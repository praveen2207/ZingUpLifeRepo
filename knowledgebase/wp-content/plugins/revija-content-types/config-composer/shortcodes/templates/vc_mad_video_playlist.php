<?php
class WPBakeryShortCode_VC_mad_video_playlist extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'custom_links' => '',
			'images_title' => '',
			'type_video' => '',
			'el_class' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_video_playlist');

		wp_enqueue_script(REVIJA_PREFIX_CONT . 'flexslider');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'flexslider');
		
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

	private function html() {

		$title = $custom_links = $images_title = $type_video = $el_class = $css_animation = '';

		extract($this->atts);

		$el_class = $this->getExtraClass( $el_class );
		$animations = $this->getExtraClass($this->getCSSAnimation($css_animation));

		$video_urls = array();

		if ( $custom_links != '' ) {
		$custom_links = explode( ',', $custom_links );
		}
		
		if ( $images_title != '' ) {
		$images_title = explode( ',', $images_title );
		}

	
		if($type_video == 'type2') {
			$el_class .= ' flex_playlist ';
		}
		if($type_video == 'type3') {
			$el_class .= ' flex_playlist ';
		}

		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'video_playlist wrapper  ' . $type_video . ' ' . $el_class . ' vc_clearfix', $this->settings['base'], $this->atts );

	ob_start(); ?>

	<?php echo  wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading section-title' ) ) ?>

	<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $this->atts ) ?>">

		
		
		
		
		<div class="flex_container">
            <div id="flexslider" style="height: 420px !important;" >
			
            <ul class="slides">
		
			<?php for ($i=0; $i<count($custom_links); $i++) :?>
			
			<?php
			/** @var WP_Embed $wp_embed  */
			global $wp_embed;

				$video_w = 1140;//( isset( $content_width ) ) ? $content_width : 500;
				$video_h = 420; //1.61 golden ratio
				$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '" height="' . $video_h . '"]' . esc_url($custom_links[$i]) . '[/embed]' );
				
			?>
		
		
			<li>
				<div class="iframe_video_container">
				 <div class="wpb_video_wrapper"><?php echo $embed;?></div>
				</div>
			</li>
		
		
			<?php endfor; ?>
			
			</ul>
			</div>
        </div>
		
		
		
		<?php if($type_video != 'type3') { ?>
		
		 <div class="thumbnails_container type_2">
            <ul>
			
			<?php for ($i=0; $i<count($custom_links); $i++) :?>
		
			<?php
				$title_arr1 = explode( '-', $images_title[$i] );
				$video_title = $title_arr1[0];
				$video_time = $title_arr1[1];
				
				$image_url = getVideoThumbUrl(esc_url($custom_links[$i]));
			?>
			
			<li class="clearfix">
			  <div class="scale_image_container">
				<img src="<?php echo $image_url;?>" alt="" width="105" height="70" >
			  </div>
			  <div class="post_text">
				<h4><?php echo $video_title;?></h4>
				<div class="event_date"><?php echo $video_time; ?></div>
			  </div>
			</li>
			
			<?php endfor; ?>
		
			</ul>
        </div>	
		<?php } ?>
	
	
	
	</div>	<?php echo $this->endBlockComment('/ .gallery_post') ?>
		

		
	<script type="text/javascript">
	(function($){
	"use strict";

	$(function(){

	
	
	<?php if($type_video != 'type3') {?>
	   // flexslider	
		if($(".video_playlist #flexslider").length){
			$(".video_playlist #flexslider").flexslider({
				controlNav:false,
				smoothHeight:true,
				animationSpeed:1000,
				slideshow:false,
				prevText:'',
				keyboard : false,
				nextText:'',
				start:function(el){
					var slshow = el,
						thumbnails = $('.video_playlist .thumbnails_container').children('ul');
					slshow.find('.flex-direction-nav a').addClass('flex_nav_buttons');
					var currIndex = slshow.data('flexslider').currentSlide;
					thumbnails.children('li').eq(currIndex).addClass('active');
					thumbnails.children('li').on('click',function(){
						var self = $(this),
							index = self.index();
						self.addClass('active').siblings().removeClass('active');
						slshow.data('flexslider').flexAnimate(index);
					});
					slshow.find('.flex-prev,.flex-next').on('click',function(){
						var ci = slshow.children('.slides').children('.flex-active-slide').index();
						thumbnails.children('li').eq(ci).addClass('active').siblings().removeClass('active');
					});
				}
			});
		}
	<?php } else { ?>
		

	
	
	$('.video_playlist #flexslider').flexslider({
		  animation: "slide",
		  controlNav: false,
		  animationLoop: false,
		  animationSpeed: 1000,
		  prevText:'',
		  nextText:'',
		  slideshow: false
		});  
	
	
	
	<?php }  ?>

	});

	})(jQuery);

    </script>
		

	<?php return ob_get_clean();
	}



}