<?php

class WPBakeryShortCode_VC_mad_newsletter extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'mailchimp_intro' => 'Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!'
		), $atts, 'vc_mad_newsletter');

		$this->content = $content;

		wp_enqueue_script( 'newsletter-widget', REVIJA_INCLUDES_URI . 'widgets/mailchimp/js/newsletter.js', array('jquery'), '', true );

		return $this->html();
	}

	
	public function html() {
		$title = $mailchimp_intro = '';

		extract($this->atts);

		

		ob_start() ?>
		
		
			<?php  
			$type = 'mad_widget_mailchimp';
			
			$this->atts['style_type'] = 'button_grey';
			
			$mad_widget_args = array(
				'before_widget' => '<div id="wp_newsletter_widget" class="section widget widget_zn_mailchimp">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-head"><h3 class="section_title">',
				'after_title' => '</h3></div>'
			);
			the_widget( $type, $this->atts, $mad_widget_args ); ?>
	
		
		<?php return ob_get_clean();
	}

}