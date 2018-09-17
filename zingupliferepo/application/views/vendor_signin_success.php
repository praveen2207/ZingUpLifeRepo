<script type="text/javascript">
    function submitform() {
	var url=document.getElementById('vendor_redirect_signin').value;
        parent.location.href = url;
    }
</script>
<body onLoad="submitform()">
    <div class="location-header redirect-header">
        <h3 class="redirect-head">Sign In</h3>
    </div>
    <div class="row-fluid redirect-row">
        <div class="span3 red-row">
            <img class="loader" src="<?php echo base_url(); ?>/assets/images/loader.jpg"/>
            <span class="success suc-con">Sign In Successful Redirecting...</span>

        </div>
    </div>
    
    <input type="hidden" id="vendor_redirect_signin" value="<?php echo base_url(); ?>vendor/edit_profile" />
</body>
