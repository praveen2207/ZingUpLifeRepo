<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="google-site-verification" content="qEw3ux_M-eIw_ld_Q4fxhiX3p6yIhXgcXqchxTSIciw" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ZingUpLife is India's first and largest marketplace with fitness and wellness experts, yoga, zumba and gym trainers, life coaches, nutritionists, therapists etc. ZingUpLife will be the guardian of your health">
   
    <meta property="og:url" content="https://zinguplife.com"/>
	<meta property="og:title" content="Your Wellness Buddy"/>
	<meta property="og:image" content="https://zinguplife.com/assets/images/ZUL_icon.png"/>
	<meta property="og:site_name" content="ZingUpLife"/>
    <meta property="og:description" content="Live Appsolutely Healthy."/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="Spa, fitness, experts, Ayurveda, personal trainer, life coach, naturopathy, nutritionist, fitness trainer, zumba, integrative wellbeing">
    <meta name="author" content="Zinguplife" >
    <title>ZingUpLife | Spa, gym, yoga, Zumba, life coach, nutritionist details</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/home/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="<?php echo base_url();?>assets/home/css/agency.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><img src ='<?php echo base_url();?>assets/zing_new/img/nav-logo.png' style="max-width:200px;"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header only for Desktop -->
    <header class="hidden-sm hidden-xs">
        <div class="container">
            <div class="intro-text">
                <div class="row">  
                    <div class="hexagon1_text">Determine your <?php echo $assessment_1['theme_name'];?></div>
                    <div class="hexagon2_text">Determine your <?php echo $assessment_2['theme_name'];?></div>
                    <div class="hexagon3_text" >Determine your <?php echo $assessment_3['theme_name'];?></div>
                    <div class="col-md-6" style="padding-left: 200px; margin-top:155px;">    

                        <div class="hexagon1">
                            <input type="hidden" id="bio_theme_id" value="<?php echo $assessment_1_theme_id; ?>">
                            <input type="hidden" id="bio_test_id" value="<?php echo $assessment_1_level_id; ?>">
                            <a style="outline: 0;cursor: pointer;" onclick="bio_asses_theme();"><img src="<?php echo base_url();?>assets/home_page/images/icon1_biologicalage.png" class="hexLink"  /></a>
                        </div>
                        <div style="clear:both;"></div>
                            <div class="hexagon2">
                                <input type="hidden" id="diet_theme_id" value="<?php echo $assessment_2_theme_id; ?>">
                                <input type="hidden" id="diet_test_id" value="<?php echo $assessment_2_level_id; ?>">
                                <a style="outline: 0;cursor: pointer;" onclick="diet_asses_theme();"><img src="<?php echo base_url();?>assets/home_page/images/icon2_dietscore.png"/></a>
                            </div>
                        </a>
                        <div style="clear:both;"></div>
                            <div class="hexagon3">
                                <input type="hidden" id="wns_theme_id" value="<?php echo $assessment_3_theme_id; ?>">
                                <input type="hidden" id="wns_test_id" value="<?php echo $assessment_3_level_id; ?>">
                                <a class="hexLink"  style="outline: 0;cursor: pointer;" onclick="wns_asses_theme();"><img src="<?php echo base_url();?>assets/home_page/images/icon3_overallwellness.png"/></a>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">  
                         <div class="intro-heading" style="text-transform:none;">Re-Discover <br/> Yourself</div>
<!--                        <h2>Re-Discover <br/> Yourself</h2>
                        <div style="position:absolute;padding-right: 195px; padding-top:155px; font-size: 19px;"><h2>Re-Discover <br/> Yourself</h2></div>-->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="hidden-md hidden-lg">
        <div class="jumbotron" style="padding-top:0;margin-bottom: 0;">&nbsp;</div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading-white" style="text-transform:none;">Re-Discover <br>yourself</h3>
                </div>
            </div>
          <div class="row">
            <div style="clear:both;height:10px;"></div>
            <div class="col-sm-12">
                <div class="col-xs-6">
                    <div style="float:left;">
                    <a style="outline: 0;cursor: pointer;" onclick="bio_asses_theme();"><img src="<?php echo base_url();?>assets/home/img/assessment/bioage.png" class="hexLink"  /></a>
                    </div>
                    <div class="hexagon1_text_mobile" style="float:left;">Determine your <br><?php echo $assessment_1['theme_name'];?></div>
		</div>
		 
            </div>
            <div style="clear:both;height:30px;"></div>
            <div class="col-sm-12">
              <div class="col-xs-6">
                  <div style="float:left;">
                    <a style="outline: 0;cursor: pointer;" onclick="diet_asses_theme();"><img src="<?php echo base_url();?>assets/home/img/assessment/dietscore.png"/></a>
                    </div>
                  <div class="hexagon1_text_mobile" style="float:left;">Determine your <br><?php echo $assessment_2['theme_name'];?></div>
		</div>
            </div>
            <div style="clear:both;height:30px;"></div>
            <div class="col-sm-12">
              <div class="col-xs-6">
                    <div style="float:left;">
                    <a class="hexLink"  style="outline: 0;cursor: pointer;" onclick="wns_asses_theme();"><img src="<?php echo base_url();?>assets/home/img/assessment/wholesomeness.png"/></a>
                    </div>
                    <div class="hexagon1_text_mobile" style="float:left;">Determine your <br><?php echo $assessment_2['theme_name'];?></div>
		</div>
            </div>
            <div style="clear:both;height:30px;"></div>
          </div>
        </div>
    </header>
    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading">All your wellbeing in one place</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="<?php echo base_url();?>assets/zing_new/img/assess.png"/>
