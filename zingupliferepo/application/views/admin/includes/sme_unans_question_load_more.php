<?php  if(count($unansque) !=0) {$i = 0;foreach($unansque as $question) {  ?>
	<a href='<?php echo base_url(); ?>questions/detail/<?php echo $sme_userid; ?>/<?php echo $question->id; ?>'>
		<li>
			<div class="feedback-list-head">
				<div class="item-head-img">
				<span class="review-hero"><img src="<?php echo base_url(); ?>images/user-photo.jpg" alt=""></span>
				<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($question->added_on));?></span></p>
				<h5><span><?php echo $question->name;  ?> </span> asked..</h5>
					<div class="review-rating-right">
					<?php 
						$oneweek= date("Y-m-d", strtotime("7 days ago"));
						$today = date('Y-m-d');
						$added = date('Y-m-d',strtotime($question->added_on));
						if($added <= $today && $added >= $oneweek) {
					?>
					<span><img src="<?php echo base_url(); ?>images/new-icon.png" alt="" /></span>
					<?php } else if($added == $today) { ?>
						<span><img src="<?php echo base_url(); ?>images/hot-icon.png" alt="" /></span>
					<?php } else { ?>
						<span><img src="<?php echo base_url(); ?>images/old-icon.png" alt="" /></span>
					<?php } ?>
					</div>                                                        
				</div>
			</div>
			<div class="feedback-list-content">
				<p><?php echo $limited_string = word_limiter($question->question, 10, ''); ?></p>
				<!--<div class="question-last-content">This communication have 3 replies yet. - <a href="">4 other users</a> found this question helpful.</div>-->
			</div>
		</li>
		</a>
	<?php  } } else {?>
<p id='no-more'>Sorry there are no more results.</p>
<?php }?>
