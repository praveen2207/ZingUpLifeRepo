<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
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

	<div class="section template-archive">
	
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