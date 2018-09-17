<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Question
        <small>List</small>
      </h1>
        <ol class="breadcrumb">
          <li class="active">
            <a href="<?php echo BASE_MODULE_URL; ?>questions/create"><button type="reset" class="btn btn-success">Add Question</button>
            </a>
        </li>
      </ol>
    </section>
    <section class="content" style="min-height: 50px; padding-bottom: 0px;">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-3">
                        <div class="form-group">
                            <label>Theme <span class="mandatory_class">*</span></label>
                            <select class="form-control" id="theme_id" name="theme_id" required onchange="load_levels(this.value);">
                            <option value="">Select an option</option>
                              <?php
                              foreach($theme_data as $k=>$value) {
                              ?>
                              <option value="<?php echo $value->theme_id; ?>"><?php echo $value->theme_name; ?></option>
                            <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="test_id" id="test_id" onchange="load_sub_theme(this.value);">
                                <option value="">Select an option</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub Theme</label>
                            <select class="form-control" name="sub_theme_id" id="sub_theme_id">
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
                <div class="col-md-3">
                    <div class="col-md-12" style="margin-top: 22px;">
                        <input type="button" class="btn btn-primary" name="btn_search_filter" id="btn_search_filter" value="Search"/>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- Main content -->
    <section class="content" style="padding-top: 0px;">
      <div class="row">
        <div class="col-xs-12">
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
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list_questions" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Theme</th>
                    <th>Level</th>
                    <th>Sub Theme</th>
                    <th>Question</th>
                    <th>Answer Type</th>
                    <th>Created On</th>
                    <th>Is Active</th>
                    <th>Action</th>
                </tr>
                </thead>
            <!--<tfoot>
                    <tr>
                      <th>Person Id</th>
                      <th>Name</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Action</th>
                    </tr>
                </tfoot>-->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="myQuestionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Prerequisite for question</h4>
      </div>
      <div class="modal-body">
          <form method="post" name="question_prerequisite" id="question_prerequisite">
              <input type="hidden" name="question_id" id="question_id" value=""/>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Theme <span class="mandatory_class">*</span></label>
                        <select class="form-control" id="theme_id" name="theme_id" required onchange="load_levels(this.value);">
                        <option value="">Select an option</option>
                          <?php
                          foreach($theme_data as $k=>$value) {
                          ?>
                          <option value="<?php echo $value->theme_id; ?>"><?php echo $value->theme_name; ?></option>
                        <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Level <span class="mandatory_class">*</span></label>
                        <select class="form-control" name="test_id" id="test_id" required onchange="load_questions(this.value);">
                            <option value="">Select an option</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>  
                </div>   
            </div>  
        </div>
              </form>
          <div id="modal-bodyku" style="min-height:150px;"></div>
      </div>
      <div class="modal-footer" id="modal-footerq">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success save_questions">Save</button>
      </div>
    </div>
  </div>
</div>
  
  
  
  
  
  
  <script>
    function prerequisite_model(question_id){
        $('#question_id').val(question_id);
        $('#modal-bodyku').html('');
        $('#theme_id').val('');
        $('#test_id').val('');
        $('#myQuestionModal').modal('show');
    }
    var questions_dataTable;
    $(document).ready(function() { 
        questions_dataTable = $('#list_questions').DataTable( {
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ordering": true,
            "info": true,
            "paging": true,
            "lengthChange": true,
            "searchHighlight": true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 0,6,7 ] }
            ],
            "ajax":{
                url :"<?php echo BASE_MODULE_URL; ?>questions/load_questions", 
                type: "post",  
                error: function(){  
                    $(".list_questions-error").html("");
                    $("#list_questions").append('<tbody class="list_questions-error">\n\
                    <tr><th colspan="8">No data found in the server</th></tr></tbody>');
                    $("#list_questions_processing").css("display","none");
                },
            }
        });
        $('#btn_search_filter').click(function () {
            questions_dataTable.destroy();
            var theme_id  = $('#theme_id').val();
            var test_id         = $('#test_id').val();
            var sub_theme_id        = $('#sub_theme_id').val();
            questions_dataTable = $('#list_questions').DataTable( {
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ordering": true,
            "info": true,
            "paging": true,
            "lengthChange": true,
            "searchHighlight": true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 0,6,7 ] }
            ],
            "ajax":{
                url :"<?php echo BASE_MODULE_URL; ?>questions/load_questions", 
                type: "post",  
                data:{
                    'theme_id':theme_id,
                    'test_id':test_id,
                    'sub_theme_id':sub_theme_id,
                },
                error: function(){  
                    $(".list_questions-error").html("");
                    $("#list_questions").append('<tbody class="list_questions-error">\n\
                    <tr><th colspan="8">No data found in the server</th></tr></tbody>');
                    $("#list_questions_processing").css("display","none");
                },
            }
        });    
    });    
        
        
        
        
        
        
    });

$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
$(".alert-error").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
});   
function load_levels(theme_id,test_id=''){
    $.getJSON( common_url+'load_lelvels/'+theme_id, function( data ) { 
        if(test_id!=''){
               render_dropdow_selected(data,'test_id',test_id); 
        }else{
            render_dropdown(data,'test_id'); 
        }
    });
}
function load_sub_theme(test_id){  
    $.getJSON( common_url+'load_sub_theme/'+test_id, function( data ) { 
            render_dropdown(data,'sub_theme_id'); 
    });  
}
function load_questions(){
    var theme_id    = $('#theme_id').val();
    var test_id     = $('#test_id').val();
    var question_id = $('#question_id').val();
    if(theme_id!='' && test_id!= '' && question_id != ''){
        
        $("#modal-bodyku").LoadingOverlay("show", {
            image       : "",
            fontawesome : "fa fa-spinner fa-spin"
        });
        $.ajax({
            type: 'POST',
            url: common_url+'load_pre_questions',
            data: { 
                test_id : test_id,
                theme_id : theme_id,
                question_id : question_id
            },
            success: function (data) {
                $("#modal-bodyku").LoadingOverlay("hide");
                $('#modal-bodyku').html(data);
            }
        });
    }
}
function show_answers(question_id){
    $('#answer_div_'+question_id).show();
}
$('.save_questions').click(function(event){
    alert('test')
    event.preventDefault();
    var serialize = $("form#question_prerequisite").serialize();
    alert(serialize)
    save_questions();
});

function save_questions(){
    $.LoadingOverlay("show", {
            image       : "",
            fontawesome : "fa fa-spinner fa-spin"
    });
    $.ajax({
        url: common_url+'save_pre_questions',
        type : "POST", 
        dataType : 'json',
        data : $("form#question_prerequisite").serialize(),
        success : function(result) {
            if(result.status == true){
                $.LoadingOverlay("hide");
            }
        },
        error: function(xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    });
    
}
var arr = [];
function selected_value(value,question_id){
    arr[question_id] = value;
    alert(arr)

    //ids += value + ',';
    //alert(ids)
    
    //alert(final_value);
//    
//     var prevalue = value.split(",");
//    var comma = select_questions.length===0?'':',';
//    select_questions += (comma+value);
//    alert(select_questions)
}
</script>