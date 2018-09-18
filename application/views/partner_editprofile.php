
<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Profile</h1>
            </div>

            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul>
                                                <li><a class="active"href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_slots">Business Hours</a></li>                                                  
                                                <li><a href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <div class="profile-list">
                            <div class="profile-list-inner">
                                <ul class="row">
<!--                                    <li class="col-xs-12">
                                        <div class="profile-list-ind">
                                            <div class="row">
                                                <div class="message pr-message" style="display:none;">

                                                    <h3 class="congratulations message-head">You've successfully Edited your Profile Details!</h3>


                                                </div><br><br>
                                                <input type="hidden" id = "vendor_id" value ="<?php echo $logged_in_user_data->id; ?>" />
                                                	<div class="col-xs-4">                                         		
                                                                                                            First Name :
                                                    </div>
                                                    <div class="col-xs-4 first_name">                                         		
                                                        <strong><?php echo $logged_in_user_data->first_name; ?></strong>
                                                    </div>
                                                    <div class="col-xs-4 firstname_edit">                                         		
                                                         <span class="vendor-name-val"><img src="<?php echo base_url(); ?>assets/images/edit-small.png" alt="" /></span>
                                 
                                                     </div>
                                                    <div class="edit-input firstname-input">
    
                                <input type="text" class="input input-xxlarge required e-input name" id="name" name="name" value="<?php echo $logged_in_user_data->first_name; ?>"> 
                                <button type="button" name="e-submit4" id="e-submit4" class="fa-caret-right e-button editvendornamesubmit" value=""></button>			  
                                
                            </div>
                                                </div>
                                                </div>
                                            </li>
                                            <li class="col-xs-12">
                                                    <div class="profile-list-ind">
                                                    <div class="row">
                                                    <div class="col-xs-4 ">                                         		
                                                                                                            Last Name :
                                                    </div>
                                                   <div class="col-xs-4 last_name">                                         		
                                                        <strong><?php echo $logged_in_user_data->last_name; ?></strong>
    
                                                    </div>
                                                      <div class="col-xs-4 lastname_edit">                                         		
                                                           <span class="vendor-lastname-val"><img src="<?php echo base_url(); ?>assets/images/edit-small.png" alt="" /></span>
                                    
                                                       </div> 
                                                    <div class="edit-input lastname-input">
    
                                <input type="text" class="input input-xxlarge required e-input lastname" id="lastname" name="lastname" value="<?php echo $logged_in_user_data->last_name; ?>"> 
                                <button type="button" name="e-submit4" id="e-submit4" class="fa-caret-right e-button editvendorlastnamesubmit" value=""></button>			  
                                
                            </div> 
                                            </div>
                                        </div>
                                    </li>-->
                                    <li class="col-xs-12">
                                        <div class="profile-list-ind">
                                            <div class="row">
                                                <div class="col-xs-4">                                         		
                                                    Email :
                                                </div>
                                                <div class="col-xs-4">                                         		
                                                    <strong><?php echo $logged_in_user_data->username; ?></strong>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </li>

                                </ul>

                            </div>
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>