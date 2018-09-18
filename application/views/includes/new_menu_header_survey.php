<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        if (isset($title) && $title != '') {
            $page_title = $title;
        } else {
            $page_title = 'ZingUpLife | Home';
        }
        $path = base_url() . 'assets/uploads/users/';
        ?>
        <title><?php echo $page_title; ?></title>
		<meta property="og:url" content="http://zinguplife.com/survey/home"/>
		<meta property="og:title" content="Your Personalized 8BAK-C1 Wellness Assessment"/>
		<meta property="og:image" content="http://zinguplife.com/assets/survey_new/img/eu.jpg"/>
		<meta property="og:site_name" content="ZingUpLife"/>
		<meta property="og:description" content="The 8BAK-C is a short1 and engaging confidential online tool that guides you through a series of questions about your lifestyle habits and helps assess deeper levels of your personal well-being.."/>
        
        <meta charset="UTF-8">
        <meta name="description" content="8BAK-C is build and validated by practitioners based on world health organization framework which will not take more than 15 minutes">
        <meta name="keywords" content="Wellness,assessment,World Health Organization,wellbeing,8BAK-C,confidential,15 minutes">
        <meta name="author" content="Zinguplife" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="icon" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico" type="image/gif" sizes="16x16">
        <!-- bootstarp css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/freshslider.min.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/contact.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/about.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/search.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/search-responsive.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/survey_new/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/css/main.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/survey_new/css/component.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/survey_new/css/font-awesome.css" rel="stylesheet">
	 <link href="<?php echo base_url();?>assets/survey_new/dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/dist/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/dist/css/component1.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/dist/css/default1.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/survey_new/dist/css/font-awesome.min.css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
	
    <script src="<?php echo base_url();?>assets/survey_new/dist/js/modernizr.custom.js"></script>
     
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!--        <script type="text/javascript">var switchTo5x = true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "45c52943-55a6-30a9-05ca-c86ff3c9717e", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>
    -->
    <style>
	
	body { padding-top: 70px; }
	.btn-login {
    background-color: #f39c12;
    color: #fff;
    border: 1px solid #f39c12;
    border-radius: 5px;
    }
    
    .btn-login:hover {
    background-color: transparent;
    color: #000;
    border: 1px solid #f39c12;
}

#subscription_submit {
    background: none;
    border: none;
    float: left;
    position: absolute;
    top: -2px;
    right: 72px;
}

.footer-icons li {
    padding-right: 0px !important;
}
.meta-social ul li a.twitter-share:hover, ul.meta-social li a.twitter-share:hover {
    border-color: #00acee;
    background-color: #00acee;
}
footer .meta-social ul li a:hover {
    color: #fff;
}
.meta-social ul li a:hover,
ul.meta-social li a:hover {
    color: #fff;
}

.meta-social ul li a.dribbble-share:hover,
ul.meta-social li a.dribbble-share:hover {
    border-color: #ea4c89;
    background-color: #ea4c89;
}

.meta-social ul li a.facebook-share:hover,
ul.meta-social li a.facebook-share:hover {
    border-color: #3b5998;
    background-color: #3b5998;
}

.meta-social ul li a.flickr-share:hover,
ul.meta-social li a.flickr-share:hover {
    border-color: #0063dc;
    background-color: #0063dc;
}

.meta-social ul li a.github-share:hover,
ul.meta-social li a.github-share:hover {
    border-color: #171515;
    background-color: #171515;
}

.meta-social ul li a.gplus-share:hover,
ul.meta-social li a.gplus-share:hover {
    border-color: #dd4b39;
    background-color: #dd4b39;
}

.meta-social ul li a.instagram-share:hover,
ul.meta-social li a.instagram-share:hover {
    border-color: #3f729b;
    background-color: #3f729b;
}

.meta-social ul li a.linkedin-share:hover,
ul.meta-social li a.linkedin-share:hover {
    border-color: #0e76a8;
    background-color: #0e76a8;
}

.meta-social ul li a.pinterest-share:hover,
ul.meta-social li a.pinterest-share:hover {
    border-color: #c8232c;
    background-color: #c8232c;
}

.meta-social ul li a.skype-share:hover,
ul.meta-social li a.skype-share:hover {
    border-color: #00aff0;
    background-color: #00aff0;
}

.meta-social ul li a.twitter-share:hover,
ul.meta-social li a.twitter-share:hover {
    border-color: #00acee;
    background-color: #00acee;
}

.meta-social ul li a.vimeo-share:hover,
ul.meta-social li a.vimeo-share:hover {
    border-color: #44bbff;
    background-color: #44bbff;
}

.meta-social ul li a.youtube-share:hover,
ul.meta-social li a.youtube-share:hover {
    border-color: #c4302b;
    background-color: #c4302b;
}

