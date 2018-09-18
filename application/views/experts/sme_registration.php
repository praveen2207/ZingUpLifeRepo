 <div class="container">
    <div class="loginBox reHeight" style='height:auto;overflow;hidden;'>
        <div class="log_head">
            <h3>EXPERTS SIGNUP</h3>
        </div>
        <div class="row log_parents">
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-7 col-md-7 input_sing new_sing">
                    <!--<span class="log_circle">OR</span>-->
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
                   <form class='sme_register' action='<?php echo base_url();?>experts/register' method='post' enctype="multipart/form-data" name="register" id="register"/> 
                     <!-- <form class='sme_register' action='<?php echo base_url();?>experts/register' method='post' enctype="multipart/form-data" name="register" id="register"/>-->
                        <input type="hidden" name="register_type" value="user_registration"/>
                       
                        <div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label">Title :</span>
                           <div class="col-xs-8 col-sm-8 col-md-8">
                                <select id="title" name="title" class="required form-control">  
                                              
                                            <option value="">Select</option>
                                            <option value="Mr.">Mr.</option>  
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Ms.">Ms.</option>
                                            <option value="Dr.">Dr.</option>
                                            <option value="Dt.">Dt.</option>  
                                        </select>
                                        <script type="text/javascript">
										 	 document.getElementById('title').value = "<?php echo set_value('title');?>";
										</script>
                                        
                                        <span style="color:red"> <?php  echo form_error('title'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label">Name :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                 <input type="text" name='name' value='<?php echo set_value('name'); ?>' class="input input-xxlarge required form-control" >
                                
                                 <span style="color:red"> <?php  echo form_error('name'); ?></span> 
                            </div>
                        </div>
											
						<div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label genderText">Gender :</span>
                            <div class="col-xs-7 col-sm-8 col-md-8 genderText01">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == female) ? "checked" : "";?>>Female
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == male) ? "checked" : "";?>>Male
                                </label>
                            	<span style="color:red"> <?php  echo form_error('gender'); ?></span>
                            </div> 
                        </div>
                        
                     <?php echo set_value('gender'); ?>
						<div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label">Email :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <input type="email" name='email' value='<?php echo set_value('email'); ?>' class="input input-xxlarge required form-control" >
                                <span style="color:red"> <?php  echo form_error('email'); ?></span> 
                            </div>
                        </div>
                        
						<div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label">Password :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                 <input type="password" name='password' value='<?php echo set_value('password'); ?>' class="input input-xxlarge required form-control" >
                                <span style="color:red"> <?php  echo form_error('password'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label">Re-enter Password :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                 <input type="password" name='cpassword' value='<?php echo set_value('cpassword'); ?>' class="input input-xxlarge required form-control" >
                                <span style="color:red"> <?php  echo form_error('password'); ?></span> 
                            </div>
                        </div>
						
						
						
						<div class="form-group">
                            <span for="inputName" class="col-xs-4 col-sm-4 col-md-4 control-label">Service :</span>
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <select id="select01" name="service" class="required main-service form-control">  
                                            <option value="">Specialty</option> 
											<?php //foreach($services as $service) {?>										
												<!--<option value="<?php echo $service->id;?>"><?php echo $service->service_name;?></option> -->
												<option value="1">MIND BODY INTERVENTIONS</option> 
																					
												<option value="2">INTEGRATIVE HEALTH & MEDICINE</option> 
																					
												<option value="3">YOGA</option> 
																					
												<option value="4">PHYSICAL & NUTRITIONAL</option> 
											<?php //} ?>
                                    </select>
                                     <script type="text/javascript">
										 	 document.getElementById('select01').value = "<?php echo set_value('service');?>";
										</script>
                                <span style="color:red"> <?php  echo form_error('service'); ?></span> 
                            </div>
                        </div>
					
                        <div class="form-group">
                            
                            <div class="col-xs-8 col-sm-8 col-md-8">
                          		<input type="submit" class="btn zing-btn pull-right reSingbtn" value="Sign Up" name="submit">
                          	</div>
                        </div>
				     	  
                         
                    
                    </form>

                </div> 
               
            </div>
        </div>
    </div>
</div>
