<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">
        	
        	
            
    		<div class="content-inner">
    			<div class="row">
                	
                    
                    <div class="col-xs-12 full-page" > 
                    
                    	<div class="dashboard-inner feedback-add">
                        	
                                <div class=" dashboard-left" > 
                                	<?php $this->view('includes/sidebar'); ?>
                                </div>
                                <div class="dashboard-right" > 
                                	<div class="dashboard-right-inner">
                                    	<div class="dashboard-top-banner" style='background: url("<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $this->session->userdata('header_image'); ?>") no-repeat 50% 0;background-size:cover;'>                                        	
                                            <div class="dashboard-top-details">
                                            	<div class="dashboard-top-details-inner">
                                                	<div class="row">
                                                    	<div class="col-xs-6">
                                                        	<div class="dashboard-top-left-details">
                                                    		<div class="page-big-icon"><img alt="" src="<?php echo base_url(); ?>images/dashboard-icon/user-big-icon.png" /></div>
                                                            <h3>Welcome To <?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?></h3>                                                            
                                                            </div>
                                                    	</div>                                                        
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>                                         
                                         <div class="dashboard-content-inner">
										 <ul class="feedback-rating">
											<li><a href="<?php echo base_url();?>followers/lists/<?php echo $this->uri->segment(3); ?>"><span></span> <?php echo count($follow_cnt);?> Followers</a></li>
											<li><a href="<?php echo base_url();?>questions/lists/<?php echo $this->uri->segment(3); ?>"><span></span> <?php echo count($questions);?> Questions</a></li>
											<li><a href="<?php echo base_url();?>articles/lists/<?php echo $this->uri->segment(3); ?>"><span></span> <?php echo count($articles);?> Articles</a></li>
											<li><a href="<?php echo base_url();?>feedback/lists/<?php echo $this->uri->segment(3); ?>"><span></span> <?php echo count($feedback);?> Feedback</a></li>
											<li><a href="<?php echo base_url();?>events/lists/<?php echo $this->uri->segment(3); ?>"><span></span> <?php echo count($events);?> Events</a></li>
										</ul>
										 <?php if(count($ur_questions) > 0 ) { ?>
											<a href='<?php echo base_url();?>questions/expedited'><h2>expedited Questions (<?php echo count($ur_questions); ?>)</h2></a>
										 <?php } ?>
                                         	<h2>Unanswered Questions (<?php echo count($unansque); ?>)</h2>
                                         	<div class="dashboard-content-inner-box">                                            
											<div class="setting-content dashboard-content-boxinner">
												<?php if(count($unansque) > 0) { ?>                                                
                                                <ul id="question-list" class="feedback-all-list-view">
													<?php $i=0; foreach($unansque as $question) { $i++; if($i==9) break;?>
                                                    <a href='<?php echo base_url(); ?>questions/detail/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $question->id; ?>'><li style="display: list-item;">
                                                        <div class="feedback-list-head">
                                                            <div class="item-head-img">
                                                            <span class="review-hero"><img src="<?php echo base_url(); ?>images/user-photo.jpg" alt=""></span>
                                                            <p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($question->added_on));?></span></p>
                                                            <h5><span><?php echo $question->name;  ?> </span> asked..</h5>
                                                                <div class="review-rating-right">
                                                                <?php 
																	$oneweek= date("Y-m-d", strtotime("7 days ago"));
																	$today = date('Y-m-d');
																	$added = date('Y-m-d',strtotime($question->added_on));
																	if($added <= $today && $added >= $oneweek) {
																?>
																<span><img src="<?php echo base_url(); ?>images/new-icon.png" alt="" /></span>
																<?php } else if($added == $today) { ?>
																	<span><img src="<?php echo base_url(); ?>images/hot-icon.png" alt="" /></span>
																<?php } else { ?>
																	<span><img src="<?php echo base_url(); ?>images/old-icon.png" alt="" /></span>
																<?php } ?>
                                                                </div>                                                        
                                                            </div>
                                                        </div>
                                                        <div class="feedback-list-content">
                                                            <p><?php echo $limited_string = word_limiter($question->question, 10, ''); ?></p>
                                                            <!--<div class="question-last-content">This communication have 3 replies yet. - <a href="">4 other users</a> found this question helpful.</div>-->
                                                        </div>
                                                    </li></a>
                                                    <?php } ?>                                                                                   
                                                </ul>
                                                <?php } else { ?>
                                                <p>There are no Questions</p>
                                                <?php } ?>
                                                <div><?php if(count($unansque) > 8)  {?>
														<div class="row">
															<div class="col-xs-12 mar-auto">
																<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
																<input type="hidden" name="limit" id="queslimit" value="8"/>
																<input type="hidden" name="offset" id="quesoffset" value="<?php echo $offset;?>"/>
																<div class="view-more">
																<button style='margin-bottom:0px;' onclick="loadmoresmeunansquestions()" value="Load more" id="load-more" class='ques-load-more' /><span style='color:#fff;'>Load More</span></div>
																<!--<div class="view-more"><a href="<?php echo base_url();?>questions/listing" class="button">Load more</a></div> -->
															</div>
														</div>
													<?php } ?></div>
                                            </div>
                                        </div>
                                            
                                        </div>   
                                        <div class="dashboard-content-inner">
                                         	<h2>Feedback</h2>
                                         	<div class="dashboard-content-inner-box">                                            
											<div class="setting-content dashboard-content-boxinner">                                                
                                                <?php if(count($feedback) > 0) { ?>         
                                                <ul id="feedback-list" class="feedback-all-list-view">
												<?php $i=0; foreach($feedback as $fb) { $i++; if($i==6) break;?>
													<li style="display: list-item;">
														<div class="feedback-list-head">
															<div class="item-head-img">
															<span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
															<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?> - <?php echo count($fb->comments);?> Replies</span></p>
															<h5><span><?php echo $fb->name; ?> said..</span> <?php echo $fb->subject; ?></h5>
																<div class="review-rating-right">
																<span>
																	
																		<?php if($fb->fb_score == 4.5) { ?>
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
																		<?php } ?>
																	</span>
																<span>
																	<?php 
																			$oneweek= date("Y-m-d", strtotime("3 days ago"));
																			$today = date('Y-m-d');
																			$added = date('Y-m-d',strtotime($fb->added_on));
																			if($added <= $today && $added >= $oneweek) {
																		?>
																		<img src="<?php echo base_url(); ?>images/new-icon.png" alt="" />
																		<?php } else if($added == $today) { ?>
																			<img src="<?php echo base_url(); ?>images/hot-icon.png" alt="" />
																		<?php } else { ?>
																			<img src="<?php echo base_url(); ?>images/old-icon.png" alt="" />
																		<?php } ?>
																	
																	</span>
																</div>                                                        
															</div>
														</div>
														<div class="feedback-list-content">
															<p><?php echo $fb->feedback; ?></p>
															<a href="#">This communication have <?php echo count($fb->comments); ?> replies yet.</a>
														</div>
													</li>
                                                 <?php } ?>                                                                                    
                                            </ul>
                                            <?php } else { ?>
                                                <p>There are no Feedback</p>
                                                <?php } ?>
                                            	<div>
													<?php if(count($feedback) > 5) {?>
														<div class="row">
															<div class="col-xs-12 mar-auto">
																<div>
																	<button onclick="smefbloadmore()" value="loadmore" id="load-more"  class='sme-fb-loadmore' style='margin-bottom:0px;'/>
																	
																	<input type='hidden' name='sme_userid' class='sme_userid' value='<?php echo $this->session->userdata('sme_userid'); ?>' />
															
																	<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
																	<input type="hidden" name="limit" id="smefblimit" value="5"/>
																	<input type="hidden" name="offset" id="smefboffset" value="<?php echo $fboffset;?>"/>
																	<span style='color:#fff;'>Load More</span>
																</div>
															</div>
														</div>
													<?php } ?>
													
													
													</div>
                                            </div>
                                        </div>
                                            
                                        </div>
                                        <div class="dashboard-content-inner">
                                         	<h2>Article</h2>
                                         	<div class="dashboard-content-inner-box">                                            
											<div class="setting-content dashboard-content-boxinner">                                                
												<div class="product-list">
													<?php if(count($articles) > 0) { ?>       
													<ul id="article-list">
													   <?php $i=0; foreach($articles as $ar) { $i++; if($i==5) break;?>
														<li style="display: list-item;">
															<div class="product-inner">
																<div class="product-list-image"><a href="<?php echo base_url(); ?>articles/detail/<?php echo $ar->id; ?>"><img src="<?php echo base_url();?>sme_users/articles/<?php echo $ar->id; ?>/<?php echo $ar->photo; ?>" alt="" style="width:200px;" /></a></div>
																<div class="product-list-details">
																	<a href="#"><h5><?php  echo $limited_string = word_limiter($ar->heading, 3, '');?></h5> </a>
																	<div class="item-head-img" style='padding-left:0px;'>
																		<p><span class="post-user"><a href="<?php echo base_url(); ?>articles/detail/<?php echo $ar->id; ?>">Posted On </a> <?php echo date('d F, Y  h:i A',strtotime($ar->added_on));?> <br></span><a class="comment-count" href="<?php echo base_url(); ?>articles/detail/<?php echo $ar->id; ?>"><?php echo $ar->comments[0]->count; ?> Comment</a></p>                                       
																	</div>                                       
																</div>
															</div>
														</li>
														<?php } ?> 
													</ul>
													<?php } else { ?>
                                                <p>There are no Articles published by You</p>
                                                <?php } ?>
												</div>
												<div class="clear"></div>
												
													<?php if(count($articles) > 5) {?>
														<div class="row">
															<div class="col-xs-12 mar-auto">
																<div>
																	<button onclick="smearloadmore()" value="loadmore" id="load-more"  class='sme-ar-loadmore' style='margin-bottom:0px;'/>
																	
																	<input type='hidden' name='sme_userid' class='sme_userid' value='<?php echo $this->session->userdata('sme_userid'); ?>' />
															
																	<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
																	<input type="hidden" name="limit" id="smearlimit" value="5"/>
																	<input type="hidden" name="offset" id="smearoffset" value="<?php echo $aroffset;?>"/>
																	<span style='color:#fff;'>Load More</span>
																</div>
															</div>
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
    	</div>
    </div>
</div>

