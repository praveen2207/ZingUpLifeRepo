
<h3><strong><?php echo count($search_result); ?></strong> Results Found</h3>
<div class="location">
    <ul>
        <li><strong>Location</strong> : Bangalore</li>
    </ul>
</div>
<?php if (!empty($search_result)) { ?>
    <div class="project-list">
        <ul id="search_filter_results">
            <?php foreach ($search_result as $key => $value) { ?>
                <li>
                    <div class="project-list-inner">
                        <div class="row">
                            <div class="col-xs-4 ">
                                <div class="product-image center">
                                    <div class="product-box-image">
                                        <a href="<?php echo base_url() . 'vendorDetails/' . $value->vendor_id; ?>">
                                            <img src="<?php echo $logo_path . $value->business_id . '/' . $value->logo; ?>" alt="" />
                                        </a> 
                                    </div> 

                                </div>

                            </div>
                            <div class="col-xs-8">
                                <div class="product-head">
        <!--                                    <h5><?php echo $value->name; ?></h5>-->
                                    <h5><a class="search_result_vendor_name" href="<?php echo base_url() . 'vendorDetails/' . $value->vendor_id; ?>"><?php echo $value->name; ?></a></h5>
                                    <div class="rating-star">
                                        <span>
                                            <img src="<?php echo base_url(); ?>assets/images/rating-img/<?php echo round(($value->average_rating * 2) / 2); ?>.png" alt="" />
                                        </span>
                                    </div>
                                    <a href="#">
                                        <h6><?php echo $value->street1 . ', ' . $value->street2 . ', ' . $value->city . ', ' . $value->state . ' '; ?>
        <!--                                                                    <span><i class="fa fa-map-marker"></i> 4 km</span>-->
                                        </h6> 
                                    </a>
                                    <div class="list-rating">
                                        <a href="#">
                                            <?php if ($value->average_rating != '') { ?>
                                                <span><?php echo round(($value->average_rating * 2) / 2); ?></span>
                                            <?php } ?>
                                            <strong><?php echo $value->review; ?></strong> Reviews
                                        </a>
                                    </div>
                                </div>                                            
                                <div class="list-content">
                                    <ul class="list-content-list">
                                        <?php
                                        foreach ($value->offering_service[0] as $keys => $values) {
                                            if ($keys < 3) {
                                                ?>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-xs-6 left"> 
                                                            <a href="<?php echo base_url(); ?>offeringServiceDetails/<?php echo $values->id; ?>"><?php echo $values->services; ?>
                                                                <?php if ($values->duration != '' && $values->duration != '-') { ?>
                                                                    <span class="minutes">
                                                                        <i class="fa fa-clock-o"></i> <?php echo $values->duration; ?>
                                                                    </span>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                        <?php if ($values->price != '' && $values->price != '-') { ?>
                                                            <div class="col-xs-6 right">&#8377; <?php echo $values->price; ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="price-list-button"><a href="<?php echo base_url() . 'vendorDetails/' . $value->vendor_id; ?>" class="button">Show Price List</a></div>

                            </div>


                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } else { ?>
    <div class="page-head center">
        <h1>No Matches found !!!</h1>
    </div>
<?php } ?>
<!--                        <div class="pagination">
                            <a href="#" class="button">Prev</a>
                            <ul>
                                <li><a href="#">1</a></li>
                                <li><a href="#" class="active">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                            </ul>
                            <a href="#" class="button">Next</a>
                        </div>-->
</div>