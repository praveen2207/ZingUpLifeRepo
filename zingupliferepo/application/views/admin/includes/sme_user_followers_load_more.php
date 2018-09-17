<?php if(count($followers) !=0) {foreach($followers as $follower) { ?>
	<li>
		<div class="product-inner">
			<div class="product-list-image"><a href="#"><img src="<?php echo base_url();?>images/Naren186x186.jpg" alt=""></a></div>
			<div class="product-list-details">
				<a href="#"><h5><?php echo $follower->name; ?></h5> </a>                                                                                   
			</div>                                        
		</div>
	</li>  
<?php }} else {?>
<p id='no-more' style='clear:both;'>Sorry there are no more results.</p>
<?php }?>