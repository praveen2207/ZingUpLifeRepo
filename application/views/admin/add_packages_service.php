<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Packages &amp; Treatments</h3>
</div>
<div class="row-fluid tr-row">

    <script src="<?php echo base_url(); ?>assets/admin/js/upload.js"></script>    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/multiple_uploads_style.css" />
    <?php
    $error_message = $this->session->flashdata('business_service_success_message');
    if ($error_message) {
        ?>
        <p class="error_validate_msg para-small for-para"><?php echo $error_message; ?></p>

    <?php } ?>
    <form class="form-horizontal partner1 infob1 for" name="services" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>customer_support/adding_business_services">  
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
                    </div> 
                    <?php echo form_error('packages'); ?>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Service</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="service" >

                        <?php echo form_error('service'); ?>
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration in Minutes</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="duration" >

                        <?php echo form_error('duration'); ?>
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

                    <label class="control-label" for="e-name">Booking Type</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_type" class="required p-select valid">  
                            <option value="">Select</option>
                            <option value="hourly">Hourly</option>
                            <option value="monthly">Monthly</option>
                            <option value="both">Both</option>
                        </select>    
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Upload Image</label>  
                    <div class="customer-edit-input">
                        <div id="filediv" class="cs_add_service_gallery"><input type="file" id="wall_post_images"/><br><br><div id="file_names"></div></div>
                        <div id="formdiv" style="display:none;">
                            <!--                                        <a id="close_button" href="">X</a>-->
                            <h2>Upload images and videos here</h2>
                            <!--    <form enctype="multipart/form-data" action="" method="post">-->

                            <hr/>
                            <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
                            <div class="addmore">
                                <input type="button" id="add_more" class="upload" value="Add More"/>
                                <input type="submit" value="Close" name="submit" id="upload" class="upload"/>
                            </div>
                            <!--    </form>-->


                        </div> 
                    </div> 
                </div>
                <input type="hidden" name="count" value="0" />

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
        Package/Treatment<br>
        <input type="text" class="package" name="package" style="float:none;" /><br><br>
        Type:<br>
        <select name="type" class="type">
            <option value="">Select</option>
            <option value="treatments">Treatment</option>
            <option value="packages">Package</option>
        </select><br>
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

