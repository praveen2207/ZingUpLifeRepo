
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">One day packages</h3>
</div>

<div class="row-fluid vd-row">
     
     <?php
    $error_message = $this->session->flashdata('one_day_package_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>   


    
    <div class="add_new"><a href="<?php echo base_url(); ?>admin/add_one_day_package/<?php echo $business_id; ?> ">Add New</a></div>
    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Package Name</th>
                <th class="filter-input">Service Name</th>
                <th class="filter-input">Duration</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="backend-user">
            <?php
            if ($one_day_packages) {
                foreach ($one_day_packages as $package) {
                    ?>

                    <tr>
                        <td class="blue"><?php echo $package->name; ?></td> 
                        <td class="blue"><?php echo $package->service_name; ?></td>
                        <td class="blue"><?php echo $package->duration; ?></td>
                        <td class="blue">
                            <ul class="backend-actions">
                                 <li><a class="blue" href="<?php echo base_url(); ?>admin/one_day_package_edit/<?php echo $package->id._.$package->service_id; ?>">Edit</a></li>
                                    <li>|</li>
                                 <li><a href="" class="blue" id="one_day_package_delete" package_id="<?php echo $package->id; ?>" >Delete</a></li>
                            </ul>  
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
            <td valign="top" class="" colspan="4" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            
<?php } ?>
        </tbody>
    </table>


</div>
