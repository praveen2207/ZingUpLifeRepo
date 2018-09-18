<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>'/>
<?php $this->load->view('/includes/new_footer_ui'); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/survey_new/js/jquery.min.js" type="text/javascript"></script>
<script  src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/survey_new/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/survey_new/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/survey_new/js/jquery.knob.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/survey_new/js/snap.svg-min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/survey_new/js/html2canvas.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/survey_new/dist/js/classie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assessment/js/custom.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assessment/js/jquery.circleGraphic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assessment/js/loadingoverlay.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assessment/js/bootstrap-datepicker.js"></script>

    <script src="<?php echo base_url(); ?>assets/assessment/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>assets/assessment/js/bootstrap.min.js"></script>

<!--    calender date-->
<script src="<?php echo base_url(); ?>assets/assessment/js/wbn-datepicker.min.js"></script>
<!--    end calender date-->
<script>
  
    
    $(function () {
         $('#datepicker').datepicker({
             
             
         });
    	//if($('#user_id').val() == 0){
           //$( ".fieldset" ).html('');
           //$( ".question" ).html('');
           //$( ".savebtn" ).hide();
           //$( ".hexagon" ).hide();
           //$( ".progress-container" ).hide();
           //$( ".bg2" ).hide();
           //$(".register_div").show();
        //}

        var baseurl = $('.url').val();
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches
        var last_question_id;
	var skip_question = [];
	var prerequisite_data_js;
	var next_question_id;
	var current_question=1;    
        $(".next").click(function(){
	    var skip= true;
	    var prerequisite_question = false;
            var dat = $('#msform').serialize();
	    //CODE TO SKIP THE DEPENDENCY QUESTION: Starts
	    var str = $('#msform').serialize();
	    var selected_answer = [];
	     
	   str.split('&').forEach(function(x){
	       var arr = x.split('=');
		if (arr[0].length > 5 && arr[0].substr(0,6) == 'option'){
		    selected_answer.push(arr[1]);
		    last_question_id = arr[0].substr(6,2); //last option will correspond to the question number.so based on that we 
		                                           // find out what was the last question shown to user.
		    if(last_question_id.substr(1,1) == '%'){
			last_question_id = last_question_id.substr(0,1);
		    }
		}
	      }//end foreach
	    ); //end function
    
	     next_question_id = parseInt(last_question_id)+1;
	    str.split('&').forEach(function(y){	
               var arr1 = y.split('=');
		if (arr1[0] == 'question'+ next_question_id){
		    prerequisite_data_js = <?php echo json_encode($prerequisite_data); ?>;
		    
		    for (var i = 0; i < prerequisite_data_js.length; i++){
			if (!skip){
			    break; 
			}
			 var prerequisite_data_array = $.map(prerequisite_data_js[i], function(value, index) {
			  return [value];
			 });
			  if (arr1[1] == prerequisite_data_array[0]){   //this is a prerequisite question.
				prerequisite_question = true;
				selected_answer.forEach(function(answerid){
				if(prerequisite_data_array[1] == answerid){
				    skip = false;
				}
			  });// end foreachnselected_answer
			  }//end if
		      }//end for 
		}//end if
	     }//end outer foreach	
	    ); //end function
	 
	    //CODE TO SKIP THE DEPENDENCY QUESTION: Ends
	    if(animating) return false;
            animating = true;
            current_fs = $(this).parent();
	    next_fs = $(this).parent().next();
	   
	    if(prerequisite_question && skip){
		
		skip_question.push(next_question_id);
		next_fs = $(this).parent().next().next();
		current_question++;
	    }
		current_question++;
	    
	    //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            //show the next fieldset
            next_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
              step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                      'transform': 'scale('+scale+')',
                      'position': 'absolute',
                      'top' : '0px'
                    });
                    next_fs.css({'left': left, 'opacity': opacity});
              }, 
              duration: 800, 
              complete: function(){
                    current_fs.hide();
                    animating = false;
              }, 
              //this comes from the custom easing plugin
              easing: 'easeInOutBack'
            });
                var v = $(this).attr('va');
            	var tot_que = '<?php echo $toal_questions; ?>';
                var att_que = v;
                var single_question_per = 100/tot_que;
                        var move_percentage = Math.round(att_que * single_question_per);
                        $('.addradio').next().html(move_percentage+'%');
                        if(move_percentage<25){
                                $(".progress-bar").css('background-color', 'red');
                        }
                        else if(move_percentage>=25 && move_percentage<50){
                                $(".progress-bar").css('background-color', '#f27011');
                        }
                        else if(move_percentage>=50 && move_percentage<75){
                                $(".progress-bar").css('background-color', '#f2b01e');
                        }
                        else if(move_percentage>=75){
                                $(".progress-bar").css('background-color', 'green');
                        }
                        $(".progress-bar").width(move_percentage+'%');

            
            $('.eachc').html(v);
            var t = $('.em .totc').text();
            if($('#total_questions').val() == v){
                $('.test_completed_div').show();
            }
        });

        $(".previous").click(function(){
            var skip_previous=false;
            if($('.test_completed_div').css('display') == 'block'){
                $('.test_completed_div').hide();
                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();
                current_fs.show(); 
            }else{
                current_question--;
                if(animating) return false;
                animating = true;

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();
		    
		skip_question.forEach(function(z){
		    if(current_question==z){
			skip_previous=true;
		    }
		});
		
		if(skip_previous){
		   previous_fs = $(this).parent().prev().prev(); 
		   current_question--;
		}    
						
                //de-activate current step on progressbar
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show(); 
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                  step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale previous_fs from 80% to 100%
                        scale = 0.8 + (1 - now) * 0.2;
                        //2. take current_fs to the right(50%) - from 0%
                        left = ((1-now) * 50)+"%";
                        //3. increase opacity of previous_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({'left': left});
                        previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity,'position': '',});
                  }, 
                  duration: 100, 
                  complete: function(){
                        current_fs.hide();
                        animating = false;
                  }, 
                  //this comes from the custom easing plugin
                  easing: 'easeInOutBack'
                });
                var v = $(this).attr('va');
                var dv = parseInt(v) - 2;
                $('.eachc').html(dv);
                $('.previous').show();
            }
				
        });
			  
        $( ".fieldset" ).each(function( index ) {
            var this2 = $(this);
            var stat = this2.children('.controls').attr('reach');
            var slug = this2.children('.controls').attr('slug');
            var catype = this2.children('.controls').attr('catype');
            $(this).find('.controls input[type="radio"]').click(function(){
                if ($(this).is(':checked')){
                    if(stat == 'enable'){
                        var next_ques_id = this2.children('.controls').attr('id');
                        $('.'+slug).attr('id',next_ques_id);
                        $('.'+slug).show();
                        $('.previous').hide();
                        $('.nxt-btn').removeAttr('disabled');
                        $('.nxt-btn').attr('catype',catype);
                        $('.nxt-btn').attr('slug',slug);
                        $('.nxt-btn').attr('btid',next_ques_id);
                        $('.nxt-btn').click();
                        //$(this).parent().next().find('.action-button').hide();
                        var form = $('#msform').children().clone();
                        $(".form_input").append(form);
                     }else{
                        this2.children('.next').click();
                        $('.previous').show();
                    }
                }
            });
        });
        $(".submit").click(function(){
              return false;
        })
        $("#submit").on('click', function(){
            var base_url  = '<?php echo base_url();?>';
            var api_url = base_url+'api/assessment/question_response';
            $.LoadingOverlay("show", {
                image       : "",
                fontawesome : "fa fa-spinner fa-spin"
            });
            $.ajax({
                url: api_url, 
                type : "POST", 
                dataType : 'json',
                data : $("#msform").serialize(),
                success : function(result) {
                    if(result.status == true){
                        $.LoadingOverlay("hide");
                        if($('#user_id').val() == 0){
                            //$( ".fieldset" ).html('');
                            //$( ".question" ).html('');
                            //$( ".savebtn" ).hide();
                            //$( ".hexagon" ).hide();
                            //$( ".progress-container" ).hide();
                            $( ".bg2" ).hide('');
                            $(".register_div").show();
                        }else{
                            $.LoadingOverlay("hide");
                            var url = base_url +'assessment/report/'+ result.theme_id+'/' +result.level_id;
                            window.location = url;
                        }
                        
                    }
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            });
        });
        
        
			 
					  $('[data-toggle="tooltip"]').tooltip();
					  
					   /* jQueryKnob */

				  $(".knob").knob({
					/*change : function (value) {
					 //console.log("change : " + value);
					 },
					 release : function (value) {
					 console.log("release : " + value);
					 },
					 cancel : function () {
					 console.log("cancel : " + this.value);
					 },*/
					draw: function () {

					  // "tron" case
					  if (this.$.data('skin') == 'tron') {

						var a = this.angle(this.cv)  // Angle
							, sa = this.startAngle          // Previous start angle
							, sat = this.startAngle         // Start angle
							, ea                            // Previous end angle
							, eat = sat + a                 // End angle
							, r = true;

						this.g.lineWidth = this.lineWidth;

						this.o.cursor
						&& (sat = eat - 0.3)
						&& (eat = eat + 0.3);

						if (this.o.displayPrevious) {
						  ea = this.startAngle + this.angle(this.value);
						  this.o.cursor
						  && (sa = ea - 0.3)
						  && (ea = ea + 0.3);
						  this.g.beginPath();
						  this.g.strokeStyle = this.previousColor;
						  this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
						  this.g.stroke();
						}

						this.g.beginPath();
						this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
						this.g.stroke();

						this.g.lineWidth = 2;
						this.g.beginPath();
						this.g.strokeStyle = this.o.fgColor;
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
						this.g.stroke();

						return false;
					  }
					}
				  });
				  /* END JQUERY KNOB */

				  //INITIALIZE SPARKLINE CHARTS
				  $(".sparkline").each(function () {
					var $this = $(this);
					$this.sparkline('html', $this.data());
				  });

				  /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
				 // drawDocSparklines();
				 // drawMouseSpeedDemo();
				  
				  
				   function init() {
				  var speed = 330,
					easing = mina.backout;

				  [].slice.call ( document.querySelectorAll( '#grid > a' ) ).forEach( function( el ) {
					var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
					  pathConfig = {
						from : path.attr( 'd' ),
						to : el.getAttribute( 'data-path-hover' )
					  };

					el.addEventListener( 'mouseenter', function() {
					  path.animate( { 'path' : pathConfig.to }, speed, easing );
					} );

					el.addEventListener( 'mouseleave', function() {
					  path.animate( { 'path' : pathConfig.from }, speed, easing );
					} );
				  } );
				}

				init();

		
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
	$(function () {
		var path = window.location.pathname;
		
		if(path.indexOf("/healthprofile1") >=1)
			{
				$(".zingList ul li a").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#fff");
					});
					
					$(".zingList ul li a.zing-btn").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#009746");
					});
				var element = $("#html-content-holder"); // global variable
					var getCanvas; // global variable
					 
						$("#btn-Preview-Image").on('click', function () {
							 html2canvas(element, {
							 onrendered: function (canvas) {
									$("#previewImage").append(canvas);
									getCanvas = canvas;
								 }
							 });
							 
						});
			}
		
			if(path.indexOf("/healthprofile2") >=1 || path.indexOf("/prev_healthprofile2") >=1)
			{
				$(".zingList ul li a").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#fff");
					});
					
					$(".zingList ul li a.zing-btn").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#009746");
					});
				var element = $("#html-content-holder"); // global variable
					var getCanvas; // global variable
					 
						$("#btn-Preview-Image").on('click', function () {
							 html2canvas(element, {
							 onrendered: function (canvas) {
									$("#previewImage").append(canvas);
									getCanvas = canvas;
								 }
							 });
							 
						});
			}
				
				if(path.indexOf("/healthprofile3") >=1 || path.indexOf("/prev_healthprofile3") >=1)
				{
					$(".zingList ul li a").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#fff");
					});
					
					$(".zingList ul li a.zing-btn").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#009746");
					});
					
						var element = $("#html-content-holder"); // global variable
						var getCanvas; // global variable
						 
							$("#btn-Preview-Image").on('click', function () {
								 html2canvas(element, {
								 onrendered: function (canvas) {
										$("#previewImage").append(canvas);
										getCanvas = canvas;
									 }
								 });
								 
							});
				}
				
				if(path.indexOf("/healthprofile4") >=1)
				{
					$(".zingList ul li a").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#fff");
					});
					
					$(".zingList ul li a.zing-btn").mouseenter(function() {
						$(this).css("border-top", "3px solid #009746").css("background", "#fff");
					}).mouseleave(function() {
						 $(this).css("border-top", "3px solid #fff").css("background", "#009746");
					});
					var element = $("#html-content-holder"); // global variable
					var getCanvas; // global variable
					 
						$("#btn-Preview-Image").on('click', function () {
							 html2canvas(element, {
							 onrendered: function (canvas) {
									$("#previewImage").append(canvas);
									getCanvas = canvas;
								 }
							 });
							 
							 $('.healthimage4').hide();
							 
						});
				}
						
				
	
				var baseurl = $('.url').val();
				document.onload = $("#btn-Preview-Image").click();
				$('.healthprofile2').click(function(){
					$('.loading').show();
					var url = baseurl + 'survey/healthprofile3';
					var dataURL = getCanvas.toDataURL("image/png");
					$(this).hide();
					$.ajax({
					  type: "POST",
					  url: baseurl + 'survey/save_healthprofile2image',
					  data: { 
						 imgBase64: dataURL 
					  },
					  dataType: "json",
					  success: function (data) {
						  if(data)
							{
								window.location = url;
							}
					  }
					});
				});
				

				$('.healthprofile1').click(function(){
					$('.loading').show();
					var url = baseurl + 'survey/healthprofile2';
					var dataURL = getCanvas.toDataURL("image/png");
					$(this).hide();
					$.ajax({
					  type: "POST",
					  url: baseurl + 'survey/save_healthprofile1image',
					  data: { 
						 imgBase64: dataURL 
					  },
					  dataType: "json",
					  success: function (data) {
						  if(data)
							{
								window.location = url;
							}
					  }
					});
				});
				
				$('.healthprofile3').click(function(){
					$('.loading').show();
					var url = baseurl + 'survey/healthprofile4';
					var dataURL = getCanvas.toDataURL("image/png");
					$(this).hide();
					$.ajax({
					  type: "POST",
					  url: baseurl + 'survey/save_healthprofile3image',
					  data: { 
						 imgBase64: dataURL 
					  },
					  dataType: "json",
					  success: function (data) {
						  if(data)
							{
								window.location = url;
							}
					  }
					});
				});
				
				$('.clickreport').click(function(){
					var id = $(this).attr('id');
					var thiss = $(this);
					$(this).children('.text').text('Downloading...');
					var url = baseurl + 'survey/report/'+id;
					var dataURL = getCanvas.toDataURL("image/png");
					$.ajax({
					  type: "POST",
					  url: baseurl + 'survey/save_healthprofile4image',
					  data: { 
						 imgBase64: dataURL 
					  },
					  dataType: "json",
					  success: function (data) {
						  if(data)
							{
								thiss.children('.text').text('Download as PDF');
								window.location = url;
							}
					  }
					});
				});
				
				document.onload = setTimeout(function () { $('.clickreport').show(); }, 10000);
				
				/*setTimeout(function(){
					alert();
					
					$('.healthprofile2').click();
					$('.healthprofile3').click();
					$('.clickreport').click();
				}, 10000);*/
			});
	</script>
	
	 <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1')
            , menuRight = document.getElementById('cbp-spmenu-s2')
            , menuTop = document.getElementById('cbp-spmenu-s3')
            , menuBottom = document.getElementById('cbp-spmenu-s4')
            , showLeft = document.getElementById('showLeft')
            , showRight = document.getElementById('showRight')
            , showTop = document.getElementById('showTop')
            , showBottom = document.getElementById('showBottom')
            , showLeftPush = document.getElementById('showLeftPush')
            , showRightPush = document.getElementById('showRightPush')
            , body = document.body;
        showRight.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(menuRight, 'cbp-spmenu-open');
            disableOther('showRight');
        };

        function disableOther(button) {
            if (button !== 'showRight') {
                classie.toggle(showRight, 'disabled');
            }
            
        }
        
        function register_user(){
            
            var vali = $('.validation').valid();
		if(vali){
		var base_url = '<?php echo base_url();?>';
		$.LoadingOverlay("show", {
		image       : "",
		fontawesome : "fa fa-spinner fa-spin"
	            });
	            $.ajax({
	            	type: "POST",
	                url: base_url + 'users/asm_registration',
	                data : $("#register_form").serialize(),
	                dataType: "json",
	                success: function (data) {
	                	
	                    if(data){
	                    	
	                    	if(data.error_type == 'failed'){
	                    		$.LoadingOverlay("hide");
		                    	$('.user_error').show();
					$('#user_login').show();
	                        }else{
	                        	$('.user_error').hide();
		                    }
	                    	if(data.access_error == 'yes'){
	                    		$.LoadingOverlay("hide");
		                    	$('.access_error_message').show();;
	                        }else{
	                        	$('.access_error_message').hide();
		                    }
	                    	if(data.error_type == 'success'){
	                    		$.LoadingOverlay("hide");
		                    	window.location=base_url +'assessment/report/'+data.theme_id+'/'+data.test_id;
	                    	}
	                    }
	                },
	            	error: function (data) {
	                	$.LoadingOverlay("hide");
	               	},
	            });
        	}
        }
    </script>
    <script>
    
    $('#height').keydown(function(e){
        if(e.which == 69){
            e.preventDefault();
        	return false;
        }else{
        	return true;
        	
        }
	});


    $('#weight').keydown(function(e){
        if(e.which == 69){
            e.preventDefault();
        	return false;
        }else{
        	return true;
        	
        }
	});


	function basic_user_detail(){
	
		var vali = $('.validation').valid();
		if(vali){
			var base_url = '<?php echo base_url();?>';
			$.LoadingOverlay("show", {
            	image       : "",
                fontawesome : "fa fa-spinner fa-spin"
            });
            $.ajax({
            	type: "POST",
                url: base_url + 'users/basic_user_detail',
                data : $(".validation").serialize(),
                dataType: "json",
                success: function (data) {
                	if(data){
                		$(".org_access_code_error").hide();
                    	var url = base_url+'assessment/index';
                        window.location = url;
                    }else{
						$(".org_access_code_error").show();
						$.LoadingOverlay("hide");
                        }
                    
                },
            	error: function (data) {
                	$.LoadingOverlay("hide");
               	},
            });
    	}else{
        $('label[for="year"]').css('visibility','hidden');
	    $('label[for="month_lable"]').css('visibility','hidden');
	    $('label[for="year"]').hide();
	    $('label[for="month_lable"]').hide();
	    
    	}
    }

	
	$('#user_phone_number').focusout(function(){
		
		var base_url = '<?php echo base_url();?>';
		var mobile_no=$(this).val();
		if(mobile_no.length=='10'){
			$.ajax({
	        	type: "POST",
	            url: base_url + 'users/set_access_code',
	            data : {mobile_no:mobile_no},
	            dataType: "json",
	            success: function (data) {
	            	if(data){
		            	$('.access_code_message').show();
	            		$("#resend").show();
	            	}
	            },
	        	error: function (data) {
	            	$.LoadingOverlay("hide");
	           	},
	        });
		}
		
	});


	$('#username').keydown(function(){
		$('.user_error').hide();
	});

	$('#accesscode').keydown(function(){
		$('.access_error_message').hide();
	});


	function bio_asses_theme(){
	    var theme_id=$('#bio_theme_id').val();
	    var test_id=$('#bio_level_id').val();
	    	
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }
		    }
		});
	}
	
	function diet_asses_theme(){
	    var theme_id=$('#diet_theme_id').val();
	    var test_id=$('#diet_level_id').val();
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/diet_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function wns_asses_theme(){
		<?php if($this->input->cookie("org_assessment")){?>
		var theme_id = $('#org_wns_theme_id').val();
	    var test_id = $('#org_wns_level_id').val();
		<?php }else{ ?>
		var theme_id = $("#wsn_theme_id").val();//Mani
		var test_id = $("#wsn_level_id").val();//Mani

		//var theme_id = $("#wns_theme_id").val();
	    //var test_id = $("#wns_test_id").val();
	    <?php } ?>
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/wholesomeness_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function strength_asses_theme(){
		<?php if($this->input->cookie("org_assessment")){?>
		 	var theme_id = $('#org_sat_theme_id').val();
		    var test_id = $('#org_sat_level_id').val();
		<?php }else{ ?>
		 	var theme_id = $('#sat_theme_id').val();
			var test_id = $('#sat_level_id').val();
		<?php } ?>
	   	$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/strength_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function thought_asses_theme(){
	    var theme_id = $('#tat_theme_id').val();
	    var test_id = $('#tat_level_id').val();
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/thought_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function relationship_asses_theme(){

		<?php if($this->input->cookie("org_assessment")){?>
    		var theme_id = $('#org_rat_theme_id').val();
    	    var test_id = $('#org_rat_level_id').val();
    	<?php }else{ ?>
        	var theme_id = $('#rat_theme_id').val();
            var test_id = $('#rat_level_id').val();
    	<?php } ?>
    		
	    
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/relationship_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function zest_asses_theme(){
	    var theme_id = $('#zat_theme_id').val();
	    var test_id = $('#zat_level_id').val();
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/zest_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
    
	$(".check_none_of_above").click(function(){
	    if ($(this).is(':checked')) {
		
		var question_no = $(this).attr('question');
		var no_option = $('[question2="'+question_no+'"]').val();
		var position = $(this).attr('option');
		var current_option = $('.option_lable'+position).html();
		var option = $('[name="option'+question_no+'[]"]').attr('option');
		var match=false;
		    if(current_option == 'None of these' || current_option == 'None of the above' || current_option == 'None of these are taken regularly' || current_option == 'I do not do anything' || current_option == 'I do not have a family history of any condition'){
			match=true;
		    }
		    
		    if(match){
		    $('[name="option'+question_no+'[]"]').prop('checked', false);
		    $(this).prop('checked', true);
		    }else{
			var length = parseInt(option)+parseInt(no_option);
			for(var i=option;i<length;i++){
			   if(($('.option_lable'+i).html()=='None of the above') || ($('.option_lable'+i).html()=='None of these') || ($('.option_lable'+i).html()=='None of these are taken regularly') || ($('.option_lable'+i).html()=='I do not do anything') || ($('.option_lable'+i).html()=='I do not have a family history of any condition')){
			       $("[option='"+i+"']").prop('checked', false);
			   }
			}
		    }
		
	    }
	});
	
	
    </script>
    <script>
        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        });
        $(document).ready(function(){
    
          $(".hide3").hide();
          $("#click1").click(function(){
	      //alert('testing');
            $(".show2").hide();
            $(".show1").show(); 
            $(".h-btn").css({backgroundColor: "#3fab3c"});
            $(".h-btn").css({color: "#fff"}); 
            $(".h2-btn").css({backgroundColor: "#ebebeb"});
            $(".h2-btn").css({color: "#000"});  
             
          });
          $("#click2").click(function(){
	      //alert('testing');
            $(".show2").show();
            $(".show1").hide();
            $(".h-btn").css({backgroundColor: "#ebebeb"});
            $(".h-btn").css({color: "#000"}); 
            $(".h2-btn").css({backgroundColor: "#f7bb3a"});
            $(".h2-btn").css({color: "#fff"});  
          });
         });
    </script>
    <script type="text/javascript">
    $('.wbn-datepicker').datepicker();
    $('.year').click(function() {
		$('label[for="year"]').hide();
	});

    $('#resend').click(function(){
    		
    		var base_url = '<?php echo base_url();?>';
    		var mobile_no = $('#user_phone_number').val();
    		if(mobile_no.length=='10'){
    			$.ajax({
    	        	type: "POST",
    	            url: base_url + 'users/set_access_code',
    	            data : {mobile_no:mobile_no},
    	            dataType: "json",
    	            success: function (data) {
    	            	if(data){
    	            		$('.access_code_message').show();
    		            }
    	            },
    	        	error: function (data) {
    	            	$.LoadingOverlay("hide");
    	           	},
    	        });
    		}
    		
    	});
	</script>
</body>

</html>
