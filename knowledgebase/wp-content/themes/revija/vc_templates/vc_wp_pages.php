<?php
$output = $title = $el_class = $sortby = $exclude = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Pages', 'revija' ),
	'sortby' => 'menu_order',
	'exclude' => null,
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_pages wpb_content_element' . $el_class . '">';
$type = 'WP_Widget_Pages';
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

$output .= '</div>' . $this->endBlockComment( 'vc_wp_pages' ) . "\n";

echo $output;