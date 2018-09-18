<?php
$output = $title = $el_class = $nav_menu = '';
extract( shortcode_atts( array(
	'title' => '',
	'nav_menu' => '',
	'nav_menu' => '',
	'depth' => 0,
	'el_class' => ''
), $atts ) );
$el_class = $this->getExtraClass( $el_class );


$type = 'WP_Nav_Menu_Widget';

$mad_widget_args = array(
	'before_widget' => '<div class="section widget %s" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);


 $nav_menu = ! empty( $atts['nav_menu'] ) ? wp_get_nav_menu_object( $atts['nav_menu'] ) : false;
 
        if ( !$nav_menu ) {
			return;
		}
            


echo '<div class="vc_wp_custommenu wpb_content_element' . $el_class . '">';

ob_start();

		echo $mad_widget_args['before_widget'];
 
        if ( $title ) {
            echo $mad_widget_args['before_title'] . $title . $mad_widget_args['after_title'];
        }
		
		
		$args = array(
		'menu'    => $nav_menu,
		'echo'          => true,
		'depth'         => $depth 
		);
		wp_nav_menu( $args );

		echo $mad_widget_args['after_widget'];
		
echo ob_get_clean();

echo '</div>' . $this->endBlockComment( 'vc_wp_custommenu' ) . "\n";


