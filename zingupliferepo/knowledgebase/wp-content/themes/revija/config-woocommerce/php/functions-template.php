<?php

/* ---------------------------------------------------------------------- */
/*	Template: Woocommerce
/* ---------------------------------------------------------------------- */

if ( ! function_exists( 'mad_wc_get_template' ) ) {
	function mad_wc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( function_exists( 'wc_get_template' ) ) {
			wc_get_template( $template_name, $args, $template_path, $default_path );
		} else {
			woocommerce_get_template( $template_name, $args, $template_path, $default_path );
		}
	}
}

if ( ! function_exists( 'mad_woocommerce_product_custom_tab' ) ) {
	function mad_woocommerce_product_custom_tab() {
		mad_wc_get_template( 'single-product/tabs/custom-tab.php' );
	}
}

if (!function_exists('mad_woocommerce_show_product_loop_out_of_sale_flash')) {
	function mad_woocommerce_show_product_loop_out_of_sale_flash() {
		mad_wc_get_template( 'loop/out-of-stock-flash.php' );
	}
}

if (!function_exists('mad_woocommerce_shop_link_products')) {
	function mad_woocommerce_shop_link_products() {
		mad_wc_get_template( 'single-product/link-products.php' );
	}
}

if (!function_exists('mad_overwrite_catalog_ordering')) {
	function mad_overwrite_catalog_ordering($args) {
		global $revija_config;

		$product_sort = $product_count = '';
		$keys = array('product_count', 'product_sort', 'product_order');
		if (empty($revija_config['woocommerce'])) $revija_config['woocommerce'] = array();

		foreach ($keys as $key) {
			if (isset($_GET[$key]) ) {
				$_SESSION['mad_woocommerce'][$key] = esc_attr($_GET[$key]);
			}
			if (isset($_SESSION['mad_woocommerce'][$key]) ) {
				$revija_config['woocommerce'][$key] = $_SESSION['mad_woocommerce'][$key];
			}
		}

		extract($revija_config['woocommerce']);

		if (!empty($product_count)) {
			$revija_config['shop_overview_product_count'] = (int) $product_count;
		}

		if (!empty($product_sort)) {
			switch ( $product_sort ) {
				case 'desc' : $order = 'desc'; break;
				case 'asc' : $order = 'asc'; break;
				default : $order = 'asc'; break;
			}
		}

		if ( isset($order) ) $args['order'] = $order;

		$revija_config['woocommerce']['product_sort'] = $args['order'];

		return $args;
	}
	add_action( 'woocommerce_get_catalog_ordering_args', 'mad_overwrite_catalog_ordering');
}


if (!function_exists('mad_woocommerce_output_product_data_tabs')) {
	function mad_woocommerce_output_product_data_tabs() {
		echo '<div class="clearfix"></div>';
		woocommerce_output_product_data_tabs();
	}
}

if (!function_exists('mad_woocommerce_output_related_products')) {
	function mad_woocommerce_output_related_products() {
		global $revija_config;

		$revija_config['shop_single_column'] = ($revija_config['sidebar_position'] != 'no_sidebar') ? 3 : 4; // columns for related products
		$revija_config['shop_single_column_items'] = mad_custom_get_option('shop_single_column_items'); // number of items for related products

		ob_start();

		woocommerce_related_products(
			array(
				'columns' => $revija_config['shop_single_column'],
				'posts_per_page' => $revija_config['shop_single_column_items']
			)
		);

		$content = ob_get_clean(); ?>

		<?php if ($content): ?>

			<div class="products-container view-grid" data-columns="<?php echo esc_attr($revija_config['shop_single_column']) ?>">
				<?php echo $content; ?>
			</div><!--/ .products-container-->

		<?php endif;
	}
}