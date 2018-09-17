<!DOCTYPE html>
<html>
<head>
<title>ZingUpLife : Zest for life</title>
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
			<p class="textFormat">Congratulations on completing your &#8216;Zest
				for Life&#8217; self-assessment &#8211; a measure of your
				enthusiasm, satisfaction, and quality of your life and work
				situations. This assessment may help promote an understanding of the
				behaviours and inner motivations of individuals in daily life.</p>
			<p class="textFormat">The Zest for Life assessment evaluates you over
				five factors &#8211; Breathing, Passion, Work-Life Balance, Positive
				Thinking, Self-Connectivity, and Sensing &#8211; to come up with a
				final score.</p>

			<p class="textFormat">&#8216;Zest for living&#8217; (Ikiruchikara)
				was originally considered a part of the social life and culture of
				Japanese people. It has become a key point in the philosophy of
				Japanese teaching. In the Japanese version of 21st century skills,
				&#8216;zest for living&#8217; seeks to promote the qualities and
				abilities necessary to steadily acquire the basics of education and
				to have self-learning abilities, as well as to develop
				problem-solving skills and to acquire skills for relating with
				others.</p>

			<p class="textFormat">Just like any assessment, a higher score
				indicates a heightened ability to form relationships and use
				information, with better planning and decision-making abilities.</p>

			<p class="textFormat">Thank you for learning more about your
				wellbeing and for taking steps to optimize it!</p>
			<br />

		</div>
		<br pagebreak="true" />
		<div class="center">
			<p class="color title">YOUR ZEST FOR LIFE SCORE</p>
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

			<p class="color title">ROUTE TO ZEST & MINDFULNESS IN LIFE</p>
			<img
				src="<?php echo base_url();?>assets/assessment/img/pdf/zest-mindfulness.png"
				class="center">
			<div class="textFormat">
				<p>Knowing you scores are important, however not adequate. In order
					to truly optimize your zest and quality of life, you need to work
					on an action plan that you feel is doable, and will keep you
					motivated on a sustainable basis.</p>

				<p>Zest is practically a happy trait by definition. Unsurprisingly,
					then, individuals high in zest tend to be more satisfied with their
					lives. Meanwhile, those low in zest tend to have remarkably low
					life satisfaction. On the job, zestful people turn their enthusiasm
					and energy to the work itself, and are motivated by the enjoyment
					and meaning they get out of work.</p>
				<p>Zest isn&#8217;t just linked to an excessively joyful type of
					happiness; it&#8217;s associated with several different forms, and
					is linked to these three ways to be happy &#8211; a life of
					pleasure, a life of engagement, and a life of meaning.</p>
			</div>
			<br pagebreak="true" />
			<div class="textFormat">
				<p>Here are a few suggestions for increasing zest in life:</p>
				<ul>
					<li><Strong>Taking care of your body</Strong></li>
					<p style="text-align: justify;">
						o Eat well, get enough sleep, and avoid smoking, alcohol and
						substance abuse<br /> o Drink enough water to support optimal body
						functions<br /> o Practice breathing & relaxation techniques on a
						daily basis<br /> o Exercise can make us especially more zestful
						if it&#8217;s fun
					</p>
					<li><Strong>Practice savoring</Strong></li>
					<p style="text-align: justify;">Zest involves feeling fully engaged
						in the world around us, with all our senses coming alive. One way
						to practice is through meditation and mindfulness.</p>
					<li><Strong>Cultivate optimism</Strong></li>
					<p style="text-align: justify;">o Feeling hopeful can help boost
						our excitement and overall sense of wellbeing</p>
					<li><Strong>Get social</Strong></li>
					<p style="text-align: justify;">o Try spending time with close
						friends, cultivating your relationships with professional
						colleagues, or participating in social activities to boost your
						zest for life .</p>
					<li><Strong>Experience nature</Strong></li>
					<p>o Being simply close to nature &#8211; with or without physical
						exercise &#8211; can make us feel more zestful and joyful</p>
				</ul>
			</div>

		</div>

		<br pagebreak="true" />

		<div class="center">


			<p class="color title">USING YOUR PERSONAL ZEST FOR LIFE REPORT</p>
			<ol>
				<li><Strong>DEVELOP A WELLNESS PLAN</Strong></li>
				<p style="text-align: justify;">Anyone can improve their quality of
					life, health, wellbeing and lifestyle. The information in your
					report will help you and family put together a holistic program.
					Zest is among the top character strengths that positive
					psychologists have defined and studied as keys to living a happy
					and fulfilling life.</p>

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
