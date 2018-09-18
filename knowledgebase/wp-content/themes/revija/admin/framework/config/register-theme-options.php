<?php

// Include Google Webfonts
include('register-google-webfonts.php');

// Include Color Schemes
include('register-color-schemes.php');


$get_theme_font_weight = apply_filters('get_theme_font_weight', array(
	"100"=>"100",
	"200"=>"200",
	"300"=>"300",
	"400"=>"400",
	"500"=>"500",
	"600"=>"600",
	"700"=>"700",
	"800"=>"800",
	"900"=>"900"
));






/* ---------------------------------------------------------------------- */
/*	Pages Elements
/* ---------------------------------------------------------------------- */

$mad_pages = array(
	array(
		'title' =>  esc_html__('Theme Options', 'revija'),
		'slug' => 'revija',
		'class' => 'admin-icon-general',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Styling Options', 'revija'),
		'slug' => 'styling',
		'class' => 'admin-icon-styling',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Header', 'revija'),
		'slug' => 'header',
		'class' => 'admin-icon-header',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Pages', 'revija'),
		'slug' => 'page',
		'class' => 'admin-icon-header',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Sidebar', 'revija'),
		'slug' => 'sidebar',
		'class' => 'admin-icon-sidebar',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Blog', 'revija'),
		'slug' => 'blog',
		'class' => 'admin-icon-blog',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Portfolio', 'revija'),
		'slug' => 'portfolio',
		'class' => 'admin-icon-portfolio',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Testimonials', 'revija'),
		'slug' => 'testimonials',
		'class' => 'admin-icon-testimonials',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Footer', 'revija'),
		'slug' => 'footer',
		'class' => 'admin-icon-footer',
		'parent'=> 'revija',
	),
	array(
		'title' =>  esc_html__('Shop', 'revija'),
		'slug' => 'shop',
		'class' => 'admin-icon-shop',
		'parent'=> 'revija',
	),
	// array(
		// 'title' =>  esc_html__('Side Tabbed Panel', 'revija'),
		// 'slug' => 'admin',
		// 'class' => 'admin-icon-admin',
		// 'parent'=> 'revija',
	// ),
	array(
		'title' =>  esc_html__('Import / Export', 'revija'),
		'slug' => 'import',
		'class' => 'admin-icon-import',
		'parent'=> 'revija',
	)
);

/* ---------------------------------------------------------------------- */
/*	General Elements
/* ---------------------------------------------------------------------- */

 // $mad_elements[] = array(
	 // "slug"	=> "revija",
	 // "type" 	=> "hidden",
	 // "id" 	=> "favicon_upload",
	 // "desc" 	=> '',
	 // "std" => '1961',
	 // "dependence" => 'favicon'
 // );
