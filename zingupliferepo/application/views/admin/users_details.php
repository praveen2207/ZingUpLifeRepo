<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">User Detail</h3>
</div>

<div class="row-fluid user-detail-row">
    <div class="photo-section photo-section1">
        <div class="photo-details">
            <h4 class="large photo-name1"><?php echo $user_details->name;?></h4>
            <span class="change-photo change-photo2"><?php echo $user_details->user_role;?></span>
        </div>

        <div class="photo-actions">
            <ul class="backend-actions">
                <li><a class="blue" href="<?php echo base_url(); ?>admin/edit_user_details/<?php echo $user_details->user_id;?>">Edit User</a></li>
                <li>|</li>
                <li><a class="blue delete_user" href="" id="<?php echo $user_details->user_id;?>">Delete</a></li>
            </ul>
        </div>
    </div>

    <div class="clear profile-tab">
        <form class="form-horizontal for" name="profile" id="profile">  
            <fieldset>  
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">User ID:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $user_details->user_id;?></span>
                    </div>  
                </div> 

                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="select01">Gender:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1 green"><?php echo $user_details->gender;?></span>
                    </div>  
                </div> 

                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="select02">Age:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1 green"><?php echo $user_details->age;?> years</span>
                    </div> 
                </div> 

                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="ephone">Phone:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1 green"><?php echo $user_details->phone;?></span>
                    </div> 
                </div> 

                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="">Email:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1 green"><a href="" class="green"><?php echo $user_details->username;?></a></span>
                    </div>  
                </div> 
            </fieldset>		   
        </form>  
    </div>
</div>