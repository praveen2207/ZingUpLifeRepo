<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Goal
        <small>Master</small>
      </h1>
        <ol class="breadcrumb">
          <li class="active">
            <a href="<?php echo BASE_MODULE_URL; ?>goals/create"><button type="reset" class="btn btn-success">Add Goal</button>
            </a>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
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
            <div class="box-header">
                <div class="col-xs-3 pull-right">
                    <div class="form-group">
                        <select class="form-control" id="goal_segment_id" name="goal_segment_id" required onchange="goal_list_by_segement(this.value);">
                        <option value="">Select segment</option>
                          <?php
                          foreach($goal_segment_data as $k=>$value) {
                          ?>
                          <option value="<?php echo $value->goal_segment_id; ?>"  ><?php echo $value->segment_name; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>    
            </div>
            <div class="box-body">
              <table id="list_goals" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Goal Id</th>
                    <th>Segment</th>
                    <th>Goal Name</th>
                    <th>Gender</th>
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
<script>
    var goal_dataTable;
    $(document).ready(function() {
        goal_dataTable = $('#list_goals').DataTable( {
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 200,
            "ordering": true,
            "info": true,
            "paging": true,
            "lengthChange": true,
            "searchHighlight": true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 4,5 ] }
            ],
            "ajax":{
                url :"<?php echo BASE_MODULE_URL; ?>goals/load_goals", 
                type: "post",  
                error: function(){  
                    $(".list_goals-error").html("");
                    $("#list_goals").append('<tbody class="list_goals-error">\n\
                    <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                    $("#list_goals_processing").css("display","none");
                },
            }
        });   
    });   
    function goal_list_by_segement(goal_segment_id){
        goal_dataTable.destroy();
        goal_dataTable = $('#list_goals').DataTable( {
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "pageLength": 200,
                "ordering": true,
                "info": true,
                "paging": true,
                "lengthChange": true,
                "searchHighlight": true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 4,5 ] }
                ],
                "ajax":{
                    url :"<?php echo BASE_MODULE_URL; ?>goals/load_goals", 
                    type: "post",
                    data:{
                            'goal_segment_id':goal_segment_id,
                        },
                    error: function(){  
                        $(".list_goals-error").html("");
                        $("#list_goals").append('<tbody class="list_goals-error">\n\
                        <tr><th colspan="6">No data found in the server</th></tr></tbody>');
                        $("#list_goals_processing").css("display","none");
                    },
                }
            });
    }

$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
$(".alert-error").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
});   
</script>