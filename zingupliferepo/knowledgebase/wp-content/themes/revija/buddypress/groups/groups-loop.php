<?php

/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of groups from the groups loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_groups_loop' ); ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	
	<?php

	/**
	 * Fires before the listing of the groups list.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_directory_groups_list' ); ?>

	<ul class="groups-list item-list activity_list">

	<?php while ( bp_groups() ) : bp_the_group(); ?>

		<li <?php bp_group_class(); ?>>
			<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
				<div class="item-avatar post_photo">
					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=80&height=80' ); ?></a>
				</div>
			<?php endif; ?>

			<div class="item post_text">
				<div class="clearfix">
				  <a href="<?php bp_group_permalink(); ?>" class="f_left"><h5><?php bp_group_name(); ?></h5></a> 
				  <span class="f_right event_activity var2"><?php bp_group_type(); ?> / <?php bp_group_member_count(); ?></span>
				</div>
			
				<div class="item-meta event_activity"><?php printf( esc_html__( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></div>

				<div class="item-desc"><?php bp_group_description_excerpt(); ?></div>

				<?php

				/**
				 * Fires inside the listing of an individual group listing item.
				 *
				 * @since BuddyPress (1.1.0)
				 */
				do_action( 'bp_directory_groups_item' ); ?>

			</div>

			<div class="action">

				<?php

				/**
				 * Fires inside the action section of an individual group listing item.
				 *
				 * @since BuddyPress (1.1.0)
				 */
				do_action( 'bp_directory_groups_actions' ); ?>

			</div>

			<div class="clearfix"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php

	/**
	 * Fires after the listing of the groups list.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_after_directory_groups_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="group-dir-count-bottom">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-bottom">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of groups from the groups loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_groups_loop' ); ?>
