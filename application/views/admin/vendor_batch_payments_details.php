<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Batch Payment Details</h3>
</div>

<div class="row-fluid tr-row">
    <div class="summary-section">
        <table class="display" id="detail-table" cellspacing="0" width="100%" >
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

    <div class="detail-section batch-section">
        <p class="d-para">
            <span class="pay-para">Batch payment Details of Dates from <?php echo date('d M Y',strtotime($end_date));?> to <?php echo date('d M Y',strtotime($start_date));?> </span>
        </p>	

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
            <tbody>
                <?php
                if (!empty($vendor_details['transactions'])) {
                    foreach ($vendor_details['transactions'] as $key => $value) {
                        ?>
                        <tr>
                            <td class="blue"><?php echo $value->booking_id; ?></td>
                            <td><?php echo date('Y/m/d', strtotime($value->booking_date)); ?><br/>
                                <?php
                                $booking_timing = date('H:i', strtotime($value->booking_date));
                                if ($booking_timing >= 12) {
                                    $meridian = 'PM';
                                } else {
                                    $meridian = 'AM';
                                }
                                echo $booking_timing, ' ' . $meridian;
                                ?> 
                            </td>
                            <td class="blue"><?php echo $value->user_details->id; ?></td>
                            <td class="blue word_break_down"><?php echo $value->user_details->name; ?></td>
                            <td><span class="blue v-name"><?php echo $value->services; ?></span><br/><?php
                                if ($value->duration > 1) {
                                    $hour = 'hours';
                                } else {
                                    $hour = 'hour';
                                }
                                echo $value->duration;
                                ?></td>

                            <td><?php echo date('Y/m/d', strtotime($value->date)); ?><br/>
                                <?php
                                $slot_timing = date('H:i', strtotime($value->start_time));
                                if ($slot_timing >= 12) {
                                    $meridian = 'PM';
                                } else {
                                    $meridian = 'AM';
                                }
                                echo $slot_timing, ' ' . $meridian;
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
