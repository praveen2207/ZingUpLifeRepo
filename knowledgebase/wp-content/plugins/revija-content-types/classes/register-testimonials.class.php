<?php
if (!class_exists('MAD_TESTIMONIALS')) {

	class MAD_TESTIMONIALS extends MAD_CONTENT_TYPES {

		public $slug = 'testimonials';

		function __construct() {
			$this->init();
		}

		public function init() {

			$args = array(
				'labels' => $this->getLabels(
					__('Testimonial', 'mad_app_textdomain'),
					__('Testimonials', 'mad_app_textdomain')
				),
				'public' => true,
				'archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => true,
				'menu_position' => null,
				'taxonomies' => array('testimonials_category'),
				'supports' => array('title', 'editor', 'thumbnail'),
				'rewrite' => array('slug' => $this->slug),
				'show_in_admin_bar' => true,
				'menu_icon' => 'dashicons-edit'
			);

			register_post_type($this->slug, $args);

			register_taxonomy('testimonials_category', $this->slug, array(
				'hierarchical' => true,
				"label" => "Categories",
				'query_var' => true,
				'rewrite' => true,
				'public' => true,
				'show_admin_column' => true
			) );

			flush_rewrite_rules(false);
		}

	}

}