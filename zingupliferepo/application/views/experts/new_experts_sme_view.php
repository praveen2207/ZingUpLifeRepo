			<?php //echo '<pre>'; print_r($slots); ?>
			<style>
			.datepicker-days .date .datepicker table tr td.new, .date .datepicker table tr td.old, .datepicker-days .date .datepicker table tr td.new, .date .datepicker table tr td.new
			{
				visibility:hidden;
			}
			.datepicker .datepicker-days table tr td.activeClass.active,.datepicker .datepicker-days table tr td.activeClass
			{
				background:green;
				border-radius: 50%;
				-ms-border-radius: 50%;
				-moz-border-radius: 50%;
				-webkit-border-radius: 50%;
				color: #2a2a2a;
				color:#fff;

			}
			.datepicker .datepicker-days table tr td.activeClass
			{
				background:green;
				color:#fff;
			}
			
			.datepicker .datepicker-days table tr td.nonactiveClass.active, .datepicker .datepicker-days table tr td.nonactiveClass
			{
				background:#ccc;
				border-radius: 50%;
				-ms-border-radius: 50%;
				-moz-border-radius: 50%;
				-webkit-border-radius: 50%;
				color: #2a2a2a;

			}
			
			.datepicker .datepicker-days table tr td.activeClass.active
			{
				background:blue;
				border-radius: 50%;
				-ms-border-radius: 50%;
				-moz-border-radius: 50%;
				-webkit-border-radius: 50%;
				color: #fff;

			}
			.smedate .ui-state-disabled a{
				 background: #d9d9d9 none repeat scroll 0 0;
				border-radius: 58px;
				color: #000;
				opacity: 1;
			}
			
			.smedate .ui-state-available a{
				 background: #ffc815 none repeat scroll 0 0;
				border-radius: 58px;
				color: #000;
				opacity: 1;
			}
			
			.smedate .ui-state-available a.ui-state-active
			{
				background:#4bc850 !important;
			}
			.btn-login:hover {
    background-color: transparent;
    color: #000;
    border: 1px solid #f39c12;
}

.available {
    background-color: #ffc815;
    color: #fff;
}

