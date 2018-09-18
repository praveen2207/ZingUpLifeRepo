<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New SME Event</h3>
</div>

<div class="row-fluid user-detail-row1">
    <form class="form-horizontal for" name="edit-form" id="" action="<?php echo base_url(); ?>admin/sme/create_event" method="post">  
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
                    <label class="control-label" for="ename">Title:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="title" value=""> 
                        <?php echo form_error('title'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Description:</label>  
                    <div class="customer-edit-input">
						<textarea class=" e-input valid" id="ename" name="description"></textarea> 
                        <?php echo form_error('description'); ?>
                    </div>
                </div> 

              <div class="edit-group3">  
                    <label class="control-label" for="ename">Location:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="location" value=""> 
                        <?php echo form_error('location'); ?>
                    </div>
                </div> 

             
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Date:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="sme_event_date" name="date" value=""> 
                        <?php echo form_error('date'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Start Time(hh:mm:ss):</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="start_time" value=""> 
                        <?php echo form_error('start_time'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Duration(hours):</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="duration" value=""> 
                        <?php echo form_error('duration'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Total Slots:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="total_slots" value=""> 
                        <?php echo form_error('total_slots'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Slots Available:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="slots_available" value=""> 
                        <?php echo form_error('slots_available'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Joining Fee:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="joining_fee" value=""> 
                        <?php echo form_error('joining_fee'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="ename">Discount (%):</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="discount" value=""> 
                        <?php echo form_error('discount'); ?>
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
