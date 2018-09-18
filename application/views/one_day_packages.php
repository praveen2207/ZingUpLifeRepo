<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>One day Packages</h1>
            </div>


            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul>
                                                <li><a href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_slots">Business Hours</a></li>                                                  
                                                <li><a class="active"href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <?php
                        $membership_added_message = $this->session->flashdata('membership_updated_message');
                        if (isset($membership_added_message)) {
                            ?>

                            <!--                            <div class="row-fluid pr-success">-->
                            <div class="message">
                                <h3 class="congratulations message-head">Congratulations !!!</h3>
                                <p class="para-small for-para"><?php echo $membership_added_message; ?></p>
                            </div>
                            <!--                            </div>-->
                        <?php } ?>
                        <div class="business-info" style="clear:both;">
                            <div class="add_new"><a class="button" href="<?php echo base_url(); ?>vendor/add_one_day_package">Add New</a></div>						 
                            <div class="clear"></div>
                            <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">


                                <thead>
                                    <tr>
                                        <th>Package Name</th>
                                        <th>Service Name</th>
                                        <th>Service Type</th>
                                        <th>Duration</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($one_day_packages as $service) {
                                    ?>

                                    <tr style="border:solid 1px #000;">
                                        <td style="border:solid 1px #000;"><?php echo $service->service_name; ?></td> 
                                        <td style="border:solid 1px #000;"><?php echo $service->name; ?></td> 
                                        <td style="border:solid 1px #000;">
                                            <?php
                                            if ($service->service_type == 'one_time') {
                                                $service_type = 'One Time';
                                            } elseif ($service->service_type == 'monthly') {
                                                $service_type = 'Monthly';
                                            } else {
                                                $service_type = 'Hourly';
                                            }

                                            echo $service_type;
                                            ?>
                                        </td> 
                                        <td style="border:solid 1px #000;"><?php echo $service->duration; ?> Hr</td> 
                                        <td style="border:solid 1px #000;">
<!--                                            <a class="terms_service" href="<?php echo base_url(); ?>vendor/business_service_edit/<?php echo $service->id; ?>"><strong>Edit</strong></a>
                                            /-->
                                            <a class="one_day_package_delete" id="<?php echo $service->id; ?>"><strong>Delete</strong></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>   

                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
   var base_url = "<?php echo base_url(); ?>";
    $('body').on('click', '.one_day_package_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these offering!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/delete_one_day_package',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;


    });
    
    
</script>
