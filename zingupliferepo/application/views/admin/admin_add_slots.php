<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add Business Hours</h3>
</div>

<div class="row-fluid user-detail-row1 add_vendor_form">
    <?php
    $validate_email_error_message = $this->session->flashdata('validate_email_error_message');
    if (isset($validate_email_error_message)) {
        ?>
        <div class="message pr-message error_messages">
            <h3 class="congratulations message-head">Error !!!</h3>
            <p class="para-small for-para"><?php echo $validate_email_error_message; ?></p>
        </div>
    <?php } ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/create_slots" method="post">  
        <fieldset>
            <input type="hidden" class="" name="service_id" value="<?php echo $id; ?>"> 
            <div class="clear">

                <div class="edit-group3">  
                    <label class="control-label" for="ename">Offering Service:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="services" value="<?php echo $offering_details->services;?>" readonly> 
                        <?php echo form_error('services'); ?>
                    </div>
                </div> 

                <div class="edit-group3">  
                    <label class="control-label" for="ename">Number of Slots:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="no_slots" value="10"> 
                        <?php echo form_error('no_slots'); ?>
                    </div>
                </div> 
                <div class="edit-group3 business_hours_ctr">  
                    <label class="control-label" for="ename">Business Hours:</label>  
                    <div class="customer-edit-input2">
                        <div class="left-side">
                            <h5>Weekdays</h5>
                            <!----->
                            <select id="check-text" multiple="multiple" name="weekdays[day][]">
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
                                            <label>Start time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="start-time" type="text" class="time slot_start_time"  name="weekdays[start_time][]" />
                                                </div>
                                            </article> 
                                        </div>
                                        <div class="col-xs-6">
                                            <label>End time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="end-time" type="text" class="time slot_end_time"  name="weekdays[end_time][]" />
                                                </div>
                                            </article> 
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <p class="add-button"><a href="" id="add-block" >Add More Slots</a></p>
                        </div>
                        <!--                        <div class="col-xs-2"></div>-->
                        <div class="right-side">
                            <h5>Weekends</h5>
                            <select id="check-text1" multiple="multiple"  name="weekends[day][]">
                                <option value="Sat">Saturday</option>
                                <option value="Sun">Sunday</option>
                            </select>                                    

                            <div id="start-date-end-date1">
                                <div class="add-time-block1">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Start time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="start-time1" type="text" class="time slot_start_time1" name="weekends[start_time][]" />
                                                </div>
                                            </article> 
                                        </div>
                                        <div class="col-xs-6">
                                            <label>End time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="end-time1" type="text" class="time slot_end_time1"  name="weekends[end_time][]" />
                                                </div>
                                            </article> 
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <p class="add-button"><a href="" id="add-block1" >Add More Slots</a></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div> 

                <div class="customer-button-group customer-button-group1"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="">
                        <input type="submit" name="submit" id="submit" value="Save" class="primary-button">
                     </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>