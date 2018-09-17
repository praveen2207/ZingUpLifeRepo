<?php
/**
* The template for home pages
*
* Please note that this is the WordPress construct of pages and that
* other "pages" on your WordPress site will use a different template.
*
* @package WordPress
* @subpackage Revija
* @since Revija 1.0
*/
 ?>
 
<?php
// Template Name: Page Home
 ?>
 
<?php
get_header(); ?>


<!-- - - - - - - - - - - - - Page - - - - - - - - - - - - - - - -->

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<div class="home_page content_post_block">
			
			
			
			<?php

			//remove_filter ('the_content', 'wpautop');
			
			/* translators: %s: Name of current post */
			the_content( sprintf(
				esc_html__( 'Continue reading %s', 'revija' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

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

