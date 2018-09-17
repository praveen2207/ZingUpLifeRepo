      <!-- Salutation Division -->
      <div class="row salutationDivision">
      			<div class="col-lg-12">
      				<h2 style="color:black">Welcome back, <?php echo $logged_in_user_data->name;?>! <span style="color:#99C989;font-weight:bold;font-size:0.6em;
    margin-top: 12px;" class="pull-right">Personalized Content and your wellness dashboard - all in one place &nbsp; &nbsp;</span></h2>
      				
      			</div>
      </div>
   
      
      </div>
        <!-- Assessment action items , Stats , Comparision Row -->
       <div class="row">
            <!-- Assessment Section -->
            <div class="col-lg-3 assessments-col">
                <!-- Assessment action items header -->
                <div class="row assessments-header">
                    <span class="text-uppercase">Assessment Inventory</span>
                </div>
                <!-- Assessment action items body -->
                <div class="row assessments-body minHeightAssesmentRow">
                    <div class="col-lg-12">
                            <div class="row">
                                <button  class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["StrenghtNEnergy"]){ echo "disabled"; }?>" onclick="strength_asses_theme()" <?php if(!$assesment_access["StrenghtNEnergy"]){ echo "disabled"; }?> >Strength & Energy <span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                            <div class="row">
                                <button class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["ThoughtControl"]){ echo "disabled"; }?>" onclick="thought_asses_theme()" <?php if(!$assesment_access["ThoughtControl"]){ echo "disabled"; }?>>Thought Control<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                            <div class="row">
                                <button class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["RelationNIntimacy"]){ echo "disabled"; }?>" onclick="relational_asses_theme()" <?php if(!$assesment_access["RelationNIntimacy"]){ echo "disabled"; }?>>Relational & Intimacy<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                            <div class="row">
                                <button class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["ZestForLife"]){ echo "disabled"; }?>" onclick="zest_asses_theme()" <?php if(!$assesment_access["ZestForLife"]){ echo "disabled"; }?>>Zest for Life<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                            <div class="row">
                                <button class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["BiologicalAge"]){ echo "disabled"; }?>" onclick="bio_asses_theme()" <?php if(!$assesment_access["BiologicalAge"]){ echo "disabled"; }?>>Biological Age<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                            <div class="row">
                                <button class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["DietScore"]){ echo "disabled"; }?>" onclick="diet_asses_theme()" <?php if(!$assesment_access["DietScore"]){ echo "disabled"; }?>>Diet Score<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                            <div class="row">
                                <button class="btn assessment-buttons col-lg-11 <?php if(!$assesment_access["Wholesomeness"]){ echo "disabled"; }?>" onclick="wholesomeness_asses_theme()" <?php if(!$assesment_access["Wholesomeness"]){ echo "disabled"; }?>>Wholesomeness<span><img style="height:30px;float:right" src="<?php echo base_url(); ?>assets/images/start_here.png"</span></button>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Stats Section -->
            <div class="col-lg-5 stats">
                <!-- Stats section header -->
                <div class="row stats-header">
                    <span class="text-uppercase">My WellBeing Summary</span>
                </div>
                <!-- Stat section body -->
                <div class="row stats-body minHeightWheelRow">
                              <div class="col-lg-12 stat-values">
                                  <div class="row" >
                                        <div class="col-lg-12 text-center stats-1-row"><?php echo $assesment_results['StrenghtNEnergy'];?></div>
                                  </div>
                                  <div class="row " >
                                        <div class="col-lg-3 text-center "></div>
                                        <div class="col-lg-3 text-center stats-7-row"><?php echo $assesment_results['DietScore'];?></div>
                                        <div class="col-lg-3 text-center stats-2-row"> <?php echo $assesment_results['ThoughtControl'];?></div>
                                        <div class="col-lg-3 text-center "></div>
                                  </div>
                                  <div class="row " >
                                        <div class="col-lg-2 text-center "></div>
                                        <div class="col-lg-4 text-center stats-6-row"><?php echo $assesment_results['Wholesomeness'];?></div>
                                        <div class="col-lg-3 text-center stats-3-row"><?php echo $assesment_results['RelationNIntimacy'];?></div>
                                        <div class="col-lg-3 text-center" ></div>
                                 
                                  </div>
                                  <div class="row " >
                                        <div class="col-lg-5 text-right stats-5-row">
                                        <?php echo $assesment_results['BiologicalAge'];?>
                                        </div>
                                        <div class="col-lg-3 text-center stats-4-row">
                                       <?php echo $assesment_results['ZestForLife'];?>
                                        </div>
                                  </div>  
                                   <div class="row" >
                                        <div class="col-lg-12 text-center stats-8-row"><?php echo substr($assesment_results['BMI'],0,strpos($assesment_results['BMI'], '.'));?></div>
                                  </div>    

                            </div>
                            <!-- 
                                       <div class="col-lg-12 stat-circle">
                                  <div class="row" >
                                        <div class="col-lg-12 text-center stats-1-circle"> <img class=" img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c1_circle_1.png" /></div>
                                  </div>
                                  <div class="row " >
                                        <div class="col-lg-3 text-center "></div>
                                        <div class="col-lg-3 text-center stats-7-circle"><img class="img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c2_circle_2.png" /></div>
                                        <div class="col-lg-3 text-center stats-2-circle"><img class=" img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c3_circle_3.png" /></div>
                                        <div class="col-lg-3 text-center "></div>
                                  </div>
                                  <div class="row " >
                                        <div class="col-lg-3 text-center "></div>
                                        <div class="col-lg-3 text-center stats-6-circle"> <img class="img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c4_circle_4.png" /></div>
                                        <div class="col-lg-3 text-center stats-3-circle"><img class=" img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c5_circle_5.png" /></div>
                                        <div class="col-lg-3 text-center" ></div>
                                 
                                  </div>
                                  <div class="row " >
                                        <div class="col-lg-5 text-right stats-5-circle">
                                       <img class=" img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c6_circle_6.png" />
                                        </div>
                                        <div class="col-lg-3 text-center stats-4-circle">
                                        <img class="img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c7_circle_7.png" />
                                        </div>
                                  </div>   
                                    <div class="row" >
                                        <div class="col-lg-12 text-center stats-8-circle"> <img class=" img-stat-circle" src="<?php echo base_url(); ?>assets/images/r3_c1_circle_1.png" /></div>
                                  </div>   

                            </div> -->
                            <div class="col-lg-12">
                                <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/images/realNewDashboard.png" />
                            </div>
                </div>
            </div>
            <!-- Comparision Section -->
            <div class="col-lg-4 recents">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row assessments-header">
                            <div class="col-lg-6">
                                <span class="text-uppercase"> Assessments</span>
                            </div>
                            <div class="col-lg-3  text-upppercase" >
                                <span>MY </span>
                                <span>SCORE </span>
                            </div>
                            <div class="col-lg-3  text-uppercase" >
                                <span>PEER</span>
                                <span> SCORE</span>
                            </div>
                        </div>
                        <!-- <div class="row assessments-header">
                            <span>Themed Assessments</span>
                        </div> -->
                        <div class="row assessments-body comparison-info-section">
                            <div class="col-lg-12 ">
                                <div class="row theme-title-row">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase">Strength & Energy</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="text-uppercase"><?php echo $assesment_results['StrenghtNEnergy'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_standards['StrenghtNEnergy'];?></span>
                                    </div>
                                </div>
                                <div class="row theme-title-row">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase">Thought Control</span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"> <?php echo $assesment_results['ThoughtControl'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_standards['ThoughtControl'];?></span>
                                    </div>
                                </div>
                                <div class="row theme-title-row">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase" >Relational & Intimacy</span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_results['RelationNIntimacy'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_standards['RelationNIntimacy'];?></span>
                                    </div>
                                </div>
                                <div class="row theme-title-row last-child">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase" >Zest for Life</span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"> <?php echo $assesment_results['ZestForLife'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase" ><?php echo $assesment_standards['ZestForLife'];?></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row non-theme-section">
                <div class="col-lg-12">
                        <div class="row assessments-header">
                            <div class="col-lg-6">
                                <span >STATS</span>
                            </div>
                            <div class="col-lg-3 " >
                                <span>MY </span>
                                <span>SCORE </span>
                            </div>
                            <div class="col-lg-3 " >
                                <span>PEER</span>
                                <span>SCORE</span>
                            </div>
                        </div>
                        <!-- <div class="row assessments-header">
                            <span>Themed Assessments</span>
                        </div> -->
                        <div class="row assessments-body comparison-info-section">
                            <div class="col-lg-12">
                                <div class="row theme-title-row">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase">BMI</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="text-uppercase"> <?php echo $assesment_results['BMI'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_standards['BMI'];?></span>
                                    </div>
                                </div>
                                <div class="row theme-title-row">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase" >Biological Age</span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"> <?php echo $assesment_results['BiologicalAge'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_standards['BiologicalAge'];?></span>
                                    </div>
                                </div>
                                
                                   <div class="row theme-title-row">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase" >WHOLESOMENESS</span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"> <?php echo $assesment_results['Wholesomeness'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span class="text-uppercase"><?php echo $assesment_standards['Wholesomeness'];?></span>
                                    </div>
                                </div>
                                
                                
                                <div class="row theme-title-row last-child">
                                    <div class="col-lg-6 theme-title">
                                        <span class="text-uppercase"  >Diet Score</span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span > <?php echo $assesment_results['DietScore'];?></span>
                                    </div>
                                    <div class="col-lg-3">
                                    <span ><?php echo $assesment_standards['DietScore'];?></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
       </div>

   <!-- Warning Division -->
      <div class="row">
       	<div class="col-lg-12" style="margin-top: 16px;margin-bottom: 5px;" >
       	<span style="color: grey;font-style: italic;padding-left: 10px;
font-weight: bold;
margin-top: 10px;">* Currently locked assesments can be accessed 15 days  after last attempt</span>
       	</div>
        <!-- Reports and Goals row -->
       <div class="row" style="margin-left: -10px;">
            <div class="col-lg-6 reports-col">
                <div class="row reports-header">
                    <span class="text-uppercase">MY WELLBEING Reports 
                    </span>
                </div>
                <div class="row reports-body">
                 <?php foreach ($assesment_reports["assesment_report"] as $report){ ?>
                 <?php if($report["isReportGenerated"]) {?>
                    <div class="col-lg-6 margin-top-card">
                        <div class="row card margin-right">
                            <!-- <div class="col-lg-3">
                                <img class="report_image" src="<?php echo base_url();?>assets/images/user_dashboard/Assets/StrengthEnergy.jpeg" />
                            </div> -->
                            <div class="col-lg-6">
                                <nobr class="report-text text-uppercase"><?php echo $report["theme_name"] ;?></nobr><br>
                                <span><?php echo $report["test_end_date"] ;?></span><br>
                              <nobr>
                               <a href="<?php echo base_url();?>assessment/dashboard_pdf_send_mail/<?php echo $report["theme_id"] ;?>/<?php echo $report["level_id"] ;?>"><span><img src="<?php echo base_url();?>assets/css/images/mail.png" style="width:40px;"/></a> 
                                <a style="position: relative; top: -40px;left: 47px;" href="<?php echo base_url();?>assessment/assessment_pdf_download/<?php echo $report["theme_id"] ;?>/<?php echo $report["level_id"] ;?>"><img src="<?php echo base_url();?>assets/css/images/download.png" style="width:40px;"/></a>
                               </nobr>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <div class="progress-circle <?php  if($report["marks_scored"]>50) echo "over50" ;?>  p<?php echo $report["marks_scored"] ;?>">
   <span><?php echo $report["marks_scored"] ;?>%</span>
   <div class="left-half-clipper">
      <div class="first50-bar"></div>
      <div class="value-bar"></div>
   </div>
</div>
                            </div>
                        </div> 
                    </div>
                    <?php }?>
                    <?php }?>
                    <!-- in case of no reports  -->
                    <?php if(!$assesment_reports["hasReports"]) {?>
                    <div class="col-lg-12">
                    You don't have any reports yet.
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-6 goals-col">
                <div class="row reports-header">
                    <span class="text-uppercase">MY Goals</span><a href="<?php echo base_url();?>goals" class="pull-right text-uppercase goalseViewMoreLink">View ALL</a>
                </div>              
                <div class="row reports-body">
                 <?php foreach ($assesment_goals["assesment_goals"] as $report){ ?>
                 <?php if($report["isReportGenerated"]) {?>
                    <div class="col-lg-6 margin-top-card " >
                        <div class="row card margin-right paddingGoals">
                            <!-- <div class="col-lg-3">
                                <img class="report_image" src="<?php echo base_url();?>assets/images/user_dashboard/Assets/StrengthEnergy.jpeg" />
                            </div> -->
                            <div class="col-lg-12" style="min-height:125px;">
                                <span class="goalTheme text-uppercase"><?php echo $report["theme_name"] ;?></span><br>
                                <span class="goalName"><?php echo $report["goals_0"] ;?></span><br>
                                 <span class="goalName"><?php echo $report["goals_1"] ;?></span><br>
                                  <span class="goalName"><?php echo $report["goals_2"] ;?></span><br>
                            </div>
                        </div> 
                    </div>
                    <?php }?>
                    <?php }?>
                    <!-- in case of no reports  -->
                    <?php if(!$assesment_goals["hasGoals"]) {?>
                    <div class="col-lg-12">
                    You don't have any suggested goals yet.
                    </div>
                    <?php }?>

                </div>
       </div>  
         						
       <!-- Scriprt for handling Assessment button click actions -->
<script>
    function wholesomeness_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
         var theme_id=7;
	    var test_id=11;
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
    }
    
    function diet_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
         var theme_id=6;
	    var test_id=10;
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
    }
    

    function bio_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
         var theme_id=5;
	    var test_id=9;
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
    }
    

    function strength_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
         var theme_id=1;
	    var test_id=1;
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
    }
    

    function thought_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
         var theme_id=2;
	    var test_id=4;
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
    }
    

    function relational_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
        
        // var theme_id=3;
	    // var test_id=7;
	    var theme_id=10;
	    var test_id=17
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
    }
    

    function zest_asses_theme(){
	    // var theme_id=$('#bio_theme_id').val();
        // var test_id=$('#bio_test_id').val();
         var theme_id=4;
	    var test_id=8;
	    
		$.ajax({
		    type: "POST",
		    url: '<?php echo base_url(); ?>assessment/bio_asses_theme',
		    dataType: "json",
		    data: {theme_id:theme_id,test_id:test_id},
		    success: function (data) {
			    if(data.user_status == 'logged in')
			    {
				window.location.href = '<?php echo base_url(); ?>assessment/index';
			    }else{
				window.location.href = '<?php echo base_url(); ?>assessment/info';
			    }

		    }
		});
	}
	
</script>
<style>
.goalseViewMoreLink{
  text-decoration : underline;
  color:#000080;
  font-weight:normal;
 
}
</style>