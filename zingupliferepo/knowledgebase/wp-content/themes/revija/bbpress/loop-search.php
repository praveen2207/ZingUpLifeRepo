<?php

/**
 * Search Loop
 *
 * @package bbPress
 * @subpackage Theme
*/

?>

<?php do_action( 'bbp_template_before_search_results_loop' ); ?>

<ul id="bbp-search-results" class="forums bbp-search-results section_5">

	<li class="bbp-header">

	<ul class="forum-titles">
		<li class="bbp-search-author"><?php  esc_html_e( 'Author',  'bbpress' ); ?></li><!-- .bbp-reply-author -->

		<li class="bbp-search-content">

			<?php esc_html_e( 'Search Results', 'bbpress' ); ?>

		</li><!-- .bbp-search-content -->

	</ul>
	</li><!-- .bbp-header -->

	<li class="bbp-body">

	<table class="table_type_1 var4">
        <tbody>
		<?php while ( bbp_search_results() ) : bbp_the_search_result(); ?>

			<?php bbp_get_template_part( 'loop', 'search-' . get_post_type() ); ?>

		<?php endwhile; ?>

		</tbody>
	</table>
		
	</li><!-- .bbp-body -->

	
</ul><!-- #bbp-search-results -->

<?php do_action( 'bbp_template_after_search_results_loop' ); ?>