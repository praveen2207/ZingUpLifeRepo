<div class="container">
    <div class="loginBox reHeight">
        <div class="log_head">
            <h3>SIGNUP</h3>
        </div>
        <div class="row log_parents">
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-6 col-md-6 input_sing">
                    <span class="log_circle">OR</span>
                    <?php
                    if ($validation_message == 'validation_error') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Validation Failed!</span>  Please enter valid values for all the fields.
                        </div>
                    <?php } ?>
                    <?php
                    if ($validation_message == 'user_exist') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Error!</span> user already exists with the same email-address .
                        </div>
                    <?php } ?>
                    <!--                    <form class="form-horizontal">-->
                    <form class="form-horizontal" name="register" id="register" action="<?php echo base_url(); ?>user_registration" method="post">  
                        <input type="hidden" name="register_type" value="booking_signup"/>
                        <div class="form-group">
                            <span for="inputName" class="col-xs-3 col-sm-3 col-md-3 control-label">Name :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" class="form-control" id="inputName" placeholder="" name="name">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-3 col-md-3 control-label genderText">Gender :</span>
                            <div class="col-xs-7 col-sm-8 col-md-8 genderText01">
                                <label class="radio-inline">
                                    <input type="radio" name="gender">Female
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender">Male
                                </label>
                            </div>
                            <?php echo form_error('gender'); ?>
                        </div>
                        <div class="form-group">
                            <span for="inputPhone" class="col-xs-3 col-sm-3 col-md-3 control-label">Phone :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" class="form-control" id="inputPhone" placeholder="" name="phone">
                                <?php echo form_error('phone'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputPhone" class="col-xs-3 col-sm-3 col-md-3 control-label">Age :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="text" class="form-control" id="inputPhone" placeholder="" name="age">
                                <?php echo form_error('age'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputEmail" class="col-xs-3 col-sm-3 col-md-3 control-label">Email Id :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="email" class="form-control" id="inputEmail" placeholder="" name="username">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputPassword" class="col-xs-3 col-sm-3 col-md-3 control-label">Password :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="password" class="form-control" id="inputPassword" placeholder="" name="password">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-8 col-sm-8 col-md-8">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="check"> I accept the <span class="colorGreen">terms and conditions</span>
                                    </label>
                                    <?php echo form_error('check'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-sm-offset-3 col-xs-offset-3 col-xs-8 col-sm-8 col-md-8">
                                <!--                                <a href="javascript:void(0);"type="button" class="btn zing-btn pull-right reSingbtn">Sign Up</a>-->
                                <input type="submit" class="btn zing-btn pull-right reSingbtn" value="Sign Up" name="submit">
                            </div>
                        </div>
                        <div class="form-group login_link_ctr">
                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-xs-9 col-sm-9 col-md-8">
                                If you have already an account then click <a class="login_link" href="<?php echo base_url(); ?>login">here</a> to login
                            </div>
                        </div>
                    </form>

                </div> 
                <div class="col-sm-6 col-md-6 socialBtn_box socialBox">
                    <h4>Login With</h4>
                    <ul class="social_tab">
                        <li>	
                            <a class="btn btn-block btn-social btn-google-plus">
                                <sapn class="fa fa-google-plus">g<span>+</span></sapn> Sign in with Google
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-facebook">
                                <sapn class="fa fa-facebook">f</sapn> Sign in with Facebook
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-twitter">
                                <sapn class="fa fa-twitter">t</sapn> Sign in with Twitter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>