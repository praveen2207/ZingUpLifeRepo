(function($){
	"use strict";

	$(function(){

	$('.main_menu>ul>li>ul.children').addClass('sub_menu_wrap type_2 clearfix');
	$('.main_menu>ul>li>ul.sub-menu').addClass('sub_menu_wrap type_2 clearfix');
	$('.main_menu ul.children ul').addClass('sub_menu_wrap sub_menu_inner type_2 clearfix');
	$('.main_menu ul.sub-menu ul').addClass('sub_menu_wrap sub_menu_inner type_2 clearfix');
	
	
	$('.mega_main_menu_ul>li.menu-item-has-children>a').append('<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span>');
	$('.mega_main_menu_ul>li>ul>li.menu-item-has-children>a').append('<span class="plus arr"><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>');

	$('#sidebar .widget_socialcountplus').addClass('section');
	
	$('.wpcf7-select').addClass('chosen-select');
	$('#wp_categories_widget select').addClass('chosen-select');
	$('.widget_categories select').addClass('chosen-select');
	$('.widget_archive select').addClass('chosen-select');
	$('.widget_text select').addClass('chosen-select');
	
	
	
	
	
	
	/* Chosen Select Box */
	var config = {
	  '.chosen-select'             : {disable_search_threshold:10, width:'100%'}
	}
	for (var selector in config) {
	
	  $(selector).chosen(config[selector]);
	  
	}

	$('#sidebar .widget.woocommerce').addClass('section');
	
	$('.sf-counter-container h3').addClass('section_title');

	$('.item-list-tabs.author_info_buttons a span').parent('a').addClass('button_type_icon_medium');
	$('.item-list-tabs.author_info_buttons a').addClass('button button_grey_light');
	
	$('.wp-polls-form a').addClass('button button_grey');
	
	
	$('.content .widget_display_forums ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_display_forums li").wrapInner("<h4></h4>");
	$('.content .widget_display_views ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_display_views li").wrapInner("<h4></h4>");

	$('.wpb_tabs_heading').addClass('section_title_medium');
	$('.wpb_tour_heading').addClass('section_title_medium');
	
	
	$('.price_slider_amount .button').addClass('button_grey');
	$('.woocommerce-message a').addClass('button button_type_icon_small button_orange');
	$('.woocommerce-message a').append('<i class="fa fa-shopping-cart"></i>');
	
	$('.widget_calendar').addClass('calendar');
	$(".calendar table tbody tr td a").parent('td').addClass('link')
	$('.calendar table tr td#prev a').addClass('button button_type_2 button_grey_light');
	$('.calendar table tr td#next a').addClass('button button_type_2 button_grey_light');
	
	$('.pagination_block ul').addClass('pagination clearfix');
	
	$('.content .vc_wp_archives ul:not(.chosen-results)').addClass('circle_list');
	$(".content .vc_wp_archives li").wrapInner("<h4></h4>");
	
	$('.content .vc_wp_categories_type1 ul:not(.chosen-results)').addClass('circle_list');
	$('.content .vc_wp_categories_type2 ul:not(.chosen-results)').addClass('circle_list');
	$(".content .vc_wp_categories_type1 li").wrapInner("<h4></h4>");
	$(".content .vc_wp_categories_type2 li").wrapInner("<h4></h4>");
	
	
	$('.content .widget_product_categories ul:not(.chosen-results)').addClass('circle_list');

	$('.content .vc_wp_posts ul').addClass('circle_list');
	$(".content .vc_wp_posts li").wrapInner("<h4></h4>");
	
	$('.content .vc_wp_tagcloud ul').addClass('circle_list');
	$(".content .vc_wp_tagcloud li").wrapInner("<h4></h4>");
	
	$('.content .vc_wp_meta ul').addClass('circle_list');
	$(".content .vc_wp_meta li").wrapInner("<h4></h4>");

	$(".content .vc_wp_recentcomments li a").wrapInner("<h4></h4>");
	
	$('.content .vc_wp_pages ul').addClass('circle_list');
	$(".content .vc_wp_pages li").wrapInner("<h4></h4>");
	
	$('.footer .vc_wp_custommenu ul').addClass('footer_list');
	$('.content .vc_wp_custommenu ul').addClass('circle_list');
	$(".content .vc_wp_custommenu li").wrapInner("<h4></h4>");
	
	
	$('.vc_wp_search form').addClass('search type_widget');
	$('.vc_wp_search form input').after('<button class=""><i class="fa fa-search"></i></button>');
	
	
	$('.widget_tag_cloud ').addClass('widget_tags');
	$('.tagcloud').addClass('box-tags');
	$('.tagcloud a').addClass('btn-tags');

	$('.content .widget_categories ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_categories li").wrapInner("<h4></h4>");
	
	$('.content .widget_archive ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_archive li").wrapInner("<h4></h4>");
	
	$('.footer .widget_nav_menu ul:not(.chosen-results)').addClass('footer_list');
	$('.content .widget_nav_menu ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_nav_menu li").wrapInner("<h4></h4>");
	
	$('.content .widget_recent_comments ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_recent_comments li").wrapInner("<h4></h4>");
	
	$('.content .widget_meta ul').addClass('circle_list');
	$(".content .widget_meta li").wrapInner("<h4></h4>");
	
	$('.content .widget_pages ul:not(.chosen-results)').addClass('circle_list');
	$(".content .widget_pages li").wrapInner("<h4></h4>");
	
	$('.content .widget_recent_entries ul').addClass('circle_list');
	$(".content .widget_recent_entries li").wrapInner("<h4></h4>");
	
	$('.widget_search form').addClass('search type_widget');
	$('.widget_search form input').after('<button class=""><i class="fa fa-search"></i></button>');

	function rgb2hex(rgb){
	 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
	 return (rgb && rgb.length === 4) ? "#" +
	  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
	  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
	  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
	}
	
	if($('body').hasClass('mmm')) {

			$('li[class*="additional_style_"]').each(function(){
				var color = $(this).children('.item_link').css("background-color");
				var hex = rgb2hex( color );
				
				$(this).children('.item_link').css("border-bottom-color", hex);
			});
			
	}
	
	
	
	
	$( function() { 
		  $( '.audioplayer1 audio' ).audioPlayer(); 
	});
	
	
	
		// ie9 placeholder

		if($('html').hasClass('ie9')) {
			$('input[placeholder]').each(function(){
				$(this).val($(this).attr('placeholder'));
				var v = $(this).val();
				$(this).on('focus',function(){
					if($(this).val() === v){
						$(this).val("");
					}
				}).on("blur",function(){
					if($(this).val() == ""){
						$(this).val(v);
					}
				});
			});
			
		}

		// remove products from shopping cart
		
		// $('header').on('click','.close_product',function(){
			// $(this).closest('li').animate({'opacity':'0'},function(){
				// $(this).slideUp(500);
			// });
		// });


		// responsive menu

		window.rmenu = function(){

			var	nav = $('nav#navigation'),
				header = $('header.header');

			var rMenu = new Object();

			rMenu.init = function(){
				rMenu.checkWindowSize();
				$(window).on('resize',rMenu.checkWindowSize);
			}

			rMenu.checkWindowSize = function(){

				if($(window).width() < 992){
					rMenu.Activate();
				}
				else{
					rMenu.Deactivate();
				}

			}
			// add click events
			rMenu.Activate = function(){
				if($('html').hasClass('md_touch')) header.off('.touch');
				header.off('click').on('click.responsivemenu','#menu_button',rMenu.openClose);
				header.on('click.responsivemenu','.main_menu li a',rMenu.openCloseSubMenu);
				nav.find('.touch_open_sub').removeClass('touch_open_sub').children('a').removeClass('prevented');
			}
			// remove click events
			rMenu.Deactivate = function(){
				header.off('.responsivemenu');
				nav.removeAttr('style').find('li').removeClass('current_click')
				.end().find('.sub_menu_wrap').removeAttr('style').end().find('.prevented').removeClass('prevented').end()
				if($('html').hasClass('md_touch')) header.off('click').on('click.touch','.main_menu li a',rMenu.touchOpenSubMenu);
			}

			rMenu.openClose = function(){

				$(this).toggleClass('active');
				nav.stop().slideToggle();

			}

			rMenu.openCloseSubMenu = function(e){

				var self = $(this);

				if(self.next('.sub_menu_wrap').length){
					self.parent()
						.addClass('current_click')
						.siblings()
						.removeClass('current_click')
						.children(':not(span,a)')
						.slideUp();
					self.next().stop().slideToggle();
					self.parent().siblings().children('a').removeClass('prevented');

					if(!(self.hasClass('prevented'))){
						e.preventDefault();
						self.addClass('prevented');
					}else{
						self.removeClass('prevented');
					}
				}

			}

			rMenu.touchOpenSubMenu = function(event){
				var self = $(this);

				if(self.next('.sub_menu_wrap').length){

					if(!(self.hasClass('prevented'))){
						event.preventDefault();
						self.addClass('prevented');
					}else{
						self.removeClass('prevented');
					}

				}
				
			}

			rMenu.init();
		}

		rmenu();

		/*Search_holder*/

		window.search_holder = function(){

			var searchHolder = $('.search-holder');

			if (searchHolder.length) {
				searchHolder.searchClick();
			}

		}

		search_holder();

	   // tweet_slider

	   if($(".widget_latest_tweets_widget").length){
	   
		   $(".widget_latest_tweets_widget ul").owlCarousel({
				navSpeed : 800,
				nav:true,
				loop:false,
				autoplay:false,
				autoplaySpeed: 800,
				navText:false,
				items: 1
			});
	   
	   }
	   
	   
		// News carousel

		$("#owl-demo").owlCarousel({
	      nav : true,
	      navText:false,
	      navSpeed: 800,
	      loop:true,
	      autoplay:true,
	      autoplaySpeed: 800,
	      items : 1
	  	});

		// Gallery carousel

		window.footer_slider = function(){
			
			$(".owl-demo-2").owlCarousel({
			  items : 1,
		      navigation : true, // Show next and prev buttons
		      nav : true,
		      loop:true,
		      navSpeed: 800,
		      navText:false
		  	});

		}

		footer_slider();

		// Gallery carousel-2

		$("#owl-demo-3").owlCarousel({
	      nav : true,
	      navText: false,
	      navSpeed: 800,
	      loop:true,
	      items : 1
	  	});

		
		
		// Gallery carousel-3

		$("#owl-demo-4").owlCarousel({
	      items : 4,
	      navSpeed: 800,
	      nav : true,
	      loop:true,
	      navText:false,
	      responsive:{
		        0:{
		            items:1
		        },
		        481:{
		            items:2
		        },
		        980:{
		            items:3
		        }
		    }
	  	});

		// Gallery carousel-4

		$("#owl-demo-5").owlCarousel({
	      items : 5,
	      navSpeed: 800,
	      nav : true,
	      navText:false,
	      loop:true,
	      autoplay: true,
	      autoplaySpeed: 800,
	        responsive:{
		        0:{
		            items:1
		        },
		        481:{
		            items:3
		        },
		        992:{
		            items:5
		        }
		    }
	  	});

		// Gallery carousel-5

		$("#owl-demo-6").owlCarousel({
	      items : 3,
	      navSpeed : 800,
	      nav : true,
	      loop: true,
	      navText:false,
	      responsive:{
		        0:{
		            items:2
		        },
		        481:{
		            items:3
		        },
		        980:{
		            items:3
		        }
		    }
	  	});

		// Gallery carousel-6

		$("#owl-demo-7").owlCarousel({
		  items : 3,
		  navSpeed : 800,
		  nav : true,
		  loop: true,
	      navText:false,
		  responsive:{
		        0:{
		            items:2
		        },
		        481:{
		            items:3
		        },
		        980:{
		            items:3
		        }
		    }
		});

		// Gallery carousel-7

		$("#owl-demo-9").owlCarousel({
	      items : 1,
	      navSpeed : 800,
	      nav: true,
	      navText: false,
	      loop: true
	 	});

	 	// Gallery carousel-8

		$("#owl-demo-10").owlCarousel({
	      items : 4,
	      navSpeed : 800,
	      nav : true,
	      loop: true,
	      navText:false,
	      responsive:{
		        0:{
		            items:2
		        },
		        481:{
		            items:3
		        },
		        980:{
		            items:4
		        }
		    }
	 	});

		

		
		//===================fixed header================

		// ie9 placeholder

		if($('html').hasClass('ie9')) {
			$('input[placeholder]').each(function(){
				$(this).val($(this).attr('placeholder'));
				var v = $(this).val();
				$(this).on('focus',function(){
					if($(this).val() === v){
						$(this).val("");
					}
				}).on("blur",function(){
					if($(this).val() == ""){
						$(this).val(v);
					}
				});
			});
			
		}

		// tabs

		var tabs = $('.tabs');
		if(tabs.length){
			tabs.tabs({
				beforeActivate: function(event, ui) {
			        var hash = ui.newTab.children("li a").attr("href");
			   	},
				hide : {
					effect : "fadeOut",
					duration : 450
				},
				show : {
					effect : "fadeIn",
					duration : 450
				},
				updateHash : false
			});
		}

	


		// Loader

		if($('.mad__queryloader').length){
		
			$("body").queryLoader2({
				backgroundColor: '#fff',
				barColor : '#ff680d',
				barHeight: 4,
				deepSearch:true,
				minimumTime:1000,
				onComplete: function(){
					$(".mad__queryloader").fadeOut('200');
				}
			});

		}

		
		
	$(window).load(function(){

	
			$('p:empty').remove();

			$(document).on('click','#sort_button',function(e){
				var dropdown = $('#sort_button').nextAll('.vc_grid-filter');
				dropdown.addClass('sort_list');
				
				$(this).toggleClass('active');
				e.preventDefault();
				if(dropdown.hasClass('opened')){
					dropdown.removeClass('opened').addClass('closed');
					setTimeout(function(){
						dropdown.removeClass('closed')
					},500);
				}else{
					dropdown.addClass('opened');
				}	
			});
			
			
			if($('.flexslider').length){
			$(window).trigger('resize');
			}

				
	});
    
	
	//if($('#scroll_sidebar').length) $('#scroll_sidebar').scrollSidebar();
	
		// Sticky and Go-top

		(function ($, window) {

			function Temp(el, options) {
				this.el = $(el);
				this.init(options);
			}

				Temp.DEFAULTS = {
					sticky: true
				}
			
			
			
			Temp.prototype = {
				init: function (options) {
					var base = this;
						base.window = $(window);
						base.options = $.extend({}, Temp.DEFAULTS, options);
						base.menuWrap = $('.menu_wrap');
						base.goTop = $('<button class="go-to-top" id="go-to-top"></button>').appendTo(base.el);

					// Sticky
					if(global.sticky_navigation == 'yes') {
						base.sticky.stickySet.call(base, base.window);
					}

					// Scroll Event
					base.window.on('scroll', function (e) {
						if(global.sticky_navigation == 'yes') {
							base.sticky.stickyInit.call(base, e.currentTarget);
						}
						base.gotoTop.scrollHandler.call(base, e.currentTarget);
					});

					// Click Handler Button GotoTop
					base.gotoTop.clickHandler(base);
				},
				sticky: {
					stickySet: function () {
						var menuWrap = this.menuWrap, offset;
						if (menuWrap.length) {
							offset = menuWrap.offset().top;
							$.data(menuWrap, 'data', {
								offset: offset,
								height: menuWrap.outerHeight(true)
							});
							this.spacer = $('<div/>', { 'class': 'spacer' }).insertBefore(menuWrap);
						}
					},
					stickyInit: function (win) {
						var base = this, data;
						if (base.menuWrap.length) {
							data = $.data(base.menuWrap, 'data');
							base.sticky.stickyAction(data, win, base);
						}
					},
					stickyAction: function (data, win, base) {
						var scrollTop = $(win).scrollTop();
						if (scrollTop > data.offset) {
							base.spacer.css({ height: data.height });
							if (!base.menuWrap.hasClass('sticky')) {
								base.menuWrap.addClass('sticky');
							}
						} else {
							base.spacer.css({ height: 'auto' });
							if (base.menuWrap.hasClass('sticky')) {
								base.menuWrap.removeClass('sticky');
							}
						}
					}
				},
				gotoTop: {
					scrollHandler: function (win) {
						$(win).scrollTop() > 200 ?
							this.goTop.addClass('go-top-visible'):
							this.goTop.removeClass('go-top-visible');
					},
					clickHandler: function (self) {
						self.goTop.on('click', function (e) {
							e.preventDefault();
							$('html, body').animate({ scrollTop: 0 }, 800);
						});
					}
				}
			}

			/* Temp Plugin
			 * ================================== */

			$.fn.Temp = function (option) {
				return this.each(function () {
					var $this = $(this), data = $this.data('Temp'),
						options = typeof option == 'object' && option;
					if (!data) {
						$this.data('Temp', new Temp(this, options));
					}
				});
			}

			$('body').Temp({
				sticky: true
			});

		})(jQuery, window);

		/* ---------------------------------------------------- */
        /*	SmoothScroll										*/
        /* ---------------------------------------------------- */

		if (global.smoothScroll == 'show') {
		
			try {
				$.browserSelector();
				var $html = $('html');
				if ( $html.hasClass('chrome') || $html.hasClass('ie11') || $html.hasClass('ie10') ) {
					$.smoothScroll();
				}
			} catch(err) {}

		}
		
		
		// custom select

		if ($('.custom_select').length) {
				$('.custom_select').customSelect();
			}
		
	
		// accordion & toggle

		var aItem = $('.accordion:not(.toggle) .accordion_item'),
			link = aItem.find('.a_title'),
			$label = aItem.find('label'),
			aToggleItem = $('.accordion.toggle .accordion_item'),
			tLink = aToggleItem.find('.a_title');

			aItem.add(aToggleItem).children('.a_title').not('.active').next().hide();

		function triggerAccordeon($item) {
			$item
				.addClass('active')
				.next().stop().slideDown()
				.parent().siblings()
				.children('.a_title')
				.removeClass('active')
				.next().stop().slideUp();
		}


		if ($label.length) {
			$label.on('click',function(){
				triggerAccordeon($(this).closest('.a_title'))
			});
		} else {
			link.on('click',function(){
				triggerAccordeon($(this))
			});
		}
			

		tLink.on('click',function(){
			$(this).toggleClass('active')
					.next().stop().slideToggle();

		})

		
		// jackbox

		if($(".jackbox[data-group]").length){
			jQuery(".jackbox[data-group]").jackBox("init",{
			    showInfoByDefault: false,
			    preloadGraphics: false, 
			    fullscreenScalesContent: true,
			    autoPlayVideo: false,
			    flashVideoFirst: false,
			    defaultVideoWidth: 960,
			    defaultVideoHeight: 540,
			    baseName: ".jackbox",
			    className: ".jackbox",
			    useThumbs: true,
			    thumbsStartHidden: false,
			    thumbnailWidth: 75,
			    thumbnailHeight: 50,
			    useThumbTooltips: false,
			    showPageScrollbar: false,
			    useKeyboardControls: true 
			});
		}

		/*	FitVids														 	  */
		/* ------------------------------------------------------------------ */

		$('#content').fitVids();
		
		
		// appear animation

	    function animate(){
	    	
	     $("[data-appear-animation]").each(function() {

	         var self = $(this);

	         self.addClass("appear-animation");

	         if($(window).width() > 800) {
	          self.appear(function() {

	           var delay = (self.attr("data-appear-animation-delay") ? self.attr("data-appear-animation-delay") : 1);

	           if(delay > 1) self.css("animation-delay", delay + "ms");
	           self.addClass(self.attr("data-appear-animation"));

	           setTimeout(function() {
	            self.addClass("appear-animation-visible");
	           }, delay);

	          }, {accX: 0, accY: -150});
	         } else {
	          self.addClass("appear-animation-visible");
	         }
	        });
	    }

	    animate();

	    $(window).on('resize',animate);


    
	});

})(jQuery);