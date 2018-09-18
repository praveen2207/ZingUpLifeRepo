<style>
.hexagon1 span {
    position: absolute;
    display: block;
    float:left;
    border-left: 65px solid transparent;
    border-right: 63px solid transparent;
}

.hexagon1 {
    width: 128px;
    height: 150px;
    position: relative;
    display: inline-block;
    margin-right: 394px;
    margin-top: -123px;
}
.hexagon2 {
    width: 128px;
    height: 150px;
    position: relative;
    display: inline-block;
    margin-right: 74px;
    margin-top: -17px
}
.hexagon3 {
    width: 128px;
    height: 150px;
    position: relative;
    display: inline-block;
    margin-right: 394px;
    margin-top: -23px;
}
.hexagon1_text{
    position: absolute;
    margin-left: 346px;
    margin-top: 85px;
    width: 157px;
    line-height: 24px;
    text-align: left;
}
.hexagon2_text{
    position: absolute;
    padding-left: 125px;
    padding-top: 222px;
    width: 263px;
    line-height: 24px;
}
.hexagon3_text{
    position: absolute;
    margin-left: 346px;
    margin-top: 358px;
    width: 193px;
    line-height: 24px;
    text-align: left;
}
.hexagon1_text_mobile{
    color: #fff;
    font-family: "Montserrat","Helvetica Neue",Helvetica,Arial,sans-serif;
    line-height: 24px;
    margin-left: 71px;
    margin-right: 20px;
    margin-top: 17px;
    position: absolute;
    text-align: center;
    width: 177px;
    background-image: url("<?php echo base_url();?>assets/assessment/img/button.png");
    background-repeat: no-repeat;
}
a {
   outline: 0;
}
a:active {
    outline: none;
}
/*.hexLink {
    display:block;
    width: 100%;
    height: 100%;
    text-align: center;
    color: #fff;
    overflow: hidden;
}
.hexLink:hover {
    display:block;
    background-color: rgba(0, 128, 128, 0.8);
    -moz-box-shadow: 0 0 10px #ccc; -webkit-box-shadow: 0 0 10px #ccc; box-shadow: 0 0 10px #ccc;
}*/



</style>
<?php //echo "<br/><br/><br/><br/><pre>"; print_r($assessment_1); echo "<br/><br/><br/><br/></pre>"; ?>
<main role="main">
        <div id="intro-wrap">
            <div id="intro" class="preload darken" data-autoplay="5000" data-navigation="true" data-pagination="true" data-transition="fadeUp">
                <div class="intro-item intro-item-image " style="background-color: #363842; background-image: url(<?php echo base_url();?>assets/zing_new/img/banner1.jpg);">
                    <div class="caption hide-mobile hidden-sm hidden-xs" style="top:20px;">
                    <div class="row">  
                        <div class="hexagon1_text">Determine your <?php echo $assessment_1['theme_name'];?></div>
                        <div class="hexagon2_text">Determine your <?php echo $assessment_2['theme_name'];?></div>
                        <div class="hexagon3_text" >Determine your <?php echo $assessment_3['theme_name'];?></div>
                        <div class="col-md-6" style="padding-left: 200px; margin-top:155px;">    
                            
                            <div class="hexagon1">
				<input type="hidden" id="bio_theme_id" value="<?php echo $assessment_1_theme_id; ?>">
				<input type="hidden" id="bio_test_id" value="<?php echo $assessment_1_level_id; ?>">
                                <a style="outline: 0;" onclick="bio_asses_theme();"><img src="<?php echo base_url();?>assets/home_page/images/icon1_biologicalage.png" class="hexLink"  /></a>
                            </div>
                            <div style="clear:both;"></div>
                                <div class="hexagon2">
				    <input type="hidden" id="diet_theme_id" value="<?php echo $assessment_2_theme_id; ?>">
				    <input type="hidden" id="diet_test_id" value="<?php echo $assessment_2_level_id; ?>">
                                    <a style="outline: 0;" onclick="diet_asses_theme();"><img src="<?php echo base_url();?>assets/home_page/images/icon2_dietscore.png"/></a>
                                </div>
                            </a>
                            <div style="clear:both;"></div>
                                <div class="hexagon3">
				    <input type="hidden" id="wns_theme_id" value="<?php echo $assessment_3_theme_id; ?>">
				    <input type="hidden" id="wns_test_id" value="<?php echo $assessment_3_level_id; ?>">
                                    <a class="hexLink"  style="outline: 0;" onclick="wns_asses_theme();"><img src="<?php echo base_url();?>assets/home_page/images/icon3_overallwellness.png"/></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6" style="clear: none !important;">    
                            <div style="position:absolute;padding-right: 195px; padding-top:155px; font-size: 19px;"><h2>Re-Discover <br/> Yourself</h2></div>
                        </div>
                    </div>
                    </div>
                    <!-- caption -->
                </div>
        <header class="hidden-md hidden-lg" style="background-color: #363842; background-image: url(<?php echo base_url();?>assets/zing_new/img/banner1.jpg);margin-top: 0;">
