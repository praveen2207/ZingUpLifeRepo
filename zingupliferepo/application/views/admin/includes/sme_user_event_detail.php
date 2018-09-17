
<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">        	
        	
    		<div class="content-inner">
    			<div class="row">
                	<div class="col-xs-12 full-page" >
						<?php echo $this->view('includes/sme_header');?>
                    <div class="feedbacktab-tabs-container">
						<div class="dashboard-content-inner">
							<div class="dashboard-content-inner-box">
                                            <div class="followers-content dashboard-content-boxinner">

                                            	<div class="followers-list">
												
													<div class="list-details-page">
															<label>Title</label>
															<p><?php echo $event->title; ?> </p>
															
															<label>Description</label>
															<p><?php echo $event->description; ?>  </p>
															
															<label>Photos</label>
															<div id="owl-example" class="owl-carousel owl-theme">
																<?php foreach($event->photos as $photo) {?>
																	<div class="item"><img src='<?php echo base_url(); ?>sme_users/events/<?php echo $event->id; ?>/<?php echo $photo->name; ?>'></div>
																<?php } ?>
															</div>
															
															<label>Location</label>
															<p><?php echo $event->location; ?></p>
															
															<label>Date</label>
															<p><?php echo $event->date; ?></p>
															
															<label>Start Time</label>
															<p><?php echo $event->start_time; ?></p>
															
															<label>Duration</label>
															<p><?php echo $event->duration; ?></p>
															
															<label>Total Slots</label>
															<p><?php echo $event->total_slots; ?></p>
															
															<label>Slots Available</label>
															<p><?php echo $event->slots_available; ?></p>
															
															<label>Joining Fee</label>
															<p><?php echo $event->joining_fee; ?></p>
															
															<label>Discount</label>
															<p><?php echo $event->discount; ?></p>

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
</div>

