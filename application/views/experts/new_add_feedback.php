		<style>
		#stars_small img
		{
			display:inline;
		}
		#stars_small
		{
			width:auto !important;
		}
		form .control-label{
			font-size:16px;
		}
		</style>
		 <main role="main">
			<!-- intro-wrap -->
			<div id="main" style="background-color: #f4f2f2;position:relative;">
				<br/><br/><br/><br/><br/><br/><br/>
			</div>
		</main>
		
		<div class="modal fade in" tabindex="-1" role="dialog" id="review" style='display:block;'>
		<div class="modal-backdrop fade in" style="height: 800px;"></div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center; color: green;">Feedback</h4> </div>
                <div class="modal-body" style="height:360px; padding-top:20px;">
                    <p style="text-align:center; margin-bottom:0px;">How would you like to rate the call?</p>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
						
							<form class="form-horizontal feedback" action='<?php echo base_url();?>experts/feedback_publish' method='post'>
						<input type="hidden"  name='smeuserid' value="<?php echo $profile->sme_userid;?>">
						<?php $logged_in_user_details = $this->session->userdata('logged_in_user_data'); ?>
						<input type="hidden"  name='userid' value="<?php echo $logged_in_user_details->user_id;?>">
					
							<div class="form-group">
								<span for="inputTitle" class="col-sm-4 col-md-3 control-label" style='text-align:left;'>Review title</span>
								<div class="col-sm-8 col-md-9">
									<input type="text" class="form-control required" name="subject" id="inputTitle" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<span for="inputReview" class="col-sm-4 col-md-3 control-label" style='text-align:left;'>Your Review</span>
								<div class="col-sm-8 col-md-9">
									<input type="text" class="form-control required" id="inputReview" name='feedback' placeholder="">
								</div>
							</div>
							<div class="form-group">
								<span for="inputPassword3" class="col-sm-4 col-md-3 control-label" style='text-align:left;'>Your Rating</span>
								<div class="col-sm-8 col-md-9">
								<!--<sapn id="stars" name ="rating" class="starrr formStar"></sapn>-->
								<div id="stars_small"></div>
								</div>
								
							</div>
							
							<div class="form-group" style='clear:both;margin-top:10px;'>
								<div class="col-sm-8 col-md-8">
									<input type='hidden' name='rating' class='rate_sme'/>
									<button type="submit" class="btn btn-chat">Submit</button>
								</div>
							</div>
							<br/><br/>
						</form>
						
                        </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>