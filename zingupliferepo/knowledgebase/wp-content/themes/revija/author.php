<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Revija
 * @since Revija 1.0
 */
get_header(); ?>


<?php if ( have_posts() ) : ?>

	<?php 
	    $mad_results = mad_which_archive(); 
		
		$id = get_query_var('author');
		$name  =  get_the_author_meta('display_name', $id);
		$email =  get_the_author_meta('email', $id);
		$website =  get_the_author_meta('url', $id);
		$heading      = esc_html__("About", "revija") ." ". $name;
		$description  = get_the_author_meta('description', $id);

		$facebook =  get_the_author_meta('facebook', $id);
		$twitter =  get_the_author_meta('twitter', $id);
		$googleplus =  get_the_author_meta('googleplus', $id);
		$rss =  get_the_author_meta('rss', $id);
		$pinterest =  get_the_author_meta('pinterest', $id);
		$instagram =  get_the_author_meta('instagram', $id);
		$linkedin =  get_the_author_meta('linkedin', $id);
		$vimeo =  get_the_author_meta('vimeo', $id);
		$youtube =  get_the_author_meta('youtube', $id);
		$flickr =  get_the_author_meta('flickr', $id);
		
		if (current_user_can('edit_users') || get_current_user_id() == $id) {
			$description .= " <a href='" . admin_url( 'profile.php?user_id=' . $id ) . "'>". esc_html__( '[ Edit the profile ]', 'revija' ) ."</a>";
		}
	?>
	
	
	<div class="section">
	
	<?php if (!empty($mad_results)): ?>
			<h2 class="section_title section_title_big"><?php echo esc_html($heading); ?></h2>
	<?php endif; ?>		
			
			
			
			<div class="author_details clearfix">
			  <div class="f_left">
				<div>
				  <?php echo get_avatar($email, '165', '', esc_html($name)); ?>
				</div>
				
				<div class="button button_type_3 button_grey_light no_link"><?php echo number_format_i18n( get_the_author_posts() ); ?> <?php echo  esc_html__( 'articles', 'revija' ); ?></div>
			  </div>
			  <div>
				<p><?php echo wp_kses_post($description); ?></p>
				
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
					  <a href="mailto:<?php echo esc_url($email); ?>">
						<i class="fa fa-envelope-o"></i>
					  </a>
					</li>
					<?php } ?>
					
				  </ul>
				</div>
				
			  </div>
			</div>
    </div>
	
	
	<!--Author Posts-->
	<div class="section read_post_list">
	  <h3 class="section_title"><?php echo  esc_html__( 'All posts by ', 'revija' ); ?><?php echo esc_html($name); ?></h3>

		<ul class="row">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			get_template_part( 'loop/loop', 'author' );
		endwhile;
		?>

		</ul><!--/ .row-->
		
		
	</div><!--/ .section-->

	
	<?php echo mad_corenavi(); ?>
	


<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'content', 'none' );

endif; ?>



<?php get_footer(); ?>