$mad_elements[] = array(
	"name" 	=> esc_html__('Favicon', 'revija'),
	"slug"	=> "revija",
	"type" 	=> "upload",
	"data" 	=> array(
		'title' => esc_html__('Upload Favicon', 'revija'),
		'text' => esc_html__('Upload', 'revija')
	),
	"id" 	=> "favicon_upload",
	"desc" 	=> esc_html__('Display site icon meta tags.', 'revija'),
	"std" => REVIJA_BASE_URI . 'images/fav_icon.png'
);


	/* ---------------------------------------------------------------------- */
	/*	Logo
	/* ---------------------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Logo Settings", "revija"),
		"slug"	=> "revija",
		"type" 	=> "heading",
		"desc" 	=> ""
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Type Logo", "revija"),
		"slug"	=> "revija",
		"type" 	=> "select",
		"id" 	=> "logo_type",
		"options" => array(
			'text' => esc_html__('Text Logo', 'revija'),
			'upload' => esc_html__('Upload Logo', 'revija')
		),
		"desc" 	=> esc_html__('Choose type logo text or image', 'revija'),
		"std"	=> 'text'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Text Logo", "revija"),
		"slug"	=> "revija",
		"type" 	=> "editor",
		"id" 	=> "logo_text",
		"desc" 	=> esc_html__("If you don't have logo image, write Your Text logo. </br> All Logo text settings you can find in Styling Options Section", "revija"),
		"required" => array("logo_type", 'text'),
		"std"	=> 'Revija'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Upload Logo", "revija"),
		"slug"	=> "revija",
		"type" 	=> "upload",
		"id" 	=> "logo_image",
		"desc" 	=> esc_html__("Upload your logo image. Your logo image width must be no more that 166px", "revija"),
		"required" => array("logo_type", 'upload'),
		"std"   => REVIJA_BASE_URI . 'images/logo_main.png'
	);


	/* --------------------------------------------------------- */
	/* Mailchimp Api Settings
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Mailchimp Api Settings", "revija"),
		"slug"	=> "revija",
		"type" 	=> "heading",
		"desc" 	=> " "
	);

	$mad_elements[] =	array(
		"name" 	=> esc_html__("Enter your Mailchimp Api", "revija"),
		"slug"	=> "revija",
		"type" 	=> "text",
		"id" 	=> "mad_mailchimp_api",
		"std"   => "",
		"desc" 	=> wp_kses(__("Please enter your MailChimp API Key. The API Key allows your WordPress site to communicate with your MailChimp account. For help, visit the MailChimp Support article : <a target='_blank' href='http://kb.mailchimp.com/article/where-can-i-find-my-api-key'>Where can I find my API Key?</a>", 'revija'), array('a' => array('href' => array(), 'target' => array())))
	);

	$mad_elements[] =	array(
		"name" 	=> esc_html__("Enter your Mailchimp Id", "revija"),
		"slug"	=> "revija",
		"type" 	=> "text",
		"id" 	=> "mad_mailchimp_id",
		"std"   => "",
		"desc" 	=> wp_kses(__("<a target='_blank' href='http://kb.mailchimp.com/article/how-can-i-find-my-list-id'>Where can I find List ID?</a>", 'revija'), array('a' => array('href' => array(), 'target' => array())))
	);

	$mad_elements[] =	array(
		"name" 	=> esc_html__("Enter your Mailchimp data center(e.g. us4)", "revija"),
		"slug"	=> "revija",
		"type" 	=> "text",
		"id" 	=> "mad_mailchimp_center",
		"desc" 	=> ' ',
		"std" => ''
	);

	/* --------------------------------------------------------- */
	/* Analytics Tracking Code
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Google Analytics Tracking Code", "revija"),
		"slug"	=> "revija",
		"type" 	=> "textarea",
		"id" 	=> "analytics",
		"desc" 	=> esc_html__("Enter your Google analytics tracking code here. </br> Tracking ID UA - .......", "revija"),
	);

	
	

	/* --------------------------------------------------------- */
	/* Cookie Alert Settings
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Cookie Alert Settings", "revija"),
		"slug"	=> "revija",
		"type" 	=> "heading",
		"desc" 	=> ' '
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Show Cookie Alert?", "revija"),
		"slug"	=> "revija",
		"type" 	=> "select",
		"id" 	=> "cookie_alert",
		"options" => array(
			'show'  => esc_html__('Show', 'revija'),
			'hide' => esc_html__('Hide', 'revija')
		),
		"std" => 'hide',
		"desc" 	=> esc_html__("Show or hide cookie alert", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Cookie Alert Message", "revija"),
		"slug"	=> "revija",
		"type" 	=> "textarea",
		"id" 	=> "cookie_alert_message",
		"desc" 	=> esc_html__("Message for cookie alert", "revija"),
		"std"   => esc_html__("Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.", "revija")
	);

	$mad_elements[] =	array(
		"name" 	=> esc_html__("Button Read More Link", "revija"),
		"slug"	=> "revija",
		"type" 	=> "text",
		"id" 	=> "cookie_alert_read_more_link",
		"desc" 	=> esc_html__("Input link for button read more", "revija"),
		"std" => 'http://www.cookielaw.org/the-cookie-law'
	);

	
	/* --------------------------------------------------------- */
	/* 404 Page Options
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("404 Page Options", "revija"),
		"slug"	=> "revija",
		"type" 	=> "heading",
		"desc" 	=> ' '
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("404 Content", "revija"),
		"slug"	=> "revija",
		"type" 	=> "editor",
		"rows"  => 10,
		"id" 	=> "440_content",
		"std"   => "<h2  class='title_404'>404</h2><h2 class='section_title section_title_big'> ". esc_html__('Page not found!', 'revija') . "</h2><p>" . esc_html__('We\'re sorry, but we can\'t find the page you were looking for. It\'s probably some thing we\'ve done wrong but now we know about it and we\'ll try to fix it. In the meantime, try one of these options:', 'revija') . "</p>",
		"desc" 	=> esc_html__("Enter your text for 404 page", "revija"),
	);
	
	


	/* --------------------------------------------------------- */
	/* Other Options
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__('Other Theme Options', 'revija'),
		"slug"	=> "revija",
		"type" 	=> "heading",
		"desc" 	=> " ",
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__('Show query loader', 'revija'),
		"slug"	=> "revija",
		"type" 	=> "select",
		"id" 	=> "query-loader",
		"options" => array(
			'show'  => esc_html__('Show', 'revija'),
			'hide' => esc_html__('Hide', 'revija')
		),
		"std" => 'hide',
		"desc" 	=> esc_html__('Show query loader on pages', 'revija'),
	);

	
	$mad_elements[] = array(
		"name" 	=> esc_html__('Smooth Scroll', 'revija'),
		"slug"	=> "revija",
		"type" 	=> "select",
		"id" 	=> "smooth_scroll",
		"options" => array(
			'show' => esc_html__('Yes', 'revija'),
			'hide' => esc_html__('No', 'revija'),
		),
		"std" => 'hide',
		"desc" 	=> esc_html__('Choose yes to enable smooth scrolling in the browser chrome', 'revija'),
	);
	
	
/* ---------------------------------------------------------------------- */
/*	Styling Elements
/* ---------------------------------------------------------------------- */

	/* --------------------------------------------------------- */
	/*	Styling Tabs
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("General Styling", "revija"),
		"slug"	=> "styling",
		"type" 	=> "heading",
		"desc" 	=> esc_html__("Change the theme style settings", "revija"),
	);


	// start tab container
	$mad_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_start",
		"id" => "styling_tab_container",
		"class" => 'mad-tab-container',
		"desc" => false
	);

		// start 1 tab
		$mad_elements[] = array(
			'name'=>esc_html__('General', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_1",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] =	array(
				"name" 	=> esc_html__("General Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-general_body_bg_color",
				"std" 	=> "#e2e2e2",
				"default" 	=> "#e2e2e2",
				"desc" 	=> esc_html__("General background color", "revija"),
			);

			
			$mad_elements[] = array(
				"name" 	=> esc_html__("General Background Image", "revija"),
				"slug"	=> "styling",
				"type" 	=> "select",
				"id" 	=> "styles-bg_img",
				"options" => array(
					'' => esc_html__('No Background Image', 'revija'),
					'custom' => esc_html__('Upload Image', 'revija')
				),
				"desc" 	=> esc_html__('The background image of your Body', 'revija')
			);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Upload Background Image", "revija"),
				"slug"	=> "styling",
				"type" 	=> "upload",
				"id" 	=> "styles-body_bg_image",
				"desc" 	=> esc_html__("Upload background image of your body", "revija"),
				"required" => array("styles-bg_img", 'custom'),
				"std"   => ''
			);

			$mad_elements[] = array(
				"name" => esc_html__("Repeat", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-body_repeat",
				"options" => array(
					'no-repeat' => esc_html__('No Repeat', 'revija'),
					'repeat' => esc_html__('Repeat', 'revija'),
					'repeat-x' => esc_html__('Repeat Horizontally', 'revija'),
					'repeat-y' => esc_html__('Repeat Vertically', 'revija')
				),
				"std" => 'no-repeat',
				"required" => array("styles-bg_img", 'custom'),
				"desc" 	=> esc_html__("Select the repeat mode for the background image", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Position", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-body_position",
				"options" => array(
					'top center' => esc_html__('Top center', 'revija'),
					'top left' => esc_html__('Top left', 'revija'),
					'top right' => esc_html__('Top right', 'revija'),
					'bottom left' => esc_html__('Bottom left', 'revija'),
					'bottom center' => esc_html__('Bottom center', 'revija'),
					'bottom right' => esc_html__('Bottom right', 'revija')
				),
				"std" => 'top center',
				"required" => array("styles-bg_img", 'custom'),
				"desc" 	=> esc_html__("Select the position for the background image", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Attachment", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-body_attachment",
				"options" => array(
					'fixed' => esc_html__('Fixed', 'revija'),
					'scroll' => esc_html__('Scroll', 'revija')
				),
				"std" => 'yes',
				"required" => array("styles-bg_img", 'custom'),
				"desc" 	=> esc_html__("Select the attachment for the background image ", "revija"),
			);


			$mad_elements[] = array(
				"name" 	=> esc_html__("General Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-general_font_color",
				"std" 	=> "#696e6e",
				"default" 	=> "#696e6e",
				"desc" 	=> esc_html__("General font color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("General Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-general_font_size",
				"options" => "range",
				"range" => "12-30",
				"std" => "14px",
				"desc" => esc_html__("General font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("General Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "general_google_webfont",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("General font family", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Second Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "second_google_webfont",
				"options" => $mad_google_webfonts,
				"std" => "Droid Serif",
				"desc" => esc_html__("Second font family", "revija"),
			);
			
			
			$mad_elements[] = array(
				"name" 	=> esc_html__("Primary Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-primary_color",
				"std" 	=> "#ff680d",
				"default" 	=> "#ff680d",
				"desc" 	=> esc_html__("Key color for links and other elements", "revija"),
			);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Secondary Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-secondary_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Color for button and other", "revija"),
			);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Highlight Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-highlight_color",
				"std" 	=> "#f2f2f2",
				"default" 	=> "#f2f2f2",
				"desc" 	=> esc_html__("Color of links and elements when you hover", "revija"),
			);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Selection Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-highlight_bg_color",
				"std" 	=> "#ff680d",
				"default" 	=> "#ff680d",
				"desc" 	=> esc_html__("Highlight and selection background color", "revija"),
			);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Selection Text Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-highlight_text_color",
				"std" 	=> "#fff",
				"default" 	=> "#fff",
				"desc" 	=> esc_html__("Highlight and selection text color", "revija"),
			);

		// end 1 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 2 tab
		$mad_elements[] = array(
			'name'=>esc_html__('Header', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_2",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] =	array(
				"name" 	=> esc_html__("Cookie Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-cookie_bg_color",
				"std" 	=> "#fff",
				"default" 	=> "#fff",
				"desc" 	=> esc_html__("Cookie background color", "revija"),
			);
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Cookie Text Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-cookie_txt_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Cookie Text color", "revija"),
			);
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Text Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-header_text_color",
				"std" 	=> "#f2f2f2",
				"default" 	=> "#f2f2f2",
				"desc" 	=> esc_html__("Header text color", "revija"),
			);

			
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-header_bg_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Header background color", "revija"),
			);

			$mad_elements[] =	array(
				"name" 	=> esc_html__("Preheader Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-preheader_bg_color",
				"std" 	=> "#383e44",
				"default" 	=> "#383e44",
				"desc" 	=> esc_html__("Preheader background color", "revija"),
			);
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Top Part Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-header_top_bg_color",
				"std" 	=> "#3E454C",
				"default" 	=> "#3E454C",
				"desc" 	=> esc_html__("Header top part background color", "revija"),
			);
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Top Part Border Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-header_top_border_color",
				"std" 	=> "#3E454C",
				"default" 	=> "#3E454C",
				"desc" 	=> esc_html__("Header top part border color", "revija"),
			);
			
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Menu Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-menu_header_bg_color",
				"std" 	=> "#383e44",
				"default" 	=> "#383e44",
				"desc" 	=> esc_html__("Header menu background color", "revija"),
			);
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Menu Border Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-menu_header_border_color",
				"std" 	=> "#383e44",
				"default" 	=> "#383e44",
				"desc" 	=> esc_html__("Header menu border color", "revija"),
			);
			
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Header Search Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-search_header_bg_color",
				"std" 	=> "#383e44",
				"default" 	=> "#383e44",
				"desc" 	=> esc_html__("Header search background color", "revija"),
			);
			
		// end 2 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 3 tab
		$mad_elements[] = array(
			'name'=>esc_html__('Logo', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_3",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] =	array(
				"name" 	=> esc_html__("Logo Text Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-logo_font_color",
				"std" 	=> "#ff680d",
				"default" 	=> "#ff680d",
				"desc" 	=> esc_html__("Logo text color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Logo Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-logo_font_size",
				"options" => "range",
				"range" => "35-60",
				"std" => "45px",
				"desc" => esc_html__("Logo Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Logo Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-logo_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Logo Font Family", "revija"),
			);

		// end 3 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 4 tab
		$mad_elements[] = array(
			'name'=>esc_html__('Footer', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_4",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Text Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_text_color",
				"std" 	=> "#f2f2f2",
				"default" 	=> "#f2f2f2",
				"desc" 	=> esc_html__("Footer text color", "revija")
			);
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Link Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_link_color",
				"std" 	=> "#fff",
				"default" 	=> "#fff",
				"desc" 	=> esc_html__("Footer link color", "revija")
			);
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Top Part Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_top_part_bg_color",
				"std" 	=> "#383e44",
				"default" 	=> "#383e44",
				"desc" 	=> esc_html__("Footer top part background color", "revija")
			);
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Top Part Border Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_top_part_border_color",
				"std" 	=> "#383e44",
				"default" 	=> "#383e44",
				"desc" 	=> esc_html__("Footer top part border color", "revija")
			);
			
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Bottom Part Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_bottom_part_bg_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Footer bottom part background color", "revija")
			);
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Bottom Part Border Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_bottom_part_border_color",
				"std" 	=> "#4b5158",
				"default" 	=> "#4b5158",
				"desc" 	=> esc_html__("Footer bottom part border color", "revija")
			);
			
			
			$mad_elements[] =	array(
				"name" 	=> esc_html__("Footer Background Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_bg_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Footer background color", "revija")
			);

			

		// end 4 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

	// end tab container
	$mad_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_end",
		"desc" => false
	);

	/* --------------------------------------------------------- */
	/*	All Headings Styling
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("All Headings (H1-H6)", "revija"),
		"slug"	=> "styling",
		"type" 	=> "heading",
		"desc" 	=> esc_html__("Change All Headings style settings", "revija"),
	);

	// start tab container
	$mad_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_start",
		"id" => "headings_tab_container",
		"class" => 'mad-tab-container',
		"desc" => false
	);

		// start 1 tab
		$mad_elements[] = array(
			'name'=>esc_html__('H1', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h1_tab_1",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h1_font_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Heading Color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h1_font_size",
				"options" => "range",
				"range" => "30-40",
				"unit" => 'px',
				"std" => "36px",
				"desc" => esc_html__("Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Weight", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h1_font_weight",
				"options" => $get_theme_font_weight,
				"std" => "700",
				"desc" => esc_html__("Font Weight", "revija"),
			);
			
			
			
			$mad_elements[] = array(
				"name" => esc_html__("Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h1_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Choose Font Family", "revija"),
			);

		// end 1 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 2 tab
		$mad_elements[] = array(
			'name'=>esc_html__('H2', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h2_tab_2",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h2_font_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Heading Color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h2_font_size",
				"options" => "range",
				"range" => "22-30",
				"unit" => 'px',
				"std" => "30px",
				"desc" => esc_html__("Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Weight", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h2_font_weight",
				"options" => $get_theme_font_weight,
				"std" => "700",
				"desc" => esc_html__("Font Weight", "revija"),
			);
			
			$mad_elements[] = array(
				"name" => esc_html__("Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h2_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Choose Font Family", "revija"),
			);

		// end 2 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 3 tab
		$mad_elements[] = array(
			'name'=>esc_html__('H3', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h3_tab_3",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h3_font_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Heading Color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h3_font_size",
				"options" => "range",
				"range" => "18-24",
				"unit" => 'px',
				"std" => "24px",
				"desc" => esc_html__("Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Weight", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h3_font_weight",
				"options" => $get_theme_font_weight,
				"std" => "700",
				"desc" => esc_html__("Font Weight", "revija"),
			);
			
			$mad_elements[] = array(
				"name" => esc_html__("Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h3_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Choose Font Family", "revija"),
			);

		// end 3 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 4 tab
		$mad_elements[] = array(
			'name'=>esc_html__('H4', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h4_tab_4",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h4_font_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Heading Color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h4_font_size",
				"options" => "range",
				"range" => "16-22",
				"unit" => 'px',
				"std" => "18px",
				"desc" => esc_html__("Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Weight", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h4_font_weight",
				"options" => $get_theme_font_weight,
				"std" => "700",
				"desc" => esc_html__("Font Weight", "revija"),
			);
			
			$mad_elements[] = array(
				"name" => esc_html__("Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h4_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Choose Font Family", "revija"),
			);

		// end 4 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 5 tab
		$mad_elements[] = array(
			'name'=>esc_html__('H5', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h5_tab_5",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h5_font_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Heading Color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h5_font_size",
				"options" => "range",
				"unit" => 'px',
				"range" => "14-20",
				"std" => "16px",
				"desc" => esc_html__("Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Weight", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h5_font_weight",
				"options" => $get_theme_font_weight,
				"std" => "700",
				"desc" => esc_html__("Font Weight", "revija"),
			);
			
			$mad_elements[] = array(
				"name" => esc_html__("Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h5_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Choose Font Family", "revija"),
			);

		// end 5 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 6 tab
		$mad_elements[] = array(
			'name'=>esc_html__('H6', 'revija'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h6_tab_6",
			"class" => "mad_tab",
			"desc" => false
		);

			$mad_elements[] = array(
				"name" 	=> esc_html__("Font Color", "revija"),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h6_font_color",
				"std" 	=> "#3e454c",
				"default" 	=> "#3e454c",
				"desc" 	=> esc_html__("Heading Color", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Size", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h6_font_size",
				"options" => "range",
				"range" => "12-18",
				"unit" => 'px',
				"std" => "14px",
				"desc" => esc_html__("Font size", "revija"),
			);

			$mad_elements[] = array(
				"name" => esc_html__("Font Weight", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h6_font_weight",
				"options" => $get_theme_font_weight,
				"std" => "400",
				"desc" => esc_html__("Font Weight", "revija"),
			);
			
			$mad_elements[] = array(
				"name" => esc_html__("Font Family", "revija"),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h6_font_family",
				"options" => $mad_google_webfonts,
				"std" => "Roboto:300,700,900,500,300italic",
				"desc" => esc_html__("Choose Font Family", "revija"),
			);

		// end 6 tab
		$mad_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

	// end tab container
	$mad_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_end",
		"desc" => false
	);

	/* --------------------------------------------------------- */
	/*	Custom Quick CSS
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Custom Quick CSS", "revija"),
		"slug"	=> "styling",
		"type" 	=> "textarea",
		"id" 	=> "custom_quick_css",
		"desc" 	=> esc_html__("Here you can make some quick changes in CSS", "revija"),
	);

/* ---------------------------------------------------------------------- */
/*	Header Elements
/* ---------------------------------------------------------------------- */

