<?php $this->load->view('/includes/footer_ui');?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery.scrolling-tabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery.raty.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/experts/js/jquery.validate.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/sme/js/masonry.pkgd.js"></script>

<?php if($this->uri->segment(2) == 'verifySmeEmail2') {?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/experts/css/jquery-ui12.css"> 
	<script src="<?php echo base_url(); ?>assets/experts/js/jquery-1.12.4.js"></script>
	<script src="<?php echo base_url(); ?>assets/experts/js/jquery-ui12.js"></script>
<?php } ?>
<script>
	$( function() {
		var url      = window.location.href;  
		var lastpath = url.substr(url.lastIndexOf('/') + 1);
		if(lastpath == 'verifySmeEmail')
		{
			$( "#datepicker234" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "-100:+0", // this is the option you're looking for
			});
		}
	} );
</script>
<?php if(ONLINE_CHAT_TAWK == 'ON'){ ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/56d93e5a67d1eaa9294fe5bd/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<?php } ?>
<!--End of Tawk.to Script--> 
<script src="<?php echo base_url(); ?>assets/js/appearin-sdk.0.0.4.min.js"></script>
<script>
	function randomString(length, chars) {
		var result = '';
		for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
		return result;
	}

	$(document).ready(function(){
		var url2 = $('.url').val();
		$('.click_join_session').click(function(){
			var id = $(this).attr('id');
			var roomName = randomString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			roomName = 'Zinguplife' + roomName;
			var appearin = new AppearIn();
			var isWebRtcCompatible = appearin.isWebRtcCompatible();
			if(isWebRtcCompatible)
			{
				var video_link = 'https://appear.in/'+roomName;
				$.ajax({
					url:url2 + 'experts/update_session_link',
					type     : "POST",
					dataType : 'JSON',
					data:{id:id,roomName:roomName},
					success :function(data){
						window.open(data,'_blank');
					}
				});
			}
			else
			{
				alert('Sorry, The browser you are using is not compatible');
			}
		});
	});



</script>
<script type="text/javascript" >

	function artcommviewmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#offset').val()) + 8; 
    $.ajax({
			url:url2 + 'experts/articles_loadmore',
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
				  $('#ar_load').hide();
				}
			}
		},"json");
	}
	
