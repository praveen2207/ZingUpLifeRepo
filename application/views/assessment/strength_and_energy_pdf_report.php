<!DOCTYPE html>
<html>
<head>
<title>ZingUpLife : Thought Control</title>
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
				&#8216;Strength & Energy&#8217; self-assessment. It&#8217;s good to
				analyze your physical and nutritional wellbeing and identify
				specific areas you can improve on. We&#8217;re glad you&#8217;ve
				taken this first step towards optimizing your personal health &
				wellness, and will now know where you&#8217;re doing well and what
				you can improve on. Good health and wellbeing is important to you,
				to your family and to your future.</p>

			<p class="textFormat">The Strength & Energy assessment evaluates you
				over seven factors &#8212; Appetite, Ergonomics, Physical Activity,
				Nutrition, Sleep, Medical Conditions, and Family History &#8212; to
				come up with a final score.</p>

			<p class="textFormat">In the following section, you can review your
				section score and interpretation. These give you a primary glimpse
				of your overall wellbeing state in this dimension, and helps
				determine action items for tracking, measuring, and optimizing your
				personal health and wellbeing.</p>

			<p class="textFormat">Just like any assessment, a higher score means
				you are at a lower risk and a higher level of wellbeing, and a lower
				score suggests you may be at a higher risk for developing conditions
				related to this specific dimension.</p>

			<p class="textFormat">Thank you for learning more about your
				wellbeing, and for taking steps to optimize it!</p>
		</div>

		<br pagebreak="true" />


		<div class="center">
			<p class="color title">YOUR STRENGTH & ENERGY SCORE</p>
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

			<p class="color">ROUTE TO PHYSICAL & NUTRITIONAL WELLBEING</p>
			<img
				src="<?php echo base_url();?>assets/assessment/img/pdf/screw.png"
				class="center">
			<div class="textFormat">
				<p>Knowing you scores are important, however not adequate. In order
					to truly optimize your strength and energy, you need to work on an
					action plan that you feel is doable, will keep you motivated on a
					sustainable basis.</p>

				<p>Based on your assessment inputs, here is an indicative action
					plan you might like to consider. You can pick and choose activities
					to begin with, that you feel can be sustained over a period of
					time.</p>
				<p>Physical and nutritional wellbeing promotes holistic care of our
					bodies through physical activity, wholesome nutrition, sleep, and a
					strong mind.</p>
				<p>Understanding the relationship and synergy between your
					body&#8217;s physical health and mental health is crucial in order
					to develop holistic and balanced physical wellbeing, strength and
					energy.</p>
				<p></p>
				<p>Physical wellness encourages the principles of good health and
					knowledge, which affect behaviour patterns that lead to a healthy
					and happy lifestyle.</p>



				<p>Here are a few suggestions for you to integrate with your daily
					lifestyle to maintain an optimal level of physical and nutritional
					wellbeing.</p>
				<ul>
					<li class="textFormat">Engage in moderate to high levels of
						physical activity everyday for 30 minutes. Feel free to break-up
						your daily 30 minutes into 10 minute bouts

						<ul class="content-3">
							<li class="textFormat">Almost any kind of physical activity
								promotes health and longevity</li>
							<li class="textFormat">Increasing volume and intensity results in
								additional health benefits</li>
							<li class="textFormat">Moderate to high intensity resistive
								exercises promote strength & endurance</li>
						</ul>
					</li>

					<li class="textFormat">Learn to recognize warning signs when your
						body begins to feel ill or at dis-ease</li>
					<li class="textFormat">Eat a variety of healthy foods and control
						your meal portions</li>
					<li class="textFormat">Maintain a regular sleep schedule and get
						between 7 and 9 hours of sleep each night</li>
					<li class="textFormat">Maintain adequate water intake per day</li>
					<ul class="content-3">
						<li class="textFormat">Recommended intake for men is 125 ounces
							(3.7 litres), while for women it is 91 ounces (2.7 litres)</li>

						<li class="textFormat">Source: The Institute of Medicine (IOM),
							USA</li>
					</ul>
				</ul>

			</div>
		</div>


		<br pagebreak="true" />

		<div class="center">
			<p class="color title">ROUTE TO PHYSICAL & NUTRITIONAL WELLBEING</p>
			<strong>1.&nbsp; DEVELOP A WELLNESS PLAN</strong>
			<p>Anyone can improve their physical & nutrition health, wellbeing
				and lifestyle. The information in your report will help you and
				family put together a holistic program. Whether its eating clean and
				nutritious foods, walking 10k steps a day, or better managing your
				sleep and water intake, your personal score can be the core of your
				plan.</p>
			<strong>2. &nbsp; DISCOVER & CONSULT </strong>
			<p>Use your personal wellness reports to identify your health,
				wellbeing and happiness goals. Discover and reach out to over 380
				leading subject matter experts, coaches, and integrative healthcare
				practitioners available on the ZingUpLife platform, and start your
				journey towards being well and living well.</p>
			<strong>3. &nbsp; TRACK & MEASURE YOUR WELLBEING INDEX </strong>
			<p>We recommend you keep a copy of this report in your personal
				health and wellness file. As the weeks and months go by, access the
				assessment inventory to track and measure your personal progress
				towards an optimal balance between mind, body and spirit.</p>
		</div>
	</div>
</body>
</html>
