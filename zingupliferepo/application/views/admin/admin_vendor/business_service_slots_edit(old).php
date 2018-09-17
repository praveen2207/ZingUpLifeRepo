<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Service Slots</h3>
</div>
<div class="row-fluid tr-row">
    
      <?php
    $error_message = $this->session->flashdata('service_slot_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>  

    
    <form class="form-horizontal for user-detail-row1 partner1 infob1 bsr-slots" id="admin_vendor_service_slot_edit_form" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/update_business_services_slots">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3"> 
                    <input type="hidden" id ="service_id" name="service_id" size="5" value ="<?php if(!empty($services['details'])){ echo $services['details']->id; } ?>" readonly/>
                     <input type="hidden" name="key_id" value="<?php echo $key_id; ?>" />
                    <label class="control-label" for="e-name">Service name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="service_name" value ="<?php if(!empty($services['details'])){ echo $services['details']->services;} ?>" readonly>

                    </div> 
                </div> 
                <div class="edit-group3 slot_edit_dates">          

                    <label class="control-label" for="e-name">Select date</label>  
                    <div class="customer-edit-input">
                        <select id="slots-date" multiple="true" name="slots_date[]" class="required p-select valid slots_date">
                            <?php
                            if(!empty($services['slots'])){
                            foreach ($services['slots'] as $keys => $values) {
                                $slot_array[] = $values->date;
                                $unique_dates_array = array_unique($slot_array);
                            }
                            foreach ($unique_dates_array as $key => $value) {
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
                            <?php } }?>
                        </select>
<div class="error_slot_date" style="display:none; color:red;">This Field is required</div>  
                    </div> 
                </div>



                <div class="edit-group3"> 

                    <label class="control-label" for="e-name">Select time</label>  
                    <div class="customer-edit-input">
                        <div id="start-date-end-date11">
                            <select id="select01"  name="slots_time" class="required p-select valid">
                                <option value="">Please Select Timings</option>
                                <?php
                                if(!empty($services['slots'])){
                                foreach ($services['slots'] as $keys => $values) {
                                    $slots_array[] = (date('H:i', (strtotime($values->start_time)))) . '-' . (date('H:i', (strtotime($values->end_time))));
                                    $unique_slots_array = array_unique($slots_array);
                                }

                                foreach ($unique_slots_array as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
                                <?php }} ?>
                            </select>   
                        </div>
                    </div> 
                </div> 
                <div class="edit-group3"> 
             <label class="control-label" for="e-name"></label> 

                    <div class="customer-edit-input">
                        <div id="start-date-end-date11">
                            <div class="add-time-block">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" for="e-name">Start time</label> 
                                        <article>
                                            <div class="date-pic">                
                                                <input id="start-time" type="text" class="time slot_start_time"  name="new_start_time" />
                                            </div>
                                        </article> 
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" for="e-name">End time</label>
                                        <article>
                                            <div class="date-pic">                
                                                <input id="end-time" type="text" class="time slot_end_time"  name="new_end_time" />
                                            </div>
                                        </article> 
                                    </div>  
                                </div>
<div class="error_start_less_end" style="display:none; color:red;">Start time should not be greater than end time</div>  
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="edit-group3"> 

                    <label class="control-label" for="e-name">Number Of Slots</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="number_of_slots" value ="10">

                    </div> 
                </div>
                <div class="edit-group3"> 

                    <label class="control-label" for="e-name">Slots Status</label>  
                    <div class="customer-edit-input">
                        <select id="select01"  name="slots_status" class="required p-select valid">
                            <option value="">Please Select Status</option>
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
