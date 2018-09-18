
$(document).ready(function () {
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
});

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

$(document).ready(function(){
	//var base_url = 'http://localhost/zinguplife_svn/';
var base_url = 'http://design1.nuvodev.com/client/zingup_anitha/';
//var base_url = 'http://zinguplife.com/';

$('body').on('click', '.edit-photo', function (e) {
	   $('.uploadBtn').hide();
      $('#upload_sme_photo_btn').show();
	});
	
	$('body').on('click', '#upload_sme_photo_btn', function (e) {
	   $('.uploadBtn').show();
      $('#upload_sme_photo_btn').hide();
	});
		//$('.askquestion_popup').attr('data-target','');
	
	/* $('body').on('click', '.askquestion_popup', function (e) {
	 e.preventDefault();
		 $.ajax({
            type: 'POST',
            url: base_url +'experts/check_userlogin',
            data: {},
            dataType: "json",
            success: function (data) {
					if(data['is_logged_in'] == ''){
					$('.askquestion_popup').attr('data-target','.loginpopup');
				}
				else{
						$('.askquestion_popup').attr('data-target','.askquestion');
						}
					}
			});
			
    });*/
    
    
 /*$('body').on('click', '.bookcall_popup', function (e) {
	 e.preventDefault();
		 $.ajax({
            type: 'POST',
            url: base_url +'experts/check_userlogin',
            data: {},
            dataType: "json",
            success: function (data) {
            	if(data['is_logged_in'] == ''){
$('.bookcall_popup').attr('data-target','.loginpopup');
    }
    else{
    	$('.bookcall_popup').attr('data-target','.bookCall');
    	}
    	}
        });
	
    });  */  
    
   
   $('body').on('click', '#book_call', function (e) {
   		alert("1");
	   	e.preventDefault();
   	
        var date = $('#book_call_date').val();
        var id = $('#smeuserid').val();
        
        if(date != '')
        {
			$('.shor3').hide();
        	$.ajax({
            type: 'POST',
            url: base_url +'experts/get_available_dates',
            data: {date:date,id:id},
            dataType: "json",
            success: function (data) {
            	if(data != ''){
            	$('#datesdiv').hide();
            	$('#slotsdiv').show();
                        $.each(data, function (key, val) { 
                            $('#callback_time').append('<span>'+val.time_from+' to '+val.time_to+'</span><br/>' );
                        });
                        
                        }else
                        {
                        	alert('Time slot not available for selected date');
                        	}
            	}
        	
        	});
        	}
        	else{
				$('.shor3').append('<span style="color:red;margin-left:20px;">Please select a Date.</span>');
        		e.preventDefault();
        		}

    });		
       
   $('body').on('click', '#ask_question_submit', function (e) {
   	e.preventDefault();
        var smeuserid = $('#smeuserid').val();
        
        var smepackages = $("input[name=package]:checked").val();
      var  smepackage = smepackages.split(",");
      var sme_amt = smepackage[1];
      
        if(sme_amt !== ''){
            
            $.ajax({
            type: 'POST',
            url: base_url +'experts/insert_session_amount',
            data: {sme_amt:sme_amt,smeuserid : smeuserid},
            dataType: "json",
            success: function (data) {
                  //  $('.askquestion').fadeOut();
          // $('.modal-backdrop').removeClass("in");
            var url =  base_url+"experts/checkout";
           window.location.href = url;      
            
            }
        	});
            
            
         
        }
else{
		$('.shor').append('<span style="color:red;margin-left:20px;">This field is required</span>');
	  e.preventDefault();
	}

    });    
    	
    
	/*
   $('body').on('click', '#ask_question', function (e) {
	  
	   $('.error').empty();
        var question = $('#questionsEnter').val();
        var smeuserid = $('#smeuserid').val();
        var userid = $('#userid').val();
		var trans = $('#transactionid').val();
        if(question != ''){
			$('.shor').hide();
        $.ajax({
            type: 'POST',
            url: base_url + 'experts/getpackages',
            data: {question: question,smeuserid:smeuserid, userid:userid,trans:trans},
            dataType: "json",
            success: function (data) {
				
				var len = Object.keys(data).length;
			
				if(len !=0)
				{
					$('#askquestion').hide();
					$('#smepacakges').show();
                        $.each(data, function (key, val) {  
                            $('.smepacakges').append('<div class="smepackages_div"><input type="radio" name="package" value="'+val.name+','+val.amount+','+val.max_number_of_questions+'"><p><b>'+val.name+'</b></p>\n\
                            <p class="package_amount">&#8377;'+val.amount+'</p>\n\
                            <p>Maximum questions:'+val.max_number_of_questions+'</p>\n\
                             <\div>' );
                        });
					$('.error').hide();
					$('.smebutn').show();
				}
				else
				{
					$('#askquestion').hide();
					$('#smepacakges').show();
					$('.smebutn').hide();
					$('.close-bt').show();
					$('#smepacakges .smepacakges').append('<p>Question is submitted succesfully.</p>');
				}
            }
        });
        }
	else{
		
		$('.shor').append('<span style="color:red;margin-left:20px;">This field is required</span>');
		$('.shor').show();
		e.preventDefault();
	  
	}

    });	*/
	
	  $('body').on('click', '#ask_question', function (e) {
	  
	   $('.error').empty();
        var question = $('#questionsEnter').val();
        var smeuserid = $('#smeuserid').val();
        var userid = $('#userid').val();
		var trans = $('#transactionid').val();
        if(question != ''){
			$('.shor').hide();
        $.ajax({
            type: 'POST',
            url: base_url + 'experts/getpackages',
            data: {question: question,smeuserid:smeuserid, userid:userid,trans:trans},
            dataType: "json",
            success: function (data) {
				
				var len = Object.keys(data).length;
			
				if(len !=0)
				{
					$('#askquestion').hide();
					$('#smepacakges').show();
                        $.each(data, function (key, val) {  
                            $('.smepacakges').append('<div class="smepackages_div"><input type="radio" name="package" value="'+val.name+','+val.amount+','+val.max_number_of_questions+'"><p><b>'+val.name+'</b></p>\n\
                            <p class="package_amount">&#8377;'+val.amount+'</p>\n\
                            <p>Maximum questions:'+val.max_number_of_questions+'</p>\n\
                             <\div>' );
                        });
					$('.error').hide();
					$('.smebutn').show();
				}
				else
				{
					$('#askquestion').hide();
					$('#smepacakges').show();
					$('.smebutn').hide();
					$('.close-bt').show();
					$('#smepacakges .smepacakges').append('<p>Question is submitted succesfully.</p>');
				}
            }
        });
        }
	else{
		
		$('.shor').append('<span style="color:red;margin-left:20px;">This field is required</span>');
		$('.shor').show();
		e.preventDefault();
	  
	}

    });
	
	$('.grey-btn').click(function(){
		$('#askquestion').show();
		$('.close-bt').hide();
		$('.smebutn').hide();
		$('.smepacakges').empty();
		$('.questionsEnter').val('');
		$('.askquestion').modal('hide');
	});
	$('.close-bt').click(function(){
		$('#askquestion').show();
		$('.close-bt').hide();
		$('.smepacakges').empty();
		$('.questionsEnter').val('');
		$('.askquestion').modal('hide');
	});
    
/*$('body').on('click', '#book_call_submit', function (e) {
	 e.preventDefault();
        var date = $('#book_call_date').val();
        var id = $('#smeuserid').val();
        var time = $('#callback_time').text();
        if(time !=''){
        	 $.ajax({
            type: 'POST',
            url: base_url + 'experts/user_booked_calls',
            data: {date: date,id:id,time:time},
            dataType: "json",
            success: function (data) {
              if(data == true )
              {
              	$('#slotsdiv').empty();
              	$('#slotsdiv').append('<p>You Have Succesfully Booked A Call </p>\n\
              	                       <a href="" class="btn grey-btn">Close</a>\n\
              	                     ');
              	}
            }
        });
        	
        }
else{
	  e.preventDefault();
	}

    });	*/
    
    
    $('body').on('click', '#book_call_submit', function (e) {
	 e.preventDefault();
        var date = $('#book_call_date').val();
        var id = $('#smeuserid').val();
        var time = $('#callback_time').text();
        $('.packdate').val(date);
		$('.packtime').val(time);
        if(time !='')
        {
        	 $.ajax({
				type: 'POST',
				//url: base_url + 'experts/user_booked_calls',
				url: base_url + 'experts/get_pay_packages',
				data: {date: date,id:id,time:time},
				dataType: "json",
				success: function (data) {
				  if(data)
				  {
					$('#slotsdiv .ne').empty();
					
					/*$('#slotsdiv').append('<p>You Have Succesfully Booked A Call </p>\n\
										   <a href="" class="btn grey-btn">Close</a>\n\
										 ');*/
                        $.each(data, function (key, val) {  
                            $('#slotsdiv .ne').append('<div class="smepackages_div"><input type="radio" name="paypackage" value="'+val.name+','+val.amount+','+val.max_number_of_questions+'"><p><b>'+val.name+'</b></p>\n\
                            <p class="package_amount">&#8377;'+val.amount+'</p>\n\
                            <p>Validity:'+val.type+'</p>\n\
                             <\div>' );
                             $('.smebutn2').show();
                             
                        });				 
										 
					}
				}
			});
        	
        }
		else
		{
		  e.preventDefault();
		}

    });
    
    $('body').on('click', '#ask_question_submit2', function (e) {
   	e.preventDefault();
        var smeuserid = $('#smeuserid').val();
        
        var smepackages = $("input[name=paypackage]:checked").val();
      var  smepackage = smepackages.split(",");
      var sme_amt2 = smepackage[1];
      var date = $('.packdate').val();
	var time = $('.packtime').val();
        if(sme_amt2 !== ''){
            
            $.ajax({
            type: 'POST',
            url: base_url +'experts/insert_paysession_amount',
            data: {sme_amt2:sme_amt2,smeuserid : smeuserid,date:date,time:time},
            dataType: "json",
            success: function (data) {
					  //  $('.askquestion').fadeOut();
			  // $('.modal-backdrop').removeClass("in");
				var url =  base_url+"experts/payment_checkout";
			  window.location.href = url;      
				
				}
        	});
            
            
         
        }
else{
		$('.shor').append('<span style="color:red;margin-left:20px;">This field is required</span>');
	  e.preventDefault();
	}

    });  
    
     
 $('body').on('click', '#questions_search', function (e) {
        var question = $('#zingInputCity').val();
        var smeuserid = $('#smeuserid').val();
        if(question != ''){
        $.ajax({
            type: 'POST',
            url: base_url + 'experts/getquestions',
            data: {question: question,smeuserid:smeuserid},
            dataType: "json",
            success: function (data) {
            $('#smequestions').empty();
            $('#smequestions').append(data);
            }
        });
        }
else{
	  e.preventDefault();
	}

    });	
    
    
 $('body').on('click', '#answer_reply_submit', function (e) {
 	
	  var answer = $('#answer').val();
	  var quesid = $('#quesid').val();
	  var userid = $('#userid').val();
		 $.ajax({
            type: 'POST',
            url: base_url +'experts/insert_sme_reply',
            data: {answer:answer,quesid:quesid,userid:userid},
            dataType: "json",
            success: function (data) {
            	
            	$('.textareaBox').prepend(answer);
            	$('.textareaBox').prev().removeClass('borderNone');
            	
    	    }
        });
	
    });   
    
    
    
    $('body').on('click', '#add_sme_event', function (e) {
 	    
	$( "#sme_add_event" ).submit();
    
    }); 
    
    $('body').on('click', '#add_sme_article', function (e) {
 	    
	$( "#sme_add_article" ).submit();
    
    });  
    
    
    $("#sme_add_article").on("submit", function(e){	
 	    
	  var article_title = $('#article_title').val();
	  var article_image = $('#article_image').val();
	  var article_description = $('#article_description').val();
	  
	  if(article_title == ''){
	  	 e.preventDefault();
	  	 $('#sme_article_title').show();
	  	}else{
	  		$('#sme_article_title').hide();
	  		}
	  		
	  		  if(article_image == ''){
	  	 e.preventDefault();
	  	 $('#sme_article_image').show();
	  	}else{
	  		$('#sme_article_image').hide();
	  		}
	  		
	  		 if(article_description == ''){
	  	 e.preventDefault();
	  	 $('#sme_article_description').show();
	  	}else{
	  		$('#sme_article_description').hide();
	  		}
	  		
	  		
	  	
    });  
        
    
    
       $("#sme_add_event").on("submit", function(e){	
 	    
	  var event_title = $('#event_title').val();
	  var event_description = $('#event_description').val();
	  var event_address = $('#event_address').val();
	  var event_photo = $('#event_photo').val();
	  var start_date = $('#start_date').val();
	  var end_date = $('#end_date').val();
	  var event_starttime = $('#event_starttime').val();
	  var event_endtime = $('#event_endtime').val();
	  
	  if(event_title == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_title').show();
	  	}else{
	  		$('#sme_event_title').hide();
	  		}
	  		
	  		  if(event_description == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_descrp').show();
	  	}else{
	  		$('#sme_event_descrp').hide();
	  		}
	  		
	  		 if(event_address == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_address').show();
	  	}else{
	  		$('#sme_event_address').hide();
	  		}
	  		
	  		
	  		 if(event_photo == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_photo').show();
	  	}else{
	  		$('#sme_event_photo').hide();
	  		}
	  		
	  		 if(start_date == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_startdate').show();
	  	}else{
	  		$('#sme_event_startdate').hide();
	  		}
	  		
	  		
	  		 if(end_date == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_enddate').show();
	  	}else{
	  		$('#sme_event_enddate').hide();
	  		}
	  		
	  		 if(event_starttime == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_starttime').show();
	  	}else{
	  		$('#sme_event_starttime').hide();
	  		}
	  		
	  		if(event_endtime == ''){
	  	 e.preventDefault();
	  	 $('#sme_event_endtime').show();
	  	}else{
	  		$('#sme_event_endtime').hide();
	  		}
    
    });  
        
    
        
  	
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
       // $("input[id='my_file']").click();
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


