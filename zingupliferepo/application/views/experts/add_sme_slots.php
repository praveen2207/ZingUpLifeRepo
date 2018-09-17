<span>Available Time Slots for <span class='dateselected'><?php echo date('j F Y',strtotime($res[0]->sel_date)); ?></span></span>
<?php $ids = array(); $i=0; foreach($res as $r) { if($r->show == 'yes'){ $i++; array_push($ids,$r->id);?>
	<button class="btn timeBtn <?php if($i==1 && !($this->session->userdata('type'))){?>timeAcitve<?php } ?> <?php if(count($res) >= 1 && $this->session->userdata('type')) { echo $r->status; }?>"  status = '<?php echo $r->status; ?>' id='<?php echo $r->id; ?>' booked_id = '<?php echo $r->booked_id;?>'><?php echo $r->time_from; ?> - <?php echo $r->time_to; ?></button>
	<?php if($r->status == 'available') {?>
		<input type='hidden' name='slots[]' class='all_slot' value='<?php echo $r->id; ?>' /> 
	<?php } ?>
<?php } } ?>
<?php if(count($res) > 1 && $this->session->userdata('type') && $res[0]->available !=0) { ?>
	<button class="btn timeBtn" id='0'>All Available Slots</button>
<?php } ?>
<input type='hidden' class='added_slot' value='<?php echo $res[0]->id; ?>' /> 

