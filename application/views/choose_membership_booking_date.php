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

    </div>
    <div class="category1">
        <h3 class="book-category">You're booking <strong><?php echo $membership_details->membership; ?> membership</strong></h3>
        <div class="time-icons">
            <div class="hour">
                <?php if ($membership_details->duration != '' && $membership_details->duration != '-') { ?>
                    <i class="fa fa-clock-o"></i>
                    <h5 class="hour-t"><?php echo $membership_details->duration; ?>
                    </h5>
                <?php } ?>
            </div>
            <div class="amt">
                <?php if ($membership_details->fees != '' && $membership_details->fees != '-') { ?>
                    <i class="fa fa-inr"></i>
                    <h5 class="hour-t"><?php echo $membership_details->fees; ?>
                    </h5>
                <?php } ?>
            </div>
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
        <?php //} ?>
        <?php
        $slot_message = $this->session->flashdata('slot_message');
        if (isset($slot_message)) {
            ?>
            <div class="location-header book-success-header">
                <h3 class="redirect-head con-head">Oops, something went wrong.</h3>
                <span class="c-span">No slots available for selected date.</span>
            </div>
        <?php } ?>
        <div class="span12">
            <div class="col-xs-9">
                <h5 class="reg-head medium">1. Select Date</h5>
                <div class="booking-calendar">
                    <div id="inlineDatepicker" data-deselect=""></div>
                </div>
                <div class="control-group button-group book-group"> 
                    <label class="control-label" for="check1"></label>  		  


                    <div class="controls">
                        <form method="post" action="<?php echo base_url(); ?>membershipSignup">
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

        <div class="span12 no-border">
            <h5 class="reg-head medium">2. Sign In</h5>
        </div>
    </div>

</div>


<!--<script>
    jQuery('.mclick').click(function () {
        alert("js");
        if (jQuery('.cat-names').css('display','none') {
            jQuery('.cat-names').show();
        }
    });
</script>-->
