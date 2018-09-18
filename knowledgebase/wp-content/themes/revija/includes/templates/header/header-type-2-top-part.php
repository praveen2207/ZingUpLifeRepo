<!-- - - - - - - - - - - - Header Top Part- - - - - - - - - - - - - - -->
	<div class="container">
		<div class="row">
				
				<div class="col-xs-12">
                <div class="header_top mobile_menu var2">
				
				
				<div class="head_weather_info">
				<?php print date('l F j Y'); ?> 
				
				
				<?php 
				$revija_header_sidebar = mad_custom_get_option('sidebar_setting_weather_header');

					if ($revija_header_sidebar && $revija_header_sidebar != '') {
					
						dynamic_sidebar($revija_header_sidebar);

					} 
				?>
				
				</div>
				
				
				<nav>
				<?php
					if (has_nav_menu('top')) :
						wp_nav_menu( array(
						'theme_location' => 'top',
						 'container' => false,
						 'menu_class' => '',
						 'menu_id' => 'menu-top',
						 'echo' => true,
						 'depth' => 1,
						 'fallback_cb'=> ''
						 ));
						endif;
						
				?>
				</nav>
				
				
				</div>
				</div>
				
		</div>
	</div>
	<!-- - - - - - - - - - - - Header Top Part- - - - - - - - - - - - - - -->