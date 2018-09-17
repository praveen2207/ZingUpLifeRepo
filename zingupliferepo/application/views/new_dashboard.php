<?php
$app_path = APPPATH;
$url = base_url() . 'add-to-calendar/addToCalendar.php';
$logged_in_user_details = $this->session->userdata('logged_in_user_data');
$path = base_url() . 'assets/uploads/users/';
?>
<style>
.date .datepicker-switch
{
	padding-top: 23px;
    text-align: center;
}
</style>
<input type='hidden' name='' class='url' value='<?php echo base_url();?>'/>
   <main role="main">
        <!-- intro-wrap -->
        <div id="main">
            <section class="row section events" style="    margin-bottom: -75px;">
                <div class="row-content buffer even clear-after" style="margin-top: 70px;  padding-top:45px;">
                    <div class="text-dark">
                        <div class="column three">
                            <div class="photo-header" style="    background-color: #fff;    border: 1px solid #ebebeb;">
                                <center><img src="<?php echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>" style="width:58%;border-radius:50%;height:100px;"></center>
                            </div>
                            <div class="photo-footer">
                                <center>
                                    <h2><?php echo $logged_in_user_details->name; ?></h2>
                                    <h5 style="margin-top:10px;">Age : <?php echo $logged_in_user_details->age; ?></h5> </center>
                                <h5><span><i class="fa fa-phone" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php echo $logged_in_user_details->phone; ?></h5>
                                <h5 style="margin-top:12px;border:0px;"><span><i class="fa fa-envelope" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php echo $logged_in_user_details->username; ?></h5>
                                <h5 style="margin-top:12px;border:0px;"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php echo $logged_in_user_details->city; ?></h5> </div>
                        </div>
                    </div>
					<?php //echo '<pre>'; print_r($last_survey_report); ?>
                    <div class="column nine last">
                        <div class="text-dark">
                            <nav style="float:left;" class="hidden-xs">
                                <ul class="nav reset" role="tablist" id="myTabs" style="margin-left:-11px;">
                                    <li role="presentation" class="active"> <a data-target="#home" onclick="return false;">Overview</a></li>
                                    <li role="presentation"> <a data-target="#book" onclick="return false">Bookings</a></li>
                                    <li role="presentation"> <a data-target="#advisors" onclick="return false">Advisors</a></li>
                                    <li role="presentation"> <a data-target="#reports" onclick="return false">Reports</a></li>
                                    <li role="presentation"> <a data-target="#reviews" onclick="return false">Reviews</a></li>
                                    <li role="presentation"> <a data-target="#about" onclick="return false">Profile</a></li>
                                    <!--
                                  <li role="presentation">
                                    <a  data-target="#feedback" onclick="return false">FEEDBACK</a></li>   
    -->
                                </ul>
                            </nav>
                            <div class="tab-content  tab-border" style="min-height:500px;margin-bottom: 80px;">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="box-footer box-comments" style="padding-top:0px;">
                                        <?php if($last_survey_report[0]->score !='') { ?>
											<h2 style="font-family: 'Montserrat', sans-serif; font-size:18px;color:#1f8643;">ABOUT</h2>
										<?php } ?>
                                        <br>
										<?php if($last_survey_report[0]->score !='') { ?>
											<div class="row" style="margin-top:0px">
												<div class="column three text-center">
													<input type="text" class="knob" value="<?php echo $last_survey_report[0]->score; ?>" data-width="120" data-height="120" data-fgColor="#e67e22" data-readonly="true">
													<div class="knob-label">Physical & Nutritional</div>
												</div>
												<div class="column three text-center">
													<input type="text" class="knob" value="<?php echo $last_survey_report[1]->score; ?>" data-width="120" data-height="120" data-fgColor="#27ae60" data-readonly="true">
													<div class="knob-label">Emotional</div>
												</div>
												<!-- ./col -->
												<div class="column three text-center">
													<input type="text" class="knob" value="<?php echo $last_survey_report[2]->score; ?>" data-width="120" data-height="120" data-fgColor="#f1c40f" data-readonly="true">
													<div class="knob-label">Spiritual</div>
												</div>
												<!-- ./col -->
												<div class="column three last text-center">
													<input type="text" class="knob" value="<?php echo $last_survey_report[3]->score; ?>" data-width="120" data-height="120" data-fgColor="#e74c3c" data-readonly="true">
													<div class="knob-label">Social</div>
												</div>
											</div>
										<?php } ?>
                                        <h2 style="font-family: 'Montserrat', sans-serif; font-size:18px; margin-top:49px;color:#1f8643;">RECOMMENDED SERVICES</h2>
                                        <div class="row section advisors" style="margin-top:30px; margin-bottom:70px;">
										<?php
											$count = 1;
											foreach ($transactions as $key => $value) {
												
												if (!empty($value['booking_details'])) {
													if ($count < 4) {
										?>
                                            <div class="col-md-6 col-sm-6">
                                                <figure> <?php if ($value['booking_details']->images != '') { ?>
                                                            <img class="recommened_img" src="<?php echo $offering_gallery_path . $value['booking_details']->service_id . '/' . $value['booking_details']->images; ?>">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg1.png">
                                                        <?php } ?>
                                                    <figcaption>
                                                        <div style="padding-left:14px;padding-right:14px;">
                                                            <h2><?php echo $value['booking_details']->services; ?></h2>
                                                            <p><?php echo strip_tags(substr($value['booking_details']->desc, 0, 70)) . '...'; ?></p>
                                                            <p style=" margin-top: 15px;margin-bottom:20px; font-size: 0.80em;"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value['vendor_details']->street1; ?>, <?php echo $value['vendor_details']->city; ?></p>
                                                        </div>
                                                        <p class="knw">
															<?php if ($value['booking_details']->service_type == 'hourly') { ?>
																<a href="<?php echo base_url(); ?>offering_details/<?php echo $value['booking_details']->service_id; ?>" class="btn zing-btn bookBtn">Book Now</a>
															<?php } else { ?>
																<a href="<?php echo base_url(); ?>memberships_offering/<?php echo $value['booking_details']->service_id; ?>" class="btn zing-btn bookBtn">Book Now</a>
															<?php } ?>
														</p>
                                                    </figcaption>
                                                </figure>
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
                                <div role="tabpanel" class="tab-pane" id="book">
                                    <div class="row section advisors" style="margin-bottom:70px;">
                                        <div class="col-md-6 col-sm-6" style="border-right: 1px solid #ebebeb">
                                            <div class="mini-cal" style="margin-top:-40px;font-family: 'Montserrat', sans-serif;">
                                                <div class="calender">
                                                    <div class="column_right_grid calender">
                                                        <div class="date dashDate" style='padding:0px;'>
															<div id="dashDatePicker"  data-deselect="<?php echo $upcoming_booking_dates; ?>"></div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <h4 style="padding-left:20px;border-bottom:1px solid #ebebeb; padding-bottom:10px; color:#3fab3c">Upcoming Bookings</h4>
                                          <?php
										$up_count = 1;
										foreach ($transactions as $key => $value) {
											if ($value['booking_details']->date > date('Y-m-d')) {
												if ($up_count < 4) {
													?>
                                            <div class="event" style="padding-left:20px;border-bottom:1px solid #ebebeb; margin-top:20px;">
                                                <h4><?php echo $value['vendor_details']->name; ?></h4>
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
                                <div role="tabpanel" class="tab-pane" id="advisors">
                                    <div class="row section advisors" style="margin-top:50px; margin-bottom:70px;">
									<?php
                                    foreach ($my_advisors as $key => $value) {
                                        if ($key < 2) {
                                            ?>
                                        <div class="col-md-4 col-sm-6">
                                            <figure> <span style="float:right; background-color: grey; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;">Offline</span>
												<?php if ($value['sme_details']->active == 'y') { ?><span style="float:right; background-color: green; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;visibility:hidden;">Online</span><?php } else {
													?>
													<span style="float:right; background-color: grey; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;visibility:hidden;">Offline</span>
												<?php } ?>
                                                <center>
												<?php if ($value['sme_details']->photo != '') { ?>
                                                            <img src="<?php echo base_url(); ?>sme_users/<?php echo $value['sme_details']->sme_userid; ?>/<?php echo $value['sme_details']->photo; ?>"  class="reviewIMG" style="width: 50%;border-radius:50%;">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png"  class="reviewIMG" style="width: 50%;border-radius:50%;">
                                                        <?php } ?>
												</center>
                                            </figure>
                                            <div class="blog-excerpt" style="margin-top:-30px">
                                                <div class="blog-excerpt-inner inner">
                                                    <center>
                                                        <h2><?php echo $value['sme_details']->first_name . ' ' . $value['sme_details']->last_name; ?></h2></center>
                                                    <center>
                                                        <p><?php echo $value['sme_details']->expertise; ?></p>
                                                    </center>
                                                    <br/>
                                                    <center>
                                                        <?php if ($value['sme_details']->active == 'y' && ($value['sme_details']->chat_pricing != '' || $value['sme_details']->video_pricing != '' || $value['sme_details']->audio_pricing != '') ) { ?>
														<a href='#' id='<?php echo $value['sme_details']->sme_userid; ?>' class='sme_chat'><button type="submit" class="btn btn-chat">Chat</button></a>
														<button style='position:absolute;display:none;background:#ccc;width:13%;opacity:.5;height:21px;left:26px;top:0px;' class='btn btn-book btn-chat-hide'></button>

														<a href='<?php echo base_url(); ?>experts/user_book/<?php echo $value['sme_details']->sme_userid; ?>' id='<?php echo $value['sme_details']->sme_userid; ?>' <?php if ($logged_in_user_data->is_logged_in != 1) { ?>class='sme_book'<?php } ?>><button type="submit" class="btn btn-book">Book</button></a>
														<?php } else {?>
														<a href='<?php echo base_url(); ?>experts/user_book/<?php echo $value['sme_details']->sme_userid; ?>'id='<?php echo $value['sme_details']->sme_userid; ?>'  <?php if ($logged_in_user_data->is_logged_in != 1) { ?>class='sme_book'<?php } ?>><button type="submit" class="btn btn-book">Book</button></a>
														<?php } ?>
                                                    </center>
                                                </div>
                                                <!-- blog-excerpt -->
                                            </div>
                                        </div>
										   <?php
											}
										}
										?>
                                       
                                    </div>
                                  
                                </div>
                                <div role="tabpanel" class="tab-pane" id="reports">                                     
                              
                                    <table class="table table-striped" style="margin-bottom:100px;">
                                         <h5 style="font-family: 'Montserrat', sans-serif; font-size:15px;color:#1f8643;">My Wellness Assessments Reports</h5>
                                        <thead>
                                            <tr>
                                                <td>S no.</td>
                                                <td>Date</td>
                                                <td>Download</td>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											$i=0; foreach($survey_det as $s) {  $i++; if($s->reports !=0){ ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo date('d M, Y',strtotime($s->added_on)); ?></td>                                    
                                                <td>
													<a href='<?php echo base_url();?>survey/report/<?php echo $s->id; ?>' target='_blank'>
														<i class="fa fa-file-o" aria-hidden="true"></i>
													</a>
												</td>
                                            </tr>
										<?php } } ?>  
                                        </tbody>
                                    </table>
                                     
                                </div>
                                <div role="tabpanel" class="tab-pane" id="reviews">
								
								 <?php foreach ($my_reviews as $key => $value) { ?>
										<div class="row articles">
											<div class="column two"> 
												 <?php if ($value->image != '') { ?>
                                                        <img src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $value->user_id; ?>/<?php echo $value->image; ?>"  class="reviewIMG" style='width:100%;'>
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png"  class="reviewIMG" style='width:100%;'>
                                                    <?php } ?>
											</div>
											<div class="column ten last">
												<p><?php echo substr($value->review, 0, 90) . '...'; ?></p>
												<h5><?php
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
                                                                ?></h5>
																
											</div>
										</div>
									<?php } ?> 
                                </div>
                                <div role="tabpanel" class="tab-pane" id="about">
                                <div class="row articles">
                                    <div class="column twelve">
                                        <h2><?php echo $logged_in_user_details->name; ?><span class="pull-right"><a href="<?php echo base_url();?>my_profile"  style="font-size:13px; text-decoration:none;color:#3fab3c">edit</a></span></h2>
                                       
                                    </div>
                                </div>
                                    <div class="row articles" >
                                     <h2>Subscription Plan<span class="pull-right"><a href="<?php echo base_url();?>my_profile"  style="font-size:13px; text-decoration:none;color:#3fab3c">edit</a></span></h2>
                                       <?php
                foreach ($memberships as $key => $value) {
                    $count = count($memberships);
                    if ($count == ($key + 1)) {
                        $custom_class = 'subscription_sub_ctr1';
                    } else {
                        $custom_class = '';
                    }
                    ?>
                                       <h5 style="line-height: 2.34">Subscription Plan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="font-size: 14px;color: #818181;">&nbsp;&nbsp;&nbsp;<?php echo $value['details']->membership; ?></span></h5>
									   <h5 style="line-height: 2.34">Subscription Place &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="font-size: 14px;color: #818181;">&nbsp;&nbsp;&nbsp;<?php echo $value['vendor_details']->area_name . ', ' . $value['vendor_details']->city; ?></span></h5>
                                        <h5 style="line-height: 2.34">Subscription Period &nbsp;&nbsp;&nbsp;&nbsp;: <span style="font-size: 14px;color: #818181;">&nbsp;&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($value['details']->membership_start_date)); ?> - <?php echo date('d/m/Y', strtotime($value['details']->membership_end_date)); ?></span></h5>
                                        <h5 style="line-height: 2.34">Subscription Renewal : <span style="font-size: 14px;color: #818181;">&nbsp;&nbsp;&nbsp;Manual</span></h5>
                              <?php } ?>  
								
								</div>
                                    <div class="row" style="margin-top:15px;" >
                                     <a href="<?php echo base_url();?>change_password" style="font-size:14px; text-decoration:none; color:#3fab3c">CHANGE PASSWORD</a>
                                      
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- id-main -->
    </main>
    <!-- main -->
    <div class="modal fade" tabindex="-1" role="dialog" id="bookoptions">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center; color: green;">BOOK AN APPOINTMENT</h4> </div>
                <div class="modal-body" style="height:360px; padding-top:40px;">
                    <p style="text-align:center; margin-bottom:50px;">How would you like to talk to talk to John?</p>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="service" style="text-align: center;">
                                <div class="image-container"> <img src="img/interface.png"></div>
                                <h5>Text Chat</h5>
                                <button type="submit" class="btn btn-chat">Amount/Session</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="service" style="text-align: center;">
                                <div class="image-container"><img src="img/technology.png"></div>
                                <h5>Voice Chat</h5>
                                <button type="submit" class="btn btn-chat">Amount/Session</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="service" style="text-align: center;">
                                <div class="image-container"><img src="img/video-play.png"></div>
                                <h5>Video Chat</h5>
                                <button type="submit" class="btn btn-chat">Amount/Session</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>