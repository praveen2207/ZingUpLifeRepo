<?php
 
/*  Register Widget Areas
/* ----------------------------------------------------------------- */

$mad_widget_args = array(
	'before_widget' => '<div id="%1$s" class="section widget %2$s"  >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);

$mad_widget_args_footer = array(
	'before_widget' => '<div id="%1$s" class="widget %2$s" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="widget_title">',
	'after_title' => '</h3></div>'
);

$mad_widget_args_header = array(
	'before_widget' => '<div id="%1$s" class="widget widget_header %2$s" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="widget_title">',
	'after_title' => '</h3></div>'
);

// General Widget Area
register_sidebar(array(
	'name' => 'General Widget Area',
	'id' => 'general-widget-area',
	'description'   => esc_html__('For all pages and posts.', 'revija'),
	'before_widget' => $mad_widget_args['before_widget'],
	'after_widget' => $mad_widget_args['after_widget'],
	'before_title' => $mad_widget_args['before_title'],
	'after_title' => $mad_widget_args['after_title']
));

register_sidebar(array(
	'name' => 'Header Widget Area',
	'id' => 'header-widget-area',
	'description'   => esc_html__('For header.', 'revija'),
	'before_widget' => $mad_widget_args_header['before_widget'],
	'after_widget' => $mad_widget_args_header['after_widget'],
	'before_title' => $mad_widget_args_header['before_title'],
	'after_title' => $mad_widget_args_header['after_title']
));

register_sidebar(array(
	'name' => 'Header Weather Area',
	'id' => 'header-weather-area',
	'description'   => esc_html__('For header type 2.', 'revija'),
	'before_widget' => $mad_widget_args_header['before_widget'],
	'after_widget' => $mad_widget_args_header['after_widget'],
	'before_title' => $mad_widget_args_header['before_title'],
	'after_title' => $mad_widget_args_header['after_title']
));


// bbPress Widget Area
register_sidebar(array(
	'name' => 'bbPress Widget Area',
	'id' => 'bbpress-widget-area',
	'description'   => esc_html__('For bbPress pages.', 'revija'),
	'before_widget' => $mad_widget_args['before_widget'],
	'after_widget' => $mad_widget_args['after_widget'],
	'before_title' => $mad_widget_args['before_title'],
	'after_title' => $mad_widget_args['after_title']
));

// buddypress Widget Area
register_sidebar(array(
	'name' => 'Buddypress Widget Area',
	'id' => 'buddypress-widget-area',
	'description'   => esc_html__('For buddypress pages.', 'revija'),
	'before_widget' => $mad_widget_args['before_widget'],
	'after_widget' => $mad_widget_args['after_widget'],
	'before_title' => $mad_widget_args['before_title'],
	'after_title' => $mad_widget_args['after_title']
));



for ($i = 1; $i <= 24; $i++) {
	register_sidebar(array(
		'name' => 'Footer Row - widget ' . $i,
		'id' => 'footer-row-' . $i,
		'before_widget' => $mad_widget_args_footer['before_widget'],
		'after_widget' => $mad_widget_args_footer['after_widget'],
		'before_title' => $mad_widget_args_footer['before_title'],
		'after_title' => $mad_widget_args_footer['after_title']
	));
}




/*	Actions
/* ----------------------------------------------------------------- */

if (!function_exists('mad_add_to_mailchimp_list')) {

	add_action('wp_ajax_add_to_mailchimp_list', 'mad_add_to_mailchimp_list');
	add_action('wp_ajax_nopriv_add_to_mailchimp_list', 'mad_add_to_mailchimp_list');

	function mad_add_to_mailchimp_list() {

		check_ajax_referer('ajax-nonce', 'ajax_nonce');

		$_POST = array_map('stripslashes_deep', $_POST);
		$apikey = mad_custom_get_option('mad_mailchimp_api');
		$dc = mad_custom_get_option('mad_mailchimp_center');
		$list_id = mad_custom_get_option('mad_mailchimp_id');
		$email = sanitize_email($_POST['email']);
		$name = ''; //sanitize_title($_POST['name']);

		if (empty($name) || $name == null) $name = '';

		$url = "https://$dc.api.mailchimp.com/2.0/lists/subscribe.json";
		$result = array();

		$request = wp_remote_post( $url, array(
			'body' => json_encode( array(
				'apikey' => $apikey,
				'id' => $list_id,
				'email' => array( 'email' => $email ),
				'merge_vars'        => array( 'FNAME' => $name )
			) )
		));

		$data = json_decode(wp_remote_retrieve_body( $request ));

		if (isset($data->error)) {
			$result['status'] = $data->status;
			$result['text'] = $data->error;
			echo json_encode($result);
			exit;
		}

		$result['status'] = 'success';
		$result['text']  = esc_html__('You\'ve been added to our sign-up list. We have sent an email, asking you to confirm the same.', 'revija');

		echo json_encode($result);
		wp_die();
	}

}




/*	Include Widgets
/* ----------------------------------------------------------------- */

 //byddypress
 if ( class_exists('bbPress') ) {
 include_once REVIJA_INCLUDES_PATH . 'widgets/byddypress/bp-groups-widgets.php';
 include_once REVIJA_INCLUDES_PATH . 'widgets/byddypress/bp-core-widgets.php';
 include_once REVIJA_INCLUDES_PATH . 'widgets/byddypress/bp-members-widgets.php';
 }
 
 //bbpress
 if ( class_exists('bbPress') ) {
 include_once REVIJA_INCLUDES_PATH . 'widgets/bbpress/widgets.php';
 }



if (!function_exists('mad_unregistered_widgets')) {
	function mad_unregistered_widgets () {
		
		
		if ( class_exists( 'kklikeMostLiked' ) ) {
			unregister_widget( 'kklikeMostLiked' );
		}
		if ( class_exists( 'kklikeLastLiked' ) ) {
			unregister_widget( 'kklikeLastLiked' );
		}
		if ( class_exists( 'kklikeUserLiked' ) ) {
			unregister_widget( 'kklikeUserLiked' );
		}
		
		
		unregister_widget( 'LayerSlider_Widget' );
		
		if ( class_exists('bbPress') ) {
		unregister_widget( 'BP_Groups_Widget' );
		register_widget('Mad_BP_Groups_Widget');
		
		unregister_widget( 'BP_Core_Login_Widget' );
		register_widget('Mad_BP_Core_Login_Widget');
		
		unregister_widget( 'BP_Core_Members_Widget' );
		unregister_widget( 'BP_Core_Whos_Online_Widget' );
		unregister_widget( 'BP_Core_Recently_Active_Widget' );
		register_widget('Mad_BP_Core_Members_Widget');
		register_widget('Mad_BP_Core_Whos_Online_Widget');
		register_widget('Mad_BP_Core_Recently_Active_Widget');
		
		
		unregister_widget( 'BBP_Login_Widget' );
		register_widget('Mad_BBP_Login_Widget');
		unregister_widget( 'BBP_Views_Widget' );
		register_widget('Mad_BBP_Views_Widget');
		unregister_widget( 'BBP_Search_Widget' );
		register_widget('Mad_BBP_Search_Widget');
		unregister_widget( 'BBP_Forums_Widget' );
		register_widget('Mad_BBP_Forums_Widget');
		unregister_widget( 'BBP_Topics_Widget' );
		register_widget('Mad_BBP_Topics_Widget');
		unregister_widget( 'BBP_Stats_Widget' );
		register_widget('Mad_BBP_Stats_Widget');
		unregister_widget( 'BBP_Replies_Widget' );
		register_widget('Mad_BBP_Replies_Widget');
		}
		
	}
	add_action('widgets_init', 'mad_unregistered_widgets');
}







/**
 * Top Review widget class
 */
 
if (!class_exists('mad_widget_top_review_posts')) {
	 
class mad_widget_top_review_posts extends WP_Widget {

	function __construct() {
			$widget_ops = array(
				'classname' => 'widget_top_review_posts',
				'description' => 'Top Review Posts'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME.' '. esc_html__('Top Review Posts', 'revija'), $widget_ops );
		}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$css_class = '';
		$num_items = ( ! empty( $instance['num_items'] ) ) ? absint( $instance['num_items'] ) : 5;
		$excerptlength = ( ! empty( $instance['excerptlength'] ) ) ? absint( $instance['excerptlength'] ) : 100;
		$sort = $instance['sort']; 
		$post_type  = post_type_exists($instance['post_type']) ? $instance['post_type'] : 'post';

	ob_start();
	
	
	
	echo $before_widget; 
	echo '<div class="widget_top_review_posts_'. $instance['type_display'] .'" >';
	
		if ($title !== '' && $instance['type_display'] != 'type4') {
			echo $before_title . $title . $after_title; 
		}
	
	if ($instance['type_display'] == 'type1') {
		
		$posts = get_posts(array(
        'post_type'  => $post_type,
        'numberposts'     => $num_items,
        'orderby'     => $sort,
        'order'      => 'DESC',
        'offset'     => 0
        ));
		
	 foreach( $posts as $post ) : 
			 $post_id = $post->ID;

			 $title_post = revija_limit_words( ( $post->post_title ), $excerptlength );
			 echo mad_big_blog_post_th_btn($post_id, '', $title_post, 19, '555*374'); 

	 endforeach; 
	 
	 wp_reset_postdata();
	}
	
	
	
	
	
	if ($instance['type_display'] == 'type2') {
		
		$posts = get_posts(array(
        'post_type'  => $post_type,
        'numberposts'     => $num_items,
        'orderby'     => $sort,
        'order'      => 'DESC',
        'offset'     => 0
        ));
		
		
	echo '<div class="owl-demo-2">';	
	 foreach( $posts as $post ) :  
		$post_id = $post->ID;
		$title_post = revija_limit_words( ( $post->post_title ), $excerptlength );

			echo '<div class="item">';
			 
				echo mad_big_blog_post_th_btn($post_id, '', $title_post, 14, '555*374'); 

			echo '</div>';  
	 endforeach; 
	 
	  wp_reset_postdata();
	 
	echo '</div>'; 
	}
	
	
	
	
	if ($instance['type_display'] == 'type3') {
		
		$posts = get_posts(array(
        'post_type'  => $post_type,
        'numberposts'     => $num_items,
        'orderby'     => $sort,
        'order'      => 'DESC',
        'offset'     => 0
        ));
		
		
	echo '<div class="side_bar_reviews"><ul>';	
	 foreach( $posts as $index => $post ) :  
		$post_id = $post->ID;
		$title_post = revija_limit_words( ( $post->post_title ), $excerptlength );

			echo '<li class="clearfix">';
			 
				echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '165*110');

			 
				echo '<div class="post_text">
                    <a href="'. get_permalink($post_id) .'"><h4 class="second_font">'. $title_post .'</h4></a>
                    <div class="event_date">'. get_the_time(get_option('date_format'), $post_id) .'</div>
                  </div>'; 
			 
			echo '</li>';  
	 endforeach; 
	 
	  wp_reset_postdata();
	 
	echo '</ul></div>'; 
	}
	
	
	
	
	
	if ($instance['type_display'] == 'type4') {
		
		
		
		
	echo '<div class="tabs">
                    <!--tabs navigation-->
                    <div class="clearfix tabs_conrainer">
                      <ul class="tabs_nav clearfix">
                        <li class="">
                          <a href="#tab-10">
                            <h3>'. esc_html__( 'Latest Reviews', 'revija' ) .'</h3>
                          </a>
                        </li>
                        <li class="">
                          <a href="#tab-11">
                            <h3>'. esc_html__( 'Top Reviews', 'revija' ) .'</h3>
                          </a>
                        </li>
                      </ul>
                    </div>
					 <!--tabs content-->
                    <div class="tabs_content side_bar_tabs">
                      <div id="tab-10">
                        <div class="review_post">
						<ul class="post_list">';
	
	
	
		$posts = get_posts(array(
        'post_type'  => $post_type,
        'numberposts'     => $num_items,
        'order'      => 'DESC',
        'offset'     => 0
        ));
		
		$countbig = 0;
					 foreach( $posts as $index => $post ) :  
					 $countbig++;
					 
						$post_id = $post->ID;
						$title_post = revija_limit_words( ( $post->post_title ), $excerptlength );
						$post_content = revija_limit_words( ( $post->post_excerpt ), 22 );
						
						
							if($countbig == 1) {
								
								echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '555*374');

								 echo '<div class="clearfix">';
								 echo mad_blog_post_meta($post_id, $post); 
								 echo '</div><!--/ .clearfix-->';
							 
								echo '<div class="post_text">';
								
								
								if (is_sticky($id)) { 
									printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); 
								}
								
								
								echo '<h2 class="post_title second_font" ><a href="'. get_permalink($post_id) .'">'. $title_post .'</a></h2>'; 
								echo (!empty($post_content)) ? "<p>{$post_content}</p>" : '';
								echo '</div>';  
								
								} else {
									
								echo '<li class="clearfix">';
							 
								echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '165*110');

							 
								echo '<div class="post_text">
									<a href="'. get_permalink($post_id) .'"><h4 class="second_font">'. $title_post .'</h4></a>
									<div class="event_date">'. get_the_time(get_option('date_format'), $post_id) .'</div>
								  </div>'; 
									
								echo '</li>';  
									 
								}
							
							
					 endforeach; 
					 
					  wp_reset_postdata();

					echo '</ul></div></div>'; 
	
	
	
			echo '<div id="tab-11">
                <div class="review_post">
				<ul class="post_list">';	
	
	
				$postsall = get_posts(array(
					'post_type'  => $post_type,
					'numberposts'     => $num_items,
					'orderby'     => $sort,
					'order'      => 'DESC',
					'offset'     => 0
					
					));
		$countbig2 = 0;
		
				foreach( $postsall as $index => $post ) :
				$countbig2++;
				
						$post_id = $post->ID;
						$title_post = revija_limit_words( ( $post->post_title ), $excerptlength );
						$post_content = revija_limit_words( ( $post->post_excerpt ), 22 );
							
							
							if($countbig2 == 1) {
								
								echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '555*374');

								 echo '<div class="clearfix">';
								 echo mad_blog_post_meta($post_id, $post); 
								 echo '</div><!--/ .clearfix-->';
							 
								echo '<div class="post_text">';
								
								if (is_sticky($id)) { 
									printf( '<div class="post_theme">%s</div>', esc_html__( 'Exlusive', 'revija' ) ); 
								}
								
								echo '<h2 class="post_title second_font" ><a href="'. get_permalink($post_id) .'">'. $title_post .'</a></h2>'; 
								echo (!empty($post_content)) ? "<p>{$post_content}</p>" : '';
								echo '</div>';  
								
								} else {
							
							
							echo '<li class="clearfix">';
							 
								echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '165*110');

							 
								echo '<div class="post_text">
									<a href="'. get_permalink($post_id) .'"><h4 class="second_font">'. $title_post .'</h4></a>
									<div class="event_date">'. get_the_time(get_option('date_format'), $post_id) .'</div>
								  </div>'; 
							 
							echo '</li>'; 
								}
								
				endforeach; 
				
			echo '</ul></div></div>'; 
	
	echo '</div></div>';

	}
	
	
	
	
	echo '</div>';
	echo '<div class="clearfix"></div>';
    echo $after_widget; 

	
	
	echo ob_get_clean();
	}

	function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
				'num_items' => '',
				'post_type' => '',
				'type_display' => '',
				'sort' => 'post_date',
				'excerptlength' => ''
			));
			
			$title = strip_tags($instance['title']);
			$num_items    = strip_tags($instance['num_items']);
			$type_display = strip_tags($instance['type_display']); 
			$excerptlength = strip_tags($instance['excerptlength']); 
			$sort = strip_tags($instance['sort']); 
			$post_type = post_type_exists($instance['post_type']) ? $instance['post_type'] : 'post';
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'revija' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		
		
		<p>
        <label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>"><?php esc_html_e('Post type:', 'revija'); ?></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_type')); ?>" name="<?php echo esc_attr($this->get_field_name('post_type')); ?>">
			<option value="post"<?php selected( $instance['post_type'], 'post' ); ?>><?php esc_html_e( 'Post', 'revija' ); ?></option>
			<option value="portfolio"<?php selected( $instance['post_type'], 'portfolio' ); ?>><?php esc_html_e( 'Portfolio', 'revija' ); ?></option>
        </select>
        </p>
		

		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'revija' ); ?>
		</label>
		<input id="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_items' )); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" size="3" />
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('excerptlength')); ?>"><?php esc_html_e('Title length', 'revija'); ?>
				<input id="<?php echo esc_attr($this->get_field_id('excerptlength')); ?>" name="<?php echo esc_attr($this->get_field_name('excerptlength')); ?>" size="5" type="text" value="<?php echo esc_attr($excerptlength); ?>"/> <?php esc_html_e('Words', 'revija'); ?>
			</label>
		</p>

		
		<p>
         <label for="<?php echo esc_attr($this->get_field_id('sort')); ?>"><?php esc_html_e('Sort by:', 'revija'); ?></label>
         <select class="wide" id="<?php echo esc_attr($this->get_field_id('sort')); ?>" name="<?php echo esc_attr($this->get_field_name('sort')); ?>">
           <option <?php selected('post_date', $instance['sort']); ?> value="post_date"><?php esc_html_e('post date', 'revija'); ?></option>
           <option <?php selected('comment_count', $instance['sort']); ?> value="comment_count"><?php esc_html_e('comment count', 'revija'); ?></option>
           <option <?php selected('author', $instance['sort']); ?> value="author"><?php esc_html_e('author', 'revija'); ?></option>
         </select>
        </p>
		
		<p>
		<label><?php esc_html_e( 'Type:', 'revija' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('type_display')); ?>" id="<?php echo esc_attr($this->get_field_id('type_display')); ?>" class="widefat">
			<option value="type1"<?php selected( $instance['type_display'], 'type1' ); ?>><?php esc_html_e( 'Type1', 'revija' ); ?></option>
			<option value="type2"<?php selected( $instance['type_display'], 'type2' ); ?>><?php esc_html_e( 'Type2', 'revija' ); ?></option>
			<option value="type3"<?php selected( $instance['type_display'], 'type3' ); ?>><?php esc_html_e( 'Type3', 'revija' ); ?></option>
			<option value="type4"<?php selected( $instance['type_display'], 'type4' ); ?>><?php esc_html_e( 'Type4', 'revija' ); ?></option>
		</select>
		</p>
		
		
		<?php
	}
}

}






