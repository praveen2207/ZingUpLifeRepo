<footer class="admin-footer">
    <!--    <ul class="footer-list footer-admin-list">
            <li><a href="">Home</a></li>
            <li>|</li>
            <li><a href="">About us</a></li>
            <li>|</li>
            <li><a href="">Feed back</a></li>
            <li>|</li>
            <li><a href="">Customer Support</a></li>
            <li>|</li>
            <li><a href="">Register as Vendor</a></li>
            <li>|</li>
            <li><a href="">Contact us</a></li>
        </ul>-->

    <p class="footer-para footer-admin-para">Copyright &copy; 2000-2015 Zing Up Life. All rights reserved.</p>
</footer>
</div> 

<!-- /container -->
<link href="<?php echo base_url(); ?>assets/admin/css/booking_calender.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/admin/js/jquery.validate.js'></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/custom.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.plugin.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.datepick.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/experts_new/js/jquery-ui.js"></script>


<!-- css for daterangepicker  -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css	/daterangepicker.css" />

<script type="text/javascript">

 $(function () {
		
		$('.main-service').change(function(){
		if($(this).val() !='')
		{
			$('.programs').empty();	
			var url2 = $('.url').val();
			var service_id = $(this).val();
			$.ajax({
			dataType: 'json',
			type:'POST',
			url:url2 + 'sme/get_programs',
			data:{
			  service :service_id
			},
			success :function(data){
					var res = '<label class="control-label" for="select01">Business Programs</label> <div class="customer-edit-input"><select id="select01" name="programs" class="required programs"><option value="">Select Program</option> ';
					$.each(data, function(i, item) {
						res += '<option value='+item.id+'>'+item.program+'</option>';
					});
					res += '</select></div>';
					$('.programs').append(res);	
				}
			
			},'json');
		}
		
	});
	
	$('body').on('change', '.programs', function (){ 
		if($(this).val() !='')
		{
			$('.offerings').empty();
			var url2 = $('.url').val();
			var program_id = $(this).val();
			$.ajax({
			dataType: 'json',
			type:'POST',
			url:url2 + 'sme/get_offerings',
			data:{
			  program_id :program_id
			},
			success :function(data){
					var res = '<label class="control-label" for="select01">Business Services</label><div class="customer-edit-input"><select id="select01" name="offering" class="required offerings"><option value="">Select Service</option> ';
					$.each(data, function(i, item) {
						res += '<option value='+item.id+'>'+item.services+'</option>';
					});
					res += '</select></div>';
					$('.offerings').append(res);	
				}
			
			},'json');
		}
	});
		
		
		
        $('#inlineDatepicker1').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            altField: '#admin_reschedule_date', altFormat: 'yyyy-mm-dd',
            onSelect: showDate
        });
    });

    function showDate(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#admin_reschedule_date').val(current_date);
    }


    $(function () {

        $('#inlineDatepicker2').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            altField: '#admin_reschedule_date', altFormat: 'yyyy-mm-dd',
            onSelect: showDate2
        });
    });

    function showDate2(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#admin_reschedule_date').val(current_date);
    }


$(function () {

        $('#sme_event_date').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            onSelect: showDate3
        });
    });

    function showDate3(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
    }

