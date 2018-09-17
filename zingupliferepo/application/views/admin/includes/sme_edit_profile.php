<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">
        	
        	
            
    		<div class="content-inner">
    			<div class="row">
                	
                    
                    <div class="col-xs-12 full-page" > 
                    
                    	<div class="dashboard-inner feedback-add">
                        	
                                <div class=" dashboard-left" > 
                                	<?php $this->view('includes/sidebar'); ?>
                                </div>
                                <div class="dashboard-right" > 
                                	<div class="dashboard-right-inner">
                                    	<div class="dashboard-top-banner" style='background: url(<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $user->header_image; ?>) no-repeat 50% 0;background-size:cover;'>                                        	
                                            <div class="dashboard-top-details">
                                            	<div class="dashboard-top-details-inner">
                                                	<div class="row">
                                                    	<div class="col-xs-6">
                                                        	<div class="dashboard-top-left-details">
                                                    		<div class="page-big-icon"><img alt="" src="<?php echo base_url(); ?>images/dashboard-icon/edit-big-icon.png" /></div>
                                                            <h3>Edit Profile</h3>                                                            
                                                            </div>
															
                                                    	</div>                                                        
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div> 
																								
                                        <div class="dashboard-content-inner">
                                        	<div class="dashboard-content-inner-box" style='border:none;'>
											<?php echo validation_errors(); ?>
												<?php if(isset($errors)) echo $errors; ?> 
												<?php if(isset($passerror)) echo $passerror; ?>  
												<?php
												$error_message = $this->session->flashdata('msg');
												if ($error_message) {
													?>
													<div class="row-fluid pr-success">


														<div class="message pr-message">

															<h3 class="congratulations message-head">Congratulations!</h3>

															<p class="para-small for-para"><?php echo $error_message; ?></p>

														</div>
													</div>    
												<?php } ?>	
                                            <div class="setting-content dashboard-content-boxinner" style='padding:0px;'>
                                            	<form action='<?php echo base_url();?>sme/update_profile' method='post' enctype="multipart/form-data" />
                                                	<div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Name</label>
                                                            <input type="text" name='first_name' value='<?php echo $user->first_name; ?>'/>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Email</label>
                                                            <input type="text" name='email' value='<?php echo $this->session->userdata('username'); ?>' readonly />
                                                        </div>                                                        
                                                    </div>
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Phone Number</label>
                                                            <input type="text" name='phone' value='<?php echo  $user->phone; ?>' />
                                                        </div>                                                        
                                                    </div>
                                                      <div class="row">
														  <div class="col-xs-12">
																<label>Date of Birth</label>
																<input type='text' name='dob' value='<?php echo date('d-m-Y',strtotime($user->dob)); ?>' id='dobdatepicker' />
																<input type='hidden' class='dob' value='<?php echo date('m/d/Y',strtotime($user->dob)); ?>'/>
															</div>                                                        
                                                      </div>	
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Address</label>
                                                            <textarea name='address'><?php echo  $user->address; ?></textarea>
                                                        </div>                                                        
                                                    </div>
                                                    
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Profile Image</label>
                                                        	<?php if( $user->photo !='') { ?>
																<img src='<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $user->photo; ?>' style='max-width:200px;' />
															<?php } ?>
															<input type='file' name='userfile' value='' />
                                                        </div>                                                        
                                                    </div>
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Header Image</label>
                                                        	<?php if( $user->header_image !='') { ?>
																<img src='<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $user->header_image; ?>' width='900' /> 
															<?php } ?>
                                                            <br/>
															<input type="file" name='header_image'/>
                                                        </div>                                                        
                                                    </div>
                                                    
                                                     <div class="row">
														  <div class="col-xs-12">
																<label>Call Back time</label>
																<input type='text' name='callbk_time' value='<?php echo $user->callback_time; ?>' class="input input-xxlarge required"/>
															</div>                                                        
                                                      </div>
                                                      
                                                      <div class="row">
														  <div class="col-xs-12">
																<label>Vacation Start Date</label>
																<input type='text' name='start_date' value='<?php echo $user->vac_start_date; ?>' class="input input-xxlarge required" id='vac_start_datepicker'/>
															</div>                                                        
                                                      </div>
                                                      
                                                      <div class="row">
														  <div class="col-xs-12">
																<label>Vacation End Date</label>
																<input type='text' name='end_date' value='<?php echo $user->vac_end_date; ?>'  class="input input-xxlarge required" id='vac_end_datepicker'/>
															</div>                                                        
                                                      </div>
                                                      
                                                      <div class="row">
														  <div class="col-xs-12">
																<label>About</label>
																<textarea name='about' id='chars' maxlength='6000'><?php echo $user->about; ?></textarea>
															</div>                                                        
                                                      </div>
                                                      
                                                      <div class="row">
														  <div class="col-xs-12">
																<label>Expertise</label>
																<textarea name='expertise' ID='chars2' maxlength='600'><?php echo $user->expertise; ?></textarea>
															</div>                                                        
                                                      </div>
                                                      
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Change Password</label>
                                                            <input type="password" name='password' value='' /> 
                                                        </div>                                                       
                                                    </div>
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Confirm Password</label>
                                                            <input type="password" name='passconf2' value='' />
                                                        </div>                                                        
                                                    </div>
                                                    
                                                    <div class="row">                                                    	
                                                        <div class="col-xs-12">
                                                        <input type="submit" class="button" value="Save" />
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </form>
                                            </div>
                                            </div>
                                            
                                        </div>                                       
                                    </div>                                
                                </div>
                                       
                        </div>
                        
                    </div>
                    
                    
                </div>
    		</div>  
    	</div>
    </div>
