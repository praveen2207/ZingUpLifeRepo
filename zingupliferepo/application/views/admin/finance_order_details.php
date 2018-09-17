<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Order Detail</h3>

</div>


<div class="row-fluid tr-row">


    <div class="finance-summary">

        <span class="summary">Summary</span>

        <div class="sorting-section sorting-section2">
            <p class="sorting-para">
                <span class=" sorting-span">Data Showing from</span>

                <span class="blue  sorting-span">Today<i class="fa fa-angle-down"></i></span>

            </p>

            <form action='<?php echo base_url(); ?>customer_support/download' method='post' class='transform finance_order_detail_section' target="_blank" style='padding-top: 9px;'>

                <input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
                <input type='hidden' name='trans' class='html' value=''/>      
            </form>


        </div>
        <div class='trans-tabledata' style='display:none;'>
          <div class="summary-section">
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
                        <td class="head-centre" style="text-align: center;"><span class="medium">4,000</span></td>
                        <td class="head-centre" style="text-align: center;"><span class="medium">150</span></td>
                        <td class="head-centre" style="text-align: center;"><span class="medium">5,000</span></td>
                        <td class="head-centre" style="text-align: center;"><span class="medium">250</span></td>

                        <td><span class="medium">-5000</span></td>


                    </tr>
                </tbody>

            </table>



        </div>
		<div class="finance-summary">



        <div class="user-order-con">


            <span class="order-admin-id" href="">ID: <?php echo $order_details['transactions']->transaction_id; ?></span>


    </div>

    <table>
      <tr>
	<td valign="top">
                <p class="order-para">
                    <label class="order-label">Date of Booking: </label>
                    <span class="order-user-text">&nbsp;<?php echo date('Y/m/d', strtotime($order_details['transactions']->booking_date)); ?></span>
                </p>

                <p class="order-para">
                    <label class="order-label">Time of Booking: </label>
                    <span class="order-user-text">&nbsp;<?php
                        $booking_timing = date('h:i A', strtotime($order_details['transactions']->booking_date));
                        echo $booking_timing;
                        ?> </span>
                </p>
      </tr>
    </table>
        <div class="order-history">
            <div class="panel panel-warning">  
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;&nbsp;History</h3>
                </div>
                <div id="" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="order-box">
                            <h4 class="medium history" style="text-align: left;">&nbsp;&nbsp;Treatment</h4>
                            <p class="box-para">
                                <label class="book-label table-label">Name:</label>
                                <span class="order-text table-text"><?php echo $order_details['transactions']->services; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Date:</label>
                                <span class="order-text table-text"><?php echo date('Y/m/d', strtotime($order_details['transactions']->date)); ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Time:</label>
                                <span class="order-text table-text"><?php
                                    $slot_timing = date('h:i A', strtotime($order_details['transactions']->start_time));
                                    echo $slot_timing;
                                    ?><span class="hours"><?php
                                   date_default_timezone_set('Asia/Calcutta');
                                   $current_time = strtotime(date('Y-m-d H:i'));
                                    $slot_time = strtotime($order_details['transactions']->date . '' . date("g:i", strtotime($order_details['transactions']->start_time)));
                                    $time_difference = abs($slot_time - $current_time);
                                    $time = floor($time_difference / 3600);
                                    if (isset($order_details['mark_attend']->status)) {
                                        if ($slot_time > $current_time && $order_details['mark_attend']->status != 'Attended') {
                                            echo $time;
                                            ?> Hrs left <?php
                                            }
                                        }
                                        ?></span></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Duration:</label>
                                <span class="order-text table-text"><?php
                                    echo $order_details['transactions']->duration;
                                    ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Amount:</label>
                                <span class="order-text table-text"><?php echo $order_details['transactions']->amount; ?></span>
                            </p>

                        </div>


                        <div class="order-box order-box1">
                            <h4 class="medium history">&nbsp;&nbsp;Vendor</h4>
                            <p class="box-para">
                                <label class="book-label table-label">Name:</label>
                                <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $order_details['vendor_details']->name; ?></a></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Location:</label>
                                <span class="order-text table-text"><?php echo $order_details['vendor_details']->area_name; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Phone No.:</label>
                                <span class="order-text table-text"><?php echo $order_details['vendor_details']->phone; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Email ID:</label>
                                <span class="order-text table-text"><a href="mailto:" class="blue vendor-text"><?php echo $order_details['vendor_details']->email; ?></a></span>
                            </p>


                        </div>



                        <div class="order-box order-box1">
                            <h4 class="medium history">&nbsp;&nbsp;Customer</h4>
                            <p class="box-para">
                                <label class="book-label table-label">Customer ID:</label>
                                <span class="order-text table-text"><?php echo $order_details['user_details']->id; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Name:</label>
                                <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $order_details['user_details']->name; ?></a></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Phone No.:</label>
                                <span class="order-text table-text"><?php echo $order_details['user_details']->phone; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Email ID:</label>
                                <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $order_details['user_details']->username; ?></a></span>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
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

    <div class="finance-summary">



        <div class="user-order-con">


            <span class="order-admin-id" href="">ID: <?php echo $order_details['transactions']->transaction_id; ?></span>


        </div>

        <div class="user-order">
            <div class="order-inner">
                <p class="order-para">
                    <label class="order-label">Date of Booking: </label>
                    <span class="order-user-text">&nbsp;<?php echo date('Y/m/d', strtotime($order_details['transactions']->booking_date)); ?></span>
                </p>

                <p class="order-para">
                    <label class="order-label">Time of Booking: </label>
                    <span class="order-user-text">&nbsp;<?php
                        $booking_timing = date('h:i A', strtotime($order_details['transactions']->booking_date));
                        echo $booking_timing;
                        ?> </span>
                </p>
            </div>



        </div>


        <div class="order-history">
            <div class="panel panel-warning">  

                <div class="panel-heading">
                    <h3 class="panel-title"> 
                        <a data-toggle="collapse" data-parent="#accordion" href="#accordionThree" class="history medium">
                            History
                            <i class="fa fa-angle-down title-arrow"></i>
                        </a>
                    </h3>
                </div>

                <div id="accordionThree" class="panel-collapse collapse">
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="order-box">
                            <h4 class="medium history">Treatment</h4>
                            <p class="box-para">
                                <label class="book-label table-label">Name:</label>
                                <span class="order-text table-text"><?php echo $order_details['transactions']->services; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Date:</label>
                                <span class="order-text table-text"><?php echo date('Y/m/d', strtotime($order_details['transactions']->date)); ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Time:</label>
                                <span class="order-text table-text"><?php
                                    $slot_timing = date('h:i A', strtotime($order_details['transactions']->start_time));
                                    echo $slot_timing;
                                    ?><span class="hours"><?php
                                   date_default_timezone_set('Asia/Calcutta');
                                   $current_time = strtotime(date('Y-m-d H:i'));
                                    $slot_time = strtotime($order_details['transactions']->date . '' . date("g:i", strtotime($order_details['transactions']->start_time)));
                                    $time_difference = abs($slot_time - $current_time);
                                    $time = floor($time_difference / 3600);
                                    if (isset($order_details['mark_attend']->status)) {
                                        if ($slot_time > $current_time && $order_details['mark_attend']->status != 'Attended') {
                                            echo $time;
                                            ?> Hrs left <?php
                                            }
                                        }
                                        ?></span></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Duration:</label>
                                <span class="order-text table-text"><?php
                                    echo $order_details['transactions']->duration;
                                    ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Amount:</label>
                                <span class="order-text table-text">&#x20B9;<?php echo $order_details['transactions']->amount; ?></span>
                            </p>

                        </div>


                        <div class="order-box order-box1">
                            <h4 class="medium history">Vendor</h4>
                            <p class="box-para">
                                <label class="book-label table-label">Name:</label>
                                <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $order_details['vendor_details']->name; ?></a></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Location:</label>
                                <span class="order-text table-text"><?php echo $order_details['vendor_details']->area_name; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Phone No.:</label>
                                <span class="order-text table-text"><?php echo $order_details['vendor_details']->phone; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Email ID:</label>
                                <span class="order-text table-text"><a href="mailto:" class="blue vendor-text"><?php echo $order_details['vendor_details']->email; ?></a></span>
                            </p>


                        </div>



                        <div class="order-box order-box1">
                            <h4 class="medium history">Customer</h4>
                            <p class="box-para">
                                <label class="book-label table-label">Customer ID:</label>
                                <span class="order-text table-text"><?php echo $order_details['user_details']->id; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Name:</label>
                                <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $order_details['user_details']->name; ?></a></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Phone No.:</label>
                                <span class="order-text table-text"><?php echo $order_details['user_details']->phone; ?></span>
                            </p>
                            <p class="book-para">
                                <label class="book-label table-label">Email ID:</label>
                                <span class="order-text table-text"><a href="" class="blue vendor-text"><?php echo $order_details['user_details']->username; ?></a></span>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


