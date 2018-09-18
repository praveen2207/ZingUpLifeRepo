<div class="location-header redirect-header">
    <h3 class="redirect-head">Profile</h3>

</div>
<div class="row-fluid pr-success" style="display:none;">


    <div class="message pr-message">

        <h3 class="congratulations message-head">Congratulations!</h3>

        <p class="para-small for-para">You've successfully Edited your Profile Details. </p>

    </div>
</div>

<div class="row-fluid edit-row">
    <div class="span12 no-border">
        <div class="photo-section">

            <form class="for" name="" id="">  
                <div class="photo-details">
                    <h4 class="large green photo-name"><?php echo $logged_in_user_data->name; ?></h4>
                    <div class="edit-input">
                        <input type="text" class="input input-xxlarge required e-input" id="pht" name="name" value="<?php echo $logged_in_user_data->name; ?>"> 
                        <button type="button" name="e-submit" id="e-submit" class="fa-caret-right e-button editsubmit" value=""></button>			  
                        <div class="form-error">
                            <label class="error">This field is required</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="span8 clear profile-tab">

            <form class="form-horizontal for" name="profile" id="profile">
                <input type="hidden" id = "user_id" value ="<?php echo $logged_in_user_data->user_id; ?>" /> 
                <fieldset>  
                    <div class="edit-group1 edit-group2"> 
                        <label class="control-label" for="e-name">Name:</label>  
                        <div class="edit-controls1 name-span"> 

                            <span class="edit-name medium1 green name-val"><?php echo $logged_in_user_data->name; ?></span>

                            <span class="edit-icon edit-icon1"></span>
                        </div>  
                        <div class="edit-input edit-input1 name-input">

                            <input type="text" class="input input-xxlarge required e-input name" id="name" name="name" value="<?php echo $logged_in_user_data->name; ?>"> 
                            <button type="button" name="e-submit4" id="e-submit4" class="fa-caret-right e-button editnamesubmit" value=""></button>			  
                            <div class="form-error name_validate_error">
                                <label class="error">This field is required</label>
                            </div>
                            <div class="form-error1">
                                            <label class="error">More then 50 characters not allowed</label>	
                                        </div>					  				
                                        <div class="form-error2">					  
                                            <label class="error">special characters not allowed</label>		
                                        </div>

                        </div>
                    </div> 
                    <div class="edit-group1 edit-group2">  
                        <label class="control-label" for="select01">Gender:</label>  

                        <div class="edit-controls1 gender-span">  

                            <span class="edit-name medium1 green gender-value"><?php echo $logged_in_user_data->gender; ?></span>
                            <span class="edit-icon edit-icon1"></span>
                        </div>  
                        <div class="edit-input edit-input1 gender-input">
                            <select id="select01" name="gender" class="required p-select gender">  
                                <option value="">Select</option> 
                                <option value="Male" <?php if ($logged_in_user_data->gender == 'Male') { ?>selected<?php } ?>>Male</option>
                                <option value="Female" <?php if ($logged_in_user_data->gender == 'Female') { ?>selected<?php } ?>>Female</option>  

                            </select> 
                            <button type="button" name="e-submit5" id="e-submit5" class="fa-caret-right e-button editgendersubmit" value="&#xf0da"></button>			  
                            <div class="form-error gender_validate_error" style="display:none;">
                                <label class="error">Select any Gender</label>
                            </div>			  

                        </div>
                    </div> 
                    <div class="edit-group1 edit-group2">  
                        <label class="control-label" for="select02">Age:</label>  
                        <div class="edit-controls1 age-span">  
                            <span class="edit-name medium1 green age-value"><?php echo $logged_in_user_data->age; ?></span>
                            <span class="edit-icon edit-icon1"></span>
                        </div> 
                        <div class="edit-input edit-input1 age-input">
                                                       
                            
                            <input type="text" class="input input-xxlarge required e-input age" id="e-sel" name="e-sel" value="<?php echo $logged_in_user_data->age; ?>"> 
             <button type="button" name="e-submit2" id="e-submit2" class="fa-caret-right e-button editagesubmit" value="&#xf0da"></button>
			 <div class="form-error">					     
			    <label class="error">This field is required</label>	
			 </div>
             <div class="form-error1">		
					  <label class="error">Enter numbers only</label>	
			 </div>
                            
                        </div>	
                    </div> 
                    <div class="edit-group1 edit-group2">  

                        <label class="control-label" for="ephone">Phone:</label>  

                        <div class="edit-controls1 phone-span">  
                            <span class="edit-name medium1 green phone-value"><?php echo $logged_in_user_data->phone; ?></span>
                            <span class="edit-icon edit-icon1"></span>
                        </div> 
                        <div class="edit-input edit-input1 phone-input">
                            <input type="tel" class="input input-xxlarge required e-input phone" id="ephone" name="phone" value="<?php echo $logged_in_user_data->phone; ?>"> 

                            <button type="button" name="e-submit3" id="e-submit3" class="fa-caret-right e-button editphonesubmit" value="&#xf0da"></button>			  
                            <div class="form-error phone_validation_error">
                                <label class="error">This field is required</label>
                            </div>
                            <div class="form-error1 phone_length_validation_error">
                                <label class="error">Enter your Valid Phone Number (10 digit number)</label>
                            </div>					  

                        </div>	
                    </div> 
                    <div class="edit-group1 edit-group2">  
                        <label class="control-label" for="">Email:</label>  
                        <div class="edit-controls1"> 
                            <span class="edit-name medium1 green"><?php echo $logged_in_user_data->username; ?></span>
                        </div>  
                        <div class="edit-input edit-input1">
                            <input type="email" class="input input-xxlarge required e-input" id="e-mail" name="e-mail" value="<?php echo $logged_in_user_data->username; ?>"> 

                            <button type="button" name="e-submit4" id="e-submit4" class="fa-caret-right e-button" value="&#xf0da"></button>			  
                            <div class="form-error">
                                <label class="error">This field is required</label>
                            </div>
                        </div>	
                    </div> 
                </fieldset>
            </form> 
        </div>
    </div>
</div>
