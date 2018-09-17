<!DOCTYPE html>
<html>
<head>
<title>ZingUpLife : Relationship & Intimacy</title>
<style type="text/css">
.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 50%;
	font-size: 12px;
}

body {Arial , Helvetica, sans-serif;
	
}

.imgRight {
	width: 150px;
	height: 30px;
}

.alignRight {
	text-align: right;
}

.textFormat {
	line-height: 1.6;
	text-align: justify;
}

.footer {
	text-align: center;
	font-style: italic;
	font-size: 0.7em;
	font-weight: bold;
}

.color {
	color: #38e23e;
}

.title {
	font-weight: bold;
}
</style>
</head>
<body>
	<div>
		<div class="center">
			<table class="color title" border='1' width='100%' style="font-size: 10px;">
				<tr>
					<td width="350px">DATE COMPLETED: <?php echo $theme_details[0]->test_end_date; ?></td>
					<td>USER: <span style="text-transform: uppercase"><?php echo $logged_in_user_data->name; ?></span></td>
				</tr>
				<br>
				<tr>
					<td width="350px"></td>
					<td>GENDER: <span style="text-transform: uppercase"><?php echo $logged_in_user_data->gender; ?></span></td>
				</tr>
			</table>
		</div>
		<div class="center">
			<p>Greetings <?php echo ucfirst($logged_in_user_data->name); ?>,</p>
			<p class="textFormat">Congratulations on completing your
				&#8216;Relationship & Intimacy&#8217; self-assessment &#8211; a
				measure of relationship satisfaction and intimacy. Emotional and
				sexual aspects of intimacy in relationships are important correlates
				of a couples&#8217; overall relationship satisfaction.</p>

			<p class="textFormat">This is the first step towards understanding
				your wellness quotient with respect to your relationship and social
				wellbeing.</p>

			<p class="textFormat">The Relationship & Intimacy assessment
				evaluates you over four factors &#8211; Communication, Emotional
				Stability, Family Dynamics, and Support System &#8211; to come up
				with a final score.</p>

			<p class="textFormat">In the following section, you can review your
				section score and interpretations. These give you a primary glimpse
				of your overall wellbeing state in this dimension, and helps
				determine action items that may help track, measure, and optimize
				your personal health and wellbeing.</p>

			<p class="textFormat">Just like any assessment, the higher the score,
				the more satisfied the respondent is with his/ her relationship, and
				a lower score suggests a higher risk of developing conditions
				related to this specific dimension.</p>

			<p class="textFormat">Thank you for learning more about your
				wellbeing and for taking steps to optimize it!</p>
		</div>

		<br pagebreak="true" />

		<div class="center">
			<p class="color title">YOUR RELATIONSHIP & INTIMACY SCORE</p>
			<p>Based on the inputs you provided in this assessment section, here
				is your score</p>
			<table>
				<tr>
					<td width="150px"></td>
					<td><img
						src="<?php echo base_url();?>assets/assessment/img/scores/<?php echo round($theme_details[0]->marks_scored); ?>.png"></td>
					<td width="150px"></td>
				</tr>
			</table>
			<div class="textFormat">
				<p>
    			<?php
                    foreach ($interpretation as $inter) {
                        echo $inter['interpretation_text'];
                    }
                ?>
             	</p>
			</div>
		</div>

		<br pagebreak="true" />

		<div class="center">

			<p class="color title">ROUTE TO RELATIONSHIP & SOCIAL WELLBEING</p>
			<img src="<?php echo base_url();?>assets/assessment/img/pdf/people.png">
			<div class="textFormat">
				<p>Knowing you scores are important, however not adequate. In order
					to truly optimize your relationships and intimacy, you need to work
					on an action plan that you feel is doable, and will keep you
					motivated on a sustainable basis.</p>

				<p>Intimacy involves feelings of emotional closeness and
					connectedness with another person and the desire to share each
					other&#8217;s innermost thoughts and feelings. Intimate
					relationships are characterized by attitudes of mutual trust,
					caring, and acceptance.</p>
				<p>In order to share true intimacy with others, an individual must
					be willing to take emotional risks when they share personal details
					and life stories. Emotional intimacy doesn&#8217;t automatically
					occur with sexual intimacy, as people who are sexually involved may
					still be unable to choose not to share their innermost thoughts and
					feelings.</p>

				<p>In fact, people sometimes find it easier to be emotionally
					intimate with friends than with a sexual partner.</p>

			</div>
		</div>

		<br pagebreak="true" />

		<div class="center textFormat">
			<p>There are 4 key factors to having a healthy and intimate
				relationship:</p>

			<strong> - Knowing and linking yourself</strong>
			<p>Anyone can improve their physical & nutrition health, wellbeing
				and lifestyle. The information in your report will help you and
				family put together a holistic program. Whether its eating clean and
				nutritious foods, walking 10k steps a day, or better managing your
				sleep and water intake, your personal score can be the core of your
				plan.</p>
			<strong>- Trust and care</strong>
			<p>Use your personal wellness reports to identify your health,
				wellbeing and happiness goals. Discover and reach out to over 380
				leading subject matter experts, coaches, and integrative healthcare
				practitioners available on the ZingUpLife platform, and start your
				journey towards being well and living well.</p>

			<strong>- Honesty</strong>
			<p>We recommend you keep a copy of this report in your personal
				health and wellness file. As the weeks and months go by, access the
				assessment inventory to track and measure your personal progress
				towards an optimal balance between mind, body and spirit.</p>
			<br /> <strong>- Communication</strong>
			<p>Communication is a two-way street that embraces sending and
				receiving messages. The clear communicator must therefore learn to
				also be a good listener</p>

		</div>


		<br pagebreak="true" />

		<div class="center">


			<p class="color title">USING YOUR PERSONAL RELATIONSHIP & INTIMACY
				REPORT</p>
			<ol>
				<li><Strong>DEVELOP A WELLNESS PLAN</Strong></li>
				<p style="text-align: justify;">Anyone can improve their
					relationship & intimacy, health, wellbeing and lifestyle. The
					information in your report will help you and family put together a
					holistic program. We recommend couples to identify and take the
					time for each other to have real conversations, and share thoughts,
					feelings and emotions. Listen to your partner, validate and
					celebrate them. Take the route to intimacy in your relationship.</p>

				<li><Strong>DISCOVER & CONSULT</Strong></li>
				<p style="text-align: justify;">Use your personal wellness reports
					to identify your health, wellbeing and happiness goals. Sometimes
					you may need help or guidance to sort through some of the problems,
					feelings or thoughts you have about your relationships. You can
					talk to a relationship counsellor, or explore a program or workshop
					that may help you and your partner optimize your relationship.</p>

				<li><Strong>TRACK & MEASURE YOUR WELLBEING INDEX</Strong></li>
				<p style="text-align: justify;">We recommend you keep a copy of this
					report in your personal health and wellness file. As the weeks and
					months go by, access the assessment inventory to track and measure
					your personal progress towards an optimal balance between mind,
					body and spirit.</p>
			</ol>


		</div>

	</div>
</body>
</html>
