<?php //echo '<pre>'; print_r($right); exit();?>
  
     <section class="bg">
       <h5 class="text-center" style="padding-top: 75px;color: #fff;font-size: 17px;">YOUR PERSONALIZED <br/>WELLNESS ASSESSMENT</h5>
     </section>

     <section class="bg2">
       <div class="container">
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="main-content" style="height:650px;">
                    <div class="nav2">
					<?php //if($register == 'yes' || $this->session->userdata('promocode')) { ?>
					  <span class="pull-left">  
					  <a href='<?php echo base_url();?>survey/healthprofile1'>
					  <img src="<?php echo base_url();?>assets/survey_new/img/prev-white.png" width="27px" alt="next" style='top: 13px;position: relative;margin-right: 20px;'/></a>
					  </span> 
					  <?php //} ?>
                      <h4>THINGS I'M DOING RIGHT
					  <?php if($health3 == 'add') {?>
					  <span class="pull-right">  <img src='<?php echo base_url();?>assets/survey_new/img/support-loading.gif' width='27px' class='loading' style='display:none;'/>
					  <img src="<?php echo base_url();?>assets/survey_new/img/next-white.png" width="27px" alt="next" class='healthprofile2' style='cursor: pointer;'/></span>
					  <?php } ?>
						 <span class="pull-right">  <img src='<?php echo base_url();?>assets/survey_new/img/support-loading.gif' width='27px' class='loading' style='display:none;'/>
						<img src="<?php echo base_url();?>assets/survey_new/img/next-white.png" width="27px" alt="next" class='healthprofile2' style='cursor: pointer;'/></span>  
					
					  </h4>
                    </div>
					
						<!--<?php if($register == 'yes' || $this->session->userdata('promocode')) { ?>
					<?php } else {?>
					<br/>
					<?php   $logged_in_user_details = $this->session->userdata('logged_in_user_data');
							if (!empty($logged_in_user_details) ) { if(!($this->session->userdata('promocode'))) { ?>
							<p style='margin-left:20px;color:red;display:none;' class='er-msg'>The code entered is not valid/wrong AccessCode</p>
							<p style='margin-left:20px;color:green;display:none;' class='su-msg'>Report is loading...</p>
							<input type='hidden' value='<?php echo $logged_in_user_details->username; ?>' class='email-send-code' />
							<input type='hidden' value='<?php echo $logged_in_user_details->name; ?>' class='email-send-code-name' />
							 <button type="button" class="btn btn-default nxt-btn23 get-access-code" name='btntype' value='next' style="background-color:#009746; color:#fff; margin-left:20px;">&nbsp;&nbsp; Get Access Code &nbsp;&nbsp;
							 </button>
							 <div class="form-group access-code-form" style='margin-left:20px;display:none;'>
							 <p style='color:green;'>The Access Code is sent to your registered email ID. Please check your mail and enter the code in the box shown below</p>
								<input type="text" id="name" name="code" placeholder="Access Code" class='access-code-ent' value=''/>
								<button type="button" class="btn btn-default nxt-btn23 submit-new-access-code" name='btntype' value='next' style="background-color:#009746; color:#fff; margin-left:20px;">&nbsp;&nbsp; Submit &nbsp;&nbsp;
							 </button>
							</div>
							<?php } } ?> 
						<!--<p style='margin-left:20px;'>Please <span style='cursor:pointer;' class='registr'>register</span> to get the final report</p>
					<?php } ?>-->
					
				
					
					
					
                    <div class="profile-results2" id="html-content-holder">
                    <div class="row">
                        <div class="col-lg-4 box1">
                           <ul style="list-style-type:none">
                              <li style="background-color:#27ae60;"><?php echo $right[0]->wellness_element; ?></li>
							  <li style="background-color:#27ae60;"><?php echo $right[1]->wellness_element; ?></li>
							  <li style="background-color:#27ae60;"><?php echo $right[2]->wellness_element; ?></li>
                           </ul>
                        </div>
                        <div class="col-lg-4 box2">
                          <ul style="list-style-type:none">
							<li style="background-color:#27ae60;"><?php echo $right[3]->wellness_element; ?></li>
                              <li style="background-color:#27ae60;"><?php echo $right[4]->wellness_element; ?></li>
                              <li style="background-color:#27ae60;"><?php echo $right[5]->wellness_element; ?></li>
                              <li style="background-color:#27ae60;"><?php echo $right[6]->wellness_element; ?></li>
                           </ul>
                        </div>
                        <div class="col-lg-4 box3">
                            <ul style="list-style-type:none">
                              <li style="background-color:#27ae60;"><?php echo $right[7]->wellness_element; ?></li>
                              <li style="background-color:#27ae60"><?php echo $right[8]->wellness_element; ?></li>
							   <li style="background-color:#27ae60;"><?php echo $right[9]->wellness_element; ?></li>
                           </ul>
                        </div>
                       </div> 
                    </div>
                </div>
               </div>
			   
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
     </section>
     