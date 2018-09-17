<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Enter OTP</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="login-content">
                            <div class="row">
                                <div class="login-form col-xs-4 mar-auto">
                                    <?php
                                    $success_message = $this->session->flashdata('otp_validation_success_message');
                                    $error_message = $this->session->flashdata('otp_validation_error_message');
                                    if ($success_message) {
                                        ?>
                                        <div class="message">
                                            <h3 class="congratulations message-head">Congratulations !!!.</h3>
                                            <p class="para-small for-para"><?php echo $success_message; ?></p>
                                        </div>    
                                    <?php } if ($error_message) { ?>
                                        <div class="message">
                                            <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
                                            <p class="para-small for-para"><?php echo $error_message; ?></p>

                                        </div> 
                                    <?php } ?>

                                    <form class="form-horizontal for" name="register" id="register" method="post" action="<?php echo base_url(); ?>validate_otp">  
                                        <label>Enter OTP</label>
                                        <input type="text" class="input input-xxlarge required" id="otp" name="otp"> 
                                        <input type="submit" name="send" id="send" value="Submit to Reset Password" class="button login-continue"/>
                                    </form>
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
