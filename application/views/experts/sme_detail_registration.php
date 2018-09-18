<link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">
<form class='sme_register'	action='<?php echo base_url();?>experts/registerDetail' method='post' enctype="multipart/form-data" name="register" id="register" />
<div class="container">
      		
	<div class="loginBox reHeight" style='height: auto;'>
		<div class="log_head">
			<h3>EXPERTS SIGNUP</h3>
		</div>
		<div class="row log_parents">
			<div class="col-sm-12 col-md-12">
				<div class="col-sm-7 col-md-7 input_sing new_sing">
                    <?php
                    if ($validation_message == 'validation_error') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">	
							<span aria-hidden="true">&times;</span>
						</button>
						<span>Validation Failed!</span> Please enter valid values for all the fields.
					</div>
                    <?php } ?>
                    <?php
                    if ($validation_message == 'user_exist') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError"role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<span>Error!</span> user already exists with the same email-address .
					</div>
                    <?php } ?>
							<input type="hidden" name="register_type" value="user_registration" />
							<input type="hidden" name="smeuser_id"	value="<?php echo $smeuser_id; ?>" />
							<div class="form-group">
								<span  	class="col-xs-3 col-sm-3 col-md-3 control-label">Name:</span>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<input type="text" name='name' value="<?php echo $name; ?>" class="input input-xxlarge required form-control">
		                                <?php echo form_error('name'); ?>
		                            </div>
							</div>
		
							<div class="form-group countryListArea">
								<span  class="col-xs-3 col-sm-3 col-md-3 control-label">Phone<sup class="txt-red">*</sup> :</span>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<input type="tel" maxlength="10" name='phone' id="phone" placeholder="Mobile Number" value='<?php echo set_value('phone'); ?>'	class="input input-xxlarge required form-control"> 
									<input	type="hidden" name="phonefull" id="phonefull" />
								</div>
							</div>
		
							<div id="wrapper" style="clear:both;margin-top:10px;">
								<div class="wrap_box">
									<?php
									if(sizeof($list) > 0){
									?>
										
										<div class="form-group">
										<span  class="col-xs-3 col-sm-3 col-md-3 control-label" style="margin-top:10px;">Country<sup class="txt-red">*</sup> :</span>
										<div class="col-xs-8 col-sm-8 col-md-8" style="margin-top:10px;">
											<select id="country_dropdown" name="country_dropdown" class="required form-control"	onchange="selectState(this.options[this.selectedIndex].value)">
												<option value="-1" selected>Select Country</option>	
		                                           <?php
														foreach($list as $listElement){
															?>
															<option value="<?php echo $listElement->id?>"><?php echo $listElement->country_name?></option>
															<?php
														}
														?>
		                                        </select>
											    <script type="text/javascript">
												 	 document.getElementById('country_dropdown').value = "<?php echo set_value('country_dropdown');?>";
												</script>
		
											<span style="color: red"> <?php  echo form_error('country_dropdown'); ?></span>
											</div>
										 </div>
										 
									
									<div class="form-group">
										<span  class="col-xs-3 col-sm-3 col-md-3 control-label">State<sup class="txt-red">*</sup> :</span>
										<div class="col-xs-8 col-sm-8 col-md-8">
											<select id="state_dropdown" name="state_dropdown"class="required form-control"
												onchange="selectCity(this.options[this.selectedIndex].value)">
												<option value="-1" selected>Select state</option>
											
											</select> 
											   <script type="text/javascript">
												 	 document.getElementById('state_dropdown').value = "<?php echo set_value('state_dropdown');?>";
												</script>
											<span id="state_loader"></span> <span style="color: red"> <?php  echo form_error('state_dropdown'); ?></span>
										</div>
									</div>
									<div class="form-group">
										<span  class="col-xs-3 col-sm-3 col-md-3 control-label">City<sup class="txt-red">*</sup> :</span>
										<div class="col-xs-8 col-sm-8 col-md-8">
											<select id="city_dropdown" name="city_dropdown" 	class="required form-control">
												<option value="-1" selected>Select city</option>
											</select> 
											<span id="city_loader"></span> 
											 <script type="text/javascript">
												 	 document.getElementById('city_dropdown').value = "<?php echo set_value('city_dropdown');?>";
												</script>
											<span style="color: red"> <?php  echo form_error('city_dropdown'); ?></span>
										</div>
									</div>
		                        					
										<?php
									}else{
										echo 'No Country Name Found';
									}
									?>
								</div>
							</div>
						<!-- 
							<div class="form-group">
								<span class="col-xs-3 col-sm-3 col-md-3 control-label">Pincode<sup class="txt-red">*</sup> :</span>
									<div class="col-xs-8 col-sm-8 col-md-8">
									<input type='text' name='pincode'value='<?php echo set_value('pincode'); ?>' class='required form-control' />
		                                <?php echo form_error('pincode'); ?>
		                            </div>
							</div>
						 -->
							<span>&nbsp;</span>
							<div class="form-group">
								<span 	class="col-xs-3 col-sm-3 col-md-3 control-label">Upload Image:</span>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<input type="file" name='userfile' />
								</div>
							</div>
						<!-- 
							<div class="form-group">
								<span  class="col-xs-3 col-sm-3 col-md-3 control-label">Date of Birth<sup class="txt-red">*</sup> :</span>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<input type='text' name='dob' 	value='<?php echo set_value('dob'); ?>' id='datepicker' class='required form-control' />
		                                <?php echo form_error('dob'); ?>
		                            </div>
							</div>
		 				-->
							<div class="form-group">
								<span  class="col-xs-3 col-sm-3 col-md-3 control-label">About<sup class="txt-red">*</sup> :</span>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<textarea name='about' id='chars' maxlength='6000'	class='required form-control'><?php echo set_value('about'); ?></textarea>
		                                <?php echo form_error('about'); ?>
										<font size="2">(Maximum characters: 6000)<br> You have <span id='text' style='font-weight: bold;'>6000</span> characters left.
									</font>
								</div>
							</div>
							<div class="form-group">
								<span  class="col-xs-3 col-sm-3 col-md-3 control-label">Expertise<sup class="txt-red">*</sup> :</span>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<textarea name='expertise' id='chars' maxlength='6000'	class='required form-control'><?php echo set_value('about'); ?></textarea>
		                                <?php echo form_error('about'); ?>
										<font size="2">(Maximum characters: 6000)<br> You have <span id='text' style='font-weight: bold;'>6000</span> characters left.
									</font>
								</div>
							</div>
							<!--  	
							<div class="form-group">
									
									<span  class="col-xs-3 col-sm-3 col-md-3 control-label">Expertise<sup class="txt-red">*</sup> :</span></span>
									<div class="col-xs-8 col-sm-8 col-md-8">
				                           <?php
								               if(!empty($expertise)) {
								            ?>     
							                   <select name="expertiseMulti[]" id="expertiseMulti" multiple  class="required form-control">
							                    <?php         
								                 foreach ($expertise as $key => $value) {
								                ?>        
								        		 <option value=<?php echo $value->expertise_id ?>><?php echo $value ->expertise_desc?></option>
												<?php }// end for each?>
												
											</select> 
												
											<?php }// end if ?>
											 <script type="text/javascript">
												 	 document.getElementById('expertiseMulti').value = "<?php echo set_value('expertiseMulti');?>";
												</script>
				                            <?php echo form_error('"expertiseMulti"'); ?>
			                            </div>
								</div>
								 -->
							<div class="form-group">
									<span 
										class="col-xs-3 col-sm-3 col-md-3 control-label">Certification/Education </span>
									<div class="col-xs-8 col-sm-8 col-md-8">
										<input type='text' name='cert_edu' placeholder="Enter comma separated values.." value='<?php echo set_value('otherExpertise'); ?>' class='form-control' />
			                                <?php echo form_error('cert_edu'); ?>
			                         </div>
							</div>
					
							<div class="form-group">
								<div
									class="col-xs-offset-3 col-sm-offset-3 col-xs-offset-3 col-xs-8 col-sm-8 col-md-8">
									<input type="submit" class="btn zing-btn pull-right reSingbtn"
										value="Sign Up" name="submit">
								</div>
							</div>
			</div>
		</div>
	</div>
