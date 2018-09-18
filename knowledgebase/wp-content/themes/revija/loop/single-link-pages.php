<?php
    $mad_next_post = get_next_post();
    $mad_prev_post = get_previous_post();
    $mad_next_post_url = $mad_prev_post_url = "";
	$mad_next_post_title = $mad_prev_post_title = "";

    if (is_object($mad_next_post)) {
        $mad_next_post_url = get_permalink($mad_next_post->ID);
        $mad_next_post_title = $mad_next_post->post_title;
    }
    if (is_object($mad_prev_post)) {
        $mad_prev_post_url = get_permalink($mad_prev_post->ID);
		$mad_prev_post_title = $mad_prev_post->post_title;
    }
?>

<?php if (!empty($mad_prev_post_url) || !empty($mad_next_post_url)): ?>

   <div class="text_post_section post_controls">
        <div class="clearfix">

		
		<div class="prev_post">
			<?php if (!empty($mad_prev_post_url)): ?>
				<a class="button button_type_icon_medium button_grey_light" href="<?php echo esc_url($mad_prev_post_url) ?>" title="">
					<?php esc_html_e('Previous Post', 'revija') ?><i class="fa fa-angle-left"></i>
				</a>
				<a href="<?php echo esc_url($mad_prev_post_url) ?>"><h5 class="second_font"><?php echo esc_html($mad_prev_post_title); ?></h5></a>
			<?php endif; ?>
		</div><!--/ .post-nav-left-->

		<div class="next_post">
			<?php if (!empty($mad_next_post_url)): ?>
				<a class="button button_type_icon_medium button_grey_light" href="<?php echo esc_url($mad_next_post_url) ?>" title="">
					<?php esc_html_e('Next Post', 'revija') ?><i class="fa fa-angle-right"></i>
				</a>
				<a href="<?php echo esc_url($mad_next_post_url) ?>"><h5 class="second_font"><?php echo esc_html($mad_next_post_title); ?></h5></a>
			<?php endif; ?>
		</div><!--/ .post-nav-right-->

		
		</div>
    </div><!--/ .post_controls-->

<?php endif; ?>