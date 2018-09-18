<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">SME Event Detail</h3>
</div>

<div class="row-fluid user-detail-row">
    <div class="photo-section photo-section1">
        <div class="photo-details">
            <h4 class="large photo-name1">SME User - <?php echo $event_details->first_name;?> <?php echo $event_details->last_name;?></h4>
        </div>

        <div class="photo-actions">
            <ul class="backend-actions">
                <li><a class="blue" href="<?php echo base_url(); ?>admin/sme/edit_event_details/<?php echo $event_details->id;?>">Edit Event</a></li>
                <li>|</li>
                <li><a class="blue delete_smeevent" href="" id="<?php echo $event_details->id;?>">Delete</a></li>
            </ul>
        </div>
    </div>

    <div class="clear profile-tab">
        <form class="form-horizontal for" name="profile" id="profile">  
            <fieldset>  
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Title:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->title;?></span>
                    </div>  
                </div> 
                
                 <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Description:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->description;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Location:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->location;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Date:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->date;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Start Time:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->start_time;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Duration:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->duration;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Total Slots:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->total_slots;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Slots Available:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->slots_available;?></span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Joining Fee:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->joining_fee;?> Rs</span>
                    </div>  
                </div>
                
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Discount:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $event_details->discount;?>%</span>
                    </div>  
                </div>

               
            </fieldset>		   
        </form>  
    </div>
</div>
