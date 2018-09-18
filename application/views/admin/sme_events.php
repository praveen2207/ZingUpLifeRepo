<div class="location-header admin-header">
    <h3 class="redirect-head admin-head user-head">Sme Events</h3>
    <a class="new-user" href="<?php echo base_url(); ?>admin/sme_add_event">New Event</a>
</div>

<div class="row-fluid tr-row">
 <?php
    $error_message = $this->session->flashdata('sme_event_message');
    if ($error_message) {
        ?>
        <div class="row-fluid pr-success">


            <div class="message pr-message">

                <h3 class="congratulations message-head">Congratulations!</h3>

                <p class="para-small for-para"><?php echo $error_message; ?></p>

            </div>
        </div>    
    <?php } ?>
    <div class="filter-section user-filter-section filter_admin_smeevent">
        <p class="filter-para">
            <label class="filter-label">Filter Info:</label>
            <input class="first-in" type="text" name="" id="search_backend_user" placeholder="Event Title">
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
                <th class="filter-input">Event ID</th>
                <th class="filter-input">SME User Name</th>
                <th>Title</th>
                <th>Location</th>
                <th>Date</th>
               
                <th class="filter-input">Actions</th>
            </tr>
        </thead>

        <tbody id='backend-user-filter'>
            <?php foreach ($all_events as $key => $value) { ?>
                <tr>
                    <td class="blue"><?php echo $value->id ?></td>
                    <td class="blue word_break_down"><?php echo $value->first_name ?> <?php echo $value->last_name ?></td>
                    <td class="blue"><a href="<?php echo base_url(); ?>admin/sme/event_details/<?php echo $value->id; ?>" class="blue v-name"><?php echo $value->title ?></a></td>
                    <td class="blue"><?php echo $value->location ?></td>
                    <td class="blue"><?php echo date('m-d-Y',strtotime($value->date)); ?></td>
                    
                    <td>
                        <ul class="backend-actions">
                            <li><a class="blue" href="<?php echo base_url(); ?>admin/sme/edit_event_details/<?php echo $value->id; ?>">Edit</a></li>
                            <li>|</li>
                            <li><a class="blue delete_smeevent" href="" id="<?php echo $value->id; ?>">Delete</a></li>
                        </ul>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
