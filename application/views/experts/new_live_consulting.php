 <main role="main">
        <!-- intro-wrap -->
        <div id="main" style="background-color: #f4f2f2;">
            <section class="row section experts" style="margin-bottom:-113px;">
                <div class="row-content buffer even clear-after" style="margin-top: 40px; ">
                    <div class="extra-white text-dark" style="min-height: 650px;">
                        <div class="column eight">
							<form action='<?php echo base_url();?>experts/end_live_session' class='validation' method='post' >
								<input type='hidden' name='sid' value='<?php echo $id;?>' />
							
                                <button class="btn btn-success" data-toggle="modal" type="submit" >End Session</button>
							</form>
							<br/>
                            
							<?php  if($book_type != 'Text Chat' ){?> 
								<iframe style="width:100%" height="315" src="<?php echo $link; ?>" frameborder="0" allowfullscreen></iframe>
							<?php } else {?>
								<iframe style="width:100%" height="315" src="<?php echo base_url(); ?>experts/chat" frameborder="0" allowfullscreen></iframe>
							<?php }  ?>
                            <ul class="list-inline">
                                <li>
									<?php if ($this->session->userdata('photo') != '') { ?>
										<img class="user_icon"  src="<?php echo base_url();?>sme_users/<?php  echo $this->session->userdata('sme_userid') . '/' . $this->session->userdata('photo'); ?>" style="height:40px;width:40px;border-radius:50%;">
									<?php } else { ?>
										<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='border-radius:50%;'>
									<?php } ?>
								</li>

                                <li class="colorGreen"><p class="decoration"><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></p></li>
                            </ul>
							<br/>
							<input type='hidden' name='chat_userid' class='chat_userid' value='<?php echo $this->session->userdata('chat_userid');?>' />
							<input type='hidden' name='package_amount' class='package_amount' value='<?php echo $this->session->userdata('paypackage_amt');?>' />
							<input type='hidden' name='smebookcallid' class='smebookcallid' value='<?php echo $this->session->userdata('smebookcallid');?>' />
							<button class="btn btn-success chat-payment" data-toggle="modal" type="button" data-target="#myModal">Ask for Payment</button>
									
						                  
                        </div>
                        <div class="column four last" style="margin-top:-5px;padding-right: 15px;padding-left:0px;">
                            <h5 style="font-size:15px;">Keep Notes</h5>
                               <form action='<?php echo base_url();?>experts/save_notes' class='validation' method='post' >
                               
                                <textarea name="comment"  class="form-control" rows="10" style="border-radius:0px; height:283px;" placeholder='Enter text here...'></textarea>
								<input type='hidden' name='sid' value='<?php echo $id;?>' />
								<p>Please click on Save Notes button below to close/end the session</p>
                                <button class="btn btn-success" data-toggle="modal" type="submit" data-target="#myModal">Save Notes and End Session</button>
							</form>				
                        </div>
                    </div>
                </div>
            </section>            
        </div>
        <!-- id-main -->
    </main>
