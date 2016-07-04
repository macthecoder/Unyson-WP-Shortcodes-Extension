<?php

if (! defined('FW')) { die('Forbidden'); }

class FW_Extension_WP_Shortcodes extends FW_Extension {
	protected $default_shortcodes_list = null;

	protected function _init() {
		if ( is_admin() ) {
			$this->add_admin_hooks();
		} else {
			$this->add_frontend_hooks();
		}
	}

	public function default_shortcodes_list() {
		if (! $this->default_shortcodes_list) {
			/**
			 * Filter default shortcodes list that will be displayed in
			 * default post editor and all of the wp-editors.
			 */
			$this->default_shortcodes_list = apply_filters(
				'fw:ext:wp-shortcodes:default-shortcodes',
				array(
					'button', 'map', 'icon', 'divider', 'notification'
				)
			);
		}

		return $this->default_shortcodes_list;
	}

	public function build_shortcodes_list() {
		$shortcodes = array_values( fw_ext('shortcodes')->get_shortcodes() );

		$shortcodes = array_map(
			array($this, '_parse_single_shortcode'),
			$shortcodes
		);

		return $shortcodes;
	}

	public function _parse_single_shortcode( $shortcode ) {
		$result = array();

		$icon = $shortcode->locate_URI('/static/img/page_builder.png');

		if ($icon) {
			$result['icon'] = $icon;
		}

		$result['options'] = $shortcode->get_options();
		$result['config'] = $shortcode->get_config();
		$result['tag'] = $shortcode->get_tag();

		$title = $shortcode->get_config('page_builder/title');
		$result['title'] = $title ? $title : $result['tag'];

		return $result;
	}

	protected function add_admin_hooks() {
		add_filter(
			'mce_buttons',
			array($this, 'register_unyson_button')
		);

		add_filter(
			'mce_external_plugins',
			array($this, 'add_unyson_plugin')
		);

		add_filter(
			'mce_css',
			array($this, 'editor_styles')
		);
	}

	protected function add_frontend_hooks() {
	}

	public function add_unyson_plugin($plugins) {
		$plugins['unyson_shortcodes'] = $this->locate_js_URI('plugin');
		return $plugins;
	}

	public function register_unyson_button($buttons) {
		array_push($buttons, 'unyson_shortcodes');
		return $buttons;
	}

	public function editor_styles($mce_css) {
		$mce_css .= ', ' . implode(', ', array(
			$this->locate_css_URI('content'),
			// in case some shortcodes use unycon icons
			fw_get_framework_directory_uri('/static/libs/unycon/unycon.css'),
			// in case some shortcodes use fontAwesome icons
			fw_get_framework_directory_uri('/static/libs/font-awesome/css/font-awesome.min.css')
		));

		return $mce_css;
	}
}
