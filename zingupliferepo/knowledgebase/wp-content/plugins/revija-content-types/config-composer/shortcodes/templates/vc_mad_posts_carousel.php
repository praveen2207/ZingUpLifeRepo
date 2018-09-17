<?php

class WPBakeryShortCode_VC_mad_posts_carousel extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'title_color' => '#3e454c',
			'url_view_all' => '',
			'post_type' => 'post',
			'img_size' => '555*374',
			'carousel_type' => 'type1',
			'columns' => '1',
			'category' => '',
			'category_portfolio' => '',
			'autoplay' => '',
			'loop' => '',
			'orderby' => '',
			'order' => '',
			'gap' => '',
			'posts_per_page' => 5,
			'el_class' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_posts_carousel');

		$this->query_entries();
		

		wp_enqueue_script(REVIJA_PREFIX_CONT . 'owlcarousel');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'owlcarousel');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'owltheme');
		wp_enqueue_style(REVIJA_PREFIX_CONT . 'owltransitions');
		
		return $this->html();
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

	protected function entry_title($title, $url) {
		$output = "<h3 class='section_title'>";
		if($title != '') {
		$output .= $title;
		}
		$output .= "</h3>";
		if($url != '') {
		$output .= "<a target='_blank' href='". $url ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
		}
	return $output;
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
		
		if (empty($this->entries) || empty($this->entries->posts)) {
			return;
		}
		$css_animation = $items = $gap = $title = $title_color = $carousel_type = $category = $url_view_all = $columns = $autoplay = $img_size = $el_class = '';
		
		extract($this->atts);
		$entries = $this->entries;

		$el_class = $this->getExtraClass( $el_class );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . $el_class . ' ', $this->settings['base'], $this->atts );
		
		$autoplay = ($autoplay) ? 'true' : 'false';
		$loop = ($loop) ? 'true' : 'false';
		
		$animation = $this->getCSSAnimation($css_animation);
		$rand_id = rand();
		
		$resp_0 = 1;
		$resp_481 = 1;
		if($columns == '3') {
			$resp_481 = 2;
		}
		if($columns == '4') {
			$resp_481 = 2;
		}
		if($columns == '5') {
			$resp_481 = 3;
		}
		
		$nav_show = '';
		if( count($this->entries->posts) <= $columns ) {
			$nav_show = 'nav_hide';
		}
		
		ob_start(); ?>

		<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $this->atts ); ?>" >
		
		<div class="mad_post_carousel <?php echo $nav_show; ?> post_carousel_<?php echo $carousel_type; ?> <?php if ($carousel_type == 'type2' || $carousel_type == 'type3') { echo ' photo_gallery '; } if ($carousel_type == 'type1') { echo ' news_gallery news_gallery_var2 '; } ?>  " style="border-color:<?php echo $title_color; ?>; margin-top:<?php echo $gap; ?>px;" >

			<?php if (!empty($title)): ?>
				<?php 
				echo "<h3 class='section_title' style='color:". $title_color ."' >";
				if($title != '') {
					echo $title;
				}
				echo "</h3>";
				if($url_view_all != '') {
				echo "<a target='_blank' href='". $url_view_all ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
				} 
				?>
		
			<?php endif; ?>
		<div class="<?php if ($carousel_type == 'type2' || $carousel_type == 'type4') { echo 'row'; } ?> ">
		
			<div id="owl_custom_<?php echo $rand_id; ?>" class="owl-custom-<?php echo $columns; ?>" >
			
			

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title($id);
						$post_title =  revija_limit_words($post_title, 3);
						$post_content = get_the_content();
					?>

					<?php if ($carousel_type == 'type1') {  ?>
					
					<div <?php post_class('item') ?>>
					
						<?php echo mad_big_blog_post_th_carousel($id, $post_content, $post_title, $img_size); ?>

					</div>

					<?php }  ?>
					
					
					<?php if ($carousel_type == 'type2') {  ?>
					
					<div <?php post_class('item') ?>>
	
							<?php echo mad_blog_post_th_btn($id, $post_content, $post_title, 0, $img_size); ?>
							
							<a href="<?php echo esc_url($link) ?>"><h4 class="second_font" ><?php echo $post_title; ?></h4></a>
							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
	

					</div>

					<?php }  ?>
					
					
					<?php if ($carousel_type == 'type3') {  ?>
					
					<div <?php post_class('item') ?>>
					
					

							<?php echo mad_blog_post_th_btn($id, $post_content, $post_title, 0, $img_size); ?>
							
							<div class="clearfix">
							<?php echo mad_blog_post_meta($id, $entries); ?>
							</div><!--/ .clearfix-->
							
							<div class="post_text">
							
								<?php if (is_sticky($id)): ?>
									<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
								<?php endif; ?>
							
							
							
							
							
							<?php 
							$cat_theme = '';
							$terms = get_the_terms($id, 'label_theme');
							
							if ($terms != '' && ! is_wp_error($terms)){
								foreach($terms as $term) {
								$cat_theme .= '<div class="post_theme">'. $term->name .'</div>';
								}
							}
							echo $cat_theme;
							?>
							
							
			
							
								<h4 class="post_title second_font">
									<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($post_title) ?></a>
								</h4>

							</div><!--/ .post_text-->
							
					

					</div>

					<?php }  ?>
					
					
					<?php if ($carousel_type == 'type4') {  ?>
					
					<div <?php post_class('item') ?>>
					
						<?php echo mad_big_blog_post_th_btn($id, $post_content, $post_title, 19, $img_size); ?>
				
					</div>

					<?php }  ?>
					
					
				<?php endwhile; ?>

		

			</div><!--/ .owl-demo-->
			
			
			
			
				
	<script type="text/javascript">
	(function($){
	"use strict";

		$(function(){
			
		var post_carousel_custom = $("#owl_custom_<?php echo $rand_id; ?>");	
			

			post_carousel_custom.owlCarousel({
			  items : <?php echo $columns; ?>,
			  navSpeed: 800,
			  nav : true,
			  navText:false,
			  loop:<?php echo $loop; ?>,
			  autoplay: <?php echo $autoplay; ?>,
			  autoplaySpeed: 800,
				responsive:{
					0:{
						items:<?php echo $resp_0; ?>
					},
					481:{
						items:<?php echo $resp_481; ?>
					},
					992:{
						items:<?php echo $columns; ?>
					}
				}
			});
		
		});

	})(jQuery);

    </script>		
			
			
			
			
			<?php wp_reset_postdata(); ?>

		</div><!--/ .row-->
		</div><!--/ .post-slider-area-->
		
		</div><!--/ .ell_class-->

		<?php return ob_get_clean();
	}

}