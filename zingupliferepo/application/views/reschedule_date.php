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
                <li>
                    <div class="dateTxt">
                        <span class="colorGreen">Current Date: <?php echo date("l, F j, Y", strtotime($transaction_details->date)); ?></span>
                    </div>
                </li>
                <li>
                    <div class="dateTxt">
                        <span class="colorGreen">1. Change Date</span>
                        <!--                        <div class="row">
                                                    <div class="col-xs-6 col-sm-2">
                                                        <select class="selectpicker1" data-style="btn-inverse">
                                                            <option>APRIL</option>
                                                            <option>......</option>
                                                            <option>......</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-2">
                                                        <select class="selectpicker2" data-style="btn-inverse">
                                                            <option>2016</option>
                                                            <option>......</option>
                                                            <option>......</option>
                                                        </select>
                                                    </div>
                                                </div>-->
                        <div class="date dashDate">
                            <div id="dashDatePicker"></div>
                        </div>

                        <form method="post" action="<?php echo base_url(); ?>confirm_reschedule_date">
                            <input type="hidden" name="booking_date" value="<?php echo date('Y-m-d'); ?>" id="reschedule_date"/>
                            <input type="hidden" name="booking_id" value="<?php echo $transaction_details->booking_id; ?>" id="booking_id"/>
                            <input type="hidden" name="reschedule_start_time" value="<?php echo date('H:i', strtotime($transaction_details->start_time)); ?>" />
                            <input type="hidden" name="reschedule_end_time" value="<?php echo date('H:i', strtotime($transaction_details->end_time)); ?>" />
                            <input type="submit" name="submit" id="submit" value="Continue" class="btn editButton"/>
                            <input type="submit" name="submit" value="Cancel" class="btn odColor"/>
                        </form>


                        <!--                        <a href="javascript:void(0);" class="btn editButton">Continue</a>
                        <a href="javascript:void(0);" class="btn odColor">Cancel</a>-->
                    </div>
                </li>
                <li class="checkboxs checked">
                    <div class="dateTxt">
                        <span class="colorGreen">2. Time <?php
                            $start_time = date('H:i A', strtotime($transaction_details->start_time));
                            echo $start_time;
                            ?></span>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>