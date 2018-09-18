<html>
    <head>
        <?php
        if (isset($title) && $title != '') {
            $page_title = $title;
        } else {
            $page_title = 'ZingUpLife | About us';
        }
        ?>
        <title><?php echo $page_title; ?></title>

        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Zinguplife" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
         <link rel="icon" href="<?php echo base_url(); ?>assets/zing_new/image/favicon.ico" type="image/gif" sizes="16x16">
        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/layers.min.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/font-awesome.min.css" media="screen">
        <link href="<?php echo base_url();?>assets/zing_new/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/zing_new/css/jasny-bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/style.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/custom.css" media="screen">
         <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/component.css" media="screen">
        <link href="<?php echo base_url();?>assets/zing_new/css/flags.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/zing_new/css/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/zing_new/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/zing_new/css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/zing_new/css/custom.css" media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/zing_new/css/clndr.css">
        <link href="<?php echo base_url();?>assets/zing_new/css/jquery.timepicker.css" rel="stylesheet">
         <link href="<?php echo base_url();?>assets/zing_new/css/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/zing_new/css/animate.css" media="screen">
        <script src="<?php echo base_url();?>assets/zing_new/js/modernizr.custom.js"></script>
       
        <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
        <link rel="icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <!--<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/zing_new/img/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>assets/zing_new/img/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>assets/zing_new/img/apple-touch-icon-152x152.png"> -->
	
	    <link rel="apple-touch-icon" sizes="76x76" href="http://zinguplife.com/assets/new_design/image/favicon.ico">

        <link rel="apple-touch-icon" sizes="120x120" href="http://zinguplife.com/assets/new_design/image/favicon.ico">

        <link rel="apple-touch-icon" sizes="152x152" href="http://zinguplife.com/assets/new_design/image/favicon.ico">
	
        <style type="text/css">
        .events .nav>li.active>a,
        .events .nav>li.active>a:focus,
        .events .nav>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
        }
        
        .events .nav>li>a {
            margin-right: -22px;
            line-height: 1.42857143;
            border-radius: 0px;
            font-size: 14px;
            background-color: #fff padding: 11px 25px;
            font-weight: 300;
            border-bottom: 1px solid #ebebeb;
        }
        
        .events .nav>li>a {
            position: relative;
            display: block;
            padding: 10px 37px;
        }
        
        .events .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
        }
        
        .events .nav>li {
            position: relative;
            display: block;
        }
        
        .events .tab-border .tab-content {
            border-left: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            padding: 30px;
            background-color: #fff;
        }
        
        .hasBackground {
            background-repeat: no-repeat;
            background-size: cover;
            height: 660px;
            width: 100%;
        }
        
        .hasBackground h4 {
            margin-top: 215px;
            color: #fff;
        }
        
        .hasBackground h6 {
            margin-top: 20px;
            color: #fff;
            font-size: 42px;
        }
        
        .green {
            color: #fff;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 1px solid #fff;
            padding-bottom: 7px;
        }
        
        #btn_start {
            border: 0px;
            border-radius: 5px;
            font-size: 18px;
            font-family: 'Lato', sans-serif;
            font-weight: 600;
            background-color: #f39c12;
            color: #fff;
            padding: 7px 30px;
        }
        
        .values p {
            font-size: 15px;
        }
        
        .team {
            border: 1px solid #c3c3c3;
            padding: 37px 20px;
            text-align: center;
            transition: all 0.8s;
            min-height: 10px;
            margin-bottom: 30px;
        }
        
        .team .line {
            width: 29px;
            border-bottom: 2px solid #ff3333;
            right: 0;
            left: 0;
            text-align: center;
            margin: 0 auto;
            margin-top: -10px;
        }
        
        p {
            font-size: 16px;
        }
        
        .team {
            border: 1px solid #c3c3c3;
            padding: 25px 20px;
            text-align: center;
            transition: all 0.8s;
            min-height: 10px;
            margin-bottom: 30px;
        }
        
        .team1 {
            color: #fff;
            padding: 10px 20px;
            transition: all 0.8s;
            min-height: 231px;
            margin-bottom: 30px;
            background-color: #00a651;
        }
        
        a {
            text-decoration: none;
        }
        
        .profile {
            background-color: #fff;
            min-height: 250px;
        }
        
        .profile p {
            margin-top: 0px;
            font-size: 12px;
            padding: 10px;
        }
        
        .profile h6 {
            margin-top: -10px;
            font-size: 12px;
        }
        
        .links {
            width: 98px;
            height: 37px;
            -webkit-transform: skew(-20deg);
            -moz-transform: skew(-20deg);
            -o-transform: skew(-20deg);
            background: #009746;
            position: relative;
            top: 16px;
            margin-top: -10px;
        }
        
        .icons {
            -webkit-transform: skew(20deg);
            -moz-transform: skew(20deg);
            -o-transform: skew(20deg);
            color: #fff;
        }
        
        .icons .fa {
            color: #fff;
            font-size: 15px;
        }
        
        .icons li {
            padding-right: 12px;
        }
        
        form {
            max-width: 600px;
            text-align: center;
            margin: 20px auto;
        }
        
        form input,
        form textarea {
            border: 0;
            outline: 0;
            padding: 1em;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
            display: block;
            width: 93%;
            margin-top: 1em;
            font-family: 'Merriweather', sans-serif;
            -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            resize: none;
        }
        
        form input:focus,
        form textarea:focus {
            -moz-box-shadow: 0 0px 2px #e74c3c !important;
            -webkit-box-shadow: 0 0px 2px #e74c3c !important;
            box-shadow: 0 0px 2px #e74c3c !important;
        }
        
        form #input-submit {
            color: white;
            background: #f39c12;
            cursor: pointer;
        }
        
        form #input-submit:hover {
            -moz-box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
            -webkit-box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
            box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
        }
        
        form textarea {
            height: 126px;
        }
        
        .half {
            float: left;
            width: 48%;
            margin-bottom: 1em;
        }
        
        .right {
            width: 50%;
        }
        
        .left {
            margin-right: 2%;
        }
        
        @media (max-width: 480px) {
            .half {
                width: 100%;
                float: none;
                margin-bottom: 0;
            }
        }
        /* Clearfix */
        
        .cf:before,
        .cf:after {
            content: " ";
            /* 1 */
            display: table;
            /* 2 */
        }
        
        .cf:after {
            clear: both;
        }
    </style>

    </head>
	
   <body class="page" style="padding-left: 0px !important">
