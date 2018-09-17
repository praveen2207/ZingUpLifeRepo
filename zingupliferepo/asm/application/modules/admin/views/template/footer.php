<?php if ($this->session->userdata('logged_in')) { ?>
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
<!--        <p><button id="quick_demo">Loading...</button></p>-->
      <strong>Copyright © 2017 www.zinguplife.com</strong> All rights reserved.
    </div>
      <strong>Zinguplife.com</strong>
  </footer>
<?php } ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

  
<!-- Modal form-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <input type="hidden" name="hidden_url" id="hidden_url" value=""/>
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" id="modal-bodyku">
          <h5>Are you sure you want to delete <strong><span id='element_name'></span></strong> ? </h5>
      </div>
      <div class="modal-footer" id="modal-footerq">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="delete_redirect();">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal ------------------------------>

<!-- jQuery 2.2.3 -->

<script src="<?php echo base_url();?>assets/dist/js/jquery.Jcrop.js"></script>

<!-- DataTables -->


<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/main.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript"> 
$(document).ready(function() {
    $(".select2").select2();

    var dataTable = $('#list_users').DataTable( {
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "ordering": true,
        "info": true,
        "paging": true,
        "lengthChange": true,
        "searchHighlight": true,
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 5,6 ] }
        ],
        "ajax":{
            url :"<?php echo BASE_MODULE_URL; ?>user/load_users", 
            type: "post",  
            error: function(){  
                $(".list_users-error").html("");
                $("#list_users").append('<tbody class="list_users-error">\n\
                <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                $("#list_users_processing").css("display","none");
            },
        }
    });
    var dataTable = $('#list_themes').DataTable( {
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "ordering": true,
        "info": true,
        "paging": true,
        "lengthChange": true,
        "searchHighlight": true,
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 5,6 ] }
        ],
        "ajax":{
            url :"<?php echo BASE_MODULE_URL; ?>theme/load_themes", 
            type: "post",  
            error: function(){  
                $(".list_themes-error").html("");
                $("#list_themes").append('<tbody class="list_themes-error">\n\
                <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                $("#list_themes_processing").css("display","none");
            },
        }
    });
    var dataTable = $('#list_tests').DataTable( {
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
            { 'bSortable': false, 'aTargets': [ 4,5 ] }
        ],
        "ajax":{
            url :"<?php echo BASE_MODULE_URL; ?>test/load_tests", 
            type: "post",  
            error: function(){  
                $(".list_tests-error").html("");
                $("#list_tests").append('<tbody class="list_tests-error">\n\
                <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                $("#list_tests_processing").css("display","none");
            },
        }
    });
    var dataTable = $('#list_segments').DataTable( {
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
            { 'bSortable': false, 'aTargets': [ 3,4 ] }
        ],
        "ajax":{
            url :"<?php echo BASE_MODULE_URL; ?>goal_segment/load_segments", 
            type: "post",  
            error: function(){  
                $(".list_segments-error").html("");
                $("#list_segments").append('<tbody class="list_segments-error">\n\
                <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                $("#list_segments_processing").css("display","none");
            },
        }
    });
    var dataTable = $('#list_goal_activities').DataTable( {
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
            { 'bSortable': false, 'aTargets': [ 3,4 ] }
        ],
        "ajax":{
            url :"<?php echo BASE_MODULE_URL; ?>goal_activity/load_goal_activities", 
            type: "post",  
            error: function(){  
                $(".list_goal_activities-error").html("");
                $("#list_goal_activities").append('<tbody class="list_goal_activities-error">\n\
                <tr><th colspan="7">No data found in the server</th></tr></tbody>');
                $("#list_goal_activities_processing").css("display","none");
            },
        }
    });
});
function confirm_model(url,element_name){
    $('#element_name').html(element_name);
    $('#hidden_url').val(url);
    $('#myModal').modal('show');
}
function delete_redirect(){
    var url             = $('#hidden_url').val();
    window.location     = url;
}
$(function(){
    /***************************************************************************
        Quick Demo
    ***************************************************************************/
    $("#quick_demo1").on("click", function(event){
        $.LoadingOverlay("show");
        setTimeout(function(){
            $.LoadingOverlay("hide");
        }, 3000);
    });
    $("#quick_demo").on("click", function(event){
        $.LoadingOverlay("show", {
            image       : "",
            fontawesome : "fa fa-spinner fa-spin"
        });
        setTimeout(function(){
            $.LoadingOverlay("hide");
        }, 3000);
    });
});
</script>
</body>
</html>
