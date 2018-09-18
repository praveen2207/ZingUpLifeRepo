<?php

/**
 * Search Loop - Single Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<tr><td><div class="clearfix">


<div id="post-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<div class="bbp-topic-author  topic_author">

		<?php do_action( 'bbp_theme_before_topic_author_details' ); ?>

		<?php bbp_topic_author_link( array( 'sep' => '', 'show_role' => true, 'type' => 'avatar' ) ); ?>

		<?php if ( bbp_is_user_keymaster() ) : ?>

			<?php do_action( 'bbp_theme_before_topic_author_admin_details' ); ?>

			<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_topic_id() ); ?></div>

			<?php do_action( 'bbp_theme_after_topic_author_admin_details' ); ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_after_topic_author_details' ); ?>

	</div><!-- .bbp-topic-author -->

	<div class="bbp-topic-content wrapper">

		<div class="clearfix topic_text">
		  <div class="f_left">
			<?php bbp_topic_author_link( array( 'sep' => '', 'show_role' => false, 'type' => 'name' ) ); ?>
			<span class="event_date"><span>on </span> <?php bbp_topic_post_date( bbp_get_topic_id() ); ?></span>
		  </div>
		  <div class="f_right">
			<a href="<?php bbp_topic_permalink(); ?>" class="number bbp-topic-permalink">#<?php bbp_topic_id(); ?></a>
		  </div>
		</div>
	
	
	
	
	
		<?php do_action( 'bbp_theme_before_topic_content' ); ?>

		<?php bbp_topic_content(); ?>

		<?php do_action( 'bbp_theme_after_topic_content' ); ?>

	</div><!-- .bbp-topic-content -->

</div><!-- #post-<?php bbp_topic_id(); ?> -->

</div></td></tr>