<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sub Theme Questions
        <small>Weightage</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sub Theme Questions</a></li>
        <li class="active">Weghtage</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'sub_theme_questions/save_mapping',$attributes); ?>
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
                    <label>Level</label>
                        <select class="form-control" id="test_id" name="test_id" required onchange="load_sub_theme(this.value);">
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                    <div class="help-block with-errors"></div>
                </div> 
                 
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id" name="sub_theme_id" required onchange="load_assessment_test(this.value);">
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
        if($sub_theme_id!='' && isset($question_list) && count($question_list)>0) { 
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
                                 <th width="80%;">Question</th>                       
                                 <th width="20%;">Weightage</th>
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;       
                        foreach ($question_list as $value) { 
                            $current_weightage = $value['question_weightage'];
                            if($current_weightage == "0.00"){
                                $current_weightage = "";
                            }
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>                      
                                <td><?php echo $value['question_text']; ?></td>                       
                                <td>
                                    <div class="form-group"> <!-- onblur="return validate_weightage();" -->
                                    <input class="form-control"  type="text" name="weightage_<?php echo $value['question_id']; ?>" id="order_<?php echo $i; ?>" value="<?php echo $current_weightage; ?>" style="width:200px;" class="form-control" required max="100" min="0" maxlength="4" > <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_<?php $i;?>"></div>
                                </div>
                                    <input type="hidden"  name="questionid[]" id="questionid_<?php echo $i; ?>" value="<?php echo $value['question_id']; ?>"/>
                                    
                                    
                                    </td>
                                
                            </tr>                   
                        <?php $i++; } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" id="count" value="<?php echo count($question_list); ?>" > 
                </div>
                  <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_error"></div>
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
                <!-- onclick="return validate_weightage();" -->
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save" >Save</button>
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
function load_assessment_test(sub_theme_id){    
    var site_url    = '<?php echo BASE_MODULE_URL;?>';
    var test_id     = $('#test_id').val();
    var theme_id    = $('#theme_id').val();
    window.location=site_url+'sub_theme_questions/index/'+theme_id+'/'+test_id+'/'+sub_theme_id;
}
function loadorderby(order_by){ 
    if(order_by=='SHUFFLE' || order_by=='NONE'){
       $('#order_div').hide(); 
       var count = $('#count').val(); 
       for(i=1;i<=count;i++){
         $("#order_"+i).hide();
       }
    }
    if(order_by=='ORDER'){
          $('#order_div').show(); 
          var count = $('#count').val();
          for(i=1;i<=count;i++)
          {          
               if ($('#testid_'+i+':checked').val() !== undefined) {
                    $("#order_"+i).show();
                    $("#order_"+i).prop('disabled', false);
                } else {
                     $("#order_"+i).show();
                    $("#order_"+i).prop('disabled', true);
                }                
           
          }
     }
}
jQuery(document).ready(function($) {

var test_id = '<?php echo $test_id;?>';
var sub_theme_id_val = '<?php echo $sub_theme_id;?>';
load_sub_theme(test_id,sub_theme_id_val)
var theme_id_val = '<?php echo $theme_id;?>';
load_levels(theme_id_val,test_id);
 
jQuery(".revers_question").change(function() {
            if($(this).is(':checked')){
              if(jQuery("#displaytype").val()=='ORDER')  {
                        var id= $(this).attr('rel');
                         $("#order_"+id).prop('disabled', false);
                         $("#order_"+id).show();
               }          
            }else{
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
            return false;
        }
      
    }
var test_id = '<?php echo $test_id;?>';
function load_sub_theme(test_id,sub_theme_id=''){
    $.getJSON( common_url+'load_sub_theme/'+test_id, function( data ) { 
        if(sub_theme_id!=''){
              render_dropdow_selected(data,'sub_theme_id',sub_theme_id); 
        }else{
            render_dropdown(data,'sub_theme_id'); 
        }
    });
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