<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Assessment</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/build/font-awesome/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/build/font-awesome/ionicons.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">

  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/validator.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>


<?php
    $controller_name    =   $this->router->fetch_class(); 
    $method_name        =   $this->router->fetch_method();  
    
   $user_type = $this->session->userdata('user_type');
?>
<style>
    .mandatory_class{
        color:#dd4b39;
    }
    body{
        font-size: 13px !important;
    }
    .sidebar-menu .treeview-menu > li > a {
        font-size: 13px !important;
    }
    .btn{
        font-size: 13px !important;
    }
</style>
<script>
//global common url returns 
var common_url="<?php echo base_url().$this->router->fetch_module()."/".$this->router->fetch_class(); ?>/";
//
//$(window).load(function() {
//    //setTimeout(function(){
//        $.LoadingOverlay("show", {
//            image       : "",
//            fontawesome : "fa fa-spinner fa-spin"
//        });
//    //}, 3000);
//    
//});

</script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<?php if($controller_name=='login'){ ?>
<body class="hold-transition login-page">
<?php }else { ?>
<body class="hold-transition skin-blue sidebar-mini">
<?php } 
$this->load->view('/template/header_menu');
?>    
    
    
