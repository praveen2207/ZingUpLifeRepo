<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit One day package</h3>
</div>
<div class="row-fluid tr-row">
      
     <?php
    $error_message = $this->session->flashdata('one_day_pacakge_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?> 

    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="cs_vendor_one_day_pacakge_edit" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/update_one_day_packages">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3"> 

                   <input type="hidden" id ="package_id" name="package_id" size="5" value ="<?php echo $services[0]->id; ?>" readonly/>
                    <input type="hidden" id ="service_id" name="service_id" size="5" value ="<?php echo $services[0]->service_id; ?>" readonly/>
                   
                    <label class="control-label" for="e-name">Package name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="package_name" value="<?php
                        
                            echo $services['0']->name;
                       
                        ?>">
                     
                    </div> 
                </div> 
               

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                        <textarea name="description" id="cs_service_description"><?php
                        
                            echo $services['0']->description;
                       
                        ?></textarea> 
                    </div> 
                </div>
                
                     <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration</label>  
                    <div class="customer-edit-input">
                    <?php $duartion = explode(':', $services['0']->duration); ?>
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
                
                
                
                                                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
                </div> 
        </fieldset>
    </form>

</div>
