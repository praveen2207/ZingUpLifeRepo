<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
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

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container comment clearfix">

		<div><div>
		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '80' ), '', get_comment_author() ); ?>
		</div></div>
		
		<div class="comment-text">

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<p class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
			<?php else : ?>

				<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

					<div class="star-rating">
						<?php woocommerce_template_loop_rating(); ?>
					</div>

				<?php endif; ?>
			
				<div class="clearfix meta">
				  <a href="#"><h5 class="f_left"><?php comment_author(); ?></h5></a>
				  <?php
						if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) {
							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) {
								echo '<em class="verified">(' . esc_html__( 'verified owner', 'woocommerce' ) . ')</em> ';
							}
						}
					?>
				  <div class="event_date f_right"><?php echo get_comment_date('l, j F Y'); ?></div>
				</div>

			<?php endif; ?>

			
			<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
			<div itemprop="description" class="description"><?php comment_text(); ?></div>
			<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
			
			
		</div>
	</div>
