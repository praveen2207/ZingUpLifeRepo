<?php
    // pre populate data in post-back and edit secreen.
    $interpretation_id      = (isset($interpretation[0]->interpretation_id) && $interpretation[0]->interpretation_id != '0') ? $interpretation[0]->interpretation_id : (isset($_POST['interpretation_id']) ? $_POST['interpretation_id'] : '0');
    
    $interpretation_text      = (isset($interpretation[0]->interpretation_text) && $interpretation[0]->interpretation_text != '') ? $interpretation[0]->interpretation_text : (isset($_POST['interpretation_text']) ? $_POST['interpretation_text'] : '');
    
    $score_from    = (isset($interpretation[0]->score_from) && $interpretation[0]->score_from != '') ? $interpretation[0]->score_from : (isset($_POST['score_from']) ? $_POST['score_from'] : '');
    
    $score_to    = (isset($interpretation[0]->score_to) && $interpretation[0]->score_to != '') ? $interpretation[0]->score_to : (isset($_POST['score_to']) ? $_POST['score_to'] : '');
    
    $ideal_image_url    = (isset($interpretation[0]->ideal_image) && $interpretation[0]->ideal_image != '') ? $interpretation[0]->ideal_image : (isset($_POST['ideal_image']) ? $_POST['ideal_image'] : '');
    
    $score_image_url    = (isset($interpretation[0]->score_image) && $interpretation[0]->score_image != '') ? $interpretation[0]->score_image : (isset($_POST['score_image']) ? $_POST['score_image'] : '');
    
    $active         = (isset($interpretation[0]->is_active)) ? $interpretation[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
 
    $sub_theme_id = (isset($interpretation[0]->sub_theme_id) && $interpretation[0]->sub_theme_id != '') ? $interpretation[0]->sub_theme_id : (isset($_POST['sub_theme_id']) ? $_POST['sub_theme_id'] : '');
    
    $gender    = (isset($interpretation[0]->gender) && $interpretation[0]->gender != '') ? $interpretation[0]->gender : (isset($_POST['gender']) ? $_POST['gender'] : '');
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Interpretation
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Interpretation</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php
    $attributes = array('data-toggle' => 'validator','enctype' => 'multipart/form-data');
        echo form_open(BASE_MODULE_URL.'test_interpretation/'.$action,$attributes); ?>
    <input type="hidden" id="interpretation_id" name="interpretation_id" value="<?php echo $interpretation_id; ?>">
    <input type="hidden" id="theme_id" name="theme_id" value="<?php echo $theme_id; ?>">
    <input type="hidden" id="test_id" name="test_id" value="<?php echo $test_id; ?>">
    <input type="hidden" id="removed_ideal" name="removed_ideal" value="0">
    <input type="hidden" id="removed_score" name="removed_score" value="0">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Theme</label>
                        <select class="form-control" id="sub_theme_id" name="sub_theme_id">
                        <option value="">Select an option</option>
                          <?php
                          foreach($sub_theme_data as $k=>$value) {
                          ?>
                          <option value="<?php echo $value->sub_theme_id; ?>" <?php if($sub_theme_id==$value->sub_theme_id) {?> selected <?php }?>  ><?php echo $value->sub_theme_name; ?></option>
                        <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">Select an option</option>
                            <option value="MALE" <?php if($gender=='MALE'){ ?>selected<?php } ?>>MALE</option>
                            <option value="FEMALE" <?php if($gender=='FEMALE'){ ?>selected<?php } ?>>FEMALE</option>
                            <option value="BOTH" <?php if($gender=='BOTH'){ ?>selected<?php } ?>>BOTH</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Score From <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="score_from" id="score_from" placeholder="Score From" required value="<?php echo $score_from;?>"/>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('score_from'); ?>
                    </div>  
                </div>
                <div style="clear:both;"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Score To <span class="mandatory_class">*</span></label>
                        <input class="form-control" type="text" name="score_to" id="score_to" placeholder="Score To" required value="<?php echo $score_to;?>"/>
                        <div class="help-block with-errors"></div>
                        <?php echo form_error('score_to'); ?>
                    </div>  
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Interpretation Text <span class="mandatory_class">*</span></label>
                        <textarea class="form-control" type="text" name="interpretation_text" id="interpretation_text" required placeholder="Interpretation Text"><?php echo $interpretation_text;?></textarea>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Ideal Image</label>
                        <input type="file" name="ideal_image" id="ideal_image" accept="image/*">
                        <div class="help-block with-errors"></div>
                        <div id="ideal_image_div">
                            <?php if($ideal_image_url!=''){ ?>
                            <img src="<?php echo $ideal_image_url;?>"  style="width:100px;"/>
                            <a href="javascript:void(0);" onclick="delete_image('ideal')">Remove</a>
                            <?php } ?>
                            
                        </div>
                        
                    </div>  
                </div> 
                <div style="clear:both;"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Score Image</label>
                        <input type="file" name="score_image" id="score_image" accept="image/*">
                        <div class="help-block with-errors"></div>
                        <div id="score_image_div">
                            <?php if($score_image_url!=''){ ?>
                            <img src="<?php echo $score_image_url;?>"  style="width:100px;"/><a href="javascript:void(0);" onclick="delete_image('score')">Remove</a>
                            <?php } ?>
                        </div>
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
                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save" value="Save"><?php echo $action_button_text;?></button>
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
  function delete_image(type){
      if(type == 'ideal'){
        $('#ideal_image_div').html('');
        $('#removed_ideal').val('1');
      }
      if(type == 'score'){
        $('#score_image_div').html('');
        $('#removed_score').val('1');
      }
  }
  </script>