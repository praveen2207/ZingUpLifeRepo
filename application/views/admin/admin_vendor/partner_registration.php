<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Vendor Registration</h3>
</div>

<div class="row-fluid user-detail-row1">

    <form class="form-horizontal for partner1" name="partner_register" id="admin_partner_register" action="<?php echo base_url(); ?>admin/add_partner_registration" method="post">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Username*</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="username" value="<?php echo set_value('username'); ?>">

                        <?php echo form_error('username'); ?>
                        <?php
                        $error_message = $this->session->flashdata('validate_email_error_message');
                        if ($error_message) {
                            ?>

                            <p class="error_validate_msg para-small for-para"><?php echo $error_message; ?></p>


                        <?php } ?>
                    </div> 
                </div> 

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Name*</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="business_name" value="<?php set_value('business_name'); ?>">

                        <?php echo form_error('business_name'); ?>

                    </div> 
                </div>

                <div class="edit-group3 edt3">          

                    <label class="control-label" for="e-name">What Business type are you?</label> 
                    <label class="control-label edt1" for="e-name">Select the services you provide. (You may select multiple services).</label> 
                    <div class="customer-edit-input">
                        <ul class="cs_business_services">
                            <?php foreach ($services as $service) { ?>

                                <li class="choose_service"><input type="checkbox" name="business_type[]" value="<?php echo $service->id . '/' . $service->service_name; ?>" />
                                    <?php echo $service->service_name; ?>
                                </li>

                            <?php } ?>
                             <label class="error" id="admin_business_type"  style="display:none;color:red;" generated="true" for="name">This Field is Required.</label>
                        </ul>

                    </div> 
                </div>


                <div class="edit-group3 edt3">          

                    <label class="control-label" for="e-name">What is your Business Address?</label> 
                    <label class="control-label edt1" for="e-name">Address*</label> 
                    <div class="customer-edit-input">
                        <textarea name="address1" class="business_info_textarea"></textarea>
                        <?php echo form_error('address1'); ?>

                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Landmark</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="address2" value="<?php echo set_value('address1'); ?>">
                        <?php echo form_error('address2'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Country</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="country" class="required p-select valid">  
                            <option value="">Select Country</option>  
                            <option value="India" selected>India</option>  
                        </select> 
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">State/province</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="state" class="required p-select valid">  
                            <option value="">Select State/province</option>  
                            <option value="Karnataka" selected>Karnataka</option>
                        </select> 
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">City</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="city" class="required p-select valid">  
                            <option value="">Select City</option>  
                            <option value="Banglore" selected>Banglore</option>
                        </select> 
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Area Name</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="area" class="required p-select valid">  
                            <option value="">Select Area</option>  
                            <?php foreach ($locations as $location) { ?>
                                <option value="<?php echo $location->id; ?>"><?php echo $location->suburb; ?></option> 
                            <?php } ?>
                        </select> 
                        <?php echo form_error('area'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Zip/postal code*</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="zipcode" value="<?php echo set_value('zipcode'); ?>">
                        <?php echo form_error('zipcode'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Telephone - Landline</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="landline" value="<?php echo set_value('landline'); ?>">
                        <?php echo form_error('landline'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Telephone - Mobile*</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="mobile" value="<?php echo set_value('mobile'); ?>">
                        <?php echo form_error('mobile'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name"> Business Website</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="website" value="<?php echo set_value('website'); ?>">
                        <?php echo form_error('website'); ?>
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name"> Business Email*</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="business_email" value="<?php echo set_value('business_email'); ?>">
                        <?php echo form_error('business_email'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Facebook page</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="fb_page" value="<?php echo set_value('fb_page'); ?>">
                        <?php echo form_error('fb_page'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Twitter Handle</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="tw_page" value="<?php echo set_value('tw_page'); ?>">
                        <?php echo form_error('tw_page'); ?>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Instagram</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="instagram" value="<?php echo set_value('instagram'); ?>">
                        <?php echo form_error('instagram'); ?>
                    </div> 
                </div>


                <div class="edit-group3 agree2">          

                     
                    <div class="customer-edit-input">
                        <input type="checkbox" class="input input-xxlarge required e-input valid" name="check" id="check" >
                       
                    </div> 
                    <label class="control-label" for="e-name">I agree to Zinguplife's <a class="terms_service" href="<?php echo base_url(); ?>assets/MERCHANT PARTICIPATION AGREEMENT.pdf" target="_blank"><strong>terms</strong></a>
                        of service.
    <?php echo form_error('check'); ?>
</label> 
                    
                </div>

                <div class="controls1 ctr3">
                    <input type="submit" name="submit" id="submit" value="Register" class="primary-button">
                </div> 
        </fieldset>
    </form>
</div>



