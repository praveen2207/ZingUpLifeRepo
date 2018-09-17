<footer role="contentinfo">
        <div class="row">
            <div class="row-content buffer clear-after">
                <section id="top-footer">
                    <div class="widget column three">
                        <!-- la class="widget" è forse generata utomaticamente da wp -->
                        <h4>COMPANY</h4>
                        <ul class="plain">
                            <li><a href="<?php echo base_url(); ?>about_us">About us</a></li>
                            <li><a href="<?php echo base_url(); ?>coming_soon">Careers</a></li>
                            <li><a href="<?php echo base_url(); ?>faq">FAQ's</a></li>
                            <li><a href="<?php echo base_url(); ?>terms">Terms and conditions</a></li>
                        </ul>
                    </div>
                    <div class="widget column three">
                        <h4>DISCOVER</h4>
                        <ul class="plain">
                           <li><a href="<?php echo base_url(); ?>coming_soon">Corporate Wellness</a></li>
                                <li><a href="<?php echo base_url(); ?>coming_soon">ZUL Gift Cards</a></li>
                                <li><a href="<?php echo base_url(); ?>knowledgebase/" target="_blank">Knowledge Base</a></li>
                                <li><a href="<?php echo base_url(); ?>partner">Partner Login</a></li>
                        </ul>
                    </div>
                    <div class="widget column three">
                        <h4>CONTACT US</h4>
                        <ul class="plain">
                            <li><a href="<?php echo base_url(); ?>coming_soon">Customer Support</a></li>
                                <li><a href="<?php echo base_url(); ?>coming_soon">Partner Support</a></li>
                                <li><a href="<?php echo base_url(); ?>vendor/registration">Get Your Venue Listed</a></li>
                                <li><a href="<?php echo base_url(); ?>coming_soon">Feedback</a></li>
                        </ul>
                    </div>
                    <div class="widget  meta-social column three">
                        <br/>
                         <form class="form-inline" method="post" novalidate="novalidate" id="subscription">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="subscription_email" placeholder="Enter email to subscribe" style="width:100%;border-radius: 20px;"> 
								<span for="email" generated="true" class="subscription_error" id="email_subscription_error">This field is required</span><span class="errspan"><button type="button" class="btn" id="subscription_submit" style='background:none;border:none;'><img src="<?php echo base_url();?>assets/experts_new/img/email.png"></button></span> 
								</div>
                        </form>
                        <ul class="inline footer-icons" style=" margin-top:30px;">
                            <li><a href="https://twitter.com/ZingUp_Life" class="twitter-share border-box"><i class="fa fa-twitter fa-lg"></i></a></li>
                            <li><a href="https://www.facebook.com/zinguplife/?ref=ts&fref=ts" class="facebook-share border-box"><i class="fa fa-facebook fa-lg"></i></a></li>
                            <!--<li><a href="#" class="pinterest-share border-box"><i class="fa fa-pinterest fa-lg"></i></a></li>-->
							<li><a href="https://plus.google.com/u/0/+Zinguplife_embrace_wellness" class="gplus-share border-box"><i class="fa fa-google-plus fa-lg"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCedodQSa3CA2YB21DOBjJaA" class="youtube-share border-box"><i class="fa fa-youtube fa-lg"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/10364501?trk=tyah&trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A10364501%2Cidx%3A2-1-4%2CtarId%3A1475057537428%2Ctas%3Azingup" class="facebook-share border-box"><i class="fa fa-linkedin fa-lg"></i></a></li>
                        </ul>
                    </div>
                </section>
                <!-- top-footer -->
                <section id="bottom-footer" style="border-top:1px solid #666;margin-top:15px;color:#A3A3A3;min-height:115px;">
                    <br/>
                    <div class="widget column three">
                        <a href="#"><img src="<?php echo base_url();?>assets/experts_new/img/logo.png" style="width: 190px;"></a><br/>
                        <p>&nbsp;&nbsp;&nbsp;<a href="#" target="_blank" style="border:none;width:100px;"><img src="<?php echo base_url(); ?>assets/images/appstore.png" alt="" style="width: 152px;padding-left: 16px;"></a></p>
                        <p>&nbsp;&nbsp;&nbsp;<a href="#" style="cursor:pointer;border:none;width:100px"><img src="<?php echo base_url(); ?>assets/images/playstore.png" alt="" style="width: 152px;padding-left: 16px;margin-top: -12px;"></a></p>
                    </div>
                    <div class="column six">
                        <h4 style="margin-top: 0px">ABOUT US</h4>
                        <p>ZingUpLife is India's first online discovery platform and only curated marketplace for alternate wellness service providers, bundled with real-time engagement with a wide ranging panel of leading subject matter experts. We host the most comprehensive knowledge repository on wellness, backed by the collated knowledge and wisdom of a global community of wellness evangelists and enthusiasts.

