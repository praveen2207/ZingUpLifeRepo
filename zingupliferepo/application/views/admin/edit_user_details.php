<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit Users</h3>
</div>

<div class="row-fluid user-detail-row">
    <?php
    $update_message = $this->session->flashdata('profile_update_message');
    if (isset($update_message)) {
        if ($update_message == 'success') {
            ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Congratulations!</h3>
                <p class="para-small for-para">You've successfully edited user's profile details.</p>

            </div>
        <?php } else { ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Oops!</h3>
                <p class="para-small for-para">Something went wrong please try again.</p>

            </div>
        <?php }
    }
    ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/update_user" method="post">  
        <input type="hidden" name="user_id" value="<?php echo $user_details->user_id; ?>" />
        <fieldset>
            <div class="photo-section photo-section1 photo-section2">
                <div class="photo-details">
                    <input type="text" class="input input-xxlarge required e-input valid" id="pht" name="name" value="<?php echo $user_details->name; ?>">
                    <span class="change-photo change-photo3"><?php echo $user_details->user_role; ?></span>
                </div>
            </div>

            <div class="clear profile-tab profile-tab2">
                <div class="edit-group3 edit-group4">  
                    <label class="control-label control-label3" for="e-name">User ID:</label>  
                    <div class="customer-edit-input customer-edit-input1">
                        <span class="edit-name3 edit-name4 medium1"><?php echo $user_details->user_id; ?></span>
                    </div> 
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Gender:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="gender" class="required p-select">  
                            <option value="">Select</option> 
                            <option value="Male" <?php if ($user_details->gender == 'Male') { ?> selected <?php } ?>>Male</option>  
                            <option value="Female" <?php if ($user_details->gender == 'Female') { ?> selected <?php } ?>>Female</option>  
                        </select> 
                    </div>  
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="age">Age:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="age" name="age" value="<?php echo $user_details->age; ?>"> 
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="ephone">Phone:</label>  
                    <div class="customer-edit-input">
                        <input type="tel" class="input input-xxlarge required e-input valid" id="ephone" name="phone" value="<?php echo $user_details->phone; ?>"> 
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="">Email:</label>  
                    <div class="customer-edit-input">
                        <input type="email" class="input input-xxlarge required e-input valid" id="e-mail" name="e-mail" value="<?php echo $user_details->username; ?>" disabled> 
                    </div>
                </div>

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