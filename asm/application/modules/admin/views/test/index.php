<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Theme Level
        <small>List</small>
      </h1>
        <ol class="breadcrumb">
          <li class="active">
            <a href="<?php echo BASE_MODULE_URL; ?>test/create"><button type="reset" class="btn btn-success">Add Test</button>
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
              <table id="list_tests" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Level Id</th>
                    <th>Theme</th>                    
                    <th>Level Name</th>
                    <th>Level Code</th>
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
$(".alert-success").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
$(".alert-error").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
});   
</script>