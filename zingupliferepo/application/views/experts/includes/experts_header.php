<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Zinguplife">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/gif" sizes="16x16"/>
    <!-- bootstarp css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-roboto.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/zingupcustom.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-datepicker3.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.5.0/css/intlTelInput.css"/>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/experts/css/jquery-ui.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery.min.js"></script>
    <style>
        .form-group{ overflow:hidden; }
        .like_article,.unlike_article{ cursor:pointer; color:green; }
        .imgCard2{ margin-right:0px; width:7%; }
        .rederror {
            color:red;
            margin-top:10px;
        }   
        .form-group
        {
            overflow:hidden;
        }
        .like_article,.unlike_article
        {
            cursor:pointer;
            color:green;
        }
        .imgCard2
        {
            margin-right:0px;
            width:7%;
        }
    </style>
    </head>
    <body>
	<input type='hidden' class='url' value='<?php echo base_url(); ?>' />
        <div class="wrapper">
             
            <div class=" header-container">
                <div class="container">
                    <div style="padding-right:20px; float:right; font-size:13px;">24/7 Support&nbsp;&nbsp;&nbsp;+91 98863 50650  |  support@zinguplife.com</div>
                    <div style="clear:both;"></div>
                    <header>
                        <nav class="navbar comman_header ds_header">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header logoImg">
                                <button type="button" class="navbar-toggle collapsed dsToggle" data-toggle="collapse" data-target="#zing-home-header" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand logo dsLogo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/experts/image/logo.png" alt="zinguplife.com"></a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="pull-right notificationBox">
                                <!--<div class="notification">
                                    <ul>
                                        <li>
                                            <span class="messageIcon"></span>
                                            <div class="blogs">5</div>
                                        </li>
                                        <li>
                                            <span class="bellIcon"></span>
                                            <div class="blogs">5</div>
                                        </li>
                                    </ul>
                                </div>-->
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
                                    <div  class="dropdown dasMenu  loginImg login_panel_ctr"> 
                                        <a href="javascript:void(0);" class="dropdown-toggle dsProfile" data-toggle="dropdown">
                                            
                                                <!--<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">-->
												<?php if($logged_in_user_details->image == '') {?>
                                                <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">
											<?php } else {?>
												<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $logged_in_user_details->user_id; ?>/<?php echo $logged_in_user_details->image; ?>">
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
                                <?php } elseif($this->session->userdata('is_logged_in') == true ){ ?>
                             <div  class="dropdown dasMenu  loginImg login_panel_ctr"> 
                                        <a href="javascript:void(0);" class="dropdown-toggle dsProfile" data-toggle="dropdown">
                                            <?php if ($this->session->userdata('photo') != '') { ?>
                                                <img class="user_icon"  src="<?php echo $smepath . $this->session->userdata('sme_userid') . '/' . $this->session->userdata('photo'); ?>" style="height:40px;width:40px;">
                                            <?php } else { ?>
                                                <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png">
                                            <?php } ?>
                                            <span class="colorGreen"><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span>
                                            <span class="caret menu_caret colorGreen"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(); ?>experts/dashboard">Dashboard</a></li>
                                            <li><a href="<?php echo base_url(); ?>experts/profile">My Profile</a></li>
                                            <li><a href="<?php echo base_url(); ?>experts/logout">Log Out</a></li>
                                        </ul>
                                    </div> 
                                                                    <?php } ?>
                            </div>

                            <div class="collapse navbar-collapse zingList dS" id="zing-home-header">
                                <ul class="nav navbar-nav navbar-right
								<?php if ($this->session->userdata('is_logged_in') != true) { ?>
								not-logged
								<?php }?>
								" >
								<?php  if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme' ){ ?>
									<li><a href="<?php echo base_url(); ?>experts/dashboard" class="">DASHBOARD</a></li>
									<?php } ?>
                                  <!--<li><a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">Dashboard</a></li>-->
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
								
                                </ul>
									<?php $logged_in_user_details = $this->session->userdata('logged_in_user_data'); 
									if ($logged_in_user_details->is_logged_in != 1 && $this->session->userdata('type') !='sme') { ?>
										<p class="btn zing-btn serBtn not-log-btn" style='float: right;margin-top:12px;'><a href="<?php echo base_url(); ?>experts/login" >Expert Login/Signup</a></p>
									 <?php } ?>
								 
                            </div>
                            
                        </nav>
                    </header>
                </div>
            </div>
