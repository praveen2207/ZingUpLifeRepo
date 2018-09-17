<div class="location-header redirect-header">
    <h3 class="redirect-head">Customer Support</h3>
</div>

<div class="row-fluid notify customer-row">
    <div class="span12 no-border">
        <div class="tdetail-con tdetail-con1">
            <div class="trans-header">
                <img class="shatayu-logo1" src="<?php echo $logo_path . $business_provider_details['details']->id . '/' . $business_provider_details['details']->logo; ?>"/>
                <h3 class="vendor-head medium"><?php echo $business_provider_details['details']->name . '- ' . $business_provider_details['details']->area_name; ?></h3>
            </div>

            <div class="customer-details">
                <div class="cust-group">  
                    <label class="customer-label" for="">Location:</label>  
                    <div class="edit-controls">  
                        <span class="cust-name medium green"><?php echo $business_provider_details['details']->area_name . ', ' . $business_provider_details['details']->city; ?></span>
                    </div> 
                </div> 

                <div class="cust-group">  
                    <label class="customer-label" for="">Call Support:</label>  
                    <div class="edit-controls">  
                        <span class="cust-name medium green"><?php echo $business_provider_details['details']->phone;?></span>
                    </div> 
                </div> 

                <div class="cust-group">  
                    <label class="customer-label" for="">Email Us:</label>  
                    <div class="edit-controls">  
                        <span class="cust-name medium green"><?php echo $business_provider_details['details']->email;?></span>
                    </div> 
                </div> 

                <div class="cust-group">  
                    <label class="customer-label" for="">Visit Website:</label>  
                    <div class="edit-controls">  
                        <span class="cust-name medium green"><?php echo $business_provider_details['details']->website;?></span>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</div>
