<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">        	
        	
    		<div class="content-inner">
    			<div class="row">
                	<div class="col-xs-12 full-page" >
						<?php echo $this->view('includes/sme_header');?>
						
				<div class="recent-question-content">
                    <div class="recent-question">
                    	<h3>Recent Answered Questions</h3>
                        <span class="question-unread">
							<form action='<?php echo base_url();?>user_zingup/check' method='post'>
								<li>
									<input type='hidden' name='referrer' value='<?php echo base_url();?>questions/ask/<?php echo $this->uri->segment(3); ?>' />
									<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
									<input type='submit' value='Ask a Question' class="red-button button"/>

								</li>
							</form>
							
							
							</span>
                    </div>                    
                    <div class="reviewtab">
						
						<div class="feedbacktab-tabs-container">
							<div class="grid">
							<div class="grid-sizer"></div>
							<?php $i=0; foreach($questions as $question) { $i++; if($i==6) break;?>
							  <div class="grid-item">
									<div class="grid-item-inner">
										<div class="review-item-head">
											<div class="item-head-img">
											<span class="review-hero"><img src="<?php echo base_url(); ?>images/user-photo.jpg" alt="" /></span>
											<span><?php echo date('d F, Y  h:i A',strtotime($question->added_on));?> </span>
											<h6><?php echo $question->name;  ?> <span>asked..</span></h6>
											</div>
											<?php 
												$oneweek= date("Y-m-d", strtotime("7 days ago"));
												$today = date('Y-m-d');
												$added = date('Y-m-d',strtotime($question->added_on));
												if($added <= $today && $added >= $oneweek && $question->answer == '') {
											?>
												<span class="review-new"><img src="<?php echo base_url(); ?>images/new-icon.png" alt="" /></span>
											<?php } else if($question->answer == '') { ?>
												<span class="review-new"><img src="<?php echo base_url(); ?>images/hot-icon.png" alt="" /></span>
											<?php } ?>
										</div>
										<div class="review-item-content">
											<h2><?php echo $limited_string = word_limiter($question->question, 10, ''); ?></h2>
											<!--<p><a href="#">4 other users</a> found this question helpful</p>-->
										</div>
										
										
									</div>
								  </div>
								<?php } ?>
							</div>
							<?php if(count($questions) > 5)  {?>
								<div class="row">
									<div class="col-xs-5 mar-auto">
										<div class="view-more">
											<form action='<?php echo base_url();?>user_zingup/check' method='post'>
												<li>
													<input type='hidden' name='referrer' value='<?php echo base_url();?>questions/lists/<?php echo $this->uri->segment(3); ?>' />
													<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
													<input type='submit' value='View More' class="button"/>

												</li>
											</form>
											</div> 
									</div>
								</div>
							<?php } ?>
						</div>
					</div>  
				</div>
				<div class="recent-feedback-content">
                    <div class="recent-feedback">
                    	<h3>Recent Feedback<span></span></h3>
						<span class="question-unread">
							<form action='<?php echo base_url();?>user_zingup/check' method='post'>
								<li>
									<input type='hidden' name='referrer' value='<?php echo base_url();?>feedback/add/<?php echo $this->uri->segment(3); ?>' />
									<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
									<input type='submit' value='Add a Feedback' class="red-button button"/>

								</li>
							</form>
							
							
							</span>
                    </div>                    
                    <div class="feedbacktab">
						<ul class="feedbacktab-menu">
							<li><a href="" class="active">All Feedbacks<span>(<?php echo count($feedback);?>)</span></a></li>
						</ul>
						<div class="feedbacktab-tabs-container">
							<div class="feedback-list">
								<ul>
									<?php $i=0; foreach($feedback as $fb) { $i++; if($i==6) break;?>
									<form action='<?php echo base_url();?>user_zingup/check' method='post' class='fbform'>
													<input type='hidden' name='referrer' value='<?php echo base_url();?>feedback/lists/<?php echo $this->uri->segment(3); ?>' />
													<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
										<li class='fbsbt' style='cursor:pointer;'>
											<div class="feedback-list-post">
												<div class="item-head-img">
												<span class="review-hero"><img alt="" src="<?php echo base_url();?>images/user-photo.jpg"></span>
												<p><span class="post-user"><a href="#"><?php echo $fb->name; ?></a> on <?php echo date('d F, Y  h:i A',strtotime($question->added_on));?></span></p>
												<h5><?php echo $fb->subject; ?></h5>
												<p>
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
												</p>
												<p><?php echo $fb->feedback; ?></p>
													<?php if($fb->userid == $this->session->userdata("logged_in_user_data")->user_id) {?>
															<a  style='cursor:pointer;' href='<?php echo base_url();?>feedback/edit/<?php echo $this->uri->segment(3); ?>/<?php echo $fb->id; ?>'><img src='<?php echo base_url();?>images/fbedit.png' /></a> &nbsp;&nbsp;&nbsp;<a class='delete-feedback ' style='cursor:pointer;' id='<?php echo $fb->id; ?>'><img src='<?php echo base_url();?>images/fbdelete.png' /></a>
														<?php }?>
												
												</div>
												<?php 
													$oneweek= date("Y-m-d", strtotime("3 days ago"));
													$today = date('Y-m-d');
													$added = date('Y-m-d',strtotime($fb->added_on));
													if($added <= $today && $added >= $oneweek) {
												?>
													<span class="review-new"><img alt="" src="<?php echo base_url();?>images/new-icon.png"></span>
												<?php } ?>
											</div>
											
										</li>
									</form>
									<?php } ?>
								</ul>
							</div>
							<?php if(count($feedback) > 5) {?>
								<div class="row">
									<div class="col-xs-5 mar-auto">
										<div class="view-more">
											<form action='<?php echo base_url();?>user_zingup/check' method='post'>
													<li>
														<input type='hidden' name='referrer' value='<?php echo base_url();?>feedback/lists/<?php echo $this->uri->segment(3); ?>' />
														<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
														<input type='submit' value='View More' class="button"/>

													</li>
												</form>
											</div>
									</div>
								</div>
							<?php } ?>
							</div>
							</div>  
					</div> 
					 <div class="recent-article-content">
						<div class="recent-article">
							<h3>Recent Articles</h3>
							<span class="question-unread">
								 <form action='<?php echo base_url();?>user_zingup/check' method='post'>
									<li>
										<input type='hidden' name='referrer' value='<?php echo base_url();?>articles/lists/<?php echo $this->uri->segment(3); ?>' />
										<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
										<input type='submit' value='All Articles' class="red-button button"/>

									</li>
								</form>
								 </span>
						</div>                    
						<div class="recent-article-list">
							<div class="product-list">
								<ul>
									<?php $i=0; foreach($articles as $ar) { $i++; if($i==7) break;?>
									<li>
										<div class="product-inner">
											<div class="product-list-image"><a href="<?php echo base_url(); ?>articles/detailpage/<?php echo $this->uri->segment(3); ?>/<?php echo $ar->id; ?>">
											<img src="<?php echo base_url();?>sme_users/articles/<?php echo $ar->id; ?>/<?php echo $ar->photo; ?>" alt="" style='height:200px;'/></a></div>
											<div class="product-list-details">
												<a href="#"><h5><?php  echo $limited_string = word_limiter($ar->heading, 8, '');?></h5> </a>
												<div class="item-head-img">
													<span class="review-hero"><img src='<?php echo base_url();?>sme_users/<?php echo $profile->sme_userid; ?>/<?php echo $profile->photo; ?>' height='36' width='36'/></span>
													<p><span class="post-user"><a href="#"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?></a> on <?php echo date('d F, Y  h:i A',strtotime($ar->added_on));?> <br /></span><a href="#" class="comment-count"><?php echo $ar->comments[0]->count; ?> Comments</a></p>                                       
												</div>                                       
											</div>
										</div>
									</li>
									<?php } ?>
									
								</ul>
							</div>
								<div class="clear"></div>
								<?php if(count($articles) >6) { ?>
									<div class="row">
										<div class="col-xs-5 mar-auto">
											<div class="view-more">
												<form action='<?php echo base_url();?>user_zingup/check' method='post'>
													<li>
														<input type='hidden' name='referrer' value='<?php echo base_url();?>articles/lists/<?php echo $this->uri->segment(3); ?>' />
														<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
														<input type='submit' value='View More' class="button"/>

													</li>
												</form>
												
												</div>  
										</div>
									</div>
								<?php } ?>
						</div>
					</div>
					
					<div class="recent-article-content">
						<div class="recent-article">
							<h3>Recent Events</h3>
							<span class="question-unread">
								 <form action='<?php echo base_url();?>user_zingup/check' method='post'>
									<li>
										<input type='hidden' name='referrer' value='<?php echo base_url();?>events/lists/<?php echo $this->uri->segment(3); ?>' />
										<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
										<input type='submit' value='All Events' class="red-button button"/>

									</li>
								</form>
								 </span>
						</div>                    
						<div class="recent-article-list">
							<div class="product-list">
								<ul>
									<?php $i=0; foreach($events as $ar) { $i++; if($i==7) break;?>
									<li>
										<div class="product-inner">
											<div class="product-list-image"><a href="<?php echo base_url(); ?>events/detailpage/<?php echo $this->uri->segment(3); ?>/<?php echo $ar->id; ?>">
											<img src="<?php echo base_url();?>sme_users/events/<?php echo $ar->id; ?>/<?php echo $ar->photo[0]->name; ?>" alt="" style='height:200px;'/></a></div>
											<div class="product-list-details">
												<a href="#"><h5><?php  echo $limited_string = word_limiter($ar->title, 8, '');?></h5> </a>                                  
											</div>
										</div>
									</li>
									<?php } ?>
									
								</ul>
							</div>
								<div class="clear"></div>
								<?php if(count($events) >6) { ?>
									<div class="row">
										<div class="col-xs-5 mar-auto">
											<div class="view-more">
												<form action='<?php echo base_url();?>user_zingup/check' method='post'>
													<li>
														<input type='hidden' name='referrer' value='<?php echo base_url();?>events/lists/<?php echo $this->uri->segment(3); ?>' />
														<input type='hidden' name='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
														<input type='submit' value='View More' class="button"/>

													</li>
												</form>
												
												</div>  
										</div>
									</div>
								<?php } ?>
						</div>
					</div>
					
					<div class="testimonials-contentbox" >
                    	<div class="testimonials-innerbox" >
                    	<ul class="testimonial-block">
                        <li>
                        	<p><img src="<?php echo base_url();?>images/testimonial-img.png" alt="" /></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet leo sapien bibendum Aenean sit amet tempor augue</p>
                            <p><img src="<?php echo base_url();?>images/testimonial-photo.png" alt="" /></p>
                            <p>- Jack Black, Web Designer -<br /> April 22, 2015</p>
                        </li>
                        <li>
                        	<p><img src="<?php echo base_url();?>images/testimonial-img.png" alt="" /></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet leo sapien bibendum Aenean sit amet tempor augue</p>
                            <p><img src="<?php echo base_url();?>images/testimonial-photo.png" alt="" /></p>
                            <p>- Jack Black, Web Designer -<br /> April 22, 2015</p>
                        </li>
                        <li>
                        	<p><img src="<?php echo base_url();?>images/testimonial-img.png" alt="" /></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet leo sapien bibendum Aenean sit amet tempor augue</p>
                            <p><img src="<?php echo base_url();?>images/testimonial-photo.png" alt="" /></p>
                            <p>- Jack Black, Web Designer -<br /> April 22, 2015</p>
                        </li>
                        <li>
                        	<p><img src="<?php echo base_url();?>images/testimonial-img.png" alt="" /></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet leo sapien bibendum Aenean sit amet tempor augue</p>
                            <p><img src="<?php echo base_url();?>images/testimonial-photo.png" alt="" /></p>
                            <p>- Jack Black, Web Designer -<br /> April 22, 2015</p>
                        </li>
                        
                        
                        </ul>
                        </div>
                    </div>
	
					</div>  
				</div>
			</div>
		</div>
	</div>	
</div>
