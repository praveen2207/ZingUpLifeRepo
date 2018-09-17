<div style="padding:10px;">
  <p style="color: #858181">Check Your prevously added time slots<span class="pull-right"><!--<a href="#"><i class="fa fa-plus open" aria-hidden="true" style="color: #000"></i></a>--></span></p>
 <div class='show_times' style='display:block;'><?php foreach($bookedsmeslots as $slot) { if($slot[0] !='') {$day = explode("+",$slot[0]);  ?>
	<p><span class='add_days2' style='font-weight:bold;'><?php echo $day[0]; ?></span> -  <span class='add_time2'><?php foreach($slot as $s) { $days = explode("+",$s);  echo $days[1]; echo ','; }?></span>
		<!--<a href="#" style='float:right;' class='delete_time_slot' ids=''><i class="fa fa-close" aria-hidden="true" style="color: #000"></i></a>-->
	</p>
 <?php } } ?>
 </div>
</div>