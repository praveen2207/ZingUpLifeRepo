<div class="container">
    <div class="linerList">
        <span class="colorGreen">Home&nbsp;</span><span  class="colorGrey">// Reschedule</span>
    </div>

    <div class="orderBox">
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

        <div class="datetimeBox">
            <ul>
                <li class="checkboxs checked">
                    <div class="dateTxt">
                        <?php if ($transaction_details->membership_type == 0) { ?>
                            <span class="colorGreen">1. Date: <?php echo date("l, F j, Y", strtotime($transaction_details->date)); ?></span>
                            <a href="<?php echo base_url(); ?>reschedule_date/<?php echo $transaction_details->booking_id; ?>" class="btn editButton pull-right">Edit Date</a>
                        <?php } else { ?>
                            <span class="colorGreen">1. Date: <?php echo date("l,F j, Y", strtotime($transaction_details->membership_start_date)); ?></span>
                            <a href="<?php echo base_url(); ?>reschedule_membership_date/<?php echo $transaction_details->booking_id; ?>" class="btn editButton pull-right">Edit Date</a>
                        <?php } ?>
                    </div>
                </li>
                <li class="checkboxs checked">
                    <div class="dateTxt">
                        <?php if ($transaction_details->membership_type == 0) { ?>
                            <span class="colorGreen">2. Time: <?php
                                $start_time = date('H:i A', strtotime($transaction_details->start_time));
                                echo $start_time;
                                ?>
                            </span>
                            <a href="<?php echo base_url(); ?>reschedule_time/<?php echo $transaction_details->booking_id; ?>" class="btn editButton pull-right">Edit Time</a>
                        <?php } else { ?>
                            <span class="colorGreen">2. Time: <?php echo $transaction_details->duration; ?>
                            </span>
<!--                            <a href="javascript:void(0);" class="btn editButton pull-right">Edit Time</a>-->
                        <?php } ?>

                    </div>
                </li>
            </ul>
        </div>

        <div class="nextBox">
            <h4>Contact Customer support:</h4>
            <span class="colorGreen">080 4951 5364</span>
        </div>
    </div>
</div>