$(document).ready(function () {


$("#vendor_packages_treatments_form").on("submit", function(e){	
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



$("#vendor_business_service_edit_form").on("submit", function(e){
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
               if (!pattern.test(discount)) {
                          e.preventDefault();
			 	  $(this).find('.error_service_discount').show();
                         }
			 else{
                        $(this).find('.error_service_discount').hide();
                          }
		else{
			 $(this).find('.error_start_date').hide();
                         $(this).find('.error_end_date').hide();
                          
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
	

//    $(".logo-click").click(function () {
//
//        if (confirm("Do you want to leave this page?")) {
//            return true;
//        }
//        else {
//            return false;
//        }
//    });

//    jQuery.validator.addMethod("lettersonly", function (value, element) {
//        return this.optional(element) || /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i.test(value);
//    }, "please enter letters");
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


    $('#reset_password').validate({
        rules: {
            password: {minplength: 6
            },
            confirm_password: {minplength: 6
            }


        }
    });

    $('#review').validate({
        rules: {
            check: {required: function (element) {
                    var boxes = $('.checkbox');
                    if (boxes.filter(':checked').length == 0) {
                        return true;
                    }
                    return false;
                }, minlength: 1}}, messages: {check: "Please select the checkbox."}

    });



/* validation for vendor forms */
$('#vendor_business_info_form').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            business_name: {required: true,lettersonly: true, maxclength: 50},
            area: {required: true
            },
           email:{required: true,email: true}
}
    });



$('#vendor_add_business_gallery').validate({
        rules: {
        file:{
                required: true   
        }
       }
    });




$('#vendor_business_service_edit_form').validate({
        rules: {
            service_name: {required: true,lettersonly: true},
            price: {required: true
            },
            duration_hour: {required: true
            },
           duration_minutes: {required: true
            },
           service_type:{required: true}
}
    });





$('#vendor_add_offering_gallery').validate({
        rules: {
           file:{
                required: true   
        }
}
    });

$('#vendor_business_hrs').validate({
        rules: {
           programs:{
                required: true   
        },
services:{
                required: true   
        }
}
    });





$('#vendor_one_time_slot').validate({
        rules: {
           service_name:{
                required: true   
        },
date:{
                required: true   
        }

}
    });




$('#partner_business_package_edit').validate({
        rules: {
           package_name:{
                required: true   
        },
service: {
                required: true
            },
type:{
                required: true
            }


}
    });

/* validation for vendor forms*/


    //var pattern = /^\[0-9, ]{10}$/;

    /*$(this).prev("input[type='tel']").keyup(function () {
     
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).addClass("error");
     return false;
     
     } else if (!pattern.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).addClass("error");
     return false;
     
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).removeClass("error");
     return false;
     
     /
     
     });
     var pattern1 = /^[a-z0-9, ]{0,50}$/i;
     var pattern2 = /^[a-zA-Z-0-9,]+(\s{0,1}[a-zA-Z-0-9, ])*$/i;
     $(this).prev("input[type='text']").keyup(function () {
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).addClass("error");
     
     } else if (!pattern1.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).parent().find(".form-error2").hide();
     $(this).addClass("error");
     } else if (!pattern2.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").show();
     $(this).addClass("error");
     } else {
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
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).removeClass("error");
     }
     
     });
     
     
     
     /*$(this).prev("input[type='tel']").each(function () {
     
     
     
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).addClass("error");
     return false;
     } else if (!pattern.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).addClass("error");
     return false;
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).removeClass("error");
     return true;
     
     }
     
     
     
     
     });
     
     var pattern3 = /^[0-9]+$/;
     
     
     $(this).prev("input[name='e-sel']").each(function () {
     
     
     
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).addClass("error");
     } else if (!pattern3.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).addClass("error");
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).removeClass("error");
     
     }
     
     
     
     
     });
     
     $(this).prev("input[name='e-sel']").keyup(function () {
     
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).addClass("error");
     } else if (!pattern3.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).addClass("error");
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).removeClass("error");
     }
     
     });
     
     
     
     
     
     $('.edit-input #select01').on('change', function () {
     if ($(this).val == "")
     {
     $(this).next().find(".form-error").show();
     } else
     {
     $(this).next().find(".form-error").hide();
     }
     });
     
     
     
     /* $(".edit-input").each(function () {
     
     //alert("yes");
     
     
     $(this).find(".e-button").click(function () {
     
     //("yes");
     
     
     $(this).prev("input").keyup(function () {
     
     alert('10');
     
     if ($(this).val() == "") {
     alert('2');
     $(this).parent().find(".form-error").show();
     
     $(this).addClass("error");
     
     } else {
     alert('3');
     
     $(this).parent().find(".form-error").hide();
     
     $(this).removeClass("error");
     
     $(this).parent().find(".form-error1").hide();
     
     }
     
     
     
     
     
     
     
     
     
     });
     
     
     
     
     
     var pattern =  /^\d{10}$/ ;
     
     
     
     $(this).prev("input[type='tel']").keyup(function () {
     alert('1');
     
     if ($(this).val() == "") {
     alert('5');
     
     //alert("yes");
     
     $(this).parent().find(".form-error").show();
     
     $(this).parent().find(".form-error1").hide();
     
     $(this).addClass("error");
     
     return false;
     
     
     } else if (!pattern.test($(this).val())) {
     alert('6');
     // alert("yes");
     
     $(this).parent().find(".form-error").hide();
     
     $(this).parent().find(".form-error1").show();
     
     $(this).addClass("error");
     
     
     
     return false;
     
     
     } else {
     alert('7');
     $(this).parent().find(".form-error").hide();
     
     $(this).parent().find(".form-error1").hide();
     
     $(this).removeClass("error");
     
     //return true;
     
     
     
     }
     
     
     
     
     
     
     
     
     
     });  
     
     
     
     
     
     
     
     $(this).prev("input").each(function () {
     
     
     
     if ($(this).val() == "") {
     
     
     
     $(this).parent().find(".form-error").show();
     
     $(this).addClass("error");
     
     } else {
     
     $(this).parent().find(".form-error").hide();
     
     $(this).removeClass("error");
     
     }
     
     
     
     });
     
     
     
     
     
     
     
     $(this).prev("input[type='tel']").each(function () {
     
     var v=$(this).val();
     
     if ($(this).val() == "") {
     
     //    alert("yes");
     
     
     $(this).parent().find(".form-error").show();
     
     $(this).parent().find(".form-error1").hide();
     
     $(this).addClass("error");
     
     return false;
     
     
     } else if (!pattern.test($(this).val())) {
     
     //alert("yes");
     
     
     $(this).parent().find(".form-error").hide();
     
     $(this).parent().find(".form-error1").show();
     
     $(this).addClass("error");
     
     return false;
     
     
     
     } else {
     
     $(this).parent().find(".form-error").hide();
     
     $(this).parent().find(".form-error1").hide();
     
     $(this).removeClass("error");
     
     // alert("yes");
     
     return true;
     
     //alert(v);
     
     }
     
     
     
     });
     
     
     
     
     
     
     
     /*     $(this).prev("select").on('change', function () {
     
     
     
     
     
     
     
     if ($(this).find("option:selected").index() == "1") {
     
     $(this).parent().find(".form-error").show();
     
     $(this).addClass("error");
     
     }
     
     
     
     else {
     
     $(this).parent().find(".form-error").hide();
     
     $(this).removeClass("error");
     
     }
     
     
     
     }); */









    /*   $(this).prev("select").each(function () {
     
     
     
     
     
     
     
     if ($(this).find("option:selected").index() == "1") {
     
     $(this).parent().find(".form-error").show();
     
     $(this).addClass("error");
     
     }
     
     
     
     else {
     
     $(this).parent().find(".form-error").hide();
     
     $(this).removeClass("error");
     
     }
     
     
     
     }); 
     
     
     
     
     var pattern3 = /^[0-9]+$/;
     
     
     $(this).prev("input[name='e-sel']").each(function () {
     
     
     
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).addClass("error");
     } else if (!pattern3.test($(this).val())) {
     alert(pattern3.test($(this).val()));
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).addClass("error");
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).removeClass("error");
     
     }
     
     
     
     
     });
     
     $(this).prev("input[name='e-sel']").keyup(function () {
     
     if ($(this).val() == "") {
     $(this).parent().find(".form-error").show();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).addClass("error");
     } else if (!pattern3.test($(this).val())) {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").show();
     $(this).addClass("error");
     } else {
     $(this).parent().find(".form-error").hide();
     $(this).parent().find(".form-error1").hide();
     $(this).parent().find(".form-error2").hide();
     $(this).removeClass("error");
     }
     
     });
     
     
     
     
     //return true;
     
     
     
     
     
     });
     
     
     
     
     
     
     
     
     
     
     
     }); */








    $(".edit-icon").click(function () {



        $(this).parent().next().fadeIn(100);

        $(this).parent().hide();






    });







    $(".browse").on("change", function () {



        var bval = $(this).val();



        var clean = bval.split('\\').pop();





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

    $(".menu").click(function () {

        if ($(this).next().css("display") == "none") {

            $(this).next().slideDown();

        } else {

            $(this).next().slideUp();

        }

    });


    $('#edit-form').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10




          },
            age: {
                required: true,
                number: true



            },
            name: {
                lettersonly: true,
                maxclength: 50

          },
            select01: {
                required: true




            },
            password: {
                minplength: 6



            }
        }

    });

    var wi = $(window).width();


    if (wi <= 670) {

        $(".edit-name").each(function (i) {
            var len = $(this).text().length;

            //alert(len);

            if (len > 20)
            {
                $(this).text($(this).text().substr(0, 40) + '...');
            }
        });



        $(".book-details1 .trans-span71:nth-child(2) .book-para:first-child .order-text").each(function (i) {
            var len = $(this).text().length;

            //alert(len);

            if (len > 20)
            {
                $(this).text($(this).text().substr(0, 40) + '...');
            }
        });


    }


});
