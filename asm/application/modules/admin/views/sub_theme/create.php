<?php
    // pre populate data in post-back and edit secreen.
    $sub_theme_id      = (isset($sub_theme[0]->sub_theme_id) && $sub_theme[0]->sub_theme_id != '0') ? $sub_theme[0]->sub_theme_id : (isset($_POST['sub_theme_id']) ? $_POST['sub_theme_id'] : '0');
    
    $theme_id      = (isset($sub_theme[0]->theme_id) && $sub_theme[0]->theme_id != '0') ? $sub_theme[0]->theme_id : (isset($_POST['theme_id']) ? $_POST['theme_id'] : '0');
    
    $sub_theme_name    = (isset($sub_theme[0]->sub_theme_name) && $sub_theme[0]->sub_theme_name != '') ? $sub_theme[0]->sub_theme_name : (isset($_POST['sub_theme_name']) ? $_POST['sub_theme_name'] : '');
    
    $active         = (isset($sub_theme[0]->is_active)) ? $sub_theme[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sub Theme
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sub Theme</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php 
     $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'sub_theme/'.$action,$attributes); ?>
    <input type="hidden" id="sub_theme_id" name="sub_theme_id" value="<?php echo $sub_theme_id; ?>">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Theme <span class="mandatory_class">*</span></label>
                        <select class="form-control" id="theme_id" name="theme_id" required>
                        <option value="">Select an option</option>
                          <?php
                          foreach($theme_data as $k=>$value) {
                          ?>
                          <option value="<?php echo $value->theme_id; ?>" <?php if($theme_id==$value->theme_id) {?> selected <?php }?>  ><?php echo $value->theme_name; ?></option>
                        <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Theme Name <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="sub_theme_name" id="sub_theme_name" placeholder="Name" value="<?php echo $sub_theme_name;?>" required>
                        <?php echo form_error('sub_theme_name'); ?>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-lg-4" >
                    <div class="form-group <?php if($action == 'create') echo 'hidden_coumn'; ?>">
                        <label for="user_name">Active</label>
                        <select class="form-control" id="active" name="active" >
                            <option value="Y" <?php if($active == 'Y') echo "selected='selected'" ?> >Yes</option>
                            <option value="N" <?php if($active == 'N') echo "selected='selected'" ?> >No</option>
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