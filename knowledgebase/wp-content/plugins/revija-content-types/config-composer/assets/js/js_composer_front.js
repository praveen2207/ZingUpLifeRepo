(function ($) {

	/*	Parallax											*/
	/* ---------------------------------------------------- */

	$.fn.mad_parallax_bg_image = function (xpos, speed) {
		var top, pos;
		return this.each(function (idx, value) {
			var $this = $(value);

			if (arguments.length < 1 || xpos === null)  {
				xpos = "55%";
			}
			if (arguments.length < 2 || speed === null) {
				speed = 0.6;
			}

			var methods = {
				update: function() {
					top = $this.offset().top;
					pos = $(window).scrollTop();
					$this.css('backgroundPosition', xpos + " " + Math.round((top - pos) * speed) + "px");
				},
				init: function() {
					var base = this;
					base.update();
					$(window).on('scroll', base.update);
				}
			};
			methods.init();
		});
	};

	/*	DOM READY															*/
	/* -------------------------------------------------------------------- */

	$(function () {

		/*	Init Parallax	BG Image							*/
		/* ---------------------------------------------------- */

		if (!Modernizr.touch) {
			if ($('.bg-section-image').length) {
				$('.bg-section-image').mad_parallax_bg_image('center', 0.4);
			}
		}

		/*	Product Brands Carousel											  */
		/* ------------------------------------------------------------------ */

		(function () {

			var $mad_product_brands = $('.product-brands');

			if ($mad_product_brands.length) {

				$mad_product_brands.each(function () {

					var $this = $(this);

					var ifNoSidebar = $this.closest('.no_sidebar').length,
						ifColHalf = $this.closest('.vc_col-sm-6').length,
						items;

					if (ifNoSidebar) {
						items = [[1199,6],[992,5],[768,4],[480,3],[300,2]];
						if (ifColHalf) {
							items = [[1199,3],[992,2],[768,2],[480,2],[300,2]];
						}
					} else {
						items = [[1199,4],[992,4],[768,3],[480,2],[300,2]];
						if (ifColHalf) {
							items = [[1199,2],[992,2],[768,2],[480,2],[300,1]];
						}
					}

					$this.owlCarousel({
						itemsCustom : items,
						autoPlay: $this.data('autoplay') == true ? $this.data('autoplaytimeout') : false,
						stopOnHover : true,
						slideSpeed : 600,
						autoHeight : true,

						// Navigation
						navigation : true,

						// Pagination
						pagination : false,
						theme : "owl-tm-theme"

					});

				});
			}

		})();

		/*	Blog Carousel													  */
		/* ------------------------------------------------------------------ */

		(function () {

			var $mad_post_slider = $('.post-carousel'),
				items = $mad_post_slider.data('items') || 1;

			var mad_post_slider_set = {
				autoPlay : false,
				stopOnHover : true,
				slideSpeed : 600,
				autoHeight : true,

				// Navigation
				navigation : true,

				// Pagination
				pagination : false,
				theme : "owl-tm-theme"
			},

			customItems = [
				[1199, items],
				[992, items],
				[768, 1],
				[480, 1],
				[300, 1]
			];

			if (items == 1) {
				mad_post_slider_set.singleItem = true;
			} else {
				mad_post_slider_set.itemsCustom = customItems;
			}

			if ($mad_post_slider.length) {
				$mad_post_slider.each(function () {
					var $this = $(this);
						$this.owlCarousel(mad_post_slider_set);
				});
			}

		})();

		/*	Testimonials													  */
		/* ------------------------------------------------------------------ */

		(function () {

			var $mad_tm_slider = $('.tm-slider');

			if ($mad_tm_slider.length) {
				$mad_tm_slider.each(function () {
					var $this = $(this);

					$this.owlCarousel({
						items : 1,
						autoPlay: $this.data('autoplay') == true ? $this.data('autoplaytimeout') : false,
						stopOnHover : true,
						slideSpeed : 1000,
						autoHeight : true,

						// Navigation
						  navigation : true, // Show next and prev buttons
						  nav : true,
						  loop:true,
						  navSpeed: 800,
						  navText:false
					});
				});
			}

		})();

		/*	 Portfolio Carousel												  */
		/* ------------------------------------------------------------------ */

		(function () {

			var $mad_portfolio_carousel = $('.portfolio-carousel');

			if ($mad_portfolio_carousel.length) {
				$mad_portfolio_carousel.each(function () {
					$(this).owlCarousel({
						items: 3,
						theme: 'owl-tm-theme',

						//Autoplay
						autoPlay : false,
						slideSpeed : 1000,
						autoHeight : true,
						stopOnHover : true,

						// Navigation
						navigation : true,
						rewindNav : true,
						scrollPerPage : false,

						//Pagination
						pagination : false,
						paginationNumbers: false
					});
				});
			}

		})();

		/*	Images Carousel												  	  */
		/* ------------------------------------------------------------------ */

		(function () {

			var $mad_images_carousel = $('.images-carousel');

			if ($mad_images_carousel.length) {
				$mad_images_carousel.each(function () {
					var $this = $(this);

					var ifNoSidebar = $this.closest('.no_sidebar').length,
						ifColHalf = $this.closest('.vc_col-sm-6').length,
						items;

					if (ifNoSidebar) {
						items = [[1199,3],[992,3],[768,2],[480,1],[300,1]];
						if (ifColHalf) {
							items = [[1199,2],[992,2],[768,2],[480,1],[300,1]];
						}
					} else {
						items = [[1199,2],[992,2],[768,2],[480,1],[300,1]];
						if (ifColHalf) {
							items = [[1199,1],[992,1],[768,1],[480,1],[300,1]];
						}
					}

					$this.owlCarousel({
						itemsCustom: items,
						theme: 'owl-tm-theme',

						//Autoplay
						autoPlay: $this.data('autoplay') == true ? $this.data('autoplaytimeout') : false,
						autoHeight : true,
						stopOnHover : true,

						// Navigation
						navigation : true,
						rewindNav : true,
						scrollPerPage : false,

						//Pagination
						pagination : false,
						paginationNumbers: false
					});

				});
			}

		})();

	});

	/*	Load															    */
	/* -------------------------------------------------------------------- */

	$(window).load(function () {
	
		/*	Isotope															  */
		/* ------------------------------------------------------------------ */

		(function () {

			/*	Portfolio														  */
			/* ------------------------------------------------------------------ */

			var $mad_portfolio = $('.portfolio-isotope');

			if ($mad_portfolio.length) {
				var $mode = $mad_portfolio.attr('data-layout-type'),
					$masonryBase = {};
				if ($mode == 'masonry') {
					$masonryBase = { 'columnWidth': 10, 'qutter': 0 }
				}

				$mad_portfolio.isotope({
					itemSelector : '.portfolio-item',
					layoutMode : $mode,
					masonry: $masonryBase
				});

				$('.section-line .heapOptions a', $mad_portfolio.parent()).on('click', function () {
					var $this = $(this), selector = $this.attr('rel');
					$mad_portfolio.isotope({ filter: selector });
				});
			}

		})();

	});

})(jQuery);