<!--                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>-->
                    </span>
                    <h4 class="service-heading">ASSESS</h4>
                    <p class="text-muted">Personal Wellbeing assessment and insightful tracking with our truly comprehensive scientific tests and your personal wellness dashboard.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <img src="<?php echo base_url();?>assets/zing_new/img/consult.png"/>
                    </span>
                    <h4 class="service-heading">CONSULT</h4>
                    <p class="text-muted">Search, discover, book and follow hundreds of leading Wellness Experts, Therapists and Coaches, over phone, chat and video. </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                       <img src="<?php echo base_url();?>assets/zing_new/img/engage.png"/>
                    </span>
                    <h4 class="service-heading">ENGAGE</h4>
                    <p class="text-muted">To Get access to our curated knowledge base, and a large & verified wellness provider network across multiple locations. </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray" style="background-color: #ffc80a;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading-white">Wellness and Fitness Experts</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Round Icons</h4>
                        <p class="text-muted">Graphic Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/startup-framework.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Startup Framework</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/treehouse.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Treehouse</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/golden.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Golden</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/escape.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Escape</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/dreams.png" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Dreams</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services" style="background-color: rgb(63, 171, 60);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading-white">Know Your Well Being</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x" style="width: 5em;">
                        <img src="<?php echo base_url();?>assets/zing_new/img/icon1.png"/>
<!--                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>-->
                    </span>
                    <h4 class="service-heading-white">8BAK-C Personal assessment</h4>
                    <p class="text-muted-white">The 8BAK-C assesses over 80 factors related to your wellbeing â€� across physical, emotional, intellectual, spiritual, social, occupational, environmental & financial wellness dimensions â€� the 8 dimensions of human wellness as defined by the World Health Organization</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x" style="width: 5em;">
                        <img src="<?php echo base_url();?>assets/zing_new/img/icon2.png"/>
                    </span>
                    <h4 class="service-heading-white">Wellness Tools and Resources</h4>
                    <p class="text-muted-white">Aâ€�laâ€�carte wellness tools, curated knowledge base, and bespoke programs to help individuals and employers create a happier and healthier lifestyle </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x" style="width: 5em;">
                       <img src="<?php echo base_url();?>assets/zing_new/img/icon3.png"/>
                    </span>
                    <h4 class="service-heading-white">Ask a question</h4>
                    <p class="text-muted-white">Quick and easy access to our global network of certified wellness advisors and contributors, anytime, anywhere. Personalized and anonymous! </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section 
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Kay Garland</h4>
                        <p class="text-muted">Lead Designer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Larry Parker</h4>
                        <p class="text-muted">Lead Marketer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/3.jpg" class="img-responsive img-circle" alt="">
                        <h4>Diana Pertersen</h4>
                        <p class="text-muted">Lead Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/envato.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Your Website 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/roundicons-free.png" alt="">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <p>
                                    <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                                <ul class="list-inline">
                                    <li>Date: July 2014</li>
                                    <li>Client: Round Icons</li>
                                    <li>Category: Graphic Design</li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>Project Heading</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/startup-framework-preview.png" alt="">
                                <p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
                                <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/treehouse-preview.png" alt="">
                                <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/golden-preview.png" alt="">
                                <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/escape-preview.png" alt="">
                                <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">
                                <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. Itâ€™s a beautiful template thatâ€™s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/home/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/home/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo base_url();?>assets/home/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo base_url();?>assets/home/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/home/js/agency.min.js"></script>
    <script>
        function bio_asses_theme(){
	    var theme_id=$('#bio_theme_id').val();
	    var test_id=$('#bio_test_id').val();
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function diet_asses_theme(){
	    var theme_id=$('#diet_theme_id').val();
	    var test_id=$('#diet_test_id').val();
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/diet_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
	function wns_asses_theme(){
	    var theme_id = $('#wns_theme_id').val();
	    var test_id = $('#wns_test_id').val();
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/wholesomeness_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
    </script>
        
</body>

</html>