.booked {
    background-color: #d9d9d9;
    color: #fff;
}
.blocked{
	background-color: red;
    color: #fff;
}
.timeAcitve {
    background-color: #009746;
    color: #fff;
}
			 
			</style>
		<input type='hidden' id='smeuserid' value="<?php echo $this->session->userdata('sme_userid');?>" />
		<input type='hidden' id='' class='sme_userid' value="<?php echo $this->session->userdata('sme_userid');?>" />
		<input type='hidden' id='smeuserid' class='type' value="sme" />
		
		
			<?php foreach($added_slots as $slot) { ?>
				<span style='display:none;' class='slots'  year = '<?php echo date('Y',strtotime($slot->date));?>' month = '<?php echo date('n',strtotime($slot->date));?>' daydate = '<?php echo date('j',strtotime($slot->date));?>'></span>
				<input type='hidden' class='added_slots' value='<?php  echo date('Y-n-j',strtotime($slot->date));?>' />
			<?php } ?>
			
			<!--<?php foreach($blocked_slots as $slots) { ?>
				<span style='display:none;' class='blockedslots'  year = '<?php echo date('Y',strtotime($slots));?>' month = '<?php echo date('n',strtotime($slots));?>' daydate = '<?php echo date('j',strtotime($slots));?>'></span>
				<input type='hidden' class='blocked_slots' value='<?php  echo date('Y-n-j',strtotime($slots));?>' />
			<?php } ?>
			
			<?php foreach($user_booked_slots as $slotss) { ?>
				<span style='display:none;' class='bookedslots'  year = '<?php echo date('Y',strtotime($slotss->date));?>' month = '<?php echo date('n',strtotime($slotss->date));?>' daydate = '<?php echo date('j',strtotime($slotss->date));?>'></span>
				<input type='hidden' class='booked_slots' value='<?php  echo date('Y-n-j',strtotime($slotss->date));?>' />
			<?php } ?>-->
			
		    <main role="main">
			
        <!-- intro-wrap -->
        <div id="main" style="background-color: #f4f2f2;">
	
            <section class="row section experts" style="margin-bottom:-50px;">
                <div class="row-content buffer even clear-after" style="margin-top: 40px; ">
                     <div class="white text-dark">
                        <div class="column six" style="border-right:1px solid #ebebeb">
                            <div class="column three">
                             <?php //echo '<pre>'; print_r($user_booked_slots); ?>
								<?php if($profile->photo != '') {?>
								  <img src='<?php echo base_url(); ?>sme_users/<?php echo $profile->sme_userid;?>/<?php echo $profile->photo;?>' style="width:159px;" />
									<?php } else {?>
									<img src="<?php echo base_url(); ?>assets/experts/image/image_placeholder.png" style="width:159px;">
								<?php } ?>
                            </div>
                            <div class="column nine last" style="margin-top:-5px;">
                                <h4> <?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?><span class="pull-right"> <a href="<?php echo base_url();?>experts/profile" class="colorGreen">Edit Profile</a>&nbsp;&nbsp;</span></h4>
                                <p><span style="font-weight:600">Expert in:</span> <?php echo $profile->expertise; ?>.</p>
                                <p><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;<?php echo $profile->phone; ?></p>
                                <p><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;&nbsp;<?php echo $profile->username; ?></p>
								<p class='test'></p>
								<!--<button type="button" class="livechatBtn" id='<?php echo $l->id;?>'>
                                    <span class="liveTxt colorGreen">Online</span>
                                </button>-->
								
								<button type="button" class="livechatBtn" style="margin-top:30px;" data-toggle="modal" data-target=".bookCall"> <span class="liveTxt colorGreen"><i class="fa fa-calendar" aria-hidden="true" style="color:#fff"></i> &nbsp; &nbsp;Calendar</span> </button>
								<?php  if($livechat) { 
										$today = date('Y-m-d');
											date_default_timezone_set("Asia/Kolkata"); 
											 $currentime = date('h:i A'); 
											
											foreach($livechat as $l) {
							
													 $minutes = strtotime($l->time_from) - strtotime($currentime);
													echo $diff = abs($minutes); 
													//if(($diff <= 600 && $l->time_to < $currentime) || ($l->time_from < $currentime && $l->time_to > $currentime))
													if(($l->date == $today && $diff <= 600 && strtotime($l->time_from) > strtotime($currentime)) || ($l->date == $today && strtotime($l->time_from) < strtotime($currentime) && strtotime($l->time_to) > strtotime($currentime)) )
													{
											?>
											
													<?php if($l->video_link !='') {?>
														<!--<a href='<?php echo $l->video_link; ?>' target='_blank'>-->
														<?php //if($l->book_type == 'Text Chat') {?>
															<!--<a href='<?php echo base_url(); ?>experts/chat'>-->
														<?php //} else {?>
															<a href='<?php echo base_url(); ?>experts/live_session'>
														<?php //} ?>
													<?php  }?>
                                <button type="button" class="livechatBtn <?php if($l->video_link =='') {?>click_join_session<?php } ?>" id='<?php echo $l->id;?>'>
                                    <span class="liveTxt colorGreen">Live <?php echo $l->book_type; ?> &nbsp;<i class="fa fa-comments" aria-hidden="true" style="color:#fff"></i></span>
                                </button>
								<?php if($l->video_link !='') {?>
											</a>
										<?php  }?>
									<?php 			
												}
											
									?>
							
							<?php } } ?>
                            </div>
                        </div>
                        <div class="column six last" style="margin-top:-5px;">
                             <h5 style="font-size:15px;">Add Time Slots</h5>
							
                             <ul class="list-inline days" style="list-style:none;padding:0px;">
                                 <li day='Mon'><input type="checkbox" name="checkbox" value='monday'> M</li>
                                 <li day='Tue'><input type="checkbox" name="checkbox" value='tuesday'> T</li>
                                 <li day='Wed'><input type="checkbox" name="checkbox" value='wednesday'> W</li>
                                 <li day='Thu'><input type="checkbox" name="checkbox" value='thursday'> Th</li>
                                 <li day='Fri'><input type="checkbox" name="checkbox" value='friday'> F</li>
                                 <li day='Sat'><input type="checkbox" name="checkbox" value='saturday'> Sa</li>
                                 <li day='Sun'><input type="checkbox" name="checkbox" value='sunday'> Su</li>
                             </ul>
							 <input type='hidden' class='selecteddays' value=''/>
						

                             <ul class="list-inline" style="list-style:none;padding:0px;">
                                 <li style='position:relative;'><input class="timepicker fromt" id="timepicker" selectedftime='' type="text" placeholder="From" value='' style="width: 190px;" /><span class="caret pull-right" style="margin-top:-30px;"></span>
									<div class="fromtime" style="top: 29px; left: 5px; height: 179px; width: 190px; z-index: 10; cursor: default; display: none;border:1px solid #ccc;position:absolute;overflow-y:scroll; overflow-x:hidden;background:#fff;padding:5px;">
										<div class="" style="width: 184px;">
										<ul class="" style="width: 184px;">
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='1'>12:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='2'>12:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='3'>01:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='4'>01:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='5'>02:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='6'>02:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='7'>03:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='8'>03:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='9'>04:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='10'>04:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='11'>05:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='12'>05:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='13'>06:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='14'>06:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='15'>07:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='16'>07:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='17'>08:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='19'>08:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='20'>09:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='21'>09:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='22'>10:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='23'>10:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='24'>11:00 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='25'>11:30 AM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='26'>12:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='27'>12:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='28'>01:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='29'>01:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='30'>02:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='31'>02:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='32'>03:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='33'>03:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='34'>04:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='35'>04:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='36'>05:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='37'>05:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='38'>06:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='39'>06:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='40'>07:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='41'>07:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='42'>08:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='43'>08:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='44'>09:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='45'>09:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='46'>10:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='47'>10:30 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='48'>11:00 PM</a></li>
										 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='49'>11:30 PM</a></li>
										</ul>
										</div>
										</div>	
								 </li>
                                 <li style='position:relative'><input class="timepicker tto" id="timepicker" selectedttime='' type="text" placeholder="To" value='' style="width: 190px;"/><span class="caret pull-right" style="margin-top:-30px;"></span>
										<div class="totime" style="top: 29px; left: 5px; height: 179px; width: 190px; z-index: 10; cursor: default; display: none;border:1px solid #ccc;position:absolute;overflow-y:scroll; overflow-x:hidden;background:#fff;padding:5px;;">
											   <div class="" style="width: 184px;">
												  <ul class="" style="padding-right: 40px; width: 184px;">
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='1'>12:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='2'>12:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='3'>01:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='4'>01:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='5'>02:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='6'>02:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='7'>03:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='8'>03:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='9'>04:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='10'>04:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='11'>05:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='12'>05:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='13'>06:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='14'>06:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='15'>07:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='16'>07:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='17'>08:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='19'>08:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='20'>09:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='21'>09:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='22'>10:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='23'>10:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='24'>11:00 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='25'>11:30 AM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='26'>12:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='27'>12:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='28'>01:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='29'>01:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='30'>02:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='31'>02:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='32'>03:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='33'>03:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='34'>04:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='35'>04:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='36'>05:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='37'>05:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='38'>06:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='39'>06:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='40'>07:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='41'>07:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='42'>08:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='43'>08:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='44'>09:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='45'>09:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='46'>10:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='47'>10:30 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='48'>11:00 PM</a></li>
													 <li class="ui-menu-item" style="width: 184px;"><a class="ui-corner-all" id='49'>11:30 PM</a></li>
												  </ul>
											   </div>
											</div>	
								 </li>
                             </ul>
							 <input type='hidden' class='fr' value='' />
							 <input type='hidden' class='tr' value='' />
                             <div class="time-slot">
                                  <div style="padding:10px;">
                                      <p style="color: #858181">Your selected time slot<span class="pull-right"><a href="#"><i class="fa fa-times delete_card" aria-hidden="true" style="color: #000" title='Clear' alt='Clear'></i></a></span></p>
                                      <p><span class='add_days'></span> <span class='add_time'><span class='fromaddtime'></span><span class='toaddtime'></span></span></p>
                                  </div>
                             </div>
							 <br/>
							
							  <div class='alert alert-danger show-ermsg' style='display:none;font-size:13px;width:64%;'>From Time should be lesser than To Time</div>
							  <div class='alert alert-danger show-ermsgfields' style='display:none;font-size:13px;width:64%;'>All fields are required</div>
							  <div class='alert alert-success show-msg' style='display:none;font-size:13px;width:64%;'>Slot is added Successfully</div>
							 <button type="submit" class="btn btn-login add-exper-slot">&nbsp;&nbsp;&nbsp;Add Slot&nbsp;&nbsp;&nbsp;</button>
								<br/>
								 <?php  if(count($added_slots) > 0) { ?>
							  <h5 style="font-size:15px;">Your Availability</h5>
								  <div class="time-slot added_new_time_slots">
								  <?php //print_r($bookedsmeslots);?>
									  <div style="padding:10px;">
										  <p style="color: #858181">Check Your prevously added time slots<span class="pull-right"><!--<a href="#"><i class="fa fa-plus open" aria-hidden="true" style="color: #000"></i></a>--></span></p>
										 <div class='show_times' style='display:block;'><?php foreach($bookedsmeslots as $slot) { if($slot[0] !='') {$day = explode("+",$slot[0]);  ?>
											<p><span class='add_days2' style='font-weight:bold;'><?php echo $day[0]; ?></span> -  <span class='add_time2'><?php $times=array(); foreach($slot as $s) {  $days = explode("+",$s);  echo $days[1]; array_push($times,$days[1]); echo ','; }?></span>
												<!--<a href="#" style='float:right;' class='delete_time_slot' ids='' day = '<?php echo $day[0]; ?>' time_from='<?php print_r($times); ?>'><i class="fa fa-close" aria-hidden="true" style="color: #000"></i></a>-->
											</p>
										 <?php } } ?>
										 </div>
									  </div>
								 </div>
							 <?php } ?>
                        </div>
						
                    </div>
                </div>
            </section>   
	



              <section class="row section events">
                 <div class="row-content buffer even clear-after">
                      <div class="column ten tab-border">
                        <nav style="float:left;">
                              <ul class="nav reset" role="tablist" id="myTabs" style="margin-left:-11px;">
                              <li role="presentation" class="active">
                                 <a data-target="#profile" onclick="return false">BOOKED CALLS</a></li>
                              <li role="presentation" >
                                <a data-target="#home" onclick="return false;">QUESTIONS</a></li>
                              <li role="presentation">
                                <a  data-target="#event" onclick="return false">UPCOMING EVENTS</a></li>
                              <li role="presentation">
                                <a  data-target="#article" onclick="return false">ARTICLES</a></li>
                              <li role="presentation">
                                <a  data-target="#feedback" onclick="return false">FEEDBACK</a></li>   
                            </ul>
                        </nav>    
                        <div class="tab-content" style="min-height:500px;">
                                <div role="tabpanel" class="tab-pane" id="home">
                                    <form class="form-wrapper cf cf-btn" style="width:100%;height:auto;overflow:hidden;">
                                        <input type="text" placeholder="Search questions" required style="width:100%;max-width:800px;" class='ques_added'>
										<input type="hidden" value="<?php echo $this->session->userdata('sme_userid'); ?>" id="smeuserid">
                                       <span><a href="#" class='question_search'><i class="fa fa-search " aria-hidden="true"></i></a></span>
                                    </form>
                                    <div class="box-footer box-comments smequestionslist">
									<?php  if(count($questions) > 0) { ?>
									<?php $i=0; foreach($questions as $question) { $i++; if($i==7) break;?>
                                        <div class="box-comment">
                                            <!-- User image -->
											  <?php if($question->image == '') {?>
												<img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" alt="User Image" style="height:40px;width:40px;"/>
											  <?php } else {?>
												<img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $question->userid;?>/<?php echo $question->image;?>" alt="User Image">
											  <?php } ?>	
                                            <div class="comment-text">
                                                  <span class="username">
                                                    <?php echo $question->name;  ?>
                                                    <span class="text-muted pull-right"><?php echo date('h:i A', strtotime($question->added_on));?> <?php  $dt = date('Y-m-d', strtotime($question->added_on)); if(strtotime($dt) == strtotime(date('Y-m-d'))) { echo 'Today'; } else { echo date('l', strtotime($question->added_on)); } ?> </span>
                                                  </span><!-- /.username -->
                                              <?php echo $question->question;  ?>
											  
                                              <div class="answer">
											   <?php if(count($question->comments) != 0 ) {?>
                                                  <div class="column one">
                                                     <?php if ($this->session->userdata('photo') != '') { ?>
														<img class="user_icon"  src="<?php echo $smepath . $this->session->userdata('sme_userid') . '/' . $this->session->userdata('photo'); ?>" style="height:40px;width:40px;float:left;display:inline;">
													<?php } else { ?>
														<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='float:left;display:inline;'>
													<?php } ?>
                                                  </div>
												 
												  <?php foreach($question->comments as $c) {?>
													  <div class="column eleven last">
														 <?php echo $c->comment; ?>
													  </div>
												  <?php } ?>
												  <?php } else { ?>
													 <div class="img-push">
													  <input type="text" class="form-control input-sm answering" placeholder="Press enter to answer" style="width: 100%;max-width: 100%;">
													  <input type='hidden' class='qid' value='<?php echo $question->id; ?>' />
													  <input type='hidden' class='uid' value='<?php echo $question->userid; ?>' />
													</div>
												  <?php } ?>
                                              </div>
											  
                                            </div>
                                         </div>   
                                            <!-- /.comment-text -->
									<?php } } else {?>
										<p>There are no questions</p>
									<?php } ?>
                                    </div>
                                 </div> 
                                <div role="tabpanel" class="tab-pane active" id="profile">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>S no.</td>
                                                <td>Date & Time</td>
                                                <td>Name</td>
                                                <td>Contact Number</td>
												<td>Wellness Report</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                       <tbody>
    <?php if (count($booked_calls) > 0) { ?>
           <?php
           $i = 0;
           foreach ($booked_calls as $call) {
                   $i++;
                   if ($i == 7)
                           break;
                   ?>
    <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo date('d M Y', strtotime($call->date)); ?> ,  <?php echo $call->time_from;?> - <?php echo $call->time_to;?></td>
    <td><?php echo $call->name; ?></td>
    <td> <?php if($call->phone!='') { echo "+91 ".$call->phone; }else { echo '-';} ?></td>
       
    <td>
        <?php if($call->report_id!='') { ?> <a href='<?php echo base_url();?>survey/report/<?php echo $call->report_id; ?>' class="blue"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download</a> <?php }else { echo '-';} ?></td>  
    <td>
        <a data-toggle="modal" data-target="#cancelappoint" title="Cancel Booking" style="text-decoration:none;" id='<?php echo $call->id; ?>' class='appendid booked_<?php echo $call->id; ?>'><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a> | 
        <a data-toggle="modal" data-target="#sme_notes" title="Notes" style="text-decoration:none;" id='<?php echo $call->id; ?>' class='appendid booked_<?php echo $call->id; ?>'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Start Call</a></td>     
    <!-- S<td><img src="<?php echo base_url(); ?>sme_users/articles/<?php //echo $ar->id; ?>/<?php //echo $ar->photo; ?>" width="100%"></td>HOW NOTES LINK and POPUP-->

    </tr>
           <?php } } else {
                   ?>
                   <tr ><td colspan='6'>There are no Booked Calls</td></tr>
           <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="event">
                                    
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>S no.</td>
                                                <td>Date</td>
                                                <td>Event Name</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php if (count($events) > 0) { ?>
										 <?php
											$i = 0;
											foreach ($events as $ar) {
												$i++;
												if ($i == 7)
													break;
												$today = strtotime(date('Y-m-d'));
												$start = strtotime(date('Y-m-d', strtotime($ar->date)));
												?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo date('d M, Y', strtotime($ar->date)); ?></td>
                                                <td><?php echo $ar->title; ?></td>
                                                <td>
												<?php if($start > $today) {?>
													<a href="#"  class='delete_event' data-toggle="tooltip" data-placement="bottom" title="Cancel Event" id='<?php echo $ar->id; ?>'><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
												<?php } ?>
											   <a href="#"  data-toggle="tooltip" data-placement="bottom" title="Reschedule Event"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                                            </tr>
										 <?php } } else {
												?>
												<tr ><td colspan='4'>There are no Events</td></tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-success" style="margin-top:15px" data-toggle="modal" data-target="#myModal">Add event</button>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="article">
								 <?php if (count($articles) > 0) { ?>
								 <?php
									$i = 0;
									foreach ($articles as $ar) {
										$i++;
										if ($i == 7)
											break;
										?>
                                    <div class="row articles">
                                       <div class="column three">
                                           <img src="<?php echo base_url(); ?>sme_users/articles/<?php echo $ar->id; ?>/<?php echo $ar->photo; ?>" width="100%">
                                       </div>
                                       <div class="column nine last">
                                                <h2><?php echo $ar->heading; ?></h2>
                                                <p><?php echo $limited_string = word_limiter($ar->content, 50, ''); ?></p>
                                       </div>
                                    </div>
								 <?php } } else { ?>
											<p>There are no Articles</p>
										<?php } ?>
                                    <button class="btn btn-success" style="margin-top:15px;" data-toggle="modal" data-target="#myModal1">Add articles</button>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="feedback">
								 <?php if (count($feedback) > 0) { ?>
								 <?php
										$i = 0;
										foreach ($feedback as $fb) {
											$i++;
											if ($i == 6)
												break;
											?>
                                    <div class="row articles">
                                       <div class="column twelve">
                                                <h2>By <?php echo $fb->name; ?></h2>
                                                <p><?php echo $fb->feedback; ?></p>
												<div>
													<ul class="feedReating">
														<li>
															<?php if($fb->fb_score == 4.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/four-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 4) { ?>
															<img src="<?php echo base_url();?>images/rating-img/four-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/five-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 3) { ?>
															<img src="<?php echo base_url();?>images/rating-img/three-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 3.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/three-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 2) { ?>
															<img src="<?php echo base_url();?>images/rating-img/two-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 2.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/two-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 1.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/one-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 1) { ?>
															<img src="<?php echo base_url();?>images/rating-img/one-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == '' || $fb->fb_score ==0) { ?>
															<img src="<?php echo base_url();?>images/rating-img/zero-rating.png" alt="" />
														<?php } ?>
														</li>
														</ul>
												</div>
                                       </div>
                                    </div>
									 <?php } } else { ?>
										<p>There are no feedbacks</p>
									<?php } ?>			
                                </div>
                        </div>
                      </div>
                      <div class="column two last others" style="padding-left:0px;">
                          <h4 style="font-weight:300;font-size:14px;border-bottom:1px solid #ebebeb;padding-bottom:10px;">OTHER LINKS</h5>
                          <ul style="list-style: none;padding:0px;">
                              <li><a data-toggle="modal" data-target="#consult">Consultation History</a></li>
                              <li><a  data-toggle="modal" data-target="#payment">Payment history</a></li>
                          </ul>
                      </div>
                 </div>
            </section> 
        </div>
        <!-- id-main -->
    </main>
    <!-- main -->
					
								




<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">ADD A EVENT</h4>
          </div>
          <div class="modal-body">
            <form class="validation" id="sme_add_event" method="post" action="<?php echo base_url(); ?>experts/insert_sme_event" enctype="multipart/form-data">
			 <input type="hidden" id="sme_userid" name="sme_userid" value="<?php echo $this->session->userdata('sme_userid'); ?>">
			 <div class="form-group">
                <label for="title">TITLE</label>
                <input type="text" class="form-control required" id="title" placeholder="title" name="event_title">
              </div>
              <div class="form-group">
                <label for="description">DESCRIPTION</label>
                <input type="text" class="form-control required" id="description" placeholder="Description" name="event_description">
              </div>
              <div class="form-group">
                <label for="address">ADDRESS</label>
                <input type="text" class="form-control required" id="address" placeholder="Address" name="event_address" >
              </div>
              <div class="form-group">
                <label for="image">IMAGE</label>
                <input type="file" class="form-control required" id="image" name="event_photo">
              </div>
              <div class="form-group" style="margin-top:10px;">
                <label for="image">DATE & TIME</label>
                   <ul class="list-inline" style="list-style:none;padding:0px;">
                     <li><input class="flatpickr required" name="start_date" id="defaultDate" type="text" style="width: 274px !important;font-size: 14px;
    height: 35px;padding-left: 10px;"/></li>
                     <li><input class="flatpickr required" id="defaultDate" name="end_date" type="text" style="width: 274px !important;font-size: 14px;
    height: 35px;padding-left: 10px;"/></li>
                 </ul>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="add_sme_event">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
     <div class="modal fade" tabindex="-1" role="dialog" id="myModal1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">ADD A ARTICLE</h4>
          </div>
          <div class="modal-body">
           <form class="validation" id="sme_add_article" method="post" action="<?php echo base_url(); ?>experts/insert_sme_article" enctype="multipart/form-data">
		   <input type="hidden" id="sme_userid" name="sme_userid" value="<?php echo $this->session->userdata('sme_userid'); ?>">
              <div class="form-group">
                <label for="title">TITLE</label>
                <input type="text" class="form-control required" id="title" placeholder="title" name="article_title">
              </div>
              <div class="form-group">
                <label for="image">IMAGE</label>
                <input type="file" name="article_image" class="form-control required" id="image">
              </div>
              <div class="form-group"  style="margin-top:15px;">
                <label for="description">DESCRIPTION</label>
                <textarea rows="5" Placeholder="Description" name="article_description" class='required'></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary"  id="add_sme_article">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	<!--calender-->
	 <div class="modal fade bookCall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
				<div class="modal-dialog modal-md bookmd modal-lg">
					<div class="modal-content">
						<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center;">Calendar</h4> </div>
						<div class="textEnter">
						<div class='alert alert-danger er-msg' style='display:none;'>Please select available slots</div>
										<div class='alert alert-success show-suc' style='display:none;'>The Selected Slot is blocked successfully</div>
							<div class="date dashDate smedate">
												<div  class='edit-datepicker2' id='sme-datepicker'>
																									
												</div>
												
											</div>
											<div class="avaBox">
													<ul>
														<li><img src="<?php echo base_url(); ?>assets/experts/image/bage1.png">Selected</li>
														<li><img src="<?php echo base_url(); ?>assets/experts/image/bage2.png">Available</li>
														<li><img src="<?php echo base_url(); ?>assets/experts/image/bage3.png">Booked</li>
														<li><img src="<?php echo base_url(); ?>assets/experts/image/bage4.png">Blocked</li>
													</ul>
												</div>
												<div class="timeSlot">
													<span>Available Time Slots for </span>
													
												</div>
							<div class="modal-footer">
							<input type="hidden" id="book_call_date2" value=""/>
											<input type='hidden' name='smeuserid' class='smeuserid' value='<?php echo $this->session->userdata('sme_userid');?>' />
										<button type="button" class="btn btn-default cancel-slot" >Cancel</button>
										<button type="button" class="btn btn-success block-slot" >Block/Unblock</button>
										<button type="button" class="btn btn-success book-slot" >Book</button>
										</div>
						</div>
					</div>
				</div>
			</div>
	<!--calender-->
	
	<!--cancel appointment-->
	      <div class="modal fade" tabindex="-1" role="dialog" id="cancelappoint">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif;">Cancel this appointment</h4> </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="comment">Send a message</label>
                                <textarea class="form-control cancelmsg" rows="5" id="comment" ></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
					<input type='hidden' name='booked_id' class='booked_id' value='' />
                        <button type="button" class="btn btn-primary cancelbookcall">Send</button>
                        <button type="button" class="btn btn-default closethispopup" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
	<!--cancel appointment-->
	<div class="modal fade" tabindex="-1" role="dialog" id="sme_notes">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif;">Notes</h4> </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="comment">Note</label>
                                <textarea class="form-control notemsg" rows="5" id="comment" ></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type='hidden' name='booked_id' class='booked_id' value='' />
                        <button type="button" class="btn btn-primary notebookcall">Send</button>
                        <button type="button" class="btn btn-default closethispopup" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
	
	<div class="modal fade" tabindex="-1" role="dialog" id="consult">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif;">Consultation History</h4> </div>
                    <div class="modal-body">
                        <div role="tabpanel" class="tab-pane" id="profile" style='height:400px;overflow-y:scroll;'>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>S no.</td>
                                        <td>Date & Time</td>
                                        <td>Name</td>
                                        <td>Notes</td>
                                    </tr>
                                </thead>
                                <tbody>
									<?php  $i=0; foreach($consultation as $co) { $i++;?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo date('j M, Y',strtotime($co->date)); ?> - <?php echo $co->time_from; ?></td>
											<td><?php echo $co->name; ?></td>
											<td><a data-dismiss="modal" data-toggle="modal" data-target="#notes_<?php echo $co->id; ?>" ><i class="fa fa-file-text" aria-hidden="true"></i></a></td>
										</tr>
									<?php  } ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="payment">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif;">Payment History</h4> </div>
                    <div class="modal-body">
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Name </td>
                                        <td>Amount</td>
                                        <td>Amount Paid</td>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $i=0; foreach($payment as $p) { $i++;?>
										<tr>
											<td><?php echo $p->name; ?></td>
											<td>Rs. <?php echo (int)$p->amount; ?></td>
											<td>Rs. <?php echo (int)$p->amount_paid; ?></td>
										</tr>
									<?php } ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
		
		 <div class="modal fade" tabindex="-1" role="dialog" id="bookblock">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target=".bookCall"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif;">Book this timeslot</h4> </div>
                    <div class="modal-body">
					<div class='alert alert-success show-sucsend' style='display:none;'>The slot is booked successfully and email is sent to user.</div>
                        <form>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control emailcheck" id="email" style="border: 1px solid #ebebeb; border-radius: 0px;">
							</div>
							<div class="form-group">
                                <label for="name">Name:</label>
                                <input type="name" class="form-control newname" id="name" style="border: 1px solid #ebebeb; border-radius: 0px;"> 
							</div>
							<br/>
                            <div class="form-group">
                                  <label for="email">Gender:</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="Male" name='gender' class='gender' style="margin: 6px 0 0 -16px;">Male</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="Female" name='gender' class='gender' style="margin: 6px 0 0 -16px;">Female</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="Others" name='gender' class='gender' style="margin: 6px 0 0 -16px;">Others</label>
                            </div>
							
							 <div class="form-group">
                                  <label for="email">Type:</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="Text Chat" name='type' class='type' style="margin: 6px 0 0 -16px;">Text Chat</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="Audio Chat" name='type' class='type' style="margin: 6px 0 0 -16px;">Audio Chat</label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="Video Chat" name='type' class='type' style="margin: 6px 0 0 -16px;">Video Chat</label>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
					<input type='hidden' name='text' class='ctext' value='<?php echo $profile->chat_pricing; ?>' />
					<input type='hidden' name='text' class='caudio' value='<?php echo $profile->audio_pricing; ?>' />
					<input type='hidden' name='text' class='cvideo' value='<?php echo $profile->video_pricing; ?>' />
					<input type='hidden' name='amount' class='amount' />
					<input type='hidden' name='user_id' class='exuser_id' />
					<input type='hidden' name='slot_id' class='slot_id' />
                        <a class="btn btn-success book_slot_user" style="text-decoration:none;">Book</a>
                    </div>
					</form>
                </div>
            </div>
        </div>
		
		<?php  foreach($consultation as $co) { $i++;?>
		<div class="modal fade" tabindex="-1" role="dialog" id="notes_<?php echo $co->id; ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif;">Notes</h4> </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <p><?php if($co->sme_notes != '') {echo $co->sme_notes;} else { echo 'No Notes'; } ?></p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a data-dismiss="modal" data-toggle="modal" data-target="#consult" class="btn btn-success" style="text-decoration:none;">Back</a>
                    </div>
                </div>
            </div>
        </div>
		<?php } ?>