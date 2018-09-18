<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Service list</h3>
</div>

<div class="row-fluid vd-row">
    <table id="example" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="filter-input">Service Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="service_list_table">
              <?php   if($packages){
                foreach($services as $service){ 
          foreach($service as $s){
          ?>
             
        <tr style="border:solid 1px #000;">
            <td style="border:solid 1px #000;"><?php echo $s->services; ?></td> 
            <td style="border:solid 1px #000;"><a class="terms_service" href="<?php echo base_url(); ?>customer_support/business_service_edit/<?php echo $s->id; ?>"><strong>Edit</strong></a>/<a class="service_delete" id="<?php echo $s->id; ?>" onclick="myFunction()"><strong>Delete</strong></a></td>
           <!-- <td style="border:solid 1px #000;cursor:pointer;" class="service_delete" id="<?php echo $s->id;?>" onclick="myFunction()">Delete</td> -->
        </tr>
              <?php }}}
       
        else{?>
        <td valign="top" class="" colspan="2" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
        <td style="display:none;"></td>
      <?php   } ?>
            </tbody>
        </table>

    
    </div>