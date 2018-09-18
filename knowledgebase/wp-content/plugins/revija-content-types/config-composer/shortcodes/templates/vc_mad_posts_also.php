<?php

class WPBakeryShortCode_VC_mad_posts_also extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'title_color' => '#3e454c',
			'url_view_all' => '',
			'category' => '',
			'orderby' => '',
			'order' => '',
			'gap' => '',
			'show_th' => 'show',
			'items' => 1,
			'posts_per_page' => 5,
			'el_class' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_posts_also');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	public function query_entries() {
		$params = $this->atts;

		$query = array(
			'post_type' => 'post',
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'post_status' => array('publish')
		);

		if (!empty($params['category'])) {
			$categories = explode(',', $params['category']);
			$query['label'] = $params['category'];
			//$query['category__in'] = $categories;
		}

		//$query['paged'] = (get_query_var('paged')) ? get_query_var('paged') : get_query_var('page');

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
		
		if($url != '') {
		$output .= "<a target='_blank' href='". $url ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
		}
		
		$output .= "</h3>";
		
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

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$css_animation = $items = $title = $title_color = $gap = $url_view_all = $el_class = '';
		$entries = $this->entries;
		extract($this->atts);

		$el_class = $this->getExtraClass( $el_class );
		$animation = $this->getCSSAnimation($css_animation);

		$count_label = 1;
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section_also ' . $el_class . ' ', $this->settings['base'], $this->atts );
		
		ob_start(); ?>

		<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $this->atts ) ?>" style="margin-top:<?php echo $gap; ?>px;" >

			<?php if (!empty($title)): ?>
				<?php 
				echo "<h3 class='section_title' style='border-color:". $title_color ."; color:". $title_color ."' >";
				if($title != '') {
				echo $title;
				}
				
				if($url_view_all != '') {
				echo "<a target='_blank' href='". $url_view_all ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
				}
				
				echo "</h3>"; 
				?>	
			<?php endif; ?>

			<?php 
			$class = 'small_post_list vertical_post_list';
			if ( $show_th=='hide' ) {
				$class = 'comments_list comments_list_var2';
			}?>
			
			
			<ul class="<?php echo $class; ?>" >

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$num = (float)get_post_meta($id, 'rating', true);
						
						
						$post_format = get_post_format($id) ? get_post_format($id) : 'standard';
						$icon_type = 'fa-file-text';
						if($post_format == 'standard') {
							$icon_type = 'fa-file-text';
						}
						if($post_format == 'gallery') {
							$icon_type = 'fa-picture-o';
						}
						if($post_format == 'video') {
							$icon_type = 'fa-video-camera';
						}
						if($post_format == 'audio') {
							$icon_type = 'fa-volume-up';
						}
						if($post_format == 'quote') {
							$icon_type = 'fa-quote-left';
						}
						
						$cat = '';
						$terms = get_the_terms($id, 'label');
						
					
						if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
							
							 if( count($terms) > $count_label ) {
							  $terms = array_slice($terms, 0, $count_label);
							 }
							
							foreach($terms as $term) {
							$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
								
							$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
							}
						}
						
						
						$canvas = '';
						if (mad_custom_get_option('blog-listing-meta-ratings') && $num > 0 ) {
						$canvas = "<div class='canvas canvas_small'><div class='circle' id='also-post-circles-". $id ."'></div><br /></div>";		
						}
						
						
						$icon_box = '';
						
						if ($icon_type != '' && ! is_wp_error($icon_type)){
						$icon_box = '<a href="#" class="icon_box"><i class="fa '.$icon_type.'"></i></a>';
						}
						
					?>

					<li <?php post_class('post-item') ?>>

						<?php if ( has_post_thumbnail() && $show_th=='show' ): ?>

							<?php
								$thumbnail_atts = array(
									'class'	=> "scale_image",
									'alt'	=> trim(strip_tags(get_the_title())),
									'title'	=> trim(strip_tags(get_the_title()))
								);
								$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, '165*110', $thumbnail_atts);
								$title = sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0'));
							?>

							<div class="scale_image_container">
								<a href="<?php echo esc_url($link) ?>" title="<?php echo esc_attr($title) ?>" class="single-image <?php echo (esc_attr($animation)) ? "animate-bottom-to-top" : "" ?>">
									<?php echo $thumbnail ?>
								</a>
								<div class="post_image_buttons">
									<?php echo $cat; ?>
									<?php echo $icon_box; ?>
								</div>
								<?php echo $canvas; ?>
								
							<?php
							if (mad_custom_get_option('blog-listing-meta-ratings')) {
								$radius = 14;
								
								echo '<script type="text/javascript">
								var colors = [["#fa985d", "#ffffff"]], circles = [];
								var child = document.getElementById("also-post-circles-'. $id .'");
								if(child) {
								circles.push(Circles.create({
									id:         child.id,
									value:      '.$num.',
									radius:     '.$radius.',
									width:      3,
									maxValue:   10,
									duration:   1000,
									text:       function(value){return value;},
									colors:    ["#fa985d", "#ffffff"]
								}));
								}
								</script>';
							}
							 ?>	
							</div><!--/ .scale_image_container-->

						<?php endif; ?>

							<a href="<?php echo $link ?>">
								<h4 class="also-title second_font">
									<?php the_title() ?>
								</h4>
							</a>
							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>

					</li><!--/ .post-item-->

				<?php endwhile; ?>

			</ul><!--/ .post-carousel-->

			<?php wp_reset_postdata(); ?>

		</div><!--/ .post-slider-area-->

		<?php return ob_get_clean();
	}

}