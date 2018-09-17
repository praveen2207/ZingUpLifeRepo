<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <?php if (!empty($business_provider_details['details'])) { ?>
        <div class="location-header">
            <a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>">
                <img class="shatayu-logo" src="<?php
                if (isset($business_provider_details)) {
                    if ($business_provider_details['details']->logo != '') {
                        echo $logo_path . $business_provider_details['details']->business_id . '/' . $business_provider_details['details']->logo;
                    } else {
                        echo base_url() . 'assets/images/coming-soon-new.png';
                    }
                } else {
                    echo base_url() . 'assets/images/coming-soon.png';
                }
                ?>"/>
            </a>

            <h3 class="vendor-head"><a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>"><?php
                    if (isset($business_provider_details)) {
                        echo $business_provider_details['details']->name . '-' . $business_provider_details['details']->area_name;
                    }
                    ?></a></h3>
        </div>
    <?php } ?>

    <div class="category1">
        <h3 class="book-category">You're booking <strong><?php echo $get_offering_service_details['details']->services; ?></strong></h3>
        <div class="time-icons">
            <?php if ($get_offering_service_details['details']->duration != '' && $get_offering_service_details['details']->duration != '-') { ?>
                <div class="hour"><i class="fa fa-clock-o"></i><h5 class="hour-t"><?php
                        if ($get_offering_service_details['details']->duration == 1) {
                            $hr = 'hr';
                        } else {
                            $hr = 'hrs';
                        }echo $get_offering_service_details['details']->duration;
                        ?></h5>
                <?php } ?>
            </div>
            <?php if ($get_offering_service_details['details']->price != '' && $get_offering_service_details['details']->price != '-') { ?>
                <div class="amt"><i class="fa fa-inr"></i><h5 class="hour-t"><?php echo $get_offering_service_details['details']->price; ?></h5></div>
            <?php } ?>
        </div>
    </div>

    <div class="row-fluid register-row">
        <?php
//        if ($booking_time_duration_length != '') {
//            
        ?>
        <!--            <div class="timer">
                        <span class="timer-icon"></span><p class="timer-p">Please complete your booking within next <span class="green time">
                                <input type='text' id="timer" name='timer' class='form-control current_timer_value' placeholder='10:00' /></span></p>
                    </div>-->
        <?php // }  ?>

        <div class="span12 edit-hover">
            <h5 class="reg-head medium"><i class="fa fa-check"></i>1. Date: <?php echo date("l, F j, Y", strtotime($choosed_booking_date)); ?></h5>
            <a href="<?php echo base_url(); ?>chooseBookingDate" class="edit">Edit</a>
        </div>

        <div class="span12">
            <div class="col-xs-9">
                <form method="post" action="<?php echo base_url(); ?>signup" id="register">
                    <h5 class="reg-head medium">2. Select Time</h5>
                    <div class="select-time">
                        <select name="booking_time" class="sel-time required">
                            <option value="">Please Select</option>
                            <?php foreach ($business_services_slots as $key => $value) { ?>
                                <option value="<?php echo $value->id . '/' . date('H:i', strtotime($value->start_time)); ?>"><?php echo date('h:i A', strtotime($value->start_time)); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="control-group book-group time-group"> 
                        <label class="control-label" for="check1"></label>  		  
                        <div class="controls">

                            <input type="submit" name="submit" id="submit" value="Continue" class="primary-button"/>
                            <input type="submit" name="submit" value="Cancel" class="secondary-button cancel"/>

                        </div> 
                    </div>
                </form>
            </div>
            <div class="col-xs-3">
                <?php
                if ($booking_time_duration_length != '') {
                    ?>
                    <div class="booking-timer-inner" id="timerr">
                        Please complete your booking within next
                        <div class="timer" id="">
                            <input type='text' id="timer" name='timer' class='form-control current_timer_value' placeholder='10:00' />
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="span12 selected">
            <h5 class="reg-head medium">3. Sign In</h5>
        </div>
    </div>
</div>
