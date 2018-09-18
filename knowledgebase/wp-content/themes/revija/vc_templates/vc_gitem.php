<?php
/**
 * @var string $el_class
 * @var string $width
 * @var string $is_end
 * @var array $atts ;
 * @var string $content ;
 * @var string $c_zone_position ;
 * @var string bgimage;
 * @var string height;
 */
extract( shortcode_atts( array(
	'el_class' => '',
	'width' => '12',
	'is_end' => '',
	'css' => '',
	'c_zone_position' => '',
	'bgimage' => '',
	'height' => '',
), $atts ) );

$css_class = 'post-item-home vc_grid-item vc_clearfix' . ( $is_end === 'true' ? ' vc_grid-last-item' : '' )
             . ( strlen( $el_class ) ? ' ' . $el_class : '' )
             . ' vc_col-sm-'
             . $width
             . ( ! empty( $c_zone_position ) ? ' vc_grid-item-zone-c-' . $c_zone_position : '' );
$css_class .= '{{ filter_terms_css_classes }}';
$css_style = '';

if ( strlen( $height ) > 0 ) {
	$css_style .= 'height: ' . $height . ';';
}

//post_datetime
//post_image
//post_image_url
//post_link_url
//post_date
//post_excerpt
//post_title

$id = '{{ post_id }}';
$link = '{{ post_link_url }}';
$title = '{{ post_title }}';
$thumbnail = '{{ post_image }}';
$cat = '{{ post_cat }}';
$post_img_btn = '{{ post_img_btn }}';
$post_meta = '{{ post_meta }}';
$post_content = '{{ post_text }}';




$output = '<div class="' . esc_attr( $css_class ) . '"'
          . ( empty( $css_style ) ? '' : ' style="' . esc_attr( $css_style ) . '"' )
          . '>' . $post_img_btn
		  . '<div class="wrapper"><div class="clearfix">'. $post_meta .'</div>'. $post_content .'</div>   
		  <div class="vc_clearfix"></div></div>'
          . '';
echo $output;



 ?>

