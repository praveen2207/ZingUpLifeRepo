<div id="container">
            <h1>Login</h1>

            <div id="body">
                <?php
                $activationMessage = $this->session->flashdata('account_activation_success_message');
                $errorMessage = $this->session->flashdata('login_error_message');
                $loginRequiredMessage = $this->session->flashdata('login_required_message');
                $passwordChangedSuccessMessage = $this->session->flashdata('password_changed_success_message');
                ?>
                <?php if (isset($activationMessage)) {
                    ?>
                    <div class="success"><h2><?php echo $activationMessage; ?></h2></div>
                <?php } ?>
                <?php if (isset($passwordChangedSuccessMessage)) {
                    ?>
                    <div class="success"><h2><?php echo $passwordChangedSuccessMessage; ?></h2></div>
                <?php } ?>
                <?php if (isset($errorMessage)) {
                    ?>
                    <div class="error"><h2><?php echo $errorMessage; ?></h2></div>
                <?php } ?>
                <?php if (isset($loginRequiredMessage)) {
                    ?>
                    <div class="error"><h2><?php echo $loginRequiredMessage; ?></h2></div>
                <?php } ?>

                <?php echo form_open('doLogin'); ?>


                <?php echo 'Email / Username'; ?>: 

                <?php echo form_input('username', set_value('username')); ?>
                <br/><br/>

                <?php echo 'Password'; ?>: 
                <?php echo form_password('password'); ?>
                <br/><br/>

                <?php echo form_submit('login', 'Login'); ?>

                <?php echo form_close(); ?>

            </div><br/>
            <a class="login" href="<?php echo base_url(); ?>forgotPassword">Forgot Password</a>
            <a class="login" href="" id="facebook_login">Login with Facebook</a>
            <a class="login" onclick="window.open('googleLogin', 'Google Login', 'height=400,width=450')" href="javascript:;" data-toggle="tab">Login with Gmail </a>
            <br/><br/>
            <p class="footer">Footer</p>
        </div>
        <div id="fb-root">
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script>
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
                        oauth: true, //enable Oauth
                        version: 'v2.4'
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
                $('#facebook_login').click(function (e) {

                    FB.login(function (response) {
                        if (response.authResponse) {
                            parent.location = '<?php echo base_url('facebookLogin'); ?>'; //redirect uri after closing the facebook popup
                        }
                    }, {scope: 'email,user_birthday'}); //permissions for facebook
                    return false;
                });
        </script>
