
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Gallery</h3>
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
    <?php if (count($business_gallery) < 6) { ?>
        <div class="add_new"><a href="<?php echo base_url(); ?>cs/add_business_gallery/<?php echo $business_id; ?>">Add Gallery</a></div>
    <?php } ?>
    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">S.No</th>
                <th class="filter-input">Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="backend-user">
            <?php
            $a = 1;
            if ($business_gallery) {
                foreach ($business_gallery as $gallery) {
                    ?>

                    <tr>
                        <td class="blue"><?php echo $a++; ?></td>
                        <td class="blue"><img style="width:100px;height:40px;" src="<?php echo base_url(); ?>assets/uploads/business_providers/gallery/<?php echo $gallery->business_id; ?>/<?php echo $gallery->images; ?>" ></td> 
                        <td class="blue">

                            <ul class="backend-actions">
                                <li><a class="blue" href="<?php echo base_url(); ?>cs/business_gallery_edit/<?php echo $gallery->id; ?>">Edit</a></li>
                                <li>|</li>
                                <li><a class="blue" href="" id="business_gallery_delete" business_name ="<?php echo $gallery->images; ?>" business_id="<?php echo $gallery->business_id; ?>" gallery_id="<?php echo $gallery->id; ?>">Delete</a></li>
                            </ul>

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
