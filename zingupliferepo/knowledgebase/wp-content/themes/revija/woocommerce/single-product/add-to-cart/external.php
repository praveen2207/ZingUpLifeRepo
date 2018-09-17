<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<p class="cart">
	<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button button_type_icon_medium button_orange alt"><?php echo $button_text; ?></a>
</p>

<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

<?php

		$cat_count = sizeof( get_the_terms( $product->id , 'product_cat' ) );
		$tag_count = sizeof( get_the_terms( $product->id , 'product_tag' ) );
			
			if ($cat_count || $tag_count): ?>

				<p class="category">
					<?php echo $product->get_categories( ', ', '<span class="posted_in clearfix">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
					<?php echo $product->get_tags( ', ', '<span class="tagged_as clearfix">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
				</p>

			<?php endif; ?>