<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url();?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">// Contact</span>
    </div>
    <div class="contactBox">
        <h3>CONTACT US</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="touchBox">
                    <span>Get In Touch With Us</span>
                    <div class="mapContactshow" id="gmap_canvas">
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:210px;width:510px;'><div id='gmap_canvas' style='height:210px;width:510px;'></div><div><small><a href="http://embedgooglemaps.com">								embed google maps							</a></small></div><div><small><a href="http://buywebtrafficexperts.com">buy website traffic</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div>
                        <script type='text/javascript'>function init_map() {
                                var myOptions = {zoom: 15, center: new google.maps.LatLng(12.9727785, 77.7209892), mapTypeId: google.maps.MapTypeId.ROADMAP};
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(12.9727785, 77.7209892)});
                                infowindow = new google.maps.InfoWindow({content: '<strong>Zinguplife</strong>'});
                                google.maps.event.addListener(marker, 'click', function () {
                                    infowindow.open(map, marker);
                                });
                                infowindow.open(map, marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);
                        </script>
                    </div>
                      <ul>
						<li>
							<span class="mapContact contactIcon"></span>
							<h4>ADDRESS</h4>
							<h5>184 & 185 EPIP Zone</h5>
							<h5>Whitefield, Bengaluru</h5>
							<h5>Karnataka-560066</h5>
						</li>
						<li>
							<span class="messageContact contactIcon"></span>
							<h4>EMAIL</h4>
							<h5>info@zinguplife.com,support@zinguplife.com</h5>
						</li>
						<li>
							<span class="callContact contactIcon"></span>
							<h5>PHONE</h5>
							<h5>+91 98863 50650; +91 98236 83801; +91 98181 13345;</h5>
						</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="noteBox">
                    <span>Leave Us A Note</span>
                    <?php
                    $message = $this->session->flashdata('success_message');
                    if (isset($message)) {
                        ?>
                        <div class="alert  alert-dismissible col-xs-12 errorMessage reError successMessage" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#10003</span></button>
                            <span>Success!</span>  Your enquiry has been submitted successfully.
                        </div>
                    <?php } ?>
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>contact_us_enquiry">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputEmail3">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">
                                <textarea rows="4" name="message" class="form-control"></textarea>
                                <?php echo form_error('message'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <!--                                <a href="javascript:void(0);" type="button" class="btn zing-btn pull-right">Submit</a>-->
                                <input type="submit" name="submit" value="Submit" class="btn zing-btn pull-right"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

