
<div class="location-header redirect-header">


    <h3 class="redirect-head">Order Details</h3>


</div>


<div class="row-fluid notify">
    <div class="span12 no-border">

        <div class="tdetail-con">
            <div class="order-con">  
                <span class="order-id" href="">Transaction Id:<?php echo $order_details->transaction_id; ?></span>
                <span><a class="order-print" href="<?php echo base_url(); ?>pdf/<?php echo $order_details->booking_id; ?>"><img class="print"  src="<?php echo base_url(); ?>assets/images/print.png"/>
                        Print</a></span>

            </div>

            <div class="trans-header">

                <img class="shatayu-logo1" src="<?php echo base_url(); ?>assets/uploads/business_providers/logo/<?php echo $business_provider_details['details']->business_id; ?>/<?php echo $business_provider_details['details']->logo; ?>"/>
                <h3 class="vendor-head medium"><?php echo $business_provider_details['details']->name; ?> - <?php echo $business_provider_details['details']->area_name; ?></h3>

            </div>


            <div class="book-details1">
                <div class="trans-span7">
                    <?php if ($order_details->membership_type == 0) { ?>
                        <p class="book-para">
                            <label class="book-label">Treatment:</label>
                            <span class="book-text"><?php echo $order_details->services; ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Date:</label>
                            <span class="book-text"> <?php echo date("l, F j, Y", strtotime($order_details->date)); ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Time:</label>
                            <span class="book-text"><?php
                                $start_time = date('H:i', strtoTIME($order_details->start_time));
                                if ($start_time >= 12) {
                                    $meridian = 'PM';
                                } else {
                                    $meridian = 'AM';
                                }echo date('h:i', strtoTIME($order_details->start_time)) . ' ' . $meridian;
                                ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Duration:</label>
                            <span class="book-text"><?php
                                if ($order_details->duration == 1) {
                                    $hr = 'hr';
                                } else {
                                    $hr = 'hrs';
                                }echo $order_details->duration;
                                ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Amount:</label>
                            <span class="book-text amt">&#8377;<?php echo $order_details->amount; ?></span>
                        </p>
                        <div class="clear"></div>
                        <p class="book-para">
                            <label class="book-label">Payment Mode:</label>
                            <span class="book-text"><?php echo $order_details->payment_mode; ?></span>
                        </p>

                    <?php } else { ?>
                        <p class="book-para">
                            <label class="book-label">Treatment:</label>
                            <span class="book-text"><?php echo $order_details->services; ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Membership:</label>
                            <span class="book-text"><?php echo $order_details->membership; ?></span>
                        </p>


                        <p class="book-para">
                            <label class="book-label">Date:</label>
                            <span class="book-text"><?php echo date("l, F j, Y", strtotime($order_details->membership_start_date)); ?></span>
                        </p>


                        <p class="book-para">
                            <label class="book-label">Duration:</label>
                            <span class="book-text"><?php echo $order_details->duration; ?></span>
                        </p>

                        <p class="book-para">
                            <label class="book-label">Amount:</label>
                            <span class="book-text amt">&#8377;<?php echo $order_details->fees; ?></span>
                        </p>
                        <div class="clear"></div>
                        <p class="book-para">
                            <label class="book-label">Payment Mode:</label>
                            <span class="book-text"><?php echo $order_details->payment_mode; ?></span>
                        </p>
                    <?php } ?>
                </div>


                <div class="trans-span71">
                    <p class="book-para">
                        <label class="book-label">Name:</label>
                        <span class="order-text green"><?php echo $user_details->name; ?></span>
                    </p>
                    <p class="book-para">
                        <label class="book-label">Phone:</label>
                        <span class="order-text green"><?php echo $user_details->phone; ?></span>
                    </p>
                    <p class="book-para">
                        <label class="book-label">Email:</label>
                        <span class="order-text green"><?php echo $user_details->username; ?></span>
                    </p>


                </div>



            </div>

            <div class="book-details1">

                <span class="next-step medium">Next Step:</span>
                <p class="para-small">Arrive 15 Mins earlier and show the SMS or App confirmation page at counter.</p>

            </div>


            <div class="book-contact">
                <p class="book-para">
                    <label class="book-label1">Contact customer support: </label>
                    <span class="book-text1 green">080 4951 5364</span>
                </p>
            </div>

        </div>
    </div>


</div>