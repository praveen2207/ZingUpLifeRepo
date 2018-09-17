<?php

if (!class_exists('REVIJA_HELPER')) {

	class REVIJA_HELPER {

		/*	Get Registered Sidebars
		/* ---------------------------------------------------------------------- */

		public static function get_registered_sidebars($sidebars = array(), $exclude = array()) {
			global $wp_registered_sidebars;

			foreach ($wp_registered_sidebars as $sidebar) {
				if (!in_array($sidebar['name'], $exclude)) {
					$sidebars[$sidebar['name']] = $sidebar['name'];
				}
			}
			return $sidebars;
		}

		/*	Check page layout
		/* ---------------------------------------------------------------------- */

		public static function check_page_layout ($post_id = false) {
			global $revija_config;

			$result = false;
			$sidebar_position = 'sidebar_archive_position';

			if (empty($post_id)) $post_id = mad_post_id();

			if (is_page() || is_search() || is_attachment()) {
				$sidebar_position = 'sidebar_page_position';
			}
			if (is_archive()) {
				$sidebar_position = 'sidebar_archive_position';
			}
			if (is_single()) {
				$sidebar_position = 'sidebar_post_position';
			}
			if (is_singular()) {
				$result = rwmb_meta('mad_page_sidebar_position', '', $post_id);
			}
			if (is_404()) {
				$result = 'no_sidebar';
			}

			if (is_post_type_archive('portfolio')) {
				$result = mad_custom_get_option('sidebar_portfolio_archive_position');
			}
			if (is_post_type_archive('testimonials')) {
				$result = mad_custom_get_option('sidebar_testimonials_archive_position');
			}
			if (is_post_type_archive('team-members')) {
				$result = mad_custom_get_option('sidebar_team_members_archive_position');
			}
			if (is_post_type_archive('product')) {
				$result = mad_custom_get_option('sidebar_product_archive_position');
			}

			if (!$result) {
				$result = mad_custom_get_option($sidebar_position);
			}

			if (!$result) {
				$result = 'sbr';
			}

			if ($result) {
				$revija_config['sidebar_position'] = $result;
			}
		}

		public static function template_layout_class($key, $echo = false) {
			global $revija_config;

			if (!isset($revija_config['sidebar_position'])) { self::check_page_layout(); }

			$return = $revija_config[$key];

			if ($echo == true) {
				echo $return;
			} else {
				return $return;
			}
		}

		/*	Header type layout
		/* ---------------------------------------------------------------------- */

		public static function header_layout () {
			$post_id = mad_post_id();

			@$header_layout = rwmb_meta('mad_header_layout', '', $post_id);
			if (empty($header_layout)) {
				$header_layout = mad_custom_get_option('header_layout');
			}
			return $header_layout;
		}

		/*	Page type layout
		/* ---------------------------------------------------------------------- */

		public static function page_layout () {
			$post_id = mad_post_id();

			@$page_layout = rwmb_meta('mad_page_layout', '', $post_id);
			if (empty($page_layout)) {
				$page_layout = mad_custom_get_option('page_layout');
			}
			if (is_post_type_archive('portfolio')) {
				$page_layout = mad_custom_get_option('portfolio_archive_page_layout');
			}
			if (is_post_type_archive('testimonials')) {
				$page_layout = mad_custom_get_option('testimonials_archive_page_layout');
			}
			if (is_post_type_archive('team-members')) {
				$page_layout = mad_custom_get_option('team_members_archive_page_layout');
			}
			if (is_post_type_archive('product')) {
				$page_layout = mad_custom_get_option('product_archive_page_layout');
			}

			return $page_layout;
		}

		/*  Main Navigation
		/* ---------------------------------------------------------------------- */

		public static function main_navigation($menu = 'Primary Menu', $menu_class = 'menu', $theme_location = 'primary') {

			$defaults = array(
				'menu' => $menu,
				'container' => '',
				'menu_class' => $menu_class,
				'theme_location' => $theme_location
			);
			
			
			
			$nav_menu = rwmb_meta('mad_nav_menu', '', mad_post_id());
			if (!empty($nav_menu) && is_numeric($nav_menu)) {
				$defaults['menu'] = $nav_menu;
			}


			if (has_nav_menu($theme_location)) {
				wp_nav_menu( $defaults );
			} else {
				echo '<ul>';
				wp_list_pages('title_li=');
				echo '</ul>';
			}
			echo '<div class="clear"></div>';
		}

		public static function output_html($view, $data = array()) {
			$path = 'widgets/';
			@extract($data);
			ob_start();
			include(REVIJA_INCLUDES_PATH . $path . $view . '.php');
			return ob_get_clean();
		}

		public static function create_atts_string ($data = array()) {
			$atts_string = "";

			foreach ($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$atts_string .= " $key='$value' ";
			}
			return $atts_string;
		}

		public static function get_post_attachment_image($attachment_id, $dimensions, $crop = true) {
			$img_src = wp_get_attachment_image_src($attachment_id, $dimensions);
			$img_src = $img_src[0];
			return self::get_image($img_src, $dimensions, $crop);
		}

		public static function get_post_featured_image($post_id, $dimensions, $crop = true) {
			$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
			$img_src = $img_src[0];
			return self::get_image($img_src, $dimensions, $crop);
		}

		public static function get_image($img_src, $dimensions, $crop = true) {
			if (empty($dimensions)) return $img_src;

			$sizes = explode('*', $dimensions);
			$img_src = aq_resize($img_src, $sizes[0], $sizes[1], $crop);

			if (!$img_src) {
				return 'http://dummyimage.com/' . $sizes[0] . 'x' . $sizes[1];
			}
			return $img_src;
		}

		public static function get_the_post_thumbnail ($post_id, $dimensions, $thumbnail_atts = array()) {
			return '<img src="' . self::get_post_featured_image($post_id, $dimensions, true) . '" ' . self::create_atts_string($thumbnail_atts) . ' />';
		}

		public static function get_the_thumbnail ($attach_id, $dimensions, $thumbnail_atts = array()) {
			return '<img src="' . self::get_post_attachment_image($attach_id, $dimensions) . '" ' . self::create_atts_string($thumbnail_atts) . ' />';
		}

	}

}

