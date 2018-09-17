<div class="container">
    <div class="loginBox reHeight" style='height:auto;overflow;hidden;'>
        <div class="log_head">
            <h3>EXPERTS Reset Password</h3>
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
								
								<br/>
								<form action='<?php echo base_url();?>experts/update_password' method='post' enctype="multipart/form-data"  style='clear:both;'>
								<div class="form-group">
									<span for="inputName" class="col-xs-3 col-sm-3 col-md-3 control-label">New Password</span>
									<div class="col-xs-8 col-sm-8 col-md-8">
										 <input type="password" name='password' value='' class="input input-xxlarge required form-control" >
									
									</div>
								</div>
								
								<div class="form-group">
									<span for="inputName" class="col-xs-3 col-sm-3 col-md-3 control-label">Confirm Password</span>
									<div class="col-xs-8 col-sm-8 col-md-8">
										 <input type="password" name='passconf' value='' class="input input-xxlarge required form-control" >
									
									</div>
								</div>
								<input type='hidden' name='random_key' value='<?php echo $string; ?>' />
								<input type="submit" class="btn zing-btn pull-left" value="Reset Password" name="submit">
                                </form>
                                 </div> 
            </div>
        </div>
    </div>
</div>