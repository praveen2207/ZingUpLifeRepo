<?php


/*	Site Icon
/* ---------------------------------------------------------------------- */

if (!function_exists('revija_wp_site_icon')) {

	function revija_wp_site_icon() {

		$revija_favicon = mad_custom_get_option("favicon_upload");
		
		if ( ! $revija_favicon ) { return; }

		$meta_tags = array(
			sprintf( '<link rel="icon" href="%s"  />', esc_url( $revija_favicon ) ),
		);

		$meta_tags = array_filter( $meta_tags );

		foreach ( $meta_tags as $meta_tag ) {
			echo "$meta_tag\n";
		}

	}
}



/*	Title
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_title')) {

	function mad_title($args = false, $id = false) {

		if (!$id) $id = mad_post_id();

		$defaults = array(
			'title' 	  => get_the_title($id),
			'subtitle'    => "",
			'output_html' => "<div class='text_post_block {class}'><{heading} class='section_title section_title_big'>{title}</{heading}>{additions}</div>",
			'class'		  => '',
			'heading'	  => 'h2',
			'additions'	  => ""
		);

		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_SKIP);

		if (!empty($subtitle)) {
			$class .= ' with-subtitle';
			$additions .= "<div class='title-meta'>" . do_shortcode(wpautop($subtitle)) . "</div>";
		}

		$output_html = str_replace('{class}', $class, $output_html);
		$output_html = str_replace('{heading}', $heading, $output_html);
		$output_html = str_replace('{title}', $title, $output_html);
		$output_html = str_replace('{additions}', $additions, $output_html);
		return $output_html;
	}
}

/*	Locate Template
/* ---------------------------------------------------------------------- */

if ( !function_exists( 'mad_locate_template' ) ) {

    function mad_locate_template( $path ) {
        $path = ltrim( $path, '/' );
		$theme_path = str_replace( REVIJA_BASE_PATH, '', REVIJA_TEMPLATES_PATH . $path );
		$located = locate_template( array(
            $theme_path
        ) );
        return $located;
    }
}

