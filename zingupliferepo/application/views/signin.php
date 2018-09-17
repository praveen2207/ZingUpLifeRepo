<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Sign In</h1>
            </div>

            <div class="content-inner">
                <div class="row">
                    <?php
                    $errorMessage = $this->session->flashdata('login_error_message');
                    if (isset($errorMessage)) {
                        $old_username = $errorMessage['username'];
                    } else {
                        $old_username = '';
                    }
                    ?>
                    <div class="col-xs-12 full-page" >                    
                        <div class="get-started">

                            <div class="row">
                                <div class="col-xs-6 mar-auto">

                                    <?php
                                    if (isset($errorMessage['common_error'])) {
                                        ?>
                                        <div class="message pr-message">
                                            <h3 class="congratulations message-head">Please try again !!!</h3>
                                            <p class="para-small for-para error_message_text">Username or password is invalid.</p>
                                        </div>
<?php } ?>
                                    <p class="sign-reg"><a class="blue" href="<?php echo base_url(); ?>signup">Sign Up</a> if don't have account then register.</p>
                                    <form class="" name="register" id="register" method="post" action="<?php echo base_url(); ?>sign_in">  
                                        <label class="control-label" for="email">Email</label> 
                                        <input type="email" class="input input-xxlarge required" id="email" name="email"  value="<?php echo set_value('oldusername', $old_username); ?>"> 
                                        <?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['error_type'] == 'username' && $errorMessage['error_type'] == '') {
                                                ?> <label for="username" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                        <label class="control-label" for="password">Password</label> 
                                        <input type="password" class="input input-xxlarge required" id="password" name="password">  
                                        <?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['error_type'] == 'password' && $errorMessage['error_type'] == '') {
                                                ?> <label for="password" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                        <div class="clear"></div>
                                        <label class="control-label forgot-pass" for="forgot"></label>  
                                        <div class="controls">  
                                            <a href="<?php echo base_url(); ?>forgot_password" class="blue">Forgot Password?</a>
                                        </div>  
                                        <div class="form-submit-button-ctr">
                                            <input type="submit" class="button form-submit-button" value="Continue" name="submit">
    <!--                                        <input type="submit" class="button form-submit-button" value="Cancel">-->
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
