<style>
.centered{
	text-align: center;
	margin-left:340px;
	margin-top:100px;
	margin-bottom:20px;
}
</style>
<section class="assesment  hidden-sm hidden-xs" style="margin:0 auto; background: url(<?php echo $web_banner;?>) no-repeat center center; background-size: cover;">
    <h5 class="text-center" style='padding-top: 75px;color: #3fab3a;font-size: 28px;font-weight: bold; text-transform: uppercase;'><?php echo $theme_name;?>  <!--<p><button id="quick_demo">Loading...</button></p>--></h5>
</section>

<section class="assesment hidden-md hidden-lg" style="margin:0 auto; background: url(<?php echo $mobile_web_banner;?>) no-repeat center center; background-size: cover;">
    <h5 class="text-center" style='padding-top: 75px;color: #3fab3a;font-size: 28px;font-weight: bold; text-transform: uppercase;'><?php echo $theme_name;?>  <!--<p><button id="quick_demo">Loading...</button></p>--></h5>
</section>
<input type="hidden" name="theme_code" id="theme_code" value="<?php echo $theme_code;?>"/>
<input type="hidden" name="user_age" id="user_age" value="<?php echo $user_age;?>"/>
<input type="hidden" name="marks_scored" id="marks_scored" value="<?php echo $percentage[0]->marks_scored;?>"/>


<section class="bg2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1" style="padding:0px">
                <div class="col-lg-12">
                  	<div class="main-content" style="min-height: 500px; height: auto;position:relative;margin-top:20px;border-radius: 5px;">
	                  	<div class=row>
	                  		<div class="col-lg-12" style='text-align:center'>
                                            <?php if($theme_code == 'BIOLOGICAL_AGE'){ ?>
                                            <div class="col-md-2">&nbsp;</div>
                                            <div class="col-md-4 " style="text-align:center;">
                                                <h3>Calendar Age</h3>
                                                <div class="user_age_value"></div>
                                            </div>
                                            <div class="col-md-4" style="text-align:center;">
                                                <h3>Biological Age</h3>
                                                <div class="score_percentage"></div>
                                            </div>
                                            <div class="col-md-3">&nbsp;</div>
                                            <?php }else{ ?>
                                            <h2>Your <?php if($theme_code == 'DIET_SCORE'){ echo substr($theme_name,0,4);} else {
						                    echo $theme_name;
					                        } ?> score</h2>
                                            <div class="col-md-4 ">&nbsp;</div>
                                            <div class="col-md-4" style="text-align:center;">
                                                <div class="score_percentage"></div>
                                            </div>
                                            <div class="col-md-4">&nbsp;</div>
                                            <?php } ?>
                                            

					    <div style="clear:both;"></div>
					    <div class="col-md-2">&nbsp;</div>
					    <div class="col-md-8">
						<p align='justify' style="font-family: verdana;">
						    <?php foreach($interpretation as $inter){ 
						        echo $inter['interpretation_text'];
						    }?>
						</p>
					    </div>
					    <div class="col-md-2">&nbsp;</div>
						<div style="clear:both;height:20px;"></div>
					    <!-- <div class="col-md-12">
					    	<h3>
					    	<a href='<?php echo base_url();?>assessment/home'>
					    	<img src="<?php echo base_url();?>assets/survey_new/img/assessment_home.png" style="width: 250px;">
					    	</a>
					    	</h3>
					    </div>
		                  		<div style="clear:both;height:50px;"></div>
						
		                  		<div class="col-md-12"></div> -->
		                  		
		                  		<?php if($theme_code == 'STRENGTH_ENERGY' || $theme_code == 'THOUGHT_CONTROL' || $theme_code == 'RELATION_INTIMACY' || $theme_code == 'ZEST_FORLIFE' || $theme_code == 'S&E-A01' || $theme_code == 'R&I-A01'){?>
		                  		<div class="col-md-12">
		                  			<div class="col-md-3"></div>
    		                  		<div class="col-md-3">
    		                  			<a href='<?php echo base_url();?>assessment/home'>
    									<img src="<?php echo base_url();?>assets/css/images/assessment-home_button.png">
    									</a>
    								</div>
    								<div class="col-md-3">
    								<a href='<?php echo base_url();?>assessment/assessment_pdf_download/<?php echo $theme_id; ?>/<?php echo $level_id; ?>'>
    									<img src="<?php echo base_url();?>assets/css/images/download-report_button.png">
    								</a>	
    								</div>
    								<div class="col-md-3"></div>
		                  		</div>
		                  		<?php } else { ?>	
		                  		
		                  		<div class="col-md-12">
		                  		<div class="col-md-4"></div>
		                  		<div class="col-md-3">
		                  		<a href='<?php echo base_url();?>assessment/home'>
		                  		<img src="<?php echo base_url();?>assets/css/images/assessment-home_button.png">
		                  		</a>
		                  		</div>
		                  		<div class="col-md-4"></div>
		                  		</div>
		                  		
		                  		<?php }?>                  		
		                  		
		                  		
		                  		
		                  		
						     <?php //if($theme_code == 'STRENGTH_ENERGY' || $theme_code == 'THOUGHT_CONTROL' || $theme_code == 'RELATION_INTIMACY' || $theme_code == 'ZEST_FORLIFE' || $theme_code == 'S&E-A01' || $theme_code == 'R&I-A01'){?>
							<!--<p><a href='<?php //echo base_url();?>assessment/assessment_pdf_download/<?php //echo $theme_id; ?>/<?php //echo $level_id; ?>'>
							    <img style="width: 200px;" src='<?php //echo base_url();?>assets/css/images/download-report.png'>
							    </a></p>
							<br>-->
							<!--<p>
							    <img src='<?php //echo base_url();?>assets/assessment/img/coresecondaryCTA.png'>
							</p>-->
						    <?php //} else {?>
						    
							<!--<img src='<?php //echo base_url();?>assets/assessment/img/initprimaryCTA.png'>-->
						    <?php //}?>
							

							<div style="clear:both;height:30px;"></div>
	                  			
	                  		</div>
	                   	</div>
                   </div>
                </div>
            </div>
		</div>
	</div>

</section>
<script src="<?php echo base_url();?>assets/survey_new/js/jquery.min.js" type="text/javascript"></script>
<script>
	var color='green';
        var theme_code = $('#theme_code').val(); //BIOLOGICAL_AGE
	$(document).ready(function() {
            if(theme_code!= 'BIOLOGICAL_AGE'){
                var marks = '<?php echo $percentage[0]->marks_scored;?>';
                if(marks < 25){
                    color='red';
                }else if(marks >= 25 && marks < 50){
                    color='yellow';
                }else if(marks >= 50 && marks < 75){
                    color='orange';
                }else{
                    color='green';
                }
                $('.score_percentage').circleGraphic({color:color,percentage_value:'<?php echo $percentage[0]->marks_scored;?>',percentage_text:'%'});
            }else{
                var user_age        = parseInt($('#user_age').val());
                var marks_scored    = parseInt($('#marks_scored').val());
                if(marks_scored > user_age){
                    color='red';
                }else{
                    color='green';
                }
                $('.user_age_value').circleGraphic({color:'green',percentage_value:user_age,percentage_text:''});
                $('.score_percentage').circleGraphic({color:color,percentage_value:marks_scored,percentage_text:''});
                
            }
       });
              
		   
    </script>
<!-- semi footer -->

  


