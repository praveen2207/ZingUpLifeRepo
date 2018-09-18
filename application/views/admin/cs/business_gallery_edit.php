
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business gallery image</h3>
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
    <form class="form-horizontal for user-detail-row1 partner1 infob1" name="get_started" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>cs/updating_business_gallery/<?php
    if (isset($gallery_info)) {
        echo $gallery_info[0]->id;
    }
    ?>">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3">          
                    <label class="control-label" for="e-name">Image</label>  
                    <div class="customer-edit-input">
                        <input type="hidden" name="business_id" value="<?php
    if (isset($gallery_info)) {
        echo $gallery_info[0]->business_id;
    }
    ?>">
                        <input type="file" class="input input-xxlarge required e-input valid" name="userfile">
                        <input type="hidden" class="input input-xxlarge required e-input valid" name="old_gallery_image" value="<?php
                        if (isset($gallery_info)) {
                            echo $gallery_info[0]->images;
                        }
    ?>">
                    </div> 
                </div> 
                <div class="edit-group3">          
                    <label class="control-label" for="e-name"></label>  
                    <div class="customer-edit-input">
<?php if (isset($gallery_info)) { ?>
                            <img style="width:100px;height:40px;" src="<?php echo base_url(); ?>assets/uploads/business_providers/gallery/<?php echo $gallery_info[0]->business_id; ?>/<?php echo $gallery_info[0]->images; ?>" >
<?php } ?>
                    </div> 
                </div> 
                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
                </div> 
        </fieldset>
    </form>






</div>

