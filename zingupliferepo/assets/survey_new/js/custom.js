$(document).ready(function(){
	var baseurl = $('.url').val();
	$('.height').keyup(function(){
			var weight = $('.weight').val();
			var height = $('.height').val();
			if(weight !='' && height != '')
			{
				var bmi_val = weight / (height * height);	
				var vale = 'BMI ' + bmi_val;
				$('.bmi').val(vale);
				$('.bminew').val(bmi_val);
			}
			else
			{
				//alert('Please enter Weight/Height details');
			}
		});
		
		$('.weight').keyup(function(){
			var weight = $('.weight').val();
			var height = $('.height').val();
			if(weight !='' && height != '')
			{
				var bmi_val = weight / (height * height);	
				var vale = 'BMI ' + bmi_val;
				$('.bmi').val(vale);
				$('.bminew').val(bmi_val);
			}
			else
			{
				//alert('Please enter Weight/Height details');
			}
		});
		
		$('.bmi').click(function(){
			var weight = $('.weight').val();
			var height = $('.height').val();
			if(weight !='' && height != '')
			{
				var bmi_val = weight / (height * height);
				var vale = 'BMI ' + bmi_val;
				$('.bmi').val(vale);
				$('.bminew').val(bmi_val);
			}
			else
			{
				//alert('Please enter Weight/Height details');
			}
		});
	
	$.validator.addMethod("alpha", function(value, element) {
			return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
		 });
		 
		 $('.promovalidate').validate();
		 
		 
		 $('#bmi').validate({
			  rules: {
				user_name : {
					required: true,
					alpha: true 
				}, 
                                phone: {
                                    required: true,
                                    number: true,
                                    maxlength: 10,
                                    minlength: 10
                                },
				age: {
				  required: true,
				  digits: true
				},
				weight: {
				  required: true,
				  digits: true
				},
				height: {
				  required: true,
				  number: true
				},
				body_type:
				{
					required: true,
				},
				agreesd:
				{
					required: true,
				},
				gender: {
					required: true
				},
				 password: "required",
				 repassword: {
				  equalTo: "#password"
				}
			  },
			  messages: {
				  user_name : 'Please enter name correctly',
				  gender:"You must check at least 1 box"
			  },
			  errorPlacement: function(error, element) {

				  if (element.attr("type") == "checkbox") {
					 error.insertAfter(element.parent().parent());
				   } else if (element.attr("type") != "radio") {
					 error.insertAfter(element.parent());

				}
				else  if (element.attr("type") == "radio") {
					 error.insertAfter(element.parent().parent());

				}
			  }
			});
			
		$('.action-button').click(function(){
			
			var v = $(this).attr('va');
			var t = $('.totc').text();
			var stat = $(this).attr('reach');
			var catype = $(this).attr('catype');
			var slug = $(this).attr('slug');
			var id = $(this).parent().next().find('.action-button').attr('id');
			
			/*if(stat == 'enable')
			{
				$('.nxt-btn').removeAttr('disabled');
				$('.nxt-btn').attr('catype',catype);
				$('.nxt-btn').attr('slug',slug);
				$('.nxt-btn').attr('btid',id);
				$(this).parent().next().find('.action-button').hide();
			}
			else if(stat == 'disable')
			{
				$('.nxt-btn').attr("disabled", "disabled");
				$(this).show();
			}
			
			$('.eachc').html(v);
			var per = parseInt(v)/parseInt(t) * 100;
			if(parseInt(per) == 25)
			{
				$('.addradio').attr('id','twentyfive');
				$('.addradio').next().html('25%');
			}
			else if(parseInt(per) == 50)
			{
				$('.addradio').attr('id','fifty');
				$('.addradio').next().html('50%');
			}
			else if(parseInt(per) == 75)
			{
				$('.addradio').attr('id','seventyfive');
				$('.addradio').next().html('75%');
			}
			else if(parseInt(per) == 100)
			{
				$('.addradio').attr('id','onehundred');
				$('.addradio').next().html('100%');
			}*/
		});
		
		$('.nxt-btn').click(function(){
			var dat = $('#msform').serialize();
			var ethis = $(this).parent().parent();
			var nthis = $(this);
			var catype = $(this).attr('catype');
			var slug = $(this).attr('slug');
			var id = $(this).attr('btid');
			$.ajax({ 
				type : "POST",
				url: baseurl + 'survey/next_survey_info_submit',
				dataType: "json",
				data: dat,
				success: function (data) {
					if(data)
					{
						
						$('.'+slug).attr('id',id)
						$('.'+slug).show();
						
						
					}
				}
			});
		});
		
		$('.assesment-btn').click(function(){
			
			var dat = $('#msform').serialize();
			var ethis = $(this).parent().parent();
			var nthis = $(this);
			var newurl = baseurl + 'survey/assessment1';
			$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/survey_info_submit',
				dataType: "json",
				data: dat,
				success: function (data) {
					if(data)
					{
						window.location.href = newurl; 
					}
				}
			});
		});
		
		$('.nxt-btn2').click(function(){
			var id = $(this).parent().attr('id');
			var catype = $(this).attr('catype');
			var register = $(this).attr('register');
			$(this).parent().hide();
			if(catype == 'physical')
			{
				
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/physical',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.emotionallist a').addClass('active');
			}
			if(catype == 'emotional')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/emotional',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.spirituallist a').addClass('active');
				$('.addradio').attr('id','twentyfive');
				$('.addradio').next().html('25%');
			}
			if(catype == 'spiritual')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/spiritual',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.sociallist a').addClass('active');
			}
			if(catype == 'intellectual')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/intellectual',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.occupationallist a').addClass('active');
			}
			if(catype == 'financial')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/financial',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.environmentallist a').addClass('active');
			}
			if(catype == 'social')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/social',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.intellectuallist a').addClass('active');
				$('.addradio').attr('id','fifty');
				$('.addradio').next().html('50%');
			}
			if(catype == 'occupational')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/occupational',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				
				$('.survey-list li a').removeClass('active');
				$('.survey-list li.financiallist a').addClass('active');
				$('.addradio').attr('id','seventyfive');
				$('.addradio').next().html('75%');
			}
			if(catype == 'environmental')
			{
				$.ajax({ 
					type : "POST",
					url: baseurl + 'survey/record_users_assessment_steps/environmental',
					dataType: "json",
					data: "physical",
					success: function (data) {
						window.location.href = newurl; 
					}
				});
				$('.addradio').attr('id','hundered');
				$('.addradio').next().html('100%');
			}
			if(catype != 'environmental')
			{
				if(catype == 'physical')
				{
					$('.desc').hide();
					$('.em').show();
				}
				$('button#'+id).click();
			}
			else
			{ 
					var url = baseurl + 'survey/assessment1';
					window.location.href = url;
				
			}
		});
		$('.promo-add').click(function(){
			var code = $(this).parent().prev().val();
			if(code != '' )
			{
				var thiss = $(this);
				var url = baseurl + 'survey/assessment1';
				$.ajax({ 
					type : "POST",
					url: baseurl + 'Survey/checkcode',
					dataType: "json",
					data: {code :code},
					success: function (data) {
						if(data)
						{
							$('.hidepromo').css('visibility','hidden');
							$('.hidepromo').css('margin-bottom','0px');
							$('.add-code').val(code);
							thiss.parent().parent().parent().prev().show();
							thiss.parent().parent().next().parent().parent().next().css('top','176px');
							window.location.href = url;
							//thiss.parent().submit();
						}
						else
						{
							thiss.parent().parent().next().parent().parent().next().css('top','215px');
							thiss.parent().parent().parent().prev().prev().show();
						}
					}
				});
			}
			else{
				$(this).parent().prev().prev().show();
			}
		});
		
		$('.submit-promo').click(function(){
			var thiss = $(this);
			thiss.parent().submit();
			/*var url = baseurl + 'survey/assessment1';
			window.location.href = url;
			var code = $(this).prev().val();
			if(code != '' )
			{
				var thiss = $(this);
				var url = baseurl + 'survey/assessment1';
				$.ajax({ 
					type : "POST",
					url: baseurl + '/Survey/checkcode',
					dataType: "json",
					data: {code :code},
					success: function (data) {
						if(data)
						{
							window.location.href = url;
							thiss.parent().submit();
						}
						else
						{
							thiss.parent().prev().show();
						}
					}
				});
			}
			else{
				$(this).parent().prev().prev().show();
			}*/
			
		});
		
		$('.submit-promo-logged').click(function(){
			var code = $(this).prev().prev('.code').val();
			var vistid = $(this).prev().val();
			var thiss = $(this);
			var url = baseurl + 'survey/assessment1';
			$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/checkloggedcode',
				dataType: "json",
				data: {code :code,vistid:vistid},
				success: function (data) {
					if(data)
					{
						$('.environmentalreg').attr('register','yes');
						thiss.parent().prev().show();
						setTimeout(function(){
						  $('.code-form').hide();
						}, 2000);
					}
					else
					{
						thiss.parent().prev().prev().show();
						setTimeout(function(){
						   $('.code-form').hide();
						}, 2000);
					}
				}
			});
			
			
		});
		
		$('.email_entered').first().keyup(function () {
			
			var email = this.value;
			
			if(email !='')
			{
				
				$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/checkemailregistered',
				dataType: "json",
				data: {email :email},
				success: function (data) {
					
						if(data)
						{
							$('.email-reg').html('You have already registered with this email id. Please <a href='+baseurl+'login>Login</a> to continue with assessment');
							$('.nxt-btn23').attr('disabled','disabled');
						}
						else{
							$('.email-reg').text(' ');
							$('.nxt-btn23').removeAttr('disabled');
						}
						
					}
				});
			}
		});

		$('.rad').click(function () {
			var email = $('.email_entered').val();
			if(email !='')
			{
				$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/checkemailregistered',
				dataType: "json",
				data: {email :email},
				success: function (data) {
						if(data)
						{
							$('.email-reg').html('You have already registered with this email id. Please <a href='+baseurl+'login>Login</a> to continue with assessment');
							$('.nxt-btn23').attr('disabled','disabled');
						}
						else{
							$('.email-reg').text(' ');
							$('.nxt-btn23').removeAttr('disabled');
						}
						
					}
				});
			}
		});

		$('.registr').click(function(){
			$('.risk').hide();
			$('.registration-form').show();
		});
		
		$('.register').click(function(){
			var valid = $('#bmi').valid();
			if(valid)
			{
				$.ajax({ 
				type : "POST",
				url: baseurl + '/Survey/register',
				dataType: "json",
				data: {email :email},
				success: function (data) {
						if(data)
						{
							$('.email-reg').html('You have already registered with this email id');
						}
						else{
							$('.email-reg').text(' ');
						}
						
					}
				});
			}
			
		});
		
		$('.get-access-code').click(function(){
			var phone = $('.get-access-code').val();
			if(phone !='')
			{
				$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/get_access_code',
				dataType: "json",
				data: {phone :phone},
				success: function (data) {
						if(data)
						{	
							
							$('.phone-reg').html('Code is sent to this number.');
							$('.access-code-form').show();
						
						}
						else{
							
						}
						
					}
				});
			}
		});
		$('.show-access-code-msg').click(function(){
			$('.phone-reg').html('Code is sent to this number.');
		
		});
		$('.submit-new-access-code').click(function(){
			var access = $('.access-code-ent').val();
			
			if(access !='')
			{
				$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/update_access_code',
				dataType: "json",
				data: {access :access},
				success: function (data) {
						if(data)
						{
							window.location.href = newurl; 
							$('.su-msg').show();
							$('.er-msg').hide();
							$('.access-code-form').hide(); 
							$('.registere-report').show();
						}
						else{
							$('.er-msg').show();
							$('.su-msg').hide();
						}
						
					}
				});
			}
			
		});
		

		
		

			
});