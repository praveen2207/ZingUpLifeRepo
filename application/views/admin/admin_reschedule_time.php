<div class="location-header admin-header">

    <h3 class="redirect-head admin-head">Reschedule Order - Change Time</h3>

</div>

<div class="row-fluid order-row">
    <?php if (isset($reschedule_message)) { ?>
        <div class="message">
            <h3 class="congratulations message-head">Oops, something went wrong !!!.</h3>
            <p class="para-small for-para"><?php echo $reschedule_message; ?></p>

        </div> 
    <?php } ?>

    <div class="user-order-con">

        <span class="order-admin-id" href="">ID: <?php echo $reschedule_details['transactions']->transaction_id; ?></span>

    </div>

    <div class="user-order">

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

        <span class="confirm-message">

            <?php if ($reschedule_details['transactions']->booking_status == 'Success') { ?><i class="fa fa-check green c-check"></i>Confirmed<?php } else { ?>Not Confirmed <?php } ?>

        </span>

    </div>

    <div class="order-history">

        <div class="panel panel-warning">

            <div id="accordionThree" class="panel-collapse">

                <!-- panel body -->

                <div class="no-border">

                    <div class="order-box order-box2">

                        <h4 class="medium history">Treatment</h4>

                        <p class="box-para">

                            <label class="book-label table-label">Name:</label>

                            <span class="order-text table-text"><?php echo $reschedule_details['transactions']->services; ?></span>

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

                    <div class="order-box order-box1 order-box2">

                        <h4 class="medium history">Vendor</h4>

                        <p class="box-para">

                            <label class="book-label table-label">Name:</label>

                            <span class="order-text table-text">

                                <a href="" class="blue vendor-text"><?php echo $reschedule_details['vendor_details']->name; ?></a>

                            </span>

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

                            <span class="order-text table-text">

                                <a href="mailto:" class="blue vendor-text"><?php echo $reschedule_details['vendor_details']->email; ?></a>

                            </span>

                        </p>

                    </div>

                    <div class="order-box order-box1 order-box2">

                        <h4 class="medium history">Customer</h4>

                        <p class="box-para">

                            <label class="book-label table-label">Customer ID:</label>

                            <span class="order-text table-text"><?php echo $reschedule_details['user_details']->id; ?></span>

                        </p>

                        <p class="book-para">

                            <label class="book-label table-label">Name:</label>

                            <span class="order-text table-text">

                                <a href="" class="blue vendor-text"><?php echo $reschedule_details['user_details']->name; ?></a>

                            </span>

                        </p>

                        <p class="book-para">

                            <label class="book-label table-label">Phone No.:</label>

                            <span class="order-text table-text"><?php echo $reschedule_details['user_details']->phone; ?></span>

                        </p>

                        <p class="book-para">

                            <label class="book-label table-label">Email ID:</label>

                            <span class="order-text table-text">

                                <a href="" class="blue vendor-text"><?php echo $reschedule_details['user_details']->username; ?></a>

                            </span>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <div class="span12 span13">

        <h5 class="res-head medium table-head1">

            <i class="fa fa-check"></i>1. Date: <?php echo date("l,F j, Y", strtotime($reschedule_details['transactions']->date)); ?>

        </h5>

    </div>



    <div class="span12 span13 no-border">


        <h5 class="reg-head medium table-head1"><i class="fa fa-check"></i>2. Time: <?php
            $start_time = date('H:i', strtoTIME($reschedule_details['transactions']->start_time));
            if ($start_time >= 12) {
                $meridian = 'PM';
            } else {
                $meridian = 'AM';
            }echo $start_time, ' ' . $meridian;
            ?></h5>

    </div>

    <div class="span12 span18 no-border">


        <h5 class="res-head medium table-head table-head2">Change Time</h5>

        <form method="post" action="<?php echo base_url(); ?>admin/confirm_reschedule_time">

            <div class="select-time1 select-time2">


                <select name="reschedule_time" class="sel-time">
                    <option value="">Please Select</option>
                    <?php foreach ($business_services_slots as $key => $value) { ?>
                        <option value="<?php echo $value->id . '/' . date('H:i', strtotime($value->start_time)) . '-' . date('H:i', strtotime($value->end_time)); ?>"><?php echo date('H:i', strtotime($value->start_time)) . '-' . date('H:i', strtotime($value->end_time)); ?></option>
                    <?php } ?>

                </select>

                <input type="hidden" value ="<?php echo $reschedule_details['transactions']->date; ?>" name="booking_date">
                <input type="hidden" value ="<?php echo $reschedule_details['transactions']->booking_id; ?>" name="booking_id">
            </div>

            <div class="control-group admin-button-group1"> 


                <label class="control-label" for="check1"></label>  		  

                <div class="controls">

                    <input type="submit" name="submit" id="submit" value="Continue" class="primary-button"/>

                    <input type="submit" name="submit" value="Cancel" class="secondary-button cancel"/>

                </div> 

            </div>

        </form>

    </div>


</div>