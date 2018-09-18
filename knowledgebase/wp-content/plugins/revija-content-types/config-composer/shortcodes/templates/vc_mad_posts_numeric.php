<?php

class WPBakeryShortCode_VC_mad_posts_numeric extends WPBakeryShortCode {

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
			'meta_key' => '',
			'items' => 1,
			'posts_per_page' => 5,
			'css_animation' => ''
		), $atts, 'vc_mad_posts_numeric');

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
			'meta_key' => $params['orderby'] == 'meta_key' ? $params['meta_key'] : '',
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

		$css_animation = $items = "";
		$entries = $this->entries;
		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		ob_start(); ?>

		<div class="section">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>

			<?php 
			$class = 'comments_list posts_numeric';
			$count = 0;
			?>
			
			
			<ul class="<?php echo $class; ?>" >

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
					$count++;
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
					?>

					<li <?php post_class('post_text') ?>>
						<div class="comment_number"><?php echo esc_attr($count) ?></div>
						<div class="wrapper">
						
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
						
						
						
						
                          <a href="<?php echo esc_url($link) ?>"><h4 class="second_font"><?php the_title() ?></h4></a>
                          <div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
                        </div>
					</li><!--/ .post-item-->

				<?php endwhile; ?>

			</ul><!--/ .post-carousel-->

			<?php wp_reset_postdata(); ?>

		</div><!--/ .post-slider-area-->

		<?php return ob_get_clean();
	}

}