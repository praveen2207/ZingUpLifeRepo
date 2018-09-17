 <link type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
                
             
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Vendor Registration</h3>
</div>

<div class="row-fluid tr-row">
    
    <form class="form-horizontal for" name="partner_register" method="post" action="<?php echo base_url(); ?>admin/add_partner_registration">
        <label>Username*</label>
        <input type="text" name="username" value="<?php echo set_value('username'); ?>"><br><br>
        <?php echo form_error('username'); ?>
		<?php
                                    $error_message = $this->session->flashdata('validate_email_error_message');
                                    if ($error_message) {
                                        ?>
                                        
                                            <p class="error_validate_msg para-small for-para"><?php echo $error_message; ?></p>

                                        
                                    <?php } ?>
        <label>Business Name*</label>
        <input type="text" name="business_name" value="<?php echo set_value('business_name'); ?>">
        <?php echo form_error('business_name'); ?><br><br><br><br><br><br>
        <label>What Business type are you?</label>
        <label>Select the services you provide. (You may select multiple services).</label><br><br><br><br><br>
      <!--  <select name="business_type[]" multiple class="chosen-select-no-single"> -->

        <?php foreach ($services as $service) { ?>
            <li class="choose_service"><input type="checkbox" name="business_type[]" value="<?php echo $service->id . '/' . $service->service_name; ?>" />
                <?php echo $service->service_name; ?>
            </li>
        <?php } ?>
        <br>
        <label>What is your Business Address?</label>
        <label> Address*</label>
        <textarea name="address1" class="business_info_textarea"></textarea><?php echo form_error('address1'); ?><br><br>
        <label>Landmark</label>
        <input type="text" name="address2" value="<?php echo set_value('address1'); ?>">
        <?php echo form_error('address2'); ?>
        <label>Country</label>
        <select name="country">
            <option value="">Select Country</option>  
            <option value="India" selected>India</option>

        </select><br><br>
        <label>State/province</label>
        <select name="state">
            <option value="">Select State/province</option>  
            <option value="Karnataka" selected>Karnataka</option>

        </select><br><br>

        <label>City</label>
        <select name="city">
            <option value="">Select City</option>  
            <option value="Banglore" selected>Banglore</option>

        </select> <br><br>
        <label>Area Name</label>
        <select name="area">
            <option value="">Select Area</option>  
            <?php foreach ($locations as $location) { ?>
                <option value="<?php echo $location->id; ?>"><?php echo $location->suburb; ?></option> 
            <?php } ?>
        </select><br><br>
        <label> Zip/postal code*</label>
        <input type="text" name="zipcode" value="<?php echo set_value('zipcode'); ?>">
        <?php echo form_error('zipcode'); ?>
        <label> Business Telephone - Landline</label>
        <input type="text" name="landline" value="<?php echo set_value('landline'); ?>">
        <?php echo form_error('landline'); ?>
        <label> Business Telephone - Mobile*</label>
        <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>">
        <?php echo form_error('mobile'); ?>
        <label> Business Website</label>
        <input type="text" name="website" value="<?php echo set_value('website'); ?>">
        <?php echo form_error('website'); ?>
        <label> Business Email*</label>
        <input type="text" name="business_email" value="<?php echo set_value('business_email'); ?>">
        <?php echo form_error('business_email'); ?>
        <label> Facebook page</label>
        <input type="text" name="fb_page" value="<?php echo set_value('fb_page'); ?>">
        <?php echo form_error('fb_page'); ?>
        <label> Twitter Handle</label>
        <input type="text" name="tw_page" value="<?php echo set_value('tw_page'); ?>">
        <?php echo form_error('tw_page'); ?>
        <label> Instagram</label>
        <input type="text" name="instagram" value="<?php echo set_value('instagram'); ?>">
        <?php echo form_error('instagram'); ?>
        <input type="checkbox" class="checkbox" name="check" id="check"/>
        <label>I agree to Zinguplife's <a class="terms_service" href="<?php echo base_url(); ?>assets/MERCHANT PARTICIPATION AGREEMENT.pdf" target="_blank"><strong>terms</strong></a>
            of service.</label>
        <?php echo form_error('check'); ?>
        <input type="submit" class="button" value="Register">
    </form>
</div>

