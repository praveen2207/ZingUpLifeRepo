$(document).ready(function () {
    var base_url = 'http://zinguplife.com/';
//    var base_url = 'http://design1.nuvodev.com/client/zing/';

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i.test(value);
    }, "special characters not allowed");
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
            name: {
                lettersonly: true,
                maxclength: 50

            },
            select01: {
                required: true


            },
            password: {
                // minplength: 6

            },
            check: {
                required: function (element) {
                    var boxes = $('.checkbox');
                    if (boxes.filter(':checked').length == 0) {
                        return true;
                    }
                    return false;
                },
                minlength: 1
            }
        }
        ,
        messages: {
            check: "Please select the checkbox."
        }






    });






    $('#reset_password').validate({
        rules: {
            password: {minplength: 6
            },
            confirm_password: {minplength: 6
            }


        }
    });

    $(".edit-input").each(function () {





        $(this).find(".e-button").click(function () {








            $(this).prev("input").keyup(function () {





                if ($(this).val() == "") {


                    $(this).parent().find(".form-error").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).removeClass("error");
                    $(this).parent().find(".form-error1").hide();
                }














            });
            var pattern = /^\d{10}$/;
            $(this).prev("input[type='tel']").keyup(function () {




                if ($(this).val() == "") {


                    $(this).parent().find(".form-error").show();
                    $(this).parent().find(".form-error1").hide();
                    $(this).parent().find(".form-error2").hide();
                    $(this).addClass("error");
                }





                else if (!pattern.test($(this).val())) {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").hide();
                    $(this).parent().find(".form-error2").hide();
                    $(this).removeClass("error");
                }



            });
            var pattern1 = /^[a-z0-9, ]{0,50}$/i;
            var pattern2 = /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i;
            $(this).prev("input[type='text']").keyup(function () {




                if ($(this).val() == "") {


                    $(this).parent().find(".form-error").show();
                    $(this).parent().find(".form-error1").hide();
                    $(this).parent().find(".form-error2").hide();
                    $(this).addClass("error");
                }





                else if (!pattern1.test($(this).val())) {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").show();
                    $(this).parent().find(".form-error2").hide();
                    $(this).addClass("error");
                }


                else if (!pattern2.test($(this).val())) {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").hide();
                    $(this).parent().find(".form-error2").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").hide();
                    $(this).parent().find(".form-error2").hide();
                    $(this).removeClass("error");
                }



            });
            $(this).prev("input").each(function () {





                if ($(this).val() == "") {


                    $(this).parent().find(".form-error").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).removeClass("error");
                }





            });
            $(this).prev("input[type='tel']").each(function () {











                if ($(this).val() == "") {


                    $(this).parent().find(".form-error").show();
                    $(this).parent().find(".form-error1").hide();
                    $(this).addClass("error");
                }





                else if (!pattern.test($(this).val())) {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).parent().find(".form-error1").hide();
                    $(this).removeClass("error");
                }














            });
            $(this).prev("select").on('change', function () {











                if ($(this).find("option:selected").index() == "1") {


                    $(this).parent().find(".form-error").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).removeClass("error");
                }





            });
            $(this).prev("select").each(function () {











                if ($(this).find("option:selected").index() == "1") {


                    $(this).parent().find(".form-error").show();
                    $(this).addClass("error");
                }





                else {


                    $(this).parent().find(".form-error").hide();
                    $(this).removeClass("error");
                }





            });
        });
    });
//    $(".edit-icon").click(function (event) {
//        event.preventDefault();
//        
//        alert('thyhy');
//        
//        
//        
////        $(this).parent().next().fadeIn(100);
////        $(this).parent().hide();
//        //return false;
//    });











    $(".browse").on("change", function () {





        var bval = $(this).val();
        var clean = bval.split('\\').pop();
        // clean from C:\fakepath OR C:\fake_path 





        $("#uploadFile").val(clean);
    });
    $('#upload-form').validate({
        rules: {
            file: {
                required: true





            }


        },
        errorPlacement: function (error, element) {





            error.insertAfter(element.parent());
        }








    });
    $(".btn-navbar").click(function (e) {

        e.preventDefault();
    });
    $('body').on('click', '.panel-title1', function () {
        $(this).find("a").addClass("sel");
    });
    $('#example tfoot th').each(function () {
        var title = $('#example thead th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="' + title + '" />');
    });
    var table = $('#example').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "bAutoWidth": false,
        "pageLength": 10,
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [8]
            }]



    });
    // Apply the search
//    table.columns().every(function () {
//        var that = this;
//
//        $('input', this.footer()).on('keyup change', function () {
//            if (that.search() !== this.value) {
//                that
//                        .search(this.value)
//                        .draw();
//            }
//        });
//    });

    table.columns.adjust().draw();
    $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
    var tfoot = $("tfoot").html();