/*	Blog alias
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_blog_alias')) {

	function mad_blog_alias ($format = 'standard', $image_size = array(), $blog_style = '') {
		global $revija_config;
		$sidebar_position = $revija_config['sidebar_position'];

		if (is_array($image_size) && !empty($image_size)) {
			$alias = $format == 'audio' || $format == 'video' ? $image_size[1] : $image_size[0];
			return $alias;
		}

		if (is_single() || $blog_style == 'blog-style-1') {
			switch ($format) {
				case 'standard':
				case 'gallery':
					if ($sidebar_position == 'no_sidebar') {
						$alias = '1140*495';
					} else {
						$alias = '750*374';
					}
					break;
				case 'audio':
				case 'video':
					if ($sidebar_position == 'no_sidebar') {
						$alias = array(1140, 495);
					} else {
						$alias = array(750, 374);
					}
					break;
				default: $alias = '750*374'; break;
			}
			return $alias;
		} else {
			switch ($format) {
				case 'standard':
				case 'gallery': $alias = '554*374'; break;
				case 'audio':
				case 'video':   $alias = array(554, 374); break;
				default:    $alias = '554*374'; break;
			}
			return $alias;
		}

	}
}






/*	Portfolio alias
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_portfolio_alias')) {

	function mad_portfolio_alias ($format = 'standard', $image_size = array(), $blog_style = '') {
		global $revija_config;
		$sidebar_position = $revija_config['sidebar_position'];

		if (is_array($image_size) && !empty($image_size)) {
			$alias = $format == 'audio' || $format == 'video' ? $image_size[1] : $image_size[0];
			return $alias;
		}

		if (is_single() || $blog_style == 1) {
			switch ($format) {
				case 'standard':
				case 'gallery':
					if ($sidebar_position == 'no_sidebar') {
						$alias = '1140*495';
					} else {
						$alias = '750*374';
					}
					break;
				case 'audio':
				case 'video':
					if ($sidebar_position == 'no_sidebar') {
						$alias = array(1140, 495);
					} else {
						$alias = array(750, 374);
					}
					break;
				default: $alias = '750*374'; break;
			}
			return $alias;
		} else {
			switch ($format) {
				case 'standard':
				case 'gallery': $alias = '554*374'; break;
				case 'audio':
				case 'video':   $alias = array(554, 374); break;
				default:    $alias = '554*374'; break;
			}
			return $alias;
		}

	}
}





/*	Debug function print_r
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_print_r')) {
	function mad_print_r( $arr ) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}


/* 	Corenavi
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_corenavi')) {

	function mad_corenavi($pages = "", $a = array()) {
		global $wp_query;

		$total = 1;

		if ($pages == '') {
			$max = $wp_query->max_num_pages;
		} else {
			$max = $pages;
		}

		if (!$current = get_query_var('paged')) {
			$current = 1;
		}

		$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
		$a['total'] = $max;
		$a['type'] = 'list';
		$a['current'] = $current;
		$a['mid_size'] = 3;
		$a['add_args'] = false;
		$a['end_size'] = 1;
		$a['prev_text'] = '<i class="fa fa-angle-left"></i>';
		$a['next_text'] = '<i class="fa fa-angle-right"></i>';

		ob_start(); ?>

		<?php if ($max > 1): ?>

			<div class="pagination_block">

				<?php if ($total == 1 && $max > 1): ?>
				<span><?php printf(esc_html__("Page %d of %d", "revija"), $current, $max) ?></span>
				<?php endif; ?>
				
				<?php echo paginate_links($a); ?>

			</div><!--/ .pagination-holder-->

		<?php endif;

		return ob_get_clean();
	}

}
