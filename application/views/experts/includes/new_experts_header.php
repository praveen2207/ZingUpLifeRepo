<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This portal helps in signing in experts or practitioners" />
    <meta name="keywords" content="experts, login, signup, username, password" />
    <style type="text/css">
        @-ms-viewport {
            width: device-width;
        }
    </style>
    <title>Zinguplife | Popular Experts | Mind body interventions | Yoga | Integrative Health and Medicine</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/experts_new/css/layers.min.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url();?>assets/experts_new/css/font-awesome.min.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome-4-7-0.min.css" media="screen">
<link href="<?php echo base_url();?>assets/experts_new/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/experts_new/css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/experts_new/css/style.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url();?>assets/experts_new/css/jquery.timepicker.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/flatpickr.min.css" >
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/experts_new/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/experts_new/css/custom.css" media="screen">
<script src="<?php echo base_url();?>assets/experts_new/js/modernizr.custom.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-montserrat.css" >
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/experts_new/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/experts_new/css/bootstrap-datepicker3.min.css">-->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
    <link rel="icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/experts_new/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/experts_new/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>assets/experts_new/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>assets/experts_new/img/apple-touch-icon-152x152.png"> 
   
	<style type="text/css">
        .events .nav>li.active>a,
        .events .nav>li.active>a:focus,
        .events .nav>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
            z-index:324234;
            border-top:2px solid #000;
            border-top-color: #000;
        }
        
        
        .events .nav>li>a {
            margin-right: -22px;
            line-height: 1.42857143;
            border-radius: 0px;
            font-size: 14px;
            background-color: #fff;
            padding: 11px 25px;
            font-weight: 300;
            border-bottom: 1px solid #ebebeb;
        }
        
        .events .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 37px;
        }
        
        .events .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }
        
        .events .nav>li {
            position: relative;
            display: block;
        }
        .events .tab-border .tab-content {
            border-left: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            padding: 30px;
            margin-top: 40px;
            background-color: #fff;
	}
	.image-container {
            display: flex;
            justify-content: center;
        }
        
        .flatpickr-weekdays span {
            clear: none !important;
        }
        
        .flatpickr {
            width: 274px !important;
            font-size: 14px;
            height: 35px;
            padding-left: 10px;
        }
        
        .form-wrapper a {
            float: right;
            margin-right: 22px;
            /* margin-top: -20px; */
            position: relative;
            top: -51px;
        }
	.btn-ques {
            border-radius: 25px;
            border: 0px;
            background-color: #90D26D;
            color: #fff;
            padding: 8px 30px;
        }
        
        nav > ul > li {
            padding: 0 0.678em;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 0.778em;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
        }
        .dsProfile{
            text-decoration: none;
        }
        .new_design>li>a{
                padding: 11px 27px;
        }

        
    </style>
</head>
 
