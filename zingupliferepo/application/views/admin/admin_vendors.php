<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Vendors</h3>
    <a href="<?php echo base_url(); ?>admin/partner_registration" class="new-user">Add New Vendor</a>
</div>

<div class="row-fluid tr-row">
    <?php
    $success_message = $this->session->flashdata('success_message');
    if (isset($success_message)) {
        ?>
        <div class="message">
            <h3 class="congratulations message-head">Congratulations !!!</h3>
            <p class="para-small for-para"><?php echo $success_message; ?></p>
        </div>
    <?php } ?>
    <div class="sorting-section1">
        <ul class="sort-list admin_filter">
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

        <form action='<?php echo base_url(); ?>customer_support/download' method='post' class='transform' target="_blank" style='padding-top:9px;'>

            <input type='submit' class="blue download download1 pdftransdownload" value='Download'/>
            <input type='hidden' name='trans' class='html' value=''/>      
        </form>	
    </div>
    <div class='trans-tabledata' style='display:none;'>
        <h3 class="redirect-head admin-head">Vendors</h3>
        <h2><?php echo $service_type; ?></h2>
        <table border="1" class="display" cellspacing="0" cellpadding="3" width="100%" >
            <thead>
                <tr>
                    <th class="">Vendor Name</th>
                    <th>Locations</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach ($all_vendors as $key => $value) { ?>
                    <tr>
                        <td class=""><span class="blue v-name">
                                <a class="blue mail-id" style="padding:0px;margin:0px;" href="<?php echo base_url(); ?>admin/vendor_details/<?php echo $value->id; ?>"><?php echo $value->name; ?></a>
                            </span>
                        </td>
                        <td class=""><?php echo $value->area_name; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="filter-section filter-section1 admin-vendor-all-filter">
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
            <?php foreach ($locations as $key => $value) { ?>
                <option value='<?php echo $value->id; ?>'><?php echo $value->suburb; ?></option>
            <?php } ?>
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

        </div>
        <input type="hidden"  class='category' value='<?php echo $this->uri->segment(3); ?>'/> 
        </p>
    </div>

    <div class='table-data'>
        <table id="vendor-table3" class="display" cellspacing="0" width="100%" >
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
                        <td class=""><span class="blue v-name word_break_down">
                                <a class="blue mail-id" href="<?php echo base_url(); ?>admin/vendor_details/<?php echo $value->id; ?>"><?php echo $value->name; ?></a>
                            </span>
                        </td>
                        <td class=""><?php echo $value->area_name; ?></td>
                        <td class="blue"><a vendor_id="<?php echo $value->business_id; ?>" href="" id="admin_delete_vendor" class="blue batch">Delete Vendor</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var base_url = "<?php echo base_url(); ?>";
  $('body').on('click', '#admin_delete_vendor', function () {
        var vendor_id = $(this).attr('vendor_id');
       if (confirm("Are you sure you want to delete this Vendor") === true)
        {

        $.ajax({
            url: '' + base_url + 'admin/delete_vendor',
            type: 'POST',
            data: {vendor_id: vendor_id},
            success: function (data) {
                window.location = '' + base_url + 'admin/vendors';
            }
        });
}
        return false;
    });

</script>

