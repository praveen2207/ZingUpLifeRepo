<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		    <meta name="author" content="Zinguplife" >
            <title>zinguplife</title>
            <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico"/> 
            <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet"/>
                <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>
                <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"/>
                <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet"/>
                <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet"/>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">

                <link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'/>
                <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700,700italic,400italic' rel='stylesheet' type='text/css'/>               
                <link type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/grid.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/layout.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontello.css" />
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />

                <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

                <script src="<?php echo base_url(); ?>assets/js/jquery.modernizr.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>  
                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootbox.js"></script> 

                </head>

                <?php
                if (isset($title)) {
                    if ($title != 'Home') {
                        ?>
                        <body class="innerpage">
                        <?php } else { ?>
                            <body>
                                <?php
                            }
                        }
                        $logged_in_vendor_data = $this->session->userdata('logged_in_vendor_data');


                        if (!empty($logged_in_vendor_data)) {
                            $is_logged_in = $logged_in_vendor_data->is_logged_in;
                        } else {
                            $is_logged_in = '';
                        }
                        ?>

                        <div id="header" class="transparent">	
                            <div class="header-in container clearfix">
                                <div class="top-header">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div id="logo">
                                                <a class="logo-click" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="zinguplife.com"/></a>
                                            </div>
                                        </div> 
                                        <div class="col-xs-8">
                                            <div class="right-header">
                                                <ul>
                                                    <?php
                                                    if (isset($logged_in_vendor_data)) {
                                                        if ($logged_in_vendor_data->is_logged_in == 1) {
                                                            ?>


                                                            <li>Welcome <?php echo $logged_in_vendor_data->name; ?>!</li>
                                                            <li><a class=""  href="<?php echo base_url(); ?>vendor/dashboard">My Profile</a></li>
                                                            <li><a class=""  href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                            <li><a class="" href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                            <li><a class="" href="<?php echo base_url(); ?>logout">Logout</a></li>

                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <li><a href="<?php echo base_url(); ?>login" class="button">Login/Signup</a>
                                                        <?php } ?>
                                                        <li><a href="" class="nav-toggle"><img src="<?php echo base_url(); ?>assets/images/search-icon.png" alt="" /></a>
                                                            <div id="show-content" style="display:none">
                                                                <div class="location-search">
                                                                    <form class="" method="post" action="<?php echo base_url(); ?>search" novalidate="novalidate">
                                                                        <div class="row">
                                                                            <div class="location-field">
                                                                                <select  name="city">
                                                                                    <option value="Bangalore">Bangalore</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="location-field">
                                                                                <input type="text" placeholder="Ex. Spa, Yoga" name="keywords"/>
                                                                            </div>
                                                                            <div class="location-field location-mark">
                                                                                <input type="text" placeholder="Bangalore, Bellandur" name="locations"/>
                                                                            </div>
                                                                            <div class="location-button">
                                                                                <input type="submit" value="Go" class="button" >
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </li>
                                                </ul>
                                            </div>
                                        </div>    
                                    </div>
                                </div>         	

                            </div>
                        </div>
