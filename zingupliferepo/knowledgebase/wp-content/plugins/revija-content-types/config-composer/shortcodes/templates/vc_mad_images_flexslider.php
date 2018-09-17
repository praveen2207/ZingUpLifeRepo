<?php
class WPBakeryShortCode_VC_mad_images_flexslider extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'onclick' => 'link_image',
			'custom_links' => '',
			'images_title' => '',
			'custom_links_target' => '',
			'images' => '',
			'el_class' => '',
			'autoplay' => '',
			'autoplaytimeout' => 5000,
			'speed' => 1000,
			'css_animation' => ''
		), $atts, 'vc_mad_images_flexslider');

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

		$title = $onclick = $custom_links = $custom_links_target = $images_title = $images = $el_class = $autoplay = $autoplaytimeout = $speed = $css_animation = '';

		extract($this->atts);

		$el_class = $this->getExtraClass( $el_class );
		$animations = $this->getExtraClass($this->getCSSAnimation($css_animation));

		
		
		if ( $images == '' ) $images = '-1,-2,-3';
			$images = explode( ',', $images );

		if ( $onclick == 'custom_link' ) {
			$custom_links = explode( ',', $custom_links );
		}
		
		
		$images_title = explode( ',', $images_title );
		
		$lightbox_random = $onclick == 'link_image' ? ' data-group="carousel-'. rand(). '"' : '';

		$i = 0;
		$k = 0;
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'gallery_post ' . $el_class . ' vc_clearfix', $this->settings['base'], $this->atts );

	ob_start(); ?>

	<?php echo  wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading section-title' ) ) ?>

	<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $this->atts ) ?>">

		
		<div id="slider" class="flexslider">
            <ul class="slides">
		
			<?php foreach ( $images as $attach_id ): ?>
			
			<?php
				$images_title1 = $images_title[$i];
				$i++;
				
				if ( $attach_id > 0 ) {
					$post_thumbnail = array();
					$thumbnail_atts = array(
						'class'	=> "tr_all_long_hover",
						'alt'	=> esc_attr($images_title1),
						'title'	=> esc_attr($images_title1)
					);
					$post_thumbnail['thumbnail'] = REVIJA_HELPER::get_the_thumbnail($attach_id, '750*374', $thumbnail_atts);
					$post_thumbnail['img_large'] = REVIJA_HELPER::get_post_attachment_image($attach_id, '');
				} else {
					$post_thumbnail = array();
					$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
					$post_thumbnail['img_large'] = vc_asset_url( 'vc/no_image.png' );
				}
				$thumbnail = $post_thumbnail['thumbnail'];
				$img_large = $post_thumbnail['img_large'];
				
			?>
		
		
			<li>
			  <div>
			    <?php echo $thumbnail; ?>
				<!--caption-->
				<div class="caption_type_1">
				  <div class="caption_inner">
					<div class="clearfix">
					  <div class="f_left">
						<a href="<?php echo esc_url($custom_links[$i-1]) ?>" <?php echo ( ! empty( $custom_links_target ) ? ' target="' . esc_attr($custom_links_target) . '"' : '' ) ?> >
						<h5><?php echo $images_title1; ?></h5>
						</a>
					  </div>
					  <div class="f_right"><?php echo $i; ?>/<?php echo count($images); ?></div>
					</div>
				  </div>
				</div>
				<a href="<?php echo esc_url($img_large)  ?>" role="button" class="jackbox jackbox_button button button_grey_light" data-group="gallery_1"><i class="fa fa-expand"></i></a>
			  </div>
			</li>
		
		
			<?php endforeach; ?>
			
			</ul>
        </div>
		
		
		
		
		
		<div id="carousel" class="flexslider">
            <ul class="slides">
			
			<?php foreach ( $images as $attach_id ): ?>
		
			<?php
				$k ++;
				$images_title = '';
				if ( $attach_id > 0 ) {
					$post_thumbnail = array();
					$thumbnail_atts = array(
						'class'	=> "tr_all_long_hover",
						'alt'	=> '',
						'title'	=> ''
					);
					$post_thumbnail['thumbnail'] = REVIJA_HELPER::get_the_thumbnail($attach_id, '90*60', $thumbnail_atts);
					$post_thumbnail['img_large'] = REVIJA_HELPER::get_post_attachment_image($attach_id, '');
				} else {
					$post_thumbnail = array();
					$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
					$post_thumbnail['img_large'] = vc_asset_url( 'vc/no_image.png' );
				}
				$thumbnail = $post_thumbnail['thumbnail'];
				$img_large = $post_thumbnail['img_large'];
			?>
			
			<li>
			 <?php echo $thumbnail; ?>
			</li>
			
			<?php endforeach; ?>
		
		
			
		
		
			</ul>
        </div>		
	
	</div>	<?php echo $this->endBlockComment('/ .gallery_post') ?>
		

		
	<script type="text/javascript">
	(function($){
	"use strict";

	$(function(){
		// flexslider-2

		// The slider being synced must be initialized first
		$('#carousel').flexslider({
		  animation: "slide",
		  controlNav: false,
		  directionNav: false,
		  animationLoop: false,
		  slideshow: false,
		  prevText:'',
		  nextText:'',
		  itemWidth: 100,
		  asNavFor: '#slider'
		});

		$('#slider').flexslider({
		  animation: "slide",
		  controlNav: false,
		  animationLoop: false,
		  animationSpeed: 1000,
		  prevText:'',
		  nextText:'',
		  slideshow: false,
		  sync: "#carousel"
		});  

	});

	})(jQuery);

    </script>
		

	<?php return ob_get_clean();
	}



}