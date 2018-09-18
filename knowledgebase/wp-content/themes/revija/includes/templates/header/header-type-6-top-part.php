<!-- - - - - - - - - - - - Header Top Part- - - - - - - - - - - - - - -->
	<div class="container">
		<div class="row">
				
				<div class="col-xs-12">
                <div class="header_top mobile_menu var2">
				
				
				<nav>
				<?php
					if (has_nav_menu('top')) :
						wp_nav_menu( array(
						'theme_location' => 'top',
						 'container' => false,
						 'menu_class' => '',
						 'menu_id' => 'menu-top',
						 'echo' => true,
						 'depth' => 1,
						 'fallback_cb'=> ''
						 ));
						endif;
						
				?>
				</nav>
				
				
				<div class="login_block custom_box">
                    <ul>
                    <!--Login-->
					<?php if (revija_is_shop_installed()): ?>
					
					<?php $accountPage = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>
						
						<?php if (is_user_logged_in()): ?>
								<?php
								$user_name = revija_get_user_name();
								?>
							<li  class="login_button">
								<span class="welcome_username"><?php echo esc_html_e('Welcome visitor', 'revija') . ', ' . $user_name ?></span>
								<a href="<?php echo wp_logout_url(esc_url(home_url())) ?>" role="button" ><i class="fa fa-user login_icon"></i><?php esc_html_e('Logout', 'revija') ?></a>
							</li>
			
						<?php else: ?>
						
						    <li class="login_button">
							  <a href="#" role="button"><i class="fa fa-user login_icon"></i><?php esc_html_e('Login ', 'revija'); ?></a>
							  <div class="popup">
								<form method="post" class="login">
								  <?php do_action( 'woocommerce_login_form_start' ); ?>
								  <ul>
									<li>
									  <label for="username"><?php esc_html_e( 'Username', 'revija' ); ?></label><br>
									  <input type="text" name="username" id="username"  value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>"  >
									</li>
									<li>
									  <label for="password"><?php esc_html_e( 'Password', 'revija' ); ?></label><br>
									  <input type="password" name="password" id="password">
									</li>
									
									<?php do_action( 'woocommerce_login_form' ); ?>
									
									<li>
										<?php wp_nonce_field( 'woocommerce-login' ); ?>
										<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
										<label for="rememberme" class="inline"><?php esc_html_e( 'Remember me', 'revija' ); ?></label>
									</li>
									
									<li>
									  <input type="submit" class="button button_orange" name="login" value="<?php esc_html_e( 'Log In', 'revija' ); ?>" />
									  <div class="t_align_c">
										<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="color_dark"><?php esc_html_e( 'Lost your password?', 'revija' ); ?></a><br>
										<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="color_dark"><?php esc_html_e( 'Forgot your username?', 'revija' ); ?></a>
									  </div>
									</li>
									
									<?php do_action( 'woocommerce_login_form_end' ); ?>
									
								  </ul>
								</form>
								<section class="login_footer">
								  <h3><?php esc_html_e('New Customer?', 'revija'); ?></h3>
								  <a href="<?php echo esc_url($accountPage) ?>" class="button button_grey" role="button" ><?php esc_html_e('Create an Account', 'revija'); ?></a>
								</section>
							  </div>
							</li>

						<?php endif; ?>
						
					
					<?php else: ?>
		
						<?php if (is_user_logged_in()): ?>

							<li  class="login_button">
								<?php
								$user_name = revija_get_user_name();
								?>

								<span class="welcome_username"><?php echo esc_html_e('Welcome visitor', 'revija') . ', ' . $user_name ?></span>
								<a href="<?php echo wp_logout_url( esc_url(home_url()) ); ?>" role="button" ><i class="fa fa-user login_icon"></i><?php esc_html_e('Logout', 'revija') ?></a>
							</li>

						<?php else: ?>

							<li  class="login_button">
								<a href="<?php echo wp_login_url(); ?>" role="button" ><i class="fa fa-user login_icon"></i><?php esc_html_e('Log In', 'revija') ?></a>
								<?php echo wp_register('', '', false); ?>
							</li>

						<?php endif; ?>
		
					<?php endif; ?>
					
					 <!--language settings-->
					<?php if (defined('ICL_LANGUAGE_CODE')): ?>
						<?php if (mad_custom_get_option('show_language')): ?>
							<li class="lang_button">
								<?php echo REVIJA_WC_WPML_CONFIG::wpml_header_languages_list(); ?>
							</li>
						<?php endif; ?>
					<?php endif; ?>
	
					</ul>
                </div>
				
			
				</div>
				</div>
				
		</div>
	</div>
	<!-- - - - - - - - - - - - Header Top Part- - - - - - - - - - - - - - -->