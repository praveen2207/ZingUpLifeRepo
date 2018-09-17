<footer class="admin-footer">
      <p class="footer-para footer-admin-para">Copyright &copy; 2015 ZULPHS INFOTECH PVT. LTD. All rights reserved.</p>
</footer>
</div> 

<!-- /container -->


<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/admin/js/jquery.validate.js'></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/admin_custom.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.plugin.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.datepick.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.js"></script>

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
                 clone.find('.error_start_less_end').hide();
               clone.find('.error_start_time').hide();
               clone.find('.error_end_time').hide();
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

                var clone = $(".add-time-block1:first").clone();
                clone.find('.slot_start_time1').attr('value', '');
                clone.find('.slot_end_time1').attr('value', '');
                 clone.find('.error_start_less_end1').hide();
                clone.find('.error_start_time1').hide();
               clone.find('.error_end_time1').hide();
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

    $('#slots-date-picker1').datepick({
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        altField: '#slots-date-picker1',
        altFormat: 'yyyy-mm-dd',
        onSelect: showDate3
    });

    function showDate3(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#slots-date-picker1').val(current_date);

      
    }

    $('#slots-date-picker2').datepick({
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        altField: '#slots-date-picker2',
        altFormat: 'yyyy-mm-dd',
        onSelect: showDate4
    });

    function showDate4(date) {
        var d = new Date(date);
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $('#slots-date-picker2').val(current_date);
    }



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


<script>
    $(document).ready(function () {
        $("#add-block2").click(function () {

            var clone = $(".add-time-block2:first").clone();
            clone.find('.new_ctr').css('margin-top', '2%');
            clone.find('.name_ctr').attr('value', '');
            clone.find('.error_service_name').hide();
            clone.find('.error_pacakge_name').hide();
            clone.find('.error_duration_hrs').hide();
            clone.find('.error_duration_mins').hide();
            $("#start-date-end-dates").append(clone);
            return false;
        });
    });
</script>

<script type="text/javascript" >

