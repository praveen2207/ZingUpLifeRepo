<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Goal Mapping
        <small>List</small>
      </h1>
        <ol class="breadcrumb">
          <li class="active">
            <a href="<?php echo BASE_MODULE_URL; ?>assessment_goal/create"><button type="reset" class="btn btn-success">Add Goal Mapping</button>
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
            <div class="box-body">
              <table id="list_goal_mapping" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Theme</th>
                    <th>Sub Theme</th>
                    <th>Test(Level)</th>
                    <th>Goal</th>
                    <th>Score From</th>
                    <th>Score To</th>
                    <th>Score Level</th>
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
$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
$(".alert-error").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
});   
$(document).ready(function() {
    var dataTable = $('#list_goal_mapping').DataTable( {
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 100,
            "ordering": true,
            "info": true,
            "paging": true,
            "lengthChange": true,
            "searchHighlight": true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 5,6 ] }
            ],
            "ajax":{
                url :"<?php echo BASE_MODULE_URL; ?>assessment_goal/load_goal_mapping", 
                type: "post",  
                error: function(){  
                    $(".list_goal_mapping-error").html("");
                    $("#list_goal_mapping").append('<tbody class="list_goal_mapping-error">\n\
                    <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                    $("#list_goal_mapping_processing").css("display","none");
                },
            }
        });
});
</script>