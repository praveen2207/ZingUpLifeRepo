<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<li class="bbp-forum-info">

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><h5><?php bbp_forum_title(); ?></h5></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php do_action( 'bbp_theme_before_forum_description' ); ?>

		<div class="bbp-forum-content"><?php bbp_forum_content(); ?></div>

		<?php do_action( 'bbp_theme_after_forum_description' ); ?>

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>

	</li>

	<li class="bbp-forum-topic-count"><div><?php bbp_forum_topic_count(); ?> <?php esc_html_e( 'topics', 'bbpress' ); ?></div><div><?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?> <?php esc_html_e( 'posts', 'bbpress' ); ?></div></li>

	

	<li class="bbp-forum-freshness">
		<div class="clearfix">
		
		<figure>
            <?php do_action( 'bbp_theme_before_topic_author' ); ?>

			<?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 50, 'type' => 'avatar' ) ); ?>

			<?php do_action( 'bbp_theme_after_topic_author' ); ?>
        </figure>
		
		<p>
			<?php esc_html_e( 'by', 'bbpress' ); ?> <?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'type' => 'name' ) ); ?>
		</p>
		
		<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>

		<?php bbp_forum_freshness_link(); ?>

		<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>

		
		
		</div>
	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
