<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Email welcome detail</title>
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
                    <!--[if (gte mso 9)|(IE)]>
                                            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                                   <tr>
                                                   <td>
                                    <![endif]-->   

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
                                <!--[if (gte mso 9)|(IE)]>
                                <table width="370" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td>
                                        <![endif]-->

                                <!--[if (gte mso 9)|(IE)]>
                              </td>
                              </tr>
                      </table>
                       <![endif]-->
                            </td>            			
                        </tr>

                            

                        <tr>
                            <td style="border-top:1px solid #bebebe;padding: 20px 45px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>
                                        <td style="text-align:left;font-size:41px;vertical-align:top;width:155px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:17px;"> 
                                                <label style="font-size:17px;color:#444;">Dear <?php echo ucfirst($details['name']); ?>,</label>
                                                <span style="color:#444;display:block;font-size:17px;line-height:27px;">
                                                <div style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:17px;">
                                                <p>Your one time password (OTP) for logging into ZingUpLife is <?php echo $details['email_verification_code']; ?>.</p>
												<p>Please do not share this OTP with anyone for account security reasons. This OTP is valid for 15 minutes.</p>
												<p>You can click and follow this link to access and set-up your account <a href='https://zinguplife.com/experts/login'>https://zinguplife.com/experts/login</a></p>
												<p>
												<br>Best wishes,</br></p>
												<p>Team ZingUpLife.
												</p>
                                                </div>
												
                                                </span>
                                            </p>
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