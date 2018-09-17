<div class="container">
    <div class="row">

		<div class="col-lg-2 col-md-12">

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

					<h1 id="logo" class="logo">
						<a title="<?php bloginfo('description'); ?>" href="<?php echo esc_url(home_url()); ?>">
							<?php echo esc_html($logo_text); ?>
						</a>
					</h1>

					<?php endif;

					break;
					case 'upload':

						$logo_image = mad_custom_get_option('logo_image');

						if (!empty($logo_image)) { ?>

							<a id="logo" class="logo" title="<?php bloginfo('description'); ?>" href="<?php echo esc_url(home_url()); ?>">
								<img src="<?php echo esc_url($logo_image); ?>" alt="<?php bloginfo('description'); ?>" />
							</a>

						<?php }

					break;
				}
			?>
			
		</div>
		

		<!-- - - - - - - - - - - - Main Navigation - - - - - - - - - - - - - - -->	
		<div class="col-lg-10 col-md-12">
			<div class="clearfix">
			
			<!--button for responsive menu-->
			<button id="menu_button">
			  <?php esc_html_e('Menu ', 'revija'); ?>
			</button>
		
				<nav id="navigation" class="navigation main_menu ">
					<?php echo REVIJA_HELPER::main_navigation('Primary Menu', 'main_menu', 'primary'); ?>
				</nav><!--/ #navigation-->
				
				
				
				<div class="search-holder">
					<div class="search_box">
						<?php	
						if (mad_custom_get_option('show_search')): 
						echo ' <button class="search_button button button_orange_hover">
							  <i class="fa fa-search"></i>
							</button>';	
						endif;
						?>
					</div>
					
					
					<!--search form-->
					 <div class="searchform_wrap">
						<div class="vc_child h_inherit relative">
						  <?php get_search_form(); ?>
						  <button class="close_search_form">
							<i class="fa fa-times"></i>
						  </button>
						</div>
					 </div>
					 <!--/ .searchform-wrap -->
					
				</div>
						
				
				
				
			</div>
		</div>
		<!-- - - - - - - - - - - - / Main Navigation - - - - - - - - - - - - - - -->

		
	</div>		
</div>		
	
		