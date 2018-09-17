<div class="container">
    <?php if (!empty($business_provider_details['details'])) { ?>
        <div class="location-header">
            <a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>">
                <img class="shatayu-logo" src="<?php
                if (isset($business_provider_details)) {
                    if ($business_provider_details['details']->logo != '') {
                        echo $logo_path . $business_provider_details['details']->business_id . '/' . $business_provider_details['details']->logo;
                    } else {
                        echo base_url() . 'assets/images/coming-soon-new.png';
                    }
                } else {
                    echo base_url() . 'assets/images/coming-soon.png';
                }
                ?>"/>
            </a>

            <h3 class="vendor-head"><a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_details['details']->id; ?>"><?php
                    if (isset($business_provider_details)) {
                        echo $business_provider_details['details']->name . '-' . $business_provider_details['details']->area_name;
                    }
                    ?></a></h3>
        </div>
    <?php } ?>
    <?php if (!empty($offering_services)) { ?>
        <h5 class="vendor-category">
            <?php echo $offering_services[0]->program;
            ?>
        </h5>

        <div class = "row vendor-trt-row">
            <?php
            $count = 0;
            $column_class = '';
            $row_class = '';
            $i = 1;
            foreach ($offering_services as $key => $value) {
                $count++;
                $remainder = $count % 3;
                if ($remainder == 0) {
                    $column_class = 'span-last';
                } else {
                    $column_class = '';
                }
                if ($count > 3) {
                    $row_class = 'span-sec row-class-left';
                } else {
                    $row_class = '';
                }
                ?>
                <div class="<?php echo $row_class; ?>">
                    <div class="span3 <?php echo $column_class; ?><?php if ($i % 2 == 0) { ?> even_row <?php } ?>">
                        <a class="trt-link " href="<?php echo base_url(); ?>offeringServiceDetails/<?php echo $value->business_service_id; ?>"><i class="fa fa-angle-right vendor-icon"></i><h5><?php echo $value->services; ?></h5></a>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div> </div>
<?php } else { ?>
    <div class="row con-row error-row"><p class="page-error">No Record Found</p><a href="<?php echo base_url(); ?>offeringPrograms/<?php echo $business_provider_details['details']->id; ?>" id="" class="back">Back</a></div>
<?php } ?>







