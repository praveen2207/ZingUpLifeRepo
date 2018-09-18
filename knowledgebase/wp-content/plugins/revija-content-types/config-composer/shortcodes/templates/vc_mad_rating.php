<?php

class WPBakeryShortCode_VC_mad_rating extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'text' => ''
		), $atts, 'vc_mad_rating');

		$this->content = $content;

		return $this->html();
	}

	
	public function html() {

		$title = $text = '';

		extract($this->atts);

		global $post;

		$post_id = $post->ID;

		$rating = 1;
		$votes = 1;
		$max_rating = 1;
		$current_rating = 1;
		
		
		
		//$box = RWP_API::get_reviews_box( mad_post_id(), 2, true ); 
		//echo $box["review_users_score"]["scores"][0];
		
		
		//echo do_shortcode('[rwp-review-scores  id="-1"  template="rwp_template_56d993cf8f255"]');
		
		
		ob_start() ?>

		
		<div class="blog_rating_block clearfix ">
			  <div>
				<div class="result">
				  <h2><?php print $current_rating; ?></h2>
				  <p style='margin-bottom: 0;'><?php echo esc_html__('Very Good', 'post-ratings'); ?></p>
				</div>
				<div class="rating_view">
				  <p style='margin-bottom: 0;'><?php esc_html_e('User Rating:', 'revija'); ?> <?php print ($rating / $max_rating); ?> (<?php printf(_n('%1$s vote', '%1$s votes', $votes, 'post-ratings'), sprintf('%d', $votes)); ?>)</p>
				  
				    <div class="ratings <?php if (is_singular()) print 'hreview-aggregate'; ?>" data-post="<?php the_ID(); ?>">
				    <ul class="rated" style="width:<?php print ($max_rating * 15); ?>px">

						<li class="rating" style="width:<?php print ($rating * 15); ?>px">
						  <span class="average">
							<?php print $current_rating; ?>
						  </span>
						  <span class="best">
							<?php print $max_rating; ?>
						  </span>
						</li>

						

							<?php for ($i = 1; $i <= $max_rating; $i++): ?>

								
								<li class="s<?php print $i; ?>">
									<a title="<?php esc_attr($title); ?>"></a>
								</li>

							<?php endfor; ?>

						
					</ul>
					</div>
				  
				</div>
			  </div>
			  
			  <div class="blog_rating_block_text">
			  
				<?php if (!empty($title)): ?>
				<?php 
					echo "<h3 class='section_title section_title_small' >".$title."</h3>";
					?>
				<?php endif; ?>
	
				<?php 
					echo "<p style='margin-top: 15px; margin-bottom: 0;'>".$text."</p>";
					?>
			  </div>
		</div>
			
		
		
		<?php return ob_get_clean();
	}

}