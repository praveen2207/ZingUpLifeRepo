<?php

/**
 * BuddyPress Groups Widgets
 *
 * @package BuddyPress
 * @subpackage GroupsWidgets
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/*** GROUPS WIDGET *****************/

class Mad_BP_Groups_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'A dynamic list of recently active, popular, and newest groups', 'buddypress' ),
			'classname' => 'widget_bp_groups_widget buddypress widget',
		);
		parent::__construct( false, _x( '(BuddyPress) Groups', 'widget name', 'buddypress' ), $widget_ops );

		if ( is_active_widget( false, false, $this->id_base ) && !is_admin() && !is_network_admin() ) {
			$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_enqueue_script( 'groups_widget_groups_list-js', buddypress()->plugin_url . "bp-groups/js/widget-groups{$min}.js", array( 'jquery' ), bp_get_version() );
		}
	}

	/**
	 * PHP4 constructor
	 *
	 * For backward compatibility only
	 */
	function bp_groups_widget() {
		$this->_construct();
	}

	function widget( $args, $instance ) {

		/**
		 * Filters the user ID to use with the widget instance.
		 *
		 * @since BuddyPress (1.5.0)
		 *
		 * @param string $value Empty user ID.
		 */
		$user_id = apply_filters( 'bp_group_widget_user_id', '0' );

		extract( $args );

		if ( empty( $instance['group_default'] ) )
			$instance['group_default'] = 'popular';

		if ( empty( $instance['title'] ) )
			$instance['title'] = esc_html__( 'Groups', 'buddypress' );

		/**
		 * Filters the title of the Groups widget.
		 *
		 * @since BuddyPress (1.8.0)
		 * @since BuddyPress (2.3.0) Added 'instance' and 'id_base' to arguments passed to filter.
		 *
		 * @param string $title    The widget title.
		 * @param array  $instance The settings for the particular instance of the widget.
		 * @param string $id_base  Root ID for all widgets of this type.
		 */
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		echo $before_widget;

		$title = !empty( $instance['link_title'] ) ? '<a href="' . bp_get_groups_directory_permalink() . '">' . $title . '</a>' : $title;

		echo $before_title . $title . $after_title;

		$group_args = array(
			'user_id'         => $user_id,
			'type'            => $instance['group_default'],
			'per_page'        => $instance['max_groups'],
			'max'             => $instance['max_groups'],
		);

		?>

		<?php if ( bp_has_groups( $group_args ) ) : ?>
			<div class="item-options clearfix " id="groups-list-options">
				<a href="<?php bp_groups_directory_permalink(); ?>" id="newest-groups"<?php if ( $instance['group_default'] == 'newest' ) : ?> class="selected"<?php endif; ?>><h5><?php esc_html_e("Newest", 'buddypress') ?></h5></a>
				<a href="<?php bp_groups_directory_permalink(); ?>" id="recently-active-groups"<?php if ( $instance['group_default'] == 'active' ) : ?> class="selected"<?php endif; ?>><h5><?php esc_html_e("Active", 'buddypress') ?></h5></a>
				<a href="<?php bp_groups_directory_permalink(); ?>" id="popular-groups" <?php if ( $instance['group_default'] == 'popular' ) : ?> class="selected"<?php endif; ?>><h5><?php esc_html_e("Popular", 'buddypress') ?></h5></a>
			</div>

			<ul id="groups-list" class="item-list">
				<?php while ( bp_groups() ) : bp_the_group(); ?>
					<li <?php bp_group_class(); ?>>
						
						<div class="item-avatar scale_image_container">
							<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_avatar('type=thumb&width=80&height=80') ?></a>
						</div>

						<div class="item post_text">
							<div class="item-title"><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><h4><?php bp_group_name() ?></h4></a></div>
							<div class="item-meta">
								<span class="activity">
								<?php
									if ( 'newest' == $instance['group_default'] )
										printf( esc_html__( 'created %s', 'buddypress' ), bp_get_group_date_created() );
									if ( 'active' == $instance['group_default'] )
										printf( esc_html__( 'active %s', 'buddypress' ), bp_get_group_last_active() );
									elseif ( 'popular' == $instance['group_default'] )
										bp_group_member_count();
								?>
								</span>
							</div>
						</div>
						
						<div class="clearfix"></div>
					</li>

				<?php endwhile; ?>
			</ul>
			<?php wp_nonce_field( 'groups_widget_groups_list', '_wpnonce-groups' ); ?>
			<input type="hidden" name="groups_widget_max" id="groups_widget_max" value="<?php echo esc_attr( $instance['max_groups'] ); ?>" />

		<?php else: ?>

			<div class="widget-error">
				<?php esc_html_e('There are no groups to display.', 'buddypress') ?>
			</div>

		<?php endif; ?>

		<?php echo $after_widget; ?>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['max_groups']    = strip_tags( $new_instance['max_groups'] );
		$instance['group_default'] = strip_tags( $new_instance['group_default'] );
		$instance['link_title']    = (bool)$new_instance['link_title'];

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title'         => esc_html__( 'Groups', 'buddypress' ),
			'max_groups'    => 5,
			'group_default' => 'active',
			'link_title'    => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title 	       = strip_tags( $instance['title'] );
		$max_groups    = strip_tags( $instance['max_groups'] );
		$group_default = strip_tags( $instance['group_default'] );
		$link_title    = (bool)$instance['link_title'];
		?>

		<p><label for="bp-groups-widget-title"><?php esc_html_e('Title:', 'buddypress'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" style="width: 100%" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_name('link_title')) ?>"><input type="checkbox" name="<?php echo esc_attr($this->get_field_name('link_title')) ?>" value="1" <?php checked( $link_title ) ?> /> <?php esc_html_e( 'Link widget title to Groups directory', 'buddypress' ) ?></label></p>

		<p><label for="bp-groups-widget-groups-max"><?php esc_html_e('Max groups to show:', 'buddypress'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'max_groups' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'max_groups' )); ?>" type="text" value="<?php echo esc_attr( $max_groups ); ?>" style="width: 30%" /></label></p>

		<p>
			<label for="bp-groups-widget-groups-default"><?php esc_html_e('Default groups to show:', 'buddypress'); ?>
			<select name="<?php echo esc_attr($this->get_field_name( 'group_default' )); ?>">
				<option value="newest" <?php if ( $group_default == 'newest' ) : ?>selected="selected"<?php endif; ?>><?php esc_html_e( 'Newest', 'buddypress' ) ?></option>
				<option value="active" <?php if ( $group_default == 'active' ) : ?>selected="selected"<?php endif; ?>><?php esc_html_e( 'Active', 'buddypress' ) ?></option>
				<option value="popular"  <?php if ( $group_default == 'popular' ) : ?>selected="selected"<?php endif; ?>><?php esc_html_e( 'Popular', 'buddypress' ) ?></option>
			</select>
			</label>
		</p>
	<?php
	}
}

