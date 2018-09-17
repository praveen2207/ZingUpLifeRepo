<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */


if (rwmb_meta('mad_title_product_tab') !== '') {
	function custom_tab($tabs) {
		$tabs['custom'] = array(
			'title' => rwmb_meta('mad_title_product_tab'),
			'priority' => 50,
			'callback' => 'mad_woocommerce_product_custom_tab'
		);
		return $tabs;
	}
	add_filter('woocommerce_product_tabs', 'custom_tab');
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="section_7 woocommerce-tabs tabs vertical">
		<ul class="tabs tabs_nav">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><h3><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></h3></a>
				</li>

			<?php endforeach; ?>
		</ul>
		<div class="tabs_content">
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>

<div class="clearfix"></div>