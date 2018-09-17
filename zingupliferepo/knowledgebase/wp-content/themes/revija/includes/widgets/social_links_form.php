<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'revija') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('facebook_links')); ?>"><?php esc_html_e('Facebook Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('facebook_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('facebook_links')); ?>" value="<?php echo esc_attr($instance['facebook_links']); ?>" />
</p>

<p>
    <label for="<?php echo esc_attr($widget->get_field_id('twitter_links')); ?>"><?php esc_html_e('Twitter Link', 'revija') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('twitter_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('twitter_links')); ?>" value="<?php echo esc_attr($instance['twitter_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('gplus_links')); ?>"><?php esc_html_e('Google Plus Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('gplus_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('gplus_links')); ?>" value="<?php echo esc_attr($instance['gplus_links']); ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['rss_links'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input type="checkbox" id="<?php echo esc_attr($widget->get_field_id('rss_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('rss_links')); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo esc_attr($widget->get_field_id('rss_links')); ?>"><?php esc_html_e('Show RSS Link', 'revija') ?></label>
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('pinterest_links')); ?>"><?php esc_html_e('Pinterest Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('pinterest_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('pinterest_links')); ?>" value="<?php echo esc_attr($instance['pinterest_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('instagram_links')); ?>"><?php esc_html_e('Instagram Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('instagram_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('instagram_links')); ?>" value="<?php echo esc_attr($instance['instagram_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('linkedin_links')); ?>"><?php esc_html_e('Linkedin Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('linkedin_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('linkedin_links')); ?>" value="<?php echo esc_attr($instance['linkedin_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('vimeo_links')); ?>"><?php esc_html_e('Vimeo Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('vimeo_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('vimeo_links')); ?>" value="<?php echo esc_attr($instance['vimeo_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('youtube_links')); ?>"><?php esc_html_e('Youtube Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('youtube_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('youtube_links')); ?>" value="<?php echo esc_attr($instance['youtube_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('flickr_links')); ?>"><?php esc_html_e('Flickr Link', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('flickr_links')); ?>" name="<?php echo esc_attr($widget->get_field_name('flickr_links')); ?>" value="<?php echo esc_attr($instance['flickr_links']); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr($widget->get_field_id('contact_us')); ?>"><?php esc_html_e('Contact us', 'revija') ?>:</label>
	<input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('contact_us')); ?>" name="<?php echo esc_attr($widget->get_field_name('contact_us')); ?>" value="<?php echo esc_attr($instance['contact_us']); ?>" />
</p>





