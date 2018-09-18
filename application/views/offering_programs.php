<?php if (!empty($offering_programs)) { ?>
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
        <?php if ($slug[0]->slug == 'spa' || $slug[0]->slug == 'ayurvedic_treatments') { ?>
            <?php if (isset($offering_programs['Packages'])) { ?>
                <h5 class="vendor-category">Packages</h5>

                <div class="row vendor-trt-row">
                    <?php
                    $count = 0;
                    $column_class = '';
                    $row_class = '';
                    $i = 1;
                    foreach ($offering_programs['Packages'] as $key => $value) {
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
                        <div class="<?php echo $row_class; ?> ">
                            <div class="span3 <?php echo $column_class; ?><?php if ($i % 2 == 0) { ?> even_row <?php } ?>">
                                <a class="trt-link" href="<?php echo base_url(); ?>offeringServices/<?php echo $value->id; ?>"><i class="fa fa-angle-right vendor-icon"></i><h5><?php echo $value->program; ?></h5></a>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($offering_programs['Offerings'])) { ?>
                <h5 class="vendor-category">Offerings</h5>

                <div class="row vendor-trt-row">
                    <?php
                    $count = 0;
                    $column_class = '';
                    $row_class = '';
                    $x = 1;
                    foreach ($offering_programs['Offerings'] as $key => $value) {
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
                        <div class="<?php echo $row_class; ?> ">
                            <div class="span3 <?php echo $column_class; ?><?php if ($x % 2 == 0) { ?> even_row <?php } ?>">
                                <a class="trt-link" href="<?php echo base_url(); ?>offeringServices/<?php echo $value->id; ?>"><i class="fa fa-angle-right vendor-icon"></i><h5><?php echo $value->program; ?></h5></a>
                            </div>
                        </div>
                        <?php
                        $x++;
                    }
                    ?>
                </div>

            <?php } ?>
        <?php } else { ?> 
            <div class="row vendor-trt-row">
                <h5 class="vendor-category">Sessions</h5>
                <?php
                $ocount = 0;
                $ocolumn_class = '';
                $orow_class = '';
                $x = 1;
                foreach ($offering_programs['Offerings'] as $key => $value) {
                    $ocount++;
                    $remainder = $ocount % 3;
                    if ($remainder == 0) {
                        $ocolumn_class = 'span-last';
                    } else {
                        $ocolumn_class = '';
                    }
                    if ($count > 3) {
                        $orow_class = 'span-sec row-class-left';
                    } else {
                        $orow_class = '';
                    }
                    ?>
                    <div class="<?php echo $orow_class; ?> ">
                        <div class="span3 <?php echo $ocolumn_class; ?><?php if ($x % 2 == 0) { ?> even_row <?php } ?>">
                            <a class="trt-link" href="<?php echo base_url(); ?>offeringServices/<?php echo $value->id; ?>"><i class="fa fa-angle-right vendor-icon"></i><h5><?php echo $value->program; ?></h5></a>
                        </div>
                    </div>
                    <?php
                    $x++;
                }
                ?>

                <?php
                $pcount = 0;
                $pcolumn_class = '';
                $prow_class = '';
                $i = 1;
                foreach ($offering_programs['Packages'] as $key => $value) {
                    $pcount++;
                    $remainder = $pcount % 3;
                    if ($remainder == 0) {
                        $pcolumn_class = 'span-last';
                    } else {
                        $pcolumn_class = '';
                    }
                    if ($count > 3) {
                        $prow_class = 'span-sec row-class-left';
                    } else {
                        $prow_class = '';
                    }
                    ?>
                    <div class="<?php echo $prow_class; ?> ">
                        <div class="span3 <?php echo $pcolumn_class; ?><?php if ($i % 2 == 0) { ?> even_row <?php } ?>">
                            <a class="trt-link" href="<?php echo base_url(); ?>offeringServices/<?php echo $value->id; ?>"><i class="fa fa-angle-right vendor-icon"></i><h5><?php echo $value->program; ?></h5></a>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>

        <?php } ?>
    <?php } else { ?>
        <div class="row con-row error-row"><p class="page-error">No Record Found</p><a href="<?php echo base_url(); ?>vendorDetails/<?php echo $business_provider_id; ?>" id="" class="back">Back</a></div>
    <?php } ?>
</div>







