<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container"> 
			<div class="content-inner">
    			<div class="row">
				
				<div class="col-xs-12 full-page"> 
                    
                    	<div class="dashboard-inner feedback-add">
                        	
                                <div class=" dashboard-left"> 
                                	<?php $this->view('includes/sidebar'); ?>
                                </div>
                                <div class="dashboard-right"> 
                                	<div class="dashboard-right-inner">
                                    	<div class="dashboard-top-banner" style='background: url("<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $this->session->userdata('header_image'); ?>") no-repeat 50% 0;background-size:cover;'>                                        	
                                            <div class="dashboard-top-details">
                                            	<div class="dashboard-top-details-inner">
                                                	<div class="row">
                                                    	<div class="col-xs-6">
                                                        	<div class="dashboard-top-left-details">
                                                    		<div class="page-big-icon"><img src="<?php echo base_url(); ?>images/dashboard-icon/message-big-icon.png" alt="" /></div>
                                                            <h3>Send Email</h3>
                                                            
                                                            </div>
                                                    	</div>                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="dashboard-content-inner">
											<?php echo validation_errors(); ?>
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
                                        	<div class="dashboard-content-inner-box">
											
                                            <h2 class="dashboard-title ">Send Email</h2>
                                            <div class="dashboard-content-boxinner">
                                            <form action='<?php echo base_url(); ?>followers/send_email' method='post'>
												<div class="col-xs-12">
                                                    <label>Subject</label>
                                                    <input type="text" name='subject' />
                                                 </div>
                                                 <div class="col-xs-12">
													<label>Message</label>
													<textarea name='message'></textarea>
												</div>
												<input type='hidden' name='email' class='email' value='' />
												<input type='hidden' name='type'  value='<?php if($this->uri->segment(3) == 'all') { echo 'all'; } else {echo 'ind'; }?>' />
												<input type='hidden' name='user_id'  class='name' value='<?php echo $this->uri->segment(3); ?>' />
												
												&nbsp;&nbsp;<input type="submit" class="button" value="Send Email">
											
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
