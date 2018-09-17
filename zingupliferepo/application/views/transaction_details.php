<div class="container">
    <div class="linerList">
        <span class="colorGreen">Home&nbsp;</span><span  class="colorGrey">// Order Details</span>
    </div>

    <div class="orderBox">
        <h4>Transaction Id: <?php echo $transaction_details->transaction_id; ?></h4>
        <div class="orderImage">
            <div class="row">
                <div class="col-sm-2 addressimg"><img src="<?php echo base_url(); ?>assets/uploads/business_providers/logo/<?php echo $business_provider_details['details']->business_id; ?>/<?php echo $business_provider_details['details']->logo; ?>"></div>
                <div class="col-sm-10 addressText">
                    <p class="colorGreen"><?php echo $business_provider_details['details']->name; ?> - <?php echo $business_provider_details['details']->area_name; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form class="form-horizontal orderWidth">
                    <?php if ($transaction_details->service_type == 'hourly') { ?>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Treatment:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo $transaction_details->services; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Date:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo date("l, F j, Y", strtotime($transaction_details->date)); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Duration:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor">
                                    <?php echo $transaction_details->duration; ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Amount:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor">₹<?php echo $transaction_details->price; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Payment Mode:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo $transaction_details->payment_mode; ?></span>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Treatment:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo $transaction_details->services; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Membership:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo $transaction_details->membership; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Duration:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor">
                                    <?php echo $transaction_details->duration; ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Start date::</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo $transaction_details->membership_start_date; ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Amount:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor">₹<?php echo $transaction_details->fees; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-xs-3 widthBox1">Payment Mode:</span>
                            <div class="col-xs-8 widthBox2">
                                <span class="odColor"><?php echo $transaction_details->payment_mode; ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
            <div class="col-md-6">
                <form class="form-horizontal orderWidth">
                    <div class="form-group">
                        <span class="col-xs-2 widthBox1">Name</span>
                        <div class="col-xs-10 widthBox2">
                            <span class="colorGreen font18"><?php echo $logged_in_user_data->name; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-xs-2 widthBox1">Phone</span>
                        <div class="col-xs-10 widthBox2">
                            <span class="colorGreen font18"><?php echo $logged_in_user_data->phone; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-xs-2 widthBox1">Email</span>
                        <div class="col-xs-10 widthBox2">
                            <span class="colorGreen font18"><?php echo $logged_in_user_data->username; ?></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="nextBox">
            <h4>Next Step:</h4>
            <span class="colorBlue">Arrive 15 Mins Earlier and Show the SMS or App Confirmation page at counter</span>
        </div>

        <div class="nextBox">
            <h4>Contact Customer support:</h4>
            <span class="colorGreen">080 4951 5364</span>
        </div>
    </div>
</div>