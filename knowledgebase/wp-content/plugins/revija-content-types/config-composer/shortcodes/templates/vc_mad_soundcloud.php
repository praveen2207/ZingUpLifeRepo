<?php

class WPBakeryShortCode_VC_mad_soundcloud extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'type_title' => 'small',
			'url' => ''
		), $atts, 'vc_mad_soundcloud');

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

		
		 <iframe style="width:100%" height="120" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo $url ?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
               
		
		
		<?php return ob_get_clean();
	}

}