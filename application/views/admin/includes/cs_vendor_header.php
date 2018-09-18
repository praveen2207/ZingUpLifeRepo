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

        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/cs-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/cs_custom.css" rel="stylesheet">
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
        <!--<link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.css" />
        <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>

        <script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
       
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

        <!--[if lt IE 9]>
    
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    
        <![endif]-->
        <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
         <script>
                    tinymce.init({
                        selector: '#cs_description'
                    });
                    tinymce.init({
                        selector: '#cs_service_description'
                    });
                    tinymce.init({
                        selector: '.add_cs_service_description'
                    });

                </script>
    </head>
    <body>
        <div class="container admin-container">
            <?php if (isset($logged_in_user_details)) { ?>
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
                        
                          <ul class="user-menu-section">
                              
                            <?php if ($sub_url == 'customer_support/business_info') { ?>
                                <li><a href="<?php echo base_url(); ?>cs/business_information/<?php echo $business_id; ?>" class="admin_menu_link nav-sel">Business information</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>cs/business_information/<?php echo $business_id; ?>" class="admin_menu_link">Business information</a></li>
                            <?php } ?>

                            <?php if ($sub_url == 'customer_support/packages_treatments') { ?>
                                <li><a href="<?php echo base_url(); ?>cs/packages_treatments/<?php echo $business_id; ?>" class="admin_menu_link nav-sel">Packages/Treatments</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>cs/packages_treatments/<?php echo $business_id; ?>" class="admin_menu_link">Packages/Treatments</a></li>
                            <?php } ?>
                             <?php if ($sub_url == 'customer_support/business_services') { ?>
                                <li><a href="<?php echo base_url(); ?>cs/business_services/<?php echo $business_id; ?>" class="admin_menu_link nav-sel">Business services</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>cs/business_services/<?php echo $business_id; ?>" class="admin_menu_link">Business services</a></li>
                            <?php } ?>
                                <?php if ($sub_url == 'customer_support/business_services_slots') { ?>
                                <li><a href="<?php echo base_url(); ?>cs/business_service_slots/<?php echo $business_id; ?>" class="admin_menu_link nav-sel">Business Hours</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>cs/business_service_slots/<?php echo $business_id; ?>" class="admin_menu_link">Business Hours</a></li>
                            <?php } ?>
                             <?php if ($sub_url == 'customer_support/one_day_packages') { ?>
                                <li><a href="<?php echo base_url(); ?>cs/one_day_packages/<?php echo $business_id; ?>" class="admin_menu_link nav-sel">One day packages</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>cs/one_day_packages/<?php echo $business_id; ?>" class="admin_menu_link">One day packages</a></li>
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
                        <ul class="menu-section bb" id="admin_menu">
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
            
