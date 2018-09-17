

<div class="main-container">    
    <div class="content">
    	<div class="container">
        	
        	<div class="page-head center">
            	<h1>SME Login</h1>
            </div>
            
    		<div class="content-inner">
    			<div class="row">
                	
                    <div class="col-xs-12 full-page" >                    
                    	<div class="login-content">
                        	<div class="row">
                        	<div class="login-form col-xs-4 mar-auto">
								<?php if(isset($error)) { ?><p><?php echo $error; ?></p><?php } ?>
                            	<form action='<?php echo base_url();?>sme/signin' method='post' id='sme_login'>
                                	<label>Email</label>
                                    <input type="email" name='username' class='input input-xxlarge required'>
                                    <p><?php echo form_error('username'); ?></p>
                                    <label>Password</label>
                                    <input type="password" name='password' class='input input-xxlarge required'>
                                    <p><?php echo form_error('password'); ?></p>
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


