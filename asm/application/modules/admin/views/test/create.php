<?php
    // pre populate data in post-back and edit secreen.
    $test_id      = (isset($test[0]->test_id) && $test[0]->test_id != '0') ? $test[0]->test_id : (isset($_POST['test_id']) ? $_POST['test_id'] : '0');
    
    $theme_id      = (isset($test[0]->theme_id) && $test[0]->theme_id != '0') ? $test[0]->theme_id : (isset($_POST['theme_id']) ? $_POST['theme_id'] : '0');
    
    $test_name    = (isset($test[0]->test_name) && $test[0]->test_name != '') ? $test[0]->test_name : (isset($_POST['test_name']) ? $_POST['test_name'] : '');
    
   
    $test_code    = (isset($test[0]->test_code) && $test[0]->test_code != '') ? $test[0]->test_code : (isset($_POST['test_code']) ? $_POST['test_code'] : '');
    
    
    $test_description    = (isset($test[0]->test_description) && $test[0]->test_description != '') ? $test[0]->test_description : (isset($_POST['test_description']) ? $_POST['test_description'] : '');
    
   /* $test_duration    = (isset($test[0]->test_duration) && $test[0]->test_duration != '') ? $test[0]->test_duration : (isset($_POST['test_duration']) ? $_POST['test_duration'] : '');
    
    $test_questions    = (isset($test[0]->total_questions) && $test[0]->total_questions != '') ? $test[0]->total_questions : (isset($_POST['test_questions']) ? $_POST['test_questions'] : ''); */
    
    $active         = (isset($test[0]->is_active)) ? $test[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Theme Level
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
    echo form_open(BASE_MODULE_URL.'test/'.$action,$attributes); ?>
    <input type="hidden" id="test_id" name="test_id" value="<?php echo $test_id; ?>">
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
                        <label>Level Name <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="test_name" id="test_name" placeholder="Name" value="<?php echo $test_name;?>" required>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Level Code <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="test_code" id="test_code" placeholder="Code" value="<?php echo $test_code;?>" required>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('test_code'); ?>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Level Description</label>
                        <textarea class="form-control" type="text" name="test_description" id="test_description" placeholder="Description"> <?php echo $test_description;?></textarea>
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