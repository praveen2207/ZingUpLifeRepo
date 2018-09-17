

<div class="main-container">    
    <div class="content">
    	<div class="container">
        	
        	<div class="page-head center">
            	<h1>User Login</h1>
            </div>
            
    		<div class="content-inner">
    			<div class="row">
                	
                    <div class="col-xs-12 full-page" >                    
                    	<div class="login-content">
                        	<div class="row">
                        	<div class="login-form col-xs-4 mar-auto">
								<?php if(isset($error)) { ?><p><?php echo $error; ?></p><?php } ?>
								<?php $errorMessage = $this->session->flashdata('login_error_message'); ?>
                            	<form action='<?php echo base_url();?>user_zingup/login' method='post' class='sme_register'>
                                	<label>Email</label>
                                    <input type="email" name='username' class='required'>
									 <?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['error_type'] == 'username') {
                                                ?> <label for="username" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                    
                                    <label>Password</label>
                                    <input type="password" name='password' class='required'>
									<?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['error_type'] == 'password') {
                                                ?> <label for="password" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                    
									<input type="hidden" name='referrer' value='<?php echo $referrer;?>'>
                                    <input type="submit" class="button" value="Continue" /> <a href="<?php echo base_url();?>/sme" class="button2">Cancel</a> <a href="<?php echo base_url();?>sme/forgot_password" class="forgot-password"> Forgot Password? </a> <a href="<?php echo base_url();?>sme/register" > Register?</a>

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


