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
			.smedate .ui-datepicker.ui-datepicker-multi {
    border: 0;
    width: 64em !important;
}
			 
			</style>
<div class="container">
    <div class="linerList">
        <span class="colorGreen">Home&nbsp;</span><span  class="colorGrey">// Call Reschedule</span>
    </div>

    <div class="orderBox">
	
	<h4>Chat/Audio/Video Details</h4>
	<div class="form-group">
		<span class="col-xs-3 widthBox1">Expert:</span>
		<div class="col-xs-8 widthBox2">
			<span class="odColor"><?php echo $call_details->first_name;?></span>
			<?php if ($call_details->photo != '') { ?>
				<img class="sme_image_class" src="<?php echo base_url(); ?>sme_users/<?php echo $call_details->sme_userid; ?>/<?php echo $call_details->photo; ?>">
			<?php } ?>
		</div>
		<div class="col-xs-8 widthBox2">
			
				
		</div>
	</div>
	
	<div class="form-group">
		<span class="col-xs-3 widthBox1">Date:</span>
		<div class="col-xs-8 widthBox2">
			<span class="odColor"><?php echo date('d/m/Y',strtotime($call_details->s_date)); ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<span class="col-xs-3 widthBox1">Time:</span>
		<div class="col-xs-8 widthBox2">
			<span class="odColor"><?php echo $call_details->time_from; ?> - <?php echo $call_details->time_to; ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<span class="col-xs-3 widthBox1">Book Type:</span>
		<div class="col-xs-8 widthBox2">
			<span class="odColor"><?php echo $call_details->book_type; ?></span>
		</div>
	</div>
	
	
	<h4>Reschedule</h4>
	<?php foreach($added_slots as $slot) { ?>
				<span style='display:none;' class='slots'  year = '<?php echo date('Y',strtotime($slot->date));?>' month = '<?php echo date('n',strtotime($slot->date));?>' daydate = '<?php echo date('j',strtotime($slot->date));?>'></span>
				<input type='hidden' class='added_slots' value='<?php  echo date('Y-n-j',strtotime($slot->date));?>' />
			<?php } ?>
			
			<?php foreach($blocked_slots as $slots) { ?>
				<span style='display:none;' class='blockedslots'  year = '<?php echo date('Y',strtotime($slots));?>' month = '<?php echo date('n',strtotime($slots));?>' daydate = '<?php echo date('j',strtotime($slots));?>'></span>
				<input type='hidden' class='blocked_slots' value='<?php  echo date('Y-n-j',strtotime($slots));?>' />
			<?php } ?>
        <div class="date dashDate smedate">
			<div class="row-fluid pr-success" style='display:none;'>
				<div class="message pr-message">

					<h3 class="congratulations message-head">Congratulations!</h3>

					<p class="para-small for-para">Its Successfully Rescheduled</p>

				</div>
			</div>    
		<input type='hidden' value='<?php echo $sme_userid; ?>' class='smeuserid' />
		<input type='hidden' value='<?php echo $booked_id; ?>' class='oldsmebookcallid' />
			<div id="smedashDatePickers"></div>
		</div>
		<div class="avaBox">
			<ul>
				<li><img src="<?php echo base_url(); ?>assets/experts/image/bage1.png">Selected</li>
				<li><img src="<?php echo base_url(); ?>assets/experts/image/bage2.png">Available</li>
				<li><img src="<?php echo base_url(); ?>assets/experts/image/bage3.png">Booked</li>
			</ul>
		</div>
		<div class="timeSlot">
			<span>Available Time Slots for </span>
			
		</div>
		<div class="modal-footer reschedulefooter" style='display:none;'>
			<a href="javascript:void(0);" class="btn zing-btn reschedulebutton">Reschedule</a>
		</div>
    </div>
</div>