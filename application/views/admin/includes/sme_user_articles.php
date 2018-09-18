<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">        	
        	
    		<div class="content-inner">
    			<div class="row">
                	<div class="col-xs-12 full-page" >
						<?php echo $this->view('includes/sme_header');?>
                    <div class="feedbacktab-tabs-container">
								<div class="dashboard-content-inner">
										<div class="product-list">
											<ul id="myList">
												<?php $i=0; foreach($articles as $ar) { $i++; if($i==9) break;?>
												<a href="<?php echo base_url(); ?>articles/detailpage/<?php echo $this->uri->segment(3); ?>/<?php echo $ar->id; ?>">
													<li>
														<div class="product-inner">
															<div class="product-list-image">
																<img alt="" src="<?php echo base_url();?>sme_users/articles/<?php echo $ar->id; ?>/<?php echo $ar->photo; ?>" style='height:200px;'></div>
															<div class="product-list-details">
																<h5><a href="#"><?php  echo $limited_string = word_limiter($ar->heading, 8, '');?></a></h5> 
																<div class="item-head-img" style='padding-left:0px;'>
																	<p><span class="post-user"> on <?php echo date('d F, Y  h:i A',strtotime($ar->added_on));?> <br></span><a class="comment-count" href="<?php echo base_url(); ?>articles/detailpage/<?php echo $this->uri->segment(3); ?>/<?php echo $ar->id; ?>"><?php echo $ar->comments[0]->count; ?> Comment</a></p>                                       
																</div>                                       
															</div>
														</div>
													</li>
												</a>
												<?php } ?>
											</ul>
										</div>
										<div class="clear"></div>
										<?php if(count($articles) > 8) { ?>
											<div class="row">
														<div class="col-xs-5 mar-auto">
															<button onclick="smearloadmore()" value="loadmore" id="load-more" class='sme-ar-loadmore' >View More</button>
															<input type='hidden' name='sme_userid' class='sme_userid' value='<?php echo $this->uri->segment(3); ?>' />
															<input type='hidden' name='url' class='url' value='<?php echo base_url(); ?>' />
															<input type="hidden" name="limit" id="smearlimit" value="8"/> 
															<input type="hidden" name="smearoffset" id="smearoffset" value="<?php echo $offset;?>"/>
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





