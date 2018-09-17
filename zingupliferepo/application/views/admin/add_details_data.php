			<div class='col-md-3 pull-right'> <label>No of records:<?php echo count($res);?></label></div>
			<table id="details_table" class="display" cellspacing="0" border='1' width="100%">
			<thead>
				<tr>
                    <th style="width:100px;">Ip Address</th>
                    <th style="width:100px;">Page name</th>
		    		<th>Created Date</th>
                    <th>User Name</th>
		    		<th>User Agent</th>
                </tr>
            </thead>
	    	<tbody class='searchcontent_details'>
                <?php foreach($res as $value) {?>
				<tr>
					<td><?php echo $value->ip_address; ?></td>
					<td class="word_break_down"><?php echo $value->page_name; ?></td>
					<td style="width:100px;"><?php echo $value->created_at; ?></td>
					<td style="width:100px;"><?php echo $value->username; ?></td>
					<td style="width:200px;"><?php echo $value->user_agent;?></td>
				</tr>
				<?php } ?>
            </tbody>

 			</table>





