<?php

function mad_filter_constructor() {

	global $woocommerce;
	if ( ! isset( $woocommerce ) ) { return; }

	define('WOOF_PATH', trailingslashit(REVIJA_BASE_PATH . 'inc/plugins/woocommerce-products-filter'));
	define('WOOF_LINK', trailingslashit(REVIJA_BASE_URI . 'inc/plugins/woocommerce-products-filter'));
	define('WOOF_PLUGIN_NAME', 'revija');

	require_once( 'class.woof.php' );
	require_once( 'widgets/class.woocommerce-filter.php' );

	// Let's start the game!
	global $WOOF;
	$WOOF = new REVIJA_WOOF();
}

mad_filter_constructor();

