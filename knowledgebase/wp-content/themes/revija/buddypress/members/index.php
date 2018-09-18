<?php

/**
 * Fires at the top of the members directory template file.
 *
 * @since BuddyPress (1.5.0)
 */
do_action( 'bp_before_directory_members_page' ); ?>

<div id="buddypress">

	<?php

	/**
	 * Fires before the display of the members.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_directory_members' ); ?>

	<?php

	/**
	 * Fires before the display of the members content.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_directory_members_content' ); ?>

	
	<a  class="button button_type_icon_medium button_grey_light"  href="<?php bp_members_directory_permalink(); ?>"><?php esc_html_e( 'All Members', 'buddypress' ) ?> <?php printf( '<span>%s</span>', bp_get_total_member_count() ) ?>
	</a>
	<?php if ( is_user_logged_in() && bp_is_active( 'friends' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>
		<a class="button button_type_icon_medium button_grey_light" href="<?php echo bp_loggedin_user_domain() . bp_get_friends_slug() . '/my-friends/'; ?>"><?php esc_html_e( 'My Friends', 'buddypress' ); ?> <?php printf( '<span>%s</span>', bp_get_total_friend_count( bp_loggedin_user_id() ) ); ?>
		</a>
	<?php endif; ?>			
	
	
	
		<div class="sorting_block var2 clearfix">
			<div id="members-dir-search" class="dir-search" >
			  <?php 
			    $default_search_value = bp_get_search_default_text( 'members' );
				$search_value         = !empty( $_REQUEST['s'] ) ? stripslashes( $_REQUEST['s'] ) : $default_search_value;

				echo '<form class="search" method="get" id="search-members-form">
				<input type="text" name="s" id="members_search" placeholder="'. esc_attr( $search_value ) .'" />
				<button id="members_search_submit" name="members_search_submit" value="'. esc_html__( 'Search', 'buddypress' ) .'" class=""><i class="fa fa-search"></i></button>
				</form>';
			  ?>
			</div>
			<div>
			 <ul>
			 <?php

				/**
				 * Fires inside the members directory member sub-types.
				 *
				 * @since BuddyPress (1.5.0)
				 */
				do_action( 'bp_members_directory_member_sub_types' ); ?>
				<li id="members-order-select" class="last filter">

					<span><?php esc_html_e( 'Order By:', 'buddypress' ); ?></span>

					<select id="members-order-by" class="chosen-select">
						<option value="active"><?php esc_html_e( 'Last Active', 'buddypress' ); ?></option>
						<option value="newest"><?php esc_html_e( 'Newest Registered', 'buddypress' ); ?></option>

						<?php if ( bp_is_active( 'xprofile' ) ) : ?>
							<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'buddypress' ); ?></option>
						<?php endif; ?>

						<?php do_action( 'bp_members_directory_order_options' ); ?>
					</select>
					
				</li>
			 
			  </ul>
			</div>
		</div>
	
	
	
	
	
	
	
	
	<?php

	/**
	 * Fires before the display of the members list tabs.
	 *
	 * @since BuddyPress (1.8.0)
	 */
	do_action( 'bp_before_directory_members_tabs' ); ?>

	<form method="post" id="members-directory-form" class="dir-form">

		<div id="members-dir-list" class="members dir-list section_7">
			<?php bp_get_template_part( 'members/members-loop' ); ?>
		</div><!-- #members-dir-list -->

		<?php

		/**
 		 * Fires and displays the members content.
 		 *
 		 * @since BuddyPress (1.1.0)
 		 */
		do_action( 'bp_directory_members_content' ); ?>

		<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

		<?php

		/**
		 * Fires after the display of the members content.
		 *
		 * @since BuddyPress (1.1.0)
		 */
		do_action( 'bp_after_directory_members_content' ); ?>

	</form><!-- #members-directory-form -->

	<?php

	/**
	 * Fires after the display of the members.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_after_directory_members' ); ?>

</div><!-- #buddypress -->

<?php

/**
 * Fires at the bottom of the members directory template file.
 *
 * @since BuddyPress (1.5.0)
 */
do_action( 'bp_after_directory_members_page' );
