<style>
    .datepicker-days .date .datepicker table tr td.new, .date .datepicker table tr td.old, .datepicker-days .date .datepicker table tr td.new, .date .datepicker table tr td.new
    {
	    visibility:hidden;
    }
    .datepicker .datepicker-days table tr td.activeClass.active,.datepicker .datepicker-days table tr td.activeClass
    {
	    background:green;
	    border-radius: 50%;
	    -ms-border-radius: 50%;
	    -moz-border-radius: 50%;
	    -webkit-border-radius: 50%;
	    color: #2a2a2a;
	    color:#fff;

    }
    .datepicker .datepicker-days table tr td.activeClass
    {
	    background:green;
	    color:#fff;
    }

    .datepicker .datepicker-days table tr td.nonactiveClass.active, .datepicker .datepicker-days table tr td.nonactiveClass
    {
	    background:#ccc;
	    border-radius: 50%;
	    -ms-border-radius: 50%;
	    -moz-border-radius: 50%;
	    -webkit-border-radius: 50%;
	    color: #2a2a2a;

    }

    .datepicker .datepicker-days table tr td.activeClass.active
    {
	    background:blue;
	    border-radius: 50%;
	    -ms-border-radius: 50%;
	    -moz-border-radius: 50%;
	    -webkit-border-radius: 50%;
	    color: #fff;

    }
    .smedate .ui-state-disabled a{
	     background: #d9d9d9 none repeat scroll 0 0;
	    border-radius: 58px;
	    color: #000;
	    opacity: 1;
    }

    .smedate .ui-state-available a{
	     background: #ffc815 none repeat scroll 0 0;
	    border-radius: 58px;
	    color: #000;
	    opacity: 1;
    }
    .smedate .ui-state-available a.ui-state-active
    {
	    background:#4bc850 !important;
    }
    .events .tab-border {
            border-left: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
            border-top: 1px solid #ebebeb;
            padding: 30px;
            position: relative;
            top: -3px;
            background-color: #fff;
            margin-left: 0px;
    }
    .user_icon{
    width: 40px;
    height: 40px;
    border-radius: 20px;
    }
    .modal-dialog{
        width: 800px;
        
    }

			</style>
<?php foreach($added_slots as $slot) { ?>
	<span style='display:none;' class='slots'  year = '<?php echo date('Y',strtotime($slot->date));?>' month = '<?php echo date('n',strtotime($slot->date));?>' daydate = '<?php echo date('j',strtotime($slot->date));?>'></span>
	<input type='hidden' class='added_slots' value='<?php  echo date('Y-n-j',strtotime($slot->date));?>' />
<?php } ?>


