<?php

class WPBakeryShortCode_VC_mad_page_title extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'title_style' => 'big'
		), $atts, 'vc_mad_page_title');

		$this->content = $content;

		return $this->html();
	}

	
	public function html() {

		$title = $title_style = '';

		extract($this->atts);
		
		if ($title == '') {
			return null;
		}
		
	
		if($title_style == 'big') {
		$title = '<div class="text_post_block page_title"><h2 class="section_title section_title_big">'. $title .'</h2></div>';
		} 
		if($title_style == 'medium') {
		$title = '<div class="text_post_block page_title"><h2 class="section_title section_title_medium_var2">'. $title .'</h2></div>';	
		}
		if($title_style == 'small') {
		$title = '<h3 class="section_title page_title section_title_small">'. $title .'</h3>';	
		}
		
		ob_start() ?>
		
		<?php echo $title ?>

		<?php return ob_get_clean();
	}

}