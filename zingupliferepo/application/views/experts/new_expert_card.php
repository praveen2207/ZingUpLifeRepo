 <?php  $logged_in_user_data = $this->session->userdata('logged_in_user_data'); ?>
 <a href='<?php echo base_url(); ?>experts/user/<?php echo $value['sme_details']->sme_userid; ?>'><div class="col-md-4 col-sm-6" style="padding-right: 51px; padding-left: 30px;margin-bottom:10px;">
		<figure> 
		<?php  if ($value['sme_details']->active == 'y') { ?><span style="float:right; background-color: green; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;">Online</span><?php } else if ($value['sme_details']->active == 'n') {
										?>
										<span style="float:right; background-color: grey; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;">Offline</span>
									<?php } else { ?>
										<span style="float:right; background-color: grey; font-size:12px;padding: 3px 10px; color: #FFF; border-top-right-radius:15px; border-bottom-left-radius:15px; position: relative;">Busy</span>
									<?php } ?>
			<center>
			
			 <?php if ($value['sme_details']->photo != '') { ?>
	            <img src="<?php echo base_url(); ?>sme_users/<?php echo $value['sme_details']->sme_userid . '/' . $value['sme_details']->photo; ?>" onerror="showDefaultImage(this, '<?php echo base_url(); ?>assets/new_design/image/reviewimg.png')" style="width: 115px;height:115px;border-radius:50%;">
	        <?php } else { ?>
	            <img src="<?php echo base_url(); ?>assets/new_design/image/reviewimg.png" style="width: 115px;height:115px;border-radius:50%;">
	        <?php } ?>
			</center>
		</figure>
		<div class="blog-excerpt" style="margin-top:-30px">
			<div class="blog-excerpt-inner inner">
				<center>
					<h2><?php echo strtolower($value['sme_details']->first_name) . ' ' . strtolower($value['sme_details']->last_name); ?></h2></center>
				<center>
					<p><?php echo substr($value['sme_details']->expertise, 0, 50) . '...'; ?></p>
				</center>
				<br/>
				<center>
					<?php if ($value['sme_details']->active == 'y' && ($value['sme_details']->chat_pricing != '' || $value['sme_details']->video_pricing != '' || $value['sme_details']->audio_pricing != '')) { ?>
						<a href='#' id='<?php echo $value['sme_details']->sme_userid; ?>' class='sme_chat'><button type="submit" class="btn btn-chat">Chat</button></a>
						<a href='<?php echo base_url(); ?>experts/user_book/<?php echo $value['sme_details']->sme_userid; ?>' id='<?php echo $value['sme_details']->sme_userid; ?>' <?php if ($logged_in_user_data->is_logged_in != 1) { ?>class='sme_book'<?php } ?>><button type="submit" class="btn btn-book">Book</button></a>
					<?php } else {?>
					<a href='<?php echo base_url(); ?>experts/user_book/<?php echo $value['sme_details']->sme_userid; ?>' id='<?php echo $value['sme_details']->sme_userid; ?>' <?php if ($logged_in_user_data->is_logged_in != 1) { ?>class='sme_book'<?php } ?>><button type="submit" class="btn btn-book">Book</button></a>
					<?php } ?>
				</center>
			</div>
			<!-- blog-excerpt -->
		</div>
	</div></a>