<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Vendor Details</h3>
</div>

<div class="row-fluid tr-row">
    <div class="finance-summary">
        <span class="summary">Summary</span>
        <div class="sorting-section sorting-section2">
            <p class="sorting-para">
                <span class=" sorting-span">Data Showing from</span>
                <span class="blue  sorting-span">Today<i class="fa fa-angle-down"></i></span>
            </p>
            <form action='<?php echo base_url(); ?>customer_support/download' method='post' class='transform' target="_blank" >

                <input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
                <input type='hidden' name='trans' class='html' value=''/>      
            </form>
        </div>
        <div class='trans-tabledata' style='display:none;'>
            <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
                <thead>
                    <tr>
                        <th rowspan="2" class="filter-input">Order<br/> ID No.</th>
                        <th rowspan="2">Booked <br/>Date/Time</th>
                        <th rowspan="2" class="filter-input">Customer<br/> ID No.</th>
                        <th rowspan="2" class="filter-input">Customer<br/> Name</th>
                        <th rowspan="2">Treatment& <br/>Duration</th>
                        <th rowspan="2">Treatment <br/>Date/Time</th>
                        <th class="head-centre" colspan="2" style="text-align: center;">Incoming</th>
                        <th class="head-centre" colspan="2" style="text-align: center;">Outgoing</th>
                        <th rowspan="2">Profit</th>
                    </tr>
                    <tr>
                        <th class="head-centre no-padding no-bold" style="text-align: center;">Amount</th>
                        <th class="head-centre no-bold" style="text-align: center;">Tax</th>
                        <th class="head-centre no-padding no-bold" style="text-align: center;">Amount</th>
                        <th class="head-centre no-border1 no-bold" style="text-align: center;">Tax</th>
                    </tr>
                </thead>
                <tbody id="vendor_transaction_table_filter">
                    <?php
                    if (!empty($vendor_details['transactions'])) {
                        foreach ($vendor_details['transactions'] as $key => $value) {
                            ?>
                            <tr>
                                <td class="blue"><a style="color:#00a3d8;" href="<?php echo base_url(); ?>finance/order_details/<?php echo $value->booking_id; ?>"><?php echo $value->booking_id; ?></a></td>
                                <td><?php echo date('Y/m/d', strtotime($value->booking_date)); ?><br/>
                                    <?php
                                    $booking_timing = date('h:i A', strtotime($value->booking_date));
                                    echo $booking_timing;
                                    ?> 
                                </td>
                                <td class="blue"><?php echo $value->user_details->user_id; ?></td>
                                <td class="blue word_break_down"><?php echo $value->user_details->name; ?></td>
                                <td><span class="blue v-name"><?php echo $value->services; ?></span><br/><?php
                                    echo $value->duration;
                                    ?></td>
                                <td><?php echo date('Y/m/d', strtotime($value->date)); ?><br/>
                                    <?php
                                    $slot_timing = date('h:i A', strtotime($value->start_time));
                                    echo $slot_timing;
                                    ?>     
                                </td>

                                <td class="head-centre">4,000</td>
                                <td class="head-centre">150</td>
                                <td class="head-centre no-border1">5,000</td>
                                <td class="head-centre">250</td>
                                <td>1500</td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <div class="summary-section">
            <table id="summary-table" class="display" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th class="filter-input" rowspan="2">Average Selling<br/> Price(&#x20B9;)</th>
                        <th rowspan="2">Total No. of  <br/>Transactions</th>
                        <th rowspan="2" class="filter-input">Total Amount</th>
                        <th class="head-centre" colspan="2">Incoming</th>
                        <th class="head-centre" style="" colspan="2">Outgoing</th>
                        <th rowspan="2">Profit</th>
                    </tr>
                    <tr>
                        <th class="head-centre no-bold">Amount</th>
                        <th class="head-centre no-bold">Tax</th>
                        <th class="head-centre no-bold">Amount</th>
                        <th class="head-centre no-border1 no-bold">Tax</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="medium">20,000</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
                        <td><span class="medium">10</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
                        <td><span class="medium">-2,00,000</span></td>
                        <td class="head-centre"><span class="medium">4,000</span></td>
                        <td class="head-centre"><span class="medium">150</span></td>
                        <td class="head-centre"><span class="medium">5,000</span></td>
                        <td class="head-centre"><span class="medium">250</span></td>
                        <td><span class="medium">-5000</span></td>
                    </tr>
                </tbody>
            </table>

            <table class="display finance-vendor" id="detail-table" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th class="">Vendor Name</th>
                        <th>Locations</th>
                        <th>Phone No.</th>
                        <th>Email IDs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="" rowspan="3"><span class="v-name1"><?php echo $vendor_details['vendor_details']->name; ?></span></td>
                        <td class=""><?php echo $vendor_details['vendor_details']->area_name; ?></td>
                        <td><?php echo $vendor_details['vendor_details']->phone; ?> <a href=""></a></td>
                        <td class="blue" rowspan="3"><a class="blue mail-id" href="mailto:<?php echo $vendor_details['vendor_details']->email; ?>"><?php echo $vendor_details['vendor_details']->email; ?></a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="note-section">
            <div class="panel panel-warning">  
                <div class="panel-heading note-con">
                    <h3 class="panel-title"> 
                        <a data-toggle="collapse" data-parent="#accordion" href="#accordionThree" class="">
                            <label>Notes<i class="fa fa-angle-down note-arrow"></i></label>
                            <p class="note-para">
    <!--                            <span class="word-count">250 Words</span>
                                <span class="word-count">|</span>-->
                                <span class="user-name">Updated by <?php echo $logged_in_user_details->name; ?>
                                    <?php
                                    if (strtotime($vendor_details['vendor_details']->business_updated_at) != '' && $vendor_details['vendor_details']->business_updated_at != '0000-00-00 00:00:00') {
                                        ?> on <?php
                                        echo date('Y/m/d', strtotime($vendor_details['vendor_details']->business_updated_at));
                                    }
                                    ?> 
                                </span>
                            </p>
                        </a>
                    </h3>
                </div>

                <div id="accordionThree" class="panel-collapse collapse clear">
                    <!-- panel body -->
                    <div class="panel-body v-collapse">
                        <textarea class="note-area finance_notes"><?php echo $vendor_details['vendor_details']->finance_notes; ?></textarea>
                        <a href=""><span class="edit-icon edit-icon2 edit-icon3 finance_notes_edit" id="<?php echo $vendor_id; ?>"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-section">
            <div class="sorting-section2" id="cs_support_vendor_details_filter">
                <input type="hidden" value="<?php echo $vendor_details['vendor_details']->id; ?>" id="current_vendor_id"/>
                <p class="sorting-para">
                    <span class="detail-span">Transactions of </span>
                    <label class="select-label select-label1 blue">
                        <select class="services-dropdown services-dropdown1 filter_vendor_transaction_by_services_for_finanace">
                            <option value="">All Services</option>
                            <?php foreach ($services as $key => $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->service_name; ?></option>                                                    
                            <?php } ?>

                        </select>
                    </label>
                </p>
                <p class="d-para">
                    <a href="<?php echo base_url(); ?>finance/batch_payment/<?php echo $vendor_details['vendor_details']->id; ?>" class="blue download">View Batch Payment</a>
                </p>
            </div>


            <table id="transaction-detail2" class="display" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th rowspan="2" class="filter-input">Order<br/> ID No.</th>
                        <th rowspan="2">Booked <br/>Date/Time</th>
                        <th rowspan="2" class="filter-input">Customer<br/> ID No.</th>
                        <th rowspan="2" class="filter-input">Customer<br/> Name</th>
                        <th rowspan="2">Treatment& <br/>Duration</th>
                        <th rowspan="2">Treatment <br/>Date/Time</th>
                        <th class="head-centre" colspan="2">Incoming</th>
                        <th class="head-centre" style="" colspan="2">Outgoing</th>
                        <th rowspan="2">Profit</th>
                    </tr>
                    <tr>
                        <th class="head-centre no-padding no-bold">Amount</th>
                        <th class="head-centre no-bold">Tax</th>
                        <th class="head-centre no-padding no-bold">Amount</th>
                        <th class="head-centre no-border1 no-bold">Tax</th>
                    </tr>
                </thead>
                <tbody id="finance_vendor_transaction_table_filter">
                    <?php
                    if (!empty($vendor_details['transactions'])) {
                        foreach ($vendor_details['transactions'] as $key => $value) {
                            ?>
                            <tr>
                                <td class="blue"><a style="color:#00a3d8;" href="<?php echo base_url(); ?>finance/order_details/<?php echo $value->booking_id; ?>"><?php echo $value->booking_id; ?></a></td>
                                <td><?php echo date('Y/m/d', strtotime($value->booking_date)); ?><br/>
                                    <?php
                                    $booking_timing = date('h:i A', strtotime($value->booking_date));
                                    echo $booking_timing;
                                    ?> 
                                </td>
                                <td class="blue"><?php echo $value->user_details->user_id; ?></td>
                                <td class="blue word_break_down"><?php echo $value->user_details->name; ?></td>
                                <td><span class="blue v-name"><?php echo $value->services; ?></span><br/><?php
                                    echo $value->duration;
                                    ?></td>
                                <td><?php echo date('Y/m/d', strtotime($value->date)); ?><br/>
                                    <?php
                                    $slot_timing = date('h:iA', strtotime($value->start_time));
                                    echo $slot_timing;
                                    ?>     
                                </td>

                                <td class="head-centre">4,000</td>
                                <td class="head-centre">150</td>
                                <td class="head-centre no-border1">5,000</td>
                                <td class="head-centre">250</td>
                                <td>1500</td>
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
</div>