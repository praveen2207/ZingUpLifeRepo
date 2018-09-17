<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">User Roles</h3>
<!--    <a class="new-user" href="new-role.html">New Role</a>-->
</div>

<div class="row-fluid tr-row">
    <table id="user-role" class="display finance-vendor" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Prefix</th>
                <th>User Role</th>
                <!--<th class="filter-input">Actions</th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_roles as $key => $value) { ?>
                <tr>
                    <td class=""><?php echo $value->prefix; ?></td>
                    <td class=""><?php echo $value->role; ?></td>
                   <!-- <td>
                        <ul class="backend-actions">
                            <li><a class="blue" href="<?php echo $value->id; ?>">Edit</a></li>
                            <li>|</li>
                            <li><a class="blue delete_user_role" id="<?php echo $value->id; ?>" href="">Delete</a></li>
                        </ul>
                    </td>-->
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>