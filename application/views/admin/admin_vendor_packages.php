<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Packages / Treatments</h3>
    <a href="<?php echo base_url(); ?>admin/add_new_package/<?php echo $vendor_id; ?>" class="new-user">Add New Package / Treatment</a>
</div>

<div class="row-fluid tr-row">
    <?php
    $success_message = $this->session->flashdata('success_message');
    if (isset($success_message)) {
        ?>
        <div class="message">
            <h3 class="congratulations message-head">Congratulations !!!</h3>
            <p class="para-small for-para" id="delete_message"><?php echo $success_message; ?></p>
        </div>
    <?php } ?>
    <div class='table-data'>
        <table id="vendor-table3" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="">Packages / Treatments</th>
                    <th class="">Type</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class='searchcontent'>
                <?php foreach ($all_packages as $key => $value) { ?>
                    <tr>
                        <td class=""><span class="blue v-name word_break_down">
                                <?php echo $value->program; ?>
                            </span>
                        </td>
                        <td class=""><?php echo $value->type; ?></td>
                        <td class="blue">
                            <a id="<?php echo $value->id; ?>" href="<?php echo base_url(); ?>admin/edit_package/<?php echo $value->id; ?>" class="blue batch">Edit</a>
                            | <a id="<?php echo $value->id; ?>" href="<?php echo $value->id; ?>" class="blue batch delete_vendor_package">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
