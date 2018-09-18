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
                                                    	<div class="col-xs-12">
                                                        	<div class="dashboard-top-left-details">
                                                    		<div class="page-big-icon"><img alt="" src="<?php echo base_url(); ?>images/dashboard-icon/followers-big-icon.png" /></div>
                                                            <h3>Events</h3>                                                            
                                                            </div>
                                                            <?php if($this->session->userdata('type') == 'sme' ) { ?>
																<div class="dashboard-top-right-details">
																	<a href='<?php echo base_url(); ?>events/add_event'><button type="button" class="btn btn-info btn-lg button fb-respond">Add Event</button></a>
																</div>
															<?php } ?>
                                                    	</div>                                                        
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>                                         
                                        <div class="dashboard-content-inner">
                                        	<div class="dashboard-content-inner-box">
                                            <div class="followers-content dashboard-content-boxinner">

                                            	<div class="followers-list">
												
													<div class="list-details-page">
															<form class='event_form' action='<?php echo base_url();?>events/update_event' method='post' enctype="multipart/form-data">
															<label>Title</label>
															<input type='text' name='title' value='<?php echo $event->title; ?>' class='required'/>
															
															<?php foreach($images as $image) { ?>
																<p>
																	<img src='<?php echo base_url(); ?>sme_users/events/<?php echo $image->ev_id; ?>/<?php echo $image->name; ?>'>
																	<span event="<?php echo $image->id; ?>" class='del_evimg'>X</span>
																</p>
																
															<?php } ?>
															
															<label>Upload  Primary Image</label>
															
															<input name="userfile[]" id="userfile" type="file" multiple="" />
															
															<label>Upload another</label>
															
															<input name="userfile[]" id="userfile" type="file" multiple="" />
															
															<label>Upload another</label>
															
															<input name="userfile[]" id="userfile" type="file" multiple="" />
															
															<label>Description</label>
															<textarea name='description' class='required'><?php echo $event->description; ?> </textarea>
															
															<label>Location</label>
															<input type='text' name='location' value='<?php echo $event->location; ?>' class='required'/>
															
															<label>Date</label>
															<input type='text' name='date' value='<?php echo $event->date; ?>' class='required' id='datepicker10'/>
															
															<label>Start Time</label>
															<input type='text' name='start_time' value='<?php echo $event->start_time; ?>' class='required' style='margin-bottom:0px;'/>
															<p>(Please enter in 24 hour format < 24:00 Hours)</p>
															
															<label>Duration</label>
															<input type='text' name='duration' value='<?php echo $event->duration; ?>' class='required' style='margin-bottom:0px;'/>
															<p>(This field can be added in hours or days ex: 2hours or 2days)</p>
															
															<label>Total Slots</label>
															<input type='text' name='total_slots' value='<?php echo $event->total_slots; ?>' class='required' id='fieldID1'/>
															
															<label>Slots Available</label>
															<input type='text' name='slots_available' value='<?php echo $event->slots_available; ?>' class='required' id='fieldID2'/>
															
															<label>Joining Fee</label>
															<input type='text' name='joining_fee' value='<?php echo $event->joining_fee; ?>' class='required'/>
															
															<label>Discount</label>
															<input type='text' name='discount' value='<?php echo $event->discount; ?>' class='required' style='margin-bottom:0px;'/>
															<p>(%)</p>
															
															<input type="hidden" name="id" value="<?php echo $event->id; ?>">
															<input type='hidden' class='url' value='<?php echo base_url(); ?>' />
															<input type="submit" class="button" value="Update">
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
    </div>
</div> 



