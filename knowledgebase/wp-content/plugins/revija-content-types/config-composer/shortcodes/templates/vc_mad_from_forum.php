<?php

class WPBakeryShortCode_VC_mad_from_forum extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'parent_forum' => '',
			'posts_per_page' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_from_forum');

		$this->content = $content;

		return $this->html();
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

		$title = $posts_per_page = $parent_forum = $css_animation = '';
		
		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		
		$settings['order_by'] = 'popular';
		
		
		// How do we want to order our results?
		switch ( $settings['order_by'] ) {

			// Order by most recent replies
			case 'freshness' :
				$topics_query = array(
					'post_type'           => bbp_get_topic_post_type(),
					'post_parent'         => $parent_forum,
					'posts_per_page'      => $posts_per_page,
					'post_status'         => array( bbp_get_public_status_id(), bbp_get_closed_status_id() ),
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
					'meta_key'            => '_bbp_last_active_time',
					'orderby'             => 'meta_value',
					'order'               => 'DESC',
				);
				break;

			// Order by total number of replies
			case 'popular' :
				$topics_query = array(
					'post_type'           => bbp_get_topic_post_type(),
					'post_parent'         => $parent_forum,
					'posts_per_page'      => $posts_per_page,
					'post_status'         => array( bbp_get_public_status_id(), bbp_get_closed_status_id() ),
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
					'meta_key'            => '_bbp_reply_count',
					'orderby'             => 'meta_value',
					'order'               => 'DESC'
				);
				break;

			// Order by which topic was created most recently
			case 'newness' :
			default :
				$topics_query = array(
					'post_type'           => bbp_get_topic_post_type(),
					'post_parent'         => $parent_forum,
					'posts_per_page'      => $posts_per_page,
					'post_status'         => array( bbp_get_public_status_id(), bbp_get_closed_status_id() ),
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
					'order'               => 'DESC'
				);
				break;
		}

		// Note: private and hidden forums will be excluded via the
		// bbp_pre_get_posts_normalize_forum_visibility action and function.
		$widget_query = new WP_Query( $topics_query );

		// Bail if no topics are found
		if ( ! $widget_query->have_posts() ) {
			return;
		}
		
		
		
		ob_start() ?>
		
		<div class="section widget_from_forum">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); 
				
				?>
			<?php endif; ?>
		
			<ul class="comments_list comments_list_var2">
			
			
			
			<?php while ( $widget_query->have_posts() ) :

				$widget_query->the_post();
				$topic_id    = bbp_get_topic_id( $widget_query->post->ID );
				$author_link = '';

				$author_link = bbp_get_topic_author_link( array( 'post_id' => $topic_id, 'type' => 'name') );
				?>

				<li class="post_text">
					
					
					<?php if ( ! empty( $author_link ) ) : ?>

						<?php echo $author_link; ?>
						<span>on</span>
						<br>
					<?php endif; ?>
					
					<a class="widget-forum-title" href="<?php bbp_topic_permalink( $topic_id ); ?>"><h4 class="second_font"><?php bbp_topic_title( $topic_id ); ?></h4></a>

						<div class="event_date"><?php bbp_topic_last_active_time( $topic_id ); ?></div>

					

				</li>

			<?php endwhile; 
			
			// Reset the $post global
			wp_reset_postdata();
			?>
	
            </ul>
		
		</div>
		<?php return ob_get_clean();
	}

}