/*	Get Template
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_get_template') ) {

    function mad_get_template( $path, $var = null, $return = false ) {

        $located = mad_locate_template( $path, $var );

        if (empty( $located )) { return; }

        if ($var && is_array( $var )) { extract ( $var ); }

        if ($return) { ob_start(); }
        	include( $located );
        if ($return) { return ob_get_clean(); }
    }
}

/*	Post Content
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_post_content_truncate')) {

	function mad_post_content_truncate($string, $limit, $break = ".", $pad = "...") {
		if (strlen($string) <= $limit) { return $string; }

		if (false !== ($breakpoint = strpos($string, $break, $limit))) {
			if ($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		if (!$breakpoint && strlen(strip_tags($string)) == strlen($string)) {
			$string = substr($string, 0, $limit) . $pad;
		}
		return $string;
	}
}


/*	Portfolio Post Thumbnail with Button
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_blog_portfolio_th_btn') ) {

	function mad_blog_portfolio_th_btn($id = 0, $title = '', $image_size='165*110', $type='grid', $count_label = 2 ) {
		$link = esc_url(get_permalink($id));
		$thumbnail = $thumbnail_portfolio = $before = $jackbox = '';
		
			$post_format = rwmb_meta('mad_portfolio_format_icon', '', $id) ? rwmb_meta('mad_portfolio_format_icon', '', $id) : 'standard';
			$icon_type = 'fa-file-text';
			if($post_format == 'standard') {
				$icon_type = 'fa-file-text';
			}
			if($post_format == 'gallery') {
				$icon_type = 'fa-picture-o';
			}
			if($post_format == 'video') {
				$icon_type = 'fa-video-camera';
			}
			if($post_format == 'audio') {
				$icon_type = 'fa-volume-up';
			}
			if($post_format == 'quote') {
				$icon_type = 'fa-quote-left';
			}
			$icon_box = '';
			if ($icon_type != '' && ! is_wp_error($icon_type)){
			$icon_box = '<a href="'.$link.'" class="icon_box">
								  <i class="fa '.$icon_type.'"></i>
								</a>';
			}
		
		
		$cat = '';
		$terms = get_the_terms($id, 'portfolio_label');
		
		if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
		
		 if( count($terms) > $count_label ) {
			  $terms = array_slice($terms, 0, $count_label);
			 }
		
		
		$cat = "<div class='buttons_container'>";
			foreach($terms as $term) {
			$term_color = get_tax_meta($term->term_id,'folio_color_field_id');
				
			$cat .= '<a href="'.get_term_link( $term->slug, 'portfolio_label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
			}
		$cat .= "</div>";	
		}
		
		
		 if (has_post_thumbnail($id)) {
						
				$thumbnail_atts = array(
					'class'	=> "scale_image",
					'alt'	=> '',
					'title'	=> trim(strip_tags($title))
				);
				$thumbnail_portfolio = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);

				$post_thumbnail = get_post_thumbnail_id($id);

				if (isset($post_thumbnail) && $post_thumbnail > 0) {
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($id), '');
					if (is_array($thumbnail) && isset($thumbnail[0])) {
						$thumbnail = $thumbnail[0];
					}
				}
			
			if($type == 'grid') {
			$before = "<div class='scale_image_container with_buttons 1'>
			<a href='{$link}' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."'>{$thumbnail_portfolio}</a>
				    <div class='post_image_buttons'>
					".$cat."
					".$icon_box."
				  </div>
				   <div class='open_buttons clearfix'>
					<div class='f_left'><a href='{$thumbnail}' role='button' class='jackbox jackbox_button button button_grey_light' data-group='gallery_1'><i class='fa fa-search-plus'></i></a></div>
					<div class='f_left'><a href='{$link}' role='button' class='jackbox_button button button_grey_light'><i class='fa fa-link'></i></a></div>
				  </div>
			</div>";
			}
			
			if($type == 'gallery') {
			$before = "<div class='scale_image_container with_buttons 1'>
			<a href='{$link}' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."'>{$thumbnail_portfolio}</a>
				   <div class='open_buttons clearfix'>
					<div class='f_left'><a href='{$thumbnail}' role='button' class='jackbox jackbox_button button button_grey_light' data-group='gallery_1'><i class='fa fa-search-plus'></i></a></div>
				  </div>
			</div>";
			}
			
			
		 }
		
		
		ob_start(); ?>
		
		<?php echo $before; ?>
		
		
		<?php return ob_get_clean();
	}
}


/*	Blog Post Thumbnail with Button
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_blog_post_th_btn') ) {

	function mad_blog_post_th_btn($id = 0, $post_content = '', $title = '', $radius = 14, $image_size='165*110', $count_label = 2) {
		$link = esc_url(get_permalink($id));
		$thumbnail = $before = $jackbox = '';
		$num = 0;
		$canvas = '';
		
			$post_format = get_post_format($id) ? get_post_format($id) : 'standard';
			$icon_type = 'fa-file-text';
			if($post_format == 'standard') {
				$icon_type = 'fa-file-text';
			}
			if($post_format == 'gallery') {
				$icon_type = 'fa-picture-o';
			}
			if($post_format == 'video') {
				$icon_type = 'fa-video-camera';
			}
			if($post_format == 'audio') {
				$icon_type = 'fa-volume-up';
			}
			if($post_format == 'quote') {
				$icon_type = 'fa-quote-left';
			}
			$icon_box = '';
			if ($icon_type != '' && ! is_wp_error($icon_type)){
			$icon_box = '<a href="'.$link.'" class="icon_box">
								  <i class="fa '.$icon_type.'"></i>
								</a>';
			}
		
		
		$cat = '';
		$terms = get_the_terms($id, 'label');
		
		
		
		if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
			 if( count($terms) > $count_label ) {
			  $terms = array_slice($terms, 0, $count_label);
			 }
			
		$cat = "<div class='buttons_container '>";
			foreach($terms as $term) {
			$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
				
			$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
			}
		$cat .= "</div>";	
		}
		
		
		if (class_exists('RWP_API') && mad_custom_get_option('blog-listing-meta-ratings') && $radius > 0 ) {

			$max_rating = 5;
			$box = RWP_API::get_reviews_box_users_rating($id); 
			if(isset($box["scores"][0])) {	
				$num = $box["scores"][0];
			}

			$id_canvas = rand();
			
		
			if ( $num > 0 ) {
			$canvas = "<div class='canvas canvas_small'>
						<div class='circle' id='post-circles-". $id ."-". $id_canvas ."'></div>
						<br />
					</div>";		
			}
		}
		
		
		$thumbnail_atts = array(
			'class'	=> "scale_image",
			'alt'	=> "",
			'title'	=> ""
		);
		
		if (has_post_thumbnail($id)) {
			$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
			$before = "<div class='scale_image_container 1'>
			<a href='{$link}' class='{$jackbox}'>{$thumbnail}</a>
				    <div class='post_image_buttons'>
					".$cat."
					".$icon_box."
				  </div>
				  ".$canvas."
			</div>";
		} else {
			$image = mad_regex($post_content, 'image', "");
			if (is_array($image)) {
				$get_image = $image[0];
				$before = '
					<div class="scale_image_container 2">
						<a class="'. $jackbox .'" href="'. $link .'" >
							<img  class="scale_image" src="'. $get_image .'" alt="" />
						</a>
						<div class="post_image_buttons">
							'.$cat.'
							'.$icon_box.'
						</div>
						  '.$canvas.'
					</div>';
			} else {
				$image = mad_regex($post_content, '<img />', "");
				if (is_array($image)) {
					$before = '
					<div class="scale_image_container 3">
						<a class="'. $jackbox .'" href="'. $link .'" >
							'. $image[0] .'
						</a>
						<div class="post_image_buttons">
							'.$cat.'
							'.$icon_box.'
						</div>
						  '.$canvas.'
					</div>';
				} 
				
				else {
					$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
					
					$before = "<div class='scale_image_container 1'>
					<a href='{$link}' class='{$jackbox}'>{$thumbnail}</a>
							<div class='post_image_buttons'>
							".$cat."
							".$icon_box."
						  </div>
						  ".$canvas."
					</div>";					
				}
			}
		}
		
		
		
			
		if ( $num > 0 ) {

		$before .= '<script type="text/javascript">
		var colors = [["#fa985d", "#ffffff"]], circles = [];
		var child = document.getElementById("post-circles-'. $id .'-'. $id_canvas .'");
		if(child) {
		circles.push(Circles.create({
			id:         child.id,
			value:      '.$num.',
			radius:     '.$radius.',
			width:      3,
			maxValue:   '.$max_rating.',
			duration:   1000,
			text:       function(value){return value;},
			colors:    ["#fa985d", "#ffffff"]
		}));
		}
		</script>';
		
		}
		
		

		ob_start(); ?>
		
		<?php echo $before; ?>

		<?php return ob_get_clean();
	}
}



/*	Blog Post Index Thumbnail 
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_blog_post_th_index') ) {

	function mad_blog_post_th_index($id = 0, $post_content = '', $title = '', $radius = 14, $image_size='', $count_label = 2) {
		
		if (!has_post_thumbnail($id)) {
			return;
		}

		$link = esc_url(get_permalink($id));
		$thumbnail = $before = $jackbox = '';
		$num = 0;
		$canvas = '';
		
		
			$post_format = get_post_format($id) ? get_post_format($id) : 'standard';
			$icon_type = 'fa-file-text';
			if($post_format == 'standard') {
				$icon_type = 'fa-file-text';
			}
			if($post_format == 'gallery') {
				$icon_type = 'fa-picture-o';
			}
			if($post_format == 'video') {
				$icon_type = 'fa-video-camera';
			}
			if($post_format == 'audio') {
				$icon_type = 'fa-volume-up';
			}
			if($post_format == 'quote') {
				$icon_type = 'fa-quote-left';
			}
			$icon_box = '';
			if ($icon_type != '' && ! is_wp_error($icon_type)){
			$icon_box = '<a href="'.$link.'" class="icon_box">
								  <i class="fa '.$icon_type.'"></i>
								</a>';
			}
		
		
		$cat = '';
		$terms = get_the_terms($id, 'label');
		
		
		
		if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
			 if( count($terms) > $count_label ) {
			  $terms = array_slice($terms, 0, $count_label);
			 }
			
		$cat = "<div class='buttons_container '>";
			foreach($terms as $term) {
			$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
				
			$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
			}
		$cat .= "</div>";	
		}
		
		
		if (class_exists('RWP_API') && mad_custom_get_option('blog-listing-meta-ratings') && $radius > 0 ) {

			$max_rating = 5;
			$box = RWP_API::get_reviews_box_users_rating($id); 
			if(isset($box["scores"][0])) {	
				$num = $box["scores"][0];
			}

			$id_canvas = rand();
			
		
			if ( $num > 0 ) {
			$canvas = "<div class='canvas canvas_small'>
						<div class='circle' id='post-circles-". $id ."-". $id_canvas ."'></div>
						<br />
					</div>";		
			}
		}
		

		
		
		$thumbnail_atts = array(
			'class'	=> "scale_image",
			'alt'	=> '',
			'title'	=> trim(strip_tags($title))
		);
		
		if (has_post_thumbnail($id)) {
			$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
			
			$before = "<div class='scale_image_container 1'>
			<a href='{$link}' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='{$jackbox}'>{$thumbnail}</a>
				    <div class='post_image_buttons'>
					".$cat."
					".$icon_box."
				  </div>
				  ".$canvas."
			</div>";
		} 
		
		
		if ( $num > 0  ) {
			$max_rating = 5;
			
			$before .= '<script type="text/javascript">
			var colors = [["#fa985d", "#ffffff"]], circles = [];
			var child = document.getElementById("post-circles-'. $id .'-'. $id_canvas .'");
			if(child) {
			circles.push(Circles.create({
				id:         child.id,
				value:      '.$num.',
				radius:     '.$radius.',
				width:      3,
				maxValue:   '.$max_rating.',
				duration:   1000,
				text:       function(value){return value;},
				colors:    ["#fa985d", "#ffffff"]
			}));
			}
			</script>';
		}
		

		ob_start(); ?>
		
		<?php echo $before; ?>

		<?php return ob_get_clean();
	}
}







/*	Blog Post Big Thumbnail with Button
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_big_blog_post_th_btn') ) {

	function mad_big_blog_post_th_btn($id = 0, $post_content = '', $title = '', $radius = 14, $image_size='165*110', $custom_class = '', $count_label = 2) {
		$link = esc_url(get_permalink($id));
		$thumbnail = $before = $jackbox = '';
		
		$num = 0;
		$max_rating = 5;
		$canvas = '';		
		
			$post_format = get_post_format($id) ? get_post_format($id) : 'standard';
			$icon_type = 'fa-file-text';
			if($post_format == 'standard') {
				$icon_type = 'fa-file-text';
			}
			if($post_format == 'gallery') {
				$icon_type = 'fa-picture-o';
			}
			if($post_format == 'video') {
				$icon_type = 'fa-video-camera';
			}
			if($post_format == 'audio') {
				$icon_type = 'fa-volume-up';
			}
			if($post_format == 'quote') {
				$icon_type = 'fa-quote-left';
			}
			$icon_box = '';
			if ($icon_type != '' && ! is_wp_error($icon_type)){
			$icon_box = '<a href="'.$link.'" class="icon_box">
								  <i class="fa '.$icon_type.'"></i>
								</a>';
			}
		
		
		$cat = '';
		$terms = get_the_terms($id, 'label');
		
		if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
			
			  if( count($terms) > $count_label ) {
			  $terms = array_slice($terms, 0, $count_label);
			 }
			
		$cat = "<div class='buttons_container'>";
			foreach($terms as $term) {
			$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
				
			$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
			}
		$cat .= "</div>";	
		}
		
		
		if (class_exists('RWP_API') && mad_custom_get_option('blog-listing-meta-ratings') && $radius > 0 ) {

			$max_rating = 5;
			$box = RWP_API::get_reviews_box_users_rating($id); 
			if(isset($box["scores"][0])) {	
				$num = $box["scores"][0];
			}

			$id_canvas = rand();
			
		
			if ( $num > 0 ) {
			$canvas = "<div class='canvas canvas_small'>
						<div class='circle' id='post-circles-". $id ."-". $id_canvas ."'></div>
						<br />
					</div>";		
			}
		}

		
		$date_box = '';
		if (mad_custom_get_option('blog-listing-meta-date')) {
		$date_box = '<div class="event_date">'. get_the_time(get_option('date_format'), $id) .'</div>';
		}
		
		
		$title_box = '<h2 class="second_font">'. $title .'</h2>';
		if ($image_size == '555*374') {
		$title_box = '<h3 class="second_font">'. $title .'</h3>';
		}
		
		$thumbnail_atts = array(
			'class'	=> "scale_image",
			'alt'	=> ""
		);
		
		$before = "<div class='scale_image_container ".$custom_class." '>";
		
		if (has_post_thumbnail($id)) {
			$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
			$before .= "<a href='{$link}' data-group='entry-". $id ."' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='single-image entry-media photoframe {$jackbox}'>{$thumbnail}</a>
				    <div class='caption_type_1'><div class='caption_inner'><div class='clearfix'>
					".$cat."
					".$date_box."
				  </div>
				  <a href='". $link ."'>".$title_box."</a>
				  </div></div>
				  ".$canvas."";
		} else {
			$image = mad_regex($post_content, 'image', "");
			if (is_array($image)) {
				$get_image = $image[0];
				$before .= '<a class="single-image entry-media photoframe '. $jackbox .'" href="'. $link .'" title="'. sprintf( esc_attr__('%s', 'revija'), the_title_attribute('echo=0') ) .'">
							<img  class="scale_image" src="'. $get_image .'" alt="'. $title .'" />
						</a>
						<div class="caption_type_1"><div class="caption_inner"><div class="clearfix">
							'.$cat.'
							'.$date_box.'
						</div>
						<a href="'. $link .'">'.$title_box.'</a>
						</div></div>
						  '.$canvas.'';
			} else {
				$image = mad_regex($post_content, '<img />', "");
				if (is_array($image)) {
					$before .= '<a class="single-image entry-media photoframe '. $jackbox .'" href="'. $link .'" title="'. sprintf( esc_attr__('%s', 'revija'), the_title_attribute('echo=0') ) .'">
							'. $image[0] .'
						</a>
						<div class="caption_type_1"><div class="caption_inner"><div class="clearfix">
							'.$cat.'
							'.$date_box.'
						</div>
						<a href="'. $link .'">'.$title_box.'</a>
						</div></div>
						  '.$canvas.'';
				} else {
					$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
					$before .= "<a href='{$link}' data-group='entry-". $id ."' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='single-image entry-media photoframe {$jackbox}'>{$thumbnail}</a>
							<div class='caption_type_1'><div class='caption_inner'><div class='clearfix'>
							".$cat."
							".$date_box."
						  </div>
						  <a href='". $link ."'>".$title_box."</a>
						  </div></div>
						  ".$canvas."";		
				}
	
			}
		}
		
		
	
		
		if ( $num > 0 ) {
			$before .= '
			<script type="text/javascript">
			var colors = [["#fa985d", "#ffffff"]], circles = [];
			
			var child = document.getElementById("post-circles-'. $id .'-'. $id_canvas .'");
			if(child) {
			circles.push(Circles.create({
				id:         child.id,
				value:      '.$num.',
				radius:     '.$radius.',
				width:      3,
				maxValue:   '.$max_rating.',
				duration:   1000,
				text:       function(value){return value;},
				colors:    ["#fa985d", "#ffffff"]
			}));
			}
			</script>';
		}
		
		$before .= "</div>";
		
		ob_start(); ?>
		
		<?php echo $before; ?>
		
		
		<?php return ob_get_clean();
	}
}







/*	Blog Post Carousel Thumbnail 
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_big_blog_post_th_carousel') ) {

	function mad_big_blog_post_th_carousel($id = 0, $post_content = '', $title = '', $image_size='165*110', $custom_class = '') {
		$link = esc_url(get_permalink($id));
		$thumbnail = $jackbox = $before = '';
		$post_format = get_post_format($id) ? get_post_format($id) : 'standard';

		$date_box = '';
		if (mad_custom_get_option('blog-listing-meta-date')) {
		$date_box = '<div class="event_date">'. get_the_time(get_option('date_format'), $id) .'</div>';
		}

		$title_box = '<h4 class="second_font"  >'. $title .'</h4>';

		$thumbnail_atts = array(
			'class'	=> "scale_image",
			'alt'	=> trim(strip_tags(get_the_excerpt())),
			'title'	=> trim(strip_tags($title))
		);
		
		if (has_post_thumbnail($id)) {
			$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
			$before = "<div class='scale_image_container ".$custom_class." '>
			<a href='{$link}' data-group='entry-". $id ."' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='single-image entry-media photoframe {$jackbox}'>{$thumbnail}</a>
				    <div class='caption_type_1'><div class='caption_inner'>
					<a href='". $link ."'>".$title_box."</a>
					".$date_box."
				  </div></div>
			</div>";
		} else {
			$image = mad_regex($post_content, 'image', "");
			if (is_array($image)) {
				$get_image = $image[0];
				$before = '<div class="scale_image_container '.$custom_class.' ">
						<a class="single-image entry-media photoframe '. $jackbox .'" href="'. $link .'" title="'. sprintf( esc_attr__('%s', 'revija'), the_title_attribute('echo=0') ) .'">
							<img  class="scale_image" src="'. $get_image .'" alt="'. $title .'" />
						</a>
						<div class="caption_type_1"><div class="caption_inner">
							<a href="'. $link .'">'.$title_box.'</a>
							'.$date_box.'
						</div></div>
					</div>';
			} else {
				$image = mad_regex($post_content, '<img />', "");
				if (is_array($image)) {
					$before = '<div class="scale_image_container  '.$custom_class.' ">
						<a class="single-image entry-media photoframe '. $jackbox .'" href="'. $link .'" title="'. sprintf( esc_attr__('%s', 'revija'), the_title_attribute('echo=0') ) .'">
							'. $image[0] .'
						</a>
						<div class="caption_type_1"><div class="caption_inner">
							<a href="'. $link .'">'.$title_box.'</a>
							'.$date_box.'
						</div></div>
					</div>';
				} else {
					$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
					$before = "<div class='scale_image_container ".$custom_class." '>
					<a href='{$link}' data-group='entry-". $id ."' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='single-image entry-media photoframe {$jackbox}'>{$thumbnail}</a>
							<div class='caption_type_1'><div class='caption_inner'>
							<a href='". $link ."'>".$title_box."</a>
							".$date_box."
						  </div></div>
					</div>";
				}
			}
		}

		ob_start(); ?>
		
		<?php echo $before; ?>

		<?php return ob_get_clean();
	}
}





/*	Blog Post Extended Thumbnail with Button
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_extended_blog_post_th_btn') ) {

	function mad_extended_blog_post_th_btn($id = 0, $post_content = '', $title = '', $radius = 14, $image_size='1900*500', $custom_class = '', $count_label = 2 ) {
		$link = esc_url(get_permalink($id));
		$thumbnail = $before = $jackbox = '';
		
			$post_format = get_post_format($id) ? get_post_format($id) : 'standard';
			$icon_type = 'fa-file-text';
			if($post_format == 'standard') {
				$icon_type = 'fa-file-text';
			}
			if($post_format == 'gallery') {
				$icon_type = 'fa-picture-o';
			}
			if($post_format == 'video') {
				$icon_type = 'fa-video-camera';
			}
			if($post_format == 'audio') {
				$icon_type = 'fa-volume-up';
			}
			if($post_format == 'quote') {
				$icon_type = 'fa-quote-left';
			}
			$icon_box = '';
			if ($icon_type != '' && ! is_wp_error($icon_type)){
			$icon_box = '<a href="'.$link.'" class="icon_box">
								  <i class="fa '.$icon_type.'"></i>
								</a>';
			}
		
		
		$cat = '';
		$terms = get_the_terms($id, 'label');
		
		$id_canvas = rand();
		$canvas = '';
		if (mad_custom_get_option('blog-listing-meta-ratings') && $radius > 0) {
		$canvas = "<div class='canvas canvas_small'>
					<div class='circle' id='post-circles-". $id ."-". $id_canvas ."'></div>
					<br />
				</div>";		
		}
		
		if (mad_custom_get_option('blog-listing-meta-category') && $terms != '' && ! is_wp_error($terms)){
			
			 if( count($terms) > $count_label ) {
			  $terms = array_slice($terms, 0, $count_label);
			 }
			
		$cat = "<div class='post_image_buttons'><div class='buttons_container'>";
			foreach($terms as $term) {
			$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
				
			$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
			}
		$cat .= "</div></div>";	
		}

		$date_box = '';
		if (mad_custom_get_option('blog-listing-meta-date')) {
		$date_box = '<div class="event_date">'. get_the_time(get_option('date_format'), $id) .'</div>';
		}
		
		
		$title_box = '<h2>'. $title .'</h2>';
		if ($image_size == '555*374') {
		$title_box = '<h3>'. $title .'</h3>';
		}
		
		$thumbnail_atts = array(
			'class'	=> "scale_image",
			'alt'	=> trim(strip_tags(get_the_excerpt())),
			'title'	=> trim(strip_tags($title))
		);
		
		if (has_post_thumbnail($id)) {
			$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
			$before = "<div class='scale_image_container ".$custom_class." 1'>
			<a href='{$link}' data-group='entry-". $id ."' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='single-image entry-media photoframe {$jackbox}'>{$thumbnail}</a>
				    <div class='caption_type_1'><div class='caption_inner'><div class='container'><div class='clearfix page_theme'>
					". mad_blog_post_meta($id, '') ."
				  </div>
				  <a href='". $link ."'>".$title_box."</a>
				  </div></div></div>
				  ".$canvas."
			</div>";
		} else {
			$image = mad_regex($post_content, 'image', "");
			if (is_array($image)) {
				$get_image = $image[0];
				$before = '<div class="scale_image_container '.$custom_class.'  2">
						<a class="single-image entry-media photoframe '. $jackbox .'" href="'. $link .'" title="'. sprintf( esc_attr__('%s', 'revija'), the_title_attribute('echo=0') ) .'">
							<img  class="scale_image" src="'. $get_image .'" alt="'. $title .'" />
						</a>
						<div class="caption_type_1"><div class="caption_inner"><div class="container"><div class="clearfix page_theme">
						'. mad_blog_post_meta($id, '') .'
						</div>
						<a href="'. $link .'">'.$title_box.'</a>
						</div></div></div>
						  '.$canvas.'
					</div>';
			} else {
				$image = mad_regex($post_content, '<img />', "");
				if (is_array($image)) {
					$before = '<div class="scale_image_container  '.$custom_class.' 3">
						<a class="single-image entry-media photoframe '. $jackbox .'" href="'. $link .'" title="'. sprintf( esc_attr__('%s', 'revija'), the_title_attribute('echo=0') ) .'">
							'. $image[0] .'
						</a>
						<div class="caption_type_1"><div class="caption_inner"><div class="container"><div class="clearfix page_theme">
						'. mad_blog_post_meta($id, '') .'
						</div>
						<a href="'. $link .'">'.$title_box.'</a>
						</div></div></div>
						  '.$canvas.'
					</div>';
				} else {
					$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($id, $image_size, $thumbnail_atts);
					$before = "<div class='scale_image_container ".$custom_class." '>
					<a href='{$link}' data-group='entry-". $id ."' title='". sprintf(esc_attr__('%s', 'revija'), the_title_attribute('echo=0')) ."' class='single-image entry-media photoframe {$jackbox}'>{$thumbnail}</a>
							<div class='caption_type_1'><div class='caption_inner'><div class='container'><div class='clearfix page_theme'>
							". mad_blog_post_meta($id, '') ."
						  </div>
						  <a href='". $link ."'>".$title_box."</a>
						  </div></div></div>
						  ".$canvas."
					</div>";					
				}
				
				
				
			}
		}

		ob_start(); ?>
		
		<?php echo $before; ?>
		
		
		<?php return ob_get_clean();
	}
}









/*	Portfolio Post Meta
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_portfolio_post_meta') ) {

	function mad_portfolio_post_meta($id = 0, $entry = array() ) {
		$comments_count = get_comments_number($id);

		if (!empty($entry)) {
			$comments_count = $entry->comment_count;
		}

		$view_count = revija_getPostViews($id);
		$link = get_permalink($id);

		$cat = '';
		$terms = get_the_terms($id, 'portfolio_label');
	
		ob_start(); ?>

			<?php if (is_single()): ?>

			<div class="f_left">
			
				<?php if (mad_custom_get_option('portfolio-single-meta-category') && $terms != '' && ! is_wp_error($terms)){
					
					 
					
					$cat .= '<div class="post_image_buttons">
						<div class="buttons_container">';
					foreach($terms as $term) {
					$term_color = get_tax_meta($term->term_id,'folio_color_field_id');
						
					$cat .= '<a href="'.get_term_link( $term->slug, 'portfolio_label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
					}
					$cat .= '</div></div>';
					echo $cat;
				} ?>
	
			
				<?php if (mad_custom_get_option('portfolio-single-meta-date')): ?>
					<div class="event_date" ><?php echo get_the_time(get_option('date_format'), $id); ?></div>
				<?php endif; ?>
				
				
			</div>
			
			<div class="f_right event_info">
				<?php if (mad_custom_get_option('portfolio-single-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php
							$link_to = $comments_count === "0" ? "#respond" : "#comments";
						?>
						<a href="<?php echo esc_url($link . $link_to) ?>"><i class="fa fa-comments-o d_inline_m m_right_3"></i>
							<?php echo esc_html($comments_count) ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if (mad_custom_get_option('portfolio-single-meta-liked')): ?>
				
					<?php 
					if(function_exists('kkLikeButton')){
					kkLikeButton(false, $id);
					}
					?>
					
				<?php endif; ?>

				<?php if (mad_custom_get_option('portfolio-single-meta-views')): ?>
					<a href="#">
					  <i class="fa fa-eye d_inline_m m_right_3"></i> 
					  <span><?php echo esc_attr($view_count) ?></span>
					</a>
				<?php endif; ?>
				
			</div><!--/ .f_right-->	
				
				

			<?php else: ?>

				<?php if (mad_custom_get_option('portfolio-listing-meta-date')): ?>
				<div class="f_left">
                    <div class="event_date"><?php echo get_the_time(get_option('date_format'), $id); ?></div>
                </div>
				<?php endif; ?>

				<div class="f_right event_info">
				<?php if (mad_custom_get_option('portfolio-listing-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php
						$link_to = $comments_count === "0" ? "#respond" : "#comments";
						?>
						<a href="<?php echo esc_url($link . $link_to) ?>"><i class="fa fa-comments-o d_inline_m m_right_3"></i>
							<?php echo esc_html($comments_count) ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (mad_custom_get_option('portfolio-listing-meta-liked')): ?>
				
				<?php 
				if(function_exists('kkLikeRating')){
					$db = new kkDataBase;
					$rating = $db->getPostRating($id);
					
					echo '<a href="'. esc_url($link) .'"><i class="fa fa fa-heart-o d_inline_m m_right_3"></i><span>';
					echo $rating;
					echo '</span></a>';
					} 
				?>
				
				<?php endif; ?>
				
				<?php if (mad_custom_get_option('portfolio-listing-meta-views')): ?>
				<a href="<?php echo esc_url($link) ?>">
				  <i class="fa fa-eye d_inline_m m_right_3"></i> 
				  <span><?php echo esc_attr($view_count) ?></span>
				</a>
				<?php endif; ?>
				
				</div><!--/ .f_right-->
				
			<?php endif; ?>

		<?php return ob_get_clean();
	}
}




/*	Blog Post Meta
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_blog_post_meta') ) {

	function mad_blog_post_meta($id = 0, $entry = array()) {
		$comments_count = get_comments_number($id);

		if (!empty($entry)) {
			$comments_count = $entry->comment_count;
		}
		$view_count = revija_getPostViews($id);
		
		$link = get_permalink($id);

		$cat = '';
		$terms = get_the_terms($id, 'label');
	
		ob_start(); ?>

			<?php if (is_single()): ?>

			<div class="f_left">
			
				<?php if (mad_custom_get_option('blog-single-meta-category') && $terms != '' && ! is_wp_error($terms)){
					$cat .= '<div class="post_image_buttons">
						<div class="buttons_container">';
					foreach($terms as $term) {
					$term_color = get_tax_meta($term->term_id,'ba_color_field_id');
						
					$cat .= '<a href="'.get_term_link( $term->slug, 'label') .'"  class="button banner_button '. $term->slug .'" style="background:'.$term_color.'">'. $term->name .'</a>';
					}
					$cat .= '</div></div>';
					echo $cat;
				} ?>
	
			
				<?php if (mad_custom_get_option('blog-single-meta-date')): ?>
					<div class="event_date" ><?php echo get_the_time(get_option('date_format'), $id); ?></div>
				<?php endif; ?>
				
				
			</div>
			
			<div class="f_right event_info">
				<?php if (mad_custom_get_option('blog-single-meta-comment')): ?>
					<?php if ($comments_count != '0' || comments_open($id)): ?>
						<?php
							$link_to = $comments_count === "0" ? "#respond" : "#comments";
						?>
						<a href="<?php echo esc_url($link . $link_to) ?>"><i class="fa fa-comments-o d_inline_m m_right_3"></i>
							<?php echo esc_attr($comments_count) ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
					
				<?php if (mad_custom_get_option('blog-single-meta-liked')): ?>	
					
					<?php 
					if(function_exists('kkLikeButton')){
						
					kkLikeButton();
						
					} 
					?>
					
				<?php endif; ?>
				
				<?php if (mad_custom_get_option('blog-single-meta-views')): ?>	
					<a href="<?php echo esc_url($link) ?>">
					  <i class="fa fa-eye d_inline_m m_right_3"></i> 
					  <span><?php echo esc_attr($view_count) ?></span>
					</a>
				<?php endif; ?>
				
			</div><!--/ .f_right-->	
				
				

			<?php else: ?>

				<?php if (mad_custom_get_option('blog-listing-meta-date')): ?>
				<div class="f_left">
                    <div class="event_date"><?php echo get_the_time(get_option('date_format'), $id); ?></div>
                </div>
				<?php endif; ?>

				<div class="f_right event_info">
				<?php if (mad_custom_get_option('blog-listing-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php
						$link_to = $comments_count === "0" ? "#respond" : "#comments";
						?>
						<a href="<?php echo esc_url($link . $link_to) ?>"><i class="fa fa-comments-o d_inline_m m_right_3"></i>
							<?php echo esc_html($comments_count) ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-listing-meta-liked')): ?>
				
				<?php 
				if(function_exists('kkLikeRating')){
					$db = new kkDataBase;
					$rating = $db->getPostRating($id);
					
					echo '<a href="'. esc_url($link) .'"><i class="fa fa fa-heart-o d_inline_m m_right_3"></i><span>';
					echo $rating;
					echo '</span></a>';
					} 
				?>
				
				<?php endif; ?>
				
				<?php if (mad_custom_get_option('blog-listing-meta-views')): ?>
				<a href="<?php echo esc_url($link) ?>">
				  <i class="fa fa-eye d_inline_m m_right_3"></i> 
				  <span><?php echo esc_attr($view_count) ?></span>
				</a>
				<?php endif; ?>
				
				</div><!--/ .f_right-->
				
			<?php endif; ?>

		<?php return ob_get_clean();
	}
}





/* 	Regex
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_regex')) {

	/*
	*	Regex for url: http://mathiasbynens.be/demo/url-regex
	*/
	function mad_regex($string, $pattern = false, $start = "^", $end = "") {
		if (!$pattern) return false;

		if ($pattern == "url") {
			$pattern = "!$start((https?|ftp)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?)$end!";
		} else if ($pattern == "mail") {
			$pattern = "!$start\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$end!";
		} else if ($pattern == "image") {
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:jpg|gif|png)))$end!";
		} else if ($pattern == "mp4") {
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:mp4)))$end!";
		} else if (strpos($pattern,"<") === 0) {
			$pattern = str_replace('<',"",$pattern);
			$pattern = str_replace('>',"",$pattern);

			if (strpos($pattern,"/") !== 0) { $close = "\/>"; $pattern = str_replace('/',"",$pattern); }
			$pattern = trim($pattern);
			if (!isset($close)) $close = "<\/".$pattern.">";

			$pattern = "!$start\<$pattern.+?$close!";
		}

		preg_match($pattern, $string, $result);

		if (empty($result[0])) {
			return false;
		} else {
			return $result;
		}
	}
}

