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
            $page_title = 'ZingUpLife | Spa, gym, yoga, Zumba, life coach, nutritionist details';
        }
        $path = base_url() . 'assets/uploads/users/';
        ?>
        <title><?php echo $page_title; ?></title>

        <meta charset="UTF-8">
        <meta name="description" content="ZingUpLife is India's first and largest marketplace with fitness and wellness experts, yoga, zumba and gym trainers, life coaches, nutritionists, therapists etc. ZingUpLife will be the guardian of your health">
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
    <meta name="keywords" content="Spa, fitness, experts, Ayurveda, personal trainer, life coach, naturopathy, nutritionist, fitness trainer, zumba, integrative wellbeing,counselling">
    <meta name="author" content="Zinguplife" >
    <link rel="icon" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/layers.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/font-awesome.min.css" media="screen">
    <link href="<?php echo base_url();?>assets/zing_new/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/zing_new/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/style.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/custom.css" media="screen">
    <link href="<?php echo base_url();?>assets/zing_new/css/flags.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/zing_new/css/component.css" />
    <script src="<?php echo base_url();?>assets/zing_new/js/modernizr.custom.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/home_page/css/boostrap-select.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-montserrat.css" >
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
    <link rel="icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <!--<link rel="apple-touch-icon" sizes="76x76" href="http://zinguplife.com/assets/zing_new/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://zinguplife.com/assets/zing_new/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://zinguplife.com/assets/zing_new/img/apple-touch-icon-152x152.png">-->
	
	 <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico">
    
</head>

<body class="page" style="padding-left: 0px !important">
    <!--
    <div class="header-top">
        <ul class="reset list-inline" role="navigation">
            <li>Bangalore</li>
            <li>
                <form>
                    <div class="form-group">
                        <div id="basic" data-input-name="country"></div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
