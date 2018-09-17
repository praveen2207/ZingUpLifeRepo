<?php
/*
Plugin Name: Revija shortcode
Description: Shortcodev for Revija eCommerce Theme.
Version: 1.0
Author: mad_velikorodnov
Author URI: inthe7heaven.com
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Enqueue plugin CSS file
 */
function revija_custom_css() {
	wp_enqueue_style('style-shortcode-css', plugins_url('style_shortcode.css', __FILE__));
}
add_action('wp_print_styles', 'revija_custom_css');  


if (!class_exists('revija_shortcode')) {
	
class revija_shortcode
{
	function revija_shortcode()
	{
		if (function_exists ('add_shortcode') )
		{
			add_shortcode('revija_shortcode', array (&$this, 'mad_add_shortcode1') );
			add_shortcode('message_shortcode', array (&$this, 'mad_add_shortcode2') );
			
			add_shortcode('mad_gallery', array (&$this, 'mad_gallery_shortcode') );
			
			add_filter( 'mce_buttons_3', array(&$this, 'mce_buttons') );
			add_filter( 'mce_external_plugins', array(&$this, 'mce_external_plugins') );	
		}
	}
	
	
	function mad_add_shortcode1($atts, $content = null)
	{
		extract(shortcode_atts(array(
		"title" => '',
		"text" => '',
		"position" => ''
		), $atts));
		
		$res ='';
		
		$res .= '<a href="#" class="custom_tooltip '. $position .'"><span class="tooltip">'. $title .'</span>'. $text .'</a>';
		
		return $res;
	}

	function mad_add_shortcode2($atts, $content = null)
	{
		extract(shortcode_atts(array(
		"type" => '',
		"text" => ''
		), $atts));
		
		$res ='';
		
		$res .= '<span class="custom_info1 '. $type .'">'. $text .'</span>';
		
		return $res;
	}

	
	
	
	
	/*	Gallery Shortcode
/* ---------------------------------------------------------------------- */

	function mad_gallery_shortcode($atts) {
		$output = $jackbox = $ids = $post_id = $image_size = '';

		extract(shortcode_atts(array(
			'ids'     => '',
			'width'   => '',
			'height'  => '',
			'image_size' => '',
			'post_id' => ''
		), $atts));

		$attachments = get_posts(array(
			'include' => $ids,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
		));

		if (!empty($attachments) && is_array($attachments)) {
			$output .= "<div id='owl-demo-3' class='owl-carousel'>";
			foreach ($attachments as $attachment) {
				if (is_single()) {
					$permalink = REVIJA_HELPER::get_post_attachment_image($attachment->ID, '');
					$jackbox = '';
				} else {
					$permalink = get_permalink($post_id);
				}
				$output .= "<div class='item'><div class='scale_image_container'>";
					//$output .= '<a data-group="entry-'. esc_attr($post_id) .'" class="single-image '. esc_attr($jackbox) .'" href="'. esc_url($permalink) .'">';
						$output .= REVIJA_HELPER::get_the_thumbnail($attachment->ID, $image_size, array( 'class' => 'scale_image') );
					//$output .= '</a>';
				$output .= "</div></div>";
			}
			$output .= "</div>";
			return $output;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	// Load the TinyMCE plugin : editor_plugin_src.js 
	function mce_external_plugins($plugin_array) 
	{
		$plugin_array['revija_shortcode'] = plugins_url ('/revija_shortcode/js/editor_plugin_src.js');
		return $plugin_array;
	}
	
	function mce_buttons($buttons)
	{
		array_push($buttons, "revija_shortcode", "message_shortcode", "highlights_shortcode", "small_shortcode");
  		return $buttons;
	}
}

new revija_shortcode();
}
?>