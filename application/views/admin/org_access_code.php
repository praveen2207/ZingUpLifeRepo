<style>
.input_space{
	padding: 10px;
}
.lable_space{
	padding-top: 20px;
	font-size:18px;
}
.errormessage{
	color:red;
	font-weight: 600;
    padding: 20px;
    font-size: 30px;
}
.message{
	font-weight: 600;
    padding: 20px;
    color: green;
    font-size: 30px;
}
</style>
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Add access code</h3>		 
</div>
<div class="row-fluid tr-row">	  
     <form name='myform' id='events_form' action='<?php echo base_url();?>admin/Org_access_code/add_access_code' method="post">
		<div class="col-md-12">
			<div class="col-md-12 lable_space text-center <?php if($message) echo "message"; if($error_message) echo "errormessage";?>"><?php if($message) echo $message; if($error_message) echo $error_message;?></div>
			<div class="col-md-6 text-right lable_space"><b>Organization/Company Name : </b></div>
			<div class="col-md-6 input_space"><input type="text" name="company_name"></div>
			<div class="col-md-6 text-right lable_space"><b>No. of Access code : </b></div>
			<div class="col-md-6 input_space"><input type="text" name="no_of_access_code"></div>
			<div class="col-md-6 text-right lable_space"><b>Org./Company Email ID : </b></div>
			<div class="col-md-6 input_space"><input type="email" name="company_email_id"></div>
			<div class="col-md-12 col-md-offset-6"><input type="submit" class='btn btn-primary' name="add_access_code" value="Add"></div>
		</div>
	</form>
    
</div>	   
