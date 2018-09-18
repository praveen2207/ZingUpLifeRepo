<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Offering Service Details</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" > 
                        <?php if (!empty($business_provider_details['details'])) { ?>
                            <div class="location-header">
                                <a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>">
                                    <img class="shatayu-logo" src="<?php
                                    if (isset($business_provider_details)) {
                                        if ($business_provider_details['details']->logo != '') {
                                            echo $logo_path . $business_provider_details['details']->business_id . '/' . $business_provider_details['details']->logo;
                                        } else {
                                            echo base_url() . 'assets/images/coming-soon-new.png';
                                        }
                                    } else {
                                        echo base_url() . 'assets/images/coming-soon.png';
                                    }
                                    ?>"/>
                                </a>

                                <h3 class="vendor-head"><a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>"><?php
                                        if (isset($business_provider_details)) {
                                            echo $business_provider_details['details']->name . '-' . $business_provider_details['details']->area_name;
                                        }
                                        ?></a></h3>
                            </div>
                        <?php } ?>
                        <?php if (!empty($get_offering_service_details['details'])) { ?>
                            <div class="category1">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h3 class="book-category"><?php echo $get_offering_service_details['details']->services; ?></h3>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="time-icons row service_details_time">
                                            <div class="hour col-xs-6">
                                                <?php if ($get_offering_service_details['details']->duration != '' && $get_offering_service_details['details']->duration != '-') { ?>
                                                    <i class="fa fa-clock-o"></i><h5 class="hour-t"><?php
                                                        if ($get_offering_service_details['details']->duration == 1) {
                                                            $hr = 'hr';
                                                        } else {
                                                            $hr = 'hrs';
                                                        }echo $get_offering_service_details['details']->duration;
                                                        ?></h5>
                                                <?php } ?>
                                            </div>
                                            <?php if ($get_offering_service_details['details']->price != '' && $get_offering_service_details['details']->price != '-') { ?>
                                                <div class="amt col-xs-6"><i class="fa fa-inr"></i><h5 class="hour-t"><?php echo $get_offering_service_details['details']->price; ?></h5></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="details-content">

                            <div class="row">
                                <div class="col-xs-9">
                                    <div id="product-slide">
                                        <div class="container">
                                            <div class="row">
                                                <?php if (!empty($get_offering_service_details['gallery'])) { ?>
                                                    <div class="span12 slider-width">
                                                        <div id="owl-demo" class="owl-carousel">
                                                            <?php
                                                            $count = 0;
                                                            foreach ($get_offering_service_details['gallery'] as $key => $value) {
                                                                if ($count == 0) {
                                                                    $active = 'active';
                                                                } else {
                                                                    $active = '';
                                                                }
                                                                ?>
                                                                <div class="item row">
                                                                    <div class="col-xs-8">
                                                                        <img src="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>" alt="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <div class="slider-cont-inner">
                                                                            <h2><?php echo $value->caption; ?></h2>
                                                                            <p><?php echo $value->description; ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="span12 slider-width">
                                                        <div id="owl-demo" class="owl-carousel">
                                                            <div class="item row">
                                                                <div class="col-xs-8">
                                                                    <img src="<?php echo base_url(); ?>assets/images/shathayu-banner.jpg" alt="img1">
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <div class="slider-cont-inner">
                                                                        <h2><?php echo $get_offering_service_details['details']->services; ?></h2>
                                                                        <p><?php echo $get_offering_service_details['details']->services; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item row">
                                                                <div class="col-xs-8">
                                                                    <img src="<?php echo base_url(); ?>assets/images/shathayu-banner.jpg" alt="img2">
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <div class="slider-cont-inner">
                                                                        <h2><?php echo $get_offering_service_details['details']->services; ?></h2>
                                                                        <p><?php echo $get_offering_service_details['details']->services; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-3 my_description">
                                    <div class="details-right-content">
                                        <h2>About <?php echo $get_offering_service_details['details']->services; ?></h2>
                                        <?php if (!empty($get_offering_service_details['average_rating'])) { ?>
                                            <div class="rating-star">
                                                <span>
                                                    <img src="<?php echo base_url(); ?>assets/images/rating-img/b-<?php echo round(($get_offering_service_details['average_rating']->average_rating * 2) / 2); ?>.png" alt="" />
                                                </span>
                                            </div>
                                        <?php } ?>

                                        <p><?php echo $get_offering_service_details['details']->description; ?></p>
                                        <?php if ($get_offering_service_details['details']->service_type == 'hourly') { ?>
                                            <?php if (count($get_offering_service_details['slots']) != 0) { ?>
                                                <a href="<?php echo base_url(); ?>chooseBookingDate" class="big-button button">Book</a>
                                            <?php } else { ?>
                                                <h4 class="">No Slots Available For Booking</h4>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if ($get_offering_service_details['details']->service_type == 'monthly') { ?>
                                    <?php if (count($memberships) != 0) { ?>
                                        <div class="col-xs-12 payment-page">
                                            <?php if ($memberships[0]->service_id == 4) { ?>
                                                <h3>Memberships</h3>
                                            <?php } else { ?>
                                                <h3>Classes</h3>
                                            <?php } ?>
                                            <div class="payment-list">
                                                <ul class="payment-list-row">
                                                    <?php foreach ($memberships as $key => $value) { ?>
                                                        <li>
                                                            <div class = "row">
                                                                <div class = "col-xs-2"><?php echo $value->membership; ?></div>
                                                                <div class = "col-xs-4"><?php echo $value->description; ?></div> 
                                                                <div class = "col-xs-2"><?php echo $value->duration; ?></div>  
                                                                <div class = "col-xs-2">&#8377;<?php echo $value->fees; ?></div>
                                                                <div class = "col-xs-2">
                                                                    <form action="<?php echo base_url(); ?>chooseMembershipBookingDate" method="post">
                                                                        <input type="hidden" name="membership_plan_id" value="<?php echo $value->id; ?>" />
                                                                        <input type="submit" class="buy button" value="Buy"/>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php } else {
                                        ?>
                                        <h4 class="">Membership plans not available</h4>
                                    <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="review-section">
                                <div class="review-inner">
                                    <h2>Customer Reviews</h2>
                                    <?php if (!empty($review_details)) { ?>
                                        <a href="#reviews" class="write-review-link button">Write Reviews</a>
                                        <?php } ?>
                                    <ul class="review-list">
                                        <?php
                                        if (count($get_offering_service_details['review']) != 0) {
                                            foreach ($get_offering_service_details['review'] as $key => $value) {
                                                ?>
                                                <li>
                                                    <h4 class="ReviewTitle"><?php echo $value->title . '  '; ?><img src="<?php echo base_url(); ?>assets/images/rating-img/<?php echo $value->rating; ?>.png" alt="" /> </h4>
                                                    <p class="user-post">Posted by <?php echo $value->name; ?> on <?php echo date('jS M Y', strtotime($value->created_on)); ?></p>
                                                    <p><?php echo $value->review; ?></p>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <li>
                                                <h5 class="ReviewTitle">No Reviews !!!</h5>
                                            </li>
<?php } ?>
                                    </ul>
                                    <div class="own-review" id="reviews">
                                        <div class="row">
<?php if (!empty($review_details)) { ?>
                                                <div class="col-xs-4">
                                                    <h3>Write Your Own Review</h3>
                                                    <?php if (empty($logged_in_user_details)) { ?>
                                                        <p>Do you Want to write Review? <a href="<?php echo base_url(); ?>login">login</a></p>
                                                    <?php } ?>
                                                    <?php
                                                    $login_required_message = $this->session->flashdata('login_required_message');
                                                    if (isset($login_required_message)) {
                                                        ?>
                                                        <h5 class="login_required"><?php echo $login_required_message; ?></h5>
    <?php } ?>

                                                    <form method="post" action="<?php echo base_url(); ?>review_service">
                                                        <input type="hidden" name="rating_code" value="<?php echo $review_details->rating_code; ?>"/>
                                                        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>"/>
                                                        <div class="rating-icon">
                                                            <fieldset class="rating">
                                                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                                <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                                <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                                <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                            </fieldset>
                                                        </div>
    <!--                                                        <input type="text" placeholder="Title" name="title">
                                                        <textarea name="review"></textarea>-->

                                                        <input type="submit" value="Save My Review" class="button">
                                                    </form>

                                                </div>
<?php } ?>
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

<script src="http://localhost/zinguplife/assets/js/owl.carousel.js"></script>
<script>
    // $(document).ready(function () {
    $("#owl-demo").owlCarousel({
        autoPlay: 5000,
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true

    });
    //});
</script>
