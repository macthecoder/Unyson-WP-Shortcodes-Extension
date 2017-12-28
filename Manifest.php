In theme manifest we are doing something like this

$manifest['requirements'] = array(
    'wordpress' => array(
        'min_version' => '4.0'
    ),
    'framework' => array(
        'min_version' => '1.0.0',
        //'max_version' => '2.6.5'
    ),
    'extensions' => array(
        'page-builder' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'slider' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'breadcrumbs' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'shortcodes' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'megamenu' =>  array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'portfolio' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'events' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'backups' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
        'wp-shortcodes' => array(
            'min_version' => '1.0.0',
            //'max_version' => '2.99.9'
        ),
    )
);
than on theme install the TGMPA says that Unyson is required ,
user goes ahead and installs Unyson, than activates it ,
than user tries to go to theme settings but is sent to Install required extensions ,

This process itself is to long and I see no need for additional confirmation if theme developer has already set required extensions.

During Unyson install theme should be checked for requirements and required extensions downloaded.

If developer has already said that something is required that means that theme functionalities are not 100% until required extension is there. Please skip this step for required extensions since it just confuses the user and all they want is activate Unyson and go to theme settings.
