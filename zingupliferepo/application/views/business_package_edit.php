
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
                            <form class="form-horizontal for" name="service" method="post" action="<?php echo base_url(); ?>vendor/updating_business_program">
                                Service:<br/>
                                <select name="service" class="service_type">
                                    <option value="">Select</option>
                                    <?php foreach ($mapping as $key => $value) { ?>
                                        <option value="<?php echo $value->services_id; ?>" <?php if ($value->services_id == $packages['package']->service_id) { ?>selected <?php } ?>><?php echo $value->service_name; ?></option>
                                    <?php } ?>
                                </select><br><br>
                                Package/Treatment name:<br>
                                <input type="hidden" id = "package_id" name="service_id" size="5" value ="<?php echo $packages['package']->id; ?>"  />
                                <input type="text" name="package_name" class="package_name" size="5" value="<?php echo $packages['package']->program; ?>" style="float:none;"/><br>
                                Type:<br>
                                <select name="type" class="type">
                                    <option value="">Select</option>
                                    <option value="Offerings" <?php if ($packages['package']->type == 'Offerings') { ?>selected <?php } ?>>Offerings</option>
                                    <option value="Packages" <?php if ($packages['package']->type == 'Packages') { ?>selected <?php } ?>>Packages</option>
                                    <option value="Sessions" <?php if ($packages['package']->type == 'Sessions') { ?>selected <?php } ?>>Sessions</option>
                                </select><br><br>
                                <input type="submit" class="button" value="Save changes" /> 
                            </form> 



                        </div><br><br><br><br>
                        <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">


                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Service Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $services = $packages['service'];
                            foreach ($services as $s) {
                                ?>

                                <tr style="border:solid 1px #000;">
                                    <td style="border:solid 1px #000;"><?php echo $s->services; ?></td> 
                                    <td style="border:solid 1px #000;">
                                        <?php
                                        if ($s->service_type == 'both') {
                                            $service_type = 'Both';
                                        } elseif ($s->service_type == 'monthly') {
                                            $service_type = 'Monthly';
                                        } else {
                                            $service_type = 'Hourly';
                                        }

                                        echo $service_type;
                                        ?>
                                    </td> 
                                    <td style="border:solid 1px #000;"><a class="terms_service" href="<?php echo base_url(); ?>vendor/business_service_edit/<?php echo $s->id; ?>"><strong>Edit</strong></a>/<a class="service_delete" id="<?php echo $s->id; ?>" onclick="myFunction()"><strong>Delete</strong></a></td>
                                   <!-- <td style="border:solid 1px #000;cursor:pointer;" class="service_delete" id="<?php echo $s->id; ?>" onclick="myFunction()">Delete</td> -->
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


<script type="text/javascript">
    $(document).ready(function () {
        $('#package_service_list_table').DataTable({
            "initComplete": function (settings) {
                $('#package_service_list_table label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'shows number of entries per page');
                });

                $('#package_service_list_table').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'Filters the data in table');
                });
            }


        });



    });
</script>

