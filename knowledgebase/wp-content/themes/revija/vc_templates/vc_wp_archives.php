<?php
$output = $title = $options = $el_class = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Archives', 'revija' ),
	'options' => '',
	'el_class' => ''
), $atts ) );
$options = explode( ",", $options );
if ( in_array( "dropdown", $options ) ) {
	$atts['dropdown'] = true;
}
if ( in_array( "count", $options ) ) {
	$atts['count'] = true;
}

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_archives wpb_content_element' . $el_class . '">';
$type = 'WP_Widget_Archives';
$args = array();

$mad_widget_args = array(
	'before_widget' => '<div id="widget_archives" class="section widget widget_archives" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);


ob_start();
the_widget( $type, $atts, $mad_widget_args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment( 'vc_wp_archives' ) . "\n";

echo $output;