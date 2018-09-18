<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
global $product;

if ( !$product->is_in_stock() ) {
	$label  = apply_filters( 'out_of_stock_add_to_cart_text', esc_html__( 'Out of stock', 'woocommerce' ) ); 

	$img = REVIJA_BASE_URI .'images/sold_out_ribbon.png';  ?>
	
	<?php printf( '<div class="ribbon"><img src="%s" alt="" title="%s"></div>', $img, $label ); ?>

	<?php
}