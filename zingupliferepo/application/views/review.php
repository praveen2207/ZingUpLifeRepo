<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Billing&Review</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="get-started">


                            <div class="row">
                                <div class="col-xs-6 mar-auto">
                                    <p>Review all of your business information.Don't Worry you will be able to make changes and add even more info
                                        after you are registered.</p>
                                    <h2>Subscription overview</h2>
                                    <form class="form-horizontal for" id="review" name="review" method="post" action="<?php echo base_url(); ?>vendor/add_registration">
                                        <label><strong>Business name:</strong></label>
                                        <label> <?php echo $this->session->userdata['partner_details']['business_name']; ?></label>

                                        <label> <strong>Email:</strong></label>
                                        <label>  <?php echo $this->session->userdata['partner_details']['email']; ?></label>
                                        <label>  <strong>Property Address:</strong></label>
                                        <label>  
                                         <?php 
                                        $address =array();
                                        array_push($address,$this->session->userdata['business_info']['address1'],$this->session->userdata['business_info']['address2'],$this->session->userdata['business_info']['city'],$this->session->userdata['business_info']['state'],$this->session->userdata['business_info']['country'],$this->session->userdata['business_info']['zipcode']);
                                        echo $str = implode(' , ', array_filter($address));
                                        ?>
										</label>
                                        
                                        <label> <strong>Business Type:</strong></label>
                                    </label> <?php
									$business_types =array();
                                        foreach($this->session->userdata['business_info']['business_type'] as $type){
                                        $business_type = explode('/', $type);
                                        $business_type_id = $business_type[0];
                                        $business_type_name = $business_type[1];
										array_push($business_types,$business_type_name);
                                        }
										 echo $str = implode(' , ', $business_types);
                                        ?></label>
                                    <label><strong>Subscription plan:</strong></label>
                                        <label> <?php echo $this->session->userdata['partner_details']['plan']; ?></label>
                                         <input type="checkbox" class="checkbox" name="check" id="check"/><label>I agree to Zinguplife's <a class="terms_service" href="<?php echo base_url(); ?>assets/terms.pdf" target="_blank"><strong>terms</strong></a>
 of service.</label>
                                        <input type="submit" class="button" name="submit" value="Save & Create profile">
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>