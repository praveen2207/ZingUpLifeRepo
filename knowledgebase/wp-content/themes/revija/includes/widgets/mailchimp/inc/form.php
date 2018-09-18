<?php

$defaults = array(
	'title' => 'Newsletter',
	'style_type' => 'button_white',
	'mailchimp_intro' => 'Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!',
);

$instance = wp_parse_args( (array) $instance, $defaults );
$mailchimp_intro = isset( $instance['mailchimp_intro'] ) ? $instance['mailchimp_intro'] : '';
$style_type = isset( $instance['style_type'] ) ? $instance['style_type'] : 'button_grey';
$data_mailchimp_api = mad_custom_get_option('mad_mailchimp_api');

if ( $data_mailchimp_api == '' ) {
	echo esc_html__('Please enter your MailChimp API KEY in the theme options panel prior of using this widget.', 'revija');
	return;
}

?>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'revija') ?></label>
	<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr( $instance['title'] ) ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id('mailchimp_intro')); ?>"><?php esc_html_e('Intro Text :', 'revija'); ?></label>
	<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('mailchimp_intro')); ?>" name="<?php echo esc_attr($this->get_field_name('mailchimp_intro')); ?>" cols="35" rows="5"><?php echo esc_textarea($mailchimp_intro); ?></textarea>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id('style_type')); ?>"><?php esc_html_e('Style:', 'revija'); ?></label>
<select class="widefat" id="<?php echo esc_attr($this->get_field_id('style_type')); ?>" name="<?php echo esc_attr($this->get_field_name('style_type')); ?>">
	<option value="button_white"<?php selected( $style_type, 'button_white' ); ?>><?php esc_html_e( 'white', 'revija' ); ?></option>
	<option value="button_grey"<?php selected( $style_type, 'button_grey' ); ?>><?php esc_html_e( 'gray', 'revija' ); ?></option>
</select>
</p>








