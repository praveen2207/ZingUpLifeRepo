
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
								        <div class="list-details-page">
                                <h2><?php echo $article->heading; ?></h2> 
                                
                                <img src='<?php echo base_url(); ?>sme_users/articles/<?php echo $article->id?>/<?php echo $article->photo; ?>' />
                                
                                <p style='font-size:12px;'><?php echo nl2br($article->content); ?></p>
								<?php if(count($article->comments) >0) { ?>
									<h3 class="user-post-head">User Comment</h3>
								<?php } ?>
                                <div class="feedback-reply-section">
									<div class="feedback-reply-section-inner">
										<ul id="myList">
										<?php $i=0; foreach($article->comments as $comment) { $i++; if($i==6) break; ?>
											<li>
												<div class="feedback-list-head">
													<div class="item-head-img">
													<span class="review-hero"><img alt="" src="<?php echo base_url();?>images/user-photo.jpg"></span>
													<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($comment->added_on));?></span></p>
													<h5><span><?php echo $comment->name;?> </span>replied..</h5>             
													</div>
												</div>
												<div class="feedback-list-content">
													<p><?php echo $comment->comment;?></p>	
												</div>
											</li>
										<?php } ?>	
										</ul>
										<?php if(count($article->comments) >5) { ?>
											<div class="row">
												<div class="col-xs-5 mar-auto">
													<button onclick="artcommviewmore()" value="loadmore" id="load-more" >View More</button>
													<input type='hidden' name='art_id' class='art_id' value='<?php echo $this->uri->segment(4); ?>' />
													<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
													<input type="hidden" name="limit" id="limit" value="5"/> 
													<input type="hidden" name="offset" id="offset" value="<?php echo $offset;?>"/>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
                                <br/>
                            <?php if($this->session->userdata('is_logged_in') == 1){?>    
                               <div class="comment-section">
                                <p><strong>Post A Comment</strong></p>
                                	<div class="dashboard-content-inner-box">
                                            <div class="setting-content dashboard-content-boxinner">
                                            	<form action='<?php echo base_url();?>articles/add_comment' method='post'>
                                                    <div class="row">
                                                    	<div class="col-xs-12">
                                                        	<label>Comment</label>
                                                            <textarea name='comment'></textarea>
                                                        </div>                                                        
                                                    </div>                                                    
                                                    <div class="row">                                                    	
                                                        <div class="col-xs-12">
															<input type='hidden' name='ar_id' value='<?php echo $article->id; ?>'/>
															<input type='hidden' name='smeuser_id' value='<?php echo $this->uri->segment(3); ?>'/>
                                                        <input type="submit" value="Save" class="button">
                                                        </div>
                                                    </div> 
                                                </form>
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

