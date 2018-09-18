<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Services</h3>
</div>
<div class="row-fluid tr-row">
    <div class="" >
      
                        <?php if ($services['details']->service_type == 'monthly') { ?>
                            <div class="add_new"><a href="<?php echo base_url(); ?>admin/offerings_memberships/<?php echo $services['details']->id; ?>" class="button new-button">Add Membership</a></div>
                        <?php } elseif ($services['details']->service_type == 'one_time' && count($services['slots']) == 0) { ?>
                            <div class="add_new"><a href="<?php echo base_url(); ?>admin/business_service_add_slot/<?php echo $services['details']->id; ?>" class="button new-button">Add One Time Slot</a></div>
                        <?php } elseif ($services['details']->service_type == 'hourly') { ?>
                            <div class="add_new"><a href="<?php echo base_url(); ?>admin/business_service_slots/<?php echo $business_id; ?>" class="button new-button">Add Business Hours</a></div>
                            <?php
                        } else {
                            
                        }
                        ?>
     <?php
    $error_message = $this->session->flashdata('service_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?> 

    <form class="form-horizontal for user-detail-row1 partner1 infob1" name="service" id="admin_vendor_business_service_edit_form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/updating_business_services">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3"> 

                    <input type="hidden" id = "service_id" name="service_id" size="5" value ="<?php echo $service_id; ?>"  />
                    <label class="control-label" for="e-name">Service name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="service_name" value="<?php
                        if (!empty($services['details'])) {
                            echo $services['details']->services;
                        }
                        ?>">
                     <?php echo form_error('service_name'); ?>
                    </div> 
                </div> 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration</label>  
                    <div class="customer-edit-input">
                    <?php $duartion = explode(':', $services['details']->duration); ?>
                     <div class="service_duration_hrs">
                      <p>Hours:</p>
                      <select name="hours">
                                        <option value="">Select</option>
                                            <option value="0" <?php if ($duartion[0] == '0') { ?>selected<?php } ?>>0</option>
                                        <option value="1" <?php if ($duartion[0] == '1') { ?>selected<?php } ?>>1</option>
                                        <option value="2" <?php if ($duartion[0] == '2') { ?>selected<?php } ?>>2</option>
                                        <option value="3" <?php if ($duartion[0] == '3') { ?>selected<?php } ?>>3</option>
                                        <option value="4" <?php if ($duartion[0] == '4') { ?>selected<?php } ?>>4</option>
                                        <option value="5" <?php if ($duartion[0] == '5') { ?>selected<?php } ?>>5</option>
                                        <option value="6" <?php if ($duartion[0] == '6') { ?>selected<?php } ?>>6</option>
                                        <option value="7" <?php if ($duartion[0] == '7') { ?>selected<?php } ?>>7</option>
                                        <option value="8" <?php if ($duartion[0] == '8') { ?>selected<?php } ?>>8</option>
                                        <option value="9" <?php if ($duartion[0] == '9') { ?>selected<?php } ?>>9</option>
                                        <option value="10" <?php if ($duartion[0] == '10') { ?>selected<?php } ?>>10</option>
                                        <option value="11" <?php if ($duartion[0] == '11') { ?>selected<?php } ?>>11</option>
                                        <option value="12" <?php if ($duartion[0] == '12') { ?>selected<?php } ?>>12</option>
                                    </select>
                         <?php echo form_error('hours'); ?>
                         </div>
                         <div class="service_duration_hrs">
                      <p>Minutes:</p>
                      <select name="minutes">
                                        <option value="">Select</option>
                                        <option value="00" <?php if ($duartion[1] == '00') { ?>selected<?php } ?>>00</option>
                                        <option value="05" <?php if ($duartion[1] == '05') { ?>selected<?php } ?>>05</option>
                                        <option value="10" <?php if ($duartion[1] == '10') { ?>selected<?php } ?>>10</option>
                                        <option value="15" <?php if ($duartion[1] == '15') { ?>selected<?php } ?>>15</option>
                                        <option value="20" <?php if ($duartion[1] == '20') { ?>selected<?php } ?>>20</option>
                                        <option value="25" <?php if ($duartion[1] == '25') { ?>selected<?php } ?>>25</option>
                                        <option value="30" <?php if ($duartion[1] == '30') { ?>selected<?php } ?>>30</option>
                                        <option value="35" <?php if ($duartion[1] == '35') { ?>selected<?php } ?>>35</option>
                                        <option value="40" <?php if ($duartion[1] == '40') { ?>selected<?php } ?>>40</option>
                                        <option value="45" <?php if ($duartion[1] == '45') { ?>selected<?php } ?>>45</option>
                                        <option value="50" <?php if ($duartion[1] == '50') { ?>selected<?php } ?>>50</option>
                                        <option value="55" <?php if ($duartion[1] == '55') { ?>selected<?php } ?>>55</option>
                                    </select>   
                        <?php echo form_error('minutes'); ?>
                        </div>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Price</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="price" value="<?php
                        if (!empty($services['details'])) {
                            echo $services['details']->price;
                        }
                        ?>">
                  <?php echo form_error('price'); ?>
                    </div> 
                </div>
  <div class="edit-group3">          

                    <label class="control-label" for="e-name">Discount (For discount in % give discount value with percent symbol(ex: 2%))</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid service_discount" name="discount" value="<?php echo $services['details']->discount; ?>">

                       <div class="error_service_discount" style="display:none; color:red;">Discount value should contains only numbers and % </div>
                    </div> 
                </div>
<div class="edit-group3">          

                    <label class="control-label" for="e-name">Discount Duration</label>  
                    <div class="customer-edit-input">
                         <div class="service_discount_date">
                      <p>Start date:</p>
                      <input type="text" class="input input-xxlarge required e-input valid service_discount_start_date" name="discount_start_date" id="slots-date-picker1" value="<?php echo $services['details']->discount_start_date; ?>"/>
                                    <div class="error_start_date_greater" style="display:none; color:red;">Start date should not be greater than end date</div>
                                  <div class="error_start_date" style="display:none; color:red;">Start date is required</div>
</div>
<div class="service_discount_date">      
               <p> End date:</p>
                     <input type="text" class="input input-xxlarge required e-input valid service_discount_end_date" name="discount_end_date" id="slots-date-picker2" value="<?php echo $services['details']->discount_end_date; ?>">
                                 <div class="error_end_date_less" style="display:none; color:red;">End date should not be less than start date</div>
                                  <div class="error_end_date" style="display:none; color:red;">End date is required</div> 
</div>
                    </div> 
                </div>

               <div class="edit-group3">          

                    <label class="control-label" for="e-name">Booking Type</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_type" class="required p-select valid">  
                            <option value="">Select</option>
                            <option value="hourly" <?php if($services['details']->service_type == 'hourly') { ?> selected <?php } ?>>Hourly</option>
                            <option value="monthly" <?php if($services['details']->service_type == 'monthly') { ?> selected <?php } ?>>Monthly</option>
                            <option value="one_time" <?php if($services['details']->service_type == 'one_time') { ?> selected <?php } ?>>One time</option>
                        </select>    
                        <?php echo form_error('service_type'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                        <textarea name="description" id="cs_service_description"><?php
                        if (!empty($services['details'])) {
                            echo $services['details']->description;
                        }
                        ?></textarea>
                    </div> 
                </div>
                
                <div class="edit-group3">          
                     <?php if ($services['details']->service_type == 'hourly') { ?>
                    <label class="control-label" for="e-name">Business Hours</label>  
                    <div class="customer-edit-input">
                        <table id="example" class="display" cellspacing="0" width="100%" >
                            <thead>
                                <tr>
                                    <th class="filter-input">Days</th>
                                    <th class="filter-input">Slots</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="backend_user">
                                <?php
                                if (!empty($services['slots'])) {
                                    foreach ($services['slots'] as $key => $value) {
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
                                                <td clas="blue"><?php echo $day; ?></td> 
                                                <td clas="blue"><?php echo $slots; ?></td> 
                                                <td clas="blue">
                                                    <ul class="backend-actions">
                                                        <li><a class="blue" href="<?php echo base_url(); ?>admin/service_slots_edit/<?php echo $services['details']->id . '_' . $key; ?>">Edit</a></li>
                                                        <li>|</li>
                                                        <li><a href="" class="blue service_slots_delete" id="<?php echo $ids; ?>" >Delete</a></li>
                                                    </ul> 

                                            </tr>
            <?php
        }
    }
  
}
else{
?>
<td valign="top" class="" colspan="3" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
          
<?php } ?>
                            </tbody>
                        </table>

                    </div> 
                    <?php } elseif ($services['details']->service_type == 'one_time') { ?>
                        <label class="control-label" for="e-name">One Time Slot</label>  
                    <div class="customer-edit-input">
                        <table id="example" class="display" cellspacing="0" width="100%" >
                            <thead>
                                <tr>
                                    <th class="filter-input">Date</th>
                                    <th class="filter-input">Slots</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="backend_user">
                                <?php
                                if (!empty($services['slots'])) {
                                    foreach ($services['slots'] as $key => $value) {
                                    	//  echo "<pre>";print_r($value);exit();
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
                                                <td clas="blue"><?php echo $values->date; ?></td> 
                                                <td clas="blue"><?php echo $slots; ?></td> 
                                                <td clas="blue">
                                                    <ul class="backend-actions">
                                                        <li><a class="blue" href="<?php echo base_url(); ?>admin/one_time_service_slots_edit/<?php echo $services['details']->id . '_' . $values->id; ?>">Edit</a></li>
                                                        <li>|</li>
                                                        <li><a href="" class="blue" id="one_time_service_slots_delete" slot_id="<?php echo $values->id; ?>" >Delete</a></li>
                                                    </ul> 

                                            </tr>
            <?php
        }
    }
  
}
else{
?>
<td valign="top" class="" colspan="3" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
          
<?php } ?>
                            </tbody>
                        </table>

                    </div>                 
                    
                    <?php } else {  ?>
                    
                     <label class="control-label" for="e-name">Memberships</label>  
                    <div class="customer-edit-input">
                        <table id="example" class="display" cellspacing="0" width="100%" >
                            <thead>
                                <tr>
                                    <th class="filter-input">Membership</th>
                                    <th class="filter-input">Duration</th>
                                    <th class="filter-input">Price</th>
                                    <th class="filter-input">Number Of Members</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="backend_user">
                                <?php
                                if (!empty($services['memberships'])) {
                                     foreach ($services['memberships'] as $key => $value) {
                                            ?>
                                            <tr>
                                                <td clas="blue"><?php echo $value->membership; ?></td> 
                                                <td clas="blue"><?php echo $value->duration; ?></td> 
                                                <td clas="blue"><?php echo $value->fees; ?></td> 
                                                <td clas="blue"><?php echo $value->max_number_of_members; ?></td> 
                                                <td clas="blue">
                                                    <ul class="backend-actions">
                                                        <li><a class="blue" href="<?php echo base_url(); ?>admin/edit_offerings_memberships/<?php echo $value->id; ?>">Edit</a></li>
                                                        <li>|</li>
                                                        <li><a href="" class="blue" id="membership_delete" member_id="<?php echo $value->id; ?>" >Delete</a></li>
                                                    </ul> 

                                            </tr>
            <?php
        }
    }
  

else{
?>
<td valign="top" class="" colspan="5" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
          
<?php } ?>
                            </tbody>
                        </table>

                    </div>  
                     <?php } ?>
                </div>
                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
                </div> 
        </fieldset>
    </form>

</div>

<script>
    var base_url = "<?php echo base_url(); ?>";
    $('body').on('click', '.service_slots_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these slots!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/service_slots_delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    location.reload();

                }
            });
        }
        return false;


    });

</script>