/*	Tag Archive Page
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_tag_archive_page')) {

	function mad_tag_archive_page($query) {
		$post_types = get_post_types();

		if (is_category() || is_tag()) {
			if (!is_admin() && $query->is_main_query()) {

				$post_type = get_query_var(get_post_type());

				if ($post_type) {
					$post_type = $post_type;
				} else {
					$post_type = $post_types;
				}
				$query->set('post_type', $post_type);
			}
		}
		return $query;
	}
	add_filter('pre_get_posts', 'mad_tag_archive_page');
}

/*	Add Thumbnail Size
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_add_thumbnail_size')) {

	function mad_add_thumbnail_size($themeImgSizes) {
		if (function_exists('add_theme_support')) {
			foreach ($themeImgSizes as $size_name => $size) {
				if (!isset($themeImgSizes[$size_name]['crop'])) {
					$themeImgSizes[$size_name]['crop'] = true;
				}
				add_image_size($size_name,
					$themeImgSizes[$size_name]['width'],
					$themeImgSizes[$size_name]['height'],
					$themeImgSizes[$size_name]['crop']
				);
			}
		}
	}
}

/* 	Filter Hook for Comments
/* --------------------------------------------------------------------- */

if ( !function_exists('mad_output_comments')) {

	function mad_output_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php echo comment_ID() ?>">

			<div class="comment clearfix">

				<div class="comment-avatar">
					<div><?php echo get_avatar($comment, 80); ?></div>
					<?php echo get_comment_reply_link(array_merge(
							array('reply_text' => esc_html__('Reply', 'revija').'<i class="fa fa-mail-reply"></i>'),
							array('depth' => $depth, 'max_depth' => $args['max_depth'])
						));
						?>
			    </div>
				

				<div class="comment-info" >
					<div class="clearfix">
					  <h5 class="f_left comment_author second_font"><?php echo get_comment_author_link() ?></h5>
					  <div class="event_date f_right"><?php comment_date('Y-m-d H:i') ?></div>
					</div>
					<?php comment_text(); ?>
				</div>				

			</div><!--/ .comment-->

		

	<?php
	}
}

