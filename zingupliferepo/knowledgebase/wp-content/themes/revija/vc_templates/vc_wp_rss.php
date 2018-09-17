<?php
$output = $title = $url = $items = $options = $el_class = '';
$atts = shortcode_atts( array(
	'title' => '',
	'url' => '',
	'items' => 10,
	'options' => '',
	'el_class' => ''
), $atts );
$atts['url'] = html_entity_decode( $atts['url'], ENT_QUOTES ); // fix #2034
extract( $atts );
if ( $url == '' ) {
	return;
}

$options = explode( ",", $options );
if ( in_array( "show_summary", $options ) ) {
	$atts['show_summary'] = true;
}
if ( in_array( "show_author", $options ) ) {
	$atts['show_author'] = true;
}
if ( in_array( "show_date", $options ) ) {
	$atts['show_date'] = true;
}

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_rss wpb_content_element' . $el_class . '">';
$type = 'WP_Widget_RSS';
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

$output .= '</div>' . $this->endBlockComment( 'vc_wp_rss' ) . "\n";

echo $output;