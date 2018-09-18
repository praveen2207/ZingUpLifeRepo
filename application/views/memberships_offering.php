<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>search"><span class="colorGreen">Services & Providers&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>">
            <span  class="colorGreen"><?php echo $business_provider_details['details']->name; ?>&nbsp;</span></a>
        <span class="colorGrey">// <?php echo $get_offering_service_details['details']->services; ?></span>
    </div>
    <div class="viewDetailBox">
        <div class="headMenu viewHead">
            <span class="headTitle"><?php echo $get_offering_service_details['details']->services; ?></span>
        </div>
        <div class="carouselDetail line">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div id="viewImg-deatil01" class="carousel slide viewCarousel" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            if (!empty($get_offering_service_details['gallery'])) {
                                foreach ($get_offering_service_details['gallery'] as $key => $value) {
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
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner offerings_slider" role="listbox">
                            <?php
                            if (!empty($get_offering_service_details['gallery'])) {
                                foreach ($get_offering_service_details['gallery'] as $key => $value) {
                                    if ($key < 6) {
                                        if ($key == 0) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                        ?>
                                        <div class="item <?php echo $active; ?>">
                                            <div class="thumbnail">
                                                <img src="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>" alt="<?php echo $value->images; ?>">
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
                    <?php $desc_length = strlen($get_offering_service_details['details']->description); ?>
                    <p class="detailText height07">
                        <?php echo strip_tags($get_offering_service_details['details']->description); ?>
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
                        <div class="classesBox">
                            <span>Classes</span>
                            <div class="pull-right">
<!--                                <span class="shareIcon"></span>
                                <span class="colorGreen">Share</span>-->
                               
<!--                                    <span class="shareIcon"></span>
                                    <span class="colorGreen" class='st_sharethis_large' displayText='ShareThis'>Share</span>-->
                                    <span class='st_sharethis_large shareIcon colorGreen' displayText='ShareThis'>Share</span>
                                    <span class='st_' displayText=''></span>
                                
                            </div>
                        </div>
                        <table class="table tabList">
                            <tbody>
                                <?php foreach ($memberships as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <span class="fontSize">
                                                <?php echo $value->membership; ?>
                                            </span>
                                        </td>
                                        <td><span class="fontSize"><?php echo $value->duration; ?></span></td>
                                        <td><span class="rsText">RS.&nbsp; <?php echo $value->fees; ?></span></td>
                                        <td>
                                            <form action="<?php echo base_url(); ?>signup" method="post">
                                                <input type="hidden" name="offering_id" value="<?php echo $service_id; ?>" />
                                                <input type="hidden" name="membership_plan_id" value="<?php echo $value->id; ?>" />
                                                <input type="hidden" name="booking_type" value="membership" />
                                                <input type="submit" class="btn zing-btn bookSlot" value="Book Slot"/>
                                            </form>
    <!--                                            <a href="<?php echo base_url(); ?>membership_signup" class="btn zing-btn bookSlot">Book Slot</a>-->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>		
                </div>
            </div>
        </div>
    </div>
</div>