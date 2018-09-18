<div class="container">
    <div class="linerList">
        <a href="<?php echo base_url(); ?>"><span class="colorGreen">Home&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <a href="<?php echo base_url(); ?>dashboard"><span class="colorGreen">Dashboard&nbsp;</span></a>
        <span  class="colorGrey">//&nbsp;</span>
        <span  class="colorGrey">Booking Cancel</span>
    </div>
    <div class="bookSucesscard">
        <div class="log_head">
            <h3>Booking Canceled</h3>
        </div>
        <?php
        if (isset($message) && $message != '') {
            ?>
            <div class="col-xs-8 col-sm-8 col-md-11 er_message">
                <div class="alert  alert-dismissible col-xs-11 errorMessage reError" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <span>Booking Cancel Failed!</span>  Sorry you can not cancel this booking(you can cancel only before 24 hours of your appointment)!!!
                </div>
            </div>
        <?php } ?>
        <?php if (isset($message) && $message == '') { ?>
            <div class="row log_parents">
                <div class="col-sm-12 col-md-12 redirect_image">
                    <h4 class="redirect-head">Your Booking has been canceled successfully for transaction id <?php echo $transaction_details->transaction_id;?></h4>
                </div>

            </div>
        <?php } ?>
    </div>
</div>

