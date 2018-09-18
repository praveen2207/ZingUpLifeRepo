<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Business Service list</h3>
</div>

<div class="row-fluid vd-row">
    
    <div class="add_new"><a href="<?php echo base_url(); ?>cs/adding_package_service/<?php echo $business_id; ?> ">Add New</a></div>
<input class="businessid" type="hidden" name="business_id" value="<?php echo $business_id; ?>" readonly="readonly">     
      <div class="filter-section filter-section1 service-name-filter">
        <p class="filter-para" style="float:left;">
            <label class="filter-label">Filter Info:</label>
        <div style="float:left;">
            <input type="text" name="" id="" placeholder="Service Name" class='service_name' />

            <div class="form-error1 filter-error">
                <label class="error">Special characters not allowed</label>
            </div>
        </div>
        
        </p>
    </div> 
    <div class="cs_service_list">      
    <table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="filter-input">Service Name</th>
                <th class="filter-input">Duration</th>
                <th class="filter-input">Price</th>
                <th class="filter-input">Booking type</th>
                <th>Gallery</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="backend_user">
            <?php
               if($services){
                foreach ($services as $service) {
                    foreach ($service as $s) {
                        ?>

                        <tr>
                            <td class="blue word_break_down"><?php echo $s->services; ?></td>
                            <td class="blue"><?php echo $s->duration; ?></td>
                            <td class="blue"><?php echo $s->price; ?></td>
                             <td class="blue"><?php echo $s->service_type; ?></td>
                             <td class="blue">
                                 <ul class="backend-actions">
                                    <li><a class="blue" href="<?php echo base_url(); ?>cs/business_service_gallery/<?php echo $s->service_id; ?>">View Gallery</a></li>
                                  
                                </ul> 
                                 
                             </td>
                            <td class="blue">
                                <ul class="backend-actions">
                                    <li><a class="blue" href="<?php echo base_url(); ?>cs/business_service_edit/<?php echo $s->service_id; ?>">Edit</a></li>
                                    <li>|</li>
                                    <li><a href="" class="blue" id="service_delete" service_id="<?php echo $s->service_id; ?>" >Delete</a></li>
                                </ul>  
                            </td>
                        </tr>
                        <?php }
                    }
                }else {
          
                ?>
                
                             <td valign="top" class="" colspan="6" style="border-right:1px solid #bebebe;text-align:center;">No data available in table</td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
            <td style="display:none;"></td>
<td style="display:none;"></td>
<td style="display:none;"></td>               
             
            <?php } ?>
        </tbody>
    </table>
</div>

</div>
