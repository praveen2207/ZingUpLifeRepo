<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Offerings</h3>
    <a href="<?php echo base_url(); ?>admin/add_new_offerings/<?php echo $id; ?>" class="new-user">Add New Offerings</a>
</div>

<div class="row-fluid tr-row" id="message_display">
    <div class="message" id="deleting_message">
        <h3 class="congratulations message-head">Congratulations !!!</h3>
        <p class="para-small for-para" id="delete_message1">Successfully deleted!!!</p>
    </div>
    <?php
    $success_message = $this->session->flashdata('success_message');
    if (isset($success_message)) {
        ?>
        <div class="message">
            <h3 class="congratulations message-head">Congratulations !!!</h3>
            <p class="para-small for-para" id="delete_message1"><?php echo $success_message; ?></p>
        </div>
    <?php } ?>
    <div class="filter-section filter-section1 admin_offering_filter">
        <p class="filter-para" style="float:left;">
            <label class="filter-label">Filter Info:</label>
        <div style="float:left;">
            <input type="text" name="" id="" placeholder="Offering" class='offering_name' />

            <div class="form-error1 filter-error">
                <label class="error">Special characters not allowed</label>
            </div>
        </div>
    </div>
    <div class='table-data'>
        <table id="vendor-table3" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="offering_name">Offerings</th>
                    <th class="">Program</th>
                    <th class="">Service Type</th>
                    <th class="">Duration</th>
<!--                    <th class="">Price</th>-->
                    <th class="">Gallery</th>
                    <th class="">Business Hours</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class='searchcontent'>
                <?php foreach ($all_offerings as $key => $value) { ?>
                    <tr>
                        <td class="offering_name"><span class="blue v-name word_break_down">
                                <a class="blue mail-id" href="<?php echo base_url(); ?>admin/vendor_details/<?php echo $value->id; ?>"><?php echo $value->services; ?></a>
                            </span>
                        </td>
                        <td class=""><?php echo $value->program; ?></td>
                        <td class=""><?php
                            if ($value->service_type == 'monthly') {
                                $service_type = 'Monthly';
                            } elseif ($value->service_type == 'hourly') {
                                $service_type = 'Hourly';
                            } else {
                                $service_type = 'One Time';
                            }
                            echo $service_type;
                            ?></td>
                        <td class=""><?php echo $value->duration; ?>  Hr</td>
    <!--                        <td class="">&#8377;<?php echo $value->price; ?></td>-->
                        <td class="blue">
                            <a id="<?php echo $value->business_service_id; ?>" href="<?php echo base_url(); ?>admin/view_offerings_gallery/<?php echo $value->business_service_id; ?>" class="blue batch">View Gallery</a>
                        </td>
                        <td class="blue">
                            <a id="<?php echo $value->business_service_id; ?>" href="<?php echo base_url(); ?>admin/business_hours/<?php echo $value->business_service_id; ?>" class="blue batch">View Slots</a>
                        </td>
                        <td class="blue">
                            <a id="<?php echo $value->business_service_id; ?>" href="<?php echo base_url(); ?>admin/edit_offering/<?php echo $value->business_service_id; ?>" class="blue batch">Edit</a>
                            | <a id="<?php echo $value->business_service_id; ?>" href="<?php echo $value->business_service_id; ?>" class="blue batch delete_vendor_offering">Delete</a>
                        </td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>