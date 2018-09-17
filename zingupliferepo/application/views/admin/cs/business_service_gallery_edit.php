
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business service gallery image</h3>
</div>
<div class="row-fluid tr-row">
    <?php
    $error_message = $this->session->flashdata('gallery_update_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>   
    <form class="form-horizontal for user-detail-row1 partner1 infob1" name="get_started" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>cs/updating_business_service_gallery/<?php
    if (isset($service_info)) {
        echo $service_info[0]->id;
    }
    ?>">  
        <fieldset>
            <div class="clear">
            </div>
            <input type="hidden" name="service_id" value="<?php echo $service_info[0]->service_id;  ?>" />
            <div class="edit-group3">          
                <label class="control-label" for="e-name">Caption</label>  
                <div class="customer-edit-input">

                    <input type="text" class="input input-xxlarge required e-input valid" name="caption" value="<?php echo $service_info[0]->caption; ?>">
                    
                </div> 
            </div>
            <div class="edit-group3">          
                <label class="control-label" for="e-name">Description</label>  
                <div class="customer-edit-input">

                    <textarea id="cs_service_description" name="description"><?php echo $service_info[0]->description; ?></textarea>
                    
                </div> 
            </div>
            <div class="edit-group3">          
                <label class="control-label" for="e-name">Image</label>  
                <div class="customer-edit-input">

                    <input type="file" class="input input-xxlarge required e-input valid" name="userfile">
                    <input type="hidden" class="input input-xxlarge required e-input valid" name="old_gallery_image" value="<?php
                    if (isset($service_info)) {
                        echo $service_info[0]->images;
                    }
                    ?>">
                </div> 
            </div> 
            <div class="edit-group3">          
                <label class="control-label" for="e-name"></label>  
                <div class="customer-edit-input">
                    <?php if (isset($service_info)) { ?>
                        <img style="width:100px;height:40px;" src="<?php echo base_url(); ?>assets/uploads/business_services/gallery/<?php echo $service_info[0]->service_id; ?>/<?php echo $service_info[0]->images; ?>" >
                    <?php } ?>
                </div> 
            </div> 
            <div class="controls1 ctr2">
                <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
            </div> 
        </fieldset>
    </form>






</div>

