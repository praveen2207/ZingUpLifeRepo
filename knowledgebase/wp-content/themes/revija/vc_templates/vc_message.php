<?php
/**
 * @var $this WPBakeryShortCode_VC_Message
 * @var array $atts
 *
 * @var string $el_class
 * @var string $style
 * @var string $shape
 * @var string $type
 * @var string $color
 * @var string $css_animation
 * @var string $message_box_type
 * @var string $message_box_style
 * @var string $message_box_shape
 * @var string $message_box_color
 * @var string $icon_type
 */
$defaultFont = 'fontawesome';
$defaultIconClass = 'fa fa-info-circle';
//$this->convert..
$atts = $this->convertAttributesToMessageBox2( $atts );
$defaults = array(
	'el_class' => '',
	'message_box_style' => 'classic',
	'style' => 'rounded', // dye to backward compatibility message_box_shape
	'color' => 'alert-info', //message_box_type due to backward compatibility
	'message_box_color' => 'alert-info',
	'css_animation' => '',
	'icon_type' => $defaultFont,
	'icon_fontawesome' => $defaultIconClass,
);

$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

$elementClass = array(
	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_message_box', $this->settings['base'], $atts ),
	'style' => 'vc_message_box-' . $message_box_style,
	'shape' => 'vc_message_box-' . $style,
	'color' => ( strlen( $color ) > 0 && strpos( 'alert', $color ) === false ) ? 'vc_color-' . $color : 'vc_color-' . $message_box_color,
	'extra' => $this->getExtraClass( $el_class ),
	'css_animation' => $this->getCSSAnimation( $css_animation ),
);
$elementClass = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $elementClass ) );

?>


	<div class="alert <?php echo esc_attr( $color ); ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo wpb_js_remove_wpautop( $content, true );?>
	</div>
	
	
	
	
	
	
	
	