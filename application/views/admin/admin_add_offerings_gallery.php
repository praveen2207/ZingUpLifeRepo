<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add Offering Gallery</h3>
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
    <form class="form-horizontal for" name="edit-form" action="<?php echo base_url(); ?>admin/create_new_package" method="post" enctype="multipart/form-data">  
        <fieldset>
            <input type="hidden"  name="id" value="<?php echo $id; ?>"> 
            <input type="hidden"  name="vendor_id" value="<?php echo $vendor_id; ?>"> 
            <div class="clear">
                <?php foreach ($gallery as $key => $value) { ?>
                    <div class="edit-group3">  
                        <label class="control-label" for="ename">Image-<?php echo $key + 1; ?>:</label>  
                        <div class="customer-edit-input image_thumbnail">
                            <img src="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>" alt="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>"/>
                        </div>
                    </div> 
                <?php } ?>
                <?php
                $original_count = count($gallery);
                echo $new_count = $original_count + 1;

                echo $gallery_count = (6 - $original_count);
                for ($i = $original_count; $i <= $gallery_count; $i++) {
                    ?>
                    <div class="edit-group3">  
                        <label class="control-label" for="ename">Image-<?php echo $i+1; ?>:</label>  
                        <div class="customer-edit-input">
                            <input type="file" class="input input-xxlarge required e-input valid" name="gallery[<?php echo $i; ?>]"> 
                            <?php echo form_error('name'); ?>
                        </div>
                    </div> 
                <?php } ?>
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