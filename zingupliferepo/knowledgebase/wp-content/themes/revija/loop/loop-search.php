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
$post_content =  revija_limit_words($post_content, 50);
$title =  revija_limit_words($title, 6);

$format = get_post_format() ? get_post_format() : 'standard';	
$post_class = "col-lg-6 col-md-6 col-sm-6 col-xs-6 post-item clearfix post-entry-{$id} entry-format-{$format}";
		
?>


	<li <?php post_class('clearfix', $id) ?> >
					
		<?php echo mad_blog_post_th_btn($id, get_the_content(), $title, 14); ?>
		
		<div class="wrapper">
		
			<div class="clearfix">
			<?php echo mad_blog_post_meta($id, ''); ?>
			</div><!--/ .clearfix-->
			
				
			<div class="post_text">
			<?php if (is_sticky($id)): ?>
				<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
			<?php endif; ?>
			
				<h4 class="post_title second_font">
					<?php if ($title != '') { ?>
						<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
					<?php } else { ?>
						<a href="<?php echo esc_url($link) ?>"><?php esc_html_e('No Title', 'revija'); ?></a>
					<?php } ?>
				</h4>

			<?php echo (!empty($post_content)) ? "<p>{$post_content}</p>" : ''; ?>

			</div><!--/ .post_text-->
			
		</div>
		
	</li>	
