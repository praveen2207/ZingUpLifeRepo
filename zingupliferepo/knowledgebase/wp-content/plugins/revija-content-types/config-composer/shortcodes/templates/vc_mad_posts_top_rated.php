<?php

class WPBakeryShortCode_VC_mad_posts_top_rated extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
				'title' => '',
				'num_items' => 4,
				'post_type' => 'post',
				'order' => 'DESC',
				'orderby' => '',
				'meta_key' => '',
				'category' => '',
			    'category_portfolio' => '',
				'type_display' => 'type1',
				'sort' => 'bayesian_rating',
				'excerptlength' => '',
				'css_animation' => ''
		), $atts, 'vc_mad_posts_top_rated');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	
	public function query_entries() {
		$params = $this->atts;

		$query = array(
			'post_type' => $params['post_type'],
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'ignore_sticky_posts' => 1,
			'post_status' => array('publish')
		);

		if (!empty($params['orderby']) && $params['orderby'] === 'meta_value_num') {
			$query['meta_key'] = $params['meta_key'];
		}
		
		
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

		if (!empty($params['num_items'])) {
			$query['posts_per_page'] = $params['num_items'];
		}

		$this->entries = new WP_Query($query);
	}
	
	
	
	
	
	protected function entry_title($title) {
		$output = "<h3 class='section_title'>";
		if($title != '') {
		$output .= $title;
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
		if (empty($this->entries) || empty($this->entries->posts)) {
			return;
		}
		
		$title = $type_display = $sort = $order = $excerptlength = $num_items = $date_limit = $css_animation = $items = $post_type = '';
		extract($this->atts);
		$entries = $this->entries;
		
		
		$animation = $this->getCSSAnimation($css_animation);

		global $post;
		$tmp_post = $post;
		$first_post = 1;
		
		ob_start(); 
		?>

		
		<div class="mad_top_rated_widget <?php if ($type_display != 'type4'){ echo 'section photo_gallery'; } ?>  vc_top_rated_<?php echo esc_attr($type_display) ?> <?php echo esc_attr($animation) ?> " >
		
			<?php if (!empty($title) && $type_display != 'type4'): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>
		
		<?php 
		if ($type_display == 'type1') {

			
		while ( $entries->have_posts() ) : $entries->the_post();
				$post_id = get_the_ID();
				$comments_count = get_comments_number();
				$link = get_permalink();
				$title_post = get_the_title($post_id);
				$title_post =  revija_limit_words($title_post, $excerptlength);
				$post_content = get_the_content();
				
				 echo mad_big_blog_post_th_btn($post_id, '', $title_post, 19, '555*374'); 

		endwhile;
		}
		?>	
		
		<?php 
		if ($type_display == 'type2') {
	
			
		echo '<div class="owl-demo-2">';	
		
		while ( $entries->have_posts() ) : $entries->the_post();
		$post_id = get_the_ID();
		$comments_count = get_comments_number();
		$link = get_permalink();
		$title_post = get_the_title($post_id);
		$title_post =  revija_limit_words($title_post, $excerptlength);
		$post_content = get_the_content();

				echo '<div class="item">';
				 
					echo mad_big_blog_post_th_btn($post_id, '', $title_post, 19, '555*374'); 

				echo '</div>';  
				
		endwhile;
		
		echo '</div>'; 
		}
		?>
		
		<?php 
		if ($type_display == 'type3') {
		
		echo '<div class="side_bar_reviews"><ul>';	
		while ( $entries->have_posts() ) : $entries->the_post();
		$post_id = get_the_ID();
		$comments_count = get_comments_number();
		$link = get_permalink();
		$title_post = get_the_title($post_id);
		$title_post =  revija_limit_words($title_post, $excerptlength);
		$post_content = get_the_content();

			echo '<li class="clearfix">';
			 
				echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '165*110');

			 
				echo '<div class="post_text">
					<a href="'. get_permalink($post_id) .'"><h4 class="second_font">'. $title_post .'</h4></a>
					<div class="event_date">'. get_the_time(get_option('date_format'), $post_id) .'</div>
				  </div>'; 
			 
			echo '</li>';  
				
		endwhile;
		 
		echo '</ul></div>'; 
		}
		?>	
			
		
		<?php 
		if ($type_display == 'type4') {
		
		echo '<div class="side_bar_reviews"><ul>';	
		while ( $entries->have_posts() ) : $entries->the_post();
		
		$post_id = get_the_ID();
		$comments_count = get_comments_number();
		$link = get_permalink();
		$title_post = get_the_title($post_id);
		$title_post =  revija_limit_words($title_post, $excerptlength);
		$post_content = get_the_content();

			echo '<li class="clearfix">';
			 
				echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '165*110');

			 
				echo '<div class="post_text">
					<a href="'. get_permalink($post_id) .'"><h4  class="second_font">'. $title_post .'</h4></a>
					<div class="event_date">'. get_the_time(get_option('date_format'), $post_id) .'</div>
				  </div>'; 
			 
			echo '</li>'; 
				
		endwhile;
		
		echo '</ul></div>'; 
		}
		?>	
		
		
		
		</div><!--/ .section-->
		
		
		<?php wp_reset_postdata(); 
				$post = $tmp_post; ?>
		

		<?php return ob_get_clean();
	}

}