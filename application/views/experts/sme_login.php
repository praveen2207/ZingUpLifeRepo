

<div class="container">
    <div class="loginBox reHeight">
        <div class="log_head">
            <h3>Experts LOGIN</h3>
        </div>
        <div class="row log_parents">
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-7 col-md-7 input_sing new_sing">
                    
                    <?php $errorMessage = $this->session->flashdata('login_error_message'); ?>
                    <?php
                    $login_required_message = $this->session->flashdata('login_required_message');
                    if (isset($login_required_message)) {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Login Failed!</span>  You are not logged in or session expired.
                        </div>
                    <?php } ?>
                    <?php
                    if(isset($error)) {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Login Failed!</span>  <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <form action='<?php echo base_url();?>experts/signin' method='post' id='sme_login' style='clear:both;'> 
                        <input type="hidden" name="referrer" value="<?php echo $referrer; ?>"/>
                        <div class="form-group">
                            <span for="inputUser" class="col-xs-3 col-sm-4 col-md-3 control-label">Username :</span>
                            <div class="col-xs-9 col-sm-8 col-md-8">
<!--                                <input type="text" class="form-control" id="inputUser" placeholder="">-->
                                <input type="email" class="form-control required" id="inputUser" name="username" value=""> 
								<label for="username" generated="true" class="error"><?php echo form_error('username'); ?></label>								
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputPassword" class="col-xs-3 col-sm-4 col-md-3 control-label">Password :</span>
                            <div class="col-xs-9 col-sm-8 col-md-8">

                                <input type="password" class="form-control required" id="inputPassword" name="password"> 
								<label for="password" generated="true" class="error"><?php echo form_error('password'); ?></label>								
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-9 col-sm-9 col-md-8">
                                <input type="submit" name="submit" value="Login" class="btn zing-btn pull-right"/>
                                <input type="submit" name="submit" value="Cancel" class="btn cancle-btn pull-right"/>

                            </div>
                        </div>
                        <div class="form-group forgot_password_ctr">
                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-9 col-sm-9 col-md-8">
                                <a href="<?php echo base_url(); ?>experts/register" class="forgot-password pull-right">Register?</a>
                                <a href="<?php echo base_url(); ?>experts/forgot_password" class="forgot-password pull-right">Forgot Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!--<div class="col-sm-6 col-md-6 socialBtn_box socialBox">
                    <h4>Login With</h4>
                    <ul class="social_tab">
                        <li>	
                            <a class="btn btn-block btn-social btn-google-plus">
                                <span class="fa fa-google-plus" style='color:#fff;'>g<span>+</span></span> Sign in with Google
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-facebook">
                                <span class="fa fa-facebook" style='color:#fff;'>f</span> Sign in with Facebook
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-twitter" href="<?php echo base_url();?>twitter">
                                <span class="fa fa-twitter" style='color:#fff;'>t</span> Sign in with Twitter
                            </a>
                        </li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
</div>

