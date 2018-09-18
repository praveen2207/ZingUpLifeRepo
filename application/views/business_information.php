
<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Business Information</h1>
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
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
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
                        <div class="add_new"><a href="<?php echo base_url(); ?>vendor/gallery/<?php echo $business_info['business']->id; ?>" class="button">Gallery</a></div>

                        <div class="business-info" style="clear:both;">

                            <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>    
                            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/multiple_uploads_style.css" />

                            <form class="form-horizontal for" name="get_started" id="vendor_business_info_form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/adding_business_information">
                                <input type="hidden" name="id" value="<?php echo $business_info['business']->id; ?>" style="float:none;" />
                                <input type="hidden" name="vendor_id" value="<?php echo $business_info['partner']->id; ?>" style="float:none;" />
                                <label>What Business type are you?</label>
                                <label>Select the services you provide. (You may select multiple services).</label>
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
                                        <input type="checkbox" name="business_type[]" value="<?php echo $service->id?>" <?php if ($check) { ?>checked<?php } ?>/>
                                        <?php echo $service->service_name; ?>
                                    </li>
                                    <?php
                                }
                                ?>
                                <br/>
                                <label>Business name</label>
                                <input type="text" name="business_name" value="<?php echo $business_info['business']->name; ?>"/>
                                <label>Business Phone(10 digits)</label>
                                <input type="text" name="phone" value="<?php echo $business_info['business']->phone; ?>"/>
                                <label>Business logo</label>
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
                                <br><br>
                                <label>Business Email</label>
                                <input type="text" name="email" value="<?php echo $business_info['business']->email; ?>" />
                                <label>Business Website <br />
                                    Click through url(where visitors are taken when they click the link)</label>
                                <input type="text" name="website" value="<?php echo $business_info['business']->website; ?>"/>
                                <label>Business Description</label>
                                <textarea name="description" value="" id="description"><?php echo $business_info['business']->description; ?></textarea><br><br>

                                <label>Location Area :</label>
                                <select name="area">
                                    <option value="">Select Area</option>
                                    <?php foreach ($locations as $location) { ?>
                                        <option value="<?php echo $location->id . '/' . $location->suburb; ?>" <?php
                                        if ($business_info['business']->suburb == $location->id) {
                                            echo 'selected';
                                        }
                                        ?> ><?php echo $location->suburb; ?></option>
                                            <?php } ?>
                                </select><br><br>
                                <label>Address 1:</label>
                                <input type="text" name="address1" value="<?php echo $business_info['business']->street1; ?>"/>
                                <label>Address 2:</label>
                                <input type="text" name="address2" value="<?php echo $business_info['business']->street2; ?>"/>
                                <label>Country :</label>
                                <select name="country" >
                                    <option value="India" selected>India</option>								
                                </select>
                                <label>State :</label>
                                <select name="state" >
                                    <option value="Karnataka" selected>Karnataka</option>								  
                                </select>
                                <label>City :</label>
                                <select name="city" >
                                    <option value="Banglore" selected>Banglore</option>								 
                                </select>   
                                <label>Zipcode :</label>
                                <input id="change_zipcode" type="text" name="zipcode" value="<?php echo $business_info['business']->zipcode; ?>"/>
                                <label>Enter your latitude and longitude to appear in search :<br />
                                    <a target="_blank" href="http://mondeca.com/index.php/en/any-place-en">Find lat/long</a> OR</label>
                                <label style="border: 1px solid #c9c9c9;border-radius: 4px;padding: 4px;background: green;color: white;" onclick="return getLocation()">Get Current Location</label>
                                <input type="hidden" id="zipcode_lat" value="<?php echo $lat_long['lat']; ?>" />
                                <input type="hidden" id="zipcode_lng" value="<?php echo $lat_long['lng']; ?>" />

                                            <label for="checkbox"><!--<input type="checkbox" class="check-box" name="checkbox">--> Enter Custom coordinates</label>
                                <label>Latitude :</label>
                                <input type="text" id="latitude" name="latitude" type="text" value="<?php echo $business_info['business']->latitude; ?>" onkeyup="initialize('latitude')"/>

                                <label>Longitude :</label>
                                <input type="text" id="longitude" name="longitude" value="<?php echo $business_info['business']->longitude; ?>" onkeyup="initialize('longitude')"/>
                                <div id="googleMap" style="width:500px;height:380px;"></div><br><br>

                                <label>Payment Option :</label>
                                <select name="payment_option" >
                                    <option value="Online" <?php if ($business_info['business']->payment_option == 'Online') { ?>selected<?php } ?>>Online</option>			
                                    <option value="Offline"  <?php if ($business_info['business']->payment_option == 'Offline') { ?>selected<?php } ?>>Offline</option>			
                                </select><br><br>
                                <div class="clear"></div>
                                <input type="submit" class="button" value="Save Changes" />


                            </form>
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
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


        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        initialize('position.coords.latitude');
        initialize('position.coords.longitude');
    }

</script>
