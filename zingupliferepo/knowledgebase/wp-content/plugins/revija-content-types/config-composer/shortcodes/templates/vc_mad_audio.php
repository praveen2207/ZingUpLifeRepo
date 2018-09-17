<?php

class WPBakeryShortCode_VC_mad_audio extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'type_title' => 'small',
			'url' => ''
		), $atts, 'vc_mad_audio');

		$this->content = $content;

		return $this->html();
	}

	
	public function html() {

		$title = '';

		extract($this->atts);

		if (!empty($title)) {
			if($type_title == 'small') {
			$title = '<h3 class="section_title section_title_small">'. $title .'</h3>';
			} else {
				$title = '<h3 class="section_title section_title_medium">'. $title .'</h3>';
			}
		}

		ob_start() ?>
		
		<?php echo $title ?>

		 <div class="text_post_section">
		  <div class="audioplayer1">
			<audio preload="auto" controls>
			  <source src="<?php echo $url ?>" type="audio/mpeg">
			  <source src="<?php echo $url ?>" type="audio/ogg">
			  <source src="<?php echo $url ?>" type="audio/wav">
			</audio>
		  </div>  
		</div>
		
		
		
		<?php return ob_get_clean();
	}

}