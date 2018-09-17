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
            <div class="hour">
                <?php if ($get_offering_service_details['details']->duration != '' && $get_offering_service_details['details']->duration != '-') { ?>
                    <i class="fa fa-clock-o"></i><h5 class="hour-t"><?php
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
        $slot_message = $this->session->flashdata('slot_message');
        if (isset($slot_message)) {
            ?>
            <div class="location-header book-success-header">
                <h3 class="redirect-head con-head">Oops, something went wrong.</h3>
                <span class="c-span">No slots available for selected date.</span>
            </div>
        <?php } ?>
        <?php
        $slot_error_message = $this->session->flashdata('slot_error_message');
        if (isset($slot_error_message)) {
            ?>
            <div class="location-header book-success-header">
                <h3 class="redirect-head con-head">Oops, something went wrong.</h3>
                <span class="c-span"><?php echo $slot_error_message; ?></span>
            </div>
        <?php } ?>
        <div class="span12 full-page">

            <div class="col-xs-9">
                <h5 class="reg-head medium">1. Select Date</h5>
                <div class="booking-calendar">
                    <div id="inlineDatepicker" data-deselect="<?php echo $available_dates; ?>"></div>
                </div>
                <div class="control-group button-group book-group"> 
                    <label class="control-label" for="check1"></label>  		  


                    <div class="controls">
                        <form method="post" action="<?php echo base_url(); ?>chooseBookingTime">
                            <input type="hidden" name="booking_date" value="<?php echo date('Y-m-d'); ?>" id="booking_date"/>
                            <input type="submit" name="submit" id="submit" value="Continue" class="primary-button"/>
                            <input type="submit" name="submit" value="Cancel" class="secondary-button cancel"/>
                        </form>
                    </div> 
                </div>
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
        <div class="span12">
            <h5 class="reg-head medium">2. Select Time</h5>
        </div>
        <div class="span12 no-border">
            <h5 class="reg-head medium">3. Sign In</h5>
        </div>
    </div>
</div>