-->
    <!-- Off Canvas Navigation
    ================================================== -->
	<input type='hidden' value='<?php echo base_url();?>' class='url' />
    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas" style="z-index:212">
        <!--- Off Canvas Side Menu -->
        <!-- <div class="close" data-toggle="offcanvas" data-target=".navmenu" style="z-index:212">
            <span class="fa fa-close"></span>
        </div> -->
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/zing_new/img/logo.png" width="190px" style="margin-top: 14px;padding-left:2px;"></a>
        <ul class="nav navmenu-nav" style="margin-top: 15px;">
            <!--- Menu -->			<?php if ($is_logged_in == 1) { ?>							<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>							 <li><a href="<?php echo base_url(); ?>my_profile">My Profile</a></li>		<?php } ?>
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
    
    <!--- End Off Canvas Side Menu -->
    <header role="banner" class="transparent light normal-header" style="top:-41px;background-color:#fff;border-bottom:1px solid #ebebeb;">
        <div class="row">
        <div style="padding-right:155px; float:right; font-size:13px;">24/7 Support&nbsp;&nbsp;&nbsp;+91 98863 50650  |  support@zinguplife.com</div>
            <div class="nav-inner row-content buffer-left buffer-right even clear-after">
                <div id="brand">
                    <h1 class="reset">
                    	<?php if($this->input->cookie("org_assessment")){?>
        					<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/home_page/images/<?php echo $org_logo; ?>" ></a>
        				<?php }else{ ?>
                    		<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/zing_new/img/nav-logo.png" style="width: 252px;margin-top: -3px;"></a>
                    	<?php }?>
                    </h1>
          		</div>
                <a id="menu-toggle" href="#"><i class="fa fa-bars fa-lg"></i></a>
                <nav>
                    <ul class="reset" role="navigation">
                    	<li><a href='https://play.google.com/store/apps/details?id=com.zinguplife.mobileapp&hl=en'><img src='<?php echo base_url(); ?>assets/home/img/assessment/android_download_mweb.png' height='50px' width='50px'/></a></li>
                        <?php if ($is_logged_in == 0) { ?>                        
                        <li class="menu-item">                            
                            <a href="<?php echo base_url(); ?>login"><button type="submit" class="btn btn-login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button></a>                        
                        </li>					 
                        <?php } ?>
                        <?php if ($is_logged_in == 1) { ?>						
                        <li>
                            <p style='padding-top:11px;'><?php echo $logged_in_user_details->name; ?></p>
                        </li>
                        <?php } ?>
                        <li data-toggle="offcanvas" data-target=".navmenu">
                            <i class="fa fa-bars" aria-hidden="true" style="font-size:25px;margin-top:11px;"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- row-content -->
        </div>
        <!-- row -->
    </header>
    <header role="banner" class="transparent light mobile-header hidden-sm hidden-md hidden-lg">
        <div class="row">
            <div class="nav-inner row-content buffer-left buffer-right even clear-after">
                <div id="brand">
                    <h1 class="reset"><!--<immobig src="img/logo.png" alt="logo">-->
                        <?php if($this->input->cookie("org_assessment")){?>
            					<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/home_page/images/gpj_mobile.png" style="margin-top: 10px;"></a>
            			<?php }else{ ?>
                        		<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/zing_new/img/nav-logo.png" style="width: 142px;margin-top: 9px;    margin-left: -10px;"></a>
                        <?php }?>
                    </h1>
            	</div>
                <!-- <img src="<?php echo base_url(); ?>assets/uploads/org_logos/gpj_logo.png" style="height: 50px;margin-top:50px"> -->   
                <div><a href='https://play.google.com/store/apps/details?id=com.zinguplife.mobileapp&hl=en'><img src='<?php echo base_url(); ?>assets/home/img/assessment/android_download_mweb.png' height='50px' width='50px' style="clear: both;float: left;"/></a></div> 
                <!-- brand --><a id="menu-toggle"  class='test2' href="#" data-toggle="offcanvas" data-target=".navmenu"><i class="fa fa-bars fa-lg"></i></a>
                           
            </div>
            <!-- row-content -->
        </div>
        <!-- row -->
    </header>
    <div class="navbar hidden-xs hidden-sm" role="banner" id="header" style="position:fixed;z-index:100;width: 100%;border-radius: 0px;height:85px;margin-top:0px;background-color:#fff;border-bottom:1px solid #ebebeb">
        <div class="row" style="top:5px;">
        <div style="padding-right:155px; float:right; font-size:13px;">24/7 Support&nbsp;&nbsp;&nbsp;+91 98863 50650  |  support@zinguplife.com</div>
            <div class="nav-inner row-content buffer-left buffer-right even clear-after">
                <div id="brand">
                    <h1 class="reset"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/zing_new/img/nav-logo.png" style="width: 252px;margin-top: -3px;"></a></h1> </div>
                <a id="menu-toggle" href="#"><i class="fa fa-bars fa-lg"></i></a>
                <nav>
                    <ul class="reset" role="navigation">
                    	<li><a href='https://play.google.com/store/apps/details?id=com.zinguplife.mobileapp&hl=en'><img src='<?php echo base_url(); ?>assets/home/img/assessment/android_download_mweb.png' height='50px' width='50px'/></a></li>
                        <?php if ($is_logged_in == 0) { ?>                        
                        <li class="menu-item">                            
                            <a href="<?php echo base_url(); ?>login"><button type="submit" class="btn btn-login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button></a>                        
                        </li>					 
                        <?php } ?>
                        <?php if ($is_logged_in == 1) { ?>						
                        <li>
                            <p style='padding-top:11px;'><?php echo $logged_in_user_details->name; ?></p>
                        </li>
                        <?php } ?>
                        <li data-toggle="offcanvas" data-target=".navmenu">
                            <i class="fa fa-bars" aria-hidden="true" style="font-size:25px;margin-top:11px;"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- row-content -->
        </div>
    </div>
