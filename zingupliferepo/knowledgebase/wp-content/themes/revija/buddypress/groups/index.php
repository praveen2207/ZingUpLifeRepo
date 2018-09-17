<?php

/**
 * Fires at the top of the groups directory template file.
 *
 * @since BuddyPress (1.5.0)
 */
do_action( 'bp_before_directory_groups_page' ); ?>

<div id="buddypress"  class="section-buddypress">

	<?php

	/**
	 * Fires before the display of the groups.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_directory_groups' ); ?>

	<?php

	/**
	 * Fires before the display of the groups content.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_directory_groups_content' ); ?>

	<a class="button button_type_icon_medium button_grey_light" href="<?php bp_groups_directory_permalink(); ?>"><?php esc_html_e( 'All Groups', 'buddypress' ); ?> <?php printf( '<span>%s</span>', bp_get_total_group_count() ); ?>
	</a>

	<?php echo bp_get_group_create_button(); ?>
		




		<div class="sorting_block var2 clearfix">
			<div id="group-dir-search" class="dir-search" >
			  <?php 
				$default_search_value = bp_get_search_default_text( 'groups' );
				$search_value         = !empty( $_REQUEST['s'] ) ? stripslashes( $_REQUEST['s'] ) : $default_search_value;
			  
				echo '<form class="search" method="get" id="search-groups-form">
					<input type="text" name="s" id="groups_search" placeholder="'. esc_attr( $search_value ) .'" />
					<button id="groups_search_submit" name="groups_search_submit" value="'. esc_html__( 'Search', 'buddypress' ) .'" class=""><i class="fa fa-search"></i></button>
				</form>';
			  
			  ?>
			</div>
			<div>
			 <ul>
				<li id="groups-order-select" class="last filter">

					<span><?php esc_html_e( 'Order By:', 'buddypress' ); ?></span>

					
					<select id="groups-order-by" class="chosen-select">
						<option value="active"><?php esc_html_e( 'Last Active', 'buddypress' ); ?></option>
						<option value="popular"><?php esc_html_e( 'Most Members', 'buddypress' ); ?></option>
						<option value="newest"><?php esc_html_e( 'Newly Created', 'buddypress' ); ?></option>
						<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'buddypress' ); ?></option>

						<?php

						/**
						 * Fires inside the groups directory group order options.
						 *
						 * @since BuddyPress (1.2.0)
						 */
						do_action( 'bp_groups_directory_order_options' ); ?>
					</select>
					
					
				</li>
			 
			  </ul>
			</div>
		</div>


	
	
	
	<form method="post" id="groups-directory-form" class="dir-form">

		<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
		do_action( 'template_notices' ); 
		?>
		
		
		
		
		
		<div id="groups-dir-list" class="groups dir-list section_7">
			<?php bp_get_template_part( 'groups/groups-loop' ); ?>
		</div><!-- #groups-dir-list -->

		<?php

		/**
 		 * Fires and displays the group content.
 		 *
 		 * @since BuddyPress (1.1.0)
 		 */
		do_action( 'bp_directory_groups_content' ); ?>

		<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

		<?php

		/**
 		 * Fires after the display of the groups content.
 		 *
 		 * @since BuddyPress (1.1.0)
 		 */
		do_action( 'bp_after_directory_groups_content' ); ?>

	</form><!-- #groups-directory-form -->

	<?php

	/**
 	 * Fires after the display of the groups.
 	 *
 	 * @since BuddyPress (1.1.0)
 	 */
	do_action( 'bp_after_directory_groups' ); ?>

</div><!-- #buddypress -->

<?php

/**
 * Fires at the bottom of the groups directory template file.
 *
 * @since BuddyPress (1.5.0)
 */
do_action( 'bp_after_directory_groups_page' );
