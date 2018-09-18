<?php if(count($feedback) !=0) {$i = 0;foreach($feedback as $fb) {  ?>
	
		<li>
			<div class="feedback-list-head">
				<div class="item-head-img">
				<span class="review-hero"><img src="<?php echo base_url();?>images/user-photo.jpg" alt=""></span>
				<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($fb->added_on));?> - <?php echo count($fb->comments);?> Replies</span></p>
				<h5><span><?php echo $fb->name; ?> said..</span> <?php echo $fb->subject; ?></h5>
					<div class="review-rating-right">
					<span>
						
							<?php if($fb->fb_score == 4.5) { ?>
								<img src="<?php echo base_url();?>images/b-four-half-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 4) { ?>
								<img src="<?php echo base_url();?>images/b-four-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 5) { ?>
								<img src="<?php echo base_url();?>images/b-five-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 3) { ?>
								<img src="<?php echo base_url();?>images/b-three-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 3.5) { ?>
								<img src="<?php echo base_url();?>images/b-three-half-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 2) { ?>
								<img src="<?php echo base_url();?>images/b-two-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 2.5) { ?>
								<img src="<?php echo base_url();?>images/b-two-half-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 1.5) { ?>
								<img src="<?php echo base_url();?>images/b-one-half-rating.png" alt="" />
							<?php } ?>
							<?php if($fb->fb_score == 1) { ?>
								<img src="<?php echo base_url();?>images/b-one-rating.png" alt="" />
							<?php } ?>
						</span>
					<span>
						<?php 
								$oneweek= date("Y-m-d", strtotime("3 days ago"));
								$today = date('Y-m-d');
								$added = date('Y-m-d',strtotime($fb->added_on));
								if($added <= $today && $added >= $oneweek) {
							?>
							<img src="<?php echo base_url(); ?>images/new-icon.png" alt="" />
							<?php } else if($added == $today) { ?>
								<img src="<?php echo base_url(); ?>images/hot-icon.png" alt="" />
							<?php } else { ?>
								<img src="<?php echo base_url(); ?>images/old-icon.png" alt="" />
							<?php } ?>
						
						</span>
					</div>                                                        
				</div>
			</div>
			<div class="feedback-list-content">
				<p><?php echo $fb->feedback; ?></p>
				
				<a href="#">This communication have <?php echo count($fb->comments); ?> replies yet.</a>
			</div>
		</li>
<?php  } } else {?>
<p id='no-more'>Sorry there are no more results.</p>
<?php }?>