<main role="main">
        <!-- intro-wrap -->
        <div id="main">
            <section class="row section event1" style="margin-bottom: -75px;">
                <div class="row-content buffer even clear-after" style="margin-top: 70px;  padding-top:45px;">
                    <div class="text-dark" style="background-color:#fff;    border: 1px solid #ebebeb;    padding: 30px 51px 56px 20px;">
                            <div class="column four">
                                <center><?php if($profile->photo != '') {?>
							  <img src='<?php echo base_url(); ?>sme_users/<?php echo $profile->sme_userid;?>/<?php echo $profile->photo;?>' style="margin-top:11px;border-radius:3%;width:200px;height: 250px;"/>

								<?php } else {?>
								<img src="<?php echo base_url(); ?>assets/experts/image/image_placeholder.png" style="margin-top:11px;border-radius:5%;width:200px;height: 250px;">
								<?php } ?></center>
                            </div>
                            <div class="column eight last" class="photo-footer">
                                <h2 style="font-family: 'Montserrat', sans-serif; font-size:21px;"><?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?> </h2>
                                      <p style="font-family: 'Montserrat', sans-serif; font-size:14px;color:#676767;"><?php echo $profile->expertise; ?></p>
                                <h5 style=" margin-top: 25px; font-size: 0.90em;"><span><i class="fa fa-phone-square" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $profile->phone; ?></h5>
                                <h5 style="margin-top:12px;border:0px; font-size: 0.90em;"><span class="span2"><i class="fa fa-envelope" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $profile->username; ?></h5>
                                <ul class="list-inline">
                                <li><button id="followers" class="btn btn-follow followersBtn followersBtn2 <?php if($following != 0) {?>unfollow<?php } else { } ?><?php if($is_logged_in != '' && $following ==0){ ?>follow<?php } ?>" style=" margin-top: 25px;" >FOLLOW</button></li>
                                
                                <?php if($profile->active == 'y' && $profile->chat_pricing != '' && $profile->audio_pricing != '' && $profile->video_pricing != '' && count($added_slots) !==0){ ?>
                                <li><button class="btn btn-chat1" style=" margin-top: 25px;" data-toggle="modal" data-target=".chatOnline">CHAT</button></li>
                                <?php } ?>
                                <li><button class="btn btn-book1" style=" margin-top: 25px;" data-toggle="modal" data-target=".bookCall">BOOK</button></li>
                                
                                
                                
                                </ul>
                            </div>
                        </div>
                    </div>
            </section>

                <section class="row section events">
                <div class="row-content buffer even clear-after text-dark" style="margin-top: -32px;  padding-top:45px;">
                    <div class="text-dark">
                            <nav style="float:left;" class="hidden-xs">
                                <ul class="nav reset" role="tablist" id="myTabs" style="margin-left:-9px;">
                                    <li role="presentation" class="active"> <a data-target="#home" onclick="return false;">ABOUT</a></li>
                                    <li role="presentation"> <a data-target="#profile" onclick="return false">QUESTIONS</a></li>
                                    <li role="presentation"> <a data-target="#event" onclick="return false">UPCOMING EVENTS</a></li>
                                    <li role="presentation"> <a data-target="#article" onclick="return false">ARTICLES</a></li>
				    <li role="presentation"> <a data-target="#feedback" onclick="return false">FEEDBACK</a></li>
                                    <!--
                                  <li role="presentation">
                                    <a  data-target="#feedback" onclick="return false">FEEDBACK</a></li>
    -->
                                </ul>
                            </nav>
                            <ul class="reset hidden-lg hidden-md" role="navigation" style="list-style: none;margin-top: 25px;margin-bottom:0px;">
                              <li class="dropdown dasMenu">
                                <a href="javascript:void(0);" class="dropdown-toggle dsProfile" data-toggle="dropdown"> <i class="fa fa-bars" aria-hidden="true"></i><span style="font-size: 17px;font-family: 'Montserrat', sans-serif;">&nbsp;&nbsp;&nbsp; INFORMATION</span> <span class="caret menu_caret colorGreen"></span> </a>
                                     <ul class="dropdown-menu new_design" role="tablist" id="myTabs" style="    left: 0px;">
                                        <li data-display="ABOUT"> <a data-target="#home" onclick="return false;">ABOUT</a></li>
                                        <li value="1"><a data-target="#profile" onclick="return false">QUESTIONS</a></li>
                                        <li value="2"><a data-target="#event" onclick="return false">UPCOMING EVENTS</a></li>
                                        <li value="3"><a data-target="#article" onclick="return false">ARTICLES</a></li>
					<li value="3"><a data-target="#feedback" onclick="return false">FEEDBACK</a></li>
                                      </ul>
                                </li>
                             </ul>

                        <div class="tab-content tab-border" style="min-height:500px;">
                            <div role="tabpanel" class="tab-pane active" id="home">
                               <div class="box-footer box-comments">
                                   <h2 style="font-family: 'Montserrat', sans-serif; font-size:18px;color:#1f8643;">ABOUT</h2>
                                <p style="font-family: 'Montserrat', sans-serif; font-size:14px;color:#676767;"><?php echo $profile->about; ?></p>
                                     <h2 style="font-family: 'Montserrat', sans-serif; font-size:18px; margin-top:49px;color:#1f8643;">QUALIFICATION</h2>
                                <p style="font-family: 'Montserrat', sans-serif; font-size:14px;color:#676767;"><?php echo $profile->cert_edu; ?></p>
                                     <h2 style="font-family: 'Montserrat', sans-serif; font-size:18px; margin-top:49px;color:#1f8643;">PRICING</h2>
                                   <ul class="list-inline" style="margin-top:30px;">
                                    <li><img src="<?php echo base_url();?>assets/experts_new/img/interface.png" style=" width: 35px;"></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Text Chat = </h5></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Rs.<span class='bookingamt2'><?php echo $profile->chat_pricing; ?></span>/session</h5></li>
                                   </ul>
                                    <ul class="list-inline">
                                    <li><img src="<?php echo base_url();?>assets/experts_new/img/technology.png" style=" width: 35px;"></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Voice Chat = </h5></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Rs.<span class='bookingamt2'><?php echo $profile->audio_pricing; ?></span>/session</h5></li>
                                   </ul>
                                    <ul class="list-inline">
                                    <li><img src="<?php echo base_url();?>assets/experts_new/img/video-play.png" style=" width: 35px;"></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Video Chat = </h5></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Rs.<span class='bookingamt2'><?php echo $profile->video_pricing; ?></span>/session</h5></li>
                                   </ul></ul>
                                    <ul class="list-inline">
                                    <li><img src="<?php echo base_url();?>assets/experts_new/img/video-play.png" style=" width: 35px;"></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">In-person = </h5></li>
                                    <li style="vertical-align: 15px;"><h5 style="font-size:13px;">Rs.<span class='bookingamt2'><?php echo $profile->inperson_pricing; ?></span>/session</h5></li>
                                   </ul>

                                </div>
                            </div>
			    <?php if($this->session->userdata('ques') == 'ask') {?>
											 <div class="img-push" style='clear:both;'>
												<form action='<?php echo base_url();?>experts/ask_question' method='post' >
												 <textarea type="text" class="form-control input-sm" placeholder="Enter Question" name='question' style="width: 400px;height:60px;float:left;"> </textarea>
												  <input type="hidden" id="smeuserid" name='smeuserid' value="<?php echo $profile->sme_userid; ?>" >
												 <input type='submit' value='Submit' class='btn btn-chat1' style='float:right;'/>
												 </form>
											</div>
										<?php } else {?>
											<div class="img-push question-form" style='clear:both;display:none;'>
												<form action='<?php echo base_url();?>experts/ask_question' method='post' >
												 <textarea type="text" class="form-control input-sm" placeholder="Enter Question" name='question' style="width: 400px;height:60px;float:left;"> </textarea>
												  <input type="hidden" id="smeuserid" name='smeuserid' value="<?php echo $profile->sme_userid; ?>" >
												 <input type='submit' value='Submit' class='btn btn-chat1' style='float:right;'/>
												 </form>
											</div>
										<?php } ?>
                            <div role="tabpanel" class="tab-pane" id="profile">
				<div class="box-footer box-comments" style='clear:both;'>
				    <button class="btn btn-chat1 ques-ask" style="float:right;" id='<?php echo $profile->sme_userid; ?>'>ASK A QUESTION</button>
								<?php  if(count($questions) >0) { ?>
								<?php $i=0; foreach($questions as $question) { $i++; if($i==11) break;?>
                                    <div class="box-comment" style="margin-top: 60px;">
                                        <!-- User image -->
										<?php if($question->image == '') {?>
                                                <img alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='margin-top:0px;'>
											<?php } else {?>
												<img style='margin-top:0px;' alt="User Image" src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $question->user_id; ?>/<?php echo $question->image; ?>">
											<?php } ?>
                                        <div class="comment-text"> <span class="username">
                                                    <?php echo $question->name;  ?>
                                                    <span class="text-muted pull-right"><?php echo date('d F Y', strtotime($question->added_on));?> at <?php echo date('h:i A', strtotime($question->added_on));?></span> </span>
                                            <!-- /.username --><?php echo $question->question;  ?>

                                            <div class="answer">
											     <?php if(count($question->comments) != 0 ) {?>
		                                                  <div class="column one">
		                                                   <?php if ($question->photo != '') { ?>
																	<img class="user_icon"  src="<?php echo base_url(); ?>sme_users/<?php echo $question->sme_userid ?>/<?php
																				echo $question->photo; ?>" style="float:left;display:inline;">
															<?php } else { ?>
																<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='float:left;display:inline;'>
															<?php } ?>
														  </div>
		                                                  <div class="column eleven last">
															<?php foreach($question->comments as $c) {?>
															  <div class="column eleven last">
																 <?php echo $c->comment; ?>
															  </div>
														  	<?php } ?>
														  </div>
														  <?php }?>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.comment-text -->
                                	<?php } } else {?>
							<br/>
								<p>Currently There are no questions</p>
							<?php } ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="event">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>S no.</td>
                                            <td>Date</td>
                                            <td>Event Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
										 <?php if (count($events) > 0) { ?>
										 <?php
											$i = 0;
											foreach ($events as $ar) {
												$i++;
												if ($i == 7)
													break;
												$today = strtotime(date('Y-m-d'));
												$start = strtotime(date('Y-m-d', strtotime($ar->date)));
												?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo date('d M, Y', strtotime($ar->date)); ?></td>
                                                <td><?php echo $ar->title; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Cancel Event"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="tooltip" data-placement="bottom" title="Reschedule Event"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>


                                            </tr>
										 <?php } } else {
												?>
												<tr ><td colspan='4'>There are no Events</td></tr>
											<?php } ?>
                                        </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="article">
								<?php if (count($articles) > 0) { ?>
								 <?php
									$i = 0;
									foreach ($articles as $ar) {
										$i++;
										if ($i == 7)
											break;
										?>
                                    <div class="row articles">
                                       <div class="column three">
                                           <img src="<?php echo base_url(); ?>sme_users/articles/<?php echo $ar->id; ?>/<?php echo $ar->photo; ?>" width="100%">
                                       </div>
                                       <div class="column nine last">
                                                <h2 style='margin-top:0px;padding-bottom:10px;'><?php echo $ar->heading; ?></h2>
                                                <p><?php echo $limited_string = word_limiter($ar->content, 50, ''); ?></p>
                                       </div>
                                    </div>
								 <?php } } else { ?>
											<p>There are no Articles</p>
										<?php } ?>
                            </div>
			    <div role="tabpanel" class="tab-pane" id="feedback">
								<div class="row articles" style='padding-top:20px;'>
								 <?php if (count($feedback) > 0) { ?>
								 <?php
										$i = 0;
										foreach ($feedback as $fb) {
											$i++;
											if ($i == 6)
												break;
											?>

                                       <div class="column twelve" style='height:auto;overflow:hidden;border-bottom: 1px solid #ebebeb;margin-bottom:15px;padding-bottom:15px;'>
                                                <h2 style='margin-top:0px;padding-bottom:0px;border:none;'>By <?php echo $fb->name; ?></h2>
                                                <p><?php echo $fb->feedback; ?></p>
												<div>
													<ul class="feedReating">
														<li>
															<?php if($fb->fb_score == 4.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/four-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 4) { ?>
															<img src="<?php echo base_url();?>images/rating-img/four-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/five-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 3) { ?>
															<img src="<?php echo base_url();?>images/rating-img/three-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 3.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/three-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 2) { ?>
															<img src="<?php echo base_url();?>images/rating-img/two-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 2.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/two-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 1.5) { ?>
															<img src="<?php echo base_url();?>images/rating-img/one-half-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == 1) { ?>
															<img src="<?php echo base_url();?>images/rating-img/one-rating.png" alt="" />
														<?php } ?>
														<?php if($fb->fb_score == '' || $fb->fb_score ==0) { ?>
															<img src="<?php echo base_url();?>images/rating-img/zero-rating.png" alt="" />
														<?php } ?>
														</li>
														</ul>
												</div>
                                       </div>

									 <?php } } else { ?>
										<p>There are no feedbacks</p>
									<?php } ?>
									</div>
                                </div>
                            </div>
                    </div>
            </section>
        </div>
        <!-- id-main -->
    </main>
        
    <div class="modal fade chatOnline in" tabindex="-1" role="dialog" id="bookoptions">

        <div class="modal-backdrop fade in" style="height: 100%;"></div>
		<div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center; color: green;">CONSULT ONLINE</h4> </div>
                <div class="modal-body" style="height:auto;overflow:hidden; padding-top:20px;">
                    <h5 style="text-align:center; ">How would you like to talk to <?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?>?</h5>
                    <h5 style="text-align:center; ">Proceed with confidence. Payment will be asked after the consultation!!</h5>
                   <p class="bookingerror" style="color:red;font-size:15px;"></p>
                    <div class="row" style='margin-top:30px;'>
                        <div class="col-md-4 col-sm-4" style="clear: none !important;">
                            <div class="service" style="text-align: center;position:relative;">
                                <div class="image-container"> <img src="<?php echo base_url(); ?>assets/zing_new/img/interface.png"></div>
                                <h5 class='bookingtype'>Text Chat</h5>
                                <button type="submit" class="btn btn-chat bookingamt" >Fee Rs. <span class='bookingamt2'><?php echo $profile->chat_pricing; ?></span></button>
                                <button style='position:absolute;display:none;background:#ccc;width:46%;opacity:.5;height:22px;left:22px;top:93px;' class='btn btn-book btn-chat-hide'></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4" style="clear: none !important;">
                            <div class="service" style="text-align: center;position:relative;">
                                <div class="image-container"><img src="<?php echo base_url(); ?>assets/zing_new/img/technology.png" ></div>
                                <h5 class='bookingtype'>Audio Chat</h5>
                                <button type="submit" class="btn btn-chat bookingamt">Fee Rs. <span class='bookingamt2'><?php echo $profile->audio_pricing; ?></span></button>
								<button style='position:absolute;display:none;background:#ccc;width:46%;opacity:.5;height:22px;left:22px;top:93px;' class='btn btn-book btn-chat-hide'></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4" style="clear: none !important;">
                            <div class="service" style="text-align: center;position:relative;">
                                <div class="image-container"><img src="<?php echo base_url(); ?>assets/zing_new/img/video-play.png"></div>
                                <h5 class='bookingtype'>Video Chat</h5>
                                <button type="submit" class="btn btn-chat bookingamt">Fee Rs. <span class='bookingamt2'><?php echo $profile->video_pricing; ?></span></button>
								<button style='position:absolute;display:none;background:#ccc;width:46%;opacity:.5;height:22px;left:22px;top:93px;' class='btn btn-book btn-chat-hide'></button>
                            </div>
                        </div>
						<input type='hidden' name='booktype' value='' class='booktype' />
						<input type='hidden' name='bookamt' value='' class='bookamt' />
						<input type='hidden' name='smeuserid' class='smeuserid' value='<?php if(is_numeric($this->uri->segment(3)) || $this->uri->segment(3) != '') {echo $this->uri->segment(3);} else{ echo $smeuserid; }?>' />
                    </div>
					<br/>
					<!--<div class="modal-footer">

						<a href="" class="btn btn-chat  smechatnextbtn">Next</a>
					</div>-->
                </div>

            </div>
        </div>
    </div>    
        
        
        
    <!-- main-->
    <div class="modal fade services <?php if($this->session->userdata('direct')) { echo 'in';} ?>" tabindex="-1" role="dialog" id="bookoptions" <?php if($this->session->userdata('direct') && $profile->active == 'y' && $profile->chat_pricing != '' && $profile->audio_pricing != '' && $profile->video_pricing != '' && count($added_slots) !==0) { ?>style='display:block;'<?php } ?>>

		 <?php if($this->session->userdata('direct')) { ?><div class="modal-backdrop fade in" style="height: 100%;"></div><?php } ?>
		<div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center; color: green;">CONSULT ONLINE</h4> </div>
                <div class="modal-body services" style="height:auto;overflow:hidden; padding-top:20px;">
                    <h5 style="text-align:center; ">How would you like to talk to <?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?>?</h5>
                    <h5 style="text-align:center; ">Proceed with confidence. Payment will be asked after the consultation!!</h5>
                   <p class="bookingerror" style="color:red;font-size:15px;"></p>
                    <div class="row" style='margin-top:30px;'>
                        <div class="col-md-4 col-sm-4" style="clear: none !important;">
                            <div class="service" style="text-align: center;position:relative;">
                                <div class="image-container"> <img src="<?php echo base_url(); ?>assets/zing_new/img/interface.png"></div>
                                <h5 class='bookingtype'>Text Chat</h5>
                                <button type="submit" class="btn btn-chat bookingamt" >Fee Rs. <span class='bookingamt2'><?php echo $profile->chat_pricing; ?></span></button>
                                <button style='position:absolute;display:none;background:#ccc;width:46%;opacity:.5;height:22px;left:22px;top:93px;' class='btn btn-book btn-chat-hide'></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4" style="clear: none !important;">
                            <div class="service" style="text-align: center;position:relative;">
                                <div class="image-container"><img src="<?php echo base_url(); ?>assets/zing_new/img/technology.png" ></div>
                                <h5 class='bookingtype'>Audio Chat</h5>
                                <button type="submit" class="btn btn-chat bookingamt">Fee Rs. <span class='bookingamt2'><?php echo $profile->audio_pricing; ?></span></button>
								<button style='position:absolute;display:none;background:#ccc;width:46%;opacity:.5;height:22px;left:22px;top:93px;' class='btn btn-book btn-chat-hide'></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4" style="clear: none !important;">
                            <div class="service" style="text-align: center;position:relative;">
                                <div class="image-container"><img src="<?php echo base_url(); ?>assets/zing_new/img/video-play.png"></div>
                                <h5 class='bookingtype'>Video Chat</h5>
                                <button type="submit" class="btn btn-chat bookingamt">Fee Rs. <span class='bookingamt2'><?php echo $profile->video_pricing; ?></span></button>
								<button style='position:absolute;display:none;background:#ccc;width:46%;opacity:.5;height:22px;left:22px;top:93px;' class='btn btn-book btn-chat-hide'></button>
                            </div>
                        </div>
						<input type='hidden' name='booktype' value='' class='booktype' />
						<input type='hidden' name='bookamt' value='' class='bookamt' />
						<input type='hidden' name='smeuserid' class='smeuserid' value='<?php if(is_numeric($this->uri->segment(3)) || $this->uri->segment(3) != '') {echo $this->uri->segment(3);} else{ echo $smeuserid; }?>' />
                    </div>
					<br/>
					<!--<div class="modal-footer">

						<a href="" class="btn btn-chat  smechatnextbtn">Next</a>
					</div>-->
                </div>

            </div>
        </div>
    </div>


	<?php  if($profile->chat_pricing != '' && $profile->audio_pricing != '' && $profile->video_pricing != '' && count($added_slots) !==0) {?>
		<div class="modal fade services bookCall <?php if($this->session->userdata('from') == 'book') { echo 'in';} ?>" tabindex="-1" role="dialog" id="bookoptions" <?php if($this->session->userdata('from') == 'book') { ?>style='display:block;'<?php } ?>>

			<?php if($this->session->userdata('from')  == 'book') { ?><div class="modal-backdrop fade in" style="height: 100%;"></div><?php } ?>
			<div class="modal-dialog modal-md bookmd" role="document">

				<div class="modal-content" style='width:1000px;'>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center; color: green;">BOOK AN APPOINTMENT</h4> </div>
					<div class="modal-body  bookChat book-tes" style="height:auto;overflow:hidden; padding-top:40px;">
						<p style="text-align:center; ">How would you like to talk to <?php echo $profile->first_name; ?> <?php echo $profile->last_name; ?>?</p>
					   <p class="bookingerror" style="color:red;font-size:15px;"></p>
					   <div class="row" style='margin-top:50px;'>

							<div class="col-md-3 col-sm-3">
								<div class="service" style="text-align: center;">
									<div class="image-container"> <img src="<?php echo base_url(); ?>assets/zing_new/img/interface.png"></div>
									<h5 class='bookingtype'>Text Chat</h5>
									<button type="submit" class="btn btn-chat newbookingamt " >Fee Rs. <span class='bookingamt2'><?php echo $profile->chat_pricing; ?></span></button>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<div class="service" style="text-align: center;">
									<div class="image-container"><img src="<?php echo base_url(); ?>assets/zing_new/img/technology.png" ></div>
									<h5 class='bookingtype'>Audio Chat</h5>
									<button type="submit" class="btn btn-chat newbookingamt">Fee Rs. <span class='bookingamt2'><?php echo $profile->audio_pricing; ?></span></button>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<div class="service" style="text-align: center;">
									<div class="image-container"><img src="<?php echo base_url(); ?>assets/zing_new/img/video-play.png"></div>
									<h5 class='bookingtype'>Video Chat</h5>
									<button type="submit" class="btn btn-chat newbookingamt">Fee Rs. <span class='bookingamt2'><?php echo $profile->video_pricing; ?></span></button>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<div class="service" style="text-align: center;">
										<div class="image-container"> <img src="<?php echo base_url(); ?>assets/zing_new/img/interface.png"/></div>
										<h5 class='bookingtype'>In-person</h5>
										<button type="submit" class="btn btn-chat newbookingamt " >Fee Rs. <span class='bookingamt2'><?php echo $profile->inperson_pricing; ?></span></button>
								</div>
							</div>
							<input type='hidden' name='booktype' value='' class='booktype' />
							<input type='hidden' name='bookamt' value='' class='bookamt' />
							<input type='hidden' name='smeuserid' class='smeuserid' value='<?php if(is_numeric($this->uri->segment(3)) || $this->uri->segment(3) != '') {echo $this->uri->segment(3);} else{ echo $smeuserid; }?>' />
						</div>
						<br/>
						<!--<div class="modal-footer">

							<a href="" class="btn btn-chat  smechatnextbtn">Next</a>
						</div>-->
					</div>
					<div class="statsList hide">
						<span>Ask A Question</span>
						<h4 class="colorGrey pull-right">Available Slots</h4>
					</div>
					<div class="textEnter samDate">
						<h4 class="colorGreen">You have requested for <span class='bookingselectedtype'>Text Chat</span> and the consultation fee is Rs. <span class='bookingselectedamount'>500</span></h4>
						<h4>Please select available date and time for <span class='bookingselectedtype'>Text Chat</span></h4>
						<p class='er-msg' style='color:red;display:none;'>Please select from the available dates</p>
						<div class="date dashDate smedate">
							<div id="smedashDatePickers2"></div>
						</div>
						<div class="avaBox">
							<ul>
								<li><img src="<?php echo base_url(); ?>assets/experts/image/bage1.png">Selected</li>
								<li><img src="<?php echo base_url(); ?>assets/experts/image/bage2.png">Available</li>
								<li><img src="<?php echo base_url(); ?>assets/experts/image/bage3.png">Booked/Blocked</li>
							</ul>
						</div>
						<div class="timeSlot">
							<span>Available Time Slots for </span>

						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:void(0);" class="btn btn-chat grey-btn" id="close" data-dismiss="modal">cancel</a>
						<a href="javascript:void(0);" class="btn btn-chat zing-btn newsmechatnextbtn">Next</a>

						<a href="javascript:void(0);" class="btn btn-chat zing-btn nextbtn01">Next</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>