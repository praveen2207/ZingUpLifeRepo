	
	
	<div class="col-lg-4 col-md-4 col-sm-4">	
		
			<div class="login_block custom_box" style="margin-top:15px;">
					<div class="widget widget_social_icons type_2 tool_down clearfix">
						<ul>
							<?php if (mad_custom_get_option('facebook_page_url_top') != '') : ?>
								<li class="facebook">
									<span class="tooltip">Facebook</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('facebook_page_url_top')); ?>">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
							<?php endif; ?>
						
							<?php if (mad_custom_get_option('twitter_page_url_top') != '') : ?>
								<li class="twitter">
									<span class="tooltip">Twitter</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('twitter_page_url_top')); ?>">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('google_plus_page_url_top') != '') : ?>
								<li class="google_plus">
									<span class="tooltip">Google Plus</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('google_plus_page_url_top')); ?>">
										<i class="fa fa-google-plus"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('header_top_rss_links') == 'show') : ?>
								<li class="rss">
									<span class="tooltip">Rss</span>
									<a href="<?php bloginfo('rss2_url'); ?>">
										<i class="fa fa-rss"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('pinterest_page_url_top') != '') : ?>
								<li class="pinterest">
									<span class="tooltip">Pinterest</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('pinterest_page_url_top')); ?>">
										<i class="fa fa-pinterest"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('instagram_page_url_top') != '') : ?>
								<li class="instagram">
									<span class="tooltip">Instagram</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('instagram_page_url_top')); ?>">
										<i class="fa fa-instagram"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('linkedin_page_url_top') != '') : ?>
								<li class="linkedin">
									<span class="tooltip">LinkedIn</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('linkedin_page_url_top')); ?>">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('vimeo_page_url_top') != '') : ?>
								<li class="vimeo">
									<span class="tooltip">Vimeo</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('vimeo_page_url_top')); ?>">
										<i class="fa fa-vimeo-square"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('youtube_page_url_top') != '') : ?>
								<li class="youtube">
									<span class="tooltip">Youtube</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('youtube_page_url_top')); ?>">
										<i class="fa fa-youtube-play"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('flickr_page_url_top') != '') : ?>
								<li class="flickr">
									<span class="tooltip">Flickr</span>
									<a target="_blank" href="<?php echo esc_url(mad_custom_get_option('flickr_page_url_top')); ?>">
										<i class="fa fa-flickr"></i>
									</a>
								</li>
							<?php endif; ?>

							<?php if (mad_custom_get_option('envelope_page_url_top') != '') : ?>
								<li class="envelope">
									<span class="tooltip">Contact Us</span>
									<a target="_blank" href="mailto:<?php echo esc_url(mad_custom_get_option('contact_us')); ?>">
										<i class="fa fa-envelope-o"></i>
									</a>
								</li>
							<?php endif; ?>
						
						
						
						</ul>

					</div>
				</div>	
		
	</div>






<div class="col-lg-4 col-md-4 col-sm-4">
	<div class="t_align_c">
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
							<img src="<?php echo esc_attr($logo_image); ?>" alt="<?php bloginfo('description'); ?>" />
						</a>

					<?php }

				break;
			}
		?>

	</div>
</div>


<div class="col-lg-4 col-md-4 col-sm-4">
	<div class="search-holder">
	    <div class="search_box">
			
			<?php if (class_exists('WooCommerce')) { ?>
			
			<?php echo REVIJA_DROPDOWN_CART::mad_woocommerce_cart_dropdown(); ?>
			
			<?php } ?>
			
			
			
			<?php 
			if (mad_custom_get_option('show_search')): 
			echo ' <button class="search_button button button_orange_hover">
                  <i class="fa fa-search"></i>
                </button>';	
			endif;
			 ?>
		</div>
		
			<?php mad_searchform_type_2(); ?>
			
	</div>
</div>



