<?php

$search_result_array = array();
if (!empty($search_result)) {
    foreach ($post_data as $keys => $values) {
        foreach ($search_result as $key => $value) {
            if ($values == $value->slug) {
                $search_result_array[] = $value;
            }
        }
    }
}

$base_services = array();
if (!empty($search_result_array)) {
    foreach ($search_result_array as $key => $value) {
        ?>
        <div class="reviewCard">
            <div class="row">
                <div class="col-xs-4 col-sm-3 col-md-3 test">
                    <?php if ($value->logo != '') { ?>
                        <img src="<?php echo $logo_path . $value->business_id . '/' . $value->logo; ?>" alt="" />
                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg.png">
                    <?php } ?>
                </div>
                <div class="col-xs-8 col-sm-9 col-md-9">
                    <ul class="reviewBox">
                        <li>
                            <ul class="sapStar">
                                <li><span class="reviewName"><?php echo $value->name; ?></span></li>
                                <?php
                                $rating = round($value->average_rating);
                                if ($value->average_rating != '') {
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
                                    <?php if ($ratingg == 4) {
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
                                <li><span class="colorGreen"><?php echo $value->review; ?> reviews</span></li>
                            </ul>
                        </li>
                        <li class="addressRS">
                            <span class="colorGrey"><?php echo $value->street1 . ', ' . $value->street2 . ', ' . $value->city . ', ' . $value->state . ' '; ?></span>
                        </li>
                        <li class="colorGreen">
                            <?php
                            if (count($value->offering_service[0]) != 0) {
                                foreach ($value->offering_service[0] as $keys => $values) {
                                    if ($values->base_service_id == 1) {
                                        $base_services[$key]['spa'][] = $values;
                                    } elseif ($values->base_service_id == 2) {
                                        $base_services[$key]['ayurvedic_treatments'][] = $values;
                                    } elseif ($values->base_service_id == 3) {
                                        $base_services[$key]['yoga'][] = $values;
                                    } elseif ($values->base_service_id == 4) {
                                        $base_services[$key]['fitness'][] = $values;
                                    } else {
                                        $base_services[$key]['others'][] = $values;
                                    }
                                }
                            }
                            ?>
                            <span class="lineLF">Spa (<?php echo count($base_services[$key]['spa']); ?>)&nbsp;&nbsp;</span>&nbsp;
                            <span class="lineLF">Yoga (<?php echo count($base_services[$key]['yoga']); ?>)&nbsp;&nbsp;</span>&nbsp;
                            <span class="lineLF">Ayurveda (<?php echo count($base_services[$key]['ayurvedic_treatments']); ?>)&nbsp;&nbsp;</span>&nbsp;
                            <span>Fitness (<?php echo count($base_services[$key]['fitness']); ?>)&nbsp;&nbsp;</span>&nbsp;
                        </li>
                        <li class="rsShow">
                            <div class="row">
                                <?php
                                if (count($value->offering_service[0]) != 0) {
                                    foreach ($value->offering_service[0] as $keys => $values) {
                                        if ($keys < 5) {
                                            ?>
                                            <div class="col-xs-6 col-sm-4 col-md-2 mgRs">
                                                <div class="rsMin">
                                                    <?php
                                                    $offering_name_length = strlen($values->services);
                                                    if ($offering_name_length > 15) {
                                                        $offering_name = substr($values->services, 0, 15) . '...';
                                                    } else {
                                                        $offering_name = $values->services;
                                                    }
                                                    ?>
                                                    <span class="messAge"><?php echo $offering_name; ?></span>
                                                    <p class="minsText"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $values->duration; ?> Mins</p>
                                                    <p class="rsText">RS.&nbsp; <?php echo $values->price; ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    $offerings_count = count($value->offering_service[0]);
                                    if ($offerings_count > 5) {
                                        ?>
                                        <div class="col-xs-6 col-sm-4  col-md-2  mgMore mgRs">
                                            <a href="<?php echo base_url(); ?>all_offerings/<?php echo $value->vendor_id; ?>" class="colorGreen"><?php echo ($offerings_count - 5); ?>&nbsp;More</a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'vendorDetails/' . $value->vendor_id; ?>" class="btn zing-btn serBtn">View Detail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="reviewCard">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3">

            </div>
            <div class="col-xs-8 col-sm-9 col-md-9">
                <h3>No Matches Found...</h3>
            </div>
        </div>
    </div>
<?php } ?>
    