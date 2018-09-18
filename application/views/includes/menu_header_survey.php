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
		<meta property="og:title" content="Your Personalized 8BAK-C Wellness Assessment"/>
		<meta property="og:image" content="http://zinguplife.com/assets/survey_new/img/eu.jpg"/>
		<meta property="og:site_name" content="ZingUpLife"/>
		<meta property="og:description" content="The 8BAK-C is a short2 and engaging confidential online tool that guides you through a series of questions about your lifestyle habits and helps assess deeper levels of your personal well-being.."/>
        
        <meta charset="UTF-8">
          <meta name="description" content="">
        <meta name="keywords" content="">
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
     <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
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
    
    </head>
    <body>
		<input type='hidden' name='' class='url' value='<?php echo base_url();?>'/>
        <div class="wrapper">
            <div class=" header-container">
                <div class="container">
					
					<!--localization-->
						<div class='local' style='margin-top:5px;'>
							<div class='city_left'>
								<p class='city' style='text-transform:capitalize;cursor:pointer;'><?php 
								if($this->session->userdata('place') != '')
								{
									echo $this->session->userdata('place'); 
								}
								else{
									echo $this->session->userdata('place2'); 
								}
								?></p>
								<div class='city_search'>
									<div class='search_header'>
										<input type='text' name='city' class='cityadded' placeholder='Enter your City'/>
										<input type='button' value='Search' class='sear_city'/>
									</div>
									<div class='top_searched'>
										<h5>TOP SEARCHED</h5>
										<p>Bangalore,Bengaluru,Gurgoan
										<br/>
										<span class='all' style='color:red;cursor:pointer;'>All Cities</span>
										</p>
										
									</div>
								</div>
							</div>
							<div class='country_right'>
								<p class='add_country' value='india'><span class='couny'>
								<?php if($this->session->userdata('country') == 'india') { ?>
									<img src='<?php echo base_url(); ?>assets/images/country/india.gif' width="20px" height="20px"/>
								<?php } else if($this->session->userdata('country') == 'france') {  ?>
									<img src='<?php echo base_url(); ?>assets/images/country/france.gif' width="20px" height="20px"/>
								<?php } ?>
								</span>
								<span class='country_arrow'><img src='<?php echo base_url(); ?>assets/images/country/arrow_down.png' width="15px" height="15px"/></span>
								</p>
								<ul class='country' style='display:none;'>
									<li value='india'><img src='<?php echo base_url(); ?>assets/images/country/india.gif' width="20px" height="20px"/></li>
									<li value='france'><img src='<?php echo base_url(); ?>assets/images/country/france.gif' width="20px" height="20px"/></li>
								</ul>	
							</div>
						</div>
						<div style='clear:both;'></div>
					<!--localization-->
					
                    <header>
                        <?php
                        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
                        if (!empty($logged_in_user_details)) {
                            $is_logged_in = $logged_in_user_details->is_logged_in;
                        } else {
                            $is_logged_in = '';
                        }
                        ?>
                        <nav class="navbar comman_header ">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header logoImg">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#zing-home-header" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/new_design/image/logo.png" alt="zinguplife.com"></a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <?php if ($is_logged_in == 1) { ?>
                                <div class="dropdown dasMenu pull-right loginImg"> 
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                        <?php if ($logged_in_user_data->image != '') { ?>
                                            <img class="user_icon"  src="<?php echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>">
                                        <?php } else { ?>
                                            <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">
                                        <?php } ?>
                                        <span class="colorGreen"><?php echo $logged_in_user_details->name; ?></span>
                                        <span class="caret menu_caret colorGreen"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                        <li><a href="<?php echo base_url(); ?>my_profile">My Profile</a></li>
                                        <li><a href="<?php echo base_url(); ?>logout">Log Out</a></li>
                                    </ul>
                                </div>
                            <?php } ?>
                            <div class="collapse navbar-collapse zingList" id="zing-home-header">
                                <ul class="nav navbar-nav navbar-right">
                                    <?php if ($active_url == 'service_providers') { ?>
                                        <li><a href="<?php echo base_url(); ?>search" class="activeList partnerBtn" style='color:#000;'>SERVICES & PROVIDERS</a></li>
                                    <?php } else { ?>
                                        <li style='padding: 0 10px;font-size:13px;'><a href="<?php echo base_url(); ?>search" class="" style='color: #4e4e4e;padding: 25px 0px;border-top: 3px solid #fff;font-weight: 600;'>SERVICES & PROVIDERS</a></li>
                                    <?php } ?>
                                    <li style='padding: 0 10px;font-size:13px;'><a href="<?php echo base_url(); ?>experts/home" style='color: #4e4e4e;padding: 25px 0px;border-top: 3px solid #fff;font-weight: 600;'>EXPERTS</a></li>
                                    <li style='padding: 0 10px;font-size:13px;'><a href="http://zinguplife.com/knowledgebase/" style='color: #4e4e4e;padding: 25px 0px;border-top: 3px solid #fff;font-weight: 600;'>BLOG</a></li>
                                    <?php if ($active_url == 'workplace') { ?>
                                        <li><a href="<?php echo base_url(); ?>workplace" class="activeList partnerBtn">CORPORATE OFFERINGS</a></li>
                                    <?php } else { ?>
                                        <li style='padding: 0 10px;font-size:13px;'><a href="<?php echo base_url(); ?>workplace" class="" style='color: #4e4e4e;padding: 25px 0px;border-top: 3px solid #fff;font-weight: 600;'>CORPORATE OFFERINGS</a></li>
                                    <?php } ?>
                                    <?php if ($active_url == 'contact_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">CONTACT</a></li>
                                    <?php } else { ?>
                                        <li style='padding: 0 10px;font-size:13px;'><a href="<?php echo base_url(); ?>contact_us" class="" style='color: #4e4e4e;padding: 25px 0px;border-top: 3px solid #fff;font-weight: 600;'>CONTACT</a></li>
                                    <?php } ?>
                                    <li style='padding: 0 10px;font-size:13px;'><a href="<?php echo base_url(); ?>vendor/registration" class="" style='color: #4e4e4e;padding: 25px 0px;border-top: 3px solid #fff;font-weight: 600;'>PARTNER WITH US</a></li>
									<?php if($this->input->cookie('zingup_wellness_survey')) { $logged_in_user_details = $this->session->userdata('logged_in_user_data');
										if (!empty($logged_in_user_details)) { if($userid == $logged_in_user_details->user_id) {?>
									<li><a href="<?php echo base_url(); ?>survey/home" class="">Assessment</a></li>
										<?php } } else { ?>										
									<li><a href="<?php echo base_url(); ?>survey/home" class="">Assessment</a></li>
									<?php } } else if($this->session->userdata('assessment')) {?>
										<li><a href="<?php echo base_url(); ?>survey/home" class="">Assessment</a></li>
									<?php }  ?>
                                    <?php if ($is_logged_in != 1) { ?>
                                        <li style='padding: 0 10px;font-size:13px;'><a href="<?php echo base_url(); ?>login" type="button" class="btn zing-btn loginBtn" style='padding: 8px 12px;margin: 15px 0;height: 40px;'>Login/Signup</a></li>
                                        <?php }
                                        ?>
                                </ul>
                            </div>
                        </nav>
                    </header>
                </div>
            </div>
</div>