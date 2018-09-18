(function ($) {

	$.mad_woocommerce_mod = $.mad_woocommerce_mod || {};

	
	
	/*	Raty
	/* --------------------------------------------- */

	 $.mad_woocommerce_mod.raty = function () {

		 if ($('.rating').length) {
			 // Read Only
			 $('.rating.readonly-rating').raty({
				 readOnly: true,
				 //path: global.paththeme + '/images/img',
				 starType : 'i', 
				 score: function() {
					 return $(this).attr('data-score');
				 }
			 });

			 // Rate
			 $('.rating.rate').raty({
				 //path: global.paththeme + '/images/img',
				 starType : 'i', 
				 score: function() {
					 return $(this).attr('data-score');
				 }
			 });
		 }

	 }



	/*	Cart Dropdown
	/* --------------------------------------------- */

	$.mad_woocommerce_mod.cartDropdown = function () {
		({
			init: function () {
				var base = this;

				base.support = {
					touch : Modernizr.touch,
					transitions : Modernizr.csstransitions
				};
				base.eventtype = base.support.touch ? 'touchstart' : 'click';

				var transEndEventNames = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'OTransition': 'oTransitionEnd',
					'msTransition': 'MSTransitionEnd',
					'transition': 'transitionend'
				};
				base.transEndEventName = transEndEventNames[Modernizr.prefixed( 'transition' )];
				base.clicked_product = {};
				base.add_buttons();
				base.listeners();
			},
			add_buttons: function () {
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" id="add1" class="plus" />' ).prepend( '<input type="button" value="-" id="minus1" class="minus" />' );
			},
			track_ajax_add_to_cart: function () {
				var base = this, product = {};

				$('body').on(base.eventtype, '.add_to_cart_button', function () {
					var $this = $(this), product = {},
						productContainer = $this.parents('.product').eq(0);
						product.name  = productContainer.find('h3 a').text();
						product.image = productContainer.find('.thumbnail-container img');
						product.price = productContainer.find('.price .amount').last().text();

					$this.block({
						message: null,
						overlayCSS: {
							background: '#fff url(' + woocommerce_params.ajax_loader_url + ') no-repeat center',
							backgroundSize: '16px 16px',
							opacity: 0.6
						}}
					);

					if (product.image.length) {
						product.image = "<img class='added-product-image' src='" + product.image.get(0).src + "' />";
					}
					base.clicked_product = product;
				});
			},
			update_cart_dropdown: function (event) {

				var base = this,
					cart 	  = $('.cart-dropdown'),
					msg	 	  = cart.data('text'),
					product   = base.clicked_product;

				if (typeof event != 'undefined') {

					var template = $("<li class='cart-notification'><div class='added-product-text'><strong>"+ product.name + "</strong> " + msg + "</div> "+ product.image +"</li>");

					template.on('mouseenter template_hide', function () {
						var $this = $(this);

						setTimeout( function() {
							$this.removeClass('visible-cart');
						}, 100);
						var onEndTransitionFn = function () {
							$this.remove();
						};
						if (base.support.transitions) {
							$this.on( base.transEndEventName, onEndTransitionFn );
						} else {
							onEndTransitionFn();
						}
					}).prependTo(cart);

					setTimeout(function () {
						template.addClass('visible-cart');
					}, 50);

					setTimeout(function () {
						template.trigger('template_hide');
					}, 2500);
				}

			},
			listeners: function () {
				var base = this;
					base.track_ajax_add_to_cart();

				$('body')
					.on('added_to_cart', $.proxy(function (e, fragments) {
						$('.add_to_cart_button').unblock();

						$('.shopping-button .count').html(fragments.count);
						$('.shopping-button .amount').html(fragments.subtotal);

						base.update_cart_dropdown(e);
				}, base))
					.on(base.eventtype, '.cart_list .remove-item', function () {
						$(this).closest('li').animate({ 'opacity' : 0 }, function () {
							$(this).slideUp(400);
						});
					});

				$( document ).on( 'click', '.plus, .minus', function() {

					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );

					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
					if ( max === '' || max === 'NaN' ) max = '';
					if ( min === '' || min === 'NaN' ) min = 0;
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

					// Change the value
					if ( $( this ).is( '.plus' ) ) {
						if ( max && ( max == currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
					} else {
						if ( min && ( min == currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
					}

					// Trigger change event
					$qty.trigger( 'change' );
				});

			}
		}.init());
	}

	$.fn.css3Dropdown = function () {
		return $(this).on('click', function (e) {
			var dropdown = $(this).next();
			$(this).toggleClass('active');
			e.preventDefault();

			if (dropdown.children('ul').children('li').length) {
				if (dropdown.hasClass('opened')) {
					dropdown.removeClass('opened').addClass('closed');
					setTimeout(function(){
						dropdown.removeClass('closed')
					},500);
				} else {
					dropdown.addClass('opened');
				}
			}
		});
	}

	

	/*	DOM READY
	/* --------------------------------------------- */

	$(function () {
		
		
		
		
		
		
		
		
		
		
		$.mad_woocommerce_mod.raty();
		
		
		if($('#thumbnails').length){
		    $('#thumbnails').owlCarousel({
		      items : 3,
	    	  stagePadding : 40,
		      margin : 10,
		      URLhashListener : false,
		      navSpeed : 800,
		      nav : true,
		      navText:false,
		      responsive : {
			      "0" : {
			       "items" : 4
			      },
			      "481" : {
			       "items" : 3
			      },
			      "769" : {
			       "items" : 3
			      },
			      "992" : {
			       "items" : 3
			      }
		      }
		    });
		}

		
		
		
		
		
		var mad_get_gallery_list = function () {

			var gallerylist = [],
				gallery = 'product_carousel';

			$('.' + gallery + ' a').each(function () {

				var img_src = '';

				if ($(this).data("zoom-image")) {
					img_src = $(this).data("zoom-image");
				} else if($(this).data("image")){
					img_src = $(this).data("image");
				}

				if (img_src) {
					gallerylist.push({
						href: '' + img_src + '',
						title: $(this).find('img').attr("title")
					});
				}

			});

			return gallerylist;

		}

		
		
		
		//elevate zoom
		if($('[data-zoom-image]').length){

				var zoomWindowPosition = 1;
				if ($('body').hasClass('rtl')) {
					zoomWindowPosition = 10;
				}
				
				var $button = $('.jackboxInit'), data = '';
			
			if ($('#zoom_image').length) {
				
				var zs = $("#zoom_image").elevateZoom({
				gallery: 'thumbnails',
				galleryActiveClass: 'active',
				zoomType: "inner",
				cursor: "crosshair",
				responsive:true,
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 500,
				easing:true,
				lensFadeIn: 500,
				lensFadeOut: 500
				});
				
				
				ez = zs.data('elevateZoom'),
				data = ez.getGalleryList();
			}
			
				
				
				
			if (data.length) {

				if (data.length == 1) {

					var href_value = data[0].href;

					$button.attr({
						'href' : href_value,
						'data-group' : 'images'
					});

					$.jackBox.available(function() {
						$button.jackBox('newItem');
					});

					$button.jackBox("init", {
						dynamic: true,
						baseName: global.template_directory + 'js/jackbox'
					});

				} else {

					$.each(data, function (id, val) {

						if (id == 0) {
							$button.attr({
								'href' : val.href,
								'data-group' : 'images'
							});
							return;
						}

						var $link = $('<a>', {
							'data-group': 'images',
							'class': 'jackboxInit',
							'href' : val.href
						}), $inlink = $link.appendTo($button);

						$.jackBox.available(function () {
							$button.jackBox('newItem');
							$inlink.jackBox('newItem');
						});

						$button.jackBox("init", {
							dynamic: true,
							baseName: global.template_directory + 'js/jackbox'
						});

					});

				}

			} else {

				if ($('.product_carousel').length) {

					var data = mad_get_gallery_list();

					if (data) {

						$.each(data, function (id, val) {

							if (id == 0) {
								$button.attr({
									'href' : val.href,
									'data-group' : 'images'
								});
								return;
							}

							var $link = $('<a>', {
								'data-group': 'images',
								'class': 'jackboxInit',
								'href' : val.href
							}), $inlink = $link.appendTo($button);

							$.jackBox.available(function () {
								$button.jackBox('newItem');
								$inlink.jackBox('newItem');
							});

							$button.jackBox("init", {
								dynamic: true,
								baseName: global.template_directory + 'js/jackbox'
							});

						});

					}

				} else {

					$button.jackBox("init", {
						baseName: global.template_directory + 'js/jackbox',
						className: ".jackboxInit"
					});

				}

			}
			
			
			
			
			
			
			
			
			
			
			
		}

		
		
		
		
		// Quantity

		var q = $('.quantity');

		q.each(function(){
			var $this = $(this),
				button = $this.children('button'),
				input = $this.children('input[type="number"]'),
				val = +input.val();

			button.on('click',function(e){
				e.preventDefault();
				if($(this).hasClass('minus')){
					if(val === 1) return false;
					input.val(--val);
				}
				else{
					input.val(++val);
				}
			});
		});
		
		
		
	});

})(jQuery);
