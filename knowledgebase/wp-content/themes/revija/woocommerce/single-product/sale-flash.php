<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="ribbon"><img src="'. REVIJA_BASE_URI .'images/sale_ribbon.png" alt=""></div>', $post, $product ); ?>

<?php endif; ?>

<?php if ( $product->is_featured() ) : ?>

	<?php echo apply_filters( 'woocommerce_featured_flash', '<div class="ribbon onfeatured"><img src="'. REVIJA_BASE_URI .'images/new_ribbon.png" alt=""></div>', $post, $product ); ?>

<?php endif; ?>