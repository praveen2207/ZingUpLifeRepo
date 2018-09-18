var abc = 0; //Declaring and defining global increement variable
var base_url = "http://design1.nuvodev.com/client/zinguplife/";
$(document).ready(function() {
    $('#formdiv').hide();
    $('#formdiv').css('display','none');
	
	var c,a;
 var addcount,count1;
 

 
//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
var count = $('[name=count]').val();

         var old_count =count;

         var addcount = old_count;
		 
		// alert(count);
		 
		
		 
    $('#add_more').click(function() {

        
       //alert(addcount);

         if(addcount >= 5){
             //alert('if');
              $('[name=count]').val(old_count);
        $('#add_more').hide();
                

    }
    else{
       //  alert('else');
	   
	   
 
	   
         addcount++;
		$(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),
        $("<br/><br/>")

		
		
                ));
     

    }
	
	c = addcount;
	
	
    });



//following function will executes on change event of file input to select different file

    $('body').on('change', '#file', function() {
        var count = $('[name=count]').val();
         count++;
        if(count >= 6)
          {
              $('#add_more').hide();
             //$('#formdiv').hide();
              $('[name=count]').val(count);
              if (this.files && this.files[0]) {
            abc += 1; //increementing global variable by 1
               $.each(this.files, function (key, value) {
                $("#wall_post_images").css({"color": "transparent"});

              $('#file_names').append('<li class=abcd'+abc+'>'+value.name+'</li>');


            });

            var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");

            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);

            $(this).hide();
                         addcount = c;

            $("#abcd" + abc).append($("<img/>", {id: 'img', src: base_url+'assets/images/x.png', alt: 'delete'}).click(function() {

                $(this).parent().parent().remove();
               addcount--;


                var count =  $('[name=count]').val();

              var valuecount =count-1;
                $('input[name=count]').val(valuecount) ;

             if(valuecount < 6)
             {
                  $('#add_more').show();
             }
             var v = $(this).parent().attr("id");
			 
			 //alert(v);

                $("#file_names li."+v).remove();

            // alert(addcount);





            }));



        }
          }
          else{

         $('[name=count]').val(count);
        if (this.files && this.files[0]) {
            abc += 1; //increementing global variable by 1
               $.each(this.files, function (key, value) {
                $("#wall_post_images").css({"color": "transparent"});

              $('#file_names').append('<li class=abcd'+abc+'>'+value.name+'</li>');


            });

            var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");

            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);

            $(this).hide();
                         addcount =c;
            $("#abcd" + abc).append($("<img/>", {id: 'img', src: base_url+'assets/images/x.png', alt: 'delete'}).click(function() {


                $(this).parent().parent().remove();

                addcount--;





               var count =  $('[name=count]').val();

              var valuecount =count-1;
                $('input[name=count]').val(valuecount) ;

             if(valuecount < 6)
             {
                  $('#add_more').show();
             }

                var v = $(this).parent().attr("id");
				
				

                $("#file_names li."+v).remove();
				
				// alert(addcount);


            }));




        }

            }
    });
	
	


        $('body').on('click', '.img_del', function () {
        var name = $(this).prev().attr('class');
        var business_id = $('[name=id]').val();
		
		
        //  alert(name);  alert(business_id);
        $(this).prev().hide();
        $(this).hide();
        if (confirm("Are you sure you want to delete this Image?") === true)
        {

            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/delete_business_gallery_image',
                data: {name: name, business_id: business_id},
                dataType: "json",
                success: function (data) {
                    // console.log(data);

                    var count = $('[name=count]').val();
                    var valuecount = count - 1;
                    $('input[name=count]').val(valuecount);
                      //alert(valuecount);
                    if (valuecount < 6)
                    {
                        $('#add_more').show();
						addcount = addcount -1;
												//alert(addcount);
                    }
else{
                                                //alert(valuecount);
                                       //addcount = a - valuecount;

}									   
												
                }
            });

                


        } else
        {
            $(this).prev().show();
            $(this).show();
        }





    }); 

//To preview image
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    }
    ;

//    $('#upload').click(function(e) {
//        var name = $(":file").val();
//        if (!name)
//        {
//            alert("First Image Must Be Selected");
//            e.preventDefault();
//        }
//    });
    $('#wall_post_images').click(function() {
        var count =  $('[name=count]').val();
        if(count < 6){
        $('#formdiv').css('display', 'block');
        return false;
    }
    else
    {
        return false;
    }
    });
    $('#close_button').click(function() {
        $('#formdiv').css('display', 'none');
        return false;
    });
    $('#upload').click(function(e) {
        e.preventDefault();
        $('#formdiv').css('display', 'none');
    });

	

});