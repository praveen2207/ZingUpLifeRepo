<?php

if (!class_exists('REVIJA_TEMPLATES_HOOKS')) {

	class REVIJA_TEMPLATES_HOOKS {

		function __construct() {
			$this->init();
		}

		public function init() {
			
			if (mad_custom_get_option('cookie_alert') == 'show') {
				if (!self::getcookie('cwallowcookies')) {
					add_action('wp_enqueue_scripts', array(&$this, 'cookie_alert_enqueue_scripts'), 1);
					add_action('wp_head', array(&$this, 'top_cookie_alert_localize'), 3);
					add_action('body_prepend', array(&$this, 'top_cookie_alert'));
				}
			}	
			
			
			if (mad_custom_get_option('query-loader') == 'show') {
				add_action('body_append', array(&$this, 'query_loader'));
			}
			
			
			add_action('wp_head', array(&$this, 'add_hooks') );
		}

		
		
		public function add_hooks() {
			$post_id = mad_post_id();

			$header_layout = rwmb_meta('mad_header_layout', '', $post_id);
			if (empty($header_layout)) {
				$header_layout = mad_custom_get_option('header_layout');
			}

			$this->get_type_header($header_layout);
			$this->footer_default_hooks();

			$this->add_actions();
		}

		public function add_actions() {
			add_action('header_after', 'mad_header_after_breadcrumbs', 10);
			add_action('header_after', 'mad_portfolio_flex_slider', 10);
			add_action('header_after', 'mad_portfolio_video_slider', 10);
			add_action('header_after', 'mad_post_extended_image', 10);
			add_action('header_after', 'mad_header_after_page_content', 10);
		}
		
		public function query_loader() {
			echo '<div class="mad__queryloader loader"></div>';
		}
		
		public function get_type_header($type) {
			switch($type) {
				case 'header_2':
					$this->header_type_2_hooks();
				break;
				case 'header_3':
					$this->header_type_3_hooks();
				break;
				case 'header_4':
					$this->header_type_4_hooks();
				break;
				case 'header_5':
					$this->header_type_5_hooks();
				break;
				case 'header_6':
					$this->header_type_6_hooks();
				break;
				case 'header_7':
					$this->header_type_7_hooks();
				break;
				default:
					$this->header_default_hooks();
				break;
			}
		}

		
		public function cookie_alert_enqueue_scripts() {
			wp_enqueue_script( REVIJA_PREFIX . 'cookie' );
			wp_enqueue_script( REVIJA_PREFIX . 'cookiealert' );
		}
		
		public function top_cookie_alert_localize() {
			wp_localize_script('jquery', 'cwmessageObj', array(
				'cwmessage' => esc_html__("Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.", 'revija'),
				'cwagree' => esc_html__("Accept Cookies", 'revija'),
				'cwmoreinfo' => esc_html__("Read more", 'revija'),
				'cwmoreinfohref' => is_ssl() ? "https://" : "http://" . "www.cookielaw.org/the-cookie-law"
			));
		}
		
		public function top_cookie_alert() { 
		
			$cookie_alert_message = mad_custom_get_option('cookie_alert_message', esc_html__('Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.', 'revija'));
			$cookie_alert_read_more_link = mad_custom_get_option('cookie_alert_read_more_link');
		?>
			<script type="text/javascript">
				jQuery(document).ready(function () {
					
					var cwmessageObj = {
						cwmessage: "Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.",
						cwmoreinfohref: "http://www.cookielaw.org/the-cookie-law"
					}
					
					<?php if (!empty($cookie_alert_message)): ?>
						cwmessageObj['cwmessage'] = "<?php echo esc_html($cookie_alert_message); ?>";
					<?php endif; ?>

					<?php if (!empty($cookie_alert_read_more_link)): ?>
						cwmessageObj['cwmoreinfohref'] = "<?php echo esc_url($cookie_alert_read_more_link); ?>";
					<?php endif; ?>
					
					
					jQuery('body').cwAllowCookies(cwmessageObj);
				});
			</script>
 			<?php
		}
		
	
		/* 	Get Cookie
		/* ---------------------------------------------------------------------- */

		public static function getcookie( $name ) {
			if ( isset( $_COOKIE[$name] ) )
				return maybe_unserialize( stripslashes( $_COOKIE[$name] ) );

			return array();
		}
	

		public function header_before_container() { echo ''; }
		public function header_after_container()  { echo ''; }

		public function header_type_5_nav() {
			echo '<div class="container">
				  <div class="row">';
			mad_navigation_type_5();
			echo '</div></div>';
		}

		public function header_default_hooks() {
			add_action('header_in_before', 'mad_header_default_top_part', 10);
			
			add_action('header_in_prepend', 'mad_header_logo', 10);
			
			add_action('navigation_after', 'mad_navigation_default', 10);
		}

		public function header_type_2_hooks() {
			add_action('header_in_before', 'mad_header_type_2_top_part', 10);
			
			add_action('header_in_prepend', 'mad_header_logo_type_2', 10);

			add_action('header_in_after', 'mad_navigation_type_2', 10);
		}

		public function header_type_3_hooks() {
			add_action('header_in_before', 'mad_header_type_3_top_part', 10);
			
			add_action('navigation_after', 'mad_header_logo_type_3', 10);
		}

		public function header_type_4_hooks() {
			add_action('header_in_before', 'mad_header_type_4_top_part', 10);
			
			add_action('header_in_prepend', 'mad_header_logo_type_4', 10);

			add_action('navigation_after', 'mad_navigation_type_4', 10);
		}

		public function header_type_5_hooks() {
			add_action('header_in_before', 'mad_header_type_5_top_part', 10);
		
			add_action('navigation_after', array(&$this, 'header_type_5_nav'), 10);
		}

		public function header_type_6_hooks() {
			add_action('header_in_before', 'mad_header_type_6_top_part', 10);
			
			add_action('header_in_prepend', 'mad_header_logo_type_6', 10);

			add_action('navigation_after', 'mad_navigation_type_6', 10);
		}
		
		public function header_type_7_hooks() {
			add_action('header_in_before', 'mad_header_type_2_top_part', 10);
			
			add_action('header_in_prepend', 'mad_header_logo_type_7', 10);

			add_action('header_in_after', 'mad_navigation_type_2', 10);
		}
		
		
		public function footer_default_hooks() {
			add_action('footer_in_top_part', 'mad_footer_in_top_part_widgets', 10);
			add_action('footer_in_bottom_part', 'mad_footer_in_bottom_part', 10);
		}

	}

	new REVIJA_TEMPLATES_HOOKS();
}
