<?php
$output = $title = $el_id = '';

extract( shortcode_atts( array(
	'title' => esc_html__( "Section", "revija" ),
	'el_id' => '',
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div ' . ( isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : "" ) . 'class="accordion_item ' . $css_class . '">';
$output .= "\n\t\t\t\t" . '<h3 class="a_title">' . $title . '<span class="minus_icon"></span><span class="plus_icon"></span></h3>';
$output .= "\n\t\t\t\t" . '<div class="a_content">';
$output .= ( $content == '' || $content == ' ' ) ? esc_html__( "Empty section. Edit page to add content here.", "revija" ) : "\n\t\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t\t\t" . '</div>';
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment( '.wpb_accordion_section' ) . "\n";

echo $output;