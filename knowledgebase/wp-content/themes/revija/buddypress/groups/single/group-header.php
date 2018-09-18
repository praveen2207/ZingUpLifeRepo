<?php

/**
 * Fires before the display of a group's header.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_group_header' );

?>

<div id="item-actions">

	<?php if ( bp_group_is_visible() ) : ?>

		<h5><?php esc_html_e( 'Group Admins' , 'buddypress' ); ?></h5>
		
		<?php bp_group_list_admins();

		
		
		/**
		 * Fires after the display of the group's administrators.
		 *
		 * @since BuddyPress (1.1.0)
		 */
		do_action( 'bp_after_group_menu_admins' );

		if ( bp_group_has_moderators() ) :

			/**
			 * Fires before the display of the group's moderators, if there are any.
			 *
			 * @since BuddyPress (1.1.0)
			 */
			do_action( 'bp_before_group_menu_mods' ); ?>

			<h3><?php esc_html_e( 'Group Mods' , 'buddypress' ); ?></h3>

			<?php bp_group_list_mods();

			/**
			 * Fires after the display of the group's moderators, if there are any.
			 *
			 * @since BuddyPress (1.1.0)
			 */
			do_action( 'bp_after_group_menu_mods' );

		endif;

	endif; ?>

</div><!-- #item-actions -->

<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
	<div id="item-header-avatar" class="f_left" >
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

			<?php bp_group_avatar('width=165&height=165'); ?>

		</a>
	</div><!-- #item-header-avatar -->
<?php endif; ?>

<div id="item-header-content" class="post_text">
	<h5><?php bp_group_type(); ?></h5>
	<div class="event_activity"><span class="activity"><?php printf( esc_html__( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span></div>

	<?php

	/**
	 * Fires before the display of the group's header meta.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_before_group_header_meta' ); ?>

	<div id="item-meta">

		<?php bp_group_description(); ?>

		<div id="item-buttons">

			<?php

			/**
			 * Fires in the group header actions section.
			 *
			 * @since BuddyPress (1.2.6)
			 */
			do_action( 'bp_group_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<?php

		/**
		 * Fires after the group header actions section.
		 *
		 * @since BuddyPress (1.2.0)
		 */
		do_action( 'bp_group_header_meta' ); ?>

	</div>
</div><!-- #item-header-content -->

<?php

/**
 * Fires after the display of a group's header.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_group_header' );

/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
do_action( 'template_notices' );
?>
