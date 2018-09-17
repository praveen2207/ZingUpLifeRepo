<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">SME Article Detail</h3>
</div>

<div class="row-fluid user-detail-row">
    <div class="photo-section photo-section1">
        <div class="photo-details">
            <h4 class="large photo-name1">SME User - <?php echo $article_details->first_name;?> <?php echo $article_details->last_name;?></h4>
        </div>

        <div class="photo-actions">
            <ul class="backend-actions">
                <li><a class="blue" href="<?php echo base_url(); ?>admin/sme_edit_article_details/<?php echo $article_details->id;?>">Edit Article</a></li>
                <li>|</li>
                <li><a class="blue delete_smearticle" href="" id="<?php echo $article_details->id;?>">Delete</a></li>
            </ul>
        </div>
    </div>

    <div class="clear profile-tab">
        <form class="form-horizontal for" name="profile" id="profile">  
            <fieldset>  
                <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Heading:</label>  
                    <div class="edit-controls1">  
                        <span class="edit-name medium1"><?php echo $article_details->heading;?></span>
                    </div>  
                </div> 
                
                 <div class="edit-group1 edit-group3">  
                    <label class="control-label" for="e-name">Content:</label>  
                    <div class="edit-controls1 sme_content">  
                        <span class="edit-name medium1"><?php echo $article_details->content;?></span>
                    </div>  
                </div>
                
                
               
            </fieldset>		   
        </form>  
    </div>
</div>
