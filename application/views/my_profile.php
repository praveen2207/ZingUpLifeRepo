<style>
	
	.display{
	display:table;
	}
	.update_button{
		width: 80px;
	    height: 30px;
	    border-radius: 5px;
	    background-color: #0a3b9c;
	    border: 0px;
	    color: white;
	}
	.cancel_button{
		width: 80px;
	    height: 30px;
	    border-radius: 5px;
	    border: 0px;
	    background-color: #0a3b9c;
	    color: white;
	}
	.rederror{
		color: #bf3429;
		font-size:15px;
	}

</style>


<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>dashboard"><span class="colorGreen">Dashboard&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <span  class="colorGrey">My Profile</span>
    </div>
    <div class="userDas_box">
    <?php $error = $this->session->flashdata('errors');
     if(isset($error)){?>
    <div style=color:green;font-size:20px;>Congratulation</div>
    <div style=color:green;font-size:16px;>your profile has been changed!!</div>
    <?php }?>
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
                    $message = $this->session->flashdata('image_uploaded');
                    if (isset($message)) {
                        ?>
                        <h4 class="colorGreen"><?php echo $message; ?></h4>
                    <?php } ?>
                </div>
                <div class="basic_Details" id="error_message_show">
                    <h4 class="txtHead">BASIC DETAILS</h4>
                    <a href="javascript:void(0);" class="btnProfile_Edit colorGreen pull-right editBS edit001">Edit</a>
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
                                <input type="email" class="form-control basic_Input email_field" id="inputEmail3" value="<?php echo $logged_in_user_data->username; ?>" readonly>
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
               	
               	<div class="edit_user_profile">
              		<form class="form-horizontal validation" method="post" action="<?php echo base_url(); ?>update_user_profile" id="update_user_profile">
                        <div class="form-group"></div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputName" class="control-label" style='margin-left:20px;'>Full Name :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput" style='width:250px;'>
                                <input type="text" class="form-control required alpha basic_Input name_field " id="name" name="name" value="<?php echo $logged_in_user_data->name; ?>">
                            </div>
                        </div>
                       	<div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputAge" class="control-label" style='margin-left:20px;'>Age :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput" style='width:250px;'>
                                <input type="text" class="form-control required digits basic_Input age_field" id="age" name="age" value="<?php echo $logged_in_user_data->age; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4  col-md-4">
                                <span for="inputEmail" class="control-label" style='margin-left:20px;'>Email :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput" style='width:250px;'>
                                <input type="email" class="form-control required basic_Input email_field" id="email" name="email" value="<?php echo $logged_in_user_data->username; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputPhone" class="control-label" style='margin-left:20px;'>Phone No. :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput" style='width:250px;'>
                                <input type="text" class="form-control required number basic_Input phone_field" id="phone" maxlength='10' value="<?php echo $logged_in_user_data->phone; ?>" name="phone">
                                <div class='phonerror rederror' style='display:none'>Please enter atleast 10 digit for phone number.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <span for="inputLocation" class="control-label" style='margin-left:20px;'>Location :</span>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 dasInput" style='width:250px;'>
                                <input type="text" class="form-control required basic_Input city_field" id="city" value="<?php echo $logged_in_user_data->city; ?>" name="city">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4" style='margin-left:20px;'>
                                <input type="submit" class="user_profile_update update_button" value='Update' id="submit" name="submit">
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8" style='width:200px;'>
                                <input type="reset" class="cancel_button" id="cancel" value="cancel" name="cancel">
                            </div>
                        </div>
                   </form>	
                 </div>  
       		</div>
           	
           	<div class="col-md-8">
                <div class="comment_Box">
                    <h4 class="colorGreen"><?php echo $logged_in_user_data->name; ?></h4>
                    <!--                    <a href="javascript:void(0);" class="textarea_Edit colorGreen pull-right edit0001">Edit</a>
                                        <a href="javascript:void(0);" class="textarea_Edit colorGreen pull-right save_btn0001">Save</a>-->
                    <ul>
                        <li><?php echo $logged_in_user_data->age; ?> Years</li>
                        <li><?php echo $logged_in_user_data->gender; ?></li>
                        <li><?php echo $logged_in_user_data->city; ?></li>
                    </ul>
<!--                    <textarea rows="4" cols="50" class="textarea_info"></textarea>-->
<!--                    <p class="textarea_info01"> </p>-->
                </div>


                <div class="basic_Details subscription_ctr">
                    <h4 class="txtHead">SUBSCRIPTIONS</h4>
<!--                    <a href="<?php echo base_url(); ?>" class="Subscriptions_Edit colorGreen pull-right edit001">Edit</a>
                    <a href="javascript:void(0);" class="Subscriptions_Edit colorGreen pull-right save_btn001">Save</a>-->
                </div>
                <?php
                foreach ($memberships as $key => $value) {
                    $count = count($memberships);
                    if ($count == ($key + 1)) {
                        $custom_class = 'subscription_sub_ctr1';
                    } else {
                        $custom_class = '';
                    }
                    ?>
                    <div class="input_list subInput subscription_sub_ctr <?php echo $custom_class; ?>">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <span for="inputEmail3" class="control-label">Subscription Plan :</span>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-6 dasInput01">
    <!--                                <input type="text" class="form-control basic_Input01" id="inputEmail3" placeholder="">-->
                                    <span class="basic_Span01"><?php echo $value['details']->membership; ?></span>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 dasInput01">
    <!--                                <input type="text" class="form-control basic_Input01" id="inputEmail3" placeholder="">-->
                                    <a href="" class="colorGreen pull-right"><span class="basic_Span01">Edit</span></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <span for="inputEmail3" class="control-label">Subscription Place :</span>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-6 dasInput01">
    <!--                                <input type="text" class="form-control basic_Input01" id="inputEmail3" placeholder="">-->
                                    <span class="basic_Span01"><?php echo $value['vendor_details']->area_name . ', ' . $value['vendor_details']->city; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <span for="inputPassword3" class="control-label">Subscription Period :</span>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-6 dasInput01">
    <!--                                <input type="text" class="form-control basic_Input01" id="inputPassword3" placeholder="">-->
                                    <span class="basic_Span01"><?php echo date('d/m/Y', strtotime($value['details']->membership_start_date)); ?> - <?php echo date('d/m/Y', strtotime($value['details']->membership_end_date)); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <span for="inputEmail3" class="control-label">Subscription Renewal :</span>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-6 dasInput01">
    <!--                                <input type="email" class="form-control basic_Input01" id="inputEmail3" placeholder="">-->
                                    <span class="basic_Span01">Manual</span>
                                </div>

                            </div>
                        </form>
                    </div>
                <?php } ?>

                <div class="basic_Details">
                    <a href="<?php echo base_url(); ?>change_password" class="colorGreen">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>