$(document).ready(function(){

    $('body').on('change', '#start-time', function () {
 	var start_time = $(this).val();
 	
    //end time
    var end_time = $(this).parent().parent().parent().next().find("#end-time").val();
    //by this you can see time stamp value in console via firebug
    console.log("Time1: " + start_time + " Time2: " + end_time);
    if(end_time !=''){
    if (start_time > end_time) {
        alert('The start time can not be greater then the end time');
        return false;
    }
    }
    });
    
    
    $('body').on('change', '#end-time', function () {
 	var start_time = $(this).parent().parent().parent().prev().find("#start-time").val();
 	
    //end time
    var end_time = $(this).val();
    //by this you can see time stamp value in console via firebug
    console.log("Time1: " + start_time + " Time2: " + end_time);
    if(start_time !=''){
    if (end_time < start_time) {

        alert('The end time can not be less then the start time');
        return false;
    }
    }
    });
 
    
    
    $('body').on('change', '#start-time1', function () {
 	var start_time = $(this).val();
 	
    //end time
    var end_time = $(this).parent().parent().parent().next().find("#end-time1").val();
    //by this you can see time stamp value in console via firebug
    console.log("Time1: " + start_time + " Time2: " + end_time);
    if(end_time !=''){
    if (start_time > end_time) {
        alert('The start time can not be greater then the end time');
        return false;
    }
    }
    });
    
    
    $('body').on('change', '#end-time1', function () {
 	var start_time = $(this).parent().parent().parent().prev().find("#start-time1").val();
 	
    //end time
    var end_time = $(this).val();
    //by this you can see time stamp value in console via firebug
    console.log("Time1: " + start_time + " Time2: " + end_time);
    if(start_time !=''){
    if (end_time < start_time) {

        alert('The end time can not be less then the start time');
        return false;
    }
    }
    });
    
  
    
});
</script>
<script type="text/javascript" >
$(document).ready(function(){
$("#admin_vendor_service_slots").on("submit", function(e){
	 var start_ids = [];
	 var end_ids = [];
	 var sel1 = $("#slot_days").val();
	  var sel2 = $("#slot_weekends").val();
	 if (sel1 == null && sel1 == null) {
	 	e.preventDefault();
          alert("Please select business hours day");
	 	return false;
	 	}else{
 	$(".add-time-block").each(function (index) { 
     var start_time = $(this).find('#start-time').val();
     var end_time = $(this).find('#end-time').val();
   if(sel1 != null){
    if(start_time == '' && end_time == ''){
     	e.preventDefault();
     	$(this).find('.error_start_time').show();
        $(this).find('.error_end_time').show();
     	}
     	else if(start_time == '' && end_time != ''){
     	e.preventDefault();
     	$(this).find('.error_start_time').show();
       $(this).find('.error_end_time').hide();
     	}
       else if(start_time != '' && end_time == ''){
     	e.preventDefault();
     	$(this).find('.error_start_time').hide();
       $(this).find('.error_end_time').show();
     	}
     	else{
     		$(this).find('.error_start_time').hide();
     		$(this).find('.error_end_time').hide();
     		}
}
     if(start_time != '' && end_time!='')
     {
     	if(start_time > end_time){
     		start_ids.push(index);
    
     		}
     		else 
     	{
     		end_ids.push(index);
     		}
     		}
     		});
     		$.each(start_ids, function (index1, value) {
         $(".add-time-block").each(function (index) {
         	
             if(index == value)
             {
             	$(this).find('.error_start_less_end').show();
             	e.preventDefault();
             	} 
             	
             		  
          });
     		});
     		
     		
      $.each(end_ids, function (index2, value) {
         $(".add-time-block").each(function (index) {  
             if(index == value)
             {
             	$(this).find('.error_start_less_end').hide();
 
             	}
             	   
             	    
          });
     		});     		
     		
     var start_ids1 = [];
	 var end_ids1 = [];		
     $(".add-time-block1").each(function (index) { 
     var start_time = $(this).find('#start-time1').val();
     var end_time = $(this).find('#end-time1').val();
if(sel2 != null){
if(start_time == '' && end_time == ''){
     	e.preventDefault();
     	$(this).find('.error_start_time1').show();
        $(this).find('.error_end_time1').show();
     	}
     	else if(start_time == '' && end_time != ''){
     	e.preventDefault();
        $(this).find('.error_start_time1').show();
     	$(this).find('.error_end_time1').hide();
     	}
        else if(start_time != '' && end_time == ''){
     	e.preventDefault();
        $(this).find('.error_start_time1').hide();
     	$(this).find('.error_end_time1').show();
     	}
     	else{
     		$(this).find('.error_start_time1').hide();
     		$(this).find('.error_end_time1').hide();
     		}
}
     if(start_time != '' && end_time!='')
     {
     	if(start_time > end_time){
     		start_ids1.push(index);
    
     		}
     		else
     	{
     		end_ids1.push(index);
     		}
     		}
     		});	
     $.each(start_ids1, function (index1, value) {
         $(".add-time-block1").each(function (index) {
         	
             if(index == value)
             {
             	$(this).find('.error_start_less_end1').show();
             	e.preventDefault();
             	}     
          });
     		});
     		
     		
      $.each(end_ids1, function (index2, value) {
         $(".add-time-block1").each(function (index) {  
             if(index == value)
             {
             	$(this).find('.error_start_less_end1').hide();
             	}   
             	    
          });
     		}); 		
     		return true;
     	}
    	
     	
     		
     		
     	});
     	
     

 $("#cs_vendor_add_one_day_pack").on("submit", function(e){
	
 	$(".add-time-block2").each(function () { 
    var service_name = $(".service_id").val();
     var package_name = $(this).find('.name_ctr').val();
     var duration_hour = $(this).find('.duration_hour').val();
     var duration_minutes = $(this).find('.duration_minutes').val(); 
     
 if(service_name =='')
     {
     	
     $('.error_service_name').show();
     e.preventDefault();
     }    

     if(package_name =='')
     {
     	
     $(this).find('.error_pacakge_name').show();
     e.preventDefault();
     }

if(duration_hour =='')
     {
     	
     $(this).find('.error_duration_hrs').show();
     e.preventDefault();
     }

if(duration_minutes =='')
     {
     	
     $(this).find('.error_duration_mins').show();
     e.preventDefault();
     }
 });
return true;
   });  
   




$("#admin_vendor_one_time_slots").on("submit", function(e){
	 var start_ids = [];
	 var end_ids = [];
 	$(".add-time-block").each(function (index) { 
     var start_time = $(this).find('#start-time').val();
     var end_time = $(this).find('#end-time').val();
    
     if(start_time != '' && end_time!='')
     {
     	if(start_time > end_time){
     		start_ids.push(index);
    
     		}
     		else 
     	{
     		end_ids.push(index);
     		}
     		}
     		});
     		$.each(start_ids, function (index1, value) {
         $(".add-time-block").each(function (index) {
         	
             if(index == value)
             {
             	$(this).find('.error_start_less_end').show();
             	e.preventDefault();
             	} 
             	
             		  
          });
     		});
     		
     		
      $.each(end_ids, function (index2, value) {
         $(".add-time-block").each(function (index) {  
             if(index == value)
             {
             	$(this).find('.error_start_less_end').hide();
 
             	}
             	   
             	    
          });
     		});     		
     		
     		return true;
     	});
        
        
        
      $("#cs_vendor_add_service_gallery").on("submit", function(e){
	
 	$(".add-service-gallery-block").each(function () { 
    var file = $(this).find(".file").val();
     var caption = $(this).find('.caption').val();
     
 if(file =='')
     {
     	
     $(this).find('.error_fle_name').show();
     e.preventDefault();
     }    

     if(caption =='')
     {
     	
     $(this).find('.error_caption_name').show();
     e.preventDefault();
     }

return true;
   });  
   
   
        
    }); 
    
    
    
     $("#cs_vendor_add_gallery").on("submit", function(e){
	
 	$(".add-gallery-block").each(function () { 
    var file = $(this).find(".file").val();
     
 if(file =='')
     {
     	
     $(this).find('.error_fle_name').show();
     e.preventDefault();
     }    


return true;
   });  
   
   
        
    }); 
});   
</script>


