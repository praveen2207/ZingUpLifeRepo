<?php

/* General */
/*---------------------------------*/

$output = "";

if (mad_custom_get_option('smooth_scroll') == 'show') {
	
	$output .= "
		* ::-webkit-scrollbar{
		  width: 5px;
		  background: #52585e;
		}

		::-webkit-scrollbar-thumb{
		  background: #ff680d;
		}

		::-webkit-scrollbar {
			background-color: $secondary_color;
		}

		 ::-webkit-scrollbar-thumb, body .go-to-top:hover, .button.button_grey_light:hover, .button.button_white:hover, .post_image_buttons .icon_box:hover, .pagination li span.current, .pagination li a:hover, .button.button_orange, .button.search_button:hover, .shopping_button:hover, .close_search_form:hover, .button.button_grey:hover, body .post_text .post_theme, .login_block > ul > li:hover > a, .button.view_button:hover, .canvas, .widget_tags .box-tags a:hover, #sidebar .widget_zn_mailchimp .btn-email:hover, .owl-carousel .owl-nav .owl-prev:hover, .owl-carousel .owl-nav .owl-next:hover, .tabs.variation_2 .tabs_conrainer .tabs_nav li.ui-tabs-active a, .tabs.variation_2 .tabs_conrainer .tabs_nav li a:hover, .wp-polls-form input.Buttons, #flexslider .flex-direction-nav a:hover, .flexslider .flex-direction-nav a:hover, ul.posts_numeric li:hover .comment_number, .vc_wp_tagcloud_flat a:hover, .calendar table tr td.current, .calendar table tr td#today, .calendar table tr td.link a:hover, .custom_select .select_list li:hover, .ui-slider-range, #sidebar .widget.widget_product_tag_cloud .box-tags a:hover, #contactform-submit:hover, body #buddypress div.item-list-tabs ul li>a.button_orange, body #buddypress div.item-list-tabs ul li>a:hover, body .wpcf7-submit:hover, body .wpb_button.button_orange, body .wpb_button.button_grey:hover, body .wpb_button.button_orange i {
			background: $primary_color;
		 }
	";

}


$output .= "

	header.header, body .header[class*='header-'], .header.header_2 .searchform_wrap, .header.header_3 .searchform_wrap, body header.header_5 .searchform_wrap{
		background-color: $header_bg_color;
	}

	header.header .pre_header{
		background-color: $preheader_bg_color;
	}
	.cookie.cwcookielaw span{
		color: $cookie_txt_color;
	}
	.cookie.cwcookielaw{
		background-color: $cookie_bg_color;
	}
	
	header.header .h_top_part{
		background-color: $header_top_bg_color;
	}
	header.header .h_top_part{
		border-bottom-color: $header_top_border_color;
	}
	
	header.header .menu_wrap{
		background-color: $menu_header_bg_color;
	}
	
	header.header .searchform_wrap{
		background-color: $search_header_bg_color;
	}
	
	header.header .menu_wrap .menu_border{
		border-bottom-color: $menu_header_border_color;
	}
	.footer .widget_slider_posts h4 a { color: $footer_link_color; }
	footer.footer { border-top: 2px solid  $footer_top_part_border_color; }
	footer.footer .footer_bottom_part { border-top-color: $footer_bottom_part_border_color; }
	
	
	header.header .mobile_menu.var2 nav ul li a, header.header #mega_main_menu > .menu_holder > .menu_inner > ul > li > .item_link, header.header .mobile_menu nav ul li:before,
	header.header .login_block > ul > li, header.header .login_block > ul > li > a, .header.header_2 .head_weather_info, .header.header_7 .head_weather_info{
		color: $header_text_color;	
	}
	
	header.header .login_block > ul > li > a:hover, header.header #mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li:hover > a, header.header #mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-item > a, header.header #mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-parent > a, header.header #mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-ancestor > a {
    color: #fff;
	}
	
	body {
		color: $general_font_color;
		font-size: $general_font_size;
	}

	body.boxed_layout { background: $body_bg; }
	
	::selection {
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}

	::-moz-selection{
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}

	.tp-rightarrow.default:hover, .tp-leftarrow.default:hover {
		background-color: $primary_color !important;
	 } 
	 
	input[type='text']:focus, input[type='tel']:focus, input[type='password']:focus, input[type='email']:focus, textarea:focus {
		border-color: $primary_color;
	}
	.tooltip:after {
		border-top-color: $primary_color;
	}
	.widget_social_icons.type_2.tool_down ul li span.tooltip:after, .widget_social_icons.type_2.tool_down ul li span.tooltip:after {
		border-bottom-color: $primary_color;
	}
	

	mark, ins {
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}
	
	a, blockquote p, p a, body form.search button:hover, .shopping_cart .total_price ul li:last-child, #sort_button:hover, #sort_button.active, #load_more:hover,
