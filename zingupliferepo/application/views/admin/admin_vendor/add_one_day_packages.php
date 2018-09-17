<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add one day packages</h3>
</div>
<div class="row-fluid tr-row">
    

    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="cs_vendor_add_one_day_pack" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/create_one_day_package">  
            <div class="edit-group3"> 
                    <input type="hidden" name="business_id" value="<?php echo $business_id; ?>" readonly="readonly">
                    <input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>" readonly="readonly">
                    <label class="control-label" for="e-name">business services</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="service_id" class="service_id required p-select valid"> 
                         <option value="">Select</option> 
                          <?php foreach ($all_services as $service) {
                    foreach ($service as $s) {  ?>
                                       
                                        <option value="<?php echo $s->service_id; ?>"><?php echo $s->services; ?></option>
                                    <?php } }?>  
                        </select> 
                         <div class="error_service_name" style="display:none; color:red;">This field is Required</div>
                                                                       
                    </div> 
                </div> 
                <div class="clear"></div> 

      <div id="start-date-end-dates"> 
      
      <div class="add-time-block2">        
        <fieldset>
            
                <div class="edit-group3 new_ctr">          

                    <label class="control-label" for="e-name">Name</label>  
                    <div class="customer-edit-input">
                       <input type="text" class="input input-xxlarge  e-input valid name_ctr" name="name[]">
 <div class="error_pacakge_name" style="display:none; color:red;">This field is Required</div> 
                    </div> 
                </div>
                 <div class="edit-group3">          

                    <label class="control-label" for="e-name">Description</label>  
                    <div class="customer-edit-input">
                       <textarea class="one_day_pack_description" name="description[]"></textarea>    
                    </div> 
                </div>
                 <div class="edit-group3">          

                    <label class="control-label" for="e-name">Duration</label>  
                    <div class="customer-edit-input">
                                                            <div class="service_duration_hrs">
                                                                <p>Hour :</p>
                                                                <select name="duration_hour[]" class="duration_hour">
                                                                    <option value="">Select</option>
                                                                    <option value="0">0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">8</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                                <div class="error_duration_hrs" style="display:none; color:red;">This field is Required</div>
                                                            </div>
                                                            <div class="service_duration_hrs">
                                                                <p>Minutes :</p>
                                                                <select name="duration_minutes[]" class="duration_minutes">
                                                                    <option value="">Select</option>
                                                                    <option value="00">00</option>
                                                                    <option value="05">05</option>
                                                                    <option value="10">10</option>
                                                                    <option value="15">15</option>
                                                                    <option value="20">20</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="35">35</option>
                                                                    <option value="40">40</option>
                                                                    <option value="45">45</option>
                                                                    <option value="50">50</option>
                                                                    <option value="55">55</option>
                                                                </select>
                                                                <div class="error_duration_mins" style="display:none; color:red;">This field is Required</div>
                                                           
                                                             </div>    
                    </div> 
                    
                </div>
                
        </fieldset>
        </div>
        </div>
        
                                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save" class="primary-button">
                </div> 
                <p class="add-button"><a href="" id="add-block2" >Add More Services</a></p>
    </form>

</div>


