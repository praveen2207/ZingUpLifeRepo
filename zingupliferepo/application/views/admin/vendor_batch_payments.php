<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Batch Payment</h3>
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
            <span class="detail-span">Batch Payments </span>
            <span class="blue detail-span">All Locations<i class="fa fa-angle-down loc-arrow"></i></span>
        </p>	

        <table id="vendor-table2" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="">No.</th>
                    <th class="">Period</th>
                    <th>Locations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $start = date('d M Y');
                for ($i = 1; $i <= 20; $i++) {
                    if ($i == 1) {
                        $start_date = date('d M Y', strtotime($start));
                    } else {
                        $start_date = $end_date;
                    }
                    $end_date = date('d M Y', strtotime("-7 day", strtotime($start_date)));
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $start_date; ?>  to  <?php echo $end_date; ?></td>
                        <td class=""><?php echo $vendor_details['vendor_details']->area_name; ?></td>
                        <td class="blue"><a href="<?php echo base_url(); ?>finance/payment_details/<?php echo $vendor_details['vendor_details']->id . '/' . date('Y-m-d', strtotime($start_date)) . '_' . date('Y-m-d', strtotime($end_date)); ?>" class="blue batch">View Payment</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>