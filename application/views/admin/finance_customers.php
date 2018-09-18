<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Customers</h3>
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
			<h3></h3>
			<table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
            <thead>
                <tr>
                    <th class="filter-input">Customer ID</th>
                    <th class="filter-input">Customer Name</th>
                    <th>Join Date</th>
                    <th class="filter-input">Gender</th>
                    <th class="">Phone No.</th>
                    <th>Email IDs</th>
                    <th>Recent Order IDs</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_customers as $key => $value) { ?>
                <tr>
                    <td class="blue"><?php echo $value->user_id; ?></td>
                    <td class="blue word_break"><a class="blue mail-id" href="<?php echo base_url();?>finance/customer_details/<?php echo $value->user_id; ?>"><?php echo $value->name; ?></a></td>
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
                    <td class="blue word_break"><?php echo $value->username; ?></td>
                    <td class="blue ellipse word_break"><?php echo $value->orders; ?></td>
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

            <div class="filter-section filter-section2 finance-cus-filter">
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
        </div>
        <div class='customer-table'>
            <table id="customer-table" class="display" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th class="filter-input">Customer ID</th>
                        <th class="filter-input">Customer Name</th>
                        <th>Join Date</th>
                        <th class="filter-input gender_column">Gender</th>
                        <th class="">Phone No.</th>
                        <th>Email IDs</th>
                        <th>Recent Order IDs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_customers as $key => $value) { ?>
                        <tr>
                            <td class="blue"><?php echo $value->user_id; ?></td>
                            <td class="blue word_break word_break_down"><a class="blue mail-id" href="<?php echo base_url(); ?>finance/customer_details/<?php echo $value->user_id; ?>"><?php echo $value->name; ?></a></td>
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
                            <td class="blue word_break word_break_down"><?php echo $value->username; ?></td>
                            <td class="blue ellipse word_break"><?php echo $value->orders; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>	
            </table>
        </div>
    </div>
</div>