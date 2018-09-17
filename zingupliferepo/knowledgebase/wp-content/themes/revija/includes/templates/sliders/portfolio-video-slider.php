<!-- - - - - - - - - - - - Slider for Portfolio Video Single - - - - - - - - - - - -->

<?php
if ( get_post_type() == 'portfolio' && is_single() ) {
		$mad_post_id = mad_post_id();
		$custom_links =rwmb_meta('mad_portfolio_video_url', '', $mad_post_id);
		$custom_title =rwmb_meta('mad_portfolio_video_title', '', $mad_post_id);
		
		
	if ( $custom_links != '' ) {
		
		wp_enqueue_script(REVIJA_PREFIX . 'flexslider');
		wp_enqueue_style(REVIJA_PREFIX . 'flexslider');
		
		$title_arr1 = array();
		
		$video_urls = array();
		if ( $custom_links != '' ) {
		//$custom_links = str_replace(" ","",$custom_links);
		$video_urls = explode( ',', $custom_links );
		
		}
		
		$title_arr = array();
		if ( $custom_title != '' ) {
		$title_arr = explode( ',', $custom_title );
		}
		?>
		

<div class="container">
		
		<div class="section">
		<div class="clearfix page_theme">

			<?php echo mad_portfolio_post_meta($mad_post_id); ?>

		</div>
		</div>

		<h2 class="section_title section_title_medium_var2"><?php the_title() ?></h2>
		
		
		
		
	<div class="video_playlist ext  wrapper">

		<div class="flex_container">
            <div id="flexslider" style="height: 420px !important;" >
			
            <ul class="slides">
		
			<?php for ($i=0; $i<count($video_urls); $i++) :?>
			
			<?php
			/** @var WP_Embed $wp_embed  */
			global $wp_embed;

				$video_w = 1140;//( isset( $content_width ) ) ? $content_width : 500;
				$video_h = 420; //1.61 golden ratio
				$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '" height="' . $video_h . '"]' . esc_url($video_urls[$i]) . '[/embed]' );
				
			?>
		
		
		
			<li>
				<div class="iframe_video_container">
				 <div class="wpb_video_wrapper"><?php 
				 
					echo $embed;?>
					
				 </div>
				</div>
			</li>
		
			<?php endfor; ?>
			
			</ul>
			</div>
        </div>
		
		
		
		
		
		 <div class="thumbnails_container type_2">
            <ul>
			
			<?php for ($i=0; $i<count($video_urls); $i++) :?>
		
			<?php
				
				$title_arr1 = explode( '-', $title_arr[$i] );
				$video_title = $title_arr1[0];
				$video_time = $title_arr1[1];
				$image_url = getVideoThumbUrl(esc_url($video_urls[$i]));
			?>
			
			<li class="clearfix">
			  <div class="scale_image_container">
				<img src="<?php echo esc_url($image_url); ?>" alt="" width="105" height="70" >
			  </div>
			  <div class="post_text">
				<h4><?php echo esc_html($video_title); ?></h4>
				<div class="event_date"><?php echo esc_html($video_time); ?></div>
			  </div>
			</li>
			
			<?php endfor; ?>
		
			</ul>
        </div>	
		
	
	</div>
	
</div>	

		
		
	<script type="text/javascript">
	(function($){
	"use strict";

	$(function(){
	$(window).load(function() {
	
	
		if($(".video_playlist #flexslider").length){
			
				function playVideoAndPauseOthers(frame) {
				$('iframe').each(function(i) {
				var func = 'stopVideo';
				this.contentWindow.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
				});
				}
			
			
			
			
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
						
						playVideoAndPauseOthers($('.video_playlist iframe')[0]);
					});
					slshow.find('.flex-prev,.flex-next').on('click',function(){
						var ci = slshow.children('.slides').children('.flex-active-slide').index();
						thumbnails.children('li').eq(ci).addClass('active').siblings().removeClass('active');
						
					
						playVideoAndPauseOthers($('.video_playlist iframe')[0]);
					
					});
				}
			});
		}
 
 
 
 
	});
	});

	})(jQuery);

    </script>
		

		
		
		
		
		
		
		
<?php 
		}		
	}
?>

<!-- - - - - - - - - - - - / Slider for Portfolio Video Single - - - - - - - - - - - -->