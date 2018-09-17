<?php
/**
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$output = $text = $google_fonts = $animations = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = $with_bottom_border = '';
extract( $this->getAttributes( $atts ) );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

if (isset($atts['css_animation']) && !empty($atts['css_animation'])) {
	$animations = $this->getExtraClass(REVIJA_VC_CONFIG::getCSSAnimation($atts['css_animation']));
}

$add_border = (isset($atts['with_bottom_border']) && $atts['with_bottom_border'] == 'on') ? $this->getExtraClass('with_border') : '';
$heading_color = (isset($atts['heading_color']) && !empty($atts['heading_color'])) ? $atts['heading_color'] : '';
$text_align = (isset($atts['text_align']) && !empty($atts['text_align'])) ? $this->getExtraClass($atts['text_align']) : '';

$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}
$output .= '<div class="' . esc_attr( $css_class ) . esc_attr($animations) . esc_attr( $add_border ) . esc_attr($text_align). '" >';
$style = '';
if ( ! empty( $heading_color ) ) {
	$style = 'style="color: ' . $heading_color . '"';
}

$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
$output .= $text;
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= '</div>';

echo $output;