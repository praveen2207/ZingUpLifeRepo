var site_path = $('#site_path').val();
var smeuserid = $('.smeuserid').val();
$(document).ready(function() {
    getGpsSlot();
    var active_dates = [];
    $('.added_slots').each(function() {
        var va = $(this).val();
        active_dates.push(va);
    });
    var blocked_dates = [];
    $('.blocked_slots').each(function() {
        var va2 = $(this).val();
        blocked_dates.push(va2);
    });
    var active_dates = active_dates.filter(function(obj) {
        return blocked_dates.indexOf(obj) == -1;
    });
    //Date Picket init
    $('#sme-datepicker').datepicker({
        todayHighlight: false,
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 3,
        beforeShowDay: function(date) {
            var m = date.getMonth(),
                d = date.getDate(),
                y = date.getFullYear();
        
            for (i = 0; i < blocked_dates.length; i++) {
                if ($.inArray(y + '-' + (m + 1) + '-' + d, blocked_dates) != -1) {
                    //return [false];
                    return [true, 'ui-state-disabled', ''];
                }
            }

            for (i = 0; i < active_dates.length; i++) {
                if ($.inArray(y + '-' + (m + 1) + '-' + d, active_dates) != -1) {
                    //return [false];

                    return [true, 'ui-state-available', ''];
                }
            }

            return [true];
        },
        onSelect: function(date, instance) {
            $("#book_call_date2").val(date);
            $.ajax({
                type: 'POST',
                url: site_path+'admin/assessment/get_gp_slot',
                dataType: 'json',
                data: {
                    seldate: date,
                    smeuserid: smeuserid
                },
                success: function(data) {
                    if (data) {
                        $('.timeSlot').empty();
                        $('.timeSlot').append(data);
                        $('.er-msg').hide();
                    } else {
                        $('.timeSlot').empty();
                        $('.er-msg').show();
                        $('.show-suc').hide();
                    }
                }
            });
        }
    });
    $(".smedate .ui-datepicker-calendar td.ui-datepicker-today a").removeClass('ui-state-highlight');
    $('.appendid').click(function() {
        var id = $(this).attr('id');
        $('.booked_id').val(id);
    });
    $("form.cf-btn").bind("keypress", function(e) {
        if (e.keyCode == 13) {
            return false;
        }
    });
    $('body').on('click', '.timeBtn', function() {
        var id = $(this).attr('id');
        $('.added_slot').val(id);
        $(this).addClass('timeAcitve');
        $(this).prevAll().removeClass('timeAcitve');
        $(this).nextAll().removeClass('timeAcitve');
        jQuery.noConflict();
        $.ajax({
            type: 'POST',
            url: site_path+'admin/assessment/get_available_gps',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $('#available_gps').html(data);
                $('.SMEdetails').modal('show');
            }
        });
    });
    $(".smedate .ui-datepicker-calendar td.ui-datepicker-today a").removeClass('ui-state-highlight');
});	

function bookaCall(user_id){
    $('#book_call_user_id').val(user_id);
    jQuery.noConflict();
    $('.bookCall').modal('show');
}
function book_user_slot(){
    if($('input[name=available_gps]:checked').length<=0){
        alert("Please select a GP to Book");
    }else{
        var slot_id = $(".added_slot").val();
        var user_id = $("#book_call_user_id").val();
        var sme_id = $(".added_sme").val();
        $.ajax({
            type: 'POST',
            url: site_path+'admin/assessment/user_book_slot',
            dataType: 'json',
            data: {
                slot_id: slot_id,
                user_id: user_id,
                sme_id: sme_id
            },
            success: function(data) {
                if (data) {
                    $('.show-sucsend').show();
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 200);
                } else {

                }
            }
        });
    }
}
function getGpsSlot(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {
        dd='0'+dd
    } 
    if(mm<10) {
        mm='0'+mm
    } 
    var date = today = yyyy+'-'+mm+'-'+dd;
   $("#book_call_date2").val(date);
    $.ajax({
        type: 'POST',
        url: site_path+'admin/assessment/get_gp_slot',
        dataType: 'json',
        data: {
            seldate: date,
            smeuserid: smeuserid
        },
        success: function(data) {
            if (data) {
                $('.timeSlot').empty();
                $('.timeSlot').append(data);
                $('.er-msg').hide();
            } else {
                $('.timeSlot').empty();
                $('.er-msg').show();
                $('.show-suc').hide();
            }
        }
    });
}