$mad_elements[] = array(
		"name" 	=> esc_html__("Header Settings", "revija"),
		"slug"	=> "header",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__("Parameters for header", "revija"),
	);


$mad_elements[] = array(
	"name" 	=> esc_html__("Header Layout", "revija"),
	"slug"	=> "header",
	"type" 	=> "select",
	"id" 	=> "header_layout",
	"options" => array(
		'header-main' => esc_html__('Header 1', 'revija'),
		'header_2' => esc_html__('Header 2', 'revija'),
		'header_3' => esc_html__('Header 3', 'revija'),
		'header_4' => esc_html__('Header 4', 'revija'),
		'header_5' => esc_html__('Header 5', 'revija'),
		'header_6' => esc_html__('Header 6', 'revija'),
		'header_7' => esc_html__('Header 7', 'revija')
	),
	"std" => 'header-main',
	"desc" 	=> esc_html__("Choose your default header style", "revija"),
);


$mad_elements[] = array(
		"name" 	=> esc_html__('Header Sidebar Setting', 'revija'),
		"slug"	=> "header",
		"type" 	=> "select",
		"id" 	=> "sidebar_setting_page_header",
		"options" => 'custom_sidebars',
		'std' => 'Header Widget Area',
		"desc" 	=> esc_html__('Choose the header sidebar setting', 'revija'),
	);

