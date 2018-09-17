<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>


	<?php if ( ! WC()->cart->is_empty() ) : ?>
<div class="sc_header"><?php esc_html_e( 'Recently added item(s)', 'woocommerce' ); ?></div>
<div class="products_list">

<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array(60, 60)), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
					<li>
					<div>
						<?php if ( ! $_product->is_visible() ) { ?>
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
						<?php } else { ?>
							<a href="<?php echo get_permalink( $product_id ); ?>">
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							</a>
						<?php } ?>

						<div class="product_description">
							<a href="<?php echo get_permalink( $product_id ); ?>"><?php echo esc_html($product_name) ?></a>
							<div class="sku">
							<?php esc_html_e("Product SKU: ", 'woocommerce') ?><?php echo ($sku = $_product->get_sku()) ? $sku : esc_html__('N/A', 'revija'); ?>
							</div>

							<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<div class="product_price">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</div>', $cart_item, $cart_item_key ); ?>
						</div>

						
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove close_product" title="%s"><i class="fa fa-times-circle"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'woocommerce' ), $cart_item_key ));
						?>
						
					</div>	
					</li>
					<?php
				}
			}
		?>

		
</ul><!-- end product list -->

</div>	
		
	<?php else : ?>
	
		<div class="sc_header"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></div>

	<?php endif; ?>





<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

<!--total price-->
<div class="total_price">
					
	<ul class="total">
		<li>
			<span><?php esc_html_e( 'Tax', 'woocommerce') ?>:</span><?php wc_cart_totals_taxes_total_html() ?>
		</li>
		<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
			<li class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
				<span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
				<?php wc_cart_totals_coupon_html( $coupon ); ?>
			</li>
		<?php endforeach; ?>
		<li>
			<span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</span><?php echo WC()->cart->get_cart_subtotal(); ?>
		</li>
	</ul><!--/ .total-->
</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
<div class="sc_footer">
	<footer class="buttons">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button view-cart wc-forward button_grey full_width"><?php esc_html_e( 'View Cart', 'woocommerce' ); ?></a>
		<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout wc-forward button_orange full_width"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
	</footer>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
