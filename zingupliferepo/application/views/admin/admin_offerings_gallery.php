<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Offerings Gallery</h3>
    <a href="<?php echo base_url(); ?>admin/add_offerings_gallery/<?php echo $id; ?>" class="new-user">Add New</a>
</div>

<div class="row-fluid tr-row">
    <div class='table-data'>
        <table id="vendor-table3" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="image_thumbnail_head">Image</th>
                    <th class="">Caption</th>
                    <th class="offering_name">Description</th>
                    <th class="">Offering Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class='searchcontent'>
                <?php foreach ($gallery as $key => $value) { ?>
                    <tr>
                        <td class="image_thumbnail">
                            <img src="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>" alt="<?php echo $service_gallery_path . $value->service_id . '/' . $value->images; ?>"/>
                        </td>
                        <td class=""><?php echo $value->caption; ?></td>
                        <td class=""><?php echo $value->description; ?></td>
                        <td class=""><?php echo $value->services; ?></td>
                        <td class="blue">
                            <a id="" href="<?php echo base_url(); ?>admin/edit_offering/" class="blue batch">Edit</a>
                            | <a id="" href="<?php echo $value->business_service_id; ?>" class="blue batch delete_vendor_offering">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
