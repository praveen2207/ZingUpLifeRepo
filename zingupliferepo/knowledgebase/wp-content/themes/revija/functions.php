<?php
/**
 * Revija functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @since Revija 1.0
 */

/* 	Basic Settings
/* ---------------------------------------------------------------------- */

define('REVIJA_THEMENAME', 'Revija');
define('REVIJA_THEME_VERSION', '1.0');
define('REVIJA_PREFIX', 'revija-');

define('REVIJA_HOME_URL', get_home_url('/'));
define('REVIJA_BASE_URI', trailingslashit(get_template_directory_uri()));
define('REVIJA_BASE_PATH', trailingslashit(get_template_directory()));
define('REVIJA_ADMIN_PATH', REVIJA_BASE_PATH . trailingslashit('admin'));
define('REVIJA_FRAMEWORK_PATH', REVIJA_ADMIN_PATH . trailingslashit('framework'));

define('REVIJA_INC_PATH', REVIJA_BASE_PATH . trailingslashit('inc'));
define('REVIJA_INC_URI', REVIJA_BASE_URI . trailingslashit('inc'));

define('REVIJA_INC_PLUGINS_PATH', REVIJA_INC_PATH . 'plugins/');
define('REVIJA_INC_PLUGINS_URI', REVIJA_INC_URI . 'plugins/');

define('REVIJA_INCLUDES_URI', REVIJA_BASE_URI . trailingslashit('includes'));
define('REVIJA_INCLUDES_PATH', REVIJA_BASE_PATH . trailingslashit('includes'));

define('REVIJA_INCLUDE_CLASSES_PATH', trailingslashit(REVIJA_INCLUDES_PATH) . trailingslashit('classes'));

define('REVIJA_TEMPLATES_PATH', REVIJA_INCLUDES_PATH . 'templates/');
define('REVIJA_TEMPLATES_URL',  REVIJA_INCLUDES_URI . trailingslashit('templates'));

define('REVIJA_BASE_HELPERS', REVIJA_INCLUDES_PATH . trailingslashit('helpers'));

define('REVIJA_INCLUDES_METABOXES_PATH', REVIJA_INCLUDES_PATH . trailingslashit('meta-box'));
define('REVIJA_INCLUDES_METABOXES_URI', REVIJA_INCLUDES_URI . trailingslashit('meta-box'));





if ( !isset( $content_width ) ) $content_width = 1140;

/*  Include Plugins
/* ---------------------------------------------------------------------- */
require_once get_template_directory() . '/admin/plugin-bundle.php';

include_once get_template_directory() . '/config-plugins/config.php';
include_once REVIJA_INC_PLUGINS_PATH . 'plugins.php';
require_once get_template_directory() . '/tax-meta-class/tax-meta-class.php';

/* Load Theme Helpers
/* ---------------------------------------------------------------------- */
include_once REVIJA_BASE_HELPERS . 'aq_resizer.php';
include_once REVIJA_BASE_HELPERS . 'nav-walker.php';
include_once REVIJA_BASE_HELPERS . 'theme-helper.php';
include_once REVIJA_BASE_HELPERS . 'post-format-helper.php';
include_once REVIJA_BASE_HELPERS . 'video-preview.php';


if ( ! function_exists( 'revija_theme_add_editor_styles' ) ) {
			function revija_theme_add_editor_styles() {
				add_editor_style( 'custom-editor-style.css' );
			}
		}
add_action( 'init', 'revija_theme_add_editor_styles' );

/*  Load Classes
/* ---------------------------------------------------------------------- */

if ( ! function_exists('revija_base_functions') ) {

	function revija_base_functions() {
		// Load required classes and functions
		require_once( REVIJA_INCLUDE_CLASSES_PATH . 'register-page.class.php' );
		require_once( REVIJA_INCLUDES_PATH . 'functions-base.php' );
		return REVIJA_BASE_FUNCTIONS::instance();
	}

}

/**
 * Instance main plugin class
 */
global $revija_base_functions;
$revija_base_functions = revija_base_functions();


/*  Load Functions Files
/* ---------------------------------------------------------------------- */
include_once REVIJA_INCLUDES_PATH . 'functions-core.php';
include_once REVIJA_INCLUDES_PATH . 'functions-template.php';

/*  Add Widgets
/* ---------------------------------------------------------------------- */
include_once REVIJA_INCLUDES_PATH . 'widgets.php';

