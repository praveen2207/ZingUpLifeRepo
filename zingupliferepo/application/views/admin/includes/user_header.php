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
        <link href="<?php echo base_url(); ?>assets/admin/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/cs-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/finance-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/super-admin-style.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700,700italic,400italic' rel='stylesheet' type='text/css'>



        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

        <!--[if lt IE 9]>
    
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    
        <![endif]-->
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
                        </ul>
                        <ul class="user-menu-section">

                            <?php if ($sub_url == 'users') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/users" class="admin_menu_link nav-sel">Users</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/users" class="admin_menu_link">Users</a></li>
                            <?php } ?>

                            <?php if ($sub_url == 'roles') { ?>
                                <li><a href="<?php echo base_url(); ?>admin/user_roles" class="admin_menu_link nav-sel">Users Role</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>admin/user_roles" class="admin_menu_link">Users Role</a></li>
                            <?php } ?>
                            <?php //if ($sub_url == 'permissions') { ?>
        <!--                                <li><a href="<?php echo base_url(); ?>admin/user_role_permissions" class="admin_menu_link nav-sel">Permissions</a></li>-->
                            <?php //} else { ?>
        <!--                                <li><a href="<?php echo base_url(); ?>admin/user_role_permissions" class="admin_menu_link">Permissions</a></li>-->
                            <?php //} ?>

                        </ul>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="header cs-header"> 
                    <a class="logo admin-logo" href="<?php echo base_url(); ?>/admin"><img src="<?php echo base_url(); ?>assets/admin/images/logo.png"/></a>
                    <ul class="user-links">
                        <li>Welcome</li>
                </div>
            <?php } ?>
            