/**
 * Random post
 */
 
if (!class_exists('mad_widget_random_posts')) {
	 
class mad_widget_random_posts extends WP_Widget {

	function __construct() {
			$widget_ops = array(
				'classname' => 'widget_random_posts',
				'description' => 'Random posts'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME.' '. esc_html__('Random posts', 'revija'), $widget_ops );
		}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$css_class = '';
		$num_items = ( ! empty( $instance['num_items'] ) ) ? absint( $instance['num_items'] ) : 3;
		$excerptlength = ( ! empty( $instance['excerptlength'] ) ) ? absint( $instance['excerptlength'] ) : 100;
		$date_limit = (int)$instance['date_limit']; 
		$post_type  = post_type_exists($instance['post_type']) ? $instance['post_type'] : 'post';

	ob_start();
	
	
	
	echo $before_widget; 
	echo '<div class="widget_top_review_posts_type3 random_posts" >';
	
		
	echo $before_title . $title . $after_title; 

		$posts = get_posts(array(
        'post_type'  => $post_type,
        'numberposts'     => $num_items,
        'orderby'     => 'rand',
        'order'      => 'DESC',
        'offset'     => 0
        ));
		
		
	echo '<div class="side_bar_reviews"><ul>';	
	 foreach( $posts as $post ) :  
		$post_id = $post->ID;
		$title_post = revija_limit_words( ( $post->post_title ), $excerptlength );

			echo '<li class="clearfix">';
			 
				echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '120*80');

				echo '<div class="post_text">
                    <a href="'. get_permalink($post_id) .'"><h4 class="second_font">'. $title_post .'</h4></a>
                    <div class="event_date">'. get_the_time(get_option('date_format'), $post_id) .'</div>
                  </div>'; 
			 
			echo '</li>';  
	 endforeach; 
	echo '</ul></div>'; 
	
	
	

	
	echo '</div>';
	echo '<div class="clearfix"></div>';
    echo $after_widget; 

	wp_reset_postdata();
	
	echo ob_get_clean();
	}

	function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
				'num_items' => '',
				'post_type' => '',
				'excerptlength' => ''
			));
			
			$title = strip_tags($instance['title']);
			$num_items    = strip_tags($instance['num_items']);
			$excerptlength = strip_tags($instance['excerptlength']); 
			$date_limit = (int)$instance['date_limit']; 
			$post_type = post_type_exists($instance['post_type']) ? $instance['post_type'] : 'post';
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'revija' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		
		
		<p>
        <label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>"><?php esc_html_e('Post type:', 'revija'); ?></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_type')); ?>" name="<?php echo esc_attr($this->get_field_name('post_type')); ?>">
			<option value="post"<?php selected( $instance['post_type'], 'post' ); ?>><?php esc_html_e( 'Post', 'revija' ); ?></option>
			<option value="portfolio"<?php selected( $instance['post_type'], 'portfolio' ); ?>><?php esc_html_e( 'Portfolio', 'revija' ); ?></option>
        </select>
        </p>
		
		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'revija' ); ?>
		</label>
		<input id="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_items' )); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" size="3" />
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('excerptlength')); ?>"><?php esc_html_e('Title length', 'revija'); ?>
				<input id="<?php echo esc_attr($this->get_field_id('excerptlength')); ?>" name="<?php echo esc_attr($this->get_field_name('excerptlength')); ?>" size="5" type="text" value="<?php echo esc_attr($excerptlength); ?>"/> <?php esc_html_e('Words', 'revija'); ?>
			</label>
		</p>

		<?php
	}
}

}






