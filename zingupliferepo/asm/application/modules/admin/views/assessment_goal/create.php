<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Goal
        <small>Mapping</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Assessment Goal</a></li>
        <li class="active">Mapping</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php   $action = 'save';
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'assessment_goal/'.$action,$attributes); ?>
<!--    <input type="hidden" id="assessment_id" name="assessment_id" value="<?php echo $assessment_id; ?>">-->
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Theme</label>
                        <select class="form-control" id="theme_id" name="theme_id" required onchange="load_assessment_test(this.value);">
                            <option value="">Select an option</option>
                              <?php
                              foreach($assessment_list as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->theme_id; ?>" <?php if($assessment_id == $value->theme_id) { echo "selected=selected"; } ?>><?php echo $value->theme_name; ?></option>
                            <?php } ?>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Test-Level</label>
                        <select class="form-control" id="test_id" name="test_id" required onchange="load_sub_themes(this.value);">
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Goal Segment</label>
                        <select class="form-control" id="goal_segment_id" name="goal_segment_id" required onchange="load_goals(this.value);">
                            <option value="">Select an option</option>
                              <?php
                              foreach($goal_segment_data as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->goal_segment_id; ?>" <?php if($goal_segment_id == $value->goal_segment_id) { echo "selected=selected"; } ?>><?php echo $value->segment_name; ?></option>
                            <?php } ?>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Goal</label>
                        <select class="form-control" id="goal_id" name="goal_id" required>
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div>
                <div style="clear:both;"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id_1" name="sub_theme_id_1" required>
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score From </label>
                        <input class="form-control" type="text" name="score_from_1" id="score_from_1"  required/>
                     </div>  
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score To </label>
                        <input class="form-control" type="text" name="score_to_1" id="score_to_1" required/>
                     </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Score Level</label>
                        <select class="form-control" id="score_level_1" name="score_level_1" required>
                            <option value="">Select an option</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                     </div>  
                </div>  
                <div style="clear:both;"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id_2" name="sub_theme_id_2" >
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score From </label>
                        <input class="form-control" type="text" name="score_from_2" id="score_from_2"  />
                     </div>  
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score To </label>
                        <input class="form-control" type="text" name="score_to_2" id="score_to_2" />
                     </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Score Level</label>
                        <select class="form-control" id="score_level_2" name="score_level_2" >
                            <option value="">Select an option</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                     </div>  
                </div>  
                <div style="clear:both;"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id_3" name="sub_theme_id_3" >
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score From </label>
                        <input class="form-control" type="text" name="score_from_3" id="score_from_3"   />
                     </div>  
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score To </label>
                        <input class="form-control" type="text" name="score_to_3" id="score_to_3" />
                     </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Score Level</label>
                        <select class="form-control" id="score_level_3" name="score_level_3" >
                            <option value="">Select an option</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                     </div>  
                </div>  
                <div style="clear:both;"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id_4" name="sub_theme_id_4" >
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score From </label>
                        <input class="form-control" type="text" name="score_from_4" id="score_from_4"   />
                     </div>  
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score To </label>
                        <input class="form-control" type="text" name="score_to_4" id="score_to_4" />
                     </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Score Level</label>
                        <select class="form-control" id="score_level_4" name="score_level_4" >
                            <option value="">Select an option</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                     </div>  
                </div>  
                <div style="clear:both;"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id_5" name="sub_theme_id_5" >
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score From </label>
                        <input class="form-control" type="text" name="score_from_5" id="score_from_5"   />
                     </div>  
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score To </label>
                        <input class="form-control" type="text" name="score_to_5" id="score_to_5" />
                     </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Score Level</label>
                        <select class="form-control" id="score_level_5" name="score_level_5" >
                            <option value="">Select an option</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                     </div>  
                </div>  
                <div style="clear:both;"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id_6" name="sub_theme_id_6" >
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score From </label>
                        <input class="form-control" type="text" name="score_from_6" id="score_from_6"   />
                     </div>  
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Score To </label>
                        <input class="form-control" type="text" name="score_to_6" id="score_to_6" />
                     </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Score Level</label>
                        <select class="form-control" id="score_level_6" name="score_level_6" >
                            <option value="">Select an option</option>
                            <option value="HIGH">High</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="LOW">Low</option>
                        </select>
                     </div>  
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
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save" value="Save">Save</button>
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
    
var assessment_id = '<?php echo $assessment_id;?>';
function load_assessment_test(assessment_id,test_id=''){    
    $.getJSON( common_url+'load_assessment_test/'+assessment_id, function( data ) { 
        if(test_id!=''){
               render_dropdow_selected(data,'test_id',test_id); 
        }else{
            render_dropdown(data,'test_id'); 
        }
    });  
}

var test_id = '<?php echo $test_id;?>';
function load_sub_themes(test_id,sub_theme_id=''){
    $.getJSON( common_url+'load_test_sub_themes/'+test_id, function( data ) { 
        if(sub_theme_id!=''){
               render_dropdow_selected(data,'sub_theme_id',sub_theme_id); 
        }else{
            render_dropdown(data,'sub_theme_id_1'); 
            render_dropdown(data,'sub_theme_id_2'); 
            render_dropdown(data,'sub_theme_id_3'); 
            render_dropdown(data,'sub_theme_id_4'); 
            render_dropdown(data,'sub_theme_id_5'); 
            render_dropdown(data,'sub_theme_id_6'); 
        }
    });
}
var goal_segment_id = '<?php echo $goal_segment_id;?>';
function load_goals(goal_segment_id,goal_id=''){
    $.getJSON( common_url+'load_goals/'+goal_segment_id, function( data ) { 
        if(goal_id!=''){
               render_dropdow_selected(data,'goal_id',goal_id); 
        }else{
            render_dropdown(data,'goal_id'); 
        }
    });
}




function load_assessment_goals(test_id){
    var site_url = '<?php echo BASE_MODULE_URL;?>';
    var assessment_id = $('#assessment_id').val();
    window.location=site_url+'assessment_goal/index/'+assessment_id+'/'+test_id;
}

jQuery(document).ready(function($) {
    var assessment_id = $("#assessment_id").val();
    var test_id = $("#test_id_val").val();
    if(assessment_id!='' && test_id!=''){
        load_assessment_test(assessment_id,test_id);
    }
});
  </script>