$(function () {

        $('#edit_sme_event_date').datepick({
            minDate: new Date(),
            maxDate: new Date(2016, 12 - 1, 31),
            yearRange: '2015:2016',
            dateFormat: 'yyyy-mm-dd',
            onSelect: showDate4
        });
    });

    function showDate4(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
    }


    var base_url = '<?php echo base_url(); ?>';
    var currentDate = new Date();
    $("#dp1").datepicker('setValue', currentDate).datepicker('update');
    var startDate = new Date('<?php
if (isset($start_date)) {
    echo $start_date;
} else {
    echo date("Y/m/d");
}
?>');
    ;
    var endDate = new Date('<?php
if (isset($end_date)) {
    echo $end_date;
} else {
    echo date('Y/m/d', strtotime('-30 days'));
}
?>');
    $('#dp4').datepicker()
            .on('changeDate', function (ev) {

                if (ev.date.valueOf() < endDate.valueOf()) {
                    alert('The start date can not be less then the end date');
                } else {

                    startDate = new Date(ev.date);
                    $('#startDate').text($('#dp4').data('date'));
                    var end_date = $('#startDate').text();
                    var start_date = $('#endDate').text();
                    // alert(end_date);
                    $.ajax({
                        url: '<?php echo base_url(); ?>customer_support/transactions_filter',
                        type: 'POST',
                        data: {end_date: end_date, start_date: start_date},
                        dataType: "json",
                        success: function (data) {
                            $('#cs_transactions_filter').html('');
                            var len = Object.keys(data).length;
                            var result = '';
                            if (len > 0)
                            {
                                $.each(data, function (index, value) {
                                    var dateAr = value['transactions'].booking_date.split(' ');
                                    var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                                    var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                                    var time = dateAr[1].split(':');
                                    var ti = time[0] + ':' + time[1];
                                    if (time[0] >= '12')
                                    {
                                        var meridian = 'PM';
                                    }
                                    else
                                    {
                                        var meridian = 'AM';
                                    }
                                    if (value.duration > 1)
                                    {
                                        var hours = 'hours';
                                    }
                                    else
                                    {
                                        var hours = 'hour';
                                    }
                                    var trandate = value['transactions'].date.split('-');
                                    var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                                    var stime = value['transactions'].start_time.split(':');
                                    var sti = stime[0] + ':' + stime[1];
                                    if (stime[0] >= '12')
                                    {
                                        var meridian2 = 'PM';
                                    }
                                    else
                                    {
                                        var meridian2 = 'AM';
                                    }

                                    var status = '';
                                    if (value['transactions'].expiry == "no") {
                                        if (value['transactions'].booking_status == "Pending") {
                                            status += '<span class="blue medium actions confirmorder"> Confirm Order</span>';
                                        } else {
                                            status += '<span class="blue medium actions remind-customer">Remind Customer</span>';
                                        }
                                    }
                                    var attend = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['mark_attend'] != undefined) {
                                            if (value['mark_attend'].status == 'Not-attended') {
                                                attend += '<a id="' + value['user_details'].id + ' . ' - ' . ' + value['transactions'].booking_id + ' . ' - ' . ' + value['transactions'].slot_id + '" class="blue markattend" href="">Mark as Attended</a>';
                                            }
                                            else
                                            {
                                                attend += 'Attended';
                                            }
                                        }
                                    }
                                    var remind = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Pending') {
                                            remind += 'Remind Customer';
                                        }
                                    }
                                    var confirmed = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Success') {
                                            confirmed += '<i class="fa fa-check fa-confirm"></i>Confirmed';
                                        }
                                    }

                                    result += '<tr id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '">' +
                                            '<td class="blue">' + value['transactions'].booking_id + '</td>' +
                                            '<td>' + book_date + '<br/>' + ti + ' ' + meridian + '</td>' +
                                            '<td class="blue">' + value['user_details'].id + '</td>' +
                                            '<td class="blue word_break word_break_down">' + value['user_details'].username + '</td>' +
                                            '<td class=""><span class="blue v-name word_break word_break_down">' + value['vendor_details'].name + '</span> <br/>' + value['vendor_details'].area_name + '</td>' +
                                            '<td><span class="blue v-name word_break word_break_down">' + value['transactions'].services + '</span><br/>' + value['transactions'].duration + '</td>' +
                                            '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                            '<td>' + value['transactions'].amount + '</td>' +
                                            '<td class="action-td">' + status +
                                            '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<div class="actions-dropdown">' +
                                            '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<ul class="actions-list">' +
                                            '<li>' + attend + '</li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="blue" href="">' + remind + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="green" href="">' + confirmed + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="blue" href="' + base_url + 'customer_support/order_details/' + value['transactions'].booking_id + '">View Order Detail</a></li>' +
                                            '</ul>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                });
                            }
                            else
                            {
                                result += '<tr class="odd">' +
                                        '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                        '</tr>';
                            }

                            $('#cs_transactions_filter').append(result);

                        }
                    });
                }
            });
    $('#dp5').datepicker()
            .on('changeDate', function (ev) {
                if (ev.date.valueOf() > startDate.valueOf()) {
                    alert('The end date can not be greater then the start date');
                } else {

                    endDate = new Date(ev.date);
                    $('#endDate').text($('#dp5').data('date'));
                    var end_date = $('#startDate').text();
                    var start_date = $('#endDate').text();
                    // alert(end_date);
                    $.ajax({
                        url: '<?php echo base_url(); ?>customer_support/transactions_filter',
                        type: 'POST',
                        data: {end_date: end_date, start_date: start_date},
                        dataType: "json",
                        success: function (data) {
                            $('#cs_transactions_filter').html('');
                            var len = Object.keys(data).length;
                            var result = '';
                            if (len > 0)
                            {
                                $.each(data, function (index, value) {
                                    var dateAr = value['transactions'].booking_date.split(' ');
                                    var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                                    var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                                    var time = dateAr[1].split(':');
                                    var ti = time[0] + ':' + time[1];
                                    if (time[0] >= '12')
                                    {
                                        var meridian = 'PM';
                                    }
                                    else
                                    {
                                        var meridian = 'AM';
                                    }
                                    if (value.duration > 1)
                                    {
                                        var hours = 'hours';
                                    }
                                    else
                                    {
                                        var hours = 'hour';
                                    }

                                    var trandate = value['transactions'].date.split('-');
                                    var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                                    var stime = value['transactions'].start_time.split(':');
                                    var sti = stime[0] + ':' + stime[1];
                                    if (stime[0] >= '12')
                                    {
                                        var meridian2 = 'PM';
                                    }
                                    else
                                    {
                                        var meridian2 = 'AM';
                                    }
                                    var status = '';
                                    if (value['transactions'].expiry == "no") {
                                        if (value['transactions'].booking_status == "Pending") {
                                            status += '<span class="blue medium actions confirmorder"> Confirm Order</span>';
                                        } else {
                                            status += '<span class="blue medium actions remind-customer">Remind Customer</span>';
                                        }
                                    }
                                    var attend = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['mark_attend'] != undefined) {
                                            if (value['mark_attend'].status == 'Not-attended') {
                                                attend += '<a id="' + value['user_details'].id + ' . ' - ' . ' + value['transactions'].booking_id + ' . ' - ' . ' + value['transactions'].slot_id + '" class="blue markattend" href="">Mark as Attended</a>';
                                            }
                                            else
                                            {
                                                attend += 'Attended';
                                            }
                                        }
                                    }
                                    var remind = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Pending') {
                                            remind += 'Remind Customer';
                                        }
                                    }
                                    var confirmed = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Success') {
                                            confirmed += '<i class="fa fa-check fa-confirm"></i>Confirmed';
                                        }
                                    }
                                    result += '<tr id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '">' +
                                            '<td class="blue">' + value['transactions'].booking_id + '</td>' +
                                            '<td>' + book_date + '<br/>' + ti + ' ' + meridian + '</td>' +
                                            '<td class="blue">' + value['user_details'].id + '</td>' +
                                            '<td class="blue word_break word_break_down">' + value['user_details'].username + '</td>' +
                                            '<td class=""><span class="blue v-name word_break word_break_down">' + value['vendor_details'].name + '</span> <br/>' + value['vendor_details'].area_name + '</td>' +
                                            '<td><span class="blue v-name word_break word_break_down">' + value['transactions'].services + '</span><br/>' + value['transactions'].duration + '</td>' +
                                            '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                            '<td>' + value['transactions'].amount + '</td>' +
                                            '<td class="action-td">' + status +
                                            '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<div class="actions-dropdown">' +
                                            '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<ul class="actions-list">' +
                                            '<li>' + attend + '</li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="blue" href="">' + remind + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="green" href="">' + confirmed + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="blue" href="' + base_url + 'customer_support/order_details/' + value['transactions'].booking_id + '">View Order Detail</a></li>' +
                                            '</ul>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                });
                            }
                            else
                            {
                                result += '<tr class="odd">' +
                                        '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                        '</tr>';
                            }

                            $('#cs_transactions_filter').append(result);

                        }
                    });
                }

            });
    $('#dp6').datepicker()
            .on('changeDate', function (ev) {

                if (ev.date.valueOf() < endDate.valueOf()) {
                    alert('The start date can not be less then the end date');
                } else {

                    startDate = new Date(ev.date);
                    $('#startDate').text($('#dp6').data('date'));
                    var end_date = $('#startDate').text();
                    var start_date = $('#endDate').text();
                    // alert(end_date);
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/transactions_filter',
                        type: 'POST',
                        data: {end_date: end_date, start_date: start_date},
                        dataType: "json",
                        success: function (data) {
                            $('#admin_transactions_filter').html('');
                            var len = Object.keys(data).length;
                            var result = '';
                            if (len > 0)
                            {
                                $.each(data, function (index, value) {
                                    var dateAr = value['transactions'].booking_date.split(' ');
                                    var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                                    var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                                    var time = dateAr[1].split(':');
                                    var ti = time[0] + ':' + time[1];
                                    if (time[0] >= '12')
                                    {
                                        var meridian = 'PM';
                                    }
                                    else
                                    {
                                        var meridian = 'AM';
                                    }
                                    if (value.duration > 1)
                                    {
                                        var hours = 'hours';
                                    }
                                    else
                                    {
                                        var hours = 'hour';
                                    }
                                    var trandate = value['transactions'].date.split('-');
                                    var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                                    var stime = value['transactions'].start_time.split(':');
                                    var sti = stime[0] + ':' + stime[1];
                                    if (stime[0] >= '12')
                                    {
                                        var meridian2 = 'PM';
                                    }
                                    else
                                    {
                                        var meridian2 = 'AM';
                                    }
                                    var confirmorder = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Pending') {
                                            confirmorder += '<span class="blue medium actions admin_confirmorder">Confirm Order</span>';
                                        }
                                        else
                                        {
                                            if (value['mark_attend'] != undefined) {
                                                if (value['mark_attend'].status == 'Not-attended') {
                                                    confirmorder += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                                                }
                                            }
                                        }
                                    }
                                    var attend = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['mark_attend'] != undefined) {
                                            if (value['mark_attend'].status == 'Not-attended') {
                                                attend += '<a id="' + value['user_details'].id + ' . ' - ' . ' + value['transactions'].booking_id + ' . ' - ' . ' + value['transactions'].slot_id + '" class="blue admin_markattend" href="">Mark as Attended</a>';
                                            } else {
                                                attend += 'Attended';
                                            }
                                        }
                                    }
                                    var remind = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Pending') {
                                            remind += 'Remind Customer';
                                        }
                                    }
                                    var confirmed = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Success') {
                                            confirmed += '<i class="fa fa-check fa-confirm"></i>Confirmed';
                                        }
                                    }
                                    result += '<tr id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '">' +
                                            '<td class="blue">' + value['transactions'].booking_id + '</td>' +
                                            '<td>' + book_date + '<br/>' + ti + ' ' + meridian + '</td>' +
                                            '<td class="blue">' + value['user_details'].id + '</td>' +
                                            '<td class="blue word_break word_break_down">' + value['user_details'].username + '</td>' +
                                            '<td class=""><span class="blue v-name word_break word_break_down">' + value['vendor_details'].name + '</span> <br/>' + value['vendor_details'].area_name + '</td>' +
                                            '<td><span class="blue v-name word_break word_break_down">' + value['transactions'].services + '</span><br/>' + value['transactions'].duration + '</td>' +
                                            '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                            '<td>' + value['transactions'].amount + '</td>' +
                                            '<td class="action-td">' + confirmorder + '</span>' +
                                            '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<div class="actions-dropdown">' +
                                            '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<ul class="actions-list">' +
                                            '<li>' + attend + '</li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="">' + remind + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="green" href="">' + confirmed + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="' + base_url + 'admin/order_details/' + value['transactions'].booking_id + '">View Order Detail</a></li>' +
                                            '</ul>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                });
                            }
                            else
                            {
                                result += '<tr class="odd">' +
                                        '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                        '</tr>';
                            }

                            $('#admin_transactions_filter').append(result);

                        }
                    });
                }
            });
    $('#dp7').datepicker()
            .on('changeDate', function (ev) {
                if (ev.date.valueOf() > startDate.valueOf()) {
                    alert('The end date can not be greater then the start date');
                } else {

                    endDate = new Date(ev.date);
                    $('#endDate').text($('#dp7').data('date'));
                    var end_date = $('#startDate').text();
                    var start_date = $('#endDate').text();
                    // alert(end_date);
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/transactions_filter',
                        type: 'POST',
                        data: {end_date: end_date, start_date: start_date},
                        dataType: "json",
                        success: function (data) {
                            $('#admin_transactions_filter').html('');
                            var len = Object.keys(data).length;
                            var result = '';
                            if (len > 0)
                            {
                                $.each(data, function (index, value) {
                                    var dateAr = value['transactions'].booking_date.split(' ');
                                    var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                                    var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                                    var time = dateAr[1].split(':');
                                    var ti = time[0] + ':' + time[1];
                                    if (time[0] >= '12')
                                    {
                                        var meridian = 'PM';
                                    }
                                    else
                                    {
                                        var meridian = 'AM';
                                    }
                                    if (value.duration > 1)
                                    {
                                        var hours = 'hours';
                                    }
                                    else
                                    {
                                        var hours = 'hour';
                                    }
                                    var trandate = value['transactions'].date.split('-');
                                    var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                                    var stime = value['transactions'].start_time.split(':');
                                    var sti = stime[0] + ':' + stime[1];
                                    if (stime[0] >= '12')
                                    {
                                        var meridian2 = 'PM';
                                    }
                                    else
                                    {
                                        var meridian2 = 'AM';
                                    }
                                    var confirmorder = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Pending') {
                                            confirmorder += '<span class="blue medium actions admin_confirmorder">Confirm Order</span>';
                                        }
                                        else
                                        {
                                            if (value['mark_attend'].status != undefined) {
                                                if (value['mark_attend'] == 'Not-attended') {
                                                    confirmorder += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                                                }
                                            }
                                        }
                                    }
                                    var attend = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['mark_attend'] != undefined) {
                                            if (value['mark_attend'].status == 'Not-attended') {
                                                attend += '<a id="' + value['user_details'].id + ' . ' - ' . ' + value['transactions'].booking_id + ' . ' - ' . ' + value['transactions'].slot_id + '" class="blue admin_markattend" href="">Mark as Attended</a>';
                                            } else {
                                                attend += 'Attended';
                                            }
                                        }
                                    }
                                    var remind = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Pending') {
                                            remind += 'Remind Customer';
                                        }
                                    }
                                    var confirmed = '';
                                    if (value['transactions'].expiry == 'no') {
                                        if (value['transactions'].booking_status == 'Success') {
                                            confirmed += '<i class="fa fa-check fa-confirm"></i>Confirmed';
                                        }
                                    }
                                    result += '<tr id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '">' +
                                            '<td class="blue">' + value['transactions'].booking_id + '</td>' +
                                            '<td>' + book_date + '<br/>' + ti + ' ' + meridian + '</td>' +
                                            '<td class="blue">' + value['user_details'].id + '</td>' +
                                            '<td class="blue word_break word_break_down">' + value['user_details'].username + '</td>' +
                                            '<td class=""><span class="blue v-name word_break word_break_down">' + value['vendor_details'].name + '</span> <br/>' + value['vendor_details'].area_name + '</td>' +
                                            '<td><span class="blue v-name word_break word_break_down">' + value['transactions'].services + '</span><br/>' + value['transactions'].duration + ' </td>' +
                                            '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                            '<td>' + value['transactions'].amount + '</td>' +
                                            '<td class="action-td">' + confirmorder + '</span>' +
                                            '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<div class="actions-dropdown">' +
                                            '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>' +
                                            '<ul class="actions-list">' +
                                            '<li>' + attend + '</li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="">' + remind + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="green" href="">' + confirmed + '</a></li>' +
                                            '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="' + base_url + 'admin/order_details/' + value['transactions'].booking_id + '">View Order Detail</a></li>' +
                                            '</ul>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                });
                            }
                            else
                            {
                                result += '<tr class="odd">' +
                                        '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                        '</tr>';
                            }

                            $('#admin_transactions_filter').append(result);

                        }
                    });
                }

            });
    $('#dp8').datepicker().on('changeDate', function (ev) {

        joining_date = new Date(ev.date);
        $('#joining_date').text($('#dp8').data('date'));
        var joining_date = $('#joining_date').text();
        $.ajax({
            url: '<?php echo base_url(); ?>customer_support/customers_filter',
            type: 'POST',
            data: {joining_date: joining_date},
            dataType: "json",
            success: function (data) {
                $('.customer-table').empty();
                var result = '<table id="example1" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="filter-input">Customer ID</th>' +
                        '<th class="filter-input">Customer Name</th>' +
                        '<th>Join Date</th>' +
                        '<th class="filter-input">Gender</th>' +
                        '<th class="">Phone No.</th>' +
                        '<th>Photo <br/> Status</th>' +
                        '<th>Email IDs</th>' +
                        '<th>Recent Order IDs</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                if (data != "null")
                {

                    $.each(data, function (index, value) {
                        if (value.phone == '') {
                            var phone = '-';
                        } else {
                            var phone = '+91 ' + value.phone;
                        }

                        var date = value.created_on;
                        var dateSplit = date.split(" ");
                        var dateSplit2 = dateSplit[0].split("-");
                        var joined_date = dateSplit2.join('/');


                        result += '<tr>' +
                                '<td class="blue">' + value.user_id + '</td>' +
                                '<td class="blue word_break word_break_down"><a class="blue mail-id" href="' + base_url + 'customer_support/customer_details/' + value.user_id + '">' + value.name + '</a></td>' +
                                '<td>' + joined_date + '</td>' +
                                '<td>' + value.gender + '</td>' +
                                '<td>' + phone + '</td>' +
                                '<td class="blue">Pending</td>' +
                                '<td class="blue word_break word_break_down">' + value.username + '</td>' +
                                '<td class="blue ellipse word_break">' + value.orders + '</td>' +
                                '</tr>';
                    });

                }
                else if (data == "null")
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="8">No matching records found</td>' +
                            '</tr>';

                }


                result += '</tbody>' +
                        '</table>';
                $('.customer-table').append(result);
                $('#example1').dataTable().fnDestroy();
                $('#example1').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }

        });
    });


    $('#dp10').datepicker().on('changeDate', function (ev) {
        if (ev.date.valueOf() < endDate.valueOf()) {
            alert('The start date can not be less then the end date');
        } else {

            startDate = new Date(ev.date);
            $('#startDate').text($('#dp10').data('date'));
            var cs_id = $('#current_customer_id').val();
            var service = $('#filter_transaction_by_services').val();
            var start_date = $(this).text();
            var end_date = $('#admin_customer_details_filter #endDate').text();

            $.ajax({
                url: base_url + 'admin/customer_transactions_filter',
                type: 'POST',
                data: {cs_id: cs_id, service: service, start_date: start_date, end_date: end_date},
                dataType: "json",
                success: function (data) {
                    $('#cs_customer_transaction_table_filter').empty();
                    var trans_len = data['transactions'].length;
                    var result = '';
                    if (trans_len != 0)
                    {
                        $.each(data['transactions'], function (index, value) {
                            var dateAr = value.booking_date.split(' ');
                            var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                            var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                            var time = dateAr[1].split(':');
                            var ti = time[0] + ':' + time[1];
                            if (time[0] >= '12')
                            {
                                var meridian = 'PM';
                            }
                            else
                            {
                                var meridian = 'AM';
                            }
                            if (value.duration > 1)
                            {
                                var hours = 'hours';
                            }
                            else
                            {
                                var hours = 'hour';
                            }
                            var trandate = value.date.split('-');
                            var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                            var stime = value.start_time.split(':');
                            var sti = stime[0] + ':' + stime[1];
                            if (stime[0] >= '12')
                            {
                                var meridian2 = 'PM';
                            }
                            else
                            {
                                var meridian2 = 'AM';
                            }
                            var status = '';
                            var now = new Date();
                            var day = ("0" + now.getDate()).slice(-2);
                            var month = ("0" + (now.getMonth() + 1)).slice(-2);
                            var current_date = now.getFullYear() + "-" + (month) + "-" + (day);
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    status += '<span class="blue medium actions admin_confirmorder">Confirm Order</span>';
                                } else {
                                    if (value.mark_attend != undefined) {
                                        if (value.mark_attend == 'Not-attended') {
                                            status += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                                        }
                                    }
                                }
                            }

                            var attend = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.mark_attend != undefined) {
                                    if (value.mark_attend == 'Not-attended') {
                                        attend += '<a id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '"                                                         class="blue admin_markattend" href="">Mark as Attended</a>';
                                    } else {
                                        attend += 'Attended';
                                    }
                                }
                            }
                            var remind = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    remind += '<a href="" class="blue" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">Remind Customer</a>';
                                }
                            }
                            var confirmed = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Success') {
                                    confirmed += '<a href="" class="green" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">><i class="fa fa-check fa-confirm"></i>Confirmed</a>';
                                }
                            }
                            result += '<tr id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '" role="row" class="odd">' +
                                    '<td class="blue sorting_1">' + value.booking_id + '</td>' +
                                    '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                    '<td class="blue word_break_down">' + data['user_details'].name + '</td>' +
                                    '<td class=""><span class="blue v-name word_break_down">' + value['vendor_details'].name + '</span> <br>' + value['vendor_details'].area_name + '</td>' +
                                    '<td><span class="blue v-name word_break_down">' + value.services + '</span><br>' + value.duration + '</td>' +
                                    '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                    '<td>' + value.amount + '</td>' +
                                    '<td class="action-td">' + status +
                                    '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                    '<div class="actions-dropdown">	' +
                                    '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>	' +
                                    '<ul class="actions-list">' +
                                    '<li>' + attend + '</li>' +
                                    '<li>' + remind + '</li>' +
                                    '<li>' + confirmed + '</li>' +
                                    '<li><a href="' + base_url + 'admin/order_details/' + value.booking_id + '" class="blue" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">View Order Detail</a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';
                        });
                    }
                    else if (trans_len == 0)
                    {
                        result += '<tr class="odd">' +
                                '<td class="dataTables_empty" valign="top" colspan="8">No matching records found</td>' +
                                '</tr>';
                    }
                    $('#cs_customer_transaction_table_filter').append(result);
                }
            });
        }
    });
    $('#dp11').datepicker().on('changeDate', function (ev) {

        if (ev.date.valueOf() > startDate.valueOf()) {
            alert('The end date can not be greater then the start date');
        } else {

            endDate = new Date(ev.date);
            $('#endDate').text($('#dp11').data('date'));
            var cs_id = $('#current_customer_id').val();
            var service = $('#filter_transaction_by_services').val();
            var start_date = $('#admin_customer_details_filter #startDate').text();
            var end_date = $(this).text();

            $.ajax({
                url: base_url + 'admin/customer_transactions_filter',
                type: 'POST',
                data: {cs_id: cs_id, service: service, start_date: start_date, end_date: end_date},
                dataType: "json",
                success: function (data) {
                    $('#cs_customer_transaction_table_filter').empty();
                    var trans_len = data['transactions'].length;
                    var result = '';
                    if (trans_len != 0)
                    {
                        $.each(data['transactions'], function (index, value) {
                            var dateAr = value.booking_date.split(' ');
                            var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                            var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                            var time = dateAr[1].split(':');
                            var ti = time[0] + ':' + time[1];
                            if (time[0] >= '12')
                            {
                                var meridian = 'PM';
                            }
                            else
                            {
                                var meridian = 'AM';
                            }
                            if (value.duration > 1)
                            {
                                var hours = 'hours';
                            }
                            else
                            {
                                var hours = 'hour';
                            }
                            var trandate = value.date.split('-');
                            var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                            var stime = value.start_time.split(':');
                            var sti = stime[0] + ':' + stime[1];
                            if (stime[0] >= '12')
                            {
                                var meridian2 = 'PM';
                            }
                            else
                            {
                                var meridian2 = 'AM';
                            }
                            var status = '';
                            var now = new Date();
                            var day = ("0" + now.getDate()).slice(-2);
                            var month = ("0" + (now.getMonth() + 1)).slice(-2);
                            var current_date = now.getFullYear() + "-" + (month) + "-" + (day);
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    status += '<span class="blue medium actions admin_confirmorder">Confirm Order</span>';
                                } else {
                                    if (value.mark_attend != undefined) {
                                        if (value.mark_attend == 'Not-attended') {
                                            status += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                                        }
                                    }
                                }
                            }

                            var attend = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.mark_attend != undefined) {
                                    if (value.mark_attend == 'Not-attended') {
                                        attend += '<a id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '"                                                         class="blue admin_markattend" href="">Mark as Attended</a>';
                                    } else {
                                        attend += 'Attended';
                                    }
                                }
                            }
                            var remind = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    remind += '<a href="" class="blue" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">Remind Customer</a>';
                                }
                            }
                            var confirmed = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Success') {
                                    confirmed += '<a href="" class="green" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">><i class="fa fa-check fa-confirm"></i>Confirmed</a>';
                                }
                            }
                            result += '<tr id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '" role="row" class="odd">' +
                                    '<td class="blue sorting_1">' + value.booking_id + '</td>' +
                                    '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                    '<td class="blue word_break_down">' + data['user_details'].name + '</td>' +
                                    '<td class=""><span class="blue v-name word_break_down">' + value['vendor_details'].name + '</span> <br>' + value['vendor_details'].area_name + '</td>' +
                                    '<td><span class="blue v-name word_break_down">' + value.services + '</span><br>' + value.duration + '</td>' +
                                    '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                    '<td>' + value.amount + '</td>' +
                                    '<td class="action-td">' + status +
                                    '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                    '<div class="actions-dropdown">	' +
                                    '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>	' +
                                    '<ul class="actions-list">' +
                                    '<li>' + attend + '</li>' +
                                    '<li>' + remind + '</li>' +
                                    '<li>' + confirmed + '</li>' +
                                    '<li><a href="' + base_url + 'admin/order_details/' + value.booking_id + '" class="blue" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">View Order Detail</a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';
                        });
                    }
                    else if (trans_len == 0)
                    {
                        result += '<tr class="odd">' +
                                '<td class="dataTables_empty" valign="top" colspan="8">No matching records found</td>' +
                                '</tr>';
                    }
                    $('#cs_customer_transaction_table_filter').append(result);
                }
            });
        }
    });


    $('#dp12').datepicker().on('changeDate', function (ev) {
        if (ev.date.valueOf() < endDate.valueOf()) {
            alert('The start date can not be less then the end date');
        } else {

            startDate = new Date(ev.date);
            $('#startDate').text($('#dp12').data('date'));
            var vendor_id = $('#current_vendor_id').val();
            var service = $('filter_vendor_transaction_by_services').val();
            var start_date = $('#admin_vendor_details_filter #startDate').text();
            var end_date = $('#admin_vendor_details_filter #endDate').text();

            $.ajax({
                url: base_url + 'admin/vendor_transactions_filter',
                type: 'POST',
                data: {vendor_id: vendor_id, service: service, start_date: start_date, end_date: end_date},
                dataType: "json",
                success: function (data) {
                    $('#admin_vendor_transaction_table_filter').empty();
                    var trans_len = data['transactions'].length;
                    var result = '';
                    if (trans_len != 0)
                    {
                        $.each(data['transactions'], function (index, value) {
                            var dateAr = value.booking_date.split(' ');
                            var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                            var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                            var time = dateAr[1].split(':');
                            var ti = time[0] + ':' + time[1];
                            if (time[0] >= '12')
                            {
                                var meridian = 'PM';
                            }
                            else
                            {
                                var meridian = 'AM';
                            }
                            if (value.duration > 1)
                            {
                                var hours = 'hours';
                            }
                            else
                            {
                                var hours = 'hour';
                            }
                            var trandate = value.date.split('-');
                            var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                            var stime = value.start_time.split(':');
                            var sti = stime[0] + ':' + stime[1];
                            if (stime[0] >= '12')
                            {
                                var meridian2 = 'PM';
                            }
                            else
                            {
                                var meridian2 = 'AM';
                            }
                            var status = '';
                            var now = new Date();
                            var day = ("0" + now.getDate()).slice(-2);
                            var month = ("0" + (now.getMonth() + 1)).slice(-2);
                            var current_date = now.getFullYear() + "-" + (month) + "-" + (day);
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    status += '<span class="blue medium actions admin_confirmorder">Confirm Order</span>';
                                } else {
                                    if (value.mark_attend != undefined) {
                                        if (value.mark_attend == 'Not-attended') {
                                            status += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                                        }
                                    }
                                }
                            }
                            var attend = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.mark_attend != undefined) {
                                    if (value.mark_attend == 'Not-attended') {
                                        attend += '<a id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '"                                                        class="blue admin_markattend" href="">Mark as Attended</a>';
                                    } else {
                                        attend += 'Attended';
                                    }
                                }
                            }
                            var remind = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    remind += '<a href="" class="blue" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">Remind Customer</a>';
                                }
                            }
                            var confirmed = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Success') {
                                    confirmed += '<a href="" class="green" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">><i class="fa fa-check fa-confirm"></i>Confirmed</a>';
                                }
                            }
                            result += '<tr id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '" role="row" class="odd">' +
                                    '<td class="blue sorting_1">' + value.booking_id + '</td>' +
                                    '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                    '<td class="blue">' + value.user_details.user_id + '</td>' +
                                    '<td class="blue word_break_down">' + value.user_details.name + '</td>' +
                                    '<td class=""><span class="blue v-name word_break_down">' + data['vendor_details'].name + '</span> <br>' + data['vendor_details'].area_name + '</td>' +
                                    '<td><span class="blue v-name word_break_down">' + value.services + '</span><br>' + value.duration + '</td>' +
                                    '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                    '<td>' + value.amount + '</td>' +
                                    '<td class="action-td">' + status +
                                    '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                    '<div class="actions-dropdown">	' +
                                    '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>	' +
                                    '<ul class="actions-list">' +
                                    '<li>' + attend + '</li>' +
                                    '<li>' + remind + '</li>' +
                                    '<li>' + confirmed + '</li>' +
                                    '<li><a href="' + base_url + 'admin/order_details/' + value.booking_id + '" class="blue" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">View Order Detail</a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';
                        });
                    }
                    else if (trans_len == 0)
                    {
                        result += '<tr class="odd">' +
                                '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                '</tr>';
                    }
                    $('#admin_vendor_transaction_table_filter').append(result);
                }
            });
        }
    });
    $('#dp13').datepicker().on('changeDate', function (ev) {

        if (ev.date.valueOf() > startDate.valueOf()) {
            alert('The end date can not be greater then the start date');
        } else {

            endDate = new Date(ev.date);
            $('#endDate').text($('#dp13').data('date'));
            var vendor_id = $('#current_vendor_id').val();
            var service = $('filter_vendor_transaction_by_services').val();
            var start_date = $('#admin_vendor_details_filter #startDate').text();
            var end_date = $('#admin_vendor_details_filter #endDate').text();

            $.ajax({
                url: base_url + 'admin/vendor_transactions_filter',
                type: 'POST',
                data: {vendor_id: vendor_id, service: service, start_date: start_date, end_date: end_date},
                dataType: "json",
                success: function (data) {
                    $('#admin_vendor_transaction_table_filter').empty();
                    var trans_len = data['transactions'].length;
                    var result = '';
                    if (trans_len != 0)
                    {
                        $.each(data['transactions'], function (index, value) {
                            var dateAr = value.booking_date.split(' ');
                            var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                            var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                            var time = dateAr[1].split(':');
                            var ti = time[0] + ':' + time[1];
                            if (time[0] >= '12')
                            {
                                var meridian = 'PM';
                            }
                            else
                            {
                                var meridian = 'AM';
                            }
                            if (value.duration > 1)
                            {
                                var hours = 'hours';
                            }
                            else
                            {
                                var hours = 'hour';
                            }
                            var trandate = value.date.split('-');
                            var trdate = trandate[0] + '/' + trandate[1] + '/' + trandate[2];
                            var stime = value.start_time.split(':');
                            var sti = stime[0] + ':' + stime[1];
                            if (stime[0] >= '12')
                            {
                                var meridian2 = 'PM';
                            }
                            else
                            {
                                var meridian2 = 'AM';
                            }
                            var status = '';
                            var now = new Date();
                            var day = ("0" + now.getDate()).slice(-2);
                            var month = ("0" + (now.getMonth() + 1)).slice(-2);
                            var current_date = now.getFullYear() + "-" + (month) + "-" + (day);
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    status += '<span class="blue medium actions admin_confirmorder">Confirm Order</span>';
                                } else {
                                    if (value.mark_attend != undefined) {
                                        if (value.mark_attend == 'Not-attended') {
                                            status += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                                        }
                                    }
                                }
                            }
                            var attend = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.mark_attend != undefined) {
                                    if (value.mark_attend == 'Not-attended') {
                                        attend += '<a id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '"                                                        class="blue admin_markattend" href="">Mark as Attended</a>';
                                    } else {
                                        attend += 'Attended';
                                    }
                                }
                            }
                            var remind = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Pending') {
                                    remind += '<a href="" class="blue" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">Remind Customer</a>';
                                }
                            }
                            var confirmed = '';
                            if (Date.parse(value.date) > Date.parse(current_date)) {
                                if (value.booking_status == 'Success') {
                                    confirmed += '<a href="" class="green" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">><i class="fa fa-check fa-confirm"></i>Confirmed</a>';
                                }
                            }
                            result += '<tr id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '" role="row" class="odd">' +
                                    '<td class="blue sorting_1">' + value.booking_id + '</td>' +
                                    '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                    '<td class="blue">' + value.user_details.user_id + '</td>' +
                                    '<td class="blue word_break_down">' + value.user_details.name + '</td>' +
                                    '<td class=""><span class="blue v-name word_break_down">' + data['vendor_details'].name + '</span> <br>' + data['vendor_details'].area_name + '</td>' +
                                    '<td><span class="blue v-name word_break_down">' + value.services + '</span><br>' + value.duration + '</td>' +
                                    '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                    '<td>' + value.amount + '</td>' +
                                    '<td class="action-td">' + status +
                                    '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                    '<div class="actions-dropdown">	' +
                                    '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>	' +
                                    '<ul class="actions-list">' +
                                    '<li>' + attend + '</li>' +
                                    '<li>' + remind + '</li>' +
                                    '<li>' + confirmed + '</li>' +
                                    '<li><a href="' + base_url + 'admin/order_details/' + value.booking_id + '" class="blue" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">View Order Detail</a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';
                        });
                    }
                    else if (trans_len == 0)
                    {
                        result += '<tr class="odd">' +
                                '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                '</tr>';
                    }
                    $('#admin_vendor_transaction_table_filter').append(result);
                }
            });
        }
    });


    $('#dp15').datepicker().on('changeDate', function (ev) {

        //current_date = new Date(ev.date);
        $('#finance_transaction_date').text($('#dp15').data('date'));
        var current_date = $('#finance_transaction_date').text();
        $.ajax({
            url: base_url + 'finance/transaction_search_filter_sorting',
            type: 'POST',
            data: {current_date: current_date},
            dataType: "json",
            success: function (data) {
                //console.log(data);
                //return false;
                $('.finance_transactions_search_ctr').empty();
                var len = Object.keys(data).length;
                //console.log(len);
                var result = '<table id="transaction-detail1" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th rowspan="2" class="filter-input">Order<br/> ID No.</th>' +
                        '<th rowspan="2">Treatment <br/>Date/Time</th>' +
                        '<th rowspan="2" class="filter-input">Customer<br/> ID No.</th>' +
                        '<th rowspan="2" class="filter-input">Customer<br/> Name</th>' +
                        '<th rowspan="2" style="width:80px;">Vendor Name <br/>& Location</th>' +
                        '<th rowspan="2">Treatment</th>' +
                        '<th class="head-centre" colspan="2">Incoming</th>' +
                        '<th class="head-centre" style="" colspan="2">Outgoing</th>' +
                        '<th rowspan="2">Profit</th>' +
                        '</tr>' +
                        '<tr>' +
                        '<th class="head-centre no-padding no-bold">Amount</th>' +
                        '<th class="head-centre no-bold">Tax</th>' +
                        '<th class="head-centre no-padding no-bold">Amount</th>' +
                        '<th class="head-centre no-border1 no-bold">Tax</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
//                var table = $('#transaction-detail1').DataTable();
//                table.draw();

                if (len > 0)
                {
                    $.each(data, function (index, value) {
                        var dateAr = value['transactions'].date.split(' ');
                        var newTranDate = dateAr[0].split('-'); //dateAr[0] + '/' + dateAr[1] + '/' + dateAr[2];
                        var book_date = newTranDate[0] + '/' + newTranDate[1] + '/' + newTranDate[2];
                        var time = value['transactions'].start_time.split(':');
                        var ti = time[0] + ':' + time[1];
                        if (time[0] >= '12')
                        {
                            var meridian = 'PM';
                        }
                        else
                        {
                            var meridian = 'AM';
                        }

                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1"><a href="' + base_url + '/finance/order_details/' + value['transactions'].booking_id + '" style="color:#00a3d8;">' + value['transactions'].booking_id + '</a></td>' +
                                '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                '<td class="blue">' + value['user_details'].id + '</td>' +
                                '<td class="blue word_break word_break_down">' + value['user_details'].name + '</td>' +
                                '<td class=""><span class="blue v-name word_break word_break_down">' + value['vendor_details'].name + '</span> <br>' + value['vendor_details'].area_name + '</td>' +
                                '<td><span class="v-name word_break word_break_down">' + value['transactions'].services + '</span></td>' +
                                '<td class="head-centre">4,000</td>' +
                                '<td class="head-centre">150</td>' +
                                '<td class="head-centre no-border1">5,000</td>' +
                                '<td class="head-centre">250</td>' +
                                '<td>1500</td>' +
                                '</tr>';
                    });
                }
                else
                {
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan=11>No matching records found</td>' +
                            '</tr>';
                }
                result += '</tbody>' +
                        '</table>';
                $('.finance_transactions_search_ctr').append(result);
                $('#transaction-detail1').dataTable().fnDestroy();
                $('#transaction-detail1').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });

</script>

<script>
    $('.delete_vendor_package').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/delete_package',
            type: 'POST',
            data: {id: id},
            dataType: "json",
            success: function (data) {
                $('#deleting_message').css('display', 'block');
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        });
        return false;
    });
