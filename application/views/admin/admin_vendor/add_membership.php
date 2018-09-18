<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add Memberships</h3>
</div>
<div class="row-fluid tr-row">
    

    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="cs_vendor_add_one_day_pack" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/create_offerings_memberships">  
            
                <div class="clear"></div>       
        <fieldset>
            
                <div class="edit-group3"> 
                    <input type="hidden" name="service_id" value="<?php echo $service_details['details']->id; ?>" readonly="readonly">
                    <label class="control-label" for="e-name">business service</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="service_name" value="<?php echo $service_details['details']->services; ?>" readonly="readonly">

                      <?php echo form_error('service_name'); ?>                                                 
                    </div> 
                </div>  
               
               
                <div class="edit-group3 new_ctr">          

                    <label class="control-label" for="e-name">Membership Name</label>  
                    <div class="customer-edit-input">
                       <input type="text" class="input input-xxlarge  e-input valid" name="membership">
                       <?php echo form_error('membership'); ?>
                    </div> 
                </div>
                 <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                       <textarea class="one_day_pack_description" name="description"></textarea> 
                       
                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration</label>  
                    <div class="customer-edit-input">
                        <select name="duration" value="">
                                    <option value="">Please Select</option>
                                    <option value="1 Day">1 Day</option>
                                    <option value="7 Days">7 Days</option>
                                    <option value="15 Days">15 Days</option>
                                    <option value="1 Month">1 Month</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="1 Year">1 Year</option>
                                </select> 
                         <?php echo form_error('duration'); ?>
                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Price</label>  
                    <div class="customer-edit-input">
                      <input type="text" class="input input-xxlarge  e-input valid" name="fees">  
                       <?php echo form_error('fees'); ?>
                    </div> 
                </div>
            
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Maximum Number Of Members</label>  
                    <div class="customer-edit-input">
                      <input type="text" class="input input-xxlarge  e-input valid" name="max_number_of_members">
                       <?php echo form_error('max_number_of_members'); ?>
                    </div> 
                </div>
        </fieldset>
      
                                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save" class="primary-button">
                </div> 
    </form>

</div>


