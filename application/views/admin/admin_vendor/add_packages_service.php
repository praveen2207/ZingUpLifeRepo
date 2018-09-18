<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Packages &amp; Treatments</h3>
</div>
<div class="row-fluid tr-row">

    <?php
    $error_message = $this->session->flashdata('business_service_success_message');
    if ($error_message) {
        ?>
        <p class="error_validate_msg para-small for-para"><?php echo $error_message; ?></p>

    <?php } ?>
    <form class="form-horizontal partner1 infob1 for" name="services" id="admin_vendor_packages_treatments_form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/adding_business_services">  
        <fieldset>
            <div class="clear">

                <input type="hidden" name="business_id" value="<?php echo $business_id; ?>">


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Packages/Treatments</label>  
                    <div class="customer-edit-input">

                        <select id="select01" class="packages" name="packages" class="required p-select valid">  
                            <option value="">Select</option>
                            <?php foreach ($packages as $package) {
                                ?>
                                <option value="<?php echo $package->id; ?>" <?php if ($this->session->userdata('recent_program_id') == $package->id) { ?> selected <?php } ?>><?php echo $package->program; ?></option>
                            <?php } ?>
                            <option value="new" data-toggle="modal" data-target="#myModal">Create New</option>
                        </select> 
                        <?php echo form_error('packages'); ?>
                    </div> 
                    
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Service</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="service" >

                        <?php echo form_error('service'); ?>
                    </div> 
                </div>


               <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration</label>  
                    <div class="customer-edit-input">
                  <div class="service_duration_hrs">
                      <p>Hours:</p>
                      <select name="hours">
                                        <option value="">Select</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                         <?php echo form_error('hours'); ?>
</div>
<div class="service_duration_hrs">      
               <p> Minutes:</p>
                      <select name="minutes">
                                        <option value="">Select</option>
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
                        <?php echo form_error('minutes'); ?>
</div>
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Price(Rs)</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="price" >

                        <?php echo form_error('price'); ?>
                    </div> 
                </div>
          <div class="edit-group3">          

                    <label class="control-label" for="e-name">Discount (For discount in % give discount value with percent symbol(ex: 2%))</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid service_discount" name="discount" >

                       <div class="error_service_discount" style="display:none; color:red;">Discount value should contains only numbers and % </div>
                    </div> 
                </div>
<div class="edit-group3">          

                    <label class="control-label" for="e-name">Discount Duration</label>  
                    <div class="customer-edit-input">
                         <div class="service_discount_date">
                      <p>Start date:</p>
                      <input type="text" class="input input-xxlarge required e-input valid service_discount_start_date" name="discount_start_date" id="slots-date-picker1" value="<?php echo set_value('discount_start_date'); ?>"/>
                                    <div class="error_start_date_greater" style="display:none; color:red;">Start date should not be greater than end date</div>
                                  <div class="error_start_date" style="display:none; color:red;">Start date is required</div>
                         <?php echo form_error('discount_start_date'); ?>
</div>
<div class="service_discount_date">      
               <p> End date:</p>
                     <input type="text" class="input input-xxlarge required e-input valid service_discount_end_date" name="discount_end_date" id="slots-date-picker2" value="<?php echo set_value('discount_end_date'); ?>">
                                 <div class="error_end_date_less" style="display:none; color:red;">End date should not be less than start date</div>
                                  <div class="error_end_date" style="display:none; color:red;">End date is required</div> 
                        <?php echo form_error('discount_end_date'); ?>
</div>
                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Booking Type</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_type" class="required p-select valid">  
                            <option value="">Select</option>
                            <option value="hourly">Hourly</option>
                            <option value="monthly">Monthly</option>
                            <option value="one_time">One time</option>
                        </select>   
                         <?php echo form_error('service_type'); ?> 
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                        <textarea name="description" id="cs_service_description" cols="40"></textarea>
                        <?php echo form_error('description'); ?>
                    </div> 
                </div>

                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Submit" class="primary-button">
                </div> 
        </fieldset>
    </form>

    <div class="popup cs_package_popup">
     Service<br> 
                    <select name="service_id" class="service_type">
                                    <option value="">Select</option>
                                    <?php foreach ($mapping as $key => $value) { ?>
                                        <option value="<?php echo $value->services_id; ?>"><?php echo $value->service_name; ?></option>
                                    <?php } ?>
                                </select>
<div id="admin_error_popup_service_name" style="display:none;color:red;">This field is required</div>
      <br><br><br>

        Package/Treatment<br>
        <input type="text" class="package" name="package" style="float:none;" />
<div id="admin_error_popup_package_name" style="display:none;color:red;">This field is required</div>        
        <br><br>
        Type:<br>
        <select name="type" class="type">
            <option value="">Select</option>
            <option value="Offerings">Offerings</option>
            <option value="packages">Packages</option>
            <option value="Sessions">Sessions</option>
        </select>
<div id="admin_error_popup_type" style="display:none;color:red;">This field is required</div>
<br>
        <input type="button" class="button adding_package" value="submit" style="float:none;"/>

    </div>

</div>

<div class="mask" style="display:none;width: 100%;
     height: 100%;
     position: fixed;
     top: 0px;
     left: 0px;
     background: black;
     opacity: 0.8;">

</div> 

