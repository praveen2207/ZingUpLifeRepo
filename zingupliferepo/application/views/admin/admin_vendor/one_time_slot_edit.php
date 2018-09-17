<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit Business Service one time Slot</h3>
</div>
<div class="row-fluid tr-row">
      
     <?php
    $error_message = $this->session->flashdata('one_time_slot_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?> 

    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="admin_one_time_slot_edit_form" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/update_one_time_slots">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3"> 

                    <input type="hidden" id ="service_slot_id" name="service_slot_id" size="5" value ="<?php echo $slot_id; ?>" readonly/>
                   <input type="hidden" id ="service_id" name="service_id" size="5" value ="<?php echo $services['details']->id; ?>" readonly/>
                    <label class="control-label" for="e-name">Service name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" readonly name="service_name" value="<?php
                        if(!empty($services['details'])) {
                            echo $services['details']->services;
                        }
                        ?>">
                     
                    </div> 
                </div> 
               

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Select Date</label>  
                    <div class="customer-edit-input">
                       <input type="date" id="slots-date-picker" class="input input-xxlarge required e-input valid one_slot_date" name="one_time_date" value="<?php echo $services['slots'][0]->date; ?>"> 
        <div class="error_slot_date" style="display:none; color:red;">This Field is required</div>               
                    </div> 
                </div>
                
               <div class="edit-group3">          

                    <label class="control-label" for="e-name">Select Time</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="one_time_timing" class="required p-select valid">  
                            <option value="">Please select timings</option>
                             <?php
                                        foreach ($services['slots'] as $keys => $values) {
                                            $slots_array[] = (date('H:i', (strtotime($values->start_time)))) . '-' . (date('H:i', (strtotime($values->end_time))));
                                            $unique_slots_array = array_unique($slots_array);
                                        }

                                        foreach ($unique_slots_array as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
                                        <?php } ?>
                        </select> 
<br style="clear:both;">
<div class="one_time_slot_start_time"> 
                      <p>Start time:</p>
                      <input type="text" class="time slot_start_time" name="one_time_start_time">
<div class="error_one_time_start_time" style="display:none; color:red;">This field is required</div>
</div>
<div class="one_time_slot_start_time"> 
                      <p>End time:</p>
                       <input type="text" class="time slot_end_time" name="one_time_end_time"> 
<div class="error_one_time_end_time" style="display:none; color:red;">This field is required</div>
</div>
<div class="error_start_less_end" style="display:none; color:red;">Start time can not be greater then end time</div>
                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Number of Slots</label>  
                    <div class="customer-edit-input">
                       <input type="text" class="input input-xxlarge required e-input valid" name="no_of_slots" value="10"> 
                    </div> 
                </div>
                 <div class="edit-group3">          

                    <label class="control-label" for="e-name">Slots status</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="slots_status" class="required p-select valid">  
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>    
                    </div> 
                </div>
                                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
                </div> 
        </fieldset>
    </form>

</div>
