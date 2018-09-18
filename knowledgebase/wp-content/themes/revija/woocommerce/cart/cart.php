<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<div class="section">
              <h2 class="section_title section_title_big"><?php esc_html_e( 'Shopping cart', 'woocommerce' ); ?></h2>
</div>		  
			  
<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart table_type_1 var5 responsive_table" cellspacing="0">

	<thead>
		<tr>
			<th><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
			<th><?php esc_html_e( 'SKU', 'woocommerce' ); ?></th>
			<th><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			<th><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
			<th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<th></th>
		</tr>
	</thead>

	<tbody>

		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-thumbnail" data-title="<?php esc_html_e( 'Product Image & Name', 'woocommerce' ); ?>">
						<?php

						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array('50', '50')), $cart_item, $cart_item_key );

						if ( ! $_product->is_visible() ) {
							echo '<div class="thumbnail">';
								echo $thumbnail;
							echo '</div>';
						} else {
							echo '<div class="thumbnail">';
								printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
							echo '</div>';
						}
						?>

						<?php
						if ( ! $_product->is_visible() ) {
							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						} else {
							echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="product-name" href="%s"><h5>%s</h5></a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
						}

						// Meta data
						echo WC()->cart->get_item_data( $cart_item );

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
							echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'revija' ) . '</p>';
						?>

					</td>

					<td class="product-sku" data-title="<?php esc_html_e( 'SKU', 'woocommerce' ); ?>">
						<?php echo ($sku = $_product->get_sku()) ? $sku : esc_html__('N/A', 'revija'); ?>
					</td>

					<td class="product-price" data-title="<?php esc_html_e( 'Price', 'woocommerce' ); ?>">
						<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
					</td>

					<td class="product-quantity" data-title="<?php esc_html_e( 'Quantity', 'woocommerce' ); ?>">

						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'  => "cart[{$cart_item_key}][qty]",
								'input_value' => $cart_item['quantity'],
								'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								'min_value'   => '0'
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>

						
					</td>

					<td class="product-subtotal" data-title="<?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>">
						<b><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></b>
					</td>
					
					
					 <td>
					 <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove close_product" title="%s"><i class="fa fa-times-circle"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove', 'revija' ) ), $cart_item_key ); ?>
					 </td>

				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );

		?>
		<tr>
			<td colspan="6" class="actions">
			 <table>
			 <tbody>
			 <tr>
			    <td>
					<?php if ( WC()->cart->coupons_enabled() ) { ?>
						<div class="coupon">

							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'woocommerce' ); ?>" /> 
							<input type="submit" class="coupon-button button button_grey" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'woocommerce' ); ?>" />

							<?php do_action('woocommerce_cart_coupon'); ?>

						</div>
					<?php } ?>
				</td>
				
				<td>
				
					<input type="submit" class="update-button button button_grey" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'woocommerce' ); ?>" />
					<input type="submit" class="checkout-button button alt wc-forward button_orange" name="proceed" value="<?php esc_html_e( 'Proceed to Checkout', 'woocommerce' ); ?>" />

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				<td>
				
			 </tr>
			 </tbody>
			 </table>	
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
    <div class="row">
	
	<?php if ( is_cart() ) { ?>
	    <div class="col-lg-6 col-md-6 col-sm-6">
			<div class="section">
			<?php do_action( 'woocommerce_cart_collaterals' ); ?>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="section">
		<?php woocommerce_shipping_calculator(); ?>
			</div>
		</div>
		
	<?php } else { ?>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="section">
		<?php do_action( 'woocommerce_cart_collaterals' ); ?>
			</div>
		</div>
	<?php }  ?>
	
	</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
