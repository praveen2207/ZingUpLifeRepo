<?php
/** @var WPBakeryShortCode_VC_Basic_Grid $this */
/** @var $atts array */
$title = $style_custom = $show_filter = '';
$style_custom = 'style1';

$isotope_options = $posts = $filter_terms = array();
$this->buildAtts( $atts, $content );

$css = isset( $atts['css'] ) ? $atts['css'] : '';
$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';

$class_to_filter = 'vc_grid-container vc_clearfix wpb_content_element ' . $this->shortcode;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


if(!empty($atts['show_filter'])) {
	$show_filter = 'yes';	
}
if(!empty($atts['title'])) {
	$title = $atts['title'];
}
if(!empty($atts['style_custom'])) {
$style_custom = $atts['style_custom'];
}




//wp_enqueue_script( 'prettyphoto' );
//wp_enqueue_style( 'prettyphoto' );

$this->buildGridSettings();
if ( isset( $this->atts['style'] ) && 'pagination' === $this->atts['style'] ) {
	wp_enqueue_script( 'twbs-pagination' );
}





$this->enqueueScripts();
wp_dequeue_style( 'vc_pageable_owl-carousel-css' );
wp_dequeue_style( 'vc_pageable_owl-carousel-css-theme' );
?>

<!-- vc_grid start -->
<div class="grid-home  vc_grid-container-wrapper vc_clearfix mystyle-<?php echo esc_attr( $style_custom ) ?>">
	<div class="vc_grid-container vc_clearfix wpb_content_element<?php echo esc_attr( $css_class ) ?>"
	     data-vc-<?php echo esc_attr($this->pagable_type) ?>-settings="<?php echo esc_attr( json_encode( $this->grid_settings ) ) ?>"
	     data-vc-request="<?php echo esc_attr( admin_url( 'admin-ajax.php', 'relative' ) ) ?>"
	     data-vc-post-id="<?php echo esc_attr( get_the_ID() ) ?>"
		 data-vc-public-nonce="<?php echo vc_generate_nonce( 'vc-public-nonce' ); ?>">
		 
		<?php if (!empty($title)): ?>
				<?php echo "<h3 class='section_title'>" . $title . "</h3>"; ?>
		<?php endif; ?>
		 
		 
		 <?php if ( $show_filter === 'yes' ): ?>
		 <a href="#" id="sort_button" class="f_right color_grey_2"><i class="fa fa-bars f_size_medium"></i>
         </a>
	     <?php endif; ?>
					  
	</div>
</div>


