
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add business gallery</h3>
</div>
<div class="row-fluid tr-row">
    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="cs_vendor_add_gallery" name="get_started" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>cs/adding_business_gallery">  
        <fieldset>
            <div class="clear">
            </div>         
                   <input type="hidden" name="id" value="<?php echo $business_id; ?>" />
                   <input type="hidden" class="count" name="count" value="<?php echo count($business_gallery); ?>" />
                  <div id="add-gallery-block-clone">
                  <div class="add-gallery-block">
                    <div class="edit-group3">          


                        <label class="control-label" for="e-name">Image</label>  
                        <div class="customer-edit-input">
                            <input type="file" class="input input-xxlarge required e-input valid file" name="file[]">
 <div class="error_fle_name" style="display:none; color:red;">This field is required</div>
                        </div> 

                </div> 
                </div>
                </div>
                 <div class="edit-group3">  
                    <label class="control-label" for="e-name"></label>  
                    <div class="customer-edit-input">
                        <p class="add-button"><a href="" id="add-block3" >Add More</a></p>
                    </div> 
                </div> 
                  
                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Submit" class="primary-button">
                </div> 
        </fieldset>
    </form>

</div>

