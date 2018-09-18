<?php
$output = $title = $options = $el_class = $type_display = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Categories', 'revija' ),
	'options' => '',
	'count_num' => '',
	'type_display' => 'type1',
	'el_class' => ''
), $atts ) );
$options = explode( ",", $options );
if ( in_array( "dropdown", $options ) ) {
	$atts['dropdown'] = true;
}
if ( in_array( "count", $options ) ) {
	$atts['count'] = true;
}
if ( in_array( "hierarchical", $options ) ) {
	$atts['hierarchical'] = true;
}

$el_class = $this->getExtraClass( $el_class );



$output = '<div class="vc_wp_categories wpb_content_element ' . $el_class . ' vc_wp_categories_' . $type_display . '">';
$type = 'WP_Widget_Categories';

$mad_widget_args = array(
	'before_widget' => '<div id="wp_categories_widget" class="section widget">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);

ob_start();

        $c = ! empty( $atts['count'] ) ? '1' : '0';
        $h = ! empty( $atts['hierarchical'] ) ? '1' : '0';
        $d = ! empty( $atts['dropdown'] ) ? '1' : '0';
 
        echo $mad_widget_args['before_widget'];
        if ( $title ) {
            echo $mad_widget_args['before_title'] . $title . $mad_widget_args['after_title'];
        }
 
        $cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);
 
        if ( $d ) {
            $cat_args['show_option_none'] = esc_html__('Select Category', 'revija');

			$cat_args['number'] = $count_num;
			
            wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
			?>
			 
			<script type='text/javascript'>
			/* <![CDATA[ */
				var dropdown = document.getElementById("cat");
				function onCatChange() {
					if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
						location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
					}
				}
				dropdown.onchange = onCatChange;
			/* ]]> */
			</script>
			 
			<?php
					} else {
			?>
					<ul>
			<?php
					$cat_args['title_li'] = '';
					$cat_args['number'] = $count_num;

					wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
			?>
					</ul>
			<?php
					}
			 
			echo $mad_widget_args['after_widget'];



$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment( 'vc_wp_categories' ) . "\n";

echo $output;