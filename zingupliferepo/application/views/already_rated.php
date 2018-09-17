<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Review & Ratings</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" > 
                        <div class="location-header">
                            <div class="row">
                                <div class="col-xs-2 center">
                                    <img src="<?php echo $logo_path . $review_details['vendor_details']->id . '/' . $review_details['vendor_details']->logo; ?>" alt="" class="" />  
                                </div>
                                <div class="col-xs-10">            
                                    <h3 class="vendor-head"><?php echo $review_details['vendor_details']->name . '-' . $review_details['vendor_details']->area_name; ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="category1">
                            <div class="row">
                                <div class="col-xs-8">
                                    <h3 class="book-category"><?php echo $review_details['transactions']->services; ?></h3>
                                </div>
                                <div class="col-xs-4">
                                    <div class="time-icons row">
                                        <div class="hour col-xs-6"><i class="fa fa-clock-o"></i><h5 class="hour-t"><?php echo $review_details['transactions']->duration; ?> hours </h5></div>
                                        <div class="amt col-xs-6"><i class="fa fa-inr"></i><h5 class="hour-t"><?php echo $review_details['transactions']->price; ?></h5></div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Thank You</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="checkout-content payment-confirmed">

                            <div class="checkout-box">
                                <div class="row">
                                    <div class="subscription_success_ctr">
                                        <div class="payment-confirmed-meaasge center">
                                            <h2 class="subscription_success">You have already reviewed.</h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