.</p>
                    </div>
                    <div class="column three last">
                        <ul class="plain text-y">
							<?php $logged_in_user_details = $this->session->userdata('logged_in_user_data'); 
								if ($logged_in_user_details->is_logged_in != 1 && $this->session->userdata('type') !='sme') { ?>
                            <li><a href="<?php echo base_url(); ?>experts/login" style="font-weight: bold;">For Experts</a></li>
								<?php }?>
                            <li><a href="<?php echo base_url(); ?>login" style="font-weight: bold;">For Employers</a></li>
                            <li><a href="<?php echo base_url(); ?>vendor/registration" style="font-weight: bold;">List Your Business</a></li>
                            <li><a href="mailto:info@zinguplife.com" style="font-weight: bold;">Ask a Quesation</a></li>
                        </ul>
                    </div>
                </section>
                <!-- bottom-footer -->
            </div>
            <!-- row-content -->
        </div>
        <!-- row -->
    </footer>
	
	
	
    <script src="<?php echo base_url();?>assets/experts_new/js/jquery-1.11.2.js"></script>
    <script src="<?php echo base_url();?>assets/experts_new/js/plugins.js"></script>
    <script src="<?php echo base_url();?>assets/experts_new/js/beetle.js"></script>
    <script src="<?php echo base_url();?>assets/experts_new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/experts_new/js/jasny-bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="<?php echo base_url();?>assets/experts_new/js/jquery.timepicker.js"></script>-->
	<!--<script type="text/javascript" src="<?php echo base_url();?>assets/experts_new/js/jquery.timepicker2.js"></script>-->
	<!--<script type="text/javascript" src="<?php echo base_url();?>assets/experts_new/js/bootstrap-datepicker.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/experts_new/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/experts_new/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/flatpickr.js"></script>
        
	 <script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery.raty.min.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/custom.js"></script>-->
	<!--Start of Tawk.to Script-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/appearin-sdk.0.0.4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/pusher.min.js"></script>

<?php if(ONLINE_CHAT_TAWK == 'ON') { ?>	
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () { 
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/573dfae6f1297445545a4854/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
<?php } ?>
    <script>
        $('.carousel-control.right').click(function () {
            $('#quote-carousel').carousel('next')
        });
        $(document).ready(function(){
            $('input.fromt').click(function(){$('.fromtime').show(); $('.totime').hide();});
			$('input.tto').click(function(){$('.totime').show(); $('.fromtime').hide();});
        });
		
        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        });
		 flatpickr(".flatpickr");
        flatpickr("#defaultDate", {
            defaultDate: 1477697199863, // Date objects and date strings are also accepted
            enableTime: true
        });
		
		 var logID = 'log',
  log = $('<div id="'+logID+'"></div>');
