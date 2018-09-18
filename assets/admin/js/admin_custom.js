$(document).ready(function () {
   //var base_url = 'http://localhost/zinguplife/';
    var base_url = 'http://zinguplife.com/';


$("#admin_vendor_packages_treatments_form").on("submit", function(e){	
     var pattern = /^[0-9%]+$/;
	var discount = $(this).find('.service_discount').val();
	var discount_start_date = $(this).find('.service_discount_start_date').val();
	var discount_end_date = $(this).find('.service_discount_end_date').val();
	if(discount != ''){
		if(discount_start_date == '' && discount_end_date == ''){
		e.preventDefault();
		$(this).find('.error_start_date').show();
                $(this).find('.error_end_date').show();
		}
                else if(discount_start_date == '' && discount_end_date != ''){
                e.preventDefault();
		$(this).find('.error_start_date').show();
                $(this).find('.error_end_date').hide();
                }
                else if(discount_start_date != '' && discount_end_date == ''){
                e.preventDefault();
		$(this).find('.error_start_date').hide();
                $(this).find('.error_end_date').show();
                }
		else{
                     $(this).find('.error_start_date').hide(); 
                     $(this).find('.error_end_date').hide();
                        if (!pattern.test(discount)) {
                          e.preventDefault();
			 	  $(this).find('.error_service_discount').show();
                         }
			 else{
                        $(this).find('.error_service_discount').hide();
                          }
			 if(discount_start_date > discount_end_date){
			 	 e.preventDefault();
			 	  $(this).find('.error_start_date_greater').show();
			 	}
			 	else if(discount_end_date < discount_start_date){
			 		e.preventDefault();
			 	  $(this).find('.error_end_date_less').show();
			 		}
			 		else{
			 			 $(this).find('.error_start_date_greater').hide();
			 			$(this).find('.error_end_date_less').hide();
			 			}
			}
	}
	return true;
	});

$("#admin_vendor_business_service_edit_form").on("submit", function(e){
 var pattern = /^[0-9%]+$/;	
	var discount = $(this).find('.service_discount').val();
	var discount_start_date = $(this).find('.service_discount_start_date').val();
	var discount_end_date = $(this).find('.service_discount_end_date').val();
	if(discount != ''){
		if(discount_start_date == '' && discount_end_date == ''){
		e.preventDefault();
		$(this).find('.error_start_date').show();
		 $(this).find('.error_end_date').show();
		}
                 else if(discount_start_date == '' && discount_end_date != ''){
                e.preventDefault();
		$(this).find('.error_start_date').show();
                $(this).find('.error_end_date').hide();
                }
                else if(discount_start_date != '' && discount_end_date == ''){
                e.preventDefault();
		$(this).find('.error_start_date').hide();
                $(this).find('.error_end_date').show();
                }
		else{
			 $(this).find('.error_start_date').hide();
                         $(this).find('.error_end_date').hide();
                          if (!pattern.test(discount)) {
                          e.preventDefault();
			 	  $(this).find('.error_service_discount').show();
                         }
			 else{
                        $(this).find('.error_service_discount').hide();
                          }
			 if(discount_start_date > discount_end_date){
			 	 e.preventDefault();
			 	  $(this).find('.error_start_date_greater').show();
			 	}
			 	else if(discount_end_date < discount_start_date){
			 		e.preventDefault();
			 	  $(this).find('.error_end_date_less').show();
			 		}
			 		else{
			 			 $(this).find('.error_start_date_greater').hide();
			 			$(this).find('.error_end_date_less').hide();
			 			}
			}
	}
	return true;
	});
	



    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i.test(value);
    }, "special characters not allowed");
    jQuery.validator.addMethod("maxclength", function (value, element) {
        return this.optional(element) || /^[a-z0-9, ]{0,50}$/i.test(value);
    }, "More then 50 characters not allowed");
    jQuery.validator.addMethod("minplength", function (value, element) {
        return this.optional(element) || /^.{6,}$/i.test(value);
    }, "Password should be minimum 6 characters");

       
     $('#admin_vendor_service_slots').validate({
 		      rules: {
            programs: {required: true
            },
            services: {required: true
            }
        }
 
    });
    
    
    $('#cs_vendor_one_day_pacakge_edit').validate({
 		      rules: {
            package_name: {required: true
            },
            hours: {required: true
            },
            minutes: {required: true
            }
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
        var service_id = $('.service_type').val(); 
        var package = $('.package').val();
        var type = $('.type').val();
        var business_id = $('input[name=business_id]').val();
        if(package == ''){
    $('#admin_error_popup_package_name').show();
               	}
else{
$('#admin_error_popup_package_name').hide();
}
 if(service_id == ''){
$('#admin_error_popup_service_name').show();
  
}
else{
$('#admin_error_popup_service_name').hide();
}
 if(type == ''){
$('#admin_error_popup_type').show();
         
}
else{
$('#admin_error_popup_type').hide();
}        	if(package != '' && service_id !='' && type!= ''){

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/adding_business_programs',
            data: {package: package, type: type,business_id:business_id},
            dataType: "json",
            success: function (data) {
                $('popup').hide();
                $('mask').hide();
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
                url: base_url + 'admin/delete_business_package',
                data: {package_id: package_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;
    });
    
    
     $('body').on('click', '#service_delete', function () {

        var service_id = $(this).attr('service_id');
       // alert(service_id);
        if (confirm("Are you sure you want to delete this service!") === true)
        {

            $.ajax({
                type: 'POST',
                url: base_url + 'admin/delete_business_services',
                data: {service_id: service_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }

        return false;

    });
    
    
      $('body').on('click', '#business_gallery_delete', function () {

        var gallery_id = $(this).attr('gallery_id');
         var business_id = $(this).attr('business_id');
         var business_name = $(this).attr('business_name');
          if (confirm("Are you sure you want to delete this image!") === true)
        {
       
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/delete_business_gallery',
                data: {business_id: business_id,gallery_id: gallery_id,business_name: business_name},
                dataType: "json",
                success: function (data) {
                    window.location.reload();

                }
            });
        }
        return false;
    });


    $('body').on('click', '#business_service_gallery_delete', function () {

        var service_id = $(this).attr('service_id');
        if (confirm("Are you sure you want to delete this image!") === true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/business_service_gallery_delete',
                data: {service_id: service_id},
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    location.reload();

                }
            });
        }
        return false;


    });	
	


 $('.service-name-filter input').on('keyup', function () {


        var service_name = $('.service_name').val();
         var business_id = $('.businessid').val();
        $.ajax({
            url: base_url + 'admin/service_search_filter',
            type: 'POST',
            data: {service_name: service_name,business_id:business_id},
            dataType: "json",
            success: function (data) {
                $('.cs_service_list').empty();
                var len = Object.keys(data).length;
                var result = '<table id="example" class="display" cellspacing="0" width="100%" >' +
                        '<thead>' +
                        '<tr>' +
                        '<th class="filter-input">Service Name</th>' +
                        '<th class="filter-input">Duration</th>' +
                        '<th class="filter-input">Price</th>' +
                        '<th class="filter-input">Booking type</th>' +
                        '<th class="filter-input">Gallery</th>' +
                        '<th>Actions</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody id="cs_backend_user">';
                if (len > 0)
                {

                    $.each(data, function (index, value) {
                        result += '<tr>' +
                                '<td class="blue">'+ value.services +'</td>' +
                                '<td class="blue">' + value.duration + '</td>' +
                                '<td class="blue">' + value.price + '</td>' +
                                '<td class="blue">' + value.service_type + '</td>' +
                                '<td class="blue">'+                                
                                '<ul class="backend-actions">'+
                                '<li><a class="blue" href="'+base_url+'admin/business_service_gallery/'+value.id+'">View Gallery</a></li>'+
                                '</ul>'+ 
                                '</td>'+
                                '<td class="blue">'+                                
                                '<ul class="backend-actions">'+
                                '<li><a class="blue" href="'+base_url+'admin/business_service_edit/'+value.id+'">Edit</a></li>'+
                                '<li>|</li>'+
                                '<li><a href="" class="blue" id="service_delete" service_id="'+value.service_id+'" >Delete</a></li>'+
                                '</ul>'+ 
                                '</td>'+
                                '</tr>';
                    
                    });
                }
                else
                {

                    result += '<tr class="odd">' +
                            '<td class="dataTables_empty" valign="top" colspan="6">No matching records found</td>' +
                            '</tr>';
                }


                result += '</tbody>' +
                        '</table>';
                $('.cs_service_list').append(result);
                $('#example').dataTable().fnDestroy();
                $('#example').DataTable({
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "pageLength": 10
                });      
               
            }
        });
    });

 $('body').on('click', '#one_time_service_slots_delete', function () {

        var slot_id = $(this).attr('slot_id');
       // alert(service_id);
        if (confirm("Are you sure you want to delete this slot!") === true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/one_time_service_slots_delete',
                data: {slot_id: slot_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;


    });

 $('body').on('click', '#membership_delete', function () {

        var member_id = $(this).attr('member_id');
       // alert(service_id);
        if (confirm("Are you sure you want to delete this membership!") === true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/delete_offerings_memberships',
                data: {member_id: member_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;


    });	
    
    $('body').on('click', '#one_day_package_delete', function () {

        var package_id = $(this).attr('package_id');
        if (confirm("Are you sure you want to delete this package!") === true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/delete_one_day_package',
                data: {package_id: package_id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;


    });


$('body').on('change', '.programs', function () {

        var program_id = $('.programs').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/get_business_services',
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


});
