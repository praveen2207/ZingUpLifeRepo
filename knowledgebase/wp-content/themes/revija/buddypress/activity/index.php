<?php

/**
 * Fires before the activity directory listing.
 *
 * @since BuddyPress (1.5.0)
 */
do_action( 'bp_before_directory_activity' ); ?>

<div id="buddypress">

	<?php

	/**
	 * Fires before the activity directory display content.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_before_directory_activity_content' ); ?>

	<?php if ( is_user_logged_in() ) : ?>

		<?php bp_get_template_part( 'activity/post-form' ); ?>

	<?php endif; ?>

	<?php

	/**
	 * Fires towards the top of template pages for notice display.
	 *
	 * @since BuddyPress (1.0.0)
	 */
	do_action( 'template_notices' ); ?>

	<div class="item-list-tabs activity-type-tabs" role="navigation">
		<ul>
			<?php

			/**
			 * Fires before the listing of activity type tabs.
			 *
			 * @since BuddyPress (1.2.0)
			 */
			do_action( 'bp_before_activity_type_tab_all' ); 
			
			$count_style_all = '';
			if(bp_get_total_member_count() > 0) {
				$count_style_all = 'button_type_icon_medium';
			}
			?>

			<li class="selected" id="activity-all">
			<a class="button <?php echo esc_attr($count_style_all); ?> button_grey_light" href="<?php bp_activity_directory_permalink(); ?>" title="<?php esc_attr_e( 'The public activity for everyone on this site.', 'buddypress' ); ?>"><?php esc_html_e( 'All Members', 'buddypress' ); ?> <?php printf( '<span>%s</span>', bp_get_total_member_count() ); ?></a>
			</li>

			<?php if ( is_user_logged_in() ) : ?>

				<?php

				/**
				 * Fires before the listing of friends activity type tab.
				 *
				 * @since BuddyPress (1.2.0)
				 */
				do_action( 'bp_before_activity_type_tab_friends' ); ?>

				<?php if ( bp_is_active( 'friends' ) ) : ?>

					<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : 
					
					$count_style_friends = '';
					if(bp_get_total_friend_count( bp_loggedin_user_id() ) > 0) {
						$count_style_friends = 'button_type_icon_medium';
					}
					?>

						<li id="activity-friends"><a class="button <?php echo esc_attr($count_style_friends); ?> button_grey_light" href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of my friends only.', 'buddypress' ); ?>"><?php esc_html_e( 'My Friends', 'buddypress' ); ?>  <?php printf( '<span>%s</span>', bp_get_total_friend_count( bp_loggedin_user_id() ) ); ?></a></li>

					<?php endif; ?>

				<?php endif; ?>

				<?php

				/**
				 * Fires before the listing of groups activity type tab.
				 *
				 * @since BuddyPress (1.2.0)
				 */
				do_action( 'bp_before_activity_type_tab_groups' ); ?>

				<?php if ( bp_is_active( 'groups' ) ) : 
				    
					$count_style_groups = '';
					if(bp_get_total_group_count_for_user( bp_loggedin_user_id() ) > 0) {
						$count_style_groups = 'button_type_icon_medium';
					}
				?>

					<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

						<li id="activity-groups"><a class="button <?php echo esc_attr($count_style_groups); ?> button_grey_light" href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of groups I am a member of.', 'buddypress' ); ?>"><?php esc_html_e( 'My Groups', 'buddypress' ); ?> <?php printf( '<span>%s</span>', bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

					<?php endif; ?>

				<?php endif; ?>

				<?php

				/**
				 * Fires before the listing of favorites activity type tab.
				 *
				 * @since BuddyPress (1.2.0)
				 */
				do_action( 'bp_before_activity_type_tab_favorites' ); ?>

				<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : 
				
				$count_style_favorites = '';
				if(bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) > 0) {
						$count_style_favorites = 'button_type_icon_medium';
					}
				?>

					<li id="activity-favorites"><a class="button <?php echo esc_attr($count_style_favorites); ?> button_grey_light" href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" title="<?php esc_attr_e( "The activity I've marked as a favorite.", 'buddypress' ); ?>"><?php esc_html_e( 'My Favorites', 'buddypress' ); ?> <?php printf( '<span>%s</span>', bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

				<?php endif; ?>

				<?php if ( bp_activity_do_mentions() ) : ?>

					<?php

					/**
					 * Fires before the listing of mentions activity type tab.
					 *
					 * @since BuddyPress (1.2.0)
					 */
					do_action( 'bp_before_activity_type_tab_mentions' );

					$count_style_mentions = '';
					if(bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) > 0) {
						$count_style_mentions = 'button_type_icon_medium';
					}
					?>

					<li id="activity-mentions"><a class="button <?php echo esc_attr($count_style_mentions); ?> button_grey_light" href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>" title="<?php esc_attr_e( 'Activity that I have been mentioned in.', 'buddypress' ); ?>"><?php esc_html_e( 'Mentions', 'buddypress' ); ?><?php if ( bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ) : ?> <strong><span><?php printf( _nx( '%s new', '%s new', bp_get_total_mention_count_for_user( bp_loggedin_user_id() ), 'Number of new activity mentions', 'buddypress' ), bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ); ?></span></strong><?php endif; ?></a></li>

				<?php endif; ?>

			<?php endif; ?>

			<?php

			/**
			 * Fires after the listing of activity type tabs.
			 *
			 * @since BuddyPress (1.2.0)
			 */
			do_action( 'bp_activity_type_tabs' ); ?>
		</ul>
	</div><!-- .item-list-tabs -->

	<div class="sorting_block var2 clearfix  item-list-tabs no-ajax" id="subnav" role="navigation">
		<ul>
			<li class="feed"><a class="button button_type_icon_medium button_orange"  href="<?php bp_sitewide_activity_feed_link(); ?>" title="<?php esc_attr_e( 'RSS Feed', 'buddypress' ); ?>"><?php esc_html_e( 'RSS', 'buddypress' ); ?><i class="fa fa-rss"></i></a></li>

			<?php

			/**
			 * Fires before the display of the activity syndication options.
			 *
			 * @since BuddyPress (1.2.0)
			 */
			do_action( 'bp_activity_syndication_options' ); ?>

			<li id="activity-filter-select" class="last">
				<label for="activity-filter-by"><?php esc_html_e( 'Show', 'buddypress' ); ?></label>
				<select id="activity-filter-by" class="chosen-select" >
					<option value="-1"><?php esc_html_e( '&mdash; Everything &mdash;', 'buddypress' ); ?></option>

					<?php bp_activity_show_filters(); ?>

					<?php

					/**
					 * Fires inside the select input for activity filter by options.
					 *
					 * @since BuddyPress (1.2.0)
					 */
					do_action( 'bp_activity_filter_options' ); ?>

				</select>
			</li>
		</ul>
	</div><!-- .item-list-tabs -->

	<?php

	/**
	 * Fires before the display of the activity list.
	 *
	 * @since BuddyPress (1.5.0)
	 */
	do_action( 'bp_before_directory_activity_list' ); ?>

	<div class="activity section_7">

		<?php bp_get_template_part( 'activity/activity-loop' ); ?>

	</div><!-- .activity -->

	<?php

	/**
	 * Fires after the display of the activity list.
	 *
	 * @since BuddyPress (1.5.0)
	 */
	do_action( 'bp_after_directory_activity_list' ); ?>

	<?php

	/**
	 * Fires inside and displays the activity directory display content.
	 */
	do_action( 'bp_directory_activity_content' ); ?>

	<?php

	/**
	 * Fires after the activity directory display content.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_after_directory_activity_content' ); ?>

	<?php

	/**
	 * Fires after the activity directory listing.
	 *
	 * @since BuddyPress (1.5.0)
	 */
	do_action( 'bp_after_directory_activity' ); ?>

</div>
