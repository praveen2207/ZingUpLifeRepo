<div class="main-container sme-dashboard">    
    <div class="content">
    	<div class="container">        	
        	
    		<div class="content-inner">
    			<div class="row">
                	<div class="col-xs-12 full-page" >
						<?php echo $this->view('includes/sme_user_header');?>
                    <div class="feedbacktab-tabs-container">
						    <div class="dashboard-content-inner">
								<div class="dashboard-content-inner-box">
								<?php echo validation_errors(); ?>
								<?php if($this->session->flashdata('msg')) { ?>
									<p><?php echo $this->session->flashdata('msg'); ?></p>
								<?php } ?>
								<h2 class="dashboard-title ">Sorry you have to buy package to give more feedback/or to ask questions</h2>
								<div class="dashboard-content-boxinner">
									<ul>
										<?php foreach($packages as $package) {?>
											<li>
												<p><?php echo $package->name; ?></p>
												<p>No of Questions allowed to be asked : <?php echo $package->no_questions;?></p>
												<p>No of feedbacks allowed to be added : <?php echo $package->no_fb;?></p>
												<p>Amount : <?php echo $package->amount;?></p>
												<a href='<?php echo base_url(); ?>questions/checkout/<?php echo $this->uri->segment(3);?>/<?php echo $package->id; ?>'><input type='button' value='Buy Package' class='button' /></a>
											</li>	
										<?php } ?>
										
									</ul>
								</div>
								</div>
								
							</div> 
						</div>
					</div>  
				</div>
			</div>
		</div>
	</div>	
</div>
