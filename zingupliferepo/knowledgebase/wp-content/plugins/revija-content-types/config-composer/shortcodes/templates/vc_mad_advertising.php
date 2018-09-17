<?php

class WPBakeryShortCode_VC_mad_advertising extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'images'   => "",
			'img_size' => "",
			'custom_links' => "",
			'gap' => '0',
			'custom_links_target' => "",
			'el_class' => ''
		), $atts, 'vc_mad_advertising');

		return $this->html();
	}

	public function html() {

		$images = $gap = $img_size = $output = $el_class = '';

		extract($this->atts);

		$images = explode( ',', $images);

		
		$el_class = $this->getExtraClass( $el_class );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section ' . $el_class . ' t_align_c', $this->settings['base'], $this->atts );
		
		$custom_links = explode( ',', $custom_links );
		
		 if (strpos($img_size, '^')) {
			 $img_sizes = explode( '^', $img_size);
		 } else {
			 $img_sizes = array($img_size);
		 }

		$i = - 1;
		
		$output .= '<div class="'. apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $this->atts ) .'" style="margin-top:'. $gap .'px;" ><div class="advertising_block">';
		
		foreach ( $images as $id => $attach_id ) {
			$i ++;
			if ($attach_id > 0) {
				$img_new_size = ($img_sizes[$id]) ? $img_sizes[$id] : '336*280';
				$post_thumbnail = REVIJA_HELPER::get_the_thumbnail($attach_id, $img_new_size, array( 'class' => 'adv_img', 'alt' => '') );
				
			} else {
				$post_thumbnail = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
			}

			$link_start = $link_end = '';
			if ( isset( $custom_links[ $i ] ) && $custom_links[ $i ] != '' ) {
				$link_start = '<a href="' . $custom_links[ $i ] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>';
				$link_end = '</a>';
			}
	
			$output .= $link_start . $post_thumbnail . $link_end;
				
			
		}
		$output .= '</div></div>';
		return $output;
	}

}

