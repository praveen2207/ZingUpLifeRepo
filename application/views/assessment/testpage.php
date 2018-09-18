<style>

#msform fieldset {
background: rgba(255, 255, 255, 0.01);
border: 0 none;
padding: 14% 0% 0% 1%;
width: 80%; 
margin:0 0 0 10%;
position: relative;
}


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


.previous.action-button img {
    width: 100%;
}

.next.action-button img {
    width: 100%;
    margin-top: 66%;
}
</style>
<section class="assesment  hidden-sm hidden-xs" style="margin:0 auto; background: url(<?php echo $web_banner;?>) no-repeat center center; background-size: cover;">
    <h5 class="text-center" style='padding-top: 75px;color: #3fab3a;font-size: 28px;font-weight: bold; text-transform: uppercase;'><?php echo $theme_name;?>  <!--<p><button id="quick_demo">Loading...</button></p>--></h5>
</section>

<section class="assesment hidden-md hidden-lg" style="margin:0 auto; background: url(<?php echo $mobile_web_banner;?>) no-repeat center center; background-size: cover;">
    <h5 class="text-center" style='padding-top: 75px;color: #3fab3a;font-size: 28px;font-weight: bold; text-transform: uppercase;'><?php echo $theme_name;?>  <!--<p><button id="quick_demo">Loading...</button></p>--></h5>
