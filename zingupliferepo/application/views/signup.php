<div class="main-container">    
    <div class="content">
        <div class="container">

            <div class="page-head center">
                <h1>Sing Up</h1>
            </div>

            <div class="content-inner">
                <div class="row">

                    <div class="col-xs-12 full-page" >                    
                        <div class="get-started">

                            <div class="row">
                                <div class="col-xs-6 mar-auto">
                                  <p class="sign-reg"><a class="blue" href="<?php echo base_url(); ?>signin">Sign In</a> if you are already Registered.</p>
                                    <form class="" name="register" id="register" action="<?php echo base_url(); ?>do_registration" method="post">  
                                        <label class="control-label"  for="name">Name</label>  
                                        <input type="text" class="input input-xxlarge required" id="name" name="name" />  
                                        <?php echo form_error('name'); ?>
                                        <label class="control-label" for="select01">Gender</label>  
                                        <select id="select01" name="gender" class="required">  
                                            <option value="">Select Gender</option>  
                                            <option value="Male">Male</option>  
                                            <option value="Female">Female</option>  
                                        </select>  
                                        <?php echo form_error('gender'); ?>
                                        <label class="control-label" for="phone">Phone</label>  
                                        <input type="text" class="input input-xxlarge required" id="phone" name="phone">  
                                        <?php echo form_error('phone'); ?>
                                        <label class="control-label" for="email">Email</label>  
                                        <input type="email" class="input input-xxlarge required" id="email" name="username" value="<?php
                                        if (isset($post_data['username'])) {
                                            echo $post_data['username'];
                                        } else {
                                            
                                        }
                                        ?>"/> 
                                               <?php echo form_error('username'); ?>
                                        <?php if (isset($error_message)) { ?><label for="name" generated="true" class="error"><?php echo $error_message; ?></label><?php } ?>
                                        <label class="control-label" for="password">Password</label>  
                                        <input type="password" class="input input-xxlarge required" id="password" name="password">  
                                        <?php echo form_error('password'); ?>
                                        <div class="clear"></div>
                                        <div class="terms">
                                            <label class="control-label" for="check"></label>  
                                            <input type="checkbox" name="check" id="check" class="checkbox"/>
                                            <span>I accept the</span> <a class="blue" href="<?php echo base_url(); ?>terms" target="_blank">terms and conditions</a>
                                        </div>
                                        <div class="form-submit-button-ctr">
                                            <input type="submit" class="button form-submit-button" value="Continue" name="submit">
    <!--                                        <input type="submit" class="button form-submit-button" value="Cancel">-->
                                        </div>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
