
	 var grid = document.querySelector('.grid');
	 var msnry;

	 imagesLoaded( grid, function() {
	 // init Isotope after all images have loaded
	 msnry = new Masonry( grid, {
	 itemSelector: '.grid-item',
	 columnWidth: '.grid-sizer',
	 percentPosition: true
	 });
	 });

//code addedfor sme module

 jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i.test(value);
    }, "please enter letters");
    jQuery.validator.addMethod("maxclength", function (value, element) {
        return this.optional(element) || /^[a-z0-9, ]{0,50}$/i.test(value);
    }, "More then 50 characters not allowed");
    jQuery.validator.addMethod("minplength", function (value, element) {
        return this.optional(element) || /^.{6,}$/i.test(value);
    }, "Password should be minimum 6 characters");
    $('#register').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            name: {lettersonly: true, maxclength: 50},
            select01: {
                required: true
            }, password: {minplength: 6
            }, check: {required: function (element) {
                    var boxes = $('.checkbox');
                    if (boxes.filter(':checked').length == 0) {
                        return true;
                    }
                    return false;
                }, minlength: 1}}, messages: {check: "Please select the checkbox."}

    });

function loadmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#offset').val()) + 5; 
    $.ajax({
			url:url2 + 'feedback/loadmore',
			data:{
			  offset :$('#offset').val(),
			  limit :$('#limit').val(),
			  sme_userid : $('.sme_userid').val()
			},
			success :function(data){
				$('#myList').append(data);
				//$("body").html(data);
				$('#offset').val(offset);
				$('#limit').val('5');
				if($("#no-more").length != 0) {
				  $('#load-more').hide();
				}
			}
		},"json");
	}
	
	function eventsviewmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#offset').val()) + 5; 
    $.ajax({
			url:url2 + 'events/loadmore',
			data:{
			  offset :$('#offset').val(),
			  limit :$('#limit').val(),
			  sme_userid : $('.sme_userid').val()
			},
			success :function(data){
				$('#myList').append(data);
				//$("body").html(data);
				$('#offset').val(offset);
				$('#limit').val('5');
				if($("#no-more").length != 0) {
				  $('#load-more').hide();
				}
			}
		},"json");
	}
	
	function smearloadmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#smearoffset').val()) + 4; 
    $.ajax({
			url:url2 + 'articles/sme_article_loadmore',
			data:{
			  offset :$('#smearoffset').val(),
			  limit :$('#smearlimit').val(),
			  sme_userid : $('.sme_userid').val()
			},
			success :function(data){
				$('#article-list').append(data);
				//$("body").html(data);
				$('#smearoffset').val(offset);
				$('#smearlimit').val('4');
				if($("#no-more").length != 0) {
				  $('.sme-ar-loadmore').hide();
				}
			}
		},"json");
	}
	
	function smefbloadmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#smefboffset').val()) + 5; 
    $.ajax({
			url:url2 + 'feedback/sme_fb_loadmore',
			data:{
			  offset :$('#smefboffset').val(),
			  limit :$('#smefblimit').val(),
			  sme_userid : $('.sme_userid').val()
			},
			success :function(data){
				$('#feedback-list').append(data);
				//$("body").html(data);
				$('#smefboffset').val(offset);
				$('#smefblimit').val('5');
				if($("#no-more").length != 0) {
				  $('.sme-fb-loadmore').hide();
				}
			}
		},"json");
	}
	
	function followersviewmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#offset').val()) + 8; 
    $.ajax({
			url:url2 + 'followers/loadmore',
			data:{
			  offset :$('#offset').val(),
			  limit :$('#limit').val(),
			  sme_userid : $('.sme_userid').val()
			},
			success :function(data){
				$('#myList').append(data);
				//$("body").html(data);
				$('#offset').val(offset);
				$('#limit').val('5');
				if($("#no-more").length != 0) {
				  $('#load-more').hide();
				}
			}
		},"json");
	}
	
	function artcommviewmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#offset').val()) + 8; 
    $.ajax({
			url:url2 + 'articles/loadmore',
			data:{
			  offset :$('#offset').val(),
			  limit :$('#limit').val(),
			  art_id : $('.art_id').val()
			},
			success :function(data){
				$('#myList').append(data);
				//$("body").html(data);
				$('#offset').val(offset);
				$('#limit').val('5');
				if($("#no-more").length != 0) {
				  $('#load-more').hide();
				}
			}
		},"json");
	}
	
	
	
	function loadmorequestions(){
	var url2 = $('.url').val();
	var type = $('.type').val();
	var offset = parseInt($('#offset').val()) + 5; 
    $.ajax({
			url:url2 + 'questions/loadmore',
			data:{
			  offset :$('#offset').val(),
			  limit :$('#limit').val(),
			  sme_userid : $('.sme_userid').val(),
			  type :  $('.type').val()
			},
			success :function(data){
				$('#myList').append(data);
				//$("body").html(data);
				$('#offset').val(offset);
				$('#limit').val('5');
				if($("#no-more").length != 0) {
				  $('#load-more').hide();
				}
			}
		},"json");
	}
	
	function loadmoresmeunansquestions(){
	var url2 = $('.url').val();
	var offset = parseInt($('#quesoffset').val()) + 8; 
    $.ajax({
			url:url2 + 'questions/loadmore_sme_unansques',
			data:{
			  offset :$('#quesoffset').val(),
			  limit :$('#queslimit').val(),
			},
			success :function(data){
				$('#question-list').append(data);
				//$("body").html(data);
				$('#quesoffset').val(offset);
				$('#queslimit').val('8');
				if($("#no-more").length != 0) {
				  $('.ques-load-more').hide();
				} 
			}
		},"json");
	}
	
	$(document).ready(function(){
	
	//code addedfor sme module
	
	
	 $.fn.raty.defaults.path = '../../images';
	$('#half').raty({
		half  : true,
		hints : [['.5', '1'], ['1.5', '2'], ['2.5', '3'], ['3.5', '4'], ['4.5', '5']],
		score: function(){
                    return $(this).attr('title');
                }
	});
	
	
	
	$('.testimonial-block').bxSlider({
		 auto: true,
		 randomStart: true,
		 infiniteLoop: true,
		 mode: 'horizontal',
		 captions: true,
		 controls: true,
		 pager: true
	});
	
	$('textarea[maxlength]').keyup(function(){  
        //get the limit from maxlength attribute  
        var limit = parseInt($(this).attr('maxlength'));  
        //get the current text inside the textarea  
        var text = $(this).val();  
        //count the number of characters in the text  
        var chars = text.length;  
  
        //check if there are more characters then allowed  
        if(chars > limit){  
            //and if there are use substr to get the text before the limit  
            var new_text = text.substr(0, limit);  
  
            //and change the current text with the new text  
            $(this).val(new_text);  
        }  
    }); 
	
	var startDate = $('.start_date').val(); // some start date
    var endDate  = $('.end_date').val();  // some end date
    var dateRange = [];     
	// array to hold the range
	// populate the array
	for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
		dateRange.push($.datepicker.formatDate('yy-mm-dd', d));
	}
	
	$( "#datepicker" ).datepicker();
	
	$( "#datepicker2" ).datepicker({
		beforeShowDay: function (date) {
			var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
			return [dateRange.indexOf(dateString) == -1];
		}
	});
	
	var maxLength = 6000;
	var maxLength2 = 600;
	
	$('#chars').keyup(function() {

		var length = $(this).val().length;
		var length = maxLength-length;
		$('#text').text(length);
	});
	
	$('#chars2').keyup(function() {

		var length = $(this).val().length;
		var length = maxLength2-length;
		$('#text2').text(length);
	});
	
	
	
	$('#myCarousel').carousel({
		interval: 4000
		});
	$('.send-ind-msg').click(function(){
			var id = $(this).attr('id');
			$('.user_id').val(id);
	});
	$('.fb-respond').click(function(){
			var id = $(this).attr('id');
			$('.fb_id').val(id);
	});
	
	$('.send-ans').click(function(){
			var id = $(this).attr('id');
			$('.ques_id').val(id);
	});
	
	$('.send-ans-email').click(function(){
			var id = $(this).attr('id');
			var uid = $(this).attr('userid');
			$('.quesid').val(id);
			$('.userid').val(uid);
	});
	
	$('.del_img').click(function(){
		var id = $(this).attr('article');
		var url = $('.url').val() + 'articles/delete_image';
		$(this).prev().hide();
		$(this).hide();
		$.ajax({
				type: "POST",
				url: url,
				data: {id : id},
				success:function(){}
			});
	});
	
	$('.del_evimg').click(function(){
		var id = $(this).attr('event');
		var url = $('.url').val() + 'events/delete_ev_image';
		$(this).prev().hide();
		$(this).hide();
		$.ajax({
				type: "POST",
				url: url,
				data: {id : id},
				success:function(){}
			});
	});
	
	
	
	$('.send-ind-email').click(function(){
			var id = $(this).attr('id');
			$('.email').val(id);
			var username = $(this).attr('name');
			$('.name').val(username);
	});
	
	$('#example').DataTable();
	$('#example2').DataTable();
	
	$('.ques').click(function(){
		if($(this).next().css('display') == 'none')
		{
			$(this).next().show();
		}
		else
		{
			$(this).next().hide();
		}
		
	});
	
	 $('.bxslider').bxSlider({
		 auto: true,
		 randomStart: true,
		 infiniteLoop: true,
		 mode: 'fade',
		 captions: false,
		 controls: false,
		 pager: false

		 });
		 $('.testimonials').bxSlider({
		 auto: true,
		 randomStart: true,
		 infiniteLoop: true,
		 mode: 'horizontal',
		 captions: true,
		 controls: false,
		 pager: true

		 });
		 
	
	//code addedfor sme module
	
	
	
    $(".nav-toggle").click(function(){
        $("#show-content").toggle();
    });
});