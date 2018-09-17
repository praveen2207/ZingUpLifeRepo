<div class="col-xs-12">
<div class="clearfix">
	<?php
		$logo_type = mad_custom_get_option('logo_type');
	?>

	<?php
		switch ($logo_type) {
			case 'text':
				$logo_text = mad_custom_get_option('logo_text');

				if (empty($logo_text)) {
					$logo_text = get_bloginfo('name');
				}

			if (!empty($logo_text)): ?>

			<h1 id="logo" class="f_left logo">
				<a title="<?php bloginfo('description'); ?>" href="<?php echo esc_url(home_url()); ?>">
					<?php echo esc_html($logo_text); ?>
				</a>
			</h1>

			<?php endif;

			break;
			case 'upload':

				$logo_image = mad_custom_get_option('logo_image');

				if (!empty($logo_image)) { ?>

					<a id="logo" class="f_left logo" title="<?php bloginfo('description'); ?>" href="<?php echo esc_url(home_url()); ?>">
						<img src="<?php echo esc_attr($logo_image); ?>" alt="<?php bloginfo('description'); ?>" />
					</a>

				<?php }

			break;
		}
	?>
	
	
	
	
	
	
	
	
	
	<?php 
	$revija_post_id = mad_post_id();
	$revija_header_sidebar = rwmb_meta('mad_page_sidebar_header', '', $revija_post_id);
		if (empty($revija_header_sidebar)) {
			$revija_header_sidebar = mad_custom_get_option('sidebar_setting_page_header');
		}
		
		if ($revija_header_sidebar && $revija_header_sidebar != '') {
        echo '<div class="f_right">'; 
		
			if ( !dynamic_sidebar($revija_header_sidebar) ) {
				echo '<img src="'. REVIJA_BASE_URI .'images/header_ph.jpg" alt="">';
			}

		echo '</div>';	
		} 
	?>
	
	
	
</div>
</div>