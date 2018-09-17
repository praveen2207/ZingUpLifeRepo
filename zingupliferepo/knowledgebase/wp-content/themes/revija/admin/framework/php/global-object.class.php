<?php

if (!class_exists('REVIJA_GLOBAL_OBJECT')) {

	class REVIJA_GLOBAL_OBJECT extends REVIJA_FRAMEWORK {

		public $theme_data;
		public $option_pages = array();
		public $option_page_data = array();
		public $sub_pages = array();
		public $options;
		public $option_prefix = 'mad_options_';

		public function __construct($data) {
			$this->theme_data = $data;
			$this->create_options();

			new REVIJA_DYNAMIC_STYLES();
			new REVIJA_ADMIN_PAGES($this);

			if (class_exists('REVIJA_WP_THEME_SETTINGS_EXPORT')) {
				if (is_admin()) {
					new REVIJA_WP_THEME_SETTINGS_EXPORT($this);
				}
			}

			new REVIJA_SIDEBAR($this->options);
		}

		protected function create_options() {

			include( REVIJA_FRAMEWORK::$path['configPath'] . 'register-theme-options.php' );

			if (isset($mad_pages)) {
				$this->option_pages = $mad_pages;
			}

			if (isset($mad_elements)) {
				$this->option_page_data = $mad_elements;
			}

			foreach($this->option_pages as $page) {
				$this->sub_pages[$page['parent']][] = $page['slug'];
			}

			$option_database = get_option($this->option_prefix);

			foreach ($mad_pages as $page) {
				if (!isset($option_database[$page['parent']]) || $option_database[$page['parent']] == "") {
					$option_database[$page['parent']] = $this->default_value($this->option_page_data, $page, $this->sub_pages);
				}
			}

//			mad_print_r($option_database);
			$this->options = $option_database;
		}

		public function default_value($elements, $page, $subpages) {
			$vals = array();

			foreach ($elements as $element) {
				if (in_array($element['slug'], $subpages[$page['parent']])) {
					if (!isset($element['std'])) {
						$element['std'] = "";
					}

					if (!isset($element['id'])) continue;

					$vals[$element['id']] = htmlentities($element['std'], ENT_QUOTES);
				}
			}
			return $vals;
		}

		public function reset_options() {
			unset($this->option_pages, $this->option_page_data, $this->subpages, $this->options);
			$this->create_options();
		}

	}

}
