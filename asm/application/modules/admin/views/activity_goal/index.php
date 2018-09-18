<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Activity Goal
        <small>Mapping</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Activity Goal</a></li>
        <li class="active">Mapping</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'activity_goal/save_mapping',$attributes); ?>
        <!-- left column -->
        <div class="col-md-12">
        <?php if($this->session->flashdata('message')){?>
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <!--    <h4><i class="icon fa fa-check"></i> Alert!</h4>-->
                <?php echo $this->session->flashdata('message')?>
            </div>
        <?php } ?>
        <?php if($this->session->flashdata('error-message')){?>
           <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('error-message')?>
            </div>
        <?php } ?>
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Goal Segment <span class="mandatory_class">*</span></label>
                        <select class="form-control" id="segment_id" name="segment_id" required onchange="load_goals(this.value);">
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
                    <label>Goal <span class="mandatory_class">*</span></label>
                        <select class="form-control" id="goal_id" name="goal_id" required onchange="load_activity_goals(this.value);">
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                    <div class="help-block with-errors"></div>
                </div> 
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php 
        if($segment_id!='' && $goal_id!='' &&  isset($activity_list) && count($activity_list)>0) { 
        ?>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-12">
                    <table class="table" style="font-size:14px;">
                        <thead>
                            <tr>
                                 <th width="5%;">S.No</th>
                                 <th width="40%;">Activity</th>
                                 <th width="40%;">Activity Description</th>
                                 <th width="15%;">Action</th>
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;                 
                        foreach ($activity_list as $value) { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>                      
                                <td><?php echo $value['activity_name']; ?></td>
                                <td><?php echo $value['activity_description']; ?></td>
                                <td><input type="checkbox"  name="activity_id[]" id="activity_<?php echo $i; ?>" value="<?php echo $value['goal_activity_id']; ?>" <?php if($value['selected']==1){ ?> checked <?php } ?> class="revers_question" rel="<?php echo $i; ?>"  data-toggle="toggle" data-on="Enabled" data-off="Disabled"  /></td>                            </tr>
                        <?php $i = $i+1; } ?>
                        </tbody>
                    </table>
                <input type="hidden" name="count" id="count" value="<?php echo $i; ?>" > 
                <input type="hidden" name="segment_id" id="segment_id" value="<?php echo $segment_id; ?>" >
                <input type="hidden" name="goal_id_val" id="goal_id_val" value="<?php echo $goal_id; ?>" >
                </div> 
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php } ?>
        
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-lg-12 " >
            <div class="box-footer centered">
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save">Save</button>
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
function load_activity_goals(goal_id){
    var site_url = '<?php echo BASE_MODULE_URL;?>';
    var segment_id = $('#segment_id').val();
    window.location=site_url+'activity_goal/index/'+segment_id+'/'+goal_id;
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
$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
$(".alert-error").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
}); 
</script>