$mad_elements[] = array(
		"name" 	=> esc_html__('Header Top Weather', 'revija'),
		"slug"	=> "header",
		"type" 	=> "select",
		"id" 	=> "sidebar_setting_weather_header",
		"options" => 'custom_sidebars',
		'std' => 'Header Weather Area',
		"desc" 	=> esc_html__('Choose the header weather widget', 'revija'),
	);

$mad_elements[] = array(
		"name" 	=> esc_html__("Sticky Navigation", "revija"),
		"slug"	=> "header",
		"type" 	=> "select",
		"id" 	=> "sticky_navigation",
		"options" => array(
			'no' => esc_html__('No', 'revija'),
			'yes'  => esc_html__('Yes', 'revija')
		),
		"std" => 'no',
		"desc" 	=> esc_html__("The sticky navigation menu is a vital part of a website, helping users move between pages and find desired information.", "revija"),
	);




$mad_elements[] = array(
	"name" 	=> esc_html__("Header Top Menu Part", "revija"),
	"slug"	=> "header",
	"type" 	=> "select",
	"id" 	=> "header_top_part",
	"options" => array(
		'show'  => esc_html__('Show', 'revija'),
		'hide' => esc_html__('Hide', 'revija')
	),
	"std" => 'show',
	"desc" 	=> esc_html__("Show or hide header top part", "revija"),
);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Facebook Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "facebook_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Twitter Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "twitter_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Google+ Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "google_plus_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);


