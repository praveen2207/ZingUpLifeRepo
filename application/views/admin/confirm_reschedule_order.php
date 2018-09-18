<div class="location-header admin-header">

			<h3 class="redirect-head admin-head">Reschedule Order</h3>

		</div>

		<div class="row-fluid order-row">

			<div class="user-order-con">

				<span class="order-admin-id" href="">ID: <?php echo $reschedule_details['transactions']->transaction_id; ?></span>

			</div>

			<div class="user-order">

				<div class="order-inner">

					<p class="order-para">

						<label class="order-label">Date of Booking: </label>

						<span class="order-user-text">&nbsp;<?php echo date('d/m/Y', strtotime($reschedule_details['transactions']->booking_date)); ?></span>

					</p>

					<p class="order-para">

						<label class="order-label">Time of Booking: </label>

						<span class="order-user-text">&nbsp;<?php
                    $booking_timing = date('H:i', strtotime($reschedule_details['transactions']->booking_date));
                    if ($booking_timing >= 12) {
                        $meridian = 'PM';
                    } else {
                        $meridian = 'AM';
                    }
                    echo $booking_timing, ' ' . $meridian;
                    ?></span>

					</p>

				</div>

				<span class="confirm-message">

					<?php if ($reschedule_details['transactions']->booking_status == 'Success') { ?><i class="fa fa-check green c-check"></i>Confirmed<?php } else { ?>Not Confirmed <?php } ?>

				</span>

			</div>

			<div class="order-history">

				<div class="panel panel-warning">

					<div id="accordionThree" class="panel-collapse">

						<!-- panel body -->

						<div class="no-border">

							<div class="order-box order-box2">

								<h4 class="medium history">Treatment</h4>

								<p class="box-para">

									<label class="book-label table-label">Name:</label>

									<span class="order-text table-text"><?php echo $reschedule_details['transactions']->services; ?></span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Duration:</label>

									<span class="order-text table-text"><?php
                                    if ($reschedule_details['transactions']->duration > 1) {
                                        $hour = 'hours';
                                    } else {
                                        $hour = 'hour';
                                    }
                                    echo $reschedule_details['transactions']->duration;
                                    ?></span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Amount:</label>

									<span class="order-text table-text">&#x20B9;<?php echo $reschedule_details['transactions']->amount; ?></span>

								</p>

							</div>

							<div class="order-box order-box1 order-box2">

								<h4 class="medium history">Vendor</h4>

								<p class="box-para">

									<label class="book-label table-label">Name:</label>

									<span class="order-text table-text">

										<a href="" class="blue vendor-text"><?php echo $reschedule_details['vendor_details']->name; ?></a>

									</span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Location:</label>

									<span class="order-text table-text"><?php echo $reschedule_details['vendor_details']->area_name; ?></span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Phone No.:</label>

									<span class="order-text table-text"><?php echo $reschedule_details['vendor_details']->phone; ?></span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Email ID:</label>

									<span class="order-text table-text">

										<a href="mailto:" class="blue vendor-text"><?php echo $reschedule_details['vendor_details']->email; ?></a>

									</span>

								</p>

							</div>

							<div class="order-box order-box1 order-box2">

								<h4 class="medium history">Customer</h4>

								<p class="box-para">

									<label class="book-label table-label">Customer ID:</label>

									<span class="order-text table-text"><?php echo $reschedule_details['user_details']->id; ?></span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Name:</label>

									<span class="order-text table-text">

										<a href="" class="blue vendor-text"><?php echo $reschedule_details['user_details']->name; ?></a>

									</span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Phone No.:</label>

									<span class="order-text table-text"><?php echo $reschedule_details['user_details']->phone; ?></span>

								</p>

								<p class="book-para">

									<label class="book-label table-label">Email ID:</label>

									<span class="order-text table-text">

										<a href="" class="blue vendor-text"><?php echo $reschedule_details['user_details']->username; ?></a>

									</span>

								</p>

							</div>

						</div>

					</div>

				</div>

			</div>

			
<form method="post" action="<?php echo base_url(); ?>customer_support/reschedule_success" >
			<div class="span12 span13 edit-hover">

				<h5 class="res-head medium table-head1">

					<i class="fa fa-check"></i>1. Date: <?php echo date("l, F j, Y", strtotime($booking_date)); ?>

				</h5>

				<a href="" class="edit edit1">Edit</a>

			</div>

			

		    <div class="span12 span13 edit-hover">



	           <h5 class="reg-head medium table-head1"><i class="fa fa-check"></i>2. Time: <?php
                        $start_time = date('H:i', strtoTIME($reschedule_start_time));
                        if ($start_time >= 12) {
                            $meridian = 'PM';
                        } else {
                            $meridian = 'AM';
                        }echo $start_time, ' ' . $meridian;
                        ?></h5>

                    <input type="hidden" name="reschedule_date" value="<?php echo $booking_date; ?>">
                    <input type="hidden" name="reschedule_start_time" value="<?php echo $reschedule_start_time; ?>">
                    <input type="hidden" name="reschedule_end_time" value="<?php echo $reschedule_end_time; ?>">
                    <input type="hidden" name="old_slot_id" value="<?php echo $reschedule_details['transactions']->slot_id; ?>">
                    <input type="hidden" name="new_slot_id" value="<?php echo $new_slot_id; ?>">
                    <input type="hidden" name="booking_id" value="<?php echo $reschedule_details['transactions']->booking_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $reschedule_details['transactions']->user_id; ?>">
                    <a href="<?php echo base_url(); ?>reschedule_time/<?php echo $reschedule_details['transactions']->booking_id; ?>" class="edit edit1">Edit</a>
                    <?php $this->session->set_userdata("selected_date", $booking_date);
                    $this->session->set_userdata("selected_time", $reschedule_start_time); ?>

	        </div>

			<div class="span12 span13 no-border">

	         <p class="res-succ res-succ1">You now re-scheduled into the above date and time. Please check again before confirm. </p>



	       <div class="control-group admin-button-group2"> 


            <label class="control-label" for="check1"></label>  

            <div class="controls">
            <input type="hidden" name="change_date" value="<?php if (isset($change_date)) {
                        echo $change_date;
                    } ?>" class="primary-button"/>
                            <input type="hidden" name="change_time" value="<?php if (isset($change_time)) {
                        echo $change_time;
                    } ?>" class="primary-button"/>
            <input type="submit" name="submit" id="submit" value="Continue" class="primary-button"/>

			<input type="submit" name="submit" value="Cancel" class="secondary-button cancel"/>


              </div> 
            </form>

           </div>

          </div>
                </div>
