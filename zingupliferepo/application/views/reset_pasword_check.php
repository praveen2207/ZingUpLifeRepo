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

                                    <div class="message span8 pwd-msg">
                                        <h3 class="congratulations message-head"><?php echo $email_message_heading; ?></h3>
                                        <p class="para-small for-para"><?php echo $email_message; ?></p>

                                    </div> 
                                    <div class="span8 otp-span">
                                        <p class="para-small">Didn't receive the Email? <a class="blue link-small" href="<?php echo base_url(); ?>forgot_password">Send Again</a> or
                                            <a class="blue link-small" href="<?php echo base_url(); ?>forgot_password">Reset via OTP</a></p>
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
