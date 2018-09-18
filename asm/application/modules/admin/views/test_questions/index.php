<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Test Questions
        <small>Mapping</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Test Questions</a></li>
        <li class="active">Mapping</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'test_questions/save_mapping',$attributes); ?>
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
                    <label>Test</label>
                        <select class="form-control" id="test_id" name="test_id" required onchange="load_dimension_questions();">
                            <option value="">Select an option</option>
                              <?php
                              foreach($tests_list as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->test_id; ?>" <?php if($test_id == $value->test_id) { echo "selected=selected"; } ?>><?php echo $value->test_name; ?></option>
                            <?php } ?>
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
        if($test_id!='' && isset($questions_list) && count($questions_list)>0) { 
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
                                 <th width="5%;">S.No</th>     
                                 <th width="10%;">Dimension</th>
                                 <th width="60%;">Question</th>                       
                                 <th id="order_div" width="15%;"> Weightage </th>
                                 <th width="10%;">&nbsp;</th>
                                 
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;           
                        foreach ($questions_list as $value) { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>   
                                <td><?php echo $value['dimension_name']; ?></td> 
                                <td><?php echo $value['question_text']; ?></td> 
                                
                                <td><input type="text" name="order_<?php echo $value['question_id']; ?>" id="order_<?php echo $i; ?>" value="<?php echo $value['question_weightage']; ?>" class="form-control" <?php  if($value['selected']==1){ ?>  style="display:block;" <?php }else{ ?> disabled style="display:block;"  <?php } ?>  onblur="return validate_weightage();"> <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_<?php $i;?>"></div></td>
                                
                                <td><input type="checkbox"  name="questionid[]" id="questionid_<?php echo $i; ?>" value="<?php echo $value['question_id']; ?>" <?php if($value['selected']==1){ ?> checked <?php } ?> class="revers_question" rel="<?php echo $i; ?>"  data-toggle="toggle" data-on="Enabled" data-off="Disabled"  />
                                   <input type="hidden" name="dimension_<?php echo $value['question_id']; ?>"  value="<?php echo $value['dimension_id']; ?>" />
                                
                                </td>                            
                            </tr>                   
                        <?php $i = $i+1; } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" id="count" value="<?php  echo count($questions_list); ?>" > 
                </div> 
                  <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_error"></div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php } ?>
        
        <?php if($test_id!='' && isset($questions_list) && count($questions_list)>0) {  ?>
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
    //var dimension_id = $('#dimension_id').val();
    //if(test_id != '' && dimension_id!=''){
    if(test_id != ''){
        //window.location=site_url+'test_questions/index/'+test_id+'/'+dimension_id;
        window.location=site_url+'test_questions/index/'+test_id;
    }
}

jQuery(document).ready(function($) {
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
  
  </script>