/* 	Filter Hooks for Respond
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_comments_form_hook')) {

	function mad_comments_form_hook ($defaults) {
		$commenter = wp_get_current_commenter();

		$req = get_option('require_name_email');
		$mad_req = ($req ? " (required)" : '');
		$mad_reg_email = ($req ? "<span class='required'>*</span>" : '');

		$defaults['fields']['author'] = '
		<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> '.
			'<label for="author">' . esc_html__( 'Name', 'revija' ) . ( $req ? $mad_reg_email : '' ) . '</label> '.
			'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" />'.
			'</div>';

		$defaults['fields']['email'] = '
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> '.
			'<label for="email">' . esc_html__( 'Email', 'revija' ) . ( $req ? $mad_reg_email : '' ) . '</label> '.
			'<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" />'.
			'</div></div>';

		$defaults['fields']['url'] = '
		'.
			'<label for="url">' . esc_html__( 'Website', 'revija' ) . ( $req ? $mad_reg_email : '' ) . '</label> '.
			'<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />'.
			'';
		
		$defaults['comment_field'] = '<label for="comment">' . esc_html__( 'Comments', 'revija' ) . '</label><textarea id="comment" name="comment" ></textarea>';
		
		
		$defaults['comment_notes_before'] = '<p>'. esc_html__( 'Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Required fields are marked', 'revija' ).'<span class="required">*</span></p>';
		$defaults['comment_notes_after'] = '';

		$defaults['cancel_reply_link'] = ' - ' . esc_html__('Cancel quote', 'revija');
		$defaults['title_reply'] = esc_html__('Leave a Reply', 'revija');
		$defaults['label_submit'] = esc_html__('Post Comment', 'revija');
		$defaults['id_form'] = 'contactform';
		$defaults['id_submit'] = 'contactform-submit';

		return $defaults;
	}
	add_filter('comment_form_defaults', 'mad_comments_form_hook');
}

/*	Analytics Tracking Code
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_get_tracking_code') ) {

	function mad_get_tracking_code() {
		global $revija_config;

		$revija_config['analytics_code'] = mad_custom_get_option('analytics');
		if (empty($revija_config['analytics_code'])) return;

		if (strpos($revija_config['analytics_code'],'UA-') === 0) {
			$revija_config['analytics_code'] = "
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '". $revija_config['analytics_code'] ."', 'auto');
				ga('send', 'pageview');
			</script>";
		}
		add_action('wp_head', 'mad_print_tracking_code');
	}

	add_action('init', 'mad_get_tracking_code');

	function mad_print_tracking_code() {
		global $revija_config;
		if (!empty($revija_config['analytics_code'])) {
			echo $revija_config['analytics_code'];
		}
	}

}


/*	Post ID
/* ---------------------------------------------------------------------- */

