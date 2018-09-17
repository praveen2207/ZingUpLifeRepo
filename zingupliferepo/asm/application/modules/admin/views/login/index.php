<?php
    // pre populate data in post-back and edit secreen.
    $username   =  isset($_POST['username']) ? $_POST['username'] : '';
?>

<div class="login-box">
  <div class="login-box-body">
      <p class="login-box-msg login-logo">Assessment
      <div class="login-logo">
    <b>LOGIN</b>
  </div></p>
    <?php echo form_open(BASE_MODULE_URL.'login/index'); ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="<?php echo $username; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
<!--          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="btn_login" name="btn_login" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close(); ?>
    <a href="#">I forgot my password</a><br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- Content End -->


