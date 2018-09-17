
<div class="container">
<?php $i=0; foreach($res as $r) { $i++;?>

<div class="checkbox">
  <label><input type="radio" name="available_gps" value="<?php echo $r->sme_userid; ?>"/>&nbsp;&nbsp;<?php echo $r->name; ?></label>
</div>

<?php } ?>
<input type='hidden' class='added_sme' value='<?php echo $res[0]->sme_userid; ?>' />

</div>