if (!function_exists( 'mad_post_id' )) {

	function mad_post_id() {
		global $post, $revija_config;
		$post_id = 0;
		if (isset( $post->ID )) {
			$post_id = $post->ID;
			$revija_config['post_id'] = $post_id;
		} else {
			return get_the_ID();
		}
		return $post_id;
	}
}

/*	Body Background
/* ---------------------------------------------------------------------- */

if (!function_exists( 'mad_body_background' )) {

	function mad_body_background() {
		$post_id = mad_post_id();

		$color = rwmb_meta('mad_bg_color', '', $post_id);
		$image = rwmb_meta('mad_bg_image', '', $post_id);

		if (!empty($image) && $image > 0) {
			$image = wp_get_attachment_image_src($image, '');
			if (is_array($image) && isset($image[0])) {
				$image = $image[0];
			}
		}

		$image_repeat     = rwmb_meta('mad_bg_image_repeat', '', $post_id);
		$image_position   = rwmb_meta('mad_bg_image_position', '', $post_id);
		$image_attachment = rwmb_meta('mad_bg_image_attachment', '', $post_id);

		$css = array();

		if (!empty( $image ) && !empty( $image_attachment )) { $css[] = "background-attachment: $image_attachment;"; }
		if (!empty( $image ) && !empty( $image_position ))   { $css[] = "background-position: $image_position;"; }
		if (!empty( $image ) && !empty( $image_repeat ))     { $css[] = "background-repeat: $image_repeat;"; }

		if (!empty( $color ))                     			 { $css[] = "background-color: $color !important;"; }
		if (!empty( $image ) && $image != 'none') 			 { $css[] = "background-image: url('$image') !important;"; }

		if (empty( $css )) return;
		?>
		<style type="text/css">body { <?php echo implode( ' ', $css ) ?> } </style>

	<?php
	}

	add_filter('wp_head', 'mad_body_background');
}

