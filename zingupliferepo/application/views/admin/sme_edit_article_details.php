<div class="location-header admin-header">
    <h3 class="redirect-head admin-head">Edit SME Article</h3>
</div>

<div class="row-fluid user-detail-row">
    <?php
    $update_message = $this->session->flashdata('profile_update_message');
    if (isset($update_message)) {
        if ($update_message == 'success') {
            ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Congratulations!</h3>
                <p class="para-small for-para">You've successfully edited SME Article details.</p>

            </div>
        <?php } else { ?>
            <div class="message tb-message back_end_success_message">
                <h3 class="congratulations message-head">Oops!</h3>
                <p class="para-small for-para">Something went wrong please try again.</p>

            </div>
        <?php }
    }
    ?>
    <form class="form-horizontal for" name="edit-form" id="edit-form" action="<?php echo base_url(); ?>admin/sme/update_article" method="post">  
        <input type="hidden" name="article_id" value="<?php echo $article_details->id; ?>" />
        <fieldset>
			
            <div class="edit-group3">  
                    <label class="control-label" for="select01">SME User:</label>  
                    <div class="customer-edit-input">
                        <select id="select01" name="sme_user" class="required p-select valid">  
                            <option value="">Select SME User</option> 
                            <?php foreach($all_users as $all_user) {?>
								<option value="<?php echo $all_user->sme_userid; ?>" <?php if($article_details->sme_userid == $all_user->sme_userid) {?>selected<?php } ?>><?php echo $all_user->first_name; ?> <?php echo $all_user->last_name; ?></option> 
                            <?php } ?>   
                        </select> 
                        <?php echo form_error('sme_user'); ?>
                    </div>  
                </div> 
    
                <div class="edit-group3">  
                    <label class="control-label" for="ename">Heading:</label>  
                    <div class="customer-edit-input">
                        <input type="text" class="input input-xxlarge required e-input valid" id="ename" name="heading" value="<?php echo $article_details->heading; ?>"> 
                        <?php echo form_error('heading'); ?>
                    </div>
                </div> 

               
             
                <div class="edit-group3">  
                    <label class="control-label" for="ephone">Content:</label>  
                    <div class="customer-edit-input">
                        <textarea class="required e-input valid" id="ename" name="content" ><?php echo $article_details->content; ?></textarea> 
                        <?php echo form_error('content'); ?>
                    </div>
                </div> 

                <div class="customer-button-group"> 
                    <label class="control-label" for="check1"></label>  		  
                    <div class="controls1">
                        <input type="submit" name="submit" id="submit" value="Submit" class="primary-button">
                        <input type="reset" name="resit" value="Cancel" class="secondary-button cancel">
                    </div> 
                </div>
            </div>
        </fieldset>		   
    </form>  
</div>