<body class="page" style="padding-left: 0px !important;">
<input type='hidden' class='url' value='<?php echo base_url(); ?>' />
<input type='hidden' class='sme_userid' value='<?php echo $this->session->userdata('sme_userid');?>' />
     
      
        <div class="navmenu navmenu-default navmenu-fixed-right offcanvas " style="z-index:212"> 
        
     
		        <ul class="nav navmenu-nav" style="margin-top: 15px;">
		        
					 <?php
		                  $path = base_url() . 'assets/uploads/users/';
		                 $smepath = base_url() . 'sme_users/';
		                 $logged_in_user_details = $this->session->userdata('logged_in_user_data');
		                 if (!empty($logged_in_user_details)) {
		                 	$is_logged_in = $logged_in_user_details->is_logged_in;
		                 } else {
		                 	$is_logged_in = '';
		                 }
		                 ?>
						<?php if ($is_logged_in == 1) { ?>
							<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
		                	<li><a href="<?php echo base_url(); ?>my_profile">My Profile</a></li>
		                <?php } ?>
						<?php  if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme' ){ ?>
						<li><a href="<?php echo base_url(); ?>experts/dashboard" class="">DASHBOARD</a></li>
						<?php } ?>
						<?php if (isset($active_url) && $active_url == 'service_providers') { ?>
							<li><a href="<?php echo base_url(); ?>search" class="activeList partnerBtn">SERVICES & PROVIDERS</a></li>
						<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>search" class="">SERVICES & PROVIDERS</a></li>
						<?php } ?>
						<li><a href="<?php echo base_url(); ?>experts/home" class="">EXPERTS</a></li>
						<li><a href="<?php echo base_url();?>knowledgebase/">BLOG</a></li>
						<?php if (isset($active_url) && $active_url == 'workplace') { ?>
							<li><a href="<?php echo base_url(); ?>workplace" class="activeList partnerBtn">CORPORATE OFFERINGS</a></li>
						<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>workplace" class="">CORPORATE OFFERINGS</a></li>
						<?php } ?>
						<?php if (isset($active_url) && $active_url == 'contact_us') { ?>
							<li><a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">CONTACT</a></li>
							<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>contact_us" class="">CONTACT</a></li>
						<?php } ?>
						<?php  if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme' ){ ?>
							<li><a href="<?php echo base_url(); ?>experts/logout">Log Out</a></li>
						<?php } else if ($is_logged_in == 1) { ?>
							 <li><a href="<?php echo base_url(); ?>logout">Log Out</a></li>
						<?php } ?>
		        </ul> 	
		  </div>
    	  <div class="navbar" role="banner" id="header" style="position:fixed;z-index:100;width: 100%;border-radius: 0px;height:65px;margin-top:0px;background-color:#fff;border-bottom:1px solid #ebebeb;display: block">
            <div class="container">
            	<div class="screen-only">
              		<div style="padding-right:63px; float:right; font-size:13px;">24/7 Support&nbsp;&nbsp;&nbsp;+91 98863 50650  |  support@zinguplife.com
              		</div>
              	</div>	
                <div class="navbar-header">
                	<div class="screen-only">
	                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                 </div>   
                     <div class="mobile-only">
                     	 <div id="menu" data-toggle="offcanvas" data-target=".navmenu" style="cursor:pointer;margin-top:5px;">
			             	
			             	<span style="display: inline-block; width:23%;font-size: 25px" class="fa fa-bars" "></span>
							<span style="display: inline-block; width:53%; ">
								<a href='<?php echo base_url();?>'>
									<img  src="<?php echo base_url();?>assets/experts_new/img/nav-logo-mobile.png" alt="logo" />
								</a>
							</span>
							<span style="display: inline-block; width:13%; ">
							<li style="float:right; ">
								 <?php if ($is_logged_in == 0) { ?>    
		                           <a href="<?php echo base_url(); ?>login">
		                                <button type="submit"  style="border:none;background-color:white ;">
		                                	<img src="<?php echo base_url();?>assets/experts_new/img/login-logo.png" alt="logo" />
		                                </button>
		                            </a>   
								 <?php }?>
		                        </li>
								<?php if ($is_logged_in == 1) { ?>						
								<li style='color:#000;float:right; margin-top:31px;'>           
								<?php if ($logged_in_user_data->image != '') { ?>                                           
								<img class="user_icon"  src="<?php echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>">  
								<?php } else { ?>                                           
								<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">     
								<?php } } ?>
								<?php echo $logged_in_user_details->name; ?> 						
							</li>     
							</span>
						 </div>
		     	           <div style="float:right; font-size:8px;">Helpline:&nbsp;&nbsp;&nbsp;+91 98863 50650</div>
                    </div>
                         
                  	 <div class="screen-only">
	                    <a class="navbar-brand " href="<?php echo base_url();?>">
	                        <img src='<?php echo base_url();?>assets/experts_new/img/nav-logo.png' alt="logo" style="margin-top: -7px;width: 170px;margin-left: 45px;">
	                    </a>
	                 </div>   
                  </div>
		           <nav> 
		            <ul class="reset" role="navigation" style="margin-top:5px; margin-right: 65px;">
				       <li class="menu-item">
			                <?php $logged_in_user_details = $this->session->userdata('logged_in_user_data'); 
			                if ($logged_in_user_details->is_logged_in != 1 && $this->session->userdata('type') !='sme') { ?>
			                        <a href="<?php echo base_url(); ?>experts/login">
			                            <button type="submit" class="btn btn-login">&nbsp;&nbsp;&nbsp;Expert Login/Signup&nbsp;&nbsp;&nbsp;</button>
			                        </a>
			                <?php } ?>
			            </li>
			            <li style="margin-top:8px">
			                <select style="height:33px;background:transparent;color:#f39c12;border-radius:5px;border:0px;margin-left:30px;cursor:pointer;" class='sear_city'>
			                    <option value='Bangalore' selected="selected" style="display: none;color:#f39c12;text-transform:capitalize;">                  
			                    <?php 
			                        if($this->session->userdata('place') != ''){
			                                echo $this->session->userdata('place'); 
			                        }else{
			                                echo $this->session->userdata('place2'); 
			                        }
			                    ?>
			                   </option>
			                   <option value='Delhi & NCR'>Delhi & NCR</option>
			                   <option value='Bangalore'>Bangalore</option>
			               </select>
			            </li>
			
			            <?php
			                $path = base_url() . 'assets/uploads/users/';
			                $smepath = base_url() . 'sme_users/';
			                $logged_in_user_details = $this->session->userdata('logged_in_user_data');
			                if (!empty($logged_in_user_details)) {
			                    $is_logged_in = $logged_in_user_details->is_logged_in;
			                } else {
			                    $is_logged_in = '';
			                }
			            ?>
			            <?php if ($is_logged_in == 1) { ?>
			            <li>
			                <?php if($logged_in_user_details->image == '') {?>
								<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style="height:40px;width:40px;float:left;display:inline;">
			                    <?php } else {?>
			                    <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $logged_in_user_details->user_id; ?>/<?php echo $logged_in_user_details->image; ?>" style="height:40px;width:40px;float:left;display:inline;">
			                <?php } ?>
			                <span style='line-height:45px;margin-left:10px;'><?php echo $logged_in_user_details->name; ?></span>
			            </li>
			            <?php } ?>
			
			             <?php  if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme' ){ ?>
			                      <li>
			                     	<?php if ($this->session->userdata('photo') != '') { ?>
			                     	<img class="user_icon"  src="<?php echo $smepath . $this->session->userdata('sme_userid') . '/' . $this->session->userdata('photo'); ?>" style="height:40px;width:40px;float:left;display:inline;">
			                        <?php } else { ?>
			                        <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='float:left;display:inline;'>
			                        <?php } ?>
			                        <span style='line-height:45px;margin-left:10px;'><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span>
			                      </li>
			              <?php }  ?>
			             <li id="menu" data-toggle="offcanvas" data-target=".navmenu" style="cursor:pointer;font-size: 22px;margin-top:6px;">
			             	<span class="fa fa-bars"></span>
			             </li>
		            </ul>
		         </nav>
            </div>
    	</div>