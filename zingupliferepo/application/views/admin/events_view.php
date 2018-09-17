<style>
.ellipsis {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>

<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Events</h3>		 
</div>
<div class="row-fluid tr-row">	  
     <form name='myform' id='events_form' action='<?php echo base_url();?>admin/Events/get_users_event_detail' method="post">
		<div class="filter-section">
			<div class="col-md-1"><p style='font-size: 15px;'><b>Filter By:</b></p></div>
			<div class="col-md-8">
				<input type='text' id='user_name' name='user_name' placeholder='User Name' value="<?php if($user_name) echo $user_name; ?>"/>
				<input type='text' id='event_type' name='event_type' placeholder='Event Type' value="<?php if($event_type) echo $event_type; ?>"/>
				<input class='btn btn-primary' type='button' name='search' value='SEARCH' onclick='attempted_events();'/>
				<input type="hidden" name="selected_date" id="selected_date" value="<?php if($idate) echo $idate;?>"/>
			</div>
			<div class='col-md-3'>
				<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
		    	<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
		    	<span><?php if($dates) echo $dates; ?></span> <b class="caret"></b>
				</div>
			</div>
        </div>
	</form>
        
	    <div class='table-data'>
	    <table id="vendor-table3" class="display" cellspacing="0" width="100%" >	 
	        <thead>
	            <tr>
					<th class="filter-input"'>Sr.<br/>No.</th>	
					<th>User ID</th>	
					<th class="filter-input">User Name</th>   
					<th class="filter-input">Event Type</th>     
					<th>Event String</th>
					<th>IP address</th>
					<th>Event Date</th>       
				</tr>   
	        </thead>     
	       	<tbody id="admin_transactions_filter" class="searchcontent"> 
	       		<?php $i=1; foreach ($event_details as $value) { ?>
						<tr>
							<td><?php echo $i; $i++;?></td>
							<td><?php echo $value->user_id; ?></td>
							<td><?php echo $value->name; ?></td>     
							<td><?php echo $value->event_type; ?></td>  
							<td class="ellipsis" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value->event_string; ?>"><?php echo $value->event_string; ?></td>
							<td><?php echo $value->ip_address_original; ?></td>      
							<td><?php echo $value->insert_timestamp; ?></td>              
						</tr>
					<?php } ?>
	        </tbody>  
	    </table>
	    </div>
</div>	   