footer .meta-social ul li {
    padding-right: 0.5em;
    padding-left: 0;
}

 .logo{
	 padding-bottom:0px;
 }   
   h5.text-center
   {
	   margin-top:0px;
   }   
    
    </style>
    </head>
    <body>
		<input type='hidden' name='' class='url' value='<?php echo base_url();?>'/>
 <div id="hidden_scroll">
        <?php

                        $logged_in_user_details = $this->session->userdata('logged_in_user_data');

                        if (!empty($logged_in_user_details)) {

                            $is_logged_in = $logged_in_user_details->is_logged_in;

                        } else {

                            $is_logged_in = '';

                        }

                        ?>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style='margin-bottom:0px;'>
            <div class="">
                <div class="col-sm-12 col-md-12 col-lg-8 col-lg-offset-2" style="padding-left:0px;padding-right:0px;">
                    <ul class="list-inline" role="navigation" id="menu">
                     <div class="mobile-only">
		                         <li style="float:right; margin-top:10px;">
								 <?php if ($is_logged_in == 0) { ?>    
		                            <a href="<?php echo base_url(); ?>login">
		                                <button type="submit"  style="border:none;">
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
		                         
                         </div>
                        <li>
                            <p style="text-align:left; margin-top:15px;"> <a href='<?php echo base_url();?>'>
								<img  src="<?php echo base_url();?>assets/experts_new/img/nav-logo-mobile.png" alt="logo" />
							</a></p>
                        </li>
                        <li id="showRight" style="cursor: pointer; cursor: hand; float:left;" > 
                        	<i class="fa fa-bars" aria-hidden="true" style="font-size:25px;margin-top:15px; margin-left:15px;color:#000;"></i> 
                        </li>
                        
                         
                         <div class="screen-only">
		                         <li style="float:right; margin-top:31px;">
								 <?php if ($is_logged_in == 0) { ?>    
		                            <a href="<?php echo base_url(); ?>login">
		                                <button type="submit" class="btn btn-login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button>
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
		                         <li style="margin-top:31px; float:right;">
		                            <select style="height:33px;background:transparent;color:#f39c12;border-radius:5px;border:0px;margin-left:30px;" class='sear_city'>
		                                <option value='Bangalore' selected="selected" style="display: none;color:#f39c12;text-transform:capitalize;"><?php 
										if($this->session->userdata('place') != '')
										{
											echo $this->session->userdata('place'); 
										}
										else{
											echo $this->session->userdata('place2'); 
										}
										?></option>
		                                <option value='Delhi & NCR'>Delhi & NCR</option>
		                                <option value='Bangalore'>Bangalore</option>
		                            </select>
		                        </li>
                         </div>
                        
                        
                        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
                            <a><img src="<?php echo base_url();?>assets/experts_new/img/logo.png" width="190px" style="margin-top: 14px;"></a>
							<?php if ($is_logged_in == 1) { ?><a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
							<a href="<?php echo base_url(); ?>my_profile">My Profile</a>	<?php } ?>
                           <?php if ($active_url == 'service_providers') { ?>				
	                                <a href="<?php echo base_url(); ?>search" class="activeList partnerBtn">SERVICES & PROVIDERS</a>
                                    <?php } else { ?>
                                       <a href="<?php echo base_url(); ?>search" class="">SERVICES & PROVIDERS</a>
                                    <?php } ?>
                                    <?php if ($active_url == 'experts') { ?>
                                        <a href="<?php echo base_url(); ?>experts/home" class="activeList partnerBtn">EXPERTS</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>experts/home" class="">EXPERTS</a>
                                    <?php } ?>
                                    <a href="http://zinguplife.com/knowledgebase/">BLOG</a>
                                    <?php if ($active_url == 'about_us') { ?>
                                        <a href="<?php echo base_url(); ?>about_us" class="activeList partnerBtn">ABOUT</a>
                                    <?php } else{
                                    	if ($active_url != 'workplace') { ?>
                                    	<a href="<?php echo base_url(); ?>workplace" class="">CORPORATE OFFERINGS</a>
                                    <?php } }
                                     if ($active_url == 'workplace') { ?>
                                        <a href="<?php echo base_url(); ?>workplace" class="activeList partnerBtn">CORPORATE OFFERINGS</a>
                                    <?php }
                                    if ($active_url == 'contact_us') { ?>
                                        <a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">CONTACT</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>contact_us" class="">CONTACT</a>
                                    <?php } ?>
                                   <a href="<?php echo base_url(); ?>vendor/registration" class="">PARTNER WITH US</a>
								   <?php if ($is_logged_in == 1) { ?><a href="<?php echo base_url(); ?>logout">Log Out</a><?php } ?>
						</nav>
				
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>