//$(".filter-section").append(tfoot);




    //$(".more-actions").click(function () {
    $('body').on('click', '.more-actions', function () {

        $(".actions-dropdown").slideUp();
        if ($(this).next().css("display") == "none") {

            $(this).next().slideDown();
            //$(this).next().animate({"right":"0px"}, "slow").show();


        }

        else {

            $(this).next().slideUp("fast");
        }

    });
    //$(".more-actions1").click(function () {
    $('body').on('click', '.more-actions1', function () {

        $(this).parent().slideUp("fast");
    });
    var table = $('#example1').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "bAutoWidth": false,
        "pageLength": 10,
        "aaSorting": [[2, "desc"]]
    });
    var table = $('#example1_interpretation').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "bAutoWidth": false,
        "pageLength": 100,
        "aaSorting": [[2, "desc"]]
    });


    $('#vendor-table').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'


    });
    $('#detail-table').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "order": [[2, 'asc']],
        "bSort": false,
        "paging": false



    });
    $('#customer-detail').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'




    });
    $('#summary-table').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "order": [[2, 'asc']],
        "bSort": false,
        "paging": false



    });
    $('#transaction-detail1').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "columnDefs": [{"targets": 6, "orderable": false}, {"targets": 7, "orderable": false}, {"targets": 8, "orderable": false}, {"targets": 9, "orderable": false}]

    });
    $('#vendor-table1').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'
    });
    $('#customer-table').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'


    });
    $('#customer-detail1').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'


    });
    $('#transaction-detail2').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "columnDefs": [{"targets": 6, "orderable": false}, {"targets": 7, "orderable": false}, {"targets": 8, "orderable": false}, {"targets": 9, "orderable": false}]

    });
    $('#vendor-table2').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'


    });
    $('#vendor-table3').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'


    });
    var table = $('#admin_example1').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "bAutoWidth": false,
        "pageLength": 10,
        "aaSorting": [[2, "desc"]]
    });
    $('#backend-user').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">'


    });
    $('#user-role').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "paging": false,
        "bSort": false


    });
    //$(".cs_filter li").click(function () {
    $('body').on('click', '.cs_filter li', function () {
        var service_category = $(this).attr('id');
        if (service_category == 'all') {
            window.location = '' + base_url + 'customer_support/vendors';
        } else {
            window.location = '' + base_url + 'customer_support/vendors/' + service_category + '';
        }

    });
    //$(".finance_filter li").click(function () {
    $('body').on('click', '.finance_filter li', function () {
        var service_category = $(this).attr('id');
        if (service_category == 'all') {
            window.location = '' + base_url + 'finance/vendors';
        } else {
            window.location = '' + base_url + 'finance/vendors/' + service_category + '';
        }

    });
    // $(".admin_filter li").click(function () {
    $('body').on('click', '.admin_filter li', function () {
        var service_category = $(this).attr('id');
        if (service_category == 'all') {
            window.location = '' + base_url + 'admin/vendors';
        } else {
            window.location = '' + base_url + 'admin/vendors/' + service_category + '';
        }

    });
    //$('.delete_cusomer').click(function () {
    $('body').on('click', '.delete_cusomer', function () {
        var customer_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'admin/delete_customer',
            type: 'POST',
            data: {customer_id: customer_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/customers';
            }
        });
        return false;
    });
    // $('.delete_vendor').click(function () {
    $('body').on('click', '.delete_vendor', function () {
        var vendor_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'admin/delete_vendor',
            type: 'POST',
            data: {vendor_id: vendor_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/vendors';
            }
        });
        return false;
    });
    //$('.delete_user_role').click(function () {
    $('body').on('click', '.delete_user_role', function () {
        var role_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'admin/delete_role',
            type: 'POST',
            data: {role_id: role_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/user_roles';
            }
        });
        return false;
    });
    // $('.delete_user').click(function () {
    $('body').on('click', '.delete_user', function () {
        var user_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'admin/delete_user',
            type: 'POST',
            data: {user_id: user_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/users';
            }
        });
        return false;
    });
    // $('.cs_notes_edit').click(function (event) {
    $('body').on('click', '.cs_notes_edit', function (event) {
        event.preventDefault();
        var customer_support_notes = $('.cs_notes').val();
        var vendor_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'update_vendor_notes',
            type: 'POST',
            data: {customer_support_notes: customer_support_notes, vendor_id: vendor_id},
            success: function (data) {
                location.reload();
            }
        });
    });
    // $('.finance_notes_edit').click(function (event) {
    $('body').on('click', '.finance_notes_edit', function (event) {
        event.preventDefault();
        var finance_notes = $('.finance_notes').val();
        var vendor_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'update_vendor_notes',
            type: 'POST',
            data: {finance_notes: finance_notes, vendor_id: vendor_id},
            success: function (data) {
                location.reload();
            }
        });
    });
    // $('.admin_notes_edit').click(function (event) {
    $('body').on('click', '.admin_notes_edit', function (event) {
        event.preventDefault();
        var admin_notes = $('.admin_notes').val();
        var vendor_id = $(this).attr('id');
        $.ajax({
            url: '' + base_url + 'update_vendor_notes',
            type: 'POST',
            data: {admin_notes: admin_notes, vendor_id: vendor_id},
            success: function (data) {
                location.reload();
            }
        });
    });
    $('body').on('click', '.confirmorder', function () {
        var value = $(this).parent().parent().attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'customer_support/confirm_order',
            data: {value: value},
            dataType: "html",
            success: function (data) {
                if (data === 'true')
                {
                    window.location.reload();
                }

            }
        });
    });
    $('body').on('click', '.admin_confirmorder', function () {
        var value = $(this).parent().parent().attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/confirm_order',
            data: {value: value},
            dataType: "html",
            success: function (data) {
                if (data === 'true')
                {
                    window.location.reload();
                }

            }
        });
    });
    $('body').on('click', '.markattend', function () {
        var value = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'customer_support/mark_attend',
            data: {value: value},
            dataType: "html",
            success: function (data) {
                if (data === 'true')
                {
                    window.location.reload();
                }

            }
        });
        return false;
    });
    $('body').on('click', '.admin_markattend', function () {
        var value = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/mark_attend',
            data: {value: value},
            dataType: "html",
            success: function (data) {
                if (data === 'true')
                {
                    window.location.reload();
                }

            }
        });
        return false;
    });
    $('body').on('click', '.remind-customer', function () {
        var value = $(this).parent().parent().attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'customer_support/remind_customer',
            data: {value: value},
            dataType: "html",
            success: function (data) {

            }
        });
        return false;
    });
    $('body').on('click', '.admin_remind-customer', function () {
        var value = $(this).parent().parent().attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/remind_customer',
            data: {value: value},
            dataType: "html",
            success: function (data) {

            }
        });
        return false;
    });
    $('body').on('click', '.search-button', function () {

        var text = $('#faq_search').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'customer_support/faq_filter',
            data: {text: text},
            dataType: "json",
            success: function (data) {
                $('#accordion').empty();
                var primary_class = '';
                var in_val = '';
                var selected = '';
                $.each(data['faq'], function (key, val) {
                    if (key == 0) {
                        primary_class = 'panel-primary';
                        in_val = 'in';
                        selected = 'sel';
                    } else {
                        primary_class = '';
                        in_val = '';
                        selected = '';
                    }
                    $('#accordion').append('<div class="panel panel1 panel' + val.id + ' ' + primary_class + '">\n\
                        <div class="panel-heading panel-heading1">\n\
                            <h4 class="panel-title panel-title1">\n\
                                <a data-toggle="collapse" data-parent="#accordion" href="#accordionOne' + val.id + '" class="blue faq-link ' + selected + '">\n\
                                    <span class="q-icon blue">Q.</span>' + val.question + '</a>\n\
                            </h4>\n\
                        </div>\n\
                        <div id="accordionOne' + val.id + '" class="panel-collapse panel-collapse1 collapse ' + in_val + '">\n\
                            <div class="panel-body panel-body1">\n\
                                ' + val.answer + '\n\
                            </div>\n\
                        </div>\n\
                    </div>');
                });
            }
        });
        return false;
    });
    $('#cs_transactions_filter_section input').on('keyup', function () {

        //if (this.value != '') {
        var str = $(this).val();
        if (/^[a-zA-Z0-9- ]*$/.test(str) == true) {
            $('.searchcontent').empty();
            var parent = $(this).parent();
            var ord_id = parent.children('.ord_id').val();
            var cus_id = parent.children('.cus_id').val();
            var cus_name = parent.children('.cus_name').val();
            var ph_no = parent.children('.ph_no').val();
            var email_id = parent.children('.email_id').val();
            $.ajax({
                url: base_url + 'customer_support/transactions_search',
                type: 'POST',
                data: {ord_id: ord_id, cus_id: cus_id, cus_name: cus_name, ph_no: ph_no, email_id: email_id},
                dataType: "json",
                success: function (data) {
                    var len = Object.keys(data).length;
                    $('.searchcontent').empty();
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
                            if (value['transactions'].duration > 1)
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
                            //console.log(value.transaction_date);
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
                                        attend += '<a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '" class="blue markattend" href="">Mark as Attended</a>';
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
                            result += '<tr id="' + value['transactions'].id + '">' +
                                    '<td class="blue">' + value['transactions'].booking_id + '</td>' +
                                    '<td>' + book_date + '<br/>' + ti + ' ' + meridian + '</td>' +
                                    '<td class="blue">' + value['transactions'].id + '</td>' +
                                    '<td class="blue word_break word_break_down">' + value['transactions'].username + '</td>' +
                                    '<td class=""><span class="blue v-name word_break word_break_down">' + value['transactions'].name + '</span> <br/>' + value['transactions'].suburb + '</td>' +
                                    '<td><span class="blue v-name word_break word_break_down">' + value['transactions'].services + '</span><br/>' + value['transactions'].duration + '</td>' +
                                    '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                    '<td>' + value['transactions'].amount + '</td>' +
                                    '<td class="action-td">' + status +
                                    '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                    '<div class="actions-dropdown">' +
                                    '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>' +
                                    '<ul class="actions-list">' +
                                    '<li>' + attend + '</li>' +
                                    '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="">' + remind + '</a></li>' +
                                    '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="green" href="">' + confirmed + '</li>' +
                                    '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="' + base_url + 'customer_support/order_details/' + value['transactions'].booking_id + '">View Order Detail</a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>'
                        });
                    }

                    else
                    {
                        result += '<tr class="odd">' +
                                '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                                '</tr>';
                    }

                    $('.searchcontent').append(result);

                }
            });
            //}
        }
        else
        {
            result += '<tr class="odd">' +
                    '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                    '</tr>';
            $('.searchcontent').append(result);
        }


    });
    $('#admin_transactions_filter_section input').on('keyup', function () {

        //if (this.value != '') {
        $('.searchcontent').empty();
        var parent = $(this).parent();
        var ord_id = parent.children('.ord_id').val();
        var cus_id = parent.children('.cus_id').val();
        var cus_name = parent.children('.cus_name').val();
        var ph_no = parent.children('.ph_no').val();
        var email_id = parent.children('.email_id').val();
        $.ajax({
            url: base_url + 'admin/transactions_search',
            type: 'POST',
            data: {ord_id: ord_id, cus_id: cus_id, cus_name: cus_name, ph_no: ph_no, email_id: email_id},
            dataType: "json",
            success: function (data) {
                var len = Object.keys(data).length;
                $('.searchcontent').empty();
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
                        if (value['transactions'].duration > 1)
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
                        //console.log(value.transaction_date);
                        var status = '';
                        if (value['transactions'].expiry == "no") {
                            if (value['transactions'].booking_status == "Pending") {
                                status += '<span class="blue medium actions admin_confirmorder"> Confirm Order</span>';
                            } else {
                                status += '<span class="blue medium actions admin_remind-customer">Remind Customer</span>';
                            }
                        }
                        var attend = '';
                        if (value['transactions'].expiry == 'no') {
                            if (value['mark_attend'] != undefined) {
                                if (value['mark_attend'].status == 'Not-attended') {

                                    attend += '<a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue admin_markattend" href="">Mark as Attended</a>'
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
                        result += '<tr id="' + value['transactions'].id + '">' +
                                '<td class="blue">' + value['transactions'].booking_id + '</td>' +
                                '<td>' + book_date + '<br/>' + ti + ' ' + meridian + '</td>' +
                                '<td class="blue">' + value['transactions'].id + '</td>' +
                                '<td class="blue word_break word_break_down">' + value['transactions'].username + '</td>' +
                                '<td class=""><span class="blue v-name word_break word_break_down">' + value['transactions'].name + '</span> <br/>' + value['transactions'].suburb + '</td>' +
                                '<td><span class="blue v-name word_break word_break_down">' + value['transactions'].services + '</span><br/>' + value['transactions'].duration + '</td>' +
                                '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                '<td>' + value['transactions'].amount + '</td>' +
                                '<td class="action-td">' + status +
                                '<span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>' +
                                '<div class="actions-dropdown">' +
                                '<span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>' +
                                '<ul class="actions-list">' +
                                '<li>' + attend + '</li>' +
                                '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="">' + remind + '</a></li>' +
                                '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="green" href="">' + confirmed + '</li>' +
                                '<li><a id="' + value['user_details'].id + '-' + value['transactions'].booking_id + '-' + value['transactions'].slot_id + '"class="blue" href="' + base_url + 'admin/order_details/' + value['transactions'].booking_id + '">View Order Detail</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '</td>' +
                                '</tr>'
                    });
                }
                else
                {
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="9">No matching records found</td>' +
                            '</tr>';
                }

                $('.searchcontent').append(result);


            }
        });
        // }


    });

    var html = $('.trans-tabledata').html();
    $('.html').val(html);
    //custom vendor filter
    $('.vendor-all-filter input').on('keyup', function () {


        var parent = $(this).parent();
        var vr_name = parent.children('.vendor_name').val();
        var vr_loc = parent.children('.vendor_loc').val();
        var vr_ph = parent.children('.vendor_ph').val();
        var vr_email = parent.children('.vendor_email').val();
        var category = parent.children('.category').val();
        $.ajax({
            url: base_url + 'customer_support/vendors/search_filter',
            type: 'POST',
            data: {vr_name: vr_name, vr_loc: vr_loc, vr_ph: vr_ph, vr_email: vr_email, category: category},
            dataType: "json",
            success: function (data) {
                $('.table-data').empty();
                var len = Object.keys(data).length;
                var result = '<table id="vendor-table" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="">Vendor Name</th>' +
                        '<th>Locations</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                if (len > 0)
                {

                    $.each(data, function (index, value) {
                        result += '<tr>' +
                                '<td class=""><span class="blue v-name word_break_down">' +
                                '<a class="blue mail-id" href="' + base_url + 'customer_support/vendor_details/' + value.id + '">' + value.name + '</a>' +
                                '</span>' +
                                '</td>' +
                                '<td class="">' + value.area_name + '</td>' +
                                '<td class=""><span class="blue v-name word_break_down">'+
                                '<a id="'+value.business_id+'" href="" class="blue batch cs_delete_vendor">Delete Vendor</a>'+
                                '</span>'+
                                '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="3">No matching records found</td>' +
                            '</tr>';
                }


                result += '</tbody>' +
                        '</table>';
                $('.table-data').append(result);
                $('#vendor-table').dataTable().fnDestroy();
                $('#vendor-table').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });
    $('.vendor-all-filter .vendor_loc').on('change', function () {
//$('.searchcontent').empty();  
        $('.table-data').empty();
        var parent = $(this).parent();
        var vr_name = parent.children('.vendor_name').val();
        var vr_loc = parent.children('.vendor_loc').val();
        var vr_ph = parent.children('.vendor_ph').val();
        var vr_email = parent.children('.vendor_email').val();
        var category = parent.children('.category').val();
        $.ajax({
            url: base_url + 'customer_support/vendors/search_filter',
            type: 'POST',
            data: {vr_name: vr_name, vr_loc: vr_loc, vr_ph: vr_ph, vr_email: vr_email, category: category},
            dataType: "json",
            success: function (data) {

                var len = Object.keys(data).length;
                var result = '<table id="vendor-table" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="">Vendor Name</th>' +
                        '<th>Locations</th>' +
                        '<th>Actions</th>' + 
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                // var table = $('#vendor-table').DataTable();
                //table.draw();

                if (len > 0)
                {
                    $.each(data, function (index, value) {
                        result += '<tr><td class=""><span class="blue v-name word_break_down">' +
                                '<a class="blue mail-id" href="' + base_url + 'customer_support/vendor_details/' + value.id + '">' + value.name + '</a>' +
                                '</span>' +
                                '</td>' +
                                '<td class="">' + value.area_name + '</td>' +
                                '<td class=""><span class="blue v-name word_break_down">'+
                                '<a id="'+value.business_id+'" href="" class="blue batch cs_delete_vendor">Delete Vendor</a>'+
                                '</span>'+
                                '</td>' + 
                                '</tr>';
                    });
                }
                else
                {
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="3">No matching records found</td>' +
                            '</tr>';
                }
                result += '</tbody>' +
                        '</table>';
                $('.table-data').append(result);
                $('#vendor-table').dataTable().fnDestroy();
                $('#vendor-table').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });
    //custom vendor filter

    //$('.ord-id').on('keyup', function (e) {
    // if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    // $('.cus-filter input').stop();
    //}
    //});

    $('.cus-filter input').on('keyup', function () {

        var parent = $(this).parent();
        var ord_id = parent.children('.ord-id').val();
        var cus_id = parent.children('.cus-id').val();
        var cus_name = parent.children('.cus-name').val();
        var ph = parent.children('.ph').val();
        var email = parent.children('.email').val();
        //var str = $(this).val();
        var cl = $(this).attr('class');

        //if(/^[a-zA-Z0-9- ]*$/.test(str) == true ) {
        $.ajax({
            url: base_url + 'customer_support/customer_search',
            type: 'POST',
            data: {ord_id: ord_id, cus_id: cus_id, cus_name: cus_name, email: email, ph: ph},
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
                var len = Object.keys(data).length;
                if (len > 0)
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
                else
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
        //}
        /*else
         {
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
         result +='<tr class="odd">' +
         '<td class="dataTables_empty" valign="top" colspan="8">No matching records found</td>' +
         '</tr>';
         result += '</tbody>' +
         '</table>';
         $('.customer-table').append(result);
         $('#example1').dataTable().fnDestroy();
         $('#example1').DataTable({
         "dom": '<"top"i>rt<"bottom"flp><"clear">',
         "pageLength": 10
         });
         }
         */
    });


    //custom vendor filter
    $('.admin-vendor-all-filter input').on('keyup', function () {


        var parent = $(this).parent();
        var vr_name = parent.children('.vendor_name').val();
        var vr_loc = parent.children('.vendor_loc').val();
        var vr_ph = parent.children('.vendor_ph').val();
        var vr_email = parent.children('.vendor_email').val();
        var category = parent.children('.category').val();
        $.ajax({
            url: base_url + 'admin/vendors/search_filter',
            type: 'POST',
            data: {vr_name: vr_name, vr_loc: vr_loc, vr_ph: vr_ph, vr_email: vr_email, category: category},
            dataType: "json",
            success: function (data) {
                $('.table-data').empty();
                var len = Object.keys(data).length;
                var result = '<table id="vendor-table3" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="">Vendor Name</th>' +
                        '<th>Locations</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                if (len > 0)
                {

                    $.each(data, function (index, value) {
                        result += '<tr>' +
                                '<td class=""><span class="blue v-name word_break_down">' +
                                '<a class="blue mail-id" href="' + base_url + 'admin/vendor_details/' + value.id + '">' + value.name + '</a>' +
                                '</span>' +
                                '</td>' +
                                '<td class="">' + value.area_name + '</td>' +
                                '<td class="blue"><a id="' + value.id + '" href="" class="blue batch delete_vendor">Delete Vendor</a></td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="3">No matching records found</td>' +
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
    $('.admin-vendor-all-filter .vendor_loc').on('change', function () {
//$('.searchcontent').empty();  
        $('.table-data').empty();
        var parent = $(this).parent();
        var vr_name = parent.children('.vendor_name').val();
        var vr_loc = parent.children('.vendor_loc').val();
        var vr_ph = parent.children('.vendor_ph').val();
        var vr_email = parent.children('.vendor_email').val();
        var category = parent.children('.category').val();
        $.ajax({
            url: base_url + 'admin/vendors/search_filter',
            type: 'POST',
            data: {vr_name: vr_name, vr_loc: vr_loc, vr_ph: vr_ph, vr_email: vr_email, category: category},
            dataType: "json",
            success: function (data) {

                var len = Object.keys(data).length;
                var result = '<table id="vendor-table3" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="">Vendor Name</th>' +
                        '<th>Locations</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                // var table = $('#vendor-table').DataTable();
                //table.draw();

                if (len > 0)
                {
                    $.each(data, function (index, value) {
                        result += '<tr><td class=""><span class="blue v-name word_break_down">' +
                                '<a class="blue mail-id" href="' + base_url + 'admin/vendor_details/' + value.id + '">' + value.name + '</a>' +
                                '</span>' +
                                '</td>' +
                                '<td class="">' + value.area_name + '</td>' +
                                '<td class="blue"><a id="' + value.id + '" href="" class="blue batch delete_vendor">Delete Vendor</a></td>' +
                                '</tr>';
                    });
                }
                else
                {
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="3">No matching records found</td>' +
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
    //custom vendor filter
    $('.admin-filter input').on('keyup', function () {

        var parent = $(this).parent();
        var ord_id = parent.children('.ord-id').val();
        var cus_id = parent.children('.cus-id').val();
        var cus_name = parent.children('.cus-name').val();
        var ph = parent.children('.ph').val();
        var email = parent.children('.email').val();
        $.ajax({
            url: base_url + 'admin/customer_search',
            type: 'POST',
            data: {ord_id: ord_id, cus_id: cus_id, cus_name: cus_name, email: email, ph: ph},
            dataType: "json",
            success: function (data) {
                $('.customer-table').empty();
                var result = '<table id="admin_example1" class="display" cellspacing="0" width="100%" >' +
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
                        '<tbody id="admin_customers_filter">';
                var len = Object.keys(data).length;
                if (len > 0)
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
                                '<td class="blue word_break word_break_down"><a class="blue mail-id" href="' + base_url + 'admin/customer_details/' + value.user_id + '">' + value.name + '</a></td>' +
                                '<td>' + joined_date + '</td>' +
                                '<td>' + value.gender + '</td>' +
                                '<td>' + phone + '</td>' +
                                '<td class="blue">Pending</td>' +
                                '<td class="blue word_break word_break_down">' + value.username + '</td>' +
                                '<td class="blue ellipse word_break">' + value.orders + '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="8">No matching records found</td>' +
                            '</tr>';
                }


                result += '</tbody>' +
                        '</table>';
                $('.customer-table').append(result);
                $('#admin_example1').dataTable().fnDestroy();
                $('#admin_example1').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });
    //admin users  filter
    $('.filter_admin_users input').on('keyup', function () {
        var name = $(this).val();
        var role = $('#user_role_select').val();


        $.ajax({
            url: base_url + 'admin/user_search',
            type: 'POST',
            data: {name: name, role: role},
            dataType: "json",
            success: function (data) {
                $('#backend-user-filter').empty();
                var len = Object.keys(data).length;
                if (len > 0)
                {
                    var result = '';

                    $.each(data, function (index, value) {
                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.id + '</td>' +
                                '<td class="blue word_break_down">' + value.name + '</td>' +
                                '<td class="blue word_break_down"><a class="blue v-name" href="' + base_url + 'admin/user_details/' + value.id + '">' + value.username + '</a></td>' +
                                '<td class="blue"><span class="blue v-name">' + value.user_role + '</span></td>' +
                                '<td>' +
                                '<ul class="backend-actions">' +
                                '<li><a href="' + base_url + 'admin/edit_user_details/' + value.id + '" class="blue">Edit</a></li>' +
                                '<li>|</li>' +
                                '<li><a id="' + value.id + '" href="" class="blue delete_user">Delete</a></li>' +
                                '</ul>' +
                                '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="5"  style="border-right:1px solid#bebebe;">No matching records found</td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '</tr>';
                }
                $('#backend-user-filter').append(result);

            }
        });
    });

    //admin users  filter
    $('.filter_admin_users #user_role_select').on('change', function () {
        var name = $('#search_backend_user').val();
        var role = $(this).val();



        $.ajax({
            url: base_url + 'admin/user_search',
            type: 'POST',
            data: {name: name, role: role},
            dataType: "json",
            success: function (data) {
                // return false;
                $('#backend-user-filter').empty();
                var len = Object.keys(data).length;
                if (len > 0)
                {
                    var result = '';

                    $.each(data, function (index, value) {
                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.id + '</td>' +
                                '<td class="blue word_break_down">' + value.name + '</td>' +
                                '<td class="blue word_break_down"><a class="blue v-name" href="' + base_url + 'admin/user_details/' + value.id + '">' + value.username + '</a></td>' +
                                '<td class="blue"><span class="blue v-name">' + value.user_role + '</span></td>' +
                                '<td>' +
                                '<ul class="backend-actions">' +
                                '<li><a href="' + base_url + 'admin/edit_user_details/' + value.id + '" class="blue">Edit</a></li>' +
                                '<li>|</li>' +
                                '<li><a id="' + value.id + '" href="" class="blue delete_user">Delete</a></li>' +
                                '</ul>' +
                                '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="5" style="border-right:1px solid#bebebe;">No matching records found</td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '</tr>';
                }


                $('#backend-user-filter').append(result);

            }
        });
    });


    $('.filter_transaction_by_services').on('change', function () {
        var cs_id = $('#current_customer_id').val();
        var service = $(this).val();
        var start_date = $('#admin_customer_details_filter #startDate').text();
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
                                '<td><span class="blue v-name">' + value.services + '</span><br>' + value.duration + '</td>' +
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
    });

    $('.cs_filter_transaction_by_services').change(function () {
        var cs_id = $('#current_customer_id').val();
        var service = $(this).val();

        $.ajax({
            url: base_url + 'customer_support/customer_transactions_filter',
            type: 'POST',
            data: {cs_id: cs_id, service: service},
            dataType: "json",
            success: function (data) {
                $('#customer_transaction_table_filter').empty();
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
                                status += '<span class="blue medium actions confirmorder">Confirm Order</span>';
                            } else {
                                if (value.mark_attend != undefined) {
                                    if (value.mark_attend == 'Not-attended') {
                                        status += '<span class="blue medium actions remind-customer">Remind Customer</span>';
                                    }
                                }
                            }
                        }

                        var attend = '';
                        if (Date.parse(value.date) > Date.parse(current_date)) {
                            if (value.mark_attend != undefined) {
                                if (value.mark_attend == 'Not-attended') {
                                    attend += '<a id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">                                                         class="blue markattend" href="">Mark as Attended</a>';
                                } else {
                                    attend += 'Attended';
                                }
                            }
                        }
                        var remind = '';
                        if (Date.parse(value.date) > Date.parse(current_date)) {
                            if (value.booking_status == 'Pending') {
                                remind += '<a href="" class="blue" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">>Remind Customer</a>';
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
                                '<td class=""><span class="blue v-name">' + value['vendor_details'].name + '</span> <br>' + value['vendor_details'].area_name + '</td>' +
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
                                '<li><a href="' + base_url + 'customer_support/order_details/' + value.booking_id + '" class="blue" id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '">View Order Detail</a></li>' +
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
                $('#customer_transaction_table_filter').append(result);
            }
        });
    });


    $('.finance_filter_transaction_by_services').change(function () {
        var cs_id = $('#current_customer_id').val();
        var service = $(this).val();

        $.ajax({
            url: base_url + 'finance/customer_transactions_filter',
            type: 'POST',
            data: {cs_id: cs_id, service: service},
            dataType: "json",
            success: function (data) {
                $('#finance_customer_transaction_table_filter').empty();
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

                        result += '<tr id="' + data['user_details'].id + '-' + value.booking_id + '-' + value.slot_id + '" role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.booking_id + '</td>' +
                                '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                '<td class="blue word_break_down">' + data['user_details'].name + '</td>' +
                                '<td class=""><span class="blue v-name word_break_down">' + value['vendor_details'].name + '</span> <br>' + value['vendor_details'].area_name + '</td>' +
                                '<td><span class="blue v-name">' + value.services + '</span><br>' + value.duration + '</td>' +
                                '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
                                '<td>' + value.amount + '</td>' +
                                '</tr>';
                    });
                }
                else if (trans_len == 0)
                {
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="7">No matching records found</td>' +
                            '</tr>';
                }
                $('#finance_customer_transaction_table_filter').append(result);
            }
        });
    });




    $('.filter_vendor_transaction_by_services').on('change', function () {
        var vendor_id = $('#current_vendor_id').val();
        var service = $(this).val();
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
                                    attend += '<a id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '"                                                         class="blue admin_markattend" href="">Mark as Attended</a>';
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
                                '<td><span class="blue v-name">' + value.services + '</span><br>' + value.duration + '</td>' +
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
    });




    $('.filter_vendor_transaction_by_services_for_cs').on('change', function () {
        var vendor_id = $('#current_vendor_id').val();
        var service = $(this).val();

        $.ajax({
            url: base_url + 'customer_support/vendor_transactions_filter',
            type: 'POST',
            data: {vendor_id: vendor_id, service: service},
            dataType: "json",
            success: function (data) {

                $('#cs_vendor_transaction_table_filter').empty();
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
                                status += '<span class="blue medium actions confirmorder">Confirm Order</span>';
                            } else {
                                if (value.mark_attend != undefined) {
                                    if (value.mark_attend == 'Not-attended') {
                                        status += '<span class="blue medium actions remind-customer">Remind Customer</span>';
                                    }
                                }
                            }
                        }
                        var attend = '';
                        if (Date.parse(value.date) > Date.parse(current_date)) {
                            if (value.mark_attend != undefined) {
                                if (value.mark_attend == 'Not-attended') {
                                    attend += '<a id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '"                                                         class="blue markattend" href="">Mark as Attended</a>';
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
                                confirmed += '<a href="" class="green" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '"><i class="fa fa-check fa-confirm"></i>Confirmed</a>';
                            }
                        }
                        result += '<tr id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '" role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.booking_id + '</td>' +
                                '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                '<td class="blue">' + value.user_details.user_id + '</td>' +
                                '<td class="blue word_break_down">' + value.user_details.name + '</td>' +
                                '<td class=""><span class="blue v-name">' + data['vendor_details'].name + '</span> <br>' + data['vendor_details'].area_name + '</td>' +
                                '<td><span class="blue v-name">' + value.services + '</span><br>' + value.duration + ' </td>' +
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
                                '<li><a href="' + base_url + 'customer_support/order_details/' + value.booking_id + '" class="blue" id="' + value.user_details.user_id + '-' + value.booking_id + '-' + value.slot_id + '">View Order Detail</a></li>' +
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
                $('#cs_vendor_transaction_table_filter').append(result);
            }
        });
    });

    $('.finance-cus-filter input').on('keyup', function () {

        var parent = $(this).parent();
        var ord_id = parent.children('.ord-id').val();
        var cus_id = parent.children('.cus-id').val();
        var cus_name = parent.children('.cus-name').val();
        var ph = parent.children('.ph').val();
        var email = parent.children('.email').val();
        $.ajax({
            url: base_url + 'finance/customer_search',
            type: 'POST',
            data: {ord_id: ord_id, cus_id: cus_id, cus_name: cus_name, email: email, ph: ph},
            dataType: "json",
            success: function (data) {
                $('.customer-table').empty();
                var result = '<table id="customer-table" class="display" cellspacing="0" width="100%" >' +
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
                var len = Object.keys(data).length;
                if (len > 0)
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
                                '<td class="blue word_break word_break_down"><a class="blue mail-id" href="' + base_url + 'finance/customer_details/' + value.user_id + '">' + value.name + '</a></td>' +
                                '<td>' + joined_date + '</td>' +
                                '<td>' + value.gender + '</td>' +
                                '<td>' + phone + '</td>' +
                                '<td class="blue">Pending</td>' +
                                '<td class="blue word_break word_break_down">' + value.username + '</td>' +
                                '<td class="blue ellipse word_break">' + value.orders + '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="8">No matching records found</td>' +
                            '</tr>';
                }


                result += '</tbody>' +
                        '</table>';
                $('.customer-table').append(result);
                $('#customer-table').dataTable().fnDestroy();
                $('#customer-table').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });

//custom vendor filter
    $('.finance-vendor-all-filter input').on('keyup', function () {


        var parent = $(this).parent();
        var vr_name = parent.children('.vendor_name').val();
        var vr_loc = parent.children('.vendor_loc').val();
        var vr_ph = parent.children('.vendor_ph').val();
        var vr_email = parent.children('.vendor_email').val();
        var category = parent.children('.category').val();
        $.ajax({
            url: base_url + 'finance/vendors/search_filter',
            type: 'POST',
            data: {vr_name: vr_name, vr_loc: vr_loc, vr_ph: vr_ph, vr_email: vr_email, category: category},
            dataType: "json",
            success: function (data) {
                $('.table-data').empty();
                var len = Object.keys(data).length;
                var result = '<table id="vendor-table1" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="">Vendor Name</th>' +
                        '<th>Locations</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                if (len > 0)
                {

                    $.each(data, function (index, value) {
                        result += '<tr>' +
                                '<td class=""><span class="blue v-name word_break_down">' +
                                '<a class="blue mail-id" href="' + base_url + 'finance/vendor_details/' + value.id + '">' + value.name + '</a>' +
                                '</span>' +
                                '</td>' +
                                '<td class="">' + value.area_name + '</td>' +
                                '<td class="blue"><a href="' + base_url + 'finance/batch_payment/' + value.id + '" class="blue batch">View Batch Payment</a></td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="2">No matching records found</td>' +
                            '</tr>';
                }


                result += '</tbody>' +
                        '</table>';
                $('.table-data').append(result);
                $('#vendor-table1').dataTable().fnDestroy();
                $('#vendor-table1').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });


    $('.finance-vendor-all-filter .vendor_loc').on('change', function () {
//$('.searchcontent').empty();  
        $('.table-data').empty();
        var parent = $(this).parent();
        var vr_name = parent.children('.vendor_name').val();
        var vr_loc = parent.children('.vendor_loc').val();
        var vr_ph = parent.children('.vendor_ph').val();
        var vr_email = parent.children('.vendor_email').val();
        var category = parent.children('.category').val();
        $.ajax({
            url: base_url + 'finance/vendors/search_filter',
            type: 'POST',
            data: {vr_name: vr_name, vr_loc: vr_loc, vr_ph: vr_ph, vr_email: vr_email, category: category},
            dataType: "json",
            success: function (data) {

                var len = Object.keys(data).length;
                var result = '<table id="vendor-table1" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="">Vendor Name</th>' +
                        '<th>Locations</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody class="searchcontent">';
                // var table = $('#vendor-table').DataTable();
                //table.draw();

                if (len > 0)
                {
                    $.each(data, function (index, value) {
                        result += '<tr><td class=""><span class="blue v-name word_break_down">' +
                                '<a class="blue mail-id" href="' + base_url + 'finance/vendor_details/' + value.id + '">' + value.name + '</a>' +
                                '</span>' +
                                '</td>' +
                                '<td class="">' + value.area_name + '</td>' +
                                '<td class="blue"><a href="' + base_url + 'finance/batch_payment/' + value.id + '" class="blue batch">View Batch Payment</a></td>' +
                                '</tr>';
                    });
                }
                else
                {
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="2">No matching records found</td>' +
                            '</tr>';
                }
                result += '</tbody>' +
                        '</table>';
                $('.table-data').append(result);
                $('#vendor-table1').dataTable().fnDestroy();
                $('#vendor-table1').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });
            }
        });
    });




    $('.filter_vendor_transaction_by_services_for_finanace').on('change', function () {
        var vendor_id = $('#current_vendor_id').val();
        var service = $(this).val();
        $('#finance_vendor_transaction_table_filter').empty();
        $.ajax({
            url: base_url + 'finance/vendor_transactions_filter',
            type: 'POST',
            data: {vendor_id: vendor_id, service: service},
            dataType: "json",
            success: function (data) {
                $('#finance_vendor_transaction_table_filter').empty();
                var trans_len = data['transactions'].length;

                if (trans_len != 0)
                {
                    var result = '';
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

                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1"><a href="' + base_url + '/finance/order_details/' + value.booking_id + '" style="color:#00a3d8;">' + value.booking_id + '</a></td>' +
                                '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                '<td class="blue">' + value.user_details.user_id + '</td>' +
                                '<td class="blue word_break_down">' + value.user_details.name + '</td>' +
                                '<td><span class="blue v-name word_break_down">' + value.services + '</span><br>' + value.duration + '</td>' +
                                '<td>' + trdate + '<br/>' + sti + ' ' + meridian2 + '</td>' +
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
                    var result = '';
                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="11">No matching records found</td>' +
                            '</tr>';
                }
                $('#finance_vendor_transaction_table_filter').append(result);
            }
        });
    });


    jQuery.validator.addMethod("agenumber", function (value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Please enter age");

    $('#edit-form').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10


            },
            name: {
                lettersonly: true,
                maxclength: 50

            },
            age: {
                required: true,
                agenumber: true



            },
            role: {
                required: true


            },
            select01: {
                required: true


            }
        }

    });



    $('#sme_user_form').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10


            },
            name: {
                lettersonly: true,
                maxclength: 50

            },
            gender: {
                required: true



            },
            main_service: {
                required: true


            },
            programs: {
                required: true


            },
offering: {
                required: true


            },
username :{ 
         required: true,
         email:true        
}
        }

    });


    $('.services-dropdown').change(function () {

        var option = $(this).val();
        if (option == 2)
        {
            $(this).addClass('service_dropdown_extend');
        }
        else
        {
            $(this).removeClass('service_dropdown_extend');
        }
    });

    var fpattern = /^[0-9]+$/

    $(".ord_id").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }

        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {

            $(this).next().hide();


        }

    });

    $(".ord-id").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }

        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {

            $(this).next().hide();


        }

    });

    $(".cus_id").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });

    $(".cus-id").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });


    var fpattern3 = /^\d{10}$/;



    $(".ph_no").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();
            $(this).next().next().hide();

        }


        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();
            $(this).next().next().hide();

        }

        else if (!fpattern3.test($(this).val())) {

            //alert("yes");
            $(this).next().next().show();
            $(this).next().hide();

        }

        else {


            $(this).next().hide();
            $(this).next().next().hide();

        }

    });


    $(".ph").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();
            $(this).next().next().hide();

        }


        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();
            $(this).next().next().hide();

        }

        else if (!fpattern3.test($(this).val())) {

            //alert("yes");
            $(this).next().next().show();
            $(this).next().hide();

        }

        else {


            $(this).next().hide();
            $(this).next().next().hide();

        }

    });


    $(".vendor_ph").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();
            $(this).next().next().hide();

        }


        else if (!fpattern.test($(this).val())) {

            //alert("yes");
            $(this).next().show();
            $(this).next().next().hide();

        }

        else if (!fpattern3.test($(this).val())) {

            //alert("yes");
            $(this).next().next().show();
            $(this).next().hide();

        }

        else {


            $(this).next().hide();
            $(this).next().next().hide();

        }

    });


    var fpattern1 = /^[a-zA-Z0-9 ]+(\s{0,1}[a-zA-Z0-9 ])*$/;

    $(".cus_name").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern1.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });


    $(".cus-name").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern1.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });


    $(".vendor_name").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern1.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });

    var fpattern4 = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;


    $(".email_id").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern4.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });

    $(".vendor_email").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern4.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });

    $(".email").keyup(function () {

        if ($(this).val() == "") {

            $(this).next().hide();

        }


        else if (!fpattern4.test($(this).val())) {

            //alert("yes");
            $(this).next().show();

        }

        else {


            $(this).next().hide();

        }

    });



    $('.finance_transactions_search_method').on('change', function () {
//$('.searchcontent').empty();  

        var service = $('#finance_transactions_service').val();
        var vendor = $('#finance_transactions_vendor').val();
        var location = $('#finance_transactions_location').val();

        $.ajax({
            url: base_url + 'finance/transaction_search_filter',
            type: 'POST',
            data: {service: service, vendor: vendor, location: location},
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
                        if (value['user_details']) {
                            var user_id = value['user_details'].id;
                            var user_name = value['user_details'].name;
                        } else {
                            var user_id = '';
                            var user_name = '';
                        }
                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1"><a href="' + base_url + '/finance/order_details/' + value['transactions'].booking_id + '" style="color:#00a3d8;">' + value['transactions'].booking_id + '</a></td>' +
                                '<td>' + book_date + '<br>' + ti + ' ' + meridian + '</td>' +
                                '<td class="blue">' + user_id + '</td>' +
                                '<td class="blue word_break_down">' + user_name + '</td>' +
                                '<td class=""><span class="blue v-name word_break">' + value['vendor_details'].name + '</span> <br>' + value['vendor_details'].area_name + '</td>' +
                                '<td><span class="v-name word_break_down">' + value['transactions'].services + '</span></td>' +
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
                    "pageLength": 10,
                    "columnDefs": [{"targets": 6, "orderable": false}, {"targets": 7, "orderable": false}, {"targets": 8, "orderable": false}, {"targets": 9, "orderable": false}]
                });
            }
        });
    });


    $('.download11').click(function () {
        var id = $(this).attr('id');
        var status = $(this).attr('title');
        $.ajax({
            url: '' + base_url + 'admin/update_vendor_status',
            type: 'POST',
            data: {id: id, status: status},
            success: function (data) {
                location.reload();
            }
        });
        return false;
    });

    $('body').on('click', '.img_del', function () {
        var name = $(this).prev().attr('class');
        var business_id = $('[name=id]').val();
        $(this).prev().hide();
        $(this).hide();
        if (confirm("Are you sure you want to delete this Image?") === true)
        {

            $.ajax({
                type: 'POST',
                url: base_url + 'customer_support/delete_business_gallery_image',
                data: {name: name, business_id: business_id},
                dataType: "json",
                success: function (data) {

                    var count = $('[name=count]').val();
                    var valuecount = count - 1;
                    $('input[name=count]').val(valuecount);
                    if (valuecount < 6)
                    {
                        $('#add_more').show();
                    }
                }
            });

        }
        else
        {
            $(this).prev().show();
            $(this).show();
        }
    });

    $('body').on('change', '.packages', function () {
        var value1 = ($('option:selected', this).val());
        if ((value1 === "new")) {
            $('.popup').show();
            $('.mask').show();
        }
    });

    $('body').on('click', '.mask', function () {

        $('.popup').hide();
        $('.mask').hide();

    });


    $('body').on('click', '.adding_package', function () {

        var package = $('.package').val();
        var type = $('.type').val();
        var business_id = $('input[name=business_id]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'customer_support/adding_business_programs',
            data: {package: package, type: type, business_id: business_id},
            dataType: "json",
            success: function (data) {
                $('popup').hide();
                $('mask').hide();
                location.reload();

            }
        });

    });


    $('body').on('click', '.package_delete', function () {

        var package_id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this package/treatment!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'customer_support/delete_business_package',
                data: {package_id: package_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
    });


    $('body').on('click', '.service_delete', function () {

        var service_id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this service!") == true)
        {

            $.ajax({
                type: 'POST',
                url: base_url + 'customer_support/delete_business_services',
                data: {service_id: service_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }



    });

    var table = $('#vendor-table33').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        // "bAutoWidth": false,
        //"pageLength": 10,
        "aaSorting": [[1, "desc"]]
    });


   
//Sme user filter search
    //admin users  filter
    $('.filter_admin_smeusers input').on('keyup', function () {
        var name = $(this).val();


        $.ajax({
            url: base_url + 'admin/sme/user_search',
            type: 'POST',
            data: {name: name},
            dataType: "json",
            success: function (data) {
                $('#backend-user-filter').empty();
                var len = Object.keys(data).length;
                if (len > 0)
                {
                    var result = '';

                    $.each(data, function (index, value) {
                       if(value.status == 'enable') { 
	var sme_user_status = '<a class="blue " href="' + base_url + 'admin/sme/edit_user_status/'+ value.sme_userid +'/disable">Disable</a>';
	} else {
	var sme_user_status = '<a class="blue " href="'+ base_url +'admin/sme/edit_user_status/'+ value.sme_userid +'/enable">Enable</a>';
	}
 if(value.last_name != null) { 
								var last_name = value.last_name;
							} else {
								var last_name = '';
							 }
                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.sme_userid + '</td>' +
                                '<td class="blue word_break_down">' + value.first_name + ' ' + last_name + '</td>' +
                                '<td class="blue word_break_down"><a class="blue v-name" href="' + base_url + 'admin/sme/user_details/' + value.sme_userid + '">' + value.username + '</a></td>' +
                                '<td class="blue"><span class="blue v-name">' + value.phone + '</span></td>' +
                                '<td class="blue"><span class="blue v-name">' + value.ranking + '</span></td>' +
                                '<td>' +
                                '<ul class="backend-actions">' +
                                '<li><a href="' + base_url + 'admin/sme/edit_user_details/' + value.sme_userid + '" class="blue">Edit</a></li>' +
                                '<li>|</li>' +
                                '<li><a id="' + value.sme_userid + '" href="" class="blue delete_smeuser">Delete</a></li>' +
                                '<li>'+ sme_user_status +'</li>'+
                                '</ul>' +
                                '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="6"  style="border-right:1px solid#bebebe;">No matching records found</td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '</tr>';
                }
                $('#backend-user-filter').append(result);

            }
        });
    });


    //Sme user filter search
    //admin users  filter
    $('.filter_admin_smeevent input').on('keyup', function () {
        var name = $(this).val();


        $.ajax({
            url: base_url + 'admin/sme/event_search',
            type: 'POST',
            data: {name: name},
            dataType: "json",
            success: function (data) {
                $('#backend-user-filter').empty();
                var len = Object.keys(data).length;
                if (len > 0)
                {
                    var result = '';

                    $.each(data, function (index, value) {
                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.id + '</td>' +
                                '<td class="blue word_break_down">' + value.first_name + ' ' + value.last_name + '</td>' +
                                '<td class="blue sorting_1">' + value.title + '</td>' +
                                '<td class="blue sorting_1">' + value.location + '</td>' +
                                '<td class="blue sorting_1">' + value.date + '</td>' +
                                '<td>' +
                                '<ul class="backend-actions">' +
                                '<li><a href="' + base_url + 'admin/sme/edit_event_details/' + value.id + '" class="blue">Edit</a></li>' +
                                '<li>|</li>' +
                                '<li><a id="' + value.id + '" href="" class="blue delete_smeevent">Delete</a></li>' +
                                '</ul>' +
                                '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="6"  style="border-right:1px solid#bebebe;">No matching records found</td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '</tr>';
                }
                $('#backend-user-filter').append(result);

            }
        });
    });

    $('.filter_admin_smearticle input').on('keyup', function () {
        var article = $(this).val();


        $.ajax({
            url: base_url + 'admin/sme/article_search',
            type: 'POST',
            data: {article: article},
            dataType: "json",
            success: function (data) {
                $('#backend-user-filter').empty();
                var len = Object.keys(data).length;
                if (len > 0)
                {
                    var result = '';

                    $.each(data, function (index, value) {
if(value.last_name != null){
                    		var last_name = value.last_name;
                    		}
                    		else{
                    			
                    			var last_name = '';
                    			}
                        result += '<tr role="row" class="odd">' +
                                '<td class="blue sorting_1">' + value.id + '</td>' +
                                '<td class="blue word_break_down">' + value.first_name + ' ' + last_name + '</td>' +
                                '<td class="blue word_break_down"><a class="blue v-name" href="' + base_url + 'admin/sme_article_details/' + value.id + '">' + value.heading + '</a></td>' +
                                '<td>' +
                                '<ul class="backend-actions">' +
                                '<li><a href="' + base_url + 'admin/sme_edit_article_details/' + value.id + '" class="blue">Edit</a></li>' +
                                '<li>|</li>' +
                                '<li><a id="' + value.id + '" href="" class="blue delete_smearticle">Delete</a></li>' +
                                '</ul>' +
                                '</td>' +
                                '</tr>';
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="4"  style="border-right:1px solid#bebebe;">No matching records found</td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '<td style="display:none;"></td>' +
                            '</tr>';
                }
                $('#backend-user-filter').append(result);

            }
        });
    });

    $('body').on('click', '.delete_smeuser', function () {
        var user_id = $(this).attr('id');
       if (confirm("Are you sure you want to delete this user!") === true)
        {
        $.ajax({
            url: '' + base_url + 'admin/sme/delete_user',
            type: 'POST',
            data: {user_id: user_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/sme_users';
            }
        });
       }
        return false;
    });

    $('body').on('click', '.delete_smeevent', function () {
        var event_id = $(this).attr('id');
      if (confirm("Are you sure you want to delete this event!") === true)
        {
        $.ajax({
            url: '' + base_url + 'admin/sme/delete_event',
            type: 'POST',
            data: {event_id: event_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/sme_events';
            }
        });
      }
        return false;
    });

    $('body').on('click', '.delete_smearticle', function () {
        var article_id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this article!") === true)
        {
        $.ajax({
            url: '' + base_url + 'admin/sme/delete_article',
            type: 'POST',
            data: {article_id: article_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/sme_articles';
            }
        });
       }
        return false;
    });



});
