
$(document).ready(function () {
	
	var url2 = $('.url').val();
	$('.country_arrow').click(function()
	{
		if($('.country').css('display') == 'none')
		{
			$('.country').show();
		}
		else
		{
			$('.country').hide();
		}
	});
	
	
	$('.country li').click(function(){
		$('.city_left').empty();
		var img = $(this).html();
		var val = $(this).attr('value');
		$('.add_country .couny').html(img);
		$('.add_country').attr('value',val);
		$.ajax({
				type: "POST",
				url: url2 + 'locations/set_country',
				dataType: "json",
				data: {country:val},
				success: function (data) {
					$('.city_left').append(data);
				}
			});
			$('.country').hide();
		});

		
	
	
	
    $(".btnProfile_Edit").click(function () {
        //console.log("demo");    
        $(".basic_span").toggle();
        $(".basic_Input").toggle();
        $(".dasInput").toggleClass("top_pd_none");
        $(".editBS").toggleClass("edit02");
        $(".save_btn01").toggleClass("save_btn02");
    });


    $(".Subscriptions_Edit").click(function () {
        $(".basic_span01").toggle();
        $(".basic_Input01").toggle();
        $(".dasInput01").toggleClass("top_pd_none");
        $(".edit001").toggleClass("edit002");
        $(".save_btn001").toggleClass("save_btn002");
    });

    $(".textarea_Edit").click(function () {
        $(".textarea_info").toggle();
        $(".textarea_info01").toggle();
        $(".top_pd").toggleClass("top_pd_none");
        $(".edit0001").toggleClass("edit0002");
        $(".save_btn0001").toggleClass("save_btn0002");
    });
});
// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function ($, window) {
    var Starrr;

    Starrr = (function () {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function (e, value) {
            }
        };

        function Starrr($el, options) {
            var i, _, _ref,
                    _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'i', function (e) {
                return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function () {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'i', function (e) {
                return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function () {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<i class='glyphicon glyphicon-star empty'></i>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function (rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function (rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('i').eq(i).removeClass('glyphicon glyphicon-star empty').addClass('glyphicon glyphicon-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('i').eq(i).removeClass('glyphicon glyphicon-star').addClass('glyphicon glyphicon-star empty');
                }
            }
            if (!rating) {
                return this.$el.find('i').removeClass('glyphicon glyphicon-star').addClass('glyphicon glyphicon-star empty');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function () {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function () {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function () {
    return $(".starrr").starrr();
});

$(document).ready(function () {

    $('#stars').on('starrr:change', function (e, value) {
        $('#count').html(value);
    });

    $('#stars-existing').on('starrr:change', function (e, value) {
        $('#count-existing').html(value);
    });
});

// slide box use services 

$('.button-read-more').click(function () {
    $(this).closest('.less').addClass('active');
    $(this).closest(".less").prev().stop(true).slideDown();
    $(".addressLoc").slideToggle("hide");
    $(".less.active>.ShareBox").slideToggle("hide");

});
$('.button-read-less').click(function () {
    $(this).closest('.less').removeClass('active');
    $(this).closest(".less").prev().stop(true).slideUp();
    $(".addressLoc").slideToggle("show");
    $(".less>.ShareBox").slideToggle("show");
});

//hide "see less" button
$(".less-button").hide();
$(".more-button").click(function () {
    $(this).hide();
    $(this).siblings(".less-button").show();
});
$(".less-button").click(function () {
    $(this).hide();
    $(this).siblings(".more-button").show();
});

$(".timeBtn").click(function () {
    $(this).toggleClass("timeAcitve");
});

// carousel js use this mobile size
$('.carousel[data-type="multi"] .item').each(function () {
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < 2; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }

	
	//localization script

$(document).ready(function () {
	var url2 = $('.url').val();
	$('.country_arrow').click(function()
	{
		if($('.country').css('display') == 'none')
		{
			$('.country').show();
		}
		else
		{
			$('.country').hide();
		}
	});
	
	
	$('.country li').click(function(){
		$('.city_left').empty();
		var img = $(this).html();
		var val = $(this).attr('value');
		$('.add_country .couny').html(img);
		$('.add_country').attr('value',val);
		$.ajax({
				type: "POST",
				url: url2 + 'locations/set_country',
				dataType: "json",
				data: {country:val},
				success: function (data) {
					$('.city_left').append(data);
				}
			});
			$('.country').hide();
		});
	  });	
		
	$('body').on('click','.sear_city',function(){	
		var city = $(this).prev().val();
		
		if(city != '')
		{
			$('input[name=locations]').val(city);
			$('.city_search').hide();
			$('.city').text(city);
			$.ajax({
				type: "POST",
				url: url2 + 'locations/set_city',
				dataType: "json",
				data: {city:city},
				success: function (data) {

				}
			});
		}
	});
	
	$('body').on('click','.city',function (){	
		if($('.city_search').css('display') == 'none')
		{
			$('.city_search').show();
		}
		else
		{
			$('.city_search').hide();
		}
	});
	
	$('body').on('click','.all',function (){
		var city = 'all';
	
		$('input[name=locations]').val(city);
			$('.city_search').hide();
			$('.city').text(city);
			$.ajax({
				type: "POST",
				url: url2 + 'locations/set_city',
				dataType: "json",
				data: {city:city},
				success: function (data) {

				}
			});
	});
});

toggleNotificationBlock = function(isLoggedIn){
    if($('#notifications_block').is(':visible') === true){
        $('#notifications_block').hide();
    }
    else{
        $('#notifications_block').show();
        //getNotiicationForLoggedInUser();
    }
}; 

getNotiicationForLoggedInUser = function(){
    var base_url = 'http://localhost/zingup/';
    var notificationsHTML = '';
    var isNotificationPresent = parseInt($('#notification_content').val());
    if(!isNotificationPresent){
     $.ajax({
                type: 'POST',
                url: base_url + 'users/notifications',
                dataType: "json",
                success: function (notificationsData) {
                    $('#notifications_block .ajax-loader').hide();
                    if(notificationsData.length > 0){
                        $.each(notificationsData, function(key,notificationData){
                            notificationsHTML += '<a href="'+notificationData.url+'" target = "_blank">'+'<div class="notify">'+notificationData.notification+'</div></a>';
                        });
                        
                        $('#notification_count').html(notificationsData.length).show();
                    }
                    else{
                        notificationsHTML = '<div class="txt_center" style="margin-top:20px;">No new notification for you.</div>';
                        //$('#notification_count').html(notificationsData.length).hide();
                    }
                    $('#notifications_area').html(notificationsHTML);
                    $('#notification_content').val(1);

                }
       }); 
    }
};

if(isLoggedIn){
    getNotiicationForLoggedInUser();    
}
else{
    $('#notifications_block .ajax-loader').hide();
    var base_url = 'http://localhost/zingup/';
    var notificationsHTML = '<div class="txt_center" style="margin-top:20px;">Please <a style="color: #337ab7;" href="'+base_url+'login">Sign in</a> to view notifications</div>';
    $('#notifications_area').html(notificationsHTML);
}


var mouse_is_inside = false;

$(document).ready(function()
{
    $('#notifications_block').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('#notifications_block').hide();
    });
});