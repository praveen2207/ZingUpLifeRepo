
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Information</h3>
</div>
<div class="row-fluid tr-row">


    <script src="<?php echo base_url(); ?>assets/admin/js/upload.js"></script>    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/multiple_uploads_style.css" />
    <?php
    $error_message = $this->session->flashdata('business_info_success_message');
    if ($error_message) {
        ?>
        <p class="error_validate_msg para-small for-para"><?php echo $error_message; ?></p>

    <?php } ?>


    <form class="form-horizontal for user-detail-row1 partner1 infob1" name="get_started" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>customer_support/adding_business_information">  
        <fieldset>
            <div class="clear">
                <div class="edit-group3">          
                    <input type="hidden" name="id" value="<?php echo $business_info['business']->id; ?>" />
                    <input type="hidden" name="vendor_id" value="<?php echo $business_info['partner']->id; ?>" />
                    <label class="control-label" for="e-name">Business name</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="business_name" value="<?php echo $business_info['business']->name; ?>">

                    </div> 
                </div> 
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Phone(10 digits)</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="phone" value="<?php echo $business_info['business']->phone; ?>">

                    </div> 
                </div>
                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business logo</label>  
                    <div class="customer-edit-input">
                        <div class="cs_business_logo">
                            <input type="file" style="float:none;" name="userfile"/>
                            <input type="hidden" name="old_logo" value="<?php echo $business_info['business']->logo; ?>" />
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
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Business Email</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="email" value="<?php echo $business_info['business']->email; ?>">

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

                    <label class="control-label" for="e-name">Business gallery</label>  
                    <div class="customer-edit-input">
                        <div id="filediv" class="cs_business_gallery"><input type="file" id="wall_post_images"/></div>
                        <div class="images_gallery1">
                            <?php
                            foreach ($business_info['gallery'] as $gallery) {
                                if ($gallery->images) {
                                    $filename = "assets/uploads/business_providers/gallery/" . $business_info['business']->id . "/" . $gallery->images;
                                    if (file_exists($filename)) {
                                        ?>
                                        <img id="gallery_img" class="<?php echo $gallery->images; ?>" src="<?php echo base_url(); ?>assets/uploads/business_providers/gallery/<?php echo $business_info['business']->id; ?>/<?php echo $gallery->images; ?>" />
                                        <img class="img_del" src="<?php echo base_url(); ?>assets/images/x.png" alt="delete">
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <input type="hidden" name="count" value="<?php echo count($business_info['gallery']); ?>" />
                        <div id="file_names"></div>  
                        <div id="formdiv" style="display:none;">
                            <h2>Upload images and videos here</h2>

                            <hr/>
                            <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
                            <div class="addmore">
                                <input type="button" id="add_more" class="upload" value="Add More"/>
                                <input type="submit" value="Close" name="submit" id="upload" class="upload"/>
                            </div>
                        </div>
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
                    </div> 
                </div>



                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Address 1</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="address1" value="<?php echo $business_info['business']->street1; ?>">

                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Address 2</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" name="address2" value="<?php echo $business_info['business']->street2; ?>">

                    </div> 
                </div>



                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Country</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="country" class="required p-select valid">  
                            <option value="<?php echo $business_info['business']->country; ?>"><?php echo $business_info['business']->country; ?></option>
                        </select> 
                    </div> 
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">State</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="state" class="required p-select valid">  
                            <option value="<?php echo $business_info['business']->state; ?>"><?php echo $business_info['business']->state; ?></option>
                        </select> 
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">City</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="city" class="required p-select valid">  
                            <option value="<?php echo $business_info['business']->city; ?>"><?php echo $business_info['business']->city; ?></option>
                        </select> 
                    </div> 
                </div>


                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Zipcode</label>  
                    <div class="customer-edit-input">
                        <input id="change_zipcode" type="text" class="input input-xxlarge required e-input valid" name="zipcode" value="<?php echo $business_info['business']->zipcode; ?>">

                    </div> 
                </div>


                <div class="edit-group3 edt3">          

                    <label class="control-label edt2" for="e-name">Enter your latitude and longitude to appear in search 
                        <a target="_blank" href="http://mondeca.com/index.php/en/any-place-en">Find lat/long</a> OR </label>

                    <!--                </div>
                    
                                    <div class="edit-group3">          -->

                    <label class="control-label lbl-btn" onclick="return getLocation()" for="e-name">Get Current Location</label>
                    <input type="hidden" id="zipcode_lat" value="<?php echo $lat_long['lat']; ?>" />
                    <input type="hidden" id="zipcode_lng" value="<?php echo $lat_long['lng']; ?>" />
                </div>

                <div class="edit-group3 edt3">          

                    <label class="control-label" for="e-name">Enter Custom coordinates</label>
                    <label class="control-label edt1" for="e-name">Longitude</label>
                    <div class="customer-edit-input">
                        <input  type="text" class="input input-xxlarge required e-input valid" onkeyup="initialize('longitude')" id="longitude" name="longitude" value="<?php echo $business_info['business']->longitude; ?>">

                    </div>
                </div>

                <div class="edit-group3">          

                    <label class="control-label" for="e-name">Latitude</label>
                    <div class="customer-edit-input">
                        <input  type="text" class="input input-xxlarge required e-input valid" onkeyup="initialize('latitude')" id="latitude" name="latitude" value="<?php echo $business_info['business']->latitude; ?>">

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

                                x = document.getElementById("longitude").value;
                                y = document.getElementById("latitude").value;
                                if (x === '' && y === '') {
                                    x = document.getElementById("zipcode_lat").value;
                                    y = document.getElementById("zipcode_lng").value;
                                }

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


        document.getElementById("latitude").value = position.coords.longitude;
        document.getElementById("longitude").value = position.coords.latitude;
        initialize('position.coords.latitude');
        initialize('position.coords.longitude');
    }

</script>
