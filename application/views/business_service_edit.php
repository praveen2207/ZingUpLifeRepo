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
                        <?php if ($services['details']->service_type == 'monthly') { ?>
                            <div class="add_new"><a href="<?php echo base_url(); ?>vendor/offerings_memberships/<?php echo $services['details']->id; ?>" class="button">Add Membership</a></div>
                        <?php } elseif ($services['details']->service_type == 'one_time' && count($services['slots']) == 0) { ?>
                            <div class="add_new"><a href="<?php echo base_url(); ?>vendor/business_service_add_slot/<?php echo $services['details']->id; ?>" class="button">Add One Time Slot</a></div>
                        <?php } elseif ($services['details']->service_type == 'hourly') { ?>
                            <div class="add_new"><a href="<?php echo base_url(); ?>vendor/business_service_slots" class="button">Add Business Hours</a></div>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <div class="add_new"><a href="<?php echo base_url(); ?>vendor/offerings_gallery/<?php echo $services['details']->id; ?>" class="button">Gallery</a></div>
                        <?php
                        $membership_added_message = $this->session->flashdata('membership_updated_message');
                        if (isset($membership_added_message)) {
                            ?>

                            <!--                            <div class="row-fluid pr-success">-->
                            <div class="message">
                                <h3 class="congratulations message-head">Congratulations !!!</h3>
                                <p class="para-small for-para"><?php echo $membership_added_message; ?></p>
                            </div>
                            <!--                            </div>-->
                        <?php } ?>
                        <div class="business-info" style="clear:both;">
                            <form class="form-horizontal for" name="service" method="post" id="vendor_business_service_edit_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/updating_business_services">
                                <label> Service name:</label>
                                <input type="hidden" id = "service_id" name="service_id" size="5" value ="<?php echo $services['details']->id; ?>"  />
                                <input type="text" name="service_name" class="service_name" size="5" value="<?php echo $services['details']->services; ?>" style="float:none;"/><br>
                                <label>Number of slots:</label><input type="text" name="no_slots" size="5" value="2" style="float:none;"/><br>
                                <label>Duration:</label>
                                <?php $duration = explode(':', $services['details']->duration); ?>
                                <div class="col-xs-4 service_duration">
                                    <label>Hour :</label>
                                    <select name="duration_hour">
                                        <option value="">Select</option>
                                        <option value="0" <?php if ($duration[0] == '0') { ?>selected<?php } ?>>0</option>
                                        <option value="1" <?php if ($duration[0] == '1') { ?>selected<?php } ?>>1</option>
                                        <option value="2" <?php if ($duration[0] == '2') { ?>selected<?php } ?>>2</option>
                                        <option value="3" <?php if ($duration[0] == '3') { ?>selected<?php } ?>>3</option>
                                        <option value="4" <?php if ($duration[0] == '4') { ?>selected<?php } ?>>4</option>
                                        <option value="5" <?php if ($duration[0] == '5') { ?>selected<?php } ?>>5</option>
                                        <option value="6" <?php if ($duration[0] == '6') { ?>selected<?php } ?>>6</option>
                                        <option value="7" <?php if ($duration[0] == '7') { ?>selected<?php } ?>>7</option>
                                        <option value="8" <?php if ($duration[0] == '8') { ?>selected<?php } ?>>8</option>
                                        <option value="9" <?php if ($duration[0] == '9') { ?>selected<?php } ?>>8</option>
                                        <option value="10" <?php if ($duration[0] == '10') { ?>selected<?php } ?>>10</option>
                                        <option value="11" <?php if ($duration[0] == '11') { ?>selected<?php } ?>>11</option>
                                        <option value="12" <?php if ($duration[0] == '12') { ?>selected<?php } ?>>12</option>
                                    </select>
                                    <?php echo form_error('duration_hour'); ?>
                                </div>
                                <div class="col-xs-1"></div>
                                <div class="col-xs-4 service_duration">
                                    <label>Minutes :</label>
                                    <select name="duration_minutes">
                                        <option value="">Select</option>
                                        <option value="00" <?php if ($duration[1] == '00') { ?>selected<?php } ?>>00</option>
                                        <option value="05" <?php if ($duration[1] == '05') { ?>selected<?php } ?>>05</option>
                                        <option value="10" <?php if ($duration[1] == '10') { ?>selected<?php } ?>>10</option>
                                        <option value="15" <?php if ($duration[1] == '15') { ?>selected<?php } ?>>15</option>
                                        <option value="20" <?php if ($duration[1] == '20') { ?>selected<?php } ?>>20</option>
                                        <option value="25" <?php if ($duration[1] == '25') { ?>selected<?php } ?>>25</option>
                                        <option value="30" <?php if ($duration[1] == '30') { ?>selected<?php } ?>>30</option>
                                        <option value="35" <?php if ($duration[1] == '35') { ?>selected<?php } ?>>35</option>
                                        <option value="40" <?php if ($duration[1] == '40') { ?>selected<?php } ?>>40</option>
                                        <option value="45" <?php if ($duration[1] == '45') { ?>selected<?php } ?>>45</option>
                                        <option value="50" <?php if ($duration[1] == '50') { ?>selected<?php } ?>>50</option>
                                        <option value="55" <?php if ($duration[1] == '55') { ?>selected<?php } ?>>55</option>
                                    </select>
                                    <?php echo form_error('duration_minutes'); ?>
                                </div>
                                <div class="clear"></div><br>
                                <label> Price:</label> <input type="text" name="price" size="5" value="<?php echo $services['details']->price; ?>" style="float:none;"/><br>
                                  <?php echo form_error('price'); ?>
                                <label>Discount (For discount in % give discount value with percent symbol(ex: 2%))</label>
                                <input type="text" name="discount" class="service_discount" value="<?php echo $services['details']->discount; ?>"/>
                                <label for="service_name" generated="true" class="error error_service_discount" style="display:none;">This field should contain only numbers and %.</label>
                                <label>Discount Duration:</label>
                                <div class="col-xs-4 service_duration">
                                    <label>Start Date :</label>
                                    <input type="text" class="service_discount_start_date" name="discount_start_date" id="slots-date-picker1" value="<?php echo $services['details']->discount_start_date; ?>"/>
                      <label for="service_name" generated="true" class="error error_start_date" style="display:none;">This field is required.</label>
                       <label for="service_name" generated="true" class="error error_start_date_greater" style="display:none;">Start date should not be greater than end date.</label>
                                </div>
                                <div class="col-xs-1"></div>
                                <div class="col-xs-4 service_duration">
                                    <label>End date :</label>
                                    <input type="text" class="service_discount_end_date" name="discount_end_date" id="slots-date-picker2" value="<?php echo $services['details']->discount_end_date; ?>"/>
                         <label for="service_name" generated="true" class="error error_end_date" style="display:none;">This field is required.</label>
                         <label for="service_name" generated="true" class="error error_end_date_less" style="display:none;">End date should not be less than start date.</label>  
                                </div>
                                <div class="clear"></div><br>
                                <label> Booking Type :</label>
                                <select name="service_type">
                                    <option value="">Select</option>
                                    <option value="hourly" <?php if ($services['details']->service_type == 'hourly') { ?>selected <?php } ?>>Hourly</option>
                                    <option value="monthly" <?php if ($services['details']->service_type == 'monthly') { ?>selected <?php } ?>>Monthly</option>
                                    <option value="one_time" <?php if ($services['details']->service_type == 'one_time') { ?>selected <?php } ?>>One Time</option>
                                </select>
                                <?php echo form_error('service_type'); ?><br><br>
                                <label> Description:</label> <textarea name="description" id="service_description"><?php echo $services['details']->description; ?></textarea><br>

                                <?php if ($services['details']->service_type == 'hourly') { ?>
                                    <label>Business Hours :</label>
                                    <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">


                                        <thead>
                                            <tr>
                                                <th>Days</th>
                                                <th>Slots</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($services['slots'] as $key => $value) {
                                                if (!empty($value)) {
                                                    if ($key == '1') {
                                                        $day = 'Monday';
                                                    } elseif ($key == '2') {
                                                        $day = 'Tuesday';
                                                    } elseif ($key == '3') {
                                                        $day = 'Wednesday';
                                                    } elseif ($key == '4') {
                                                        $day = 'Thursday';
                                                    } elseif ($key == '5') {
                                                        $day = 'Friday';
                                                    } elseif ($key == '6') {
                                                        $day = 'Saturday';
                                                    } elseif ($key == '7') {
                                                        $day = 'Sunday';
                                                    }
                                                    $ids_array = array();
                                                    $slots_array = array();
                                                    foreach ($value as $keys => $values) {
                                                        $ids_array[] = $values->id;
                                                        $ids = implode(',', $ids_array);
                                                        $slots_array[] = (date('H:i', (strtotime($values->start_time)))) . ' - ' . (date('H:i', (strtotime($values->end_time))));
                                                        $unique_slots_array = array_unique($slots_array);
                                                        $slots = implode(', ', $unique_slots_array);
                                                    }
                                                    ?>
                                                    <tr style="border:solid 1px #000;">
                                                        <td style="border:solid 1px #000;"><?php echo $day; ?></td> 
                                                        <td style="border:solid 1px #000;"><?php echo $slots; ?></td> 
                                                        <td style="border:solid 1px #000;">
                                                            <a class="terms_service" href="<?php echo base_url(); ?>vendor/service_slots_edit/<?php echo $services['details']->id . '_' . $key; ?>">
                                                                <strong>Edit</strong>
                                                            </a>
                                                            /<a href="" class="service_slots_delete" id="<?php echo $ids; ?>">
                                                                <strong>Delete</strong>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                <?php } elseif ($services['details']->service_type == 'one_time') { ?>
                                    <label>One Time Slot :</label>
                                    <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Slots</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($services['slots'] as $key => $value) {
                                                if (!empty($value)) {
                                                    if ($key == '1') {
                                                        $day = 'Monday';
                                                    } elseif ($key == '2') {
                                                        $day = 'Tuesday';
                                                    } elseif ($key == '3') {
                                                        $day = 'Wednesday';
                                                    } elseif ($key == '4') {
                                                        $day = 'Thursday';
                                                    } elseif ($key == '5') {
                                                        $day = 'Friday';
                                                    } elseif ($key == '6') {
                                                        $day = 'Saturday';
                                                    } elseif ($key == '7') {
                                                        $day = 'Sunday';
                                                    }
                                                    $ids_array = array();
                                                    $slots_array = array();
                                                    foreach ($value as $keys => $values) {
                                                        $ids_array[] = $values->id;
                                                        $ids = implode(',', $ids_array);
                                                        $slots_array[] = (date('H:i', (strtotime($values->start_time)))) . ' - ' . (date('H:i', (strtotime($values->end_time))));
                                                        $unique_slots_array = array_unique($slots_array);
                                                        $slots = implode(', ', $unique_slots_array);
                                                    }
                                                    ?>
                                                    <tr style="border:solid 1px #000;">
                                                        <td style="border:solid 1px #000;"><?php echo $values->date; ?></td> 
                                                        <td style="border:solid 1px #000;"><?php echo $slots; ?></td> 
                                                        <td style="border:solid 1px #000;">
                                                            <a class="terms_service" href="<?php echo base_url(); ?>vendor/one_time_service_slots_edit/<?php echo $services['details']->id . '_' . $values->id; ?>">
                                                                <strong>Edit</strong>
                                                            </a>
                                                            /<a href="" class="one_time_service_slots_delete" id="<?php echo $ids; ?>">
                                                                <strong>Delete</strong>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                <?php } else { ?>
                                    <label>Memberships :</label>
                                    <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Membership</th>
                                                <th>Duration</th>
                                                <th>Price</th>
                                                <th>Number Of Slots</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($services['memberships'] as $key => $value) {
                                                ?>
                                                <tr style="border:solid 1px #000;">
                                                    <td style="border:solid 1px #000;"><?php echo $value->membership; ?></td> 
                                                    <td style="border:solid 1px #000;"><?php echo $value->duration; ?></td> 
                                                    <td style="border:solid 1px #000;"><?php echo $value->fees; ?></td> 
                                                    <td style="border:solid 1px #000;"><?php echo $value->max_number_of_members; ?></td> 
                                                    <td style="border:solid 1px #000;">
                                                        <a class="terms_service" href="<?php echo base_url(); ?>vendor/edit_offerings_memberships/<?php echo $value->id; ?>">
                                                            <strong>Edit</strong>
                                                        </a>
                                                        /<a href="" class="membership_delete" id="<?php echo $value->id; ?>">
                                                            <strong>Delete</strong>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                <?php } ?>
                                <input type="submit" class="button" value="Save changes" /> 
                            </form> 

                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('body').on('click', '.service_slots_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these slots!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/service_slots_delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;


    });
    $('body').on('click', '.membership_delete', function () {

        var id = $(this).attr('id');

        if (confirm("Are you sure you want to delete these membership!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/delete_offerings_memberships',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;

    });
    $('body').on('click', '.one_time_service_slots_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these slots!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/one_time_service_slots_delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    location.reload();
                }
            });
        }
        return false;


    });
</script>
