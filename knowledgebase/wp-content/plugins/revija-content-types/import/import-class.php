<?php

if (!class_exists('mad_wp_import')) {

	class mad_wp_import extends WP_Import {

		function save_settings($option_file) {

			if ($option_file) @include_once($option_file);
			if (!isset($options)) { return false; }

			$options = unserialize(base64_decode($options));

			global $revija_global_data;

			if (is_array($options)) {
				foreach($revija_global_data->option_pages as $page) {
					$database_option[$page['parent']] = $this->import_values($options[$page['parent']]);
				}
			}

			if (!empty($database_option)) {
				update_option($revija_global_data->option_prefix, $database_option);
			}

			if (!empty($widget_settings)) {
				$widget_settings = unserialize(base64_decode($widget_settings));
				if (!empty($widget_settings)) {
					foreach($widget_settings as $key => $setting) {
						update_option( $key, $setting );
					}
				}
			}

			if (!empty($sidebar_settings)) {
				$sidebar_settings = unserialize(base64_decode($sidebar_settings));
				if (!empty($sidebar_settings) && is_array($sidebar_settings)) {
					update_option('mad_sidebars', $sidebar_settings );
				}
			}

			if (!empty($woof_settings)) {
				$woof_settings = unserialize(base64_decode($woof_settings));
				if (!empty($woof_settings)) {
					update_option('woof_settings', $woof_settings);
				}
			}

			$this->twitter_api_config();
			$this->social_api_config();

			update_option('page_on_front', 15);
			
			update_option('wc_nb_newness', 1000);
			
			update_option('open-weather-key', '913471562b45d276283d7b95259557b5');
			
			$homepage = get_page_by_title( 'Home1' );
			if ( $homepage->ID ) {
				update_option('show_on_front', 'page');
				update_option( 'page_on_front', $homepage->ID );
			}
			
			
		}

		public function importSliders($path) {

			if (class_exists('RevSlider')) {

				$rev_path = $path . '/revslider'; $result = array();

				$handler = opendir($rev_path);
				if ($handler) {
					while ($file = readdir($handler)) {
						if ($file != "." AND $file != "..") {
							$result[] = $file;
						}
					}
				}
				closedir($handler);

				if (!empty($result)) {
					foreach ($result as $zip_path) {
						$slider = new RevSlider();
						$slider->importSliderFromPost(true, true, trailingslashit($rev_path) . $zip_path);
					}
				}

			

			}
		}

		public function twitter_api_config() {
			$conf = array (
				'consumer_key' => '9JH7de9na8JnUjSADwpG0fJ65',
				'consumer_secret' => 'uamiAj41b46Razt38TJVgGKzBOIwOl07Pn8W53296uvReVni9N',
				'request_secret' => '',
				'access_key' => '308471286-eKRNX77anFKPKxUWbX0wRAT95GWgjnaGko5YGBpM',
				'access_secret' => 'VtRgip39ajULJ9R5oIiclxsG9Pu3F38kz3PLHeGM4fbRp'
			);

			foreach( $conf as $key => $val ) {
				update_option( 'twitter_api_' . $key, $val );
			}
		}

		
		
		public function social_api_config() {
			$defaults = array();
            $defaults['sfcounter'] = array();

            $defaults['sfcounter']['facebook']['id'] = 'fanfbmltemplates';
            $defaults['sfcounter']['facebook']['account_type'] = 'followers';
            $defaults['sfcounter']['facebook']['access_token'] = '156';
            $defaults['sfcounter']['facebook']['followers_count'] = '156';
            $defaults['sfcounter']['facebook']['text'] = __( 'Fans' , 'sfcounter' );
            $defaults['sfcounter']['facebook']['hover_text'] = __( 'Like' , 'sfcounter' );
            //$defaults['sfcounter']['facebook']['expire'] = 0;
            $defaults['sfcounter']['facebook']['enabled'] = 1;
           // $defaults['sfcounter']['facebook']['order'] = $index++;

            $defaults['sfcounter']['twitter']['consumer_key'] = '9JH7de9na8JnUjSADwpG0fJ65';
            $defaults['sfcounter']['twitter']['consumer_secret'] = 'uamiAj41b46Razt38TJVgGKzBOIwOl07Pn8W53296uvReVni9N';
            $defaults['sfcounter']['twitter']['access_token'] = '308471286-eKRNX77anFKPKxUWbX0wRAT95GWgjnaGko5YGBpM';
            $defaults['sfcounter']['twitter']['access_token_secret'] = 'VtRgip39ajULJ9R5oIiclxsG9Pu3F38kz3PLHeGM4fbRp';
            $defaults['sfcounter']['twitter']['id'] = 'fanfbmltemplate';
            $defaults['sfcounter']['twitter']['text'] = __( 'Followers' , 'sfcounter' );
            $defaults['sfcounter']['twitter']['hover_text'] = __( 'Follow' , 'sfcounter' );
            //$defaults['sfcounter']['twitter']['expire'] = 0;
            $defaults['sfcounter']['twitter']['enabled'] = 1;
           // $defaults['sfcounter']['twitter']['order'] = $index++;
			
			$defaults['sfcounter']['vimeo']['id'] = '61316';
            $defaults['sfcounter']['vimeo']['account_type'] = 'channel';
            $defaults['sfcounter']['vimeo']['access_token'] = '';
            $defaults['sfcounter']['vimeo']['text'] = __( 'Subscribers' , 'sfcounter' );
            $defaults['sfcounter']['vimeo']['hover_text'] = __( 'Subscribe' , 'sfcounter' );
            //$defaults['sfcounter']['vimeo']['expire'] = 0;
            $defaults['sfcounter']['vimeo']['enabled'] = 1;
          //  $defaults['sfcounter']['vimeo']['order'] = $index++;
			
			$defaults['sfcounter']['envato']['id'] = 'mad_velikorodnov';
            $defaults['sfcounter']['envato']['site'] = 'themeforest';
            $defaults['sfcounter']['envato']['ref'] = 'http://themeforest.net/user/mad_velikorodnov/portfolio';
            $defaults['sfcounter']['envato']['text'] = __( 'Followers' , 'sfcounter' );
            $defaults['sfcounter']['envato']['hover_text'] = __( 'Follow' , 'sfcounter' );
            //$defaults['sfcounter']['envato']['expire'] = 0;
            $defaults['sfcounter']['envato']['enabled'] = 1;
           // $defaults['sfcounter']['envato']['order'] = $index++;
			
			$defaults['sfcounter']['youtube']['key'] = 'AIzaSyAM4TdMKHFfvmpsZrrA_DYiCXMZ1BZgcJs';
            $defaults['sfcounter']['youtube']['id'] = 'UCHLY0iBPh03oLba9Hc0ABMg';
            $defaults['sfcounter']['youtube']['text'] = __( 'Subscribers' , 'sfcounter' );
            $defaults['sfcounter']['youtube']['hover_text'] = __( 'Subscribe' , 'sfcounter' );
            $defaults['sfcounter']['youtube']['account_type'] = 'channel';
            //$defaults['sfcounter']['youtube']['expire'] = 0;
            $defaults['sfcounter']['youtube']['enabled'] = 1;
           // $defaults['sfcounter']['youtube']['order'] = $index++;

            $defaults['sfcounter']['vk']['id'] = '36520952';
            $defaults['sfcounter']['vk']['text'] = __( 'Followers' , 'sfcounter' );
            $defaults['sfcounter']['vk']['hover_text'] = __( 'Follow' , 'sfcounter' );
           // $defaults['sfcounter']['vk']['expire'] = 0;
            $defaults['sfcounter']['vk']['enabled'] = 1;
           // $defaults['sfcounter']['vk']['order'] = $index++;
			
			 update_option( 'sfcounter_plugin_setting' , serialize( $defaults ) );
		}
		
		
		
		
		
		
		public function import_values($elements) {

			$values = array();

			foreach ($elements as $element) {
				if (isset($element['id'])) {

					if (!isset($element['std'])) $element['std'] = "";

					if ($element['type'] == 'select' && !is_array($element['options'])) {
						$values[$element['id']] = $this->getSelectValues($element['options'], $element['std']);
					} else {
						$values[$element['id']] = $element['std'];
					}
				}
			}

			return $values;
		}

		public function getSelectValues($type, $name) {
			switch ($type) {
				case 'page':
				case 'post':
					$post_page = get_page_by_title($name, 'OBJECT', $type);
					if (isset($post_page->ID)) {
						return $post_page->ID;
					}
					break;
				case 'range':
					return $name;
					break;
			}
		}

		public function menu_install() {

			$get_menus = wp_get_nav_menus();

			if (!empty($get_menus)) {
				$nav_needle = array('primary' => 'Primary Menu');
				$nav_needle2 = array('top' => 'Top Menu');
				$nav_needle3 = array('bottom' => 'Bottom Menu' );
				foreach ($get_menus as $menu) {
					if (is_object($menu) && in_array($menu->name, $nav_needle) ) {
						$key = array_search($menu->name, $nav_needle);
						if ($key) {
							$locations[$key] = $menu->term_id;
						}
					}
	
					
					if (is_object($menu) && in_array($menu->name, $nav_needle2) ) {
						$key = array_search($menu->name, $nav_needle2);
						if ($key) {
							$locations[$key] = $menu->term_id;
						}
					}

					if (is_object($menu) && in_array($menu->name, $nav_needle3) ) {
						$key = array_search($menu->name, $nav_needle3);
						if ($key) {
							$locations[$key] = $menu->term_id;
						}
					}		
	
	
				}
			}

			set_theme_mod( 'nav_menu_locations', $locations );

			//$this->mad_mega_menu_options_backup();
		}

		public function mad_mega_menu_options_backup($path) {
			global $mega_main_menu;
			$file = $path . '/mega-main-menu-backup.txt';
			$backup_file_content = mm_common::get_url_content( $file );

			if ( $backup_file_content !== false && ( $options_backup = json_decode( $backup_file_content, true ) ) ) {
				if ( isset( $options_backup['last_modified'] ) ) {
					$options_backup['last_modified'] = time() + 30;
					update_option( $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ], $options_backup );
				}
			}
		}
		

	}

}