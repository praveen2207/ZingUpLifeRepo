
<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Packages &amp; Treatments</h3>
</div>

<div class="row-fluid vd-row">
     <div class="add_new"><a href="<?php echo base_url(); ?>customer_support/adding_package_service/<?php echo $business_id; ?> ">Add New</a></div>
    <table id="example" class="display" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th class="filter-input">Package/Treatment Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="package_list_table">
              <?php   if($packages){
                foreach($packages as $package){
          ?>
             
        <tr style="border:solid 1px #000;">
            <td style="border:solid 1px #000;"><?php echo $package->program; ?></td> 
            <td style="border:solid 1px #000;"><a class="terms_service" href="<?php echo base_url(); ?>customer_support/business_package_edit/<?php echo $package->id; ?>"><strong>Edit</strong></a>/<a class="package_delete" id="<?php echo $package->id; ?>" ><strong>Delete</strong></a></td>
                       <!-- <td style="border:solid 1px #000;cursor:pointer;" class="package_delete" id="<?php echo $package->id; ?>">Delete</td> -->
        </tr>
      <?php } 
        }
        else{?>
        <td valign="top" class="" colspan="2" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
        <td style="display:none;"></td>
      <?php   } ?>
            </tbody>
        </table>

    
    </div>
