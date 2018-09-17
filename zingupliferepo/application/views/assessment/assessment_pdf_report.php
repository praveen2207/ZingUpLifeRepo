<!Doctype>
<html>
    <body>
	<br><br>
	<table border='1' width='100%'>
	    <tr>
		<td width="350px">DATE COMPLETED: <?php echo $theme_details[0]->test_end_date; ?></td>
		<td>USER: <span style="text-transform: uppercase"><?php echo $logged_in_user_data->name; ?></span><br>GENDER: <span style="text-transform: uppercase"><?php echo $logged_in_user_data->gender; ?></span>
		</td>
	    </tr>
	</table><br><br><br>  
	<p>Greetings,<strong><?php echo ucfirst($logged_in_user_data->name); ?></strong></p>
	<p>Congratulation on completing your wellness assessment for <strong>"<span style="text-transform: uppercase"><?php echo $themes[0]->theme_name; ?></span>".</strong></p>
	<p>We believe any wellness assessment involves following steps </p>
	<ul>
	    <li>Self-discovery or assessment</li>
	    <li>Identification of an action plan </li>
	    <li>Putting the action plan to practice and measuring progress </li>
	    <li>Move to the next level of assessment or self-discovery if action plan is completed </li>
	    <li>Seek help of an expert if not able to complete action plan by self </li>
	</ul>
	<p>By completing the assessment, you have taken your first step towards knowing your state of well-being with respect to your "<?php echo $themes[0]->theme_name; ?>". This assessment evaluates you over "<?php echo sizeof($sub_themes); ?> Factors" - 
			<?php 
			$i = 0;
			foreach($sub_themes as $sub_theme){
					if ($i > 0 && ($i != sizeof($sub_themes) - 1)){ ?>, <?php 
					}
					if ($i == sizeof($sub_themes) - 1  ){ ?> and <?php
					}
					echo $sub_theme['sub_theme_name'];
					$i++;	
					} 				 
			?>
			 - to come up with a final score. </p>
	<p>In the next section, we have provided your "<?php echo $themes[0]->theme_name; ?>" score with a description of what it means. Please go through it in detail and internalize to be clear about the next steps forward. </p>
	<p>Later in the report, we have also created a set of recommended action plan that you can consider for improving your "<?php echo $themes[0]->theme_name; ?>" score. Identify which of the goals you can practice on a sustainable basis and add it to your daily chores. </p>
	<p>Finally, we believe that for being well a person needs to focus on their physical, emotional, mental and spiritual aspects. 
	This report captures your performance only on the "<?php echo $themes[0]->theme_name; ?>" aspect. We encourage you to take our other assessments that evaluates you on the rest of the aspects. This will provide you with a comprehensive picture on how you are performing overall on your health and wellness journey. It will also enable you to come up with a list of action plan that will help you make progress on all the above aspects. </p>
	<br style="page-break-after: always"> 
	<h4 style="color:#6495ED;">YOUR "<span style="text-transform: uppercase"><?php echo $themes[0]->theme_name; ?></span>" ASSESSMENT SCORE </h4>
	<p>Based on the inputs provided by you in the assessment please find below your score for "<?php echo $themes[0]->theme_name; ?>" </p>
	<table><tr><td width="150px"></td><td><img src="<?php echo base_url();?>assets/assessment/img/scores/<?php echo round($theme_details[0]->marks_scored); ?>.png"></td><td width="150px"></td></tr></table>
	
	<?php foreach($interpretation as $inter){ 
		echo $inter['interpretation_text']; }?>
	<p>While knowing your "<?php echo $themes[0]->theme_name; ?>" score is very important, it is not adequate. In order, to truly manage your "<?php echo $themes[0]->theme_name; ?>" effectively you need to pick up an action plan that you feel is doable, on a sustainable basis, and which will improve your "<?php echo $themes[0]->theme_name; ?>" score. In the next section, we have created for you a recommended list of action plan, based on your area of improvement, as identified by the assessment. </p>
	<h4 style="color: #6495ED;">RECOMMENDED ACTION PLAN TO IMPROVE YOUR "<span style="text-transform: uppercase"><?php echo $themes[0]->theme_name; ?></span>"</h4>
	<p>Based on the assessment inputs provided by you we have created a set of recommended action plan for your consideration. You can pick up whichever you feel you can practice on a sustained basis</p>
	
	
	<?php $i = 0;
	foreach($GoalsAndSegment as $goalsAndSegments){
		
		if ($i > 0  && $prevsegment != $goalsAndSegments['segment_name']){?>
		</ol>
			<?php }?>
		<?php 
		if ($i==0 || ($i > 0 && $prevsegment != $goalsAndSegments['segment_name'])){ ?>
			<p><?php  echo $goalsAndSegments['segment_name'];?></p> 
			<ol>
			<?php }?>
				<li><?php echo $goalsAndSegments['goal_name']; 
				$i++;
				$prevsegment = $goalsAndSegments['segment_name'];
				
			}?></li>
		</ol>	
	    
	<h4 style="color:#6495ED;">NEXT STEPS</h4>
	<p>While you have successfully identified action plan for  <?php echo $themes[0]->theme_name; ?>, this is just the first step. It is essential, that you start practicing this action plan on a regular basis, and track your performance, so that it become part of your lifestyle. </p>
	<p>We fully understand that it may be challenging for you to continue implementing this action plan on a sustainable basis. Many people face the same issue and it is OK if you are also going through the same. To address this and to make your health and wellness journey easier, 
	we are working on creating a Health and Wellness App for you. This App will not only help you track your progress against your action plan but also send you friendly reminders, 
	advices on the next step, measure your progress and let you share your journey with family and friends. </p>
	<h4 >Isn't that awesome!! </h4>
	<p>The Zinguplife App is coming up soon. So visit us at www.zinguplife.com soon again to check and download the app and set yourself up for success!</p>
	<p>In case of further enquiries towards the interpretation of the report, kindly call our service help line at 9886350650 or 8660552990.</p>
</body>
    
</html>

