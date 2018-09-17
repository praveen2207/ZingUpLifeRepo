<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Transactions</h3>		 
</div>


<div class="row-fluid tr-row">	  
     <div class="sorting-section">
        <p class="sorting-para s-para">
            <span class=" sorting-span">List Showing booking date</span>
        </p>
        <p class="sorting-para">
            <span class=" sorting-span ">from</span>
            <span class="blue  sorting-span sort-span" id="startDate"><?php echo $current_date; ?></span>
            <i class="fa fa-angle-down date-arrow blue" id="dp6" data-date-format="yyyy/mm/dd" data-date="<?php echo $current_date; ?>"></i>
        </p>
        <p class="sorting-para spara1">
            <span class="sorting-span ">to</span>
            <span class="blue  sorting-span sort-span" id="endDate"><?php echo $end_date; ?></span>
            <i class="fa fa-angle-down date-arrow blue" id="dp7" data-date-format="yyyy/mm/dd" data-date="<?php echo $end_date; ?>"></i>
        </p>

         <form action='<?php echo base_url();?>customer_support/download' method='post' class='transform' target="_blank" >
					<input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
				 <input type='hidden' name='trans' class='html' value=''/>      
		</form>
    </div>
     <div class='trans-tabledata' style='display:none;'>
		<h3 class="redirect-head admin-head">Transactions</h3>
		<table  border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >	 
				<thead>
					<tr>
						<th class="filter-input">Order<br/> ID No.</th>	
						<th>Booked <br/>Date/Time</th>	
						<th class="filter-input">Customer<br/> ID No.</th>   
						<th class="filter-input">Customer<br/> Name</th>     
						<th>Vendor Name <br/>& Location</th>  
						<th>Treatment & <br/> Duration</th>       
						<th>Treatment<br/> Date/Time</th>       
						<th>Cost</th>		
					  </tr>     
				</thead>     
				<tbody>  
					<?php foreach ($all_transactions as $key => $value) { ?>


						<tr id="<?php echo $value['user_details']->id . '-' . $value['transactions']->booking_id . '-' . $value['transactions']->slot_id; ?>">
							<td class="blue"><?php echo $value['transactions']->booking_id; ?></td>
							<td><?php echo date('Y/m/d', strtotime($value['transactions']->booking_date)); ?><br/>
								<?php
								$booking_timing = date('H:i', strtotime($value['transactions']->booking_date));
								if ($booking_timing >= 12) {
									$meridian = 'PM';
								} else {
									$meridian = 'AM';
								}
								echo $booking_timing, ' ' . $meridian;
								?> 
							</td>
							<td class="blue"><?php echo $value['user_details']->id; ?></td>     
							<td class="blue word_break"><?php echo $value['user_details']->name; ?></td>  
							<td class=""><span class="blue v-name word_break"><?php echo $value['vendor_details']->name; ?></span> <br/><?php echo $value['vendor_details']->area_name; ?></td>      
							<td><span class="blue v-name word_break"><?php echo $value['transactions']->services; ?></span><br/>
								<?php
								if ($value['transactions']->duration > 1) {
									$hour = 'hours';
								} else {
									$hour = 'hour';
								}
								echo $value['transactions']->duration;
								?>
							</td>              
							<td><?php echo date('Y/m/d', strtotime($value['transactions']->date)); ?><br/>
								<?php
								$treatment_timing = date('H:i', strtotime($value['transactions']->start_time));
								if ($treatment_timing >= 12) {
									$meridian = 'PM';
								} else {
									$meridian = 'AM';
								}
								echo $treatment_timing, ' ' . $meridian;
								?> </td>			
							<td><?php echo $value['transactions']->amount; ?></td>			
							
						</tr>
					<?php } ?>
				</tbody>  
			</table>		
	</div>
    <div class="filter-section" id="admin_transactions_filter_section">
        <label class="filter-label">Filter:</label>	
		<div style="float:left;">
		
         <input class="first-in ord_id" type="text" name="" id="" placeholder="Order ID" />	
		
          <div class="form-error1 filter-error">
                                <label class="error">Enter numbers only</label>
           </div>
		   
        </div>
		
        <div style="float:left;">		
        <input class="first-in cus_id" type="text" name="" id="" placeholder="Customer ID" />
        <div class="form-error1 filter-error">
                                <label class="error">Enter numbers only</label>
        </div>
        </div>
		
        <div style="float:left;">			
        <input type="text" class='cus_name' name="" id="" placeholder="Customer Name" />	
         <div class="form-error1 filter-error">
                                <label class="error">Special characters not allowed</label>
        </div>
        </div>
		
		 <div style="float:left;">	
        <input class="first-in ph_no" type="text" name="" id="" placeholder="Phone No" />	
		<div class="form-error filter-error">
                                <label class="error">Enter numbers only</label>
        </div>
		<div class="form-error1 filter-error">
                                <label class="error">Enter 10 numbers only</label>
        </div>
		</div>
		
		 <div style="float:left;">	
        <input type="text" class='email_id' name="" id="" placeholder="Customer Email ID" />
		
		</div>

    </div>	 		
    <table id="example" class="display" cellspacing="0" width="100%" >	 
        <thead>
            <tr>
                <th class="filter-input">Order<br/> ID No.</th>	
                <th>Booked <br/>Date/Time</th>	
                <th class="filter-input">Customer<br/> ID No.</th>   
                <th class="filter-input">Customer<br/> Name</th>     
                <th style="width:80px;">Vendor Name <br/>& Location</th>  
                <th>Treatment & <br/> Duration</th>       
                <th>Treatment<br/> Date/Time</th>       
                <th>Cost(&#x20B9;)</th>			
                <th>Actions</th>		
            </tr>     
        </thead>     
       <tbody id="admin_transactions_filter" class="searchcontent">  
            <?php foreach ($all_transactions as $key => $value) { ?>


                <tr id="<?php echo $value['user_details']->id . '-' . $value['transactions']->booking_id . '-' . $value['transactions']->slot_id; ?>">
                    <td class="blue"><?php echo $value['transactions']->booking_id; ?></td>
                    <td><?php echo date('Y/m/d', strtotime($value['transactions']->booking_date)); ?><br/>
                        <?php
                        $booking_timing = date('H:i', strtotime($value['transactions']->booking_date));
                        if ($booking_timing >= 12) {
                            $meridian = 'PM';
                        } else {
                            $meridian = 'AM';
                        }
                        echo $booking_timing, ' ' . $meridian;
                        ?> 
                    </td>
                    <td class="blue"><?php echo $value['user_details']->id; ?></td>     
                    <td class="blue word_break word_break_down"><?php echo $value['user_details']->name; ?></td>  
                    <td class=""><span class="blue v-name word_break"><?php echo $value['vendor_details']->name; ?></span> <br/><?php echo $value['vendor_details']->area_name; ?></td>      
                    <td><span class="blue v-name word_break"><?php echo $value['transactions']->services; ?></span><br/>
                        <?php
                        if ($value['transactions']->duration > 1) {
                            $hour = 'hours';
                        } else {
                            $hour = 'hour';
                        }
                        echo $value['transactions']->duration;
                        ?>
                    </td>              
                    <td><?php echo date('Y/m/d', strtotime($value['transactions']->date)); ?><br/>
                        <?php
                        $treatment_timing = date('H:i', strtotime($value['transactions']->start_time));
                        if ($treatment_timing >= 12) {
                            $meridian = 'PM';
                        } else {
                            $meridian = 'AM';
                        }
                        echo $treatment_timing, ' ' . $meridian;
                        ?> </td>			
                    <td><?php echo $value['transactions']->amount; ?></td>			
                    <td class="action-td"><?php if ($value['transactions']->expiry == 'no') {
                        if ($value['transactions']->booking_status == 'Pending') {
                                ?><span class="blue medium actions admin_confirmorder">Confirm Order</span> <?php } else {
                    if (isset($value['mark_attend']->status)) {
                        if ($value['mark_attend']->status == 'Not-attended') {
                                        ?><span class="blue medium actions admin_remind-customer">Remind Customer</span> <?php
                }
            }
        }
    }
    ?>
                        <span class="blue medium actions more-actions">More Actions<i class="fa fa-angle-down"></i></span>		
                        <div class="actions-dropdown">	
                            <span class="medium actions more-actions1">More Actions<i class="fa fa-angle-down"></i></span>	
                            <ul class="actions-list">		
                                <li><?php
                                        if ($value['transactions']->expiry == 'no') {
                                            if (isset($value['mark_attend']->status)) {
                                                if ($value['mark_attend']->status == 'Not-attended') {
                                                    ?><a id="<?php echo $value['user_details']->id . '-' . $value['transactions']->booking_id . '-' . $value['transactions']->slot_id; ?>" class="blue admin_markattend" href="">Mark as Attended</a><?php } else { ?>Attended <?php
                                }
                            }
                        }
                        ?></li>	
                                <li><a id="<?php echo $value['user_details']->id . '-' . $value['transactions']->booking_id . '-' . $value['transactions']->slot_id; ?>" class="blue" href=""><?php if ($value['transactions']->expiry == 'no') {
                            if ($value['transactions']->booking_status == 'Pending') {
                                                ?>Remind Customer<?php }
    }
    ?></a></li>	
                                <li><a id="<?php echo $value['user_details']->id . '-' . $value['transactions']->booking_id . '-' . $value['transactions']->slot_id; ?>" class="green" href=""><?php if ($value['transactions']->expiry == 'no') {
        if ($value['transactions']->booking_status == 'Success') {
            ?><i class="fa fa-check fa-confirm"></i>Confirmed <?php }
    }
    ?></a></li>
                                <li><a id="<?php echo $value['user_details']->id . '-' . $value['transactions']->booking_id . '-' . $value['transactions']->slot_id; ?>"class="blue" href="<?php echo base_url(); ?>admin/order_details/<?php echo $value['transactions']->booking_id; ?>">View Order Detail</a></li>
                            </ul>	
                        </div>
                    </td>
                </tr>
<?php } ?>
        </tbody>  
    </table>
</div>
