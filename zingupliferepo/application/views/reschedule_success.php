
<div class="location-header redirect-header">
    <h3 class="redirect-head">Reschedule</h3>

</div>
<div class="row-fluid notify">
    <div class="span12 no-border">

        <div class="tdetail-con tdetail-con1">
            <div class="message re-message">
                <h3 class="congratulations message-head">Congratulations!</h3>


                <p class="para-small for-para">You've successfully rescheduled the following transaction </p>

            </div>


            <div class="trans-header">


                <img class="shatayu-logo1" src="<?php echo base_url(); ?>assets/uploads/business_providers/logo/<?php echo $business_provider_details['details']->business_id; ?>/<?php echo $business_provider_details['details']->logo; ?>"/>


                <h3 class="vendor-head medium"><?php echo $business_provider_details['details']->name; ?> - <?php echo $business_provider_details['details']->area_name; ?></h3>



            </div>


            <!--            <div class="book-details1 book-details2">
                            <div class="trans-span7">
                                <p class="book-para">
                                    <label class="book-label">Treatment:</label>
                                    <span class="book-text"><?php echo $reschedule_details->services; ?></span>
                                </p>
            
            
                                <p class="book-para">
                                    <label class="book-label">Amount:</label>
                                    <span class="book-text">&#8377;<?php echo $reschedule_details->price; ?></span>
                                </p>
                            </div>
            
                        </div>-->

            <div class="book-details1">
                <div class="trans-span7">
                    <?php if ($reschedule_details->membership_type == 0) { ?>
                        <p class="book-para">
                            <label class="book-label">Transaction Id:</label>
                            <span class="book-text word_break_down"><?php echo $reschedule_details->transaction_id; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label">Treatment:</label>
                            <span class="book-text"><?php echo $reschedule_details->services; ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Date:</label>
                            <span class="book-text"> <?php echo date("l, F j, Y", strtotime($reschedule_details->date)); ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Time:</label>
                            <span class="book-text"><?php
                                $start_time = date('H:i', strtoTIME($reschedule_details->start_time));
                                if ($start_time >= 12) {
                                    $meridian = 'PM';
                                } else {
                                    $meridian = 'AM';
                                }echo date('h:i', strtoTIME($reschedule_details->start_time)) . ' ' . $meridian;
                                ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Duration:</label>
                            <span class="book-text"><?php
                                if ($reschedule_details->duration == 1) {
                                    $hr = 'hr';
                                } else {
                                    $hr = 'hrs';
                                }echo $reschedule_details->duration;
                                ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Amount:</label>
                            <span class="book-text amt">&#8377;<?php echo $reschedule_details->amount; ?></span>
                        </p>
                        <div class="clear"></div>
                        <p class="book-para">
                            <label class="book-label">Payment Mode:</label>
                            <span class="book-text"><?php echo $reschedule_details->payment_mode; ?></span>
                        </p>

                    <?php } else { ?>
                        <p class="book-para">
                            <label class="book-label">Transaction Id:</label>
                            <span class="book-text word_break_down"><?php echo $reschedule_details->transaction_id; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label">Treatment:</label>
                            <span class="book-text"><?php echo $reschedule_details->services; ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Membership:</label>
                            <span class="book-text"><?php echo $reschedule_details->membership; ?></span>
                        </p>


                        <p class="book-para">
                            <label class="book-label">Date:</label>
                            <span class="book-text"><?php echo date("l, F j, Y", strtotime($reschedule_details->membership_start_date)); ?></span>
                        </p>


                        <p class="book-para">
                            <label class="book-label">Duration:</label>
                            <span class="book-text"><?php echo $reschedule_details->duration; ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Amount:</label>
                            <span class="book-text amt">&#8377;<?php echo $reschedule_details->fees; ?></span>
                        </p>
                        <div class="clear"></div>
                        <p class="book-para">
                            <label class="book-label">Payment Mode:</label>
                            <span class="book-text"><?php echo $reschedule_details->payment_mode; ?></span>
                        </p>
                    <?php } ?>
                </div>


                <div class="trans-span71">
                    <p class="book-para">
                        <label class="book-label">Name:</label>
                        <span class="order-text green"><?php echo $user_details->name; ?></span>
                    </p>
                    <p class="book-para">
                        <label class="book-label">Phone:</label>
                        <span class="order-text green"><?php echo $user_details->phone; ?></span>
                    </p>
                    <p class="book-para">
                        <label class="book-label">Email:</label>
                        <span class="order-text green"><?php echo $user_details->username; ?></span>
                    </p>


                </div>



            </div>

            <div class="span12 span14 edit-hover">

                <h5 class="res-head res-head1 medium"><i class="fa fa-check"></i>1. Date: <?php echo date("l, F j, Y", strtotime($reschedule_details->date)); ?></h5>
                <a href="<?php echo base_url(); ?>reschedule_date/<?php echo $reschedule_details->booking_id; ?>" class="edit edit1">Edit</a>

            </div>


            <div class="span12 span14 edit-hover">


                <h5 class="res-head res-head1 medium"><i class="fa fa-check"></i>2. Time: <?php
                    $start_time = date('H:i', strtoTIME($reschedule_details->start_time));
                    if ($start_time >= 12) {
                        $meridian = 'PM';
                    } else {
                        $meridian = 'AM';
                    }echo date('h:i', strtoTIME($reschedule_details->start_time)) . ' ' . $meridian;
                    ?></h5>
                <a href="<?php echo base_url(); ?>reschedule_time/<?php echo $reschedule_details->booking_id; ?>" class="edit edit1">Edit</a>


            </div>


        </div>

    </div>


</div>