/*	Widget Social Links
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_social_links')) {

	class mad_widget_social_links extends WP_Widget {

		function __construct() {
			$settings = array('classname' => __CLASS__, 'description' => esc_html__('Displays website social links', 'revija'));
			parent::__construct(__CLASS__, REVIJA_THEMENAME .' '. esc_html__('Widget Social Links', 'revija'), $settings);
		}

		function widget($args, $instance) {

			extract($args, EXTR_SKIP);

			$args['instance'] = $instance;
			$args['before_widget'] = $before_widget;
			$args['after_widget'] = $after_widget;
			$args['before_title'] = $before_title;
			$args['after_title'] = $after_title;
			echo REVIJA_HELPER::output_html('social_links', $args);
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['facebook_links'] = $new_instance['facebook_links'];
			$instance['twitter_links'] = $new_instance['twitter_links'];
			$instance['gplus_links'] = $new_instance['gplus_links'];
			$instance['rss_links'] = $new_instance['rss_links'];
			$instance['pinterest_links'] = $new_instance['pinterest_links'];
			$instance['instagram_links'] = $new_instance['instagram_links'];
			$instance['linkedin_links'] = $new_instance['linkedin_links'];
			$instance['vimeo_links'] = $new_instance['vimeo_links'];
			$instance['youtube_links'] = $new_instance['youtube_links'];
			$instance['flickr_links'] = $new_instance['flickr_links'];
			$instance['contact_us'] = $new_instance['contact_us'];
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => 'Social Links',
				'facebook_links' => 'http://www.facebook.com',
				'twitter_links' => 'https://twitter.com',
				'gplus_links' => 'http://plus.google.com/',
				'rss_links' => 'false',
				'pinterest_links' => 'https://www.pinterest.com/',
				'instagram_links' => 'http://instagram.com',
				'linkedin_links' => 'http://linkedin.com/',
				'vimeo_links' => 'https://vimeo.com/',
				'youtube_links' => 'https://youtube.com/',
				'flickr_links' => 'https://www.flickr.com/',
				'contact_us' => 'your@mail.com',
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			$args = array();
			$args['instance'] = $instance;
			$args['widget'] = $this;
			echo REVIJA_HELPER::output_html('social_links_form', $args);
		}

	}
}

/*	Widget Advertising Area
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_advertising_area')) {

	class mad_widget_advertising_area extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'widget_advertising_area',
				'description' => 'An advertising widget that displays image'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME .' '. esc_html__('Advertising Area', 'revija'), $widget_ops );
		}

		function widget($args, $instance) {

			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

			if (empty($instance['image_url'])) {
				$image_url = '<span>'.esc_html__('Advertise here', 'revija').'</span>';
			} else {
				$image_url = '<img class="advertise-image" src="' . esc_url($instance['image_url']) . '" title="" alt=""/>';
			}

			$ref_url = empty($instance['ref_url']) ? '#' : apply_filters('widget_comments_title', $instance['ref_url']);

			ob_start(); ?>

			<?php 
			$before_widget = str_replace('class="', 'class="t_align_c ', $before_widget);
			echo $before_widget; ?>

				<?php if ($title !== ''): ?>
					<?php echo $before_title . $title . $after_title; ?>
				<?php endif; ?>

				<a target="_blank" class="m_top_50 d_block" href="<?php echo esc_url($ref_url); ?>"><?php echo $image_url; ?></a>

			<?php echo $after_widget; ?>

			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
				'image_url' => '',
				'ref_url' => '',
			));
			$title = strip_tags($instance['title']);
			$image_url = strip_tags($instance['image_url']);
			$ref_url = strip_tags($instance['ref_url']); ?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'revija');?>:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image_url')); ?>"><?php esc_html_e('Image URL', 'revija');?>: 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url')); ?>" type="text" value="<?php echo esc_attr($image_url); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('ref_url')); ?>"><?php esc_html_e('Referal URL', 'revija');?>:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ref_url')); ?>" name="<?php echo esc_attr($this->get_field_name('ref_url')); ?>" type="text" value="<?php echo esc_attr($ref_url); ?>" />
				</label>
			</p>

		<?php
		}
	}
}

/*	Widget Contact Us
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_contact_us')) {

	class mad_widget_contact_us extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_contact_us section', 'description' => esc_html__('Displays contact us', 'revija'));
			parent::__construct(__CLASS__, REVIJA_THEMENAME .' '. esc_html__('Widget Contact Us', 'revija'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$address = empty($instance['address']) ? '' : $instance['address'];
			$phone = empty($instance['phone']) ? '' : $instance['phone'];
			$email = empty($instance['email']) ? '' : $instance['email'];
			$info = empty($instance['info']) ? '' : $instance['info'];
			$map = empty($instance['map']) ? '' : $instance['map'];
			$map = trim( vc_value_from_safe( $map ) );
			$zoom = 14; //depreceated from 4.0.2
			$type = 'm'; //depreceated from 4.0.2
			$size = 220;
			$bubble = ''; //depreceated from 4.0.2
			
			
			if ( is_numeric( $size ) ) {
				$map = preg_replace( '/height="[0-9]*"/', 'height="' . $size . '"', $map );
			}
			
			
			ob_start(); ?>

			<?php echo $before_widget; ?>

			<?php if ($title !== ''): ?>
				<?php echo $before_title . $title . $after_title; ?>
			<?php endif; ?>

			
			<div class="t_align_c">
                <div class="map_container">
				
		<?php
		if ( preg_match( '/^\<iframe/', $map ) ) {
			echo $map;
		} 
		else {
			echo '<iframe height="' . $size . '" src="' . $map . '&amp;t=' . $type . '&amp;z=' . $zoom . '&amp;output=embed' . $bubble . '"></iframe>';
		}
		?>

				</div>
            </div>
			
			
			<?php if (!empty($info)): ?>
					<p><?php echo esc_html($info) ?></p>
			<?php endif; ?>
			
			
			
			<ul class="contact_info_list">

				<?php if (!empty($address)): ?>
					<li>
						<div class="clearfix">
							<i class="fa fa-map-marker"></i>
							<p><?php echo esc_html($address) ?></p>
						</div>
					</li>
				<?php endif; ?>

				<?php if (!empty($phone)): ?>
					<li>
						<div class="clearfix">
							<i class="fa fa-phone"></i>
							<p><?php echo esc_html($phone) ?></p>
						</div>
					</li>
				<?php endif; ?>

				<?php if (!empty($email)): ?>
					<li>
						<div class="clearfix m_bottom_10">
							<i class="fa fa-envelope"></i>
							<p><a target="_blank" class="over" href="mailto:<?php echo sanitize_email($email) ?>"><?php echo sanitize_email($email) ?></a></p>
						</div>
					</li>
				<?php endif; ?>


			</ul><!--/ .contact_info_list-->

			<?php echo $after_widget; ?>

			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => 'Contact Details',
				'address' => '8901 Marmora Road, Glasgow, D04 89GR.',
				'phone' => '+1 800 559 6580',
				'email' => 'info@companyname.com',
				'info' => 'Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum <br>libero nisl, porta vel, scelerisque eget.',
				'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12098.04228269596!2d-74.00499255597757!3d40.70677554722762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2z0J3RjNGOLdCZ0L7RgNC6!5e0!3m2!1sru!2s!4v1393474990482'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

			<p>
				<label><?php esc_html_e('Title', 'revija');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text" />
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Address', 'revija');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php echo esc_attr($instance['address']); ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Phone', 'revija');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php echo esc_attr($instance['phone']); ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('E-mail', 'revija');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" value="<?php echo esc_attr($instance['email']); ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Contact Info', 'revija');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'info' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'info' )); ?>" value="<?php echo esc_attr($instance['info']); ?>" class="widefat" type="text"/>
				</label>
			</p>
			
			<p>
				<label><?php esc_html_e('Map embed iframe', 'revija');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'map' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'map' )); ?>" value="<?php echo $instance['map']; ?>" class="widefat" type="text"/>
				</label>
				<span><?php esc_html_e('Visit Google maps to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'revija');?></span>
			</p>

		<?php
		}

	}
}

/*	Mailchimp Widget
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_mailchimp')) {

	class mad_widget_mailchimp extends WP_Widget {
		public $data = '';
		public $version = '1.0';

		function __construct() {
			$settings = array('classname' => 'widget_zn_mailchimp', 'description' => esc_html__('Use this widget to add a mailchimp newsletter to your site.', 'revija'));
			parent::__construct('widget-zn-mailchimp', REVIJA_THEMENAME .' '. esc_html__('Widget Newsletter', 'revija'), $settings);

			define('MAILCHIMP_URL', REVIJA_INCLUDES_URI . 'widgets/mailchimp/');
			define('MAILCHIMP_ABSPATH', REVIJA_INCLUDES_PATH . 'widgets/mailchimp');

			add_action('wp_enqueue_scripts', array(&$this, 'load_script'));
		}

		function load_script() {
			if ( is_active_widget( false, false, 'widget-zn-mailchimp', true ) && ! is_admin() ) {
				wp_enqueue_script( 'newsletter-widget', MAILCHIMP_URL . 'js/newsletter.js', array('jquery'), $this->version, true );
			}
		}

		function widget($args, $instance) {
			if (file_exists(MAILCHIMP_ABSPATH . '/inc/widget.php')) {
				include(MAILCHIMP_ABSPATH . '/inc/widget.php');
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
			$instance['mailchimp_intro'] =  stripslashes($new_instance['mailchimp_intro']) ;
			$instance['style_type'] =  stripslashes($new_instance['style_type']) ;
			return $instance;
		}

		function form( $instance ) {
			if (file_exists(MAILCHIMP_ABSPATH . '/inc/form.php')) {
				include(MAILCHIMP_ABSPATH . '/inc/form.php');
			}
		}
	}
}

/*	Widget Flickr
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_flickr')) {

	class mad_widget_flickr extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_flickr', 'description' => esc_html__('Flickr feed widget', 'revija'));
			parent::__construct(__CLASS__,  REVIJA_THEMENAME .' '. esc_html__('Widget Flickr feed', 'revija'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$unique_id = rand(0, 300);

			REVIJA_BASE_FUNCTIONS::enqueue_script('jflickrfeed');

			echo $before_widget;

			if ($title !== '') {
				echo $before_title . $title . $after_title;
			}

			?>

			<ul id="flickr_feed_<?php echo esc_attr($unique_id) ?>" class="flickr-feed"></ul>

			<script type="text/javascript">
				jQuery(function () {
					jQuery('#flickr_feed_<?php echo esc_attr($unique_id) ?>').jflickrfeed({
						limit: <?php echo absint($instance['imagescount']) ?>,
						qstrings: { id: '<?php echo esc_attr($instance['username']) ?>' },
						itemTemplate: '<li><a target="_blank" href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
					});
				});
			</script>

			<?php echo $after_widget;
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['imagescount'] = (int) $new_instance['imagescount'];
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => 'Flickr Feed',
				'username' => '76745153@N04',
				'imagescount' => '8',
			);
			$instance = wp_parse_args((array) $instance, $defaults); ?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e('Flickr Username', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" value="<?php echo esc_attr($instance['username']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('imagescount')); ?>"><?php esc_html_e('Number of images', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('imagescount')); ?>" name="<?php echo esc_attr($this->get_field_name('imagescount')); ?>" value="<?php echo esc_attr($instance['imagescount']); ?>" />
			</p>

		<?php
		}

	}
}




/*	Widget Our Writers
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_our_writers')) {

	class mad_widget_our_writers extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'widget_our_writers',
				'description' => 'Our Writers'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME .' '. esc_html__('Our Writers', 'revija'), $widget_ops );
		}

		function widget($args, $instance) {

			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

			$count = $instance['count'];
			ob_start(); ?>

			<?php echo $before_widget; ?>

				<?php if ($title !== ''): ?>
					<?php echo $before_title . $title . $after_title; ?>
				<?php endif; ?>

				<ul class="writers_list clearfix">
				<?php 
				global $wpdb;
 
				$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
				$count1 = 1;
				
				foreach($authors as $author) {
					if($count1 <= $count) {
						$user = new WP_User( $author->ID );

						echo "<li>";
						echo "<a href=\"".home_url()."/?author=";
						echo esc_attr($author->ID);
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
										echo esc_attr($role).'<br>';
								}
							
							echo '</div>';
						echo '</div>';
						
						
						echo "</a>";
						echo "</li>";
					}
					$count1++;
				}
				
				?>
				
			</ul><!--/ .writers_list-->	
				
			<?php echo $after_widget; ?>

			
			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {

			$instance = wp_parse_args( (array) $instance, array(
				'title' => 'Meat Our Writers',
				'count' => '3',
			));
			$title = strip_tags($instance['title']);
			$count = strip_tags($instance['count']); ?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('count')); ?>">Count: 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
				</label>
			</p>

		<?php
		}
	}
}






/*	Widget Featured Video
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_featured_video')) {

	class mad_widget_featured_video extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'widget_featured_video',
				'description' => 'Featured Video'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME .' '. esc_html__('Featured Video', 'revija'), $widget_ops );
		}

		function widget($args, $instance) {

			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$link = $instance['url'];
			
			if ( $link == '' ) {
				return null;
			}
			
			$video_w = ( isset( $content_width ) ) ? $content_width : 360;
			$video_h = $video_w / 1.61; //1.61 golden ratio
			/** @var WP_Embed $wp_embed  */
			global $wp_embed;
			$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '" height="' . $video_h . '"]' . $link . '[/embed]' );

			
			
			ob_start(); ?>

			<?php echo $before_widget; ?>

				<?php if ($title !== ''): ?>
					<?php echo $before_title . $title . $after_title; ?>
				<?php endif; ?>

				<?php echo  '<div class="wpb_video_wrapper">' . $embed . '</div>'; ?>
				
			<?php echo $after_widget; ?>

			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {

			$instance = wp_parse_args( (array) $instance, array(
				'title' => 'Featured Video',
				'url' => 'http://vimeo.com/64473966',
			));
			$title = strip_tags($instance['title']);
			$url = strip_tags($instance['url']); ?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('url')); ?>">Url: 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
				</label>
			</p>

		<?php
		}
	}
}