.more_news_button:hover, .vc_grid-btn-load_more a:hover, .login_form a, .login_form_confirm span a, .dropdown_list > li a:hover, .sort_list > li a:hover, .vc_grid-filter > li span:hover, .product_list_widget li .product_description .amount, body .rating-box i.star-on-png, body .rating-box i.star-half-png, .product_item .product_info .price, body .bbp-forum-freshness p a, .activity_list li .post_text .activity-read-more a, [class*='default_list_'] li:hover:before, .default_list_numb li:hover span { color: $primary_color; }

	.search-button:hover::before,
	.submit-search:hover::before,
	.close-search-form:hover::before,
	.info-block .icon-text-holder .icon-text-link:hover { color: $primary_color; }



	a:hover,
	.entry-title a:hover,
	blockquote:before,
	.product .price,
	.summary .price ins .amount,
	ul.fl-countdown li span
	{
		color: $secondary_color;
	}

	 .sticky-post
	 {
		background-color: $secondary_color;
	 }

";

/* Logo */
/*---------------------------------*/

$output .= "
	.header-main #logo {
		font-size: $logo_font_size;
	}

		.header-main #logo a {
			color: $logo_font_color;
		}
";

/* Headings */
/*---------------------------------*/

$output .= "
	.content_post_block .wpb_text_column h1 {
		color: $h1_font_color;
		font-size: $h1_font_size;
		font-weight: $h1_font_weight;
	}
	.content_post_block .wpb_text_column h2 {
		color: $h2_font_color;
		font-size: $h2_font_size;
		font-weight: $h2_font_weight;
	}
	.content_post_block .wpb_text_column h3 {
		color: $h3_font_color;
		font-size: $h3_font_size;
		font-weight: $h3_font_weight;
	}
	.content_post_block .wpb_text_column h4 {
		color: $h4_font_color;
		font-size: $h4_font_size;
		font-weight: $h4_font_weight;
	}
	.content_post_block .wpb_text_column h5 {
		color: $h5_font_color;
		font-size: $h5_font_size;
		font-weight: $h5_font_weight;
	}
	.content_post_block .wpb_text_column h6 {
		color: $h6_font_color;
		font-size: $h6_font_size;
		font-weight: $h6_font_weight;
	}
";

/* Layer Slider */
/*---------------------------------*/

$output .= "
	$color_scheme  .ls-nav-prev:hover,
	$color_scheme  .ls-nav-next:hover { background-color: $primary_color; }

	$color_scheme  .ls-nav-start:hover:before,
	$color_scheme  .ls-nav-stop:hover:before,
	$color_scheme  .ls-nav-start.ls-nav-start-active:before,
	$color_scheme  .ls-nav-stop.ls-nav-stop-active:before { color: $primary_color; }

	$color_scheme  .ls-bottom-slidebuttons a.ls-nav-active,
	$color_scheme  .ls-bottom-slidebuttons a:hover { background-color: $primary_color; }
";

/* Revolution Slider */
/*---------------------------------*/

$output .= "
	$color_scheme .tp-leftarrow.default.custom:hover,
	$color_scheme .tp-rightarrow.default.custom:hover { background-color: $primary_color; }

	$color_scheme .tp-bullets.simplebullets.custom .bullet.selected,
	$color_scheme .tp-bullets.simplebullets.custom .bullet:hover { background-color: $primary_color; }