<input type='hidden' class='url' value='<?php echo base_url();?>' />
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
   <!-- Off Canvas Navigation
    ================================================== -->
    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas" style="z-index:212">
        <!--- Off Canvas Side Menu -->
        <!-- <div class="close" data-toggle="offcanvas" data-target=".navmenu" style="z-index:212">
            <span class="fa fa-close"></span>
        </div> -->
        <a href='<?php echo base_url();?>'><img src="<?php echo base_url();?>assets/zing_new/img/logo.png" width="190px" style="margin-top: 14px;padding-left:2px;"></a>
        <ul class="nav navmenu-nav" style="margin-top: 15px;">
            <!--- Menu -->
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
								 <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                            <li><a href="<?php echo base_url(); ?>my_profile">My Profile</a></li>
                                           
								<?php } ?>
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
				<li><a href="http://zinguplife.com/knowledgebase/">BLOG</a></li>
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
				<li> <a href="<?php echo base_url(); ?>vendor/registration" class="">PARTNER WITH US</a></li>
				<?php  if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme' ){ ?>
					<li><a href="<?php echo base_url(); ?>experts/logout">Log Out</a></li>
				<?php } else if ($is_logged_in == 1) { ?>
					 <li><a href="<?php echo base_url(); ?>logout">Log Out</a></li>
				<?php } ?>
        </ul>
        <!--- End Menu -->
    </div>

    <div class="navbar" role="banner" id="header" style="position:fixed;z-index:100;width: 100%;border-radius: 0px;height:75px;margin-top:0px;background-color:#fff;border-bottom:1px solid #ebebeb;display: block">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand " href="<?php echo base_url();?>">
                        <img src='<?php echo base_url();?>assets/zing_new/img/nav-logo.png' alt="logo" style="margin-top: 10px;width: 170px;margin-left: 45px;">
                    </a>
                  
                    
                </div>
                 <nav> 
                    <ul class="reset" role="navigation" style="margin-top:13px; margin-right: 65px;">
					<?php  if(!($this->session->userdata('is_logged_in')) || ($is_logged_in !=1)){ ?>
                    <li>
						<form class="" method="post" action="<?php echo base_url(); ?>search" novalidate="novalidate">
							<input type="text" class="form-control" Placeholder="Type here and press enter" style="margin-top:8px;width:280px;font-size:12px;font-weight:300;" />
						</form>
					</li>
					<?php } ?>
                    <li class="menu-item" style='padding-top:8px;'>
							<?php if ($is_logged_in == 0 && $this->session->userdata('is_logged_in') ==0) { ?>    
                            <a href="<?php echo base_url(); ?>login">
                                <button type="submit" class="btn btn-login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button>
                            </a>
						 <?php }?>
                        </li>
                        <li style="margin-top:8px">
                             <select style="height:33px;background:transparent;color:#f39c12;border-radius:5px;border:0px;margin-left:30px;cursor:pointer;" class='sear_city'>
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
								<li>
									<?php if($logged_in_user_details->image == '') {?>
                                                <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style="height:40px;width:40px;float:left;display:inline;">
											<?php } else {?>
												<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $logged_in_user_details->user_id; ?>/<?php echo $logged_in_user_details->image; ?>" style="height:40px;width:40px;float:left;display:inline;">
											<?php } ?>
											<span style='line-height:45px;margin-left:10px;'><?php echo $logged_in_user_details->name; ?></span>
								</li>
								<?php }?>
						
								<?php  if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme' ){ ?>
						<li>
							<?php if ($this->session->userdata('photo') != '') { ?>
								<img class="user_icon"  src="<?php echo $smepath . $this->session->userdata('sme_userid') . '/' . $this->session->userdata('photo'); ?>" style="height:40px;width:40px;float:left;display:inline;">
							<?php } else { ?>
								<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='float:left;display:inline;'>
							<?php } ?>
							<span style='line-height:45px;margin-left:10px;'><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span>
						</li>
								<?php }  ?>
                        <li id="menu" data-toggle="offcanvas" data-target=".navmenu" style="cursor:pointer;font-size: 22px;margin-top:6px;"><span class="fa fa-bars"></span></li>
                        
                    </ul>
                </nav>
             
            </div>
    </div>