<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>

	<div class="product_thumbnails_wrap relative m_bottom_3">

		<div class="product_carousel" id="thumbnails">

			<?php

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first active';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_src = wp_get_attachment_image_src( $attachment_id, 'shop_single');
				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;

				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="javascript:void(0);" data-image="%s" data-zoom-image="%s" class="%s" title="%s">%s</a>', $image_src[0], $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

				$loop++;
			}

			?>

		</div><!--/ .product_carousel-->

	</div><!--/ .product_thumbnails_wrap-->

<?php
}