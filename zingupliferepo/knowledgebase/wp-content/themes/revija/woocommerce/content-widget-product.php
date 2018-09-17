<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<div class="entry-thumb-image">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_image(array(100, 100)); ?>
		</a>
	</div>
	<div class="entry-post-holder product_description">
		
		<a class="second_font" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo esc_html($product->get_title()); ?>
		</a>
		
		<div class="price">
		<?php echo $product->get_price_html(); ?>
		</div>
		
		<?php if ( ! empty( $show_rating ) ) {
			$num_rating = (int) $product->get_average_rating();			
			echo '<div class="rating-box"><div class="rating readonly-rating" data-score="'. $num_rating .'"></div></div>'; 
		} ?>
		
		
	</div>
	<div class="clear"></div>
</li>