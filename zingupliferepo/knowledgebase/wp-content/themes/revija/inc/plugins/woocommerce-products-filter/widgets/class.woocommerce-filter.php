<?php

if (!class_exists('REVIJA_WOOF_Widget')) {

	class REVIJA_WOOF_Widget extends WP_Widget {

		function __construct() {
			$settings  = array( 'classname' => 'widget-woof-filter woocommerce', 'description' => esc_html__( 'WooCommerce Products Filter', 'revija' ) );
			parent::__construct('widget-woof-filter', esc_html__('Revija WooCommerce Products Filter', 'revija'), $settings);
		}

		function widget($args, $instance) {

			global $_attributes_array;

			extract($args);

			if ( ! is_post_type_archive( 'product' ) && ! is_tax( array_merge( $_attributes_array, array( 'product_cat', 'product_tag' ) ) ) ) {
				return;
			}

			$title = apply_filters( 'widget_title', ( isset( $instance['title'] ) ? $instance['title'] : ''), $instance, $this->id_base );

			$args['instance'] = $instance;
			$args['sidebar_id'] = $args['id'];
			$args['sidebar_name'] = $args['name'];

			ob_start();
			echo $before_widget . $before_title . $title . $after_title;
			echo do_shortcode('[woof]');
			echo $after_widget;
			echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => esc_html__('Products Filter', 'revija')
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
		<?php
		}

	}

}
