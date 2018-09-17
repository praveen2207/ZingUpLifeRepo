<?php
foreach($added_slots as $slot) { ?>    
<span style='display:none;' class='slots'  year = '<?php echo date('Y',strtotime($slot->date));?>' month = '<?php echo date('n',strtotime($slot->date));?>' daydate = '<?php echo date('j',strtotime($slot->date));?>'></span>
    <input type='hidden' class='added_slots' value='<?php  echo date('Y-n-j',strtotime($slot->date));?>' />
<?php } ?>
    <input type="hidden" name="site_path" id="site_path" value="<?php echo base_url();?>"/>
<div class="location-header admin-header">
    <h4 class="redirect-head admin-head"><a class="blue" href="<?php echo base_url();?>admin/assessment/interpretation_users">Interpretation Queue</a> | <a class="blue" href="<?php echo base_url();?>admin/assessment/consultation_users">Consultation Queue</a></h4>
</div>
<div class="row-fluid tr-row">
    <div style="float:right;">Total Users: <?php echo count($all_customers);?></div>
<!--    <div class="filter-section cus-filter">
        <label class="filter-label">Filter:</label>
            <div style="float:left;">
                <input class="first-in cus-id" type="text" name="" id="" placeholder="Customer ID" />
                <div class="form-error1 filter-error">
                    <label class="error">Enter numbers only</label>
                </div>
            </div>
            <div style="float:left;">
                <input type="text" name="" id="" placeholder="Customer Name"/>
                    <div class="form-error1 filter-error">
                        <label class="error">Special characters not allowed</label>
                    </div>
            </div>
            <div style="float:left;">
                <input class="first-in ph" type="text" name="" id="" placeholder="Phone No" />
                <div class="form-error filter-error">
                    <label class="error">Enter numbers only</label>
                </div>
                <div class="form-error1 filter-error">
                    <label class="error">Enter 10 numbers only</label>
                </div>
            </div>
            <div style="float:left;">
                <input type="text" name="" id="" placeholder="Customer Email ID" class='email' />
            </div>
    </div>-->
<div class='customer-table_interpretation_users'>
    <div class="bs-example">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User Id</th>
                <th>Name</th>
                <th>Email Id</th>
                <th>Gender</th>
                <th class="">Contact #</th>
                <th>Assessment Date</th>
                <th>Appointment Status</th>
                <th>Missed Appointment Count</th>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_customers as $key => $value) { 
                $missed_count = $value->missedcount[0]->missed_count;
               ?>
            <tr>
                    <td class="blue"><?php echo $value->user_id; ?></td>
                    <td class="blue word_break word_break_down"><a class="blue mail-id" href="<?php echo base_url(); ?>customer_support/customer_details/<?php echo $value->user_id; ?>" target="_blank"><?php echo ucfirst($value->name); ?></a></td>
                    <td class="blue word_break word_break_down"><?php echo $value->username; ?></td>
                    <td><?php echo $value->gender; ?></td>
                    <td>
                        <?php
                        if ($value->phone == '') {
                            $phone = '-';
                        } else {
                            $phone = '+91 ' . $value->phone;
                        }
                        echo $phone;
                        
                        
                        ?>
                    </td>
                    <td class="blue"><?php echo date('d/m/Y', strtotime($value->survey_end_date)); ?></td>
                    <td class="blue word_break word_break_down center">
                        <button type="button" onclick="bookaCall('<?php echo $value->user_id; ?>');"> <span class="liveTxt colorGreen"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; &nbsp;Book</span> 
                        </button>
                    </td>
                    <td class="blue ellipse word_break"><?php echo $missed_count;?></td>
                </tr>
            
            <?php } ?>
        </tbody>
    </table>
    
    
    
    
</div>
</div>
<!--calender-->
<div class="modal fade bookCall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md bookmd modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center;">Calendar</h4> 
            </div>
            <div class="textEnter">
                <div class='alert alert-danger er-msg' style='display:none;'>Please select available slots</div>
                <div class='alert alert-success show-suc' style='display:none;'>The Selected Slot is blocked successfully</div>
                <div class="date dashDate smedate">
                    <div class='edit-datepicker2' id='sme-datepicker'></div>
                </div>
                <div class="avaBox">
                    <ul>
                        <li><img src="<?php echo base_url(); ?>assets/experts/image/bage1.png">Selected</li>
                        <li><img src="<?php echo base_url(); ?>assets/experts/image/bage2.png">Available</li>
                        <li><img src="<?php echo base_url(); ?>assets/experts/image/bage3.png">Booked</li>
                        <li><img src="<?php echo base_url(); ?>assets/experts/image/bage4.png">Blocked</li>
                    </ul>
                </div>
                <div class="timeSlot"> <i class="fa-li fa fa-spinner fa-spin"></i>
                    <span>Available Time Slots for </span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="book_call_date2" value=""/>
                    <!-- <?php //echo $this->session->userdata('sme_userid');?> -->
<!--                    <input type='hidden' name='smeuserid' class='smeuserid' value='155' />
                    <button type="button" class="btn btn-default cancel-slot">Cancel</button>
                    <button type="button" class="btn btn-success block-slot">Block/Unblock</button>
                    <button type="button" class="btn btn-success book-slot">Book</button>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade SMEdetails" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md bookmd modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-family: 'Montserrat', sans-serif; text-align:center;">Available General Practitioners</h4> 
            </div>
            <div class="textEnter">
                <div id="available_gps">
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="book_call_date2" value=""/>
                    <input type='hidden' name='smeuserid' class='smeuserid' value='155' />
                    <button type="button" class="btn btn-success" onclick="book_user_slot();">Book</button>
                    <input type="hidden" id="book_call_user_id" value=""/>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/interpretation_booking.js"></script>
