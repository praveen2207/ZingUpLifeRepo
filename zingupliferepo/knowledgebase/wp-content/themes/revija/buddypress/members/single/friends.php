<?php

/**
 * BuddyPress - Users Friends
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs no-ajax  sorting_block var2 clearfix subnav"  role="navigation">
	<ul>
		<?php if ( bp_is_my_profile() ) bp_get_options_nav(); ?>

		<?php if ( !bp_is_current_action( 'requests' ) ) : ?>

			<li id="members-order-select" class="last filter">

				<label for="members-friends"><?php esc_html_e( 'Order By:', 'buddypress' ); ?></label>
				<select id="members-friends"  class="chosen-select">
					<option value="active"><?php esc_html_e( 'Last Active', 'buddypress' ); ?></option>
					<option value="newest"><?php esc_html_e( 'Newest Registered', 'buddypress' ); ?></option>
					<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'buddypress' ); ?></option>

					<?php

					/**
					 * Fires inside the members friends order options select input.
					 *
					 * @since BuddyPress (2.0.0)
					 */
					do_action( 'bp_member_friends_order_options' ); ?>

				</select>
			</li>

		<?php endif; ?>

	</ul>
</div>

<?php
switch ( bp_current_action() ) :

	// Home/My Friends
	case 'my-friends' :

		/**
		 * Fires before the display of member friends content.
		 *
		 * @since BuddyPress (1.2.0)
		 */
		do_action( 'bp_before_member_friends_content' ); ?>

		<div class="members friends">

			<?php bp_get_template_part( 'members/members-loop' ) ?>

		</div><!-- .members.friends -->

		<?php

		/**
		 * Fires after the display of member friends content.
		 *
		 * @since BuddyPress (1.2.0)
		 */
		do_action( 'bp_after_member_friends_content' );
		break;

	case 'requests' :
		bp_get_template_part( 'members/single/friends/requests' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
