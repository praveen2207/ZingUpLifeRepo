<div class="location-header redirect-header admin-header">
    <h3 class="redirect-head admin-head">ResetPassword</h3>
</div>
<div class="row-fluid forg-row forg-admin-row">
    <?php
    $password_token_error_message = $this->session->flashdata('password_token_error_message');
    ;
    if (isset($password_token_error_message)) {
        ?>
        <div class="message span8 pwd-msg">
            <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
            <p class="para-small for-para"><?php echo $password_token_error_message; ?></p>

        </div> 
    <?php
    } else {
        $validation_error = $this->session->flashdata('validation_error');
        $username = $this->session->flashdata('username');
        $reset_password_token = $this->session->flashdata('reset_password_token');
        if (isset($validation_error)) {
            ?>
            <div class="message span8 pwd-msg">
                <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
                <p class="para-small for-para"><?php echo $validation_error; ?></p>

            </div>   
    <?php }
    ?>
        <div class="span8">


            <p class="para-small for-para"></p>

            <form class="form-horizontal for" name="register" id="register" method="post" action="<?php echo base_url(); ?>admin/store_new_password">  

                <fieldset>  
                    <div class="control-group sign-group"> 
                        <input type="hidden" name="username" value="<?php echo $username; ?>" >
                        <input type="hidden" name="reset_password_token" value="<?php echo $reset_password_token; ?>" >
                        <label class="control-label control-label1" for="email">New Password</label>  

                        <div class="controls reset-controls">  

                            <input type="password" class="input input-xxlarge required" id="pass" name="password"> 
                        </div>  

                    </div> 
                    <div class="control-group sign-group">  

                        <label class="control-label control-label1" for="email">Confirm New Password</label>  

                        <div class="controls reset-controls">  

                            <input type="password" class="input input-xxlarge required" id="cpass" name="confirm_password">  
                        </div>  

                    </div> 
                    <div class="control-group sign-group fg-group"> 

                        <label class="control-label control-label1" for="check1"></label>  		  

                        <div class="controls reset-controls">

                            <input type="submit" name="send" id="send" value="Change Password" class="primary-small"/>
                        </div> 

                    </div>
                </fieldset>		   

            </form> 
<?php } ?>
    </div>

</div>

