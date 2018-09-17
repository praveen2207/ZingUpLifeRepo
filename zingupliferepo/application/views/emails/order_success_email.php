<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Email order detail</title>
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
                                            <span style="color:#444;font-family: 'Quattrocento Sans', sans-serif;font-size:14px;font-weight:bold;display:block;margin-top:10px;">ID:<?php echo $reschedule_details->transaction_id; ?> </span>

                                        </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                                <table width="370" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td>
                                        <![endif]-->
                                <table class="col370" align="right" border="0" cellpadding="0" cellspacing="0" style="width: auto;">  
                                    <tr>
                                        <td height="" align="right">


                                            <a href="" style="float:right;"><img class="logo" src="<?php echo base_url(); ?>assets/images/logo.jpg" width="" height="" border="0" alt="" style="width:70%;height:auto;" ></a>

                                        </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                              </td>
                              </tr>
                      </table>
                       <![endif]-->
                            </td>            			
                        </tr>

                        <tr>
                            <td style="padding: 10px  23px 10px;border-top:1px solid #bebebe;">
                                <table class="col370" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 72px;">  
                                    <tr>
                                        <td>
                                             <img class="shatayu-logo" src="<?php echo $logo_path . $business_provider_details['details']->id . '/' . $business_provider_details['details']->logo; ?>" style="width:60%;"/>
                                        </td>
                                    </tr>
                                </table>

                                <table class="col370" align="left" border="0" cellpadding="0" cellspacing="0" style="width: auto;">  
                                    <tr>
                                        <td>
                                            <h3 style="font-size:18px;color:#444;font-weight:normal;font-family: 'Quattrocento Sans', sans-serif;padding:0px;margin:0px;margin-top:5px;"><?php echo $business_provider_details['details']->name; ?> - <?php echo $business_provider_details['details']->area_name; ?></h3>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>       

                        <tr>
                            <td style="border-top:1px solid #bebebe;padding: 13px 23px;">
                                <span style="display:block;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;color: #038d26;">You'r successfully re-scheduled</span>
                            </td>
                        </tr>


                        <tr>
                            <td style="padding: 17px 23px;background:#eee;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>

                                        <td style="text-align:left;font-size:41px;vertical-align:top;width:155px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"> <label style="color:#444;font-size:13px;">Date</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"><?php echo date("M j, Y", strtotime($reschedule_details->date)); ?></span></p>
                                        </td>

                                        <td style="text-align:left;font-size:41px;vertical-align:top;width:200px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"> <label style="color:#444;font-size:13px;">Treatment</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"><?php echo $reschedule_details->services; ?></span></p>
                                        </td>

                                        <td style="text-align:left;font-size:41px;vertical-align:top;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="color:#444;font-size:13px;">Time</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"><?php
                                                    echo $start_time = date('h:i A', strtoTIME($reschedule_details->start_time));
                                                   
                                                    ?></span></p>
                                        </td>

                                        <td style="text-align:left;font-size:41px;vertical-align:top;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="color:#444;font-size:13px;">Duration</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"> <?php
                                                    if ($reschedule_details->duration == 1) {
                                                        $hr = 'hr';
                                                    } else {
                                                        $hr = 'hrs';
                                                    }echo $reschedule_details->duration ;
                                                    ?></span></p>
                                        </td>

                                    </tr>
                                </table>
                            </td>
                        </tr>  


                        <tr>
                            <td style="padding: 17px 23px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>

                                        <td style="text-align:left; font-size:41px;vertical-align:top;width:155px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="font-size:13px;color:#444;">Name</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"><?php echo $logged_in_user_data->name; ?></span></p>
                                        </td>

                                        <td style="text-align:left; font-size:41px;vertical-align:top;width:200px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="font-size:13px;color:#444;">Phone</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"><?php echo $logged_in_user_data->phone; ?></span></p>
                                        </td>

                                        <td style="text-align:left; font-size:41px;vertical-align:top;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="font-size:13px;color:#444;">Email</label><span style="color:#444;display:block;font-size:18px;margin-top:5px;"><?php echo $logged_in_user_data->username; ?></span></p>
                                        </td>



                                    </tr>
                                </table>
                            </td>
                        </tr> 



                        <tr>
                            <td style="border-top:1px solid #bebebe;padding: 17px 23px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>

                                        <td style="text-align:left; font-size:41px;vertical-align:top;width:155px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="font-size:13px;color:#444;">Next step:</label><span style="color:#444;display:block;font-size:17px;margin-top:5px;line-height:27px;">Arrive 15 Mins earlier and show the SMS or App confirmation page at counter.</span></p>
                                        </td>



                                    </tr>
                                </table>
                            </td>
                        </tr> 



                        <tr>
                            <td style="border-top:1px solid #bebebe;padding: 17px 23px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>

                                        <td style="text-align:left; font-size:41px;vertical-align:top;width:155px;">
                                            <p style="color:#444;font-weight:normal;padding:0px;margin:0px;font-family: 'Quattrocento Sans', sans-serif;font-size:13px;"><label style="color:#444;font-size:15px;">Contact Customer Support:</label><span style="display:block;font-size:19px;margin-top:5px;line-height:27px;color: #038d26;">080 4951 5364</span></p>
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