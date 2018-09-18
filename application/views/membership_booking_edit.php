<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Checkout</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="checkout-content">
                            <div class="top-checkout">
                                <div class="row">
                                    <div class="col-xs-7">
                                        <ul class="left-checkout row">
                                            <li class="col-xs-4"><span class="c-pay-icon">Pay securely</span></li>
                                            <li class="col-xs-4"><span class="c-cate-icon">or pay at venue</span></li>
                                            <li class="col-xs-4"><span class="c-free-icon">Cancel free of charge</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="checkout-help">
                                            If you have any questions please give us a call <br />at <span>080 4951 5364</span> Mon-Fri from 10.00 till 15.00
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-box">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="checkout-box-inner">
                                            <h3>1. Your Treatment</h3>
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
                                    <div class="col-xs-4">
                                        <div class="checkout-box-inner">
                                            <h3>2. Your details</h3>
                                            <div class="form-pad treatment-form">
<!--                                                <p class="login-link">Do you have an account? <a href="<?php echo base_url(); ?>signin">login</a> </p>-->
                                                <form class="" name="register" id="register" method="post" action="<?php echo base_url(); ?>membership_payment">  
                                                    <label>Name* </label>
                                                    <input type="text" placeholder="Your first name" value='<?php echo $logged_in_user_details->name; ?>' readonly>
                                                    <label>E-mail address* </label>
                                                    <input type="text" placeholder="Your e-mail address" value='<?php echo $logged_in_user_details->username; ?>' readonly>
                                                    <label>Phone number* </label>
                                                    <input type="text" placeholder="Your phone number" value='<?php echo $logged_in_user_details->phone; ?>' readonly>
                                                    <label>Comments </label>
                                                    <textarea name="comments"></textarea>
                                                    <div class="term-check">
                                                        <input id="checkbox3" type="checkbox" name="checkbox3">
                                                        <label for="checkbox3">Yes, please send more information (via email or text message) about products and services offered by Zinguplife.com . </label>
                                                    </div>
                                                    <p>*These fields are mandatory </p>


                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkout-box-inner">
                                            <h3>3. Payment</h3>
                                            <div class="form-pad treatment-form">   
                                                <input type="hidden" name="total_price" value="<?php echo $total_price_to_be_paid; ?>"/>                                                
                                               <!--                                                <form class="" name="register" id="register" method="post" action="<?php echo base_url(); ?>membership_payment">  -->
                                                <!--                                                    <label>Coupon </label>
                                                                                                    <input type="text" placeholder="Your-code-here">                                         
                                                                                                    <p class="small-txt">* Coupon codes only apply to online payments</p>-->
                                                <p><strong>Are you already a customer of this salon?</strong> </p>
                                                <div class="row top-radio">
                                                    <div class="col-xs-6">
                                                        <input id="checkbox4" type="radio" name="checkbox4">
                                                        <label for="checkbox4">Yes</label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input id="checkbox5" type="radio" name="checkbox4">
                                                        <label for="checkbox5">No</label>
                                                    </div>
                                                </div>
                                                <p><strong>Select a payment method </strong> </p>
                                                <div class="row top-radio">
                                                    <div class="col-xs-6">
                                                        <input id="checkbox6" type="radio" name="payment_mode" value='Pay at venue'/>
                                                        <label for="checkbox6"> Pay at venue </label>
                                                    </div>
<?php if ($business_provider_details['details']->payment_option == 'Online') { ?>
                                                        <div class="col-xs-6">
                                                            <input id="checkbox7" type="radio" name="payment_mode"  value='Pay online'/>
                                                            <label for="checkbox7">Pay online</label>
                                                        </div>
<?php } ?>
                                                    <!--                                                        
                                                                                                            <div class="col-xs-6">
                                                                                                                <input id="checkbox7" type="radio" name="payment_mode"  value='Pay online'/>
                                                                                                                <label for="checkbox7">Pay online</label>
                                                                                                            </div>-->
                                                </div>
                                                <p class="small-txt">By clicking on completion, you agree to our terms and conditions and the privacy policy of  Zinguplife.com </p>
                                                <div class="center">
                                                    <input type="submit" name="submit"  value='Finalize' class='button'/>
                                                    <!--                                                         <a href="#" class="button">Finalize</a>-->
                                                </div>
                                                </form>


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
</div>