<?php

if (!class_exists('REVIJA_WOOCOMMERCE_CONFIG')) {

	class REVIJA_WOOCOMMERCE_CONFIG {

		public $action_quick_view = 'mad_action_add_product_popup';
		public $action_login = 'mad_action_login_popup';
		public $paths = array();
		public static $pathes = array();

		public function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file)  {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {

			// Woocommerce support
			add_theme_support('woocommerce');

			
			define('REVIJA_WOO_CONFIG', true);

			$this->paths = array(
				'PHP' => REVIJA_BASE_PATH . 'config-woocommerce/' . trailingslashit('php'),
				'TEMPLATES' => REVIJA_BASE_PATH . 'config-woocommerce/' . trailingslashit('templates'),
				'ASSETS_DIR_NAME' => 'assets',
				'WIDGETS_DIR' => REVIJA_BASE_PATH . 'config-woocommerce/' . trailingslashit('widgets'),
				'BASE_URI' => REVIJA_BASE_URI . trailingslashit('config-woocommerce')
			);
			self::$pathes = $this->paths;

			require_once( $this->paths['PHP'] . 'functions-template.php' );
			require_once( $this->paths['PHP'] . 'ordering.class.php' );

			$this->woocommerce_global_config();
			$this->woocommerce_remove_hooks();
			$this->woocommerce_add_filters();
			$this->woocommerce_add_hooks();

			unregister_widget( 'WC_Widget_Product_Categories' );
			require_once( $this->paths['WIDGETS_DIR'] . 'class-wc-widget-product-categories.php' );
			
			
			require_once( $this->paths['WIDGETS_DIR'] . 'class-wc-widget-product-search.php' );
			require_once( $this->paths['WIDGETS_DIR'] . 'class-wc-widget-recent-reviews.php' );

			
			
			add_action('wp_enqueue_scripts', array(&$this, 'add_enqueue_scripts'));
			add_action('admin_init', array(&$this, 'mad_woocommerce_first_activation') , 45 );
			add_action('backend_theme_activation', array(&$this, 'mad_woocommerce_set_defaults'), 10);
			add_action('widgets_init', array(&$this, 'include_widgets'));

			require_once( $this->paths['PHP'] . 'dropdown-cart.class.php' );
			require_once( $this->paths['PHP'] . 'form-login.class.php' );

		}

		public function include_widgets() {
			register_widget('Mad_WC__Widget_Recent_Reviews');
			register_widget('Mad_WC__Widget_Product_Search');
			
			register_widget('Mad_WC_Widget_Product_Categories');
		}

		public function woocommerce_global_config() {
			global $revija_config;

			$revija_config['themeImgSizes']['shop_thumbnail'] = array('width' => 90, 'height' => 90);
			$revija_config['themeImgSizes']['shop_catalog']   = array('width' => 325, 'height' => 325);
			$revija_config['themeImgSizes']['shop_single']    = array('width'=> 450, 'height'=> 450);

			$revija_config['shop_overview_column_count']  = mad_custom_get_option('woocommerce_column_count');
			$revija_config['shop_overview_product_count'] = mad_custom_get_option('woocommerce_product_count');

			// Add Image Size
			if (function_exists('add_image_size')) {
				mad_add_thumbnail_size($revija_config['themeImgSizes']);
			}

		}

		public function woocommerce_add_filters() {
			add_filter('woocommerce_enqueue_styles', array(&$this, 'mad_woocommerce_enqueue_styles'));

			add_filter('woocommerce_general_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));
			add_filter('woocommerce_page_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));
			add_filter('woocommerce_catalog_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));
			add_filter('woocommerce_inventory_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));
			add_filter('woocommerce_shipping_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));
			add_filter('woocommerce_tax_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));
			add_filter('woocommerce_product_settings', array(&$this, 'mad_woocommerce_general_settings_filter'));

			add_filter('loop_shop_columns', array(&$this, 'woocommerce_loop_columns'));
			add_filter('loop_shop_per_page', array(&$this, 'woocommerce_product_count'));
		}

		public function woocommerce_remove_hooks() {
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
			remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
			
			remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

			remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
		}

		public function woocommerce_add_hooks() {

			add_action('woocommerce_after_shop_loop', array(&$this, 'mad_woocommerce_pagination'));

			add_action('woocommerce_archive_description', array(&$this, 'mad_woocommerce_ordering_products'));

			add_action('woocommerce_before_shop_loop_item_title', 'mad_woocommerce_show_product_loop_out_of_sale_flash');
			add_action('woocommerce_before_shop_loop_item_title', array(&$this, 'mad_woocommerce_before_thumbnail'));

			
			//single product	
			add_action('mad_woocommerce_after_product_thumbnails', 'woocommerce_show_product_sale_flash');
			add_action('mad_woocommerce_after_product_thumbnails', 'mad_woocommerce_show_product_loop_out_of_sale_flash');
			

			// Title, meta, content, price
			add_action('woocommerce_before_single_product', array(&$this, 'mad_woocommerce_template_single_product_title'), 10);
			add_action('woocommerce_before_single_product', 'wc_print_notices', 11);
			
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 11);
			
			add_action('woocommerce_single_product_summary', array(&$this, 'mad_woocommerce_template_single_meta'), 12);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 13);
			add_action('woocommerce_single_product_summary', array(&$this, 'mad_share_this'), 20);
			
			add_action('woocommerce_after_add_to_cart_button', array(&$this, 'product_actions'), 14);

			
			// Tabs, Link products, Related products
			add_action('woocommerce_after_single_product_summary', 'mad_woocommerce_output_product_data_tabs', 26);
			add_action('woocommerce_after_single_product_summary', 'mad_woocommerce_output_related_products', 27);

			// content desc
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_shop_before_hidden'), 10);

			//title
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_shop_title'), 11);

			// description
			//add_action('woocommerce_before_shop_loop_item_title', array(&$this, 'woocommerce_shop_description'), 11);
			
			add_action('woocommerce_after_shop_loop_item_title',  array(&$this, 'woocommerce_shop_before_product_section'), 12);
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_shop_after_product_section'), 13);
			
			// process
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_shop_before_process'), 30);

			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 31);
			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 31);
			
			
			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 32);
			
			
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'product_actions'), 33);
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_shop_after_process'), 35);

			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_shop_after_hidden'), 36);
			
			// Ajax
			add_action('wp_ajax_' . $this->action_quick_view, array(&$this, 'mad_ajax_product_popup'), 30);
			add_action('wp_ajax_nopriv_' . $this->action_quick_view, array(&$this, 'mad_ajax_product_popup'), 30);

			add_action('wp_ajax_nopriv_' . $this->action_login, array(&$this, 'mad_ajax_form_login'), 30);
		}

		public function woocommerce_loop_columns() {
			global $revija_config;
			return $revija_config['shop_overview_column_count'];
		}

		public function woocommerce_product_count() {
			global $revija_config;
			return $revija_config['shop_overview_product_count'];
		}

		public function mad_share_this() {
			ob_start() 
			?>

			<div class="add_this">

				<span ><?php esc_html_e('Share this:', 'revija') ?></span>
				<div class="addthis_widget_container">

					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-url="<?php the_permalink(); ?>" data-title="<?php the_title_attribute(); ?>">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<!-- AddThis Button END -->

					<?php REVIJA_BASE_FUNCTIONS::enqueue_script('addthis'); ?>

				</div>

			</div>

			<?php echo ob_get_clean();
		}

		public function mad_ajax_product_popup() {
			if (function_exists('check_ajax_referer')) {
				check_ajax_referer($this->action_quick_view, '_madnonce_ajax');
			}

			$quickview = new REVIJA_QUICK_VIEW($_POST['id']);
			echo $quickview->html();
			wp_die('exit');
		}

		public function mad_ajax_form_login() {
			if (function_exists('check_ajax_referer')) {
				check_ajax_referer($this->action_login, '_madnonce_ajax');
			}

			$form = new REVIJA_FORM_LOGIN($_POST['href']);
			echo $form->html();
			wp_die('exit');
		}

		public function mad_woocommerce_first_activation() {
			if (!is_admin()) return;
			$this->mad_woocommerce_set_defaults();
		}

		public function mad_woocommerce_set_defaults() {
			global $revija_config;

//			update_option('install_woocommerce_pages', false);

			update_option('shop_thumbnail_image_size', $revija_config['themeImgSizes']['shop_thumbnail']);
			update_option('shop_catalog_image_size', $revija_config['themeImgSizes']['shop_catalog']);
			update_option('shop_single_image_size', $revija_config['themeImgSizes']['shop_single']);

			$disabled_options = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');

			foreach ($disabled_options as $option) {
				update_option($option, false);
			}

		}

		public function add_enqueue_scripts() {
			//$css_file = $this->assetUrl('css/woocommerce-mod.css');
			$woo_mod_file = $this->assetUrl('js/woocommerce-mod.js');
			$woo_zoom_file = $this->assetUrl('js/elevatezoom.min.js');
			$woo_file_raty = $this->assetUrl('js/raty/jquery.raty.js');
			$woo_file_raty_css = $this->assetUrl('js/raty/jquery.raty.css');

			//wp_enqueue_style(REVIJA_PREFIX . 'woocommerce-mod', $css_file);
			wp_enqueue_style(REVIJA_PREFIX . 'woocommerce-raty', $woo_file_raty_css);
			wp_enqueue_script(REVIJA_PREFIX . 'woocommerce-mod', $woo_mod_file, array('jquery'), 1, true);
			wp_enqueue_script(REVIJA_PREFIX . 'woocommerce-raty', $woo_file_raty, array('jquery'), 1, true);
			wp_register_script(REVIJA_PREFIX . 'elevate-zoom', $woo_zoom_file, REVIJA_PREFIX . 'woocommerce-mod');

			wp_localize_script(REVIJA_PREFIX . 'woocommerce-mod', 'woocommerce_mod', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce_quick_view_popup' => wp_create_nonce( $this->action_quick_view ),
				'nonce_login_popup' => wp_create_nonce( $this->action_login ),
				'action_quick_view' => $this->action_quick_view,
				'action_login' => $this->action_login
			));

			
			
			//wp_dequeue_style( 'select2' );
		}

		public static function enqueue_script($script) {
			wp_enqueue_script(REVIJA_PREFIX . $script);
		}

		public function mad_woocommerce_pagination() {
			echo mad_corenavi();
		}

		public function mad_woocommerce_ordering_products() {
			$ordering = new REVIJA_CATALOG_ORDERING();
			echo $ordering->output();
		}

		public function mad_woocommerce_second_thumbnail() {
			$id = mad_post_id();
			$active_hover = mad_custom_get_option('product_hover');

			if ($active_hover == 'yes') {
				$product_gallery = get_post_meta( $id, '_product_image_gallery', true );

				if (!empty($product_gallery)) {
					$gallery  = explode(',',$product_gallery);
					$image_id = $gallery[0];

					$image = wp_get_attachment_image(
						$image_id,
						'shop_catalog',
						false,
						array(
							'class' => "attachment-shop_catalog c_image_2"
						)
					);

					if (!empty($image)) return $image;
				}
			}

		}

		public function mad_woocommerce_before_thumbnail () {
			global $product, $post;
			$data = $this->create_data_string(array(
				'id' => get_the_ID()
			));
			$has_thumb = ($this->mad_woocommerce_second_thumbnail() != '') ? 'has-second-thumb' : '';
			?>
			
			
			
			<?php if ( $product->is_featured() ) : ?>
			
				<?php echo apply_filters( 'woocommerce_featured_flash', '<div class="ribbon onfeatured"><img src="'. REVIJA_BASE_URI .'images/new_ribbon.png" alt=""></div>', $post, $product ); ?>
			
			<?php endif; ?>
			
			<div class="thumbnail-container <?php echo esc_attr($has_thumb) ?>">

				

				<a href="<?php the_permalink(); ?>">
					<?php echo $product->get_image('shop_catalog'); ?>
					<?php if ($has_thumb): ?>
						<?php echo $this->mad_woocommerce_second_thumbnail(); ?>
					<?php endif; ?>
				</a>

				
				<?php do_action('woocommerce_after_thumbnail'); ?>

			</div><!--/ .thumbnail-container-->
			
			
		<?php
		}

		function mad_woocommerce_general_settings_filter($options) {
			$delete = array('woocommerce_enable_lightbox');

			foreach ($options as $key => $option) {
				if (isset($option['id']) && in_array($option['id'], $delete)) {
					unset($options[$key]);
				}
			}
			return $options;
		}

		function mad_woocommerce_enqueue_styles($styles) {
			$styles = array();
			return $styles;
		}

		public static function content_truncate($string, $limit, $break = ".", $pad = "...") {
			if (strlen($string) <= $limit) { return $string; }

			if (false !== ($breakpoint = strpos($string, $break, $limit))) {
				if ($breakpoint < strlen($string) - 1) {
					$string = substr($string, 0, $breakpoint) . $pad;
				}
			}
			if (!$breakpoint && strlen(strip_tags($string)) == strlen($string)) {
				$string = substr($string, 0, $limit) . $pad;
			}
			return $string;
		}

		public static function create_data_string($data = array()) {
			$data_string = "";

			foreach($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$data_string .= " data-$key='$value' ";
			}
			return $data_string;
		}

		public function mad_woocommerce_template_single_product_title() {
			?>
			<section class="product-section">
			<div class="section">
				<?php woocommerce_template_single_title(); ?>
			</div>	
			</section><!--/ .product-section-->
		<?php
		}

		function mad_woocommerce_template_single_meta () {
			?>

			<?php global $product; ?>
			
			<?php $post_content = !empty($product->post->post_excerpt) ? $product->post->post_excerpt : self::content_truncate($product->post->post_content, 200 , " ", "…"); ?>

			<?php if (!empty($post_content)): ?>
				<p class="product-content">
					<?php echo do_shortcode($post_content); ?>
				</p><!--/ .product-section-->
			<?php endif; ?>
			
			
			
			<section class="product-section">

				<div class="product_meta">

					<?php do_action('woocommerce_product_meta_start'); ?>

					<?php if ($product->is_in_stock()): ?>
						<?php $availability = sprintf(esc_html__('%s in stock', 'revija'), $product->get_total_stock()); ?>
					<span class="stock_wrapper clearfix">
						<span class="meta-title"><?php esc_html_e('Availability:', 'revija'); ?></span>
						<span class="stock in-stock"><?php echo esc_html($availability); ?></span>
					</span>
					<?php else: ?>
					<span class="stock_wrapper clearfix">
						<span class="meta-title"><?php esc_html_e('Availability:', 'revija'); ?></span>
						<span class="stock out-of-stock"><?php esc_html_e('out of stock', 'revija') ?></span>
					</span>
					<?php endif; ?>

					<?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
					<span class="sku_wrapper clearfix">
						<span class="meta-title"><?php esc_html_e('SKU:', 'revija'); ?></span>
						<span class="sku" itemprop="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'revija'); ?></span>
					</span>
					<?php endif; ?>

					<?php do_action('woocommerce_product_meta_end'); ?>

				</div><!--/ .product_meta-->

	
			</section><!--/ .product-section-->
			
			

		<?php
		}


		public function get_attributes() {
			global $product;
			$attributes = $product->get_attributes(); ?>

			<?php if (!empty($attributes)): ?>

				<?php ob_start(); ?>

				<?php foreach ($attributes as $key => $value): ?>
					<tr>
						<?php if (!empty($key)): ?>
							<td><?php echo ucfirst(substr($key, 3)); ?></td>
						<?php endif; ?>

						<?php if ($value['name'] !== ''): ?>
							<td>
								<?php $attribute = $product->get_attribute($value['name']); ?>

								<?php if (strpos($attribute, ",") !== false): ?>

									<?php $values = explode(',', $attribute); ?>

									<div class="select-small-size">
										<select class="woo-custom-select" name="<?php echo esc_attr($key) ?>">
											<?php foreach ($values as $val): ?>
												<option value="<?php echo esc_attr(trim($val)); ?>"><?php echo esc_html($val); ?></option>
											<?php endforeach; ?>
										</select>
									</div><!--/ .select-small-size-->

								<?php else: ?>
									<?php echo esc_html($attribute); ?>
								<?php endif; ?>

							</td>
						<?php endif; ?>

					</tr>
				<?php endforeach; ?>

				<?php return ob_get_clean();

			endif;
		}

		public function product_actions() {
			?>
			<div class="product-actions">
				<?php do_action('product-actions-before'); ?>
				<?php do_action('product-actions-after'); ?>
			</div><!--/ .product-actions-->
		<?php
		}

		function woocommerce_shop_before_hidden()  { echo '<div class="product_info">'; }
		function woocommerce_shop_after_hidden()   { echo '</div>'; }

		function woocommerce_shop_before_product_section()   { echo '<div class="product-section">'; }
		function woocommerce_shop_after_product_section()    { echo '</div>'; }

		function woocommerce_shop_before_process() { echo '<div class="process-section clearfix">'; }
		function woocommerce_shop_after_process()  { echo '</div>'; }

		function woocommerce_shop_description() {
			global $product;
			$post_content = !empty($product->post->post_excerpt) ? $product->post->post_excerpt : substr($product->post->post_content, 0, 200) . '...';
			echo "<p>{$post_content}</p>";
		}

		function woocommerce_shop_title() {
			global $product;
			echo '<a href="'. get_the_permalink() .'"><h4>'. mad_post_content_truncate(get_the_title(), 28, '.', '...' ) .'</h4></a>';
		}
		
		
	}

	new REVIJA_WOOCOMMERCE_CONFIG();
}