</script>

<script>
    $('#deleting_message').css('display', 'none');
    $('.delete_vendor_offering').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/delete_offerings',
            type: 'POST',
            data: {id: id},
            dataType: "json",
            success: function (data) {
                $('#deleting_message').css('display', 'block');
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        });
        return false;
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.timepicker.js"></script>  
<script type="text/javascript">
    $(function () {
        $('#check-text').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#check-text option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });
</script> 

<script type="text/javascript">
    $(function () {
        $('body .slot_start_time').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('body .slot_end_time').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script>
    $(document).ready(function () {
        var count = 1;
        $("#add-block").click(function () {

            if (count <= 9) {
                var clone = $(".add-time-block:first").clone();
                clone.find('.slot_start_time').attr('value', '');
                clone.find('.slot_end_time').attr('value', '');
                //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
                $("#start-date-end-date").append(clone);
                count++;
            }
            $(function () {
                $('body .slot_start_time').timepicker({
                    timeFormat: 'H:i',
                });
            });
            $(function () {
                $('body .slot_end_time').timepicker({
                    timeFormat: 'H:i'
                });
            });
            return false;
        });
    });
</script>


<script type="text/javascript">
    $(function () {
        $('#check-text1').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected1').click(function () {
            var selected = $("#check-text1 option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });
</script> 

<script type="text/javascript">
    $(function () {
        $('body .slot_start_time1').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('body .slot_end_time1').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script>
    $(document).ready(function () {
        var count = 1;
        $("#add-block1").click(function () {
            if (count <= 9) {
//                $(".add-time-block1:first").clone().appendTo("#start-date-end-date1");
//                count++;

                var clone = $(".add-time-block1:first").clone();
                clone.find('.slot_start_time1').attr('value', '');
                clone.find('.slot_end_time1').attr('value', '');
                //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
                $("#start-date-end-date1").append(clone);
                count++;
            }
            $(function () {
                $('body .slot_start_time1').timepicker({
                    timeFormat: 'H:i'
                });
            });
            $(function () {
                $('body .slot_end_time1').timepicker({
                    timeFormat: 'H:i'
                });
            });
            return false;
        });
    });
    $('#slots-date').multiselect({
        includeSelectAllOption: true
    });
    $('#btnSelected1').click(function () {
        var selected = $("#slots-date option:selected");
        var message = "";
        selected.each(function () {
            message += $(this).text() + " " + $(this).val() + "\n";
        });
        alert(message);
    });
</script>
<script>
    $('.offering_name').on('keyup', function () {
        var base_url = "<?php echo base_url(); ?>";
        var id = "<?php echo $this->uri->segment(3); ?>";

        var offering_name = $(this).val();

        $.ajax({
            url: base_url + 'admin/offerings_search',
            type: 'POST',
            data: {offering_name: offering_name, id: id},
            dataType: "json",
            success: function (data) {
                $('.table-data').empty();
                var len = Object.keys(data).length;
                var result = '<table id="vendor-table3" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="offering_name">Offerings</th>' +
                        '<th>Program</th>' +
                        '<th>Service Type</th>' +
                        '<th>Duration</th>' +
                        '<th>Gallery</th>' +
                        '<th>Business Hours</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                if (len > 0)
                {

                    $.each(data, function (index, value) {
                        result += '<tr role="row" class="odd">\n\
                        <td class="offering_name sorting_1"><span class="blue v-name word_break_down">\n\
                                <a href="' + base_url + 'admin/vendor_details/' + value.id + '" class="blue mail-id">' + value.services + '</a>\n\
                            </span>\n\
                        </td>\n\
                        <td class="">' + value.program + '</td>\n\
                        <td class="">' + value.service_type + '</td>\n\
                        <td class="">' + value.duration + ' Hr</td>\n\
                        <td class="blue">\n\
                            <a class="blue batch" href="' + base_url + 'admin/view_offerings_gallery/' + value.business_service_id + '" id="' + value.business_service_id + '">View Gallery</a>\n\
                        </td>\n\
                        <td class="blue">\n\
                            <a class="blue batch" href="' + base_url + 'admin/business_hours/' + value.business_service_id + '" id="' + value.business_service_id + '">View Slots</a>\n\
                        </td>\n\
                        <td class="blue">\n\
                            <a class="blue batch" href="' + base_url + 'admin/edit_offering/' + value.business_service_id + '" id="' + value.business_service_id + '">Edit</a>\n\
                            | <a class="blue batch delete_vendor_offering" href="' + value.business_service_id + '" id="' + value.business_service_id + '">Delete</a>\n\
                        </td>\n\
                    </tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="7">No matching records found</td>' +
                            '</tr>';
                }


                result += '</tbody>' +
                        '</table>';
                $('.table-data').append(result);
                $('#vendor-table3').dataTable().fnDestroy();
                $('#vendor-table3').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#slot_days').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#lstFruits option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });

    $(function () {
        $('#slot_weekends').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#lstFruits option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });




</script>



<script type="text/javascript">
    $(function () {
        $('#slots-date').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#lstFruits option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });

    $(function () {
        $('#slot_weekends').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#lstFruits option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });
    });




</script>

<script type="text/javascript">
    $(function () {
        $('body .slot_start_time').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('body .slot_end_time').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('body .slot_start_time1').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('body .slot_end_time1').timepicker({
            timeFormat: 'H:i'
        });
    });
</script>

<!--<script>
    $(document).ready(function () {
        var count = 1;
        $("#add-block1").click(function () {
            if (count <= 9) {
//                $(".add-time-block1:first").clone().appendTo("#start-date-end-date1");
//                count++;

                var clone = $(".add-time-block1:first").clone();
                clone.find('.slot_start_time1').attr('value', '');
                clone.find('.slot_end_time1').attr('value', '');
                //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
                $("#start-date-end-date1").append(clone);
                count++;
            }
            $(function () {
                $('body .slot_start_time1').timepicker({
                    timeFormat: 'H:i'
                });
            });
            $(function () {
                $('body .slot_end_time1').timepicker({
                    timeFormat: 'H:i'
                });
            });
            return false;
        });
    });
    $('#slots-date').multiselect({
        includeSelectAllOption: true
    });
    $('#btnSelected1').click(function () {
        var selected = $("#slots-date option:selected");
        var message = "";
        selected.each(function () {
            message += $(this).text() + " " + $(this).val() + "\n";
        });
        alert(message);
    });
</script>

<script>
    $(document).ready(function () {
        var count = 1;
        $("#add-block").click(function () {

            if (count <= 9) {
                var clone = $(".add-time-block:first").clone();
                clone.find('.slot_start_time').attr('value', '');
                clone.find('.slot_end_time').attr('value', '');
                //$(".add-time-block:first").clone().appendTo("#start-date-end-date");
                $("#start-date-end-date").append(clone);
                count++;
            }
            $(function () {
                $('body .slot_start_time').timepicker({
                    timeFormat: 'H:i',
                });
            });
            $(function () {
                $('body .slot_end_time').timepicker({
                    timeFormat: 'H:i'
                });
            });
            return false;
        });

        $('#slots-date-picker').datepick({
            minDate: new Date(),
            dateFormat: 'yyyy-mm-dd',
            altField: '#slots-date-picker',
            altFormat: 'yyyy-mm-dd',
            onSelect: showDate2
        });

        function showDate2(date) {
            var d = new Date(date);
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
            $('#slots-date-picker').val(current_date);
        }
    });
</script>-->
<script>

    $(function () {

    $('.main-service').change(function(){
    if ($(this).val() != '')
    {
    $('.programs').empty();
            var url2 = $('.url').val();
            var service_id = $(this).val();
            $.ajax({
            dataType: 'json',
                    type:'POST',
                    url:url2 + 'sme/get_programs',
                    data:{
                    service :service_id
                    },
                    success :function(data){
                    var res = '<label class="control-label" for="select01">Business Programs</label> <div class="customer-edit-input"><select id="select01" name="programs" class="required programs"><option value="">Select Program</option> ';
                            $.each(data, function(i, item) {
                            res += '<option value=' + item.id + '>' + item.program + '</option>';
                            });
                            res += '</select></div>';
                            $('.programs').append(res);
                    }

            }, 'json');
    }

    });
            $('body').on('change', '.programs', function (){
    if ($(this).val() != '')
    {
    $('.offerings').empty();
            var url2 = $('.url').val();
            var program_id = $(this).val();
            $.ajax({
            dataType: 'json',
                    type:'POST',
                    url:url2 + 'sme/get_offerings',
                    data:{
                    program_id :program_id
                    },
                    success :function(data){
                    var res = '<label class="control-label" for="select01">Business Services</label><div class="customer-edit-input"><select id="select01" name="offering" class="required offerings"><option value="">Select Service</option> ';
                            $.each(data, function(i, item) {
                            res += '<option value=' + item.id + '>' + item.services + '</option>';
                            });
                            res += '</select></div>';
                            $('.offerings').append(res);
                    }

            }, 'json');
    }
    });
</script>



<script type="text/javascript" >
$(document).ready(function(){
$("#admin_partner_register").on("submit", function(e){
var checkedNum = $('input[name="business_type[]"]:checked').length;
if (!checkedNum) {
   $('#admin_business_type').show();
   e.preventDefault();
}
else{
$('#admin_business_type').hide();
}
});
});
</script>


<script type="text/javascript" >
$(document).ready(function(){
$("#cs_partner_register").on("submit", function(e){
var checkedNum = $('input[name="business_type[]"]:checked').length;
if (!checkedNum) {
   $('#cs_business_type').show();
   e.preventDefault();
}
else{
$('#cs_business_type').hide();
}
});
});
</script>
<script type="text/javascript" >
function visited_page_filter(){
	document.forms["myform"].submit();
	}
</script>

<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();
	
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var selected_date = start.format('YYYY-MM-D') + ',' + end.format('YYYY-MM-D');
        $('#selected_date').val(selected_date);
        document.forms["myform"].submit();
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()]
           //'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           //'This Month': [moment().startOf('month'), moment().endOf('month')],
           //'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    //cb(start, end);
    
	});
</script>

</body>

</html>
