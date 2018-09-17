<?php

class WPBakeryShortCode_VC_mad_tweets extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'playerid' => '',
			'num' => 3,
			'css_animation' => ''
		), $atts, 'vc_mad_tweets');

		$this->content = $content;

		return $this->html();
	}

	protected function entry_title($title) {
		return "<h3 class='section_title'>" . $title . "</h3>";
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

		$title = $playerid = $css_animation = $num = '';

		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		$type = 'Latest_Tweets_Widget';
		$args = array();
		$mad_widget_args = array(
			'before_widget' => '<div id="widget_tweets" class="section widget widget_tweets">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-head"><h3 class="section_title">',
			'after_title' => '</h3></div>'
		);
		
		
		ob_start() ?>

		
		<?php the_widget( $type, $this->atts, $mad_widget_args ); ?>
			
		
		
		<?php return ob_get_clean();
	}

}