function loadmorequestions(){
	var url2 = $('.url').val();
	var type = $('.type').val();
	var offset = parseInt($('#offset').val()) + 5; 
    $.ajax({
			url:url2 + 'experts/questions_loadmore',
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
				  $('.view_more').hide();
				}
			}
		},"json");
	}
	
	function smearloadmore(){
	var url2 = $('.url').val();
	var offset = parseInt($('#smearoffset').val()) + 4; 
    $.ajax({
			url:url2 + 'experts/sme_article_loadmore', 
			data:{
			  offset :$('#smearoffset').val(),
			  limit :$('#smearlimit').val(),
			  sme_userid : $('.sme_userid').val()
			},
			success :function(data){
				$('#article-list').append(data);
				$('#myList').append(data);
				$('#article-list li').show();
				//$("body").html(data);
				$('#smearoffset').val(offset);
				$('#smearlimit').val('4');
				$('.fullartlimit').val('8');
				if($("#no-more").length != 0) {
				  $('.sme-ar-loadmore').hide();
				}
			}
		},"json");
	}
 $(document).ready(function() { 

 
	
 $('.apply-coupon').click(function(){
	 $('.coupon-error').text('');
	 var coupon = $('.coupon').val();
	 var new_amt = $('.new_amout').text();
	 if(coupon == '')
	 {
		$('.coupon-error').text('Please enter Coupon Code.');
	 }
	 else{
		 $.ajax({
			 type : 'POST',
			 url : '<?php echo base_url();?>' + 'experts/apply_coupon',
			 dataType : 'JSON',
			 data : {coupon : coupon,new_amt : new_amt},
			 success : function(data){
				if(data)
				{
					if(parseInt(new_amt) > parseInt(data))
					{
						var total = parseInt(new_amt) - parseInt(data);
					}
					else
					{
						var total = 0;
					}
					$('.new_amout').text(total);
					$('.new_amt').val(total);
					$('.apply-mask').show();
				}
				else
				{
					$('.coupon-error').text("Sorry Either this gift card doesn't exists or it has expired or its full amount is used");
					$('.apply-mask').show();
				}
			 }
		 });
	 }
	 
 });
 
 $('body').on('click', '#followersviewmore', function (e) {
        var url2 = $('.url').val();
        var offset = parseInt($('#offset').val()) + 8;
        $.ajax({
            url: url2 + 'experts/followers_loadmore',
            data: {
                offset: $('#offset').val(),
                limit: $('#limit').val(),
                sme_userid: $('.sme_userid').val()
            },
            success: function (data) {
                $('#myList').append(data);
                //$("body").html(data);
                $('#offset').val(offset);
                $('#limit').val('5');
                if ($("#no-more").length != 0) {
                    $('#load-more').hide();
                }
            }
        }, "json");
    });
	
		$(".sme_register").validate({
  rules: {
   gender: { valueNotEquals: "default" },
   service : { valueNotEquals: "default" },
   dob : { required: true },
   phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
			start_date: {le: '#vac_end_datepicker'},
            end_date: {ge: '#vac_start_datepicker'},
  },
  messages: {
   gender: { valueNotEquals: "Please select an item!" },
   service: { valueNotEquals: "Please select an item!" },
   start_date: {le: 'Must be less than or equal to Vacation End Date'},
   end_date: {ge: 'Must be greater than or equal to Vacation Start Date'}
  }  
 });
 
 
 
 $("#datepicker").datepicker();
    
     /*$('textarea[maxlength]').keyup(function () {
            //get the limit from maxlength attribute  
            var limit = parseInt($(this).attr('maxlength'));
            //get the current text inside the textarea  
            var text = $(this).val();
            //count the number of characters in the text  
            var chars = text.length;

            //check if there are more characters then allowed  
            if (chars > limit) {
                //and if there are use substr to get the text before the limit  
                var new_text = text.substr(0, limit);

                //and change the current text with the new text  
                $(this).val(new_text);
            }
        });
		*/
		
		var maxLength = 6000;
        var maxLength2 = 600;
		 $('#chars').keyup(function () {

            var length = $(this).val().length;
            var length = maxLength - length;
            $('#text').text(length);
        });

        $('#chars2').keyup(function () {

            var length = $(this).val().length;
            var length = maxLength2 - length;
            $('#text2').text(length);
        });
		
		$('.main-service').change(function () {
            if ($(this).val() != '')
            {
				if($(this).val() == 5)
				{
					$('.new_service').show();
				}
				else{
					$('.new_service').hide();
				}
                $('.programs').empty();
                var url2 = $('.url').val();
                var service_id = $(this).val();
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: url2 + 'sme/get_programs',
                    data: {
                        service: service_id
                    },
                    success: function (data) {
                        var res = '<label>Business Programs</label><select id="select01" name="programs" class="required programs"><option value="">Select Program</option> ';
                        $.each(data, function (i, item) {
                            res += '<option value=' + item.id + '>' + item.program + '</option>';
                        });
                        res += '</select>';
                        $('.programs').append(res);
                    }

                }, 'json');
            }
			else{
				$('.new_service').hide();
			}

        });
		
		$('.askquestion_popup').click(function(){
			//$('.shor').hide();
		});
    
