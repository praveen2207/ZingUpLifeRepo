<?php
$app_path = APPPATH;
$url = base_url() . 'add-to-calendar/addToCalendar.php';
?>
<input type='hidden' name='' class='url' value='<?php echo base_url();?>'/>
<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <span  class="colorGrey">Dashboard</span>
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

    <div class="couponsBox">
        <span>WELLNESS OFFERS / COUPONS / FREE AD</span>
        <!--<a href="javascript:void(0);"type="button" class="btn zing-btn dasBtn">Book Now</a>-->
		      <?php  if($livechat) { 
								date_default_timezone_set("Asia/Kolkata"); 
								 $currentime = date('h:i A'); 
								
								foreach($livechat as $l) {
									
										$minutes = strtotime($l->time_from) - strtotime($currentime);
										$diff = abs($minutes); 
										//if(($diff <= 600 && $l->time_to < $currentime) || ($l->time_from < $currentime && $l->time_to > $currentime))
										if(($diff <= 600 && strtotime($l->time_from) > strtotime($currentime)) || (strtotime($l->time_from) < strtotime($currentime) && strtotime($l->time_to) > strtotime($currentime)) )
										{
								?>
										<?php if($l->video_link !='') {?>
											<!--<a href='<?php echo $l->video_link; ?>' target='_blank'>-->
											<a href='<?php echo base_url(); ?>experts/user_live_session'>
										<?php  }?>
											<p class="livechatBtn pull-right" style='width:auto;cursor:pointer;'>
												
												<span class="liveTxt colorGreen click_join_session" id='<?php echo $l->id;?>'>Click  to join <?php echo $l->book_type; ?>(Live) Session</span>
												
											</p>
										<?php if($l->video_link !='') {?>
											</a>
										<?php  }?>
									<?php 			
												}
											
									?>
							
							<?php } } ?>
    </div>

    <div class="dashTab">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"  class="active">
                <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">OVERVIEW</a>
            </li>
            <li role="presentation">
                <a href="#bookings" aria-controls="bookings" role="tab" data-toggle="tab">MY BOOKINGS</a>
            </li>
            <li role="presentation">
                <a href="#advisors" aria-controls="advisors" role="tab" data-toggle="tab">MY ADVISORS</a>
            </li>
            <!--            <li role="presentation">
                            <a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">MY REPORTS</a>
                        </li>-->
            <li role="presentation">
                <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">MY REVIEWS</a>
            </li>
			<li role="presentation">
                <a href="#callbookings" aria-controls="bookings" role="tab" data-toggle="tab">MY Call BOOKINGS</a>
            </li>
			 <?php if(isset($survey_det)) {?> 
				<li role="presentation">
					<a href="#report" aria-controls="reviews" role="tab" data-toggle="tab">Wellness Assessment Report</a>
				</li>
            <?php } ?>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane   active" id="overview">
                <div class="row">
                    <div class="col-md-8 pdDr">
                        <div class="statsBox">
                            <!--                            <div class="progaressBox">
                                                            <div class="statsList">
                                                                <span>MY STATS</span>
                                                                <ul>
                                                                    <li>
                                                                        <span class="colorGrey">Last Updated on 28/12/2016 &nbsp;&nbsp;&nbsp;|</span>
                                                                    </li>
                                                                    <li><span class="colorGreen">Update Now</span></li>
                                                                    <li>
                                                                        <select class="selectpicker" data-style="btn-inverse">
                                                                            <option>Select Stats</option>
                                                                            <option>......</option>
                                                                            <option>......</option>
                                                                        </select>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="row progressImg">
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/greenProgress.png">
                                                                    <h5>BMI</h5>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/yellowProgress.png">
                                                                    <h5>BP</h5>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/greenProgress.png">
                                                                    <h5>Cholestrol</h5>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/yellowProgress.png">
                                                                    <h5>Weight Management</h5>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <div class="recommenedBox">
                                <div class="deshText">
                                    <span>RECOMMENDED SERVICES</span>
                                </div>
                                <div class="row">
                                    <?php
                                    $count = 1;

                                    foreach ($transactions as $key => $value) {

                                        if (!empty($value['booking_details'])) {
                                            if ($count < 4) {
                                                ?>
                                                <div class="col-xs-6 col-sm-4 col-md-4">
                                                    <div class="recommenCard">
            <!--                                                        <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg1.png">-->
                                                        <?php if ($value['booking_details']->images != '') { ?>
                                                            <img class="recommened_img" src="<?php echo $offering_gallery_path . $value['booking_details']->service_id . '/' . $value['booking_details']->images; ?>">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg1.png">
                                                        <?php } ?>
                                                        <h5 class="colorGreen"><?php echo $value['booking_details']->services; ?></h5>
                                                        <h6 class="recommened_desc">
                                                            <?php echo strip_tags(substr($value['booking_details']->desc, 0, 70)) . '...'; ?>
                                                        </h6>
                                                        <?php if ($value['booking_details']->service_type == 'hourly') { ?>
                                                            <a href="<?php echo base_url(); ?>offering_details/<?php echo $value['booking_details']->service_id; ?>" class="btn zing-btn bookBtn">Book Now</a>
                                                        <?php } else { ?>
                                                            <a href="<?php echo base_url(); ?>memberships_offering/<?php echo $value['booking_details']->service_id; ?>" class="btn zing-btn bookBtn">Book Now</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $count++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pdDl">
                        <div class="upcomingBox">
                            <div class="statsList">
                                <span>MY UPCOMING BOOKINGS</span>
                                <a href="javascript:void(0);" class="colorGreen pull-right">View All</a>
                            </div>

                            <div class="date dashDate">
                                <div id="dashDatePicker"  data-deselect="<?php echo $upcoming_booking_dates; ?>"></div>
                            </div>
                            <?php
                            $up_count = 1;
                            foreach ($transactions as $key => $value) {
                                if ($value['booking_details']->date > date('Y-m-d')) {
                                    if ($up_count < 4) {
                                        ?>
                                        <div class="addressCard">
                                            <h5 class="colorGreen"><?php echo $value['vendor_details']->name; ?></h5>
                                            <p><?php echo $value['vendor_details']->area_name . ', ' . $value['vendor_details']->city . ', ' . $value['vendor_details']->state . ', ' . $value['vendor_details']->zipcode; ?></p>
                                            <ul>
                                                <li class="resizeTime_das">
                                                    <span><?php echo date('D, M d, Y', strtotime($value['booking_details']->date)); ?>
                                                        | <?php echo date('H:i a', strtotime($value['booking_details']->start_time)); ?></span>
                                                </li>
                                                <li class="resize_resched">
                                                    <a href="<?php echo base_url(); ?>reschedule/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen">Reschedule</a>
                                                </li>
                                                <li class="resize_cencel">
                                                    <a href="<?php echo base_url(); ?>cancel_order/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }$up_count++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="retingBox">
                        <div class="col-sm-12 col-md-4">
                            <div class="reportsList">
                                <div class="deshText">
                                    <span>RECOMMENDED SERVICES</span>
                                    <!--                                    <a href="javascript:void(0);" class="colorGreen pull-right">View All</a>-->
                                </div>
                                <ul>
                                    <?php
                                    $counter = 1;
                                    foreach ($transactions as $key => $value) {

                                        if (!empty($value['booking_details'])) {
                                            if ($counter < 3) {
                                                ?>
                                                <li>
                                                    <div class="cardImg">
                                                        <div class="imgCard"><img src="<?php echo base_url(); ?>assets/new_design/image/list.png"></div>
                                                        <div class="imgText">
                                                            <h5 class="colorGreen"><?php echo $value['booking_details']->services; ?></h5>
                                                            <h6 class="colorGrey"><?php echo $value['booking_details']->duration; ?></h6>
                                                            <p><?php echo strip_tags(substr($value['booking_details']->desc, 0, 70)) . '...'; ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            $counter++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="reportsList">
                                <div class="deshText">
                                    <span>MY ADVISORS</span>
                                    <!--                                    <a href="javascript:void(0);" class="colorGreen pull-right">View All</a>-->
                                </div>
                                <ul>
                                    <?php
                                    foreach ($my_advisors as $key => $value) {
                                        if ($key < 2) {
                                            ?>
                                            <li>
                                                <div class="cardImg">
                                                    <div class="imgCard" id="dashboard_sme_image">
        <!--                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/profile.png" class="reviewIMG">-->
                                                        <?php if ($value['sme_details']->photo != '') { ?>
                                                            <img src="<?php echo base_url(); ?>sme_users/<?php echo $value['sme_details']->sme_userid; ?>/<?php echo $value['sme_details']->photo; ?>"  class="reviewIMG">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png"  class="reviewIMG">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="imgText">
                                                        <h5 class="colorGreen"><?php echo $value['sme_details']->first_name . ' ' . $value['sme_details']->last_name; ?></h5>
                                                        <h6 class="colorGrey"><?php echo $value['sme_details']->expertise; ?></h6>
                                                        <p><?php echo substr($value['sme_details']->about, 0, 90) . '...'; ?></p>
        <!--                                                        <span class="colorGreen commenLike">23 Comments </span>
                                                        <span class="colorGreen commenLike lineBor">5 Likes</span>-->
                                                        <span class="colorGreen commenLike"><?php echo $value['followers']; ?> comments </span>
                                                        <span class="colorGreen commenLike lineBor"><?php echo $value['likes']; ?> Likes</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="reportsList">
                                <div class="deshText">
                                    <span>MY REVIEWS</span>
                                    <!--                                    <a href="javascript:void(0);" class="colorGreen pull-right">View All</a>-->
                                </div>
                                <ul>
                                    <?php
                                    foreach ($my_reviews as $key => $value) {
                                        if ($key < 2) {
                                            ?>
                                            <li>
                                                <div class="cardImg reviewLast">
                                                    <div class="imgCard">
        <!--                                                <img src="<?php echo base_url(); ?>assets/new_design/image/profile.png" class="reviewIMG">-->
                                                        <?php if ($value->image != '') { ?>
                                                            <img src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $value->user_id; ?>/<?php echo $value->image; ?>"  class="reviewIMG">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png"  class="reviewIMG">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="imgText">
                                                        <h5 class="colorGreen"><?php echo $value->title; ?></h5>
                                                        <ul class="sapStar">
                                                            <li><h6 class="colorGrey">
                                                                    <?php
                                                                    $date = date('Y-m-d', strtotime($value->posted));
                                                                    $today_date = date('Y-m-d');
                                                                    $date_diff = strtotime($today_date) - strtotime($date);
                                                                    $date_difference = floor(($date_diff) / 2628000);
                                                                    if ($date_difference == 1) {
                                                                        echo $date_difference . ' Month Back';
                                                                    } elseif ($date_difference == 0) {
                                                                        echo $date;
                                                                    } else {
                                                                        echo $date_difference . ' Months Back';
                                                                    }
                                                                    ?>
                                                                </h6>
                                                            </li>
                                                            <?php
                                                            $rating = round($value->rating);
                                                            if ($value->rating != '') {
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
                                                        </ul>
                                                        <p><?php echo substr($value->review, 0, 90) . '...'; ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="bookings">
                <div class="row">
                    <div class="col-md-8 pdDr">
                        <div class="bookingBox">
                            <div class="upTabmenu">
                                <div class="bookAll">
                                    <a href="javascript:void(0);" class="colorGreen pull-right reSize_det">Delete Select</a>
                                    <a href="javascript:void(0);" class="colorGreen pull-right selectbtn">Book Select</a>
                                </div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#upcoming" aria-controls="upcoming" role="tab" data-toggle="tab">MY UPCOMING BOOKINGS</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#allBooking" aria-controls="allBooking" role="tab" data-toggle="tab">ALL BOOKINGS</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="upcoming">
                                        <div class="upcomingBoxtab">
                                            <?php
                                            if (!empty($transactions)) {
                                                foreach ($transactions as $key => $value) {
                                                    if ($value['booking_details']->date > date('Y-m-d')) {
                                                        ?>

                                                        <div class="row upcoming_card">
                                                            <div class="col-sm-12 col-md-6">
                                                                <!--                                                            <h5>Web, Feb 10, 2016 | 2:00pm</h5>-->
                                                                <h5><a href="<?php echo base_url(); ?>transaction_details/<?php echo $value['transactions']->booking_id; ?>"><?php echo date('D, M d, Y', strtotime($value['booking_details']->date)); ?>
                                                                        | <?php echo date('H:i a', strtotime($value['booking_details']->start_time)); ?>
                                                                    </a>
                                                                </h5>
                                                                <span class="colorGreen"><?php echo $value['vendor_details']->name; ?></span>
                                                                <p><?php echo $value['vendor_details']->street1 . ', ' . $value['vendor_details']->street2 . ', '; ?><br/>
                                                                    <?php echo $value['vendor_details']->area_name . ', ' . $value['vendor_details']->city . ', ' . $value['vendor_details']->state . ', ' . $value['vendor_details']->zipcode; ?></p>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <ul>
                                                                    <li>
                                                                        <a href="<?php echo base_url(); ?>reschedule/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen">Reschedule</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo base_url(); ?>cancel_order/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen">Cancel</a>
                                                                    </li>
                                                                    <li>
                                                                        <!--                                                                    <a href="javascript:void(0);" class="colorGreen">Add To Calendar</a>-->
                                                                        <a class="add-cal-link colorGreen" href="<?php echo $url; ?>?format=google&amp;fn=Zinguplife%20Bangalore%20Event&amp;title=Zinguplife Booking%20on%20Date&amp;start=<?php echo date('Y-m-d', strtotime($value['booking_details']->date)); ?>+<?php echo date('H:i a', strtotime($value['booking_details']->start_time)); ?>" target="_blank">Add to Calendar</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                ?>

                                                <div class="row upcoming_card">
                                                    <div class="col-sm-12 col-md-12 align_center">
                                                      No Records Found !!!
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="allBooking">
                                        <div class="tableList">
                                            <table class="table">
                                                <thead>
                                                    <tr class="tabHead">
                                                        <td>
<!--                                                            <input type="checkbox" id="selectall">-->
                                                            <span>SNo.</span>
                                                        </td>
                                                        <td><span>Name</span></td>
                                                        <td><span>Location</span></td>
                                                        <td><span>Date & Time</span></td>
                                                        <td><span>Status</span></td>
                                                        <td><span>Action</span></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($transactions)) { ?>
                                                        <?php foreach ($transactions as $key => $value) { ?>
                                                            <tr>
        <!--                                                            <td><input type="checkbox" class="booking" name="booking" value="1"></td>-->
                                                                <td><?php echo $key + 1; ?></td>
                                                                <td class="word_break_down"><?php echo $value['vendor_details']->name; ?></td>
                                                                <td class="word_break_down"><?php echo $value['vendor_details']->area_name; ?></td>
                                                                <?php if ($value['booking_details']->service_type == 'hourly') { ?>
                                                                    <td><?php echo date('d/m/Y', strtotime($value['booking_details']->date)); ?><br/>
                                                                        <?php echo date('H:i A', strtotime($value['booking_details']->start_time)); ?>
                                                                    </td>
                                                                <?php } else { ?>
                                                                    <td><?php echo date('d/m/Y', strtotime($value['booking_details']->membership_start_date)); ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <td><?php echo $value['booking_details']->booking_status; ?></td>
                                                                <td>
                                                                    <?php
                                                                    //echo $value['booking_details']->date;
                                                                    if ($value['booking_details']->date < date('Y-m-d')) {
                                                                        ?>
                                                                        <?php if ($value['booking_details']->service_type == 'hourly') { ?>
                                                                            <a href="<?php echo base_url(); ?>offering_details/<?php echo $value['booking_details']->service_id; ?>" class="colorGreen">Book Again</a>
                                                                        <?php } else { ?>
                                                                            <a href="<?php echo base_url(); ?>memberships_offering/<?php echo $value['booking_details']->service_id; ?>" class="colorGreen">Book Again</a>
                                                                        <?php } ?>
                                                                    <?php } elseif ($value['booking_details']->date > date('Y-m-d')) { ?>
                                                                        <a href="<?php echo base_url(); ?>reschedule/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen selectbtn">Reschedule</a>
                                                                        <a href="<?php echo base_url(); ?>cancel_order/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen">Cancel</a>
                                                                    <?php } else { ?>
            <!--                                                                    <a href="<?php echo base_url(); ?>cancel_order/<?php echo $value['transactions']->booking_id; ?>" class="colorGreen">Cancel</a>-->
                                                                    <?php } ?>

                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="align_center">No Records Found !!!</td>
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

                    <div class="col-md-4 pdDl">
                        <div class="upcomingBox">
                            <div class="statsList">
                                <span>MY UPCOMING BOOKINGS</span>
                                <a href="javascript:void(0);" class="colorGreen pull-right">View All</a>
                            </div>

                            <div class="date dashDate">
                                <div id="dashDatePicker01"></div>
                            </div>
                            <?php
                            $visited_centers = array();
                            foreach ($transactions as $key => $value) {
                                if (strtotime($value['booking_details']->date) < date('Y-m-d')) {
                                    $visited_centers[] = $value['vendor_details'];
                                }
                            }
                            ?>
                            <?php
                            $visited_center = array_unique($visited_centers);
                            if (!empty($visited_center)) {
                                ?>
                                <h3 class="visitedTxt">VISITED CENTERS</h3>
                                <?php
                                foreach ($visited_center as $keys => $values) {
                                    if ($keys < 3) {
                                        ?>
                                        <div class="addressCard bookingAdd">
                                            <h5 class="colorGreen"><?php echo $values->name; ?></h5>
                                            <p><?php echo $values->street1 . ', ' . $values->area_name . ', ' . $values->city . ', ' . $values->state . ', ' . $values->zipcode; ?></p>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="advisors">
                <div class="advisorsBox">
                    <div class="row">
                        <?php foreach ($my_advisors as $key => $value) { ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="cardAdvisor">
                                    <div class="col-xs-4 col-sm-3 col-md-3 resize_cards">
                                        <?php if ($value['sme_details']->photo != '') { ?>
                                            <img class="sme_image_class" src="<?php echo base_url(); ?>sme_users/<?php echo $value['sme_details']->sme_userid; ?>/<?php echo $value['sme_details']->photo; ?>">
                                        <?php } else { ?>
                                            <img class="sme_image_class"  src="<?php echo base_url(); ?>assets/new_design/image/sme_user_placeholder.png">
                                        <?php } ?>
    <!--                                    <img src="<?php //echo base_url();                                                                               ?>assets/new_design/image/advisors.png">-->
                                    </div>
                                    <div class="col-xs-8 col-sm-9 col-md-9 resize_cards">
                                        <h4 class="colorGreen"><?php echo $value['sme_details']->first_name . ' ' . $value['sme_details']->last_name; ?></h4>
                                        <sapn class="colorGrey"><?php echo $value['sme_details']->expertise; ?></sapn>
                                        <p><?php echo $value['sme_details']->about; ?></p>
                                    </div>
                                    <div class="col-xs-12 moreAdvisor">
                                        <span class="colorGreen pull-right"><?php echo $value['likes']; ?> Likes</span>
                                        <span class="colorGreen pull-right commAdvi"><?php echo $value['followers']; ?> Comments</span>
                                        <a href="<?php echo base_url(); ?>experts/user/<?php echo $value['sme_details']->sme_userid; ?>"type="button" class="btn zing-btn redBtn pull-right">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="reports">
                <div class="reportsBox">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li><h4 class="repText">MY WELLNESS ASSESSMENT REPORT</h4></li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Emotional Wellness Report</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Complete Wellness Report</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Emotional Wellness Report</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Complete Wellness Report</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li><h4 class="repText">MY FITNESS REPORT</h4></li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Fitness Report 1</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Fitness Report 2</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Fitness Report 3</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="cardReports">
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url(); ?>assets/new_design/image/list.png">
                                        </div>
                                        <div class="col-md-10">
                                            <h4 class="colorGreen">Fitness Report 4</h4>
                                            <h6 class="colorGrey">12/12/2015</h6>
                                            <p>Duis aute irure dolor in reprehenderit involupt.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="reviews">
                <div class="reviewdasBox my_review_report_ctr">
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <?php foreach ($my_reviews as $key => $value) { ?>
                                    <li>
                                        <div class="col-md-6">
                                            <div class="cardReports revCards my_review_report">
                                                <div class="col-xs-3 col-sm-2 col-md-2">
    <!--                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/advisors.png">-->
                                                    <?php if ($value->image != '') { ?>
                                                        <img src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $value->user_id; ?>/<?php echo $value->image; ?>"  class="reviewIMG">
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png"  class="reviewIMG">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-xs-9 col-sm-10 col-md-10">
                                                    <h4 class="colorGreen"><?php echo $value->title; ?></h4>
                                                    <ul class="sapStar">
                                                        <li>
                                                            <span class="colorGrey"> <?php
                                                                $date = date('Y-m-d', strtotime($value->posted));
                                                                $today_date = date('Y-m-d');
                                                                $date_diff = strtotime($today_date) - strtotime($date);
                                                                $date_difference = floor(($date_diff) / 2628000);
                                                                if ($date_difference == 1) {
                                                                    echo $date_difference . ' Month Back';
                                                                } elseif ($date_difference == 0) {
                                                                    echo $date;
                                                                } else {
                                                                    echo $date_difference . ' Months Back';
                                                                }
                                                                ?>
                                                            </span>
                                                        </li>
                                                        <?php
                                                        $rating = round($value->rating);
                                                        if ($value->rating != '') {
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
                                                    </ul>

                                                    <p><?php echo substr($value->review, 0, 90) . '...'; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!--                        <div class="col-md-6">
                                                    <ul>
                                                        <li><h4 class="repText">MY FITNESS REPORT</h4></li>
                                                        <li>
                                                            <div class="cardReports revCards">
                                                                <div class="col-xs-3 col-sm-2 col-md-2">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/advisors.png">
                                                                </div>
                                                                <div class="col-xs-9 col-sm-10 col-md-10">
                                                                    <h4 class="colorGreen">Fitness Report 1</h4>
                                                                    <ul class="sapStar">
                                                                        <li><span class="colorGrey">2 Months Back</span></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                                                                    </ul>
                        
                                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="cardReports revCards">
                                                                <div class="col-xs-3 col-sm-2 col-md-2">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/advisors.png">
                                                                </div>
                                                                <div class="col-xs-9 col-sm-10 col-md-10">
                                                                    <h4 class="colorGreen">Fitness Report 2</h4>
                                                                    <ul class="sapStar">
                                                                        <li><span class="colorGrey">2 Months Back</span></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                                                                    </ul>
                        
                                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="cardReports revCards">
                                                                <div class="col-xs-3 col-sm-2 col-md-2">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/advisors.png">
                                                                </div>
                                                                <div class="col-xs-9 col-sm-10 col-md-10">
                                                                    <h4 class="colorGreen">Fitness Report 3</h4>
                                                                    <ul class="sapStar">
                                                                        <li><span class="colorGrey">2 Months Back</span></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star'></i></li>
                                                                        <li><i class='glyphicon glyphicon-star empty'></i></li>
                                                                    </ul>
                                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="cardReports revCards">
                                                                <div class="col-xs-3 col-sm-2 col-md-2">
                                                                    <img src="<?php echo base_url(); ?>assets/new_design/image/advisors.png">
                                    </div>
                                    <div class="col-xs-9 col-sm-10 col-md-10">
                                        <h4 class="colorGreen">Fitness Report 4</h4>
                                        <ul class="sapStar">
                                            <li><span class="colorGrey">2 Months Back</span></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star'></i></li>
                                            <li><i class='glyphicon glyphicon-star empty'></i></li>
                                        </ul>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>-->
                    </div>
                </div>
            </div>
			
			 <div role="tabpanel" class="tab-pane" id="callbookings">
                <div class="row">
                    <div class="col-md-8 pdDr">
                        <div class="bookingBox">
                            <div class="upTabmenu">
                                <div class="bookAll">
                                    <a href="javascript:void(0);" class="colorGreen pull-right reSize_det">Delete Select</a>
                                    <a href="javascript:void(0);" class="colorGreen pull-right selectbtn">Book Select</a>
                                </div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#upcoming" aria-controls="upcoming" role="tab" data-toggle="tab">MY UPCOMING CALL BOOKINGS</a>
                                    </li>
                                  
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="upcoming">
                                        <div class="upcomingBoxtab">
										<?php if(count($call_transactions) != 0 ) { ?>
											<p>Online cancellation is not available. Please call customer support for cancellation and refund. </p>
										<?php } ?>
                                            <?php if(count($call_transactions) != 0 ) {
                                            foreach ($call_transactions as $call) {
														date_default_timezone_set("Asia/Kolkata"); 
														$today = date('Y-m-d');
														$currentime = date('h:i A'); 
														 $cur = strtotime($currentime);
														 $from = strtotime($call->time_from);
															if( $call->date == $today  && $cur  < $from) {
                                                //if (strtotime($value['booking_details']->date) > date('Y-m-d')) {
                                                    ?>

                                                    <div class="row upcoming_card">
                                                        <div class="col-sm-12 col-md-6">
                                                            <h5><?php echo date('D, M d, Y', strtotime($call->date)); ?>
                                                                    | <?php echo $call->time_from; echo "-"; echo $call->time_to;  ?>
                                                            </h5>
															<p><span class="colorGreen">Book Type : <?php echo $call->book_type; ?></span></p>
															 <span class="colorGreen">Expert : <?php echo $call->first_name; ?></span>
															<div class="col-xs-4 col-sm-3 col-md-3 resize_cards">
																<?php if ($call->photo != '') { ?>
																	<img class="sme_image_class" src="<?php echo base_url(); ?>sme_users/<?php echo $call->sme_userid; ?>/<?php echo $call->photo; ?>">
																<?php } else { ?>
																	<img class="sme_image_class"  src="<?php echo base_url(); ?>assets/new_design/image/sme_user_placeholder.png">
																<?php } ?>
															</div>
                                                           
                                                            <p><?php echo $call->address; ?><br/>
                                                                <?php echo $call->phone; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <ul>
                                                                <li>
                                                                    <a href="<?php echo base_url(); ?>reschedule_call/<?php echo $call->id; ?>" target='_blank' class="colorGreen">Reschedule</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                //}
                                            }  else if($call->date > $today) { ?> 
											<div class="row upcoming_card">
                                                        <div class="col-sm-12 col-md-6">
                                                            <h5><?php echo date('D, M d, Y', strtotime($call->date)); ?>
                                                                    | <?php echo $call->time_from; echo "-"; echo $call->time_to;  ?>
                                                            </h5>
															<p><span class="colorGreen">Book Type : <?php echo $call->book_type; ?></span></p>
															 <span class="colorGreen">Expert : <?php echo $call->first_name; ?></span>
															<div class="col-xs-4 col-sm-3 col-md-3 resize_cards">
																<?php if ($call->photo != '') { ?>
																	<img class="sme_image_class" src="<?php echo base_url(); ?>sme_users/<?php echo $call->sme_userid; ?>/<?php echo $call->photo; ?>">
																<?php } else { ?>
																	<img class="sme_image_class"  src="<?php echo base_url(); ?>assets/new_design/image/sme_user_placeholder.png">
																<?php } ?>
															</div>
                                                           
                                                            <p><?php echo $call->address; ?><br/>
                                                                <?php echo $call->phone; ?></p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <ul>
                                                                <li>
                                                                    <a href="<?php echo base_url(); ?>reschedule_call/<?php echo $call->id; ?>" target='_blank' class="colorGreen">Reschedule</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
											<?php } } } else {
                                                ?>

                                                <div class="row upcoming_card">
                                                    <div class="col-sm-12 col-md-12 align_center">
                                                      No Records Found !!!
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4 pdDl">
                        <div class="upcomingBox">
                            <div class="statsList">
                                <span>MY UPCOMING BOOKINGS</span>
                                <a href="javascript:void(0);" class="colorGreen pull-right">View All</a>
                            </div>

                            <div class="date dashDate">
                                <div id="dashDatePicker01"></div>
                            </div>
                            <?php
                            $visited_centers = array();
                            foreach ($transactions as $key => $value) {
                                if (strtotime($value['booking_details']->date) < date('Y-m-d')) {
                                    $visited_centers[] = $value['vendor_details'];
                                }
                            }
                            ?>
                            <?php if (!empty($visited_centers)) { ?>
                                <h3 class="visitedTxt">VISITED CENTERS</h3>
                                <?php
                                foreach ($visited_centers as $keys => $values) {
                                    if ($keys < 3) {
                                        ?>
                                        <div class="addressCard bookingAdd">
                                            <h5 class="colorGreen"><?php echo $values->name; ?></h5>
                                            <p><?php echo $values->street1 . ', ' . $values->area_name . ', ' . $values->city . ', ' . $values->state . ', ' . $values->zipcode; ?></p>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
			
			 <div role="tabpanel" class="tab-pane" id="report">
                <div class="reviewdasBox my_review_report_ctr">
                    <div class="row">
                        <div class="col-md-12">
							<style>
							#report table tr td, #report table tr{
								border:1px solid #ccc;
								padding:5px;
								width:2px;
							}
							#report table
							{
								width:100%;
							}
							</style>
							<p>Improve your wellness quotient, consult our wide network wellness <a href='<?php echo base_url(); ?>experts/home'>experts</a> and avail different <a href='<?php echo base_url(); ?>search'>service offering</a>.</p>
<br/>
                   <!--<p class='pull-left'>Please find all the Survey Report taken pdf links below</p>-->
				   <?php echo $survey; if($survey) {?><p class='pull-right'><a href='<?php echo base_url(); ?>survey/home'>Retake Survey</a></p><?php } ?>
				   <?php //echo '<pre>'; print_r($survey_det);?>
				   <?php $i=0; foreach($survey_det as $s) {  $i++; if($s->reports !=0){ ?>
						<div style='clear:both;'>
							<a href='<?php echo base_url();?>survey/report/<?php echo $s->id; ?>'>
								Download the report of the Survey taken on <?php echo date('d/m/Y',strtotime($s->added_on)); ?>
							</a>
						</div>
				   <?php } else if($s->promo == 0){  $logged_in_user_details = $this->session->userdata('logged_in_user_data');?>
				       <p class='download_link_<?php echo $i;?>'>To Download the report of the Survey taken on <?php echo date('d/m/Y',strtotime($s->added_on)); ?> </p>
					  
						<p style='margin-left:20px;color:red;display:none;' class='er-msg_<?php echo $i;?>'>The code entered is not valid/wrong AccessCode</p>
						<input type='hidden' value='<?php echo $logged_in_user_details->username; ?>' class='email-send-code' />
						<input type='hidden' value='<?php echo $logged_in_user_details->name; ?>' class='email-send-code-name' />
						 <button type="button" class="btn btn-default nxt-btn23 get-access-code" name='btntype' value='next' style="background-image:none;background-color:#009746; color:#fff; margin-left:20px;">&nbsp;&nbsp; Get Access Code &nbsp;&nbsp;
						 </button>
						 <div class="form-group access-code-form" style='margin-left:20px;display:none;'>
						 <p style='color:green;'>The Access Code is sent to your registered email ID. Please check your mail and enter the code in the box shown below</p>
							<input type="text" id="name" name="code" placeholder="Access Code" class='access-code-ent' value=''/>
							 <input type='hidden' value='<?php echo date('d/m/Y',strtotime($s->added_on)); ?>' class='date' />
							<button type="button" class="btn btn-default nxt-btn23 submit-new-access-code" id='<?php echo $i;?>' name='btntype' value='next' style="background-image:none;background-color:#009746; color:#fff; margin-left:20px;">&nbsp;&nbsp; Submit &nbsp;&nbsp;
						 </button>
						</div>
				   <?php } else if($s->promo == 1){ ?>
						<p><a href='<?php echo base_url();?>survey/home'>Please complete survey started on <?php echo date('d/m/Y',strtotime($s->added_on)); ?></a></p>
				   <?php } } ?>
						</div>
					</div>
				</div>
			</div>
			
			
        </div>
    </div>
</div>