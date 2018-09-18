<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit Customer Detail</h3>
</div>

<div class="row-fluid customer-row2">
    <?php
    $update_message = $this->session->flashdata('profile_update_message');
    if (isset($update_message)) {
        if ($update_message == 'success') {
            ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Congratulations!</h3>
                <p class="para-small for-para">You've successfully edited customer's profile details.</p>

            </div>
        <?php } else { ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Oops!</h3>
                <p class="para-small for-para">Something went wrong please try again.</p>

            </div>
        <?php }
    } ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/update_customer" method="post">  
        <input type="hidden" name="user_id" value="<?php echo $customer_details['user_details']->user_id; ?>" />
        <fieldset>
            <div class="photo-section">
                <div class="photo"><img src="<?php echo base_url(); ?>assets/admin/images/profile-photo.jpg"/></div>
                <div class="photo-details">
                    <div class="c-photo">
                        <input type="text" class="input input-xxlarge required e-input" id="pht" name="pht" value="<?php echo $customer_details['user_details']->name; ?>" disabled> 
                    </div>
                    <a href="" class="blue change-photo1">Change Photo</a>
                </div>
            </div>

            <div class="span8 clear profile-tab profile-tab1">
                <div class="edit-group1 edit-group2">  
                    <label class="control-label control-label3" for="e-name">Customer ID:</label>  
                    <div class="customer-edit-input customer-edit-input1">
                        <span class="edit-name3 medium1"><?php echo $customer_details['user_details']->user_id; ?></span>
                    </div>
                </div> 		

                <div class="edit-group1 edit-group2">  
                    <label class="control-label" for="e-name">Name:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input" id="e-name" name="name" value="<?php echo $customer_details['user_details']->name; ?>"> 
                    </div>
                </div> 

                <div class="edit-group1 edit-group2">  
                    <label class="control-label" for="select01">Gender:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="gender" class="required p-select">  
                            <option value="">Select</option> 
                            <option value="Male" <?php if ($customer_details['user_details']->gender == 'Male') { ?> selected <?php } ?>>Male</option>  
                            <option value="Female" <?php if ($customer_details['user_details']->gender == 'Female') { ?> selected <?php } ?>>Female</option>  
                        </select> 
                    </div>
                </div> 

                <div class="edit-group1 edit-group2">  
                    <label class="control-label" for="e-age">Age:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input" id="e-age" name="age" value="<?php echo $customer_details['user_details']->age; ?>"> 
                    </div>
                </div> 

                <div class="edit-group1 edit-group2">  
                    <label class="control-label" for="ephone">Phone:</label>  
                    <div class="customer-edit-input">
                        <input type="tel" class="input input-xxlarge required e-input" id="ephone" name="phone" value="<?php echo $customer_details['user_details']->phone; ?>"> 
                    </div>				
                </div> 

                <div class="edit-group1 edit-group2">  
                    <label class="control-label" for="">Email:</label>  
                    <div class="customer-edit-input">
                        <input type="email" class="input input-xxlarge required e-input" id="e-mail" name="e-mail" value="<?php echo $customer_details['user_details']->username; ?>" disabled> 
                    </div>	
                </div>

                <div class="control-group customer-button-group"> 
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