<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Partner Registration</h1>


            </div>


            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="get-started">


                            <div class="row">
                                <div class="col-xs-6 mar-auto">



                                    <p>Get started by letting us know about your business</p>
                                    <form class="form-horizontal for" name="get_started" method="post" action="<?php echo base_url(); ?>vendor/do_registration">
                                        <label>What is the Business name?</label>
                                        <input type="text" name="business_name" value="<?php echo set_value('business_name'); ?>">
                                        <?php echo form_error('business_name'); ?>


                                        <input type="hidden" name="plan" value="Membership-I" style="float:none;" />
                                        <input type="hidden" name="plan_id" value="1" style="float:none;" />
                                        <input type="hidden" name="plan_description" value="ecomony" style="float:none;" />
                                        <input type="hidden" name="plan_duration" value="1 Month" style="float:none;" />
                                        <input type="hidden" name="plan_amount" value="25000" style="float:none;" />


                                        <input type="hidden" name="first_name" value="<?php echo set_value('first_name'); ?>">

                                        <input type="hidden" name="last_name" value="<?php echo set_value('last_name'); ?>">

                                        <label>Email Address</label>
                                        <input type="text" name="email" id="vendor_username" value="<?php echo set_value('email'); ?>">
                                        <?php
                                        $error_message = $this->session->flashdata('validation_error');
                                        if ($error_message) {
                                            ?>

                                            <!--<p class="para-small for-para" style="color:red;"><?php echo $error_message; ?></p>-->
<?php echo $error_message; ?>


                                        <?php } ?>
                                        <label id="vendor_username_error" for="name" generated="true" class="error">You have already registered with this email address, you can <a href="<?php echo base_url(); ?>partner">login</a> and continue.</label>
                                        <?php echo form_error('email'); ?>
                                        <label>Create Password</label>
                                        <input type="password" name="password" id="vendor_password" value="<?php echo set_value('password'); ?>">
                                        <?php echo form_error('password'); ?>
                                        <label>Re-enter Password</label>
                                        <input type="password" name="reenter_password" value="<?php echo set_value('reenter_password'); ?>">
                                        <?php echo form_error('reenter_password'); ?>
                                        <input type="submit" class="button" value="Confirm">
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
<script>
    $('#vendor_username_error').css('display', 'none');
//setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 3000;  //time in ms, 5 second for example
    var $input = $('#vendor_username');

//on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

//on keydown, clear the countdown 
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

//user is "finished typing," do something
    function doneTyping() {
        var email = $('#vendor_username').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>vendor/check_username_availability',
            data: {email: email},
            success: function (data) {
                if (data == 'exist') {
                    $('#vendor_username_error').css('display', 'block');
                } else {
                    $('#vendor_username_error').css('display', 'none');
                    $('#vendor_username_errors').css('display', 'none');
                }
            }
        });
    }
    $('#vendor_password').focus(function () {
        var email = $('#vendor_username').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>vendor/check_username_availability',
            data: {email: email},
            success: function (data) {
                if (data == 'exist') {
                    $('#vendor_username_error').css('display', 'block');
                } else {
                    $('#vendor_username_error').css('display', 'none');
                    $('#vendor_username_errors').css('display', 'none');
                }
            }
        });
    });
</script>