</section>
<section class="bg2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1" style="padding:0px">
                <div class="col-lg-12">
                   
                    
                    
                    <div class="main-content" style="min-height: 500px; height: auto;position:relative;">
                        
                        
                        <?php
                            $intial_percentage = round(100/$toal_questions);
                        ?>
                        <!-- progress bar -->
                        <div class="progress-container">
                            <input type="radio" class="radio addradio" name="progress" value="five" id="five" checked>
                            <label for="five" class="label "><?php echo $intial_percentage;?>%</label>
                            <div class="progress" >
                                <div class="progress-bar" style="width:<?php echo $intial_percentage;?>%"></div>
                            </div>
                        </div>
                        <!-- page counter -->
                    
                   
                    <div class="hexagon"></div>
                   <span class="desc ph" style='display:block;'> 
                    <span class='eachc'>1</span>/<span class='totc'><?php echo $toal_questions; ?></span>
                    </span>
            <form id="msform" role="form" action="" method='post'>
                <?php 
                foreach ($questions as $question) {
                    $theme_id = $question['theme_id'];
                    $test_id = $question['level_id'];
                    break;
                }
                ?>
                <input type="hidden" name="theme_id" value="<?php echo $theme_id;?>"/>
                <input type="hidden" name="test_id" value="<?php echo $test_id;?>"/>
                <input type='hidden' name='total_questions' id="total_questions" value='<?php echo count($questions); ?>'/>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
			    <?php
				    $k = 0;
				    $i = 1;
				    $c = 0;
                    foreach ($questions as $question) {
					$i++;
					$k++;
					$c++;
                ?>
                
                <fieldset style="transform:scale(0.8)" class='fieldset'>
                    
                    <?php if ($c != 1) { ?>
                            
					<button type="button" name="next" class="previous action-button" data-toggle="tooltip" data-placement="bottom" title="Previous" style="right: 97% !important;margin-top: 10%; width: 136px;" catype='<?php echo $question['test_name']; ?>' slug='<?php echo $question['level_id']; ?>' reach='<?php if ($i1 == $toal_questions) {
	    echo 'enable';
	} else {
	    echo 'disable';
	} ?>' va='<?php echo $i; ?>'><img src="<?php echo base_url(); ?>assets/survey_new/img/back.png" width="47px" alt="next"/></button>
                        <?php } ?>
                    
                            <span class="question">
                    <h4 style="line-height:25px;"><?php echo $question['question_text']; ?></h4>    
                    <h3 class="fs-subtitle"><?php echo $question['question_description']; ?></h3>
                </span> 
    				<div class="controls" id='bt_<?php echo $i; ?>' catype='<?php echo $question['test_name']; ?>' slug='<?php echo $question['level_id']; ?>' reach='<?php if (($i1 > $toal_questions)) {
					    echo 'enable';
					} else {
					    echo 'disable';
					} ?>' va='<?php echo $i; ?>'>
                    
					    <?php if ($question['answer_type'] == 'SINGLE' || $question['answer_type'] == 'WEIGHTAGE') { ?>
                    <div class="col-md-12">
					    <?php
					    $j = 0;
                    foreach ($question['answer_options'] as $option) {
                        $j++; 
                        //print_r($option);
                    ?>
                    <div style="<?php if ($j == 1 || $j == 2) { ?>margin-top:10px;<?php } else { ?>margin-top:30px;<?php } ?>float: left;width: 300px;">

                    <input id='radio-<?php echo $k; ?><?php echo $j; ?>' type="radio"  name="option<?php echo $k; ?>[]" value='<?php echo $option['answer_id']; ?>'/>

                    <label for="radio-<?php echo $k; ?><?php echo $j; ?>"><?php echo $option['answer_option_text']; ?></label>
                    </div>
                    <?php } ?>
                    </div>
                    <?php } ?>
					    <?php if ($question['answer_type'] == 'MULTIPLE') { ?>
                    <div class="col-md-12">
					    <?php
					    $j = 0;
					    static $option_value=0;
                    foreach ($question['answer_options'] as $option) {
						$j++;$option_value++;
                        //print_r($option);
                    ?>
                    <div style="<?php if ($j == 1 || $j == 2) { ?>margin-top:10px;<?php } else { ?>margin-top:30px;<?php } ?>float: left;width: 325px;">

	    					    <input id='radio-<?php echo $k; ?><?php echo $j; ?>' type="checkbox"  name="option<?php echo $k; ?>[]" value='<?php echo $option['answer_id']; ?>' option='<?php echo $option_value; ?>' question="<?php echo $k; ?>" class="check_none_of_above"/>

	    					    <label for="radio-<?php echo $k; ?><?php echo $j; ?>" class="option_lable<?php echo $option_value; ?>"><?php echo $option['answer_option_text']; ?></label>
                    </div>
                    <?php } ?>
                    </div>
				<input type="hidden" name="no_of_options" id='no_of_options' question2="<?php echo $k; ?>" value="<?php echo $j; ?>"/>
                    <?php } ?>
                    
                    
                    
                    
                    
                </div>     
                    <div style="clear:both; height: 30px;"></div>
                    
                <?php if (count($questions) + 1 != $i) { ?>
					<button type="button" name="next" class="next action-button"  data-toggle="tooltip" data-placement="bottom" title="Next" id='bt_<?php echo $i; ?>' catype='<?php echo $question['test_name']; ?>' slug='<?php echo $question['level_id']; ?>' reach='<?php if ($i1 == $toal_questions) {
				echo 'enable';
			    } else {
				echo 'disable';
			    } ?>' va='<?php echo $i; ?>'><?php if ($question['answer_type'] == 'MULTIPLE') { ?><img src="<?php echo base_url(); ?>assets/survey_new/img/next.png"  width="47px" alt="next"/><?php } ?></button>
                <?php } ?>
                 
<!--                    style="visibility:hidden;"-->
                   
                   
                   <input type='hidden' name='question<?php echo $k;?>' value='<?php echo $question['question_id'];?>' />  
                   
                </fieldset>   
                
                
                
                
                <?php
                }
                 ?>              
    
    <div style="margin: 50px 0px;margin-left: 110px;" class='savebtn'>
    <button style='visibility:hidden;' type="button" class="btn btn-default nxt-btn" style="background-color:#009746; color:#fff" va='<?php echo $i; ?>' disabled> &nbsp;&nbsp; NEXT &nbsp;&nbsp;</button>
    </div>
    </form>
    			
    			 <fieldset  class='test_completed_div' style="display:none;border-style: none">
                  <button type="submit" catype='physical' class="btn btn-default nxt-btn2"  style="background-color:#009746; color:#fff;position: relative;margin-top:100px;margin-left:190px;" id="submit" name="submit" value="SAVE">&nbsp;&nbsp; SUBMIT &nbsp;&nbsp;</button>
                </fieldset>   
                
               
                    
