<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>

<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	

		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
        <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<p class="form-row-wide form-row-first">
				<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<p class="form-row-wide form-row-last">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />

				
			</p>
			</div>
		</div><!--/ .row-->
		
		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row rememberme">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
			<label for="rememberme" class="inline"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label>
		</p>

		<p class="form-row login_form_confirm">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="submit" class="button button_grey" name="login" value="<?php esc_html_e( 'Login', 'woocommerce' ); ?>" />
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		
				<span class="lost_password">
					<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</span>
		</p>		
				
		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

	

</form>