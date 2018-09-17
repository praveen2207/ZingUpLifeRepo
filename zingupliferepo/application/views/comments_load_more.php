<?php if(count($comments) !=0) {foreach($comments as $comment) { ?>
	<li>
		<div class="feedback-list-head">
			<div class="item-head-img">
			<span class="review-hero"><img alt="" src="<?php echo base_url();?>images/user-photo.jpg"></span>
			<p><span class="post-user"><?php echo date('d F, Y  h:i A',strtotime($comment->added_on));?></span></p>
			<h5><span><?php echo $comment->name;?> </span>replied..</h5>             
			</div>
		</div>
		<div class="feedback-list-content">
			<p><?php echo $comment->comment;?></p>	
		</div>
	</li>
<?php }} else {?>
<p id='no-more' style='clear:both;'>Sorry there are no more results.</p>
<?php }?>