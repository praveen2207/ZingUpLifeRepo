<?php
    // pre populate data in post-back and edit secreen.
    $goal_segment_id      = (isset($segment[0]->goal_segment_id) && $segment[0]->goal_segment_id != '0') ? $segment[0]->goal_segment_id : (isset($_POST['goal_segment_id']) ? $_POST['goal_segment_id'] : '0');
    
    $segment_name    = (isset($segment[0]->segment_name) && $segment[0]->segment_name != '') ? $segment[0]->segment_name : (isset($_POST['segment_name']) ? $_POST['segment_name'] : '');
    
    $segment_description    = (isset($segment[0]->segment_description) && $segment[0]->segment_description != '') ? $segment[0]->segment_description : (isset($_POST['segment_description']) ? $_POST['segment_description'] : '');
    
    $active         = (isset($segment[0]->is_active)) ? $segment[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Segment
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Segment</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php 
     $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'goal_segment/'.$action,$attributes); ?>
    <input type="hidden" id="goal_segment_id" name="goal_segment_id" value="<?php echo $goal_segment_id; ?>">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Segment Name <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="segment_name" id="segment_name" placeholder="Name" value="<?php echo $segment_name;?>" required>
                        <?php echo form_error('segment_name'); ?>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Segment Description</label>
                        <textarea class="form-control" type="text" name="segment_description" id="segment_description" placeholder="Description"> <?php echo $segment_description;?></textarea>
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