<?php $this->load->view('/includes/footer_ui');?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/jquery.scrolling-tabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

<!-- Javascript SVG parser and renderer on Canvas, used to convert SVG tag to Canvas -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/rgbcolor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/StackBlur.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_design/js/canvg.js"></script>

<script src="<?php echo base_url(); ?>assets/new_design/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/js/highcharts-more.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/js/exporting.js"></script>

<!--Start of Tawk.to Script-->
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


<script>
$(function () { 

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

	
	var scores = [];
	
	$('.score').each(function(){
			var va = $(this).val();
			scores.push(va);
		});
	
    $('#container').highcharts({

        chart: {
            polar: true,
            type: 'area',
			events: {
                load: function () {
					//alert();
                    
                }
            }
        },
        title: {
            text: 'Your Wellness Report',
            x: -80
        },
        pane: {
            size: '80%'
        },
        xAxis: {
            categories: ['Physical and Nutritional Wellness', 'Emotional', 'Spiritual', 'Relationship',
                    'Intellectual', 'Occupational','Financial','Environmental'],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },
        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },
        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}"><b>{point.y:,.0f}</b><br/>'
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 200,
            layout: 'vertical'
        },
        series: [{
            name: 'Scores',
            data: JSON.parse("[" + scores + "]"),
            pointPlacement: 'on'
        }]

    });
	
		setTimeout(function(){
			var url2 = $('.url').val();
			var svg = document.getElementById('container').children[0].innerHTML;
			canvg(document.getElementById('canvas'),svg);
			var img = canvas.toDataURL("image/png"); //img is data:image/png;base64
			img = img.replace('data:image/png;base64,', '');
			var id = $('.userid').val(); 
			var data2 = img;
			
			$.ajax({
				type: "POST",
				url:url2 + 'survey/savecharts',
				data: {data2:data2,id:id},
				success: function(data){
					var src = url2 + 'graph/' + data;
					$('.graph_img').attr('src',src);
				}
			});
		}, 2000);
});
</script>

<script src="//developer.appear.in/scripts/appearin-sdk.0.0.4.min.js"></script>
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
			var newurl = url2 + 'experts/user_live_session';
			var isWebRtcCompatible = appearin.isWebRtcCompatible();
			if(isWebRtcCompatible)
			{
				var video_link = 'https://appear.in/'+roomName;
				$.ajax({
					url:url2 + 'users/update_session_link',
					type     : "POST",
					dataType : 'JSON',
					data:{id:id,roomName:roomName},
					success :function(data){
						//window.open(data,'_blank');
						window.location.href = newurl;
					}
				});
			}
			else
			{
				alert('Sorry, The browser you are using is not compatible');
			}
		});
		
		$('.height').keyup(function(){
			var weight = $('.weight').val();
			var height = $('.height').val();
			if(weight !='' && height != '')
			{
				var bmi_val = weight / (height * height);	
				$('.bmi').val(bmi_val.toFixed(2));
			}
			
		});
		
		$('.bmi').click(function(){
			var weight = $('.weight').val();
			var height = $('.height').val();
			if(weight !='' && height != '')
			{
				var bmi_val = weight / (height * height);	
				$('.bmi').val(bmi_val.toFixed(2));
			}
			else
			{
				alert('Please enter Weight/Height details');
			}
		});
	});



</script>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-69869734-1', 'auto');
    ga('send', 'pageview');

</script>
<script>
    $('.payment_mode_selection').click(function () {
        var payment_mode = $(this).val();
        if (payment_mode == 'Pay at venue') {
            $('#pay_button').val('Book');
        } else {
            $('#pay_button').val('Pay');
        }
    });
</script>

<script>
    $('.package_carousel').carousel({
        interval: false
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
    $('#result_count').change(function () {
        var row_count = $(this).val();
        var city = $('#city').val();
        var keywords = $('#keywords').val();
        var location = $('#location').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>search_result_filter',
            data: {row_count: row_count, city: city, keywords: keywords, location: location},
            dataType: "html",
            success: function (data) {
                $('.container #filter_search_result').html('');
                $('.container #filter_search_result').append(data);

                $('body .selectpicker').selectpicker();

            }
        });
    });