$('body').on('click', '#load-more', function (e) {
	var url2 = $('.url').val();
	var offset = parseInt($('#offset').val()) + 5; 
    $.ajax({
			url:url2 + 'experts/feedback_loadmore',
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
				if($('.allFeedback p.no_fb').text() == 'Sorry there are no more Results')
				{
					$('.view_more').hide();
				}
			}
		},"json");
	});
	
	$('.feedback').validate();
	
	/*$('.feedback').validate(
      {
        rules:
        {
          fb_type:{ required:true }
        },
        messages:
        {
          Color:
          {
            required:"Please select a Feedback Type<br/>"
          }
        },
        errorPlacement: function(error, element)  
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.container') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
      });	*/
	  

	$('body').on('click', '.follow', function () {
		  var url2 = $('.url').val();
		  var expert = $(this).children('.expert_id').val();
		  var user = $(this).children('.user_id').val();
		  $.ajax({
			url:url2 + 'experts/follow',
			type     : "POST",
			data:{
			  expert :expert,
			  user :user
			},
			success :function(data){
				if(data)
				{
					$('.followersBtn2').removeClass('follow');
					$('.followersBtn2 .colorGrey').text('Unfollow');
					$('.followersBtn2 .follow_id').val(data);
					$('.followersBtn2').addClass('unfollow');
					var cnt = $('.new_fo_count').text();
					cnt = parseInt(cnt) + 1;
					$('.new_fo_count').text(cnt);
				}
			}
		},"json");
		  
	  });
	  
	 $('body').on('click', '.unfollow', function () {
		  var url2 = $('.url').val();
		  var follow_id = $(this).children('.follow_id').val();
		  $.ajax({
			url:url2 + 'experts/unfollow',
			type     : "POST",
			data:{
			  follow_id :follow_id
			},
			success :function(data){
				if(data)
				{
					$('.followersBtn2').removeClass('unfollow');
					$('.followersBtn2 .colorGrey').text('Follow');
					$('.followersBtn2 .follow_id').val('');
					$('.followersBtn2').addClass('follow');
					
					var cnt = $('.new_fo_count').text();
					cnt = parseInt(cnt) - 1;
					$('.new_fo_count').text(cnt);
				}
			}
		},"json");
		  
	  });
	  
	  $('body').on('click', '.like_article', function () {
		  var url2 = $('.url').val();
		  var article_id = $(this).attr('id');
		  var userid = $(this).attr('userid');
		  $.ajax({
			url:url2 + 'experts/article_like',
			type     : "POST",
			data:{
			  article_id :article_id,userid : userid
			},
			success :function(data){
				if(data)
				{
					
				}
			}
		},"json");
		  $(this).removeClass('like_article');
		   $(this).text('Liked');
	  });
	  
	  $('body').on('click', '.unlike_article', function () {
		  var url2 = $('.url').val();
		  var article_id = $(this).attr('id');
		  var userid = $(this).attr('userid');
		  $.ajax({
			url:url2 + 'experts/article_unlike',
			type     : "POST",
			data:{
			  article_id :article_id,userid : userid
			},
			success :function(data){
				if(data)
				{
					
				}
			}
		},"json");
		   $(this).removeClass('unlike_article');
		   $(this).text('UnLiked');
	  });
	  
	  $('body').on('click', '.serlocationBtn', function () {
		  $('.active .new-list').empty();
		  var url2 = $('.url').val();
		  var location = $('#zingInputCity').val();
		  var tab = $('.nav-tabs li.active a').text();
		  $.ajax({
			url:url2 + 'experts/search2',
			type     : "POST",
			data:{
			  location :location,tab : tab 
			},
			success :function(data){
				if(data)
				{
					$('.new-list').attr('added','');  
					$('.active .new-list').attr('added',"addeddiv");
					$('.active .new-list').append(data);
				}
			}
		},"json");
	  });
	  
	   $('body').on('click', '.scrtabs-tabs-movable-container ul li', function () {
		 // $('.active .new-list').empty();
		 var li = $(this).children('a').attr('aria-controls');
		 var classs =$('.'+li+'_div .new-list').attr('added');
		 if(classs == '')
		 {
			  $('.'+li+'_div .new-list').empty();
			  var url2 = $('.url').val();
			  var thiss = $(this);
			  
			  var tab = $(this).children('a').text();
			  $.ajax({
				url:url2 + 'experts/listi',
				type     : "POST",
				data:{
				  tab : tab 
				},
				success :function(data){
					
					if(data)
					{
						
						$('.'+li+'_div .new-list').append(data);
					}
				}
			},"json");
		 }
	  });
	  
	  $(document).keypress(function(e) {
		if(e.which == 13) {
			e.preventDefault();
			//$('.serlocationBtn').click();
		   // alert('You pressed enter!');
		}
	});
	    
     $(document).keypress(function(e) {
		  if(e.which == 13) {
			  var url      = window.location.href;
				var one = url.substr(url.lastIndexOf('/') + 1); 
			if(one == 'home')
				{
					$('.serlocationBtn').click();
			  }
		  } 
		});
     
    
    }); 
</script>	


<script type="text/javascript" >


$.fn.raty.defaults.path = '<?php echo base_url(); ?>images/';
        $('#half').raty({
            half: true,
            hints: [['.5', '1'], ['1.5', '2'], ['2.5', '3'], ['3.5', '4'], ['4.5', '5']],
            score: function () {
                return $(this).attr('title');
            }
        });

        $('#stars_small').raty({
            readOnly: false,
            half: true,
            hints: [['.5', '1'], ['1.5', '2'], ['2.5', '3'], ['3.5', '4'], ['4.5', '5']],
            score: function () {
                return $(this).attr('data-rating');
            }

        });
        
 </script>       

<script type="text/javascript">

    $(document).ready(function () {
        $('.selectpicker').selectpicker();

        $('.dashTab>.nav-tabs').scrollingTabs();
    });

</script>

