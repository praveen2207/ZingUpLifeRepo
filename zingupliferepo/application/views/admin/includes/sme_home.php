<div class="main-container sme-dashboard">    
    <div class="content">
        <div class="container">


            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="smehome-page">
                            <div class="sme-header">
                                <img src="<?php echo base_url(); ?>assets/sme/images/header-img.jpg" alt="" />
                            </div>
                            <div class="page-head center">
                                <h1>SME Home Page</h1>
                            </div>
                            <p>
                                One can not say enough good things about him. The possibility of hiring more employees like Mr. Naren should be discussed immediately. He has proven to be one of the company's larger investments. His work may greatly impact the company. Mr. Naren is willing to take risks.
                            </p>
                            <p>
                                One can not say enough good things about him. The possibility of hiring more employees like Mr. Naren should be discussed immediately. He has proven to be one of the company's larger investments. His work may greatly impact the company. Mr. Naren is willing to take risks.
                            </p>
                            <p>
                                One can not say enough good things about him. The possibility of hiring more employees like Mr. Naren should be discussed immediately. He has proven to be one of the company's larger investments. His work may greatly impact the company. Mr. Naren is willing to take risks.
                            </p>

                            <div class="featured-content">
                                <div class="featured-list">
                                    <ul>
                                        <?php $i = 0;
                                        foreach ($services as $service) {
                                            $i++;
                                            if ($i == 5) break; ?>
                                            <li>
                                                <div class="featured-inner">
                                                    <a href="#">
                                                        <div class="featured-img"><img alt="" src="<?php echo base_url(); ?>assets/uploads/services/<?php echo $service->image; ?>"></div>
                                                        <div class="featured-details">
                                                            <?php if ($service->id == 1) { ?>
                                                                <p>Looking for a SPA?</p>
                                                            <?php } else if ($service->id == 2) { ?>
                                                                <p>Need some ayurvedic treatments?</p>
                                                            <?php } else if ($service->id == 3) { ?>
                                                                <p>Yoga on your mind?</p>
    <?php } else if ($service->id == 4) { ?>
                                                                <p>Fitness Freak?</p>
                                                        <?php } ?>
                                                        </div>
                                                    </a>
                                                    <ul class="all-user-list">
                                                                    <?php foreach ($service->sme_users as $sme_user) { ?>
                                                            <li>
                                                                <div class="review-top-profile">
                                                                    <div class="row"> 
        <?php if ($sme_user->photo != '') { ?>
                                                                            <div class="col-xs-4">
                                                                                <div class="review-profile-img">
                                                                                    <a href="<?php echo base_url(); ?>sme_home/user/<?php echo $sme_user->sme_userid; ?>">
                                                                                        <img alt="" src="<?php echo base_url(); ?>sme_users/<?php echo $sme_user->sme_userid; ?>/<?php echo $sme_user->photo; ?>">                                        
                                                                                    </a>                                    
                                                                                </div>                                
                                                                            </div>
        <?php } ?>
                                                                        <div class="col-xs-8 ">
                                                                            <div class="top-profile-right-inner">
                                                                                <h2><a href="<?php echo base_url(); ?>sme_home/user/<?php echo $sme_user->sme_userid; ?>"><?php echo $sme_user->first_name; ?> <?php $sme_user->last_name; ?></h2></a>
                                                                                <p class="total-riview-link">
                                                                                    <?php if ($sme_user->rating == 4.5) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-four-half-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 4) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-four-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 5) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-five-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 3) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-three-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 3.5) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-three-half-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 2) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-two-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 2.5) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-two-half-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 1.5) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-one-half-rating.png" alt="" />
                                                                                    <?php } ?>
                                                                                    <?php if ($sme_user->rating == 1) { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-one-rating.png" alt="" />
                                                                                    <?php } ?>
        <?php if ($sme_user->rating == '') { ?>
                                                                                        <img src="<?php echo base_url(); ?>assets/sme/images/b-zero-rating.png" alt="" />
        <?php } ?>


                                                                                </p>
                                                                                <div class="follow-content">
                                                                                    <a href="#"><span class="follow-icon"><img src="<?php echo base_url(); ?>assets/sme/images/follow-icon.png" alt=""></span><span class="follow-text"><?php echo $sme_user->followers_cnt; ?> Followers</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                    <?php } ?>
                                                    </ul>
                                                    <?php if ($service->id == 1) { ?>
                                                        <a class="button" href="#">View All SPA’s here..</a>
                                                    <?php } else if ($service->id == 2) { ?>
                                                        <a class="button" href="#">Explore Ayurveda Centers here..</a>
                                                    <?php } else if ($service->id == 3) { ?>
                                                        <a class="button" href="#">Find the Yoga Studios here..</a>
    <?php } else if ($service->id == 4) { ?>
                                                        <a class="button" href="#">Get Fit! Find it here..</a>
                                            <?php } ?>
                                                </div>
                                            </li>
<?php } ?>
                                    </ul>
                                </div>
                            </div>





                            <div class="dashboard-button dashboard-content-boxinner">
                                <div class="row">
                                    <div class="col-xs-6 mar-auto">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <a href="<?php echo base_url(); ?>sme/register" class="button"><span><img src="<?php echo base_url(); ?>assets/sme/images/register-icon.png" alt="" /></span> Register as SME</a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="<?php echo base_url(); ?>sme/login" class="button"><span><img src="<?php echo base_url(); ?>assets/sme/images/login-icon.png" alt="" /></span>Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>






<!--
<div class="popup-content">
        <h2 class="center">Introducing SME</h2>
        <div class="row">
                <div class="col-xs-6">
                        <div class="popup-left-content center">
                                <h3>Login</h3>
                                <p>
                                        Already Registered Please Login
                                </p>
                                <a href="<?php echo base_url(); ?>sme/login" class="button circle-but"><span>Login</span></a>
                        </div>
                        
                </div>
                <div class="col-xs-6">
                        <div class="popup-right-content center">
                                <h3>Register</h3>
                                <p>If not registered click below to register</p>
                                <a href="<?php echo base_url(); ?>sme/register" class="button circle-but"><span>Register</span></a>
                        </div>
                        
                </div>
        </div>
        
</div>-->


