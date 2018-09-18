<p class='city' style='text-transform:capitalize;cursor:pointer;'><?php echo $cities[0]->city;?></p>
<div class='city_search'>
	<div class='search_header'>
		<input type='text' name='city' class='cityadded' placeholder='Enter your City'/>
		<input type='button' value='Search' class='sear_city'/>
	</div>
	<div class='top_searched'>
		<h5>TOP SEARCHED</h5>
		<p>
		<?php $i=0; foreach($cities as $c){ $i++; if($i==5) break;?>
			<span><?php echo $c->city;  echo ','; ?></span>
		<?php } ?>
		<br/>
			<span class='all' style='color:red;cursor:pointer;'>All Cities</span>
		</p>
	</div>
</div>
