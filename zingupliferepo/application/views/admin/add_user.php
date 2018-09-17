<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">New User</h3>
</div>

<div class="row-fluid user-detail-row1">
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/create_users" method="post">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3">  
                    <label class="control-label" for="e-name">User Role:</label>  
                    <div class="customer-edit-input">
                        <select id="select03" name="role" class="required p-select user-role valid">  
                            <option value="">Select User Role</option> 
                            <?php foreach ($user_roles as $key => $value) { ?>
                                <option value="<?php echo$value->id; ?>"><?php echo$value->role; ?></option> 
                            <?php } ?>
                        </select> 
                        <?php echo form_error('role'); ?>
                    </div> 
                    <!--                    <a class="blue new-role" href="">Create New Role</a>-->
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="ename">Name:</label>  
                    <div class="customer-edit-input">
                        <input type="tel" class="input input-xxlarge required e-input valid" id="ename" name="name" value=""> 
                        <?php echo form_error('name'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="select01">Gender:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="gender" class="required p-select valid">  
                            <option value="">Select Gender</option> 
                            <option value="Female">Female</option>  
                            <option value="Male">Male</option>    
                        </select> 
                        <?php echo form_error('gender'); ?>
                    </div>  
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="eage">Age:</label>  
                    <div class="customer-edit-input">
                        <input type="tel" class="input input-xxlarge required e-input valid" id="eage" name="age" value=""> 
                        <?php echo form_error('age'); ?>
                    </div>
                </div>  

                <div class="edit-group3">  
                    <label class="control-label" for="ephone">Phone:</label>  
                    <div class="customer-edit-input">
                        <input type="tel" class="input input-xxlarge required e-input valid" id="ephone" name="phone" value=""> 
                        <?php echo form_error('phone'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="">Email:</label>  
                    <div class="customer-edit-input">
                        <input type="email" class="input input-xxlarge required e-input valid" id="e-mail" name="username" value="<?php echo set_value('oldusername', $post_data['username']); ?>"/> 
                        <?php echo form_error('username'); ?>
                        <?php if (isset($error_message)) { ?><label for="name" generated="true" class="error"><?php echo $error_message; ?></label><?php } ?>
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