<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
<div class="location-header">
    <img class="shatayu-logo" src="<?php echo base_url(); ?>assets/uploads/business_providers/logo/<?php echo $business_provider_details['details']->business_id; ?>/<?php echo $business_provider_details['details']->logo; ?>"/>
    <h3 class="vendor-head"><?php echo $business_provider_details['details']->name . '- ' . $business_provider_details['details']->area_name; ?></h3>
</div>
<div class="location-header book-success-header">
    <h3 class="redirect-head con-head">Oops! something went wrong, your booking not completed due to erroneous entries.</h3>
    <span class="c-span">You were trying to book <?php echo $get_offering_service_details['details']->services;?> Programme.</span>
</div>

<div class="row-fluid register-row">
    <div class="span12">
        <div class="book-details">
            <p class="book-para">
                Location: <?php echo $business_provider_details['details']->area_name;?>
            </p>
            <p class="book-para">
                Date: <?php echo $choosed_booking_date;?>
            </p>
            <p class="book-para">
                Time: <?php if ($choosed_booking_time >= 12) {
                $meridian = 'PM';
            } else {
                $meridian = 'AM';
            }echo date('h:i', strtotime($choosed_booking_time)).' ' . $meridian;
            ?>
            </p>
            <p class="book-para">
                Cost:<i class="fa fa-inr post_booking_cost"><?php echo $get_offering_service_details['details']->price;?></i>
            </p>
        </div>

        <div class="book-details">
            <span class="green medium">What happens next?</span>
            <p class="book-para1">
                You can try booking again or contact our customer support to help you with this.
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