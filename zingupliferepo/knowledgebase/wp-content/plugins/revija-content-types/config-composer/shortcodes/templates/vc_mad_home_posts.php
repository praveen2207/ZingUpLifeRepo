<?php

class WPBakeryShortCode_VC_mad_home_posts extends WPBakeryShortCode {

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
			'blog_style' => '',
			'posts_per_page' => 5,
			'first_big_post' => 'no',
			'pagination' => 'no'
		), $atts, 'vc_mad_home_posts');

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
		return "<h3 class='section_title '>" . esc_html($title) . "</h3>";
	}

	public function html() {

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$blog_style = $first_big_post = $pagination = $before_content = $blog_style_class = '';

		extract($this->atts);

		$post_loop = 1;
		$first_big_post ='no';
		$first_big_post = $first_big_post == 'yes' ? true : false;

		$blog_style_class = 'home_posts';
		$blog_style_class .= ' home-'.$blog_style;
		ob_start(); ?>

		<div class="<?php echo $blog_style_class; ?>">777777777777
		
		<?php if (!empty($title)): ?>
			<?php echo $this->entry_title($title); ?>
		<?php endif; ?>

		
		
		<?php if ( $blog_style == 'blog-style-1' ) { ?>
		<div  class="read_post_list">

			<ul class="vertical_list">
		
			<?php foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = $entry->post_title;
				$post_content = !empty($entry->post_excerpt) ? $entry->post_excerpt : mad_post_content_truncate($entry->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');	
				$post_class = "post-item clearfix post-entry-{$id} entry-format-{$format} entry-{$type_blog}";
			?>

				<li <?php post_class($post_class, $id) ?>>
				
					<?php echo mad_blog_post_th_btn($id, $post_content, $title, 0, '555*374'); ?>
				

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

								<?php echo (!empty($post_content)) ? "<p>{$post_content}</p>" : ''; ?>

							</div><!--/ .post_text-->
						
						</div><!--/ .wrapper-->
				</li><!--/ .post-item-->

			<?php endforeach; ?>

			</ul>
		</div>
		
		<?php } 
		if ( $blog_style == 'blog-style-2' ) { ?>
		
			<div  class="section block_post_list">
			<ul>
		
				<?php foreach ($this->entries->posts as $entry):
				$id = $entry->ID;
				$link = get_permalink($id);
				$title = $entry->post_title;
				$post_content = !empty($entry->post_excerpt) ? $entry->post_excerpt : mad_post_content_truncate($entry->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');	
				?>
		
				<li <?php post_class('post-item') ?>>
				
				<?php echo mad_blog_post_th_btn($id, $post_content, $title, 19, '555*374'); ?>
				
				<div class="clearfix">
				<?php echo mad_blog_post_meta($id, $entry); ?>
				</div><!--/ .clearfix-->
						
					<div class="post_text">
						<h2 class="post_title second_font">
							<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
						</h2>

						<?php echo (!empty($post_content)) ? "<p>{$post_content}</p>" : ''; ?>

						<a href="<?php echo esc_url($link); ?>" class="button button_type_2 button_grey_light">
							<?php esc_html_e('Read More', 'revija'); ?>
						</a>

					</div><!--/ .post_text-->
				
				</li><!--/ .post-item-->
		
				<?php endforeach; ?>
		
			</ul>
			</div>
		
		<?php } ?>
		
		
		
		
		</div><!--/ .section-->
		
		<?php if ($pagination == "yes") { ?>
		
		
			<?php 
			global $wp_query;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
			$max_page = $wp_query->max_num_pages;
			
				if(empty($paged) || $paged == 0) $paged = 1;
				$out='';
				if ( $paged!=$max_page) {
				$out.= '<div class="load_more_wrapper"><h3 class="section_title"><a href="'.get_pagenum_link(($paged+1)).'" class="more_news_button">Load More</a></h3></div>';			
				}	
				echo $out;
				?>
			
			<?php //echo mad_corenavi($this->entries->max_num_pages); ?>
		<?php }

		
		return ob_get_clean();
	}

}