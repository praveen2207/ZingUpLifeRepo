<style>
.btn-social{ width: 96% !important; float: left;
    position: relative;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    height: 39px;
    padding: 9px 45px;
}
.btn-social :first-child {
    top: -3px !important;
}
.btn-block + .btn-block { margin-top: 0;}
.socialBox { adding: 0px 1px;}
.login_circle_boottom {
    position: absolute;
    width: 35px;
    height: 35px;
    background: #898989;
    color: #fff;
    top: -35%;
    right: 240px;
    border-radius: 50%;
    padding: 8px 8px;
    font-size: 14px;
}
.zing-signup-btn{ 
    background: #f39c12;
    border: 2px solid #f39c12 !important;
    color: #fff !important;
    font-size: 16px;
    font-weight: normal !important;
    border-color: #009746;
    border-radius: 4px;
    -ms-border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    margin-right: 10px;
}
.forgot-password{
    margin: auto 0;
}
</style>
<div class="container">
    <div class="loginBox reHeight">
        <div class="log_head">
            <h3>LOGIN / SIGNUP</h3>
        </div>
        <div class="row log_parents">
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-6 col-md-6 input_log">
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
                    if (isset($errorMessage['common_error'])) {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Login Failed!</span>  Invalid Username or password
                        </div>
                    <?php } ?>
                    <form class="form-horizontal user_login_form" name="register" method="post" id="register" action="<?php echo base_url(); ?>do_login">  
                        <input type="hidden" name="referrer" value="<?php if($this->session->userdata('referrer')){ echo $this->session->userdata('referrer'); } else{ echo $referrer;  } ?>"/>
                        <div class="form-group">
                            <span for="inputUser" class="col-xs-3 col-sm-4 col-md-3 control-label">Username :</span>
                            <div class="col-xs-9 col-sm-8 col-md-8">
                                <input type="email" class="form-control required" id="inputUser" name="username" value="<?php echo set_value('oldusername', $errorMessage['username']); ?>">  
                                <?php
                                if (isset($errorMessage)) {
                                    if ($errorMessage['username_error_type'] == 'username') {
                                        ?> <label for="username" generated="true" class="error"><?php echo $errorMessage['username_status']; ?></label> <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span for="inputPassword" class="col-xs-3 col-sm-4 col-md-3 control-label">Password :</span>
                            <div class="col-xs-9 col-sm-8 col-md-8">
								<input type="password" class="form-control required" id="inputPassword" name="password">  
                                <?php
                                if (isset($errorMessage)) {
                                    if ($errorMessage['password_error_type'] == 'password') {
                                        ?> <label for="password" generated="true" class="error"><?php echo $errorMessage['password_status']; ?></label> <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-9 col-sm-9 col-md-8">
                            </div>
                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-9 col-sm-9 col-md-8">
                                <a href="<?php echo base_url();?>forgot_password" class="forgot-password">Forgot Password?</a> <input type="submit" name="submit" value="Login" class="btn zing-btn pull-right" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-md-12" style="text-align: center; padding-top:80px;">
                           <div class="col-sm-12 col-md-12">
                                <a href="<?php echo base_url();?>register" type="button" class="btn zing-signup-btn loginBtn">Signup</a>
                            </div>
                            <div class="col-sm-2 col-md-12">&nbsp;</div>
                            <div class="col-sm-2 col-md-12">
                                <a href="<?php echo base_url();?>experts/register" type="button" class="blue">Signup as Practitioner</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>