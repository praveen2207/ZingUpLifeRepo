<?php

class WPBakeryShortCode_VC_mad_our_writers extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'type_author' => 'type1',
			'posts_per_page' => 3,
			'css_animation' => ''
		), $atts, 'vc_mad_our_writers');

		$html = $this->html();

		return $html;
	}


	protected function entry_title($title) {
		return "<h3 class='section_title'>" . $title . "</h3>";
	}

	public function getCSSAnimation($css_animation) {
		$output = false;
		if ( $css_animation == 'yes' ) {
			wp_enqueue_script('waypoints');
			$output = true;
		}
		return $output;
	}

	public function html() {

		$css_animation = $items = $type_author = $posts_per_page = $title = '';
		$entries = $this->entries;
		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		ob_start(); ?>

	<?php if ($type_author == 'type1') {?>
		
		<div class="section vc_our_writers">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>

			<ul class="writers_list clearfix">
				<?php 
				global $wpdb;
 
				$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
				$count = 1;
				
				foreach($authors as $author) {
					if($count <= $posts_per_page) {
						$user = new WP_User( $author->ID );

						echo "<li>";
						echo "<a href=\"".home_url()."/?author=";
						echo $author->ID;
						echo "\">";
							echo '<div>';
							echo get_avatar($author->ID);
							echo '</div>';
						
						echo '<div class="post_text">';
							echo '<h4 class="second_font">';
							the_author_meta('display_name', $author->ID);
							echo '</h4>';
							echo '<div class="event_date">';
							
								if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
									foreach ( $user->roles as $role )
										echo $role.'<br>';
								}
							
							echo '</div>';
						echo '</div>';
						
						
						echo "</a>";
						echo "</li>";
					}
					$count++;
				}
				
				?>
				
			</ul><!--/ .writers_list-->

		</div><!--/ .vc_our_writers-->

	<?php } ?>	
	
	<?php if ($type_author == 'type2') { 
	
	
		 if (!empty($title)) {
			 echo $this->entry_title($title);
		 }
	
	
		echo '<div class="authors_list">';
		
		
		global $wpdb;
 
				$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
				$count = 1;
				
				foreach($authors as $author) {
					if($count <= $posts_per_page) {
						$user = new WP_User( $author->ID );
						
						$id = $author->ID;
						$name  =  get_the_author_meta('display_name', $id);
						$email =  get_the_author_meta('email', $id);
						$website =  get_the_author_meta('url', $id);
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
						
					?>	
						
						
			<div class="author_details clearfix">
			  <div class="f_left">
				<div>
				  <?php echo get_avatar($email, '165', '', esc_html($name)); ?>
				</div>
				
				<a href="<?php echo home_url('/'); echo '?author='; echo $author->ID; ?>" class="button button_type_3 button_grey_light"><?php echo count_user_posts( $id, $post_type = 'post' ); ?> <?php echo  esc_html__( 'articles', 'revija' ); ?></a>
			  </div>
			  
			  <div>
			  
			    <div class="post_text">
                    <h4 class="second_font"><?php echo $name; ?></h4>
                    <div class="event_date">
					
					<?php if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
							foreach ( $user->roles as $role )
								echo $role.' ';
						} ?>
						
					</div>
                </div>
			  
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
					  <a href="<?php echo esc_url($website); ?>">
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
					  <a href="mailto:<?php echo $email; ?>">
						<i class="fa fa-envelope-o"></i>
					  </a>
					</li>
					<?php } ?>
					
				  </ul>
				</div>
				
			  </div>
			</div>
						
						
						
						
					<?php	}
					$count++;
					
				}
				
				?>
		
		</div>
	<?php } ?>		
		
		
	<?php if ($type_author == 'type3') {?>
		
		<div class="section widget vc_list_writers">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>

			<ul class="circle_list">
				<?php 
				global $wpdb;
 
				$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
				$count = 1;
				
				foreach($authors as $author) {
					if($count <= $posts_per_page) {
						$user = new WP_User( $author->ID );

						echo "<li><h4 class='second_font'>";
						echo "<a href=\"".home_url()."/?author=";
						echo $author->ID;
						
						echo "\">";
							the_author_meta('display_name', $author->ID);
							
						echo " (";
						echo count_user_posts( $author->ID, $post_type = 'post' ); 
						echo ")";
							
						echo "</a>";
						echo '</h4>';
						
						echo "</li>";
					}
					$count++;
				}
				
				?>
				
			</ul><!--/ .writers_list-->

		</div><!--/ .vc_our_writers-->

	<?php } ?>		
		
		
		
		
		<?php return ob_get_clean();
	}

}