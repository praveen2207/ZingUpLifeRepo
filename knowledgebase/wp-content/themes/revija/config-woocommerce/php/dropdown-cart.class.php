<?php

if (!class_exists('REVIJA_DROPDOWN_CART')) {

	class REVIJA_DROPDOWN_CART {

		function __construct() {
			$this->add_filters();
		}

		public function add_filters() {
			add_filter('add_to_cart_fragments', array(&$this, 'mad_add_to_cart_success_ajax'));
		}

		function mad_add_to_cart_success_ajax( $data ) {
			list( $cart_items, $cart_subtotal, $cart_currency ) = self::get_current_cart_info();

			$data['count'] = $cart_items;
			$data['subtotal'] = $cart_currency . round($cart_subtotal, 2);

			return $data;
		}

		public function get_current_cart_info() {
			global $woocommerce;

			if ( get_option( 'woocommerce_tax_display_cart' ) == 'excl' || $woocommerce->customer->is_vat_exempt() ) {
				$subtotal = $woocommerce->cart->subtotal_ex_tax;
			} else {
				$subtotal = $woocommerce->cart->subtotal;
			}

			$items = count( $woocommerce->cart->get_cart() );

			return array(
				$items,
				$subtotal,
				get_woocommerce_currency_symbol()
			);
		}

		public static function mad_woocommerce_cart_dropdown() {

			global $wpdb, $woocommerce;
			$count = count( $woocommerce->cart->get_cart() );
			$view_cart = $woocommerce->cart->get_cart_url();
			$view_compare = '';
			$count_compare = $count_wishlist = 0;

			if (defined('YITH_WOOCOMPARE')) {
				global $yith_woocompare;
				$view_compare = add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() );
				$count_compare = count($yith_woocompare->obj->products_list);
			}

			if (defined('YITH_WCWL')) {
				if( isset( $_GET['user_id'] ) && !empty( $_GET['user_id'] ) ) {
					$user_id = $_GET['user_id'];
				} elseif( is_user_logged_in() ) {
					$user_id = get_current_user_id();
				}
				$count_wishlist = '';

				if( is_user_logged_in() || ( isset( $user_id ) && !empty( $user_id ) ) ) {
					$count_wishlist = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
					$count_wishlist = $count_wishlist[0]['cnt'];
				} elseif( yith_usecookies() ) {
					$count_wishlist = count( yith_getcookie( 'yith_wcwl_products' ) );
				} else {
					$count_wishlist = count( $_SESSION['yith_wcwl_products'] );
				}
			}

			ob_start(); ?>

			
			<div class="shopping_button button_orange_hover">

					<?php if (mad_custom_get_option('show_cart')): ?>
						<button class="shop_button button">
							<i class="fa fa-shopping-cart"></i>
						</button>
						
						
						<div class="shopping_cart">
							<div class="widget_shopping_cart_content"></div>
						</div>
						
					<?php endif; ?>

				

			</div><!--/ .cart-holder-->

			<?php return ob_get_clean();
		}

		public static function mad_woocommerce_cart_dropdown_type_3() {

			global $wpdb, $woocommerce;
			$count = count( $woocommerce->cart->get_cart() );
			$view_cart = $woocommerce->cart->get_cart_url();
			$view_compare = '';
			$count_compare = $count_wishlist = 0;

			if (defined('YITH_WOOCOMPARE')) {
				global $yith_woocompare;
				$view_compare = add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() );
				$count_compare = count($yith_woocompare->obj->products_list);
			}

			if (defined('YITH_WCWL')) {
				if( isset( $_GET['user_id'] ) && !empty( $_GET['user_id'] ) ) {
					$user_id = $_GET['user_id'];
				} elseif( is_user_logged_in() ) {
					$user_id = get_current_user_id();
				}

				$count_wishlist = '';

				if( is_user_logged_in() || ( isset( $user_id ) && !empty( $user_id ) ) ) {
					$count_wishlist = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
					$count_wishlist = $count_wishlist[0]['cnt'];
				} elseif( yith_usecookies() ) {
					$count_wishlist = count( yith_getcookie( 'yith_wcwl_products' ) );
				} else {
					$count_wishlist = count( $_SESSION['yith_wcwl_products'] );
				}
			}

			ob_start(); ?>

			

					<?php if (mad_custom_get_option('show_wishlist')): ?>
						<li>
							<a class="count-wishlist" href="<?php echo esc_url(get_permalink( get_option('yith_wcwl_wishlist_page_id') )); ?>">
								<span class="count"><?php echo esc_html($count_wishlist) ?></span>
							</a>
						</li>
					<?php endif; ?>

					<?php if (mad_custom_get_option('show_compare')): ?>
						<li>
							<a class="count-compare" href="<?php echo esc_url($view_compare); ?>">
								<span class="count"><?php echo esc_html($count_compare); ?></span>
							</a>
						</li>
					<?php endif; ?>

					<?php if (mad_custom_get_option('show_cart')): ?>
						<li class="login_button shop_button">

							<a href="<?php echo esc_url($view_cart); ?>">
									<i class="fa fa-shopping-cart"></i><?php echo esc_html_e('Cart', 'revija') . '(' . esc_html($count) . ')'; ?>
							</a><!--/ .shopping-button-->

							<div class="shopping_cart">
								<div class="widget_shopping_cart_content"></div>
							</div>
							
						</li>
					<?php endif; ?>

				

			<?php return ob_get_clean();
		}

	}

	new REVIJA_DROPDOWN_CART();

}


