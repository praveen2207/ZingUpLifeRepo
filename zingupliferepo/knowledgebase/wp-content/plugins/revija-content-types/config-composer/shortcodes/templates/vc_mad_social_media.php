<?php

class WPBakeryShortCode_VC_mad_social_media extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'el_class' => '',
			'css_animation' => '',
			'css' => ''
		), $atts, 'vc_mad_social_media');

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

		if (!function_exists( 'get_scp_widget' )) return;
	
		$type = $output = $title = $css = $css_animation = '';

		extract($this->atts);

		$el_class = $this->getExtraClass( $el_class );
		$animations = $this->getExtraClass($this->getCSSAnimation($css_animation));
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section wpb_social_media wpb_content_element' . $el_class . $animations . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $this->atts );

		if (!empty($title)) {
			$title = '<h3 class="section_title">'. $title .'</h3>';
		}

		$page_title = get_the_title();
		$link = get_permalink();
		ob_start() ?>

		<div  class="<?php echo $css_class ?>">
			<?php echo $title; ?>

			<?php echo get_scp_widget(); ?>
			
		</div><!--/ .section-->

		<?php return ob_get_clean();
	}

}




