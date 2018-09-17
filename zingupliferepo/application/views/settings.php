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
                                                    		<div class="page-big-icon"><img alt="" src="<?php echo base_url(); ?>images/dashboard-icon/setting-big-icon.png" /></div>
                                                            <h3>Setting</h3>                                                            
                                                            </div>
                                                           
                                                    	</div>                                                      
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>                                         
                                        <div class="dashboard-content-inner">
                                        	<div class="dashboard-content-inner-box">
											
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
                                            <div class="setting-content dashboard-content-boxinner">
                                            	<form action='<?php echo base_url();?>sme/update_settings' method='post' enctype="multipart/form-data" />
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
                                                        	<label>Address</label>
                                                            <textarea name='address'><?php echo  $user->address; ?></textarea>
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
                                                            <input type="password" name='passconf' value='' />
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




