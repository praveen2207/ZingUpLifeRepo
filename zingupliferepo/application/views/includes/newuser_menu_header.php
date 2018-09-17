<?php
	$requestURI = $_SERVER['REQUEST_URI'];
	$expertsLoginPattern = "/\/experts\/login/";
	$logged_in_user_details = $this->session->userdata('logged_in_user_data');
	if (!empty($logged_in_user_details)) {
		$is_logged_in = $logged_in_user_details->is_logged_in;
		$isLoggedIn = 1;
	} else {
		$is_logged_in = '';
		$isLoggedIn = 0;
	}
?>

			
<!DOCTYPE html>
<html lang="en">

<head>
   <meta name="google-site-verification" content="qEw3ux_M-eIw_ld_Q4fxhiX3p6yIhXgcXqchxTSIciw" />
        <?php
        if (isset($title) && $title != '') {
            $page_title = $title;
        } else {
            $page_title = 'ZingUpLife | Home';
        }
        $path = base_url() . 'assets/uploads/users/';
        ?>
        <title><?php echo $page_title; ?></title>

        <meta charset="UTF-8">
        <meta name="description" content="">
	<style type="text/css">
        @-ms-viewport {
            width: device-width;
        }
        </style>
        
      <meta property="og:url" content="https://zinguplife.com"/>
	  <meta property="og:title" content="Your Wellness Buddy"/>
  	  <meta property="og:image" content="https://zinguplife.com/assets/images/ZUL_icon.png"/>
	  <meta property="og:site_name" content="ZingUpLife"/>
      <meta property="og:description" content="Live Appsolutely Healthy."/>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="keywords" content="">
        <meta name="author" content="Zinguplife" >
        <link rel="icon" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico" type="image/gif" sizes="16x16">
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zing_user/css/layers.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zing_user/css/font-awesome.min.css" media="screen">
    <link href="<?php echo base_url(); ?>assets/zing_user/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/zing_user/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zing_user/css/clndr.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zing_user/css/style.css" media="screen">
    <script src="<?php echo base_url(); ?>assets/zing_user/js/modernizr.custom.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
    <link rel="icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/zing_user/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/zing_user/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/zing_user/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/zing_user/img/apple-touch-icon-152x152.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dashboard/progress_bar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dashboard/style.css">

    <style type="text/css">
        .events .nav>li.active>a,
        .events .nav>li.active>a:focus,
        .events .nav>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
            z-index: 324234;
            border-top: 2px solid #000;
            border-top-color: #000;
        }
        
        .events .nav>li>a {
            margin-right: -22px;
            line-height: 1.42857143;
            border-radius: 0px;
            font-size: 14px;
            background-color: #fff padding: 11px 25px;
            font-weight: 300;
            border-bottom: 1px solid #ebebeb;
        }
        
        .events .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 27px;
        }
        
        .events .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }
        
        .events .nav>li {
            position: relative;
            display: block;
        }
        
        .events .tab-border {
            border-left: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            border-top: 1px solid #ebebeb;
            padding: 30px;
            position: relative;
            top: 40px;
            background-color: #fff;
            margin-left: -1px;
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
        
        .dsProfile {
            text-decoration: none;
        }
        
        .new_design>li>a {
            padding: 11px 27px;
        }
        
        figcaption {
            border: 1px solid #ebebeb;
            min-height: 100px;
            text-align: left;
        }
        
        .knw {
            border: 1px solid #ebebeb;
            padding: 13px;
            text-align: center;
            margin-bottom: 0px;
            margin-top: 15px;
            background-color: #fff
        }
        
        .knw a {
            text-decoration: none;
            color: black;
        }
        
        .advisors p {
            font-size: 13px;
            margin-bottom: 0px;
        }
        
        p,
        a {
            font-family: 'Montserrat', sans-serif;
            color: #818181;
        }
        
        input[type="text"] {
            margin-top: -87px !important;
            margin-left: 49px !important;
        }
        
        .advisors figure {
            border-bottom: 0px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            min-height: 160px;
            background-color: #f8f8f8;
        }
        
        .inner {
            background-color: #f9f9f9;
            padding: 17px;
            min-height: 235px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    </style>
</head>
    

<body class="page" style="padding-left: 0px !important">
       <!-- Off Canvas Navigation
    ================================================== -->
	<input type='hidden' value='<?php echo base_url();?>' class='url' />
    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas" style="z-index:212">
        <!--- Off Canvas Side Menu -->
        <!-- <div class="close" data-toggle="offcanvas" data-target=".navmenu" style="z-index:212">
            <span class="fa fa-close"></span>
        </div> --><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/zing_new/img/nav-logo.png" width="190px" style="margin-top: 14px;padding-left:2px;"></a>
        <ul class="nav navmenu-nav" style="margin-top: 15px;">
                   <!--- Menu -->			<?php if ($is_logged_in == 1) { ?>							
				   <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>							 
				   <li><a href="<?php echo base_url(); ?>my_profile">My Profile</a></li>		
				   <?php } ?>
	    <?php if ($active_url == 'service_providers') { ?>				
	                                <li><a href="<?php echo base_url(); ?>search" class="activeList partnerBtn">SERVICES & PROVIDERS</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>search" class="">SERVICES & PROVIDERS</a></li>
                                    <?php } ?>
                                    <?php if ($active_url == 'experts') { ?>
                                        <li><a href="<?php echo base_url(); ?>experts/home" class="activeList partnerBtn">EXPERTS</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>experts/home" class="">EXPERTS</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>knowledgebase/">BLOG</a></li>
                                    <?php if ($active_url == 'about_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>about_us" class="activeList partnerBtn">ABOUT</a></li>
                                    <?php } else{
                                    	if ($active_url != 'workplace') { ?>
                                    	<li><a href="<?php echo base_url(); ?>workplace" class="">CORPORATE OFFERINGS</a></li>
                                    <?php } }
                                     if ($active_url == 'workplace') { ?>
                                        <li><a href="<?php echo base_url(); ?>workplace" class="activeList partnerBtn">CORPORATE OFFERINGS</a></li>
                                    <?php }
                                    if ($active_url == 'contact_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">CONTACT</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="">CONTACT</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>vendor/registration" class="">PARTNER WITH US</a></li>
                                    <?php if ($is_logged_in != 1) { ?>
                                        <!--<li>
                                        <?php if($active_url == 'experts'){?>
                                        <a href="<?php echo base_url(); ?>experts/login" type="button" class="btn zing-btn loginBtn">Expert Login/Signup</a>
                                        <?php } else {?>
                                        <a href="<?php echo base_url(); ?>login" type="button" class="btn zing-btn loginBtn">Login/Signup</a>
                                        <?php } ?>
                                        </li>-->
                                        <?php }
                                        ?>										<?php if ($is_logged_in == 1) { ?>							                                        <li><a href="<?php echo base_url(); ?>logout">Log Out</a></li>		<?php } ?>
       
        </ul>
        <!--- End Menu -->
    </div>
    <div class="navbar" role="banner" id="header" style="position:fixed;z-index:100;width: 100%;border-radius: 0px;height:75px;margin-top:0px;background-color:#fff;border-bottom:1px solid #ebebeb;display: block">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand hidden-xs" href="<?php echo base_url();?>"> <img src='<?php echo base_url();?>assets/zing_new/img/nav-logo.png' alt="logo" style="margin-top: 10px;width: 170px;"> </a>
                <a class="navbar-brand mobile-brand hidden-sm hidden-md hidden-lg" href="/home"> <img src="<?php echo base_url();?>assets/zing_new/img/nav-logo.png" style="width: 142px;margin-top: 9px;    margin-left: -10px;"> </a>
            </div>
            <nav>
                <ul class="reset" role="navigation" style="margin-top:13px;">
                    <li style="margin-top:5px">
						<img src="<?php if( isset($logged_in_user_data->image) &&$logged_in_user_data->image!=NULL){ 
						    echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image;
						}
						else{
						    echo  base_url().'assets/images/default_profilepic.png';
						}
						?>" alt="User Image" style="border-radius: 50%;width:40px;height:40px;" />
					</li>
                    <li class="dropdown dasMenu">
                        <a href="javascript:void(0);" class="dropdown-toggle dsProfile" data-toggle="dropdown"> <span class="colorGreen"><?php echo $logged_in_user_details->name; ?></span> <!--<span class="caret menu_caret colorGreen"></span>--> </a>
                        
                    </li>
                    <li style="margin-top:8px"> </li>
                    <li class="dropdown notifications">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-bell" style="font-size:16px;"></i> <span class="label label-warning">10</span> </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                    <ul class="menu" style="overflow-x: scroll; width: 100%; height: 200px;">
                                        <li> <a href="#"> 5 new members joined today
                                </a> </li>
                                        <li> <a href="#"> Very long description here that may not fit into the
                                  page and may cause design problems
                                </a> </li>
                                        <li> <a href="#">5 new members joined
                                </a> </li>
                                        <li> <a href="#"> 25 sales made
                                </a> </li>
                                        <li> <a href="#"> You changed your username
                                </a> </li>
                                    </ul>
                                    <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px;"></div>
                                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                                </div>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <li style="margin-top:8px"> </li>
                    <li id="menu" data-toggle="offcanvas" data-target=".navmenu" style="cursor:pointer;font-size: 22px;margin-top:6px;"><span class="fa fa-bars"></span></li>
                </ul>
            </nav>
        </div>
    </div>