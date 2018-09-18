<?php  $maxscore = round($maxscore / 320 * 100); //echo $maxscore; //echo '<pre>'; print_r($survey_det);  ?>
 <?php
                        $logged_in_user_details = $this->session->userdata('logged_in_user_data');?>
						<style>
						.name{
						    font-family: 'Lato', Arial, sans-serif;
						}
						</style>
                                                
 <div id="fb-root"></div>
                     <script>(function(d, s, id) {
                     var js, fjs = d.getElementsByTagName(s)[0];
                     if (d.getElementById(id)) return;
                     js = d.createElement(s); js.id = id;
                     js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
                     fjs.parentNode.insertBefore(js, fjs);
                     }(document, 'script', 'facebook-jssdk'));
                    </script>                                                
  
     <section class="bg3">
         <h5 class="text-center" style="padding-top: 75px;color: #fff;font-size: 17px;">YOUR PERSONALIZED 8BAK-C <br/>WELLNESS ASSESSMENT</h5>
     </section>

     <section class="bg2"> 
       <div class="container">
         <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="main-content" style="min-height:1000px;box-shadow:none;border-right:1px solid #ebebeb;border-left:1px solid #ebebeb;">
                    <div class="nav3">
					<?php //if($register == 'yes' || $this->session->userdata('promocode')) { ?>
					  <span class="pull-left">  
					   <a href='<?php echo base_url();?>survey/prev_healthprofile3'> 
					  <img src="<?php echo base_url();?>assets/survey_new/img/prev-white.png" width="27px" alt="next" style='top: 13px;position: relative;margin-right: 20px;'/></a>
					  </span>
					  <?php //} ?>
                      <h4>HOW DO I STACK UP?</h4>
                    </div>
                    <h4 align="right"> INIVITE FRIENDS TO TAKE ASSESSMENT: 
                        <div class="fb-share-button" data-href="<?php echo base_url();?>survey/home" data-layout="button"  data-size="small" data-mobile-iframe="true"  align="right">
                        	<a class="fb-xfbml-parse-ignore" target="_blank"   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fzinguplife.com%2Fsurvey%2Fhome&amp;src=sdkpreparse">  
                        	</a>       	 
                         </div>
                         
                    </h4>
                    <div class="profile-results3" style="margin-top:90px">
					<p class='clickreport'  id='<?php echo $pageid;?>' style='font-size: 20px;cursor: pointer;display:none;'><img src='<?php echo base_url();?>assets/survey_new/img/pdf_down.png' /> <span class='text'>Download as PDF</span></p>
                         <div >
					   <div class="row" id="html-content-holder">
                             
                          <!-- <p style="text-align:center"><img src="<?php echo base_url();?>assets/survey_new/img/result.png"  width="64%" alt="roadmap" /></p>-->
						   <p style="text-align:center;position:relative;"><img src="<?php echo base_url();?>assets/survey_new/img/result2.png"  width="64%" alt="roadmap" />
								<span class='name' style='position:absolute;top:48px;left:234px;font-size:17px;font-weight:bold;width:50px;line-height:16px;'><?php echo $logged_in_user_details->name; ?></span>
						   </p>
                           <div class="status" style="margin-top:-92px">
                              <ul class="list-inline" style="list-style-type:none; padding-left: 28px;position: relative;top: -117px;color: #fff;">
                                  <li><p><span style="font-size:28px"><?php $maxscore2= round($survey_det[0]->grand_total / 320 * 100); echo round($survey_det[0]->grand_total / 320 * 100);?></span></p></li>
                                  <li><p><span class="pull-right" style="font-size:28px;position:relative;top:10px;"><?php if($maxscore == '') {?>90<?php } else if($maxscore2 >= $maxscore){ echo $maxscore2; } else { echo $maxscore; } ?> </span></p></li>
                                </ul>
                             </div>   
							 
							 <br/><br/><br/><br/>
								<section id="grid" class="grid clearfix healthimage4" style="background-color: #F0F0F0;margin-top:-10px;padding-top:12px;">
								 <?php foreach($survey_det as $s) {?>
									<div style='width:300px;height:400px;float:left;background:#fff;color:#000;padding:20px;margin:10px;font-family:arial'>
										<h2 ><?php echo $s->category; ?></h2>
										<p style='line-height:18px;font-size:16px;'><?php echo $s->report; ?></p>
									</div>
								 <?php  } ?>
								</section>			
                         </div>    


                           <br/><br/><br/><br/>

                        
                           <section id="grid" class="grid clearfix" style="background-color: #F0F0F0;margin-top:-10px;padding-top:12px">
							   <?php foreach($survey_det as $s) {?>
									<a href="#" data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
									  <figure>
									  <?php if($s->category == 'Physical & Nutritional') {?>
										<img src="<?php echo base_url();?>assets/survey_new/img/1.png" />
										<?php } else if($s->category == 'Emotional') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/2.png" />
										<?php } else if($s->category == 'Spiritual') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/3.png" />
										<?php } else if($s->category == 'Social') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/4.png" />
										<?php } else if($s->category == 'Intellectual') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/5.png" />
										<?php } else if($s->category == 'Occupational') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/6.png" />
										<?php } else if($s->category == 'Financial') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/7.png" />
										<?php } else if($s->category == 'Environmental') { ?>
										<img src="<?php echo base_url();?>assets/survey_new/img/8.png" />
										<?php } ?>
										<svg viewBox="0 0 180 250" preserveAspectRatio="none"><path d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"/></svg>
										<figcaption>
										  <h2><?php echo $s->category; ?></h2>
										  <p><?php echo $s->report; ?></p>
										</figcaption>
									  </figure>
									</a>
							   <?php } ?>
                              </section>
