
<!-- - - - - - - - - - - - Main Navigation - - - - - - - - - - - - - - -->
<div class="menu_border">
	<div class="container clearfix menu_border_wrap">	

		<!--button for responsive menu-->
		<button id="menu_button">
		  <?php esc_html_e('Menu ', 'revija'); ?>
		</button>
				
		<nav id="navigation" class="main_menu menu_var2">
			<?php echo REVIJA_HELPER::main_navigation('Primary Menu', 'main_menu', 'primary'); ?>
		</nav><!--/ #navigation-->
	
	
		<div class="search-holder">
			<div class="search_box">
					<?php
					
					if ( defined('REVIJA_WOO_CONFIG') ) {
					echo REVIJA_DROPDOWN_CART::mad_woocommerce_cart_dropdown();
					}
					
					if (mad_custom_get_option('show_search')): 
					echo ' <button class="search_button button button_orange_hover">
						  <i class="fa fa-search"></i>
						</button>';	
					endif;
					?>
			</div>
				<?php mad_searchform_default(); ?>
		</div>
	
	</div>
</div><!--/ .menu_border -->
<!-- - - - - - - - - - - - / Main Navigation - - - - - - - - - - - - - - -->


