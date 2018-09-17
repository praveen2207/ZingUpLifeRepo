<?php

class WPBakeryShortCode_VC_mad_portfolio extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'layout' => 'grid',
			'categories' => array(),
			'orderby' => 'date',
			'order' => 'DESC',
			'columns' 	=> '2',
			'size_head' 	=> 'big',
			'type_title' 	=> 'big',
			'items' 	=> '6',
			'sort' 		=> 'no',
			'pagination' => 'no',
			'image_size' => '750*374',
			'taxonomy'  => 'portfolio_categories',
			'class'		=> "",
			'related' => "",
			'css_animation' => ''
		), $atts, 'vc_mad_portfolio');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	public function getCSSAnimation($css_animation) {
		$output = '';
		if ( $css_animation != '' ) {
			wp_enqueue_script('waypoints');
			$output = ' animate-' . $css_animation;
		}
		return $output;
	}

	public function query_entries() {
		global $post;

		$this_id = $post->ID;
		$params = $this->atts;
		$tag_ids = $tax_query = array();
		$tags = wp_get_post_tags($this_id);

		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		if (!$page || $params['pagination'] == 'no') $page = 1;

		if (!empty($params['categories'])) {
			$categories = explode(',', $params['categories']);
			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'portfolio_categories',
					'field' => 'slug',
					'terms' => $categories
				)
			);
		}

		$query = array(
			'post_type' => 'portfolio',
			'posts_per_page' => $params['items'],
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'paged' => $page,
			'tax_query' => $tax_query
		);

		if ($params['related'] == 'yes') {
			if (!empty($tags) && is_array($tags)) {
				foreach ($tags as $tag ) {
					$tag_ids[] = (int) $tag->term_id;
				}
			}
			if (!empty($tag_ids)) {
				$query['tag__in'] = $tag_ids;
			}
			$query['post__not_in'] = array($this_id);
		}

		$this->entries = new WP_Query($query);
	}

	
	protected function sort_links($entries, $params) {

		$categories = get_categories(array(
			'taxonomy'	=> $params['taxonomy'],
			'hide_empty'=> 0
		));
		$current_cats = array();
		$display_cats = is_array($params['categories']) ? $params['categories'] : array_filter(explode(',', $params['categories']));

		foreach ($entries as $entry) {
			if ($current_item_cats = get_the_terms( $entry->ID, $params['taxonomy'] )) {
				if (!empty($current_item_cats)) {
					foreach ($current_item_cats as $current_item_cat) {
						if (empty($display_cats) || in_array($current_item_cat->term_id, $display_cats)) {
							$current_cats[$current_item_cat->term_id] = $current_item_cat->term_id;
						}
					}
				}
			}
		}

		ob_start(); ?>

			<select class="portfolio_filter">

				<option value="*"><?php esc_html_e('Sort Porfolio...', 'revija') ?></option>
				<option data-filter="*" value="*"><?php esc_html_e('All', 'revija') ?></option>

				<?php foreach ($categories as $category): ?>
					<?php if (in_array($category->term_id, $current_cats)): ?>
						<?php $nicename = $category->category_nicename ?>
						<option data-filter=".<?php echo esc_attr($nicename) ?>" value=".<?php echo esc_attr($nicename) ?>" class="<?php echo esc_attr($nicename); ?>">
							<?php echo esc_html(trim($category->cat_name)); ?>
						</option>
					<?php endif; ?>
				<?php endforeach; ?>

			</select><!--/ .portfolio_filter-->

		<?php return ob_get_clean();
	}

	protected function getTerms($id, $params, $slug) {
		$classes = "";
		$item_categories = get_the_terms($id, $params['taxonomy']);
		if (is_object($item_categories) || is_array($item_categories)) {
			foreach ($item_categories as $cat) {
				$classes .= $cat->$slug . ' ';
			}
		}
		return $classes;
	}

	public function html() {

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$layout = $columns = $masonry = $size_head = $layoutMode = $sort = $grid = $isotope = $pagination = $css_animation = $image_size = '';

		extract($this->atts);
		
		$animations = $this->getExtraClass($this->getCSSAnimation($css_animation));
		$lightbox_random = ' data-group="portfolio-'. rand(). '"';
		$loop = 1;
		
		switch($layout) {
			case 'grid':
				$init_layout = 'gallery-gallery';
				
				switch ($columns) {
					case 1: $grid = '1_columns_portfolio';    break;
					case 2: $grid = 'col-lg-6 col-md-6 col-sm-6 col-xs-6';    break;
					case 3: $grid = 'col-lg-4 col-md-4 col-sm-4 col-xs-4';  break;
					case 4: $grid = 'col-lg-3 col-md-6 col-sm-6 col-xs-6';   break;
				}

			break;
			case 'gallery':
				$init_layout = 'portfolio-gallery';
				
				switch ($columns) {
					case 1: $grid = '1_columns_portfolio';    break;
					case 2: $grid = 'col-lg-6 col-md-6 col-sm-6 col-xs-6';    break;
					case 3: $grid = 'col-lg-4 col-md-4 col-sm-4 col-xs-4';  break;
					case 4: $grid = 'col-lg-3 col-md-6 col-sm-6 col-xs-6';   break;
				}

			break;
			case 'carousel':
				$init_layout = 'portfolio-carousel';
			break;
			case 'masonry':
				$init_layout = 'portfolio-isotope';
				$layoutMode = 'data-layout-type="masonry"';
			break;
		}

		ob_start(); ?>
<div class=" read_post_list portfolio_block">

		<div class="section-line">
		<?php
		if (!empty($title)) {
			if($type_title == 'small') {
			$title = '<h3 class="section_title section_title_small">'. $title .'</h3>';
			} 
			if($type_title == 'medium') {
				$title = '<h3 class="section_title section_title_medium">'. $title .'</h3>';
			}
			if($type_title == 'big') {
				$title = '<h2 class="section_title section_title_big">'. $title .'</h2>';
			}
		}
		?>
		 
			<?php echo $title; ?>
			
			
			<?php echo ($sort == 'yes') ? $this->sort_links($this->entries->posts, $this->atts) : ""; ?>
		</div><!--/ .section-line-->

		<div <?php echo $layoutMode ?> class="portfolio-items <?php echo $init_layout ?> ">

		<ul>
		
			<?php foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$sort_class = $this->getTerms($id, $this->atts, 'slug');
				$masonry_class = $thumbnail = '';

				$link  = get_permalink($id);
				$title = $entry->post_title;
				$cur_terms = get_the_terms($id, 'portfolio_categories');

				$comments_count = $entry->comment_count;
				$view_count = revija_getPostViews($id);
				
				
				
				if ($layout == 'masonry') {
					$image_size = get_post_meta($id, 'mad_masonry_size', true);
					switch($image_size) {
						case 'masonry-big':
							$image_size = '440*345';
							break;
						case 'masonry-medium':
							$image_size = '340*150';
							break;
						case 'masonry-small':
							$image_size = '260*150';
							break;
						case 'masonry-long':
							$image_size = '260*345';
							break;
					}
					$masonry_class = get_post_meta($id, 'mad_masonry_size', true);
				}
			?>

		
			
			 <!--Post-->
                <li class="portfolio-item <?php echo esc_attr($sort_class) ?><?php echo esc_attr($masonry_class) ?><?php echo esc_attr($animations) ?> <?php echo $grid ?>" >
                  <div class="section_post_left">
                   
					<?php echo mad_blog_portfolio_th_btn($id, $title, $image_size, $layout); ?>

                    
					<?php if($layout != 'gallery') { ?>
					
					<div class="clearfix">
                      <div class="f_left">
                        <div class="event_date"><?php echo get_the_time(get_option('date_format'), $id) ?></div>
                      </div>
					  
                      <div class="f_right event_info ">
                        
						<?php if (mad_custom_get_option('portfolio-single-meta-comment')): ?>
						
							<?php if ($comments_count != "0" || comments_open($id)): ?>
							<?php
								$link_to = $comments_count === "0" ? "#respond" : "#comments";
							?>
							<a href="<?php echo esc_url($link . $link_to) ?>">
							  <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
							  <span><?php echo esc_html($comments_count) ?></span>
							</a>
							<?php endif; ?>
							
						<?php endif; ?>
						
						
						<?php if (mad_custom_get_option('portfolio-single-meta-liked')): ?>	
					
							<?php 
							if(function_exists('kkLikeButton')){	
							global $post;
							global $kkLikeSettings;
							clean_post_cache( $id );
	
							kkLikeButton(false, $id);
							} 
							?>
						
						<?php endif; ?>
						
						
						<?php if (mad_custom_get_option('portfolio-single-meta-views')): ?>
							<a href="<?php echo esc_url($link) ?>">
							  <i class="fa fa-eye d_inline_m m_right_3"></i> 
							  <span><?php echo esc_attr($view_count) ?></span>
							</a>
						<?php endif; ?>
						
                     
                      </div>
					  
                    </div>
                    <div class="post_text">
					   <?php 
					   if($size_head == 'big') { ?>
						<h2 class="post_title second_font"><a href="<?php echo esc_url($link) ?>"><?php echo esc_attr($title) ?></a></h2>
					   <?php  } else { ?>
						<h4 class="post_title second_font"><a href="<?php echo esc_url($link) ?>"><?php echo esc_attr($title) ?></a></h4>
					  <?php  } ?>
                    </div>
					
					<?php } ?>
					
                  </div>
                </li>
                <!--Post-->
			
			
			<?php $loop ++; endforeach; ?>

		</ul>
		
		</div><!--/ .portfolio-items-->

		
</div><!--/ .read_post_list-->		
		
		<div class="clearfix"></div>
		<?php if ($pagination == "yes"): ?>
			<?php echo mad_corenavi($this->entries->max_num_pages); ?>
		<?php endif;

		return ob_get_clean();
	}

}