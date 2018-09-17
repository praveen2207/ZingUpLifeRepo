<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12">
	<?php
		// reset all previous queries
		wp_reset_postdata();
		
		$mad_post_id = @get_the_ID();
		$mad_custom_sidebar = '';

		if (is_post_type_archive('product') || revija_is_product_category() || revija_is_product_tag()) {
			$mad_woo_shop_page_id = get_option('woocommerce_shop_page_id');
			if ($mad_woo_shop_page_id) {
				$mad_custom_sidebar = rwmb_meta('mad_page_sidebar', '', $mad_woo_shop_page_id);
			}
		}
		
		
		if (is_singular() && !empty($mad_post_id)) {
			$mad_custom_sidebar = rwmb_meta('mad_page_sidebar');
		}

		if ( class_exists('bbPress') ) {
			
			if(bp_current_component()){
				$mad_custom_sidebar = 'Buddypress Widget Area';
			}
			
			if(is_bbpress() || is_post_type_archive('forum') || is_post_type_archive('topic') || is_singular('forum') || is_singular('topic') ){
				$mad_custom_sidebar = 'bbPress Widget Area';
			}
	
		}
		
		
		if ($mad_custom_sidebar && $mad_custom_sidebar != '') {

			dynamic_sidebar($mad_custom_sidebar);
			
		} else {
			if (is_active_sidebar('general-widget-area')) {
				dynamic_sidebar('General Widget Area');
			} else {
			 ?>
				<div class="section widget widget_archive">
					<div class="widget-head">
						<h3 class="section_title"><?php esc_html_e('Archives', 'revija'); ?></h3>
					</div>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</div><!--/ .widget -->

				<div class="section widget widget_meta">
					<div class="widget-head">
						<h3 class="section_title"><?php esc_html_e('Meta', 'revija'); ?></h3>
					</div>
					<ul>
						<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</div><!--/ .widget -->
			<?php
			}
		}
	?>

</div>


