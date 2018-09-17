<?php
$output = $title = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_search wpb_content_element' . $el_class . '">';
$type = 'WP_Widget_Search';
$args = array();


$mad_widget_args = array(
	'before_widget' => '<div class="section widget %s" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);



ob_start();
the_widget( $type, $atts, $mad_widget_args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment( 'vc_wp_search' ) . "\n";

echo $output;