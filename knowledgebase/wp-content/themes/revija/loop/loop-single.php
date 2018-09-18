<?php
$this_post = array();
$this_post['post_id'] = $this_id = get_the_ID();
$this_post['post_format'] = $format = get_post_format() ? get_post_format() : 'standard';
$this_post['content'] = get_the_content();
$this_post['image_size'] = mad_blog_alias($format);
$link = get_permalink($this_id);
$extended = rwmb_meta('mad_extended_featured', '', $this_id);

$title = get_the_title();

$this_post = apply_filters('revija-entry-format-single', $this_post);
extract($this_post);
?>
<article <?php post_class('post-entry'); ?>>

	
	<div class="section">
	<?php if (!$extended) { ?>
		<div class="clearfix page_theme">

			<?php echo mad_blog_post_meta($this_id); ?>

		</div>

		<h2 class="section_title section_title_medium_var2 second_font">
			<?php if ($title != '') { ?>
				<?php echo esc_html($title) ?>
			<?php } else { ?>
				<?php esc_html_e('No Title', 'revija'); ?>
			<?php } ?>
		
		</h2>
		
		
		
	<?php } ?>
	</div><!--/ .row-->

	
	<?php if (!$extended) { ?>
	<?php echo (!empty($before_content)) ? $before_content : ""; ?>
	<?php } ?>
	
	
	<div class="post-body">

		<?php echo apply_filters('the_content', $content); ?>

		
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
		
		
		<?php if (mad_custom_get_option('blog-single-share')): ?>
		<div class="text_post_section add_this">
			<span><?php esc_html_e('Share this:', 'revija') ?></span>
			<div>
			  <!-- AddThis Button BEGIN -->
			  <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
			  </div>
			  <!-- AddThis Button END -->
			  <?php REVIJA_BASE_FUNCTIONS::enqueue_script('addthis'); ?>
			</div>
        </div>
		<?php endif;  ?>
		
		
		
		<?php if (is_single() && has_tag() && !post_password_required()): ?>
		 <div class="text_post_section tags_section side_bar_tabs">
                <span><?php esc_html_e('Tags:', 'revija') ?></span>
                <div class="widget_tags">
                  <div class="box-tags">
                    <?php the_tags('', ' ', ''); ?>
                  </div>
                </div>
         </div>
		<?php endif; ?>
	


		<?php if (mad_custom_get_option('blog-single-link-pages')): ?>
			<?php get_template_part('loop/single', 'link-pages'); ?>
		<?php endif; ?>

		
		
		<?php if (mad_custom_get_option('blog-single-meta-author')): ?>

			<?php
				$id = get_the_author_meta('ID');
				$name  =  get_the_author_meta('display_name');
				$email =  get_the_author_meta('email');
				$website =  get_the_author_meta('url');
				$heading      = esc_html__("About", "revija") ." ". $name;
				$description  = get_the_author_meta('description');

				$facebook =  get_the_author_meta('facebook');
				$twitter =  get_the_author_meta('twitter');
				$googleplus =  get_the_author_meta('googleplus');
				$rss =  get_the_author_meta('rss');
				$pinterest =  get_the_author_meta('pinterest');
				$instagram =  get_the_author_meta('instagram');
				$linkedin =  get_the_author_meta('linkedin');
				$vimeo =  get_the_author_meta('vimeo');
				$youtube =  get_the_author_meta('youtube');
				$flickr =  get_the_author_meta('flickr');

				
				
				if (current_user_can('edit_users') || get_current_user_id() == $id) {
					$description .= " <a href='" . admin_url( 'profile.php?user_id=' . $id ) . "'>". esc_html__( '[ Edit the profile ]', 'revija' ) ."</a>";
				}
			?>
		
		<div class="section">
			<h3 class="section_title"><?php echo esc_html($heading); ?></h3>
			<div class="author_details clearfix">
			  <div class="f_left">
				<div>
				  <?php echo get_avatar($email, 165, '', esc_html($name)); ?>
				</div>
			  </div>
			  <div>
				<p><?php echo $description; ?></p>
				
				<div class="widget widget_social_icons type_2 type_border clearfix">
				  <ul>
				    <?php if ( $website != '') { ?>
					<li class="website">
					  <span class="tooltip">Website</span>
					  <a href="<?php echo esc_url($website); ?>">
						<i class="fa fa-home"></i>
					  </a>
					</li>
					<?php } ?>
					
					 <?php if ( $facebook != '') { ?>
					<li class="facebook">
					  <span class="tooltip">Facebook</span>
					  <a href="<?php echo esc_url($facebook); ?>">
						<i class="fa fa-facebook"></i>
					  </a>
					</li>
					<?php } ?>
					<?php if ( $twitter != '') { ?>
					<li class="twitter">
					  <span class="tooltip">Twitter</span>
					  <a href="<?php echo esc_url($twitter); ?>">
						<i class="fa fa-twitter"></i>
					  </a>
					</li>
					<?php } ?>
					<?php if ( $googleplus != '') { ?>
					<li class="google_plus">
					  <span class="tooltip">Google+</span>
					  <a href="<?php echo esc_url($googleplus); ?>">
						<i class="fa fa-google-plus"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $rss != '') { ?>
					<li class="rss">
					  <span class="tooltip">Rss</span>
					  <a href="<?php bloginfo('rss2_url'); ?>">
						<i class="fa fa-rss"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $pinterest != '') { ?>
					<li class="pinterest">
					  <span class="tooltip">Pinterest</span>
					  <a href="<?php echo esc_url($pinterest); ?>">
						<i class="fa fa-pinterest"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $instagram != '') { ?>
					<li class="instagram">
					  <span class="tooltip">Instagram</span>
					  <a href="<?php echo esc_url($instagram); ?>">
						<i class="fa fa-instagram"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $linkedin != '') { ?>
					<li class="linkedin">
					  <span class="tooltip">LinkedIn</span>
					  <a href="<?php echo esc_url($linkedin); ?>">
						<i class="fa fa-linkedin"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $vimeo != '') { ?>
					<li class="vimeo">
					  <span class="tooltip">Vimeo</span>
					  <a href="<?php echo esc_url($vimeo); ?>">
						<i class="fa fa-vimeo-square"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $flickr != '') { ?>
					<li class="youtube">
					  <span class="tooltip">Youtube</span>
					  <a href="<?php echo esc_url($youtube); ?>">
						<i class="fa fa-youtube-play"></i>
					  </a>
					</li>
					<?php } ?>
					 <?php if ( $flickr != '') { ?>
					<li class="flickr">
					  <span class="tooltip">Flickr</span>
					  <a href="<?php echo esc_url($flickr); ?>">
						<i class="fa fa-flickr"></i>
					  </a>
					</li>
					<?php } ?>
					<?php if ( $email != '') { ?>
					<li class="envelope">
					  <span class="tooltip">Email</span>
					  <a href="mailto:<?php echo sanitize_email($email); ?>">
						<i class="fa fa-envelope-o"></i>
					  </a>
					</li>
					<?php } ?>
					
				  </ul>
				</div>
				
			  </div>
			</div>
        </div>
		<?php endif; ?>
		
		
		
		
		
		<?php

		$advertising_url = rwmb_meta('mad_advertising_url', '', $this_id);
		
		if( !empty($advertising_url) && $advertising_url != '' ) {
		?>
		  <div class="section t_align_c">
			<?php echo wp_kses_post($advertising_url); ?>
		  </div>
		<?php 
		}
		?>

		
		
		
		
		<?php if (mad_custom_get_option('blog-single-related-posts')): ?>
			<?php get_template_part('loop/single', 'related-posts'); ?>
		<?php endif; ?>

	</div><!--/ .post-body-->

</article><!--/ .post-entry-->