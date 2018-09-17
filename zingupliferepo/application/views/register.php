
<style>
.datepicker .datepicker-switch {
    width: 145px;
    color: blue ;
    text-decoration: underline;
}
.wbn-datepicker-wrapper .wbn-datepicker-controls input[type="text"].year {
    width: 32% !important;
    padding: 1px !important;
}
.wbn-datepicker-wrapper .wbn-datepicker-controls input[type="text"].month-label {
    width: 32% !important;
     padding: 1px !important;
}
.wbn-datepicker-wrapper .wbn-datepicker-controls input[type="text"] {
    
    width: 32% !important;
     padding: 1px !important;
    
}
.wbn-datepicker-controls{
width: 100% !important;
}

</style>


<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.js"></script>
<!-- css for daterangepicker  -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css	/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assessment/css/wbn-datepicker.css">
<div class="container">
    <div class="loginBox reHeight">
        <div class="log_head">
            <h3>SIGNUP</h3>
        </div>
        <div class="row log_parents">
            <div class="col-sm-12 col-md-12">
                
                    
                    <?php
                    if ($validation_message == 'validation_error') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Validation Failed!</span>  Please enter valid values for all the fields.
                        </div>
                    <?php } ?>
                    <?php
                    if ($validation_message == 'user_exist') {
                        ?>
                        <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span>Error!</span> user already exists with the same email-address .
                        </div>
                    <?php } ?>
                    <!--                    <form class="form-horizontal">-->
                    <form class="form-horizontal" name="register" id="register" action="<?php echo base_url(); ?>user_registration" method="post">  
                        <input type="hidden" name="register_type" value="user_registration"/>
                        <div class="form-group col-lg-10">
                            <span for="inputName" class="col-lg-3 control-label">Name :</span>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="inputName" placeholder="" name="name">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group col-lg-10">
                            <span for="inputName" class="col-lg-3 control-label genderText">Gender :</span>
                            <div class="col-lg-9 genderText01">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="Female">Female
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value='Male'>Male
                                </label>
                            </div>
                            <?php echo form_error('gender'); ?>
                        </div>
                        <div class="form-group col-lg-10">
                            <span for="inputPhone" class="col-lg-3 control-label">Phone :</span>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="inputPhone" placeholder="" name="phone">
                                <?php echo form_error('phone'); ?>
                            </div>
                        </div>
                      <div class="form-group col-lg-10">
                            <span for="inputPhone" class="col-lg-3 control-label">DOB :</span>
                            <div class="col-lg-9">
                            <?php  $date = date('Y-m-d', strtotime('-100 year', strtotime(date('Y-m-d'))));?>
                            <input type='text' class="form-control wbn-datepicker" id="dob" name="dob" data-min="<?php echo $date;?>" placeholder="Born On"/>
                            
                            </div>
                        </div>
                        
                        
                       
                        
                       	 <div class="form-group col-lg-10">      
                       	                           
                          	<span  class="col-lg-3 control-label">BMI :</span>                        
                            <div class="col-lg-3">                                                   
                                                                          
                                  <input type="number" name="height" id='height' placeholder="Height(cm)" class='form-control required height' >
                            </div>
                            <div class="col-lg-3">
                                                       
                                   <input type="number" name="weight" id='weight' placeholder="Weight(kg)" class='form-control required weight' >
                                                       
                            </div>
                            <div class="col-lg-3">
                                                       
                            		<input type="text" name="asse_bmi" placeholder="=> BMI" class='form-control required bmi' readonly>
                             </div>
                                                  
                          </div>
                        <div class="form-group col-lg-10">
                            <span for="inputEmail" class="col-lg-3 control-label">Email Id :</span>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" id="inputEmail" placeholder="" name="username">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <div class="form-group col-lg-10">
                            <span for="inputPassword" class="col-lg-3 control-label">Password :</span>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" id="inputPassword" placeholder="" name="password">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group col-lg-10">
                        	<span for="inputCheck" class="col-lg-3 control-label"></span>
                            <div class="col-lg-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="check" > I accept the <a class="colorGreen" href='<?php echo base_url();?>terms' target='_blank'>terms and conditions</a>
                                    </label>
                                    <?php echo form_error('check'); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <input type="submit" class="btn zing-btn reSingbtn pull-right" value="Sign Up" name="submit">
                                                   
                            </div>
                        
                        </div>
                        
                        <div class="form-group login_link_ctr col-lg-10">
                        <span for="inputCheck" class="col-lg-3 control-label"></span>
                            <div class="col-lg-9">
                                If you have already an account then click <a class="login_link" href="<?php echo base_url(); ?>login">here</a> to login
                            </div>
                        </div>
                    </form>

                </div> 
            
        </div>
    </div>
</div>

<?php $this->load->view('assessment/includes/register_footer'); ?>
