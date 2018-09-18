<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Vendor Detail</h3>
</div>

<div class="row-fluid vd-row">
    <div class="sorting-section">
        <a class="blue batch delete delete_vendor" id="admin_delete_vendor" vendor_id="<?php echo $vendor_details['vendor_details']->id; ?>" href="">Delete Vendor</a>
        <?php
        if ($vendor_details['vendor_details']->status == 'De-active') {
            $status = "Activate";
        } else {
            $status = "De-activate";
        }
        ?>
        <a class="blue batch activate_vendor download11" id="<?php echo $vendor_details['vendor_details']->id; ?>" href="" title="<?php echo $status;?>"><?php echo $status;?> Vendor</a>
        <form action='<?php echo base_url(); ?>customer_support/download' method='post' class='transform v-form' target="_blank">

            <input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
            <input type='hidden' name='trans' class='html' value=''/>      
        </form>
    </div>
    <div class='trans-tabledata' style='display:none;'>
        <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
            <thead>
                <tr>
                    <th class="filter-input">Order<br/> ID No.</th>
                    <th>Booked <br/>Date/Time</th>
                    <th class="filter-input">Customer<br/> ID No.</th>
                    <th class="filter-input">Customer<br/> Name</th>
                    <th>Vendor Name <br/>& Location</th>
                    <th>Treatment & <br/> Duration</th>
                    <th>Treatment<br/> Date/Time</th>
                    <th>Cost</th>
                </tr>
            </thead>

            <tbody id="vendor_transaction_table_filter">
                <?php
                if (!empty($vendor_details['transactions'])) {
                    foreach ($vendor_details['transactions'] as $key => $value) {
                        ?>
                        <tr id="<?php echo $value->user_id . '-' . $value->booking_id . '-' . $value->slot_id; ?>">
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
                            <td class="blue"><?php echo $value->user_details->user_id; ?></td>
                            <td class="blue"><?php echo $value->user_details->name; ?></td>
                            <td class=""><span class="blue v-name"><?php echo $vendor_details['vendor_details']->name; ?></span> <br/><?php echo $vendor_details['vendor_details']->area_name; ?></td>
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
    <table class="display" id="detail-table" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="">Vendor Name</th>
                <th>Locations</th>
                <th>Phone No.</th>
                <th>Email IDs</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="" rowspan="3"><span class="v-name1"><?php echo $vendor_details['vendor_details']->name; ?></span></td>
                <td class=""><?php echo $vendor_details['vendor_details']->area_name; ?></td>
                <td><?php echo $vendor_details['vendor_details']->phone; ?> <a href=""></a></td>
                <td class="blue" rowspan="3"><a class="blue mail-id" href="mailto:<?php echo $vendor_details['vendor_details']->email; ?>"><?php echo $vendor_details['vendor_details']->email; ?></a></td>
                <td><?php echo $vendor_details['vendor_details']->status; ?></td>
            </tr>
        </tbody>
    </table>

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
                    <textarea class="note-area admin_notes"><?php echo $vendor_details['vendor_details']->admin_notes; ?></textarea>
                    <a href=""><span class="edit-icon edit-icon2 edit-icon3 admin_notes_edit" id="<?php echo $vendor_id; ?>"></span></a>
                </div>
            </div>
        </div>
    </div>


    <div class="detail-section">
        <div class="sorting-section2 cdetail-section" id="admin_vendor_details_filter">
            <input type="hidden" value="<?php echo $vendor_details['vendor_details']->id; ?>" id="current_vendor_id"/>
            <p class="sorting-para">
                <span class="detail-span">Transactions of </span>
                <label class="select-label select-label1 blue">
                    <select class="services-dropdown services-dropdown1 filter_vendor_transaction_by_services">
                        <option value="">All Services</option>
                        <?php foreach ($services as $key => $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->service_name; ?></option>                                                    
                        <?php } ?>

                    </select>
                </label>
            </p>
            <p class="sorting-para">
                <span class="detail-span sort-span">showing on</span>
                <span class="blue  sorting-span">Date of Booking
<!--                <i class="fa fa-angle-down"></i>-->
                </span>
                <!--                <label class="select-label select-label2 blue">
                                    <select class="services-dropdown services-dropdown2">
                                        <option>Date of Booking</option>
                                        <option>All Services</option>
                                    </select>
                                </label>-->
            </p>
            <p class="sorting-para">
                <span class="detail-span">from</span>
                <span class="blue  sorting-span sort-span" id="startDate"><?php echo $start_date; ?></span>
                <i class="fa fa-angle-down date-arrow blue" id="dp12" data-date-format="yyyy/mm/dd" data-date="<?php echo $current_date; ?>"></i>
            </p>
            <p class="sorting-para spara1">
                <span class="detail-span">to</span>
                <span class="blue  sorting-span sort-span" id="endDate"><?php echo $end_date; ?></span>
                <i class="fa fa-angle-down date-arrow blue" id="dp13" data-date-format="yyyy/mm/dd" data-date="<?php echo $end_date; ?>"></i>
            </p>
        </div>

        <table id="example" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="filter-input">Order<br/> ID No.</th>
                    <th>Booked <br/>Date/Time</th>
                    <th class="filter-input">Customer<br/> ID No.</th>
                    <th class="filter-input">Customer<br/> Name</th>
                    <th style="width:80px;">Vendor Name <br/>& Location</th>
                    <th>Treatment & <br/> Duration</th>
                    <th>Treatment<br/> Date/Time</th>
                    <th>Cost(&#x20B9;)</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="admin_vendor_transaction_table_filter">
                <?php
                if (!empty($vendor_details['transactions'])) {
                    foreach ($vendor_details['transactions'] as $key => $value) {
                        ?>
                        <tr id="<?php echo $value->user_id . '-' . $value->booking_id . '-' . $value->slot_id; ?>">
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
                            <td class="blue"><?php echo $value->user_details->user_id; ?></td>
                            <td class="blue word_break_down"><?php echo $value->user_details->name; ?></td>
                            <td class=""><span class="blue v-name"><?php echo $vendor_details['vendor_details']->name; ?></span> <br/><?php echo $vendor_details['vendor_details']->area_name; ?></td>
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

                            <td><?php echo $value->amount; ?></td>
                            <td class="action-td"><?php
                                $current_date = date('Y-m-d');
                                if (strtotime($value->date) > strtotime($current_date)) {
                                    if ($value->booking_status == 'Pending') {
                                        ?><span class="blue medium actions confirmorder">Confirm Order</span> <?php
                                    } else {
                                        if (isset($value->mark_attend)) {
                                            if ($value->mark_attend == 'Not-attended') {
                                                ?><span class="blue medium actions admin_remind-customer">Remind Customer</span> <?php
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
                                                        ?><a id="<?php echo $value->user_id . '-' . $value->booking_id . '-' . $value->slot_id; ?>" class="blue admin_markattend" href="">Mark as Attended</a><?php } else { ?>Attended <?php
                                                    }
                                                }
                                            }
                                            ?></li>	
                                        <li><a id="<?php echo $value->user_id . '-' . $value->booking_id . '-' . $value->slot_id; ?>" class="blue" href=""><?php
                                                if (strtotime($value->date) > strtotime($current_date)) {
                                                    if ($value->booking_status == 'Pending') {
                                                        ?>Remind Customer<?php
                                                    }
                                                }
                                                ?></a></li>	
                                        <li><a id="<?php echo $value->user_id . '-' . $value->booking_id . '-' . $value->slot_id; ?>" class="green" href=""><?php
                                                if (strtotime($value->date) > strtotime($current_date)) {
                                                    if ($value->booking_status == 'Success') {
                                                        ?><i class="fa fa-check fa-confirm"></i>Confirmed <?php
                                                    }
                                                }
                                                ?></a></li>
                                        <li><a id="<?php echo $value->user_id . '-' . $value->booking_id . '-' . $value->slot_id; ?>"class="blue" href="<?php echo base_url(); ?>admin/order_details/<?php echo $value->booking_id; ?>">View Order Detail</a></li>
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

<script>
    var base_url = "<?php echo base_url(); ?>";
  $('body').on('click', '#admin_delete_vendor', function () {
        var vendor_id = $(this).attr('vendor_id');
       if (confirm("Are you sure you want to delete this Vendor") === true)
        {

        $.ajax({
            url: '' + base_url + 'admin/delete_vendor',
            type: 'POST',
            data: {vendor_id: vendor_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/vendors';
            }
        });
}
        return false;
    });

</script>