/*	Widget Advertising 4 Area
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_advertising_area4')) {

	class mad_widget_advertising_area4 extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'widget_advertising_area4',
				'description' => 'An advertising widget that displays 4 image'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME .' '. esc_html__('Advertising Area 4', 'revija'), $widget_ops );
		}

		function widget($args, $instance) {

			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

			if (empty($instance['image_url1'])) {
				$image_url1 = '<span>'.esc_html__('Advertise here', 'revija').'</span>';
			} else {
				$image_url1 = '<img class="advertise-image" src="' . esc_url($instance['image_url1']) . '" title="" alt=""/>';
			}
			
			if (empty($instance['image_url2'])) {
				$image_url2 = '<span>'.esc_html__('Advertise here', 'revija').'</span>';
			} else {
				$image_url2 = '<img class="advertise-image" src="' . esc_url($instance['image_url2']) . '" title="" alt=""/>';
			}
			
			if (empty($instance['image_url3'])) {
				$image_url3 = '<span>'.esc_html__('Advertise here', 'revija').'</span>';
			} else {
				$image_url3 = '<img class="advertise-image" src="' . esc_url($instance['image_url3']) . '" title="" alt=""/>';
			}
			
			if (empty($instance['image_url4'])) {
				$image_url4 = '<span>'.esc_html__('Advertise here', 'revija').'</span>';
			} else {
				$image_url4 = '<img class="advertise-image" src="' . esc_url($instance['image_url4']) . '" title="" alt=""/>';
			}
			

			$ref_url1 = empty($instance['ref_url1']) ? '#' : apply_filters('widget_comments_title', $instance['ref_url1']);
			$ref_url2 = empty($instance['ref_url2']) ? '#' : apply_filters('widget_comments_title', $instance['ref_url2']);
			$ref_url3 = empty($instance['ref_url3']) ? '#' : apply_filters('widget_comments_title', $instance['ref_url3']);
			$ref_url4 = empty($instance['ref_url4']) ? '#' : apply_filters('widget_comments_title', $instance['ref_url4']);

			ob_start(); ?>

			<?php 
			$before_widget = str_replace('class="', 'class="t_align_c ', $before_widget);
			echo $before_widget; ?>

				<?php if ($title !== ''): ?>
					<?php echo $before_title . $title . $after_title; ?>
				<?php endif; ?>

				<div class="box_image_conteiner">
				<a target="_blank"  href="<?php echo esc_url($ref_url1); ?>"><?php echo $image_url1; ?></a>
				<a target="_blank"  href="<?php echo esc_url($ref_url2); ?>"><?php echo $image_url2; ?></a>
				<a target="_blank"  href="<?php echo esc_url($ref_url3); ?>"><?php echo $image_url3; ?></a>
				<a target="_blank"  href="<?php echo esc_url($ref_url4); ?>"><?php echo $image_url4; ?></a>
				</div>
				
			<?php echo $after_widget; ?>

			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
				'image_url1' => '',
				'ref_url1' => '',
				'image_url2' => '',
				'ref_url2' => '',
				'image_url3' => '',
				'ref_url3' => '',
				'image_url4' => '',
				'ref_url4' => '',
			));
			$title = strip_tags($instance['title']);
			$image_url1 = strip_tags($instance['image_url1']);
			$ref_url1 = strip_tags($instance['ref_url1']); 
			
			$image_url2 = strip_tags($instance['image_url2']);
			$ref_url2 = strip_tags($instance['ref_url2']);
			
			$image_url3 = strip_tags($instance['image_url3']);
			$ref_url3 = strip_tags($instance['ref_url3']);
			
			$image_url4 = strip_tags($instance['image_url4']);
			$ref_url4 = strip_tags($instance['ref_url4']);
			?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image_url1')); ?>">Image URL: <?php  echo "(125px * 125px):"; ?>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url1')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url1')); ?>" type="text" value="<?php echo esc_attr($image_url1); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('ref_url1')); ?>">Referal URL:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ref_url1')); ?>" name="<?php echo esc_attr($this->get_field_name('ref_url1')); ?>" type="text" value="<?php echo esc_attr($ref_url1); ?>" />
				</label>
			</p>

			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image_url2')); ?>">Image URL: <?php  echo "(125px * 125px):"; ?>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url2')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url2')); ?>" type="text" value="<?php echo esc_attr($image_url2); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('ref_url2')); ?>">Referal URL:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ref_url2')); ?>" name="<?php echo esc_attr($this->get_field_name('ref_url2')); ?>" type="text" value="<?php echo esc_attr($ref_url2); ?>" />
				</label>
			</p>
			
			
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image_url3')); ?>">Image URL: <?php  echo "(125px * 125px):"; ?>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url3')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url3')); ?>" type="text" value="<?php echo esc_attr($image_url3); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('ref_url3')); ?>">Referal URL:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ref_url3')); ?>" name="<?php echo esc_attr($this->get_field_name('ref_url3')); ?>" type="text" value="<?php echo esc_attr($ref_url3); ?>" />
				</label>
			</p>
			
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image_url4')); ?>">Image URL: <?php  echo "(125px * 125px):"; ?>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url4')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url4')); ?>" type="text" value="<?php echo esc_attr($image_url4); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('ref_url4')); ?>">Referal URL:
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ref_url4')); ?>" name="<?php echo esc_attr($this->get_field_name('ref_url4')); ?>" type="text" value="<?php echo esc_attr($ref_url4); ?>" />
				</label>
			</p>
			
			
			
			
			
		<?php
		}
	}
}



/*	Widget Popular Categories
/* ----------------------------------------------------------------- */

