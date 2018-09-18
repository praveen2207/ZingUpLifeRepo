
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Packages &amp; Treatments</h3>
</div>

<div class="row-fluid vd-row">
     
     <?php
    $error_message = $this->session->flashdata('business_service_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>   


    
    <div class="add_new"><a href="<?php echo base_url(); ?>cs/adding_package_service/<?php echo $business_id; ?> ">Add New</a></div>
    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Package/Treatment Name</th>
                <th class="filter-input">Type</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="backend-user">
            <?php
            if ($packages) {
                foreach ($packages as $package) {
                    ?>

                    <tr>
                        <td class="blue"><?php echo $package->program; ?></td> 
                        <td class="blue"><?php echo $package->type; ?></td>
                        <td class="blue">
                            <ul class="backend-actions">
                                <li><a class="blue" href="<?php echo base_url(); ?>cs/business_package_edit/<?php echo $package->id; ?>">Edit</a></li>
                                <li>|</li>
                                <li><a href="" class="blue package_delete" id="<?php echo $package->id; ?>" >Delete</a></li>
                            </ul>  
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
            <td valign="top" class="" colspan="3" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
<?php } ?>
        </tbody>
    </table>


</div>
