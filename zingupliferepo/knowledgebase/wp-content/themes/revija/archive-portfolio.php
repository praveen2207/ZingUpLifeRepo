<?php
/**
 * The template for displaying Portfolio Archive area.
 */

get_header(); ?>

	<?php $mad_results = mad_which_archive(); ?>

	<div class="template-area portfolio-area">

		<?php if (!empty($mad_results)): ?>
			<h2 class="extra-title"><?php echo esc_html($mad_results) ?></h2>
		<?php endif; ?>

		<?php if (have_posts()): ?>

			<?php
			$mad_columns = mad_custom_get_option('portfolio_archive_column_count');

			switch ($mad_columns) {
				case 2: $mad_grid = 'two_columns';  break;
				case 3: $mad_grid = 'three_columns';  break;
				case 4: $mad_grid = 'four_columns';   break;
				default: $mad_grid = 'three_columns'; break;
			}
			?>

			<div data-layout-type="fitRows" class="portfolio-items portfolio-isotope <?php echo esc_attr($mad_grid) ?>">

				<?php while (have_posts()) : the_post(); ?>

					<?php
						$id = get_the_ID();
						$link  = get_permalink();
						$title = get_the_title();
						$cur_terms = get_the_terms($id, 'portfolio_categories');
						$thumbnail_atts = array(
							'class'	=> "tr_all_long_hover",
							'alt'	=> trim(get_the_excerpt()),
							'title'	=> trim(get_the_title()),
						);

						$thumbnail = '';
						$post_thumbnail = get_post_thumbnail_id($id);

						if (isset($post_thumbnail) && $post_thumbnail > 0) {
							$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($id), '');
							if (is_array($thumbnail) && isset($thumbnail[0])) {
								$thumbnail = $thumbnail[0];
							}
						}

					?>

					<div class="portfolio-item">

						<div class="image-overlay">
							<div class="photoframe with-buttons">
								<?php echo REVIJA_HELPER::get_the_post_thumbnail($id, '550*345', $thumbnail_atts); ?>
								<div class="open-buttons clearfix">
									<a href="<?php echo esc_url($thumbnail) ?>" class="open-button lightbox-icon jackbox" data-group="<?php echo 'portfolio-' . rand() ?>" data-title="<?php echo esc_attr($title) ?>"><span class="curtain"></span></a>
									<a href="<?php echo esc_url($link) ?>" class="open-button link-icon"><span class="curtain"></span></a>
								</div><!--/ .open-buttons-->
							</div><!--/ .with-buttons-->
						</div><!--/ .image-overlay-->

						<div class="text-holder">

							<h4 class="entry-title">
								<a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr(strip_tags($title)); ?>">
									<?php echo esc_html($title); ?>
								</a>
							</h4><!--/ .entry-title-->

							<?php if (!empty($cur_terms)): ?>
								<div class="post-meta">
									<?php foreach($cur_terms as $cur_term): ?>
										<a href="<?php echo esc_url(get_term_link( (int) $cur_term->term_id, $cur_term->taxonomy )) ?>">
											<?php echo esc_html($cur_term->name); ?>
										</a>
									<?php endforeach; ?>
								</div><!--/ .post-meta-->
							<?php endif; ?>

						</div><!--/ .text-holder-->

					</div><!--/ .portfolio-item-->

				<?php endwhile; // end of the loop. ?>

			</div><!--/ .portfolio-items-->

			<?php echo mad_corenavi(); ?>

		<?php endif; ?>

	</div><!--/ .template-area-->

<?php get_footer(); ?>