<script>
    $(document).ready(function () {
    	var count = $(".count").val();
        $("#add-block3").click(function () {
        	   
        	   if(count < 5){
            var clone = $(".add-gallery-block:first").clone();
            clone.find('.file').attr('value', '');
            clone.find('.error_fle_name').hide();
            $("#add-gallery-block-clone").append(clone);
            count++;
            }
            return false;
        });
    });
</script>

<script>
    $(document).ready(function () {
    	var count = $(".count").val();
        $("#add-block4").click(function () {
        	   
        	   if(count < 5){
            var clone = $(".add-service-gallery-block:first").clone();
            clone.find('.file').attr('value', '');
            clone.find('.error_fle_name').hide();
            clone.find('.error_caption_name').hide();
            $("#add-service-gallery-block-clone").append(clone);
            count++;
            }
            return false;
        });
    });
</script>


<script type="text/javascript" >
$(document).ready(function(){
$("#admin_vendor_service_slot_edit_form").on("submit", function(e){
	
     var date = $('.slots_date').val();
     var slots_time = $('.slots_time').val(); 
     var start_time = $('.slot_start_time').val();
     var end_time = $('.slot_end_time').val();
if(start_time != '' && end_time == ''){
e.preventDefault();
$('.error_start_time').hide();
$('.error_end_time').show();
}
if(start_time == '' && end_time != ''){
e.preventDefault();
$('.error_start_time').show();
$('.error_end_time').hide();
}
     if(start_time != '' && end_time!='')
     {
$('.error_start_time').hide();
$('.error_end_time').hide();
       if(date == null){
         $('.error_slot_date').show();
         e.preventDefault();
        }
        else{

$('.error_slot_date').hide();
       }

if(slots_time == ''){
         $('.admin_error_slot_timings').show();
         e.preventDefault();
        }
        else{

$('.admin_error_slot_timings').hide();
       }
     	if(start_time > end_time){
     		
    $('.error_start_less_end').show();
    e.preventDefault();
     		}
     		else 
     	{
     		$('.error_start_less_end').hide();
     		}
     		}
     		
     		return true;
     		});
});
</script>


<script type="text/javascript" >
$(document).ready(function(){
$("#admin_one_time_slot_edit_form").on("submit", function(e){
	
     var date = $('.one_slot_date').val(); 
     var start_time = $('.slot_start_time').val();
     var end_time = $('.slot_end_time').val();
 if(date == ''){
         $('.error_slot_date').show();
         e.preventDefault();
        }
        else{

$('.error_slot_date').hide();
if(start_time == '' &&  end_time == ''){
e.preventDefault();
$('.error_one_time_start_time').show();
$('.error_one_time_end_time').show();
}
if(start_time == '' &&  end_time != '')
{
e.preventDefault();
$('.error_one_time_start_time').show();
$('.error_one_time_end_time').hide();
}
if(start_time != '' &&  end_time == ''){
e.preventDefault();
$('.error_one_time_start_time').hide();
$('.error_one_time_end_time').show();
}
       }
     if(start_time != '' && end_time!='')
     {
      $('.error_one_time_start_time').hide();
$('.error_one_time_end_time').hide();
     	if(start_time > end_time){
     		
    $('.error_start_less_end').show();

    e.preventDefault();
     		}
     		else 
     	{
     		$('.error_start_less_end').hide();
     		}
     		}
     		
     		return true;
     		});
});
</script>



<script type="text/javascript" >
$(document).ready(function(){
$("#admin_business_info_form").on("submit", function(e){
var checkedNum = $('input[name="business_type[]"]:checked').length;
if (!checkedNum) {
   $('#admin_business_info_type').show();
   e.preventDefault();
}
else{
$('#admin_business_info_type').hide();
}
});
});
</script>


<script type="text/javascript" >
$(document).ready(function(){
$("#cs_business_info_form").on("submit", function(e){
var checkedNum = $('input[name="business_type[]"]:checked').length;
if (!checkedNum) {
   $('#cs_business_info_type').show();
   e.preventDefault();
}
else{
$('#cs_business_info_type').hide();
}
});
});
</script>
</body>

</html>
