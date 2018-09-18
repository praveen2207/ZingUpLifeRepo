<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Forgot Password</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="login-content">
                            <div class="row">
                                <div class="login-form col-xs-4 mar-auto">
                                    <?php
                                    $error_message = $this->session->flashdata('email_validation_error_message');
                                    if ($error_message) {
                                        ?>
                                        <div class="message span8 pwd-msg">
                                            <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
                                            <p class="para-small for-para"><?php echo $error_message; ?></p>

                                        </div> 
                                    <?php } ?>
                                    <form class="form-horizontal for" name="register" method="post" id="register" action="<?php echo base_url(); ?>reset_password_request">  
                                        <label>Email</label>
                                        <input type="email" class="required" id="username" name="username" value="<?php echo set_value('oldusername', $errorMessage['username']); ?>">  
                                        <?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['error_type'] == 'username') {
                                                ?> <label for="username" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                        <input type="submit" name="send" id="send" value="Send OTP to Mobile Number" class="button login-continue"/>
                                        <br/><span class="two_options">OR</span><br/><input type="submit" class="button login-continue" value="Send Reset Password Link to Email" />
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
