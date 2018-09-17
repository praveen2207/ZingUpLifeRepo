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
												
										
											 <div class="list-details-page">
												
												<form action='<?php echo base_url();?>articles/submit_article' method='post' enctype="multipart/form-data">
													<label>Heading</label>
													<input type='text' name='heading' value='<?php echo $article->heading; ?>' />
													
													<label>Upload a New Photo</label>
													<?php if($article->photo != '')  {?>
														<img src='<?php echo base_url();?>sme_users/articles/<?php echo $article->id; ?>/<?php echo $article->photo; ?>' />
														<span article="<?php echo $article->id; ?>" class='del_img'>X</span>
													<?php } ?>
													<input type='file' name='userfile' value='' />
													
													<label>Content</label>
													<textarea name='content'><?php echo  $article->content; ?></textarea>
													
													<input type="hidden" name="id" value="<?php echo $article->id; ?>">
													
													<input type="submit" class="button" value="Update">
													<input type='hidden' class='url' value='<?php echo base_url(); ?>' />
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





















