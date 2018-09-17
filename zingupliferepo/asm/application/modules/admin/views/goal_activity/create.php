<?php
    // pre populate data in post-back and edit secreen.
    $goal_activity_id      = (isset($goal_activity[0]->goal_activity_id) && $goal_activity[0]->goal_activity_id != '0') ? $goal_activity[0]->goal_activity_id : (isset($_POST['goal_activity_id']) ? $_POST['goal_activity_id'] : '0');
    
    $goal_activity_name    = (isset($goal_activity[0]->activity_name) && $goal_activity[0]->activity_name != '') ? $goal_activity[0]->activity_name : (isset($_POST['goal_activity_name']) ? $_POST['goal_activity_name'] : '');
    
    $goal_activity_description    = (isset($goal_activity[0]->activity_description) && $goal_activity[0]->activity_description != '') ? $goal_activity[0]->activity_description : (isset($_POST['goal_activity_description']) ? $_POST['goal_activity_description'] : '');

    $active         = (isset($goal_activity[0]->is_active)) ? $goal_activity[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Goal Activity
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Goal Activity</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php
    $attributes = array('data-toggle' => 'validator','enctype' => 'multipart/form-data');
        echo form_open(BASE_MODULE_URL.'goal_activity/'.$action,$attributes); ?>
    <input type="hidden" id="goal_activity_id" name="goal_activity_id" value="<?php echo $goal_activity_id; ?>">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Activity <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="goal_activity_name" id="goal_activity_name" placeholder="Activity Name" required value="<?php echo $goal_activity_name;?>"/>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('goal_activity_name'); ?>
                    </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Goal Activity Description</label>
                        <textarea class="form-control" type="text" name="goal_activity_description" id="goal_activity_description" placeholder="Description"> <?php echo $goal_activity_description;?></textarea>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('goal_activity_description'); ?>
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
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save"><?php echo $action_button_text; ?></button>
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
     var action = '<?php echo $action;?>';
    $(document).ready(function() {
          load_goals('<?php echo $goal_segment_id;?>','goal_id');
    });
    function load_goals(goal_id,destination_id){
        $.getJSON( common_url+'load_goal/'+goal_id, function( data ) { 
            if(action=='edit'){
               render_dropdow_selected(data,destination_id,'<?php echo $goal_id;?>'); 
           }
           if(action=='create'){
               render_dropdown(data,destination_id); 
           }    

        });  
    }
  </script>