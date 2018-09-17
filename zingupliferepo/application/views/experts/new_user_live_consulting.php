 <style>
 /*  
		 * Rating styles
		 */
		.rating {
			width: 226px;
			margin: 0 auto 1em;
			font-size: 33px;
			overflow:hidden;
		}
.rating input {
  float: right;
  opacity: 0;
  position: absolute;
}
		.rating a,
    .rating label {
			float:right;
			color: #aaa;
			text-decoration: none;
			-webkit-transition: color .4s;
			-moz-transition: color .4s;
			-o-transition: color .4s;
			transition: color .4s;
		}
.rating label:hover ~ label,
.rating input:focus ~ label,
.rating label:hover,
		.rating a:hover,
		.rating a:hover ~ a,
		.rating a:focus,
		.rating a:focus ~ a		{
			color: orange;
			cursor: pointer;
		}
		.rating2 {
			direction: rtl;
		}
		.rating2 a {
			float:none
		}
 </style>
 <main role="main">
 <?php  $logged_in_user_data = $this->session->userdata('logged_in_user_data');?>
        <!-- intro-wrap -->
        <div id="main" style="background-color: #f4f2f2;position:relative;">
            <section class="row section experts" style="margin-bottom:-113px;">
                <div class="row-content buffer even clear-after" style="margin-top: 40px; ">
                    <div class="extra-white text-dark" style="min-height: 650px;">
						<?php if($this->session->userdata('live_session') ){?> 
								<button class="btn btn-success user-chat-payment"  type="button" style='cursor:pointer;'>Complete Session</button>
								
							<?php }  else {?>
								<button type="submit" class="btn btn-chat" data-toggle="modal" data-target="#review">Review</button>
							<?php } ?>
                        <div class="column eight">
							<?php if($this->session->userdata('live_session') && $book_type != 'Text Chat' ){?>
								<iframe style="width:100%" height="315" src="<?php echo $link; ?>" frameborder="0" allowfullscreen></iframe>
							<?php } else {?>
								<iframe style="width:100%" height="315" src="<?php echo base_url(); ?>chat" frameborder="0" allowfullscreen></iframe>
							<?php }  ?>
                            <ul class="list-inline">
                                <li>
									<?php if ($logged_in_user_data->image != '') { ?>
                                            <img class="user_icon"  src="<?php echo base_url();?>assets/uploads/users/<?php echo $logged_in_user_data->user_id . '/' . $logged_in_user_data->image; ?>" style='height:40px;width:40px;border-radius:50%'>
                                        <?php } else { ?>
                                            <img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='height:40px;width:40px;border-radius:50%'>
                                        <?php } ?>
								</li>

                                <li class="colorGreen"><p class="decoration"><?php echo $logged_in_user_data->name; ?></p></li>
                            </ul>
							
                    <input type='hidden' name='user_id' class='user_id' value='<?php echo $logged_in_user_data->user_id; ?>' />
					 <input type='hidden' name='type' class='type' value='user' />
									<br/>
							<input type='hidden' name='chat_userid' class='chat_userid' value='<?php echo $this->session->userdata('chat_userid');?>' />
							<input type='hidden' name='package_amount' class='package_amount' value='<?php echo $this->session->userdata('paypackage_amt');?>' />
							<input type='hidden' name='smebookcallid' class='smebookcallid' value='<?php echo $this->session->userdata('smebookcallid');?>' />
							
							<input type='hidden' name='sme_userid' class='sme_userid' value='<?php echo $this->session->userdata('smeuser');?>' />
							
						                  
                        </div>
                        <!--<div class="column four last" style="margin-top:-5px;padding-right: 15px;padding-left:0px;">
                            <h5 style="font-size:15px;">Keep Notes</h5>
                               <form action='<?php echo base_url();?>experts/save_notes' class='validation' method='post' >
                               
                                <textarea name="comment"  class="form-control" rows="10" style="border-radius:0px; height:283px;">Enter text here...</textarea>
				<input type='hidden' name='sid' value='<?php echo $id;?>' />
                                <button class="btn btn-success" data-toggle="modal" type="submit" data-target="#myModal">Save Notes</button>
				</form>				
                        </div>-->
                    </div>
                </div>
            </section>  
<div class='live_session_payment' style='position:absolute;top:0px;height:800px;background:#000;display:none;padding-top:190px;width:100%;'>
<p style='background:#fff; color:#000; padding:20px;width:1200px;margin:0px auto;'>To Continue Live Session Please <a href='<?php echo base_url();?>experts/new_chat_payment_checkout'>Click here</a> to make the payment. </p> </div>			
        </div>
        <!-- id-main -->
    </main>
	

