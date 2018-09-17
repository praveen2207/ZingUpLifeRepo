<?php

if (!function_exists('mad_ajax_reset_options')) {

	function mad_ajax_reset_options() {

		if (function_exists('check_ajax_referer')) {
			check_ajax_referer('ajax_reset_options');
		}

		global $revija_global_data;
		delete_option($revija_global_data->option_prefix);
		wp_die('reset');
	}

	add_action('wp_ajax_ajax_reset_options', 'mad_ajax_reset_options');
}

/*  Ajax Import Data Hook
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_prepare_save_options_array')) {

	function mad_prepare_save_options_array($data) {
		$result = array();

		foreach ($data as $option) {
			$option = explode("=", $option);
			$option[1] = htmlentities(urldecode(stripslashes($option[1])), ENT_COMPAT, get_bloginfo('charset'));
			if ($option[0] != "" && $option[0] != 'undefined') {
				$result[$option[0]] = $option[1];
			}
		}
		return $result;
	}
}

if (!function_exists('mad_ajax_save_options_page')) {

	function mad_ajax_save_options_page() {

		if (function_exists('check_ajax_referer')) {
			check_ajax_referer('ajax_save_options_page');
		}

		if (!isset($_REQUEST['data']) || !isset($_REQUEST['slug']) || !isset($_REQUEST['prefix'])) { return; }

		$data = explode("&", $_REQUEST['data']);

		$prefix = $_REQUEST['prefix'];
		$options = get_option($prefix);
		$save = mad_prepare_save_options_array($data);
		$options[$_REQUEST['slug']] = $save;

		update_option($prefix, $options);
		do_action('revija_ajax_after_save_options_page', $options);

		wp_die('save');
	}
	add_action('wp_ajax_ajax_save_options_page', 'mad_ajax_save_options_page');
}

/*  Ajax Import Data Hook
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_ajax_import_options_page')) {

	function mad_ajax_import_options_page() {
		if (function_exists('check_ajax_referer')) {
			check_ajax_referer('ajax_import_options_page');
		}
		require_once('config-import-export/inc-importer.php');
		wp_die('madImport');
	}
	add_action('wp_ajax_ajax_import_options_page', 'mad_ajax_import_options_page');
}

