<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Theme Test
        <small>Mapping</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Theme Test</a></li>
        <li class="active">Mapping</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'theme_test/save_mapping',$attributes); ?>
    <input type="hidden" id="theme_id" name="theme_id" value="<?php echo $theme_id; ?>">
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
                        <select class="form-control" id="theme_id" name="theme_id" required onchange="load_theme_test(this.value);">
                            <option value="">Select an option</option>
                              <?php
                              foreach($theme_list as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->theme_id; ?>" <?php if($theme_id == $value->theme_id) { echo "selected=selected"; } ?>><?php echo $value->theme_name; ?></option>
                            <?php } ?>
                        </select>
                     </div>  
                </div> 
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <?php 
        if($theme_id!='' && isset($tests_list) && count($tests_list)>0) { 
            $displaytype = $tests_list[0]['displaytype'];    
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
                                 <th width="60%;">Test</th>                       
                                 <th id="order_div"  <?php if($displaytype=='NONE' || $displaytype==''  || $displaytype=='SHUFFLE'){ ?> style="display:none; " <?php } else { ?> style="display:block; " <?php } ?> > Level </th>
                                 <th width="10%;">&nbsp;</th>
                                 <th width="10%;">&nbsp;</th>
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;                 
                        foreach ($tests_list as $value) { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>                      
                                <td><?php echo $value['test_name']; ?></td>                       
                                <td><input type="text" name="order_<?php echo $value['test_id']; ?>" id="order_<?php echo $i; ?>" value="<?php echo $value['order']; ?>" <?php if($displaytype=='NONE' || $displaytype==''  || $displaytype=='SHUFFLE'){ ?>  style="display:none; width:50px;"  <?php }else{ if($value['selected']==1){ ?>  style="display:block; width:50px;" <?php }else{ ?> disabled style="display:block; width:50px;"  <?php } } ?>  class="form-control"> </td>
                                <td><input type="checkbox"  name="testid[]" id="testid_<?php echo $i; ?>" value="<?php echo $value['test_id']; ?>" <?php if($value['selected']==1){ ?> checked <?php } ?> class="revers_question" rel="<?php echo $i; ?>"  data-toggle="toggle" data-on="Enabled" data-off="Disabled"  /></td>                            </tr>                   
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
function load_theme_test(theme_id){    
    var site_url = '<?php echo BASE_MODULE_URL;?>';
    window.location=site_url+'theme_test/index/'+theme_id;
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
  </script>