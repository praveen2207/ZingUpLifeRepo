<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
           <meta name="author" content="Zinguplife" >

        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/admin/images/favicon.ico">
        <!-- Le styles -->

        <link href="<?php echo base_url(); ?>assets/experts_new/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/cs-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/cs-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/finance-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/super-admin-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/ion.calendar.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/admin/css/datepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery.datepick.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/font-montserrat.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/font-quattrocento.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts_new/css/jquery-ui.css">
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
		
		<!-- Include Date Range Picker -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css/daterangepicker.css" />

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

        <!--[if lt IE 9]>
    
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    
        <![endif]-->
        <script src='<?php echo base_url();?>assets/admin/js/tinymce.min.js'></script>
         <script>
                    tinymce.init({
                        selector: '#cs_description'
                    });
                    tinymce.init({
                        selector: '#cs_service_description'
                    });

                </script>
    </head>
    <body>
        <div class="container admin-container">
            <?php $sub_url = '';
            if (isset($logged_in_user_details)) { ?>
                <div class="header cs-header"> 
                    <a class="logo admin-logo" href=""><img src="<?php echo base_url(); ?>assets/admin/images/logo.png"/></a>
                    <ul class="user-links">
                        <li>Welcome, <?php echo $logged_in_user_details->name; ?></li>
                        <li>|</li>
                        <li>User ID: <?php
                            echo $logged_in_user_details->user_id;
                            ?></li>
                        <li>|</li>
                        <li><a class="blue" href="<?php echo base_url(); ?>admin/reset_password">Reset Password</a></li>
                        <li>|</li>
                        <li><a class="blue"  href="<?php echo base_url(); ?>admin_logout">Logout</a></li>
                    </ul>
                </div>
                <?php if ($logged_in_user_details->role == 2) { ?>
                    <div class="nav-collapse">
                        <ul class="menu-section" id="admin_menu">
                            <?php if ($url == 'customer_support/transactions') { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/transactions" class="admin_menu_link nav-sel">Transactions</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/transactions" class="admin_menu_link">Transactions</a></li>
                            <?php } ?>
                            <?php if ($url == 'customer_support/vendors') { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/vendors" class="admin_menu_link nav-sel">Vendors</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/vendors" class="admin_menu_link">Vendors</a></li>
                            <?php } ?>

                            <?php if ($url == 'customer_support/customers') { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/customers" class="admin_menu_link nav-sel">Customers</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/customers" class="admin_menu_link">Customers</a></li>
                            <?php } ?>
                            <?php if ($url == 'customer_support/faqs') { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/faqs"  class="admin_menu_link nav-sel">FAQ</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>customer_support/faqs"  class="admin_menu_link">FAQ</a></li>
                            <?php } ?>


                        </ul>
                    </div>
                <?php } elseif ($logged_in_user_details->role == 3) { ?> 
                    <div class="nav-collapse">
                        <ul class="menu-section" id="admin_menu">
                            <?php if ($url == 'finance/transactions') { ?>
                                <li><a href="<?php echo base_url(); ?>finance/transactions" class="admin_menu_link nav-sel">Transactions</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>finance/transactions" class="admin_menu_link">Transactions</a></li>
                            <?php } ?>
                            <?php if ($url == 'finance/vendors') { ?>
                                <li><a href="<?php echo base_url(); ?>finance/vendors" class="admin_menu_link nav-sel">Vendors</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>finance/vendors" class="admin_menu_link">Vendors</a></li>
                            <?php } ?>

                            <?php if ($url == 'finance/customers') { ?>
                                <li><a href="<?php echo base_url(); ?>finance/customers" class="admin_menu_link nav-sel">Customers</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>finance/customers" class="admin_menu_link">Customers</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } else {
                    ?>
                    <div class="nav-collapse">
                        <ul class="menu-section" id="admin_menu">
                            <?php if ($url == 'admin/transactions') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/transactions" class="admin_menu_link nav-sel">Transactions</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/transactions" class="admin_menu_link">Transactions</a></li>
                            <?php } ?>
                            <?php if ($url == 'admin/vendors') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/vendors" class="admin_menu_link nav-sel">Vendors</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/vendors" class="admin_menu_link">Vendors</a></li>
                            <?php } ?>

                            <?php if ($url == 'admin/customers') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/customers" class="admin_menu_link nav-sel">Customers</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/customers" class="admin_menu_link">Customers</a></li>
                            <?php } ?>
                            <?php if ($url == 'admin/users') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/users" class="admin_menu_link nav-sel">Users</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/users" class="admin_menu_link">Users</a></li>
                            <?php } ?>

			    <?php if ($sub_url == 'sme_users') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/sme_users" class="admin_menu_link nav-sel">Sme Users</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/sme_users" class="admin_menu_link">Sme Users</a></li>
                            <?php } ?>
			    <?php if ($url == 'admin/tips') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/wellness_tips/tips" class="admin_menu_link nav-sel">Wellness Tips</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/wellness_tips/tips" class="admin_menu_link">Wellness Tips</a></li>
                            <?php } ?>
	                            <li><a href="<?php echo base_url(); ?>admin/assessment/interpretation_users" class="admin_menu_link <?php if ($url == 'admin/assessment/interpretation_users') { ?>  nav-sel <?php } ?>">Assessment Users</a></li>
				     			<li><a href="<?php echo base_url(); ?>admin/Analytics_controller/page_visitors_view" class="admin_menu_link <?php if ($url == 'admin/Analytics_controller/page_visitors_view') { ?>  nav-sel <?php } ?>">Analytics</a></li>
				     			<li><a href="<?php echo base_url(); ?>admin/Events/get_users_event_detail" class="admin_menu_link <?php if ($url == "admin/Events/get_users_event_detail") { ?>  nav-sel <?php } ?>">Events</a></li>
				     			<li><a href="<?php echo base_url(); ?>admin/Org_access_code" class="admin_menu_link <?php if ($url == "admin/Org_access_code") { ?>  nav-sel <?php } ?>">Org Access Code</a></li>
                        </ul>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="header cs-header"> 
                    <a class="logo admin-logo" href="<?php echo base_url(); ?>admin"><img src="<?php echo base_url(); ?>assets/admin/images/logo.png"/></a>
                    <ul class="user-links">
                        <li>Welcome</li>
                     
                </div>
            <?php } ?>
            
