<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New Vendor</h3>
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
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/do_vendor_registration" method="post">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Username:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="username" value=""> 
                        <?php echo form_error('username'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Business Name:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="business_name" value=""> 
                        <?php echo form_error('business_name'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="e-name">Select the services you provide. (You may select multiple services).:</label>  
                    <div class="customer-edit-input">
                        <?php foreach ($services as $service) { ?>
                            <li class="choose_service"><input type="checkbox" name="business_type[]" value="<?php echo $service->id . '/' . $service->service_name; ?>" />
                                <?php echo $service->service_name; ?>
                            </li>
                        <?php } ?>
                    </div> 
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Business Address*:</label>  
                    <div class="customer-edit-input">
                        <textarea name="address1" class="textarea_address"></textarea>
                        <?php echo form_error('address1'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Landmark:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="address2" value=""> 
                        <?php echo form_error('address2'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Country:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="country" class="required p-select valid">  
                            <option value="">Select Country</option>  
                            <option value="India" selected>India</option>  
                        </select> 
                    </div>  
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">State/province:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="state" class="required p-select valid">  
                            <option value="">Select State/province</option>  
                            <option value="Karnataka" selected>Karnataka</option>
                        </select> 
                    </div>  
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="select01">City:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="city" class="required p-select valid">  
                            <option value="">Select City</option>  
                            <option value="Bangalore" selected>Bangalore</option>
                        </select> 
                    </div>  
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Area Name:</label>  
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
                    <label class="control-label" for="ename">Zip/postal code*:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="zipcode" value=""> 
                        <?php echo form_error('zipcode'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Business Telephone - Landline:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="landline" value=""> 
                        <?php echo form_error('landline'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Business Telephone - Mobile*:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="mobile" value=""> 
                        <?php echo form_error('mobile'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Business Website:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="website" value=""> 
                        <?php echo form_error('website'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Business Email*:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="business_email" value=""> 
                        <?php echo form_error('business_email'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="payment_option">Payment Option:</label>  
                    <div class="customer-edit-input">
                        <select name="payment_option" class="required p-select valid">
                            <option value="Online">Online</option>			
                            <option value="Offline">Offline</option>			
                        </select>
                        <?php echo form_error('payment_option'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Facebook page:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="fb_page" value=""> 
                        <?php echo form_error('fb_page'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Twitter Handle:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="tw_page" value=""> 
                        <?php echo form_error('tw_page'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Instagram:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="instagram" value=""> 
                        <?php echo form_error('instagram'); ?>
                    </div>
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename"></label>  
                    <div class="customer-edit-input">
                        <input type="checkbox" class="checkbox" name="check" id="check"/>
                        <label>I agree to Zinguplife's <a class="terms_service" href="<?php echo base_url(); ?>assets/MERCHANT PARTICIPATION AGREEMENT.pdf" target="_blank"><strong>terms</strong></a>
                            of service.</label>
                        <?php echo form_error('check'); ?>
                    </div>
                </div> 
                <div class="customer-button-group customer-button-group1"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="">
                        <input type="submit" name="submit" id="submit" value="Continue" class="primary-button">
                        <input type="reset" name="resit" value="Cancel" class="secondary-button cancel">
                    </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>