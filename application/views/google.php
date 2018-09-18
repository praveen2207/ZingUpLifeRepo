
<script type="text/javascript">
    <?php if($authUrl != '') { ?>
    window.location = "<?php echo base_url(); ?><?php echo $authUrl; ?>";
    window.close();
    <?php } ?>
    <?php if($parent_url) { ?>
        window.opener.location= "<?php echo base_url(); ?><?php echo $parent_url; ?>";
        window.close();
    <?php } ?>
</script>    
    