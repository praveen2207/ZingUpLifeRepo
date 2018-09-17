<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit Business Service Memberships</h3>
</div>
<div class="row-fluid tr-row">
   

    <form class="form-horizontal for user-detail-row1 partner1 infob1" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/update_offerings_memberships">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3"> 
                  <input type="hidden" name="id" size="5" value ="<?php echo $membership->id; ?>" readonly />  
                   <input type="hidden" id ="service_id" name="service_id" size="5" value ="<?php echo $service_id; ?>" readonly/>
                    <label class="control-label" for="e-name">Service name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="service_name" value="<?php echo $services['details']->services; ?>" readonly>
                     
                    </div> 
                </div> 
               

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Membership Name</label>  
                    <div class="customer-edit-input">
                       <input type="text" class="input input-xxlarge required e-input valid" name="membership" value="<?php echo $membership->membership; ?>"> 
                       <?php echo form_error('membership'); ?>                   
                    </div> 
                </div>
               
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                      <textarea name="description" id="cs_service_description"><?php echo $membership->description; ?></textarea>  
                </div>
                </div> 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="duration" class="required p-select valid"> 
                        <option value="">Please Select</option>
                                    <option value="1 Day" <?php if ($membership->duration == '1 Day') { ?> selected <?php } ?>>1 Day</option>
                                    <option value="7 Days" <?php if ($membership->duration == '7 Days') { ?> selected <?php } ?>>7 Days</option>
                                    <option value="15 Days" <?php if ($membership->duration == '15 Days') { ?> selected <?php } ?>>15 Days</option>
                                    <option value="1 Month" <?php if ($membership->duration == '1 Month') { ?> selected <?php } ?>>1 Month</option>
                                    <option value="3 Months" <?php if ($membership->duration == '3 Months') { ?> selected <?php } ?>>3 Months</option>
                                    <option value="6 Months" <?php if ($membership->duration == '6 Months') { ?> selected <?php } ?>>6 Months</option>
                                    <option value="1 Year" <?php if ($membership->duration == '1 Year') { ?> selected <?php } ?>>1 Year</option> 
                          </select>                        
                        </div> 
                </div>
                <?php echo form_error('duration'); ?>
                  <div class="edit-group3">          

                    <label class="control-label" for="e-name">Price</label>  
                    <div class="customer-edit-input">
                       <input type="text" class="input input-xxlarge required e-input valid" name="fees" value="<?php echo $membership->fees; ?>"> 
                    </div> 
                </div>
                <?php echo form_error('fees'); ?>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Maximum Number Of Members</label>  
                    <div class="customer-edit-input">
                       <input type="text" class="input input-xxlarge required e-input valid" name="max_number_of_members" value="<?php echo $membership->max_number_of_members; ?>"> 
                    </div> 
                </div>
                <?php echo form_error('max_number_of_members'); ?>
                                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
                </div> 
        </fieldset>
    </form>

</div>

