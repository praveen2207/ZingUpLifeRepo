
<!-- - - - - - - - - - - - - Breadcrumb - - - - - - - - - - - - - -->

<?php if (mad_custom_get_option('page_breadcrumbs') == 'yes'): ?>

	<?php $mad_breadcrumb = rwmb_meta('mad_breadcrumb'); ?>

	<?php if (is_page()): ?>

		<?php if ($mad_breadcrumb == 'breadcrumb'): ?>

			<div class="breadcrumb">
				<div class="container">
					<div class="mad-breadcrumbs">
						<?php echo mad_breadcrumbs(array(
							'separator' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumb-->

		<?php endif; ?>

		
		<?php 
		if ( class_exists('bbPress') ) {
		if(bbp_is_single_forum() || bbp_is_forum_archive() || is_bbpress() || is_post_type_archive('forum') || is_post_type_archive('topic') || is_singular('forum') || is_singular('topic') || bp_current_component()) { ?>

			<div class="breadcrumb breadcrumb-buddypress">
				<div class="container">
					<div class="mad-breadcrumbs">
						<?php echo mad_breadcrumbs(array(
							'separator' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumb-->

		<?php }
		}
		?>
		
		
		
	<?php else: ?>

		<?php if (is_post_type_archive('product')): ?>

			<?php if ($mad_breadcrumb == 'breadcrumb'): ?>

			<div class="breadcrumb">
				<div class="container">
					<div class="mad-breadcrumbs">
						<?php woocommerce_breadcrumb(array(
							'delimiter' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumb-->

			<?php endif; ?>

		<?php else : ?>

			<?php if ($mad_breadcrumb == 'breadcrumb'): ?>

			<div class="breadcrumb">
				<div class="container">
					<div class="mad-breadcrumbs">
						<?php echo mad_breadcrumbs(array(
							'separator' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumb-->

			<?php endif; ?>
			
			
			
			
			
		<?php 
		if ( class_exists('bbPress') ) {
		if(bbp_is_single_forum() || bbp_is_forum_archive() || is_bbpress() ) { ?>

			<div class="breadcrumb breadcrumb-buddypress">
				<div class="container">
					<div class="mad-breadcrumbs">
						<?php echo mad_breadcrumbs(array(
							'separator' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumb-->

		<?php }
		}
		?>
			
			
			
			
			

		<?php endif; ?>

	<?php endif; ?>

<?php endif; ?>

<!-- - - - - - - - - - - - - / breadcrumb - - - - - - - - - - - - -->