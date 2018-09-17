<?php

class WPBakeryShortCode_VC_mad_post_tabs extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'title_color' => '#3e454c',
			'category' => '',
			'orderby' => '',
			'order' => '',
			'font_container' => '',
			'gap' => '',
			'type_post_tabs' => 'type1',
			'posts_per_page' => 4,
			'css_animation' => ''
		), $atts, 'vc_mad_posts_slider');

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
			//$categories = explode(',', $params['category']);
			$query['category_name'] = $params['category'];
		}

		$query['paged'] = (get_query_var('paged')) ? get_query_var('paged') : get_query_var('page');

		if (!empty($params['posts_per_page'])) {
			$query['posts_per_page'] = $params['posts_per_page'];
		}

		$this->entries = new WP_Query($query);
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

		$font_container = $css_animation = $title = $title_post = $title_color = $gap = $category = $term_id1 = $type_post_tabs = '';
		$entries = $this->entries;
		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		$term1 = get_term_by( 'slug', $category, 'category');
		$term_id1 = $term1->term_id;
		
		$tab_id = rand();
		$num_tab = $tab_id;
		
		$args_cat = array(
			'orderby'       => 'id', 
			'order'         => 'ASC',
			'hide_empty'    => true, 
			'child_of'       => (int) $term_id1
			
		);  
		$portfolio_category = get_terms('category', $args_cat );
		$termchildren = get_term_children( $category, 'category' );
		
		wp_enqueue_script( 'jquery-ui-tabs' );
	
		$font_container_field_settings = array();
		$font_container_obj = new Vc_Font_Container();
		$font_container_data = $font_container_obj->_vc_font_container_parse_attributes( $font_container_field_settings, $font_container );

		ob_start(); 
		?>

	<div class="block-post-tabs block-post-tabs-<?php echo $type_post_tabs; ?> <?php if($portfolio_category){ echo ' tabs '; } ?> variation_2" style="border-color:<?php echo $title_color; ?>; margin-top:<?php echo $gap; ?>px;" >


		<!--tabs navigation-->
        <div class="clearfix">
		
			<?php if (!empty($title)): ?>
				<?php echo "<h3 class='section_title' style='color:". $title_color ."' >" . $title . "</h3>"; ?>
			<?php endif; ?>

			<div class="clearfix tabs_conrainer">
	
				<?php 
				if($portfolio_category): ?>
					<ul class="tabs_nav clearfix">
					
						<li class=""><a href="#tab-<?php echo $tab_id; ?>"><?php echo esc_html__('All','Revija');?></a></li>
						<?php 
						
						foreach($portfolio_category as $portfolio_cat): 
						$tab_id++;
						?>
							<li class=""><a href="#tab-<?php echo $tab_id; ?>"><?php echo $portfolio_cat->name; ?></a></li>
						<?php endforeach; ?>
					
					</ul>
				<?php endif; ?>

			</div>
		
		</div>	
			
			
			
		<?php $tab_id = $num_tab;  ?>	
			
		<!--tabs content-->
        <div class="tabs_content post_var_inline">
		
			<div id="tab-<?php echo $tab_id; ?>">
				<div class="row">
				<?php

				global $post;
				$tmp_post = $post;
				
				$first_post = 1;
				$end_post = count($entries->posts);
				
				
				while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$link = get_permalink();
						$id = get_the_ID();
						$post_content = !empty($post->post_excerpt) ? $post->post_excerpt : mad_post_content_truncate($post->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');
						$title_post = mad_post_content_truncate($post->post_title, 30, " ", "…");
						
						$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
					?>

				<?php if($type_post_tabs == 'type1' ) { ?>
					
					<?php if($first_post == 1 ) { ?>
					
					<div <?php post_class('col-lg-6 col-md-6 col-sm-6 col-xs-6') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post->post_content, $title_post, 14, '555*374'); ?>

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
							<a href="<?php echo esc_url($link) ?>" style="color:<?php echo esc_attr($font_container_data['values']['color']) ?>;">
							<?php echo esc_html($title_post) ?>
							</a>
							</h2>

							<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

						</div><!--/ .post_text-->
						
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<ul>
					<?php } else { ?>
					<li <?php post_class('clearfix') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '165*110'); ?>

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
							<h4 class="second_font" style="font-size:<?php echo esc_attr($font_container_data['values']['font_size']) ?>px !important;color:<?php echo esc_attr($font_container_data['values']['color']) ?>;">
								<?php echo esc_html($title_post) ?>
							</h4></a>

							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
							
						</div><!--/ .post_text-->
						
					</li>

					<?php } ?>
					
						<?php 
						if($first_post == $end_post ) { 

						?>
						</ul></div>
						<?php } ?>
					
				<?php } ?>	
					
				
				
				<?php if($type_post_tabs == 'type2' ) { ?>
					
					
					
					<?php if($first_post == 1 ) { ?>
					<div class="post_tabs_type2">
					<ul>
					<?php } ?>
					
					<li <?php post_class('clearfix col-lg-6 col-md-6 col-sm-6 col-xs-6') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '165*110'); ?>

						<div class="post_text">
							
							<?php if (is_sticky($id)): ?>
								<?php printf( '<div class="post_theme f_left">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
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
							<h4 class="second_font" style="font-size:<?php echo esc_attr($font_container_data['values']['font_size']) ?>px !important;color:<?php echo esc_attr($font_container_data['values']['color']) ?>;">
								<?php echo esc_html($title_post) ?>
							</h4></a>

							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
							
						</div><!--/ .post_text-->
						
					</li>
					
					
						<?php if($first_post == $end_post ) { 

						?>
						</ul></div>
						<?php } ?>
					
				<?php } ?>		
				
				
				
				
				
				<?php if($type_post_tabs == 'type3' ) { ?>
					
					
					
					<?php if($first_post == 1 ) { ?>
					<div class="post_tabs_type3">
					
					<?php } ?>
					
					<div <?php post_class('clearfix col-lg-4 col-md-4 col-sm-4 col-xs-4') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '555*374'); ?>

						
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
								<a href="<?php echo esc_url($link) ?>" style="font-size:<?php echo esc_attr($font_container_data['values']['font_size']) ?>px !important;color:<?php echo esc_attr($font_container_data['values']['color']) ?>;" >
								<?php echo esc_html($title_post) ?>
								</a>
							</h2>

							<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

						</div><!--/ .post_text-->
						
					</div>
					
					
					<?php if($first_post == $end_post ) { 

						?>
						</div>
						<?php } ?>
					
					
				<?php } ?>
				
				
				
					
				<?php 
				$first_post++;
				endwhile; ?>

				</div>	<!--/ .row-->
				
				<?php 
				$first_post = 1;
				wp_reset_postdata(); 
				?>
			</div>	<!--/ .tab-1-->
			
			
			
			<?php 
			if($portfolio_category) { ?>

				<?php 
				foreach($portfolio_category as $portfolio_cat) {
				$tab_id++;	
				?>
				<div id="tab-<?php echo $tab_id; ?>">
				<div class="row">
				<?php 
				$next_cat = $portfolio_cat->slug;
				
				$args = array( 'order' => $order,
								'orderby' => $orderby,
								'category_name' => $next_cat,
								'numberposts' => $posts_per_page);

				$myposts = get_posts( $args );
				
				
				?>
				
				<?php 
				foreach( $myposts as $post ) :  setup_postdata($post);
					
					$end_post = count($myposts);
					
					$link = get_permalink($post->ID);
					$id = $post->ID;
					$title_post = mad_post_content_truncate($post->post_title, 30, " ", "…");
					$post_content = !empty($post->post_excerpt) ? $post->post_excerpt : mad_post_content_truncate($post->post_content, mad_custom_get_option('excerpt_count_medium_post') , " ", "…", '');	
					
					$excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_content );
				?>
				
				<?php if($type_post_tabs == 'type1' ) { ?>
				
				<?php if($first_post == 1) { ?>
					
					<div <?php post_class('col-lg-6 col-md-6 col-sm-6 col-xs-6') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '555*374'); ?>

						<div class="clearfix">
						<?php echo mad_blog_post_meta($id, $post); ?>
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
								<a href="<?php echo esc_url($link) ?>" style="color:<?php echo esc_attr($font_container_data['values']['color']) ?>;" >
								<?php echo esc_html($title_post) ?>
								</a>
							</h2>

							<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

						</div><!--/ .post_text-->
						
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<ul>
					<?php } else { ?>
					<li <?php post_class('clearfix') ?> >

						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '165*110'); ?>

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
							<h4 class="second_font" style="font-size:<?php echo esc_attr($font_container_data['values']['font_size']) ?>px !important;color:<?php echo esc_attr($font_container_data['values']['color']) ?>;" >
								<?php echo esc_html($title_post) ?>
							</h4>
							</a>

							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
							
						</div><!--/ .post_text-->
						
					</li>

					<?php } ?>
					
				
						<?php if($first_post == $end_post ) { 

						?>
						</ul></div>
						<?php } ?>
				

				<?php } ?>

				<?php if($type_post_tabs == 'type2' ) { ?>
				
				
				
					<?php if($first_post == 1 ) { ?>
					<div class="post_tabs_type2">
					<ul>
					<?php } ?>
					
					<li <?php post_class('clearfix col-lg-6 col-md-6 col-sm-6 col-xs-6') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '165*110'); ?>

						<div class="post_text">
							
							<?php if (is_sticky($id)): ?>
								<?php printf( '<div class="post_theme f_left">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
							<?php endif; ?>
							
							
							
							<?php 
							$cat_theme = '';
							$terms = get_the_terms($id, 'label_theme');
							
							if ($terms != '' && ! is_wp_error($terms)){
								foreach($terms as $term) {
								$cat_theme .= '<div class="post_theme  f_left">'. $term->name .'</div>';
								}
							}
							echo $cat_theme;
							?>
							
							<a href="<?php echo esc_url($link) ?>">
							<h4 class="second_font" style="font-size:<?php echo esc_attr($font_container_data['values']['font_size']) ?>px !important;color:<?php echo esc_attr($font_container_data['values']['color']) ?>;" >
								<?php echo esc_html($title_post) ?>
							</h4></a>

							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
							
						</div><!--/ .post_text-->
						
					</li>
				
				
						<?php 
						if($first_post == $end_post ) { 

						?>
							</ul></div>
						<?php } ?>
				
				
				<?php } 
				if($type_post_tabs == 'type3' ) { ?>
					
					
					
					<?php if($first_post == 1 ) { ?>
					<div class="post_tabs_type3">
					
					<?php } ?>
					
					<div <?php post_class('clearfix col-lg-4 col-md-4 col-sm-4 col-xs-4') ?> >
					
						<?php echo mad_blog_post_th_btn($id, $post_content, $title_post, 14, '555*374'); ?>

						
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
								<a href="<?php echo esc_url($link) ?>"  style="font-size:<?php echo esc_attr($font_container_data['values']['font_size']) ?>px !important;color:<?php echo esc_attr($font_container_data['values']['color']) ?>;">
								<?php echo esc_html($title_post) ?>
								</a>
							</h2>

							<?php echo (!empty($excerpt)) ? "<p>{$excerpt}</p>" : ''; ?>

						</div><!--/ .post_text-->
						
					</div>
					
					
					<?php if($first_post == $end_post ) { 

						?>
							</div>
						<?php } ?>
					
					
				<?php } ?>
				
				
				
				<?php 
				$first_post++;
				?>
				
				<?php endforeach; ?>

				</div><!--/ .row-->
				</div><!--/ .tab-n-->
				<?php
				
				$num_tab++;
				$first_post = 1;
				} //endforeach cat 
				
				wp_reset_postdata(); 
				$post = $tmp_post;
				?>
			
			<?php } //portfolio category ?>

		</div><!--/ .tabs_content-->

	</div><!--/ .tabs-->

		<?php return ob_get_clean();
		
	}

}