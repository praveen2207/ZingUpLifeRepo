<div class="container redirect_message">
    <div class="row-fluid notify" >
        <div class="span12 no-border">
             <img src="<?php echo base_url(); ?>assets/css/images/redirect.gif" alt="redirect.gif"/>
            <h3 class="redirect-head">Please do not refresh or press back button. you are being redirected to the payment gateway...</h3>
        </div> 
    </div> 
</div>  

<div class="container">
    <div class="location-header redirect-header" style="display:none;">
        <h3 class="redirect-head">Checkout</h3>
    </div>

    <div class="row-fluid notify" style="display:none;">
        <div class="span12 no-border">

            <div class="tdetail-con">
                <form method="post" name="customerData" action="<?php echo base_url(); ?>membership_payment_process" id="paymentForm">
                    <table width="40%" height="100" border='1' align="center"><caption><font size="4" color="blue"><b>Integration Kit</b></font></caption></table>
                    <table width="40%" height="100" border='1' align="center">
                        <tr>
                            <td>Parameter Name:</td><td>Parameter Value:</td>
                        </tr>
                        <tr>
                            <td colspan="2"> Compulsory information</td>
                        </tr>
                        <tr>
                            <td>TID	:</td><td><input type="text" name="tid" id="tid" readonly /></td>
                        </tr>
                        <tr>
                            <td>Merchant Id	:</td><td><input type="text" name="merchant_id" value="77199"/></td>
                        </tr>
                        <tr>
                            <td>Order Id	:</td><td><input type="text" name="order_id" value="123654789"/></td>
                        </tr>
                        <tr>
                            <td>Amount	:</td><td><input type="text" name="amount" value="1.00"/></td>
                        </tr>
                        <tr>
                            <td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
                        </tr>
                        <tr>
                            <td>Redirect URL	:</td><td><input type="text" name="redirect_url" value="<?php echo base_url(); ?>membership_payment_success"/></td>
                        </tr>
                        <tr>
                            <td>Cancel URL	:</td><td><input type="text" name="cancel_url" value="<?php echo base_url(); ?>payment_canceled"/></td>
                        </tr>
                        <tr>
                            <td>Language	:</td><td><input type="text" name="language" value="EN"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">Billing information(optional):</td>
                        </tr>
                        <tr>
                            <td>Billing Name	:</td><td><input type="text" name="billing_name" value="<?php echo $logged_in_user_details->name; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing Address	:</td><td><input type="text" name="billing_address" value="<?php echo $logged_in_user_details->address; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing City	:</td><td><input type="text" name="billing_city" value="<?php echo $logged_in_user_details->city; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing State	:</td><td><input type="text" name="billing_state" value="<?php echo $logged_in_user_details->state; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing Zip	:</td><td><input type="text" name="billing_zip" value="<?php echo $logged_in_user_details->zipcode; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing Country	:</td><td><input type="text" name="billing_country" value="<?php echo $logged_in_user_details->country; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="<?php echo $logged_in_user_details->phone; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Billing Email	:</td><td><input type="text" name="billing_email" value="<?php echo $logged_in_user_details->username; ?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">Shipping information(optional)</td>
                        </tr>
                        <tr>
                            <td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="<?php echo $logged_in_user_details->name; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="<?php echo $logged_in_user_details->address; ?>"/></td>
                        </tr>
                        <tr>
                            <td>shipping City	:</td><td><input type="text" name="delivery_city" value="<?php echo $logged_in_user_details->city; ?>"/></td>
                        </tr>
                        <tr>
                            <td>shipping State	:</td><td><input type="text" name="delivery_state" value="<?php echo $logged_in_user_details->state; ?>"/></td>
                        </tr>
                        <tr>
                            <td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="<?php echo $logged_in_user_details->zipcode; ?>"/></td>
                        </tr>
                        <tr>
                            <td>shipping Country	:</td><td><input type="text" name="delivery_country" value="<?php echo $logged_in_user_details->country; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="<?php echo $logged_in_user_details->phone; ?>"/></td>
                        </tr>
                        <tr>
                            <td>Merchant Param1	:</td><td><input type="text" name="merchant_param1" value="additional Info."/></td>
                        </tr>
                        <tr>
                            <td>Merchant Param2	:</td><td><input type="text" name="merchant_param2" value="additional Info."/></td>
                        </tr>
                        <tr>
                            <td>Merchant Param3	:</td><td><input type="text" name="merchant_param3" value="additional Info."/></td>
                        </tr>
                        <tr>
                            <td>Merchant Param4	:</td><td><input type="text" name="merchant_param4" value="additional Info."/></td>
                        </tr>
                        <tr>
                            <td>Merchant Param5	:</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
                        </tr>
                        <tr>
                            <td>Promo Code	:</td><td><input type="text" name="promo_code" value=""/></td>
                        </tr>
                        <tr>
                            <td>Vault Info.	:</td><td><input type="text" name="customer_identifier" value=""/></td>
                        </tr>
                        <tr>
                            <td></td><td><INPUT TYPE="submit" value="CheckOut"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>


    </div>
</div>
<script>
    window.onload = function () {
        $('#paymentForm').submit();
        var d = new Date().getTime();
        document.getElementById("tid").value = d;
    };
</script>