if (!class_exists('mad_widget_popular_categories')) {

	class mad_widget_popular_categories extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_popular_categories widget_categories', 'description' => esc_html__('Popular Categories widget', 'revija'));
			parent::__construct(__CLASS__,  REVIJA_THEMENAME .' '. esc_html__('Widget Popular Categories', 'revija'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			
			echo $before_widget;

			if ($title !== '') {
				echo $before_title . $title . $after_title;
			}

			
			
			
			$args = array(
			'type'                     => 'post',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'count',
			'order'                    => 'DESC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => $instance['include'],
			'number'                   => $instance['count'],
			'taxonomy'                 => 'category',
			'pad_counts'               => false
			);
			$categories = get_categories( $args );
			
			if( $categories ){
				
				echo '<ul class="categories_list"><li>
                    <ul>';
				foreach( $categories as $cat ){
					
					
					echo '<li><a title="' . sprintf( esc_html__( "%s", "revija" ), $cat->name ) . '" href="' . get_category_link( $cat->term_id ) . '">'. $cat->cat_name .'</a><span>'. $cat->count .'</span></li>';
				}
				echo '</ul></li></ul>';
			}
			
			?>

			
			<?php echo $after_widget;
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['count'] = (int) $new_instance['count'];
			$instance['include'] = $new_instance['include'];
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => 'Popular Categories',
				'include' => '',
				'count' => '8',
			);
			$instance = wp_parse_args((array) $instance, $defaults); ?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('include')); ?>"><?php esc_html_e('Include', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('include')); ?>" name="<?php echo esc_attr($this->get_field_name('include')); ?>" value="<?php echo esc_attr($instance['include']); ?>" />
			</p>

			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Number of categories', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" value="<?php echo esc_attr($instance['count']); ?>" />
			</p>

		<?php
		}

	}
}












