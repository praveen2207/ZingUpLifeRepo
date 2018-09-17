<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* e.g., it puts together the home page when no home.php file exists.
*
* @package WordPress
* @subpackage Revija
* @since Revija 1.0
*/

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div class="post-area main-post section read_post_list">
<ul>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			get_template_part( 'loop/loop', 'index' );
		endwhile;
		?>
</ul>
	</div><!--/ .post-area-->

	<div class="clearfix"></div>
	<?php echo mad_corenavi(); ?>

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'content', 'none' );

endif; ?>

<?php get_footer(); ?>