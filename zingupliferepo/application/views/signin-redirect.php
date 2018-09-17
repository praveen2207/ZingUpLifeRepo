<script type="text/javascript">
    function submitform() {
         document.signin_submit.submit();
    }
</script>
<body onLoad="submitform()">
    <div class="container">
        <div class="loginBox reHeight">
            <div class="log_head">
                <h3>SIGNING IN</h3>
            </div>
            <div class="row log_parents redirection_ctr">
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-5">
                            <img src="<?php echo base_url(); ?>assets/css/images/redirect.gif" alt="redirect.gif"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-5 redirection">
                            <h4 class="success suc-con">Sign In Successful Redirecting...</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $home_url = base_url();
    $reset_pwd = base_url() . 'store_new_password';
    $login_url = base_url() . 'login';
    if ($referrer == $home_url || $referrer == '' || $referrer == $reset_pwd || $referrer == $login_url) {
        $referrer_url = base_url() . 'dashboard';
    } else {
        $referrer_url = $referrer;
    }
    ?>
    <form action="<?php echo $referrer_url ?>" method="post" name="signin_submit">
    </form>
</body>

