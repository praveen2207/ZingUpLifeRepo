<?php

class WPBakeryShortCode_VC_mad_blockquotes_carousel extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'orderby' => 'date',
			'order' => 'DESC',
			'items' => '6',
			'categories' => array(),
			'display_show_image' => '',
			'pagination' => 'no',
			'autoplay' => '',
			'autoplaytimeout' => 5000,
			'css_animation' => ''
		), $atts, 'vc_mad_blockquotes_carousel');

		$this->query_entries();
		return $this->html();
	}

	public function query_entries() {
		$params = $this->atts;
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		if (!$page || $params['pagination'] == 'no') $page = 1;

		$tax_query = array();

		if (!empty($params['categories'])) {
			$categories = explode(',', $params['categories']);
			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'blockquotes_category',
					'field' => 'id',
					'terms' => $categories
				)
			);
		}

		$query = array(
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'paged' => $page,
			'post_type' => 'blockquotes',
			'posts_per_page' => $params['items'],
			'tax_query' 	 => $tax_query
		);

		$this->entries = new WP_Query($query);
	}

	protected function entry_title($title) {
		return "<h3 class='section_title section_title_medium'>". $title ."</h3>";
	}

	public function getCSSAnimation($css_animation) {
		$output = '';
		if ( $css_animation == 'yes' ) {
			wp_enqueue_script('waypoints');
			$output = ' animate-left-to-right';
		}
		return $output;
	}

	public function html() {

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$display_show_image = $pagination = $autoplay = $autoplaytimeout = $css_animation = '';

		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation) ? $this->getCSSAnimation($css_animation) : '';

		ob_start(); ?>

		
		<?php echo (!empty($title)) ? $this->entry_title($title) : ''; ?>
		
		<div class="owl-demo-2 owl-carousel_2 var2 ">

				<?php $post_loop = 1; ?>

				<?php foreach ($this->entries->posts as $entry):
					$id = $entry->ID;
					$name = get_the_title($id);
					$link  = get_permalink($id);
					$place = rwmb_meta('mad_tm_place', '', $id);
					$thumbnail_attr = array(
						'alt'	=> trim(strip_tags($entry->post_excerpt)),
						'title'	=> trim(strip_tags($entry->post_title)),
					);
					$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, '165*165', $thumbnail_attr);
					?>

					<div class="item <?php echo $animation ?>">
                        <div class="blockquotes">
                          <div><?php echo $entry->post_content; ?></div>
                          <div><?php echo $name; ?>, <?php echo $place; ?></div>
                        </div>
                    </div>

					<?php $post_loop ++; ?>
				<?php endforeach; ?>

			

		</div><!--/ .owl-carousel_2-->

		<?php
		$output = ob_get_clean();
		return $output;
	}

}