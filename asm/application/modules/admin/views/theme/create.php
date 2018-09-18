<?php
    // pre populate data in post-back and edit secreen.
    $theme_id      = (isset($assessment[0]->theme_id) && $assessment[0]->theme_id != '0') ? $assessment[0]->theme_id : (isset($_POST['theme_id']) ? $_POST['theme_id'] : '0');
    
    $theme_name    = (isset($assessment[0]->theme_name) && $assessment[0]->theme_name != '') ? $assessment[0]->theme_name : (isset($_POST['theme_name']) ? $_POST['theme_name'] : '');
    
    $theme_type = (isset($assessment[0]->theme_type) && $assessment[0]->theme_type != '') ? $assessment[0]->theme_type : (isset($_POST['theme_type']) ? $_POST['theme_type'] : '');
   
    $theme_code    = (isset($assessment[0]->theme_code) && $assessment[0]->theme_code != '') ? $assessment[0]->theme_code : (isset($_POST['theme_code']) ? $_POST['theme_code'] : '');
    
    $active         = (isset($assessment[0]->is_active)) ? $assessment[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
    $theme_image_url = (isset($assessment[0]->bg_image) && $assessment[0]->bg_image != '') ? $assessment[0]->bg_image : (isset($_POST['theme_image']) ? $_POST['theme_image'] : '');
?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Theme
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Theme</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php
        $attributes = array('data-toggle' => 'validator','enctype' => 'multipart/form-data');
    echo form_open(BASE_MODULE_URL.'theme/'.$action,$attributes); ?>
    <input type="hidden" id="theme_id" name="theme_id" value="<?php echo $theme_id; ?>">
    <input type="hidden" id="removed_image" name="removed_image" value="0">

        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Theme Type</label>
                    <select class="form-control" name="theme_type" id="theme_type">
                      <option value="">Select an option</option>
                      <option value="init" <?php if($theme_type=='init'){?>selected<?php }?>>Init</option>
                     </select>
                    
                     </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Theme Name <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="theme_name" id="theme_name" placeholder="Name" value="<?php echo $theme_name;?>" required data-validation="length alphanumeric" data-validation-length="min4">
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Theme Code <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="theme_code" id="theme_code" placeholder="Code" value="<?php echo $theme_code;?>" required>
                        <?php echo form_error('theme_code'); ?>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div style="clear:both;"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Theme Image</label>
                        <input type="file" name="theme_image" id="theme_image" accept="image/*">
                        <div class="help-block with-errors"></div>
                        <div id="image_div">
                            <?php if($theme_image_url!=''){ ?>
                            <img src="<?php echo $theme_image_url;?>"  style="width:100px;"/>
                            <a href="javascript:void(0);" onclick="delete_image()">Remove</a>
                            <?php } ?>
                            
                        </div>
                        
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
  <script>
  function delete_image(){
        $('#image_div').html('');
        $('#removed_image').val('1');
  }
  </script>