</script>

<script>
    $('#result_count1').change(function () {
        var row_count = $(this).val();
        var keywords = $('#keywords').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>search_result_filter_show',
            data: {row_count: row_count, keywords: keywords},
            dataType: "html",
            success: function (data) {
                $('.container #filter_search_result').html('');
                $('#filter_search_result').append(data);
                $('body .selectpicker').selectpicker();
            }
        });
    });
</script>

<script>
    $('input,textarea').focus(function () {
        $(this).removeAttr('placeholder');
    });
</script>
<script type="text/javascript">

    $(document).ready(function () {
        $('body .selectpicker').selectpicker();
    });
    $(document).on('click', '.ntdelbutton', function () {
        $(this).parent('.tagcontent').remove();
        // console.log('infod');
    });
</script>
<script>
    var servcie_type = '<?php echo $service_type; ?>';
    var month = new Array();
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";

    var suffix = new Array("th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th");

    var slots_dates = "<?php echo $slots_dates; ?>";
    var slots_dates_array = slots_dates.split(',');
    var SelectedDate = [];
    $.each(slots_dates_array, function (index, value) {
        SelectedDate[index] = value;
    });
    $(document).ready(function () {
        $('#embeddingDatePicker').datepicker({
            format: 'yyyy-mm-dd',
            minDate: "+1M",
            todayHighlight: true,
            startDate: new Date(),
            beforeShowDay: highlightDay

        }).on('changeDate', function (e) {
            // Set the value for the date input
            $("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
            var selected_date = $("#embeddingDatePicker").datepicker('getFormattedDate');
            var service_id = '<?php echo $business_service_id; ?>';
            var d = new Date(selected_date);
            var selectedDate = d.getDate();
            if (selectedDate % 100 >= 11 && selectedDate % 100 <= 13) {
                var selectedDateDay = selectedDate + "th";
            } else {
                selectedDateDay = selectedDate + suffix[selectedDate % 10];
            }

            var selectedMonthName = month[d.getMonth()];
            var selectedYear = d.getFullYear();
            var finalSelectedDate = selectedDateDay + ' ' + selectedMonthName + ' ' + selectedYear;
            $('#available_slots #current_display_date').text('Available Slots for ' + finalSelectedDate + '');
            $('#selected_date_heading').text('Available Slots for ' + finalSelectedDate + '');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>get_available_slots_by_date',
                dataType: "json",
                data: {selected_date: selected_date, service_id: service_id},
                success: function (data) {

                    $('#available_slots_ctr').html('');
                    $('#available_dates_ctr').css('display', 'none');
                    $('#slots_messages').show();

                    if (data === 'no slots' && servcie_type === 'hourly') {
                        $('#available_slots_ctr').append('<h5 id="slots_messages">Slots not available for date you selected. Please choose other available date.</h5>');
                        $('.paymentBox').hide();
                    } else {

                        $('#available_slots_ctr').append('<input type="hidden" name="slot_id" value="' + data[0].id + '" id="choosed_slot_id"/>');
                        $(data).each(function (index, value) {

                            if (index == 0) {
                                var active = 'timeAcitve';
                            } else {
                                var active = '';
                            }

                            $('#slots_messages').hide();
                            $('#available_slots_ctr').append('<table>\n\
                                        <tbody id="available slots">\n\
                                            <tr>\n\
                                                <td>\n\
                                                    <button class="btn timeBtn rbutton ' + active + '" id="' + value.id + '">' + value.start_time + ' - ' + value.end_time + '</button>\n\
                                                </td>\n\
                                            </tr>\n\
                                        </tbody>\n\
                                    </table>');
                        });

                    }
                }
            });
            //available_slots
        });

        function highlightDay(date) {

            var d = date;
            var curr_date = ("0" + d.getDate()).slice(-2);
            var curr_month = ("0" + ((d.getMonth()) + 1)).slice(-2);
            var curr_year = d.getFullYear();
            var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;
            for (var i = 0; i < SelectedDate.length; i++) {
                if (SelectedDate[i] === formattedDate) {
                    return {classes: 'active', 'tooltip': SelectedDate[i]};
                }
            }
            return [true];
        }
		/*		
		var baseurl = $('.url').val();
		
		$('.get-access-code').click(function(){
			
			var email = $(this).prev().prev().val();
			var name = $(this).prev().val();
			var thiss = $(this);
			if(email !='')
			{
				$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/get_access_code',
				dataType: "json",
				data: {email :email,name:name},
				success: function (data) {
						if(data)
						{
							thiss.hide();
							thiss.next().show();
						}
						else{
							
						}
						
					}
				});
			}
		});
		
		$('.submit-new-access-code').click(function(){
			var access = $(this).prev().prev().val();
			var date = $(this).prev().val();
			var id = $(this).attr('id');
			if(access !='')
			{
				$.ajax({ 
				type : "POST",
				url: baseurl + 'Survey/update_access_code2',
				dataType: "json",
				data: {access :access},
				success: function (data) {
						if(data)
						{
							$('.download_link_'+id).html("<a href='<?php echo base_url();?>survey/report/"+data+"'>Download the report of the Survey taken on "+date+"</a>");
							$('.su-msg').show();
							$('.er-msg').hide();
							$('.access-code-form').hide(); 
							$('.registere-report').show();
						}
						else{
							$('.er-msg_'+id).show();
							$('.su-msg').hide();
						}
						
					}
				});
			}
			
		});
		*/
    });
