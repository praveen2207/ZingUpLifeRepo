<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Backend Users</h3>
    <a class="new-user" href="<?php echo base_url(); ?>admin/add_user">New User</a>
</div>

<div class="row-fluid tr-row">
    <div class="filter-section user-filter-section filter_admin_users">
        <p class="filter-para">
            <label class="filter-label">Filter Info:</label>
            <input class="first-in" type="text" name="" id="search_backend_user" placeholder="User Name">
            <select class="" name='role' id='user_role_select'>
                <option value=''>Select User Role</option>
                <?php foreach ($user_roles as $key => $value) { ?>
                    <option value='<?php echo $value->id; ?>'><?php echo $value->role; ?></option>
                <?php } ?> 

            </select>
        </p>
    </div>

    <table id="backend-user" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">User ID</th>
                <th class="filter-input">User Name</th>
                <th>Email ID</th>
                <th>User Role</th>
                <th class="filter-input">Actions</th>
            </tr>
        </thead>

        <tbody id='backend-user-filter'>
            <?php foreach ($all_users as $key => $value) { ?>
                <tr>
                    <td class="blue"><?php echo $value->id ?></td>
                    <td class="blue word_break_down"><?php echo $value->name ?></td>
                    <td class="blue word_break_down"><a href="<?php echo base_url(); ?>admin/user_details/<?php echo $value->id; ?>" class="blue v-name"><?php echo $value->username ?></a></td>
                    <td class="blue word_break_down"><span class="blue v-name"><?php echo $value->user_role ?></span></td>
                    <td>
                        <ul class="backend-actions">
                            <li><a class="blue" href="<?php echo base_url(); ?>admin/edit_user_details/<?php echo $value->id; ?>">Edit</a></li>
                            <li>|</li>
                            <li><a class="blue delete_user" href="" id="<?php echo $value->id; ?>">Delete</a></li>
                        </ul>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
