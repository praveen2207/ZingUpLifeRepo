<?php
	/**
	 * The template for displaying Search Results pages.
	 */
	get_header();

?>

	<?php $mad_results = mad_which_archive(); ?>

	<div class="section template-search">

		<?php if (!empty($mad_results)): ?>
			<h2 class="section_title section_title_big"><?php echo esc_html($mad_results) ?></h2>
		<?php endif; ?>

		
		
		<form class="search 404_search type_404"  method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
			<input type="text" autocomplete="off" name="s" placeholder="<?php esc_attr_e( 'Search', 'revija' ) ?>"  value="<?php echo(isset($_GET['s']) ? $_GET['s'] : ''); ?>" />
			<button class=""><i class="fa fa-search"></i></button>
		</form>
		
		
		
		
		<?php if (!empty($_GET['s']) || have_posts()): ?>
			
			<ul class="vertical_list type2">
			<?php

			if (have_posts()):

				$loop_count = 1;
				$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if ($page > 1) {
					$loop_count = ((int) ($page - 1) * (int) get_query_var('posts_per_page')) + 1;
				}

				while (have_posts()) : the_post(); 
				
				get_template_part( 'loop/loop', 'search' );

				endwhile; ?>

			<?php else: ?>

				<?php get_template_part('content', 'none'); ?>

			<?php endif; ?>

		</ul>
		
		
		<?php echo mad_corenavi(); ?>

		
		<?php endif; ?>

	</div><!--/ .template-search-->

<?php get_footer(); ?>
