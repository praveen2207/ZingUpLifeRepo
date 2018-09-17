
<div class="main-container">    
    <div class="content">
        <div class="container">    

            <div class="page-head center">
                <h1>Partner Sign In</h1>
            </div>

            <?php
            $login_required_message = $this->session->flashdata('login_required_message');
            if (isset($login_required_message)) {
                ?>

                <div class="row-fluid pr-success">
                    <div class="message pr-message">
                        <h3 class="congratulations message-head">Please login to continue !!!</h3>
                        <p class="para-small for-para">You are not logged in or session expired.</p>
                    </div>
                </div>
            <?php } ?>
            <div class="content-inner">
                <div class="row">
                    <?php $errorMessage = $this->session->flashdata('login_error_message'); ?>
                    <div class="col-xs-12 full-page" >                    
                        <div class="login-content">
                            <div class="row">
                                <div class="login-form col-xs-4 mar-auto">
                                    <?php
                                    if (isset($errorMessage)) {
                                        echo '<label for="username" generated="true" class="error">' . $errorMessage['error_status'] . '</label>';
                                    }
                                    ?>
                                    <form class="form-horizontal for login-form-ctr" name="register" method="post" id="register" action="<?php echo base_url(); ?>do_partner_login">
                                        <label>Email</label>
                                        <input type="text" id="username" name="username" value="<?php echo set_value('oldusername', $errorMessage['username']); ?>">
                                        <?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['username_error_type'] == 'username') {
                                                ?> <label for="username" generated="true" class="error"><?php echo $errorMessage['username_status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                        <label>Password</label>
                                        <input type="password" id="password" name="password">
                                        <?php
                                        if (isset($errorMessage)) {
                                            if ($errorMessage['password_error_type'] == 'password') {
                                                ?> <label for="password" generated="true" class="error"><?php echo $errorMessage['password_status']; ?></label> <?php
                                            }
                                        }
                                        ?>
                                        <input type="submit" class="button login-continue" value="Continue" /> <a href="#" class="button2">Cancel</a> <a href="<?php echo base_url(); ?>vendor/forgot_password" class="forgot-password"> Forgot Password?</a>
                                        <a href="<?php echo base_url(); ?>vendor/registration" class="forgot-password">Register?</a>
<!--                                        <ul><li class="facebook_login"><img src="<?php echo base_url(); ?>assets/images/fb.png"/></li></ul>-->
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






<!--<script>
    logInWithFacebook = function () {
        FB.login(function (response) {
            if (response.authResponse) {
                alert('You are logged in &amp; cookie set!');
                // Now you can redirect the user or do an AJAX request to
                // a PHP script that grabs the signed request from the cookie.
            } else {
                alert('User cancelled login or did not fully authorize.');
            }
        });
        return false;
    };
    window.fbAsyncInit = function () {
        FB.init({
            appId: '1598778137051809',
            cookie: true, // This is important, it's not enabled by default
            version: 'v2.2'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>-->

<script type="text/javascript">
    window.fbAsyncInit = function () {
//Initiallize the facebook using the facebook javascript sdk
        FB.init({
            appId: '<?php
                                        $this->config->load('facebook');
                                        echo $this->config->item('appId');
                                        ?>',
            cookie: true, // enable cookies to allow the server to access the session
            status: true, // check login status
            xfbml: true, // parse XFBML
            oauth: true //enable Oauth
        });
    };
//Read the baseurl from the config.php file
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
//Onclick for fb login
    $('.facebook_login').click(function (e) {

        FB.login(function (response) {
            if (response.authResponse) {
                parent.location = '<?php echo base_url('vendor/facebook_login'); ?>'; //redirect uri after closing the facebook popup
            }
        }, {scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook
    });
</script>