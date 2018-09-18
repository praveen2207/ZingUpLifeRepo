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
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_slots">Business Hours</a></li>                                                  
                                                <li><a  class="active"  href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
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
                            <form class="form-horizontal for" name="serviceslots" id="vendor_add_one_day_package_form" method="post" action="<?php echo base_url(); ?>vendor/create_one_day_package">
                                <label>Business Services :</label>
                                <select name="service_id" class="service_id">
                                    <option value="">Please Select</option>
                                    <?php foreach ($all_services[0] as $key => $value) { ?>
                                        <option value="<?php echo $value->service_id; ?>"><?php echo $value->services; ?></option>
                                    <?php } ?>
                                </select><br/><br/>
                                <div class="error_service_name" style="display:none; color:red;">This field is required</div>
                                <div class="">
                                    <div id="start-date-end-dates">
                                        <div class="add-time-block2">
                                            <fieldset>
                                                <div class="row new_ctr">
                                                    <div class="col-xs-12">
                                                        <label>Name:</label>
                                                        <input type="text" id="" name="name[]" class="name_ctr"/>
                                                       <div class="error_pacakge_name" style="display:none; color:red;">This field is required</div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label>Description:</label>
<!--                                                        <textarea name="description[]" class="service_description" cols="40"></textarea>-->
                                                        <textarea name="description[]" class="" cols="40"></textarea>
                                                        <?php echo form_error('description'); ?><br><br>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label>Duration:</label>
                                                        <div class="col-xs-5">
                                                            <div class="col-xs-5 service_duration">
                                                                <label>Hour :</label>
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
                                                              <div class="error_duration_hrs" style="display:none; color:red;">This field is required</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <div class="col-xs-5 service_duration">
                                                                <label>Minutes :</label>
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
                                                              <div class="error_duration_mins" style="display:none; color:red;">This field is required</div>
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                    </div>
                                    <div class="col-xs-8" id="button-ctr">
                                        <p class="add-button"><a href="" id="add-block2" >Add More Services</a></p>
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

