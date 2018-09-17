<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Edit Business Service Memberships</h1>
            </div>


            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >

                        <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>    
                        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/multiple_uploads_style.css" />
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul>
                                                <li><a href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_slots">Business Hours</a></li>                                                  
                                              <li><a href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <div class="business-info" style="clear:both;">
                            <form class="form-horizontal for" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/update_offerings_memberships">
                                <label> Service:</label>
                                <input type="hidden" id = "service_id" name="id" size="5" value ="<?php echo $membership->id; ?>"  />
                                <input type="hidden" id = "service_id" name="business_service_id" size="5" value ="<?php echo $service_id; ?>"  />
                                <input type="text" name="service_name" class="service_name" value="<?php echo $services['details']->services; ?>" readonly/><br>
                                <label> Membership name:</label>
                                <input type="text" name="membership" class="" value="<?php echo $membership->membership; ?>"/>
                                <?php echo form_error('membership'); ?><br>
                                <label> Description:</label>
                                <textarea name="description" id=""><?php echo $membership->description; ?></textarea><br><br>
                                <label>Duration:</label>
                                <select name="duration">
                                    <option value="">Please Select</option>
                                    <option value="1 Day" <?php if ($membership->duration == '1 Day') { ?> selected <?php } ?>>1 Day</option>
                                    <option value="7 Days" <?php if ($membership->duration == '7 Days') { ?> selected <?php } ?>>7 Days</option>
                                    <option value="15 Days" <?php if ($membership->duration == '15 Days') { ?> selected <?php } ?>>15 Days</option>
                                    <option value="1 Month" <?php if ($membership->duration == '1 Month') { ?> selected <?php } ?>>1 Month</option>
                                    <option value="3 Months" <?php if ($membership->duration == '3 Months') { ?> selected <?php } ?>>3 Months</option>
                                    <option value="6 Months" <?php if ($membership->duration == '6 Months') { ?> selected <?php } ?>>6 Months</option>
                                    <option value="1 Year" <?php if ($membership->duration == '1 Year') { ?> selected <?php } ?>>1 Year</option>
                                </select><br/>
<!--                                <input type="text" name="duration" class=""/>-->
                                <?php echo form_error('duration'); ?><br>
                                <label> Price:</label>
                                <input type="text" name="fees" class="" value="<?php echo $membership->fees; ?>"/>
                                <?php echo form_error('fees'); ?><br>
                                <label>Maximum Number Of Members:</label>
                                <input type="text" name="max_number_of_members" class="" value="<?php echo $membership->max_number_of_members; ?>"/>
                                <?php echo form_error('max_number_of_members'); ?><br>
                                <input type="submit" class="button" value="Save changes" /> 
                            </form> 

                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('body').on('click', '.service_slots_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these slots!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/service_slots_delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    location.reload();

                }
            });
        }
        return false;


    });

</script>