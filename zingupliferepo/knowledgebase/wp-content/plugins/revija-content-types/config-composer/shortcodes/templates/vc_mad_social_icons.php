<?php

class WPBakeryShortCode_VC_mad_social_icons extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'type' => 'type_border',
			'website_link' => '',
			'facebook_link' => '',
			'twitter_link' => '',
			'google_plus_link' => '',
			'rss_link' => '',
			'pinterest_link' => '',
			'instagram_link' => '',
			'linkedin_link' => '',
			'vimeo_link' => '',
			'youtube_link' => '',
			'flickr_link' => '',
			'envelope_link' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_social_icons');

		$this->content = $content;

		return $this->html();
	}

	public function getCSSAnimation($css_animation) {
		$output = '';
		if ( $css_animation != '' ) {
			wp_enqueue_script('waypoints');
			$output = ' animate-' . $css_animation;
		}
		return $output;
	}

	public function html() {

		$type = $output = $title = $website_link = $facebook_link = $twitter_link = $google_plus_link = $rss_link = $pinterest_link = $instagram_link = $linkedin_link = $vimeo_link = $youtube_link = $flickr_link = $envelope_link = $css_animation = '';

		extract($this->atts);

		$animations = $this->getExtraClass($this->getCSSAnimation($css_animation));
		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' elements_soc_icons ' . $animations, $this->settings['base']);
		
		if (!empty($title)) {
			$title = '<h3 class="section_title section_title_medium">'. $title .'</h3>';
		}

		
		ob_start() ?>

		<?php echo $title ?>
		
		<div  class="<?php echo $css_class ?>">
		
		<div  class="widget widget_social_icons type_2 clearfix <?php echo $type ?>">

		

			<div class="icon-text-holder">

				 <ul>
                      
					 <?php if (!empty($website_link) && $website_link != ''): ?>
					  <li class="website">
                        <span class="tooltip"><?php echo esc_html__( 'Website', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($website_link) ?>" target="_blank">
                          <i class="fa fa-home"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					  
					 <?php if (!empty($facebook_link) && $facebook_link != ''): ?>
					  <li class="facebook">
                        <span class="tooltip"><?php echo esc_html__( 'Facebook', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($facebook_link) ?>" target="_blank">
                          <i class="fa fa-facebook"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					  
					 <?php if (!empty($twitter_link) && $twitter_link != ''): ?>
					  <li class="twitter">
                        <span class="tooltip"><?php echo esc_html__( 'Twitter', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($twitter_link) ?>" target="_blank">
                          <i class="fa fa-twitter"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					 
					 <?php if (!empty($google_plus_link) && $google_plus_link != ''): ?>
					  <li class="google_plus">
                        <span class="tooltip"><?php echo esc_html__( 'Google+', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($google_plus_link) ?>" target="_blank">
                          <i class="fa fa-google-plus"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					  
					 <?php if (!empty($rss_link) && $rss_link != ''): ?>
					  <li class="rss">
                        <span class="tooltip"><?php echo esc_html__( 'Rss', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($rss_link) ?>" target="_blank">
                          <i class="fa fa-rss"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					  
					 <?php if (!empty($pinterest_link) && $pinterest_link != ''): ?>
					  <li class="pinterest">
                        <span class="tooltip"><?php echo esc_html__( 'Pinterest', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($pinterest_link) ?>" target="_blank">
                          <i class="fa fa-pinterest"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					  
					 <?php if (!empty($instagram_link) && $instagram_link != ''): ?>
					  <li class="instagram">
                        <span class="tooltip"><?php echo esc_html__( 'Instagram', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($instagram_link) ?>" target="_blank">
                          <i class="fa fa-instagram"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					
					 <?php if (!empty($linkedin_link) && $linkedin_link != ''): ?>
					  <li class="linkedin">
                        <span class="tooltip"><?php echo esc_html__( 'LinkedIn', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($linkedin_link) ?>" target="_blank">
                          <i class="fa fa-linkedin"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					
					 <?php if (!empty($vimeo_link) && $vimeo_link != ''): ?>
					  <li class="vimeo">
                        <span class="tooltip"><?php echo esc_html__( 'Vimeo', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($vimeo_link) ?>" target="_blank">
                          <i class="fa fa-vimeo-square"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					 
					 <?php if (!empty($youtube_link) && $youtube_link != ''): ?>
					  <li class="youtube">
                        <span class="tooltip"><?php echo esc_html__( 'Youtube', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($youtube_link) ?>" target="_blank">
                          <i class="fa fa-youtube-play"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					  
					 <?php if (!empty($flickr_link) && $flickr_link != ''): ?>
					 <li class="flickr">
                        <span class="tooltip"><?php echo esc_html__( 'Flickr', 'revija' ); ?></span>
                        <a href="<?php echo esc_url($flickr_link) ?>" target="_blank">
                          <i class="fa fa-flickr"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					 
					  <?php if (!empty($envelope_link) && $envelope_link != ''): ?>
					  <li class="envelope">
                        <span class="tooltip"><?php echo esc_html__( 'Email', 'revija' ); ?></span>
                        <a href="mailto:<?php echo $envelope_link ?>" target="_blank">
                          <i class="fa fa-envelope-o"></i>
                        </a>
                      </li>
                      <?php endif; ?>
					
					</ul>

			</div>

		</div>
		
		</div>

		<?php return ob_get_clean();
	}

}