<script>
	$(document).ready(function() {
		/* js added for sme chat*/
		/* added for sme chat*/
		// tab menu image changes
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
		
		var active_dates = [];
		$('.added_slots').each(function(){
			var va = $(this).val();
			active_dates.push(va);
		});
		
		var blocked_dates = [];
		$('.blocked_slots').each(function(){
			var va2 = $(this).val();
			blocked_dates.push(va2);
		});
		
		var active_dates = active_dates.filter(function(obj) { return blocked_dates.indexOf(obj) == -1; });
		
			var nowDate = new Date();
			var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
			$('.bookingerror').text('');
			$('.bookingamt').click(function(){
				$('.bookingerror').text('');
				var amt = $(this).children('.at').text();
				var type = $(this).prev().text();
				$('.bookamt').val(amt);
				$('.booktype').val(type);
				$('.bookingselectedtype').text(type);
				$('.bookingselectedamount').text(amt);
				
			});
			
			$('.textChat').click(function(){
				$('.bookingerror').text('');
				var amt = $(this).next().next().children('.at').text();
				var type = $(this).next().text();
				$('.bookamt').val(amt);
				$('.booktype').val(type);
				$('.bookingselectedtype').text(type);
				$('.bookingselectedamount').text(amt);
				
			});
			
			$('.audioChat').click(function(){
				$('.bookingerror').text('');
				var amt = $(this).next().next().children('.at').text();
				var type = $(this).next().text();
				$('.bookamt').val(amt);
				$('.booktype').val(type);
				$('.bookingselectedtype').text(type);
				$('.bookingselectedamount').text(amt);
				
			});
			
			$('.videoChat').click(function(){
				$('.bookingerror').text('');
				var amt = $(this).next().next().children('.at').text();
				var type = $(this).next().text();
				$('.bookamt').val(amt);
				$('.booktype').val(type);
				$('.bookingselectedtype').text(type);
				$('.bookingselectedamount').text(amt);
				
			});
		
			$(".smechatnextbtn").click(function () {  
				if($('.bookamt').val() == '')
				{
					$('.bookingerror').text('Please select booking type from options given below');
				}
				else
				{
					
					$('.bookingerror').text('');
					$(".samDate").addClass('show'); 
					$(".bookChat").addClass('hide'); 
					$(".smechatnextbtn").addClass('hide');    
					$(".nextbtn01").addClass('nextbtn01show');
					$(".bookmd").addClass('modal-lg');
				}
			});
			 $(".nextbtn01").click(function () {     
$('.er-msg').hide();			 
				//$(".appointLogin").addClass('show');   
				//$(".modal-footer").addClass('hide');
				//$(".samDate").addClass('textEnterNON');
				//$(".bookmd").removeClass('modal-lg');
				
						var smeuserid = $('.smeuserid').val();
						var sme_amt2 = $('.bookamt').val();
						var id = $('.added_slot').val();
						var type = $('.booktype').val();
						if(id !== undefined){
							
							$.ajax({
							type: 'POST',
							url: base_url +'experts/insert_paysession_amount',
							data: {sme_amt2:sme_amt2,smeuserid : smeuserid,id : id,type :type},
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
					$('.er-msg').show();
						$('.shor').append('<span style="color:red;margin-left:20px;">This field is required</span>');
					  e.preventDefault();
					}
			});
			
			$(".reschedulebutton").click(function () {     		 
				var newid = $('.added_slot').val();
				var bookedid = $('.oldsmebookcallid').val();
				if(newid !== undefined){
					$.ajax({
					type: 'POST',
					url: base_url +'experts/call_reschedule',
					data: {newid : newid,bookedid :bookedid},
					dataType: "json",
					success: function (data) {
							$('.pr-success').show();
							location.reload();
						}
					});

				}
			});
			
		  $('.textChat').click(function(e){
				 e.preventDefault();
			   $(".textChatClick").attr('src',url2 + "assets/experts/image/text-clicked.png");
			   $(".audioChatClick").attr('src',url2 + "assets/experts/image//audio-chat.png");
			   $(".videoChatClick").attr('src',url2 + "assets/experts/image//video-chat.png");   
				$(".text_chat").addClass('show'); 
			 });

		   $('.audioChat').click(function(e){
				 e.preventDefault();
			   $(".audioChatClick").attr('src',url2 +"assets/experts/image//audio-chat-clicked.png");
			   $(".textChatClick").attr('src',url2 +"assets/experts/image//text-chat.png");
			   $(".videoChatClick").attr('src',url2 +"assets/experts/image//video-chat.png");
				$(".audio_chat").addClass('show'); 
			 });

		   $('.videoChat').click(function(e){
				 e.preventDefault();
			   $(".videoChatClick").attr('src',url2 +"assets/experts/image//video-chat-clicked.png");
			   $(".audioChatClick").attr('src',url2 +"assets/experts/image//audio-chat.png");
			   $(".textChatClick").attr('src',url2 +"assets/experts/image//text-chat.png");
				$(".video_chat").addClass('show'); 
			 });

			$('.selectpicker').selectpicker();
			
			
			var date = new Date();
			//alert(disabledDays);
			//$("#smedashDatePickers").datepicker({ numberOfMonths:3 });
			
			$('#smedashDatePickers').datepicker( { 
				todayHighlight: false, 
				dateFormat: 'yy-mm-dd',
				numberOfMonths:3,
				beforeShowDay: function(date) {
					var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
					for (i = 0; i < blocked_dates.length; i++) {
						if($.inArray(y + '-' + (m+1) + '-' + d,blocked_dates) != -1) {
							//return [false];
							return [true, 'ui-state-disabled', ''];
						}
					}
					
					for (i = 0; i < active_dates.length; i++) {
						if($.inArray(y + '-' + (m+1) + '-' + d,active_dates) != -1) {
							//return [false];
							return [true, 'ui-state-available', ''];
						}
					}
					
					return [true];

				 },
				onSelect: function(date, instance) {
					var smeuserid = $('.smeuserid').val();
					$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/get_slot',
						dataType:'json',
						data: {seldate:date,smeuserid : smeuserid },
						success: function (data) 
						{
							if(data)
							{
								$('.timeSlot').empty();
								$('.timeSlot').append(data);
								$('.er-msg').hide();
								$('.reschedulefooter').show();
							}
							else 
							{
								$('.timeSlot').empty();
								$('.er-msg').show();
								$('.show-suc').hide();
							}
						}
					});
				 }
			});
			
			
			
			$('body').on('click', '.timeBtn', function () {
				var id = $(this).attr('id');
				$('.added_slot').val(id);
				$(this).addClass('timeAcitve');
				$(this).prevAll().removeClass('timeAcitve');
				$(this).nextAll().removeClass('timeAcitve');
			});
			
			$(".smedate .ui-datepicker-calendar td.ui-datepicker-today a").removeClass('ui-state-highlight');
			
			
		 /* added for sme chat */
		 
		 
		 $('.change_package').click(function(){
		
		if($(this).is(':checked'))
		{
			
			var amt = $(this).attr('amt');
			$('.new_amt').val(amt);
			$('.new_amout').text(amt);
		}
	});
     

 var base_url = '<?php echo base_url();?>';
		
		
        
        $('#questions-date-picker')
		.datepicker({
			format: 'yyyy-mm-dd',
			"setDate": new Date(),
        "autoclose": true
		})
		.on('changeDate', function(e) {
            // Set the value for the date input
            //$("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
            $("#sortdate").val($("#questions-date-picker").datepicker('getFormattedDate'));
            var sortdate = $("#sortdate").val();
            var id = $('#smeuserid').val();
            if(sortdate != ''){
				$('.smequestionslist').empty();
            $.ajax({
            type: 'POST',
            url: base_url +'experts/sort_questions_by_dates',
            data: {sortdate:sortdate,id:id},
            dataType: "json",
            success: function (data) {
            	$('.smequestionslist').empty();
            	$('.smequestionslist').append(data);
            	
            	}
        	
        	});	
           } 	
        });
		
		
        $('#articles-date-picker')
		.datepicker({
			format: 'yyyy-mm-dd',
			"setDate": new Date(),
        "autoclose": true
		})
		.on('changeDate', function(e) {
            // Set the value for the date input
            //$("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
            $("#sortdate").val($("#articles-date-picker").datepicker('getFormattedDate'));
            var sortdate = $("#sortdate").val();
            var id = $('#smeuserid').val();
            if(sortdate != ''){
            $.ajax({
            type: 'POST',
            url: base_url +'experts/sort_articles_by_dates',
            data: {sortdate:sortdate,id:id},
            dataType: "json",
            success: function (data) {
            	$('.smequestionslist').empty();
            	$('.smequestionslist').append(data);
            	
            	}
        	
        	});	
           } 	
        });
		
		$('.question_search').click(function(e){
		
			e.preventDefault();
			var ques_id = $(this).attr('id');
			 var id = $('#smeuserid').val();
			var ques = $('.ques_added').val();
		
			$.ajax({
            type: 'POST',
			url: base_url +'experts/get_questions',
           // url: base_url +'experts/sort_questions_by_dates',
            data: {ques:ques,id:id},
            dataType: "json",
            success: function (data) {
				
            	$('.smequestionslist').empty();
            	$('.smequestionslist').append(data);
            	
            	}
        	
        	});	
		});


$('#sme-questions-date-picker')
		.datepicker({
			format: 'yyyy-mm-dd',
			"setDate": new Date(),
        "autoclose": true
		})
		.on('changeDate', function(e) {
            // Set the value for the date input
            //$("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
            $("#sme-sortdate").val($("#sme-questions-date-picker").datepicker('getFormattedDate'));
            var sortdate = $("#sme-sortdate").val();
            var id = $('#smeuserid').val();
            if(sortdate != ''){
            $.ajax({
            type: 'POST',
            url: base_url +'experts/sort_questions_by_dates',
            data: {sortdate:sortdate,id:id},
            dataType: "json",
            success: function (data) {
            	$('.smequestionslist').empty();
            	$('.smequestionslist').append(data);
            	
            	}
        	
        	});	
           } 
			else{
				location.reload();
			}		   
        });
      
      $('.qu').keyup(function(e){ 
	  if(e.keyCode == 8)
	  {
		  if($('#sme-sortdate').val() == '')
		  {
			location.reload();  
		  }
	  }
	  });
$('#event_start_date')
		.datepicker({
			startDate: today,
			format: 'yyyy-mm-dd',
			"setDate": new Date(),
        "autoclose": true
		})
		.on('changeDate', function(e) {
            // Set the value for the date input
            $("#start_date").val($("#event_start_date").datepicker('getFormattedDate'));
        });
   
   
   $('#event_end_date')
		.datepicker({
			startDate: today,
			format: 'yyyy-mm-dd',
			"setDate": new Date(),
        "autoclose": true
		})
		.on('changeDate', function(e) {
            // Set the value for the date input
            $("#end_date").val($("#event_end_date").datepicker('getFormattedDate'));
        }); 
        
		$('.validation').validate();

		$('.add-exper-slot').click(function(e){
			e.preventDefault();
			$('.show-msg').hide();
			$('.show-ermsg').hide();
			var day = $('#day option:selected').val();
			
			var starttime = $('.starttime').val();
			var id1 = $('.starttime option:selected').attr('id');
			var id2 = $('.endtime option:selected').attr('id');
			var endtime = $('.endtime').val();
			if(id1 > id2)
			{
				$('.show-ermsg').show();
			}
			else
			{
				$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/add_slots',
						data: {day:day, starttime:starttime, endtime:endtime },
						success: function (data) 
						{
							$('.show-msg').show();
							$('.show-ermsg').hide();
							location.reload();
							//$('.call_slots').modal('hide');
						}
				});
			}
		});
		
		var active_dates = [];
		$('.added_slots').each(function(){
			var va = $(this).val();
			active_dates.push(va);
		});
		
		var blocked_dates = [];
		$('.blocked_slots').each(function(){
			var va2 = $(this).val();
			blocked_dates.push(va2);
		});
		
		var active_dates = active_dates.filter(function(obj) { return blocked_dates.indexOf(obj) == -1; });
		
			var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
		$('#dashDatePickers')
		.datepicker({
			startDate: today,
			format: 'yyyy-mm-dd',
			 multidate: false,
			"setDate": new Date(),
			"autoclose": true,
		
			beforeShowDay: function(date){
					 var d = date;
					 var curr_date = ('0' + (d.getDate())).slice(-2);
					 var curr_month = ('0' + (d.getMonth()+1)).slice(-2); //Months are zero based
					 var curr_year = d.getFullYear();
					 var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;
					   if ($.inArray(formattedDate, active_dates) != -1){
						   return {
							  classes: 'activeClass'
						   };
					   }
					   else if ($.inArray(formattedDate, blocked_dates) != -1){
						    return {
							  classes: 'nonactiveClass',
							  enabled : false
						   };
					   }
					  
					  return;
				  }
		})
		.on('changeDate', function(e) {
            // Set the value for the date input
            $("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
            $("#book_call_date").val($("#dashDatePickers").datepicker('getFormattedDate'));
			 $("#book_call_date").val(e.format());
        });

		
		$('.edit-datepicker').datepicker({
				format: 'yyyy-mm-dd',
                multidate: true,
				autoclose: true,
				todayHighlight: true,
				 beforeShowDay: function(date){
					 var d = date;
					 var curr_date = ('0' + (d.getDate())).slice(-2);
					 var curr_month = ('0' + (d.getMonth()+1)).slice(-2); //Months are zero based
					 var curr_year = d.getFullYear();
					 var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;
					   if ($.inArray(formattedDate, active_dates) != -1){
						   return {
							  classes: 'activeClass'
						   };
					   }
					   else if ($.inArray(formattedDate, blocked_dates) != -1){
						    return {
							  classes: 'nonactiveClass',
							  enabled : false
						   };
					   }
					  
					   
					  return;
				  }
	   }).on('changeDate', function(e) {

             $("#book_call_date2").val(e.format());
			 
        });
		
		$('#sme-datepicker').datepicker( { 
				todayHighlight: false, 
				dateFormat: 'yy-mm-dd',
				numberOfMonths:3,
				  beforeShowDay: function(date) {
					var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
					for (i = 0; i < blocked_dates.length; i++) {
						if($.inArray(y + '-' + (m+1) + '-' + d,blocked_dates) != -1) {
							//return [false];
							return [true, 'ui-state-disabled', ''];
						}
					}
					
					for (i = 0; i < active_dates.length; i++) {
						if($.inArray(y + '-' + (m+1) + '-' + d,active_dates) != -1) {
							//return [false];
							return [true, 'ui-state-available', ''];
						}
					}
					
					return [true];

				 },
				onSelect: function(date, instance) {
					$("#book_call_date2").val(date);
					var smeuserid = $('.smeuserid').val();
					$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/get_slot',
						dataType:'json',
						data: {seldate:date,smeuserid : smeuserid },
						success: function (data) 
						{
							if(data)
							{
								$('.timeSlot').empty();
								$('.timeSlot').append(data);
								$('.er-msg').hide();
							}
							else 
							{
								$('.timeSlot').empty();
								$('.er-msg').show();
								$('.show-suc').hide();
							}
						}
					});
				 }
				
			});
			
			$(".smedate .ui-datepicker-calendar td.ui-datepicker-today a").removeClass('ui-state-highlight');
        
        
 $('body').on('click', '.bookcall_popup', function (e) {
	 
	 $('.edit-datepicker .activeClass').removeClass('active');
 });
		
	
        
		
		
		$('.er-msg').hide();
			$('.show-suc').hide();
		$('.block-slot').click(function(e){
			e.preventDefault();
			$('.er-msg').hide();
			$('.show-suc').hide();
			var slotid = $('.timeAcitve').attr('id');
			if(slotid == '')
			{
				$('.er-msg').show();
			}
			else
			{
				//var seldate = $("#book_call_date2").val();
				$.ajax({
					type : 'POST',
					url : '<?php echo base_url(); ?>experts/block_slot',
					dataType:'json',
					data: {slotid:slotid },
					success: function (data) 
					{
						if(data)
						{
							$('.show-suc').show();
							//$('.er-msg').hide();
							setTimeout(function(){
							  window.location.reload(1);
							}, 100);
							
						}
						else 
						{
							$('.er-msg').show();
							$('.show-suc').hide();
						}
					}
				});
			}
		});
        
	   
	   
		var year = [];
		var month = [];
		var daydate = [];
		var dates = [];
		
			//$('.edit-datepicker').datepicker('setDates',[new Date(2016, 5, 3),new Date(2016, 6, 8),new Date(2016, 5, 10)]);
			
		$('.slots').each(function(){
			
			var years = $(this).attr('year');
			year.push(years);
			var months = parseInt($(this).attr('month')) - 1 ;
			month.push(months);
			var daydates = $(this).attr('daydate');
			//daydate.push(daydates);
			
			//$('.edit-datepicker').datepicker('setDates',[new Date(2016, 5, 3),new Date(2016, 6, 8),new Date(2016, 5, 10)]);
			//$('.edit-datepicker').datepicker('update');  //update the bootstrap datepicker
		});
		
		
		for(var i = 0;i<year.length;i++)
		{
			var date = new Date(year[i], month[i], daydate[i]);
			var todayDate = new Date();
			dates.push(date);
			dates.push(todayDate);
			//$('.edit-datepicker').datepicker('setDates',[,new Date(2016, 6, 8),new Date(2016, 5, 10)]);
		}
		
		var blockedyear = [];
		var blockedmonth = [];
		var blockeddaydate = [];
		var blockeddates = [];
		
			//$('.edit-datepicker').datepicker('setDates',[new Date(2016, 5, 3),new Date(2016, 6, 8),new Date(2016, 5, 10)]);
			
		$('.blockedslots').each(function(){
			
			var years = $(this).attr('year');
			blockedyear.push(years);
			var months = parseInt($(this).attr('month')) - 1 ;
			blockedmonth.push(months);
			var daydates = $(this).attr('daydate');
			blockeddaydate.push(daydates);
			
			//$('.edit-datepicker').datepicker('setDates',[new Date(2016, 5, 3),new Date(2016, 6, 8),new Date(2016, 5, 10)]);
			//$('.edit-datepicker').datepicker('update');  //update the bootstrap datepicker
		});
		
		
		
		for(var i = 0;i<blockedyear.length;i++)
		{
			var date = new Date(blockedyear[i], blockedmonth[i], blockeddaydate[i]);
			var todayDate = new Date();
			dates.push(date);
			dates.push(todayDate);
			//$('.edit-datepicker').datepicker('setDates',[,new Date(2016, 6, 8),new Date(2016, 5, 10)]);
		}
		
		$('.edit-datepicker').datepicker('setDates',dates);
		//$('.user-expert-dates').datepicker('setDates',dates);
		//$('.edit-datepicker').datepicker('setDates',blockeddates);

	$('.add-slot').click(function(){
		$('.show-msg').hide();
	});	

	$('.datepicker-days table tbody tr td').removeClass('active');
        
	});
	

	</script>

	
