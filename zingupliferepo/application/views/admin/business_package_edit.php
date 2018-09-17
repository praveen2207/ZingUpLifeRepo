<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Packages &amp; Treatments</h3>
</div>

<div class="row-fluid vd-row">
    <?php
    $error_message = $this->session->flashdata('business_program_success_message');
    if ($error_message) {
        ?>

        <p class="error_validate_msg para-small for-para"><?php echo $error_message; ?></p>


    <?php } ?>

    <form class="form-horizontal partner1 infob1for" name="service" method="post" action="<?php echo base_url(); ?>customer_support/updating_business_program">  
        <fieldset>
            <div class="clear">



                <div class="edit-group3">          

                    <label class="control-label" for="e-name"> Package/Treatment name</label>  
                    <div class="customer-edit-input">
                        <input type="hidden" id = "package_id" name="service_id" size="5" value ="<?php echo $packages['package']->id; ?>"  />
                        <input type="text" class="input input-xxlarge required e-input valid package_name" name="package_name" value="<?php echo $packages['package']->program; ?>">

                    </div> 
                </div>


                <div class="controls1 ctr3 mrg">
                    <input type="submit" name="submit" id="submit" value="Update" class="primary-button">
                </div> 
        </fieldset>
    </form>

    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Service Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="package_service_list_table">
            <?php
            if ($packages['service']) {
                foreach ($packages['service'] as $service) {
                    ?>

                    <tr style="border:solid 1px #000;">
                        <td style="border:solid 1px #000;"><?php echo $service->services; ?></td> 
                        <td style="border:solid 1px #000;"><a class="terms_service" href="<?php echo base_url(); ?>customer_support/business_service_edit/<?php echo $service->id; ?>"><strong>Edit</strong></a>/<a class="service_delete" id="<?php echo $service->id; ?>" onclick="myFunction()"><strong>Delete</strong></a></td>

                    </tr>
                <?php
                }
            } else {
                ?>
            <td valign="top" class="" colspan="2" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
<?php } ?>
        </tbody>
    </table>

</div>
</div>