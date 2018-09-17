<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $theme_name; ?>  <small><i class="fa fa fa-arrow-right"></i>&nbsp;&nbsp;<?php echo $test_name; ?>
        </small> 
      </h1>
        <ol class="breadcrumb">
          <li class="active">
            <a href="<?php echo BASE_MODULE_URL; ?>test_interpretation/add/<?php echo $theme_id;?>/<?php echo $test_id;?>"><button type="reset" class="btn btn-success">Add Interpretation</button>
            </a>
        </li>
        </ol>
    </section>
    <input type="hidden" name="theme_id" id="theme_id" value="<?php echo $theme_id;?>"/>
    <input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>"/>
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
              <table id="list_interpretations" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Sub Theme</th>
                    <th>Gender</th>
                    <th>Score From</th>
                    <th>Score To</th>
                    <th>interpretation</th>
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
    $(document).ready(function() {   
        var theme_id    = $('#theme_id').val();
        var test_id     = $('#test_id').val();
        var dataTable = $('#list_interpretations').DataTable( {
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "paging": true,
            "lengthChange": true,
            "searchHighlight": true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 0,6,7 ] }
            ],
            "ajax":{
                url :"<?php echo BASE_MODULE_URL; ?>test_interpretation/load_interpretations", 
                type: "post",  
                data:{
                        'theme_id':theme_id,
                        'test_id':test_id,
                    },
                error: function(){  
                    $(".list_interpretations-error").html("");
                    $("#list_interpretations").append('<tbody class="list_interpretations-error">\n\
                    <tr><th colspan="8">No data found in the server</th></tr></tbody>');
                    $("#list_interpretations_processing").css("display","none");
                },
            }
        });
    });
    
$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
$(".alert-error").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
});   
</script>