</script>

<script language="javascript">
    $(function () {

        // add multiple select / deselect functionality
        $("#selectall").click(function () {
            $('.booking').attr('checked', this.checked);
            $(".bookAll").addClass("bookAllshow");
        });
        // if all checkbox are selected, check the selectall checkbox
        // and viceversa
        $(".booking").click(function () {

            if ($(".booking").length == $(".booking:checked").length) {
                $("#selectall").attr("checked", "checked");
                $(".bookAll").addClass("bookAllshow");
            } else {
                $("#selectall").removeAttr("checked");
                $(".bookAll").addClass("bookAllhide");
            }

        });
    });
</script>


<script>
$('.edit001').click(function () {
        $(".input_list").hide();
        $(".edit_user_profile").show();
    });
</script>
<script>
    $('body').on('click', '#stars i', function () {
        var index = $(this).index();
        var star = index + 1;
        $('#rating_star').val(star);
    });</script>
<script>
    $(document).ready(function () {
		/*created after 8th may*/
		$('.bmi_input').hide();
		$('.bmi_error').hide();
		$('.phy_error').hide();
		/**/
		$.validator.addMethod("alpha", function(value, element) {
			return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
		 });
		$('.basic_info2').on('click',function(){
			var cu = $(this).attr('id');
			$('.bmi_input').hide();
			$('.bmi_error').hide();
			$('.phy_error').hide();
			$('.phy_error').hide();
			$('.phy_input').hide();
			
			$('.em_input').hide();
			$('.sp_input').hide();
			$('.re_input').hide();
			$('.in_input').hide();
			$('.oc_input').hide();
			$('.fi_input').hide();
			$('.env_input').hide();
			
			$('#bmi').validate({
			  rules: {
				user_name : {
					required: true,
					alpha: true 
				}, 
				age: {
				  required: true,
				  digits: true
				},
				weight: {
				  required: true,
				  number: true
				},
				height: {
				  required: true,
				  number: true
				},
				body_type:
				{
					required: true,
				}
			  },
			  messages: {
				  user_name : 'Please enter name correctly'
			  }
			});
			
			var status =  $('#bmi').valid();
			if(status == true)
			{
				var weight = $('.weight').val();
				var height = $('.height').val();
				
				var bmi_val = weight / (height * height);				
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>Users/basic_info_submit',
					dataType: "json",
					data: $('.basic_info').serialize(),
					success: function (data) {
						if(data)
						{
							$('.userid').val(data);
							$('.'+cu).removeClass('active');
							$('.tab-content #'+cu).removeClass('active');
							$('.tab-content #'+cu).next().addClass('active');
							$('.'+cu).next().addClass('active');
							window.scrollTo(0,0);
							$('li.physical').attr('data-toggle','tab');
							$('li.emotional').attr('data-toggle','tab');
							$('li.spiritual').attr('data-toggle','tab');
							$('li.social').attr('data-toggle','tab');
							$('li.intellectual').attr('data-toggle','tab');
							$('li.occupational').attr('data-toggle','tab');
							$('li.financial').attr('data-toggle','tab');
							$('li.environmental').attr('data-toggle','tab');
						}
						else
						{
							var url = '<?php echo base_url(); ?>survey/survey_already_taken';
							window.location.assign(url);
							$('li.physical').attr('data-toggle','tab');
							$('li.emotional').attr('data-toggle','tab');
							$('li.spiritual').attr('data-toggle','tab');
							$('li.social').attr('data-toggle','tab');
							$('li.intellectual').attr('data-toggle','tab');
							$('li.occupational').attr('data-toggle','tab');
							$('li.financial').attr('data-toggle','tab');
							$('li.environmental').attr('data-toggle','tab');
						}
						/*if(data)
						{
							$('.bmi_input .bmi_rep').text(data);
							$('.bmi_input .bmi_val').text(bmi_val);
							$('.bmi_input').show();
							$('.bmi_error').hide();
						}
						else if(data == false){
							$('.bmi_error').text('Please enter correct values.');
							$('.bmi_error').show();
						}*/
					}
				});
				
				
			}
		});
		
		
		
		$('.physical_submit').on('click',function(){
			var cu = $(this).attr('id');
			$('.bmi_input').hide();
			$('.bmi_error').hide();
			$('.phy_error').hide();
			$('.phy_error').hide();
			$('.phy_input').hide();
			
			
			$('#bmi2').validate({
			  rules: {
				age: {
				  required: true,
				  digits: true
				},
				weight: {
				  required: true,
				  number: true
				},
				height: {
				  required: true,
				  number: true
				},
			  }
			});
			var status =  $(this).parent().parent().parent('#bmi2').valid();
			//var status =  true;
			var id = $(this).attr('id');
			//if(status == true)
			//{
				var dat = $(this).parent().parent().parent('.survey').serialize();
				$.ajax({
					type : "POST",
					url: '<?php echo base_url(); ?>Users/survey_info_submit',
					dataType: "json",
					data: dat,
					success: function (data) {
						if(id == 'environmental')
						{
							var url = '<?php echo base_url(); ?>survey/survey_taken/' + data ;
							window.location.assign(url);
						}
						/*if(id == 'physical')
						{
							$('.phy_input .yr_report').text(data[1]);
							$('.phy_input .yr_score').text(data[0]);
							$('.phy_input').show();
							$('.phy_error').hide();
						}
						else if(id == 'emotional')
						{
							$('.em_input .yr_report').text(data[1]);
							$('.em_input .yr_score').text(data[0]);
							$('.em_input').show();
							$('.phy_error').hide(); 
						}
						
						else if(id == 'spiritual')
						{
							$('.sp_input .yr_report').text(data[1]);
							$('.sp_input .yr_score').text(data[0]);
							$('.sp_input').show();
							$('.phy_error').hide(); 
						}
						else if(id == 'relationship')
						{
							$('.re_input .yr_report').text(data[1]);
							$('.re_input .yr_score').text(data[0]);
							$('.re_input').show();
							$('.phy_error').hide(); 
						}
						else if(id == 'intellectual')
						{
							$('.in_input .yr_report').text(data[1]);
							$('.in_input .yr_score').text(data[0]);
							$('.in_input').show();
							$('.phy_error').hide(); 
						}
						else if(id == 'occupational')
						{
							$('.oc_input .yr_report').text(data[1]);
							$('.oc_input .yr_score').text(data[0]);
							$('.oc_input').show();
							$('.phy_error').hide(); 
						}
						else if(id == 'financial')
						{
							$('.fi_input .yr_report').text(data[1]);
							$('.fi_input .yr_score').text(data[0]);
							$('.fi_input').show();
							$('.phy_error').hide(); 
						}
						else if(id == 'environmental')
						{
							$('.env_input .yr_report').text(data[1]);
							$('.env_input .yr_score').text(data[0]);
							$('.env_input').show();
							$('.phy_error').hide(); 
						}*/
					}
				});
				
				$('.'+cu).removeClass('active');
				$('.tab-content #'+cu).removeClass('active');
				$('.tab-content #'+cu).next().addClass('active');
				$('.'+cu).next().addClass('active');
				window.scrollTo(0,0);
			///}
			//else{
				/*$(this).parent().parent().parent().prev('.phy_error').text('All Questions are compulsory');
				$('.phy_error').show();
				$('.phy_input').hide();
				$('.em_input').hide();
				$('.sp_input').hide();
				$('.re_input').hide();
				$('.in_input').hide();
				$('.oc_input').hide();
				$('.fi_input').hide();
				$('.env_input').hide();*/
			//}
		});
		
		/*created after 8th may*/
        var upcoming_booking_dates = "<?php echo $upcoming_booking_dates; ?>";
        var upcoming_booking_dates_array = upcoming_booking_dates.split(',');
        var SelectedDates = [];
        $.each(upcoming_booking_dates_array, function (index, value) {
            SelectedDates[index] = value;
        });
        $('#dashDatePicker, #dashDatePicker01')
                .datepicker({
                    format: 'yyyy-mm-dd',
                    beforeShowDay: highlightDays
                })
                .on('changeDate', function (e) {
                    // Set the value for the date input
                    $("#selectedDate").val($("#embeddingDatePicker").datepicker('getFormattedDate'));
                });
        function highlightDays(date) {

            var d = date;
            var curr_date = ("0" + d.getDate()).slice(-2);
            var curr_month = ("0" + ((d.getMonth()) + 1)).slice(-2);
            var curr_year = d.getFullYear();
            var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;
            for (var i = 0; i < SelectedDates.length; i++) {
                if (SelectedDates[i] === formattedDate) {
                    return {classes: 'active', 'tooltip': SelectedDates[i]};
                }
            }
            return [true];
        }

    });</script>

