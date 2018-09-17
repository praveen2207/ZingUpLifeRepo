<div class="main-container">    
    <div class="content">
        <div class="container">        	
            <div class="page-head center">
                <h1><?php echo $details['details']->name; ?>'s Gallery</h1>
            </div>


            <div class="content-inner">
                <div class="row">
                    <div class="col-xs-3 side-bar" >
                        <ul>
                            <li>
                                <ul class="filters">                                    
                                    <li>
                                        <div class="side-block">
                                            <ul>
                                                <li><a href="<?php echo base_url(); ?>vendor/dashboard">Dashboard</a></li>
                                                <li><a class="active" href="<?php echo base_url(); ?>vendor/business_information">Business Information</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/packages_treatmets_listing">Packages/Treatments</a></li>
                                                <li><a href="<?php echo base_url(); ?>vendor/business_service_list">Business services</a></li>
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
                        <?php
                        $membership_added_message = $this->session->flashdata('gallery_updated_message');
                        if (isset($membership_added_message)) {
                            ?>

                            <!--                            <div class="row-fluid pr-success">-->
                            <div class="message">
                                <h3 class="congratulations message-head">Congratulations !!!</h3>
                                <p class="para-small for-para"><?php echo $membership_added_message; ?></p>
                            </div>
                            <!--                            </div>-->
                        <?php } ?>
                        <div class="business-info gallery_ctr" style="clear:both;">
                            <?php if (count($details['gallery']) < 6) { ?>
                                <div class="add_new"><a class="button" href="<?php echo base_url(); ?>vendor/add_gallery/<?php echo $vendor; ?>">Add New</a></div>						 
                            <?php } ?>
                            <div class="clear"></div>
                            <table id ="service_list_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="serial">S. No.</th>
                                        <th class="vendor_gallery_tabel_head">Image</th>
                                        <th class="vendor_gallery_tabel_head">Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($details['gallery'] as $key => $gallery) {
                                    ?>

                                    <tr style="border:solid 1px #000;">
                                        <td style="border:solid 1px #000;"><?php echo $key + 1; ?></td> 
                                        <td style="border:solid 1px #000;" class="vendor_gallery_tabel_head">
                                            <img class="services_gallery_img" src='<?php echo $gallery_path . $gallery->business_id . '/' . $gallery->images; ?>'/>
                                        </td> 
                                        <td style="border:solid 1px #000;" class="vendor_gallery_tabel_head">
                                            <a class="terms_service" href="<?php echo base_url(); ?>vendor/edit_gallery/<?php echo $gallery->id; ?>"><strong>Edit</strong></a>
                                            /<a class="vendor_gallery_delete" id="<?php echo $gallery->id; ?>"><strong>Delete</strong></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>   
                        </div>

                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#service_list_table').DataTable({
            "initComplete": function (settings) {
                $('#service_list_table_length label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'shows number of entries per page');
                });

                $('#service_list_table_filter label').each(function () {
                    var $td = $(this);
                    $td.attr('title', 'Filters the data in table');
                });
            }

        });
    });
</script>
<script>
    var base_url = "<?php echo base_url(); ?>";
    $('body').on('click', '.vendor_gallery_delete', function () {

        var id = $(this).attr('id');
        if (confirm("Are you sure you want to delete these image from gallery!!!") == true)
        {
            $.ajax({
                type: 'POST',
                url: base_url + 'vendor/gallery_delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    location.reload();

                }
            });
        }
        return false;


    });
</script>
