<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	global $woocommerce_loop, $revija_config;

	$woocommerce_loop['columns'] = $revija_config['shop_overview_column_count'];

	$view = $woocommerce_loop['view'] = isset( $_COOKIE[ 'mad_shop_view' ] ) ? $_COOKIE[ 'mad_shop_view' ] : mad_custom_get_option('shop-view');

	if (empty($view)) {
		$view = 'view-grid-center';
	}

	if (is_single()) { $view = ''; }

?>

<div class="products-container shop-columns-<?php echo esc_attr($woocommerce_loop['columns']) ?> <?php echo esc_attr($view) ?>">