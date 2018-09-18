<?php
    // pre populate data in post-back and edit secreen.
    $question_id      = (isset($question[0]->question_id) && $question[0]->question_id != '0') ? $question[0]->question_id : (isset($_POST['question_id']) ? $_POST['question_id'] : '0');
    
    $question_text    = (isset($question[0]->question_text) && $question[0]->question_text != '') ? $question[0]->question_text : (isset($_POST['question_text']) ? $_POST['question_text'] : '');
    
    $answer_type    = (isset($question[0]->answer_type) && $question[0]->answer_type != '') ? $question[0]->answer_type : (isset($_POST['answer_type']) ? $_POST['answer_type'] : '');

    $question_description    = (isset($question[0]->question_description) && $question[0]->question_description != '') ? $question[0]->question_description : (isset($_POST['question_description']) ? $_POST['question_description'] : '');
    
    $theme_id    = (isset($question[0]->theme_id) && $question[0]->theme_id != '') ? $question[0]->theme_id : (isset($_POST['theme_id']) ? $_POST['theme_id'] : ''); 
    
    $sub_theme_id    = (isset($question[0]->sub_theme_id) && $question[0]->sub_theme_id != '') ? $question[0]->sub_theme_id : (isset($_POST['sub_theme_id']) ? $_POST['sub_theme_id'] : '');
    
    $test_id    = (isset($question[0]->test_id) && $question[0]->test_id != '') ? $question[0]->test_id : (isset($_POST['test_id']) ? $_POST['test_id'] : '');
    
    $gender    = (isset($question[0]->gender) && $question[0]->gender != '') ? $question[0]->gender : (isset($_POST['gender']) ? $_POST['gender'] : '');
 
    $active         = (isset($question[0]->is_active)) ? $question[0]->is_active : (isset($_POST['active']) ? $_POST['active'] : 'Y');
    
