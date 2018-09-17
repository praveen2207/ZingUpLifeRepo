<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Booking Success</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="checkout-content payment-confirmed">

                            <div class="checkout-box">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="checkout-box-inner">
                                            <h3>Enjoy your treat</h3>
                                            <?php if (!empty($get_offering_service_details['gallery'])) { ?> 
                                                <a href="#"><img src="<?php echo $service_image_path . $get_offering_service_details['gallery'][0]->service_id . '/' . $get_offering_service_details['gallery'][0]->images; ?>" alt="" /></a>
                                            <?php } ?>
                                            <div class="treatment-details">
                                                <h2><?php echo $business_provider_details['details']->name; ?></h2>
                                                <ul class="list-content-list">
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-6 left"> 
                                                                <a href="#"><?php echo $get_offering_service_details['details']->services; ?> 
                                                                    <span class="minutes">
                                                                        <i class="fa fa-clock-o"></i> 
                                                                        <?php
//                                                                        if ($get_offering_service_details['details']->duration == 1) {
//                                                                            $hr = 'hr';
//                                                                        } else {
//                                                                            $hr = 'hrs';
//                                                                        }echo $get_offering_service_details['details']->duration;
                                                                        echo $membership_details->duration;
                                                                        ?>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div class="col-xs-6 right">&#8377; <?php echo $membership_details->fees; ?></div>
                                                        </div>
                                                    </li>                                                    
                                                </ul>
                                                <div class="row">
                                                    <div class="col-xs-12"> 
                                                        <div class="date-time-inner">                                                        
                                                            <span>Membership</span>
                                                            <?php echo $membership_details->membership; ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <p>Practitioner: Jana </p>
                                                <div class="date-time">
                                                    <ul >
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-12"> 
                                                                    <div class="date-time-inner">                                                        
                                                                        <span>Membership Starting Date</span>
                                                                        <?php echo date("d.m.Y", strtotime($choosed_booking_date)); ?>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </li>                                                    
                                                    </ul>
                                                </div>
                                                <ul class="treatment-details-list">
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-6 left"> 
                                                                <a href="#">Costs</a>
                                                            </div>
                                                            <div class="col-xs-6 right">&#8377; <?php echo $membership_details->fees; ?></div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $price = $membership_details->fees;
                                                    if ($discount) {
                                                        ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-6 left"> 
                                                                    <a href="#">Discount (<?php echo $get_offering_service_details['details']->discount; ?>)</a>
                                                                </div>
                                                                <?php
                                                                $discount = $get_offering_service_details['details']->discount;

                                                                $check = strrchr($discount, '%');
                                                                if ($check != '') {
                                                                    $discount_value = ($price * $discount) / 100;
                                                                } else {
                                                                    $discount_value = $discount;
                                                                }
                                                                ?>
                                                                <div class="col-xs-6 right">&#8377; <?php echo $discount_value; ?></div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    $total_price_to_be_paid = $price - $discount_value;
                                                    ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-6 left"> 
                                                                <a href="#">Coupon</a>
                                                            </div>
                                                            <div class="col-xs-6 right">&#8377; 0.00</div>
                                                        </div>
                                                    </li>

                                                </ul>
                                                <ul class="treatment-details-list total">
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-6 left"> 
                                                                <a href="#">To be paid </a>
                                                            </div>
                                                            <div class="col-xs-6 right">&#8377; <?php echo $total_price_to_be_paid; ?></div>
                                                        </div>
                                                    </li>                                              
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="payment-confirmed-meaasge center">
                                            <h2>Your booking has been done successfully !!!<br/>
                                                (your transaction is <?php echo $transaction_id; ?>).<br/>
                                                When you visit to the merchant's outlet to please quote this booking reference number alternatively you can show the booking confirmation email or  SMS.
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
