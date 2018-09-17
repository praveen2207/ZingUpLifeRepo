<style>
.modal-body {
    max-height:500px;
    overflow-y: auto;
        opacity: 1.8;
}
.modal-backdrop.in {
    filter: alpha(opacity=50);
    opacity: 0.95;
    background-color: #444;
	}
td, th {
    padding: 10px;
}
</style>

<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Visitors</h3>		 
</div>
<div class="row-fluid tr-row">
    <?php
    //$current_date = date("Y/m/d");
    //$end_date= date('Y/m/d', strtotime('-30 days'));
    ?>
    <div>
         <label>No of records:<?php echo count($analyticlist);?></label>
    </div>
    <div class="sorting-section">
     <!-- 
        <p class="sorting-para s-para">
            <span class=" sorting-span">List Showing users activity between date</span>
        </p>
       
	        <p class="sorting-para">
		    <span class=" sorting-span">from</span>
	            <span class="blue sorting-span sort-span" id="startDate"><?php echo $current_date; ?></span>
	            <i class="fa fa-angle-down date-arrow blue" id="dp6" data-date-format="yyyy/mm/dd" data-date="<?php echo $current_date; ?>"></i>
	        </p>
	        <p class="sorting-para spara1">
		    <span class="sorting-span">to</span>
	            <span class="blue  sorting-span sort-span" id="endDate"><?php echo $end_date; ?></span>
	            <i class="fa fa-angle-down date-arrow blue" id="dp7" data-date-format="yyyy/mm/dd" data-date="<?php echo $end_date; ?>"></i>
	        </p>
         -->
         
	<form action='<?php echo base_url();?>customer_support/download' method='post' class='transform' target="_blank">
	    <input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
	    <input type='hidden' name='trans' class='html' value=''/>      
	</form>
    </div>
    <form name='myform' action='<?php echo base_url();?>admin/Analytics_controller/page_visitors_view' method="post">
	    <div class="filter-section filter-section1 admin-vendor-all-filter">
	        <p class="filter-para" style="float:left;">
	            <label class="filter-label">Filter Info:</label>
	        	<select id='page' name='url_pages' onchange='visited_page_filter();'>
	            	<option value=''>All pages</option>
	            	<?php foreach ($pagenamelist as $value) { ?>
	                <option value='<?php echo $value->page_url; ?>' <?php if($page_url==$value->page_url){?> selected="" <?php } ?>><?php echo $value->page_name; ?></option>
	            	<?php } ?>
	        	</select>
		        <input type="hidden" name="selected_date" id="selected_date" value="<?php if($idate) echo $idate;?>"/>
		        <div class='col-md-4 pull-right'>
			        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
			    		<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			    		<span><?php if($dates) echo $dates; ?></span> <b class="caret"></b>
					</div>
				</div>
	        </p>
	    </div>
    </form>
    <div class='trans-tabledata' style='display:none;'>
        <h3 class="redirect-head admin-head">Analytics</h3>
        <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
            <thead>
                <tr>
                    <th style="width:60px;">Ip Addresss</th>
                     <th style="width:60px;">page_visited_count</th>
                    <th style="width:150px;">Page name</th>
				    <th>Created Date</th>
				    <th style="width:150px;">User Agent</th>
				</tr>
            </thead>
	    	<tbody>
                <?php foreach($analyticlist as $value) { ?>
                    <tr>
                        <td style="width:1000px;"><?php echo $value->ip_address; ?></td>
                        <td style="width:60px;"><?php echo $value->page_visited_count; ?></td>
                        <td class="word_break_down" style="width:150px;"><?php echo $value->page_name; ?></td>
						<td><?php echo $value->created_at; ?></td>
						<td style="width:150px;"><?php echo $value->user_agent; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class='table-data'>
        <table id="vendor-table3" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Ip Address</th>
                    <th>page_visited_count</th>
                    <th>Page name</th>
		    		<th>Created Date</th>
                    <th>User Name</th>
		    		<th>User Agent</th>
                </tr>
            </thead>
	    	<tbody class='searchcontent'>
                <?php foreach($analyticlist as $value) { ?>
                    <tr>
                        <td>
                        
                         <!--<button class="btn btn-success" style="margin-top:15px" data-toggle="modal" data-target="#myModal">Add event</button>  
                        
                       <a href="<?php echo base_url(); ?>admin/analytic_view_ip_detail?ip_address=<?php echo $value->ip_address; ?>" data-toggle="modal" data-target="#myModal" >-->
                    <a href="javascript:void(0);" onclick="show_details('<?php echo $value->ip_address;?>','<?php echo $value->page_name; ?>','<?php echo $idate;?>');">
                        		<font size="2" color="blue" >
                        			<?php echo $value->ip_address; ?>
                        		</font>
                        	</a>
                        </td>
                        <td ><?php echo $value->page_visited_count	; ?></td>
                        <td class="word_break_down"><?php echo $value->page_name; ?></td>
						<td><?php echo $value->created_at; ?></td>
                        <td style="width:50px;"><?php echo $value->username; ?></td>
						<td><?php echo $value->user_agent; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<div class="modal modal-backdrop fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">pages visited by users</h4>
	            </div>
	         <div class="modal-body">
	            <div class='details_table-data'>
			    </div>
			</div>
	        <div class="modal-footer">
	           <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	       	</div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
     

