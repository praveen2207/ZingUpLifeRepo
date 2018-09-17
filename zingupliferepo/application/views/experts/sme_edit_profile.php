
<div class="container">
		<div class="linerList">
			<span class="colorGreen"><a class="colorGreen" href="<?php echo base_url(); ?>">Home</a>&nbsp;</span>
			<span  class="colorGreen">//<a class="colorGreen" href="<?php echo base_url();?>experts/dashboard">Dashborad</a>&nbsp;</span>
			<span  class="colorGrey">// My Profile</span>
		</div>
		
		<div class="userDas_box smeEdit">
		    <div class="rederror">
		    <?php validation_errors();
		    if(isset($errors)){
		    echo $errors;
		    }; 
		    ?>
		</div>
		    <?php
			$error_message = $this->session->flashdata('msg');
			if ($error_message) {
		    ?>
		<div class="row-fluid pr-success">
		    <div class="message pr-message">
			<h3 class="congratulations message-head" style="color:green;">Congratulations!</h3>
			    <p class="colorGreen" ><?php echo $error_message; ?></p>
		    </div>
		</div>    
		    <?php } ?>
		<h4>MY PROFILE</h4>
		    <div class="row">
			<div class="col-md-4 basic_Box">
			    <div class="uplaodImg">
				<?php if($this->session->userdata('type') == 'sme') { if($this->session->userdata('photo') != '') {?>
				<img src="<?php echo base_url(); ?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $this->session->userdata('photo'); ?>" alt="" style="height:180px;width:180px;">
				<?php }else{ ?><img src="<?php echo base_url(); ?>assets/experts/image/image_placeholder.png" style="height:159px;width:159px;">
				<?php } ?>
				<?php } else {?>
				<img src="<?php echo base_url(); ?>sme_users/<?php echo $smeuerdetails->sme_userid; ?>/<?php echo $smeuerdetails->photo; ?>" alt="" style="height:180px;width:180px;">
				<?php }?></br>
			
				<form class="upload_photo_form" method="post" action="<?php echo base_url(); ?>experts/upload_sme_photo" enctype="multipart/form-data">
				    <label class="btn uploadBtn edit-photo" for="upload-file-selector">
					<input id="upload-file-selector" class="colorGreen imgUpload" name="sme_photo" type="file">Edit Photo
				    </label>
				    <br/>
				    <label>    		
			        	<input id="upload_sme_photo_btn" type="submit" value="Upload" class="btn zing-btn" style="display:none; ">
				    </label>
			        </form>
				    <?php
			        	$error_message = $this->session->flashdata('failure_photo_msg');
					    if ($error_message) {
				    ?>
					<div class="row-fluid pr-success">
					    <div class="message pr-message">
						<p class="para-small for-para"><?php echo $error_message; ?></p>
					    </div>
					</div>    
				    <?php } ?>
				    <?php
			        	$error_message = $this->session->flashdata('upload_photo_msg');
					    if ($error_message) {
				    ?>
				    <div class="row-fluid pr-success">
					<div class="message pr-message">
					    <h3 class="congratulations message-head">Congratulations!</h3>
						<p class="para-small for-para"><?php echo $error_message; ?></p>
					</div>
				    </div>    
				    <?php } ?>
			    </div>
			    <div class="basic_Details">
				<h4 class="txtHead">BASIC DETAILS</h4>
			    </div>
			    <div class="input_list showInput">
				<form class="form-horizontal" method='post' action='<?php echo base_url();?>experts/update_profile' id="sme_edit_profile">
				    <div class="form-group">
					<div class="col-xs-4 col-sm-4 col-md-4">
					    <span for="inputEmail3" class="control-label">Title<sup class="txt-red">*</sup> :</span>
					</div>
					<div class="col-xs-8 col-sm-8 col-md-8 dasInput">
					    <select id="inputEmail3" name="title" class="form-control basic_Input">  
						<option value="Mr." <?php if($user->title=="Mr.") echo 'selected="selected"'; ?> >Mr.</option>  
						<option value="Mrs." <?php if($user->title=="Mrs.") echo 'selected="selected"'; ?> >Mrs.</option>
						<option value="Ms." <?php if($user->title=="Ms.") echo 'selected="selected"'; ?> >Ms.</option>
						<option value="Dr." <?php if($user->title=="Dr.") echo 'selected="selected"'; ?> >Dr.</option>
						<option value="Dt." <?php if($user->title=="Dt.") echo 'selected="selected"'; ?> >Dt.</option>  
					    </select>
					</div>
				    </div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputEmail3" class="control-label">Full Name<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<input type="text" name='first_name' class="form-control basic_Input" id="inputEmail3" placeholder="" value="<?php echo $user->first_name; ?>">
						<div class="rederror"><?php echo form_error('first_name'); ?></div>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4  col-md-4">
						<span for="inputEmail3" class="control-label">Email<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<input type="email" name='email' class="form-control basic_Input" id="inputEmail3" placeholder="" value='<?php echo $this->session->userdata('username');?>'readonly />
					    </div>
					</div>
					<div class="form-group countryListArea">
					    <div class="col-xs-4 col-sm-4  col-md-4">
						<span for="inputEmail3" class="control-label">Phone<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<input type="tel" name='phone' maxlength="10" id="phone" placeholder="Mobile Number" value='<?php echo $user->phone; ?>' class="input input-xxlarge required form-control" > 
						<input	type="hidden" name="phonefull" id="phonefull" />
						    <div class="rederror"><?php echo form_error('phone'); ?></div>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputPassword3" class="control-label">Gender<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<label class="radio-inline"><input type="radio" name="gender" value="male" <?php if ($user->gender == 'male') echo 'checked="checked"'; ?>/>Male</label>								
						<label class="radio-inline"><input type="radio" name="gender" value="female" <?php if ($user->gender == 'female') echo 'checked="checked"'; ?>/>Female</label>									</div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputPassword3" class="control-label">Country<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
