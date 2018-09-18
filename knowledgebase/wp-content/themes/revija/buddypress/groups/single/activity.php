<div class="sorting_block var2 clearfix item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<li class="feed"><a class="button button_type_icon_medium button_orange" href="<?php bp_group_activity_feed_link(); ?>" title="<?php esc_attr_e( 'RSS Feed', 'buddypress' ); ?>"><?php esc_html_e( 'RSS', 'buddypress' ); ?><i class="fa fa-rss"></i></a></li>

		<?php

		/**
		 * Fires inside the syndication options list, after the RSS option.
		 *
		 * @since BuddyPress (1.2.0)
		 */
		do_action( 'bp_group_activity_syndication_options' ); ?>

		<li id="activity-filter-select" class="last">
			<label for="activity-filter-by"><?php esc_html_e( 'Show', 'buddypress' ); ?></label>
			<select id="activity-filter-by" class="chosen-select">
				<option value="-1"><?php esc_html_e( '&mdash; Everything &mdash;', 'buddypress' ); ?></option>

				<?php bp_activity_show_filters( 'group' ); ?>

				<?php

				/**
				 * Fires inside the select input for group activity filter options.
				 *
				 * @since BuddyPress (1.2.0)
				 */
				do_action( 'bp_group_activity_filter_options' ); ?>
			</select>
		</li>
	</ul>
</div><!-- .item-list-tabs -->

<?php

/**
 * Fires before the display of the group activity post form.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_group_activity_post_form' ); ?>

<?php if ( is_user_logged_in() && bp_group_is_member() ) : ?>

	<?php bp_get_template_part( 'activity/post-form' ); ?>

<?php endif; ?>

<?php

/**
 * Fires after the display of the group activity post form.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_group_activity_post_form' ); ?>
<?php

/**
 * Fires before the display of the group activities list.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_group_activity_content' ); ?>

<div class="activity single-group section_7">

	<?php bp_get_template_part( 'activity/activity-loop' ); ?>

</div><!-- .activity.single-group -->

<?php

/**
 * Fires after the display of the group activities list.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_group_activity_content' ); ?>
