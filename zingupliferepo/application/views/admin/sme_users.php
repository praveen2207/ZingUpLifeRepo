
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Sme Users</h3>
    <a class="new-user" href="<?php echo base_url(); ?>admin/sme_add_user">New Sme User</a>
</div>

<div class="row-fluid tr-row">

 <?php
    $error_message = $this->session->flashdata('sme_user_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>
    <div class="filter-section user-filter-section filter_admin_smeusers">
        <p class="filter-para">
            <label class="filter-label">Filter Info:</label>
            <input class="first-in" type="text" name="" id="search_backend_user" placeholder="User Name">
            <!--<select class="" name='role' id='user_role_select'>
                <option value=''>Select User Role</option>
                <?php foreach ($user_roles as $key => $value) { ?>
                    <option value='<?php echo $value->id; ?>'><?php echo $value->role; ?></option>
                <?php } ?> 

            </select>-->
        </p>
    </div>

    <table id="backend-user" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Sl No</th>
                <th class="filter-input">User Name</th>
                <th>Email ID</th>
				<th>Phone</th>
				<th>Ranking</th>
                <th class="filter-input">Actions</th>
            </tr>
        </thead>

        <tbody id='backend-user-filter'>
            <?php $i = 0; foreach ($all_users as $key => $value) { $i++; ?>
                <tr>
                    <td class="blue"><?php echo $i; ?></td>
                    <td class="blue word_break_down"><?php echo $value->first_name ?> <?php echo $value->last_name ?></td>
                    <td class="blue word_break_down"><a href="<?php echo base_url(); ?>admin/sme/user_details/<?php echo $value->sme_userid; ?>" class="blue v-name"><?php echo $value->username ?></a></td>
					<td class="blue word_break_down"><span class="blue v-name"><?php echo $value->phone; ?></span></td>
					<td class="blue word_break_down"><span class="blue v-name"><?php echo $value->ranking; ?></span></td>
                    <td>
                        <ul class="backend-actions">
                            <li><a class="blue" href="<?php echo base_url(); ?>admin/sme/edit_user_details/<?php echo $value->sme_userid; ?>">Edit</a></li>
                            <li>|</li>
                            <li><a class="blue delete_smeuser" href="" id="<?php echo $value->sme_userid; ?>">Delete</a></li>
							<?php if($value->status == 'enable') { ?>
								<li><a class="blue " href="<?php echo base_url(); ?>admin/sme/edit_user_status/<?php echo $value->sme_userid; ?>/disable">Disable</a></li>
							<?php } else {?>
								<li><a class="blue " href="<?php echo base_url(); ?>admin/sme/edit_user_status/<?php echo $value->sme_userid; ?>/enable">Enable</a></li>
							<?php } ?>
						</ul>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
