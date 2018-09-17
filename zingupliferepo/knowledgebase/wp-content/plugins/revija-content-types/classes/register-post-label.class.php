<?php

if (!class_exists('MAD_POST')) {

	class MAD_POST extends MAD_CONTENT_TYPES {

		public $slug = 'post';

		function __construct() {
			$this->init();
		}

		public function init() {

			register_taxonomy("label", array($this->slug), array(
				"hierarchical" => true,
				"labels" => $this->getTaxonomyLabels(
					__('Label', 'mad_app_textdomain'),
					__('Label', 'mad_app_textdomain')
				),
				"singular_label" => __("label", 'mad_app_textdomain'),
				"show_tagcloud" => true,
				'query_var' => true,
				'rewrite' => true,
				'show_in_nav_menus' => false,
				'capabilities' => array('manage_terms'),
				'show_ui' => true
			));
			
			
			register_taxonomy("label_theme", array($this->slug), array(
				"hierarchical" => true,
				"labels" => $this->getTaxonomyLabels(
					__('Label theme', 'mad_app_textdomain'),
					__('Label theme', 'mad_app_textdomain')
				),
				"singular_label" => __("label_theme", 'mad_app_textdomain'),
				"show_tagcloud" => true,
				'query_var' => true,
				'rewrite' => true,
				'show_in_nav_menus' => false,
				'capabilities' => array('manage_terms'),
				'show_ui' => true
			));

				if (is_admin() && class_exists('Tax_Meta_Class') ){
				  /* 
				   * prefix of meta keys, optional
				   */
				  $prefix = 'ba_';
				  /* 
				   * configure your meta box
				   */
				  $config = array(
					'id' => 'demo_meta_box',          // meta box id, unique per meta box
					'title' => 'Demo Meta Box',          // meta box title
					'pages' => array('label'),        // taxonomy name, accept categories, post_tag and custom taxonomies
					'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
					'fields' => array(),            // list of meta fields (can be added by field arrays)
					'local_images' => true,          // Use local or hosted images (meta box images for add/remove)
					'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
				  );
				  
				  
				  /*
				   * Initiate your meta box
				   */
				  $my_meta =  new Tax_Meta_Class($config);
				  
				  /*
				   * Add fields to your meta box
				   */
				  

				  //Color field
				  $my_meta->addColor($prefix.'color_field_id',array('name'=> __('Label Color ','tax-meta')));
				 
				   /*
				   * Don't Forget to Close up the meta box decleration
				   */
				  //Finish Meta Box Decleration
				  $my_meta->Finish();
				}

	
		}
	}
}
