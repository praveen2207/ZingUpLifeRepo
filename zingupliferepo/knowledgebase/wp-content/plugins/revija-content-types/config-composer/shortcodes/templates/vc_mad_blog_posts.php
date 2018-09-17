<?php

class WPBakeryShortCode_VC_mad_blog_posts extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'advertising_after_post' => 2,
			'advertising' => '',
			'category' => '',
			'orderby' => '',
			'order' => '',
			'posts_per_page' => -1,
			'exerpt_count' => '100',
			'blog_style' => 'blog-style-1',
			'first_big_post' => '',
			'pagination' => 'no'
		), $atts, 'vc_mad_blog_posts');

		
		
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
			'post_status' => array('publish'),
			'cache_results' => false 
		);

		if (!empty($params['category'])) {
			$categories = explode(',', $params['category']);
			$query['category_name'] = $params['category'];
			//$query['category__in'] = $categories;
		}


		if ($params['pagination'] == "yes") {
		$query['paged'] = (get_query_var('paged')) ? get_query_var('paged') : get_query_var('page');
		} 
		
		
		if ($params['posts_per_page'] == 'all' ) {
			$params['posts_per_page'] = -1;
		}
		
		
		if (!empty($params['posts_per_page']) ) {
			$query['posts_per_page'] = $params['posts_per_page'];
		} 

		
		$this->entries = new WP_Query($query);
	}

	protected function entry_title($title) {
		return "<h2 class='section_title section_title_big'>" . esc_html($title) . "</h2>";
	}

	public function html() {

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$blog_style = $first_big_post = $pagination = $before_content = $blog_style_class = $exerpt_count = '';

		extract($this->atts);

		
		$counter_posts = 0;
		$post_loop = 1;
		$first_big_post = $first_big_post == 'yes' ? true : false;

		if($blog_style == 'blog-style-1') {
			$blog_style_class = ' blog-style-1 read_post_list var2';
		}
		if($blog_style == 'blog-style-2') {
			$blog_style_class = ' blog-style-2';
		}
		if($blog_style == 'blog-style-3') {
			$blog_style_class = ' blog-style-3 read_post_list';
		}
		if($blog_style == 'blog-style-4') {
			$blog_style_class = ' blog-style-4';
		}
		if($blog_style == 'blog-style-5') {
			$blog_style_class = ' blog-style-5 read_post_list var3';
		}
		if($blog_style == 'blog-style-6') {
			$blog_style_class = ' blog-style-6';
		}
		if($blog_style == 'blog-style-7') {
			$blog_style_class = ' blog-style-7';
		}
		
		ob_start(); ?>

		<div class="<?php echo $blog_style_class; ?> blog_post">
		
		<?php if (!empty($title)): ?>
			<?php echo $this->entry_title($title); ?>
		<?php endif; ?>

		<?php 
		if($blog_style == 'blog-style-1') {
		?>
		
		<ul>

			<?php foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = $entry->post_title;
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	
				$post_class = "post-item clearfix post-entry-{$id} entry-format-{$format} ";
				
				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>

				<li <?php post_class($post_class, $id) ?>>
				<div class="section_post_left">
			
						<?php echo mad_blog_post_th_btn($id, $post_content, $title, 19, mad_blog_alias('standard', '', 'blog-style-1')); ?>
						
						<div class="clearfix">
						<?php echo mad_blog_post_meta($id, $entry); ?>
						</div><!--/ .clearfix-->
						
						<div class="post_text">
							<h2 class="post_title second_font">
								<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
							</h2>

							<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

							<a href="<?php echo esc_url($link); ?>" class="button button_type_2 button_grey_light">
								<?php esc_html_e('Read More', 'revija'); ?>
							</a>

						</div><!--/ .post_text-->
						
				</div><!--/ .section_post_left-->
				</li><!--/ .post-item-->

				
				
				
				<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				<?php } 
				$post_loop++;
				?>
				
				
				
			<?php endforeach; ?>

		</ul><!--/ .post-area-->
		
		
		<?php 
		}
		?>
		
		
		
		<?php 
		if($blog_style == 'blog-style-2') {
		?>
		
		<div  class="read_post_list">

			
		
			<?php foreach ($this->entries->posts as $entry):
				
				$first_post = $first_big_post && $post_loop == 1;
				$type_blog  = ($first_post) ? $type_blog = 'blog-big' : $blog_style;
				
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = $entry->post_title;
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	
				$post_class = "post-item clearfix post-entry-{$id} entry-format-{$format} ";
				
				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>

				<?php if ($first_post || $type_blog == 'blog-big'): ?>
				
					<div <?php post_class($post_class, $id) ?> >
					
					<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, mad_blog_alias('standard', '', 'blog-style-1')); ?>
				
					</div>
					
					
					<ul class="vertical_list">
				<?php else: ?>
				
				<li <?php post_class($post_class, $id) ?>>
				
					<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, mad_blog_alias('standard', '', 'blog-style-2')); ?>
				

						<div class="wrapper">
							<div class="clearfix">
							<?php echo mad_blog_post_meta($id, $entry); ?>
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

								<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

							</div><!--/ .post_text-->
						
						</div><!--/ .wrapper-->
				</li><!--/ .post-item-->

				<?php endif; ?>
				
				
				<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				<?php } 
				$post_loop++;
				?>
				
			
			<?php endforeach; ?>

			</ul>
		</div>
		
		<?php 
		}
		?>
		
		
		
		
		
		<?php 
		if($blog_style == 'blog-style-3') {
		?>
		
		<ul class="row">

			<?php 

			foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$link = get_permalink($id);
				$title =  revija_limit_words($entry->post_title, 2);
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				
				
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	
				
				
				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $entry->post_content );
				$excerpt =  revija_limit_words($excerpt, $exerpt_count);
				
				$post_class = "col-lg-6 col-md-6 col-sm-6 col-xs-6 post-item clearfix post-entry-{$id} entry-format-{$format} ";
		
				?>

				<li <?php post_class($post_class, $id) ?>>
				<div class="section_post_left">
					
					<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, mad_blog_alias('standard', '', 'blog-style-2')); ?>
	
						<div class="clearfix">
						<?php echo mad_blog_post_meta($id, $entry); ?>
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

							<a href="<?php echo esc_url($link); ?>" class="button button_type_2 button_grey_light">
								<?php esc_html_e('Read More', 'revija'); ?>
							</a>

						</div><!--/ .post_text-->
						
				</div><!--/ .section_post_left-->
				</li><!--/ .post-item-->

			
			
			<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				<?php } 
				$post_loop++;
			?>
			
				
			<?php endforeach; ?>

		</ul><!--/ .row-->
		
		
		<?php 
		}
		?>
		
		
		
		
		<?php 
		if($blog_style == 'blog-style-4') {
		?>
		
		<div class="read_post_list">

			
		
			<?php foreach ($this->entries->posts as $entry):
			
				$first_post = $first_big_post && $post_loop == 1;
				$type_blog  = ($first_post) ? $type_blog = 'blog-big' : $blog_style;
				
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = $entry->post_title;
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	
				$post_class = "post-item clearfix post-entry-{$id} entry-format-{$format}";
				
				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>

				<?php if ($first_post || $type_blog == 'blog-big'): ?>
				
					<div <?php post_class($post_class, $id) ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title, 19, mad_blog_alias('standard', '', 'blog-style-2')); ?>

						<div class="clearfix">
						<?php echo mad_blog_post_meta($id, $entry); ?>
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
				
				<ul class="vertical_list">
				<?php else: ?>
				
				<li <?php post_class($post_class, $id) ?>>
				
					<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, '165*110'); ?>


						<div class="wrapper">
							<div class="clearfix">
							<?php echo mad_blog_post_meta($id, $entry); ?>
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

								<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

							</div><!--/ .post_text-->
						
						</div><!--/ .wrapper-->
				</li><!--/ .post-item-->

				<?php endif; ?>
				
				
			<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				<?php } 
				$post_loop++;
				?>
				
			
			<?php endforeach; ?>

			</ul>
		</div>
		
		<?php 
		}
		?>
		
		
		
		
		
		
		<?php 
		if($blog_style == 'blog-style-5') {
		?>
	
			
		
			<?php foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = mad_post_content_truncate($entry->post_title, 100, " ", "…", '');
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	

				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>

				
				
				<?php if ($post_loop == 1) {
				$post_class = "two_third_column post-item post-entry-{$id} entry-format-{$format}";
				?>
				
					<div <?php post_class($post_class, $id) ?> >
					
						<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, '750*520'); ?>

					</div>
				<?php } 
				
				 if ($post_loop == 2) { ?>
				<div class="one_third_column one_third_var2">
					
					<?php echo mad_big_blog_post_th_btn($id, $post_content, mad_post_content_truncate($entry->post_title, 24, " ", "…", ''), 19, '555*374'); ?>
	
				 <?php } 
				
				
				 if ($post_loop == 3) { ?>
				
					<?php echo mad_big_blog_post_th_btn($id, $post_content, mad_post_content_truncate($entry->post_title, 24, " ", "…", ''), 19, '555*374', ' r_image_container '); ?>
					
				</div>
				
				<div class="row">
				 <?php } 
				 
				if ($post_loop > 3) {
				$post_class = "top_40 col-lg-4 col-md-4 col-sm-4 col-xs-4 post-item post-entry-{$id} entry-format-{$format}";
				?>
				
				<div <?php post_class($post_class, $id) ?>>
				
					<div class="section_post_left">
					
					<?php echo mad_blog_post_th_btn($id, $post_content, $title, 19, '555*374'); ?>

							<div class="clearfix">
							<?php echo mad_blog_post_meta($id, $entry); ?>
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
									<a href="<?php echo esc_url($link) ?>"><?php echo esc_html(mad_post_content_truncate($entry->post_title, 24, " ", "…", '')) ?></a>
								</h2>

							</div><!--/ .post_text-->
					
					</div><!--/ .section_post_left-->
						
				</div><!--/ .post-item-->
				
				<?php } ?>
				
				
				<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				<?php } 
				$post_loop++;
				?>
				
				
			
			<?php endforeach; 

			if ($post_loop > 4)  { ?>
			</div><!--/ .row-->
			<?php } ?>
			
			
			<div class="clearfix"></div>
		
		<?php 
		}
		?>
		
		
		
		
		
		
		<?php 
		if($blog_style == 'blog-style-6') {
			
		?>
		
		<div class="read_post_list">

			
			
			
			
		
			<?php foreach ($this->entries->posts as $entry):
				
				$first_post = $first_big_post && $post_loop == 1;
				$type_blog  = ($first_post) ? $type_blog = 'blog-big' : $blog_style;
				
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = mad_post_content_truncate($entry->post_title, 100, " ", "…", '');
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	
				$post_class = "post-item clearfix post-entry-{$id} entry-format-{$format}";
				
				
				
				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>

				<?php if ($first_post || $type_blog == 'blog-big'): ?>
				
					<div <?php post_class($post_class, $id) ?> >
					
						<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, mad_blog_alias('standard', '', 'blog-style-1')); ?>

					</div>
					
				<div class="row">
				
				<ul class="small_post_list <?php if (!$first_big_post) { echo 'row'; }?> ">
				
				<?php else: 
				$post_class = "post-item clearfix col-lg-3 col-md-3 col-sm-3 col-xs-3 post-entry-{$id} entry-format-{$format}";
				?>
				
				
				<li <?php post_class($post_class, $id) ?>>
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title, 14, '165*110'); ?>

						<a href="<?php echo esc_url($link) ?>">
							<h4 class="second_font">
								<?php echo esc_html(mad_post_content_truncate($entry->post_title, 10, " ", "…", '')) ?>
							</h4>
						</a>

						<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
						

						
				</li><!--/ .post-item-->

				<?php endif; ?>
		
				
			
			
			
				<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<li>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				</li>
				<?php } ?>
			
			<?php $post_loop ++; ?>
			<?php endforeach; ?>

			</ul>
			
			
			
			</div><!--/ .row-->
			
		
			
		</div>
		
		<div class="clearfix"></div>
		
		<?php 
		}
		?>
		
		

		<?php 
		if($blog_style == 'blog-style-7') {
		?>
	
			<div class="clearfix">
		
			<?php foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = mad_post_content_truncate($entry->post_title, 22, " ", "…", '');
				$format = get_post_format($id) ? get_post_format($id) : 'standard';
				$post_content = !empty($entry->post_excerpt) ? mad_post_content_truncate($entry->post_excerpt, $exerpt_count, " ", "…", '') : mad_post_content_truncate($entry->post_content, $exerpt_count, " ", "…", '');	
				
				$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>

				
				
				<?php if ($post_loop == 1 ) {?>
				
					<div class="half_column" >
					
						<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, '565*377'); ?>

					</div>
				<?php } 
				
				 if ($post_loop == 2) { ?>
					<div class="half_column" >
						
						<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, '565*377'); ?>
					</div>
				 <?php } 
				
				
				 if ($post_loop == 3) { ?>
				<div class="clearfix one_third_banner_box">
				
				<div class="one_third_column ">
					<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, '555*374'); ?>
				</div>	
				<?php } 
				 
				if ($post_loop > 3) {?>
				
				<div class="one_third_column ">
					<?php echo mad_big_blog_post_th_btn($id, $post_content, $title, 19, '555*374'); ?>
				</div>	
				
				<?php } ?>
				
				
			<?php if ( $post_loop == $advertising_after_post && $advertising != '') { 
				$advertising = trim(vc_value_from_safe($advertising));
				?>
				<div class="clearfix"></div>
				<div class="section t_align_c clearfix">
				<?php echo $advertising; ?>
				</div>
				<?php } 
				$post_loop++;
			?>
				
				
			<?php endforeach; 

			if ($post_loop > 3)  { ?>
			</div><!--/ .one_third_banner_box-->
			<?php } ?>
			
			</div>
			
		
		<?php 
		}
		?>
		
		
		
		

		</div><!--/ .section-->
		
		<?php if ($pagination == "yes"): ?>
			<?php echo mad_corenavi($this->entries->max_num_pages); ?>
		<?php endif;

		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

}