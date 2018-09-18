<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Business Hours</h1>
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
                                                <li><a href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/business_service_slots">Business Hours</a></li>                                                  
                                              <li><a href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <?php
                        $error_message = $this->session->flashdata('slot_message');
                        if ($error_message) {
                            ?>
                            <div class="message span8 pwd-msg">

                                <p class="para-small for-para" style="color:red;"><?php echo $error_message; ?></p>

                            </div> 
                        <?php } ?>
                        <div class="business-info" style="clear:both;">
                            <form class="form-horizontal for" name="serviceslots" id="vendor_business_hrs" method="post" action="<?php echo base_url(); ?>vendor/adding_business_service_slots">
                                <label>Packages/Treatments :</label>
                                <select name="programs" class="programs">
                                    <option value="">Select</option> 
                                    <?php foreach ($packages as $package) { ?>
                                        <option value="<?php echo $package->id; ?>"><?php echo $package->program; ?></option>
                                    <?php } ?>
                                </select>
                                <label>Business Services :</label>
                                <select class="services" name="services" id="services_listing">
                                    <option value="">Select</option>                                 
                                </select>
                                <label>Number of slots :</label>
                                <input type="text" name="no_slots" value="2">
                                <label>Business Hours :<br />
                                    <div class="col-xs-4">
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
                                               <div class="error_start_less_end" style="display:none; color:red;">Start time can not be greater then end time</div> 
                                            </div>
                                        </div>
                                        <p class="add-button"><a href="" id="add-block" >Add More Slots</a></p>
                                    </div>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-4">

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
                                              <div class="error_start_less_end1" style="display:none; color:red;">Start time can not be greater then end time</div>
                                            </div>
                                        </div>
                                        <p class="add-button"><a href="" id="add-block1" >Add More Slots</a></p>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-xs-8">
                                        <input type="submit" class="button" value="Save">
                                    </div>


                            </form>
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