$mad_elements[] = array(
	"name" 	=> esc_html__("Show RSS Link", "revija"),
	"slug"	=> "header",
	"type" 	=> "select",
	"id" 	=> "header_top_rss_links",
	"options" => array(
		'show'  => esc_html__('Show', 'revija'),
		'hide' => esc_html__('Hide', 'revija')
	),
	"std" => 'show',
	"desc" 	=> esc_html__("Show or hide RSS Link", "revija"),
);			
			
			
$mad_elements[] =	array(
				"name" 	=> esc_html__("Pinterest Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "pinterest_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Instagram Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "instagram_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("LinkedIn Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "linkedin_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Vimeo Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "vimeo_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Youtube Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "youtube_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Flickr Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "flickr_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

$mad_elements[] =	array(
				"name" 	=> esc_html__("Envelope Page URL:", "revija"),
				"slug"	=> "header",
				"type" 	=> "text",
				"id" 	=> "envelope_page_url_top",
				"desc" 	=> esc_html__("Enter url", "revija"),
				"std"   => ''
			);

			
			
$mad_elements[] = array(
	"name" 	=> esc_html__("Show search, language, cart in header", "revija"),
	"slug"	=> "header",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> esc_html__("Header parameters", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Show Search", "revija"),
	"slug"	=> "header",
	"type" 	=> "checkbox",
	"std"   => 1,
	"id" 	=> "show_search",
	"desc" 	=> ' ',
	"label" => esc_html__("If checked show", "revija"),
	"class" => 'mad_3col'
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Show Language", "revija"),
	"slug"	=> "header",
	"type" 	=> "checkbox",
	"std"   => 1,
	"id" 	=> "show_language",
	"desc" 	=> ' ',
	"label" => esc_html__("If checked show", "revija"),
	"class" => 'mad_3col'
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Show Social", "revija"),
	"slug"	=> "header",
	"type" 	=> "checkbox",
	"std"   => 1,
	"id" 	=> "show_social",
	"desc" 	=> ' ',
	"label" => esc_html__("If checked show", "revija"),
	"class" => 'mad_3col'
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Show Cart", "revija"),
	"slug"	=> "header",
	"type" 	=> "checkbox",
	"std"   => 1,
	"id" 	=> "show_cart",
	"desc" 	=> ' ',
	"label" => esc_html__("If checked show", "revija"),
	"class" => 'mad_3col'
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Show Woo Links", "revija"),
	"slug"	=> "header",
	"type" 	=> "checkbox",
	"std"   => 1,
	"id" 	=> "show_woo_links",
	"desc" 	=> ' ',
	"label" => esc_html__("If checked show", "revija"),
	"class" => 'mad_3col',
	"clear" => 'both'
);

/* ---------------------------------------------------------------------- */
/*	Page Elements
/* ---------------------------------------------------------------------- */

$mad_elements[] = array(
		"name" 	=> esc_html__("Page Settings", "revija"),
		"slug"	=> "page",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__("Parameters for pages", "revija"),
	);

$mad_elements[] = array(
	"name" 	=> esc_html__("Page Layout", "revija"),
	"slug"	=> "page",
	"type" 	=> "select",
	"id" 	=> "page_layout",
	"options" => array(
		'wide_layout' => esc_html__('Wide Layout', 'revija'),
		'boxed_layout' => esc_html__('Boxed Layout', 'revija')
	),
	"std" => 'wide_layout',
	"desc" 	=> esc_html__("Choose a default page layout style", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Breadcrumbs on page ", "revija"),
	"slug"	=> "page",
	"type" 	=> "select",
	"id" 	=> "page_breadcrumbs",
	"options" => array(
		'yes' => esc_html__('Yes', 'revija'),
		'no' => esc_html__('No', 'revija')
	),
	"std" => 'yes',
	"desc" 	=> esc_html__("Show or hide breadcrumbs by default", "revija"),
);

$mad_elements[] = array(
		"name" 	=> esc_html__("Breadcrumbs on single page", "revija"),
		"slug"	=> "page",
		"type" 	=> "select",
		"id" 	=> "single_breadcrumbs",
		"options" => array(
			'yes' => esc_html__('Yes', 'revija'),
			'no' => esc_html__('No', 'revija')
		),
		"std" => 'yes',
		"desc" 	=> esc_html__("Show or hide breadcrumbs by default on single page", "revija"),
	);

$mad_elements[] = array(
	"name" 	=> esc_html__("Animation on Pages", "revija"),
	"slug"	=> "page",
	"type" 	=> "select",
	"id" 	=> "animation",
	"options" => array(
		'yes' => esc_html__('Yes', 'revija'),
		'' => esc_html__('No', 'revija'),
	),
	"std" => 'yes',
	"desc" 	=> esc_html__("Choose yes for shortcodes animation", "revija"),
);


	
/* ---------------------------------------------------------------------- */
/*	Sidebar Elements
/* ---------------------------------------------------------------------- */
	
$mad_elements[] = array(
		"name" 	=> esc_html__("Sidebar Settings", "revija"),
		"slug"	=> "sidebar",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__("Parameters for sidebar", "revija"),
	);
	
	
	
$mad_elements[] = array(
	"name" 	=> esc_html__("Sidebar on Pages", "revija"),
	"slug"	=> "sidebar",
	"type" 	=> "select",
	"id" 	=> "sidebar_page_position",
	"options" => array(
		'sbl' => esc_html__('Sidebar Left', 'revija'),
		'sbr' => esc_html__('Sidebar Right', 'revija'),
		'no_sidebar' => esc_html__('No Sidebar', 'revija')
	),
	"std" => 'no_sidebar',
	"desc" 	=> esc_html__("Choose the default page sidebar position", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Sidebar on Single Post Pages", "revija"),
	"slug"	=> "sidebar",
	"type" 	=> "select",
	"id" 	=> "sidebar_post_position",
	"options" => array(
		'sbl' => esc_html__('Sidebar Left', 'revija'),
		'sbr' => esc_html__('Sidebar Right', 'revija'),
		'no_sidebar' => esc_html__('No Sidebar', 'revija')
	),
	"std" => 'sbr',
	"desc" 	=> esc_html__("Choose the blog post sidebar position", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Sidebar on Archive Pages", "revija"),
	"slug"	=> "sidebar",
	"type" 	=> "select",
	"id" 	=> "sidebar_archive_position",
	"options" => array(
		'sbl' => esc_html__('Sidebar Left', 'revija'),
		'sbr' => esc_html__('Sidebar Right', 'revija'),
		'no_sidebar' => esc_html__('No Sidebar', 'revija')
	),
	"std" => 'sbr',
	"desc" 	=> esc_html__("Choose the archive sidebar position", "revija"),
);

 $mad_elements[] = array(
		 "name" 	=> esc_html__("Position Sidebar for mobile devices", "revija"),
		 "slug"	=> "sidebar",
		 "type" 	=> "select",
		 "id" 	=> "position_sidebar_mobile",
		 "options" => array(
			'bottom' => esc_html__('Bottom', 'revija'),
			'top' => esc_html__('Top', 'revija')
		 ),
		 "std" => 'bottom',
		 "desc" 	=> esc_html__("Position Sidebar for mobile devices", "revija"),
	 );





/* ---------------------------------------------------------------------- */
/*	Blog Elements
/* ---------------------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Post List Settings", "revija"),
		"slug"	=> "blog",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__("Parameters for posts list on blog page", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Excerpt Count", "revija"),
		"slug"	=> "blog",
		"type" 	=> "number",
		"id" 	=> "excerpt_count_big_post",
		"min" => 100,
		"max" => 1000,
		"std"   => 500,
		"desc" 	=> esc_html__("Excerpt count ( min-100, max-1000 symbols)", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Date", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-date",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Labels", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-category",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Ratings", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-ratings",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Comment", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-comment",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Liked", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-liked",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Views", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-views",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_3col'
	);
	
	
	
$mad_elements[] = array(
	"name" 	=> esc_html__("Single Post Settings", "revija"),
	"slug"	=> "blog",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> esc_html__("Parameters for standart elements on Post page", "revija"),
);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Excerpt Count", "revija"),
		"slug"	=> "blog",
		"type" 	=> "number",
		"id" 	=> "excerpt_count_medium_post",
		"min" => 100,
		"max" => 1000,
		"std"   => 270,
		"desc" 	=> esc_html__("Excerpt count ( min-100, max-1000 symbols)", "revija"),
	);

	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Date", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-date",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_2col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Labels", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-category",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_2col'
	);
	
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Comment", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-comment",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Liked", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-liked",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Views", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-views",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Blog Post Author", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-author",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_4col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Share Button", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-share",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_4col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Link Pages", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-link-pages",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_4col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Related Posts", "revija"),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-related-posts",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_4col'
	);

	
	
	$mad_elements[] = array(
	"name" 	=> esc_html__("Rating Posts Settings", "revija"),
	"slug"	=> "blog",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> ' '
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Title", "revija"),
		"slug"	=> "blog",
		"type" 	=> "text",
		"id" 	=> "blog_rating_title",
		"desc" 	=> esc_html__("Title Rating", "revija"),
		"std"	=> 'Summary'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Rating text", "revija"),
		"slug"	=> "blog",
		"type" 	=> "textarea",
		"id" 	=> "blog_rating_text",
		"std"   => 'Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipis.',
		"desc" 	=> esc_html__("Rating text", "revija")
	);
	

$mad_elements[] = array(
	"name" 	=> esc_html__("Related Posts Settings", "revija"),
	"slug"	=> "blog",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> ' '
);

	
	$relatedcount = array('-1' => 'All');

	for ($i = 3; $i < 51; $i++) {
		$relatedcount[$i] = $i;
	}
	$mad_elements[] = array(
		"name" 	=> esc_html__("Post's Count", "revija"),
		"slug"	=> "blog",
		"type" 	=> "select",
		"id" 	=> "related_posts_count",
		"options" => $relatedcount,
		"std" => 5,
		"desc" 	=> esc_html__("Show to display count items", "revija"),
	);

/* ---------------------------------------------------------------------- */
/*	Portfolio Elements
/* ---------------------------------------------------------------------- */

$mad_elements[] = array(
	"name" 	=> esc_html__("Archive Page Layout", "revija"),
	"slug"	=> "portfolio",
	"type" 	=> "select",
	"id" 	=> "portfolio_archive_page_layout",
	"options" => array(
		'wide_layout' => esc_html__('Wide Layout', 'revija'),
		'boxed_layout' => esc_html__('Boxed Layout', 'revija')
	),
	"std" => 'wide_layout',
	"desc" 	=> esc_html__("Choose a page layout style for the portfolio archive page", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Sidebar on Archive page", "revija"),
	"slug"	=> "portfolio",
	"type" 	=> "select",
	"id" 	=> "sidebar_portfolio_archive_position",
	"options" => array(
		'sbl' => esc_html__('Sidebar Left', 'revija'),
		'sbr' => esc_html__('Sidebar Right', 'revija'),
		'no_sidebar' => esc_html__('No Sidebar', 'revija')
	),
	"std" => 'no_sidebar',
	"desc" 	=> esc_html__("Choose the portfolio archive sidebar position", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Columns on Archive page", "revija"),
	"slug"	=> "portfolio",
	"type" 	=> "select",
	"id" 	=> "portfolio_archive_column_count",
	"options" => array(
		'2' => '2',
		'3' => '3',
		'4' => '4'
	),
	"std" => '3',
	"desc" 	=> esc_html__("This controls how many columns should be appeared on the portfolio archive page", "revija"),
);


$mad_elements[] = array(
	"name" 	=> esc_html__("List portfolio Settings", "revija"),
	"slug"	=> "portfolio",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> esc_html__("Parameters for standart elements on portfolio page", "revija"),
);

$mad_elements[] = array(
		"name" 	=> esc_html__("Portfolio Post Date", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-listing-meta-date",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_2col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Labels", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-listing-meta-category",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_2col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Comment", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-listing-meta-comment",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Liked", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-listing-meta-liked",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Views", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-listing-meta-views",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_3col'
	);
	
	
	
$mad_elements[] = array(
	"name" 	=> esc_html__("Single portfolio Settings", "revija"),
	"slug"	=> "portfolio",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> esc_html__("Parameters for standart elements on portfolio page", "revija"),
);

	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Date", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-meta-date",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_2col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Labels", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-meta-category",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_2col'
	);
	
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Comment", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-meta-comment",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Liked", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-meta-liked",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("portfolio Post Views", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-meta-views",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_3col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Portfolio Author", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-meta-author",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_4col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Share Button", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-share",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_4col'
	);
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Link Pages", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-link-pages",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"class" => 'mad_4col'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Related Posts", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "portfolio-single-related-posts",
		"label" => esc_html__("If checked show", "revija"),
		"desc" 	=> ' ',
		"clear" => 'both',
		"class" => 'mad_4col'
	);


$mad_elements[] = array(
	"name" 	=> esc_html__("Related Portfolio Settings", "revija"),
	"slug"	=> "portfolio",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> ' '
);

	
	$relatedcount_p = array('-1' => 'All');

	for ($i = 3; $i < 51; $i++) {
		$relatedcount_p[$i] = $i;
	}
	$mad_elements[] = array(
		"name" 	=> esc_html__("Portfolio's Count", "revija"),
		"slug"	=> "portfolio",
		"type" 	=> "select",
		"id" 	=> "related_portfolio_count",
		"options" => $relatedcount_p,
		"std" => 5,
		"desc" 	=> esc_html__("Show to display count items", "revija"),
	);






/* ---------------------------------------------------------------------- */
/*	Testimonials Elements
/* ---------------------------------------------------------------------- */

$mad_elements[] = array(
	"name" 	=> esc_html__("Archive Page Layout", "revija"),
	"slug"	=> "testimonials",
	"type" 	=> "select",
	"id" 	=> "testimonials_archive_page_layout",
	"options" => array(
		'wide_layout' => esc_html__('Wide Layout', 'revija'),
		'boxed_layout' => esc_html__('Boxed Layout', 'revija')
	),
	"std" => 'wide_layout',
	"desc" 	=> esc_html__("Choose a page layout style for the testimonials archive", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Sidebar on Archive page", "revija"),
	"slug"	=> "testimonials",
	"type" 	=> "select",
	"id" 	=> "sidebar_testimonials_archive_position",
	"options" => array(
		'sbl' => esc_html__('Sidebar Left', 'revija'),
		'sbr' => esc_html__('Sidebar Right', 'revija'),
		'no_sidebar' => esc_html__('No Sidebar', 'revija')
	),
	"std" => 'sbr',
	"desc" 	=> esc_html__("Choose the portfolio archive sidebar position", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Columns on Archive page", "revija"),
	"slug"	=> "testimonials",
	"type" 	=> "select",
	"id" 	=> "testimonials_archive_column_count",
	"options" => array(
		'2' => '2',
		'3' => '3',
		'4' => '4'
	),
	"std" => '3',
	"desc" 	=> esc_html__("This controls how many columns should be appeared on the testimonials archive", "revija"),
);

/* ---------------------------------------------------------------------- */
/*	Team Members Elements
/* ---------------------------------------------------------------------- */

$mad_elements[] = array(
	"name" 	=> esc_html__("Archive Page Layout", "revija"),
	"slug"	=> "team-members",
	"type" 	=> "select",
	"id" 	=> "team_members_archive_page_layout",
	"options" => array(
		'wide_layout' => esc_html__('Wide Layout', 'revija'),
		'boxed_layout' => esc_html__('Boxed Layout', 'revija')
	),
	"std" => 'wide_layout',
	"desc" 	=> esc_html__("Choose a page layout style for the team members archive", "revija"),
);

$mad_elements[] = array(
	"name" 	=> esc_html__("Sidebar on Archive page", "revija"),
	"slug"	=> "team-members",
	"type" 	=> "select",
	"id" 	=> "sidebar_team_members_archive_position",
	"options" => array(
		'sbl' => esc_html__('Sidebar Left', 'revija'),
		'sbr' => esc_html__('Sidebar Right', 'revija'),
		'no_sidebar' => esc_html__('No Sidebar', 'revija')
	),
	"std" => 'no_sidebar',
	"desc" 	=> esc_html__("Choose the team members archive sidebar position", "revija"),
);

/* ---------------------------------------------------------------------- */
/*	Footer Elements
/* ---------------------------------------------------------------------- */

	/* --------------------------------------------------------- */
	/* Copyright
	/* --------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Footer Settings", "revija"),
		"slug"	=> "footer",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__("Parameters for footer", "revija"),
	);


	$mad_elements[] = array(
		"name" => esc_html__("Show Footer Row Top widgets ?", "revija"),
		"slug"	=> "footer",
		"type" => "checkbox",
		"std" => 0,
		"id" => "show_row_top_widgets",
		"desc" => ' ',
		"label" => esc_html__("Show it if the checkbox is checked", "revija")
	);

	$mad_elements[] = array(
		"name" => esc_html__("Footer Row Top Widget positions", "revija"),
		"slug"	=> "footer",
		"type" => "widget_positions",
		"std" => '{"1":[["12"]]}',
		"id" => "footer_row_top_columns_variations",
		"desc" => esc_html__("Here you can select how your footer row top widgets will be displayed.", "revija"),
		"columns" => 6,
		"selectname" => 'get_sidebars_top_widgets'
	);

	$mad_elements[] = array(
		"name" => esc_html__("Show Footer Row Bottom widgets ?", "revija"),
		"slug"	=> "footer",
		"type" => "checkbox",
		"std" => 0,
		"id" => "show_row_bottom_widgets",
		"desc" => ' ',
		"label" => esc_html__("Show it if the checkbox is checked", "revija")
	);

	$mad_elements[] = array(
		"name" => esc_html__("Footer Row Bottom Widget positions", "revija"),
		"slug"	=> "footer",
		"type" => "widget_positions",
		"std" => '{"3":[["4","4","4"]]}',
		"id" => "footer_row_bottom_columns_variations",
		"desc" => esc_html__("Here you can select how your footer row bottom widgets will be displayed.", "revija"),
		"columns" => 6,
		"selectname" => 'get_sidebars_bottom_widgets'
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Copyright", "revija"),
		"slug"	=> "footer",
		"type" 	=> "textarea",
		"id" 	=> "copyright",
		"std"   => '',
		"desc" 	=> esc_html__("Write your copyright text for the footer", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Align the center of the copyright", "revija"),
		"slug"	=> "footer",
		"type" 	=> "checkbox",
		"std"   => 0,
		"id" 	=> "copyright_center",
		"desc" 	=> ' ',
		"label" => esc_html__("Show it if the checkbox is checked", "revija")
	);

	
/* ---------------------------------------------------------------------- */
/*	Shop Elements
/* ---------------------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Page Layout", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "product_archive_page_layout",
		"options" => array(
			'wide_layout' => esc_html__('Wide Layout', 'revija'),
			'boxed_layout' => esc_html__('Boxed Layout', 'revija')
		),
		"std" => 'wide_layout',
		"desc" 	=> esc_html__("Choose the page style layout for the product archive", "revija"),
	);

	
	
	
	$mad_elements[] = array(
		"name" => esc_html__("Effect Zoom Image", "revija"),
		"slug" => "shop",
		"type" => "select",
		"id" => "zoom_on_product_image",
		"options" => array(
			'zoom-image' => esc_html__('Yes', 'revija'),
			'' => esc_html__('No', 'revija')
		),
		"std" => 'zoom-image',
		"desc" 	=> esc_html__("if select 'yes' image zoom hover effect on", "revija"),
	);
	
	
	
	
	
	
	$mad_elements[] = array(
		"name" 	=> esc_html__("Sidebar on Archive Product", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "sidebar_product_archive_position",
		"options" => array(
			'sbl' => esc_html__('Sidebar Left', 'revija'),
			'sbr' => esc_html__('Sidebar Right', 'revija'),
			'no_sidebar' => esc_html__('No Sidebar', 'revija')
		),
		"std" => 'sbr',
		"desc" 	=> esc_html__("Choose the product archive sidebar position", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Shop View", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "shop-view",
		"options" => array(
			'view-grid-center' => esc_html__('Grid View', 'revija'),
			'view-list' => esc_html__('List View', 'revija')
		),
		"std" => 'view-grid-center',
		"desc" 	=> esc_html__("Choose default style view for the Shop page", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Product Hover", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "product_hover",
		"options" => array(
			'yes' => esc_html__('Yes', 'revija'),
			'no' => esc_html__('No', 'revija')
		),
		"std" => 'yes',
		"desc" 	=> esc_html__("If you choose Yes, you will see the first image from gallery on product hover", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Column and Product Count", "revija"),
		"slug"	=> "shop",
		"type" 	=> "heading",
		"heading" => 'h4',
		"desc" 	=> esc_html__("The following settings allow you to choose how many columns and items should be appeared on your default shop overview page and on your product archive pages.", "revija")
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Column Count", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "woocommerce_column_count",
		"options" => array(
			'3' => '3',
			'4' => '4'
		),
		"std" => '3',
		"desc" 	=> esc_html__("This controls how many columns should be appeared on overview pages.", "revija"),
	);

	$itemcount = array('-1' => 'All');

	for ($i = 3; $i < 51; $i++) {
		$itemcount[$i] = $i;
	}

	$mad_elements[] = array(
		"name" 	=> esc_html__("Product Count", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "woocommerce_product_count",
		"options" => $itemcount,
		"std" => '9',
		"desc" 	=> esc_html__("This controls how many products should be appeared on overview pages.", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Product Count of items for related products", "revija"),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "shop_single_column_items",
		"options" => $itemcount,
		"std" => '6',
		"desc" 	=> esc_html__("Number of items for related products", "revija"),
	);



/* ---------------------------------------------------------------------- */
/*	Import Elements
/* ---------------------------------------------------------------------- */

	$mad_elements[] = array(
		"name" 	=> esc_html__("Import demo files", "revija"),
		"slug"	=> "import",
		"type" 	=> "heading",
		"desc" 	=> esc_html__("If you are Wordpress newbie or want to get the theme look like one of our demos, then you can make import dummy posts and pages here. It will help you to understand how everything is organized.", "revija"),
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Import Default Content", "revija"),
		"slug"	=> "import",
		"desc" 	=> wp_kses(__("<p>
			<strong>View demo:</strong>
			<a target='_blank' href='http://velikorodnov.com/dev/revija/'>View Demo Online</a>
			</p> You can import default content dummy posts and pages here </br> </br>
			<strong>Before Import Data install you must install and activate the following plugins: </strong>
			<ul>
				<li>Revija Content Types</li>
				<li>Revija Shortcode</li>
				<li>WPBakery Visual Composer</li>
				<li>LayerSlider WP</li>
				<li>Revolution Slider</li>
				<li>WPML Multilingual CMS</li>
				<li><a target='_blank' href='https://wordpress.org/plugins/woocommerce/'>Woocommerce</a></li>
				<li><a target='_blank' href='https://wordpress.org/plugins/contact-form-7/'>Contact Form 7</a></li>
			</ul>", 'revija'), array('p' => array(), 'strong' => array(), 'a' => array('href' => array(), 'target' => array()), 'strong' => array(), 'ul' => array(), 'li' => array(), 'br')),
		"id" 	=> "import_default",
		"type" 	=> "import",
		"path" => "admin/demo/default/default",
		"source" => "admin/demo/default",
		"image" => "admin/demo/default/default.jpg"
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Import Light Content", "revija"),
		"slug"	=> "import",
		"desc" 	=> wp_kses(__("<p>
			<strong>View demo:</strong>
			<a target='_blank' href='http://velikorodnov.com/wordpress/revija2/'>View Demo Online</a>
			</p> You can import default content dummy posts and pages here </br> </br>
			<strong>Before Import Data install you must install and activate the following plugins: </strong>
			<ul>
				<li>Revija Content Types</li>
				<li>Revija Shortcode</li>
				<li>WPBakery Visual Composer</li>
				<li>LayerSlider WP</li>
				<li>Revolution Slider</li>
				<li>WPML Multilingual CMS</li>
				<li><a target='_blank' href='https://wordpress.org/plugins/woocommerce/'>Woocommerce</a></li>
				<li><a target='_blank' href='https://wordpress.org/plugins/contact-form-7/'>Contact Form 7</a></li>
			</ul>", 'revija'), array('p' => array(), 'strong' => array(), 'a' => array('href' => array(), 'target' => array()), 'strong' => array(), 'ul' => array(), 'li' => array(), 'br')),
		"id" 	=> "import_light",
		"type" 	=> "import",
		"path" => "admin/demo/light/light",
		"source" => "admin/demo/light",
		"image" => "admin/demo/light/light.jpg"
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Export Theme Settings", "revija"),
		"slug"	=> "import",
		"desc" 	=> esc_html__("Export a theme configuration file here. ", "revija"),
		"id" 	=> "export_config_file",
		"type" 	=> "export_config_file"
	);

	$mad_elements[] = array(
		"name" 	=> esc_html__("Import Theme Settings", "revija"),
		"slug"	=> "import",
		"desc" 	=> esc_html__("Upload a theme configuration file here. ", "revija"),
		"id" 	=> "import_config_file",
		"type" 	=> "import_config_file"
	);