";

/* Navigation */
/*---------------------------------*/

$output .= "
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li:hover > a, 
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-item > a, 
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-parent > a, 
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-ancestor > a {
  background: $primary_color;
}
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li:hover > a, 
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-item > a,
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-parent > a, 
#mega_main_menu > .menu_holder > .menu_inner .mega_main_menu_ul > li.current-menu-ancestor > a {
   border-bottom-color:$primary_color;
}
";

/* Footer */
/*---------------------------------*/

$output .= "
	footer.footer, footer.footer .widget_title, .footer .footer_bottom_part p span, footer.footer .mobile_menu nav ul li:before,
	#footer .form_section.widget_zn_mailchimp .form_text, footer.footer .widget_categories .categories_list > li > ul li a, 
	footer.footer .widget ul li a, footer.footer .mobile_menu a, footer.footer .widget .post_text h4 { color: $footer_text_color; }
	
	
	
	footer.footer .widget_title, footer.footer .widget_slider_posts .photo_gallery.side_bar { border-top-color: $footer_text_color; }
	
	footer.footer { background-color: $footer_bottom_part_bg_color; }
	footer.footer .top_footer_banner { background-color: $footer_top_part_bg_color; }
	footer.footer .footer_bottom_part { background-color: $footer_bg_color; }
	
	
	
	

	footer.footer .widget ul li .tweet-text a.twitter-hashtag, footer.footer .widget.widget_latest_tweets_widget ul li .tweet-text a { color: $primary_color; }
	footer.footer .widget ul li .tweet-text a.twitter-hashtag:hover, footer.footer .widget.widget_latest_tweets_widget ul li .tweet-text a:hover { color: $primary_color; }
	
		#footer .widget.widget_text a:hover {
			color: $primary_color;
		}

";


/* Owl Carousel */
/*---------------------------------*/

$output .= "
	.owl-tm-theme .owl-controls .owl-buttons div:hover,
	.owl-qv-carousel-theme .owl-controls .owl-buttons div:hover,
	.owl-widget-theme .owl-controls .owl-buttons div:hover
	{
		background-color: $primary_color;
	}
";

/* Shortcodes */
/*---------------------------------*/

$output .= "
	.info-block.type-2 .icon-wrap {
		color: $primary_color;
	}

	.info-block.type-2:hover .icon-wrap {
		background-color: $primary_color;
	}

";

/*---------------------------------*/
/* CUSTOM */
/*---------------------------------*/

global $revija_config;
$revija_config['styles'] = array(

	array(
		'commenting' => esc_html__('Dynamic Styles', 'revija'),
		'values' => array(
			'returnValue' => $output
		)
	),

	array(
		'elements' => 'body',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('general_google_webfont')
		)
	),
	array(
		'elements' => 'body .second_font, #recentcomments_widget h4, .wp-polls-form p strong, .post-item-home h4',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('second_google_webfont')
		)
	),
	array(
		'elements' => '#header .logo',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-logo_font_family')
		)
	),

	// Heading H1
	array(
		'elements' => 'h1',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-h1_font_family')
		)
	),
	// Heading H2
	array(
		'elements' => 'h2',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-h2_font_family')
		)
	),
	// Heading H3
	array(
		'elements' => 'h3',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-h3_font_family')
		)
	),
	// Heading H4
	array(
		'elements' => 'h4',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-h4_font_family')
		)
	),
	// Heading H5
	array(
		'elements' => 'h5',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-h5_font_family')
		)
	),
	// Heading H6
	array(
		'elements' => 'h6',
		'values' => array(
			'google_webfonts' => mad_custom_get_option('styles-h6_font_family')
		)
	),

	// The Quick Custom CSS
	array(
		'commenting' => 'Custom Styles',
		'values' => array(
			'returnValue' => mad_custom_get_option('custom_quick_css')
		)
	)
);