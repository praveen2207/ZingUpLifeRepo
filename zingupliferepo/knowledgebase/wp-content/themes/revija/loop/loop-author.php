<?php
$id = get_the_ID();
$link = get_permalink($id);
$title = get_the_title();

$excerpt = trim(get_the_excerpt());
if (!empty($excerpt)) {
	$post_content = get_the_excerpt();
} else {
	$excerpt = preg_replace( '~\[[^\]]+\]~', '', get_the_content() );
	$post_content =  $excerpt;
}

$post_content =  revija_limit_words($post_content, 16);
$title =  revija_limit_words($title, 2);

$format = get_post_format() ? get_post_format() : 'standard';	
$post_class = "col-lg-6 col-md-6 col-sm-6 col-xs-6 post-item clearfix post-entry-{$id} entry-format-{$format}";	
?>


	<li <?php post_class($post_class, $id) ?>>
	<div class="section_post_left">
		
		<?php echo mad_blog_post_th_btn($id, get_the_content(), $title, 14, mad_blog_alias('standard', '', 'blog-style-2')); ?>

			<div class="clearfix">
			<?php echo mad_blog_post_meta($id, ''); ?>
			</div><!--/ .clearfix-->
			
			<div class="post_text">
				<?php if (is_sticky($id)): ?>
					<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
				<?php endif; ?>
				
				<h2 class="post_title second_font">
					<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
				</h2>

				<?php echo (!empty($post_content)) ? "<p>{$post_content}</p>" : ''; ?>

				<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links clearfix"><span class="page-links-title">' . esc_html__( 'Pages: ', 'revija') . '</span>',
					'after'       => '</div>',
					'link_before' => '<span class="page-links-btn">',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'revija') . ' </span>%',
					'separator'   => '',
				) );
				?>

				
				
				<a href="<?php echo esc_url($link); ?>" class="button button_type_2 button_grey_light">
					<?php esc_html_e('Read More', 'revija'); ?>
				</a>

				
				
			</div><!--/ .post_text-->
			
	</div><!--/ .section_post_left-->
	</li><!--/ .post-item-->



