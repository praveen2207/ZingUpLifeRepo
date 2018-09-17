<?php

class WPBakeryShortCode_VC_mad_testimonials extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'orderby' => 'date',
			'order' => 'DESC',
			'items' => '6',
			'style' => '',
			'categories' => array(),
			'display_show_image' => '',
			'pagination' => 'no',
			'autoplay' => '',
			'autoplaytimeout' => 5000,
			'css_animation' => ''
		), $atts, 'vc_mad_testimonials');

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
					'taxonomy' => 'testimonials_category',
					'field' => 'id',
					'terms' => $categories
				)
			);
		}

		$query = array(
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'paged' => $page,
			'post_type' => 'testimonials',
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

		$style = $display_show_image = $pagination = $autoplay = $autoplaytimeout = $css_animation = '';

		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation) ? $this->getCSSAnimation($css_animation) : '';

		if ($style == 'tm-slider') {
			REVIJA_BASE_FUNCTIONS::enqueue_script('owlcarousel');
		}

		ob_start(); ?>

		<div class="testimonials-area ">

			<?php echo (!empty($title)) ? $this->entry_title($title) : ""; ?>

			<?php if ($style == 'tm-slider') { ?>
			<div class="owl-demo-2 owl-carousel_2 var2  ">
			<?php } ?>

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

					<div class="item">

						  <div class="testimonials clearfix">
                           
						   <?php if ($display_show_image): ?>
							<?php if (has_post_thumbnail($id)): ?>
								<div class="tm-photo <?php echo $animation ?>"><?php echo $thumbnail; ?></div>
                            <?php endif; ?>
							<?php endif; ?>
						
							<div  class="tm-blockquote <?php echo $animation ?>">
                              <?php echo $entry->post_content; ?>
                              <span><a href="<?php echo $link ?>"><?php echo $name; ?>, <?php echo $place; ?></a></span>
                            </div>
                          </div>

					</div>

					<?php $post_loop ++; ?>
				<?php endforeach; ?>

			<?php if ($style == 'tm-slider') { ?>	
			</div>
			<?php } ?>	
			
		</div><!--/ .testimonials-area-->

		<?php if ($pagination == "yes"): ?>
			<?php echo mad_corenavi($this->entries->max_num_pages); ?>
		<?php endif; ?>

		<?php
		$output = ob_get_clean();
		return $output;
	}

}