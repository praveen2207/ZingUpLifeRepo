<div class="container">
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
            <div class="span12 span14 edit-hover">

                <h5 class="res-head res-head1 medium"><i class="fa fa-check"></i>1. Date: <?php echo date("l,F j, Y", strtotime($reschedule_details->membership_start_date)); ?></h5>
                <a href="<?php echo base_url(); ?>reschedule_membership_date/<?php echo $reschedule_details->booking_id; ?>" class="primary-small re-edit">Edit Date</a>

            </div>


            <div class="span12 span14 edit-hover">
                <h5 class="res-head res-head1 medium"><i class="fa fa-check"></i>2. Duration: <?php echo $reschedule_details->duration; ?></h5>
            </div>

        </div>

    </div>


</div>
</div>
