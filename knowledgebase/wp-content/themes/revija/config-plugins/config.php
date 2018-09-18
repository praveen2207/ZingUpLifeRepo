<?php

if (!class_exists('REVIJA_PLUGINS_CONFIG')) {

	class REVIJA_PLUGINS_CONFIG {

		public $options;
		public $paths = array();

		protected function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		protected function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {
			
			$this->paths = array(
				'PHP' => REVIJA_BASE_PATH . 'config-plugins/php/',
				'ASSETS_DIR_NAME' => 'assets',
				'WIDGETS_DIR' => REVIJA_BASE_PATH . 'config-plugins/widgets/',
				'BASE_URI' => REVIJA_BASE_URI . trailingslashit('config-plugins')
			);

			
			
			$this->add_hooks();
			$this->hooks_for_flashsale();
			add_action('wp_enqueue_scripts', array(&$this, 'frontend_assets'));

		}

		
		
		public function add_hooks() {
			add_action('wp', array(&$this, 'dequeue_styles'));
			add_action('admin_init', array(&$this, 'dequeue_styles'));
			add_action('wp_head', array(&$this, 'dequeue_styles'), 5);
		}

		public function hooks_for_flashsale() {

			if (class_exists('WooCommerce') && defined('RC_TC_BASE_FILE')) {
				add_action('woocommerce_after_thumbnail', array(&$this, 'on_price_htmla'));

				$this->options = $this->woocommerce_brands_plugin_options();
				add_filter( 'woocommerce_settings_tabs_array', array( $this, 'woocommerce_brands_add_tab_woocommerce' ), 60);
				add_action( 'woocommerce_update_options_flash_sale', array( $this, 'woocommerce_brands_update_options' ) );
				add_action( 'woocommerce_settings_tabs_flash_sale', array( $this, 'woocommerce_brands_print_plugin_options' ) );
			}
		}

		public function frontend_assets() {
			$ips_items_status = get_option('ips_items_status');

			if (isset($ips_items_status) && $ips_items_status != null) {
				if (in_array('active', $ips_items_status)) {
					wp_enqueue_style(REVIJA_PREFIX . 'indeed-smart-popup-frontend', $this->assetUrl('css/indeed-smart-popup-frontend.css'), false);
				}
			}
		}

		public function dequeue_styles() {

			if (is_admin()) {

				if (defined('RC_TC_BASE_FILE')) {
					/* jquery style from woo-sale-revolution-flashsale plugin */
					wp_dequeue_style('jquery-style');
				}
			} else {

				if (defined('RC_TC_BASE_FILE')) {
					/* jquery style from woo-sale-revolution-flashsale plugin */
					wp_dequeue_style('jquery-style');
					wp_dequeue_style('flipclock-master-cssss');
				}

				/* jquery style from indeed-smart-popup */
				wp_dequeue_style('isp_owl_carousel_css');
				wp_dequeue_style('isp_owl_theme_css');
				
				
				// if ( class_exists('bbPress') ) {
				// wp_dequeue_style ('bbp-default');
				// wp_dequeue_style( 'bp-legacy-css' );
				// }
				
			}

		}

		public function woocommerce_brands_add_tab_woocommerce ($tabs) {
			unset($tabs['pw_flash_sale']);
			$tabs['flash_sale'] = esc_html__('Flash Sale', 'revija');
			return $tabs;
		}

		public function woocommerce_brands_update_options() {
			global $wp_rewrite;
			foreach( $this->options as $option ) {
				woocommerce_update_options( $option );
			}
			$wp_rewrite->flush_rules();
		}

		public function woocommerce_brands_print_plugin_options() {

			?>
			<div class="subsubsub_section">
				<br class="clear" />
				<?php foreach( $this->options as $id => $tab ) : ?>
					<div class="section" id="woocommerce_brands_<?php echo esc_attr($id) ?>">
						<?php woocommerce_admin_fields( $this->options[$id] ) ;?>
					</div>
				<?php endforeach;?>
			</div>
		<?php
		}

		private function woocommerce_brands_plugin_options() {
			$options['general_settings'] = array(
				array(
					'name' => esc_html__( 'General Settings', 'revija' ),
					'type' => 'title',
					'desc' => '',
					'id' => 'pw_woocommerce_brands_general_settings'
				),
				array(
					'name'      => esc_html__( 'Show Count Down Single', 'revija' ),
					'desc'      => esc_html__( 'Show Count Down Single.', 'revija'),
					'id'        => 'pw_woocommerce_flashsale_single_countdown',
					'std' 		=> 'yes',         // for woocommerce < 2.0
					'default' 	=> 'yes',         // for woocommerce >= 2.0
					'type'      => 'checkbox'
				),
				array(
					'name'      => esc_html__( 'Show Count Down Archive', 'revija' ),
					'desc'      => esc_html__( 'Show Count Down Archive', 'revija' ),
					'id'        => 'pw_woocommerce_flashsale_archive_countdown',
					'std' 		=> 'yes',         // for woocommerce < 2.0
					'default' 	=> 'yes',         // for woocommerce >= 2.0
					'type'      => 'checkbox'
				),
				array( 'type' => 'sectionend', 'id' => 'pw_woocommerce_brands_image_settings' )
			);
			return $options;
		}

		public function on_price_htmla() {

			$html = '';
			global $product;
			$_product = $product;

			$arr = $pw_discount = $result = $timer = "";
			$query_meta_query=array('relation' => 'AND');
			$query_meta_query[] = array(
				'key' =>'status',
				'value' => "active",
				'compare' => '=',
			);
			$matched_products = get_posts(
				array(
					'post_type' 	=> 'flash_sale',
					'numberposts' 	=> -1,
					'post_status' 	=> 'publish',
					'fields' 		=> 'ids',
					'orderby'	=>'modified',
					'no_found_rows' => true,
					'meta_query' => $query_meta_query,
				)
			);

			$id = $_product->id;
			foreach($matched_products as $pr) {
				$arr=$type="";
				$pw_to=strtotime(get_post_meta($pr,'pw_to',true));
				$pw_from=strtotime(get_post_meta($pr,'pw_from',true));
				$arr= get_post_meta($pr,'pw_array',true);
				$blogtime = strtotime(current_time( 'mysql' ));
				$pw_type = get_post_meta($pr,'pw_type',true);
				if($pw_to=="" && ($pw_type=="quantity" || $pw_type=="special"))
				{
					$pw_from=$blogtime-1000;
					$pw_to=$blogtime+1000;
				}
				if($blogtime<$pw_to && $blogtime>$pw_from)
				{
					if (is_array($arr) && in_array($id, $arr))
					{
						if($pw_type=="flashsale")
						{
							$pw_discount= get_post_meta($pr,'pw_discount',true);
							$timer=get_post_meta($pr,'pw_to',true);
							goto break_line;
						}
						else
							goto break_line;
					}
				}

			}
			break_line:

			if ( is_shop() ) {
				if (get_option('pw_woocommerce_flashsale_archive_countdown')!="yes")
					goto break_ret;
			}

			if ( is_singular( 'product' ) ) {
				if (get_option('pw_woocommerce_flashsale_single_countdown')!="yes")
					goto break_ret;
			}

			if ($timer != "") {

				$id = rand(0,1000);

				$html.='
					<div class="fl-pcountdown-cnt">
						<ul class="fl-countdown fl-countdown-pub countdown_' . $id . '">
						  <li><span class="days">00</span><p class="days_text">Days</p></li>
							<li class="seperator">:</li>
							<li><span class="hours">00</span><p class="hours_text">'.esc_html__('Hours','revija').'</p></li>
							<li class="seperator">:</li>
							<li><span class="minutes">00</span><p class="minutes_text">'.esc_html__('Minutes','revija').'</p></li>
							<li class="seperator">:</li>
							<li><span class="seconds">00</span><p class="seconds_text">'.esc_html__('Seconds','revija').'</p></li>
						</ul>
					</div>
					<script type="text/javascript">
						jQuery(".countdown_' . $id . '").countdown({
							date: "' . $timer . '",
							offset: -8,
							day: "Day",
							days: "Days"
						}, function () {
						//	alert("Done!");
						});
					</script>';
			}
			break_ret:
			echo $html;
		}

	}

	new REVIJA_PLUGINS_CONFIG();
}