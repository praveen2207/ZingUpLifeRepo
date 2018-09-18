<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Reset Password</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="login-content">
                            <div class="row">
                                <div class="login-form col-xs-4 mar-auto">
                                    <?php
                                    $password_token_error_message = $this->session->flashdata('password_token_error_message');

                                    if (isset($password_token_error_message)) {
                                        ?>
                                        <div class="message">
                                            <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
                                            <p class="para-small for-para"><?php echo $password_token_error_message; ?></p>

                                        </div> 
                                        <?php
                                    } else {
                                        $validation_error = $this->session->flashdata('validation_error');
                                        $username = $this->session->flashdata('username');
                                        $reset_password_token = $this->session->flashdata('reset_password_token');
                                        $reset_password_otp_token = $this->session->flashdata('reset_password_otp_token');
                                        if (isset($validation_error)) {
                                            ?>
                                            <div class="message">
                                                <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
                                                <p class="para-small for-para"><?php echo $validation_error; ?></p>

                                            </div>   
                                        <?php }
                                        ?>
                                        <form class="form-horizontal for" name="reset_password" id="reset_password" method="post" action="<?php echo base_url(); ?>store_new_password">  
                                            <input type="hidden" name="username" value="<?php echo $username; ?>" >
                                            <input type="hidden" name="reset_password_token" value="<?php echo $reset_password_token; ?>" >
                                            <input type="hidden" name="reset_password_otp_token" value="<?php echo $reset_password_otp_token; ?>" >  
                                            <label>New Password</label>
                                            <input type="password" class="input input-xxlarge required" id="pass" name="password"> 
                                            <label>Confirm New Password</label>
                                            <input type="password" class="input input-xxlarge required" id="cpass" name="confirm_password"> 
                                            <input type="submit" name="send" id="send" value="Change Password" class="button login-continue"/>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
