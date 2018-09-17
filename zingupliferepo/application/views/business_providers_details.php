<div class="container" id='top'>
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>search"><span class="colorGreen">Services & Providers&nbsp;</span></a>
        <span  class="colorGrey">// <?php echo $business_provider_details['details']->name; ?></span>
    </div>
    <div class="viewDetailBox">
        <div class="headMenu viewHead">
            <span class="viewTitle"><?php echo $business_provider_details['details']->name; ?></span>
            <ul>
                <?php
                $rating = round($business_provider_details['details']->average_rating);
                if ($business_provider_details['details']->average_rating != '') {
                    if ($rating == 0) {
                        ?>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                    <?php } ?>
                    <?php if ($rating == 1) {
                        ?>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                    <?php } ?>
                    <?php if ($rating == 2) {
                        ?>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                    <?php } ?>
                    <?php if ($rating == 3) {
                        ?>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                    <?php } ?>
                    <?php if ($rating == 4) {
                        ?>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                    <?php } ?>
                    <?php if ($rating == 5) {
                        ?>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                        <li><i class='glyphicon glyphicon-star'></i></li>
                    <?php } ?>
                <?php } ?>
                <li>
                    <a href="javascript:void(0);" class="colorGreen"><?php echo $business_provider_details['details']->review; ?> reviews</a>
                </li>
            </ul>
        </div>
        <div class="carouselDetail">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div id="viewImg-deatil" class="carousel slide viewCarousel" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            if (!empty($business_provider_details['gallery'])) {
                                foreach ($business_provider_details['gallery'] as $key => $value) {
                                    if ($key < 6) {
                                        if ($key == 0) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                        ?>
                                        <li data-target="#viewImg-deatil" data-slide-to="<?php echo $key; ?>" class="<?php echo $active; ?>"></li>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <li data-target="#viewImg-deatil" data-slide-to="0" class="active"></li>
                                <li data-target="#viewImg-deatil" data-slide-to="1"></li>
                                <li data-target="#viewImg-deatil" data-slide-to="2"></li>
                                <li data-target="#viewImg-deatil" data-slide-to="3"></li>
                                <li data-target="#viewImg-deatil" data-slide-to="4"></li>
                                <li data-target="#viewImg-deatil" data-slide-to="5"></li>
                            <?php } ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner gallery_slider" role="listbox">
                            <?php
                            if (!empty($business_provider_details['gallery'])) {
                                foreach ($business_provider_details['gallery'] as $key => $value) {
                                    if ($key < 6) {
                                        if ($key == 0) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                        ?>
                                        <div class="item <?php echo $active; ?>">
                                            <div class="thumbnail">
                                                <img src="<?php echo $gallery_path . $value->business_id . '/' . $value->images; ?>" alt="<?php echo $value->images; ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <div class="item active">
                                    <div class="thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <?php $desc_length = strlen($business_provider_details['details']->description); ?>
                    <p class="detailText height07">
                        <?php echo utf8_encode(strip_tags($business_provider_details['details']->description)); ?>
                    </p>

                    <?php if ($desc_length > 100) { ?>
                        <div class="less viewLess viewLess2">
                            <a href="#moreBox1" class="button-read-more1 colorGreen pull-right more-button">
                                Read More<span class="glyphicon glyphicon-triangle-bottom"></span>
                            </a>
                            <a href="#moreBox1" class="button-read-less1 colorGreen pull-right less-button">
                                Read Less<span class="glyphicon glyphicon-triangle-right"></span>
                            </a>
                        </div>
                    <?php } ?>

                    <div class="addressLoc">
                        <p class="colorGrey">
                            <span class="mapIcon"></span><?php echo $business_provider_details['details']->street1; ?>
                        </p>
                        <?php if ($business_provider_details['details']->street2 != '') { ?>
                            <p class="colorGrey"><?php echo $business_provider_details['details']->street2; ?></p>
                        <?php } ?>
                        <p class="colorGrey"><?php echo $business_provider_details['details']->city; ?>, <?php echo $business_provider_details['details']->state; ?></p>
                        <p class="colorGreen"> <a href="#locate_on_map" class="colorGreen">Locate On Map</a></p>
                        <?php if ($business_provider_details['details']->phone != '' && $business_provider_details['details']->landline != '') { ?>
                            <p class="numBox"><span class="telephoneIcon"></span>+91 <?php echo $business_provider_details['details']->phone; ?>, <?php echo $business_provider_details['details']->landline; ?></p>
                        <?php } else { ?>
                            <p class="numBox"><span class="telephoneIcon"></span>+91 <?php echo $business_provider_details['details']->phone; ?></p>
                        <?php } ?>
                    </div>		
                </div>
            </div>
        </div>
        <?php if (!empty($offerings['Sessions'])) { ?>

            <div class="packagesBox">
                <div class="headMenu ourBox reSize">
                    <span class="viewTitle">
                        Our Sessions
                    </span>
                    <a href="<?php echo base_url(); ?>all_offerings/<?php echo $business_provider_id; ?>" class="colorGreen">View All</a>
                    <!--                    <ul>
                                            <li><a href="javascript:void(0);" class="colorGreen">Spa (3)</a></li>
                                            <li><a href="javascript:void(0);" class="colorGreen">Yoga (5)</a></li>
                                            <li><a href="javascript:void(0);" class="colorGreen">Ayurveda (3)</a></li>
                                            <li><a href="javascript:void(0);" class="colorGreen">Fitness (5)</a></li>
                                        </ul>-->
                </div>
                <div class="carousel slide secand marginTop package_carousel" data-ride="carousel" data-type="multi" data-interval="false" id="myCarousel">
                    <div class="carousel-inner">
                        <?php
                        foreach ($offerings['Sessions'] as $key => $value) {
                            if ($key < 10) {
                                if ($key == 0) {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                                ?>


                                <div class="item <?php echo $active; ?>">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <?php if ($value->gallery[0]->images != '') { ?>
                                            <img class="vendor_offering_images" src="<?php echo $offering_gallery_path . $value->gallery[0]->service_id . '/' . $value->gallery[0]->images; ?>">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg.png">
                                        <?php } ?>
                                        <div class="cardView">
                                            <h5 class="colorGreen"><?php echo substr($value->services, 0, 30) . '...'; ?></h5>
                                            <span class="offering_limit"><?php echo utf8_encode(strip_tags(substr($value->description, 0, 60))) . '....'; ?></span>
                                            <ul>
                                                <li>
                                                    <span class="minsText"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $value->duration; ?></span>
                                                </li>
                                                <!--                                                <li class="mapIcons">
                                                                                                    <i class="iconMapg"></i>
                                                                                                    <span><?php echo $business_provider_details['details']->area_name; ?></span>
                                                                                                </li>-->
                                                <li><span class="rsText">RS.&nbsp; <?php echo $value->price; ?></span></li>
                                            </ul>
											<?php if($value->service_type == 'monthly') {?>
                                            <a href="<?php echo base_url(); ?>memberships_offering/<?php echo $value->id; ?>" class="btn zing-btn bookBtn">Book Now</a>
											<?php } else {?>
												<form action="<?php echo base_url(); ?>signup" method="post">
                                                    <input type="hidden" name="offering_id" value="<?php echo $value->id; ?>" />
                                                    <input type="hidden" name="membership_plan_id" value="" />
                                                    <input type="hidden" name="booking_type" value="hourly" />
                                                    <input type="submit" class="btn zing-btn slotBtn" value="Book Now"/>
                                                </form>
											<?php } ?>
										</div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <a data-slide="prev" href="#myCarousel" class="left carousel-control collaborators" data-slide="prev">‹</a>
                    <a data-slide="next" href="#myCarousel" class="right carousel-control collaborators" data-slide="next">›</a>
                </div>
            </div>

        <?php } else { ?>
            <div class="packagesBox">
                <?php if (!empty($offerings['Offerings'])) { ?>
                    <div class="headMenu ourBox reSize">
                        <span class="viewTitle">
                            Our Offerings
                        </span>
                        <a href="<?php echo base_url(); ?>all_offerings/<?php echo $business_provider_id; ?>" class="colorGreen">View All</a>
                        <!--                    <ul>
                                                <li><a href="javascript:void(0);" class="colorGreen">Spa (3)</a></li>
                                                <li><a href="javascript:void(0);" class="colorGreen">Yoga (5)</a></li>
                                                <li><a href="javascript:void(0);" class="colorGreen">Ayurveda (3)</a></li>
                                                <li><a href="javascript:void(0);" class="colorGreen">Fitness (5)</a></li>
                                            </ul>-->
                    </div>
                    <div class="carousel slide secand marginTop package_carousel" data-ride="carousel" data-type="multi" data-interval="false" id="myCarousel">
                        <div class="carousel-inner">
                            <?php
                            foreach ($offerings['Offerings'] as $key => $value) {
                                if ($key < 10) {
                                    if ($key == 0) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    ?>


                                    <div class="item <?php echo $active; ?>">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <?php if ($value->gallery[0]->images != '') { ?>
                                                <img class="vendor_offering_images" src="<?php echo $offering_gallery_path . $value->gallery[0]->service_id . '/' . $value->gallery[0]->images; ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg.png">
                                            <?php } ?>
                                            <div class="cardView">
                                                <h5 class="colorGreen"><?php echo substr($value->services, 0, 30) . '...'; ?></h5>
                                                <span class="offering_limit"><?php echo utf8_encode((strip_tags(substr($value->description, 0, 60)))) . '....'; ?></span>
                                                <ul>
                                                    <li>
                                                        <span class="minsText"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $value->duration; ?></span>
                                                    </li>
                                                    <!--                                                    <li class="mapIcons">
                                                                                                            <i class="iconMapg"></i>
                                                                                                            <span><?php echo $business_provider_details['details']->area_name; ?></span>
                                                                                                        </li>-->
                                                    <li><span class="rsText">RS.&nbsp; <?php echo $value->price; ?></span></li>
                                                </ul>
                <!--                                                <a href="<?php echo base_url(); ?>offering_details/<?php echo $value->id; ?>" class="btn zing-btn bookBtn">Book Now</a>-->
                                                <form action="<?php echo base_url(); ?>signup" method="post">
                                                    <input type="hidden" name="offering_id" value="<?php echo $value->id; ?>" />
                                                    <input type="hidden" name="membership_plan_id" value="" />
                                                    <input type="hidden" name="booking_type" value="hourly" />
                                                    <input type="submit" class="btn zing-btn slotBtn" value="Book Now"/>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <a data-slide="prev" href="#myCarousel" class="left carousel-control collaborators" data-slide="prev">‹</a>
                        <a data-slide="next" href="#myCarousel" class="right carousel-control collaborators" data-slide="next">›</a>
                    </div>
                <?php } ?>
            </div><br/>
            <div class="packagesBox">
                <?php if (!empty($offerings['Packages'])) { ?>
                    <div class="headMenu ourBox reSize">
                        <span class="viewTitle">
                            Our Packages
                        </span>
                        <a href="<?php echo base_url(); ?>all_offerings/<?php echo $business_provider_id; ?>" class="colorGreen">View All</a>
                        <!--                    <ul>
                                                <li><a href="javascript:void(0);" class="colorGreen">Spa (3)</a></li>
                                                <li><a href="javascript:void(0);" class="colorGreen">Yoga (5)</a></li>
                                                <li><a href="javascript:void(0);" class="colorGreen">Ayurveda (3)</a></li>
                                                <li><a href="javascript:void(0);" class="colorGreen">Fitness (5)</a></li>
                                            </ul>-->
                    </div>
                    <div class="carousel slide secand marginTop package_carousel" data-ride="carousel" data-type="multi" data-interval="false" id="myCarousel">
                        <div class="carousel-inner">
                            <?php
                            foreach ($offerings['Packages'] as $key => $value) {
                                if ($key < 10) {
                                    if ($key == 0) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    ?>


                                    <div class="item <?php echo $active; ?>">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <?php if ($value->gallery[0]->images != '') { ?>
                                                <img class="vendor_offering_images" src="<?php echo $offering_gallery_path . $value->gallery[0]->service_id . '/' . $value->gallery[0]->images; ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg.png">
                                            <?php } ?>
                                            <div class="cardView">
                                                <h5 class="colorGreen"><?php echo substr($value->services, 0, 30) . '...'; ?></h5>
                                                <span class="offering_limit"><?php echo utf8_encode(strip_tags(substr($value->description, 0, 60))) . '....'; ?></span>
                                                <ul>
                                                    <li>
                                                        <span class="minsText"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $value->duration; ?></span>
                                                    </li>
                                                    <!--                                                    <li class="mapIcons">
                                                                                                            <i class="iconMapg"></i>
                                                                                                            <span><?php echo $business_provider_details['details']->area_name; ?></span>
                                                                                                        </li>-->
                                                    <li><span class="rsText">RS.&nbsp; <?php echo $value->price; ?></span></li>
                                                </ul>
                <!--                                                <a href="<?php echo base_url(); ?>offering_details/<?php echo $value->id; ?>" class="btn zing-btn bookBtn">Book Now</a>-->
                                                <form action="<?php echo base_url(); ?>signup" method="post">
                                                    <input type="hidden" name="offering_id" value="<?php echo $value->id; ?>" />
                                                    <input type="hidden" name="membership_plan_id" value="" />
                                                    <input type="hidden" name="booking_type" value="hourly" />
                                                    <input type="submit" class="btn zing-btn slotBtn" value="Book Now"/>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <a data-slide="prev" href="#myCarousel" class="left carousel-control collaborators" data-slide="prev">‹</a>
                        <a data-slide="next" href="#myCarousel" class="right carousel-control collaborators" data-slide="next">›</a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>


        <div class="reviewsBox">
            <div class="headMenu reviewHead">
                <span class="viewTitle">Reviews</span>
            </div>

            <div class="row reviewList">
                <?php
                $logged_in_user_details = $this->session->userdata('logged_in_user_data');
                if (!empty($logged_in_user_details)) {
                    $is_logged_in = $logged_in_user_details->is_logged_in;
                    // $user_id = $logged_in_user_details->user_id;
                } else {
                    $is_logged_in = '';
                    $user_id = '';
                }
                if ($is_logged_in == 1) {
                    ?>
                    <div class="col-xs-12 col-sm-9 col-md-8 col-sm-offset-1 col-md-offset-2">
                        <div class="row">
                            <div class="col-xs-3 col-sm-2 col-md-2  reSizeMessage imgCenter">

                                <!--                            <img src="<?php echo base_url(); ?>assets/new_design/image/circle.png" class="circle-img reviewCircle">-->
                                <?php if ($logged_in_user_details->image != '') { ?>
                                    <img src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $logged_in_user_details->user_id; ?>/<?php echo $logged_in_user_details->image; ?>"  class="circle-img reviewCircle"/>
                                <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>assets/new_design/image/sme_user_placeholder.png">
                                <?php } ?>
                            </div>
                            <div class="col-xs-9 col-sm-10 col-md-10  reSizeMessage">
                                <?php
                                $message = $this->session->flashdata('review_success');
                                if (isset($message)) {
                                    ?>
                                    <div class="alert  alert-dismissible col-xs-12 errorMessage reError successMessage" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#10003</span></button>
                                        <span>Success!</span>  Your review submitted successfully.
                                    </div>
                                <?php } ?>

                                <!--                            <form class="form-horizontal">-->
                                <form  class="form-horizontal" method="post" action="<?php echo base_url(); ?>vendor_review">
                                    <div class="form-group">
                                        <span for="inputTitle" class="col-sm-4 col-md-3 control-label">Review title</span>
                                        <div class="col-sm-8 col-md-9">
                                            <input type="text" class="form-control" id="inputTitle" name="title">
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span for="inputReview" class="col-sm-4 col-md-3 control-label">Your Review</span>
                                        <div class="col-sm-8 col-md-9">
    <!--                                            <input type="text" class="form-control" id="inputReview" placeholder="">-->
                                            <textarea class="form-control" name="review"></textarea>
                                            <?php echo form_error('review'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span for="inputPassword3" class="col-sm-4 col-md-3 control-label">Your Rating</span>
                                        <div class="col-sm-8 col-md-9">
                                            <span id="stars" class="starrr formStar"></span>
                                            <input type="hidden" name="rating" value="" id="rating_star"/>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                                            <input type="hidden" name="id" value="<?php echo $business_provider_details['details']->id; ?>"/>
                                            <input type="hidden" name="vendor_id" value="<?php echo $business_provider_details['details']->business_id; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-sm-offset-4 col-sm-8 col-md-8">
                                            <button type="submit" class="btn zing-btn">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12 col-sm-9 col-md-8  col-sm-offset-1 col-md-offset-2">
                    <?php if (!empty($reviews)) { ?>
                        <?php
                        foreach ($reviews as $key => $value) {
                            ?>
                            <div class="row listReviewShow lastRew">
                                <div class="col-xs-3 col-sm-2 col-md-2 reSizeMessage imgCenter">
                <!--                            <img src="<?php echo base_url(); ?>assets/new_design/image/circle.png" class="circle-img reviewCircle">-->
                                    <?php if ($value->image != '') { ?>
                                        <img class="circle-img reviewCircle"  src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $value->user_id; ?>/<?php echo $value->image; ?>">
                                    <?php } else { ?>
                                        <img class="circle-img reviewCircle" src="<?php echo base_url(); ?>assets/new_design/image/sme_user_placeholder.png">
                                    <?php } ?>
                                </div>
                                <div class="col-xs-9 col-sm-10 col-md-10 reSizeMessage">
                                    <ul>
                                        <?php
                                        if ($value->rating == 0) {
                                            ?>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                        <?php } ?>
                                        <?php if ($value->rating == 1) {
                                            ?>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                        <?php } ?>
                                        <?php if ($value->rating == 2) {
                                            ?>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                        <?php } ?>
                                        <?php if ($value->rating == 3) {
                                            ?>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                        <?php } ?>
                                        <?php if ($value->rating == 4) {
                                            ?>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                        <?php } ?>
                                        <?php if ($value->rating == 5) {
                                            ?>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                        <?php } ?>
                                    </ul>
                                    <h4><?php echo $value->title; ?></h4>
                                    <h6 class="colorGrey">By <?php echo $value->name; ?> on <?php echo date('M d,Y', strtotime($value->created_on)); ?>  |  <?php echo date('H:i a', strtotime($value->created_on)); ?></h6>
                                    <p><?php echo $value->review; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <h4 class="no_review_found">No reviews found</h4>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="mapBox" id="locate_on_map">
            <div class="headMenu reviewHead ourBox">
                <span class="headTitle">Map</span>
                <a href="#top" class="colorGreen">Back On Top</a>
            </div>
            <div class="mapShow" id='map_canvas'  style="height:250px;">
    <!--            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.000825768568!2d77.63801451482205!3d12.971798690855755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae16a7b176e369%3A0x4109f8d352ce76f7!2sZingUpLife!5e0!3m2!1sen!2sin!4v1456742545325" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
            </div>
        </div>
    </div> 
</div> 
</div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
    function initialize() {
        var latitude = '<?php echo $business_provider_details['details']->area_latitude; ?>';
        var longitude = '<?php echo $business_provider_details['details']->area_longitude; ?>';
        var mapCanvas = document.getElementById('map_canvas');
        var myLatlng = new google.maps.LatLng(latitude, longitude);
        var mapOptions = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: "Fast marker"
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
