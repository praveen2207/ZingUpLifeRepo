<?php
	$requestURI = $_SERVER['REQUEST_URI'];
	$expertsLoginPattern = "/\/experts\/login/";
	$logged_in_user_details = $this->session->userdata('logged_in_user_data');
	if (!empty($logged_in_user_details)) {
		$is_logged_in = $logged_in_user_details->is_logged_in;
		$isLoggedIn = 1;
	} else {
		$is_logged_in = '';
		$isLoggedIn = 0;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    	<meta name="google-site-verification" content="qEw3ux_M-eIw_ld_Q4fxhiX3p6yIhXgcXqchxTSIciw" />
        <?php
        if (isset($title) && $title != '') {
            $page_title = $title;
        } else {
            $page_title = 'ZingUpLife | Home';
        }
        $path = base_url() . 'assets/uploads/users/';
        ?>
        <title><?php echo $page_title; ?></title>

        <meta charset="UTF-8">
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="keywords" content="">
        <meta name="author" content="Zinguplife" >
        <link rel="icon" href="<?php echo base_url(); ?>assets/new_design/image/favicon.ico" type="image/gif" sizes="16x16"/>
		<?php if($active_url == 'survey_page'){?>
		<!-- Bootstrap -->
		    <link href="<?php echo base_url();?>assets/survey_new/css/bootstrap.css" rel="stylesheet">
		    <link href="<?php echo base_url();?>assets/survey_new/css/main.css" rel="stylesheet">
			<link href="<?php echo base_url();?>assets/survey_new/css/component.css" rel="stylesheet">
		     <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
		<?php } if($active_url == 'contact_us'){?>
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/contact.css">
        <?php } if($active_url == 'about_us'){?>
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/about.css">
        <?php } ?>
        <?php if ($active_url == 'workplace'){?>
       	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/workplace/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/workplace/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/workplace/css/bootstrap-select.min.css">
		<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/font-roboto.css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/workplace/css/zingupcustom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
        <?php } else if($active_url == 'experts' || $active_url == 'service_providers') {?>
        <!-- bootstarp css -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-select.min.css">
		<link href='<?php echo base_url(); ?>assets/css/font-roboto.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/zingupcustom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-datepicker3.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/experts/css/jquery-ui.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/experts/js/jquery.min.js"></script>
        <?php  }else if($active_url == 'login'){?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap.min.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/contact.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-roboto.css"/>

        <?php } else if (preg_match($expertsLoginPattern, $requestURI)){?>
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-select.min.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/zingupcustom.css">
        	<style type="text/css">
	        	.form-group {
	    			overflow: hidden;
				}
        	</style>
        <?php }else if($active_url == 'home_page') {?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/experts/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/freshslider.min.css">
        <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/font-roboto.css'>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
     	
        <?php }else {?>
        <!-- bootstarp css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/bootstrap-datepicker3.min.css">
        
        <link rel='stylesheet' type='text/css' href="<?php echo base_url(); ?>assets/css/grid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/menu-css.css" />
        <link rel='stylesheet' type='text/css' href="<?php echo base_url(); ?>assets/css/custom.css" />
        <link rel='stylesheet' type='text/css' href="<?php echo base_url(); ?>assets/css/terms.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/freshslider.min.css">
        <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/font-roboto.css'>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/contact.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/search-responsive.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/zingupcustom.css">
        <?php  } ?>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_design/css/search.css">
		<?php if($active_url == 'survey_page'){?>
		 <style type="text/css">
	        	body {
				    background: #fff;
				}
        	</style>
		<?php } ?>
        <script type="text/javascript">
        	var switchTo5x = true;
   			var isLoggedIn = <?php echo $isLoggedIn;?>;
   			var baseURL = '<?php echo base_url();?>';
   			var activeURL = '<?php echo $active_url;?>';
        </script>
		
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sharethis-buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "45c52943-55a6-30a9-05ca-c86ff3c9717e", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>
    
    </head>
    <body>
        <div class="wrapper">
            <div class=" header-container">
                <div class="container">
				
					<!--localization-->
						<div class='local' style='margin-top:5px;'>
							<!-- <div class="notify_link fl">
								<span onclick="toggleNotificationBlock();" class="notification_icon">
									<img src="<?php echo base_url(); ?>assets/images/notification_icon.png" />
								</span>
								<span id="notification_count"></span>
								<div id="notifications_block">
									<input type="hidden" name="n_content" id="notification_content" value="0"/>
									<div class="arrow-up grey"></div>
									<div class="bbottom pbl10"><h5 class="txt-bold">Notificaitons</h5></div>
									<div class="ajax-loader">&nbsp;</div>
									<div id="notifications_area"></div>
								</div>	
							</div>
							<div class='city_left'>
								<p class='city' style='text-transform:capitalize;cursor:pointer;margin-left: 10px;'><?php 
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
									<img src='<?php echo base_url(); ?>assets/images/country/india.gif' width="20px" height="20px" title="India"/>
								<?php } else if($this->session->userdata('country') == 'france') {  ?>
									<img src='<?php echo base_url(); ?>assets/images/country/france.gif' width="20px" height="20px" title="France"/>
								<?php } ?>
								</span>
								<span class='country_arrow'><img src='<?php echo base_url(); ?>assets/images/country/arrow_down.png' width="15px" height="15px"/></span>
								</p>
								<ul class='country' style='display:none;'>
									<li value='india'><img src='<?php echo base_url(); ?>assets/images/country/india.gif' width="20px" height="20px" title="India"/></li>
									<li value='france'><img src='<?php echo base_url(); ?>assets/images/country/france.gif' width="20px" height="20px" title="France"/></li>
								</ul>	
							</div> -->
							<!-- <div style="padding-left:130px;">
                                      24/7 Support&nbsp;&nbsp;&nbsp;+91 98863 50650 |  support@zinguplife.com
                          	</div> -->
						</div>
						<div class="clear">&nbsp;</div>
					<!--localization-->
					
                    <header>
                        
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
                                    <?php if ($active_url == 'experts') { ?>
                                        <li><a href="<?php echo base_url(); ?>experts/home" class="activeList partnerBtn">EXPERTS</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>experts/home" class="">EXPERTS</a></li>
                                    <?php } ?>
                                    <li><a href="http://zinguplife.com/knowledgebase/">BLOG</a></li>
                                    <?php if ($active_url == 'about_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>about_us" class="activeList partnerBtn">ABOUT</a></li>
                                    <?php } else{
                                    	if ($active_url != 'workplace') { ?>
                                    	<li><a href="<?php echo base_url(); ?>workplace" class="">CORPORATE OFFERINGS</a></li>
                                    <?php } }
                                     if ($active_url == 'workplace') { ?>
                                        <li><a href="<?php echo base_url(); ?>workplace" class="activeList partnerBtn">CORPORATE OFFERINGS</a></li>
                                    <?php }
                                    if ($active_url == 'contact_us') { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="activeList partnerBtn">CONTACT</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo base_url(); ?>contact_us" class="">CONTACT</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>vendor/registration" class="">PARTNER WITH US</a></li>
                                    <?php if ($is_logged_in != 1) { ?>
                                        <!--<li>
                                        <?php if($active_url == 'experts'){?>
                                        <a href="<?php echo base_url(); ?>experts/login" type="button" class="btn zing-btn loginBtn">Expert Login/Signup</a>
                                        <?php } else {?>
                                        <a href="<?php echo base_url(); ?>login" type="button" class="btn zing-btn loginBtn">Login/Signup</a>
                                        <?php } ?>
                                        </li>-->
										<li>
                                            <?php if($active_url!='login'){ ?>
                                        <a href="<?php echo base_url(); ?>login" type="button" class="btn zing-btn loginBtn">Login/Signup</a>
                                        <?php } ?>
                                        </li>
                                        <?php }
                                        ?>
                                        
                                </ul>
                             
                            </div>
                        </nav>
                       
                        
                    </header>
                     
                </div>
                			<?php if($active_url =='terms'){?>
                			<div class="nav-bg"> 
                                <div class="container">   
                                    <?php
                                    $url = $this->uri->segment(2);
                                    if (isset($url)) {
                                        if ($is_logged_in != '2') {
                                            $url_segments = explode('=', $url);
                                            if (!empty($url_segments)) {
                                                $active_url_segment = $url_segments[1];
                                            }
                                        } else {
                                            $active_url_segment = '';
                                        }
                                    }
                                    ?>
                                    <nav>            
                                        <div class="menu-btn"><img src="<?php echo base_url(); ?>assets/images/btn-hamburger.png" alt=""> Menu</div>
                                        <ul class="menu">
                                            <?php if (isset($active_url_segment)) { ?>
                                                <?php if ($active_url_segment == 'spa') { ?>
                                                    <li class="active-menu"><a href="<?php echo base_url(); ?>search/keyword=spa">Spa</a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?php echo base_url(); ?>search/keyword=spa">Spa</a></li>
                                                <?php } ?>
                                                <?php if ($active_url_segment == 'ayurvedic_treatments') { ?>
                                                    <li class="active-menu"><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments">Ayurvedic Treatments</a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments">Ayurvedic Treatments</a></li>
                                                <?php } ?>
                                                <?php if ($active_url_segment == 'yoga') { ?>
                                                    <li class="active-menu"><a href="<?php echo base_url(); ?>search/keyword=yoga">Yoga</a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?php echo base_url(); ?>search/keyword=yoga">Yoga</a></li>
                                                <?php } ?>
                                                <?php if ($active_url_segment == 'fitness') { ?>
                                                    <li class="active-menu"><a href="<?php echo base_url(); ?>search/keyword=fitness">Fitness</a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?php echo base_url(); ?>search/keyword=fitness">Fitness</a></li>
                                                <?php } ?>

                                            <?php } else { ?>
                                                <li><a href="<?php echo base_url(); ?>search/keyword=spa">Spa</a></li>
                                                <li><a href="<?php echo base_url(); ?>search/keyword=ayurvedic_treatments">Ayurvedic Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>search/keyword=yoga">Yoga</a></li>
                                                <li><a href="<?php echo base_url(); ?>search/keyword=fitness">Fitness</a></li>
                                            <?php } ?>
                                        </ul>             
                                        <div class="clear"></div>
                                    </nav>
                                </div>
                            </div>
                            <?php } ?>
            </div>