<!--        <div class="jumbotron" style="padding-top:0;margin-bottom: 0;">&nbsp;</div>-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading-white" style="text-transform:none; color: #fff; font-size:22px;">Re-Discover <br>yourself</h3>
                </div>
            </div>
          <div class="row">
            <div style="clear:both;height:10px;"></div>
            <div class="col-sm-12">
                <div class="col-xs-6">
                    <a style="outline: 0;cursor: pointer;" onclick="bio_asses_theme();">
                    <div style="float:left;">
                    <img src="<?php echo base_url();?>assets/assessment/img/bioageicon.png" class="hexLink"  />
                    </div>
                    <div class="hexagon1_text_mobile" style="float:left;">Determine your <br><?php echo $assessment_1['theme_name'];?></div>
                    </a>
		</div>
		 
            </div>
            <div style="clear:both;height:30px;"></div>
            <div class="col-sm-12">
              <div class="col-xs-6">
                  <a style="outline: 0;cursor: pointer;" onclick="diet_asses_theme();">
                  <div style="float:left;">
                    <img src="<?php echo base_url();?>assets/assessment/img/dieticon.png"/>
                    </div>
                  <div class="hexagon1_text_mobile" style="float:left;">Determine your <br><?php echo $assessment_2['theme_name'];?></div>
                  </a>
		</div>
            </div>
            <div style="clear:both;height:30px;"></div>
            <div class="col-sm-12">
              <div class="col-xs-6">
                  <a class="hexLink"  style="outline: 0;cursor: pointer;" onclick="wns_asses_theme();">
                    <div style="float:left;">
                    <img src="<?php echo base_url();?>assets/assessment/img/wholesomenessicon.png"/>
                    </div>
                    <div class="hexagon1_text_mobile" style="float:left;">Determine your <br><?php echo $assessment_3['theme_name'];?></div>
                    </a>
		</div>
            </div>
            <div style="clear:both;height:80px;"></div>
          </div>
        </div>
    </header>
    </div>
            <!-- intro -->
        </div>
        <!-- intro-wrap -->
        <div id="main">
            <section class="row section features">
                <div class="row-content buffer even clear-after">
                    <div class="section-title" style="margin-top:-30px">
                        <h3 style="font-size: 1.5em; font-family: 'Arvo', serif; text-transform:none;">All your wellbeing in one place</h3></div>
                    <div class="column col-xs-4 four last-arrow">
                        <center><img class="animated swing visible" data-animation="swing" src="<?php echo base_url();?>assets/zing_new/img/assess.png"></center>
                        <h2>Assess</h2>
                        <div class="mobile-title hidden-sm hidden-md hidden-lg">
                            <center>Personal Wellbeing assessment and insightful tracking with our truly comprehensive scientific tests and your personal wellness dashboard.</center>
                        </div>
                        <p class="hidden-xs">Personal Wellbeing assessment and insightful tracking with our truly comprehensive scientific tests and your personal wellness dashboard. </p>
                    </div>
                    <div class="column  col-xs-4 four last-arrow">
                        <center><img class="animated swing visible" data-animation="swing" src="<?php echo base_url();?>assets/zing_new/img/consult.png"></center>
                        <h2>Consult</h2>
                        <div class="mobile-title hidden-sm hidden-md hidden-lg">
                             <center>Search, discover, book and follow hundreds of leading Wellness Experts, Therapists and Coaches, over phone, chat and video. </center>
                        </div>
                        <p class="hidden-xs">Search, discover, book and follow hundreds of leading Wellness Experts, Therapists and Coaches, over phone, chat and video. </p>
                    </div>
                    <div class="column col-xs-4 four last">
                        <center><img class="animated swing visible" data-animation="swing" src="<?php echo base_url();?>assets/zing_new/img/engage.png"></center>
                        <h2>Engage</h2>
                        <div class="mobile-title hidden-sm hidden-md hidden-lg">
                            <center>To	Get access to our curated knowledge base, and a large & verified wellness provider network  across multiple locations.  </center>
                        </div>
                        <p class="hidden-xs">To	Get access to our curated knowledge base, and a large & verified wellness provider network  across multiple locations. </p>
                    </div>
                </div>
            </section>
            <section class="row section advisors" style="background-color: #ffc80a">
                <div class="row-content buffer even clear-after">
                    <div class="section-title" style="margin-top:-30px;">
                        <h3 style="color:#fff; font-size: 1.5em; font-family: 'Arvo', serif; text-transform:none;">Wellness and Fitness Experts</h3></div>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-bottom:50px;">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
						<?php $sme = array_chunk($sme_user,4); //echo '<pre>'; print_r(array_chunk($sme_user,3)); ?>
						<?php $i=0;foreach($sme as $s) { $i++;  $j=1; if($i==13) break; ?>
                            <div class="item <?php if($i==1) {?>active<?php } ?>">
							  <?php  foreach ($s as $key => $value) {?>
                                <div class="column three margin-mobile <?php if($j==4) {?>last<?php } ?> ">
                                    <figure> <span style="float:right; background-color: grey; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;">Offline</span>
									<?php if ($value['sme_details']->active == 'y') { ?><span style="float:right; background-color: green; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;visibility:hidden;">Online</span><?php } else {
										?>
										<span style="float:right; background-color: grey; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;visibility:hidden;">Offline</span>
									<?php } ?>
                                        <center>
											<div>
												 <?php if ($value['sme_details']->photo != '') { ?>
														<img src="<?php echo base_url(); ?>sme_users/<?php echo $value['sme_details']->sme_userid; ?>/<?php echo $value['sme_details']->photo; ?>"  style="width: 115px;height:115px;border-radius:50%;">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/new_design/image/sme_user_placeholder.png" style="width: 115px;height:115px;border-radius:50%;">
													<?php } ?>
											</div>
										</center>
                                    </figure>
									<?php  $logged_in_user_data = $this->session->userdata('logged_in_user_data'); ?>
                                    <div class="blog-excerpt" style="margin-top:-30px">
                                        <div class="blog-excerpt-inner inner">
                                            <center>
                                                <h2><?php echo $value['sme_details']->first_name . ' ' . $value['sme_details']->last_name; ?></h2></center>
                                            <center>
                                                <p class="expert"><?php echo $value['sme_details']->expertise; ?></p>
                                            </center>
                                            <br/>
                                            <!--<center>
												<?php if ($value['sme_details']->active == 'y') { ?>
													<a href='<?php echo base_url(); ?>experts/user/<?php echo $value['sme_details']->sme_userid; ?>' ><button type="submit" class="btn btn-book">Book</button></a>
												<?php } else {?>
												<a href='<?php echo base_url(); ?>experts/user/<?php echo $value['sme_details']->sme_userid; ?>' ><button type="submit" class="btn btn-book">Book</button></a>
												<?php } ?>
                                            </center>-->
											<center style='position:relative;'>
												<?php if ($value['sme_details']->active == 'y' && ($value['sme_details']->chat_pricing != '' || $value['sme_details']->video_pricing != '' || $value['sme_details']->audio_pricing != '') ) { ?>
												<a href='#' id='<?php echo $value['sme_details']->sme_userid; ?>' class='sme_chat'><button type="submit" class="btn btn-chat">Chat</button></a>
												<button style='position:absolute;display:none;background:#ccc;width:13%;opacity:.5;height:21px;left:26px;top:0px;' class='btn btn-book btn-chat-hide'></button>

												<a href='<?php echo base_url(); ?>experts/user_book/<?php echo $value['sme_details']->sme_userid; ?>' id='<?php echo $value['sme_details']->sme_userid; ?>' <?php if ($logged_in_user_data->is_logged_in != 1) { ?>class='sme_book'<?php } ?>><button type="submit" class="btn btn-book">Book</button></a>
												<?php } else {?>
												<a href='<?php echo base_url(); ?>experts/user_book/<?php echo $value['sme_details']->sme_userid; ?>'id='<?php echo $value['sme_details']->sme_userid; ?>'  <?php if ($logged_in_user_data->is_logged_in != 1) { ?>class='sme_book'<?php } ?>><button type="submit" class="btn btn-book">Book</button></a>
												<?php } ?>
											</center>
                                        </div>
                                        <!-- blog-excerpt -->
                                    </div>
                                    <!-- blog-excerpt-inner -->
                                </div>
							  <?php $j++; } ?>
                            </div>
						<?php } ?>
                        </div>
                    </div>
                <center>
                    <a href='<?php echo base_url();?>experts/home' ><button type="button" class="btn btn-view" style="margin-top: 58px;">View all <i class="fa fa-caret-right" aria-hidden="true"></i></button></a>
                </center>
                </div>
            </section>
