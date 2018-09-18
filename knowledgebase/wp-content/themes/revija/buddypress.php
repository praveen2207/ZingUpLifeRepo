<?php
/**
* The template for displaying pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages and that
* other "pages" on your WordPress site will use a different template.
*
* @package WordPress
* @subpackage Revija
* @since Revija 1.0
*/

get_header(); ?>


<!-- - - - - - - - - - - - - Page - - - - - - - - - - - - - - - -->

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<div class="section content_post_block">
			
			 <h2 class="section_title section_title_big"><?php echo get_the_title(); ?></h2>
			
			<?php

				the_content();

				wp_link_pages( array(
					'before'      => '<div class="pagination" role="navigation">',
					'after'       => '</div>'
				) );

			?>
		</div><!--/ .section-main-->

	<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<!-- - - - - - - - - - - - -/ Page - - - - - - - - - - - - - - -->


<?php get_footer(); ?>

