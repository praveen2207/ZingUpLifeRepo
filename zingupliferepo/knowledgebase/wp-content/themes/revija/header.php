<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
    ==================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Favicons
	==================================================== -->
	<?php if (function_exists('wp_site_icon') && has_site_icon()): ?>
		<?php wp_site_icon(); ?>
	<?php else: ?>
		<?php revija_wp_site_icon(); ?>
	<?php endif; ?>

	<!-- Mobile Specific Metas
	==================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php wp_head(); ?>
</head>

<?php
	$mad_post_id = mad_post_id();
	$mad_layout_scheme = esc_attr(REVIJA_HELPER::page_layout());
?>

<body <?php body_class($mad_layout_scheme); ?>>
	<?php do_action('body_append'); ?>
  
  <!--[if (lt IE 9) | IE 9]>
    <div class="ie_message_block">
      <div class="container">
        <div class="wrapper">
          <div class="clearfix"><i class="fa fa-exclamation-triangle f_left"></i><b>Attention!</b> This page may   not display correctly. You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button button_type_3 button_grey_light f_right" target="_blank">Update Now!</a></div>
        </div>
      </div>
    </div>
  <![endif]-->

	<?php 
	/**
	 * body_prepend hook
	 *
	 * @hooked top_cookie_alert - 10
	 */
	do_action('body_prepend');

	?>

<!-- - - - - - - - - - - - - - wrapper_container - - - - - - - - - - - - - - - - -->

<div class="wrapper_container">

	<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

	<?php $mad_header_layout = rwmb_meta('mad_header_layout', '', $mad_post_id);
		if (empty($mad_header_layout)) {
			$mad_header_layout = mad_custom_get_option('header_layout');
		}
		
	?>
	
	<header class="header <?php echo esc_attr(REVIJA_HELPER::header_layout()) ?>">

		<?php if (mad_custom_get_option('header_top_part') == 'show'): ?>
		<div class="h_top_part">
		<?php
			/**
			 * header_in_before hook
			 *
			 * @hooked mad_header_default_top_part - 10
			 * @hooked mad_header_type_2_top_part - 10
			 */

			do_action('header_in_before');
		?>
		</div><!--/ .h_top_part -->
		<?php endif; ?>
	
		<?php if ($mad_header_layout !== 'header_3' && $mad_header_layout !== 'header_5'): ?>
		<div class="header-in h_bot_part">
			<div class="container">

				<div class="<?php 
				if ($mad_header_layout === 'header_2'){
					echo 'h_bot_part_container';
				} else {
					echo 'row';		
				}
				?>">

					<?php
						/**
						 * header_in_prepend hook
						 *
						 * @hooked mad_header_logo - 10
						 * @hooked mad_header_logo_type_2 - 10
						 */

						do_action('header_in_prepend');
					?>

					<?php
						/**
						 * header_in_append hook
						 *
						 * @hooked TemplatesHooks::header_cart_dropdown - 10
						 */

						do_action('header_in_append');
					?>

				</div><!--/ .row -->
			</div><!--/ .container-->
		</div><!--/ .header-in h_bot_part -->
		<?php endif; ?>

		<?php
			/**
			 *
			 * header_in_after hook
			 *
			 * @hooked header_before_container  - 10
			 */

			do_action('header_in_after');
		?>

			<!--main menu container-->
			<div class="menu_wrap">
				<?php
					/**
					 * navigation_after hook
					 *
					 * @hooked mad_navigation_default - 10
					 */

					do_action('navigation_after');
				?>

			</div><!--/ .menu_wrap -->

	</header><!--/ #header -->

	<!-- - - - - - - - - - - - - - / Header - - - - - - - - - - - - - - -->

	<?php
		/**
		 * header_after hook
		 *
		 * @hooked mad_header_after_breadcrumbs - 10
		 * @hooked mad_portfolio_flex_slider - 10
		 * @hooked mad_layer_slider - 11
		 * @hooked mad_header_after_page_content - 10
		 */

		do_action('header_after');
	?>

	<!-- - - - - - - - - - - - - Page Content - - - - - - - - - - - - - -->

	<?php
		$mad_sidebar_position = REVIJA_HELPER::template_layout_class('sidebar_position');
		$mad_vc_status = get_post_meta( $mad_post_id, '_wpb_vc_js_status', true );

		if ( $mad_vc_status == '' || is_post_type_archive() || is_search() || is_archive() || is_404() ) $mad_vc_status = 'false';
	?>

	<div id="content" class="content <?php if ($mad_vc_status === 'false') { echo 'no_composer'; } ?> <?php echo esc_attr($mad_sidebar_position); ?> ">

		<?php if ($mad_sidebar_position != 'no_sidebar'): ?>

			<div class="container">

				<div class="row">

				
					<?php if (mad_custom_get_option('position_sidebar_mobile') == 'top'): ?>

						<?php get_sidebar(); ?>

					<?php endif; ?>
				
					<main id="main" class="col-lg-8 col-md-8 col-sm-12">

		<?php else: ?>

				<div class="container">

					<div class="row">

						<div class="col-sm-12">

		<?php endif; ?>