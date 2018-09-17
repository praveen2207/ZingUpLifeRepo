<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Product Search Widget
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class Mad_WC__Widget_Product_Search extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_search';
		$this->widget_description = esc_html__( 'A Search box for products only.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_product_search';
		$this->widget_name        = esc_html__( 'WooCommerce Product Search', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'woocommerce' )
			)
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

		get_product_search_form();

		$this->widget_end( $args );
	}
}