?>
<style>
    .answer_box{
        background-color: #f2f9fc;
        border: 1px solid #c9e6f2;
        box-sizing: border-box; 
        padding: 10px; 
        border-radius: 3px;
    }
    .answer_img{
        padding-top:10px;
    }
    .qType{
        padding-top:10px;
    }
    .form-control-short{
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
    }
    .form-control-short{
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Question
        <small><?php echo $title;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Questions</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
    <?php
    $attributes = array('data-toggle' => 'validator','enctype' => 'multipart/form-data');
    echo form_open(BASE_MODULE_URL.'questions/'.$action,$attributes); ?>
    <input type="hidden" id="question_id" name="question_id" value="<?php echo $question_id; ?>">
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
                        <label>Level <span class="mandatory_class">*</span></label>
                        <select class="form-control" name="test_id" id="test_id" required onchange="load_sub_theme(this.value);">
                            <option value="">Select an option</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>    
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Theme <span class="mandatory_class">*</span></label>
                        <select class="form-control" name="sub_theme_id" id="sub_theme_id" required>
                            <option value="">Select an option</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div style="clear:both;"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Question Text <span class="mandatory_class">*</span></label>
                        <textarea class="form-control"  name="question_text" id="question_text" placeholder="Question" required><?php echo $question_text;?></textarea>
                       
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Question Description</label>
                        <textarea class="form-control"  name="question_description" id="question_description" placeholder="Description"> <?php echo $question_description;?></textarea>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" id="gender" >
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
                        <label>Answer Type <span class="mandatory_class">*</span></label>
                        <select class="form-control" name="answer_type" id="answer_type" required onchange="load_answer_type(this.value);">
                            <option value="">Select an option</option>
                            <option value="SINGLE" <?php if($answer_type=='SINGLE'){ ?>selected<?php } ?>>Single</option>
                            <option value="WEIGHTAGE" <?php if($answer_type=='WEIGHTAGE'){ ?>selected<?php } ?>>Weightage</option>
                            <option value="MULTIPLE" <?php if($answer_type=='MULTIPLE'){ ?>selected<?php } ?>>Multiple</option>
                        </select>
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
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body" id="answer_item_rows">
                  <?php  $this->load->view('/questions/edit_new_answer', $answer_details_data);  ?>
<!--                  
                <div class="col-md-6">
                    <div class="form-group answer_box">
                        
                        <label>Answer Option 1</label>
                        <textarea class="form-control" type="text" placeholder="Answer Text" name="answer_text[]">Rarely</textarea>
                        <div class="answer_img">
                            <input class="img_control" onchange="check_image(this.value,this.id);" accept="image/*" id="answer_img_1" name="answer_image[]" type="file">
                        </div>
                        <div class="qType">
                            <input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" name="answer_weightage[]" type="input">
                        </div>
                        <input type="hidden" id="single_answer_index" name="single_answer_index" value="">

                        <input type="hidden" id="multiple_answer_index" name="multiple_answer_index" value="">
                        
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="form-group answer_box">
                        <label>Answer Option 2</label>
                        <textarea class="form-control" type="text" placeholder="Answer Text" name="answer_text[]">Sometimes</textarea>
                        <div class="answer_img">
                            <input class="img_control" onchange="check_image(this.value,this.id);" accept="image/*" id="answer_img_2" name="answer_image[]" type="file">
                        </div>
                        <div class="qType">
                            <input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" name="answer_weightage[]" type="input">
                        </div>
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="form-group answer_box">
                        <label>Answer Option 3</label>
                        <textarea class="form-control" type="text" placeholder="Answer Text" name="answer_text[]">Frequently</textarea>
                        <div class="answer_img">
                            <input class="img_control" onchange="check_image(this.value,this.id);" accept="image/*" id="answer_img_3" name="answer_image[]" type="file">
                        </div>
                        <div class="qType">
                            <input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" name="answer_weightage[]" type="input">
                        </div>
                        
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="form-group answer_box">
                        <label>Answer Option 4</label>
                        <textarea class="form-control" type="text" placeholder="Answer Text" name="answer_text[]">Always</textarea>
                        <div class="answer_img">
                            <input class="img_control" onchange="check_image(this.value,this.id);" accept="image/*" id="answer_img_4" name="answer_image[]" type="file">
                        </div>
                        <div class="qType">
                            <input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" name="answer_weightage[]" type="input">
                        </div>
                        
                    </div>  
                </div>  
                <div class="col-md-6">
                    <div class="form-group answer_box">
                        <label>Answer Option 5</label>
                        <textarea class="form-control" type="text" placeholder="Answer Text" name="answer_text[]"></textarea>
                        <div class="answer_img">
                            <input class="img_control" onchange="check_image(this.value,this.id);" accept="image/*" id="answer_img_5" name="answer_image[]" type="file">
                        </div>
                        <div class="qType">
                            <input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" name="answer_weightage[]" type="input">
                        </div>
                        
                    </div>  
                </div>  
                <div class="col-md-6">
                    <div class="form-group answer_box">
                        <label>Answer Option 6</label>
                        <textarea class="form-control" type="text" placeholder="Answer Text" name="answer_text[]"></textarea>
                        <div class="answer_img">
                            <input class="img_control" onchange="check_image(this.value,this.id);" accept="image/*" id="answer_img_6" name="answer_image[]" type="file">
                        </div>
                        <div class="qType">
                            <input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" name="answer_weightage[]" type="input">
                        </div>
                        
                    </div>  
                </div>  
                <div style="clear:both;"></div>-->
              </div>
              <!-- /.box-body -->
              <div class="box-body">
                <div class="col-md-12 pull-right-container text-right">
                    <a id="answer_add_row" onclick="answer_add_row(this.form);"><button type="button" class="btn btn-info"><i class="fa fa-plus-square"></i>&nbsp;Add More Option</button></a>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left)  onclick="return validate_answers();" -->
        <!-- right column -->
        <div class="col-lg-12 " >
            <div class="box-footer centered">
                <button type="submit" value="save" class="btn btn-primary" id="btn_save" name="btn_save"><?php echo $action_button_text;?></button>
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
    $(document).ready(function() {
    var test_id = '<?php echo $test_id;?>';
    var sub_theme_id_val = '<?php echo $sub_theme_id;?>';
    var theme_id_val = '<?php echo $theme_id;?>';
    load_levels(theme_id_val,test_id);
    load_sub_theme(test_id,sub_theme_id_val)
    enable_answer_widget('<?php echo $answer_type;?>');
    


    $('#question_text,#question_description').wysihtml5({
	"font-styles": true, 
        "emphasis": true, 
        "lists": false, 
        "html": false, 
        "link": false, 
        "image": false,
        "color": false
    });
    });
    function load_answer_type(answer_type){

    	elem = jQuery("div[class='col-md-6'][id^='rowNums']").find("input[class='img_control']");
    	removeElem = jQuery("div[class='col-md-6'][id^='rowNums']").find("div[class='qType']");
        if(answer_type=='0')
        {
          //jQuery( ".qType" ).remove(); 
           return true;
        }
         
        //jQuery( ".qType" ).remove();
        if(answer_type=='SINGLE')
        {
        	appendHtml = '<div class="qType"><input class="form-control-short single_box" onkeypress="return float_validation(event, this.value)" type="text" placeholder="" readonly name="new_answer_single_weightage[]"/>&nbsp;<input type="radio" onclick="single_click()" value="1" class="single_field" id="single_field" name="answer_single"/>&nbsp;&nbsp;Answer</div>';
            //jQuery( ".img_control" ).after();
        }

        if(answer_type=='MULTIPLE')
        {
        	appendHtml = '<div class="qType"><input onkeypress="return float_validation(event, this.value)" class="form-control-short multi-box" type="text" placeholder="" readonly name="new_answer_text_multiple[]"/>&nbsp;<input type="checkbox" value="yes" onclick="multiple_click()"    name="answer_check_multiple" />&nbsp;&nbsp;Answers</div>';
            //jQuery( ".img_control" ).after('');
        }

        if(answer_type=='WEIGHTAGE')
        {
            appendHtml = '<div class="qType"><input placeholder="Weightage" onkeypress="return float_validation(event, this.value)" class="form-control-short" type="input" name="new_answer_weightage[]"/></div>';
        }
        
    	removeElem.remove();
    	elem.after(appendHtml);
        
    }
    function float_validation(event, value){
        if(event.which < 45 || event.which > 58 || event.which == 47 ) {
            return false;
            event.preventDefault();
        } // prevent if not number/dot

        if(event.which == 46 && value.indexOf('.') != -1) {
            return false;
            event.preventDefault();
        } // prevent if already dot

        if(event.which == 45 && value.indexOf('-') != -1) {
                return false;
            event.preventDefault();
        } // prevent if already dot

        if(event.which == 45 && value.length>0) {
            event.preventDefault();
        } // prevent if already -

        return true;
    }
    function single_click() {
       var form = document.getElementsByName('answer_single');
        $(".single_box").prop("readonly", true);
        for(var i = 0; i < form.length; i++){
            if(form[i].checked){
                jQuery("#single_answer_index").val(i)
                var cnt=i;
                var $textboxes = $('input[name="answer_single_weightage[]"]');
                $('input[name="answer_single_weightage[]"]').each(function() {
                    $(this).val('');
                });
                $textboxes.eq(cnt).val('');
                $textboxes.eq(cnt).prop("readonly", false);
            }
        }
    }
    function multiple_click() {
        var form = document.getElementsByName('answer_check_multiple');
        $(".multi-box").prop("readonly", true);
        var computed = [];
        for(var i = 0; i < form.length; i++){
            if(form[i].checked){
                computed.push(i);
                jQuery("#multiple_answer_index").val(computed);
                
                var $textboxes = $('input[name="answer_text_multiple[]"]');
                $textboxes.eq(i).prop("readonly", false);
				//================================
                var $newTextboxes = $('input[name="new_answer_text_multiple[]"]');
                $newTextboxes.eq(i).prop("readonly", false);
                
            }else{
                var $textboxes = $('input[name="answer_text_multiple[]"]');
                $textboxes.eq(i).val('');
                $textboxes.eq(i).prop("readonly", true);
                //================================
                var $newTextboxes = $('input[name="new_answer_text_multiple[]"]');
                $newTextboxes.eq(i).val('');
                $newTextboxes.eq(i).prop("readonly", true);
            }
        }
   }
   function validate_answers(){
        var answer_type = $('#answer_type').val();
        if(answer_type=='SINGLE'){
          var isChecked = jQuery("input[id=single_field]:checked").val();
            if(isChecked=='undefined' || isChecked==undefined || isChecked=='') { 
            //showError("please choose answer");
            alert("please choose answer")
            return false;
          } 
        }
        //multiple 
        if(answer_type=='MULTIPLE'){
          var isChecked = jQuery("input[name=answer_check_multiple]:checked").val();
            if(isChecked=='undefined' || isChecked==undefined || isChecked=='') { 
            alert("please choose answer");
            return false;
          } 
        }   
    }
    function check_image(val,id){   
        if(val!=""){
            var bind_id='#'+id;
            var q_preview="preview_"+id;
            var res = id.split("_");
            var slag='preview_'+res[0]+'_'+res[1]+'[]'; 
            var bind ='<a href="javascript:;" id="delete_'+id+'" onclick="remove_image_add(this.id);"><i class="glyphicon glyphicon-trash delete-red"></i></a>';
            jQuery(bind_id).after(bind);
            var input = document.getElementById(id);
            var fReader = new FileReader();
            fReader.readAsDataURL(input.files[0]);
            fReader.onloadend = function(event){
                raw_data='<input type="hidden" id="'+q_preview+'" name="'+slag+'" value="'+event.target.result+'" />';
                jQuery(bind_id).after(raw_data);
            }     
        }
    }
    function remove_image_add(delete_id){ 
        var res = delete_id.split("_");
        var slag=res[1]; 
        var id=res[3];
        $("#"+slag+"_img_"+id).val("");
        $("#preview_"+slag+"_img_"+id).val("");
        $("#"+delete_id).remove();
    }
    function enable_answer_widget(type){
        jQuery(".ans_order").hide();
        jQuery(".ans_single").hide();
        jQuery(".ans_multiple").hide();
        jQuery(".ans_weitage").hide();
        jQuery(".ans_related_question").hide();

        
        if(type=="SINGLE")
        {
         jQuery(".ans_single").show();
        }

        if(type=="MULTIPLE")
        {
         jQuery(".ans_multiple").show();
        }

        if(type=="WEIGHTAGE")
        {
         jQuery(".ans_weitage").show();
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
    
    var rowNums = $('#answer_counts').val()- 1;
    var rowNumsId = 6;
    function answer_add_row(frm) {
        rowNumsId++;
        rowNums ++;
        var rows = '<div class="col-md-6" id="rowNums'+rowNums+'">  <div class="form-group answer_box"><label>Answer Option <a href="javascript:;" onclick="answer_remove_ow('+rowNums+');"><i class="glyphicon glyphicon-remove-circle red"></i></a></label>  <textarea class="form-control" placeholder="Answer Text" name="answer_text[]" ></textarea> <div class="answer_img"><input id="answer_img_'+rowNumsId+'" type="file" accept="image/*" class="img_control" onchange="check_image(this.value,this.id);"  name="answer_image[]"/></div></div></div>';
         jQuery('#answer_item_rows').append(rows);

         jQuery("#answer_type").change();
}
 function answer_remove_ow(rnums) {
        jQuery('#rowNums'+rnums).remove();
    }
</script>