<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Vendors</h3>
</div>

<div class="row-fluid tr-row">
    <div class="finance-summary">
        <span class="summary">Summary</span>
        <div class="sorting-section sorting-section2">
            <p class="sorting-para">
                <span class=" sorting-span">Data Showing from</span>
                <span class="blue  sorting-span">Today<i class="fa fa-angle-down"></i></span>
            </p>
           <form action='<?php echo base_url();?>customer_support/download' method='post' class='transform' target="_blank" >
				<input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
				 <input type='hidden' name='trans' class='html' value=''/>      
			</form>
        </div>
<div class='trans-tabledata' style='display:none;'>
	<h3>Summary</h3>
		 <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
					<thead>
						<tr>
							<th class="filter-input" rowspan="2">Average Selling<br/> Price(&#x20B9;)</th>
							<th rowspan="2">Total No. of  <br/>Transactions</th>
							<th rowspan="2" class="filter-input">Total Amount</th>
							<th class="head-centre" colspan="2" style="text-align: center;">Incoming</th>
							<th class="head-centre" colspan="2" style="text-align: center;">Outgoing</th>
							<th rowspan="2">Profit</th>
						</tr>

						<tr>
							<th class="head-centre no-bold" style="text-align: center;">Amount</th>
							<th class="head-centre no-bold" style="text-align: center;">Tax</th>
							<th class="head-centre no-bold" style="text-align: center;">Amount</th>
							<th class="head-centre no-border1 no-bold" style="text-align: center;">Tax</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="medium">20,000</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
							<td><span class="medium">10</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
							<td><span class="medium">-2,00,000</span></td>
							<td class="head-centre" style="text-align: center;"><span class="medium">4,000</span></td>
							<td class="head-centre" style="text-align: center;"><span class="medium">150</span></td>
							<td class="head-centre" style="text-align: center;"><span class="medium">5,000</span></td>
							<td class="head-centre" style="text-align: center;"><span class="medium">250</span></td>
							<td><span class="medium">-5000</span></td>
						</tr>
					</tbody>
				</table>
			
			<h3><?php echo $service_type; ?></h3>
			 <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
            <thead>
                <tr>
                    <th class="">Vendor Name</th>
                    <th>Locations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_vendors as $key => $value) { ?>
                    <tr>
                        <td class="word_break_down"><span class="blue v-name">
                                <a class="blue mail-id" href="<?php echo base_url(); ?>finance/vendor_details/<?php echo $value->id; ?>"><?php echo $value->name; ?></a>
                            </span>
                        </td>
                        <td class=""><?php echo $value->area_name; ?></td>
                        <td class="blue"><a href="<?php echo base_url(); ?>finance/batch_payment/<?php echo $value->id; ?>" class="blue batch">View Batch Payment</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
			
	</div>
        <div class="summary-section">
            <table id="summary-table" class="display" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th class="filter-input" rowspan="2">Average Selling<br/> Price(&#x20B9;)</th>
                        <th rowspan="2">Total No. of  <br/>Transactions</th>
                        <th rowspan="2" class="filter-input">Total Amount</th>
                        <th class="head-centre" colspan="2">Incoming</th>
                        <th class="head-centre" style="" colspan="2">Outgoing</th>
                        <th rowspan="2">Profit</th>
                    </tr>

                    <tr>
                        <th class="head-centre no-bold">Amount</th>
                        <th class="head-centre no-bold">Tax</th>
                        <th class="head-centre no-bold">Amount</th>
                        <th class="head-centre no-border1 no-bold">Tax</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="medium">20,000</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
                        <td><span class="medium">10</span><i class="fa fa-caret-up sum-arrow"></i><i class="fa fa-caret-down sum-arrow"></i></td>
                        <td><span class="medium">-2,00,000</span></td>
                        <td class="head-centre"><span class="medium">4,000</span></td>
                        <td class="head-centre"><span class="medium">150</span></td>
                        <td class="head-centre"><span class="medium">5,000</span></td>
                        <td class="head-centre"><span class="medium">250</span></td>
                        <td><span class="medium">-5000</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="sorting-section1">
            <ul class="sort-list finance_filter">
                <?php if ($service_type == 'all') { ?>
                    <li class="sort-li sort-sel" id="all">SHOW ALL</li>
                <?php } else { ?>
                    <li class="sort-li" id="all">SHOW ALL</li>
                <?php } ?>

                <?php if ($service_type == 'spa') { ?>
                    <li class="sort-li sort-sel" id="spa">SPA</li>
                <?php } else { ?>
                    <li class="sort-li" id="spa">SPA</li>
                <?php } ?>
                <?php if ($service_type == 'ayurvedic_treatments') { ?>
                    <li class="sort-li sort-sel" id="ayurvedic_treatments">AYURVEDIC TREATMENTS</li>
                <?php } else { ?>
                    <li class="sort-li" id="ayurvedic_treatments">AYURVEDIC TREATMENTS</li>
                <?php } ?>
                <?php if ($service_type == 'yoga') { ?>
                    <li class="sort-li sort-sel" id="yoga">YOGA</li>
                <?php } else { ?>
                    <li class="sort-li" id="yoga">YOGA</li>
                <?php } ?>
                <?php if ($service_type == 'healthclubs') { ?>
                    <li class="sort-li sort-sel" id="healthclubs">FITNESS</li>
                <?php } else { ?>
                    <li class="sort-li" id="healthclubs">FITNESS</li>
                <?php } ?>
            </ul>
        </div>

        <div class="filter-section filter-section1 finance-vendor-all-filter">
            <p class="filter-para" style="float:left;">
                <label class="filter-label">Filter Info:</label>
				<div style="float:left;">
            <input type="text" name="" id="" placeholder="Vendor Name" class='vendor_name' />
			
			<div class="form-error1 filter-error">
                                <label class="error">Special characters not allowed</label>
        </div>
		</div>
                <select class="vendor_loc">
                    <option value=''>All Locations</option>
                    <option value='135'>Whitefield</option>
                    <option value='14'>Bellandur</option>
                    <option value='71'>Koramangala</option>
                </select>
				<div style="float:left;">
            <input class="first-in vendor_ph" type="text" name="" id="" placeholder="Phone No"  />
			<div class="form-error filter-error">
                                <label class="error">Enter numbers only</label>
        </div>
		<div class="form-error1 filter-error">
                                <label class="error">Enter 10 numbers only</label>
        </div>
		</div>
				<div style="float:left;">	
            <input type="text" name="" id="" placeholder="Vendor Email ID" class='vendor_email'/> 
		
                <input type="hidden"  class='category' value='<?php echo $this->uri->segment(3); ?>'/> 
            </p>
        </div>
<div class='table-data'>
        <table id="vendor-table1" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="">Vendor Name</th>
                    <th>Locations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class='searchcontent'>
                <?php foreach ($all_vendors as $key => $value) { ?>
                    <tr>
                        <td class=""><span class="blue v-name">
                                <a class="blue mail-id" href="<?php echo base_url(); ?>finance/vendor_details/<?php echo $value->id; ?>"><?php echo $value->name; ?></a>
                            </span>
                        </td>
                        <td class=""><?php echo $value->area_name; ?></td>
                        <td class="blue"><a href="<?php echo base_url(); ?>finance/batch_payment/<?php echo $value->id; ?>" class="blue batch">View Batch Payment</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>
    </div>
</div>