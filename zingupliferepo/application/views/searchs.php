<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a><span  class="colorGrey">// Services & Providers</span>
    </div>
    <div class="searchPro">
        <div class="row">
            <form class="" method="post" action="<?php echo base_url(); ?>search" novalidate="novalidate">
                <div class="col-xs-5 col-sm-3 col-md-3 resizeCol">
                    <input type="hidden" name="city" value="Bangalore"/>
                    <input type="text" class="form-control" id="zingInputCity" placeholder="Search for location" name="locations">
                </div>
                <div class="col-xs-5 col-sm-7 col-md-8 resizeCol pd">
                    <input type="text" class="form-control" id="zingInputCity" placeholder="Search for Services or Providers" name="keywords">
                </div>
                <div class="col-xs-2 col-sm-2  col-md-1 resizeCol pdLf">
                    <!--                    <a href="javascript:void(0);"type="button" class="btn zing-btn serBtn">Search</a>-->
                    <input type="submit" name="submit" value="Search" class="btn zing-btn serBtn"/>
                </div>
            </form>
        </div>
    </div>

    <div class="serviceContent" id="filter_search_result">
        <div class="headMenu">
            <div class="row"  id="filter_search_result">
                <div class="col-xs-12 col-sm-12 col-md-4 reSizeHead">
                    <span class="headTitle">SERVICES & PROVIDERS</span> <span class="colorGrey">in Bangalore</span>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-8">
                    <ul>
                        <?php if ($post_data['keywords'] == '') { ?>
                            <li>
                                <button class="tagcontent search_category" id="spa">Mind Body Interventions &nbsp;<a class="ntdelbutton">x</a></button>
                            </li>
                            <li>
                                <button class="tagcontent search_category" id="yoga">Yoga&nbsp;<a class="ntdelbutton">x</a></button>
                            </li>
                            <li>
                                <button class="tagcontent search_category" id="ayurvedic_treatments">Integrative Health & Medicine &nbsp;<a class="ntdelbutton">x</a></button>
                            </li>
                            <li>
                                <button class="tagcontent search_category" id="fitness">Physical & Nutritional&nbsp;<a class="ntdelbutton">x</a></button>
                            </li>
                        <?php } ?>
                        <li class="iconFil">
                            <div class="dropdown filterMenu">
                                <a id="filerMenu" data-target="#" href="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="filterIcon"></span>
                                </a>
<!--                                <input type="hidden" name="post_data" id="post_data" value="<?php echo $post_data; ?>"/>-->
                                <ul class="dropdown-menu filter_cat" aria-labelledby="filerMenu">
                                    <li><input type="checkbox" name="vendor" value="spa" checked="checked">Mind Body Interventions</li>
                                    <li><input type="checkbox" name="vendor" value="yoga" checked="checked">Yoga</li>
                                    <li><input type="checkbox" name="vendor" value="ayurvedic_treatments" checked="checked">Integrative Health & Medicine</li>
                                    <li><input type="checkbox" name="vendor" value="fitness" checked="checked">Physical & Nutritional</li>
                                </ul>
                            </div>
                        </li>
                        <li id="result_count_filter">
                            <span>Showing&nbsp;</span>
                            <select class="selectpicker" data-style="btn-inverse" id="result_count">
                                <option value="10">1-10 Results</option>
                                <option value="25">1-25 Results</option>
                                <option value="50">1-50 Results</option>
                                <option value="75">1-75 Results</option>
                                <option value="100">1-100 Results</option>
                                <option value="all">All Results</option>
                            </select>
                            <input type="hidden" value="<?php echo $post_data['city']; ?>" id="city"/>
                            <input type="hidden" value="<?php echo $post_data['keywords']; ?>" id="keywords"/>
                            <input type="hidden" value="<?php echo $post_data['locations']; ?>" id="location"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="searchs_results_main_container">
            <?php
            $base_services = array();
            if (!empty($search_result)) {
                foreach ($search_result as $key => $value) {
                    ?>
                    <div class="reviewCard">
                        <div class="row">
                            <div class="col-xs-4 col-sm-3 col-md-3 test">
		                        <a href="<?php echo base_url() . 'vendorDetails/' . $value->vendor_id; ?>" class="btn zing-btn serBtn">
		                            <?php if ($value->logo != '') { ?>
		                              <img src="<?php echo $logo_path . $value->vendor_id . '/' . $value->logo; ?>" alt="" />  
		                            <?php } else { ?>
		                            
		                                <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg.png">
		                            <?php } ?>
		                          </a>  
                       	    </div>
                            <div class="col-xs-8 col-sm-9 col-md-9">
                                <ul class="reviewBox">
                                    <li>
                                        <ul class="sapStar">
                                           <li>
                                       			<a href="<?php echo base_url() . 'vendorDetails/' . $value->vendor_id; ?>" class="serBtn reviewName"> <?php echo $value->name; ?> </a>
                                      		 </li>
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
                                        <span class="lineLF">Mind Body Interventions (<?php echo count($base_services[$key]['spa']); ?>)&nbsp;&nbsp;</span>&nbsp;
                                        <span class="lineLF">Yoga (<?php echo count($base_services[$key]['yoga']); ?>)&nbsp;&nbsp;</span>&nbsp;
                                        <span class="lineLF">Integrative Health & Medicine (<?php echo count($base_services[$key]['ayurvedic_treatments']); ?>)&nbsp;&nbsp;</span>&nbsp;
                                        <span>Physical & Nutritional (<?php echo count($base_services[$key]['fitness']); ?>)&nbsp;&nbsp;</span>&nbsp;
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
        </div>
    </div>
</div>