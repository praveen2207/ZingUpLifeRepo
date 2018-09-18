<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Hours</h3>
</div>
<div class="row-fluid tr-row">
    
     <?php
    $error_message = $this->session->flashdata('service_slot_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>  

    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="admin_vendor_service_slots" name="serviceslots" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/adding_business_service_slots">  
        <fieldset>
            <div class="clear">


                <input type="hidden" name="business_id" value="<?php echo $business_id; ?>" />
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Packages/Treatments</label>
                    <div class="customer-edit-input">
                        <select id="select01" name="programs" class="required p-select valid programs">
                            <option value="">Select</option> 
                            <?php foreach ($packages as $package) { ?>
                                <option value="<?php echo $package->id; ?>"><?php echo $package->program; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Services</label>
                    <div class="customer-edit-input">
                        <select class="services" name="services" id="services_listing" class="required p-select valid">
                            <option value="">Select</option>                                 
                        </select>
                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Number of slots</label>
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="no_slots" value="2">

                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Hours</label>
                    <div class="customer-edit-input slots_weekdays">
                        <div class="col-xs-4 slot_weekdays_div">
                            <!----->
                            <select id="slot_days" multiple="true" name="weekdays[day][]" class="required p-select valid">
                                <option value="Mon">Monday</option>
                                <option value="Tue">Tuesday</option>
                                <option value="Wed">Wednesday</option>
                                <option value="Thu">Thursday</option>
                                <option value="Fri">Friday</option>
                            </select>                                    
                            <!----->
                            <div id="start-date-end-date">
                                <div class="add-time-block">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="control-label" for="e-name">Start time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="start-time" type="text" class="time slot_start_time"  name="weekdays[start_time][]" />
                                                     <div class="error_start_time" style="display:none; color:red;">This field is required</div>
                                                </div>
                                            </article> 
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="control-label" for="e-name">End time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="end-time" type="text" class="time slot_end_time"  name="weekdays[end_time][]" />
                                                     <div class="error_end_time" style="display:none; color:red;">This field is required</div>
                                                </div>
                                            </article> 
                                        </div>  
                                    </div>
                                     <div class="error_start_less_end" style="display:none; color:red;">Start time can not be greater then end time</div>
                                        
                                </div>
                            </div>
                            <p class="add-button"><a href="" id="add-block" >Add More Slots</a></p>
                        </div>
                        <div class="customer-edit-input slot-weekends_div">

                        <select id="slot_weekends" multiple="multiple"  name="weekends[day][]">
                            <option value="Sat">Saturday</option>
                            <option value="Sun">Sunday</option>
                        </select>                                    

                        <div id="start-date-end-date1">
                            <div class="add-time-block1">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label class="control-label" for="e-name">Start time :</label>
                                        <article>
                                            <div class="date-pic">                
                                                <input id="start-time1" type="text" class="time slot_start_time1" name="weekends[start_time][]" />
                                                <div class="error_start_time1" style="display:none; color:red;">This field is required</div>
                                            </div>
                                        </article> 
                                    </div>
                                    <div class="col-xs-6">
                                        <label class="control-label" for="e-name">End time :</label>
                                        <article>
                                            <div class="date-pic">                
                                                <input id="end-time1" type="text" class="time slot_end_time1"  name="weekends[end_time][]" />
                                               <div class="error_end_time1" style="display:none; color:red;">This field is required</div>
                                            </div>
                                        </article> 
                                    </div>  
                                </div>
                                 <div class="error_start_less_end1" style="display:none; color:red;">Start time can not be greater then end time</div>
                                        
                            </div>
                        </div>
                            <p class="add-button"><a href="" id="add-block1" >Add More Slots</a></p>
                    </div>
                    </div>
                </div>
                
                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Submit" class="primary-button">
                </div> 
        </fieldset>
    </form>






</div>



