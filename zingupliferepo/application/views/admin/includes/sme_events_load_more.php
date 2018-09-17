<?php  if(count($events) !=0) { foreach($events as $ar) { ?>
	<li>
		<div class="product-inner">
			<div class="product-list-image"><a href="<?php echo base_url(); ?>events/detailpage/<?php echo $ar->id; ?>"><img src="<?php echo base_url();?>sme_users/events/<?php echo $ar->id; ?>/<?php echo $ar->photo[0]->name; ?>" alt="" /></a></div>
			<div class="product-list-details">
				<a href="#"><h5><?php  echo $limited_string = word_limiter($ar->title, 8, '');?></h5> </a>
				<div class="item-head-img" style='padding-left:0px;'>
					<p><span class="post-user"><a href="#">Posted On </a> <?php echo date('d F, Y  h:i A',strtotime($ar->added_on));?> <br></span><a class="comment-count" href="#"><?php echo $ar->comments[0]->count; ?> Comment</a></p>                                       
				</div>                                       
			</div>
		</div>
	</li>
<?php  } } else {?>
<p id='no-more' style='clear:both;'>Sorry there are no more results.</p>
<?php }?> 

