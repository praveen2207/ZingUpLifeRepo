<?php  if(count($articles) !=0) { foreach($articles as $ar) { ?>
	<li>
		<div class="product-inner">
			<div class="product-list-image"><a href="<?php echo base_url(); ?>articles/detail/<?php echo $ar->id; ?>"><img src="<?php echo base_url();?>sme_users/articles/<?php echo $ar->id; ?>/<?php echo $ar->photo; ?>" alt="" /></a></div>
			<div class="product-list-details">
				<a href="#"><h5><?php  echo $limited_string = word_limiter($ar->heading, 8, '');?></h5> </a>
				<div class="item-head-img" style='padding-left:0px;'>
					<p><span class="post-user"><a href="#">Posted On </a> <?php echo date('d F, Y  h:i A',strtotime($ar->added_on));?> <br></span><a class="comment-count" href="<?php echo base_url(); ?>articles/detail/<?php echo $ar->id; ?>"><?php echo $ar->comments[0]->count; ?> Comment</a></p>                                       
				</div>                                       
			</div>
		</div>
	</li>
<?php  } } else {?>
<p id='no-more' style='clear:both;'>Sorry there are no more results.</p>
<?php }?> 

