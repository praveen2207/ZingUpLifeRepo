<?php

class WPBakeryShortCode_VC_mad_facebook_likebox extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'width' => '350',
			'height' => '300',
			'titleurl' => '',
			'connection' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_facebook_likebox');

		$this->content = $content;
		
		return $this->html();
	}
	
	public function getCSSAnimation($css_animation) {
		$output = false;
		if ( $css_animation == 'yes' ) {
			wp_enqueue_script('waypoints');
			$output = true;
		}
		return $output;
	}
	
	public function html() {
		$title = $width = $height = $titleurl = $connection = $css_animation = '';

		extract($this->atts);

		$this->atts['profile_id'] = $titleurl;
		$this->atts['width'] = $width;
		$this->atts['height'] = $height;
		$this->atts['streams'] = 'no';
		$this->atts['header'] = 'false';
		$this->atts['facebook_likebox_theme'] = 'dark';
		$this->atts['connections'] = $connection;
		
		$animation = $this->getCSSAnimation($css_animation);

		$type = 'revija_like_box_facebook';
		$args = array();
		$mad_widget_args = array(
			'before_widget' => '<div id="facebook_likebox" class="section widget facebook_likebox_widget"  >',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-head"><h3 class="section_title">',
			'after_title' => '</h3></div>'
		);

		ob_start() ?>

		<?php the_widget( $type, $this->atts, $mad_widget_args ); ?>

		<?php return ob_get_clean();
	}

}