<div class="row salutationDivision">
    <div class="col-lg-12">
		<h3 style="color:black">Welcome back, <?php echo $logged_in_user_data->name;?>! 
		</h2>
    </div>
</div>
<!-- Assessment action items , Stats , Comparision Row -->
<div class="row">
    <!-- Assessment Section -->
    <div class="col-sm-12 assessments-col">
        <!-- Assessment action items header -->
        <div class="row assessments-header">
            <span class="text-uppercase">Assessment Inventory</span>
        </div>
        <!-- Assessment action items body -->
        <div class="row assessments-body minHeightAssesmentRow">
            <div class="col-sm-12">
                <div class="row">
                    <button  class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["StrenghtNEnergy"]){ echo "disabled"; }?>" onclick="strength_asses_theme()" <?php if(!$assesment_access["StrenghtNEnergy"]){ echo "disabled"; }?> >Strength & Energy <span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                <div class="row">
                    <button class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["ThoughtControl"]){ echo "disabled"; }?>" onclick="thought_asses_theme()" <?php if(!$assesment_access["ThoughtControl"]){ echo "disabled"; }?>>Thought Control<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                <div class="row">
                    <button class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["RelationNIntimacy"]){ echo "disabled"; }?>" onclick="relational_asses_theme()" <?php if(!$assesment_access["RelationNIntimacy"]){ echo "disabled"; }?>>Relational & Intimacy<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                <div class="row">
                    <button class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["ZestForLife"]){ echo "disabled"; }?>" onclick="zest_asses_theme()" <?php if(!$assesment_access["ZestForLife"]){ echo "disabled"; }?>>Zest for Life<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                <div class="row">
                    <button class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["BiologicalAge"]){ echo "disabled"; }?>" onclick="bio_asses_theme()" <?php if(!$assesment_access["BiologicalAge"]){ echo "disabled"; }?>>Biological Age<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                <div class="row">
                    <button class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["DietScore"]){ echo "disabled"; }?>" onclick="diet_asses_theme()" <?php if(!$assesment_access["DietScore"]){ echo "disabled"; }?>>Diet Score<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                <div class="row">
                    <button class="btn assessment-buttons col-sm-12 <?php if(!$assesment_access["Wholesomeness"]){ echo "disabled"; }?>" onclick="wholesomeness_asses_theme()" <?php if(!$assesment_access["Wholesomeness"]){ echo "disabled"; }?>>Wholesomeness<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                </div>
                </div>
            </div>
        </div>
