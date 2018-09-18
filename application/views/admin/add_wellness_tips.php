<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New Wellness Tip</h3>
</div>

<div class="row-fluid user-detail-row1">
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/wellness_tips/add_wellness_tip" method="post"  enctype= "multipart/form-data">  
        <p style='color:green;margin-bottom:10px;'><?php echo $this->session->flashdata('message');?></p>
		<fieldset>
            <div class="clear">
               

                <div class="edit-group3">  
                    <label class="control-label" for="ename">Wellness Tip Image:</label>  
                    <div class="customer-edit-input">
                        <input type="file" class="input input-xxlarge required e-input valid" id="ename" name="userfile" value=""> 
                        <?php echo form_error('name'); ?>
                    </div>
                </div> 

            
                <div class="customer-button-group customer-button-group1"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="controls1">
                        <input type="submit" name="submit" id="submit" value="Continue" class="primary-button">
                        <input type="reset" name="resit" value="Cancel" class="secondary-button cancel">
                    </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>