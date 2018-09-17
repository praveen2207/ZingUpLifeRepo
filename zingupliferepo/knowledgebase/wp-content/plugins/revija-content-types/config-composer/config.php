<?php

if (!class_exists('REVIJA_VC_CONFIG')) {

	class REVIJA_VC_CONFIG {

		public $paths = array();

		public $removeElements = array(
			'vc_pie', 'vc_images_carousel',
			'vc_posts_slider', 'vc_progress_bar', 'vc_carousel', 'vc_gallery',
			'vc_gmaps', 'vc_cta_button', 'vc_cta_button2',
			'vc_media_grid', 'vc_masonry_media_grid', 'vc_masonry_grid', 'vc_widget_sidebar',

			'products', 'product', 'product_attribute', 'recent_products', 'add_to_cart',
			'add_to_cart_url', 'product_category', 'product_categories', 'featured_products',
			'sale_products', 'best_selling_products', 'top_rated_products'
		);

		function __construct() {

			$dir = dirname(__FILE__);

			
			
			$this->paths = array(
				'APP_ROOT' => $dir,
				'APP_DIR' => basename( $dir ),
				'CONFIG_DIR' => $dir . '/config',
				'ASSETS_DIR_NAME' => 'assets',
				'BASE_URI' => trailingslashit($dir),
				'PARTS_VIEWS_DIR' => $dir . '/shortcodes/views/',
				'TEMPLATES_DIR' => $dir . '/shortcodes/templates/'
			);

			define('REVIJA_PREFIX_CONT', 'revija-');
			
			// Add New param
			$this->add_shortcode_params();
			$this->add_hooks();

			// Load
			require_once $this->path('CONFIG_DIR', 'templates.php');
			$this->autoloadLibraries($this->path('TEMPLATES_DIR'));

			$this->init();
		}

		
		public function before_init() {
			require_once $this->path('CONFIG_DIR', 'map.php');
		}

		public function init() {

			add_action('vc_build_admin_page', array(&$this, 'autoremoveElements'), 11);
			add_action('vc_load_shortcode', array(&$this, 'autoremoveElements'), 11);

			
			
			if ( is_admin() ) {
				add_action('load-post.php', array($this, 'admin_init') , 4);
				add_action('load-post-new.php', array($this, 'admin_init') , 4 );
			} else {
				add_action('wp_enqueue_scripts', array(&$this, 'front_init'));
			}
		}

		
		
		
		public function add_hooks() {
			add_action('pre_import_hook', array(&$this, 'wpb_content_types'));
			add_action('vc_before_init', array(&$this, 'before_init'), 1);
			if (function_exists('layerslider')) {
				add_action('vc_after_init', array(&$this, 'add_param_css_animation_to_layerslider'));
			}
			add_filter('vc_font_container_get_allowed_tags', array(&$this, 'mad_font_container_get_allowed_tags'));
			
			add_filter('wpb_widget_title', 'override_widget_title', 10, 2);
			function override_widget_title($output = '', $params = array('')) {
			  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
			  return '<h3 class="section_title '.$extraclass.'">'.$params['title'].'</h3>';
			}
			

			add_filter( 'vc_gitem_template_attribute_post_id', 'vc_gitem_template_attribute_post_id', 10, 2 );
			function vc_gitem_template_attribute_post_id( $value, $data ) {
				extract( array_merge( array(
					'post' => null,
					'data' => ''
				), $data ) );
				return get_the_ID();
			}
		
		
			add_filter( 'vc_gitem_template_attribute_post_meta', 'vc_gitem_template_attribute_post_meta', 10, 2 );
			function vc_gitem_template_attribute_post_meta( $value, $data ) {
				extract( array_merge( array(
					'post' => null,
					'data' => ''
				), $data ) );
				$output = '';
				$id = get_the_ID();
				
				$output .= mad_blog_post_meta($id, '');
				return $output;
			}
		
			add_filter( 'vc_gitem_template_attribute_post_text', 'vc_gitem_template_attribute_post_text', 10, 2 );
			function vc_gitem_template_attribute_post_text( $value, $data ) {
				extract( array_merge( array(
					'post' => null,
					'data' => ''
				), $data ) );
				$output = '';
				$id = get_the_ID();
				$link = get_permalink();
				$title = get_the_title();
				
				$excerpt = trim(get_the_excerpt());
				if (!empty($excerpt)) {
					$post_content = get_the_excerpt();
				} else {
					$excerpt = preg_replace( '~\[[^\]]+\]~', '', get_the_content() );
					$post_content =  $excerpt;
				}
				$post_content =  revija_limit_words($post_content, 20);
				
				
				$output .= '<div class="post_text">';
							
						if (is_sticky($id)){
				$output .= '<div class="post_theme">'. esc_html__( 'Exlusive', 'revija' ) .'</div>';
						}
					
				$output .= '<h4 class="post_title"><a href="'. esc_url($link) .'">'. esc_attr($title) .'</a></h4><p>'. esc_attr($post_content) .'</p>
				<a href="'. esc_url($link) .'" class="link-home button button_type_2 button_grey_light">'. esc_html__('Read More', 'revija') .'</a></div>';
	
				return $output;
			}
		
		
			add_filter( 'vc_gitem_template_attribute_post_img_btn', 'vc_gitem_template_attribute_post_img_btn', 10, 2 );
			function vc_gitem_template_attribute_post_img_btn( $value, $data ) {
				extract( array_merge( array(
					'post' => null,
					'data' => ''
				), $data ) );
			$output = '';
				
			$id = get_the_ID();
			$link = get_permalink($id);
			$title = get_the_title($id);
			$post_content = get_the_content();	
			$output .= mad_blog_post_th_btn($id, $post_content, $title, 14, '555*374');
				
				return $output;
			}
		
			
			
			
		}
		
		
		
		public function add_shortcode_params() {
			vc_add_shortcode_param('choose_icons', array(&$this, 'param_icon_field'), plugins_url ('/revija-content-types/config-composer/assets/js/js_shortcode_param_icon.js'));
			vc_add_shortcode_param('number', array(&$this, 'param_number_field'), plugins_url('/revija-content-types/config-composer/assets/js/js_shortcode_tables.js'));
			vc_add_shortcode_param('hidden', array(&$this, 'param_hidden_field'));
			vc_add_shortcode_param('term_categories', array(&$this, 'param_woocommerce_term_categories'), plugins_url('/revija-content-types/config-composer/assets/js/js_shortcode_products_cat.js'));
			vc_add_shortcode_param('term_categories2', array(&$this, 'param_woocommerce_term_categories2'), plugins_url('/revija-content-types/config-composer/assets/js/js_shortcode_products_cat2.js'));	
			vc_add_shortcode_param('term_categories3', array(&$this, 'param_woocommerce_term_forum'), plugins_url('/revija-content-types/config-composer/assets/js/js_shortcode_products_cat2.js'));	
		}

		public function add_param_css_animation_to_layerslider() {
			$add_css_animation = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'CSS Animation', 'revija' ),
				'param_name' => 'css_animation',
				'admin_label' => true,
				'value' => array(
					esc_html__( 'No', 'revija' ) => '',
					esc_html__( 'Top to bottom', 'revija' ) => 'top-to-bottom',
					esc_html__( 'Bottom to top', 'revija' ) => 'bottom-to-top',
					esc_html__( 'Left to right', 'revija' ) => 'left-to-right',
					esc_html__( 'Right to left', 'revija' ) => 'right-to-left',
					esc_html__( 'Appear from center', 'revija' ) => "appear",
					esc_html__( 'Fade', 'revija' ) => "fade"
				),
				'group' => esc_html__( 'Animations', 'revija' ),
				'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'revija' )
			);
			vc_add_param( 'layerslider_vc', $add_css_animation );
		}

		public function admin_init() {
			add_action('admin_enqueue_scripts', array(&$this, 'admin_extend_js_css'));
		}

		public function front_init() {
			$this->register_css();
			$this->front_js_register();
			$this->wp_print_styles();
			$this->front_extend_js_css();
		}

		public function admin_extend_js_css() {
			wp_enqueue_style(REVIJA_PREFIX_CONT . 'extend-admin', plugins_url('/revija-content-types/config-composer/assets/css/vc_st_extend_admin.css'), false, WPB_VC_VERSION);
			wp_enqueue_style(REVIJA_PREFIX_CONT . 'font-awesome', plugins_url('/revija-content-types/config-composer/assets/css/font-awesome.min.css'), false, WPB_VC_VERSION);
		}

		public function front_js_register() {
			wp_register_script(REVIJA_PREFIX_CONT . 'wpb_composer_front_js', plugins_url('/revija-content-types/config-composer/assets/js/js_composer_front.js'), array( 'jquery' ), WPB_VC_VERSION, true );
		}

		public function front_extend_js_css() {
			wp_enqueue_script(REVIJA_PREFIX_CONT . 'wpb_composer_front_js');
		}

		public function wp_print_styles() {
			wp_deregister_style('js_composer_front');
			wp_enqueue_style(REVIJA_PREFIX_CONT . 'css_composer_front');
		}

		public function register_css() {
			$front_css_file = plugins_url('/revija-content-types/config-composer/assets/css/css_composer_front.css');
			wp_register_style(REVIJA_PREFIX_CONT . 'css_composer_front', $front_css_file, array(REVIJA_PREFIX_CONT . 'style'), WPB_VC_VERSION, 'all');
		}

		public function autoremoveElements() {
			$elements = $this->removeElements;

			foreach ($elements as $element) {
				vc_remove_element($element);
			}
		}

		protected function autoloadLibraries($path) {
			foreach (glob($path. '*.php') as $file) {
				require_once($file);
			}
		}

		public function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		public function path($name, $file = '') {
			$path = $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
			return apply_filters('vc_path_filter', $path);
		}

		function fieldAttachedImages( $att_ids = array() ) {
			$output = '';

			foreach ( $att_ids as $th_id ) {
				$thumb_src = wp_get_attachment_image_src( $th_id, 'thumbnail' );
				if ( $thumb_src ) {
					$thumb_src = $thumb_src[0];
					$output .= '
							<li class="added">
								<img rel="' . $th_id . '" src="' . $thumb_src . '" />
								<input type="text" name=""/>
								<a href="#" class="icon-remove"></a>
							</li>';
				}
			}
			if ( $output != '' ) {
				return $output;
			}
		}

		public function param_icon_field($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$icons = array('none', 'adjust', 'adn', 'align-center', 'align-justify', 'align-left', 'align-right', 'ambulance', 'anchor', 'android', 'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'apple', 'archive', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-o-down', 'arrow-circle-o-left', 'arrow-circle-o-right', 'arrow-circle-o-up', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'arrows', 'arrows-alt', 'arrows-h', 'arrows-v', 'asterisk', 'backward', 'ban', 'bar-chart-o', 'barcode', 'bars', 'beer', 'bell', 'bell-o', 'bitbucket', 'bitbucket-square', 'bitcoin', 'bold', 'bolt', 'book', 'bookmark', 'bookmark-o', 'briefcase', 'btc', 'bug', 'building-o', 'bullhorn', 'bullseye', 'calendar', 'calendar-o', 'camera', 'camera-retro', 'caret-down', 'caret-left', 'caret-right', 'caret-square-o-down', 'caret-square-o-left', 'caret-square-o-right', 'caret-square-o-up', 'caret-up', 'certificate', 'chain', 'chain-broken', 'check', 'check-circle', 'check-circle-o', 'check-square', 'check-square-o', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-up', 'circle', 'circle-o', 'clipboard', 'clock-o', 'cloud', 'cloud-download', 'cloud-upload', 'cny', 'code', 'code-fork', 'coffee', 'cog', 'cogs', 'columns', 'comment', 'comment-o', 'comments', 'comments-o', 'compass', 'compress', 'copy', 'credit-card', 'crop', 'crosshairs', 'css3', 'cut', 'cutlery', 'dashboard', 'dedent', 'desktop', 'dollar', 'dot-circle-o', 'download', 'dribbble', 'dropbox', 'edit', 'eject', 'ellipsis-h', 'ellipsis-v', 'envelope', 'envelope-o', 'eraser', 'eur', 'euro', 'exchange', 'exclamation', 'exclamation-circle', 'exclamation-triangle', 'expand', 'external-link', 'external-link-square', 'eye', 'eye-slash', 'facebook', 'facebook-square', 'fast-backward', 'fast-forward', 'female', 'fighter-jet', 'file', 'file-o', 'file-text', 'file-text-o', 'files-o', 'film', 'filter', 'fire', 'fire-extinguisher', 'flag', 'flag-checkered', 'flag-o', 'flash', 'flask', 'flickr', 'floppy-o', 'folder', 'folder-o', 'folder-open', 'folder-open-o', 'font', 'forward', 'foursquare', 'frown-o', 'gamepad', 'gavel', 'gbp', 'gear', 'gears', 'gift', 'github', 'github-alt', 'github-square', 'gittip', 'glass', 'globe', 'google-plus', 'google-plus-square', 'group', 'h-square', 'hand-o-down', 'hand-o-left', 'hand-o-right', 'hand-o-up', 'hdd-o', 'headphones', 'heart', 'heart-o', 'home', 'hospital-o', 'html5', 'inbox', 'indent', 'info', 'info-circle', 'inr', 'instagram', 'italic', 'jpy', 'key', 'keyboard-o', 'krw', 'laptop', 'leaf', 'legal', 'lemon-o', 'level-down', 'level-up', 'lightbulb-o', 'link', 'linkedin', 'linkedin-square', 'linux', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'magic', 'magnet', 'mail-forward', 'mail-reply', 'mail-reply-all', 'male', 'map-marker', 'maxcdn', 'medkit', 'meh-o', 'microphone', 'microphone-slash', 'minus', 'minus-circle', 'minus-square', 'minus-square-o', 'mobile', 'mobile-phone', 'money', 'moon-o', 'music', 'none', 'outdent', 'pagelines', 'paperclip', 'paste', 'pause', 'pencil', 'pencil-square', 'pencil-square-o', 'phone', 'phone-square', 'picture-o', 'pinterest', 'pinterest-square', 'plane', 'play', 'play-circle', 'play-circle-o', 'plus', 'plus-circle', 'plus-square', 'plus-square-o', 'power-off', 'print', 'puzzle-piece', 'qrcode', 'question', 'question-circle', 'quote-left', 'quote-right', 'random', 'refresh', 'renren', 'repeat', 'reply', 'reply-all', 'retweet', 'rmb', 'road', 'rocket', 'rotate-left', 'rotate-right', 'rouble', 'rss', 'rmad-square', 'rub', 'ruble', 'rupee', 'save', 'scissors', 'search', 'search-minus', 'search-plus', 'share', 'share-square', 'share-square-o', 'shield', 'shopping-cart', 'sign-in', 'sign-out', 'signal', 'sitemap', 'skype', 'smile-o', 'sort', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-asc', 'sort-desc', 'sort-down', 'sort-numeric-asc', 'sort-numeric-desc', 'sort-up', 'spinner', 'square', 'square-o', 'stack-exchange', 'stack-overflow', 'star', 'star-half', 'star-half-empty', 'star-half-full', 'star-half-o', 'star-o', 'step-backward', 'step-forward', 'stethoscope', 'stop', 'strikethrough', 'subscript', 'suitcase', 'sun-o', 'superscript', 'table', 'tablet', 'tachometer', 'tag', 'tags', 'tasks', 'terminal', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'thumb-tack', 'thumbs-down', 'thumbs-o-down', 'thumbs-o-up', 'thumbs-up', 'ticket', 'times', 'times-circle', 'times-circle-o', 'tint', 'toggle-down', 'toggle-left', 'toggle-right', 'toggle-up', 'trash-o', 'trello', 'trophy', 'truck', 'try', 'tumblr', 'tumblr-square', 'turkish-lira', 'twitter', 'twitter-square', 'umbrella', 'underline', 'undo', 'unlink', 'unlock', 'unlock-alt', 'unsorted', 'upload', 'usd', 'user', 'user-md', 'users', 'video-camera', 'vimeo-square', 'vk', 'volume-down', 'volume-off', 'volume-up', 'warning', 'weibo', 'wheelchair', 'windows', 'won', 'wrench', 'xing', 'xing-square', 'youtube', 'youtube-play', 'youtube-square');

			ob_start(); ?>

			<input type="hidden" name="<?php echo esc_attr($param_name) ?>" class="wpb_vc_param_value <?php echo esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) ?> " value="<?php echo esc_attr($value) ?>" id="mad-trace" />
			<div class="mad-icon-preview"><i class="fa fa-<?php echo esc_attr($value) ?>"></i></div>
			<input class="mad-search" type="text" placeholder="Search icon" />
			<div id="mad-icon-dropdown">
				<ul class="mad-icon-list">

					<?php foreach ($icons as $icon): ?>
						<?php $selected = ($icon == $value) ? 'class="selected"' : ''; ?>
						<li <?php echo $selected ?> data-icon="<?php echo esc_attr($icon) ?>"><i class="mad-icon fa fa-<?php echo esc_attr($icon) ?>"></i></li>
					<?php endforeach; ?>

				</ul><!--/ .mad-icon-list-->
			</div><!--/ #mad-icon-dropdown-->

			<?php return ob_get_clean();
		}

		function param_hidden_field($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			ob_start(); ?>
				<input type="hidden" name="<?php echo esc_attr($param_name) ?>" class="wpb_vc_param_value <?php echo esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) ?> value="<?php echo esc_attr($value) ?>" />
			<?php
			return ob_get_clean();
		}

		function param_number_field($settings, $value) {
			ob_start(); ?>
			<div class="mad_number_block">
				<input id="<?php echo esc_attr($settings['param_name']) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-number <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) . '_field'  ?>" type="number" value="<?php echo esc_attr($value) ?>"/>
			</div><!--/ .mad_number_block-->
			<?php
			return ob_get_clean();
		}
		
		function param_woocommerce_term_categories($settings, $value) {

			$categories = get_terms($settings["term"]);

			ob_start(); 
			
			?>

			<input type="text" value="<?php echo esc_attr($value) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-input mad-custom-val <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) ?>" id="<?php echo esc_attr($settings['param_name']); ?>">

			<div class="mad-custom-wrapper">

				<ul class="mad-custom-vals">

					<?php $inserted_vals = explode(',', $value); ?>

					<?php foreach($categories as $val): ?>
						<?php if( in_array($val->slug, $inserted_vals) ): ?>
							<li data-val="<?php echo $val->slug ?>"><?php echo $val->name ?><button>×</button></li>
						<?php endif; ?>
					<?php endforeach; ?>

				</ul><!--/ .mad-custom-vals-->

				<ul class="mad-custom">

					<?php foreach($categories as $val): ?>
						<?php
							$selected = '';
							if ( in_array($val->slug, $inserted_vals) ) {
								$selected = ' class="selected"';
							}
						?>
						<li <?php echo $selected ?> data-val="<?php echo $val->slug ?>"><?php echo $val->name ?></li>
					<?php endforeach; ?>

				</ul><!--/ .mad-custom-->

			</div><!--/ .mad-custom-wrapper-->

			<?php
			return ob_get_clean();
		}

		
		function param_woocommerce_term_categories2($settings, $value) {

			
			$categories = get_terms($settings["term"]);
			ob_start(); 
			
			?>

			<input type="text" value="<?php echo esc_attr($value) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-input mad-custom-val2 <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) ?>" id="<?php echo esc_attr($settings['param_name']); ?>">

			<div class="mad-custom-wrapper">

				<ul class="mad-custom-vals2">

					<?php $inserted_vals = explode(',', $value); ?>

					<?php foreach($categories as $val): ?>
						<?php if( in_array($val->slug, $inserted_vals) ): ?>
							<li data-val="<?php echo $val->slug ?>"><?php echo $val->name ?><button>×</button></li>
						<?php endif; ?>
					<?php endforeach; ?>

				</ul><!--/ .mad-custom-vals-->

				<ul class="mad-custom2">

					<?php foreach($categories as $val): ?>
						<?php
							$selected = '';
							if ( in_array($val->slug, $inserted_vals) ) {
								$selected = ' class="selected"';
							}
						?>
						<li <?php echo $selected ?> data-val="<?php echo $val->slug ?>"><?php echo $val->name ?></li>
					<?php endforeach; ?>

				</ul><!--/ .mad-custom-->

			</div><!--/ .mad-custom-wrapper-->

			<?php
			return ob_get_clean();
		}
		
		
		function param_woocommerce_term_forum($settings, $value) {

			
			$posts = get_posts( array(
				'numberposts'     => 0,
				'offset'          => 0,
				'category'        => '',
				'orderby'         => 'post_date',
				'order'           => 'DESC',
				'include'         => '',
				'exclude'         => '',
				'meta_key'        => '',
				'meta_value'      => '',
				'post_type'       => 'forum',
				'post_mime_type'  => '', 
				'post_parent'     => '',
				'post_status'     => 'publish'
			) );
			
			
			ob_start(); 
			
			?>

			<input type="text" value="<?php echo esc_attr($value) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-input mad-custom-val2 <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) ?>" id="<?php echo esc_attr($settings['param_name']); ?>">

			<div class="mad-custom-wrapper">

				<ul class="mad-custom-vals2">

					<?php $inserted_vals = explode(',', $value); ?>

					<?php foreach($posts as $val): 
					
					?>
						<?php if( in_array($val->ID, $inserted_vals) ): ?>
							<li data-val="<?php echo $val->ID ?>"><?php echo $val->post_name ?><button>×</button></li>
						<?php endif; ?>
					<?php endforeach; ?>

				</ul><!--/ .mad-custom-vals-->

				<ul class="mad-custom2">

					<?php foreach($posts as $val): ?>
						<?php
							$selected = '';
							if ( in_array($val->ID, $inserted_vals) ) {
								$selected = ' class="selected"';
							}
						?>
						<li <?php echo $selected ?> data-val="<?php echo $val->ID ?>"><?php echo $val->post_name ?></li>
					<?php endforeach; ?>

				</ul><!--/ .mad-custom-->

			</div><!--/ .mad-custom-wrapper-->

			<?php
			wp_reset_postdata();
			
			return ob_get_clean();
		}
		
		
		
		
		public static function array_number($from = 0, $to = 50, $step = 1, $array = array()) {
			for ($i = $from; $i <= $to; $i += $step) {
				$array[$i] = $i;
			}
			return $array;
		}

		public static function get_order_sort_array() {
			return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
				'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
				'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
				'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent', 'meta_value_num' => 'meta_value_num',
				'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
		}

		public static function count_posts($type_post) {
			if (!isset($type_post)) {
				$type_post = 'post';
			}
			$count_posts = wp_count_posts($type_post);
			$published_posts = $count_posts->publish;
			return $published_posts;
		}

		public function mad_font_container_get_allowed_tags($allowed_tags) {
			array_unshift($allowed_tags, 'h1');
			return $allowed_tags;
		}

		public function wpb_content_types() {
			$wpb_content_types = array( 'post', 'page', 'portfolio', 'product' );
			update_option('wpb_js_content_types', $wpb_content_types);
		}

		public static function getCSSAnimation($css_animation) {
			$output = '';
			if ( $css_animation != '' ) {
				wp_enqueue_script('waypoints');
				$output = ' animate-' . $css_animation;
			}
			return $output;
		}
		

	}

	new REVIJA_VC_CONFIG();
}