</div>
</div>
</form>

<script	src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.5.0/js/intlTelInput.js"></script>

<script>
	var baseUrl = '<?php echo base_url();?>';
      $("#phone").intlTelInput({
            autoHideDialCode: true,
            autoPlaceholder: true,
            separateDialCode: true,
            nationalMode: true,
            geoIpLookup: function (callback) {
                $.get("http://ipinfo.io", function () {}, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            initialCountry: "auto",
        });

        // get the country data from the plugin
        var countryData = $.fn.intlTelInput.getCountryData(),
          telInput = $("#phone"),
          addressDropdown = $("#listcountry");

        // init plugin
        telInput.intlTelInput({
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.5.0/js/utils.js" // just for formatting/placeholders etc
        });

        // populate the country dropdown
        $.each(countryData, function(i, country) {
          addressDropdown.append($("<option></option>").attr("value", country.iso2).text(country.name));
        });

        // listen to the telephone input for changes
        telInput.on("countrychange", function() {
          var countryCode = telInput.intlTelInput("getSelectedCountryData").iso2;
          addressDropdown.val(countryCode);
        });

        // trigger a fake "change" event now, to trigger an initial sync
        telInput.trigger("countrychange");

        // listen to the address dropdown for changes
        addressDropdown.change(function() {
          var countryCode = $(this).val();
          telInput.intlTelInput("setCountry", countryCode);
        });

        // update the hidden input on submit
        $("form").submit(countryData,function(i, country) {
          $("#country").val(telInput.intlTelInput("getSelectedCountryData").name);
          $("#phonefull").val('+' + telInput.intlTelInput("getSelectedCountryData").dialCode + $("#phone").val());
        });
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/sme-reg-details.js">	</script>