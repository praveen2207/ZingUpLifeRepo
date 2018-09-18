<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Packages &amp; Treatments</h3>
</div>

<div class="row-fluid vd-row">
    
     <?php
    $error_message = $this->session->flashdata('business_program_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>   

    <form class="form-horizontal partner1 infob1for" name="service" method="post" action="<?php echo base_url(); ?>cs/updating_business_program">  
        <fieldset>
            <div class="clear">

              <div class="edit-group3">          

                    <label class="control-label" for="e-name"> Service</label>  
                    <div class="customer-edit-input">
                         <select name="service" class="required p-select valid">
                            <option value="">Select</option>
                            <?php foreach ($mapping as $key => $value) { ?>
                                        <option value="<?php echo $value->services_id; ?>" <?php if ($value->services_id == $packages['package']->service_id) { ?>selected <?php } ?>><?php echo $value->service_name; ?></option>
                                    <?php } ?>
                        </select>
                      <?php echo form_error('service'); ?>

                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name"> Package/Treatment name</label>  
                    <div class="customer-edit-input">
                        <input type="hidden" id = "package_id" name="service_id" size="5" value ="<?php if($packages['package']){ echo $packages['package']->id; } ?>"  />
                        <input type="text" class="input input-xxlarge required e-input valid package_name" name="package_name" value="<?php if($packages['package']){ echo $packages['package']->program; }?>">
                      <?php echo form_error('package_name'); ?>

                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Type</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="type" class="required p-select valid">
                            <option value="">Select</option>
                            <option value="Offerings" <?php if($packages['package']->type == 'Offerings'){ ?> selected <?php } ?>>Offerings</option>
                            <option value="Packages" <?php if($packages['package']->type == 'Packages'){ ?> selected <?php } ?>>Packages</option>
                            <option value="Sessions" <?php if($packages['package']->type == 'Sessions'){ ?> selected <?php } ?>>Sessions</option>
                        </select>
                        <?php echo form_error('type'); ?>
                    </div> 
                </div>


                <div class="controls1 ctr3 mrg">
                    <input type="submit" name="submit" id="submit" value="Update" class="primary-button">
                </div> 
        </fieldset>
    </form>

    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Service Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="backend-user">
            <?php
            if (isset($packages['service'])) {
                foreach ($packages['service'] as $service) {
                    ?>

                    <tr>
                        <td class="blue"><?php echo $service->services; ?></td> 
                        <td class="blue">
                            <ul class="backend-actions">
                                <li><a class="blue" href="<?php echo base_url(); ?>cs/business_service_edit/<?php echo $service->id; ?>">Edit</a></li>
                                <li>|</li>
                                <li><a href="" class="blue" id="service_delete" service_id="<?php echo $service->id; ?>" >Delete</a></li>
                            </ul>  
                        
                        </td>

                    </tr>
                    <?php
                }
            } else {
                ?>
            <td valign="top" class="" colspan="2" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
        <?php } ?>
        </tbody>
    </table>

</div>

