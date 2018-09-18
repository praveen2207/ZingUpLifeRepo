<?php //echo '<pre>'; print_r($right); exit();?>
 
     <section class="bg">
       <h5 class="text-center" style="padding-top: 75px;color: #fff;font-size: 17px;">YOUR PERSONALIZED <br/>WELLNESS ASSESSMENT</h5>
     </section>

     <section class="bg2">
       <div class="container">
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="main-content risk" style="height:650px;">
                    <div class="nav4">
					<?php //if($register == 'yes' || $this->session->userdata('promocode')) { ?>
					  <span class="pull-left">  
					  <a href='<?php echo base_url();?>survey/prev_healthprofile2'> 
					  <img src="<?php echo base_url();?>assets/survey_new/img/prev-white.png" width="27px" alt="next" style='top: 13px;position: relative;margin-right: 20px;'/></a>
					  </span>
					  <?php //} ?>
                    	<h4>WHERE CAN I IMPROVE?
					  <span class="pull-right">  
					   <img src='<?php echo base_url();?>assets/survey_new/img/support-loading.gif' width='27px' class='loading' style='display:none;'/>
					   <img src="<?php echo base_url();?>assets/survey_new/img/next-white.png" width="27px" alt="next" class='healthprofile3' style='cursor: pointer;'/>
					   </span>
					    <?php ?>
					  <span class="pull-right registere-report" style='display:none;'>
					  <img src="<?php echo base_url();?>assets/survey_new/img/next-white.png" width="27px" alt="next"  class='healthprofile3' style='cursor: pointer;'/>
					  </span>
					  </h4>
                    </div>
					
                    <div class="profile-results2" id="html-content-holder">
                    <div class="row">
                        <div class="col-lg-4 box1">
                           <ul style="list-style-type:none">
                              <li style="background-color:#e67e22;"><?php echo $right[0]->wellness_element; ?></li>
							  <li style="background-color:#e67e22;"><?php echo $right[1]->wellness_element; ?></li>
							  <li style="background-color:#e67e22;"><?php echo $right[2]->wellness_element; ?></li>
                           </ul>
                        </div>
                        <div class="col-lg-4 box2">
                          <ul style="list-style-type:none">
                              <li style="background-color:#e67e22;"><?php echo $right[3]->wellness_element; ?></li>
                              <li style="background-color:#e67e22;"><?php echo $right[4]->wellness_element; ?></li>
                              <li style="background-color:#e67e22;"><?php echo $right[5]->wellness_element; ?></li>
							  <li style="background-color:#e67e22;"><?php echo $right[6]->wellness_element; ?></li>
                           </ul>
                        </div>
                        <div class="col-lg-4 box3">
                            <ul style="list-style-type:none">
                              <li style="background-color:#e67e22;"><?php echo $right[7]->wellness_element; ?></li>
                              <li style="background-color:#e67e22;"><?php echo $right[8]->wellness_element; ?></li>
							  <li style="background-color:#e67e22;"><?php echo $right[9]->wellness_element; ?></li>
                           </ul>
                        </div>
                       </div> 
                    </div>
					<div style='display:none;'>
			   <input id="btn-Preview-Image" type="button" value="Preview" />
					<a id="btn-Convert-Html2Image3" href="#">Download</a>
					<br />
					<h3>Preview :</h3>
					<div id="previewImage">
					</div>
					</div>
                </div>
				
				 <div class="main-content registration-form" style='display:none;'>
               <!-- progress bar -->
                   <div class="progress-container" style='visibility:hidden;'>
                      <input type="radio" class="radio" name="progress" value="five" id="five" checked>
                      <label for="five" class="label">5%</label>

                      <div class="progress">
                        <div class="progress-bar"></div>
                      </div>
                    </div>
               </div>
            </div>
         </div>
     </section>
    