
<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">        	
        	
    		<div class="content-inner">
    			<div class="row">
                	<div class="col-xs-12 full-page" >
						<?php echo $this->view('includes/sme_header');?>
                    <div class="feedbacktab-tabs-container">
						<div class="dashboard-content-inner">
							
								      <div class="followers-content dashboard-content-boxinner">
                                            	<div class="followers-list">
                            
													<div class="product-list">
														
														<?php if(count($followers) > 0) {?>
														<ul id="myList" style='clear:both;'>
														<?php $i=0; foreach($followers as $follower) { $i++; if($i == 9) break;?>
															<li>
																<div class="product-inner">
																	<div class="product-list-image"><a href="#"><img src="<?php echo base_url();?>images/Naren186x186.jpg" alt=""></a></div>
																	<div class="product-list-details">
																		<a href="#"><h5><?php echo $follower->name; ?></h5> </a>                                                                                   
																	</div>
																                      
																</div>
															</li>  
														<?php }?>
														</ul>
														<?php } else { ?>
															<p>There are no Followers</p>
														<?php } ?>
													</div>
										<div class="clear"></div>
												<?php if(count($followers) > 8) {?>
													<div class="row">
														<div class="col-xs-5 mar-auto">
															<button onclick="followersviewmore()" value="loadmore" id="load-more" >View More</button>
															<input type='hidden' name='sme_userid' class='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
															<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
															<input type="hidden" name="limit" id="limit" value="8"/> 
															<input type="hidden" name="offset" id="offset" value="<?php echo $offset;?>"/>
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












