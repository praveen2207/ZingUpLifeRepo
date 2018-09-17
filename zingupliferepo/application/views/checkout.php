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
        <span  class="colorGrey">&nbsp;// Booking&nbsp;</span>
    </div>
    <form  method="post" action="<?php echo base_url(); ?>payment" class="form-inline">  
        <div class="bookingBox">
            <div class="dateTime">
                <h3>BOOKING</h3>

                <div class="row">
                    <?php
                    $payment_mode_erros = $this->session->flashdata('payment_mode_erros');
                    if (isset($payment_mode_erros)) {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Booking Failed!</span>  <?php echo $payment_mode_erros; ?>
                        </div>
                    <?php } ?>
                    <div class="col-xs-12 col-sm-6 col-md-6">

                        <div class="date">
                            <?php if (isset($membership_plan_id) && $membership_plan_id != '') { ?>
                                <h4>Please choose a date from when you want to start your membership</h4>
                            <?php } else { ?>
                                <h4 id="selected_date_heading">Available Slots for <?php echo date('dS M Y'); ?></h4>
                            <?php } ?>
                            <div id="embeddingDatePicker"></div>
                            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" id="selectedDate" />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="time" id="available_slots">
                            <?php
                            $slots = array();
                            foreach ($get_offering_service_details['slots'] as $key => $value) {
                                if ($value->date == date('Y-m-d')) {
                                    $slots[] = $value;
                                }
                            }
                            ?>
                            <?php if ($membership_plan_id == '' && count($slots) != 0) { ?>
                                <h4 id="current_display_date">Available Slots for <?php echo date('dS M Y'); ?></h4>
                            <?php } elseif ($membership_plan_id == '' && count($slots) == 0) { ?>
                                <h5 id="slots_messages">Slots not available for date you selected. Please choose other available date.</h5>
<!--                                <div class="slots_ctr" id="available_dates_ctr">

                                    <?php
                                    $slots = array();
                                    foreach ($get_offering_service_details['slots'] as $key => $value) {
                                        if ($value->date == date('Y-m-d')) {
                                            $slots[] = $value;
                                        }
                                    }
                                    ?>
                                    <input type="hidden" name="slot_id" value="<?php// echo $slots[0]->id; ?>" id="choosed_slot_id"/>
                                    <?php
                                    $slots_dates_array = sort($slots_date_array);
                                    foreach ($slots_date_array as $key => $value) {
                                        $active = 'timeAcitve';
                                        ?>
                                        <table>
                                            <tbody id="available slots">
                                                <tr>
                                                    <td>

                                                        <button id="<?php //echo $value; ?>" class="btn timeBtn rbutton <?php// echo $active; ?>"><?php echo $value; ?>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                    }
                                    ?>
                                </div>-->
                            <?php } ?>
                            <div class="slots_ctr" id="available_slots_ctr">

                                <?php
                                $slots = array();
                                foreach ($get_offering_service_details['slots'] as $key => $value) {
                                    if ($value->date == date('Y-m-d')) {
                                        $slots[] = $value;
                                    }
                                }
                                ?>
                                <input type="hidden" name="slot_id" value="<?php echo $slots[0]->id; ?>" id="choosed_slot_id"/>
                                <?php
                                foreach ($slots as $key => $value) {
                                    if ($key < 1) {
                                        $active = 'timeAcitve';
                                    } else {
                                        $active = '';
                                    }
                                    ?>
                                    <table>
                                        <tbody id="available slots">
                                            <tr>
                                                <td>

                                                    <button id="<?php echo $value->id; ?>" class="btn timeBtn rbutton <?php echo $active; ?>"><?php echo date('H:i', strtotime($value->start_time)) . ' - ' . date('H:i', strtotime($value->end_time)); ?>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customerBox">
                    <h3>CUSTOMER DETAILS</h3>
                    <div class="form-inline">
                        <div class="form-group">
                            <sapn for="inputName" class="intext">Full Name</sapn>
                            <input type="text" class="form-control" id="inputName" value="<?php echo $logged_in_user_data->name; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <sapn for="inputEmail2"  class="intext">Email</sapn>
                            <input type="email" class="form-control" id="inputEmail" value="<?php echo $logged_in_user_data->username; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <sapn for="inputNumber"  class="intext">Contact Number</sapn>
                            <input type="text" class="form-control" id="inputNumber" value="<?php echo $logged_in_user_data->phone; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="paymentBox">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <h3>PAYMENT INFORMATION</h3>
                            <div class="payBox payBox_cng">
                                <p>If you have any questions please give us a call at 080 4951 5364 Mon-Fri from 10.00 till 15.00</p>
                                <p>By clicking on completion, you agree to our terms and conditions and the privacy policy of zinguplife.com</p>
                                <span>Payment Gateway:</span>
                                <input type="radio" name="payment_mode" class="btn zing-btn bookBtn payWidth payment_mode_selection" value="Pay at venue"/>Pay at venue
                                <?php if ($business_provider_details['details']->payment_option == 'Online') { ?>
                                    <input type="radio" name="payment_mode" class="btn zing-btn bookBtn payWidth payment_mode_selection"  value="Pay online"/>Pay Online
                                <?php } ?>
                                <!--                            <a href="javascript:void(0);" class="btn zing-btn bookBtn payWidth">Cancle</a>
                                                            <a href="javascript:void(0);" class="btn zing-btn bookBtn payWidth">Pay</a>-->
                            </div>
                        </div>
                        <div class="col-xs-12  col-sm-12 col-md-4">
                            <h3>PAYMENT SUMMARY</h3>
                            <?php
                            if (!empty($membership_details) && $membership_plan_id != '') {
                                $price = $membership_details->fees;
                            } else {
                                $price = $get_offering_service_details['details']->price;
                            }
                            $discount = $get_offering_service_details['details']->discount;

                            $check = strrchr($discount, '%');
                            if ($check != '') {
                                $discount_value = ($price * $discount) / 100;
                            } else {
                                $discount_value = $discount;
                            }
                            ?>
                            <table class="check-price">
                                <tbody>
                                    <tr>
                                        <td><span><?php echo $get_offering_service_details['details']->services; ?></span></td>
                                        <td class="pricing"><span><?php echo $price; ?></span></td>
                                    </tr>
                                    <?php if ($discount) { ?>
                                        <tr>
                                            <td><span>Discount(-)</span></td>
                                            <td class="pricing"><span><?php echo $discount_value; ?></span></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><span>Tax(+)</span></td>
                                        <td class="pricing"><span><?php echo $tax;?></span></td>
                                    </tr>
                                    <?php
                                    
                                    $total_price_to_be_paid = ($price - $discount_value) + $tax;
                                    ?>
                                    <tr>
                                        <td><span>Total</span></td>
                                        <td class="pricing"><span><?php echo $total_price_to_be_paid; ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="total_price" value="<?php echo $total_price_to_be_paid; ?>"/>
                            <?php
                            if (isset($membership_plan_id) && $membership_plan_id != '') {

                                $membership_type = $membership_plan_id;
                            } else {
                                $membership_type = 0;
                            }
                            ?>
                            <input type="hidden" name="user_id" value="<?php echo $logged_in_user_data->user_id; ?>"/>
                            <input type="hidden" name="total_price" value="<?php echo $total_price_to_be_paid; ?>"/>
                            <input type="hidden" name="membership_type" value="<?php echo $membership_type; ?>"/>
                            <input type="hidden" name="provider_id" value="<?php echo $business_provider_id; ?>"/>
                            <input type="hidden" name="service_id" value="<?php echo $business_service_id; ?>"/>
                            <?php // if ($membership_plan_id == '' && count($slots) != 0) {  ?>
                            <input type="submit" name="pay" value="Cancel" class="btn zing-btn bookBtn pull-right payWidth"/>
                            <input type="submit" name="pay" value="Pay" class="btn zing-btn bookBtn pull-right payWidth" id="pay_button"/>
                            <?php //} elseif ($membership_plan_id != '' && count($slots) == 0) {  ?>
<!--                                <input type="submit" name="pay" value="Cancel" class="btn zing-btn bookBtn pull-right payWidth"/>
                            <input type="submit" name="pay" value="Pay" class="btn zing-btn bookBtn pull-right payWidth"/>-->
                            <?php //}  ?>
                            <!--                            <a href="javascript:void(0);" class="btn zing-btn bookBtn pull-right payWidth">Cancle</a>
                                                        <a href="javascript:void(0);" class="btn zing-btn bookBtn pull-right payWidth">Pay</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>