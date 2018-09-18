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
    <meta property="og:url" content="<?php echo base_url();?>survey/home"/>
    <meta property="og:title" content="Your Personalized 8BAK-C1 Wellness Assessment"/>
    <meta property="og:image" content="<?php echo base_url();?>assets/survey_new/img/eu.jpg"/>
    <meta property="og:site_name" content="ZingUpLife"/>
    <meta property="og:description" content="The 8BAK-C is a short1 and engaging confidential online tool that guides you through a series of questions about your lifestyle habits and helps assess deeper levels of your personal well-being.."/>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Zinguplife" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico" type="image/gif" sizes="16x16">
    
        <!-- bootstarp css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assessment/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/freshslider.min.css">
    <link href='<?php echo base_url(); ?>assets/css/font-roboto.css' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
    <link href='<?php echo base_url(); ?>assets/css/font-montserrat.css' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/survey_new/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/css/component.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/survey_new/dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/assessment/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/dist/css/component1.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/survey_new/dist/css/default1.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/survey_new/dist/css/font-awesome.min.css" media="screen">
    <link href='<?php echo base_url(); ?>assets/css/font-lato.css' rel='stylesheet' type='text/css'>
    <!-- datepicker -->
    <!-- end datepicker-->
    <script src="<?php echo base_url();?>assets/survey_new/dist/js/modernizr.custom.js"></script>
<!--     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

    <!--    calender date-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assessment/css/wbn-datepicker.css">
    <!--    end calender date-->
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/assessment/css/clndr.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/assessment/css/font-awesome.min.css" media="screen">
    <link href="<?php echo base_url();?>assets/survey_new/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
   <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '601815649968732'); 
    fbq('track', 'PageView');
    </script>
    <noscript>
     <img height="1" width="1" 
    src="https://www.facebook.com/tr?id=601815649968732&ev=PageView
    &noscript=1"/>
    </noscript>
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
    
/* figure{
        -webkit-box-shadow: 7px 7px 19px -9px rgba(0,0,0,0.75); 
        -moz-box-shadow: 7px 7px 19px -9px rgba(0,0,0,0.75); 
        box-shadow: 7px 7px 19px -9px rgba(0,0,0,0.75); 
        border:1px solid #ebebeb; 
    }*/
 #msform {
    margin: -242px auto;
    position: relative;
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
            <div class="row">
                <div class="screen-only" style="padding-right:225px; margin-top:10px; float:right; font-size:13px; color:#000;">24/7 Support&nbsp;&nbsp;&nbsp;+91 98863 50650  |  support@zinguplife.com</div>
                <div class="col-sm-12 col-md-12 col-lg-8 col-lg-offset-2" style="padding-left:0px;padding-right:0px;">
                    
                    <ul class="list-inline" role="navigation" id="menu">
                        
                        
                    <div class="screen-only">
                            
                            <li style="float:right; margin-top:15px;">
                                <?php if ($is_logged_in == 0) { ?>    
                               <a href="<?php echo base_url(); ?>login">
                                   <button type="submit" class="btn btn-login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button>
                               </a>
                                <?php }?>
                            </li>
                            <?php if ($is_logged_in == 1) { ?>						
                            <li style='color:#000;float:right; margin-top:15px; margin-bottom: 10px'>           
                            <?php if ($logged_in_user_data->image != '') { ?>                                           
                            <img class="user_icon"  src="<?php echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>">  
                            <?php } else { ?>                                           
                            <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">     
                            <?php } echo $logged_in_user_details->name; } ?>
                            </li>
                            <li style="margin-top:15px; float:right; margin-bottom: 10px">
                               <select style="height:33px;background:transparent;color:#f39c12;border-radius:5px;border:0px;margin-left:30px;" class='sear_city'>
                                   <option value='Bangalore' selected="selected" style="display: none;color:#f39c12;text-transform:capitalize;"><?php 
                            if($this->session->userdata('place') != '')
                            {
                                echo ucfirst($this->session->userdata('place')); 
                            }
                            else{
                                echo ucfirst($this->session->userdata('place2')); 
                            }
                                    ?></option>
                                   <option value='Delhi & NCR'>Delhi & NCR</option>
                                   <option value='Bangalore'>Bangalore</option>
                               </select>
                            </li>
                            <li id="showRight" style="float:right; margin-top:25px; margin-bottom: 10px; display: inline-block;cursor: pointer; cursor: hand;">
                                <i class="fa fa-bars" aria-hidden="true" style="font-size:25px;color:#000;margin-left:20px;"></i>
                            </li>
                         </div>    
                <div class="mobile-only">
                    <?php if ($is_logged_in == 0) { ?>
                    <li style="float:right; margin-top:0px;">
                        <a href="<?php echo base_url(); ?>login">
                        <button type="submit"  style="border:none;">
                        <img src="<?php echo base_url();?>assets/experts_new/img/login-logo.png" alt="logo" />
                        </button>
                       </a>
                    </li>
                    <?php } ?>
                    
                    <?php if ($is_logged_in == 1) { ?>						
                    <li style='color:#000;float:right; margin-top:10px; margin-right: 20px;'>           
                    <?php if ($logged_in_user_data->image != '') { ?>                                           
                    <img class="user_icon"  src="<?php echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>">  
                    <?php } else { ?>                                           
                    <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">     
                    <?php } echo $logged_in_user_details->name;  ?> 
                    </li>
                    <?php } ?>
                    
                    <li>
                        <p style="text-align:left; margin-top:20px;"> 
                            <a href='<?php echo base_url();?>'><img  src="<?php echo base_url();?>assets/zing_user/img/nav-logo.png" alt="logo" style="width: 155px;margin-top: 9px;    margin-left: 10px;" /></a>
                        </p>
                    </li> 
                    
                </div>
                        <div class="screen-only">
                        <li>
                            <p style="text-align:left; margin-top:0px;">
                                <?php if($this->input->cookie("org_assessment")){ ?>
                                	<a href='<?php echo base_url();?>'><img  src="<?php echo base_url();?>assets/home_page/images/gpj_web.png" alt="logo"/></a>
                                <?php }else{?>
                                    <a href='<?php echo base_url();?>'><img  src="<?php echo base_url();?>assets/zing_user/img/nav-logo.png" alt="logo"/></a>
                             	<?php } ?>
                            </p>
                        </li>
                        </div>
<!--                        <li id="showRight" style="cursor: pointer; cursor: hand; float:left;" > 
                            <i class="fa fa-bars" aria-hidden="true" style="font-size:25px;margin-top:15px; margin-left:15px;color:#000;"></i> 
                        </li>-->
                        
                         
                         
                        
                        
                        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
                            <a><img src="<?php echo base_url();?>assets/zing_user/img/logo.png" width="190px" style="margin-top: 14px;"></a>
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
                                    <a href="<?php echo base_url();?>knowledgebase/">BLOG</a>
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