/*  Include Framework
/* ---------------------------------------------------------------------- */
include_once REVIJA_FRAMEWORK_PATH . 'framework.php';

/*  Load hooks
/* ---------------------------------------------------------------------- */
if (!is_admin()) {
	include_once REVIJA_INCLUDES_PATH . 'templates-hooks.php';
}



/*  Add Meta Boxes
/* ---------------------------------------------------------------------- */
include_once REVIJA_INCLUDES_PATH . 'meta-box/meta-box.php';
include_once REVIJA_INCLUDES_PATH . 'config-meta.php';





/*  Include Config Widget Meta Box
/* ---------------------------------------------------------------------- */

require_once get_template_directory() . '/config-widget-meta-box/config.php';

/*  Include Config Composer
/* ---------------------------------------------------------------------- */

if (class_exists('Vc_Manager')) {
	//require_once get_template_directory() . '/config-composer/config.php';
}

/*  Include Config DHVC Forms
/* ---------------------------------------------------------------------- */

if (defined('WPCF7_VERSION')) {
	require_once get_template_directory() . '/config-contact-form-7/config.php';
}

/*  Include Config WooCommerce
/* ---------------------------------------------------------------------- */

if (class_exists('WooCommerce')) {
	require_once get_template_directory() . '/config-woocommerce/config.php';
}

/*  Include Config Mega Menu
/* ---------------------------------------------------------------------- */

 if (class_exists('mega_main_init')) {
	 require_once get_template_directory() . '/config-megamenu/config.php';
 }

/*  Include Config WPML
/* ---------------------------------------------------------------------- */

if (defined('ICL_SITEPRESS_VERSION') && defined('ICL_LANGUAGE_CODE')) {
	require_once get_template_directory() . '/config-wpml/config.php';
}



/*  Is shop installed
/* ---------------------------------------------------------------------- */

