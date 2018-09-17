<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>User registration welcome email</title>
        <style type="text/css">
             body {margin: 0; padding: 0; min-width: 100%!important;background:#eee; padding-top:20px; padding-bottom: 20px;}

            @media only screen and (max-width: 577px), screen and (max-device-width: 577px) {
                body[yahoo] .text-left {text-align:left !important;}
            }

        </style>
    </head>
    <body>
        <table class="wholetable" width="100%" bgcolor="" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                 

                    <table bgcolor="#ffffff"  align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width: 600px;margin:0 auto;">
                        <tr>
                            <td style="padding: 10px  22px 10px;">
                                <table width="193" align="left" border="0" cellpadding="0" cellspacing="0">  
                                    <tr>
                                        <td>
                                            <a href=""><img class="logo" src="<?php echo base_url(); ?>/assets/images/logo.png" width="" height="" border="0" alt="" style="width:70%;height:auto;" ></a>

                                        </td>
                                    </tr>
                                </table>
                               
                            </td>            			
                        </tr>

                        <tr>
                            <td style="border-top:1px solid #bebebe;padding: 20px 45px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>
								
                                        <td style="text-align:left;font-size:41px;vertical-align:top;width:155px;">
                                  
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:17px;"> 
                                                <label style="font-size:17px;color:#444;">Hello <?php echo $user_details->name; ?>,</label>
                                                <span style="color:#444;display:block;font-size:17px;line-height:27px;">
                                                <div style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:17px;">
                                                <p>A warm welcome to ZingUpLife - we're delighted to have you on board! With your new account, you now have access to all your 'wellbeing' in one place. 
												Your ZingUpLife username is: <?php echo $user_details->username; ?></p></br>
												<p>Please set-up your password by clicking on the following link </p>
													<a href="<?php echo base_url(); ?>reset_password/<?php echo $reset_password_token_data['reset_password_token']; ?>" style="color:#444;background:#fff;display:block;width:229px;text-decoration:none;font-family: Quattrocento Sans, sans-serif;border:1px solid #088B2B;font-size:21px;color:#038d26;border-radius:4px;padding:5px 26px;font-weight:normal;line-height:normal;letter-spacing: 0.5px;height:auto;">
		                                                Setup password
		                                            </a>
												<p>After thhat you can:</p>
												<p>
												<ul>
													<li>Assess your personal wellbeing score: <a href='https://zinguplife.com/dashboardhttps://zinguplife.com/dashboard'>Dashboard</a></li>
													<li>Discover, follow and consult with our exclusive panel of over 380 wellness experts, therapists and coaches: <a href='https://zinguplife.com/experts/home'>Experts Home</a></li>
													<li>Explore a host of curated tools, resources and knowledge base: <a href='http://zinguplife.com/knowledgebase/'>Knowledge Base</a></li>
												</ul>
												</p>
												<p>Login to your account anytime by heading to <a href=https://zinguplife.com/login>Login</a></p>
												<p>If there's anything we can help you with, simply drop in a line at <a href="mailto:support@zinguplife.com">support@zinguplife.com</a>, or call us at  +91 98181 13345.</p>
												<p>
												<br>Best wishes,</br></p>
												<p>
												Team ZingUpLife.
												</p>
                                                </div>
												
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>  


                        <tr>
                            <td style="padding: 20px 45px 100px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>

                                        <td style="text-align:left; font-size:41px;vertical-align:top;width:155px;">
                                            <a href="<?php echo base_url(); ?>" style="color:#444;background:#fff;display:block;width:496px;text-decoration:none;font-family: 'Quattrocento Sans', sans-serif;border:1px solid #088B2B;font-size:21px;color:#038d26;border-radius:4px;padding:5px 26px;font-weight:normal;line-height:normal;letter-spacing: 0.5px;height:auto;">
                                            Psst,'Ask an expert a question for free  <a href='http://zinguplife.com/experts/user/11'>http://zinguplife.com/experts/user/11</a>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr> 
                    </table>							
                </td>			
            </tr>
        </table>
    </body>
</html>