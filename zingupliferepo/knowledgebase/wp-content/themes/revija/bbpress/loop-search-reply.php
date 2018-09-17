<?php

/**
 * Search Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<tr><td><div class="clearfix">

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author   topic_author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'sep' => '', 'show_role' => true, 'type' => 'avatar' ) ); ?>

		<?php if ( bbp_is_user_keymaster() ) : ?>

			<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

			<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

			<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content wrapper">

		<div class="clearfix topic_text">
		  <div class="f_left">
			<?php bbp_reply_author_link( array( 'sep' => '', 'show_role' => false, 'type' => 'name' ) ); ?>
			<span class="event_date"><span>on </span> <?php bbp_reply_post_date(); ?></span>
		  </div>
		  <div class="f_right">
			<a href="<?php bbp_reply_url(); ?>" class="number bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>
		  </div>
		</div>
	
	
	
		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->

</div><!-- #post-<?php bbp_reply_id(); ?> -->

</div></td></tr>