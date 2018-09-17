<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Questions 
        <small>Order</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Questions</a></li>
        <li class="active">Order</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'question_order/save_mapping',$attributes); ?>
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
                        <select class="form-control" id="test_id" name="test_id" required>
                            <option value="">Select an option</option>
                        </select>
                     </div>  
                    <div class="help-block with-errors"></div>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Gender</label>
                        <select class="form-control" id="gender" name="gender" required onchange="load_test_questions(this.value);">
                            <option value="">Select an option</option>
                            <option value="BOTH" <?php if($gender == 'BOTH'){ ?>selected<?php } ?>>BOTH</option>
                            <option value="MALE" <?php if($gender == 'MALE'){ ?>selected<?php } ?>>MALE</option>
                            <option value="FEMALE" <?php if($gender == 'FEMALE'){ ?>selected<?php } ?>>FEMALE</option>
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
        if($theme_id!='' && $level_id!='' && isset($question_list) && count($question_list)>0) { 
            $displaytype = $question_list[0]['displaytype'];    
        ?>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                <div class="col-md-4">
                <label>Display Type</label>                
                  <select class="form-control" id="displaytype" name="displaytype" onchange="loadorderby(this.value);">                      
                         <option value="" >-- Order By -- </option>                        
                         <option value="SHUFFLE" <?php if($displaytype=='SHUFFLE' || $displaytype=='NONE' || $displaytype=='' ){ ?> selected <?php } ?> >SHUFFLE</option>
                         <option value="ORDER" <?php if($displaytype=='ORDER' ){ ?> selected <?php } ?>>ORDER</option>
                     </select> 
                   <div  id="productnameInfo" class="err_txt"></div>
                </div>  
                  
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                 <th width="10%;">S.No</th>                        
                                 <th width="20%;">Gender</th> 
                                 <th width="60%;">Question</th>
                                 <th id="order_div"  <?php if($displaytype=='NONE' || $displaytype==''  || $displaytype=='SHUFFLE'){ ?> style="display:none; " <?php } else { ?> style="display:block; " <?php } ?> > Order </th>
                                 <th width="10%;">&nbsp;</th>
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;                 
                        foreach ($question_list as $value) { 
                            $order = $value['order'];
                            if($order!=0){
                                $order = $value['order'];
                            }else{
                                $order = '';
                            }
                            
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>  
                                <td><?php echo $value['gender']; ?></td>  
                                <td><?php echo $value['question_text']; ?></td>                       
                                <td><input type="text" name="order_<?php echo $value['question_id']; ?>" id="order_<?php echo $i; ?>" value="<?php echo $order; ?>" <?php if($displaytype=='NONE' || $displaytype==''  || $displaytype=='SHUFFLE'){ ?>  style="display:none; width:150px;"  <?php }else{ if($value['selected']==1){ ?>  style="display:block; width:150px;" <?php }else{ ?> disabled style="display:block; width:150px;"  <?php } } ?>  class="form-control selector">
                                <input type="hidden"  name="questionid[]" id="questionid_<?php echo $i; ?>" value="<?php echo $value['question_id']; ?>" <?php if($value['selected']==1){ ?> checked <?php } ?> class="revers_question" rel="<?php echo $i; ?>"  data-toggle="toggle" data-on="Enabled" data-off="Disabled" readonly="" />
                                </td>
                            </tr>                   
                        <?php $i = $i+1; } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" id="count" value="<?php echo $i; ?>" > 
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
function load_test_questions(test_id){    
    var site_url    = '<?php echo BASE_MODULE_URL;?>';
    var test_id     = $('#test_id').val();
    var theme_id    = $('#theme_id').val();
    var gender      = $('#gender').val();
    window.location=site_url+'question_order/index/'+theme_id+'/'+test_id+'/'+gender;
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
                     $("#order_"+i).prop('disabled', false);
                }                
           
          }
     }
}
jQuery(document).ready(function($) {

    var test_id = '<?php echo $level_id;?>';
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
    $('.selector').on('blur',function () {
        var current_value = $(this).val();
        if(current_value!=''){
            $(this).attr('value',current_value);
            console.log(current_value);
            if ($('.selector[value="' + current_value + '"]').not($(this)).length > 0 || current_value.length == 0 ){
            $(this).focus();
            alert('Please check the order'+current_value+' is assigned to other question.. ');
            $(this).val('');
            }
        }
    });
});
    
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