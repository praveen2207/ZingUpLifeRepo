
<input type="hidden" name="site_path" id="site_path" value="<?php echo base_url();?>"/>
<div class="location-header admin-header">
    <h4 class="redirect-head admin-head"><a class="blue" href="<?php echo base_url();?>admin/assessment/interpretation_users">Interpretation Queue</a> | <a class="blue" href="<?php echo base_url();?>admin/assessment/consultation_users">Consultation Queue</a></h4>
</div>
<div class="row-fluid tr-row">
    <div style="float:right;">Total Users: <?php echo count($all_customers);?></div>
<!--    <div class="filter-section cus-filter">
        <label class="filter-label">Filter:</label>
            <div style="float:left;">
                <input class="first-in cus-id" type="text" name="" id="" placeholder="Customer ID" />
                <div class="form-error1 filter-error">
                    <label class="error">Enter numbers only</label>
                </div>
            </div>
            <div style="float:left;">
                <input type="text" name="" id="" placeholder="Customer Name"/>
                    <div class="form-error1 filter-error">
                        <label class="error">Special characters not allowed</label>
                    </div>
            </div>
            <div style="float:left;">
                <input class="first-in ph" type="text" name="" id="" placeholder="Phone No" />
                <div class="form-error filter-error">
                    <label class="error">Enter numbers only</label>
                </div>
                <div class="form-error1 filter-error">
                    <label class="error">Enter 10 numbers only</label>
                </div>
            </div>
            <div style="float:left;">
                <input type="text" name="" id="" placeholder="Customer Email ID" class='email' />
            </div>
    </div>-->
<div class='customer-table'>
    <table id="example1" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">User ID</th>
                <th class="filter-input">Name</th>
                <th>Email Id</th>
                <th class="filter-input">Gender</th>
                <th class="">Contact #</th>
                <th>Assessment Date</th>
                <th>Appointment<br> Booked</th>
                <th>GP's Notes</th>
                <th>Consultation<br> Status</th>
            </tr>
        </thead>
        <tbody id="cs_customers_filter">
            <?php foreach ($all_customers as $key => $value) { ?>
                <tr>
                    <td class="blue"><?php echo $value->user_id; ?></td>
                    <td class="blue word_break word_break_down"><a class="blue mail-id" href="<?php echo base_url(); ?>customer_support/customer_details/<?php echo $value->user_id; ?>"><?php echo $value->name; ?></a></td>
                    <td class="blue word_break word_break_down"><?php echo $value->username; ?></td>
                    <td><?php echo $value->gender; ?></td>
                    <td>
                        <?php
                        if ($value->phone == '') {
                            $phone = '-';
                        } else {
                            $phone = '+91 ' . $value->phone;
                        }
                        echo $phone;
                        ?>
                    </td>
                    <td class="blue"><?php echo date('d/m/Y', strtotime($value->survey_end_date)); ?></td>
                    <td class="blue word_break word_break_down center"><?php echo date('d/m/Y', strtotime($value->date)); ?> <br><?php echo $value->time_from; ?> - <?php echo $value->time_to; ?></td>
                    <td class="blue ellipse word_break"><?php echo $value->sme_notes;?></td>
                    <td class="blue ellipse word_break"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
