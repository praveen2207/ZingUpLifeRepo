<!-- - - - - - - - - - - - Post Extended - - - - - - - - - - - -->

<?php
	if (is_singular(get_post_type()) == 'post') {
		
		$id = get_the_ID();
		$extended = rwmb_meta('mad_extended_featured', '', $id);
		$title = get_the_title($id);
	
		if($extended) {
		echo '<div class="featured_img">';	
		echo mad_extended_blog_post_th_btn($id, '', $title, 0, '1900*500');
		echo '</div>';
		}
	
	}
?>

<!-- - - - - - - - - - - - / Post Extended - - - - - - - - - - - -->