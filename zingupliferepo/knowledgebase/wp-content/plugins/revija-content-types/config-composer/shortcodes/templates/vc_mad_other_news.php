<?php

class WPBakeryShortCode_VC_mad_other_news extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'category' => '',
			'orderby' => '',
			'order' => '',
			'gap' => '',
			'items' => 1,
			'posts_per_page' => 5,
			'css_animation' => ''
		), $atts, 'vc_mad_other_news');

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
			$query['category__in'] = $categories;
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

		$css_animation = $items = $gap = $title = '';
		$entries = $this->entries;
		extract($this->atts);

		global $post;
		$tmp_post = $post;
		$count_label = 1;
		$animation = $this->getCSSAnimation($css_animation);

		ob_start(); ?>

		<div class="post_var_inline other_news_post" style="margin-top:<?php echo $gap; ?>px;" >

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>

			<?php 
			$class = 'small_post_list';
			?>
			
			
			<ul class="<?php echo $class; ?>" >

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$num = (float)get_post_meta($id, 'rating', true);
						
						$post_content = !empty($post->post_excerpt) ? $post->post_excerpt : mad_post_content_truncate($post->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');
						$title = $post->post_title;
				
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
						$canvas = "<div class='canvas canvas_small'>
									<div class='circle' id='also-post-circles-". $id ."'></div>
									<br />
								</div>";		
						}
						
						
						$icon_box = '';
						
						if ($icon_type != '' && ! is_wp_error($icon_type)){
						$icon_box = '<a href="#" class="icon_box">
											  <i class="fa '.$icon_type.'"></i>
											</a>';
						}
						
					?>

					<li <?php post_class('clearfix') ?>>

						<?php if ( has_post_thumbnail() ): ?>

							<?php
								$thumbnail_atts = array(
									'class'	=> "scale_image",
									'alt'	=> trim(strip_tags($title)),
									'title'	=> trim(strip_tags($title))
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
								
								echo '
								<script type="text/javascript">
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

						
						<div class="wrapper">
							
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
									<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
								</h4>

								<?php echo (!empty($post_content)) ? "<p>{$post_content}</p>" : ''; ?>

							</div><!--/ .post_text-->
						
						</div>	
							
							
					</li><!--/ .post-item-->

				<?php endwhile; ?>

			</ul><!--/ .post-carousel-->

			<?php wp_reset_postdata(); 
			$post = $tmp_post;
			?>

		</div><!--/ .post-slider-area-->

		<?php return ob_get_clean();
	}

}