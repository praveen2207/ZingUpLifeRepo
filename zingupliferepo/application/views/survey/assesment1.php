<?php //echo '<pre>'; print_r($details);?>


     <section class="bg">
        <h5 class="text-center" style="padding-top: 75px;color: #fff;font-size: 17px;">YOUR PERSONALIZED 8BAK-C <br/>WELLNESS ASSESSMENT</h5>
     </section>

     <section class="bg2">
       <div class="container">
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
               <div class="main-content">
               <!-- progress bar -->
                   <div class="progress-container" style='visibility:hidden;'>
                      <input type="radio" class="radio" name="progress" value="five" id="five" checked>
                      <label for="five" class="label">5%</label>
                       <div class="progress">
                        <div class="progress-bar"></div>
                      </div>
                    </div>

                 <!-- page counter -->
                   	
                   <div class="hexagon" style='visibility:hidden;'></div><span class="desc" style='visibility:hidden;'>1/9</span>
                   <div class="form">
                  <p style="color:green;">*Your data will be confidential.</p>
                     <form class='basic_info' action='<?php echo base_url(); ?>survey/register' method='post' name="bmi"  id="bmi"/>
                        <div class="form-group">
                            <input type="text" id="name" name="user_name" placeholder="What we should call you?" class='required' 
                            		    value='<?php if($this->session->flashdata('user_name') =='') {  echo $details->name; } else { echo $this->session->flashdata('user_name'); }?>'
                            			 <?php if($details->name != '') {?>readonly<?php } ?> 
                            			 value='<?php echo $this->session->flashdata('user_name'); ?>'>
                          </div>
                           <div class="form-group">
                               <input type="radio" id="radio1" value="Male" name="gender" class='rad'
                               	 <?php  if($details->gender == 'Male' || $this->session->flashdata('gender') == 'Male') 
                               	 	{?>checked<?php }?> <?php if($details->gender != '') {?>disabled<?php } ?>> Male
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               <input type="radio" id="radio2" class='rad' value="Female" name="gender" 
                               			<?php if($details->gender == 'Female' || $this->session->flashdata('gender') == 'Female') 
                               			{?>checked<?php }?> <?php if($details->gender != '') {?>disabled<?php } ?>> Female
                            
                          </div>
                          <div class="form-group">
                              <div class="col-lg-6" style="padding-left:0px; float:left;">
                                 <div class="form-group">
                                    <input type="text"  id="age" name="age" placeholder="Age (years)" class='required age' value='<?php if($this->session->flashdata('age') =='') { echo $details->age; } else { echo $this->session->flashdata('age'); }  ?>' >
                                  </div>
                              </div>
							  <div class="col-lg-6" style="padding-left:0px;float:left;">
							   <div class="form-group">
                                    <input type="text"  id="weight" name="weight" placeholder="Weight (kg)" class='required weight' value='<?php if($this->session->flashdata('weight') =='') { echo $details->weight; } else { echo $this->session->flashdata('weight'); } ?>' >
                                  </div>
							  </div>
                              <div class="col-lg-12" style="padding-left:0px;">
                                   <div class="form-group">
                                    <input type="text"  id="height" name="height" placeholder="Height (m)" class='required height' value='<?php if($this->session->flashdata('height') =='') { echo $details->height; } else { echo $this->session->flashdata('height'); } ?>' >
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <input type="text"  id="bmi" name="bmi"  class='bmi' 
                            	value='<?php if($this->session->flashdata('bmi') =='') 
                                				{echo $details->bmi; } 
                                			else { echo $this->session->flashdata('bmi'); }?>' readonly>
							 </div>
                          <div class="form-group">
                            <input type="email"  id="email" name="email" placeholder="Email ID" class='required email_entered'
                            				 value='<?php if($this->session->flashdata('email') =='') 
                            				 	{echo $details->username; } else { echo $this->session->flashdata('email'); }?>'
                            				 	<?php if($details->username != '') {?>readonly<?php } ?>/>
                            				 	
                          	<p class='email-reg' style='color:green;'></p>
                          </div>
                          
                           <div class="form-group">
                                <input type="text" id="phone" maxlength="10" name="phone" placeholder="Mob # (to get access code)"  class='required get-access-code'
                                value='<?php if($this->session->flashdata('phone') =='') 
                                				{echo $details->phone; } 
                                			else { echo $this->session->flashdata('phone'); }?>'>
                             <p class='phone-reg' style='color:green;'></p>   			
                            </div>
                             
                           <br/>
                         	<div class="form-group">
                                <input type="text" id="otp" name="otp" placeholder="Enter access code" class='required  show-access-code-msg' value='<?php if($this->session->flashdata('otp') =='') {    
                                	echo $details->otp; } else { echo $this->session->flashdata('otp'); }?>' <?php if($details->phone != '') {?><?php } ?>/>
                                <p style='color:red;'> <?php echo $this->session->flashdata('otp_error') ?></p>  
                            </div>
                           <br/>
                         
                              <input type="checkbox" id='agreesd' name='agreesd'  class='required' <?php if($this->session->flashdata('terms') == 'checked') 
								  { ?>checked<?php } ?> />I have read the <a href='<?php echo base_url();?>terms' target='_blank' style='padding-left:0px;'>terms and conditions</a> and agree to them.</label>
                              
							
                           	<input type='hidden' name='link' value='<?php echo $this->uri->segment(3);?>' />
							 
							 <button type="submit" class="btn btn-default nxt-btn23" name='btntype' value='next' style="background-color:#009746; color:#fff">&nbsp;&nbsp; Submit &nbsp;&nbsp;
							 </button>
							  <br/><br/><br/>
							  </form>
                          </div>
                   </div>
               </div>
            </div>
         </div>
     </section>
    