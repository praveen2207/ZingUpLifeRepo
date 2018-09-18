<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<tr><td><div class="clearfix">

<div class="bbp-forum-header">

	<div class="bbp-meta clearfix topic_text">
		<div class="f_left">
		<?php printf( esc_html__( 'Last updated %s', 'bbpress' ), bbp_get_forum_last_active_time() ); ?>
		</div>
		
		<div class="f_right">
		<a href="<?php bbp_forum_permalink(); ?>" class="bbp-forum-permalink">#<?php bbp_forum_id(); ?></a>
		</div>
		
	</div><!-- .bbp-meta -->

	<div class="bbp-forum-title">

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<a href="<?php bbp_forum_permalink(); ?>"><h5><?php esc_html_e( 'Forum: ', 'bbpress' ); ?><?php bbp_forum_title(); ?></h5></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

	</div><!-- .bbp-forum-title -->

</div><!-- .bbp-forum-header -->

<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<div class="bbp-forum-content">

		<?php do_action( 'bbp_theme_before_forum_content' ); ?>

		<?php bbp_forum_content(); ?>

		<?php do_action( 'bbp_theme_after_forum_content' ); ?>

	</div><!-- .bbp-forum-content -->

</div><!-- #post-<?php bbp_forum_id(); ?> -->


</div></td></tr>
