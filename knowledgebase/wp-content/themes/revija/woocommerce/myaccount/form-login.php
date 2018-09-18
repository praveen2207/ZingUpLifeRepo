<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="login-holder">

	<div class="login-container">

		<div class="login-content">

			
				<h3 class="section_title form-field-title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h3>

				<form method="post" class="login">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<div class="row">
					
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<p class="form-row form-row-wide">
							<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
						</p>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<p class="form-row form-row-wide">
							<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input class="input-text" type="password" name="password" id="password" />
							
						</p>
						</div>
					
					</div><!--/ .row-->
					
					<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="form-row">
						<?php wp_nonce_field( 'woocommerce-login' ); ?>
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
						<label for="rememberme" class="inline rememberme"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label>
					</p>

					<p class="form-row login_form_confirm">
						<input type="submit" class="button button_grey" name="login" value="<?php esc_html_e( 'Login', 'woocommerce' ); ?>" />
						
							<span class="lost_password">
								<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
							</span>
					</p>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>


		</div><!--/ .login-content-->

		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

			<div class="registration-content">

				<div id="customer_login">

					<h3 class="section_title form-field-title"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h3>

					<form method="post" class="register">

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<div class="row">
					
						
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<p class="form-row form-row-wide">
									<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
									<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
								</p>
							</div>
								
							<?php endif; ?>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p class="form-row form-row-wide">
								<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
							</p>

							</div>
							
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<p class="form-row form-row-wide">
									<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
									<input type="password" class="input-text" name="password" id="reg_password" />
								</p>

							</div>	
							<?php endif; ?>

						</div><!--/ .row-->
						
						<!-- Spam Trap -->
						<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

						<?php do_action( 'woocommerce_register_form' ); ?>
						<?php do_action( 'register_form' ); ?>

						<p class="form-row login_form_confirm">
							<?php wp_nonce_field( 'woocommerce-register' ); ?>
							<input type="submit" class="button button_grey" name="register" value="<?php esc_html_e( 'Register', 'woocommerce' ); ?>" />
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>

				</div><!--/ .col-2-->

			</div><!--/ .registration-content-->

		<?php endif; ?>

	</div>

</div><!--/ .login-holder-->

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