$('body').append(log);
  $('[type*="radio"]').change(function () {
    var me = $(this);
    log.html(me.attr('value'));
  });
  
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
	
	var selecteddaysa = new Array();
	
	$('.days li input').click(function(){
		var days = [];
		if(this.checked)
		{
			var seday = $(this).val();
			selecteddaysa.push(seday);
			if($('.add_days').text() == '')
			{
				$('.add_days').append($(this).parent().attr('day'));
			}
			else{
				$('.add_days').append(',');
				$('.add_days').append($(this).parent().attr('day'));
			}
		}
		else{
			var seday = $(this).val();
			var day = $(this).parent().attr('day');
			selecteddaysa = jQuery.grep(selecteddaysa, function(value) {
			  return value != seday;
			});
			var string = $('.add_days').text();
			if (string.indexOf(",") >= 0)
			{
				var n = string.indexOf(day);
				if(n==0)
				{
					var string2 = string.replace(day+',','');
				}
				else{
					var string2 = string.replace(','+day,'');
				}
				
			}
			else
			{
				var string2 = string.replace(day,'');
			}
			$('.add_days').empty();
			$('.add_days').append(string2);
			
			if(string.length == 0)
			{
				selecteddaysa.length = 0;
			}
		}
		//if(selecteddaysa.length !=0)
		//{
			$('.selecteddays').val(selecteddaysa);
		//}
	});
	
	$('body').on('click','.fromtime  li a',function (){
		$('.fromaddtime').empty();
		var time =$(this).text();
		var id = $(this).attr('id');
		var id1 = $('.tto').attr('selectedttime');
		if(id1 !='' && (id1 < id || id1 == id))
		{
			$('.show-ermsg').show();
		}
		else
		{
			$('.show-ermsg').hide();
			$('.fromt').val(time);
			$('.fr').val(time);
			$('.fromt').attr('selectedftime',id);
			$('.fromtime').hide();
			$('.fromaddtime').append(time);
		}
		
	});
	
	$('body').on('click','.totime li a',function (){
		$('.toaddtime').empty();
		var time =$(this).text();
		var id2 = $(this).attr('id');
		var id1 = $('.fromt').attr('selectedftime');
		if(id2 < id1 || id2 == id1)
		{
			$('.show-ermsg').show();
		}
		else{
			$('.tto').attr('selectedttime',id2);
			$('.show-ermsg').hide();
			$('.tto').val(time);
			$('.tr').val(time);
			$('.totime').hide();
			$('.toaddtime').append(' - ');
			$('.toaddtime').append(time);
		}
	});
	
	$('.add-exper-slot').click(function(e){
			e.preventDefault();
			$('.show-msg').hide();
			$('.show-ermsg').hide();
			
			
			//var day = $('#day option:selected').val();
			
			var day = $('.selecteddays').val();
			var starttime = $('.fr').val();
			var endtime = $('.tr').val();
			
			if(day =='' || starttime == '' || endtime =='' || starttime == ' ' || endtime ==' ' || day ==' ' )
			{
				$('.show-ermsgfields').show();
			}
			else
			{
				$('.show-ermsgfields').hide();
				$('.added_new_time_slots').empty();
				$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/add_slots',
						data: {day:day, starttime:starttime, endtime:endtime },
						success: function (data) 
						{ 
							$('.added_new_time_slots').append(data);
							$('.show-msg').show();
							$('.show-ermsg').hide();
							setTimeout(function(){
							  $('.show-msg').hide();
							}, 2000);
							$('.add_days').empty();
							$('.fromaddtime').empty();
							$('.toaddtime').empty();
							$('.fr').val(' ');
							$('.tr').val(' ');
							$('.selecteddays').val(' ');
							$('.fromt').val('From');
							$('.tto').val('To');
							$('input:checkbox').removeAttr('checked');
							location.reload();
							//$('.call_slots').modal('hide');
						}
				});
			}
		});
		
		
		$('.question_search').click(function(e){
		
			e.preventDefault();
			var ques_id = $(this).attr('id');
			 var id = $('#smeuserid').val();
			var ques = $('.ques_added').val();
			if(ques !='')
			{
				$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>experts/new_get_questions',
			   // url: base_url +'experts/sort_questions_by_dates',
				data: {ques:ques,id:id},
				dataType: "json",
				success: function (data) {
					
					$('.smequestionslist').empty();
					$('.smequestionslist').append(data);
					
					}
				
				});
			}
		});
		
		$(".answering").on('keyup', function (e) {
			if (e.keyCode == 13) {
				var qid = $(this).next().val();
				var uid = $(this).next().next().val();
				var ans = $(this).val();
				$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>experts/add_ques_replies',
			   // url: base_url +'experts/sort_questions_by_dates',
				data: {qid:qid,uid:uid,ans:ans},
				dataType: "json",
				success: function (data) {
					
					location.reload();
					
					}
				
				});	
			}
		});
		
		$('body').on('click', '#add_sme_event', function (e) {
			e.preventDefault();
			var vali = $('.validation').valid();
			if(vali)
			{
				$( "#sme_add_event" ).submit();
			}
		});
		
		$('body').on('click', '#add_sme_article', function (e) {
			e.preventDefault();
			var vali = $('.validation').valid();
			if(vali)
			{
				$( "#sme_add_article" ).submit();
			}
		}); 

		$('.delete_event').click(function(e){
			e.preventDefault();
			var c = confirm("Are you sure you want to delete this event?");
			var id = $(this).attr('id');
			var thiss = $(this);
			if(c)
			{
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>experts/delete_event',
				   // url: base_url +'experts/sort_questions_by_dates',
					data: {id:id},
					dataType: "json",
					success: function (data) {
						
						thiss.parent().parent().remove();
						
						}
					
					});
			}				
		});
		
		$('.delete_card').click(function(){
			$('.days input').attr('checked', false); 
			$('.add_days').empty();
			$('.fromaddtime').empty();
			$('.toaddtime').empty();
			$('.fr').val(' ');
			$('.fromt').val(' ');
			$('.tr').val(' ');
			$('.tto').val(' ');
			$('.selecteddays').val(' ');
		});
		
		function randomString(length, chars) {
		var result = '';
		for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
		return result;
	}
	
		var url2 = $('.url').val();
		
		$('.click_join_session').click(function(){
			var id = $(this).attr('id');
			var roomName = randomString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			roomName = 'Zinguplife' + roomName;
			var newurl = url2 + 'experts/live_session';
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
						window.location.href = newurl;
					}
				});
			}
			else
			{
				alert('Sorry, The browser you are using is not compatible');
			}
		});
		
		$('.open').click(function(){
			if($('.show_times').css('display') == 'none')
			{
				$('.show_times').show();
				$(this).removeClass('fa-plus');
				$(this).addClass('fa-minus');
			}
			else{
				$('.show_times').hide();
				$(this).removeClass('fa-minus');
				$(this).addClass('fa-plus');
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
			
			
		$('#sme-datepicker2').datepicker( { 
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
						url : '<?php echo base_url(); ?>experts/get_slot2', 
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
			
			$('.block-slot').click(function(e){
			e.preventDefault();
			$('.er-msg').hide();
			$('.show-suc').hide();
			arr = [];
			var slotid = $('.timeAcitve').attr('id');
			
			if(slotid == 0)
			{
				
				 $(".all_slot").each(function(){
						var v = $(this).val();
						arr.push(v);
					});
				//var slotid =  $('input[name="slots[]"]').val();
			}
			if(slotid == '' || slotid == undefined)
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
					data: {slotid:slotid,arr:arr },
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
		
		
			$('.cancel-slot').click(function(e){
			e.preventDefault();
			$('.er-msg').hide();
			$('.show-suc').hide();
			var slotid = $('.timeAcitve').attr('booked_id');

			
			if(slotid == '' || slotid == undefined)
			{
				$('.er-msg').show();
				$('.er-msg').text('Please select Booked slot');
			}
			else
			{
				$.ajax({
					type : 'POST',
					url : '<?php echo base_url(); ?>experts/cancel_call_booking',
					dataType:'json',
					data: {id:slotid},
					success: function (data) 
					{
						if(data)
						{
							$('.show-suc').show();
							$('.show-suc').show('The Selected Slot is cancelled successfully');
							//$('.er-msg').hide();
							setTimeout(function(){
								window.location.reload(1);
							}, 100);
							
						}
						else 
						{
							$('.er-msg').show();
							$('.er-msg').text('Please select Booked slot');
							$('.show-suc').hide();
						}
					}
				});
			}
		});
		
		$('.book-slot').click(function(e){
			//data-dismiss="modal" data-toggle="modal" data-target="#bookblock"
			e.preventDefault();
			$('.er-msg').hide();
			$('.show-suc').hide();
			var slotid = $('.timeAcitve').attr('id');
			var status = $('.timeAcitve').attr('status');
			
			if(slotid == '' || slotid == undefined || status !='available')
			{
				$('.er-msg').show();
			}
			else
			{
				$(this).attr('data-dismiss','modal');
				$(this).attr('data-toggle','modal');
				$(this).attr('data-target','#bookblock');
				$('.slot_id').val(slotid);
				
			}
		});
		

		
		$("input.emailcheck").keydown(function (e) {
			if (e.which == 9)
			{
			  var email = $('.emailcheck').val();
				$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/check_user_reg',
						dataType:'json',
						data: {email:email},
						success: function (data) 
						{
							if(data)
							{
								$('.newname').val(data.name);
								$("input[name=gender][value=" + data.gender + "]").attr('checked', 'checked');
								$('.exuser_id').val(data.id);
							}
							else 
							{
								
							}
						}
					});
			}
		});
		
		$("input.newname").click(function (e) {
			var email = $('.emailcheck').val();
				$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/check_user_reg',
						dataType:'json',
						data: {email:email},
						success: function (data) 
						{
							if(data)
							{
								$('.newname').val(data.name);
								$("input[name=gender][value=" + data.gender + "]").attr('checked', 'checked');
								$('.exuser_id').val(data.id);
							}
							else 
							{
								
							}
						}
					});
		});
		
		$('.book_slot_user').click(function(){
			$('.show-sucsend').hide();
			var id = $('.exuser_id').val();
			var slot_id = $(".slot_id").val();
			var type = $(".type:checked").val();
			var email = $('.emailcheck').val();
			var name = $('.newname').val();
			var gender = $(".gender:checked").val();
			if(type == 'Text Chat')
			{
				var amount = $('.ctext').val();
			}
			else if(type == 'Audio Chat'){
				var amount = $('.caudio').val();
			}
			else if(type == 'Video Chat'){
				var amount = $('.cvideo').val();
			}
			
			if(id == '')
			{
				
				$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/reg_new_user',
						dataType:'json',
						data: {email:email,name:name,gender:gender,slot_id:slot_id,type:type,amount:amount},
						success: function (data) 
						{
							if(data)
							{
								$('.show-sucsend').show();
								setTimeout(function(){
									window.location.reload(1);
								}, 200);
							}
							else 
							{
								
							}
						}
					});
			}
			else
			{
				$.ajax({
						type : 'POST',
						url : '<?php echo base_url(); ?>experts/add_exis_user_book',
						dataType:'json',
						data: {email:email,name:name,id:id,slot_id:slot_id,type:type,amount:amount},
						success: function (data) 
						{
							if(data)
							{
								$('.show-sucsend').show();
								setTimeout(function(){
									window.location.reload(1);
								}, 200);
							}
							else 
							{
								
							}
						}
					});
			}
		});
		
		
		$('.appendid').click(function(){
			var id = $(this).attr('id');
			$('.booked_id').val(id);
		});
		
		$('.cancelbookcall').click(function(){
			var id = $('.booked_id').val();
			var message = $('.cancelmsg').val();
			$.ajax({
					type : 'POST',
					url : '<?php echo base_url(); ?>experts/cancel_call_booking',
					dataType:'json',
					data: {id:id,message : message },
					success: function (data) 
					{
						$('.closethispopup').click();  
						$('.booked_'+id).text('Cancelled');
						$('.booked_'+id).attr('data-target','');
					}
				});
		});
		
		$("form.cf-btn").bind("keypress", function(e) {
              if (e.keyCode == 13) {
                 return false;
              }
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
	  
	  var url2 = $('.url').val();
	    var base_url = $('.url').val();
	  $('.bookingerror').text('');
			$('.bookingamt').click(function(){
				$(this).next('.btn-chat-hide').show();
				$('.bookingerror').text('');
				var amt = $(this).children('.bookingamt2').text();
				var type = $(this).prev().text();
				$('.bookamt').val(amt);
				$('.booktype').val(type);
				$('.bookingselectedtype').text(type);
				$('.bookingselectedamount').text(amt);
				//$('.smechatnextbtn').click();
				if($('.bookamt').val() == '')
			{
				$('.bookingerror').text('Please select booking type from options given below');
			}
			else
			{
				
				$('.bookingerror').text('');
				var smeuserid = $('.smeuserid').val();
				var sme_amt2 = $('.bookamt').val();
					//var id = $('.added_slot').val();
				var type = $('.booktype').val();
					//if(id !== undefined){
						
				$.ajax({
				type: 'POST',
				url: url2 +'experts/create_sme_slot',
				data: {sme_amt2:sme_amt2,smeuserid : smeuserid,type :type},
				dataType: "json",
				success: function (data) {
						if(data)
						{
							window.location.href = url2 + 'experts/user_live_session';
						}
					}
				});
			}
			});
			
			$('.newbookingamt').click(function(){
				$('.bookingerror').text('');
				var amt = $(this).children('.bookingamt2').text();
				var type = $(this).prev().text();
				$('.bookamt').val(amt);
				$('.booktype').val(type);
				$('.bookingselectedtype').text(type);
				$('.bookingselectedamount').text(amt);
				//$('.smechatnextbtn').click();
			});
			
			
	  $(".smechatnextbtn").click(function (e) {  
	  e.preventDefault();
			if($('.bookamt').val() == '')
			{
				$('.bookingerror').text('Please select booking type from options given below');
			}
			else
			{
				
				$('.bookingerror').text('');
				var smeuserid = $('.smeuserid').val();
				var sme_amt2 = $('.bookamt').val();
					//var id = $('.added_slot').val();
				var type = $('.booktype').val();
					//if(id !== undefined){
						
				$.ajax({
				type: 'POST',
				url: url2 +'experts/create_sme_slot',
				data: {sme_amt2:sme_amt2,smeuserid : smeuserid,type :type},
				dataType: "json",
				success: function (data) {
						if(data)
						{
							window.location.href = url2 + 'experts/user_live_session';
						}
					}
				});
			}
		});
		
		$(".newsmechatnextbtn").click(function () {  
				if($('.bookamt').val() == '')
				{
					$('.bookingerror').text('Please select booking type from options given below');
				}
				else
				{
					$('.bookingerror').text('');
					$(".samDate").addClass('show'); 
					$(".bookChat").addClass('hide'); 
					$(".newsmechatnextbtn").addClass('hide');    
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
			
			$('body').on('click', '.timeBtn', function () {
				var id = $(this).attr('id');
				$('.added_slot').val(id);
				$(this).addClass('timeAcitve');
				$(this).prevAll().removeClass('timeAcitve');
				$(this).nextAll().removeClass('timeAcitve');
			});
			
			$(".smedate .ui-datepicker-calendar td.ui-datepicker-today a").removeClass('ui-state-highlight');
		
		// set interval
		/*var tid = setInterval(mycode, 2000);
		function mycode() {
		  $.ajax({
				type: 'POST',
				url: url2 +'experts/check_chat_initiate',
				dataType: "json",
				success: function (data) {
						if(data)
						{
							$('.test').text('You have Live session to start');
							abortTimer();
						}
					}
				});
		}
		
		function abortTimer() { // to be called when you want to stop the timer
		  clearInterval(tid);
		}*/
			
		$('.close').click(function(){
			$('.services').hide();
			$('.modal-backdrop').hide();
		});
		
		
		
		$('body').on('click','.sme_chat',function(e){
				//$('.sme_chat').click(function(e){
			e.preventDefault();
			$(this).next('.btn-chat-hide').show();
			var url2 = $('.url').val();
			var smeid = $(this).attr('id');
			$.ajax({
						type: "POST",
						url: url2 + 'experts/check_user_logged',
						dataType: "json",
						data: {smeid:smeid},
						success: function (data) {
							if(data == 'login')
							{
								window.location.href = url2 + 'login';
							}
							else if(data == 'cleared'){
								window.location.href = url2 + 'experts/user_chat/' + smeid;
							}
							else{
								window.location.href = url2 + 'experts/new_payment_checkout/';
							}
						}
					});
		});
		
		$('.chat-payment').click(function(){
			var user = $('.chat_userid').val();
			var amt = $('.package_amount').val();
			var bookid = $('.smebookcallid').val();
			$.ajax({
						type: "POST",
						url: url2 + 'experts/ask_payment',
						dataType: "json",
						data: {user:user,amt:amt,bookid:bookid},
						success: function (data) {
							if(data)
							{
								
							}
						}
					});
		});
		
		$(document).click(function(){
			  $(".fromtime").hide();
			  $('.totime').hide();
			});
			
			$(".fromt").click(function(e){
			  e.stopPropagation();
			});
			
			$(".tto").click(function(e){
			  e.stopPropagation();
			});
			
			$('.delete_time_slot').click(function(e){
				e.preventDefault();
				
			});
			
			$('.user-chat-payment').click(function(){
		
				var url2 = $('.url').val();
			var user = $('.chat_userid').val();
			var amt = $('.package_amount').val();
			var bookid = $('.smebookcallid').val();
			var sme = $('.sme_userid').val();
			$.ajax({
						type: "POST",
						url: url2 + 'experts/user_make_payment',
						dataType: "json",
						data: {user:user,amt:amt,bookid:bookid},
						success: function (data) {
							
							if(data)
							{
								window.location.href = url2 + 'experts/new_chat_payment_checkout/';
							}
							else{
								window.location.href = url2 + 'experts/add_feedback/'+ sme ;
							}
						}
					});
		});
		
		$('.rating2 a').click(function(){
			var rate = $(this).attr('id');
			$('.rate_sme').val(rate);
			if(parseInt(rate) <= 3 )
			{
				$('.fb_error').hide();
				$('.sme_fb').show();
				$('.sme_fb').addClass('required');
			}
			else{
				$('.fb_error').hide();
				$('.sme_fb').hide();
				$('.sme_fb').removeClass('required');
			}
			
		});
		
		$('.feed_form').validate();
		
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
			
			$('#smedashDatePickers2').datepicker( { 
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
						url : '<?php echo base_url(); ?>experts/get_slot2',
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
		
		/*$('.fbsubmit').click(function(e){
			e.preventDefault();
			var fb = $('.sme_fb').val();
			if($('.sme_fb').css('display') == 'block')
			{
				if(fb == '')
				{
					$('.fb_error').show();
				}
				else
				{
					$('.fb_error').hide();
					$('.feed_form').submit();
				}
			}
			else{
				$('.fb_error').hide();
					$('.feed_form').submit();
			}
		});*/
		
		$('body').on('click','.sme_book',function(e){	
			e.preventDefault();
			//$(this).next('.btn-chat-hide').show();
			var url2 = $('.url').val();
			var smeid = $(this).attr('id');
			$.ajax({
						type: "POST",
						url: url2 + 'experts/book_check_user_logged',
						dataType: "json",
						data: {smeid:smeid},
						success: function (data) {
							if(data == 'login')
							{
								window.location.href = url2 + 'login';
							}
				
						}
					});
		});
		
		$('body').on('click','.ques-ask',function(e){	
			e.preventDefault();
			//$(this).next('.btn-chat-hide').show();
			var url2 = $('.url').val();
			var smeid = $(this).attr('id');
			$.ajax({
						type: "POST",
						url: url2 + 'experts/ques_check_user_logged',
						dataType: "json",
						data: {smeid:smeid},
						success: function (data) {
							if(data == 'login')
							{
								window.location.href = url2 + 'login';
							}
							else
							{
								$('.question-form').show();
							}
				
						}
					});
		});

$('.book-t').click(function(){
			
			$('.book-tes').show();
		});
		
		$('#close').click(function(){
			$('.services').hide();
			$('.modal-backdrop').hide();
		});
		/*$('#follow').click(function(){
			var sme_id = $('.booked_id').val();
			var user_id = $('.notemsg').val();
			$.ajax({
                            type : 'POST',
                            url : '<?php echo base_url(); ?>experts/save_gp_notes',
                            dataType:'json',
                            data: {sme_id:sme_id,user_id : user_id },
                            success: function (data) 
                            {       
                                $('.closethispopup').click();  
                            }
                        });
			$('#followers').text('FOLLOW');
		});
		$('#unfollowers').click(function(){
			$('#followers').text('UNFOLLOW');
		});*/
		
});
	</script>
	<script type="text/javascript">
		// Enable pusher logging - don't include this in production
		Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};

		var pusher = new Pusher('6945c067cf76ecd342e6');
		var channel = pusher.subscribe('test_channel');

		channel.bind('my_event', function(data) {
		
			var v = $('.sme_userid').val();
			var ty = $('.type').val();
			if(v == data.id && ty == data.type )
			{
				setTimeout(function(){ 
					//alert(data.message);
					location.reload();
				}, 40000);
				
			}
			else{
				var v2 = $('.user_id').val();
				var t = $('.type').val();
				
				if(v2 == data.id && t == data.type && data.status == 'unpaid')
				{
					$('.live_session_payment').show();
				}
				/*else if(v2 == data.id && t == data.type && data.status == 'paid')
				{
					$('.live_session_payment').remove();
					$('.services').hide();
				}*/
			}
		});
		
		setTimeout(onUserInactivity, 1000 * 1800)
		function onUserInactivity() {
			
			var url2 = $('.url').val();
		   window.location.href = url2 + 'experts/logout';
		}
		
		
		$('.notebookcall').click(function(){
			var sid = $('.booked_id').val();
			var comment = $('.notemsg').val();
			$.ajax({
                            type : 'POST',
                            url : '<?php echo base_url(); ?>experts/save_gp_notes',
                            dataType:'json',
                            data: {sid:sid,comment : comment },
                            success: function (data) 
                            {       
                                $('.closethispopup').click();  
                            }
                        });
		});
		
	</script>
</body>

</html>