<script type="text/javascript">

    $(document).ready(function () {
        $('body .selectpicker').selectpicker();
    });
    $('.dashTab>.nav-tabs').scrollingTabs();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('body .selectpicker').selectpicker();
        $("[id^=button]").click(function () {
            $('#info' + this.id.match(/\d+$/)[0]).toggle('1000');
            $('#glyphiconRight' + this.id.match(/\d+$/)[0]).toggleClass("hide");
            $('#glyphiconBottom' + this.id.match(/\d+$/)[0]).toggleClass("show");
        });
    });
</script>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('.search_category').click(function () {
        // $(this).parent().hide();

        var post_data = $('#post_data').val();
        var un_select = $(this).attr('id');

        $(".filter_cat li input").each(function (index) {
            var check_value = $(this).val();

            if (check_value == un_select) {
                $(this).removeAttr('checked');
                $('#' + check_value).parent().hide();
            } else {
            }

        });

        var checkValues = $('input[name=vendor]:checked').map(function ()
        {
            return $(this).val();
        }).get();

        // $('#result_count_filter').hide();

        $('.searchs_results_main_container').html('');
        $('.searchs_results_main_container').append('<div class="redirect_image filter_image">\n\
              <img src="<?php echo base_url(); ?>assets/css/images/redirect.gif" alt="redirect.gif"/>\n\
              <h4 class="redirect-head">Please wait, we are filetring your result...</h4>\n\
              </div>');

        $.ajax({
            type: "POST",
            url: base_url + 'filtering_search',
            data: {checkValues: checkValues, post_data: post_data},
            dataType: 'html',
            success: function (data) {
                $('.searchs_results_main_container').html('');
                $('.searchs_results_main_container').append(data);
            }
        });
    });


    $(".filter_cat li input").click(function () {

        var post_data = $('#post_data').val();
        var un_select = $(this).val();
        $(this).attr('checked','checked');
        $('#' + un_select).parent().show();



        var checkValues = $('input[name=vendor]:checked').map(function ()
        {
            return $(this).val();
        }).get();

        //$('#result_count_filter').hide();

        $('.searchs_results_main_container').html('');
        $('.searchs_results_main_container').append('<div class="redirect_image filter_image">\n\
              <img src="<?php echo base_url(); ?>assets/css/images/redirect.gif" alt="redirect.gif"/>\n\
              <h4 class="redirect-head">Please wait, we are filetring your result...</h4>\n\
              </div>');

        $.ajax({
            type: "POST",
            url: base_url + 'filtering_search',
            data: {checkValues: checkValues, post_data: post_data},
            dataType: 'html',
            success: function (data) {
                $('.searchs_results_main_container').html('');
                $('.searchs_results_main_container').append(data);
            }
        });
    });



