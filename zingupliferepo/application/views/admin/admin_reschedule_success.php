<div class="location-header admin-header">

    <h3 class="redirect-head admin-head">Reschedule Order</h3>

</div>

<div class="row-fluid order-row">

    <div class="message tb-message">


        <h3 class="congratulations message-head">Congratulations!</h3>

        <a class="blue download">Download 
<!--            <i class="fa fa-angle-down"></i>-->
        </a>

        <p class="para-small for-para">You've successfully rescheduled the following transaction </p>

    </div>

    <div class="user-order no-border user-order1">



        <span class="order-admin-id" href="">ID: <?php echo $reschedule_details['transactions']->transaction_id; ?></span>

        <span class="confirm-message"><?php if ($reschedule_details['transactions']->booking_status == 'Success') { ?><i class="fa fa-check green c-check"></i>Confirmed<?php } else { ?>Not Confirmed <?php } ?></span>



    </div>

    <div class="user-order user-order1">
        <div class="order-inner">
            <p class="order-para">
                <label class="order-label">Date of Booking: </label>
                <span class="order-user-text">&nbsp;<?php echo date('d/m/Y', strtotime($reschedule_details['transactions']->booking_date)); ?></span>
            </p>

            <p class="order-para">
                <label class="order-label">Time of Booking: </label>
                <span class="order-user-text">&nbsp;<?php
                    $booking_timing = date('H:i', strtotime($reschedule_details['transactions']->booking_date));
                    if ($booking_timing >= 12) {
                        $meridian = 'PM';
                    } else {
                        $meridian = 'AM';
                    }
                    echo $booking_timing, ' ' . $meridian;
                    ?></span>
            </p>
        </div>


    </div>

    <div class="order-history">
        <div class="panel panel-warning">  

            <div class="panel-heading">
                <h3 class="panel-title"> 
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordionThree" class="history medium">
                        History
                        <i class="fa fa-angle-down title-arrow"></i>
                    </a>
                </h3>
            </div>

            <div id="accordionThree" class="panel-collapse collapse">
                <!-- panel body -->
                <div class="panel-body">
                    <div class="order-box">
                        <h4 class="medium history">Treatment</h4>
                        <p class="box-para">
                            <label class="book-label table-label">Name:</label>
                            <span class="order-text table-text"><?php echo $reschedule_details['transactions']->services; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Date:</label>
                            <span class="order-text table-text"><?php echo $reschedule_details['transactions']->date; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Time:</label>
                            <span class="order-text table-text"><?php
                                $start_time = date('H:i', strtoTIME($reschedule_details['transactions']->start_time));
                                if ($start_time >= 12) {
                                    $meridian = 'PM';
                                } else {
                                    $meridian = 'AM';
                                }echo $start_time, ' ' . $meridian;
                                ?><span class="hours">
                                <?php
                                $current_time = strtotime(date('Y-m-d h:i'));
                                $slot_time = strtotime($reschedule_details['transactions']->date . '' . date("g:i", strtotime($reschedule_details['transactions']->start_time)));
                                $time_difference = abs($slot_time - $current_time);
                                $time = floor($time_difference / 3600);
                                if ($slot_time > $current_time && $reschedule_details['mark_attend']->status != 'Attended') {
                                    echo $time;
                                    ?> Hrs left <?php
                                    }
                                    ?>
                                </span></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Duration:</label>
                            <span class="order-text table-text"><?php
                                if ($reschedule_details['transactions']->duration > 1) {
                                    $hour = 'hours';
                                } else {
                                    $hour = 'hour';
                                }
                                echo $reschedule_details['transactions']->duration;
                                ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Amount:</label>
                            <span class="order-text table-text">&#x20B9;<?php echo $reschedule_details['transactions']->amount; ?></span>
                        </p>

                    </div>


                    <div class="order-box order-box1">
                        <h4 class="medium history">Vendor</h4>
                        <p class="box-para">
                            <label class="book-label table-label">Name:</label>
                            <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $reschedule_details['vendor_details']->name; ?></a></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Location:</label>
                            <span class="order-text table-text"><?php echo $reschedule_details['vendor_details']->area_name; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Phone No.:</label>
                            <span class="order-text table-text"><?php echo $reschedule_details['vendor_details']->phone; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Email ID:</label>
                            <span class="order-text table-text"><a href="mailto:" class="blue vendor-text"><?php echo $reschedule_details['vendor_details']->email; ?></a></span>
                        </p>


                    </div>



                    <div class="order-box order-box1">
                        <h4 class="medium history">Customer</h4>
                        <p class="box-para">
                            <label class="book-label table-label">Customer ID:</label>
                            <span class="order-text table-text"><?php echo $reschedule_details['user_details']->id; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Name:</label>
                            <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $reschedule_details['user_details']->name; ?></a></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Phone No.:</label>
                            <span class="order-text table-text"><?php echo $reschedule_details['user_details']->phone; ?></span>
                        </p>
                        <p class="book-para">
                            <label class="book-label table-label">Email ID:</label>
                            <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $reschedule_details['user_details']->username; ?></a></span>
                        </p>

                    </div> 
                </div>

            </div>

        </div>
    </div>


    <?php $current_time = date('y-m-d'); if(strtotime($reschedule_details['transactions']->date) > strtotime($current_time)){ ?><a class="sign-link sign-now-link" href="<?php echo base_url(); ?>admin/reschedule_order/<?php echo $reschedule_details['transactions']->booking_id; ?>"><i class="fa fa-angle-right sign-arrow"></i> Re-schedule this order</a>
<?php }else { ?> <i class="sign-link sign-now-link">Not Attended</i> <?php }?>



</div>