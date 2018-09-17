<?php

class WPBakeryShortCode_VC_mad_login extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'playerid' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_login');

		$this->content = $content;

		return $this->html();
	}

	protected function entry_title($title) {
		return "<h3 class='section_title'>" . $title . "</h3>";
	}
	
	public function getCSSAnimation($css_animation) {
		$output = false;
		if ( $css_animation == 'yes' ) {
			wp_enqueue_script('waypoints');
			$output = true;
		}
		return $output;
	}
	
	public function html() {

		$title = $css_animation = '';

		extract($this->atts);

		$animation = $this->getCSSAnimation($css_animation);

		$accountPage = '';
		if (class_exists('WooCommerce')) {
		$accountPage = esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') ));
		} else {
		$accountPage = esc_url(wp_login_url());
		}
							
		ob_start() ?>
		
		<div class="section widget_member_login login_form">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title); ?>
			<?php endif; ?>
		
			
			
			 <form action="<?php echo esc_url(wp_login_url( revija_curPageURL() )); ?>" method="post" name="loginform" >
				<ul>
				  <li>
					<input type="text" name="log" id="username" placeholder="Username">
					<i class="fa fa-user"></i>
				  </li>
				  <li>
					<input type="password" name="pwd" id="password" placeholder="Password">
					<i class="fa fa-lock"></i>
				  </li>
				  <li class="clearfix">
					<input type="checkbox" id="rememberme1">
					<label for="rememberme1"><?php esc_html_e( 'Remember me', 'revija' ); ?></label>
					<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="f_right"><?php esc_html_e( 'Forgot your password?', 'revija' ); ?></a>
				  </li>
				</ul>
			 
			  <div class="login_form_confirm">

				<input class="button button_grey orange" type="submit" name="wp-submit" id="wp-submit" value="<?php esc_html_e( 'LOGIN', 'revija' ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
				<span>
				  or
					<?php if ( !is_user_logged_in() ) { ?>
					    <a href="<?php echo esc_url($accountPage); ?>"><?php esc_html_e( 'Register', 'revija' ); ?></a>
					<?php } else {
						$current_user1 = wp_get_current_user();
						?>
						<a href="<?php echo esc_url(wp_logout_url( revija_curPageURL() )); ?>">
							<?php esc_html_e('Logout', 'homeShop'); ?>
						</a>
					<?php } ?>
				</span>
			  </div>
			  
			 </form>
			
			
		</div>
		<?php return ob_get_clean();
	}

}