<!--                    <fieldset class='physical surveyint'>
                        <h3 class="fs-subtitle">You have successfully completed the well-being assessment.</h3>
                        <h3 class="fs-subtitle">Please continue submit your scores and get your personal wellness report and score card.</h3>
                        <button type="submit" catype='physical' class="btn btn-default nxt-btn2"  style="background-color:#009746; color:#fff; position: absolute;<?php //if (!($this->session->userdata('survey')) && !($this->session->userdata('logged_in_user_data'))) { ?>top: 176px;left: 163px;<?php //} ?>">&nbsp;&nbsp; SUBMIT &nbsp;&nbsp;</button>
                    </fieldset>-->
                </div>


                </div>
            </div>
        </div>

    </div>

</section>


<section class="register_div" style="display:none;">
    <div class="container">
        <div class="row">
        	<div class="col-lg-3 col-md-3"></div>
            	<div class="col-lg-4 col-lg-offset-1 col-md-6" style="padding:0px;">
                	<div class="col-lg-12" style='min-height:400px'>
                   		<div class="main-content" style="min-height: 400px; height: auto;position:absolute;">
                      		<div style="display:block;" class="register_divi">    
        						<div class="col-md-12" style="text-align:center;"></div> 
             						<form name="register_form" id="register_form" action="" data-toggle="validator" method="post" class='validation' novalidate='novalidate'>
            							<input type="hidden" name="session_id" id="session_id" value="<?php echo session_id();?>"/>
            								<div class="col-md-12">
                								<div class="col-md-12">
                    								<h4>Please fill the below form to continue</h4>
                								</div>
                								<div class="col-md-12">
                   									<div class="form-group has-feedback">
        												<input type="email" id="username" name="username" placeholder="Email" class='required email' >
													<lable for='username' class='user_error' style="display:none;color:#bf3429;">Username already exist</lable><a href='<?php echo base_url();?>login' style="display:none;" id="user_login">login</a>
                   									</div>
               									</div>
        										<div class="col-md-12">
								                   <div class="form-group">
								        				<input type="password" name="password" id='password' placeholder="Enter New Password" class='required' >
								                   </div>
								               </div>
								               <div class="col-md-12">
								                   <div class="form-group">
								        				<input type="password" name="co_password" equalTo='#password' id='co_password' placeholder="Confirm password" class='required' >
								                   </div>
								               </div>
								               <div style="clear:both;"></div>
								               <div class="col-md-12">
								                   <div class="form-group">
								        				<input type="number" id="user_phone_number" maxlength='10' minlength='10' name="phone" placeholder="Mobile Number" class='required number' >
								        				<lable for='access_code_message' class='access_code_message' style="display:none;color:green">Your One Time Password is sent to this number.</lable>
								                   </div>
								               </div>
								               <div class="col-md-12 accesscode">
								                   <div class="form-group">
								        				<input type="text" id="accesscode" name="accesscode" placeholder="One Time Password" class='required' >
                       									<lable for='access_error_message' class='access_error_message' style="display:none;color:#bf3429;">Your One Time Password is not matching.</lable>
								                   </div>
								               </div>
								               <div class="col-lg-12">
								                    <div class="box-footer" style='text-align:right;'>
								                    	<a href='javascript:void(0);' id="resend" style="display:none;padding-right:10px;">Resend OTP</a>
								                        <button type="button" class="btn btn-success" id="btn_save" name="btn_save" value="Next" onclick="register_user();">NEXT</button>
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

  
