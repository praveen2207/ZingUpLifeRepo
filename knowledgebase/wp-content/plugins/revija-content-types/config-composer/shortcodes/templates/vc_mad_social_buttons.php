<?php

class WPBakeryShortCode_VC_mad_social_buttons extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title'   => '',
			'custom_links_target' => '_self',
			'facebook_links'	   => '',
			'twitter_links'	   => '',
			'gplus_links'	   => '',
			'rss_links'	   => '',
			'pinterest_links'	   => '',
			'youtube_links'	   => '',
			'contact_us'	   => '',
			'css_animation' => ''
		), $atts, 'vc_mad_social_buttons');

		$this->atts['mailchimp_intro'] = $this->atts['contact_us'];
		
		
		
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

		$title = $custom_links_target = $contact_us = $youtube_links = $vimeo_links = $linkedin_links = $instagram_links = $pinterest_links = $rss_links = $gplus_links = $twitter_links = $facebook_links = $css_animation = '';

		extract($this->atts);

		$animations = $this->getExtraClass($this->getCSSAnimation($css_animation));
		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' section elements_soc_icons_btn ' . $animations, $this->settings['base']);

		
		if (!empty($title)) {
			$title = '<h3 class="section_title">'. $title .'</h3>';
		}

		ob_start() ?>
		
		
		
	<div  class="tabs <?php echo $css_class ?>">
		
		<?php echo $title ?>
		
		<div class="widget_social_buttons clearfix tabs_conrainer">

		<ul class="tabs_nav social_media_list clearfix">

			<?php if ($contact_us != '') : ?>
				<li class="">
					<a class="btn-email button"  href="#tab-3">
						<i class="fa fa-envelope-o"></i>
					</a>
				</li>
			<?php endif; ?>


			<?php if ($rss_links != '') : ?>
				<li class="">
					<a class="rss" href="#tab-4" >
						<i class="fa fa-rss"></i>
					</a>
				</li>
			<?php endif; ?>
			
			<?php if ($facebook_links != '') : ?>
				<li class="">
					<a class="fb" href="#tab-5" >
						<i class="fa fa-facebook"></i>
					</a>
				</li>
			<?php endif; ?>
			
			<?php if ($gplus_links != '') : ?>
				<li class="">
					<a class="g_plus"  href="#tab-6">
						<i class="fa fa-google-plus"></i>
					</a>
				</li>
			<?php endif; ?>
			
			<?php if ($youtube_links != '') : ?>
				<li class="">
					<a class="you_tube" href="#tab-7">
						<i class='fa fa-youtube-play'></i>
					</a>
				</li>
			<?php endif; ?>
	
			<?php if ($twitter_links != '') : ?>
				<li class="">
					<a class="twitter" href="#tab-8">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
			<?php endif; ?>

		
			<?php if ($pinterest_links != '') : ?>
				<li class="">
					<a class="pint" href="#tab-9">
						<i class="fa fa-pinterest"></i>
					</a>
				</li>
			<?php endif; ?>

			
		</ul><!--/ .social-icons-->

		</div><!--/ .social_icons_holder-->
		
		
		
		
		
		
		<!--tabs content-->
		<div class="tabs_content side_bar_tabs social_tabs">
		 
		 <div id="tab-3">

			<?php  
			$this->atts['title'] = ''; 
			$type = 'mad_widget_mailchimp';
			
			$this->atts['style_type'] = 'button_grey';
			
			$mad_widget_args = array(
				'before_widget' => '<div id="wp_newsletter_widget" class="section widget widget_zn_mailchimp">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-head"><h3 class="section_title">',
				'after_title' => '</h3></div>'
			);
			the_widget( $type, $this->atts, $mad_widget_args ); ?>

		  </div>
		  
		  <div id="tab-4">
			<p>
			  <a href="<?php echo $rss_links; ?>"><?php esc_html_e( 'Full site feed', 'revija' ); ?></a>
			</p>
		  </div>
		  
		  <div id="tab-5">
			<p><?php esc_html_e( 'Like us', 'revija' ); ?></p><div class="fb-like" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
		  </div>
		  
		  <div id="tab-6">
			<p><?php esc_html_e( 'Follow us', 'revija' ); ?></p><div class="g-follow" data-annotation="bubble" data-height="20" data-href="<?php echo $gplus_links; ?>" data-rel="author"></div>
		  </div>
		  
		  <div id="tab-7">
			<div class="g-ytsubscribe" data-channel="<?php echo $youtube_links; ?>"></div>
		  </div>
		  
		  <div id="tab-8">
			<p><?php esc_html_e( 'Follow us', 'revija' ); ?></p><a href="<?php echo $twitter_links; ?>" class="twitter-follow-button" data-show-count="false"><?php esc_html_e( 'Follow @twitter', 'revija' ); ?></a>
		  </div>
		  
		  <div id="tab-9">
			<p><?php esc_html_e( 'Follow us', 'revija' ); ?></p><a data-pin-do="buttonFollow" href="<?php echo $pinterest_links; ?>"><?php esc_html_e( 'Pinterest', 'revija' ); ?></a>
		  </div>
		  
		</div>
		
	
	</div>

	
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>

  <script src="https://apis.google.com/js/platform.js"></script>

  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  <!-- Please call pinit.js only once per page -->
  <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
	
	
		<?php return ob_get_clean();
	}

}

