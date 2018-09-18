<?php
    // pre populate data in post-back and edit secreen.
    $goal_id      = (isset($goal[0]->goal_id) && $goal[0]->goal_id != '0') ? $goal[0]->goal_id : (isset($_POST['goal_id']) ? $_POST['goal_id'] : '0');
    
    $goal_segment_id    = (isset($goal[0]->goal_segment_id) && $goal[0]->goal_segment_id != '') ? $goal[0]->goal_segment_id : (isset($_POST['segment_id']) ? $_POST['segment_id'] : '');
    
    $goal_name    = (isset($goal[0]->goal_name) && $goal[0]->goal_name != '') ? $goal[0]->goal_name : (isset($_POST['goal_name']) ? $_POST['goal_name'] : '');
    
    $goal_description    = (isset($goal[0]->goal_description) && $goal[0]->goal_description != '') ? $goal[0]->goal_description : (isset($_POST['goal_description']) ? $_POST['goal_description'] : '');
    
    $active         = (isset($goal[0]->is_active)) ? $goal[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
     $gender    = (isset($goal[0]->gender) && $goal[0]->gender != '') ? $goal[0]->gender : (isset($_POST['gender']) ? $_POST['gender'] : '');
    
     $goal_image_url    = (isset($goal[0]->goal_icon) && $goal[0]->goal_icon != '') ? $goal[0]->goal_icon : (isset($_POST['goal_image']) ? $_POST['goal_image'] : '');
     
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Goal
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Goal</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php
    $attributes = array('data-toggle' => 'validator','enctype' => 'multipart/form-data');
        echo form_open(BASE_MODULE_URL.'goals/'.$action,$attributes); ?>
    <input type="hidden" id="goal_id" name="goal_id" value="<?php echo $goal_id; ?>">
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
                        <label>Segment <span class="mandatory_class">*</span></label>
                        <select class="form-control" id="goal_segment_id" name="goal_segment_id" required>
                        <option value="">Select an option</option>
                          <?php
                          foreach($goal_segment_data as $k=>$value) {
                          ?>
                          <option value="<?php echo $value->goal_segment_id; ?>" <?php if($goal_segment_id==$value->goal_segment_id) {?> selected <?php }?>  ><?php echo $value->segment_name; ?></option>
                        <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('goal_segment_id'); ?>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Goal <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="goal_name" id="goal_name" placeholder="Goal Name" required value="<?php echo $goal_name;?>"/>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('goal_name'); ?>
                    </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Goal Description</label>
                        <textarea class="form-control" type="text" name="goal_description" id="goal_description" placeholder="Description"> <?php echo $goal_description;?></textarea>
                        <?php echo form_error('goal_description'); ?>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Goal Activities</label>
                        <?php //echo "<pre>";
                       // print_r($goal_activities);
                        
                        ?>
                        <select name="goal_activities[]" id="goal_activities" class="form-control select2" multiple="multiple">
                        <?php
                          foreach($goal_activity_data as $k=>$value) {
                              $selected = '';
                            foreach($goal_activities as $goal_activity){
                                if($goal_activity->activity_id == $value->goal_activity_id){
                                    $selected = "selected=selected";
                                }
                            }
                                                    
                              
                        ?>
                          <option value="<?php echo $value->goal_activity_id; ?>" <?php echo $selected;?> ><?php echo $value->activity_name; ?></option>
                        <?php } ?>
                        </select>
                        
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" id="gender" >
                            <option value="">Select an option</option>
                            <option value="MALE" <?php if($gender=='MALE'){ ?>selected<?php } ?>>MALE</option>
                            <option value="FEMALE" <?php if($gender=='FEMALE'){ ?>selected<?php } ?>>FEMALE</option>
                            <option value="BOTH" <?php if($gender=='BOTH'){ ?>selected<?php } ?>>BOTH</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Goal Image</label>
                        <input type="file" name="goal_image" id="goal_image" accept="image/*">
                        <div class="help-block with-errors"></div>
                        <div id="image_div">
                            <?php if($goal_image_url!=''){ ?>
                            <img src="<?php echo $goal_image_url;?>"  style="width:100px;"/>
                            <a href="javascript:void(0);" onclick="delete_image('')">Remove</a>
                            <?php } ?>
                            
                        </div>
                        
                    </div>  
                </div>
                <div style="clear:both;"></div>
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