<div class="location-header redirect-header">
    <h3 class="redirect-head">Reschedule</h3>
</div>

<div class="row-fluid notify">
    <div class="span12 no-border">

        <div class="tdetail-con tdetail-con1">
            <div class="trans-header">


                <img class="shatayu-logo1" src="<?php echo base_url(); ?>assets/uploads/business_providers/logo/<?php echo $business_provider_details['details']->business_id; ?>/<?php echo $business_provider_details['details']->logo; ?>"/>

                <h3 class="vendor-head medium"><?php echo $business_provider_details['details']->name; ?> - <?php echo $business_provider_details['details']->area_name; ?></h3>
            </div>


            <div class="book-details1 book-details2">

                <div class="trans-span7">
                    <p class="book-para">
                        <label class="book-label">Membership:</label>
                        <span class="book-text"><?php echo $reschedule_details->membership; ?></span>
                    </p>
                    <p class="book-para">
                        <label class="book-label">Amount:</label>
                        <span class="book-text">&#8377;<?php echo $reschedule_details->fees; ?></span>
                    </p>
                </div>

            </div>
            <div class="span12 span14">
                <h5 class="res-head res-head1 medium">Current Date: <?php echo date("l,F j, Y", strtotime($reschedule_details->membership_start_date)); ?></h5>
            </div>
            <div class="span12 span13">
                <h5 class="reg-head medium">1. Select Date</h5>
                <div class="booking-calendar">
                    <div id="inlineDatepicker" data-deselect=""></div>
                </div>
                <div class="control-group button-group book-group"> 
                    <label class="control-label" for="check1"></label>  		  


                    <div class="controls">
                        <form method="post" action="<?php echo base_url(); ?>membership_rescheduling_success">
                            <input type="hidden" name="booking_date" value="<?php echo date('Y-m-d'); ?>" id="booking_date"/>
                            <input type="hidden" name="booking_id" value="<?php echo $reschedule_details->booking_id; ?>" id=""/>
                            <input type="hidden" name="membership_id" value="<?php echo $reschedule_details->membership_id; ?>" id=""/>
                            <input type="hidden" name="user_membership_id" value="<?php echo $reschedule_details->user_membership_id; ?>" id=""/>
                            <input type="submit" name="submit" id="submit" value="Continue" class="primary-button"/>
                            <input type="submit" name="submit" value="Cancel" class="secondary-button cancel"/>
                        </form>
                    </div> 
                </div>
            </div>

            <div class="span12 span13">
                <h5 class="res-head medium"><i class="fa fa-check"></i>2. Duration: <?php echo $reschedule_details->duration; ?></h5>
            </div>
            <div class="book-reschedule">
                <p class="book-para">
                    <label class="book-label1">Or Contact customer support to reschedule: </label>
                    <span class="book-text1 green">080 4951 5364</span>
                </p>
            </div>
        </div>
    </div>
</div>
