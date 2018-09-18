<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New SME User</h3>
</div>

<div class="row-fluid user-detail-row1">
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/sme/update_amount" method="post">  
        <fieldset>
            <div class="clear">
    
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Amount:</label>  
                    <div class="customer-edit-input">
                        <input type="tel" class="input input-xxlarge required e-input valid" id="ename" name="amount" value="<?php echo $amount[0]->amount; ?>"> 
                        <?php echo form_error('amount'); ?>
                    </div>
                </div>
				


                <div class="customer-button-group customer-button-group1"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="controls1">
					<input type='hidden' name='id' value='<?php echo $amount[0]->id; ?>' />
                        <input type="submit" name="submit" id="submit" value="Continue" class="primary-button">
                        <input type="reset" name="resit" value="Cancel" class="secondary-button cancel">
                    </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>
