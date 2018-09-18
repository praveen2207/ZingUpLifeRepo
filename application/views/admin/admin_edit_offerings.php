<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New Offering Service</h3>
</div>

<div class="row-fluid user-detail-row1 add_vendor_form">
    <?php
    $validate_email_error_message = $this->session->flashdata('validate_email_error_message');
    if (isset($validate_email_error_message)) {
        ?>
        <div class="message pr-message error_messages">
            <h3 class="congratulations message-head">Error !!!</h3>
            <p class="para-small for-para"><?php echo $validate_email_error_message; ?></p>
        </div>
    <?php } ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/update_offering" method="post">  
        <fieldset>
            <input type="hidden" class="" name="service_id" value="<?php echo $id; ?>"> 
            <input type="hidden" class="" name="vendor_id" value="<?php echo $vendor_id; ?>"> 
            <div class="clear">
                <div class="edit-group3">  
                    <label class="control-label" for="select01">Packages/Treatments:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="program_id" class="required p-select valid">  
                            <option value="">Select Packages/Treatments</option>  
                            <?php foreach ($all_packages as $key => $value) { ?>
                                <option value="<?php echo $value->id; ?>" <?php if ($offering_details->program_id == $value->id) { ?>selected <?php } ?>><?php echo $value->program; ?></option>  
                            <?php } ?>
                        </select> 
                        <?php echo form_error('program_id'); ?>
                    </div>  
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Service:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="services" value="<?php echo $offering_details->services; ?>"> 
                        <?php echo form_error('services'); ?>
                    </div>
                </div> 

                <?php
                $duration = explode(':', $offering_details->duration);
                ?>
                <div class="edit-group3 business_hours_ctr">  
                    <label class="control-label" for="ename">Duration:</label>  
                    <div class="customer-edit-input2">
                        <div class="left-side left-side-ctr">
                            <div class="check-text">
                                <label class="control-label" for="ename">Hours:</label>  
                                <select class="" name="duration_hour">
                                    <option value="">Hours</option>
                                    <option value="0" <?php if ($duration[0] == '0') { ?>selected<?php } ?>>0</option>
                                    <option value="1" <?php if ($duration[0] == '1') { ?>selected<?php } ?>>1</option>
                                    <option value="2" <?php if ($duration[0] == '2') { ?>selected<?php } ?>>2</option>
                                    <option value="3" <?php if ($duration[0] == '3') { ?>selected<?php } ?>>3</option>
                                    <option value="4" <?php if ($duration[0] == '4') { ?>selected<?php } ?>>4</option>
                                    <option value="5" <?php if ($duration[0] == '5') { ?>selected<?php } ?>>5</option>
                                    <option value="6" <?php if ($duration[0] == '6') { ?>selected<?php } ?>>6</option>
                                    <option value="7" <?php if ($duration[0] == '7') { ?>selected<?php } ?>>7</option>
                                    <option value="8" <?php if ($duration[0] == '8') { ?>selected<?php } ?>>8</option>
                                    <option value="9" <?php if ($duration[0] == '9') { ?>selected<?php } ?>>8</option>
                                    <option value="10" <?php if ($duration[0] == '10') { ?>selected<?php } ?>>10</option>
                                    <option value="11" <?php if ($duration[0] == '11') { ?>selected<?php } ?>>11</option>
                                    <option value="12" <?php if ($duration[0] == '12') { ?>selected<?php } ?>>12</option>
                                </select>  
                                <?php echo form_error('duration_hour'); ?>
                            </div>
                            <div class="check-text">
                                <label class="control-label" for="ename">Minutes:</label>  
                                <select class="" name="duration_minutes">
                                    <option value="">Minutes</option>
                                    <option value="00" <?php if ($duration[1] == '00') { ?>selected<?php } ?>>00</option>
                                    <option value="05" <?php if ($duration[1] == '05') { ?>selected<?php } ?>>05</option>
                                    <option value="10" <?php if ($duration[1] == '10') { ?>selected<?php } ?>>10</option>
                                    <option value="15" <?php if ($duration[1] == '15') { ?>selected<?php } ?>>15</option>
                                    <option value="20" <?php if ($duration[1] == '20') { ?>selected<?php } ?>>20</option>
                                    <option value="25" <?php if ($duration[1] == '25') { ?>selected<?php } ?>>25</option>
                                    <option value="30" <?php if ($duration[1] == '30') { ?>selected<?php } ?>>30</option>
                                    <option value="35" <?php if ($duration[1] == '35') { ?>selected<?php } ?>>35</option>
                                    <option value="40" <?php if ($duration[1] == '40') { ?>selected<?php } ?>>40</option>
                                    <option value="45" <?php if ($duration[1] == '45') { ?>selected<?php } ?>>45</option>
                                    <option value="50" <?php if ($duration[1] == '50') { ?>selected<?php } ?>>50</option>
                                    <option value="55" <?php if ($duration[1] == '55') { ?>selected<?php } ?>>55</option>
                                </select> 
                                <?php echo form_error('duration_minutes'); ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Price:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="price" value="<?php echo $offering_details->price; ?>"> 
                        <?php echo form_error('price'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Service Type:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_type" class="required p-select valid">  
                            <option value="">Select Service Type</option>  
                            <option value="hourly" <?php if ($offering_details->service_type == 'hourly') { ?>selected <?php } ?>>Hourly</option>  
                            <option value="monthly" <?php if ($offering_details->service_type == 'monthly') { ?>selected <?php } ?>>Monthly</option>  
                            <option value="one_time" <?php if ($offering_details->service_type == 'one_time') { ?>selected <?php } ?>>One Time</option>  
                        </select> 
                        <?php echo form_error('service_type'); ?>
                    </div>  
                </div> 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                        <textarea name="description" value="" id="cs_description"><?php echo $offering_details->description; ?></textarea>
                    </div> 
                </div>
                <div class="customer-button-group customer-button-group1"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="">
                        <input type="submit" name="submit" id="submit" value="Save" class="primary-button">
                        <input type="reset" name="resit" value="Cancel" class="secondary-button cancel">
                    </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>