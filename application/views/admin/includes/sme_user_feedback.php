<?php echo $this->session->userdata('user_id'); //echo '<pre>'; print_r($feedback); ?>
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
								        <div class="dashboard-content-inner" style='padding-top:0px;'>
										<div class="dashboard-top-right-details" style='margin-top:0px;'>
												<a href='<?php echo base_url();?>feedback/add/<?php echo $this->uri->segment(3); ?>'><button type="button" class="btn btn-info btn-lg button fb-respond">Add Feedback</button></a>
											</div>
											
                                        	<ul id="myList" class="feedback-all-list-view" style='clear:both;'>
											<?php $i = 0;foreach($feedback as $fb) { $i++; if($i == 6) break; ?>
										
                                            	<a  href='<?php echo base_url(); ?>feedback/detailpage/<?php echo $this->uri->segment(3); ?>/<?php echo $fb->id; ?>'>
												<li style="display: list-item;" class='fb_<?php echo $fb->id; ?>'>
                                                	<div class="feedback-list-head">
                                                        <div class="item-head-img">
                                                        <span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
                                                        <p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?></span></p>
                                                        <h5><span><?php echo $fb->name; ?> said..</span> <?php echo $fb->subject; ?> .</h5>
                                                            <div class="review-rating-right">
                                                            <span><?php if($fb->fb_score == 4.5) { ?>
																		<img src="<?php echo base_url();?>images/b-four-half-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 4) { ?>
																		<img src="<?php echo base_url();?>images/b-four-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 5) { ?>
																		<img src="<?php echo base_url();?>images/b-five-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 3) { ?>
																		<img src="<?php echo base_url();?>images/b-three-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 3.5) { ?>
																		<img src="<?php echo base_url();?>images/b-three-half-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 2) { ?>
																		<img src="<?php echo base_url();?>images/b-two-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 2.5) { ?>
																		<img src="<?php echo base_url();?>images/b-two-half-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 1.5) { ?>
																		<img src="<?php echo base_url();?>images/b-one-half-rating.png" alt="" />
																	<?php } ?>
																	<?php if($fb->fb_score == 1) { ?>
																		<img src="<?php echo base_url();?>images/b-one-rating.png" alt="" />
																	<?php } ?></span>
                                                            <span><?php 
																	$oneweek= date("Y-m-d", strtotime("3 days ago"));
																	$today = date('Y-m-d');
																	$added = date('Y-m-d',strtotime($fb->added_on));
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
                                                    <div class="feedback-list-content">
													
                                                    	<p><?php echo word_limiter($fb->feedback, 30); ?></p>
														<?php if($fb->userid == $this->session->userdata("logged_in_user_data")->user_id) {?>
															<a  style='cursor:pointer;' href='<?php echo base_url();?>feedback/edit/<?php echo $this->uri->segment(3); ?>/<?php echo $fb->id; ?>'><img src='<?php echo base_url();?>images/fbedit.png' /></a> &nbsp;&nbsp;&nbsp;<a class='delete-feedback ' style='cursor:pointer;' id='<?php echo $fb->id; ?>'><img src='<?php echo base_url();?>images/fbdelete.png' /></a>
														<?php }?>
														<br/>
                                                        <a href="#">This communication have <?php echo count($fb->comments);?> replies yet.</a>
                                                    </div>
                                                </li></a>
											<?php }?>
											</ul>
											<?php if(count($feedback) > 5) {?>
												<div>
													<?php if($this->uri->segment(2) == 'type') { ?>
														<button onclick="loadmorefbtype()" value="loadmore" id="load-more" />
														<?php if($this->uri->segment(4) == 'positive') {?>
															<input type='hidden' name='type' class='type' value='positive' />
														<?php } else if($this->uri->segment(4) == 'neutral') { ?>
															<input type='hidden' name='type' class='type' value='neutral' />
														<?php } else { ?>
															<input type='hidden' name='type' class='type' value='negative' />
														<?php } ?>
													<?php } else { ?>
														<button onclick="loadmore()" value="loadmore" id="load-more" />
													<?php } ?>
													<input type='hidden' name='sme_userid' class='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
												
													<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
													<input type="hidden" name="limit" id="limit" value="5"/>
													<input type="hidden" name="offset" id="offset" value="<?php echo $offset;?>"/>
													<span style='color:#fff;'>Load More</span>
												</div>
											<?php } ?>
                                        </div>  
							
							</div> 
						</div>
					</div>  
				</div>
			</div>
		</div>
	</div>	
</div>
