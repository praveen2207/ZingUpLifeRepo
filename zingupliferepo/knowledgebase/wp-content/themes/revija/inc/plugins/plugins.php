<?php

$mad_include_plugins = array(
	'woocommerce-products-filter'
);

foreach ($mad_include_plugins as $inc) {
	include_once REVIJA_INC_PLUGINS_PATH . trailingslashit($inc) . 'init' . '.php';
}
