<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>dashboard"><span class="colorGreen">Dashboard&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>my_profile"><span  class="colorGreen">My Profile</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <span  class="colorGrey">Change Password</span>
    </div>
    <div class="userDas_box">
        <h4>MY PROFILE</h4>
        <div class="row">
            <div class="col-md-4 basic_Box">
                <div class="uplaodImg">
                    <?php if ($logged_in_user_data->image != '') { ?>
                        <img src="<?php echo $path . $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>" id="image_preview"></br>
                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>assets/new_design/image/profileBig.png" id="image_preview"></br>
                    <?php } ?>
                    <form class="upload_photo_form" method="post" action="<?php echo base_url(); ?>upload_user_image" enctype="multipart/form-data">
                        <label class="btn uploadBtn" for="upload-file-selector">
                            <input id="upload-file-selector" class="choose_file_class" type="file" name="image"/>Edit Photo
                        </label>

                        <input id="upload_photo_btn" type="submit" value="Upload" class="btn zing-btn"/>
                    </form>
                    <?php
                    $message1 = $this->session->flashdata('image_uploaded');
                    if (isset($message1)) {
                        ?>
                        <h4 class="colorGreen"><?php echo $message; ?></h4>
                    <?php } ?>
                </div>
                <div class="basic_Details" id="error_message_show">
                    <h4 class="txtHead">BASIC DETAILS</h4>
                    <a href="javascript:void(0);" class="btnProfile_Edit colorGreen pull-right editBS">Edit</a>
                    <a href="javascript:void(0);" class="btnProfile_Edit colorGreen pull-right save_btn01" id="update_profile_save">Save</a>
                </div>
                <div class="input_list">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>update_user_profile" id="update_profile_form">
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputEmail3" class="control-label">Full Name :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
                                <input type="text" class="form-control basic_Input name_field" id="inputEmail3" name="name" value="<?php echo $logged_in_user_data->name; ?>">
                                <span class="basic_Span"><?php echo $logged_in_user_data->name; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputPassword3" class="control-label">Age :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
                                <input type="text" class="form-control basic_Input age_field" id="inputPassword3" name="age" value="<?php echo $logged_in_user_data->age; ?>">
                                <span class="basic_Span"><?php echo $logged_in_user_data->age; ?> Years</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4  col-md-4">
                                <span for="inputEmail3" class="control-label">Email :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
                                <input type="email" class="form-control basic_Input" id="inputEmail3" value="<?php echo $logged_in_user_data->username; ?>" readonly>
                                <span class="basic_Span"><?php echo $logged_in_user_data->username; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputPassword3" class="control-label">Phone No. :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
                                <input type="text" class="form-control basic_Input phone_field" id="inputPassword3" value="<?php echo $logged_in_user_data->phone; ?>" name="phone">
                                <span class="basic_Span"><?php echo $logged_in_user_data->phone; ?></span></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputPassword3" class="control-label">Location :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput">
                                <input type="text" class="form-control basic_Input city_field" id="inputPassword3" value="<?php echo $logged_in_user_data->city; ?>" name="city">
                                <span class="basic_Span"><?php echo $logged_in_user_data->city; ?></span>
                            </div>
                        </div>
                    </form>	
                </div>
            </div>
            <div class="col-md-8">
                <div class="basic_Details change_password">
                    <h4 class="txtHead">CHANGE PASSWORD</h4>
                </div>
                <div class="col-sm-10 col-md-10 col-md-offset-1 changeResize">
                    <?php
                    if (isset($validation_error) && $validation_error != '') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-12 errorMessage reError successMessage1" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Failed!</span>  <?php echo $validation_error; ?>
                        </div>
                    <?php } ?>
                    <?php
                    $message = $this->session->flashdata('success_message');
                    if (isset($message)) {
                        ?>
                        <div class="alert  alert-dismissible col-xs-12 errorMessage reError successMessage successMessage1" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#10003</span></button>
                            <span>Success!</span>  Your password has been changed successfully.
                        </div>
                    <?php } ?>
                    <div class="successfully_box">
                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>update_password">
                            <div class="form-group">
                                <span class="col-xs-4 col-sm-4 col-md-4 control-label" for="inputNew">Old Password</span>
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <input type="password" name="old_password" id="inputNew" class="form-control" value="<?php echo $old_data['old_password']; ?>">
                                    <?php echo form_error('old_password'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-xs-4 col-sm-4 col-md-4 control-label" for="inputNew">New Password</span>
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <input type="password" name="new_password" id="inputNew" class="form-control"  value="<?php echo $old_data['new_password']; ?>">
                                    <?php echo form_error('new_password'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-xs-4 col-sm-4 col-md-4 control-label" for="inputConfirm">Confirm New Password</span> 
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <input type="password" name="confirm_password" id="inputConfirm" class="form-control"  value="<?php echo $old_data['confirm_password']; ?>">
                                    <?php echo form_error('confirm_password'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-8 col-md-offset-8 col-md-offset-4 col-xs-4 col-sm-4 col-md-8">
                                    <input type="submit" name="submit" value="Change" class="btn zing-btn pull-right"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>