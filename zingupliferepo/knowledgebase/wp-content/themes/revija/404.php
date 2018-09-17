<?php
// Template Name: Page 404
 ?>
 
 
<?php get_header(); ?>

	<div class="template-404">

		<div class="row">

		<div class="col-lg-3 col-md-3 col-sm-0"></div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="section page_404">
              <?php echo html_entity_decode(mad_custom_get_option('440_content')); ?>
              <div class="buttons_404">
                <a href="<?php echo REVIJA_HOME_URL; ?>" class="button button_type_2 button_grey_light"><?php esc_html_e("Go to Previous page", "revija") ?></a>
                <a href="<?php echo REVIJA_HOME_URL; ?>" class="button button_type_2 button_grey_light"><?php esc_html_e("Go to Home page", "revija") ?></a>
              </div>
		
		  <?php
			$type_post = 'post';
			
			if (isset($_GET['post_type']) && $_GET['post_type'] == 'product' && function_exists('get_product_search_form')) {
				$type_post = 'product';
				get_product_search_form();
			} else { 
			$type_post = 'post';
			?>
					
					
		<form class="search 404_search type_404"  method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
			<input type="text" autocomplete="off" name="s" placeholder="<?php esc_attr_e( 'Search', 'revija' ) ?>"  value="<?php echo(isset($_GET['s']) ? $_GET['s'] : ''); ?>" />
			<button class=""><i class="fa fa-search"></i></button>
		</form>
		
			<?php	
			}
			?>
			  
			  
            </div>
          </div>
        <div class="col-lg-3 col-md-3 col-sm-0"></div>
			
		</div><!--/ .row-->

		
		
		
	<div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">	
		 <div class="section">
              <h3 class="section_title"><?php esc_html_e("Most Read", "revija") ?></h3>
			<?php 
			$args = array( 'post_type' => $type_post,
							'numberposts' => 3,
							'meta_key' => 'post_views_count',
							'orderby'  => 'meta_value_num',
							'order'=> 'DESC'
							);
			$entries = get_posts( $args );
			 ?>	
		
			<ul class="post_list">
			<?php foreach($entries as $post): setup_postdata($post); ?>

				<?php
					$id = get_the_ID();
					$format = get_post_format() ? get_post_format() : 'standard';
					$title = $post->post_title;
				?>
				
				<li <?php post_class('clearfix'); ?> >
				
					<?php echo mad_blog_post_th_btn($id, get_the_content(), $title, 14, '165*110'); ?>
					
					<div class="post_text">
					
						<?php if (is_sticky($id)): ?>
							<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
						<?php endif; ?>
					
						<a href="<?php the_permalink(); ?>"><h4 class="second_font"><?php echo esc_html($title) ?></h4></a>
						<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
					</div>
			
				</li> 
			<?php endforeach; ?>
			 </ul>

		<?php wp_reset_postdata(); ?>
		 </div>
		</div>
   
		<div class="col-lg-4 col-md-4 col-sm-12">	
		 <div class="section">
              <h3 class="section_title"><?php esc_html_e("Most Commented", "revija") ?></h3>
		
			<?php 
			$args = array( 'post_type' => $type_post,
							'numberposts' => 3,
							'order'=> 'DESC',
							'orderby' => 'comment_count'
							);
			$entries = get_posts( $args );
			 ?>	
		
			<ul class="post_list">
			<?php foreach($entries as $post): setup_postdata($post); ?>

				<?php
					$id = get_the_ID();
					$format = get_post_format() ? get_post_format() : 'standard';
					$title = $post->post_title;
					$comments_count = get_comments_number($id);
				?>
				
				<li <?php post_class('clearfix'); ?> >
				
					<?php echo mad_blog_post_th_btn($id, get_the_content(), $title, 14, '165*110'); ?>
					
					<div class="post_text">
					
						<?php if (is_sticky($id)): ?>
							<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
						<?php endif; ?>
					
						<a href="<?php the_permalink(); ?>"><h4 class="second_font"><?php echo esc_html($title) ?></h4></a>
						<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
					</div>
			
				</li> 
			<?php endforeach; ?>
			 </ul>
	
		<?php wp_reset_postdata(); ?>
		 </div>
		</div>

        <div class="col-lg-4 col-md-4 col-sm-12">	
		 <div class="section">
              <h3 class="section_title"><?php esc_html_e("Most Liked", "revija") ?></h3>
		
			<?php 
			$args = array( 'post_type' => $type_post,
							'numberposts' => 3,
							'order'=> 'DESC',
							'orderby' => 'comment_count'
							);
			$entries = get_posts( $args );
			 ?>	
		
			<ul class="post_list">
			<?php foreach($entries as $post): setup_postdata($post); ?>

				<?php
					$id = get_the_ID();
					$format = get_post_format() ? get_post_format() : 'standard';
					$title = $post->post_title;
				?>
				
				<li <?php post_class('clearfix'); ?> >
				
					<?php echo mad_blog_post_th_btn($id, get_the_content(), $title, 14, '165*110'); ?>
					
					<div class="post_text">
					
						<?php if (is_sticky($id)): ?>
							<?php printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); ?>
						<?php endif; ?>
					
						<a href="<?php the_permalink(); ?>"><h4 class="second_font"><?php echo esc_html($title) ?></h4></a>
						<div class="event_date"><?php echo get_the_time(get_option('date_format')) ?></div>
					</div>
			
				</li> 
			<?php endforeach; ?>
			 </ul>
	
		<?php wp_reset_postdata(); ?>
		 </div>
		</div>

    </div>		

	</div><!--/ .template-404-->

<?php get_footer(); ?>