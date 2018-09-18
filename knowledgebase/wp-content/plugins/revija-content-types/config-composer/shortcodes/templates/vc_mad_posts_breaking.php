<?php

class WPBakeryShortCode_VC_mad_posts_breaking extends WPBakeryShortCode {

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
			'type' => 'type1',
			'posts_per_page' => 5,
			'css_animation' => ''
		), $atts, 'vc_mad_posts_breaking');

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
		return "<div class='news_title'>" . $title . "</div>";
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

		$css_animation = $type = $title = $category = '';
		$entries = $this->entries;
		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		ob_start(); ?>

		<div class="<?php if($type == 'type2') echo 'news_gallery'; ?> clearfix calousel_top_news posts_breaking <?php echo $type; ?>">

			<?php if (!empty($title) && $type == 'type1') {?>
				<?php echo $this->entry_title($title); ?>
			<?php } else { ?>
				<h3 class="section_title"><?php echo $title; ?></h3>
			<?php } ?>
			
			<?php if ($type == 'type1') {  ?>
			<div class="wrapper">
            <div id="owl-demo" class="owl-carousel">

				<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title($id);
					?>

					<div <?php post_class('item') ?> ><a href="<?php echo esc_url($link) ?>"><?php echo esc_attr($post_title) ?></a></div>
					
				<?php endwhile; ?>

			</div><!--/ .owl-carousel-->
			</div>
			<?php }  ?>
			
			
			<?php if ($type == 'type2') {  ?>
			<div id="owl-demo-5" class="owl-carousel">
			
			<?php while ( $entries->have_posts() ) : $entries->the_post(); ?>

					<?php
						$comments_count = get_comments_number();
						$link = get_permalink();
						$id = get_the_ID();
						$post_title = get_the_title($id);
						$post_content = get_the_content();
					?>
					
				<div <?php post_class('item') ?>>
				
				<?php echo mad_big_blog_post_th_carousel($id, $post_content, $post_title, '218*148'); ?>
			
				</div>
				
			<?php endwhile; ?>
			</div><!--/ .owl-carousel-->
			<?php }  ?>
			
			
			
			<?php wp_reset_postdata(); ?>

		</div><!--/ .calousel_top_news-->

		<?php return ob_get_clean();
	}

}