</div>




<?php //print_r($user); ?>
<!--<div class="main-container">    
    <div class="content">
    	<div class="container">
        	
        	<div class="page-head center">
            	<h1>Get Started</h1>
            </div>
            
    		<div class="content-inner">
    			<div class="row">
                	
                    <div class="col-xs-12 full-page" >                    
                    	<div class="get-started">
                        	

                        	<div class="row">
                        		<div class="col-xs-6 mar-auto">
                                <p>Registration</p>
                                <?php echo validation_errors(); ?>
								<?php if(isset($errors)) echo $errors; ?>
							<form action='<?php echo base_url();?>sme/update_profile' method='post' enctype="multipart/form-data" />
                                
                                <label>First name</label>
									<input type='text' name='first_name' value='<?php echo $user->first_name; ?>' />

                                <label>Last name</label>
                                	<input type='text' name='last_name' value='<?php echo  $user->last_name; ?>'  />
                                <label>Email Address</label>
									<input type='email' name='email' value='<?php echo $this->session->userdata('username'); ?>' readonly /> 
								<label>Address</label>
									<textarea name='address'><?php echo  $user->address; ?></textarea>	
								<label>Phone</label>
									<input type='text' name='phone' value='<?php echo  $user->phone; ?>'  />
								<label>Date of Birth</label>
									<input type='text' name='dob' value='<?php echo  $user->dob; ?>' />									
								<label>Gender</label>
									<select id="select01" name="gender" class="required">  
										<option value="">Select Gender</option>  
										<option value="m" <?php   if($user->gender == 'm') ?>selected>Male</option>  
										<option value="f" <?php   if($user->gender == 'f') ?>selected>Female</option>  
									</select>
								<label>Call Back time</label>
									<input type='text' name='callbk_time' value='<?php echo  $user->callback_time; ?>' />
								<label>Start Date</label>
									<input type='text' name='start_date' value='<?php echo  $user->vac_start_date; ?>' />
								<label>End Date</label>
									<input type='text' name='end_date' value='<?php echo  $user->vac_end_date; ?>'  />
								<label>About</label>
									<textarea name='about'><?php echo  $user->about; ?></textarea>
								<label>Expertise</label>
									<textarea name='expertise'><?php echo  $user->expertise; ?></textarea>
								<label>Upload a Photo</label>
									<img src='<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $user->photo; ?>' />
									<input type='file' name='userfile' value='' />
                                <input type="submit" class="button" value="Update"> 
                                </form>
                                
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
    		</div>  
    	</div>
    </div>
</div>-->
