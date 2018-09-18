	<?php   if(count($questions) >0) { ?>
									<?php $i=0; foreach($questions as $question) { $i++; if($i==7) break;?>
                                        <div class="box-comment">
                                            <!-- User image -->
											  <?php if($question->image == '') {?>
												<img src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" alt="User Image" style="height:40px;width:40px;"/>
											  <?php } else {?>
												<img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/uploads/users/<?php echo $question->userid;?>/<?php echo $question->image;?>" alt="User Image">
											  <?php } ?>	
                                            <div class="comment-text">
                                                  <span class="username">
                                                    <?php echo $question->name;  ?>
                                                    <span class="text-muted pull-right"><?php echo date('h:i A', strtotime($question->added_on));?> <?php  $dt = date('Y-m-d', strtotime($question->added_on)); if(strtotime($dt) == strtotime(date('Y-m-d'))) { echo 'Today'; } else { echo date('l', strtotime($question->added_on)); } ?> </span>
                                                  </span><!-- /.username -->
                                              <?php echo $question->question;  ?>
											  
                                              <div class="answer">
											   <?php if(count($question->comments) != 0 ) {?>
                                                  <div class="column one">
                                                     <?php if ($this->session->userdata('photo') != '') { ?>
														<img class="user_icon"  src="<?php echo $smepath . $this->session->userdata('sme_userid') . '/' . $this->session->userdata('photo'); ?>" style="height:40px;width:40px;float:left;display:inline;">
													<?php } else { ?>
														<img class="user_icon" alt="User Image" src="<?php echo base_url(); ?>assets/new_design/image/user_icon_placeholder.png" style='float:left;display:inline;'>
													<?php } ?>
                                                  </div>
												 
												  <?php foreach($question->comments as $c) {?>
													  <div class="column eleven last">
														 <?php echo $c->comment; ?>
													  </div>
												  <?php } ?>
												  <?php } else { ?>
													 <div class="img-push">
													  <input type="text" class="form-control input-sm answering" placeholder="Press enter to answer" style="width: 100%;max-width: 100%;">
													  <input type='hidden' class='qid' value='<?php echo $question->id; ?>' />
													  <input type='hidden' class='uid' value='<?php echo $question->userid; ?>' />
													</div>
												  <?php } ?>
                                              </div>
											  
                                            </div>
                                         </div>   
                                            <!-- /.comment-text -->
									<?php } } else {?>
										<p>There are no questions</p>
									<?php } ?>