<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Business Service</h1>
            </div>


            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >

                        <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>    
                        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/multiple_uploads_style.css" />
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul>
                                                <li><a href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
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
                        <div class="business-info" style="clear:both;">
                            <form class="form-horizontal for" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/update_one_time_slots">
                                <label> Service name:</label>
                                <input type="text" id ="service_id" name="" size="5" value ="<?php echo $services['details']->services; ?>" readonly/>
                                <input type="hidden" id ="service_id" name="service_id" size="5" value ="<?php echo $services['details']->id; ?>" readonly/>
                                <label> Select date:</label>
                                <input type="date" id="slots-date-picker" name="date" value="<?php echo $services['slots'][0]->date; ?>"/>
                              <label> Select time:</label>                                
                                <div id="start-date-end-date11">
                                   <!-- <label> Select time:</label> -->

                                    <select id=""  name="slots_time">
                                        <option value="">Please Select Timings</option>
                                        <?php
                                        foreach ($services['slots'] as $keys => $values) {
                                            $slots_array[] = (date('H:i', (strtotime($values->start_time)))) . '-' . (date('H:i', (strtotime($values->end_time))));
                                            $unique_slots_array = array_unique($slots_array);
                                        }

                                        foreach ($unique_slots_array as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
                                        <?php } ?>
                                    </select>  
                                </div>
                                <div id="start-date-end-date11">
                                    <div class="add-time-block">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Start time :</label>
                                                <article>
                                                    <div class="date-pic">                
                                                        <input id="start-time" type="text" class="time slot_start_time"  name="new_start_time" />
                                                    </div>
                                                </article> 
                                            </div>
                                            <div class="col-xs-6">
                                                <label>End time :</label>
                                                <article>
                                                    <div class="date-pic">                
                                                        <input id="end-time" type="text" class="time slot_end_time"  name="new_end_time" />
                                                    </div>
                                                </article> 
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <label> Number Of Slots:</label>
                                <input type="text" id ="" size="5" value ="10" name="number_of_slots"/>

                                <label> Slots Status:</label>
                                <select id=""  name="slots_status">
                                    <option value="enable">Enable</option>
                                    <option value="disable">Disable</option>
                                </select>
                                <div class="clear"></div>
                                <input type="submit" class="button submit_buttons" value="Save changes" /> 
                            </form> 

                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
