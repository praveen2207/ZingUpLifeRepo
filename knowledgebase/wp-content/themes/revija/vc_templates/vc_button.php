<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = $align = $css_animation = '';
extract( shortcode_atts( array(
	'color' => 'button_orange',
	'size' => 'large',
	'icon' => 'none',
	'target' => '_self',
	'href' => '',
	'el_class' => '',
	'title' => '',
	'position' => '',
	'align' => 'align-left',
	'css_animation' => ''
), $atts ) );
$a_class = '';

if ( $el_class != '' ) {
	$tmp_class = explode( " ", strtolower( $el_class ) );
	$tmp_class = str_replace( ".", "", $tmp_class );
	if ( in_array( "prettyphoto", $tmp_class ) ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		$a_class .= ' prettyphoto';
		$el_class = str_ireplace( "prettyphoto", "", $el_class );
	}
	if ( in_array( "pull-right", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-right';
		$el_class = str_ireplace( "pull-right", "", $el_class );
	}
	if ( in_array( "pull-left", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-left';
		$el_class = str_ireplace( "pull-left", "", $el_class );
	}
}

$target = ( $target != '' ) ? ' target="' . $target . '"' : '';

$color = ( $color != '' ) ? ' ' . $color : '';
$icon = ( $icon != '' && $icon != 'none' ) ? ' ' . $icon : '';
$icon_class = ( $icon != '' && $icon != 'none' ) ? ' button_type_icon_' . $size : '';
$i_icon = ( $icon != '' ) ? ' <i class="fa ' . $icon . '"> </i>' : '';
$size = ( $size != '' && $size != 'wpb_regularsize' ) ? ' wpb_btn-' . $size : ' ' . $size;
$position = ( $position != '' ) ? ' ' . $position . '-button-position' : '';
$el_class = $this->getExtraClass( $el_class );
$animations = $this->getExtraClass(REVIJA_VC_CONFIG::getCSSAnimation($css_animation));

if($title == '') {
	$icon_class .= ' icon ';	
}


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_button ' . $color . $size . $icon_class . $el_class . $animations . $position, $this->settings['base'], $atts );

ob_start() ?>

<?php if ($align != 'align-left'): ?>
	<div class="<?php echo esc_attr($align) ?>">
<?php endif; ?>

	<a class="<?php echo esc_attr($a_class) . esc_attr($css_class) ?>" title="<?php echo esc_attr($title) ?>" href="<?php echo esc_url($href) ?>" <?php echo esc_attr($target) ?>>
		<?php echo esc_attr($title) . $i_icon ?>
	</a>

<?php if ($align != 'align-left'): ?>
	</div>
<?php endif; ?>

<?php echo ob_get_clean();