if (!class_exists('revija_widget_popular_categories2')) {
	
	class revija_widget_popular_categories2 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => esc_html__('Add a custom menu to your footer sidebar.', 'revija') );
		parent::__construct( 'popular_categories_custom', REVIJA_THEMENAME.' - '.esc_html__('Custom Menu Bottom', 'revija'), $widget_ops );
	}
	function widget($args, $instance) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		
		
		$args1 = array(
			'type'                     => 'post',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'count',
			'order'                    => 'DESC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => $instance['nav_menu'],
			'number'                   => 0,
			'taxonomy'                 => 'category',
			'pad_counts'               => false
			);
		$categories = get_categories( $args1 );
		
		
		
		$args2 = array(
			'type'                     => 'post',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'count',
			'order'                    => 'DESC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => $instance['nav_menu2'],
			'number'                   => 0,
			'taxonomy'                 => 'category',
			'pad_counts'               => false
			);
		$categories2 = get_categories( $args2 );
		
		
		
		
		echo $args['before_widget'];
		
		if ( !empty($instance['title']) ) {
			echo $args['before_title'] . esc_attr($instance['title']) . $args['after_title'];
		}
		
        echo '<ul class="categories_list"><li>';	
		
		
		if( $categories ){
				
				echo '<ul>';
				foreach( $categories as $cat ){
					
					
					echo '<li><a title="' . sprintf( esc_html__( "%s", "revija" ), $cat->name ) . '" href="' . get_category_link( $cat->term_id ) . '">'. $cat->cat_name .'</a><span>'. $cat->count .'</span></li>';
				}
				echo '</ul>';
			}
		
		 echo '</li>';	
	
		echo '<li>';	
		
		
			if( $categories2 ){
				
				echo '<ul>';
				foreach( $categories2 as $cat ){
					
					
					echo '<li><a title="' . sprintf( esc_html__( "%s", "revija" ), $cat->name ) . '" href="' . get_category_link( $cat->term_id ) . '">'. $cat->cat_name .'</a><span>'. $cat->count .'</span></li>';
				}
				echo '</ul>';
			}
		
		
		 echo '</li></ul>';	
		
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		
		
		$instance['nav_menu'] =  $new_instance['nav_menu'];
		$instance['nav_menu2'] =  $new_instance['nav_menu2'];
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'nav_menu' => '', 'nav_menu2' => '') );

		$title = esc_attr( $instance['title'] );
		
		$nav_menu = esc_attr($instance['nav_menu'] ); 
		$nav_menu2 = esc_attr($instance['nav_menu2'] );

		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'revija') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		
	
		<p>
				<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php esc_html_e('Include categories ID in left part', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>" value="<?php echo esc_attr($instance['nav_menu']); ?>" />
		</p>
			
		<p>
				<label for="<?php echo esc_attr($this->get_field_id('nav_menu2')); ?>"><?php esc_html_e('Include categories ID in right part', 'revija') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('nav_menu2')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu2')); ?>" value="<?php echo esc_attr($instance['nav_menu2']); ?>" />
		</p>

		<?php
	}
	}
}








