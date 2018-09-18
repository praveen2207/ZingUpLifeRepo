<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container"> 
			<div class="content-inner">
    			<div class="row">
				
				<div class="col-xs-12 full-page"> 
                    
                    	<div class="dashboard-inner feedback-add">
                        	
                                <div class=" dashboard-left"> 
                                	<?php $this->view('includes/sidebar'); ?>
                                </div>
                                <div class="dashboard-right"> 
                                	<div class="dashboard-right-inner">
                                    	<div class="dashboard-top-banner" style='background: url("<?php echo base_url();?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $this->session->userdata('header_image'); ?>") no-repeat 50% 0;background-size:cover;'>                                        	
                                            <div class="dashboard-top-details">
                                            	<div class="dashboard-top-details-inner">
                                                	<div class="row">
                                                    	<div class="col-xs-12">
                                                        	<div class="dashboard-top-left-details">
                                                    		<div class="page-big-icon"><img src="<?php echo base_url(); ?>images/dashboard-icon/article-big-icon.png" alt=""></div>
                                                            <h3>Articles</h3>
                                                           
                                                            </div>
													
																<div class="dashboard-top-right-details">
																	<a href='<?php echo base_url(); ?>articles/add_article'><button type="button" class="btn btn-info btn-lg button fb-respond">Add an Article</button></a>
																</div>
															

														</div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="dashboard-content-inner">
												
											<div class="dashboard-top-right-details">
												<a href='<?php echo base_url(); ?>articles/edit_article/<?php echo $article->id; ?>'><button type="button" class="btn btn-info btn-lg button fb-respond">Edit Article</button></a>
											</div>
											<div class="dashboard-top-right-details">
												<a href='<?php echo base_url(); ?>articles/delete_article/<?php echo $article->id; ?>'><button type="button" class="btn btn-info btn-lg button fb-respond">Delete Article</button></a>
											</div>
											 <div class="list-details-page">
												<h2><?php echo $article->heading; ?></h2> 
												<img src='<?php echo base_url();?>sme_users/articles/<?php echo $article->id ?>/<?php echo $article->photo;?>' style='max-width:900px;' />
												<br/>
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
																	<span class="review-hero"><img alt="" src="<?php echo base_url();?>images/user-photo.jpg" ></span>
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
																	<input type='hidden' name='art_id' class='art_id' value='<?php echo $this->uri->segment(3); ?>' />
																	<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
																	<input type="hidden" name="limit" id="limit" value="5"/> 
																	<input type="hidden" name="offset" id="offset" value="<?php echo $offset;?>"/>
																</div>
															</div>
														<?php } ?>
													</div>
												</div>
												<br/>
												
											   
												
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

























