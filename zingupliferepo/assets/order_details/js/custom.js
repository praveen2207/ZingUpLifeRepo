
$(document).ready(function(){
    $(".btnProfile_Edit").click(function () {     
      console.log("demo");    
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
      $(".imgUpload").click(function() {
        $("input[id='my_file']").click();
      });
});
// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
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
            this.$el.on('mouseover.starrr', 'i', function(e) {
                return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'i', function(e) {
                return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<i class='glyphicon glyphicon-star empty'></i>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
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
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
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

$(function() {
    return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
    $('#count').html(value);
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
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
$(".more-button").click(function(){ 
  $(this).hide();
  $(this).siblings(".less-button").show();
});
$(".less-button").click(function(){
  $(this).hide();
  $(this).siblings(".more-button").show();
});


$(".timeBtn").click(function(){
    $( this ).toggleClass( "timeAcitve" );
});

// carousel js use this mobile size
$('.carousel[data-type="multi"] .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    
    next.children(':first-child').clone().appendTo($(this));
  }
});

