<span>Available Time Slots for <span class='dateselected'><?php echo date('j F Y',strtotime($res[0]->sel_date)); ?></span></span>
<?php $i=0; foreach($res as $r) { $i++;?>
	<button class="btn timeBtn <?php if($i==1){?>timeAcitve<?php } ?>"  id='<?php echo $r->id; ?>'><?php echo $r->time_from; ?> - <?php echo $r->time_to; ?></button>
<?php } ?>
<input type='hidden' class='added_slot' value='<?php echo $res[0]->id; ?>' />