function groups_ajax_widget_groups_list1() {

	check_ajax_referer('groups_widget_groups_list');

	switch ( $_POST['filter'] ) {
		case 'newest-groups':
			$type = 'newest';
		break;
		case 'recently-active-groups':
			$type = 'active';
		break;
		case 'popular-groups':
			$type = 'popular';
		break;
	}

	$per_page = isset( $_POST['max_groups'] ) ? intval( $_POST['max_groups'] ) : 5;

	$groups_args = array(
		'user_id'  => 0,
		'type'     => $type,
		'per_page' => $per_page,
		'max'      => $per_page,
	);

	if ( bp_has_groups( $groups_args ) ) : ?>
		<?php echo "0[[SPLIT]]"; ?>
		<?php while ( bp_groups() ) : bp_the_group(); ?>
			<li <?php bp_group_class(); ?>>
				<div class="item-avatar scale_image_container">
					<a href="<?php bp_group_permalink() ?>"><?php bp_group_avatar('type=thumb&width=80&height=80') ?></a>
				</div>

				<div class="item post_text">
					<div class="item-title"><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><h4><?php bp_group_name() ?></h4></a></div>
							
					<div class="item-meta">
						<span class="activity">
							<?php
							if ( 'newest-groups' == $_POST['filter'] ) {
								printf( esc_html__( 'created %s', 'buddypress' ), bp_get_group_date_created() );
							} elseif ( 'recently-active-groups' == $_POST['filter'] ) {
								printf( esc_html__( 'active %s', 'buddypress' ), bp_get_group_last_active() );
							} elseif ( 'popular-groups' == $_POST['filter'] ) {
								bp_group_member_count();
							}
							?>
						</span>
					</div>
				</div>
				<div class="clearfix"></div>
			</li>
		<?php endwhile; ?>

		<?php wp_nonce_field( 'groups_widget_groups_list', '_wpnonce-groups' ); ?>
		<input type="hidden" name="groups_widget_max" id="groups_widget_max" value="<?php echo esc_attr( $_POST['max_groups'] ); ?>" />

	<?php else: ?>

		<?php echo "-1[[SPLIT]]<li>" . esc_html__("No groups matched the current filter.", 'buddypress'); ?>

	<?php endif;

}

remove_action( 'wp_ajax_widget_groups_list',        'groups_ajax_widget_groups_list' );
remove_action( 'wp_ajax_nopriv_widget_groups_list', 'groups_ajax_widget_groups_list' );

add_action( 'wp_ajax_widget_groups_list',        'groups_ajax_widget_groups_list1' );
add_action( 'wp_ajax_nopriv_widget_groups_list', 'groups_ajax_widget_groups_list1' );