/**
 * slider post
 */
 
if (!class_exists('mad_widget_slider_posts')) {
	 
class mad_widget_slider_posts extends WP_Widget {

	function __construct() {
			$widget_ops = array(
				'classname' => 'widget_slider_posts',
				'description' => 'Slider posts'
			);
			parent::__construct( __CLASS__,  REVIJA_THEMENAME.' '. esc_html__('Slider posts', 'revija'), $widget_ops );
		}
	
	function widget($args, $instance) {
		$url_view_all = $view_all = '';
		
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$css_class = '';
		$num_items = ( ! empty( $instance['num_items'] ) ) ? absint( $instance['num_items'] ) : 3;
		$excerptlength = ( ! empty( $instance['excerptlength'] ) ) ? absint( $instance['excerptlength'] ) : 100;
		$post_type  = post_type_exists($instance['post_type']) ? $instance['post_type'] : 'post';
		$url_view_all = empty($instance['url_view_all']) ? '' : $instance['url_view_all'];
		$rand_id = rand(1, 1000);
		$loop = 'true';
		$autoplay = 'false';
		$resp_0 = 1;
		$resp_481 = 1;
		
		
		wp_enqueue_script(REVIJA_PREFIX . 'owlcarousel');
		wp_enqueue_style(REVIJA_PREFIX . 'owlcarousel');
		wp_enqueue_style(REVIJA_PREFIX . 'owltheme');
		wp_enqueue_style(REVIJA_PREFIX . 'owltransitions');
		
	ob_start();
	
	
	
	echo $before_widget; 
	
	echo '<div class="photo_gallery side_bar">';
	
	if($url_view_all != '') {
		$view_all = "<a target='_blank' href='". $url_view_all ."' class='button view_button'>". esc_html__( 'View All', 'revija' ) ."</a>";
		}
		
	echo $before_title . $title . $view_all . $after_title; 

		$posts = get_posts(array(
        'post_type'  => $post_type,
        'numberposts'     => $num_items,
        'orderby'     => 'rand',
        'order'      => 'DESC',
        'offset'     => 0
        ));
		
		
	echo '<div id="owl-custom-1" class="owl_custom_'. $rand_id .'">';	
	 foreach( $posts as $post ) :  
		$post_id = $post->ID;
		$title_post = revija_limit_words( ( $post->post_title ), $excerptlength );

			echo '<div class="item">';

				echo mad_blog_post_th_btn($post_id, get_the_content(), $title_post, 14, '555*374');

				echo '<div class="clearfix">';
					echo mad_blog_post_meta($post_id, $post);
				echo '</div>';
				
				echo '<div class="post_text">
                    <h4  class="post_title second_font"><a href="'. get_permalink($post_id) .'">'. $title_post .'</a></h4>
                  </div>'; 
			 
			echo '</div>';  
	 endforeach; 
	echo '</div>'; 
	
	
	echo '</div>'; 

	
	echo '<div class="clearfix"></div>';
    echo $after_widget; 

	wp_reset_postdata();
	
	 ?>
	<script type="text/javascript">
	(function($){
	"use strict";

		$(function(){
			
		var post_carousel_custom = $(".owl_custom_<?php echo esc_attr($rand_id); ?>");	
			

			post_carousel_custom.owlCarousel({
			  items : 1,
			  navSpeed: 800,
			  nav : true,
			  navText:false,
			  loop:<?php echo esc_attr($loop); ?>,
			  autoplay: <?php echo esc_attr($autoplay); ?>,
			  autoplaySpeed: 800,
				responsive:{
					0:{
						items:<?php echo esc_attr($resp_0); ?>
					},
					481:{
						items:<?php echo esc_attr($resp_481); ?>
					},
					992:{
						items:1
					}
				}
			});
		
		});

	})(jQuery);

    </script>		
	
	<?php 
	
	echo ob_get_clean();
	}

	function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
				'url_view_all' => '',
				'num_items' => '',
				'post_type' => '',
				'excerptlength' => ''
			));
			
			$title = strip_tags($instance['title']);
			$url_view_all = strip_tags($instance['url_view_all']);
			$num_items    = strip_tags($instance['num_items']);
			$excerptlength = strip_tags($instance['excerptlength']); 
			$post_type = post_type_exists($instance['post_type']) ? $instance['post_type'] : 'post';
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'revija' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'url_view_all' )); ?>"><?php esc_html_e( 'URL View All:', 'revija' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url_view_all' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'url_view_all' )); ?>" type="text" value="<?php echo esc_url($url_view_all); ?>" /></p>

		
		<p>
        <label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>"><?php esc_html_e('Post type:', 'revija'); ?></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_type')); ?>" name="<?php echo esc_attr($this->get_field_name('post_type')); ?>">
			<option value="post"<?php selected( $instance['post_type'], 'post' ); ?>><?php esc_html_e( 'Post', 'revija' ); ?></option>
			<option value="portfolio"<?php selected( $instance['post_type'], 'portfolio' ); ?>><?php esc_html_e( 'Portfolio', 'revija' ); ?></option>
        </select>
        </p>
		
		
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'revija' ); ?>
		</label>
		<input id="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_items' )); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" size="3" />
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('excerptlength')); ?>"><?php esc_html_e('Title length', 'revija'); ?>
				<input id="<?php echo esc_attr($this->get_field_id('excerptlength')); ?>" name="<?php echo esc_attr($this->get_field_name('excerptlength')); ?>" size="5" type="text" value="<?php echo esc_attr($excerptlength); ?>"/> <?php esc_html_e('Words', 'revija'); ?>
			</label>
		</p>

		<?php
	}
}

}



