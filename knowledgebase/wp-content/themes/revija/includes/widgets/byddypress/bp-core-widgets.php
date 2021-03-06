<?php
/**
 * BuddyPress Core Component Widgets.
 *
 * @package BuddyPress
 * @subpackage Core
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * BuddyPress Login Widget.
 *
 * @since BuddyPress (1.9.0)
 */
class Mad_BP_Core_Login_Widget extends WP_Widget {

	/**
	 * Constructor method.
	 */
	public function __construct() {
		parent::__construct(
			false,
			_x( '(BuddyPress) Log In', 'Title of the login widget', 'buddypress' ),
			array(
				'description' => esc_html__( 'Show a Log In form to logged-out visitors, and a Log Out link to those who are logged in.', 'buddypress' ),
				'classname' => 'widget_bp_core_login_widget buddypress widget',
			)
		);
	}

	/**
	 * Display the login widget.
	 *
	 * @see WP_Widget::widget() for description of parameters.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Widget settings, as saved by the user.
	 */
	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		/**
		 * Filters the title of the Login widget.
		 *
		 * @since BuddyPress (1.9.0)
		 * @since BuddyPress (2.3.0) Added 'instance' and 'id_base' to arguments passed to filter.
		 *
		 * @param string $title    The widget title.
		 * @param array  $instance The settings for the particular instance of the widget.
		 * @param string $id_base  Root ID for all widgets of this type.
		 */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];

		echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>

		<?php if ( is_user_logged_in() ) : ?>

			<?php

 		 	/**
		 	 * Fires before the display of widget content if logged in.
		 	 *
		 	 * @since BuddyPress (1.9.0)
		 	 */
			do_action( 'bp_before_login_widget_loggedin' ); ?>

			<div class="bp-login-widget-user-avatar scale_image_container">
				<a href="<?php echo bp_loggedin_user_domain(); ?>">
					<?php bp_loggedin_user_avatar( 'type=full&width=80&height=80' ); ?>
				</a>
			</div>

			<div class="bp-login-widget-user-links post_text">
				<div class="bp-login-widget-user-link"><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></div>
				<div class="bp-login-widget-user-logout"><a class="logout button button_grey" href="<?php echo wp_logout_url( bp_get_requested_url() ); ?>"><?php esc_html_e( 'Log Out', 'buddypress' ); ?></a></div>
			</div>

			<div class="clearfix"></div>
			
			<?php

			/**
		 	 * Fires after the display of widget content if logged in.
		 	 *
		 	 * @since BuddyPress (1.9.0)
		 	 */
			do_action( 'bp_after_login_widget_loggedin' ); ?>

		<?php else : ?>

			<?php

			/**
		 	 * Fires before the display of widget content if logged out.
		 	 *
		 	 * @since BuddyPress (1.9.0)
		 	 */
			do_action( 'bp_before_login_widget_loggedout' ); ?>
			<div class="login_form">
			<form name="bp-login-form" id="bp-login-widget-form" class="login_form_confirm standard-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
				<ul>
                <li>
				<input type="text" name="log" id="bp-login-widget-user-login" class="input" value="" /><i class="fa fa-user"></i>
				</li>
				
				<li>
				<input type="password" name="pwd" id="bp-login-widget-user-pass" class="input" value="" <?php bp_form_field_attributes( 'password' ) ?> /><i class="fa fa-lock"></i>
				</li>
				
				<li class="clearfix" >
				<div class="forgetmenot">
					
					<input name="rememberme" type="checkbox" id="bp-login-widget-rememberme" value="forever" /> 
					<label for="bp-login-widget-rememberme"><?php esc_html_e( 'Remember Me', 'buddypress' ); ?></label>
				</div>
				</li>
				
				</ul>
				
				
				<input type="submit" class="button button_grey" name="wp-submit" id="bp-login-widget-submit" value="<?php esc_attr_e( 'Log In', 'buddypress' ); ?>" />

				<?php if ( bp_get_signup_allowed() ) : ?>

					 <a href="<?php echo esc_url( bp_get_signup_page() ); ?>" id="bp-login-widget-register"  class="button button_grey"  title="Register for a new account"><?php  esc_html_e( 'Register', 'buddypress' ); ?></a>

				<?php endif; ?>

			</form>
			</div>
			<div class="clearfix"></div>
			<?php

			/**
		 	 * Fires after the display of widget content if logged out.
		 	 *
		 	 * @since BuddyPress (1.9.0)
		 	 */
			do_action( 'bp_after_login_widget_loggedout' ); ?>

		<?php endif;

		echo $args['after_widget'];
	}

	/**
	 * Update the login widget options.
	 *
	 * @param array $new_instance The new instance options.
	 * @param array $old_instance The old instance options.
	 * @return array $instance The parsed options to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Output the login widget options form.
	 *
	 * @param $instance Settings for this widget.
	 */
	public function form( $instance = array() ) {

		$settings = wp_parse_args( $instance, array(
			'title' => '',
		) ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'buddypress' ); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" /></label>
		</p>

		<?php
	}
}
