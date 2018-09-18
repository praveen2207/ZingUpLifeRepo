 <?php
                if (!empty($loggedInUserData)) {
                    if ($loggedInUserData->is_logged_in == 1) {
                        ?>
                        <a class="logout" href="<?php echo base_url(); ?>logout">Logout</a>
                        <br/><br/>
                        <?php
                    }
                }
                ?>
                <?php foreach ($businessProviders as $key => $value) { ?>
                    <div id="<?php echo $value->id; ?>">
                        <a href="<?php echo base_url() . 'offeringPrograms/' . $value->id; ?>"><?php echo $value->name; ?></a><br/>
                        <span><?php echo $value->street1 . ', ' . $value->area_name . '- ' . $value->zipcode; ?></span><br/>
                        <a href="<?php echo base_url() . 'providerDetails/' . $value->id; ?>">See Details</a><br/>
                    </div><br/><br/>
                <?php } ?>
            </div><br/><br/>
