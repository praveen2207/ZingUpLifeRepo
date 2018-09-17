<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Customer Detail</h3>
</div>

<div class="row-fluid customer-detail-row">
    <div class="customer-section">
        <p class="customer-detail">
            <span class="cust-d-name"><?php echo $customer_details['user_details']->name; ?></span>
            <span class="cust-admin-id" href="">Customer ID:<?php echo $customer_details['user_details']->user_id; ?></span>
        </p>
        <form action='<?php echo base_url(); ?>customer_support/download' method='post' class='transform' target="_blank">

            <input type='submit' class="blue download download1 pdftransdownload cs_invoice_download" value='Download'/>
            <input type='hidden' name='trans' class='html' value=''/>      
        </form>
    </div>
    <div class='trans-tabledata' style='display:none;'>
        <table  border="1" class="display" cellspacing="0" cellpadding="3" width="100%">
            <thead>
                <tr>
                    <th class="filter-input">Order<br/> ID No.</th>
                    <th>Booked <br/>Date/Time</th>
                    <th class="filter-input">Customer<br/> Name</th>
                    <th>Vendor Name <br/>& Location</th>
                    <th>Treatment & <br/> Duration</th>
                    <th>Treatment<br/> Date/Time</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody >
                <?php
                if (!empty($customer_details['transactions'])) {
                    foreach ($customer_details['transactions'] as $key => $value) {
                        ?>
                        <tr id="<?php echo $customer_details['user_details']->id . '-' . $value->booking_id . '-' . $value->slot_id; ?>">
                            <td class="blue"><?php echo $value->booking_id; ?></td>
                            <td><?php echo date('Y/m/d', strtotime($value->booking_date)); ?><br/>
                                <?php
                                $booking_timing = date('h:i A', strtotime($value->booking_date));
                                echo $booking_timing;
                                ?> 
                            </td>

                            <td class="blue"><?php echo $customer_details['user_details']->name; ?></td>
                            <td class=""><span class="blue v-name"><?php echo $value->vendor_details->name; ?></span> <br/><?php echo $value->vendor_details->area_name; ?></td>
                            <td><span class="blue v-name"><?php echo $value->services; ?></span><br/><?php
                                echo $value->duration;
                                ?></td>

                            <td><?php echo date('Y/m/d', strtotime($value->date)); ?><br/>
                                <?php
                                $slot_timing = date('h:i A', strtotime($value->start_time));
                                echo $slot_timing;
                                ?>     
                            </td>

                            <td><?php echo $value->amount; ?></td>
                            
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="customer-order clear">
        <div class="customer-in">
            <div class="customer-image">
                <img class="customer-photo" src="<?php echo base_url(); ?>assets/admin/images/profile-photo.jpg"/>
                <ul class="customer-action-list">
                    <li><a class="blue" href="">Approve</a></li>
                    <li>|</li>
                    <li><a href="" class="blue">Reject</a></li>
                </ul>
            </div>

            <div class="customer-history">
                <p class="book-para">	
                    <label class="book-label table-label">Age:</label>	
                    <span class="order-text table-text"><?php echo $customer_details['user_details']->age; ?> years</span>	
                </p>


                <p class="book-para">	
                    <label class="book-label table-label">Gender:</label>	
                    <span class="order-text table-text"><?php echo $customer_details['user_details']->gender; ?></span>	
                </p>

                <p class="book-para">
                    <label class="book-label table-label">Phone No:</label>	
                    <span class="order-text table-text">+91 <?php echo $customer_details['user_details']->phone; ?></span>	
                </p>

                <p class="book-para">	
                    <label class="book-label table-label">Email ID:</label>		
                    <span class="order-text table-text word_break_down"><a href="mailto:" class="blue vendor-text"><?php echo $customer_details['user_details']->username; ?></a></span>
                </p>

            </div>
        </div>
        <?php if (!empty($customer_details['transactions'])) { ?>
            <?php
            $total_transaction_amount_array = array();
            $upcoming_bookings = array();
            foreach ($customer_details['transactions'] as $key => $value) {
                $total_transaction_amount_array[] = $value->amount;
                if ($value->date >= date('Y-m-d')) {
                    $upcoming_bookings[] = $value->date;
                }
            }
            $total_transaction_amount = array_sum($total_transaction_amount_array);
            ?>

            <div class="transaction-summary">
                <span class="cust-d-name">Transactions Summary</span>
                <ul class="summary-list">
                    <li>Total No.<span class="summary-text medium"><?php echo count($customer_details['transactions']); ?></span></li>
                    <li>Total Amount:<span class="summary-text medium">&#x20B9; <?php echo $total_transaction_amount; ?></span></li>
                    <li>Most Used Treatment:<span class="summary-text medium"><?php
                            if (isset($customer_details['services'])) {
                                echo $customer_details['services']->services;
                            }
                            ?></span></li>
                    <li>Upcoming:<span class="summary-text medium"><?php echo count($upcoming_bookings); ?></span></li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="transaction-summary">
                <span class="cust-d-name">Transactions Summary</span>
                <ul class="summary-list">
                    <li>Total No.<span class="summary-text medium"></span></li>
                    <li>Total Amount:<span class="summary-text medium"></span></li>
                    <li>Most Used Treatment:<span class="summary-text medium"></span></li>
                    <li>Upcoming:<span class="summary-text medium"></span></li>
                </ul>
            </div>
        <?php } ?>
    </div>

    <p class="customer-date-section">
        <span class="customer-date">Member Since: <?php echo date('Y/m/d', strtotime($customer_details['user_details']->created_on)); ?></span>
        <?php if (!empty($customer_details['transactions'])) { ?>
            <span class="customer-date">Last Booking Since: <?php echo date('Y/m/d', strtotime($customer_details['transactions'][0]->booking_date)); ?></span>
        <?php } ?>
    </p>


    <div class="detail-section">
        <p class="sorting-para d-para1">
            <span class="detail-span">Transactions of </span>
            <input type="hidden" value="<?php echo $customer_details['user_details']->user_id; ?>" id="current_customer_id"/>
            <label class="select-label select-label1 blue">
                <select class="services-dropdown services-dropdown1 cs_filter_transaction_by_services">
                    <option value="">All Services</option>
                    <?php foreach ($services as $key => $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->service_name; ?></option>                                                    
                    <?php } ?>

                </select>
            </label>
        </p>

        <table id="customer-detail" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="filter-input">Order<br/> ID No.</th>
                    <th>Booked <br/>Date/Time</th>
                    <th class="filter-input">Customer<br/> Name</th>
                    <th style="width:80px;">Vendor Name <br/>& Location</th>
                    <th>Treatment & <br/> Duration</th>
                    <th>Treatment<br/> Date/Time</th>
                    <th>Cost(&#x20B9;)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="customer_transaction_table_filter">
                <?php
                if (!empty($customer_details['transactions'])) {
                    foreach ($customer_details['transactions'] as $key => $value) {
                        ?>
                        <tr id="<?php echo $customer_details['user_details']->id . '-' . $value->booking_id . '-' . $value->slot_id; ?>">
                            <td class="blue"><?php echo $value->booking_id; ?></td>
                            <td><?php echo date('Y/m/d', strtotime($value->booking_date)); ?><br/>
                                <?php
                                $booking_timing = date('h:i A', strtotime($value->booking_date));
                                echo $booking_timing;
                                ?> 
                            </td>

                            <td class="blue word_break_down"><?php echo $customer_details['user_details']->name; ?></td>
                            <td class=""><span class="blue v-name"><?php echo $value->vendor_details->name; ?></span> <br/><?php echo $value->vendor_details->area_name; ?></td>
                            <td><span class="blue v-name word_break_down"><?php echo $value->services; ?></span><br/><?php
                                echo $value->duration;
                                ?></td>

                            <td><?php echo date('Y/m/d', strtotime($value->date)); ?><br/>
                                <?php
                                $slot_timing = date('h:i A', strtotime($value->start_time));
                                echo $slot_timing;
                                ?>     
                            </td>

                            <td><?php echo $value->amount; ?></td>
                            <td class="action-td"><?php
                                $current_date = date('Y-m-d');
                                if (strtotime($value->date) > strtotime($current_date)) {
                                    if ($value->booking_status == 'Pending') {
                                        ?><span class="blue medium actions confirmorder">Confirm Order</span> <?php
                                    } else {
                                        if (isset($value->mark_attend)) {
                                            if ($value->mark_attend == 'Not-attended') {
                                                ?><span class="blue medium actions remind-customer">Remind Customer</span> <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                                <span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>		
                                <div class="actions-dropdown">	
                                    <span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>	
                                    <ul class="actions-list">		
                                        <li><?php
                                            if (strtotime($value->date) > strtotime($current_date)) {
                                                if (isset($value->mark_attend)) {
                                                    if ($value->mark_attend == 'Not-attended') {
                                                        ?><a id="<?php echo $customer_details['user_details']->id . '-' . $value->booking_id . '-' . $value->slot_id; ?>" class="blue markattend" href="">Mark as Attended</a><?php } else { ?>Attended <?php
                                                    }
                                                }
                                            }
                                            ?></li>	
                                        <li><a id="<?php echo $customer_details['user_details']->id . '-' . $value->booking_id . '-' . $value->slot_id; ?>" class="blue" href=""><?php
                                                if (strtotime($value->date) > strtotime($current_date)) {
                                                    if ($value->booking_status == 'Pending') {
                                                        ?>Remind Customer<?php
                                                    }
                                                }
                                                ?></a></li>	
                                        <li><a id="<?php echo $customer_details['user_details']->id . '-' . $value->booking_id . '-' . $value->slot_id; ?>" class="green" href=""><?php
                                                if (strtotime($value->date) > strtotime($current_date)) {
                                                    if ($value->booking_status == 'Success') {
                                                        ?><i class="fa fa-check fa-confirm"></i>Confirmed <?php
                                                    }
                                                }
                                                ?></a></li>
                                        <li><a id="<?php echo $customer_details['user_details']->id . '-' . $value->booking_id . '-' . $value->slot_id; ?>"class="blue" href="<?php echo base_url(); ?>customer_support/order_details/<?php echo $value->booking_id; ?>">View Order Detail</a></li>
                                    </ul>	
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>