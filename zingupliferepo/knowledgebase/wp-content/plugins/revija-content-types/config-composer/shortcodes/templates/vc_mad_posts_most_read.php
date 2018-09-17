<?php

class WPBakeryShortCode_VC_mad_posts_most_read extends WPBakeryShortCode {

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
			'order' => '',
			'gap' => '',
			'type' => 'type1',
			'posts_per_page' => 4,
			'css_animation' => ''
		), $atts, 'vc_mad_posts_most_read');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	public function query_entries() {
		$params = $this->atts;

		$query = array(
			'post_type' => 'post',
			'meta_key' => 'post_views_count',
			'orderby'  => 'meta_value_num',
			'order' => $params['order'],
			'post_status' => array('publish')
		);

		if (!empty($params['category'])) {
			$categories = explode(',', $params['category']);
			$query['category_name'] = $params['category'];
			//$query['category__in'] = $categories;
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

		$css_animation = $items = $type = $gap = $title = $title_color = $url_view_all = $posts_per_page = '';
		$entries = $this->entries;
		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		global $post;
		$tmp_post = $post;
		$first_post = 1;
		
		ob_start(); 
		?>

		
		<?php if ($type == 'type1') { ?>
		
		<div class=" section_post_left mad_posts_most_read mad_posts_most_read_type1"  style="margin-top:<?php echo $gap; ?>px;" >

			<?php if (!empty($title)): ?>
				<?php 
					echo "<h3 class='section_title'  style='border-color:". $title_color ."; color:". $title_color ."' >";
					if($title != '') {
					echo $title;
					}
					if($url_view_all != '') {
					echo "<a target='_blank' href='". $url_view_all ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
					}
					echo "</h3>";
					?>
			<?php endif; ?>

			

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$link = get_permalink();
						$id = get_the_ID();
						$post_content = !empty($post->post_excerpt) ? $post->post_excerpt : mad_post_content_truncate($post->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');
						$title = $post->post_title;
						
						$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
					?>

					
					
					<?php if($first_post == 1) { ?>
					
					<div <?php post_class('') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, '555*374'); ?>

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
							
							
							
							
							
							
							
							<h2 class="post_title second_font">
								<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
							</h2>

							<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

						</div><!--/ .post_text-->
						
					</div>
					
					
					
					<ul class="post_list">
					
					<?php } else { ?>
					
					<li <?php post_class('clearfix') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, '165*110'); ?>

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
							
							
							
							
							
							<a href="<?php echo esc_url($link) ?>">
							<h4 class="second_font">
								<?php echo esc_html($title) ?>
							</h4></a>

							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
							
						</div><!--/ .post_text-->
						
					</li>

					<?php } ?>

				<?php 
				$first_post++;
				endwhile; ?>

					</ul><!--/ .post_list-->

			
			
			<?php wp_reset_postdata(); 
				$post = $tmp_post; ?>

		</div><!--/ .section_post_left-->

		<?php } 
		
		if ($type == 'type2')  { ?>

		<div class=" mad_posts_most_read mad_posts_most_read_type2"  style="margin-top:<?php echo $gap; ?>px;" >

			<?php if (!empty($title)): ?>
				<?php 
					echo "<h3 class='section_title'  style='border-color:". $title_color ."; color:". $title_color ."' >";
					if($title != '') {
					echo $title;
					}
					if($url_view_all != '') {
					echo "<a target='_blank' href='". $url_view_all ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
					}
					echo "</h3>";
					?>
			<?php endif; ?>

			<ul class="small_post_list vertical_post_list">

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$link = get_permalink();
						$id = get_the_ID();
						$post_content = !empty($post->post_excerpt) ? $post->post_excerpt : mad_post_content_truncate($post->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');
						$title = $post->post_title;
					?>
		
				
		
					<li <?php post_class() ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, '165*110'); ?>

						<a href="<?php echo esc_url($link) ?>">
						<h4 class="second_font">
							<?php echo esc_html($title) ?>
						</h4></a>

						<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
		
					</li>
				
				
				<?php 
				$first_post++;
				endwhile; ?>

				</ul><!--/ .small_post_list-->	

			
			
				<?php wp_reset_postdata(); 
				$post = $tmp_post; ?>
				
		</div><!--/ .section-->
		
		
		<?php } 
		if ($type == 'type3')  { ?>
		
		<div class=" mad_posts_most_read mad_posts_most_read_type3"  style="margin-top:<?php echo $gap; ?>px;" >

				<?php if (!empty($title)): ?>
					<?php 
					echo "<h3 class='section_title'  style='border-color:". $title_color ."; color:". $title_color ."' >";
					if($title != '') {
					echo $title;
					}
					if($url_view_all != '') {
					echo "<a target='_blank' href='". $url_view_all ."' class='button button_grey view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
					}
					echo "</h3>";
					?>
				<?php endif; ?>

			<ul class="circle_list">

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$link = get_permalink();
						$id = get_the_ID();
						$title = $post->post_title;
					?>
		
				
		
					<li>
						<h4 class="second_font">
						<a href="<?php echo esc_url($link) ?>">
							<?php echo esc_html($title) ?>
						</a>
						</h4>
					</li>
				
				
				<?php endwhile; ?>

			</ul><!--/ .small_post_list-->		

			
			
				<?php wp_reset_postdata(); 
				$post = $tmp_post; ?>
		
		</div><!--/ .section-->
		
		<?php } ?>
		
		
		<?php return ob_get_clean();
	}

}