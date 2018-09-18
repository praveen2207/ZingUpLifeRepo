<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Packages &amp; Treatments</h1>
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

                            <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>    
                            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/multiple_uploads_style.css" />

                            <form class="form-horizontal for" name="services" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/adding_business_services">
                                <label>Packages/Treatments</label>
                                <select id="packages" name="packages" value="<?php echo set_value('packages'); ?>">
                                    <option value="">Select</option>
                                    <?php foreach ($packages as $package) {
                                        ?>
                                        <option value="<?php echo $package->id; ?>" <?php if ($this->session->userdata('recent_program_id') == $package->id) { ?> selected <?php } ?>><?php echo $package->program; ?></option>
                                    <?php } ?>
                                    <option value="new" data-toggle="modal" data-target="#myModal">Create New</option>
                                </select>
                                <?php echo form_error('packages'); ?>
                                <br><br>
                                <label>Service</label>
                                <input type="text" name="service" value="<?php echo set_value('service'); ?>">
                                <?php echo form_error('service'); ?>
                                <label>Duration:</label>
                                <div class="col-xs-4 service_duration">
                                    <label>Hour :</label>
                                    <select name="duration_hour" value="<?php echo set_value('duration_hour'); ?>">
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
                                    <?php echo form_error('duration_hour'); ?>
                                </div>
                                <div class="col-xs-1"></div>
                                <div class="col-xs-4 service_duration">
                                    <label>Minutes :</label>
                                    <select name="duration_minutes" value="<?php echo set_value('duration_minutes'); ?>">
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
                                    <?php echo form_error('duration_minutes'); ?>
                                </div>
                                <div class="clear"></div><br>
                                <label>Price(Rs) :</label>
                                <input type="text" name="price" value="<?php echo set_value('price'); ?>">
                                <?php echo form_error('price'); ?>
                                <label>Discount (For discount in % give discount value with percent symbol(ex: 2%))</label>
                                <input type="text" name="discount" value="<?php echo set_value('discount'); ?>"/>
                                <label>Discount Duration:</label>
                                <div class="col-xs-4 service_duration">
                                    <label>Start Date :</label>
                                    <input type="date" name="discount_start_date" id="slots-date-picker1" value="<?php echo set_value('discount_start_date'); ?>"/>
                                </div>
                                <div class="col-xs-1"></div>
                                <div class="col-xs-4 service_duration">
                                    <label>End date :</label>
                                    <input type="date" name="discount_end_date" id="slots-date-picker2" value="<?php echo set_value('discount_end_date'); ?>">
                                </div>
                                <div class="clear"></div><br>
                                <label> Booking Type :</label>
                                <select name="service_type" value="<?php echo set_value('service_type'); ?>">
                                    <option value="">Select</option>
                                    <option value="hourly">Hourly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="one_time">One  Time</option>
                                </select>
                                <?php echo form_error('service_type'); ?><br><br>

                                <label>Description:</label>
                                <textarea name="description" id="service_description" cols="40" value="<?php echo set_value('description'); ?>"></textarea>
                                <?php echo form_error('description'); ?><br><br>
                                <input type="submit" value="Save Changes" class="button">





                            </form>
                            <form id="vendor_popup_package_treatment">
                            <div class="popup" style="display:none;border:1px solid black;position: fixed;top: 100px;width: 40%;margin: 0 auto; left: 0px;right: 0px;z-index:999;background:#fff;padding: 15px; ">
                                Service:<br/>
                                <select name="service_id" class="service_type">
                                    <option value="">Select</option>
                                    <?php foreach ($mapping as $key => $value) { ?>
                                        <option value="<?php echo $value->services_id; ?>"><?php echo $value->service_name; ?></option>
                                    <?php } ?>
                                </select><br>
                                Package/Treatment:<br>
                                <input type="text" class="package" name="package" style="float:none;" /><br>
                                Type:<br>
                                <select name="type" class="type">
                                    <option value="">Select</option>
                                    <option value="Offerings">Offerings</option>
                                    <option value="Packages">Packages</option>
                                    <option value="Sessions">Sessions</option>
                                </select><br>
                                <input type="button" class="button adding_package" value="submit" style="float:none;"/>

                            </div>
                          </form>
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>


<div class="mask" style="display:none;width: 100%;
     height: 100%;
     position: fixed;
     top: 0px;
     left: 0px;
     background: black;
     opacity: 0.8;">

</div>    
