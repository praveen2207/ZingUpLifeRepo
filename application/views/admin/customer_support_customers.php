<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Customers</h3>
</div>

<div class="row-fluid tr-row">
    <div class="sorting-section">
        <p class="sorting-para">
            <span class=" sorting-span">Show members Since </span>
            <span class="blue  sorting-span">Join Date
<!--                <i class="fa fa-angle-down"></i>-->
            </span>
            <span class="blue  sorting-span sort-span" id="joining_date"><?php echo $customer_joining_date; ?></span>
            <i class="fa fa-angle-down date-arrow blue" id="dp8" data-date-format="yyyy/mm/dd" data-date="<?php echo $customer_joining_date; ?>"></i>
        </p>
        <form action='<?php echo base_url();?>customer_support/download' method='post' class='transform' target="_blank" >
			
				<input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
				 <input type='hidden' name='trans' class='html' value=''/>      
			</form>
    </div>
    
    <div class='trans-tabledata' style='display:none;'>
<h3 class="redirect-head admin-head">Customers</h3>
<table  border="1" class="display" cellpadding="3" width="100%" >
			<thead>
				<tr>
					<th class="filter-input">Customer ID</th>
					<th class="filter-input">Customer Name</th>
					<th>Join Date</th>
					<th class="filter-input">Gender</th>
					<th class="">Phone No.</th>
					<th>Photo <br/> Status</th>
					<th>Email IDs</th>
					<th>Recent Order IDs</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_customers as $key => $value) { ?>
					<tr>
						<td class="blue"><?php echo $value->user_id; ?></td>
						<td class="blue word_break"><a class="blue mail-id" href="<?php echo base_url();?>customer_support/customer_details/<?php echo $value->user_id; ?>"><?php echo $value->name; ?></a></td>
						<td><?php echo date('Y/m/d', strtotime($value->created_on)); ?></td>
						<td><?php echo $value->gender; ?></td>
						<td>
							<?php
							if ($value->phone == '') {
								$phone = '-';
							} else {
								$phone = '+91 ' . $value->phone;
							}
							echo $phone;
							?>
						</td>
						<td class="blue">Pending</td>
						<td class="blue word_break"><?php echo $value->username; ?></td>
						<td class="blue ellipse word_break"><?php echo $value->orders; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
</div>

    <div class="filter-section cus-filter">
        <label class="filter-label">Filter:</label>
		<div style="float:left;">
        <input class="first-in ord-id" type="text" name="" id="" placeholder="Order ID" />
		<div class="form-error1 filter-error">
                                <label class="error">Enter numbers only</label>
           </div>
		   </div>
		<div style="float:left;">
        <input class="first-in cus-id" type="text" name="" id="" placeholder="Customer ID" />
		<div class="form-error1 filter-error">
                                <label class="error">Enter numbers only</label>
        </div>
		</div>
		<div style="float:left;">
        <input type="text" name="" id="" placeholder="Customer Name"  class='cus-name'/>
		<div class="form-error1 filter-error">
                                <label class="error">Special characters not allowed</label>
        </div>
		</div>
		<div style="float:left;">
        <input class="first-in ph" type="text" name="" id="" placeholder="Phone No" />
		<div class="form-error filter-error">
                                <label class="error">Enter numbers only</label>
        </div>
		<div class="form-error1 filter-error">
                                <label class="error">Enter 10 numbers only</label>
        </div>
		</div>
		<div style="float:left;">
        <input type="text" name="" id="" placeholder="Customer Email ID" class='email' />
		
		</div>
    </div>
<div class='customer-table'>
    <table id="example1" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Customer ID</th>
                <th class="filter-input">Customer Name</th>
                <th>Join Date</th>
                <th class="filter-input">Gender</th>
                <th class="">Phone No.</th>
                <th>Photo <br/> Status</th>
                <th>Email IDs</th>
                <th>Recent Order IDs</th>
            </tr>
        </thead>
        <tbody id="cs_customers_filter">
            <?php foreach ($all_customers as $key => $value) { ?>
                <tr>
                    <td class="blue"><?php echo $value->user_id; ?></td>
                    <td class="blue word_break word_break_down"><a class="blue mail-id" href="<?php echo base_url(); ?>customer_support/customer_details/<?php echo $value->user_id; ?>"><?php echo $value->name; ?></a></td>
                    <td><?php echo date('Y/m/d', strtotime($value->created_on)); ?></td>
                    <td><?php echo $value->gender; ?></td>
                    <td>
                        <?php
                        if ($value->phone == '') {
                            $phone = '-';
                        } else {
                            $phone = '+91 ' . $value->phone;
                        }
                        echo $phone;
                        ?>
                    </td>
                    <td class="blue">Pending</td>
                    <td class="blue word_break word_break_down"><?php echo $value->username; ?></td>
                    <td class="blue ellipse word_break"><?php echo $value->orders; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>