</div>



                          <!--<div class="row  section section2">
                           <div class="col-lg-12" style="margin-top:50px;">
                              <h4>RECOMMENDED SERVICES <span class="pull-right"><small><a href='<?php echo base_url();?>search'>view all</a></small></span></h4><br/><br/>
                                  <div class="row" style="padding-left:0px;padding-right:0px;">
									  <?php foreach($services as $service) {?>
										 <div class="col-lg-4 services">
											 <figure>
												 <img src="<?php echo base_url();?>assets/uploads/business_providers/logo/<?php echo $service->business_id; ?>/<?php echo $service->logo; ?>" width="100%"/>
												 <figcaption>
													   <h6><?php echo $service->name; ?></h6>
													   <p><?php echo $limited_string = word_limiter($service->description, 50, ''); ?></p>
													   <a href="<?php echo base_url();?>vendorDetails/<?php echo $service->id; ?>">know more</a>
												 </figcaption>
											 </figure>
										 </div>
									  <?php } ?>
                                  </div>
                                  </div>    
                               </div>-->



                               <div style="padding:50px;margin-top:-20px;"><hr/></div>
                          <!--<div class="row  section section3">
                           <div class="col-lg-12">
                              <h4>RECOMMENDED CONSULTANTS <span class="pull-right"><small><a href='<?php echo base_url();?>experts/home'>view all</a></small></span></h4><br/><br/>
                                    <div class="row" style="padding-left:0px;padding-right:0px;">
									<?php foreach($sme as $s) {?>
										 <div class="col-lg-4 services">
											 <figure>
												 <p style="text-align:center"><img src="<?php echo base_url();?>sme_users/<?php echo $s->sme_userid; ?>/<?php echo $s->photo; ?>" width="60%"/></p>
												 <figcaption>
													   <h6><?php echo $s->first_name;?> <?php echo $s->last_name;?></h6>
													   <p><?php echo $limited_string = word_limiter($s->about, 20, ''); ?></p>
													   <a href="<?php echo base_url();?>experts/user/<?php echo $s->sme_userid; ?>">know more</a>
												 </figcaption>
											 </figure>
										 </div>
									 <?php } ?>
                                     </div>
                                  </div>    
                               </div>-->
<div style='display:none;'>
			   <input id="btn-Preview-Image" type="button" value="Preview" />
					<a id="btn-Convert-Html2Image" href="#">Download</a>
					<br />
					<h3>Preview :</h3>
					<div id="previewImage">
					</div>
					</div>
                               
                               <br/><br/><br/><br/>
                </div>
               </div>
            </div>
         </div>
     </section>
   