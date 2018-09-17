<?php //echo $this->session->userdata('surveyuserid'); //echo $this->session->userdata('pagevisitorid');	//echo '<pre>'; print_r($surveys); ?>
 
     <section class="assesment">
         <h5 class="text-center" style="padding-top: 75px;color: #fff;font-size: 17px;">YOUR PERSONALIZED <br/>WELLNESS ASSESSMENT</h5>
     </section>

     <section class="bg2">
       <div class="container">
         <div class="row">
		 <div class="col-lg-11 col-lg-offset-1" style="padding:0px">
            <div class="col-lg-9">
			
               <div class="main-content" style="height: 500px;position:relative;" >
               <!-- progress bar -->
			  
                   <div class="progress-container">
                      <input type="radio" class="radio addradio" name="progress" value="five" id="five" checked>
                      <label for="five" class="label ">5%</label>
					  
                      <div class="progress">
                        <div class="progress-bar"></div>
                      </div>
                    </div>
			  
				<?php if(isset($msg)) {?><p style='color:#fff;'><?php echo $msg; ?></p><?php } ?>
                 <!-- page counter -->
				  <?php foreach($surveys as $survey) { 
					if($survey->cat_id == 1) { $phy_cnt = $survey->group; } 
					else if($survey->cat_id == 2) { $emt_cnt = $survey->group; } 
					else if($survey->cat_id == 3) { $sp_cnt = $survey->group; } 
					else if($survey->cat_id == 4) { $so_cnt = $survey->group; } 
					else if($survey->cat_id == 5) { $in_cnt = $survey->group; } 
					else if($survey->cat_id == 6) { $oc_cnt = $survey->group; } 
					else if($survey->cat_id == 7) { $fi_cnt = $survey->group; } 
					else if($survey->cat_id == 8) { $en_cnt = $survey->group; } 
					} ?>
					<?php if($this->input->cookie('zingup_wellness_survey')!= '') { ?>
					   <div class="hexagon"></div><span class="desc ph" <?php if($surveys[0]->cat_id == 1) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $phy_cnt; ?></span>
					   </span>
					   <span class="desc em" <?php if($surveys[0]->cat_id == 2) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $emt_cnt; ?></span>
					   </span>
					   <span class="desc sp" <?php if($surveys[0]->cat_id == 3) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $sp_cnt; ?></span>
					   </span>
					   <span class="desc so" <?php if($surveys[0]->cat_id == 4) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $so_cnt; ?></span>
					   </span>
					   <span class="desc in" <?php if($surveys[0]->cat_id == 5) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $in_cnt; ?></span>
					   </span>
					   <span class="desc oc" <?php if($surveys[0]->cat_id == 6) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $oc_cnt; ?></span>
					   </span>
					   <span class="desc fi" <?php if($surveys[0]->cat_id == 7) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $fi_cnt; ?></span>
					   </span>
					   <span class="desc en" <?php if($surveys[0]->cat_id == 8) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $en_cnt; ?></span>
					   </span>
					<?php } else {?>
					<div class="hexagon"></div><span class="desc ph" <?php if($surveys[0]->cat_id == 1) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $phy_cnt; ?></span>
					   </span>
					   <span class="desc em" <?php if($surveys[0]->cat_id == 2) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $emt_cnt; ?></span>
					   </span>
					   <span class="desc sp" <?php if($surveys[0]->cat_id == 3) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $sp_cnt; ?></span>
					   </span>
					   <span class="desc so" <?php if($surveys[0]->cat_id == 4) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $so_cnt; ?></span>
					   </span>
					   <span class="desc in" <?php if($surveys[0]->cat_id == 5) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $in_cnt; ?></span>
					   </span>
					   <span class="desc oc" <?php if($surveys[0]->cat_id == 6) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $oc_cnt; ?></span>
					   </span>
					   <span class="desc fi" <?php if($surveys[0]->cat_id == 7) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $fi_cnt; ?></span>
					   </span>
					   <span class="desc en" <?php if($surveys[0]->cat_id == 8) {?> style='display:block;'<?php } ?>>
						<span class='eachc'><?php echo $surveys[0]->q_no;?></span>/<span class='totc'><?php echo $en_cnt; ?></span>
					   </span>
					<?php } ?>
					
                    <form id="msform" role="form" action='<?php echo base_url(); ?>Users/survey_info_submit' method='post'>  
					<?php $k=0; $i=1; $c=0;
					if($surveys[0]->cat_id == 1) { $i1 = $surveys[0]->q_no; } else {$i1 = 1;}
					if($surveys[0]->cat_id == 2) { $i2 = $surveys[0]->q_no; }else {$i2 = 1;}
					if($surveys[0]->cat_id == 3) { $i3 = $surveys[0]->q_no; }else {$i3 = 1;}
					if($surveys[0]->cat_id == 4) { $i4 = $surveys[0]->q_no; }else {$i4 = 1;}
					if($surveys[0]->cat_id == 5) { $i5 = $surveys[0]->q_no; }else {$i5 = 1;}
					if($surveys[0]->cat_id == 6) { $i6 = $surveys[0]->q_no; }else {$i6 = 1;}
					if($surveys[0]->cat_id == 7) { $i7 = $surveys[0]->q_no; }else {$i7 = 1;}
					if($surveys[0]->cat_id == 8) { $i8 = $surveys[0]->q_no; }else {$i8 = 1;}
 
					foreach($surveys as $survey) {$i++; $k++; $c++;
					if($survey->cat_id == 1) { $i1++; }
					if($survey->cat_id == 2) { $i2++; }
					if($survey->cat_id == 3) { $i3++; }
					if($survey->cat_id == 4) { $i4++; }
					if($survey->cat_id == 5) { $i5++; }
					if($survey->cat_id == 6) { $i6++; }
					if($survey->cat_id == 7) { $i7++; }
					if($survey->cat_id == 8) { $i8++; }
					
					?>
					  <!-- multiple choice row -->                 
						  <fieldset class='fieldset'>
						   <?php if($c != 1){?>
								<button style='left:-53px;top:15px;' type="button" name="next" class="previous action-button"  data-toggle="tooltip" data-placement="bottom" title="Previous"  catype='<?php echo $survey->category; ?>' slug='<?php echo $survey->slug; ?>' reach = '<?php if($i1 == $survey->group || $i2 == $survey->group || $i3 == $survey->group || $i4 == $survey->group || $i5 == $survey->group || $i6 == $survey->group || $i7 == $survey->group || $i8 == $survey->group) { echo 'enable';} else {echo 'disable';}?>' va = '<?php echo $i;?>'><img src="<?php echo base_url();?>assets/survey_new/img/back.png" width="27px" alt="next"/></button>
							<?php } ?> 
							<h4><?php echo $survey->category; ?></h4><br/>
							
							<h3 class="fs-subtitle"><?php echo $survey->question;?></h3>
							 <div class="controls" id = 'bt_<?php echo $i;?>' catype='<?php echo $survey->category; ?>' slug='<?php echo $survey->slug; ?>' reach = '<?php if(($i1 > $survey->group && $survey->cat_id == 1) || ($i2 > $survey->group && $survey->cat_id == 2) || ($i3 > $survey->group && $survey->cat_id == 3) || ($i4 > $survey->group && $survey->cat_id == 4) || ($i5 > $survey->group && $survey->cat_id == 5) || ($i6 > $survey->group && $survey->cat_id == 6) || ($i7 > $survey->group && $survey->cat_id == 7) || ($i8 > $survey->group && $survey->cat_id == 8)) { echo 'enable';} else {echo 'disable';}?>' va = '<?php echo $i;?>'>
								<div class="col-md-12">
								 <?php $j=0; foreach($survey->options as $option){ $j++;?>
									  <div style="<?php if($j == 1 || $j==2) {?>margin-top:10px;<?php } else {?>margin-top:30px;<?php } ?>float: left;width: 235px;">
										<input id='radio-<?php echo $k;?><?php echo $j;?>' type="radio" name="option<?php echo $k;?>"  value='<?php echo $option->option_id;?>'/>
										<label for="radio-<?php echo $k;?><?php echo $j;?>"><?php echo $option->option;?></label>
									  </div>
								  <?php } ?>
								</div>
							</div>
							<?php if(count($surveys) + 1 != $i){?>
								<button style='visibility:hidden;' type="button" name="next" class="next action-button"  data-toggle="tooltip" data-placement="bottom" title="Next" id = 'bt_<?php echo $i;?>' catype='<?php echo $survey->category; ?>' slug='<?php echo $survey->slug; ?>' reach = '<?php if($i1 == $survey->group || $i2 == $survey->group || $i3 == $survey->group || $i4 == $survey->group || $i5 == $survey->group || $i6 == $survey->group || $i7 == $survey->group || $i8 == $survey->group) { echo 'enable';} else {echo 'disable';}?>' va = '<?php if($i1 > $survey->group && $i2 <= $survey->group) { echo $i2; } else if($i2 > $survey->group && $i3 <= $survey->group) { echo $i3; } else if($i3 > $survey->group && $i4 <= $survey->group) { echo $i4; } else if($i4 > $survey->group && $i5 <= $survey->group) { echo $i5; } else if($i5 > $survey->group && $i6 <= $survey->group) { echo $i6; } else if($i6 > $survey->group && $i7 <= $survey->group) { echo $i7; } else if($i7 > $survey->group && $i8 <= $survey->group) { echo $i8; } else {  
								if($survey->cat_id == 1) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 2) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 3) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 4) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 5) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 6) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 7) { echo $survey->q_no + 1; }
								else if($survey->cat_id == 8) { echo $survey->q_no + 1; }
								} ?>'><img src="<?php echo base_url();?>assets/survey_new/img/next.png" width="27px" alt="next"/></button>
							<?php } ?> 
							<?php //} ?> 
							
							<input type='hidden' name='question<?php echo $k;?>' value='<?php echo $survey->q_id;?>' />
						  </fieldset>
						  
						<!-- ends here -->  
					 <?php } //}  ?>
					 
					
                  

					<input type='hidden' name='userid' value='<?php echo $this->session->userdata('surveyuserid');?>' />
					<input type='hidden' name='length' value='<?php echo count($surveys);?>' />
                    <div style="margin: 50px 0px;margin-left: 110px;" class='savebtn'>
						<!--<button type="button" class="btn btn-default assesment-btn" style="border:1px solid #009746 !important;color:#009746;">SAVE FOR LATER</button> &nbsp;&nbsp;&nbsp;-->
						<button style='visibility:hidden;' type="button" class="btn btn-default nxt-btn" style="background-color:#009746; color:#fff" va = '<?php echo $i;?>' disabled>&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>
					</div>
                    </form>
					 <fieldset class='physical surveyint'>
							
							<h3 class="fs-subtitle">You have successfully completed physical & nutritional section of the well-being assessment.</h3> 
							
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							
							
					 		<?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
									<p class='er_msg2' style='display:none;'>This field is required</p>
											<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
											<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
								 
								 
							 </div>
							 
							 <?php } ?>
							 <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate'>
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								 
							 </div>-->
							 
							 <?php } ?>
							<button type="submit" catype='physical' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;    
							position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) 
							{?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  
					  <fieldset class='emotional surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed emotional section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							<?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
							 </div>
							 
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate'>
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								 
							 </div>-->
							 
							 <?php } ?>
							<button type="submit" catype='emotional' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  <fieldset class='spiritual surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed spiritual section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							<?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
							 </div>
							 
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate' >
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' name='btn' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								
							 </div>-->
							 
							 <?php } ?>
							<button type="submit" catype='spiritual' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  <fieldset class='social surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed social section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							
							 <?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
							 </div>
							 
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate' >
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' name='btn' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								  
							 </div>-->
							
							 <?php } ?>
							<button type="submit" catype='social' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  <fieldset class='intellectual surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed intellectual section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							 <?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
									
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
								 
							 </div>
							 
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate' >
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' name='btn' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								
							 </div>-->
							 
							 <?php } ?>
							<button type="submit" catype='intellectual' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  <fieldset class='occupational surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed occupational section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							 <?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
							 </div>
							 
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate' >
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' name='btn' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								 
							 </div>-->
							 
							 <?php } ?>
							<button type="submit" catype='occupational' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  <fieldset class='financial surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed financial section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
							
							 <?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
							 </div>
							
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate'>
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' name='btn' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								 
							 </div>-->
							 
							 <?php } ?>
							<button type="submit" catype='financial' class="btn btn-default nxt-btn2" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>	
                      </fieldset>
					  <fieldset class='environmental surveyint'>
                         
							<h3 class="fs-subtitle">You have successfully completed environmental section of the well-being assessment.</h3> 
							<h3 class="fs-subtitle">Please continue all the sections for your personal wellness report and score card.</h3>
						
							<?php if(!($this->session->userdata('logged_in_user_data')) && !($this->session->userdata('surveyuserid'))) {?>
							<div class="">
							<p class='er_msg2' style='display:none;'>This field is required</p>
								<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
								<p class='su_msg' style='display:none;'>The Promo Code is valid and applied.</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate1'>
										
										<div style="margin: 0px 0px;">
										<input type='hidden' value='' class='add-code' name='code' />
										
										</div>
										<!--<input type='button' name='btn' class="btn btn-default submit-promo" style="background-color:#009746; color:#fff" value='Register' />-->
									</form>
							 </div>
							 
							 <?php } ?>
							  <?php if($this->session->userdata('logged_in_user_data') && !($this->session->userdata('survey'))) {?>
							<!--<div class="input-group code-form">
									<p class='er_msg' style='display:none;'>The Promo Code entered is already used or its invalid code.</p>
									<p class='suc_msg' style='display:none;'>The Promo Code entered is valid and applied. please click on next button to continue</p>
									<form action='<?php echo base_url();?>survey/assessment1' method='post' class='promovalidate'>
										<input type="text"  id="code" name="code" class='code required' placeholder="Promo Code"  />
										<input type='hidden' class='visitor_id' name='visitor_id' value='<?php echo $visitor_id; ?>'/>
										<input type='button' name='btn' class="btn btn-default submit-promo-logged" style="background-color:#009746; color:#fff" value='Apply' />
									</form>
								 
								 
							 </div>-->
							 
							 <?php } ?>
							<button type="button" catype='environmental' class="btn btn-default nxt-btn2 environmentalreg" style="background-color:#009746; color:#fff;position: absolute;<?php if(!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) {?>top: 176px;left: 163px;<?php } ?>" register = "<?php if(!($this->session->userdata('surveyuserid'))) {?>no<?php } else { echo 'yes';} ?>">&nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>
                      </fieldset>
                   </div>
				  
               </div>
			   <div class="col-lg-2 list-view" style="padding:0px;margin-top:-31px">
			   <!--<img src='<?php echo base_url(); ?>assets/survey_new/img/8-dimenstions-of-wellness-2.jpg' style='width:330px;' />-->
			   <ul style="list-style-type:none;padding:0px;" class='survey-list'>
                          <li><a href="#">Basic Information</a></li>
                          <li><a href="#" <?php if($surveys[0]->cat_id == 1) {?>class="active"<?php } ?>>Physical &amp; Nutritional</a></li>
                          <li class='emotionallist'><a href="#" <?php if($surveys[0]->cat_id == 2) {?>class="active"<?php } ?>>Emotional</a></li>
                          <li class='spirituallist'><a href="#" <?php if($surveys[0]->cat_id == 3) {?>class="active"<?php } ?>>Spiritual</a></li>
                          <li class='sociallist'><a href="#" <?php if($surveys[0]->cat_id == 4) {?>class="active"<?php } ?>>Social</a></li>
                          <li class='intellectuallist' <?php if($surveys[0]->cat_id == 5) {?>class="active"<?php } ?>><a href="#">Intellectual</a></li>
                          <li class='occupationallist'><a href="#" <?php if($surveys[0]->cat_id == 6) {?>class="active"<?php } ?>>Occupational</a></li>
                          <li class='financiallist'><a href="#" <?php if($surveys[0]->cat_id == 7) {?>class="active"<?php } ?>>Financial</a></li>
                          <li class='environmentallist'><a href="#" <?php if($surveys[0]->cat_id == 8) {?>class="active"<?php } ?>>Environmental</a></li>
                       </ul>
			   </div>
			   </div>
            </div>
         </div>
     </section>

     <!-- semi footer -->
  
