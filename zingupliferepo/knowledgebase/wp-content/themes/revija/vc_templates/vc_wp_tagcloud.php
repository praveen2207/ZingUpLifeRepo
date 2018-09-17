<?php
$output = $title = $el_class = $count = $taxonomy = $type_display = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Tags', 'revija' ),
	'taxonomy' => 'post_tag',
	'type_display' => 'list',
	'count' => '',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$current_taxonomy = $atts['taxonomy'];
if ( !empty($atts['title']) ) {
            $title = $atts['title'];
        } else {
            if ( 'post_tag' == $current_taxonomy ) {
                $title = esc_html__('Tags', 'revija');
            } else {
                $tax = get_taxonomy($current_taxonomy);
                $title = $tax->labels->name;
            }
        }



$output = '<div class="vc_wp_tagcloud vc_wp_tagcloud_' . $type_display . ' wpb_content_element' . $el_class . '">';	

//$type = 'WP_Widget_Tag_Cloud';
//$args = array();



$mad_widget_args = array(
	'before_widget' => '<div id="vc_wp_tagcloud_widget" class="section widget"  >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);


 $output .= $mad_widget_args['before_widget'];
        if ( $title ) {
            $output .= $mad_widget_args['before_title'] . $title . $mad_widget_args['after_title'];
        }



ob_start();

//the_widget( $type, $atts, $mad_widget_args );

$args = array(
	 'smallest'                  => 13
	,'largest'                   => 13
	,'unit'                      => 'px'
	,'number'                    => $count
	,'format'                    => $type_display
	,'separator'                 => "\n"
	,'orderby'                   => 'name'
	,'order'                     => 'ASC'
	,'exclude'                   => null
	,'include'                   => null
	,'topic_count_text_callback' => 'default_topic_count_text'
	,'link'                      => 'view'
	,'taxonomy'                  => $atts['taxonomy']
	,'echo'                      => true
); 

wp_tag_cloud( $args );



$output .= ob_get_clean();

$output .= $mad_widget_args['after_widget'];

$output .= '</div>' . $this->endBlockComment( 'vc_wp_tagcloud' ) . "\n";

echo $output;