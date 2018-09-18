
<?php
	if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
?>

<!-- - - - - - - - - - - - Comments - - - - - - - - - - - - - - -->

<div class="theme-respond section">

	<?php if ( have_comments() ): ?>

		<!-- - - - - - - - - - - end Comments - - - - - - - - - - - - - -->

		<div id="comments">

			<h3 class="section_title">
				<?php echo get_comments_number() . " " . esc_html__('Comments', 'revija'); ?>
			</h3>

			<ul class="comments" style="list-style:none;">
				<?php wp_list_comments('avatar_size=80&callback=mad_output_comments'); ?>
			</ul>

			<?php if (get_comment_pages_count() > 1 && get_option( 'page_comments' )): ?>
			<div class="pagination_block">
				<ul class="comments-pagination pagination clearfix">
					<?php 
					$args = array(
						'base' => add_query_arg( 'cpage', '%#%' )
						,'format' => null
						,'echo' => true
						,'add_fragment' => '#comments'
						,'type'               => 'list'
						,'prev_text' => '<i class="fa fa-angle-left"></i>'
						,'next_text' => '<i class="fa fa-angle-right"></i>'
					);
					paginate_comments_links( $args ); ?>
				</ul>
			</div><!--/ .pagination_block-->	
			<?php endif; ?>

			<?php if (! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' )): ?>
				<p class="nocomments"><?php esc_html_e('Comments are closed.', 'revija'); ?></p>
			<?php endif; ?>

		</div><!--/ #comments-->

	<?php endif; ?>

	<!-- - - - - - - - - - - - Respond - - - - - - - - - - - - - - - -->

	<?php if (comments_open()) : ?>
	<div class="section">
		<?php comment_form(array(
			'title_reply' => esc_html__('Add Comment', 'revija')
		)); ?>
	</div><!--/ .section-->	
	<?php endif; ?>

	<!-- - - - - - - - - - -/ end Respond - - - - - - - - - - - - - -->

</div><!--/ .theme-respond-->