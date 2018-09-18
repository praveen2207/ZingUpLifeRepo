<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add Business service one time slot</h3>
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

    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="cs_vendor_one_time_slots" name="serviceslots" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>cs/business_service_adding_slot">  
        <fieldset>
            <div class="clear">


                <input type="hidden" name="service_id" value="<?php echo $service_details['details']->id; ?>" />
              

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Services</label>
                    <div class="customer-edit-input">
                        <input type="text" name="service_name" value="<?php echo $service_details['details']->services; ?>" readonly="readonly" />   
                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Number of slots</label>
                    <div class="customer-edit-input">
                        <input type="text" class="input required e-input valid" name="no_slots" value="2">

                    </div>
                </div>
                 <div class="edit-group3">          

                    <label class="control-label" for="e-name">Date</label>
                    <div class="customer-edit-input">
                        <input type="date" id="slots-date-picker" name="date"/>
                    </div>
                </div>
 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name"></label>
                    <div class="customer-edit-input slots_weekdays">
                        <div class="col-xs-4 slot_weekdays_div">
                                                            
                            <!----->
                            <div id="start-date-end-date">
                                <div class="add-time-block">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="control-label" for="e-name">Start time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="start-time" type="text" class="time slot_start_time"  name="slot[start_time][]" />
                                                    <div class="error_start_time_validate" style="display:none; color:red;">This field is required</div>
                                                </div>
                                            </article> 
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="control-label" for="e-name">End time :</label>
                                            <article>
                                                <div class="date-pic">                
                                                    <input id="end-time" type="text" class="time slot_end_time"  name="slot[end_time][]" />
                                                    <div class="error_end_time_validate" style="display:none; color:red;">This field is required</div>
                                                </div>
                                            </article> 
                                        </div>  
                                    </div>
                                     <div class="error_start_less_end" style="display:none; color:red;">Start time can not be greater then end time</div>
                                        
                                </div>
                            </div>
                            <p class="add-button"><a href="" id="add-block" >Add More Slots</a></p>
                        </div>
                       
                    </div>
                </div>
                
                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Submit" class="primary-button">
                </div> 
        </fieldset>
    </form>






</div>

