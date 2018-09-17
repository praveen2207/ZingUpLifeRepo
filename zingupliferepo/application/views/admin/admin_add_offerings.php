<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">New Offering Service</h3>
    <a href="<?php echo base_url(); ?>admin/add_new_package/<?php echo $vendor_id; ?>" class="new-user">Add New Package / Treatment</a>
</div>
<div class="row-fluid user-detail-row1 add_vendor_form">
    <?php
    $validate_email_error_message = $this->session->flashdata('validate_email_error_message');
    if (isset($validate_email_error_message)) {
        ?>
        <div class="message">
            <h3 class="congratulations message-head">Error !!!</h3>
            <p class="para-small for-para"><?php echo $validate_email_error_message; ?></p>
        </div>
    <?php } ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/create_offerings" method="post">  
        <fieldset>
            <input type="hidden" class="" name="vendor_id" value="<?php echo $id; ?>"> 
            <div class="clear">
                <div class="edit-group3">  
                    <label class="control-label" for="select01">Packages/Treatments:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="program_id" class="required p-select valid">  
                            <option value="">Select Packages/Treatments</option>  
                            <?php foreach ($all_packages as $key => $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->program; ?></option>  
                            <?php } ?>
                        </select> 
                        <?php echo form_error('program_id'); ?>
                    </div>  
                </div> 
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Service:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="services" value=""> 
                        <?php echo form_error('services'); ?>
                    </div>
                </div> 

                <div class="edit-group3 business_hours_ctr">  
                    <label class="control-label" for="ename">Duration:</label>  
                    <div class="customer-edit-input2">
                        <div class="left-side left-side-ctr">
                            <div class="check-text">
                                <label class="control-label" for="ename">Hours:</label>  
                                <select class="" name="duration_hour">
                                    <option value="">Hours</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">8</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>  
                                <?php echo form_error('duration_hour'); ?>
                            </div>
                            <div class="check-text">
                                <label class="control-label" for="ename">Minutes:</label>  
                                <select class="" name="duration_minutes">
                                    <option value="">Minutes</option>
                                    <option value="00">00</option>
                                    <option value="05">05</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                    <option value="55">55</option>
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
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="price"> 
                        <?php echo form_error('price'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Booking Type:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_type" class="required p-select valid">  
                            <option value="">Select Booking Type</option>  
                            <option value="hourly">Hourly</option>
                            <option value="monthly">Monthly</option>
                            <option value="one_time">One Time</option>  
                        </select> 
                        <?php echo form_error('service_type'); ?>
                    </div>  
                </div> 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                        <textarea name="description" value="" id="cs_description"></textarea>
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