<script type="text/javascript">
    $('#email_subscription_error').css('display', 'none');
    $('#subscription_success').hide();
    $("#subscription_submit").click(function () {
        var email = $('#subscription_email').val();
        var zipcode = $('#subscription_zipcode').val();
        if (email == '') {
            $('#email_subscription_error').css('display', 'block');
        } else {
            if (validateEmail(email)) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>subscribe',
                    data: {email: email, zipcode: zipcode},
                    //dataType: "html",
                    success: function (data) {
                        if (data === 'email error') {
                            $('#email_subscription_error').css('display', 'block');
                        } else if (data === 'subscribed') {
                            $('#subscription_success').html('');
                            $('#email_subscription_error').css('display', 'none');
                            $('#subscription_success').show();
                            $('#subscription_success').text('You have already subscribed.');
                        } else if (data === 'success') {
                            $('#subscription_success').html('');
                            $('#email_subscription_error').css('display', 'none');
                            $('#subscription_success').show();
                            $('#subscription_success').text('Thank you for subscribing to ZingUpLife.');
                        } else {

                        }

                    }
                });
            } else {
                $('#email_subscription_error').css('display', 'block');
                $('#email_subscription_error').text('Please enter a valid email address.');
            }
        }
        return false;
    });
    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
</script>

<script	src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.5.0/js/intlTelInput.js"></script>
<script>
	var baseUrl = '<?php echo base_url();?>';
      $("#phone").intlTelInput({
            autoHideDialCode: true,
            autoPlaceholder: true,
            separateDialCode: true,
            nationalMode: true,
            geoIpLookup: function (callback) {
                $.get("http://ipinfo.io", function () {}, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            initialCountry: "auto",
        });

        // get the country data from the plugin
        var countryData = $.fn.intlTelInput.getCountryData(),
          telInput = $("#phone"),
          addressDropdown = $("#listcountry");

        // init plugin
        telInput.intlTelInput({
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.5.0/js/utils.js" // just for formatting/placeholders etc
        });

        // populate the country dropdown
        $.each(countryData, function(i, country) {
          addressDropdown.append($("<option></option>").attr("value", country.iso2).text(country.name));
        });

        // listen to the telephone input for changes
        telInput.on("countrychange", function() {
          var countryCode = telInput.intlTelInput("getSelectedCountryData").iso2;
          addressDropdown.val(countryCode);
        });

        // trigger a fake "change" event now, to trigger an initial sync
        telInput.trigger("countrychange");

        // listen to the address dropdown for changes
        addressDropdown.change(function() {
          var countryCode = $(this).val();
          telInput.intlTelInput("setCountry", countryCode);
        });

        // update the hidden input on submit
        $("form").submit(countryData,function(i, country) {
          $("#country").val(telInput.intlTelInput("getSelectedCountryData").name);
          $("#phonefull").val('+' + telInput.intlTelInput("getSelectedCountryData").dialCode + $("#phone").val());
        });
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/sme-reg-details.js">	</script>
</body>
</html>