<select id="country_dropdown" name="country_dropdown"  class="form-control basic_Input" onchange="selectState(this.value)">
    <option value="">Select</option>
    <?php foreach($list as $listElement){?>                                             
    <option value="<?php echo $listElement->id;?>"><?php echo $listElement->country_name; ?></option>  
    <?php }?>   
</select>
<script>$('#country_dropdown').val('<?php echo $user->country;?>');</script>
<div class="rederror"><?php echo form_error('country_dropdown'); ?></div>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputPassword3" class="control-label">State<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<select id="state_dropdown" name="state_dropdown" class="form-control basic_Input" onchange="selectCity(this.options[this.selectedIndex].value)">
						    <option value="">Select</option>
							    <?php foreach($statelist as $stlist){?>                                             
						    <option value="<?php echo $stlist->id;?>"><?php echo $stlist->state_name; ?></option><?php }?>  
						</select>
						<script>$('#state_dropdown').val('<?php echo $user->state;?>');</script>
						<div class="rederror"><?php echo form_error('state_dropdown'); ?></div>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputPassword3" class="control-label">City<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<select id="city_dropdown" name="city_dropdown" class="form-control basic_Input" >						      <option value="">Select</option>
							<?php foreach($citylist as $ctlist){?>                                             
						    <option value="<?php echo $ctlist->id;?>"><?php echo $ctlist->city_name; ?></option><?php }?>
						</select>
						<script>$('#city_dropdown').val('<?php echo $user->city;?>');</script>
						<div class="rederror"><?php echo form_error('city_dropdown'); ?></div>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputPassword3" class="control-label">Education & Certificate :</span>					     </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<input type="text" name="cert_edu" class="form-control basic_Input" id="inputPassword3" placeholder="" value='<?php echo $user->cert_edu; ?>'>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-xs-4 col-sm-4 col-md-4">
						<span for="inputPassword3" class="control-label">Service<sup class="txt-red">*</sup> :</span>
					    </div>
					    <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
						<select id="service" name="service" class="form-control basic_Input" >							  <?php foreach($service as $servicelist){?>
						    <option value="<?php echo $servicelist->id; ?>"><?php echo $servicelist->service_name; ?></option> 
						    <?php }?>      
						</select>
						<script>$('#service').val('<?php echo $user->offerings_id;?>');</script>
								    
					    </div>
					</div>
				    </div>
				</div>
				<div class="col-md-8">
				    <div class="comment_Box showTextaera">
					<h4 class="txtHead">About<sup class="txt-red">*</sup></h4>
					    <textarea name='about' id='chars' rows="4" cols="50" class="textarea_info" maxlength='6000' style='height:150px;'><?php echo $user->about; ?> </textarea>
					    <?php echo form_error('about'); ?>
										<font size="2">(Maximum characters: 6000)<br> You have <span id='text' style='font-weight: bold;'>6000</span> characters left.
									</font>
				    </div>
				    </br>
				    <div class="comment_Box showTextaera">
					<h4 class="txtHead">Expertise<sup class="txt-red">*</sup></h4>
					    <textarea name='expertise' id='chars2' rows="4" cols="50" class="textarea_info" maxlength='6000' style='height:150px;'><?php echo $user->expertise; ?></textarea>
					    <?php echo form_error('expertise'); ?>
										<font size="2">(Maximum characters: 6000)<br> You have <span id='text2' style='font-weight: bold;'>6000</span> characters left.
									</font>
					    
				    </div>
				    </br>
				    <div class="input_list subInput showInput">
					<div class="form-horizontal" >
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputEmail3" class="control-label">Call Back time :</span>
							<p>Sample Data : e.g 9am to 11am and 6pm to 9pm (M,T,W,T,F,S,S)</p>						   </div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01 rederror">
						    <input name='callbk_time' type="text" class="form-control basic_Input01" id="inputEmail3" placeholder="" value='<?php echo $user->callback_time; ?>'>
							<p><?php echo form_error('callbk_time'); ?></p>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputPassword3" class="control-label">Chat Pricing :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <span style='float:left;width:6%;margin-top:10px;'>Rs</span>
						    <span style='float:left;width:94%;'>
						    <input type="text" name='chat_pricing' class="form-control basic_Input01" id="inputPassword3" placeholder="" value='<?php echo $user->chat_pricing; ?>'>								
							<div class="rederror"><?php echo form_error('chat_pricing'); ?></div>
						    </span>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputPassword3" class="control-label">Video Pricing :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <span style='float:left;width:6%;margin-top:10px;'>Rs</span>
						    <span style='float:left;width:94%;'>
							<input type="text" name='video_pricing' class="form-control basic_Input01" id="inputPassword3" placeholder="" value='<?php echo $user->video_pricing; ?>'>								    
							    <div class="rederror"><?php echo form_error('video_pricing'); ?></div>
						    </span>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputPassword3" class="control-label">Audio Pricing :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <span style='float:left;width:6%;margin-top:10px;'>Rs</span>
						    <span style='float:left;width:94%;'>
							<input type="text" name='audio_pricing' class="form-control basic_Input01" id="inputPassword3" placeholder="" value='<?php echo $user->audio_pricing; ?>'>		
							    <div class="rederror"><?php echo form_error('audio_pricing'); ?></div>
						    </span>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputPassword3" class="control-label">In-Person Pricing :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <span style='float:left;width:6%;margin-top:10px;'>Rs</span>
						    <span style='float:left;width:94%;'>
							<input type="text" name='inperson_pricing' class="form-control basic_Input01" id="inputPassword3" placeholder="" value='<?php echo $user->inperson_pricing; ?>'>								
							    <div class="rederror"><?php echo form_error('inperson_pricing'); ?></div>
						    </span>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputPassword3" class="control-label">Vacation Start Date :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <input type="text" name='start_date' maxlength="10" class="form-control basic_Input01" id="inputPassword3" placeholder="" value="<?php echo $user->vac_start_date; ?>"/>
							 <div class="rederror"><?php echo form_error('start_date'); ?></div>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputEmail3" class="control-label">Vacation End Date :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						     <input type="text" name='end_date' maxlength="10" class="form-control basic_Input01" id="inputEmail3" placeholder="" value="<?php echo $user->vac_end_date; ?>"/>
						     <div class="rederror">
							<?php validation_errors();
		    if(isset($errordate)){
		    echo $errordate;
		    }; 
		    ?>
							</div> 
<!--<div class="rederror"><?php echo form_error('end_date'); ?></div>-->
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputEmail3" class="control-label">Change Password :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <input type="password" name='password' class="form-control basic_Input01" id="inputEmail3" placeholder="">
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-xs-4 col-sm-4 col-md-4">
						    <span for="inputPassword3" class="control-label">Confirm Password :</span>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 dasInput01">
						    <input type="password" name='passconf2' class="form-control basic_Input01" id="inputPassword3" placeholder="">
							<div class="rederror"><?php echo form_error('password'); ?></div>
						</div>
					    </div>
					    <div class="form-group">
						<div class="col-md-12 dasInput01">
						    <input type="submit" class="btn zing-btn pull-right" value="Save">
						</div>
					    </div>
					</div>
				    </form>	
				</div>
			    </div>
			</div>
		    </div>
		</div>
	</div> 

	
