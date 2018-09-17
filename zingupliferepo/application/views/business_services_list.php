<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Business Service list</h1>
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
                        <?php
                        $membership_added_message = $this->session->flashdata('membership_added_message');
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
                            <div class="add_new"><a class="button" href="<?php echo base_url(); ?>vendor/packages_treatments">Add New</a></div>						 
                            <div class="clear"></div>
                            <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">


                                <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Service Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($services as $service) {
                                    foreach ($service as $s) {
                                        ?>

                                        <tr style="border:solid 1px #000;">
                                            <td style="border:solid 1px #000;"><?php echo $s->services; ?></td> 
                                            <td style="border:solid 1px #000;">
                                                <?php
                                                if ($s->service_type == 'one_time') {
                                                    $service_type = 'One Time';
                                                } elseif ($s->service_type == 'monthly') {
                                                    $service_type = 'Monthly';
                                                } else {
                                                    $service_type = 'Hourly';
                                                }

                                                echo $service_type;
                                                ?>
                                            </td> 
                                            <td style="border:solid 1px #000;"><a class="terms_service" href="<?php echo base_url(); ?>vendor/business_service_edit/<?php echo $s->service_id; ?>"><strong>Edit</strong></a>/<a class="service_delete" id="<?php echo $s->service_id; ?>" onclick="myFunction()"><strong>Delete</strong></a></td>
                                           <!-- <td style="border:solid 1px #000;cursor:pointer;" class="service_delete" id="<?php echo $s->id; ?>" onclick="myFunction()">Delete</td> -->
                                        </tr>
                                        <?php
                                    }
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
    $(document).ready(function () {
        $('#service_list_table').DataTable({
            "initComplete": function (settings) {
                $('#service_list_table_length label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'shows number of entries per page');
                });

                $('#service_list_table_filter label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'Filters the data in table');
                });
            }

        });
    });
</script>
