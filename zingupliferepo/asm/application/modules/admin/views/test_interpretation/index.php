<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-toggle.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Interpretation
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Theme Test </a></li>
        <li class="active">Interpretation</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php  
    $attributes = array('data-toggle' => 'validator');
    echo form_open(BASE_MODULE_URL.'test_questions/save_mapping',$attributes); ?>
    <input type="hidden" id="theme_id_val" name="theme_id_val" value="<?php echo $theme_id; ?>">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Assessment</label>
                        <select class="form-control" id="theme_id" name="theme_id" onchange="load_tests();">
                            <option value="">Select an option</option>
                              <?php
                              foreach($assessment_list as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->theme_id; ?>" <?php if($theme_id == $value->theme_id) { echo "selected=selected"; } ?>><?php echo $value->theme_name; ?></option>
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
        if(isset($test_list) && count($test_list)>0) { 
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
                                 <th width="40%;">Theme</th>
                                 <th width="40%;">Level</th>
                                 <th width="15%;">Action</th>
                            </tr>
                       </thead>
                        <tbody>
                        <?php       
                        $i=1;           
                        foreach ($test_list as $value) { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>   
                                <td><?php echo $value['theme_name']; ?></td> 
                                <td><?php echo $value['test_name']; ?></td> 
                                <td>
                                <a href="<?php echo BASE_MODULE_URL;?>test_interpretation/view/<?php echo $theme_id;?>/<?php echo $value['test_id'];?>"><input type="button" class="btn btn-primary" value="View"></a>
                                <a href="<?php echo BASE_MODULE_URL;?>test_interpretation/add/<?php echo $theme_id;?>/<?php echo $value['test_id'];?>"><input type="button" class="btn btn-primary" value="Add"></a>
                                    
                                </td>                            
                            </tr>                   
                        <?php $i = $i+1; } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" id="count" value="<?php  echo count($test_list); ?>" > 
                </div> 
                  <div class="help-block with-errors" style="color: #dd4b39;" id="percentage_error"></div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
function load_tests(){    
    var site_url = '<?php echo BASE_MODULE_URL;?>';
    var theme_id = $('#theme_id').val();
    if(theme_id != ''){
        window.location=site_url+'test_interpretation/index/'+theme_id;
    }else{
        window.location=site_url+'test_interpretation/index';
    }
}
</script>