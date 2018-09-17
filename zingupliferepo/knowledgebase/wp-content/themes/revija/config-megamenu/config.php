<?php

if (!class_exists('REVIJA_CONFIG_MEGAMENU')) {

	class REVIJA_CONFIG_MEGAMENU {

		public $paths = array();

		protected function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {

			if (!is_admin()) {

				$this->paths = array(
					'APP_ROOT' => REVIJA_BASE_URI . trailingslashit('config-megamenu'),
					'APP_DIR' => REVIJA_BASE_URI . trailingslashit('config-megamenu'),
					'BASE_URI' => REVIJA_BASE_URI . trailingslashit('config-megamenu'),
					'ASSETS_DIR_NAME' => 'assets'
				);

				$this->add_hooks();

			}

		}

		public function add_hooks() {

			add_action('wp_enqueue_scripts', array(&$this, 'front_init'), 1);

		}

		public function front_init() {
			$this->register_css();
		}

		public function register_css() {
			$front_css_file = $this->assetUrl('css/frontend-megamenu.css');
			wp_register_style( REVIJA_PREFIX . 'frontend_megamenu', $front_css_file, array('mmm_mega_main_menu') );
			wp_enqueue_style( REVIJA_PREFIX . 'frontend_megamenu' );
		}

	}

	new REVIJA_CONFIG_MEGAMENU();
}