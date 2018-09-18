<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
<div class="location-header">
    <img class="shatayu-logo" src="<?php echo $logo_path . $business_provider_details['details']->id . '/' . $business_provider_details['details']->logo; ?>"/>
    <h3 class="vendor-head"><?php echo $business_provider_details['details']->name . '- ' . $business_provider_details['details']->area_name; ?></h3>
</div>
<div class="location-header book-success-header">
    <h3 class="redirect-head con-head">Oops!!!, something went wrong, your booking not completed due to wrong entries.</h3>
    <span class="c-span">You was trying to book <?php echo $get_offering_service_details['details']->services;?> Programme.</span>
</div>

<div class="row-fluid register-row">
    <div class="span12 no-border">
        <div class="book-details">
            <p class="book-para">
                Location: <?php echo $business_provider_details['details']->area_name;?>
            </p>
            <p class="book-para">
                Date: <?php echo $choosed_booking_date;?>
            </p>
            <p class="book-para">
                Membership: <?php echo $membership_details->membership; ?>
            </p>
            <p class="book-para">
                Cost:<i class="post_booking_cost"> &#8377;<?php echo $membership_details->fees; ?></i>
            </p>
            <p class="book-para">
                Duration: <?php echo $membership_details->duration; ?>
            </p>
        </div>

        <div class="book-details">
            <span class="green medium">What happens next?</span>
            <p class="book-para1">
                You would receive a confirmation SMS Turn up at location with your phone
            </p>
        </div>

        <div class="book-details">
            <span class="green medium">What would you like to do next?</span>
            <p class="book-para1">
                <a href="" class="blue">> View Ayurvedic treatment offers in Koramangala.</a>
            </p>
        </div>
    </div>
</div>
</div>