
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Information</h3>
</div>
<div class="row-fluid tr-row">


    <?php
    $error_message = $this->session->flashdata('business_info_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>   
    <div class="add_new"><a href="<?php echo base_url(); ?>admin/view_business_gallery/<?php echo $business_info['business']->id; ?> ">View Gallery</a></div>
    <form class="form-horizontal for user-detail-row1 partner1 infob1" id="admin_business_info_form" name="get_started" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/adding_business_information">  
        <fieldset>
            <div class="clear">
                       
                    <input type="hidden" name="id" value="<?php echo $business_info['business']->id; ?>" />
                    <input type="hidden" name="vendor_id" value="<?php echo $business_info['partner']->id; ?>" />
                    <div class="edit-group3">          

                    <label class="control-label" for="e-name">What Business type are you?</label>  
                    <div class="customer-edit-input">
                       
                    </div> 
                </div>
                 <div class="edit-group3">          

                    <label class="control-label" for="e-name">Select the services you provide. (You may select multiple services).</label>  
                    <div class="customer-edit-input">
                    <ul class="cs_business_services">
                       <?php
                                $count = 0;
                                foreach ($services as $service) {
                                    $mapping = $business_info['mapping'];
                                    ?>
                                    <?php
                                    for ($i = 0; $i < count($mapping); $i++) {
                                        $map = $mapping[$i];
                                        if ($service->id == $map->services_id) {
                                            $check = true;
                                            break;
                                        } else
                                            $check = false;
                                    }
                                    ?>
                                    <li class="choose_service">
                                        <input type="checkbox" class="input input-xxlarge required e-input valid" name="business_type[]" value="<?php echo $service->id?>" <?php if(isset($check)){if($check =='true') { ?> checked <?php } }?> />
                                        <?php echo $service->service_name; ?>
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
 <label class="error" id="admin_business_info_type"  style="display:none;color:red;" generated="true" for="name">Business type is Required.</label>
                    </div> 
                </div>
                 <div class="edit-group3">  
                    <label class="control-label" for="e-name">Business name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="business_name" value="<?php echo $business_info['business']->name; ?>">
                     <?php echo form_error('business_name'); ?>
                    </div> 
                </div> 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Phone(10 digits)</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="phone" value="<?php echo $business_info['business']->phone; ?>">
                    <?php echo form_error('phone'); ?>
                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business logo</label>  
                    <div class="customer-edit-input">

                        <input type="file" style="float:none;" name="userfile"/>
                        <input type="hidden" name="old_logo" value="<?php echo $business_info['business']->logo; ?>" />

                    </div>

                </div>
                <div class="edit-group3">
                    <label class="control-label" for="e-name"></label>  
                    <div class="customer-edit-input">
                        <?php
                        $filename = "assets/uploads/business_providers/logo/" . $business_info['partner']->id . "/" . $business_info['business']->logo;
                        if ($business_info['business']->logo) {
                            if (file_exists($filename)) {
                                ?>
                                <img src="<?php echo base_url(); ?>assets/uploads/business_providers/logo/<?php echo $business_info['partner']->id; ?>/<?php echo $business_info['business']->logo; ?>" style="width:80px; height:45px;" />
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Email</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="email" value="<?php echo $business_info['business']->email; ?>">
                     <?php echo form_error('email'); ?>
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Website</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="website" value="<?php echo $business_info['business']->website; ?>">

                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Description</label>  
                    <div class="customer-edit-input">
                        <textarea name="description" value="" id="cs_description"><?php echo $business_info['business']->description; ?></textarea>
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Location Area</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="area" class="required p-select valid">  
                            <option value="">Select Area</option>  
                            <?php foreach ($locations as $location) { ?>
                                <option value="<?php echo $location->id . '/' . $location->suburb; ?>" <?php
                                if ($business_info['business']->suburb == $location->id) {
                                    echo 'selected';
                                }
                                ?> ><?php echo $location->suburb; ?></option>
                                    <?php } ?>
                        </select> 
                         <?php echo form_error('area'); ?>
                    </div> 
                </div>



                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Landmark</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="address1" value="<?php echo $business_info['business']->street1; ?>">

                    </div> 
                </div>


                <div class="edit-group3 txt-ar">          

                    <label class="control-label" for="e-name">Address</label>  
                    <div class="customer-edit-input">
                        <textarea name="address2"><?php echo $business_info['business']->street2; ?></textarea>

                    </div> 
                </div>



                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Country</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="country" class="required p-select valid"> 
                            <option value="India" selected>India</option>
                        </select> 
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">State</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="state" class="required p-select valid"> 
                            <option value="Karnataka" selected>Karnataka</option> 
                        </select> 
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">City</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="city" class="required p-select valid">
                            <option value="Banglore" selected>Banglore</option>
                        </select> 
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Zipcode</label>  
                    <div class="customer-edit-input">
                        <input id="change_zipcode" type="text" class="input input-xxlarge required e-input valid" name="zipcode" value="<?php echo $business_info['business']->zipcode; ?>">
  <?php echo form_error('zipcode'); ?>
                    </div> 
                </div>

                <div class="edit-group3 edt3">          
                    <label class="control-label" for="e-name"> </label>

                    <div class="customer-edit-input lat_long lbl_bui">
                        <label class="control-label" for="e-name">  Enter your latitude and longitude to appear in search </label>
                        <label class="control-label">  <a target="_blank" href="http://mondeca.com/index.php/en/any-place-en">Find lat/long</a> OR</label> 
                        <label class="control-label lbl-btn" onclick="return getLocation()" for="e-name"> Get Current Location</label>

                    </div>
                </div>

                <div class="edit-group3 edt3">          

                    <label class="control-label" for="e-name">Enter Custom coordinates</label>

                    <label class="control-label edt1" for="e-name">Latitude</label>
                    <div class="customer-edit-input">
                        <input  type="text" class="input input-xxlarge required e-input valid" onkeyup="initialize('latitude')" id="latitude" name="latitude" value="<?php echo $business_info['business']->latitude; ?>">
<?php echo form_error('latitude'); ?>
                    </div>
                </div>

                <div class="edit-group3">          


                    <label class="control-label" for="e-name">Longitude</label>
                    <div class="customer-edit-input">
                        <input  type="text" class="input input-xxlarge required e-input valid" onkeyup="initialize('longitude')" id="longitude" name="longitude" value="<?php echo $business_info['business']->longitude; ?>">
<?php echo form_error('longitude'); ?>
                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name"></label>
                    <div class="customer-edit-input">
                        <div id="googleMap" style="width:500px;height:380px;"></div>
                    </div>
                </div>



                <div class="controls1 ctr2">
                    <input type="submit" name="submit" id="submit" value="Save Changes" class="primary-button">
                </div> 
        </fieldset>
    </form>






</div>

<script src="http://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
<script>


                            $('#change_zipcode').keyup(function () {
                                var zipcode = $(this).val();
                                var geocoder = new google.maps.Geocoder();
                                var latlng = new google.maps.LatLng(12.9667, 77.5667);
                                var myOptions = {
                                    zoom: 12,
                                    center: latlng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                }
                                var map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
                                geocoder.geocode({'address': zipcode}, function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        //Got result, center the map and put it out there
                                        map.setCenter(results[0].geometry.location);
                                        var latlng = results[0].geometry.location;
                                        var marker1 = new google.maps.Marker({
                                            map: map,
                                            position: latlng,
                                            title: 'Drag Me!',
                                            draggable: true
                                        });
//                                                google.maps.event.addListener(marker, 'dragend', function (marker) {
//                                                    var latLng1 = results[0].geometry.location;
//                                                    document.getElementById("latitude").value = latLng1.lat();
//                                                    document.getElementById("longitude").value = latLng1.lng();
//                                                });
                                    } else {
                                        alert("Geocode was not successful for the following reason: " + status);
                                    }

                                });
                            });
                            $(document).ready(function () {

                                initialize();
                            });
                            function initialize()
                            {

                                x = document.getElementById("latitude").value;
                                y = document.getElementById("longitude").value;


                                var latLng = new google.maps.LatLng(x, y);
                                var mapProp = {
                                    center: latLng,
                                    zoom: 15,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                                var marker1 = new google.maps.Marker({
                                    position: latLng, title: 'Point A',
                                    draggable: true,
                                });
                                marker1.setMap(map);
                                var ne0 = new google.maps.LatLng(25.774252, -80.190262);
                                var ne01 = new google.maps.LatLng(18.466465, -66.118292);
                                var ne02 = new google.maps.LatLng(32.321384, -64.75737);
                                var n0 = new google.maps.LatLng(23.774252, -78.190262);
                                var n01 = new google.maps.LatLng(17.466465, -65.118292);
                                var n02 = new google.maps.LatLng(16.466465, -63.118292);
                                var n03 = new google.maps.LatLng(30.321384, -64.75737);
                                var zone = [
                                    n0, n01, n02, n03
                                ];
                                var zone0 = [
                                    ne0, ne01, ne02, ne0
                                ];
                                var dzone = new google.maps.Polygon({
                                    paths: zone,
                                    strokeColor: "#0000FF",
                                    strokeOpacity: 1.5,
                                    strokeWeight: 2,
                                    fillColor: "#ff0000",
                                    fillOpacity: 1, clickable: false
                                });
                                dzone.setMap(map);
                                // google.maps.event.trigger(marker1, 'dragend', {latLng: marker1.getPosition()});
                                google.maps.event.addListener(marker1, 'dragend', function (marker1) {
                                    var latLng = marker1.latLng;
                                    document.getElementById("latitude").value = latLng.lat();
                                    document.getElementById("longitude").value = latLng.lng();
                                });
                            }

                            google.maps.event.addDomListener(window, 'load', initialize);</script>


<script>
    var x = document.getElementById("demo");
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {


        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        initialize('position.coords.latitude');
        initialize('position.coords.longitude');
    }

</script>
