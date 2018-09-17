$(window).on("load",function(){
	var sw = $('#styleswitcher'),
		swB = sw.children('.open_sw'),
		layout = $('[class*="_layout"]'),
		sc = $('#select_color'),
		hSelect = $('[name="header_type"]'),
		fSelect = $('[name="footer_type"]'),
		bgSelect = $('select[name="bg_color"]'),
		color = $('.bg_select_color'),
		image = $('.bg_select_image'),
		bgImagebutton = $('.bg_image_button'),
		reset = sw.find('button[type="reset"]');

	var t = setTimeout(function(){
		sw.addClass('closed');	
		clearTimeout(t);
		sw.trigger('open/close');
	},700);

	sw.on('open/close',function(){
		var $this = $(this);
		swB.on('click',function(){
			$this.toggleClass('closed');
		});
	});

	sc.ColorPicker({
		color: '#e2e2e2',
		onShow: function (colpkr){
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb){
			$('body').css('background-image','none');
			$('#select_color,body').css('backgroundColor', '#' + hex);
		}
	});

	sw.find('[data-layout]').on('click',function(){
		var self = $(this),
		data = self.data('layout');
		self.addClass('active').siblings('[data-layout]').removeClass('active');
		if(!(self.hasClass('homepage'))){
			switch(data){
				case "wide" :
				 if(layout.hasClass('wide_layout')){
				 	break;
				 }else{
				 	layout.removeClass('boxed_layout').addClass('wide_layout');
				 	$('#go_to_top').addClass('type_2');
				 }
			 	break;
			 	case "boxed" :
			 		if(layout.hasClass('boxed_layout')){
				 		break;
					}else{
						layout.removeClass('wide_layout').addClass('boxed_layout');
						$('#go_to_top').removeClass('type_2');
					}
			 	break;
			}
		}else{
			switch(data){
				case "boxed" :
				 	window.location.href = "index_layout_boxed.html"
			 	break;
			 	case "wide" :
			 		window.location.href = "index.html"
			 	break;
			}
		}
	});

	$('.select_list').each(function(){

		var t = $(this).prev('.select_title').text();
		$(this).find('li').each(function(){
			var self = $(this);
			if(self.text() == t){
				self.addClass('active');
			}
		});

	});

	hSelect.prev('.select_list').on('click','li:not(.active)',function(){
		var val = $(this).text(),
			h = $('header.header');

		$(this).addClass('active').siblings().removeClass('active');

		h.slideUp(function(){
			$(this).html("");
			switch(val){
				case "Header 1" : 
					h.load('inc/header_1.html',function(){
						$(this).removeClass('header_2 header_3 header_4 header_5').addClass('header-main').slideDown();
						window.rmenu();
						window.search_holder();
					});
				break;
				case "Header 2" : 
					h.load('inc/header_2.html',function(){
						$(this).removeClass('header-main header_3 header_4 header_5').addClass('header_2').slideDown();
						window.rmenu();
						window.search_holder();
					});
				break;
				case "Header 3" : 
					h.load('inc/header_3.html',function(){
						$(this).removeClass('header-main header_2 header_4 header_5').addClass('header_3').slideDown();
						window.rmenu();
						window.search_holder();
					});
				break;
				case "Header 4" : 
					h.load('inc/header_4.html',function(){
						$(this).removeClass('header_2 header-main header_3 header_5').addClass('header_4').slideDown();
						window.rmenu();
						window.search_holder();
					});
				break;
				case "Header 5" : 
					h.load('inc/header_5.html',function(){
						$(this).removeClass('header_2 header-main header_3 header_4').addClass('header_5').slideDown();
						window.rmenu();
						window.search_holder();
					});
				break;
				case "Header 6" : 
					h.load('inc/header_6.html',function(){
						$(this).removeClass('header_2 header-main header_3 header_4 header_5').addClass('header_6').slideDown();
						window.rmenu();
						window.search_holder();
					});
				break;
			}
		});

	});

	fSelect.prev('.select_list').on('click','li:not(.active)',function(){
		var val = $(this).text(),
			h = $('.footer'),
			body = $('html,body');

		$(this).addClass('active').siblings().removeClass('active');

		h.slideUp(function(){
			$(this).html("");
			switch(val){
				case "Footer 1" : 
					h.load('inc/footer_1.html',function(){
						$(this).removeClass('footer_2 footer_3 footer_4 footer_5').addClass('footer-main').slideDown();
						body.animate({ scrollTop : $(document).height() });
						window.tweet_slider();
						window.flickr_list();
					});
				break;
				case "Footer 2" : 
					h.load('inc/footer_2.html',function(){
						$(this).removeClass('footer_3 footer_4 footer_5 footer-main').addClass('footer_2').slideDown();
						body.animate({ scrollTop : $(document).height() });
					});
				break;
				case "Footer 3" : 
					h.load('inc/footer_3.html',function(){
						$(this).removeClass('footer_2 footer_4 footer_5 footer-main').addClass('footer_3').slideDown();
						body.animate({ scrollTop : $(document).height() });
					});
				break;
				case "Footer 4" : 
					h.load('inc/footer_4.html',function(){
						$(this).removeClass('footer_3 footer_2 footer_5 footer-main').addClass('footer_4').slideDown();
						body.animate({ scrollTop : $(document).height() });
					});
				break;
				case "Footer 5" : 
					h.load('inc/footer_5.html',function(){
						$(this).removeClass('footer_3 footer_4 footer_2 footer-main').addClass('footer_5').slideDown();
						body.animate({ scrollTop : $(document).height() });
						window.footer_slider();
					});
				break;
				case "Footer 6" : 
					h.load('inc/footer_6.html',function(){
						$(this).removeClass('footer_3 footer_4 footer_5 footer-main footer_2').slideDown();
						body.animate({ scrollTop : $(document).height() });
						window.tweet_slider();
						window.flickr_list();
					});
				break;
			}
		});

	});

	bgSelect.prev('.select_list').on('click','li',function(){
		var val = $(this).text();

		switch(val){

			case "Image" : 
				color.slideUp(function(){
					image.slideDown();
				});
			break;

			case "Color" : 
				image.slideUp(function(){
					color.slideDown();
				});
			break;

		}

	});
	bgImagebutton.each(function(){
		$(this).css('background-image','url('+$(this).data('image')+')');
	});

	bgImagebutton.on('click',function(){
		var bg = $(this).data('image');
		$('body').css('backgroundImage','url('+bg+')');
	});

	reset.on('click',function(){
		var h = $('header.header')

		$('body,#select_color').css({
			'backgroundImage' : 'none',
			'backgroundColor' : '#e2e2e2'
		});

		if(!(sw.find('.homepage').length)){
			layout.removeClass('boxed_layout').addClass('wide_layout');
			sw.find('[data-layout]').removeClass('active').first().addClass('active');
		}

		image.slideUp(function(){
			color.slideDown();
		});

		bgSelect.prevAll(".select_title").text('Color');
		bgSelect.prev('.select_list').children('li').removeClass('active').first().addClass('active');

		
		if(hSelect.prevAll(".select_title").text() !== "Header 1"){
			hSelect.prevAll(".select_title").text('Header 1');
			hSelect.prev('.select_list').children('li').removeClass('active').first().addClass('active');
			h.slideUp(function(){
				$(this).html("");
				h.load('inc/header_1.html',function(){
					$(this).removeClass('header_2 header_3 header_4 header_5 extra').addClass('header_1').slideDown();
					window.rmenu();
					window.search_holder();
				});
			});
		}

	});

	
});