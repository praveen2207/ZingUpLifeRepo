<style>
#register_form input, #register_form textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 5px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 12px !important;
}    
#login_form input, #login_form textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 5px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 12px !important;
}    
.help-block{
    color:red;
    font-style: italic;
} 
.radio-align{
margin-left:-120;
}
</style>
<section class="assesment hidden-sm hidden-xs" style="margin:0 auto; background: url(<?php echo $web_banner;?>) no-repeat center center; background-size: cover;">
    <h5 class="text-center" style='padding-top: 75px;color: #3fab3a;font-size: 28px;font-weight: bold; text-transform: uppercase;'><?php echo $theme_name;?>  <!--<p><button id="quick_demo">Loading...</button></p>--></h5>
</section>


<section class="assesment hidden-md hidden-lg" style="margin:0 auto; background: url(<?php echo $mobile_web_banner;?>) no-repeat center center; background-size: cover;margin-top: -8px;">
    <h5 class="text-center" style='padding-top: 75px;color: #3fab3a;font-size: 28px;font-weight: bold; text-transform: uppercase;'><?php echo $theme_name;?>  <!--<p><button id="quick_demo">Loading...</button></p>--></h5>
</section>



<section class="bg2">
    <div class="container" style="height: 850px;">
        <div>
        	<div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-4 col-lg-offset-1 col-md-6" style="padding:0px;">
                    <div class="col-lg-12" style='min-height:400px'>
    <div class="main-content col-sm-12" style="min-height: 600px; height: auto;position: absolute;">
    <div style="display:block;" class="register_division">    
                            <div class="col-md-12" style="text-align:center;"></div> 
                            <form name="register_form" id="register_form" action="" data-toggle="validator" method="post" class='validation' novalidate='novalidate'>
                                    <input type="hidden" name="session_id" id="session_id" value="<?php echo session_id();?>"/>
                                    <input type="hidden" name="theme_id" id="theme_id" value="<?php echo $theme_id;?>"/>
                                    <input type="hidden" name="level_id" id="level_id" value="<?php echo $level_id;?>"/>
                                            <div class="col-md-12">
                                                    <div class="col-md-12">
                                                    <h4>Welcome. Please share your details</h4>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                                    <!--  <label for="name">Name:</label>-->
                                                            <input type="text" id="name" name="name" placeholder="What we should call you?" class='required alpha' >
                                                            </div>
                                                    </div>
                                                           <div class="col-md-12">
								<div class="form-group" ><label for='gender' style='height: 30px;padding-top: 0px;margin-right: 12%;'>Gender</label>

								Male<input type="radio" style='width: 9%;' name="gender" value='male' class='required'>

								Female<input type="radio" style='width: 9%;' name="gender" value='female' class='required'>

								<label for="gender" class="error" style="display:none;">Please choose atleast one.</label>
								</div>
                                                    </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                            <!--<input type='text' class="required" id="datepicker" name="dob" placeholder="Born On"/>-->				    
							<label>Date of birth</label>
							<?php  $mindate = date('Y-m-d', strtotime('-100 year', strtotime(date('Y-01-t'))));?>
							<?php  $maxdate = date('Y-m-d', strtotime('-18 year', strtotime(date('Y-12-t'))));?>
							<input type="text" id="dob" name="dob" data-min="<?php echo $mindate;?>" data-max="<?php echo $maxdate;?>" class="wbn-datepicker"/>
							<label for="day" class="error" style="display: none;">This field is required.</label>
                                                        </div>
                                                    </div>

                                                            <!--<div class="col-md-12">
                                                       <div class="form-group">
                                                                           <label for="name">Password:</label>
                                                           <input type="date" name="dob" maxlength='10' minlength='10' placeholder='Born On' class='required'>
                                                       </div>
                                                   </div>-->
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                            <!--                               <label for="name">Password:</label>-->
                                                           <input type="number" name="height" id='height' placeholder="Height in cms" class='required height' >
                                                       </div>
                                                   </div>
                                                   <div style="clear:both;"></div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                            <!--                               <label for="name">Password:</label>-->
                                                           <input type="number" name="weight" id='weight' placeholder="Weight in kg" class='required weight' >
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                            <!--                               <label for="name">Password:</label>-->
                                                           <input type="text" name="asse_bmi" placeholder="BMI" class='required bmi' readonly>
                                                       </div>
                                                   </div>
                                                   <?php if($switch_flag){?>
                                                   	<div class="col-md-12">
                                                       <div class="form-group">
                                                                           <label for="alert">Enter Access Code</label>
                                                           <input type="text" name="org_access_code" placeholder="Access Code (for corporate employees only)" class="<?php if($this->input->cookie("org_assessment")){?>required<?php } ?>">
                                                           <label for="org_access_code_error" class="org_access_code_error" style="display: none;color:#BF3429;font-weight:normal;font-size:15px;">Your organisation access code is not matched.</label>
                                                       </div>
                                                   	</div>
                                                   	<div class="col-md-12">
                                                       <div class="form-group">
                                                           <input type="text" name="job_location" placeholder="Job Location" class="<?php if($this->input->cookie("org_assessment")){?>required<?php } ?>">
                                                           <label for="job_location_error" class="job_location_error required" style="display: none;color:#BF3429;font-weight:normal;font-size:15px;">job location is not correct</label>
                                                       </div>
                                                   	</div>
                                                   	<div class="col-md-12">
                                                       <div class="form-group">
                                                           <input type="text" name="job_role" placeholder="Job Role" class="<?php if($this->input->cookie("org_assessment")){?>required<?php } ?>">
                                                           <label for="job_role_error" class="job_role_error required" style="display: none;color:#BF3429;font-weight:normal;font-size:15px;">job role is incorrect</label>
                                                       </div>
                                                   	</div>
                                                   <?php } ?>
                                                   
                                                   <div class="col-lg-12">
                                                        <div class="box-footer" style='text-align:right;'>
                                                            <button type="button" class="btn btn-success" id="btn_save" name="btn_save" value="Next" onclick="basic_user_detail();">NEXT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                    </div>
                    </div>
                    </div>
                </div>
          </div>
	</div>
</section>


<!-- semi footer -->