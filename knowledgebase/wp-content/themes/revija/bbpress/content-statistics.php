<?php

/**
 * Statistics Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Get the statistics
$stats = bbp_get_statistics(); ?>



	<?php do_action( 'bbp_before_statistics' ); ?>

	<div class="widget widget_categories_statistics categories_var2">
	<ul class="categories_list">
	  <li>
		<ul>
	
	
	
	<li><?php esc_html_e( 'Registered Users', 'bbpress' ); ?><span><?php echo esc_html( $stats['user_count'] ); ?></span></li>
	<li><?php esc_html_e( 'Forums', 'bbpress' ); ?><span><?php echo esc_html( $stats['forum_count'] ); ?></span></li>
	<li><?php esc_html_e( 'Topics', 'bbpress' ); ?><span><?php echo esc_html( $stats['topic_count'] ); ?></span></li>
	<li><?php esc_html_e( 'Replies', 'bbpress' ); ?><span><?php echo esc_html( $stats['reply_count'] ); ?></span></li>
	<li><?php esc_html_e( 'Topic Tags', 'bbpress' ); ?><span><?php echo esc_html( $stats['topic_tag_count'] ); ?></span></li>
	
	<?php if ( !empty( $stats['empty_topic_tag_count'] ) ) : ?>
	<li><?php esc_html_e( 'Empty Topic Tags', 'bbpress' ); ?><span><?php echo esc_html( $stats['empty_topic_tag_count'] ); ?></span></li>
	<?php endif; ?>

	<?php if ( !empty( $stats['topic_count_hidden'] ) ) : ?>
		<li><?php esc_html_e( 'Hidden Topics', 'bbpress' ); ?><span><?php echo esc_html( $stats['topic_count_hidden'] ); ?></span></li>
	<?php endif; ?>

	<?php if ( !empty( $stats['reply_count_hidden'] ) ) : ?>
		<li><?php esc_html_e( 'Hidden Replies', 'bbpress' ); ?><span><?php echo esc_html( $stats['reply_count_hidden'] ); ?></span></li>
	<?php endif; ?>

	
		</ul>
	  </li>
	</ul>
    </div>
	
	
	
	
	
	
	<?php do_action( 'bbp_after_statistics' ); ?>



<?php unset( $stats );