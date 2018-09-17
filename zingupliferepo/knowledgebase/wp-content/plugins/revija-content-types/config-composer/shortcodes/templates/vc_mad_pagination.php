<?php

class WPBakeryShortCode_VC_mad_pagination extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => ''
		), $atts, 'vc_mad_pagination');

		$this->content = $content;

		return $this->html();
	}

	
	public function html() {

		$title = '';

		extract($this->atts);

		if (!empty($title)) {
			$title = '<h3 class="section_title section_title_medium">'. $title .'</h3>';
		}

		ob_start() ?>
		
		<div class="section_2">
		<?php echo $title ?>

		 <div class="pagination_block var2">
			<span>Page 1 of 4</span>
			<ul class="pagination clearfix">
			 <li><a href="#" class="active">1</a></li>
			 <li><a href="#">2</a></li>
			 <li><a href="#">3</a></li>
			 <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
			</ul>
		 </div>
		
		 </div>
		
		<?php return ob_get_clean();
	}

}