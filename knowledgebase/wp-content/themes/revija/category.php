<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Revija
 * @since Revija 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php $mad_results = mad_which_archive(); ?>
<div class="section template-category">
	
	
	<?php if (!empty($mad_results)): ?>
		<h2 class="section_title section_title_big"><?php echo esc_html($mad_results); ?></h2>
	<?php endif; ?>

	<ul class="vertical_list type2">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			get_template_part( 'loop/loop', 'search' );
		endwhile;
		?>

	</ul><!--/ .row-->

</div><!--/ .section-->	


	<?php echo mad_corenavi(); ?>

<?php else: ?>

	<div class="section">
	<?php
		// If no content, include the "No posts found" template.
		get_template_part( 'content', 'none' ); ?>
		
	</div><!--/ .section-->	
	
<?php endif; ?>

<?php get_footer(); ?>