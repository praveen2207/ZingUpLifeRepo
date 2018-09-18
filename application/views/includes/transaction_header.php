<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <?php
        if (isset($title) && $title != '') {
            $page_title = $title;
        } else {
            $page_title = 'ZingUpLife | Home';
        }
        $path = base_url().'assets/uploads/users/';
        ?>
        <title><?php echo $page_title; ?></title>

         <meta charset="UTF-8">
        <meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="keywords" content="">
            <meta name="author" content="Zinguplife" >
        <link rel="icon" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico" type="image/gif" sizes="16x16">
        <!-- bootstarp css -->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/order_details/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/order_details/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/order_details/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/order_details/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/order_details/css/bootstrap-select.min.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/order_details/css/zingupcustom.css">


    </head>
    <body>
        <div class="wrapper">
            <div class=" header-container">
                <div class="container">
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
                                        <li><a href="<?php echo base_url(); ?>search" class="activeList partnerBtn">SERVICES & PROVIDERS</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>search" class="">SERVICES & PROVIDERS</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>sme">EXPERTS</a></li>
                                    <li><a href="http://zinguplife.com/knowledgebase/">BLOG</a></li>
                                    <?php if ($active_url == 'about_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>about_us" class="activeList partnerBtn">ABOUT</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>about_us" class="">ABOUT</a></li>
                                    <?php } ?>
                                    <?php if ($active_url == 'contact_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">CONTACT</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="">CONTACT</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>vendor/registration" class="">PARTNER WITH US</a></li>
                                    <?php if ($is_logged_in != 1) { ?>
                                        <li><a href="<?php echo base_url(); ?>login" type="button" class="btn zing-btn loginBtn">Login/Signup</a></li>
                                        <?php }
                                        ?>
                                </ul>
                            </div>
                        </nav>
                    </header>
                </div>
            </div>