/*	Widget Facebook Like Box
/* ----------------------------------------------------------------- */

if (!class_exists('revija_like_box_facebook')) {

	class revija_like_box_facebook extends WP_Widget {

		private static $id_of_like_box = 0;

		function __construct() {
			$widget_ops = array( 'classname' => 'like_box_facebook', 'description' => 'Like box Facebook ' ); // Widget Settings
			$control_ops = array( 'id_base' => 'like_box_facebook' ); // Widget Control Settings

			parent::__construct( 'like_box_facebook', 'Like box Facebook', $widget_ops, $control_ops ); // Create the widget
		}

		function widget($args, $instance) {
			self::$id_of_like_box++;
			extract( $args );
			$title = $instance['title'];
			$profile_id = $instance['profile_id'];
			$facebook_likebox_theme = $instance['facebook_likebox_theme'];
			$width = $instance['width'];
			$height = $instance['height'];
			$connections = $instance['connections'];
			$header = ($instance['header'] == 'yes') ? 'true' : 'false';

			// Before widget //
			echo $before_widget;

			// Title of widget //
			if ( $title ) { echo $before_title . $title . $after_title; }

			// Widget output //
			echo '<iframe id="like_box_widget_'. self::$id_of_like_box .'" src="http://www.facebook.com/plugins/likebox.php?href='. $profile_id .'&amp;colorscheme='. $facebook_likebox_theme .'&amp;width='. $width .'&amp;height='. $height .'&amp;connections='. $connections .'&amp;stream=false&amp;show_border=false&amp;header='. $header .'&amp;" scrolling="no" frameborder="0" allowTransparency="true" style="width:'. $width .'px; height:'. $height .'px;"></iframe>';

			echo $after_widget;
		}

		// Update Settings //
		function update ($new_instance, $old_instance) {
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);
			$instance['profile_id'] = $new_instance['profile_id'];
			$instance['facebook_likebox_theme'] = $new_instance['facebook_likebox_theme'];
			$instance['width'] = $new_instance['width'];
			$instance['height'] = $new_instance['height'];
			$instance['connections'] = $new_instance['connections'];
			$instance['header'] =  $new_instance['header'];
			return $instance;
		}

		/* admin page opions */
		function form($instance) {

			$defaults = array(
				'title' => esc_html__('Like Us on Facebook', 'revija'),
				'profile_id' => '',
				'facebook_likebox_theme' => 'light',
				'width' => '235',
				'height' => '345',
				'connections' => 10,
				'header' => 'yes'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

			<p class="flb_field">
				<label for="title"><?php esc_html_e('Title', 'revija') ?>:</label><br>
				<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" class="widefat">
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('profile_id')); ?>"><?php esc_html_e('Page ID', 'revija') ?>:</label><br>
				<input id="<?php echo esc_attr($this->get_field_id('profile_id')); ?>" name="<?php echo esc_attr($this->get_field_name('profile_id')); ?>" type="text" value="<?php echo esc_attr($instance['profile_id']); ?>" class="widefat">
			</p>

			<p>
				<label><?php esc_html_e('Facebook Like box Theme', 'revija'); ?>:</label><br>
				<select name="<?php echo esc_attr($this->get_field_name('facebook_likebox_theme')); ?>">
					<option selected="selected" value="light"><?php esc_html_e('Light', 'revija') ?></option>
					<option value="dark"><?php esc_html_e('Dark', 'revija') ?></option>
				</select>
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Like box Width', 'revija') ?>:</label>
				<br>
				<input id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($instance['width']); ?>" class="" size="3">
				<small>(<?php esc_html_e('px', 'revija') ?>)</small>
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php esc_html_e("Like box Height", 'revija') ?>:</label>
				<br>
				<input id="<?php echo esc_attr($this->get_field_id('height')); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" type="text" value="<?php echo esc_attr($instance['height']); ?>" class="" size="3">
				<small>(<?php esc_html_e('px', 'revija') ?>)</small>
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('connections')); ?>"><?php esc_html_e('Number of connections', 'revija') ?>:</label>
				<br>
				<input id="<?php echo esc_attr($this->get_field_id('connections')); ?>" name="<?php echo esc_attr($this->get_field_name('connections')); ?>" type="text" value="<?php echo esc_attr($instance['connections']); ?>" class="" size="3">
				<small>(<?php esc_html_e("Max. 100", 'revija') ?>)</small>
			</p>

			<p class="flb_field">
				<label><?php esc_html_e('Show Header', 'revija') ?>:</label><br>
				<input name="<?php echo esc_attr($this->get_field_name('header')); ?>" type="radio" value="yes" <?php checked( $instance[ 'header' ], 'yes' ); ?>><?php esc_html_e("Yes", 'revija') ?>
				<input name="<?php echo esc_attr($this->get_field_name('header')); ?>" type="radio" value="no" <?php checked( $instance[ 'header' ], 'no'); ?>><?php esc_html_e("No", 'revija') ?>
			</p>

			<?php
		}
	}

}





 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_social_links");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_advertising_area");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_contact_us");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_mailchimp");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_flickr");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_our_writers");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_featured_video");'));
 add_action('widgets_init', create_function('', 'return register_widget("mad_widget_advertising_area4");'));

add_action('widgets_init', create_function('', 'return register_widget("mad_widget_top_review_posts");'));
add_action('widgets_init', create_function('', 'return register_widget("mad_widget_random_posts");'));
add_action('widgets_init', create_function('', 'return register_widget("mad_widget_slider_posts");'));

add_action('widgets_init', create_function('', 'return register_widget("mad_widget_popular_categories");'));
add_action('widgets_init', create_function('', 'return register_widget("revija_widget_popular_categories2");'));
add_action('widgets_init', create_function('', 'return register_widget("revija_like_box_facebook");'));
?>