<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit SME Event</h3>
</div>

<div class="row-fluid user-detail-row">
    <?php
    $update_message = $this->session->flashdata('profile_update_message');
    if (isset($update_message)) {
        if ($update_message == 'success') {
            ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Congratulations!</h3>
                <p class="para-small for-para">You've successfully edited SME Event details.</p>

            </div>
        <?php } else { ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Oops!</h3>
                <p class="para-small for-para">Something went wrong please try again.</p>

            </div>
        <?php }
    }
    ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/sme/update_event" method="post">  
        <input type="hidden" name="user_id" value="<?php echo $event_details->sme_userid; ?>" />
        <fieldset>
            <div class="edit-group3">  
                    <label class="control-label" for="select01">SME User:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="sme_user" class="required p-select valid">  
                            <option value="">Select SME User</option> 
                            <?php foreach($all_users as $all_user) {?>
								<option value="<?php echo $all_user->sme_userid; ?>" <?php if($event_details->sme_userid == $all_user->sme_userid ) {?>selected<?php } ?>><?php echo $all_user->first_name; ?> <?php echo $all_user->last_name; ?></option> 
                            <?php } ?>   
                        </select> 
                        <?php echo form_error('sme_user'); ?>
                    </div>  
                </div> 
    
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Title:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="title" value="<?php echo $event_details->title; ?>"> 
                        <?php echo form_error('title'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Description:</label>  
                    <div class="customer-edit-input">
						<textarea class=" e-input valid" id="ename" name="description"><?php echo $event_details->description; ?></textarea> 
                        <?php echo form_error('description'); ?>
                    </div>
                </div> 

              <div class="edit-group3">  
                    <label class="control-label" for="ename">Location:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="location" value="<?php echo $event_details->location; ?>"> 
                        <?php echo form_error('location'); ?>
                    </div>
                </div> 

             
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Date:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="edit_sme_event_date" name="date" value="<?php echo $event_details->date; ?>"> 
                        <?php echo form_error('date'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Start Time(hh:mm:ss):</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="start_time" value="<?php echo $event_details->start_time; ?>"> 
                        <?php echo form_error('start_time'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Duration(hours):</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="duration" value="<?php echo $event_details->duration; ?>"> 
                        <?php echo form_error('duration'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Total Slots:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="total_slots" value="<?php echo $event_details->total_slots; ?>"> 
                        <?php echo form_error('total_slots'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Slots Available:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="slots_available" value="<?php echo $event_details->slots_available; ?>"> 
                        <?php echo form_error('slots_available'); ?>
                    </div>
                </div> 
                
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Joining Fee:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="joining_fee" value="<?php echo $event_details->joining_fee; ?> "> 
                        <?php echo form_error('joining_fee'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="ename">Discount (%):</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="discount" value="<?php echo $event_details->discount; ?> "> 
                        <?php echo form_error('discount'); ?>
                    </div>
                </div> 
			<input type='hidden' name='event_id' value='<?php echo $event_details->id; ?>' />
                <div class="customer-button-group"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="controls1">
                        <input type="submit" name="submit" id="submit" value="Submit" class="primary-button">
                        <input type="reset" name="resit" value="Cancel" class="secondary-button cancel">
                    </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>
