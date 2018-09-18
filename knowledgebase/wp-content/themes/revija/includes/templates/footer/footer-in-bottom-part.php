
<?php $is_align_copyright = mad_custom_get_option('copyright_center');

if ($is_align_copyright): ?>

	<div class="col-sm-12">

		<p class="copyright align-center">
			<?php echo mad_custom_get_option('copyright', "&copy; 2015 " . "<span>" . get_bloginfo('name') . "</span> " . esc_html__('All Rights Reserved.', 'revija')); ?>
		</p>

	</div>

<?php else: ?>

	<p class="copyright">
		<?php echo mad_custom_get_option('copyright', "&copy; 2016 " . "<span>" . get_bloginfo('name') . "</span> " . esc_html__('All Rights Reserved.', 'revija')); ?>
	</p>

	<div class="mobile_menu">
		<nav>
		<?php
			if (has_nav_menu('bottom')) :
				wp_nav_menu( array(
				'theme_location' => 'bottom',
				 'container' => false,
				 'menu_class' => '',
				 'menu_id' => 'menu-bottom',
				 'echo' => true,
				 'depth' => 1,
				 'fallback_cb'=> ''
				 ));
				endif;
				
		?>
		</nav>
	</div>

<?php endif; ?>
