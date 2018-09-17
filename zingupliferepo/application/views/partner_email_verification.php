<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Email Verification</h1>


            </div>


            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="get-started">


                            <div class="row">
                                <div class="col-xs-6 mar-auto">



<!--                                    <p>Please verify your email to register as partner</p>-->
                                    <form class="form-horizontal for" name="get_started" method="post" action="<?php echo base_url(); ?>vendor/verify_vendor_email">
                                        <label>Please enter verification code(do check your email spam folder in case you've not received it yet)</label>
                                        <input type="text" name="email_verification_code" value="<?php echo set_value('business_name'); ?>">
                                        <?php 
                                        if(isset($verification_error)){ ?>
                                        <label class="error" generated="true" for="password"><?php echo $verification_error;?></label>
                                        <?php } ?>
                                        <input type="submit" class="button" value="Continue">
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