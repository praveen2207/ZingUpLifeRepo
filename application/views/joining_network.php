<div class="container">
<div class="location-header redirect-header">
    <h3 class="redirect-head">Partner Registration</h3>
<?php
    $error_message = $this->session->flashdata('vendor_register_message');
    if ($error_message) {
        ?>
        <div class="message span8 pwd-msg">
		
	    <p class="para-small for-para" style="color:red;"><?php echo $error_message; ?></p>
            
	   </div> 
    <?php } ?>

</div>

<div>
    
    
     <?php foreach($memberships as $membership){ ?>
    <form class="form-horizontal for" name="join_network" method="post" action="<?php echo base_url(); ?>vendor/registration">
        <span style="font-size:14px;"><?php echo $membership->membership; ?></span>
    <br>
    <span style="font-size:14px;"><?php echo $membership->fees; ?>/mo</span><br>
    <span style="font-size:14px;"><?php echo $membership->description; ?></span><br>
        <input type="hidden" name= "subscription_id" value="<?php echo $membership->id; ?>"/> 
        <input type="hidden" name= "subscription_name" value="<?php echo $membership->membership; ?>"/>
        <input type="hidden" name= "subscription_description" value="<?php echo $membership->description; ?>"/>
        <input type="hidden" name= "subscription_duration" value="<?php echo $membership->duration; ?>"/>
        <input type="hidden" name= "subscription_fees" value="<?php echo $membership->fees; ?>"/>
        <input type="submit" name="send" id="send" value="get<?php echo $membership->membership; ?>" class="primary-small"/><br><br><br>
        </form>

    
     <?php } ?>
        
</div>
</div>