<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1>Edit Offering Gallery</h1>
            </div>


            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >

                        <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>    
                        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/multiple_uploads_style.css" />
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul>
                                                <li><a href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_slots">Business Hours</a></li>                                                  
                                              <li><a href="<?php echo base_url(); ?>vendor/one_day_packages">One Day Packages</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-9 right-content" >
                        <div class="business-info" style="clear:both;">
                            <form class="form-horizontal for" name="service" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>vendor/update_offerings_gallery">
                                <label> Service:</label>
                                <input type="hidden" name="service_id" size="5" value ="<?php echo $service_gallery->service_id; ?>"  />
                                <input type="hidden" name="id" size="5" value ="<?php echo $service_gallery->id; ?>"  />
                                <input type="hidden"name="image_name" size="5" value ="<?php echo $service_gallery->images; ?>"  />
                                <input type="text" name="service_name" class="service_name" value="<?php echo $gallery['details']->services; ?>" readonly/><br>
                                <label>Image:</label>
                                <input type="file" name="file" class="" name="images"/>
                                 <img class="services_gallery_img_ctr" src='<?php echo $gallery_path . $service_gallery->service_id . '/' . $service_gallery->images; ?>'/>
                                <br/>
<!--                                <label>Caption:</label>
                                <input type="text" name="caption" class="" value="<?php echo $service_gallery->caption; ?>"/>
                                <?php echo form_error('caption'); ?><br>
                                <label>Description:</label>
                                <textarea name="description" id=""><?php echo $service_gallery->description; ?></textarea><br><br>
                                <?php echo form_error('description'); ?><br>-->
                                <input type="submit" class="button" value="Save changes" /> 
                            </form> 

                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('body').on('click', '.service_slots_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these slots!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/service_slots_delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    location.reload();

                }
            });
        }
        return false;


    });

</script>
