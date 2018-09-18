<?php
    // pre populate data in post-back and edit secreen.
    $advice_id      = (isset($advice[0]->advice_id) && $advice[0]->advice_id != '0') ? $advice[0]->advice_id : (isset($_POST['advice_id']) ? $_POST['advice_id'] : '0');
    
    $advice_type = (isset($advice[0]->advice_type) && $advice[0]->advice_type != '') ? $advice[0]->advice_type : (isset($_POST['advice_type']) ? $_POST['advice_type'] : '');
	
    $advice_source = (isset($advice[0]->advice_source) && $advice[0]->advice_source != '') ? $advice[0]->advice_source : (isset($_POST['advice_source']) ? $_POST['advice_source'] : '');
    
    $advice_description    = (isset($advice[0]->advice_description) && $advice[0]->advice_description != '') ? $advice[0]->advice_description : (isset($_POST['advice_description']) ? $_POST['advice_description'] : '');
      
   $goal_id    = (isset($advice[0]->goal_id) && $advice[0]->goal_id != '') ? $advice[0]->goal_id : (isset($_POST['goal_id']) ? $_POST['goal_id'] : '');
    
    $active         = (isset($advice[0]->is_active)) ? $advice[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advice
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Advice</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php
        $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'advice/'.$action,$attributes); ?>
    <input type="hidden" id="advice_id" name="advice_id" value="<?php echo $advice_id; ?>">
    <input type="hidden" id="goal_id_val" name="goal_id_val" value="<?php echo $goal_id; ?>">
    
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Goal Segment </label>
                        <select class="form-control" id="segment_id" name="segment_id" onchange="load_goals(this.value);">
                            <option value="">Select an option</option>
                              <?php
                              foreach($segment_list as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->goal_segment_id; ?>" <?php if($segment_id == $value->goal_segment_id) { echo "selected=selected"; } ?>><?php echo $value->segment_name; ?></option>
                            <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>
                     </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Goal </label>
                        <select class="form-control" id="goal_id" name="goal_id" >
                            <option value="">Select an option</option>
                        </select>
                        <div class="help-block with-errors"></div>
                     </div>  
                    
                </div>   
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Advice Source</label>
                    <select class="form-control" name="advice_source" id="advice_source">
                      <option value="">Select an option</option>
                      <option value="prism" <?php if($advice_source=='prism'){?>selected<?php }?>>Prism</option>
                      <option value="practitioner" <?php if($advice_source=='practitioner'){?>selected<?php }?>>Practitioner</option>
                     </select>
                     </div>  
                </div> 
				<div style="clear:both"></div>
				<div class="col-md-4">
                    <div class="form-group">
                    <label>Advice Type <span class="mandatory_class">*</span></label>
                    <input class="form-control" type="text" name="advice_type" id="advice_type" placeholder="Advice Type" required value="<?php echo $advice_type;?>"/>
                    <div class="help-block with-errors"></div>
                     </div>  
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Advice Description <span class="mandatory_class">*</span></label>
                        <textarea class="form-control" type="text" name="advice_description" id="advice_description" placeholder="Adcvice Description" required> <?php echo $advice_description;?></textarea>
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
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save" value="<?php echo $action_button_text;?>"><?php echo $action_button_text;?></button>
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
    var segment_id = '<?php echo $segment_id;?>';
    //-----------------------------------------------------------------------------------------
    function load_goals(segment_id,goal_id=''){    
        
        $.getJSON( common_url+'load_goals/'+segment_id, function( data ) { 
            if(goal_id!=''){
                   render_dropdow_selected(data,'goal_id',goal_id); 
            }else{
                render_dropdown(data,'goal_id'); 
            }
        });  
    }
    //-----------------------------------------------------------------------------------------
    jQuery(document).ready(function($) {
        var segment_id = $("#segment_id").val();
        var goal_id = $("#goal_id_val").val();
        if(segment_id!='' && goal_id!=''){
            load_goals(segment_id,goal_id);
        }
    });
    //-----------------------------------------------------------------------------------------
    </script>