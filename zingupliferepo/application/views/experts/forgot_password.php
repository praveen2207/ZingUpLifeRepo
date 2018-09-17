<div class="container">
    <div class="loginBox reHeight" style='height:auto;overflow:hidden;'>
        <div class="log_head">
            <h3>EXPERTS Forgot Password</h3>
        </div>
        <div class="row log_parents">
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-7 col-md-7 input_sing" style='border:none;margin:0px 250px;'>
       
                                <?php if(validation_errors()) { ?>
								 <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<span>Validation Failed!</span>  <?php echo validation_errors();?>
								</div>
							<?php } ?>
								 <?php if(isset($errors)) {
                            if($errors == 'Please check your email to reset the password'){                         
                                    $messge_class = "successMessage";
                                }else{
                                    $messge_class = "errorMessage";
                                }
                            ?>
									 <div class="alert  alert-dismissible col-xs-11 <?php echo $messge_class;?> reError" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									 <?php  echo $errors;?>
								</div>
									<?php } ?>
								<br/>
								<form action='<?php echo base_url();?>experts/send_mail' method='post' enctype="multipart/form-data"  style='clear:both;'/>
								<div class="form-group">
									<span for="inputName" class="col-xs-3 col-sm-3 col-md-3 control-label">Email ID</span>
									<div class="col-xs-8 col-sm-8 col-md-8">
										 <input type="email" name='email' value='<?php echo set_value('name'); ?>' class="input input-xxlarge required form-control" >
										<?php echo form_error('name'); ?>
									</div>
								</div>
								<input type="submit" class="btn zing-btn pull-left" value="Send Email" name="submit">
                                </form>
                                 </div> 
            </div>
        </div>
    </div>
</div>