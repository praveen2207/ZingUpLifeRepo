<?php
    // pre populate data in post-back and edit secreen.
    $user_id      = (isset($user[0]->user_id) && $user[0]->user_id != '0') ? $user[0]->user_id : (isset($_POST['user_id']) ? $_POST['user_id'] : '0');
    $username    = (isset($user[0]->username) && $user[0]->username != '') ? $user[0]->username : (isset($_POST['username']) ? $_POST['username'] : '');
    $first_name    = (isset($user[0]->first_name) && $user[0]->first_name != '') ? $user[0]->first_name : (isset($_POST['first_name']) ? $_POST['first_name'] : '');
    $last_name    = (isset($user[0]->last_name) && $user[0]->last_name != '') ? $user[0]->last_name : (isset($_POST['last_name']) ? $_POST['last_name'] : '');
    $user_email    = (isset($user[0]->email) && $user[0]->email != '') ? $user[0]->email : (isset($_POST['user_email']) ? $_POST['user_email'] : '');
    $user_contact_no    = (isset($user[0]->contact_no) && $user[0]->contact_no != '') ? $user[0]->contact_no : (isset($_POST['user_contact_no']) ? $_POST['user_contact_no'] : '');
    $user_type    = (isset($user[0]->user_type) && $user[0]->user_type != '') ? $user[0]->user_type : (isset($_POST['user_type']) ? $_POST['user_type'] : '');
    
    $active         = (isset($user[0]->active)) ? $user[0]->active : (isset($_POST['active']) ? $_POST['active'] : '1');
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php 
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'user/'.$action,$attributes); ?>
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>User Type <span class="mandatory_class">*</span></label>
                    <select class="form-control" name="user_type" id="user_type">
                      <option value="">Select Admin role</option>
                      <option value="0" <?php if($user_type==0){?>selected<?php }?>>Super Admin</option>
                      <option value="1" <?php if($user_type==1){?>selected<?php }?>>Content Writer</option>
                      <option value="2" <?php if($user_type==2){?>selected<?php }?>>Data Upload</option>
                     </select>  
                     <div class="help-block with-errors"></div>
                     </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>First Name <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="FirstName" value="<?php echo $first_name;?>" required>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="LastName" value="<?php echo $last_name;?>">
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>User Name <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="UserName" value="<?php echo $username;?>" required>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('username'); ?>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="user_email" id="user_email" placeholder="Email" value="<?php echo $user_email;?>">
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Password <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="user_password" id="user_password" placeholder="Password" required>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Contact No</label>
                        <input class="form-control" type="text" name="user_contact_no" id="user_contact_no" placeholder="Contact No" value="<?php echo $user_contact_no;?>" maxlength="10">
                    </div>  
                </div>
                <div class="col-lg-4" >
                    <div class="form-group <?php if($action == 'create') echo 'hidden_coumn'; ?>">
                        <label for="user_name">Active</label>
                        <select class="form-control" id="active" name="active" >
                            <option value="1" <?php if($active == '1') echo "selected='selected'" ?> >Yes</option>
                            <option value="0" <?php if($active == '0') echo "selected='selected'" ?> >No</option>
                        </select>

                    </div>
                </div>  
                  
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-lg-12 " >
            <div class="box-footer centered">
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save"><?php echo $action_button_text;?></button>
              </div>
        </div>
        <!--/.col (right) -->
        <?php echo form_close(); ?>
      </div>
        
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->