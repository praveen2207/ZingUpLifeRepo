<div class="container">
<div class="location-header redirect-header">
    <h3 class="redirect-head">Check out</h3>

</div>
<div class="row-fluid register-row">
    <div class="span12 no-border">
        <div class="book-details">
		   <div class="col-xs-4">
                                    	<div class="checkout-box-inner">
                                        	<h3>Enjoy your Treat!</h3>
                                            <a href="#"><img src="<?php if(!empty($get_offering_service_details['gallery'])) { echo base_url(); ?>assets/images/<?php echo $get_offering_service_details['gallery'][0]->images; ?>"  <?php } else { echo base_url();?>assets/images/placeholder.jpg <?php }?> alt="" /></a>
                                            <div class="treatment-details">
                                            	<h2><?php echo $business_provider_details['details']->name ;?></h2>
                                                <ul class="list-content-list">
                                                	<li>
                                                    	<div class="row">
                                                    	<div class="col-xs-6 left"> 
                                                        <a href="#"><?php echo $get_offering_service_details['details']->services;?> 
                                                        <span class="minutes">
                                                        <i class="fa fa-clock-o"></i> 10 min
                                                        </span>
                                                        </a>
                                                        </div>
                                                        <div class="col-xs-6 right">&#x20b9;<?php echo $get_offering_service_details['details']->price;?></div>
                                                        </div>
                                                    </li>                                                    
                                                </ul>
                                                <p>Practitioner:  </p>
                                                <div class="date-time">
                                                	<ul >
                                                	<li>
                                                    	<div class="row">
                                                    	<div class="col-xs-6"> 
                                                        <div class="date-time-inner">                                                        
                                                        <span>Saturday</span>
                                                        <?php echo $choosed_booking_date;?>
                                                        </div>
                                                        </div>
                                                        <div class="col-xs-6 ">
                                                        <div class="date-time-inner">
                                                        <span>starting</span>
                                                        <?php if ($choosed_booking_time >= 12) {
                $meridian = 'PM';
            } else {
                $meridian = 'AM';
            }echo date('h:i', strtotime($choosed_booking_time)). ' ' . $meridian;
            ?>
														</div>
                                                        </div>
                                                        </div>
                                                    </li>                                                    
                                                </ul>
                                                </div>
                                                <ul class="treatment-details-list">
                                                	<li>
                                                    	<div class="row">
                                                    	<div class="col-xs-6 left"> 
                                                        <a href="#">Costs</a>
                                                        </div>
                                                        <div class="col-xs-6 right">&#x20b9; <?php echo $get_offering_service_details['details']->price;?></div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                    	<div class="row">
                                                    	<div class="col-xs-6 left"> 
                                                        <a href="#">Coupon</a>
                                                        </div>
                                                        <div class="col-xs-6 right">&#x20b9; 0.00</div>
                                                        </div>
                                                    </li>
                                                                                                       
                                                </ul>
                                                <ul class="treatment-details-list total">
                                                	<li>
                                                    	<div class="row">
                                                    	<div class="col-xs-6 left"> 
                                                        <a href="#">To be paid </a>
                                                        </div>
                                                        <div class="col-xs-6 right">&#x20b9 <?php echo $get_offering_service_details['details']->price;?></div>
                                                        </div>
                                                    </li>                                              
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                    	<div class="payment-confirmed-meaasge center">
                                        	<h2>Confirmed</h2>
                                        </div>
                                    </div>
         </div> 
        
    </div>
</div>
</div>