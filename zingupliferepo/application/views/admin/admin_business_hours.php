<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Business Hours</h3>
    <a href="<?php echo base_url(); ?>admin/add_business_hours/<?php echo $id; ?>" class="new-user">Add New Business Hours</a>
</div>

<div class="row-fluid tr-row">
    <div class='table-data'>
        <table id="vendor-table33" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="">Days</th>
                    <th class="offering_name">Slots</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class='searchcontent'>
                <?php
                foreach ($slots_details_array as $key => $value) {
                    if (!empty($value)) {
                        if ($key == '1') {
                            $day = 'Monday';
                        } elseif ($key == '2') {
                            $day = 'Tuesday';
                        } elseif ($key == '3') {
                            $day = 'Wednesday';
                        } elseif ($key == '4') {
                            $day = 'Thursday';
                        } elseif ($key == '5') {
                            $day = 'Friday';
                        } elseif ($key == '6') {
                            $day = 'Saturday';
                        } elseif ($key == '7') {
                            $day = 'Sunday';
                        }
                        $ids_array = array();
                        $slots_array = array();
                        foreach ($value as $keys => $values) {
                            $ids_array[] = $values->id;
                            $ids = implode(',', $ids_array);
                            $slots_array[] = (date('H:i', (strtotime($values->start_time)))) . ' - ' . (date('H:i', (strtotime($values->end_time))));
                            $unique_slots_array = array_unique($slots_array);
                            $slots = implode(', ', $unique_slots_array);
                        }
                        ?>
                        <tr>
                            <td class=""><span class="blue v-name word_break_down">
                                    <a class="blue mail-id" href=""><?php echo $day; ?></a>
                                </span>
                            </td>
                            <td class="offering_name word_break_down"><?php echo $slots; ?></td>
                            <td class="blue">
                                <a id="<?php echo $value->business_service_id; ?>" href="<?php echo base_url(); ?>admin/edit_offering/<?php echo $value->business_service_id; ?>" class="blue batch">Edit</a>
                                | <a id="<?php echo $value->business_service_id; ?>" href="<?php echo $value->business_service_id; ?>" class="blue batch delete_vendor_offering">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
