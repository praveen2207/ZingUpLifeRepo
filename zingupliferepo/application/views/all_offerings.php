<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>search"><span class="colorGreen">Services & Providers&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>"><span  class="colorGreen"><?php echo $business_provider_details['details']->name; ?>&nbsp;</span></a>
        <span class="colorGrey">// Packages & Treatments</span>
    </div>
    <div class="viewDetailBox">
        <div class="headMenu viewHead">
            <span class="viewTitle">OUR PACKAGES & TREATMENTS</span>
        </div>

        <?php foreach ($offerings as $key => $values) { ?> 
            <div class="carouselDetail line">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div id="viewImg-deatil01" class="carousel slide viewCarousel" data-ride="carousel">
                            <!-- Indicators -->
                            <?php
                            if (!empty($offerings->gallery)) {
                                foreach ($values->gallery as $key => $value) {
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
                                <ol class="carousel-indicators">
                                    <li data-target="#viewImg-deatil01" data-slide-to="0" class="active"></li>
                                    <li data-target="#viewImg-deatil01" data-slide-to="1"></li>
                                    <li data-target="#viewImg-deatil01" data-slide-to="2"></li>
                                    <li data-target="#viewImg-deatil01" data-slide-to="3"></li>
                                    <li data-target="#viewImg-deatil01" data-slide-to="4"></li>
                                    <li data-target="#viewImg-deatil01" data-slide-to="5"></li>
                                </ol>
                            <?php } ?>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner offerings_slider" role="listbox">
                                <?php
                                if (!empty($values->gallery)) {
                                    foreach ($values->gallery as $key => $value) {
                                        if ($key < 6) {
                                            if ($key == 0) {
                                                $active = 'active';
                                            } else {
                                                $active = '';
                                            }
                                            ?>
                                            <div class="item <?php echo $active; ?>">
                                                <div class="thumbnail">
                                                    <img src="<?php echo $offering_gallery_path . $value->service_id . '/' . $value->images; ?>" alt="<?php echo $value->images; ?>">
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
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <h4 class="colorGreen allRev"><?php echo $values->services; ?></h4>
                        <?php $desc_length = strlen($values->description); ?>

                        <p class="detailText height07">
                            <?php echo strip_tags($values->description); ?>
                        </p>
                        <?php if ($desc_length > 100) { ?>
                            <div class="less viewLess selectRed viewLess2 common_view_less">
                                <a href="#moreBox1" class="button-read-more1 colorGreen pull-right more-button">
                                    Read More<span class="glyphicon glyphicon-triangle-bottom"></span>
                                </a>
                                <a href="#moreBox1" class="button-read-less1 colorGreen pull-right less-button">
                                    Read Less<span class="glyphicon glyphicon-triangle-right"></span>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="ShareBox">
                            <ul>
                                <li><span class="rsText"><?php
                                        if ($values->type == 'Sessions') {
                                            echo 'Membership';
                                        } else {
                                            ?>RS.&nbsp; <?php
                                            echo $values->price;
                                        }
                                        ?></span></li>
                                <li>
                                    <span class="minsText"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php
                                        if ($values->type == 'Sessions') {
                                            echo 'Monthly';
                                        } else {
                                            echo $values->duration;
                                        }
                                        ?></span>
                                </li>
                                <li class="borderTop">
                                    <span class="mapSmall"></span>
                                    <span class="colorGreen"><?php echo $business_provider_details['details']->area_name; ?></span>
                                </li>
                                <li class="share_list">
    <!--                                    <span class="shareIcon"></span>
                                    <span class="colorGreen" class='st_sharethis_large' displayText='ShareThis'>Share</span>-->
                                    <span class='st_sharethis_large shareIcon colorGreen' displayText='ShareThis'>Share</span>
                                    <span class='st_' displayText=''></span>
                                </li>
                            </ul>
                            <?php if (!empty($values->slots)) { ?>
                                <?php if ($values->type == 'Sessions') { ?>

                                    <a href="<?php echo base_url(); ?>memberships_offering/<?php echo $values->id; ?>" class="btn zing-btn slotBtn">Book Slot</a>
                                <?php } else { ?>

                                                <!--                                <a href="<?php //echo base_url();      ?>offering_details/<?php //echo $values->id;      ?>" class="btn zing-btn slotBtn">Book Slot</a>-->
                                    <form action="<?php echo base_url(); ?>signup" method="post">
                                        <input type="hidden" name="offering_id" value="<?php echo $values->id; ?>" />
                                        <input type="hidden" name="membership_plan_id" value="" />
                                        <input type="hidden" name="booking_type" value="hourly" />
                                        <input type="submit" class="btn zing-btn slotBtn" value="Book Slot"/>
                                    </form>
                                <?php } ?>
                            <?php } ?>


                        <!--                                <form action="<?php echo base_url(); ?>signup" method="post">
                                                            <input type="hidden" name="offering_id" value="<?php echo $value->business_service_id; ?>" />
                                                            <input type="hidden" name="membership_plan_id" value="<?php echo $value->id; ?>" />
                                                            <input type="hidden" name="booking_type" value="membership" />
                                                            <input type="submit" class="btn zing-btn bookSlot" value="Book Slot"/>
                                                        </form>-->

                        </div>		
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>