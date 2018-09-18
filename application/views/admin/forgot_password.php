<div class="location-header redirect-header admin-header">
    <h3 class="redirect-head admin-head">Forgot Password</h3>
</div>

<div class="row-fluid forg-row forg-admin-row">
    <?php
    $error_message = $this->session->flashdata('email_validation_error_message');
    if ($error_message) {
        ?>
        <div class="message span8 pwd-msg">
	    <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
	    <p class="para-small for-para"><?php echo $error_message; ?></p>
            
	   </div> 
    <?php } ?>

    <div class="span8">

        <p class="para-small for-para">Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is  simply dummy text of the

            printing and typesetting. </p>



        <form class="form-horizontal for" name="register" id="register" method="post" action="<?php echo base_url(); ?>admin/reset_password_request">  

            <fieldset>  



                <div class="control-group sign-group">  

                    <label class="control-label" for="email">Email</label>  

                    <div class="controls">  

                        <input type="email" class="input input-xxlarge required" id="username" name="username">  



                    </div>  

                </div> 

                <div class="control-group sign-group fg-group"> 

                    <label class="control-label" for="check1"></label>  		  

                    <div class="controls">

                        <input type="submit" name="send" id="sende" value="Send Reset Password Link to Email" class="primary-small clear"/>

                    </div> 

                </div>

            </fieldset>		   

        </form>  
    </div>
</div>       











