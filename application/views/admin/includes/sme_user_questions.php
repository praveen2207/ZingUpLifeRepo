

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
										<h2>Answered Questions</h2>
										<?php if(count($questions) > 0) {?>
                                        	<ul id="myList" class="feedback-all-list-view">
											<?php $i = 0;foreach($questions as $q) { $i++; if($i == 6) break; ?>
											
											<?php if($q->answer != '' ) {?>
												<a href='<?php echo base_url(); ?>questions/detailpage/<?php echo $this->uri->segment(3); ?>/<?php echo $q->id; ?>'>
											
                                            	<li style="display: list-item;">
                                                	<div class="feedback-list-head">
                                                        <div class="item-head-img">
                                                        <span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
                                                        <p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($q->added_on));?></span></p>
                                                        <h5><span><?php echo $q->name; ?> Asked..</span>  .</h5>
                                                            <div class="review-rating-right">
																<span><?php
															
																		$oneweek= date("Y-m-d", strtotime("3 days ago"));
																		$today = date('Y-m-d');
																		$added = date('Y-m-d',strtotime($q->added_on));
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
                                                    	<p><?php echo $q->question; ?></p>
                                                       <div class="question-last-content">This communication have <?php echo count($q->comments); ?> replies yet.</div>
                                                    </div>
                                                </li>
												</a>
											<?php } }?>
											</ul>
											<?php } else { ?>
												<p>There are no Questions</p>
											<?php } ?>
											<?php if(count($questions) > 5) {?>
											
												<div>
													<button onclick="loadmorequestions()" value="loadmore" id="load-more" />
													
													
														<input type='hidden' name='type' class='type' value='answered' />
													
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


