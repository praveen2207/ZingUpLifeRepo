<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Edit One day packages</h1>
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
                                              <li><a class="active" href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <div class="business-info" style="clear:both;">
                            <form class="form-horizontal for" name="service" id="vendor_one_day_pacakge_edit" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/update_one_day_packages">
                                
                                <input type="hidden" name="pacakge_id" size="5" value ="<?php echo $package_detail[0]->id; ?>" readonly/>
                                <label> Package name:</label>
                                <input type="text" name="package_name" class="package_name" value="<?php echo $package_detail[0]->name; ?>"/>
                                <div class="error_pacakge_name" style="display:none; color:red;">This field is required</div>
                                                          
                               
                                <label> Description:</label>
                                <textarea name="description"><?php echo $package_detail[0]->description; ?></textarea> 
                                  <?php $duration = explode(':',$package_detail[0]->duration);
                                       $duration_hr = $duration[0];
                                        $duration_min = $duration[1];
                                   ?>
                                 <div class="col-xs-12">
                                                        <label>Duration:</label>
                                                        <div class="col-xs-5">
                                                            <div class="col-xs-5 service_duration">
                                                                <label>Hour :</label>
                                                                <select name="duration_hour" class="duration_hour">
                                                                    <option value="">Select</option>
                                                                    <option value="0" <?php if($duration_hr == 0) {?> selected <?php } ?>>0</option>
                                                                    <option value="1" <?php if($duration_hr == 1) {?> selected <?php } ?>>1</option>
                                                                    <option value="2" <?php if($duration_hr == 2) {?> selected <?php } ?>>2</option>
                                                                    <option value="3" <?php if($duration_hr == 3) {?> selected <?php } ?>>3</option>
                                                                    <option value="4" <?php if($duration_hr == 4) {?> selected <?php } ?>>4</option>
                                                                    <option value="5" <?php if($duration_hr == 5) {?> selected <?php } ?>>5</option>
                                                                    <option value="6" <?php if($duration_hr == 6) {?> selected <?php } ?>>6</option>
                                                                    <option value="7" <?php if($duration_hr == 7) {?> selected <?php } ?>>7</option>
                                                                    <option value="8" <?php if($duration_hr == 8) {?> selected <?php } ?>>8</option>
                                                                    <option value="9" <?php if($duration_hr == 9) {?> selected <?php } ?>>9</option>
                                                                    <option value="10" <?php if($duration_hr == 10) {?> selected <?php } ?>>10</option>
                                                                    <option value="11" <?php if($duration_hr == 11) {?> selected <?php } ?>>11</option>
                                                                    <option value="12" <?php if($duration_hr == 12) {?> selected <?php } ?>>12</option>
                                                                </select>
                                                                <div class="error_duration_hrs" style="display:none; color:red;">This field is required</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5">
                                                            <div class="col-xs-5 service_duration">
                                                                <label>Minutes :</label>
                                                                <select name="duration_minutes" class="duration_minutes">
                                                                    <option value="">Select</option>
                                                                    <option value="00" <?php if($duration_min == 00) {?> selected <?php } ?>>00</option>
                                                                    <option value="05" <?php if($duration_min == 05) {?> selected <?php } ?>>05</option>
                                                                    <option value="10" <?php if($duration_min == 10) {?> selected <?php } ?>>10</option>
                                                                    <option value="15" <?php if($duration_min == 15) {?> selected <?php } ?>>15</option>
                                                                    <option value="20" <?php if($duration_min == 20) {?> selected <?php } ?>>20</option>
                                                                    <option value="25" <?php if($duration_min == 25) {?> selected <?php } ?>>25</option>
                                                                    <option value="30" <?php if($duration_min == 30) {?> selected <?php } ?>>30</option>
                                                                    <option value="35" <?php if($duration_min == 35) {?> selected <?php } ?>>35</option>
                                                                    <option value="40" <?php if($duration_min == 40) {?> selected <?php } ?>>40</option>
                                                                    <option value="45" <?php if($duration_min == 45) {?> selected <?php } ?>>45</option>
                                                                    <option value="50" <?php if($duration_min == 50) {?> selected <?php } ?>>50</option>
                                                                    <option value="55" <?php if($duration_min == 55) {?> selected <?php } ?>>55</option>
                                                                </select>
                                                                  <div class="error_duration_mins" style="display:none; color:red;">This field is required</div>
                                                             </div>
                                                        </div>
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
