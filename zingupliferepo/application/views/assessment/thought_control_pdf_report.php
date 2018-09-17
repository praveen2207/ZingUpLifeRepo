<!Doctype>
<html>

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
				&#8216;Thought Control&#8217; self-assessment - a measure of your
				emotional control and thought regulation. Individuals who
				demonstrate high levels of thought control are better at
				understanding themselves and others, making confident decisions and
				expressing their views well. They have also been found to
				effectively manage their emotions, and have the drive, energy and
				optimism to succeed.</p>
			<p class="textFormat">The Thought Control assessment evaluates you
				over five factors - Addiction, Anger Management, Depression,
				Grieving & OCD - to come up with a final score.</p>
			<p class="textFormat">This assessment can be used as a tool to
				facilitate your personal and emotional development, as a starting
				point to begin exploring possible development needs and to produce a
				strategy for promoting your emotional competencies.</p>
			<p class="textFormat">Just like any assessment, the higher the score,
				the greater the tendency to exhibit effective behaviours as compared
				to others and a lower score represents a reduced likelihood of
				behaving in a particular manner.</p>
			<p class="textFormat">Thank you for learning more about your
				wellbeing and for taking steps to optimize it!</p>

		</div>

		<br pagebreak="true" />


		<div class="center">
			<p class="color title">YOUR THOUGHT CONTROL SCORE</p>
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
    			<?php
    
    foreach ($interpretation as $inter) {
        echo "<p>" . $inter['interpretation_text'] . "</p>";
    }
    ?>
			</div>
		</div>

		<br pagebreak="true" />


		<div class="center">

			<p class="color title">ROUTE TO EMOTIONAL & MENTAL WELLBEING</p>
			<img
				src="<?php echo base_url();?>assets/assessment/img/pdf/mentalwellbeing.png"
				class="center">
			<div class="textFormat">
				<p>Knowing you scores are important, however not adequate. In order
					to truly optimize your emotional intelligence and thought control,
					you need to work on an action plan that you feel is doable, and
					will keep you motivated on a sustainable basis.</p>

				<p>Thought control and emotional intelligence impacts success in
					both work and life that require social interaction and the ability
					to remain calm, enthusiastic and optimistic.</p>
				<p>Many low scorers tend to be uninterested in self-analysis,
					indifferent to their own thoughts and emotions, and may be
					unreflective, while high scorers tend to be self-aware, in touch
					with their own thoughts and emotions, and are introspective.
					Similarly low scores generally indicate pessimism and a
					temperamental attitude, while high scores indicate optimism and an
					even-tempered attitude.</p>

				<p>There are 5 critical factors related to emotional and thought
					control that can help change your life</p>
				<ul>
					<li><Strong>Self-awareness</Strong></li>
					<p style="text-align: justify;">Pay attention to how others are
						reacting to you, in order to adjust or correct course accordingly.</p>
					<li><Strong>Self-regulation</Strong></li>
					<p style="text-align: justify;">This is the ability to think before
						you speak. Being aware of how you may be affecting others is one
						thing, but without the ability to act on that awareness, you will
						not be likely to control thoughts in times of high stress and
						pressure.</p>
					<li><Strong>Motivation</Strong></li>
					<p style="text-align: justify;">Consistently keeping in mind your
						values and goals for set periods of time will only serve to
						improve your position in your personal and work life as time goes
						on</p>
					<li><Strong>Empathy</Strong></li>
					<p style="text-align: justify;">Empathize with others in a way that
						helps to analyze what may be affecting them, and consider your
						options around helping them work more effectively.</p>
					<li><Strong>Social Skills</Strong></li>
					<p>Network! Every person you meet has the potential to benefit you
						in ways you wouldn"t imagine.</p>
				</ul>

			</div>

		</div>




		<br pagebreak="true" />

		<div class="center">


			<p class="color title">USING YOUR PERSONAL THOUGHT CONTROL REPORT</p>
			<ol>

				<li><Strong>DEVELOP A WELLNESS PLAN</Strong></li>
				<p style="text-align: justify;">Anyone can improve their emotional
					health, wellbeing and lifestyle. The information in your report
					will help you and family put together a holistic program. With all
					that&#8217;s going on in your day-to-day life, busy work schedule,
					or personal commitments, control over your thoughts and emotions
					can benefit you greatly in a number of ways.</p>

				<li><Strong>DISCOVER & CONSULT</Strong></li>
				<p style="text-align: justify;">Use your personal wellness reports
					to identify your health, wellbeing and happiness goals. Discover
					and reach out to over 380 leading subject matter experts, coaches,
					and integrative healthcare practitioners available on the
					ZingUpLife platform, and start your journey towards being well and
					living well.</p>

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


