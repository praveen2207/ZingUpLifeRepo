<?php
$this_id = $post->ID;
$tag_ids = array();
$tags = wp_get_post_terms($this_id, 'post_tag');

if (!empty($tags) && is_array($tags)) {

	$query = array(
		'post_type' => 'post',
		'numberposts' => mad_custom_get_option('related_posts_count'),
		'ignore_sticky_posts'=> 1,
		'post__not_in' => array($this_id)
	);

	foreach ($tags as $tag) {
		$tag_ids[] = (int) $tag->term_id;
	}

	if (!empty($tag_ids)) {
		$query['tag__in'] = $tag_ids;

		$entries = get_posts($query);
		?>

		<?php if (!empty($entries)): ?>

			<div class="section photo_gallery">

				<h3 class="section_title">
					<?php esc_html_e('Related Posts', 'revija'); ?>
				</h3>

				<div class="row">

					<div id="owl-demo-related"  class="<?php if(count($entries) <= 4) { echo 'no_controls'; }  ?> related_carousel" >
					<?php foreach($entries as $post): setup_postdata($post); ?>

						<?php
							$id = get_the_ID();
							$format = get_post_format() ? get_post_format() : 'standard';
							$title = $post->post_title;
							
							$post_class = "item post-entry-{$id} entry-format-{$format} related-item";
						?>

						<div <?php post_class($post_class); ?> id="post-<?php the_ID(); ?>">

							<?php echo mad_blog_post_th_btn($id, get_the_content(), $title, 14, '165*110'); ?>
							
							<a href="<?php the_permalink(); ?>"><h4 class="second_font"><?php echo esc_html($title) ?></h4></a>
							<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
					
						</div>

					<?php endforeach; ?>

					</div>
					
				
			<?php 	
				$count_related = 4;
				 $mad_sidebar_position = REVIJA_HELPER::template_layout_class('sidebar_position');
				 if($mad_sidebar_position == 'no_sidebar') {
					 $count_related = 6;
				 }	
			?>
				 
				<script type="text/javascript">
					(function($){
					"use strict";
					
					$(function(){	
						
						
						$("#owl-demo-related").owlCarousel({
						   items : <?php echo absint($count_related); ?>,
						   navSpeed : 800,
						   nav : true,
						   loop: true,
						   navText:false,
						   responsive:{
								 0:{
									 items:2
								 },
								 481:{
									 items:3
								 },
								 980:{
									 items:<?php echo absint($count_related); ?>
								 }
							 }
						 });	
						
					});

					})(jQuery);

				</script>


	
				</div><!--/ .row-->

				<?php wp_reset_postdata(); ?>

			</div><!--/ .photo_gallery-->

		<?php endif; ?>

	<?php
	}
}