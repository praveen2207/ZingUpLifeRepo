<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sub Theme Weightage
        <small>Mapping</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sub Theme Weightage</a></li>
        <li class="active">Mapping</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'sub_theme_test_weightage/save_mapping',$attributes); ?>
    <input type="hidden" id="test_id_val" name="test_id_val" value="<?php echo $test_id; ?>">
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
                        <select class="form-control" id="theme_id" name="theme_id" required onchange="load_levels(this.value);">
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
                    <label>Levels</label>
                        <select class="form-control" id="test_id" name="test_id" required onchange="load_dimension_questions();">
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                </div> 
<!--                <div class="col-md-4">
                    <div class="form-group">
                    <label>Dimension</label>
                        <select class="form-control" id="dimension_id" name="dimension_id" required onchange="load_dimension_questions();">
                            <option value="">Select an option</option>
                              <?php
                              //foreach($dimension_list as $k=>$value) {
                              ?>
                              <option value="<?php //echo $value->dimension_id; ?>" <?php //if($dimension_id == $value->dimension_id) { //echo "selected=selected"; } ?>><?php //echo $value->dimension_name; ?></option>
                            <?php //} ?>
                        </select>
                     </div>  
                </div>-->
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php 
        if($test_id!='' && isset($sub_theme_list) && count($sub_theme_list)>0) { 
        ?>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%;">S.No</th>     
                                <th width="50%;">Sub Theme</th>
                                <th id="order_div" width="20%;"> Weightage(%) </th>
                                <th width="20%;">&nbsp;</th>
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;           
                        foreach ($sub_theme_list as $value) { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>   
                                <td><?php echo $value['sub_theme_name']; ?></td> 
                                
                                <td><input type="text" name="order_<?php echo $value['sub_theme_id']; ?>" id="order_<?php echo $i; ?>" value="<?php echo $value['weightage']; ?>" class="form-control" <?php  if($value['selected']==1){ ?>  style="display:block;" <?php }else{ ?> disabled style="display:block;"  <?php } ?>  onblur="return validate_weightage();"> <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_<?php $i;?>"></div></td>
                                
                                <td><input type="checkbox"  name="subthemeid[]" id="questionid_<?php echo $i; ?>" value="<?php echo $value['sub_theme_id']; ?>" <?php if($value['selected']==1){ ?> checked <?php } ?> class="revers_question" rel="<?php echo $i; ?>"  data-toggle="toggle" data-on="Enabled" data-off="Disabled"  />
                                
                                </td>                            
                            </tr>                   
                        <?php $i = $i+1; } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" id="count" value="<?php  echo count($sub_theme_list); ?>" > 
                </div> 
                  <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_error"></div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php } ?>
        
        <?php if($test_id!='' && isset($sub_theme_list) && count($sub_theme_list)>0) {  ?>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-lg-12 " >
            <div class="box-footer centered">
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save" onclick="return validate_weightage();">Save</button>
              </div>
        </div>
        <?php } ?>
        <!--/.col (right) -->
        <?php echo form_close(); ?>
      </div>
        
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
function load_dimension_questions(){    
    var site_url = '<?php echo BASE_MODULE_URL;?>';
    var test_id = $('#test_id').val();
    var theme_id = $('#theme_id').val();
    if(test_id != ''){
        window.location=site_url+'sub_theme_test_weightage/index/'+theme_id+'/'+test_id;
    }
}

jQuery(document).ready(function($) {
var test_id = '<?php echo $test_id;?>';
var theme_id_val = '<?php echo $theme_id;?>';
load_levels(theme_id_val,test_id);
jQuery(".revers_question").change(function() {
            if($(this).is(':checked')){
                var id= $(this).attr('rel');
                 $("#order_"+id).prop('disabled', false);
                 $("#order_"+id).show();
            }else{
                var id= $(this).attr('rel');
                $("#order_"+id).val('');
                 $("#order_"+id).html("");
                validate_weightage();
                var id= $(this).attr('rel');
                 $("#order_"+id).prop('disabled', true);
            }
        });
  });
  function validate_weightage(){
        var total_percentage = 0;
        var count = $('#count').val();
        for(i=1;i<=count;i++){
            var percentage = $("#order_"+i).val();
            if(percentage > 100 || percentage <0){
                //alert("Weghtage should be 0 to 100");
                $("#percentage_"+i).html("Please make sure that weightage should be 0 to 100");
                $("#order_"+i).val('');
                return false;
            }else{
                $("#percentage_"+i).html("");
            }
            if(percentage!=''){
                total_percentage=parseFloat(total_percentage)+parseFloat(percentage);
            }   
        }
        if(total_percentage >0 ){
            if(total_percentage<100){
                var remaining_percentage = 100 - total_percentage;
                $("#percentage_error").html("Please make sure that sum of the weightage should be equal to 100%. <br> Filled  Percentage : "+total_percentage+"% <br> Remaining Percentage to be filled :"+remaining_percentage+"%");
                return false;
            }else if(total_percentage>100){
                var exceeded_percentage = 100 - total_percentage ;
               $("#percentage_error").html("Please make sure that sum of the weightage should be equal to 100%. <br> Filled Percentage : "+total_percentage+"% <br> Percenteage to be adjust : "+exceeded_percentage+"%");
                return false;   

            }else{
               $("#percentage_error").text("");
               return true;  
            }
        }else{
            $("#percentage_error").html("Select atleast one question and make sure that sum of the weightage should be 100");
            return false;
        }
      
    }
    var theme_id = '<?php echo $theme_id;?>';
    function load_levels(theme_id,test_id=''){
        $.getJSON( common_url+'load_lelvels/'+theme_id, function( data ) { 
            if(test_id!=''){
                   render_dropdow_selected(data,'test_id',test_id); 
            }else{
                render_dropdown(data,'test_id'); 
            }
        });
    }
  </script>