/*	Which Archive
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_which_archive')) {

	function mad_which_archive() {

		ob_start(); ?>

		<?php if (is_category()): ?>

			<?php echo esc_html__('Archive for category', 'revija') . " " . single_cat_title('', false); ?>

		<?php elseif (is_day()): ?>

			<?php echo esc_html__('Archive for date', 'revija') . " " . get_the_time( esc_html__('F jS, Y', 'revija')); ?>

		<?php elseif (is_month()): ?>

			<?php echo esc_html__('Archive for month', 'revija') . " " . get_the_time( esc_html__('F, Y', 'revija')); ?>

		<?php elseif (is_year()): ?>

			<?php echo esc_html__('Archive for year', 'revija') . " " . get_the_time( esc_html__('Y', 'revija')); ?>

		<?php elseif (is_search()): global $wp_query; ?>

			<?php if (!empty($wp_query->found_posts)): ?>

				<?php if ($wp_query->found_posts > 1): ?>

					<?php echo esc_html__('Search results for:', 'revija')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"; ?>

				<?php else: ?>

					<?php echo esc_html__('Search result for:', 'revija')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"; ?>

				<?php endif; ?>

			<?php else: ?>

				<?php if (!empty($_GET['s'])): ?>

					<?php echo esc_html__('Search results for:', 'revija') . " " . esc_attr(get_search_query()); ?>

				<?php else: ?>

					<?php echo esc_html__('To search the site please enter a valid term', 'revija'); ?>

				<?php endif; ?>

			<?php endif; ?>

		<?php elseif (is_author()): ?>

			<?php $auth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); ?>

			<?php if (isset($auth->nickname) && isset($auth->ID)): ?>

				<?php $name = $auth->nickname; ?>

				<?php echo esc_html__('Author Archive', 'revija'); ?>
				<?php echo esc_html__('for:', 'revija') . " " . $name; ?>

			<?php endif; ?>

		<?php elseif (is_tag()): ?>

			<?php echo esc_html__('Tag archive for', 'revija') . " " . single_tag_title('', false); ?>

			<?php
				$term_description = term_description();
				if ( ! empty( $term_description ) ) {
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				}
			?>

		<?php elseif (is_tax()): ?>

			<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

			<?php if (is_product_tag()): ?>
				<?php echo esc_html__('Products by', 'revija') . ' "' . $term->name . '" tag'; ?>
			<?php else: ?>
				<?php echo esc_html__('Archive for', 'revija') . " " . $term->name; ?>
			<?php endif; ?>

		<?php else: ?>

			<?php if (is_post_type_archive( 'product' )): ?>
				<?php echo esc_html__('Product Archive', 'revija'); ?>
			<?php elseif(is_post_type_archive()): ?>
				<?php echo esc_html__('Archive ' . get_query_var('post_type'), 'revija'); ?>
			<?php else: ?>
				<?php echo esc_html__('Archive', 'revija'); ?>
			<?php endif; ?>

		<?php endif; ?>

		<?php return ob_get_clean();
	}
}