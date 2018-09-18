<?php

class WPBakeryShortCode_VC_mad_blockquotes extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title_block' => '',
			'title' => ''
		), $atts, 'vc_mad_blockquotes');

		$this->content = $content;

		return $this->html();
	}

	protected function entry_title($title) {
		return "<h3 class='section_title section_title_medium'>". $title ."</h3>";
	}
	
	public function html() {

		$title = $title_block = '';

		extract($this->atts);

		if (!empty($title)) {
			$title = '<div class="blockquotes_title">'. $title .'</div>';
		}

		ob_start() ?>
            
		<?php echo (!empty($title_block)) ? $this->entry_title($title_block) : ""; ?>
			
		<div class="blockquotes">
		 <div><?php echo $this->content; ?></div>
		<?php echo $title; ?>
		</div>
		

		<?php return ob_get_clean();
	}

}