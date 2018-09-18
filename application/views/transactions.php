
<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>My Bookings</h1>
            </div>

            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul> 
                                                <li><a href="<?php echo base_url(); ?>my_bookings">My Bookings</a></li>                                                
                                                <li><a href="<?php echo base_url(); ?>my_upcoming_bookings">My Upcoming Bookings</a></li>
                                                <li><a href="<?php echo base_url(); ?>my_past_bookings">Past Bookings</a></li>
                                                <!--                                                <li><a href="#">Upcoming Appointments</a></li>                                                -->
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <div class="my-bookings">
                            <div class="project-list ">
                                <ul > 
                                    <li>
                                        <div class="project-list-inner">
                                            <div class="event-head">
                                                <div class="row">
                                                    <div class="col-xs-1">
                                                        <strong>SNo.</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <strong>Date</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <strong>Event</strong>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <strong>Vendor</strong>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <strong>Status</strong>
                                                    </div>                                        
                                                </div>
                                            </div>
                                            <ul class="event-list">
                                                <?php
                                                if (!empty($transactions)) {
                                                    foreach ($transactions as $key => $value) {
                                                        ?>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-1">
                                                                    <?php echo $key + 1; ?>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <a class="show_details" href="<?php echo base_url(); ?>transaction_details/<?php echo $value['transactions']->booking_id; ?>"><?php echo date("d-M-Y", strtotime($value['transactions']->transaction_date)); ?></a>
<!--                                                                      <a class="show_details" href="<?php echo base_url(); ?>transaction_details/<?php echo $value['transactions']->id; ?>"><?php echo date("d-M-Y", strtotime($value['transactions']->transaction_date)); ?></a>-->
                                                                </div>   
                                                                <div class="col-xs-3">
                                                                    <?php echo $value['vendor_details']->service_name; ?>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <?php echo $value['vendor_details']->name; ?>
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <?php echo $value['transactions']->booking_status; ?>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <p class="no_record_found">No Bookings Found !!!</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>  
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>


                        </div>


                    </div>
                </div>
                </li>
                </ul>
            </div>
        </div>

    </div>
</div>

