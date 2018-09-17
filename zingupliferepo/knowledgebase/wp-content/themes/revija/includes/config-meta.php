<?php

if (!class_exists('REVIJA_META')) {

	class REVIJA_META {

		function __construct() {
			add_action('init', array(&$this, 'init') );
		}

		public function init() {
			add_filter('rwmb_meta_boxes', array(&$this, 'meta_boxes_array'));
		}

		public function meta_boxes_array($mad_meta_boxes) {

			/*	Meta Box Definitions
			/* ---------------------------------------------------------------------- */

			$mad_prefix = 'mad_';

			
			
			/*	Post Advertising
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'post-advertising-settings',
				'title'    => esc_html__('Post Settings', 'revija'),
				'pages'    => array('post'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(

					array(
						'name' => esc_html__('Advertising code', 'revija'),
						'id'   => $mad_prefix . 'advertising_url',
						'type' => 'textarea',
						'std'  => '',
						'desc' => esc_html__('(optional)', 'revija')
					),
					array(
						'name' => esc_html__('Extended Featured Image', 'revija'),
						'id'   => $mad_prefix . 'extended_featured',
						'type' => 'checkbox',
						'std'  => '0',
						'desc' => esc_html__('Boolean: Extended Featured Image', 'revija')
					)	
				)
			);


			/*	Portfolio Advertising
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'portfolio-advertising-settings',
				'title'    => esc_html__('Advertising Settings', 'revija'),
				'pages'    => array('portfolio'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__('Advertising code', 'revija'),
						'id'   => $mad_prefix . 'advertising_url_p',
						'type' => 'textarea',
						'std'  => '',
						'desc' => esc_html__('(optional)', 'revija')
					)
				)
			);



			/*	Layout Settings
			/* ---------------------------------------------------------------------- */

			$mad_pages = get_pages('title_li=&orderby=name');
			$mad_list_pages = array('' => 'None');
			foreach ($mad_pages as $key => $entry) {
				$mad_list_pages[$entry->ID] = $entry->post_title;
			}

			$mad_list_menus = array('' => 'Default');
			$mad_menu_terms = get_terms('nav_menu');
			if ( !empty( $mad_menu_terms ) ) {
				foreach ($mad_menu_terms as $term) {
					$mad_list_menus[$term->term_id] = $term->name;
				}
			}

			
			
			
			$mad_registered_sidebars = REVIJA_HELPER::get_registered_sidebars(array("" => 'Default Sidebar'), array('General Widget Area'));
			$mad_registered_custom_sidebars = array();

			foreach($mad_registered_sidebars as $key => $value) {
				if (strpos($key, 'Footer Row') === false) {
					$mad_registered_custom_sidebars[$key] = $value;
				}
			}

			
			
			
			
			
			
			
			$mad_meta_boxes[] = array(
				'id'       => 'layout-settings',
				'title'    => esc_html__('Layout', 'revija'),
				'pages'    => array('post', 'page', 'portfolio', 'product', 'testimonials', 'team-members'),
				'context'  => 'side',
				'priority' => 'default',
				'fields'   => array(
					array(
						'name'    => esc_html__('Header Layout', 'revija'),
						'id'      => $mad_prefix . 'header_layout',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Choose header layout', 'revija'),
						'options' => array(
							'' => esc_html__('Default', 'revija'),
							'header-main' => esc_html__('Header 1', 'revija'),
							'header_2' => esc_html__('Header 2', 'revija'),
							'header_3' => esc_html__('Header 3', 'revija'),
							'header_4' => esc_html__('Header 4', 'revija'),
							'header_5' => esc_html__('Header 5', 'revija'),
							'header_6' => esc_html__('Header 6', 'revija')
						)
					),
					array(
						'name'    => esc_html__('Header Sidebar', 'revija'),
						'id'      => $mad_prefix . 'page_sidebar_header',
						'class'    => 'custom_sidebar_header',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Choose a header sidebar', 'revija'),
						'options' => $mad_registered_custom_sidebars
					),
					array(
						'name'    => esc_html__('Page Title', 'revija'),
						'id'      => $mad_prefix . 'page_title',
						'type'    => 'checkbox',
						'std'     => '0',
						'desc'    => esc_html__('Boolean: Hide page title', 'revija'),
					),
					array(
						'name'    => esc_html__('Navigation Menu', 'revija'),
						'id'      => $mad_prefix . 'nav_menu',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Choose navigation menu', 'revija'),
						'options' => $mad_list_menus
					),
					array(
						'name'    => esc_html__('After Header Content', 'revija'),
						'id'      => $mad_prefix . 'header_after',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Display content after the header', 'revija'),
						'options' => $mad_list_pages
					),
					array(
						'name'    => esc_html__('Sidebar Position', 'revija'),
						'id'      => $mad_prefix . 'page_sidebar_position',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Choose page sidebar position', 'revija'),
						'options' => array(
							'' => esc_html__('Default Sidebar Position', 'revija'),
							'no_sidebar' => esc_html__('No Sidebar', 'revija'),
							'sbl' => esc_html__('Left Sidebar', 'revija'),
							'sbr' => esc_html__('Right Sidebar', 'revija')
						)
					),
					array(
						'name'    => esc_html__('Sidebar Setting', 'revija'),
						'id'      => $mad_prefix . 'page_sidebar',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Choose a custom sidebar', 'revija'),
						'options' => $mad_registered_custom_sidebars
					),
					array(
						'name'    => esc_html__('Breadcrumb Navigation', 'revija'),
						'id'      => $mad_prefix . 'breadcrumb',
						'type'    => 'select',
						'std'     => 'breadcrumb',
						'desc'    => esc_html__('Display the Breadcrumb Navigation?', 'revija'),
						'options' => array(
							'breadcrumb' => esc_html__('Display breadcrumbs', 'revija'),
							'hide' => esc_html__('Hide', 'revija')
						)
					),
					array(
						'name'    => '',
						'id'      => $mad_prefix . 'page_layout',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Choose page layout style', 'revija'),
						'options' => array(
							'' => esc_html__('Default Layout', 'revija'),
							'boxed_layout' => esc_html__('Boxed Layout', 'revija'),
							'wide_layout' => esc_html__('Wide Layout', 'revija')
						)
					)
				)
			);

			/*	Body Background
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'body-background',
				'title'    => esc_html__('Body Background', 'revija'),
				'pages'    => array('page'),
				'context'  => 'side',
				'priority' => 'default',
				'fields'   => array(
					array(
						'name'    => esc_html__('Background color', 'revija'),
						'id'      => $mad_prefix . 'bg_color',
						'type'    => 'color',
						'std'     => '',
						'desc'    => esc_html__('Select the background color of the body', 'revija')
					),
					array(
						'name'    => esc_html__('Background image', 'revija'),
						'id'      => $mad_prefix . 'bg_image',
						'type'    => 'thickbox_image',
						'std'     => '',
						'desc'    => esc_html__('Select the background image', 'revija')
					),
					array(
						'name'    => esc_html__('Background repeat', 'revija'),
						'id'      => $mad_prefix . 'bg_image_repeat',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Select the repeat mode for the background image', 'revija'),
						'options' => array(
							'' => esc_html__('Default', 'revija'),
							'repeat' => esc_html__('Repeat', 'revija'),
							'no-repeat' => esc_html__('No Repeat', 'revija'),
							'repeat-x' => esc_html__('Repeat Horizontally', 'revija'),
							'repeat-y' => esc_html__('Repeat Vertically', 'revija')
						)
					),
					array(
						'name'    => esc_html__('Background position', 'revija'),
						'id'      => $mad_prefix . 'bg_image_position',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Select the position for the background image', 'revija'),
						'options' => array(
							'' => esc_html__('Default', 'revija'),
							'top left' => esc_html__('Top left', 'revija'),
							'top center' => esc_html__('Top center', 'revija'),
							'top right' => esc_html__('Top right', 'revija'),
							'bottom left' => esc_html__('Bottom left', 'revija'),
							'bottom center' => esc_html__('Bottom center', 'revija'),
							'bottom right' => esc_html__('Bottom right', 'revija')
						)
					),
					array(
						'name'    => esc_html__('Background attachment', 'revija'),
						'id'      => $mad_prefix . 'bg_image_attachment',
						'type'    => 'select',
						'std'     => '',
						'desc'    => esc_html__('Select the attachment for the background image ', 'revija'),
						'options' => array(
							'' => esc_html__('Default', 'revija'),
							'scroll' => esc_html__('Scroll', 'revija'),
							'fixed' => esc_html__('Fixed', 'revija')
						)
					),
				)
			);

			
			/*	Testimonials Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'testimonials-settings',
				'title'    => esc_html__('Testimonials Settings', 'revija'),
				'pages'    => array('testimonials'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__('Place', 'revija'),
						'id'   => $mad_prefix . 'tm_place',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					)
				)
			);

			
			/*	Blockquotes Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'blockquotes-settings',
				'title'    => esc_html__('Blockquotes Settings', 'revija'),
				'pages'    => array('blockquotes'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__('Place', 'revija'),
						'id'   => $mad_prefix . 'tm_place',
						'type' => 'text',
						'std'  => '',
						'desc' => ''
					)
				)
			);
			
			
			/*	Portfolio Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'portfolio-settings',
				'title'    => esc_html__('Portfolio Slider Settings', 'revija'),
				'pages'    => array('portfolio'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__('Portfolio Slider Images', 'revija'),
						'id'   => $mad_prefix . 'portfolio_images',
						'type' => 'image_advanced',
						'std'  => '',
						'desc' => esc_html__('Upload portfolio single images come here', 'revija')
					),
					array(
						'name' => esc_html__('Slideshow', 'revija'),
						'id'   => $mad_prefix . 'flex_slideshow',
						'type' => 'checkbox',
						'std'  => '1',
						'desc' => esc_html__('Boolean: Animate slider automatically', 'revija')
					),
					array(
						'name' => esc_html__('Slideshow speed', 'revija'),
						'id'   => $mad_prefix . 'flex_slideshow_speed',
						'type' => 'number',
						'std'  => 5000,
						'step' => 10,
						'desc' => esc_html__('Integer: Set the speed of the slideshow cycling, in milliseconds', 'revija')
					)
				)
			);

			/*	Portfolio Video Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'portfolio-settings-video',
				'title'    => esc_html__('Portfolio Video Slider Settings', 'revija'),
				'pages'    => array('portfolio'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__('Portfolio Video Url', 'revija'),
						'id'   => $mad_prefix . 'portfolio_video_url',
						'type' => 'textarea',
						'std'  => '',
						'desc' => sprintf( esc_html__( 'Enter url for each video here. Divide url with linebreaks (Enter).Link to the video. More about supported formats at %s.', 'revija' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' )
					),
					array(
						'name' => esc_html__('Portfolio Video Title', 'revija'),
						'id'   => $mad_prefix . 'portfolio_video_title',
						'type' => 'textarea',
						'std'  => '',
						'desc' => esc_html__('Enter title for each video here. Divide title with linebreaks (Enter)', 'revija')
					)
				)
			);

			
			

			/*	Portfolio Format Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id'       => 'format-settings',
				'title'    => esc_html__('Format Settings', 'revija'),
				'pages'    => array('portfolio'),
				'context'  => 'side',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name'    => esc_html__('Format', 'revija'),
						'id'      => $mad_prefix . 'portfolio_format_icon',
						'type'    => 'select',
						'options' => array(
							'standard' => esc_html__('Standard', 'revija'),
							'gallery' => esc_html__('Gallery', 'revija'),
							'image' => esc_html__('Image', 'revija'),
							'video' => esc_html__('Video', 'revija'),
							'audio' => esc_html__('Audio', 'revija')
						),
						'std'     => 'standard',
						'desc'    => esc_html__('Choose format for portfolio', 'revija')
					),
				)
			);
						
			
			
			
			
			/*	Product Settings
			/* ---------------------------------------------------------------------- */

			$mad_meta_boxes[] = array(
				'id' => $mad_prefix . 'product_custom_meta_box',
				'title' => esc_html__('Custom Tab Options', 'revija'),
				'pages' => array('product'),
				'context' => 'normal',
				'priority' => 'high',
				'fields' => array(
					array(
						'name' => '',
						'id' => $mad_prefix . 'title_product_tab',
						'type' => 'text',
						'desc' => esc_html__('Title Custom Tab',  'revija'),
						'std' => '',
					),
					array(
						'name' => '',
						'id' => $mad_prefix . 'content_product_tab',
						'desc' => esc_html__('Content Custom Tab',  'revija'),
						'std' => '',
						'type' => 'wysiwyg'
					)
				)
			);
			
			
			
			
			
			
			

			return $mad_meta_boxes;
		}

	}

	new REVIJA_META;
}