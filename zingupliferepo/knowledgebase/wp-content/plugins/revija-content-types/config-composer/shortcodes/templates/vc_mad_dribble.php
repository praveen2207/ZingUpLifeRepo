<?php

class WPBakeryShortCode_VC_mad_dribbble extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'playerid' => '',
			'type_slider' => 1,
			'css_animation' => ''
		), $atts, 'vc_mad_dribbble');

		$this->content = $content;

		wp_enqueue_script(REVIJA_PREFIX_CONT . 'jribbble');
		wp_enqueue_script(REVIJA_PREFIX_CONT . 'owlcarousel');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'owlcarousel');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'owltheme');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'owltransitions');
		
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

		$title = $playerid = $css_animation = $type_slider = '';

		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		ob_start() ?>
		
		<div class="section widget_dribbble">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>
		
			<div id="owl-dribbble">
            </div>
		
			<script type="text/javascript">
			(function($){
				"use strict";

			$(function(){

				$(window).load(function(){
			
				
				var playerid = '<?php echo $playerid; ?>';
			
				$.jribbble.getShotsByPlayerId(playerid, function (work) {

				  $.each(work.shots, function(x, shot) {
					$('#owl-dribbble').append($('<div>', {'class': 'item', 'html': '<a href="' + shot.url + '"><img src="' + shot.image_teaser_url + '" alt="' + shot.title + '"></a>'}));
				  });

				  // Gallery carousel-7

				  $("#owl-dribbble").owlCarousel({
					  items : <?php echo $type_slider; ?>,
					  slideSpeed : 800,
					  paginationSpeed : 800,
					  nav: true,
					  margin : 10,
					  navText:false,
					  autoplay:false,
					  loop: true,
					  navRewind: true
					});
				  }, {page: 2, per_page: 8});
				  
				  
				  
				  });
				  
			});

			})(jQuery);	
			</script>
		
		</div>
		<?php return ob_get_clean();
	}

}