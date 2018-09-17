
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
													<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($question[0]->added_on));?></span></p>
													<h5><span><?php echo $question[0]->name; ?> Asked..</span> .</h5>
														                                                  
													</div>
													   
												</div>
												<div class="feedback-list-content" style='border-bottom: 1px solid #d4d4d4;margin-bottom:10px;'>
                                                    <p><?php echo $question[0]->question; ?></p>
                                                    <a href="#">This communication have <?php echo count($question[0]->comments);?> replies yet.</a>
                                                </div>
												<?php if($question[0]->answer !='') { ?>
												<ul id="myList" class="feedback-all-list-view">
													<li style="display: list-item; border:none;margin:0px 10px 20px;width:96%;">
														<div class="feedback-list-head" style='box-shadow:none;'>
															<div class="item-head-img">
																<span class="review-hero"><img src="<?php echo base_url();?>sme_users/<?php echo $question[0]->sme_userid; ?>/<?php echo $question[0]->photo; ?>" width='32px' height="32px" alt=""></span>
																<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?></span></p>
																<h5><span><?php echo $question[0]->first_name; ?> <?php echo $question[0]->last_name; ?> replied..</span></h5>
															</div>
															<div class="feedback-list-content" style='padding:10px 0px 0px;'>
																<p style='font-size:14px;line-height:20px;font-family:roboto;'><?php echo $question[0]->answer; ?></p>
															</div>
														</div>
													</li>
												</ul>
												<?php } ?>
												<ul id="myList" class="feedback-all-list-view">
												<?php $i = 0;foreach($question[0]->comments as $fb) { $i++; if($i == 6) break; ?>
													<li style="display: list-item; border:none;margin:0px 10px 20px;width:96%;">
														<div class="feedback-list-head" style='box-shadow:none;'>
															<div class="item-head-img">
																<span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
																<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?></span></p>
																<h5><span><?php echo $fb->name; ?> Said..</span></h5>
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
										
										 <?php if($this->session->userdata('type') == 'sme' && $question[0]->answer == '') { ?>
                                        	<div class="dashboard-content-inner-box">
												<?php echo validation_errors(); ?>
												<?php if($this->session->flashdata('msg')) { ?>
													<p><?php echo $this->session->flashdata('msg'); ?></p>
												<?php } ?>
												<h2 class="dashboard-title ">Reply</h2>
												<div class="dashboard-content-boxinner">
												<form action='<?php echo base_url();?>questions/add_answer' method='post'>
																		   
													<div class="row" style='clear:both;'>
														<div class="col-xs-12">
													  
														<textarea name='answer'> </textarea>
														</div>
													</div>
													<input type="hidden"  name='sme_userid' value="<?php echo $this->session->userdata('sme_userid');?>">
													<input type="hidden"  name='ques_id' value="<?php echo $question[0]->id;?>">
													<input class="button" value="Publish" type="submit">
													
												</form>
												</div>
                                            </div>
										 <?php } else if($this->session->userdata('type') != 'sme'){?>
											<div class="dashboard-content-inner-box">
												<?php echo validation_errors(); ?>
												<?php if($this->session->flashdata('msg')) { ?>
													<p><?php echo $this->session->flashdata('msg'); ?></p>
												<?php } ?>
												<h2 class="dashboard-title ">Reply</h2>
												<div class="dashboard-content-boxinner">
												<form action='<?php echo base_url();?>questions/add_user_reply' method='post'>
																		   
													<div class="row" style='clear:both;'>
														<div class="col-xs-12">
													  
														<textarea name='comment'> </textarea>
														</div>
													</div>
													<input type="hidden"  name='sme_userid' value="<?php echo $this->uri->segment(3);?>">
													<input type="hidden"  name='q_id' value="<?php echo $question[0]->id;?>">
													<input class="button" value="Publish" type="submit">
													
												</form>
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
