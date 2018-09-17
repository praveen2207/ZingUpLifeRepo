
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Service Gallery</h3>
</div>
<div class="row-fluid tr-row">


    <?php
    $error_message = $this->session->flashdata('gallery_adding_success_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?> 
    <?php if (count($business_service_gallery) < 6) { ?>
        <div class="add_new"><a href="<?php echo base_url(); ?>admin/add_business_service_gallery/<?php echo $service_id; ?>">Add Service Gallery</a></div>
    <?php } ?>
    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">S.No</th>
                <th class="filter-input">Caption</th>
                <th class="filter-input">Description</th>
                <th class="filter-input">Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="backend-user">
            <?php
            $a = 1;
            if ($business_service_gallery) {
                foreach ($business_service_gallery as $gallery) {
                    ?>

                    <tr>
                        <td class="blue"><?php echo $a++; ?></td>
                        <td class="blue"><?php echo $gallery->caption; ?></td>
                        <td class="blue"><?php echo $gallery->description; ?></td>
                        <td class="blue"><img style="width:100px;height:40px;" src="<?php echo base_url(); ?>assets/uploads/business_services/gallery/<?php echo $gallery->service_id; ?>/<?php echo $gallery->images; ?>" ></td> 
                        <td class="blue">

                            <ul class="backend-actions">
                                <li><a class="blue" href="<?php echo base_url(); ?>admin/business_service_gallery_edit/<?php echo $gallery->id; ?>">Edit</a></li>
                                <li>|</li>
                                <li><a class="blue" href="" id="business_service_gallery_delete" gallery_name ="<?php echo $gallery->images; ?>" service_id="<?php echo $gallery->id; ?>">Delete</a></li>
                            </ul>

                    </tr>
                <?php
                }
            } else {
                ?>
            <td valign="top" class="" colspan="5" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
<?php } ?>
        </tbody>
    </table>

</div>