<!--            <section class="row section services">
                <div class="row-content buffer even clear-after">
                        <div class="section-title" style="margin-top:-30px;">
                            <h3 style="font-size: 1.5em; font-family: 'Arvo', serif; text-transform:none;">Wellness Services</h3></div>
                         <div class="grid-items blog-section masonry-style preload">
							<article class="item column four">
								<a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[0]->slug; ?>">
									<figure><img src="<?php echo base_url();?>assets/zing_new/img/cat1.jpg" alt=""><span class="blog-overlay"><i class="icon icon-doc"></i></span></figure>
									<div class="blog-excerpt">
										<div class="blog-excerpt-inner">
											<h2>Spa and Massage Therapies</h2>
											<p>Escape into another world to recompose, refresh and rejuvenate.</p>
										</div> blog-excerpt 
									</div> blog-excerpt-inner 
								</a>
							</article>
							<article class="item column four">
								<a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[1]->slug; ?>">
									<figure><img src="<?php echo base_url();?>assets/zing_new/img/cat2.jpg" alt=""><span class="blog-overlay"><i class="icon icon-doc"></i></span></figure>
									<div class="blog-excerpt">
										<div class="blog-excerpt-inner">

											<h2><?php echo $services[1]->service_name; ?></h2>
											<p>Modern practices derived from ancient healthcare systems.</p>
										</div> blog-excerpt-inner 
									</div> blog-excerpt 
								</a>
							</article>
							<article class="item column four">
								<a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[2]->slug; ?>">
									<figure><img src="<?php echo base_url();?>assets/zing_new/img/cat33.jpg" alt=""><span class="blog-overlay"><i class="icon icon-doc"></i></span></figure>
									<div class="blog-excerpt">
										<div class="blog-excerpt-inner">

											<h2>Yoga and Meditation</h2>
											<p>Explore the essence of physical, mental and spiritual disciplines.</p>
										</div> blog-excerpt 
									</div> blog-excerpt-inner 
								</a>
							</article>
							<article class="item column four" style="margin-top:3px !important">
								<a href="<?php echo base_url(); ?>search/keyword=<?php echo $services[3]->slug; ?>">
									<figure><img src="<?php echo base_url();?>assets/zing_new/img/cat44.jpg" alt=""><span class="blog-overlay"><i class="icon icon-doc"></i></span></figure>
									<div class="blog-excerpt">
										<div class="blog-excerpt-inner">

											<h2>Fitness and Nutrition</h2>
											<p>Enjoy the glow of good health and nourishment everyday.</p>
										</div> blog-excerpt 
									</div> blog-excerpt-inner 
								</a>
							</article>
							<article class="item column eight">
								<a href="">
									<figure><img src="<?php echo base_url();?>assets/zing_new/img/ComingSoon_Packages1.jpg" alt="" style="height: 305px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;"><span class="blog-overlay" style="border-bottom-right-radius: 0px !important;border-bottom-left-radius: 0px !important"><i class="icon icon-doc"></i></span></figure>
									<div class="blog-excerpt">
										<div class="blog-excerpt-inner">


										</div> blog-excerpt 
									</div> blog-excerpt-inner 
								</a>
							</article>
							<div class="shuffle-sizer four"></div>
						</div> grid-items 
                </div>
            </section>-->
            <section class="row section text-light wellbeing" style="background-color: rgb(63, 171, 60);">
                <div class="row-content buffer even clear-after">
                    <div class="section-title" style="margin-top:-35px;">
                        <h3 style="font-size: 1.5em; font-family: 'Arvo', serif; text-transform:none;">Know Your Well Being</h3></div>
                    <div class="column col-xs-4 four ">
                        <center><img class="animated swing visible" data-animation="swing" src="<?php echo base_url();?>assets/zing_new/img/icon1.png"></center>
                        <h2>8BAK-C Personal assessment</h2>
                        <div class="mobile-title hidden-sm hidden-md hidden-lg">                            <center>The 8BAK-C assesses over 80 factors related to your wellbeing &#8208; across physical, emotional, intellectual, spiritual, social, occupational, environmental &  financial wellness dimensions &#8208; the 8 dimensions of human wellness as defined by the World Health Organization</center>                            <center><a href="<?php echo base_url(); ?>survey/home">Know More &nbsp; <i class="fa fa-caret-right" aria-hidden="true"></i></a></center>                        </div>
                        <div class="space">
                            <p class="hidden-xs">The 8BAK-C assesses over 80 factors related to your wellbeing &#8208; across physical, emotional, intellectual, spiritual, social, occupational, environmental &  financial wellness dimensions &#8208; the 8 dimensions of human wellness as defined by the World Health Organization</p>							<center class="hidden-xs"><a href="<?php echo base_url(); ?>survey/home">Know More &nbsp; <i class="fa fa-caret-right" aria-hidden="true"></i></a></center>
                        </div>
                        
                    </div>
                    <div class="column  col-xs-4 four">
                        <center><img class="animated swing visible" data-animation="swing" src="<?php echo base_url();?>assets/zing_new/img/icon2.png"></center>
                        <h2>Wellness Tools and Resources</h2>
                         <div class="mobile-title hidden-sm hidden-md hidden-lg">                            <center>A&#8208;la&#8208;carte wellness tools, curated knowledge base, and bespoke programs to help individuals and employers create a happier and healthier lifestyle</center>                            <center><a href="<?php echo base_url(); ?>survey/home">Know More &nbsp; <i class="fa fa-caret-right" aria-hidden="true"></i></a></center>                        </div>
                        <div class="space">
                            <p class="hidden-xs">A&#8208;la&#8208;carte wellness tools, curated knowledge base, and bespoke programs to help individuals and employers create a happier and healthier lifestyle</p>							<center class="hidden-xs"><a href="<?php echo base_url(); ?>survey/home">Know More &nbsp; <i class="fa fa-caret-right" aria-hidden="true"></i></a></center>
                        </div>
                        
                    </div>
                    <div class="column col-xs-4 four last">
                        <center><img class="animated swing visible" data-animation="swing" src="<?php echo base_url();?>assets/zing_new/img/icon3.png"></center>
                        <h2>Ask a question</h2>
                         <div class="mobile-title hidden-sm hidden-md hidden-lg">                            <center>Quick and easy access to our global network of certified wellness advisors and contributors, anytime, anywhere. Personalized and anonymous!</center>                            <center><a href="<?php echo base_url(); ?>survey/home">Know More &nbsp; <i class="fa fa-caret-right" aria-hidden="true"></i></a></center>                        </div>
                       <div class="space">                            <p class="hidden-xs">Quick and easy access to our global network of certified wellness advisors and contributors, anytime, anywhere. Personalized and anonymous!</p>                            <center class="hidden-xs"><a href="<?php echo base_url(); ?>survey/home">Know More &nbsp; <i class="fa fa-caret-right" aria-hidden="true"></i></a></center>                        </div>                        
                    </div>
                </div>
            </section>
            <section class="row section knowledge">
                <div class="row-content buffer even base clear-after">
                    <div class="section-title" style="text-align: left;margin-top:-30px;">
                        <h3 style="font-family: 'Arvo', serif; text-transform:none;">KNOWLEDGE BASE</h3></div>
                    <div class="column nine">
                    <div class="column four">
                        <figure> <img src="<?php echo base_url(); ?>assets/new_design/image/knowledgebase_1.jpg" width="100%" > </figure>
                        <div class="blog-excerpt">
                            <div class="blog-excerpt-inner inner2">
                                <h2>About omega 3 fish oils, and zinc supplements</h2>
                                <p>Omega 3 fish oils are a substance that can be found in the bodies</p>
                            </div>
                        </div>
                        <!-- blog-excerpt-inner -->
                    </div>
                    <div class="column four">
                        <figure> <img src="<?php echo base_url(); ?>assets/new_design/image/knowledgebase_2.jpg" width="100%"> </figure>
                        <div class="blog-excerpt">
                            <div class="blog-excerpt-inner inner2">
                                <h2>Detoxification:natural remedies for cleansing your body</h2>
                                <p>If you have ever wondered what it’s like to go through a total body</p>
                            </div>
                            <!-- blog-excerpt -->
                        </div>
                        <!-- blog-excerpt-inner -->
                    </div>
                    <div class="column four last">
                        <figure> <img src="<?php echo base_url(); ?>assets/new_design/image/knowledgebase_3.jpg" width="100%"> </figure>
                        <div class="blog-excerpt">
                            <div class="blog-excerpt-inner inner2">
                                <h2>Fitness centre's:an investigation</h2>
                                <p>Today, we have many Indians who are obsessed with health, and yet</p>
                            </div>
                            <!-- blog-excerpt -->
                        </div>
                        <!-- blog-excerpt-inner -->
                    </div>
                    <center>
                    <a target="_blank" href="http://zinguplife.com/knowledgebase" >
						<button type="button" class="btn btn-knowbook" style="margin-top:20px">View all <i class="fa fa-caret-right" aria-hidden="true"></i></button>
					</a>
                    </center>
                    </div>
					<div class="column three last" style="margin-top:-121px;" >
					     <div class="section-title" style="text-align: left;text-transform: none;"><h3 style="font-family: 'Arvo', serif;">Upcoming events</h3></div>
					     <div style="height:332px;border-radius:15px;background-color: #363842; background-image: url(<?php echo base_url(); ?>assets/new_design/image/events.png);">

					     </div>
					</div>
                </div>

            </section>
            <section class="row section light-text" style="background-color: #00a651;color: #fff">
                <div class="row-content buffer even clear-after" style="margin-bottom:0em !important;">
                    <div class="section-title" style="margin-bottom:0em;">
                        <h3 style="color: #fff">What People Say</h3></div>
                    <div class="col-md-12" data-wow-delay="0.2s">
                        <div class="carousel slide" data-ride="carousel" id="quote-carousel" data-interval="false">
                            <!-- Bottom Carousel Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#quote-carousel" data-slide-to="0" class="active"><img class="img-responsive " src="<?php echo base_url(); ?>assets/testimonials/mannat_sharma.jpg"> </li>
                                <li data-target="#quote-carousel" data-slide-to="1"><img src="<?php echo base_url(); ?>assets/testimonials/ridhi_bakshi.jpg" class="img-responsive "> </li>
                                <li data-target="#quote-carousel" data-slide-to="2"><img src="<?php echo base_url(); ?>assets/testimonials/amol_motwani.jpg" class="img-responsive "> </li>
                            </ol>
                            <!-- Carousel Slides / Quotes -->
                            <div class="carousel-inner text-center my-img">
                                <!-- Quote 1 -->
                                <div class="item active">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1" style="margin-top:40px;">
                                                <div class="column three">
                                                    <center><img class="img-responsive " src="<?php echo base_url(); ?>assets/testimonials/mannat_sharma.jpg" alt="" width="130px;" style="border:4px solid #ccc"></center>
                                                    <h5 style="color: #fff;margin-top:15px">- Mannat Sharma</h5> </div>
                                                     <div class="column one"></div>
                                                <div class="column seven last">
                                                    <h4 style="text-align:left;font-size:25px;color:#fff">Testimonial</h4>
                                                    <p style="text-align:left;font-size:14px"> Over 3 epic weeks, Dr. Geetha skilfully made me conscious of my emotional and intellectual wellness. My peak stage of well-being is now within sight.</p>
                                                </div>
                                                <div class="column one"></div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 2 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1" style="margin-top:40px;">
                                                <div class="column three">
                                                    <center><img class="img-responsive " src="<?php echo base_url(); ?>assets/testimonials/ridhi_bakshi.jpg" alt="" width="130px;" style="border:4px solid #ccc"></center>
                                                    <h5 style="color: #fff;margin-top:15px">- Ridhi Bakshi</h5> </div>
                                                     <div class="column one"></div>
                                                <div class="column seven last">
                                                    <h4 style="text-align:left;font-size:25px;color:#fff">Testimonial</h4>
                                                    <p style="text-align:left;font-size:14px"> ZingUpLife is an incredible platform to discover curated wellness services in the neighborhood, as well as consult with leading specialists. You've made it to my bookmarked list.</p>
                                                </div>
                                                <div class="column one"></div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 3 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1" style="margin-top:40px;">
                                                <div class="column three">
                                                    <center><img class="img-responsive " src="<?php echo base_url(); ?>assets/testimonials/amol_motwani.jpg" alt="" width="130px;" style="border:4px solid #ccc"></center>
                                                    <h5 style="color: #fff;margin-top:15px">- Amol Motwani</h5> </div>
                                                 <div class="column one"></div>
                                                <div class="column seven last">
                                                    <h4 style="text-align:left;font-size:25px;color:#fff">Testimonial</h4>
                                                    <p style="text-align:left;font-size:14px"> An effortless, honest-to-goodness way to keep my mind, body and spirit at their peak. The online experts are accomplished and sincere. Highly recommended.</p>
                                                </div>
                                                <div class="column one"></div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="right carousel-control" href="javascript:void(0)" role="button" data-slide="next"> <img src="<?php echo base_url();?>assets/zing_new/img/arrow.png" style="font-size:20px;width:37px;background:#f1c40f;padding: 10px;border-radius: 50%;" /> <span class="sr-only">Next</span> </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- id-main -->
    </main>
    <!-- main -->
