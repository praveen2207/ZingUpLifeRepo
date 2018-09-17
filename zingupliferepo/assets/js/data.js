$(document).ready(function () {
//    $("body").dblclick(function (e) {
//        alert('5455');
//        e.preventDefault();
//        return false;
//    });
    $('#offerings_locations').hide();
    $('#offering_vendors').hide();
    //var base_url = 'http://localhost/zinguplife/';
    var base_url = 'http://zinguplife.com/';
    var locations_count = '';
    var error = 'No Record Found';
    $('body').on('click', '.services a', function (e) {
        var service_id = $(this).attr('class');
        var location_id = $(this).attr('id');
        $('body #offerings_vendors').html('');
        $('body #offerings_vendors').empty();
        if (location_id == '')
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'get_locations_by_service',
                data: {service_id: service_id},
                dataType: "json",
                success: function (data) {
                    var locations_count = data['locations'].length;
                    $('#offerings').hide();
                    $('#offering_vendors').hide();
                    $('#offerings_locations').show();
                    $('#offerings_locations').html('');
                    $('body #offerings_vendors').html('');
                    $('body #offerings_vendors').empty();
                    if (locations_count > 0) {
                        $('#offerings_locations').append('<h3 class="con-offer">' + data['services'].service_name + '</h3>');
                        $.each(data['locations'], function (key, val) {
                            $('#offerings_locations').append('<div class="span4 services">\n\
                                            <a id="' + val.suburb + '" class="' + service_id + '" href="">\n\
                                            <h2>' + val.area_name + '</h2>\n\
                                            </a>\n\
                                            </div>');
                        });
                    } else {
                        $('#offerings_locations').append('<div class="row con-row error-row"><p class="page-error">' + error + '</p><a href="" id="services_back" class="back">Back</a></div>');
                    }
                    $('body').on('click', '#services_back', function () {
                        $('#offerings').show();
                        $('#offering_vendors').hide();
                        $('#offerings_locations').hide();
                        return false;
                    });
                }
            });
        } else
        {
            e.preventDefault();
            e.stopPropagation();
            $('body #offerings_vendors').html('');
            $('body #offerings_vendors').empty();
            $.ajax({
                type: 'POST',
                url: base_url + 'getVendor',
                data: {service_id: service_id, location_id: location_id},
                dataType: "json",
                success: function (data) {
                    $('body #offerings_vendors').html('');
                    $('body #offerings_vendors').empty();
                    var vendors_count = data['business_providers'].length;
                    $('#offerings').hide();
                    $('#offering_vendors').show();
                    $('#offerings_locations').hide();

                    if (vendors_count > 0) {
                        $('body #offerings_vendors').html('');
                        $('body #offerings_vendors').empty();
                        $('#offering_vendors').append('<h5 class="category">' + data['services'].service_name + '-' + data['location'].suburb + '</h5>');
                        if (vendors_count == 1) {
                            $('body #offerings_vendors').html('');
                            $('body #offerings_vendors').empty();
                            $.each(data['business_providers'], function (key, val) {
                                $('#offering_vendors').append('<div class="row vendor-row">\n\
		                                   <div class="vendor-image">\n\
	                                           <a href="' + base_url + 'vendorDetails/' + val['details'].id + '"><img src="' + data['logo'] + val['details'].id + '/' + val['details'].logo + '"></a>\n\
		                                     </div>\n\
                                                       </div>');
                            });
                        } else
                        {
                            $('body #offerings_vendors').html('');
                            $('body #offerings_vendors').empty();
                            var count = 0;
                            var column_class = '';
                            var row_class = '';
                            $('#offering_vendors').append('<div class="row vendor-trt-row" id="multiple_vendors">');
                            $.each(data['business_providers'], function (key, val) {
                                count++;
                                var remainder = count % 3;
                                if (remainder == 0) {
                                    column_class = 'span-last';
                                } else
                                {
                                    column_class = '';
                                }
                                if (count > 3)
                                {
                                    row_class = 'span-sec row-class-left';
                                } else
                                {
                                    row_class = '';
                                }
                                $('#multiple_vendors').append('<div class="' + row_class + '">\n\
                                                                <div class="span3 ' + column_class + '">\n\
                                                                    <a class="vendor-link" href="' + base_url + 'vendorDetails/' + val['details'].id + '"><img src="' + data['logo'] + val['details'].id + '/' + val['details'].logo + '"></a>\n\
                                                                </div>\n\
                                                            </div> ');
                            });
                        }
                    } else
                    {
                        $('#offering_vendors').append('<div class="row con-row error-row"><p class="page-error">' + error + '</p><a href="" id="vendors_back" class="back">Back</a></div>');
                    }
                    $('body').on('click', '#vendors_back', function () {
                        $('#offerings').hide();
                        $('#offering_vendors').hide();
                        $('#offerings_locations').show();
                        return false;
                    });
                }
            });
        }
        return false;
    });




    $('body').on('click', '.editvendornamesubmit', function () {
        var name = $('.name').val();
        var vendorid = $('#vendor_id').val();



        $.ajax({
            type: 'POST',
            url: base_url + 'update_vendorprofile',
            data: {name: name, vendor_id: vendorid},
            dataType: "json",
            success: function (data) {

                $('.name_validate_error').hide();
                $('.name-input').hide();
                $('.name-val').empty();
                $('.name-val').html(data['update_partner'].first_name);
                $('.photo-name').empty();
                $('.photo-name').html(data['update_partner'].first_name);
                $('.name-span').show();
                $('.pr-success').show();
                //return false;

            }
        });


    });



    $('body').on('click', '.editvendorlastnamesubmit', function () {
        var lastname = $('.lastname').val();
        var vendorid = $('#vendor_id').val();



        $.ajax({
            type: 'POST',
            url: base_url + 'update_vendorprofile',
            data: {lastname: lastname, vendor_id: vendorid},
            dataType: "json",
            success: function (data) {
                $('.name_validate_error').hide();
                $('.name-input').hide();
                $('.lastname-val').empty();
                $('.lastname-val').html(data['update_partner'].last_name);
                $('.photo-name').empty();
                $('.photo-name').html(data['update_partner'].last_name);
                $('.name-span').show();
                $('.pr-success').show();
                //return false;

            }
        });


    });

    $(document).on('change', '#packages', function () {
        var value1 = ($('option:selected', this).val());
        // alert(value1);
        if ((value1 === "new")) {
            // alert(value1);
            $('.popup').show();
            $('.mask').show();
        }
    });

    $('body').on('click', '.mask', function () {

        $('.popup').hide();
        $('.mask').hide();

    });


    $('body').on('click', '.adding_package', function () {
        var service_id = $('.service_type').val();
        var package = $('.package').val();
        var type = $('.type').val();
if(package == ''){
    $('#cs_error_popup_package_name').show();
               	}
else{
$('#cs_error_popup_package_name').hide();
}
 if(service_id == ''){
$('#cs_error_popup_service_name').show();
  
}
else{
$('#cs_error_popup_service_name').hide();
}
 if(type == ''){
$('#cs_error_popup_type').show();
         
}
else{
$('#cs_error_popup_type').hide();
}        	if(package != '' && service_id !='' && type!= ''){

        $.ajax({
            type: 'POST',
            url: base_url + 'adding_business_programs',
            data: {service_id: service_id, package: package, type: type},
            dataType: "json",
            success: function (data) {
                //console.log(data);
                $('popup').hide();
                $('mask').hide();
                location.reload();

            }
        });
   }
    });


    $('body').on('change', '.programs', function () {

        var program_id = $('.programs').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'get_business_services',
            data: {program_id: program_id},
            dataType: "json",
            success: function (data) {
                $('#services_listing').html('');
                $('#services_listing').append('<option value="">Please Select</option>');
                $.each(data['services'], function (key, val) {
                    $('#services_listing').append('<option value="' + val.id + '">' + val.services + '</option>');
                });

            }
        });

    });



    $('body').on('click', '.service_delete', function () {

        var service_id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this service!") == true)
        {

            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/delete_business_services',
                data: {service_id: service_id},
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    location.reload();

                }
            });
        }



    });



    $('body').on('click', '.package_delete', function () {

        var package_id = $(this).attr('id');
        if (confirm("Are you sure you want to delete this package/treatment!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/delete_business_package',
                data: {package_id: package_id},
                dataType: "json",
                success: function (data) {
                    //console.log(data);
                    location.reload();

                }
            });
        }
    });

    $('body').on('click', '.editnamesubmit', function () {
        var name = $('.name').val();
        var userid = $('#user_id').val();


        var pattern1 = /^[a-z0-9, ]{0,50}$/i;
        var pattern2 = /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i;


        if (name == "") {
            $(this).parent().find(".form-error").show();
            $(this).parent().find(".form-error1").hide();
            $(this).parent().find(".form-error2").hide();
            $(".name").addClass("error");

        } else if (!pattern2.test(name)) {
            $(this).parent().find(".form-error").hide();
            $(this).parent().find(".form-error1").hide();
            $(this).parent().find(".form-error2").show();
            $(".name").addClass("error");

        } else if (!pattern1.test(name)) {
            $(this).parent().find(".form-error").hide();
            $(this).parent().find(".form-error1").show();
            $(this).parent().find(".form-error2").hide();
            $(".name").addClass("error");

        } else {
            $(this).parent().find(".form-error").hide();
            $(this).parent().find(".form-error1").hide();
            $(this).parent().find(".form-error2").hide();
            $(".name").removeClass("error");



            $.ajax({
                type: 'POST',
                url: base_url + 'update_profile',
                data: {name: name, user_id: userid},
                dataType: "json",
                success: function (data) {
                    if (data['name_validation_error'] !== '')
                    {
                        //$('.name_validate_error').show();
                        //return false;
                    } else
                    {
                        $('.name_validate_error').hide();
                        $('.name-input').hide();
                        $('.name-val').empty();
                        $('.name-val').html(data['update_user'].name);
                        $('.photo-name').empty();
                        $('.photo-name').html(data['update_user'].name);
                        $('.name-span').show();
                        $('.pr-success').show();
                        //return false;
                    }
                }
            });
        }

    });

    $('body').on('click', '.editgendersubmit', function () {
        var gender = $('.gender').val();
        var userid = $('#user_id').val();

        if ($(".gender").find("option:selected").index() == "0") {

            $(this).parent().find(".form-error").show();

            $(".gender").addClass("error");

        }



        else {

            $(this).parent().find(".form-error").hide();

            $(".gender").removeClass("error");





            $.ajax({
                type: 'POST',
                url: base_url + 'update_profile',
                data: {gender: gender, user_id: userid},
                dataType: "json",
                success: function (data) {
                    if (data['gender_validation_error'] !== '')
                    {
                        // $('.gender_validate_error').show();
                        // return false;
                    } else
                    {
                        $('.gender_validate_error').hide();
                        $('.gender-input').hide();
                        $('.gender-value').empty();
                        $('.gender-value').html(data['update_user'].gender);
                        $('.gender-span').show();
                        $('.pr-success').show();
                        //return false;
                    }
                }
            });

        }

    });

    $('body').on('click', '.editagesubmit', function () {
        var age = $('.age').val();
        var userid = $('#user_id').val();

        var pattern3 = /^[0-9]+$/;


        if (age == "") {
            $(this).parent().find(".form-error").show();
            $(this).parent().find(".form-error1").hide();
            $(this).parent().find(".form-error2").hide();
            $(".age").addClass("error");
        } else if (!pattern3.test(age)) {
            $(this).parent().find(".form-error").hide();
            $(this).parent().find(".form-error1").show();
            $(".age").addClass("error");
        } else {
            $(this).parent().find(".form-error").hide();
            $(this).parent().find(".form-error1").hide();
            $(this).parent().find(".form-error2").hide();
            $(".age").removeClass("error");


            $.ajax({
                type: 'POST',
                url: base_url + 'update_profile',
                data: {age: age, user_id: userid},
                dataType: "json",
                success: function (data) {
                    if (data['age_validation_error'] !== '')
                    {
                        //$('.age_validate_error').show();
                        // return false;
                    } else
                    {
                        $('.age_validate_error').hide();
                        $('.age-input').hide();
                        $('.age-value').empty();
                        $('.age-value').html(data['update_user'].age);
                        $('.age-span').show();
                        $('.pr-success').show();
                        //return false;
                    }
                }
            });
        }

    });

    $('body').on('click', '.editphonesubmit', function () {
        var phone = $('.phone').val();
        var userid = $('#user_id').val();

        var pattern = /^\d{10}$/;

        $(".phone").keyup(function () {



        });

        if (phone == "") {


            alert("yes");

            $(this).parent().find(".form-error").show();

            $(this).parent().find(".form-error1").hide();

            $(".phone").addClass("error");

            return false;


        } else if (!pattern.test(phone)) {

            //alert("yes");
            //alert(phone);

            $(this).parent().find(".form-error").hide();

            $(this).parent().find(".form-error1").show();

            $(".phone").addClass("error");



            return false;


        }
        else {
            $.ajax({
                type: 'POST',
                url: base_url + 'update_profile',
                data: {phone: phone, user_id: userid},
                dataType: "json",
                success: function (data) {
                    if (data['phone_validation_error'] !== '')
                    {
                        // $('.phone_validate_error').show();

                        //return false;
                    } else if (data['phone_length_validation_error'] !== '')
                    {
                        //$('.phone_length_validation_error').show();
                        //return false;
                    } else
                    {
                        $('.phone_validate_error').hide();
                        $('.phone_length_validation_error').hide();
                        $('.phone-input').hide();
                        $('.phone-value').empty();
                        $('.phone-value').html(data['update_user'].phone);
                        $('.phone-span').show();
                        $('.pr-success').show();

                        $(".phone").removeClass("error");

                        // false;
                    }
                }
            });



            return true;
        }

    });


});
