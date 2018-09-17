<?php
$id = get_the_ID();
$link = get_permalink($id);
$title = get_the_title();
$title =  revija_limit_words($title, 10);

$format = get_post_format() ? get_post_format() : 'standard';	
$post_class = "loop_index col-lg-12 col-md-12 col-sm-12 col-xs-12 post-item clearfix post-entry-{$id} entry-format-{$format}";	
?>


	<li <?php post_class($post_class, $id) ?>>
	<div class="section_post_left">
		
		<?php echo mad_blog_post_th_index($id, get_the_content(), $title, 14); ?>

			<div class="clearfix">
			<?php echo mad_blog_post_meta($id, ''); ?>
			</div><!--/ .clearfix-->
			
			<div class="post_text">
				<?php if (is_sticky($id)): ?>
					<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
				<?php endif; ?>
				
				<h2 class="post_title second_font">
					<?php if ($title != '') { ?>
						<a href="<?php echo esc_url($link) ?>"><?php the_title(); ?></a>
					<?php } else { ?>
						<a href="<?php echo esc_url($link) ?>"><?php esc_html_e('No Title', 'revija'); ?></a>
					<?php } ?>
				</h2>

				<?php
				if (has_excerpt($id)) {
					$post_content = apply_filters('the_excerpt', get_the_excerpt());
				} else {
					$post_content = apply_filters('the_content', get_the_content(sprintf(
						esc_html__( 'Continue reading %s', 'revija' ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					)));
				}

				echo (!empty($post_content)) ? "{$post_content}" : '';
				?>

				<?php
				$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'revija' ) );
				if ( $categories_list ) {
					printf( '<p class="cat-links clearfix"><span class="screen-reader-text">%1$s </span>%2$s</p>',
						_x( 'Categories', 'Used before category names.', 'revija' ),
						$categories_list
					);
				}
				?>
				
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