</script>
<script>
    $('body').on('click', '.timeBtn', function () {
        // $('.timeBtn').on('click', function () {
        $('body tr .timeBtn').removeClass('timeAcitve');
        //$('tr .timeBtn').removeClass('timeAcitve');
        $(this).addClass('timeAcitve');
        $('body #choosed_slot_id').val($(this).attr('id'));
        //$(this).addClass('timeAcitve');

        //$(this).prop("disabled", true);
        return false;
    });
</script>

<script type="text/javascript" >
    $(document).ready(function () {
        $('.button-read-more1').click(function () {
            //$('.carouselDetail .height07').addClass('more-height');
            $(this).parent().prev().addClass('more-height');
        });
        $('.button-read-less1').click(function () {
            //$('.carouselDetail .height07').removeClass('more-height');
            $(this).parent().prev().removeClass('more-height');
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('.filterMenu>ul>li>input[type="checkbox"]').click(function () {
            if ($(this).attr("value") == "spa") {
                $(".spa").toggle();
            }
            if ($(this).attr("value") == "yoga") {
                $(".yoga").toggle();
            }
            if ($(this).attr("value") == "ayurveda") {
                $(".ayurveda").toggle();
            }

            if ($(this).attr("value") == "fitness") {
                $(".fitness").toggle();
            }
        });
    });
</script>




<script>
    $('#upload_photo_btn').hide();
    $('.choose_file_class').click(function () {
        $(this).parent().hide();
        $('#upload_photo_btn').show();
    });
</script>
<script>
if(document.getElementById("upload-file-selector") != null)
	{
    document.getElementById("upload-file-selector").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("image_preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
	}
</script>

<script>
    $(document).ready(function () {
    	$(".edit_user_profile").hide();
        });
</script>

<script>
$('body').on('click', '.user_profile_update', function (e) {
	var vali = $('.validation').valid();
	var phone_no = $('#phone').val();
	if(vali && phone_no.length==10)
	{
		$('#update_user_profile').submit();
	}else{
		e.preventDefault();
	}	
});

$( "#phone" ).keyup(function() {
	var phone_no = $('#phone').val();
	if(phone_no.length!=10 && phone_no.length!=0 && (!isNaN(phone_no))){
		$('.phonerror').show();
	}else{
		$('.phonerror').hide();
		}
	});
</script>

</body>
</html>