<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New Package / Treatment</h3>
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
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/create_new_package" method="post">  
        <fieldset>
            <input type="hidden"  name="id" value="<?php echo $id; ?>"> 
            <input type="hidden"  name="vendor_id" value="<?php echo $vendor_id; ?>"> 
            <div class="clear">
                <div class="edit-group3">  
                    <label class="control-label" for="select01">Service:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_id" class="required p-select valid">  
                            <option value="">Select Service</option>
                            <?php foreach ($mapping as $key => $value) { ?>
                                <option value="<?php echo $value->services_id; ?>"><?php echo $value->service_name; ?></option>  
                            <?php } ?>
                        </select> 
                    </div>  
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Name:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="name" value=""> 
                        <?php echo form_error('name'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Type:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="type" class="required p-select valid">  
                            <option value="">Select Type</option>  
                            <option value="Offerings">Offerings</option>  
                            <option value="Packages">Packages</option>  
                            <option value="Sessions">Sessions</option>  
                        </select> 
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