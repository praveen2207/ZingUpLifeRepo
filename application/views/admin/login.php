<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Sign In</h3>
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




<div class="row-fluid sign-admin-row">
    <div class="login-box" style="padding-top:70px; padding-left:100px;">
  <div class="login-box-body">
    <p class="login-box-msg"><div class="login-logo">
  </div>
    <?php 
    $errorMessage = $this->session->flashdata('login_error_message'); 
   ?>
    <form  name="register" method="post" id="register" action="<?php echo base_url(); ?>admin/do_login"> 
  <div class="row">
      <div class="col-xs-4">
      <div class="form-group has-feedback">
        <input type="email" class="form-control required" id="email" name="username" value="<?php echo set_value('oldusername', $errorMessage['username']); ?>" placeholder="Username">
        <?php
        if (isset($errorMessage)) {
            if ($errorMessage['error_type'] == 'username') {
                ?> <label for="username" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
            }
        }
        ?>
      </div>
      </div>
      <div style="clear:both; height: 20px;"></div>
     <div class="col-xs-4">
      <div class="form-group has-feedback">
            <input type="password" class="form-control" id="" name="password" placeholder="Password">  
            <?php
            if (isset($errorMessage)) {
                if ($errorMessage['error_type'] == 'password') {
                    ?> <label for="password" generated="true" class="error"><?php echo $errorMessage['status']; ?></label> <?php
                }
            }
            ?>
      </div>
        </div>
        <div style="clear:both; height: 20px;"></div>
        <div class="col-xs-1">
         <button type="submit" id="btn_login" name="btn_login"  value="Continue" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <div class="col-xs-1">
            <button type="reset" id="btn_cancel" name="btn_cancel"  value="Cancel" class="btn btn-warning btn-block btn-flat">Cancel</button>
        </div>
        <div class="col-xs-2">
            <a href="<?php echo base_url(); ?>admin/forgot_password" class="blue" style="font-size:14px;">Forgot Password?</a>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close(); ?>
  </div>
  <!-- /.login-box-body -->
</div>
    </div>