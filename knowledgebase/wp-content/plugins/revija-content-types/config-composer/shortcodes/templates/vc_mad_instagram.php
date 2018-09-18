<?php

class WPBakeryShortCode_VC_mad_instagram extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'link' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_instagram');

		$this->content = $content;

		//wp_enqueue_script(REVIJA_PREFIX_CONT . 'jribbble');
		
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

		$title = $link = $css_animation = '';

		extract($this->atts);

		if ($link == '') {
			return null;
		}
		$link = trim(vc_value_from_safe($link));
		$animation = $this->getCSSAnimation($css_animation);

		ob_start() ?>
		
		<div class="section widget_instagram">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>
		
			<div class="wrapper">
			<?php echo $link; ?>
            </div>
		
		</div>
		<?php return ob_get_clean();
	}

}