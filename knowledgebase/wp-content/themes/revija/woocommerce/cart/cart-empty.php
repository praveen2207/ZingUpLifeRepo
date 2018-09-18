<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>
<div class="alert alert-success">

<a class="button button_type_icon_small button_orange wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'Return To Shop', 'woocommerce' ) ?><i class="fa fa-shopping-cart"></i></a>

<?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ) ?>


</div>


<?php do_action( 'woocommerce_cart_is_empty' ); ?>
