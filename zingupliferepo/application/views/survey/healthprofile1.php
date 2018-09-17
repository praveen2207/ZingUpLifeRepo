<?php //echo '<pre>'; print_r($survey_det); exit();?>
 
     <section class="bg">
        <h5 class="text-center" style="padding-top: 75px;color: #fff;font-size: 17px;">YOUR PERSONALIZED 8BAK-C <br/>WELLNESS ASSESSMENT</h5>
     </section>

     <section class="bg2">
       <div class="container">
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="main-content">
                    <div class="nav">
                      <h4>MY PERSONAL WELLNESS 360&deg;<span class="pull-right"> 
					  <img src='<?php echo base_url();?>assets/survey_new/img/support-loading.gif' width='27px' class='loading' style='display:none;'/>	
					 		
					  		<img src="<?php echo base_url();?>assets/survey_new/img/next-white.png" width="27px" alt="next" class='healthprofile1' style='cursor: pointer;'/>
					  		</span></h4> 
                    </div>
                    <?php $logged_in_user_details = $this->session->userdata('logged_in_user_data');
						
                    	if (empty($logged_in_user_details) ) { ?>
						
						 <a href='<?php echo base_url(); ?>survey/assessment1' >
						 <!--   <p type="button" class="btn btn-default nxt-btn23" name='btntype' 
						 			value='next' style="background-color:#009746; color:#fff; margin-left:20px;">&nbsp;&nbsp; Get Your Overall Wellness Report &nbsp;&nbsp;
						 		</p>
						  -->
						 </a>
						
					<?php } ?>
                    <div class="profile-results" id="html-content-holder">
					<?php if($survey_det[0]->bmi_value != '')
					{ ?>
					<div class="col-xs-12">
                            <p>BMI value : <?php echo number_format((float)$survey_det[0]->bmi_value, 1, '.', '');?> </p>
							 <p>BMI Category : <?php echo $survey_det[0]->bmi_cat; ?> </p>
							<p>BMI Report : <?php echo $survey_det[0]->bmi_report; ?></p>
                          </div>
						 
					<?php } ?>
                        <div class="row">
                          
                          <!-- ./col -->
                          <div class="col-xs-6 col-md-4 text-center" style='margin-left:250px;'>
                            <input type="text" class="knob" value="<?php $grand = round($survey_det[0]->grand_total /320 * 100); echo round($survey_det[0]->grand_total /320 * 100); ?>" data-width="140" data-height="140" 
							data-fgColor="<?php if($grand >=0 && $grand <=25) { echo '#e74c3c'; } else if($grand >=26 && $grand <=50) { echo '#e67e22'; } else if($grand >=51 && $grand <=75) { echo '#f1c40f'; } else if($grand >=76 && $grand <=100) { echo '#27ae60'; }?>" data-readonly="true">

                            <div class="knob-label">Overall score</div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-6 col-md-4 text-center"> 
                            
                          </div>
                        </div>  
                       
                        <hr/>
                        <div class="row" style="margin-top:0px">
							<?php foreach($survey_det as $r) { $finalscore = $r->score / 40 * 100; ?>
							   <div class="col-xs-6 col-md-3 text-center">
								<input type="text" class="knob" value="<?php echo abs($finalscore); ?>" data-width="120" data-height="120" data-fgColor="<?php if($finalscore >=0 && $finalscore <=25) { echo '#e74c3c'; } else if($finalscore >=26 && $finalscore <=50) { echo '#e67e22'; } else if($finalscore >=51 && $finalscore <=75) { echo '#f1c40f'; } else if($finalscore >=76 && $finalscore <=100) { echo '#27ae60'; }?>" data-readonly="true">
								<div class="knob-label"><?php echo $r->category;?></div>
							  </div>
							<?php } ?>
                        </div> 
                       
                        
                    </div>
					<br/>
					 <div style='display:none;'>
					   <input id="btn-Preview-Image" type="button" value="Preview" />
						<a id="btn-Convert-Html2Image" href="#">Download</a>
						<br />
						<h3>Preview :</h3>
						<div id="previewImage">
						</div>
					</div>
					
                </div>
               </div>
            </div>
         </div>
     </section>
   