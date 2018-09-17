<?php

class WPBakeryShortCode_VC_mad_posts_slider extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$type_slider = '';
	
		$this->atts = shortcode_atts(array(
			'title' => '',
			'type' => 'type1',
			'post_type' => 'post',
			'featured_id' => '',
			'img_size' => '',
			'category' => '',
			'category_portfolio' => '',
			'orderby' => '',
			'order' => '',
			'posts_per_page' => 5,
			'css_animation' => ''
		), $atts, 'vc_mad_posts_slider');

		$type_slider = $this->atts['type'];
		
		$this->query_entries();
		$html = $this->html();
		
		if ($type_slider == 'type1') { 
		wp_enqueue_script(REVIJA_PREFIX_CONT . 'greensock');
		wp_enqueue_script(REVIJA_PREFIX_CONT . 'layerslider_kreaturamedia');
		wp_enqueue_script(REVIJA_PREFIX_CONT . 'layerslider_transitions');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'layerslider');
		}
		
		if ($type_slider == 'type3') { 
		wp_enqueue_script(REVIJA_PREFIX_CONT . 'flexslider');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'flexslider');
		}
		
		return $html;
	}

	public function query_entries() {
		$params = $this->atts;

		$query = array(
			'post_type' => $params['post_type'],
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'post_status' => array('publish')
		);

		if (!empty($params['category']) && $params['post_type'] === 'post') {
			$categories = explode(',', $params['category']);
			$query['category_name'] = $params['category'];
			//$query['category__in'] = $categories;
		}

		if (!empty($params['category_portfolio']) && $params['post_type'] === 'portfolio') {
			//$categories = explode(',', $params['category_portfolio']);
			$categories = explode(',', $params['category_portfolio']);

			$query['tax_query'] = array(
				'relation' => 'IN',
				array(
					'taxonomy' => 'portfolio_categories',
					'field' => 'slug',
					'terms' => $categories,
				)
			);
	
		}

		$query['paged'] = (get_query_var('paged')) ? get_query_var('paged') : get_query_var('page');

		if (!empty($params['posts_per_page'])) {
			$query['posts_per_page'] = $params['posts_per_page'];
		}

		$this->entries = new WP_Query($query);
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

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$type = $css_animation = $category = $category_portfolio = $items = $img_size = $title = '';
		extract($this->atts);
		$entries = $this->entries;

		$animation = $this->getCSSAnimation($css_animation);
		$count = 0;
		
		$image_size = '1140*500';
		if($img_size != '') {
		$image_size = $img_size;
		}
		
		$slideshowSpeed = 5000;
		
		ob_start(); ?>

		<div class="post-slider-home-<?php echo $type ?>">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>

			
			
			<?php if ($type == 'type1') { ?>
			<div id="layerslider" class="section_8 <?php echo (esc_attr($animation)) ? "animate-bottom-to-top" : "" ?>" style="width: 100%; height: 500px;" >

			<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
					$count++;
					
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$thumbnail = '';
						$thumbnail_atts = array(
							'class'	=> "ls-bg",
							'alt'	=> trim(strip_tags(get_the_title())),
							'title'	=> trim(strip_tags(get_the_title()))
						);
						$post_content = get_the_content();
						
						
					if (has_post_thumbnail($id)) {
						$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
					} else {
						$image = mad_regex($post_content, 'image', "");
						if (is_array($image)) {
							$get_image = $image[0];
							$thumbnail = '<img  class="ls-bg" src="'. $get_image .'" alt="'. trim(strip_tags(get_the_title())) .'" />';
						} else {
							$image = mad_regex($post_content, '<img />', "");
							if (is_array($image)) {
								$thumbnail = $image[0];
							} else{
								$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
							}
					
						}
					}
					
					
					$cat = '';
					$terms = get_the_terms($id, 'label');
					
					if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
					$cat = "<div class='buttons_container'>";
						foreach($terms as $term) {
						$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
							
						$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
						}
					$cat .= "</div>";	
					}
					
					?>
			
				<div class="ls-layer slide<?php echo $count; ?>" style="slidedirection: top; slidedelay: 8000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; transition3d: all;"> 
				    
					<?php echo $thumbnail; ?>
					
					<div class="ls-s4  slide-text1" style="position: absolute; top: 50%; right: 0; slidedirection : bottom; slideoutdirection : top;  durationin : 1500; durationout : 1500; easingin: easeInOutQuint; easingout : easeInOutQuint; delayin : 0; delayout : 100; showuntil : 0;">
					  <div class="caption_inner layer_slide_text">
						<div class="clearfix">
						
						  <?php echo $cat; ?>
						  
						  <div class="event_date"> <?php echo get_the_time(get_option('date_format'), $id); ?></div>
						</div>
						<a href="<?php echo esc_url(get_permalink($id)) ?>"><h2 class="second_font"><?php echo esc_attr(get_the_title($id)); ?></h2></a>
					  </div>
					</div>
				</div>
			
			
			<?php endwhile; ?>
			
			<?php wp_reset_postdata(); ?>
			
			</div><!--/ #layerslider-->
			
			
			<script type="text/javascript">
				(function($){
				"use strict";

				$(function(){
					$(window).load(function(){
					
						$('#layerslider').layerSlider({
						  autoStart: false,
						  responsive: true,
						  skinsPath : '',
						  imgPreload : false,
						  navPrevNext: true,
						  navButtons: false,
						  hoverPrevNext: false,
						  responsiveUnder : 940
						});
					
					});

				});

				})(jQuery);

			</script>
			
		<?php } 
		if ($type == 'type2')  { ?>
				
		<div class="clearfix">
        <div class="two_third_column">
		
			<div id="owl-demo-3" class="owl-carousel">
			
			

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title();
						$post_content = get_the_content();
					?>

					<div <?php post_class('item') ?>>
					
					<?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '750*520'); ?>
					
					</div>

				<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

			</div><!--/ .owl-demo-->
		</div>
		
		
		
			<div class="one_third_column one_third_var2">
			<?php 
			if($featured_id != '') {
			$featured_id = explode(',', $featured_id);
			?>
				<?php foreach ($featured_id as $id => $attach_id): 
				$post_content = get_post_field('post_content', $attach_id);
				?>
					<?php echo mad_big_blog_post_th_btn($attach_id, $post_content, get_the_title($attach_id), 0, '555*374'); ?>
				<?php endforeach; ?>
			
			<?php } ?>
			</div>
		
		</div><!--/ .clearfix-->
			
			
			
			
			
			
			
			<?php } 
		if ($type == 'type3')  { ?>
		<div class="wrapper" >
		
		<div class="flex_container">
            <div id="flexslider">
			
              <ul class="slides">
			  <?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title();
						$post_content = get_post_field('post_content', $id);
					?>
					<li <?php post_class('item') ?>>
					
					<?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '750*450'); ?>
					
					</li>
					
			  <?php endwhile; ?>
			 
			  </ul>
			</div>
        </div>
		
		<div class="thumbnails_container">
            <ul>
			<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title();
						$post_content = get_post_field('post_content', $id);
					?>
					<li <?php post_class('clearfix') ?> >
					<?php echo mad_blog_post_th_btn($id, $post_content, $post_title, 0, '165*110'); ?>
					
						<div class="post_text">
						
						    <?php if (is_sticky($id)): ?>
								<?php printf( '<div class="post_theme f_left">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
							<?php endif; ?>
							
							
							<?php 
							$cat_theme = '';
							$terms = get_the_terms($id, 'label_theme');
							
							if ($terms != '' && ! is_wp_error($terms)){
								foreach($terms as $term) {
								$cat_theme .= '<div class="post_theme f_left">'. $term->name .'</div>';
								}
							}
							echo $cat_theme;
							?>
							
							<h4 class="second_font"><?php echo $post_title ?></h4>
							
						  <div class="event_date"> <?php echo get_the_time(get_option('date_format'), $id); ?></div>
						</div>
					</li>
					
			 <?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
			</ul>
		</div>
		
		
		</div><!--/ .wrapper-->	
		
		
		<script type="text/javascript">
			(function($){
			"use strict";

			$(function(){
				// flexslider
				if($("#flexslider").length){
					$("#flexslider").flexslider({
						controlNav:false,
						smoothHeight:true,
						animationSpeed:1000,
						slideshow:false,
						prevText:'',
						keyboard : false,
						nextText:'',
						start:function(el){
							var slshow = el,
								thumbnails = $('.thumbnails_container').children('ul');
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

			});

			})(jQuery);

		</script>
		
		<?php } 
		if ($type == 'type4')  { 
		$count_all = 0;

		?>
				
		<div class="wrapper relative">
       
			<div id="owl-demo-9" class="owl-carousel">
			
			

				<?php while ( $entries->have_posts() ) : $entries->the_post(); 
				$count++;
				$count_all++;
				?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title();
						$post_content = get_the_content();
					?>

					<?php if( $count == 1) { ?>
					<div class="item">
					
						<div class="two_third_column">
						<?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '750*520'); ?>
						</div>
					<?php } ?>
					
						
						<?php if( $count == 2) { ?>
						 <div class="one_third_column one_third_var2">
						    <?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '555*374'); ?>
						<?php } ?>
						
						
						
						<?php if( $count == 3) { ?>
							<?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '555*374'); ?>
						</div>
						<?php } ?>
						
						
						<?php if( $count == 4) { ?>
						 <div class="one_third_column one_third_var2">
						    <?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '555*374'); ?>
						<?php } ?>
						
						
						
						<?php if( $count == 5) { ?>
							<?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 0, '555*374'); ?>
						</div>
						<?php } ?>
						
						
						
						
					
					<?php if( $count == 5 || $count_all == count($entries->posts) ) { ?>
					</div>
					<?php } ?>
					
					
					
					<?php if( $count == 5) { 
					$count = 0;
					}
					?>
					
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			

			</div><!--/ .owl-demo-->
		
		</div><!--/ .wrapper-->	
			
		<?php } 
		if ($type == 'type5')  { 
		?>
		<!--#################################
		  - THEMEPUNCH BANNER -
		#################################-->	
		<div class="tp-banner-container">
			<div class="rev_slider forcefullwidth_wrapper_tp_banner">
				<ul>

				<?php while ( $entries->have_posts() ) : $entries->the_post(); 
				?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title();
						$post_content = get_the_content();
						
						$thumbnail = '';
						$thumbnail_atts = array(
							'class'	=> "",
							'data-bgfit' => "cover",
							'data-bgposition' => "center center",
							'alt'	=> trim(strip_tags($post_title)),
							'title'	=> trim(strip_tags($post_title))
						);
						
						
						if (has_post_thumbnail($id)) {
							$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
						} else {
							$image = mad_regex($post_content, 'image', "");
							if (is_array($image)) {
								$get_image = $image[0];
								$thumbnail = '<img  class="" data-bgfit="cover" data-bgposition="center center" src="'. $get_image .'" alt="'. trim(strip_tags(get_the_title())) .'" />';
							} else {
								$image = mad_regex($post_content, '<img />', "");
								if (is_array($image)) {
									$thumbnail = $image[0];
								} else{
									$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
								}
						
							}
						}
						
						
						
						
						
					$cat = '';
					$terms = get_the_terms($id, 'label');
					
					if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
					$cat = "<div class='buttons_container'>";
						foreach($terms as $term) {
						$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
							
						$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
						}
					$cat .= "</div>";	
					}
						
						
						
						
					?>

					<li data-transition="fade" data-slotamount="10">

						<?php echo $thumbnail; ?>

						
					    <div class="tp-caption lightgrey_sectionider skewfromrightshort fadeout"
						  data-speed="500"
						  data-start="1200"
						  data-easing="Power4.easeOut">
						  <div class="caption_type_1">
							<div class="caption_inner">
							  <div class="container">
								<div class="rev_caption">
								  <div class="clearfix">
									<?php echo $cat; ?>
									 <div class="event_date"> <?php echo get_the_time(get_option('date_format'), $id); ?></div>
								  </div>
								  <a href="<?php echo esc_url(get_permalink()) ?>"><h2 class="second_font"><?php the_title() ?></h2></a>
								</div>
							  </div>
							</div>
						  </div>
						</div>	
		
		
		
					</li>
					
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

				</ul>
			</div>
		</div>	
		
		
		
		<script type="text/javascript">
			(function($){
			"use strict";

			$(function(){
				// rev_slider
				if($(".rev_slider").length){
					
					
					$('.rev_slider').revolution({
						delay:99000,
						startwidth:1170,
						startheight:500,
						hideThumbs:0,
						fullWidth:"on",
						hideTimerBar:"on",
						soloArrowRightHOffset:30,
						soloArrowLeftHOffset:30,
						shadow:0
					  });

					  $('.rev_slider').parent().find('.tp-bullets').remove();
					
					
				} 

			});

			})(jQuery);

		</script>
		
		
		
		<?php } ?>	
			

		</div><!--/ .post-slider-home-->

		
		<?php return ob_get_clean();
	}

}