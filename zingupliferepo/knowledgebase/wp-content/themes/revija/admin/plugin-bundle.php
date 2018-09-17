<?php
/**
 * This file represents an example of the code that themes would use to register
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require_once REVIJA_ADMIN_PATH . 'class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'revija_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function revija_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
	$revija_plugins = array(
/*
        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'TGM Example Plugin', // The plugin name.
            'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
*/
        // This is an example of how to include a plugin from a private repo in your theme.
		/*
        array(
            'name'               => 'TGM New Media Plugin', // The plugin name.
            'slug'               => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
            'source'             => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
        ),
		*/
		
		
		array(
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '4.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
		
		array(
            'name'               => 'Reviewer', // The plugin name.
            'slug'               => 'reviewer', // The plugin slug (typically the folder name).
            'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/reviewer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
		
		array(
            'name'      => 'Woocommerce', // The plugin name.
            'slug'      => 'woocommerce', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
	
		array(
            'name'               => 'Envato Wordpress Toolkit Master', // The plugin name.
            'slug'               => 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name).
            'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/envato-wordpress-toolkit-master.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),

		array(
            'name'               => 'Rich Snippets Wordpress Plugin', // The plugin name.
            'slug'               => 'rich-snippets-wordpress-plugin', // The plugin slug (typically the folder name).
            'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/rich-snippets-wordpress-plugin.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '2.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),


		array(
			'name'               => 'Revija Content Types', // The plugin name.
			'slug'               => 'revija-content-types', // The plugin slug (typically the folder name).
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/revija-content-types.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),


		array(
			'name'               => 'Revija Shortcodes', // The plugin name.
			'slug'               => 'revija_shortcode', // The plugin slug (typically the folder name).
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/revija_shortcode.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'               => 'Mega Main Menu',
			'slug'               => 'mega-main-menu',
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/mega_main_menu.zip',
			'required'           => false,
			'version'            => '2.1.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		
		
		array(
			'name'               => 'Socialfans Counter', // The plugin name.
			'slug'               => 'socialfans-counter', // The plugin slug (typically the folder name).
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/socialfans-counter.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'               => 'Kk-i-like-it', // The plugin name.
			'slug'               => 'kk-i-like-it', // The plugin slug (typically the folder name).
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/kk-i-like-it.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
            'name'      => 'WP user avatar', // The plugin name.
            'slug'      => 'wp-user-avatar', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),

		array(
            'name'      => 'BuddyPress', // The plugin name.
            'slug'      => 'buddypress', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.3.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
		
		 array(
            'name'      => 'bbPress', // The plugin name.
            'slug'      => 'bbpress', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),

		array(
			'name'      => 'Contact Form 7', // The plugin name.
			'slug'      => 'contact-form-7', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '4.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'      => 'Awesome weather', // The plugin name.
			'slug'      => 'awesome-weather', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.5.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		
		array(
			'name'      => 'Latest tweets widget', // The plugin name.
			'slug'      => 'latest-tweets-widget', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		
		array(
			'name'      => 'Wp polls', // The plugin name.
			'slug'      => 'wp-polls', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.69', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'      => 'WordPress SEO by Yoast',  // The plugin name.
			'slug'      => 'wordpress-seo', // The plugin slug (typically the folder name).
			'required'  => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'               => 'LayerSlider WP', // The plugin name.
			'slug'               => 'LayerSlider', // The plugin slug (typically the folder name).
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/LayerSlider.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '5.3.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'               => 'Slider Revolution', // The plugin name.
			'slug'               => 'revslider', // The plugin slug (typically the folder name).
			'source'             => 'http://velikorodnov.com/dev/revija/plugins_revija/revslider.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '4.6.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		)

		
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $revija_config = array(
        'default_path' => '',  // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'revija' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'revija' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'revija' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'revija' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'revija' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'revija' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'revija' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'revija' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'revija' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'revija'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'revija' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'revija' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'revija' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'revija' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'revija' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'revija' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'revija' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $revija_plugins, $revija_config );

}