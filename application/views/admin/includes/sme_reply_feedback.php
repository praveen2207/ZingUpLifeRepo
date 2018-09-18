<div class="main-container">    
    <div class="content">
    	<div class="container"> 
			<div class="content-inner">
    			<div class="row">
					<div class="col-xs-12" > 
						<?php if($this->session->flashdata('msg')) { ?>
							<p><?php echo $this->session->flashdata('msg'); ?></p>
						<?php } ?>
					</div>
                	<div class="col-xs-12" style='clear:both;'> 
						
						<form action='<?php echo base_url(); ?>feedback/add_respond' method='post'>
							  <div class="modal-header">
								<h4 class="modal-title">Respond</h4>
							  </div>
							  <div class="modal-body">
								<label>Message</label>
								<textarea name='message'></textarea>
								<input type='hidden' name='fb_id' class='fb_id' value='<?php echo $this->uri->segment(3);?>' />
							  </div>
							  <div class="modal-footer">
								<input type='submit' class='button' value='Send Message'/>
							  </div>
							  </form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
		<form action='<?php echo base_url(); ?>feedback/add_respond' method='post'>
      <div class="modal-header">
        <button type="button" class="button pull-right" data-dismiss="modal" >X</button>
        <h4 class="modal-title">Respond</h4>
      </div>
      <div class="modal-body">
		<label>Message</label>
		<textarea name='message'></textarea>
		<input type='hidden' name='fb_id' class='fb_id' value='' />
      </div>
      <div class="modal-footer">
        <input type='submit' class='button' value='Send Message'/>
      </div>
      </form>
    </div>
	
  </div>
</div>
