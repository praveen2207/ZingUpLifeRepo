<!-- - - - - - - - - - - - Header Top Part- - - - - - - - - - - - - - -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="header_top mobile_menu var2">

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


				<div class="login_block custom_box">
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
		</div>
				
	</div>
</div>
	
<!-- - - - - - - - - - - - Header End Top Part- - - - - - - - - - - - - - -->