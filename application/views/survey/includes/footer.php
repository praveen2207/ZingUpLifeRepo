<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>'/>
<?php $this->load->view('/includes/footer_ui'); ?>

	 
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>assets/survey_new/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/survey_new/js/jquery.easing.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/survey_new/js/bootstrap.min.js"></script>
	 <script src="<?php echo base_url();?>assets/survey_new/js/jquery.knob.js"></script>
	 <script src="<?php echo base_url();?>assets/survey_new/js/snap.svg-min.js"></script>
	 <script src="<?php echo base_url();?>assets/survey_new/js/html2canvas.js"></script>
      <script>
	    $(function () {
			
			
				
				//document.onload =   $("#btn-Convert-Html2Image").click(); 
				
	
			//jQuery time
			  var current_fs, next_fs, previous_fs; //fieldsets
			  var left, opacity, scale; //fieldset properties which we will animate
			  var animating; //flag to prevent quick multi-click glitches

			  $(".next").click(function(){
				  
				  var id = $(this).prev().attr('id');
				
				
					var dat = $('#msform').serialize();
					var slug = $(this).attr('slug');
					var id = $(this).attr('btid');
					$.ajax({ 
						type : "POST",
						url: baseurl + 'survey/next_survey_info_submit',
						dataType: "json",
						data: dat,
						success: function (data) {
							if(data)
							{
								
								//$('.'+slug).attr('id',id)
								//$('.'+slug).show();
								
								
							}
						}
					});
				 
				if(animating) return false;
				animating = true;
				
				current_fs = $(this).parent();
				next_fs = $(this).parent().next();
				
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
				  $('.eachc').html(v);
				  var t = $('.em .totc').text();
				  var stat = $(this).attr('reach');
				  var per = parseInt(v)/parseInt(t) * 100;

				/*if(parseInt(per) == 30)
					{
						$('.addradio').attr('id','twentyfive');
						$('.addradio').next().html('25%');
					}
					else if(parseInt(per) == 50)
					{
						$('.addradio').attr('id','fifty');
						$('.addradio').next().html('50%');
					}
					else if(parseInt(per) == 70)
					{
						$('.addradio').attr('id','seventyfive');
						$('.addradio').next().html('75%');
					}
					else if(parseInt(per) == 100)
					{
						$('.addradio').attr('id','onehundred');
						$('.addradio').next().html('100%');
					}
					*/
			  });

			  $(".previous").click(function(){
				  if($('.surveyint').css('display') == 'block')
				  {
					$('.surveyint').hide();
					current_fs = $(this).parent();
						previous_fs = $(this).parent().prev();
						current_fs.show(); 
						
				  }
				  else{
					  
						  
						if(animating) return false;
						animating = true;
						
						current_fs = $(this).parent();
						previous_fs = $(this).parent().prev();
						
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
						  duration: 800, 
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
					if ($(this).is(':checked'))
					{
					   
					   if(stat == 'enable')
					   {
						   if(catype == 'Environmental')
						{
							$('.addradio').attr('id','onehundred');
							$('.addradio').next().html('100%');
						}
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
					   }
					   else{
						   this2.children('.next').click();
						   $('.previous').show();
					   }
					}
				  });
			  });

			  $(".submit").click(function(){
				return false;
			  })
			 
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/survey_new/js/custom.js"></script>
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
				
				document.onload = setTimeout(function () { $('.clickreport').show(); }, 6000);
				
				/*setTimeout(function(){
					alert();
					
					$('.healthprofile2').click();
					$('.healthprofile3').click();
					$('.clickreport').click();
				}, 10000);*/
			});
	</script>
	
</body>

</html>