<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Transactions</h3>
</div>

<div class="row-fluid tr-row">
    <div class="finance-summary">
        <span class="summary">Summary</span>
        <div class="sorting-section sorting-section2">
            <p class="sorting-para spara1">
                <span class=" sorting-span">Data Showing for</span>
                <span id="finance_transaction_date" class="blue sorting-span sort-span"><?php
                    if ($current_date == date('Y/m/d')) {
                        echo 'Today';
                    } else {
                        echo $current_date;
                    }
                    ?></span>
                <i id="dp15" class="fa fa-angle-down date-arrow blue" data-date="<?php echo $current_date; ?>" data-date-format="yyyy/mm/dd"></i>
            </p>

            <form action='<?php echo base_url(); ?>customer_support/download' method='post' class='transform' target="_blank" >

                <input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
                <input type='hidden' name='trans' class='html' value=''/>      
            </form>
        </div>
        <div class='trans-tabledata' style='display:none;'>
            <h3>Summary</h3>
            <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
                <thead>
                    <tr>
                        <th class="filter-input" rowspan="2">Average Selling<br/> Price(&#x20B9;)</th>
                        <th rowspan="2">Total No. of  <br/>Transactions</th>
                        <th rowspan="2" class="filter-input">Total Amount</th>
                        <th class="head-centre" colspan="2" style="text-align: center;">Incoming</th>
                        <th class="head-centre" colspan="2" style="text-align: center;">Outgoing</th>
                        <th rowspan="2">Profit</th>
                    </tr>
                    <tr>
                        <th class="head-centre no-bold" style="text-align: center;">Amount</th>
                        <th class="head-centre no-bold" style="text-align: center;">Tax</th>
                        <th class="head-centre no-bold" style="text-align: center;">Amount</th>
                        <th class="head-centre no-border1 no-bold" style="text-align: center;">Tax</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="medium">20,000</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
                        <td><span class="medium">10</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
                        <td><span class="medium">-2,00,000</span></td>
                        <td class="head-centre"><span class="medium" style="text-align: center;">4,000</span></td>
                        <td class="head-centre"><span class="medium" style="text-align: center;">150</span></td>
                        <td class="head-centre"><span class="medium" style="text-align: center;">5,000</span></td>
                        <td class="head-centre"><span class="medium" style="text-align: center;">250</span></td>
                        <td><span class="medium">-5000</span></td>
                    </tr>
                </tbody>
            </table>

            <h2 class="summary summary1">Transactions</h2>

            <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
                <thead>
                    <tr>
                        <th rowspan="2" class="filter-input">Order<br/> ID No.</th>
                        <th rowspan="2">Treatment <br/>Date/Time</th>
                        <th rowspan="2" class="filter-input">Customer<br/> ID No.</th>
                        <th rowspan="2" class="filter-input">Customer<br/> Name</th>
                        <th rowspan="2">Vendor Name <br/>& Location</th>
                        <th rowspan="2">Treatment</th>
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
                <tbody>
                    <?php foreach ($all_transactions as $key => $value) { ?>
                        <tr>
                            <td class="blue"><a style="color:#00a3d8;" href="<?php echo base_url(); ?>finance/order_details/<?php echo $value['transactions']->booking_id; ?>"><?php echo $value['transactions']->booking_id; ?></a></td>
                            <td><?php echo date('Y/m/d', strtotime($value['transactions']->booking_date)); ?><br/>
                                <?php
                                $booking_timing = date('h:i A', strtotime($value['transactions']->start_time));
                                echo $booking_timing;
                                ?> 
                            </td>
                            <td class="blue"><?php echo $value['user_details']->id; ?></td>  
                            <td class="blue word_break word_break_down"><?php echo $value['user_details']->name; ?></td> 
                            <td class=""><span class="blue v-name word_break"><?php echo $value['vendor_details']->name; ?></span> <br/><?php echo $value['vendor_details']->area_name; ?></td>
                            <td><span class="v-name word_break word_break_down"><?php echo $value['transactions']->services; ?></span></td>

                            <td class="head-centre" style="text-align: center;">4,000</td>
                            <td class="head-centre" style="text-align: center;">150</td>
                            <td class="head-centre no-border1" style="text-align: center;">5,000</td>
                            <td class="head-centre" style="text-align: center;">250</td>
                            <td>1500</td>
                        </tr>
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
        </div>
    </div>

    <div class="finance-summary1">
        <span class="summary summary1">Transactions</span>
        <div class="filter-section">
<!--            <input type="hidden" value="<?php echo $vendor_details['vendor_details']->id; ?>" id="current_vendor_id"/>-->
            <label class="filter-label filter-label1">Filter:</label>
            <select class="finance_transactions_search_method finance_servce_filter" id="finance_transactions_service">
                <option value="">All Services</option>
                <?php foreach ($services as $key => $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->service_name; ?></option>                                                    
                <?php } ?>

            </select>

            <select class="vendor-select finance_transactions_search_method" id="finance_transactions_vendor">
                <option value="">All Vendors</option>
                <?php foreach ($vendors as $key => $val) { ?>
                    <option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>                                                    
                <?php } ?>

            </select>

            <select class="vendor_loc finance_transactions_search_method" id="finance_transactions_location">
                <option value=''>All Locations</option>
                <option value='135'>Whitefield</option>
                <option value='14'>Bellandur</option>
                <option value='71'>Koramangala</option>
            </select>

            <span class="medium total">Total Value of Data:15,150</span>
        </div>

        <div class="finance_transactions_search_ctr">
            <table id="transaction-detail1" class="display" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th rowspan="2" class="filter-input">Order<br/> ID No.</th>
                        <th rowspan="2">Treatment <br/>Date/Time</th>
                        <th rowspan="2" class="filter-input">Customer<br/> ID No.</th>
                        <th rowspan="2" class="filter-input">Customer<br/> Name</th>
                        <th rowspan="2" style="width:80px;">Vendor Name <br/>& Location</th>
                        <th rowspan="2">Treatment</th>
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

                <tbody>
                    <?php foreach ($all_transactions as $key => $value) { ?>
                        <tr>
                            <td class="blue"><a style="color:#00a3d8;" href="<?php echo base_url(); ?>finance/order_details/<?php echo $value['transactions']->booking_id; ?>"><?php echo $value['transactions']->booking_id; ?></a></td>
                            <td><?php echo date('Y/m/d', strtotime($value['transactions']->booking_date)); ?><br/>
                                <?php
                                $booking_timing = date('h:i A', strtotime($value['transactions']->start_time));
                                echo $booking_timing;
                                ?> 
                            </td>
                            <td class="blue"><?php echo $value['user_details']->id; ?></td>  
                            <td class="blue word_break word_break_down"><?php echo $value['user_details']->name; ?></td> 
                            <td class=""><span class="blue v-name word_break word_break_down"><?php echo $value['vendor_details']->name; ?></span> <br/><?php echo $value['vendor_details']->area_name; ?></td>
                            <td><span class="v-name word_break"><?php echo $value['transactions']->services; ?></span></td>

                            <td class="head-centre">4,000</td>
                            <td class="head-centre">150</td>
                            <td class="head-centre no-border1">5,000</td>
                            <td class="head-centre">250</td>
                            <td>1500</td>
                        </tr
                        ><?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>