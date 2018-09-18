   
<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Packages &amp; Treatments</h1>
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
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
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
                            <div class="add_new"><a class="button" href="<?php echo base_url(); ?>vendor/packages_treatments">Add New</a></div>						 
                            <div class="clear"></div>
                            <table id ="package_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th>Package/Treatment Name</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php foreach ($packages as $package) {
                                    ?>

                                    <tr style="border:solid 1px #000;">
                                        <td style="border:solid 1px #000;"><?php echo $package->program; ?></td> 
                                         <td style="border:solid 1px #000;"><?php echo $package->type; ?></td> 
                                        <td style="border:solid 1px #000;"><a class="terms_service" href="<?php echo base_url(); ?>vendor/business_package_edit/<?php echo $package->id; ?>"><strong>Edit</strong></a>/<a class="package_delete" id="<?php echo $package->id; ?>" ><strong>Delete</strong></a></td>
                                                   <!-- <td style="border:solid 1px #000;cursor:pointer;" class="package_delete" id="<?php echo $package->id; ?>">Delete</td> -->
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#package_list_table').DataTable({
            "initComplete": function (settings) {
                $('#package_list_table_length label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'shows number of entries per page');
                });

                $('#package_list_table_filter label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'Filters the data in table');
                });
            }


        });



    });
</script>
