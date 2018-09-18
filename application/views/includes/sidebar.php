  	<div class="dashboard-left-inner">
		<ul>
		<li>
			<div class="dashboard-left-profile">
			<?php if($this->session->userdata('type') == 'sme') { if($this->session->userdata('photo') != '') {?>
				<img src="<?php echo base_url(); ?>sme_users/<?php echo $this->session->userdata('sme_userid'); ?>/<?php echo $this->session->userdata('photo'); ?>" alt="">
			<?php } ?>
			<?php } else {?>
				<img src="<?php echo base_url(); ?>sme_users/<?php echo $smeuerdetails->sme_userid; ?>/<?php echo $smeuerdetails->photo; ?>" alt="">
			<?php }?>
				<?php if($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme'){?>
					<div class="review-profile-details">
						<a href="<?php echo base_url(); ?>sme/profile">
						<img alt="" src="<?php echo base_url(); ?>images/edit-icon.png">  Edit Profile                                    
						</a>                                                    
					</div>
				<?php } ?>
			</div>
		</li>
		<li>
		<?php if($this->session->userdata('type') == 'sme') {?>
			<div class="dashboard-left-profile-menu">
				<ul>
					<li><a href="<?php echo base_url(); ?>sme/dashboard" class="dashboard-icon"> Dashboard</a></li>
					<li><a href="<?php echo base_url(); ?>feedback/listing" class="feedbacks-icon"> Feedbacks</a></li>
					<li><a href="<?php echo base_url(); ?>followers" class="feedbacks-icon"> Followers</a></li>
					<li><a href="<?php echo base_url(); ?>questions/listing" class="questions-icon"> Questions</a></li>
					<li><a href="<?php echo base_url(); ?>articles" class="articles-icon"> Articles</a></li>
					<li><a href="<?php echo base_url(); ?>events" class="articles-icon"> Events</a></li>
					<li><a href="<?php echo base_url(); ?>book_call/calls" class="booked-icon"> Booked Calls</a></li>
					<li><a href="<?php echo base_url(); ?>sme/settings" class="settings-icon"> Settings</a></li>
					<li><a href="<?php echo base_url(); ?>sme/logout" class="logout-icon"> Logout</a></li>                                                        
				</ul>
			</div>
		
		<?php } else { ?>
			<div class="dashboard-left-profile-menu">
				<ul>
					<li><a href="<?php echo base_url(); ?>/sme_home/sme_profile/<?php echo $smeuerdetails->sme_userid; ?>" class="dashboard-icon"> Dashboard</a></li>
					<li><a href="<?php echo base_url(); ?>feedback/user/<?php echo $smeuerdetails->sme_userid; ?>" class="feedbacks-icon"> Feedbacks</a></li>
					<li><a href="<?php echo base_url(); ?>questions/user/<?php echo $smeuerdetails->sme_userid; ?>" class="questions-icon"> Questions</a></li>
					<li><a href="<?php echo base_url(); ?>questions/ask/<?php echo $smeuerdetails->sme_userid; ?>" class="ask-question-icon"> Ask a Question</a></li>
					<li><a href="#" class="booked-icon"> Booked Calls</a></li>
					<li><a href="#" class="book-call-icon"> Book a Call</a></li>
					<li><a href="#" class="articles-icon"> Articles</a></li>
					<li><a href="#" class="settings-icon"> Settings</a></li>
					<li><a href="<?php echo base_url(); ?>sme/logout" class="logout-icon"> Logout</a></li>                                                        
				</ul>
			</div>
		<?php } ?>
		</li>
		</ul>
	</div>