if (!function_exists( 'revija_is_shop_installed' )) {
	function revija_is_shop_installed() {
		global $woocommerce;
		if ( isset( $woocommerce ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/*  Get user name
/* ---------------------------------------------------------------------- */

if (!function_exists("revija_get_user_name")) {
	function revija_get_user_name($current_user = '') {

		global $current_user;
		get_currentuserinfo();
	
		if (!$current_user->user_firstname && !$current_user->user_lastname) {

			if (revija_is_shop_installed()) {

				$firstname_billing = get_user_meta($current_user->ID, "billing_first_name", true);
				$lastname_billing = get_user_meta($current_user->ID, "billing_last_name", true);

				if (!$firstname_billing && !$lastname_billing) {
					$user_name = $current_user->user_nicename;
				} else {
					$user_name = $firstname_billing . ' ' . $lastname_billing;
				}

			} else {
				$user_name = $current_user->user_nicename;
			}

		} else {
			$user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
		}

		return $user_name;
	}
}

/*  @hooked Product class
/* ---------------------------------------------------------------------- */

if (!function_exists('revija_product_class')) {
	function revija_product_class() {
		$classes = array();
		$classes = apply_filters( 'product_class', $classes );
		echo join( ' ', array_unique( $classes ) );
	}
}

/*  Generate Dynamic Styles
/* ---------------------------------------------------------------------- */

if (!function_exists('revija_dynamic_styles')) {
	function revija_dynamic_styles() {
		require_once(REVIJA_FRAMEWORK::$path['frameworkPHP'] . 'register-dynamic-styles.php');
		revija_pre_dynamic_stylesheet();
	}
	add_action('init', 'revija_dynamic_styles', 15);
	add_action('admin_init', 'revija_dynamic_styles', 15);
}

if (!function_exists('revija_generate_styles')) {
	function revija_generate_styles() {
		$globalObject = $GLOBALS['revija_global_data'];
		$globalObject->reset_options();
		$prefix_name = sanitize_file_name($globalObject->theme_data['prefix']);

		revija_pre_dynamic_stylesheet();
		$generate_styles = new REVIJA_DYNAMIC_STYLES(false);
		$styles = $generate_styles->create_styles();
		
		$wp_upload_dir  = wp_upload_dir();
		$stylesheet_dynamic_dir = $wp_upload_dir['basedir'] . '/dynamic_revija_dir';
		$stylesheet_dynamic_dir = str_replace('\\', '/', $stylesheet_dynamic_dir);
		revija_backend_create_folder($stylesheet_dynamic_dir);
		
		$stylesheet = trailingslashit($stylesheet_dynamic_dir);
		$create = revija_write_to_file($stylesheet, $styles, true);

		if ($create === true) {
			update_option('exists_stylesheet' . $prefix_name, true);
			update_option('stylesheet_version' . $prefix_name, uniqid());
		}
	}
	add_action('revija_ajax_after_save_options_page', 'revija_generate_styles', 25);
	add_action('after_import_hook', 'revija_generate_styles', 28);
}




if (!function_exists('revija_add_contactmethod')) {
// Add contact links
function revija_add_contactmethod( $contactmethods ) {
   
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['googleplus'] = 'Google+';
    $contactmethods['rss'] = 'Rss';
    $contactmethods['pinterest'] = 'Pinterest';
    $contactmethods['instagram'] = 'Instagram';
    $contactmethods['linkedin'] = 'LinkedIn';
    $contactmethods['vimeo'] = 'Vimeo';
    $contactmethods['youtube'] = 'Youtube';
    $contactmethods['flickr'] = 'Flickr';
  
    //unset($contactmethods['yim']);

    return $contactmethods;
}
}
add_filter('user_contactmethods','revija_add_contactmethod',10,1);



// filter to replace class on reply link
add_filter('comment_reply_link', 'revija_replace_reply_link_class');
if (!function_exists('revija_replace_reply_link_class')) {
function revija_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='button button_type_icon_small button_grey", $class);
    return $class;
}
}

if (!function_exists('revija_limit_words')) {
function revija_limit_words($string, $word_limit) {
		$words = explode(" ", wp_strip_all_tags(strip_shortcodes($string)));

		if ($word_limit && (str_word_count($string) > $word_limit)) {
			return $output = implode(" ",array_splice( $words, 0, $word_limit )) ."...";
		} else if( $word_limit ) {
			return $output = implode(" ", array_splice( $words, 0, $word_limit ));
		} else {
			return $string;
		}
	}
}














if (!function_exists('revija_getPostViews')) {
function revija_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
}

if (!function_exists('revija_setPostViews')) {
function revija_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
}
// Remove issues with prefetching adding extra views   //echo revija_getPostViews(get_the_ID());
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 







//login url
if ( ! function_exists( 'revija_curPageURL' ) ) {
    function revija_curPageURL() {
    	$pageURL = 'http';
    	if ( isset( $_SERVER["HTTPS"] ) AND $_SERVER["HTTPS"] == "on" ) 
    		$pageURL .= "s";
    	
    	$pageURL .= "://";
    	
    	if ( isset( $_SERVER["SERVER_PORT"] ) AND $_SERVER["SERVER_PORT"] != "80" ) 
    		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    	else
    		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    	
    	return $pageURL;
    }         
} 

if ( ! function_exists( 'revija_is_shop_installed' ) ) {
	function revija_is_shop_installed() {
		global $woocommerce;
		if( isset( $woocommerce ) || defined( 'JIGOSHOP_VERSION' ) ) {
			return true;
		} else {
			return false;
		}
	}
}	
	
	
	
/*  Is product category
/* ---------------------------------------------------------------------- */

if ( ! function_exists( 'revija_is_product_category' ) ) {
	function revija_is_product_category( $term = '' ) {
		return is_tax( 'product_cat', $term );
	}
}

/*  Is product tag
/* ---------------------------------------------------------------------- */

if ( ! function_exists( 'revija_is_product_tag' ) ) {
	function revija_is_product_tag( $term = '' ) {
		return is_tax( 'product_tag', $term );
	}
}
	
	
	
	
	
register_activation_hook( __FILE__, 't5_clear_oembed_cache' );
add_filter( 'embed_oembed_html', 't5_oembed_wmode', 10, 2 );	

function t5_oembed_wmode( $html, $url )
{
    if ( 'www.youtube.com' !== parse_url( $url, PHP_URL_HOST ) )
        return $html;

    return str_replace( '=oembed', '=oembed&amp;wmode=transparent&enablejsapi=1', $html );
}


	
add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );	
	
	
	
/*  Post title
/* ---------------------------------------------------------------------- */	
if ( ! function_exists( 'revija_the_title' ) ) {	
function revija_the_title ( $title ) {

	//if ( in_the_loop() && ! is_page() ) {
		if ( ! $title )
			$title = esc_html__( 'No title', 'revija' );
	//}
	return $title;

}
}
add_filter( 'the_title', 'revija_the_title' );	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
