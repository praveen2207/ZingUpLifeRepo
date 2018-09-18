<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">
        	
            
    		<div class="content-inner">
    			<div class="row">
                	
                    <div class="col-xs-12 full-page" >                    
                    	<div class="sme-home-page">
                        	<div class="sme-header">
                            	<img src="<?php echo base_url(); ?>images/header-img.jpg" alt="" />
                            </div>
                            <div class="page-head center">
                            	<h1>SME Register</h1>
                            </div>
							<?php //echo validation_errors(); ?>
                            <div class="register-content">
                        	<div class="row">
                        	<div class="login-form col-xs-4 mar-auto">
                            	<form class='sme_register' action='<?php echo base_url();?>sme/register' method='post' enctype="multipart/form-data" name="register" id="register"/>
                                	<label>Name</label>
                                    <input type="text" name='name' value='<?php echo set_value('name'); ?>' class="input input-xxlarge required" >
									 <label for="name" generated="true" class="error"><?php echo form_error('name'); ?></label>
									 
                                	<label>Email</label>
                                    <input type="email" name='email' value='<?php echo set_value('email'); ?>' class="input input-xxlarge required" >
									<label for="name" generated="true" class="error"> <?php echo form_error('name'); ?></label>
									 
                                    <label>Password</label>
                                    <input type="password" name='password' class="input input-xxlarge required" >
									 <label for="password" generated="true" class="error"><?php echo form_error('password'); ?></label>
									 
									<label>Service</label> 
									<select id="select01" name="service" class="required main-service">  
                                            <option value="">Select Service</option> 
											<?php foreach($services as $service) {?>										
												<option value="<?php echo $service->id;?>"><?php echo $service->service_name;?></option> 
											<?php } ?>
                                    </select>
									
									<div class='programs'>
									
									</div>
									
									<div class='offerings'>
									
									</div>
									 
                                    <label>Phone Number</label>
                                    <input type="text" name='phone' class="input input-xxlarge required" value='<?php echo set_value('phone'); ?>'>
									<label for="phone" generated="true" class="error"> <?php echo form_error('phone'); ?></label>
									<label>Date of Birth</label>
									<input type='text' name='dob' value='<?php echo set_value('dob'); ?>' id='datepicker' />
									 <label for="dob" generated="true" class="error"><?php echo form_error('dob'); ?></label>		
								<!--<label>Gender</label>
									<select  name="gender" class="required">  
										<option value="">Select Gender</option>  
										<option value="m">Male</option>  
										<option value="f">Female</option>  
									</select>-->
									<label class="control-label" for="select02">Gender</label>  
                                        <select id="select02" name="gender" class="required">  
                                            <option value="">Select Gender</option>  
                                            <option value="Male">Male</option>  
                                            <option value="Female">Female</option>  
                                        </select>
									<label for="gender" generated="true" class="error"><?php echo form_error('gender'); ?>	</label>									
								<label>Call Back time</label>
									<input type='text' name='callbk_time' value='<?php echo set_value('callbk_time'); ?>' class="input input-xxlarge required"/>
									<label for="callbk_time" generated="true" class="error"> <?php echo form_error('callbk_time'); ?></label>
								<label>Vacation Start Date</label>
									<input type='text' name='start_date' value='<?php echo set_value('start_date'); ?>' class="input input-xxlarge required" id='vac_start_datepicker'/>
									<label for="start_date" generated="true" class="error"> <?php echo form_error('start_date'); ?></label>
								<label>Vacation End Date</label>
									<input type='text' name='end_date' value='<?php echo set_value('end_date'); ?>'  class="input input-xxlarge required" id='vac_end_datepicker'/>
									<label for="end_date" generated="true" class="error"> <?php echo form_error('end_date'); ?></label>
								<label>About</label>
									<textarea name='about' id='chars' maxlength='6000'><?php echo set_value('about'); ?></textarea>
									<label for="about" generated="true" class="error"> <?php echo form_error('about'); ?></label>
									<font size="2">(Maximum characters: 6000)<br>
									You have <span id='text' style='font-weight:bold;'>6000</span> characters left.</font>
									<br/>
								<label>Expertise</label>
									<textarea name='expertise' ID='chars2' maxlength='600'><?php echo set_value('expertise'); ?></textarea>
									<label for="expertise" generated="true" class="error"> <?php echo form_error('expertise'); ?></label>
									<font size="2">(Maximum characters: 600)<br>
									You have <span id='text2' style='font-weight:bold;'>600</span> characters left.</font>
									<br/>
									<input type='hidden' name='url' class='url' value='<?php echo base_url();?>' />
                                    <input type="submit" value="Register" class="button">
                                </form>
                            </div>
                            </div>
                            
                        </div>
                            
                        </div>
                    </div>
                </div>
    		</div>  
    	</div>
    </div>
</div>





<!--<div class="main-container">    
    <div class="content">
    	<div class="container">
        	
        	<div class="page-head center">
            	<h1>Get Started</h1>
            </div>
            
    		<div class="content-inner">
    			<div class="row">
                	
                    <div class="col-xs-12 full-page" >                    
                    	<div class="get-started">
                        	

                        	<div class="row">
                        		<div class="col-xs-6 mar-auto">
                                <p>Registration</p>
                                <?php echo validation_errors(); ?>
								
							<form action='<?php echo base_url();?>sme/register' method='post' enctype="multipart/form-data" />
                                
                                <label>First name</label>
									<input type='text' name='first_name' value='<?php echo set_value('first_name'); ?>' />

                                <label>Last name</label>
                                	<input type='text' name='last_name' value='<?php echo set_value('last_name'); ?>'  />
                                <label>Email Address</label>
									<input type='email' name='email' value='<?php echo set_value('email'); ?>' />
                                <label>Create Password</label>
									<input type='password' name='password' value=''  />
                                <label>Reenter Password</label>
									<input type='password' name='passconf' value=''  />
								<label>Address</label>
									<textarea name='address'><?php echo set_value('address'); ?></textarea>
								<label>Phone</label>
									<input type='text' name='phone' value='<?php echo set_value('phone'); ?>'  />
								<label>Date of Birth</label>
									<input type='text' name='dob' value='<?php echo set_value('dob'); ?>' id='datepicker' />									
								<label>Gender</label>
									<select id="select01" name="gender" class="required">  
										<option value="">Select Gender</option>  
										<option value="m">Male</option>  
										<option value="f">Female</option>  
									</select>
								<label>Call Back time</label>
									<input type='text' name='callbk_time' value='<?php echo set_value('callbk_time'); ?>' />
								<label>Start Date</label>
									<input type='text' name='start_date' value='<?php echo set_value('start_date'); ?>' />
								<label>End Date</label>
									<input type='text' name='end_date' value='<?php echo set_value('end_date'); ?>'  />
								<label>About</label>
									<textarea name='about' id='chars' maxlength='6000'><?php echo set_value('about'); ?></textarea>
									<font size="2">(Maximum characters: 6000)<br>
									You have <span id='text' style='font-weight:bold;'>6000</span> characters left.</font>
									<br/>
								<label>Expertise</label>
									<textarea name='expertise' ID='chars2' maxlength='600'><?php echo set_value('expertise'); ?></textarea>
									<font size="2">(Maximum characters: 600)<br>
									You have <span id='text2' style='font-weight:bold;'>600</span> characters left.</font>
									<br/>
								<label>Upload a Photo</label>
									<input type='file' name='userfile' value='' />
                                <input type="submit" class="button" value="Submit">
                                </form>
                                
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
    		</div>  
    	</div>
    </div>
</div>-->
