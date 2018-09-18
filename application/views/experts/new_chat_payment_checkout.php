

<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">
            
    		<div class="content-inner">
    			<div class="row">
                	
                    <div class="col-xs-12 full-page" >                    
                    	<div class="checkout-content">
                            <div class="checkout-box checkout_div">
                            	<div class="row">
                                	<div class="col-xs-4">
                                    	<div class="checkout-box-inner">
                                        	<h3>1. Previous Dues</h3>
                                            <!--<a href="#"><img src="images/product-img.jpg" alt="" /></a>-->
                                            <div class="treatment-details">
												<form action='<?php echo base_url();?>experts/new_chat_call_payment' method='post'>
                                            	<p >Amount to be Paid : Rs <span class='new_amout'><?php echo $amount;?></span></p>
                                            	<input type='hidden' name='amount' class='new_amt'  value='<?php echo $amount; ?>' />
                                            	<input type='hidden' name='sme_userid' value='<?php echo $sme_userid; ?>' />
												
												
                                            </div>
											<br/>
											 <p>Note : Please do not refresh this page.</p>
											 
											<a href='<?php echo base_url();?>experts/user/<?php echo $sme_userid;?>'><p class='button'>Cancel</p></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                    	<div class="checkout-box-inner">
                                        	<h3>2. Your details</h3>
                                            <div class="form-pad treatment-form">
                                            	<!--<p class="login-link">Do you have an account? <a href="">login</a> </p>-->
                                            	
                                            	<label>Name* </label>
                                            	<?php $names = explode(" ",$user->name); ?>
                                                <input type="text" placeholder="Your first name" name = "first_name" value='<?php echo $names[0];?>' readonly>
                                                <input type="text" placeholder="Your last name" name = "last_name" value='<?php echo $names[1];?>' readonly>
                                                <label>E-mail address* </label>
                                                <input type="text" placeholder="Your e-mail address" name='email' value='<?php echo $user->username;?>' readonly>
                                                <label>Phone number* </label>
                                                <input type="text" placeholder="Your phone number" name='phone' value='<?php echo $user_detail->phone;?>' readonly>
                                                <label>Comments </label>
                                                <textarea></textarea>
                                               <!-- <div class="term-check">
                                                <input id="checkbox3" type="checkbox" name="checkbox3">
												<label for="checkbox3">Yes, please send more information (via email or text message) about products and services offered by Treatwell.de, such as offers, promotions and sweepstakes. </label>
                                                </div>-->
                                                <p>*These fields are mandatory </p>
                                               
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                    	<div class="checkout-box-inner">
                                        	<h3>3. Payment</h3>
                                            <div class="form-pad treatment-form">                                            	
                                           
                                            	<!--<label>Coupon </label>
                                                <input type="text" placeholder="Your-code-here" name='coupon'>                                         
                                                <p class="small-txt">* Coupon codes only apply to online payments</p>
                                               <!-- <p><strong>Are you already a customer of this salon?</strong> </p>
                                                <div class="row top-radio">
                                                	<div class="col-xs-6">
                                                    	<input id="checkbox4" type="radio" name="checkbox4">
														<label for="checkbox4">Yes</label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                    	<input id="checkbox5" type="radio" name="checkbox4">
														<label for="checkbox5">No</label>
                                                    </div>
                                                </div>
                                                <p><strong>Select a payment method </strong> </p>
                                                <div class="row top-radio">
                                                	<div class="col-xs-6">
                                                    	<input id="checkbox6" type="radio" name="checkbox6" class='salon_check'>
														<label for="checkbox6" class='salon'> Pay at the salon </label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                    	<input id="checkbox7" type="radio" name="checkbox6" class='online_check'>
														<label for="checkbox7" class='online'>Pay online</label>
                                                    </div>
                                                </div>
                                                <p class="small-txt">By clicking on completion, you agree to our terms and conditions and the privacy policy of Treatwell.com B.V. </p>-->
                                                <label>Gift Card No </label>
												<p class='coupon-error' style='color:red;'></p>
                                                <input type="text" placeholder="Your-code-here" name='coupon' class='coupon'>
												<div class='buttons' style='position:relative;'>
													<input type='button' value='Apply' class='button apply-coupon'>	
													<div class='apply-mask' style='position:absolute;width:80px;height:40px;background:#ddd;opacity:.7;display:none;top:0px;left:0px;'></div>
												<br/><br/> 
                                                <p class="small-txt">* Coupon codes only apply to online payments</p>
												
												<div class="center"><input type='submit' class="button" value='Make Payment'></div>
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
    </div>
</div>
