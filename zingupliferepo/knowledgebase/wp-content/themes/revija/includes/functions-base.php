<?php

/*  Base Function Class
/* ---------------------------------------------------------------------- */

if (!class_exists('REVIJA_BASE_FUNCTIONS')) {

	class REVIJA_BASE_FUNCTIONS {

		protected static $_instance = null;

		function __construct() {

			add_action('after_setup_theme', array(&$this, 'after_setup_theme'));

			$this->init();

			/*  Init Classes
			/* ---------------------------------------------------------------------- */
			new REVIJA_PAGE();

		}

		/* 	After Setup Theme
		/* ---------------------------------------------------------------------- */

		public function after_setup_theme() {

			// Post Formats Support
			add_theme_support('post-formats', array( 'gallery', 'quote', 'video', 'audio' ));

			// Post Thumbnails Support
			add_theme_support('post-thumbnails');

			// Add default posts and comments RSS feed links to head
			add_theme_support('automatic-feed-links');

			add_theme_support('title-tag');

			add_filter( 'widget_text', 'do_shortcode' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menu( 'primary', 'Primary Menu' );
			register_nav_menu( 'top', 'Top Menu' );
			register_nav_menu( 'bottom', 'Bottom Menu' );

			
			 if ( class_exists('bbPress') ) {
				 define ( 'BP_AVATAR_THUMB_WIDTH', 80 );
				 define ( 'BP_AVATAR_THUMB_HEIGHT', 80 );
				 define ( 'BP_AVATAR_FULL_WIDTH', 165 );
				 define ( 'BP_AVATAR_FULL_HEIGHT', 165 );
			 }
			
			
			add_theme_support( 'custom-header', apply_filters( 'revija_custom_header_args', array(
				'width'                  => 1140,
			) ) );
			
			// Setup the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'revija_custom_background_args', array(
				'default-color'      => mad_custom_get_option('styles-general_body_bg_color'),
				'default-attachment' => 'fixed',
			) ) );
			
			
			
			// Load theme textdomain
			self::load_textdomain();

			// Theme Activation
			self::theme_activation();
		}
		
		

		/* 	Initialization
		/* ---------------------------------------------------------------------- */

		public function init() {

			if (!is_admin()) {
				add_action('wp_enqueue_scripts', array(&$this, 'enqueue_styles_scripts'), 1);
				add_filter('body_class', array(&$this, 'body_class'), 5);
			}

		}

		function body_class($classes) {
			
			$classes[] = 'body_class';
			
			return $classes;
		}

		public function enqueue_styles_scripts() {
			$this->register_styles();
			$this->register_scripts();

			$this->enqueue_styles();
			$this->enqueue_scripts();

			self::localize_script();

			global $mad_theme_data;
			$prefix_name = sanitize_file_name($mad_theme_data['prefix']);

			if (get_option('exists_stylesheet'. $prefix_name ) == true) {
				$upload_dir = wp_upload_dir();
				if (is_ssl()) {
					$upload_dir['baseurl'] = str_replace("http://", "https://", $upload_dir['baseurl']);
				}
				$version = get_option('stylesheet_version' . $prefix_name);
				if (empty($version)) $version = '1';
				wp_enqueue_style( REVIJA_PREFIX . 'dynamic-styles', $upload_dir['baseurl'] . '/dynamic_revija_dir/' . $prefix_name . '.css', '', $version, 'all' );
			}
		}

		/* 	Theme Activation
		/* ---------------------------------------------------------------------- */

		public static function theme_activation() {
			global $pagenow;
			if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
				do_action('backend_theme_activation');
				wp_redirect(admin_url('admin.php?page=revija'));
			}
		}

		public function theme_slug_fonts_url() {
			$fonts_url = '';
			 

			$roboto = _x( 'on', 'Roboto font: on or off', 'revija' );
			$droid_serif = _x( 'on', 'DroidSerif font: on or off', 'revija' );
			 
			if ( 'off' !== $roboto || 'off' !== $droid_serif ) {
			$font_families = array();
			 
			if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:400,500,700';
			}
			 
			if ( 'off' !== $droid_serif ) {
			$font_families[] = 'Droid+Serif:400,700,400italic,700italic';
			}
			}

			$fonts_url = add_query_arg( 'family', urlencode( implode( '|', $font_families ) ), "//fonts.googleapis.com/css" );

			return esc_url_raw( $fonts_url );
		}
					
		
		/* 	Register Theme Styles
		/* ---------------------------------------------------------------------- */

		public function register_styles() {
			$protocol = is_ssl() ? 'https' : 'http';
			
			wp_enqueue_style( 'revija-fonts', $this->theme_slug_fonts_url(), array(), null );

		}

		/* 	Register Theme Scripts
		/* ---------------------------------------------------------------------- */

		public function register_scripts() {
			
			wp_register_script( REVIJA_PREFIX . 'cookie', REVIJA_BASE_URI . 'js/jq-cookie.js', array('jquery') );
			wp_register_script( REVIJA_PREFIX . 'cookiealert', REVIJA_BASE_URI . 'js/cookiealert.js', array('jquery') );
			wp_register_script(REVIJA_PREFIX . 'flexslider', REVIJA_BASE_URI .'js/flexslider/jquery.flexslider-min.js', array('jquery'));
			wp_register_script(REVIJA_PREFIX . 'addthis', 'http://s7.addthis.com/js/300/addthis_widget.js', array('jquery'));
			wp_register_script(REVIJA_PREFIX . 'jribbble', REVIJA_BASE_URI . 'js/jquery.jribbble-1.0.1.ugly.js', array('jquery'));
			wp_register_script(REVIJA_PREFIX . 'jflickrfeed', REVIJA_BASE_URI . 'js/jflickrfeed.js', array('jquery'));
	
		}

		/* 	WP Print Styles
		/* ---------------------------------------------------------------------- */

		public function enqueue_styles() {
			
			wp_enqueue_style(REVIJA_PREFIX . 'flexslider', REVIJA_BASE_URI . 'js/flexslider/flexslider.css');
			wp_enqueue_style(REVIJA_PREFIX . 'bootstrap', REVIJA_BASE_URI . 'css/bootstrap.min.css', REVIJA_PREFIX . 'style');
			wp_enqueue_style(REVIJA_PREFIX . 'style',  get_stylesheet_uri() );
			wp_enqueue_style(REVIJA_PREFIX . 'owlcarousel', REVIJA_BASE_URI . 'js/owl-carousel/owl.carousel.css');
			wp_enqueue_style(REVIJA_PREFIX . 'owltheme', REVIJA_BASE_URI . 'js/owl-carousel/owl.theme.css');
			wp_enqueue_style(REVIJA_PREFIX . 'owltransitions', REVIJA_BASE_URI . 'js/owl-carousel/owl.transitions.css');
			wp_enqueue_style(REVIJA_PREFIX . 'font_awesome', REVIJA_BASE_URI . 'css/font-awesome.min.css');
			wp_enqueue_style(REVIJA_PREFIX . 'jackbox', REVIJA_BASE_URI . 'js/jackbox/css/jackbox.css');
			wp_enqueue_style(REVIJA_PREFIX . 'animate', REVIJA_BASE_URI . 'css/animate.css');
			wp_enqueue_style(REVIJA_PREFIX . 'audioplayer', REVIJA_BASE_URI . 'css/audioplayer.css');
			wp_enqueue_style(REVIJA_PREFIX . 'bxslider', REVIJA_BASE_URI . 'css/bxslider.css');
			wp_enqueue_style(REVIJA_PREFIX . 'heapbox', REVIJA_BASE_URI . 'js/heapbox/heapbox.css');
			wp_enqueue_style(REVIJA_PREFIX . 'responsive', REVIJA_BASE_URI . 'css/responsive.css');
	
			if (is_rtl()) {
				wp_enqueue_style( REVIJA_PREFIX . 'rtl',  REVIJA_BASE_URI . "css/rtl.css", array( REVIJA_PREFIX . 'style' ), '1', 'all' );
			}

		}

		/*  WP Footer Action
		/* ---------------------------------------------------------------------- */

		public function enqueue_scripts() {

			if (mad_custom_get_option('query-loader') == 'show') {
			wp_enqueue_script( REVIJA_PREFIX . 'queryloader2', REVIJA_BASE_URI . 'js/jquery.queryloader2.min.js', array('jquery'), '', true );
			}
		
			wp_enqueue_script(REVIJA_PREFIX . 'modernizr', REVIJA_BASE_URI . 'js/jquery.modernizr.js', array('jquery'));
			wp_enqueue_script(REVIJA_PREFIX . 'jquery-ui', REVIJA_BASE_URI . 'js/jquery-ui.min.js', array('jquery'), '', true);
			wp_enqueue_script(REVIJA_PREFIX . 'plugins', REVIJA_BASE_URI . 'js/plugins.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'owlcarousel', REVIJA_BASE_URI . 'js/owl-carousel/owl.carousel.min.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'jacked', REVIJA_BASE_URI . 'js/jackbox/js/libs/jacked.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'jackbox-swipe', REVIJA_BASE_URI . 'js/jackbox/js/jackbox-swipe.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'jackbox', REVIJA_BASE_URI . 'js/jackbox/js/jackbox.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'heapbox', REVIJA_BASE_URI . 'js/heapbox/jquery.heapbox-0.9.4.min.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'apear', REVIJA_BASE_URI . 'js/apear.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'audioplayer', REVIJA_BASE_URI . 'js/audioplayer.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'bootstrap', REVIJA_BASE_URI . 'js/bootstrap.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'circles', REVIJA_BASE_URI . 'js/circles.min.js', array('jquery') );
			wp_enqueue_script(REVIJA_PREFIX . 'chosen', REVIJA_BASE_URI . 'js/chosen.jquery.min.js', array('jquery'), '', true );
			wp_enqueue_script(REVIJA_PREFIX . 'script', REVIJA_BASE_URI . 'js/script' . (WP_DEBUG ? '':'') . '.js', array('jquery'), '', true );

		}

		/* 	Localize Scripts
		/* ---------------------------------------------------------------------- */

		public function localize_script() {
			wp_localize_script('jquery', 'global', array(
				'template_directory' => REVIJA_BASE_URI,
				'site_url' => REVIJA_HOME_URL,
				'ajax_nonce' => wp_create_nonce('ajax-nonce'),
				'ajaxurl' => admin_url('admin-ajax.php'),
				'paththeme' => get_template_directory_uri(),
				'ajax_loader_url' => REVIJA_BASE_URI . 'images/ajax-loader@2x.gif',
				'smoothScroll' => mad_custom_get_option('smooth_scroll', 1),
				'sticky_navigation' => mad_custom_get_option('sticky_navigation', 1)
			));
		}

		/* 	Load Textdomain
		/* ---------------------------------------------------------------------- */

		public static function load_textdomain () {
			load_theme_textdomain('revija', REVIJA_BASE_PATH  . 'lang');
		}

		
		
		
		/* 	Get Cookie
		/* ---------------------------------------------------------------------- */

		public static function getcookie( $name ) {
			if ( isset( $_COOKIE[$name] ) )
				return maybe_unserialize( stripslashes( $_COOKIE[$name] ) );

			return array();
		}
		
		
		
		/* 	Helpers enqueue style & script methods
		/* ---------------------------------------------------------------------- */

		public static function enqueue_style($style)   { wp_enqueue_style( REVIJA_PREFIX . $style );   }
		public static function enqueue_script($script) { wp_enqueue_script( REVIJA_PREFIX . $script ); }

		/* 	Instance
		/* ---------------------------------------------------------------------- */

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

	}

}