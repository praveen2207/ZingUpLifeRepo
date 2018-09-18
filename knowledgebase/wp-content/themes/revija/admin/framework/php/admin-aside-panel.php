<?php
if (!class_exists('REVIJA_ADMIN_ASIDE_PANEL')) {

	class REVIJA_ADMIN_ASIDE_PANEL extends REVIJA_FRAMEWORK {

		function __construct() {
			add_action('init', array(&$this, 'init'));

			add_action('wp_ajax_send_contact_form', array(&$this, 'ajax_send_contact_form'));
			add_action('wp_ajax_nopriv_send_contact_form', array(&$this, 'ajax_send_contact_form'));
		}

		function init() {

			if ( is_admin() ) {

			} else {

				if (mad_custom_get_option('show_admin_panel') == 'show_admin_panel') {
					add_action('body_prepend', array(&$this, 'output_panel'));
					add_action('wp_enqueue_scripts', array( &$this, 'front_extend_js' ) );
				}

			}
		}

		public function ajax_send_contact_form() {

			header( "Content-Type: application/json" );

			$required_fields = array("name", "email", "message");
			$data = $errors = array();
			parse_str($_POST['values'], $data);
			$result = array( 'text' => array('Sending mail error') );

			if (!empty($data)) {

				$emailto = $messages = '';
				$headers = "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\r\n";

				foreach ($data as $key => $value) {
					$name = strtolower(trim($key));
					if (in_array($name, $required_fields)) {
						if (empty($value)) {
							if ($name == "name") {
								$errors[$name] = esc_html__('Please enter your name before sending', 'revija');
							}
							if ($name == "email") {
								if (!$this->isValidEmail($value)) {
									$errors[$name] = esc_html__('Please enter your email before sending', 'revija');
								}
							}
							if ($name == "message") {
								$errors[$name] = esc_html__('Please enter your message', 'revija');
							}
						}
					}
				}

				if (!empty($errors)) {
					$result['status'] = 'error';
					$result['text'] = $errors;
					echo json_encode($result);
					exit;
				}

				if (isset($data['email'])) {
					$from = trim($data['email']);
					$headers .= 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" ;
				}

				foreach ($data as $field => $text) {
					if (!empty($text)) {
						$ucfield = ucfirst($field);
						$text = nl2br($text);
						if (in_array($field, array('name', 'email', 'message'))) {
							$messages .= "<br><strong>{$ucfield}</strong> : {$text}";
						}
					}
				}

				$name = stripslashes($data['name']);
				$emailto = get_option('admin_email');

				if ($emailto) {
					$mail = wp_mail($emailto, $name, $messages, $headers);
					if ($mail) {
						$result = array(
							'status' => 'success',
							'text' => esc_html__('Your message has been sent successfully!', 'revija')
						);
					} else {
						$result['status'] = 'error';
					}
				}
			}

			echo json_encode($result);
			exit();
		}

		public function isValidEmail($email) {
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		public function front_extend_js() {
			wp_enqueue_script(REVIJA_PREFIX . 'front-mod', self::$path['assetsJsURL'] . 'front.js', array('jquery'), 1, true);
		}

		public function vk_output() {

			$show_vk_box = mad_custom_get_option('show_vk_box');
			$vk_title = htmlspecialchars(mad_custom_get_option('vk_title'));
			$vk_widget_community = html_entity_decode(mad_custom_get_option('vk_widget_community'));

			if ($show_vk_box): ?>
				<li>
					<button class="panel-button vk"></button>

					<div class="admin-panel-content">

						<?php if (!empty($vk_title)): ?>
							<h3 class="panel-title"><?php echo esc_html($vk_title); ?></h3>
						<?php endif; ?>

						<?php  ?>

						<?php if (strpos($vk_widget_community, 'vk.com/js/api/')) {
							echo html_entity_decode(mad_custom_get_option('vk_widget_community'));
						} ?>

					</div><!--/ .admin-panel-content-->
				</li>
			<?php endif;
		}

		public function facebook_output() {

			$show_facebook_box = mad_custom_get_option('show_facebook_box');
			$facebook_title = htmlspecialchars(mad_custom_get_option('facebook_title'));
			$pageURL = mad_custom_get_option('facebook_page_url');
			$showHeader = mad_custom_get_option('facebook_show_header');
			$showStream = mad_custom_get_option('facebook_show_stream');

			if ($showHeader == 'yes') {
				$showHeader = "true";
			} else {
				$showHeader = "false";
			}

			if ($showStream == 'yes') {
				$showStream = "true";
			} else {
				$showStream = "false";
			}

			if ($show_facebook_box): ?>
				<li>
					<button class="panel-button facebook"></button>

					<div class="admin-panel-content">

						<?php if (!empty($facebook_title)): ?>
							<h3 class="panel-title"><?php echo esc_html($facebook_title); ?></h3>
						<?php endif; ?>

						<?php if (strlen($pageURL) > 23) {
							$pageURL = esc_url($pageURL);
							echo "<iframe src=\"http://www.facebook.com/plugins/likebox.php?href=$pageURL&amp;width=235&amp;height=258&amp;colorscheme=light&amp;show_border=false&amp;show_faces=false&amp;connections=10&amp;stream=$showStream&amp;header=$showHeader\" style=\"border:none; overflow:hidden; width:235px; height:258px;\" ></iframe>";
						} ?>

					</div><!--/ .admin-panel-content-->
				</li>
			<?php endif;
		}

		public function latest_tweets_output() {

			REVIJA_BASE_FUNCTIONS::enqueue_script('tweet');

			$show_latest_tweets = mad_custom_get_option('show_latest_tweets');
			$show_follow_button = mad_custom_get_option('show_follow_button');
			$latest_tweets_title = htmlspecialchars(mad_custom_get_option('latest_tweets_title'));
			$latest_tweets_username = mad_custom_get_option('latest_tweets_username');
			$latest_tweets_count = mad_custom_get_option('latest_tweets_count');

			if (empty($latest_tweets_count))
				$latest_tweets_count = 2;

			if ($show_latest_tweets): ?>

				<li>

					<button class="panel-button twitter"></button>

					<div class="admin-panel-content <?php if ($show_follow_button != 'show_follow_button') { echo 'no-follow-button'; } ?>">
						<?php if (!empty($latest_tweets_title)): ?>
							<h3 class="panel-title"><?php echo esc_html($latest_tweets_title); ?></h3>
						<?php endif; ?>
						<div class="twitterfeed">
							<?php if ($latest_tweets_username): ?>
								<?php echo do_shortcode('[tweets max="'. esc_attr($latest_tweets_count) .'" user="'. esc_attr($latest_tweets_username) .'"]') ?>
							<?php endif; ?>

							<?php if ($show_follow_button == 'show_follow_button' && !empty($latest_tweets_username)): ?>
								<a target="_blank" class="follow-button" href="https://twitter.com/<?php echo esc_attr($latest_tweets_username) ?>">
									<?php esc_html_e('Follow on Twitter', 'revija') ?>
								</a>
							<?php endif; ?>

						</div><!--/ .twitterfeed-->
					</div><!--/ .admin-panel-content-->

				</li>

			<?php endif;
		}

		public function contact_us_output() {

			$show_contact_us = mad_custom_get_option('show_contact_us');
			$contact_us_title = htmlspecialchars(mad_custom_get_option('contact_us_title'));
			$contact_us_short_text = mad_custom_get_option('contact_us_short_text');

			if ($show_contact_us): ?>
				<li>

					<button class="panel-button contact"></button>

					<div class="admin-panel-content">

						<?php if (!empty($contact_us_title)): ?>
							<h3 class="panel-title"><?php echo esc_html($contact_us_title); ?></h3>
						<?php endif; ?>

						<p class="f_size_medium m_bottom_15"><?php echo html_entity_decode($contact_us_short_text); ?></p>

						<form id="contactform" method="post" class="mini" >
							<input type="text" name="name" placeholder="Your name" />
							<input type="text" name="email" placeholder="Your email">
							<textarea placeholder="Message" name="message"></textarea>
							<button type="submit"><?php esc_html_e('Send', 'revija'); ?></button>
						</form>

					</div><!--/ .admin-panel-content-->

				</li>
			<?php endif;
		}

		public function store_location_output() {

			$show_store_location = mad_custom_get_option('show_store_location');
			$store_location_title = htmlspecialchars(mad_custom_get_option('store_location_title'));
			$store_location_address = mad_custom_get_option('store_location_address');

			$store_location_embed_iframe = wp_kses(
				html_entity_decode(mad_custom_get_option('store_location_embed_iframe')), array(
					'iframe' => array(
						'src' => array(),
						'width' => array(),
						'height' => array(),
						'style' => array())
					)
			);
			$store_location_phone = htmlspecialchars(mad_custom_get_option('store_location_phone'));
			$store_location_email = htmlspecialchars(mad_custom_get_option('store_location_email'));
			$store_location_opening_hours = mad_custom_get_option('store_location_opening_hours');

			if ($show_store_location): ?>
				<li>

					<button class="panel-button googlemap"></button>

					<div class="admin-panel-content">

						<?php if (!empty($store_location_title)): ?>
							<h3 class="panel-title"><?php echo esc_html($store_location_title); ?></h3>
						<?php endif; ?>

						<ul class="info-list">

							<?php if (!empty($store_location_embed_iframe)): ?>
								<li>
									<div class="clearfix m_bottom_15">
										<i class="fa fa-map-marker"></i>
										<p class="contact_e"><?php echo html_entity_decode($store_location_address); ?></p>
									</div>
									<?php echo $store_location_embed_iframe; ?>
								</li>
							<?php endif; ?>

							<?php if (!empty($store_location_phone)): ?>
								<li>
									<div class="clearfix">
										<i class="fa fa-phone"></i>
										<p class="contact_e"><?php echo esc_html($store_location_phone) ?></p>
									</div>
								</li>
							<?php endif; ?>

							<?php if (!empty($store_location_email)): ?>
								<li>
									<div class="clearfix">
										<i class="fa fa-envelope"></i>
										<a class="contact_e" href="mailto:<?php echo esc_url($store_location_email); ?>">
											<?php echo esc_html($store_location_email); ?>
										</a>
									</div>
								</li>
							<?php endif; ?>

							<?php if (!empty($store_location_opening_hours)): ?>
								<li>
									<div class="clearfix">
										<i class="fa fa-clock-o"></i>
										<p class="contact_e"><?php echo html_entity_decode($store_location_opening_hours); ?></p>
									</div>
								</li>
							<?php endif; ?>

						</ul><!--/ .info-list-->

					</div><!--/ .admin-panel-content-->

				</li>
			<?php endif;

		}

		public function instagram_output() {
			$show_instagram = mad_custom_get_option('show_instagram');
			$instagram_title = htmlspecialchars(mad_custom_get_option('instagram_title'));
			$instagram_iframe = wp_kses(
				html_entity_decode(mad_custom_get_option('instagram_iframe')), array(
					'iframe' => array(
						'src' => array(),
						'class' => array(),
						'title' => array(),
						'style' => array())
				)
			);

			if ($show_instagram): ?>
				<li>
					<button class="panel-button instagram"></button>

					<div class="admin-panel-content">

						<?php if (!empty($instagram_title)): ?>
							<h3 class="panel-title"><?php echo esc_html($instagram_title); ?></h3>
						<?php endif; ?>

						<?php if (!empty($instagram_iframe) && preg_match('/^\<iframe/', $instagram_iframe)): ?>
							<?php echo $instagram_iframe; ?>
						<?php endif; ?>

					</div><!--/ .admin-panel-content-->

				</li>
			<?php endif;
		}

		public function output_panel() {
			ob_start(); ?>

			<div class="aside-admin-panel">
				<ul>
					<?php $this->vk_output(); ?>
					<?php $this->facebook_output(); ?>
					<?php $this->latest_tweets_output(); ?>
					<?php $this->contact_us_output(); ?>
					<?php $this->store_location_output(); ?>
					<?php $this->instagram_output(); ?>
				</ul>
			</div><!--/ .aside-admin-panel-->

			<?php echo ob_get_clean();
		}

	}

	new REVIJA_ADMIN_ASIDE_PANEL();

}