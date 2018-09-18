
<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">        	
        	
    		<div class="content-inner">
    			<div class="row">
                	<div class="col-xs-12 full-page" >
						<?php echo $this->view('includes/sme_header');?>
                    <div class="feedbacktab-tabs-container">
						<div class="dashboard-content-inner">
							<?php echo validation_errors(); ?>
								<?php if($this->session->flashdata('msg')) { ?>
									<p><?php echo $this->session->flashdata('msg'); ?></p>
								<?php } ?>
								        <div class="dashboard-content-inner">
										<ul id="myList" class="feedback-all-list-view">
											<li style="display: list-item;">
												<div class="feedback-list-head">
													<div class="item-head-img">
													<span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
													<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($feedback[0]->added_on));?></span></p>
													<h5><span><?php echo $feedback[0]->name; ?> said..</span> <?php echo $feedback[0]->subject; ?> .</h5>
														<div class="review-rating-right">
														<span><?php if($feedback[0]->fb_score == 4.5) { ?>
																	<img src="<?php echo base_url();?>images/b-four-half-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 4) { ?>
																	<img src="<?php echo base_url();?>images/b-four-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 5) { ?>
																	<img src="<?php echo base_url();?>images/b-five-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 3) { ?>
																	<img src="<?php echo base_url();?>images/b-three-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 3.5) { ?>
																	<img src="<?php echo base_url();?>images/b-three-half-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 2) { ?>
																	<img src="<?php echo base_url();?>images/b-two-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 2.5) { ?>
																	<img src="<?php echo base_url();?>images/b-two-half-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 1.5) { ?>
																	<img src="<?php echo base_url();?>images/b-one-half-rating.png" alt="" />
																<?php } ?>
																<?php if($feedback[0]->fb_score == 1) { ?>
																	<img src="<?php echo base_url();?>images/b-one-rating.png" alt="" />
																<?php } ?></span>
														<span><?php 
																$oneweek= date("Y-m-d", strtotime("3 days ago"));
																$today = date('Y-m-d');
																$added = date('Y-m-d',strtotime($feedback[0]->added_on));
																if($added < $today && $added >= $oneweek) {
															?>
																<img alt="" src="<?php echo base_url();?>images/new-icon.png">
															<?php } else if($added == $today){?>
																<img alt="" src="<?php echo base_url();?>images/hot-icon.png">	
															<?php } else { ?>
																<img alt="" src="<?php echo base_url();?>images/old-icon.png">	
															<?php } ?>
														</span>
														</div>                                                        
													</div>
												</div>
												<div class="feedback-list-content" style='border-bottom: 1px solid #d4d4d4;margin-bottom:10px;'>
                                                    <p><?php echo word_limiter($feedback[0]->feedback, 30); ?></p>
                                                    <a href="#">This communication have <?php  $total = count($feedback[0]->comments) + count($feedback[0]->smecomments); echo $total;?> replies yet.</a>
                                                </div>
												<ul id="myList" class="feedback-all-list-view">
												<?php $i = 0;foreach($feedback[0]->smecomments as $fb) { $i++; if($i == 6) break; ?>
													<li style="display: list-item; border:none;margin:0px 10px 20px;width:96%;">
														<div class="feedback-list-head" style='box-shadow:none;'>
															<div class="item-head-img">
																<span class="review-hero"><img src="<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid');?>/<?php echo $this->session->userdata('photo');?>" alt="" width='36' height='36'></span>
																<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?></span></p>
																<h5><span>I replied..</span> <?php echo $fb->subject; ?> .</h5>
															</div>
															<div class="feedback-list-content" style='padding:10px 0px 0px;'>
																<p style='font-size:14px;line-height:20px;font-family:roboto;'><?php echo word_limiter($fb->comment); ?></p>
															</div>
														</div>
										
															
													
													</li>
												<?php }?>
												
												
												<?php $i = 0;foreach($feedback[0]->comments as $fb) { $i++; if($i == 6) break; ?>
													<li style="display: list-item; border:none;margin:0px 10px 20px;width:96%;">
														<div class="feedback-list-head" style='box-shadow:none;'>
															<div class="item-head-img">
																<span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
																<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?></span></p>
																<h5><span><?php echo $fb->name; ?> replied..</span> <?php echo $fb->subject; ?> .</h5>
															</div>
															<div class="feedback-list-content" style='padding:10px 0px 0px;'>
																<p style='font-size:14px;line-height:20px;font-family:roboto;'><?php echo word_limiter($fb->comment); ?></p>
															</div>
														</div>
										
															
													
													</li>
												<?php }?>
												</ul>
											</li>
										</ul>
										
										 
                                        	<div class="dashboard-content-inner-box">
											<?php echo validation_errors(); ?>
											<?php if($this->session->flashdata('msg')) { ?>
												<p><?php echo $this->session->flashdata('msg'); ?></p>
											<?php } ?>
                                            <h2 class="dashboard-title ">Reply this Feedback</h2>
                                            <div class="dashboard-content-boxinner">
									
												<form action='<?php echo base_url();?>feedback/add_reply' method='post'>
                                           
                                                <div class="row" style='clear:both;'>
                                                	<div class="col-xs-12">
                                                  
                                                    <textarea name='comment'> </textarea>
                                                    </div>
                                                </div>
												<input type="hidden"  name='sme_userid' value="<?php echo $this->uri->segment(3);?>">
												<input type="hidden"  name='fb_id' value="<?php echo $feedback[0]->id;?>">
                                                <input class="button" value="Publish" type="submit">
                                                
                                            </form>
                                            </div>
                                            </div>
                                            
                                                
										
										
                                        </div>                                       
                                    </div>
							
							</div> 
						</div>
					</div>  
				</div>
			</div>
		</div>
	</div>	
</div>

