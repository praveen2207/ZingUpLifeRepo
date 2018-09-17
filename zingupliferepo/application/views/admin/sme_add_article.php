<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New SME Article</h3>
</div>

<div class="row-fluid user-detail-row1">
    <form class="form-horizontal for" name="edit-form" action="<?php echo base_url(); ?>admin/sme/create_article" method="post">  
        <fieldset>
            <div class="clear">
				
				<div class="edit-group3">  
                    <label class="control-label" for="select01">SME User:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="sme_user" class="required p-select valid">  
                            <option value="">Select SME User</option> 
                            <?php foreach($all_users as $all_user) {?>
								<option value="<?php echo $all_user->sme_userid; ?>"><?php echo $all_user->first_name; ?> <?php echo $all_user->last_name; ?></option> 
                            <?php } ?>   
                        </select> 
                        <?php echo form_error('sme_user'); ?>
                    </div>  
                </div> 
    
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Heading:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="heading" value=""> 
                        <?php echo form_error('heading'); ?>
                    </div>
                </div> 

               
             
                <div class="edit-group3">  
                    <label class="control-label" for="ephone">Content:</label>  
                    <div class="customer-edit-input">
                        <textarea class="required e-input valid" id="ename" name="content" ></textarea> 
                        <?php echo form_error('content'); ?>
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
