<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>search"><span class="colorGreen">Services & Providers&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>"><span  class="colorGreen"><?php echo $business_provider_details['details']->name; ?>&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <?php
        if (isset($membership_plan_id) && $membership_plan_id != '') {
            $url = 'memberships_offering/';
        } else {
            $url = 'offering_details/';
        }
        ?>
        <a href="<?php echo base_url(); ?><?php echo $url . $get_offering_service_details['details']->service_id; ?>">
            <span class="colorGreen"><?php echo $get_offering_service_details['details']->services; ?></span>
        </a>
        <span  class="colorGrey">&nbsp;// Booking Success&nbsp;</span>
    </div>
    <div class="bookSucesscard">
        <h4 class="bookHeading">BOOKING SUCCESS</h4>
        <div class="successConent">
            <h4>Your booking has been done successfully!</h4>
            <p>Your transaction ID is <span class="colorGreen"><?php echo $transaction_id; ?>.</span></p>
            <p>When you visit the merchant's outlet, please quote this booking reference number.</p>
            <p>Alternatively you can show the booking confirmation email or sms.</p>
        </div>
    </div>
    <div class="bookSucesscard mg30">
        <h4 class="bookHeading">ENJOY YOUR TREAT!</h4>
        <div class="row enjoyCard">
            <div class="col-md-6">
                <div class="thumbnail">
                    <?php if ($get_offering_service_details['gallery'][0]->images != '') { ?>
                        <img class="suceess_checkout_image" src="<?php echo $service_image_path . $get_offering_service_details['gallery'][0]->service_id . '/' . $get_offering_service_details['gallery'][0]->images; ?>">
                    <?php } else { ?>
                        <img class="suceess_checkout_image" src="<?php echo base_url(); ?>assets/new_design/image/gallery_placeholder.jpg" alt="...">
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6 detailCard payment_success_info">
                <h4 class="colorGreen detailHeading"><?php echo $business_provider_details['details']->name; ?></h4>
                <span class="subHeading">
                    <?php
                    if (!empty($membership_details) && $membership_plan_id != '') {
                        echo $membership_details->membership;
                    } else {
                        echo $get_offering_service_details['details']->services;
                    }
                    ?>
                </span>
                <ul>
                    <?php
                    if (!empty($membership_details) && $membership_plan_id != '') {
                        $price = $membership_details->fees;
                        $duration = $membership_details->duration;
                    } else {
                        $price = $get_offering_service_details['details']->price;
                        $duration = $get_offering_service_details['details']->duration;
                    }
                    ?>
                    <li><span class="rsText">RS.&nbsp; <?php echo $price; ?></span></li>
                    <li><span class="minsText"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $duration; ?> </span></li>
                    <li>
                        <span class="mapSmall"></span>
                        <span class="colorGreen"><?php echo $business_provider_details['details']->area_name; ?></span>
                    </li>
                </ul>
                <span class="subHeading">Practitioner. Jena</span>
                <?php
                //$price = $get_offering_service_details['details']->price;
                $discount = $get_offering_service_details['details']->discount;

                $check = strrchr($discount, '%');
                if ($check != '') {
                    $discount_value = ($price * $discount) / 100;
                } else {
                    $discount_value = $discount;
                }
                ?>
                <table class="tablePayment">
                    <thead>
                        <tr>
                            <th><span class="rsText"><?php echo date('l, d.m.Y', strtotime($payment_data['date'])); ?></span></th>
                            <?php if (empty($membership_details) && $membership_plan_id == '') { ?>
                                <th><span class="rsText">Starting: <?php echo date('H:i a', strtotime($slot_details->start_time)); ?></span></th>
                            <?php } else { ?>
                                <th><span class="rsText"></span></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($membership_details) && $membership_plan_id != '') {
                            $price = $membership_details->fees;
                        } else {
                            $price = $get_offering_service_details['details']->price;
                        }
                        ?>
                        <tr>
                            <td><span>Costs</span></td>
                            <td><span class = "rsText">RS.&nbsp;
                                    <span class="price-number"><?php echo $price;
                        ?></span></span></td>
                        </tr>
                        <?php if ($discount) { ?>
                            <tr>
                                <td><span>Discount(-)</span></td>
                                <td><span class="rsText">RS.&nbsp; <span class="price-number"><?php echo $discount_value; ?></span></span></td>
                            </tr>
                            <?php
                        }
                       
                        $total_price_to_be_paid = ($price - $discount_value) + $tax;
                        ?>
                        <tr>
                            <td><span>Tax(+)</span></td>
                            <td><span class="rsText">RS.&nbsp; <span class="price-number"><?php echo $tax; ?></span></span></td>
                        </tr>
                        <tr>
                            <td><span>Total Paid</span></td>
                            <td><span class="rsText">RS.&nbsp; <span class="price-number"><?php echo $total_price_to_be_paid; ?></span></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>