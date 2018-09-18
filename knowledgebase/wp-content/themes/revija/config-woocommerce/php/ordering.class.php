<?php

if (!class_exists('REVIJA_CATALOG_ORDERING')) {

	class REVIJA_CATALOG_ORDERING {

		function __construct() { }

		public function woocoomerce_build_query_string ($params = array(), $key, $value) {
			$params[$key] = $value;
			$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
			return "?" . $paged . http_build_query($params);
		}

		public function output() {

			global $woocommerce_loop, $revija_config, $wp_query;

			ob_start();
			?>

			
			<div class="sorting_block clearfix">	
						<div class="woocommerce-result-count">
							<?php
							// $product_per_page = mad_custom_get_option('woocommerce_product_count');
							// if (!$product_per_page) {
								// $product_per_page = get_option('posts_per_page');
							// }
							$paged    = max( 1, $wp_query->get( 'paged' ) );
							$per_page = $wp_query->get( 'posts_per_page' );
							$total    = $wp_query->found_posts;
							$first    = ( $per_page * $paged ) - $per_page + 1;
							$last     = min( $total, $per_page * $paged );

							
							
							if ( 1 == $total ) {
								esc_html_e( 'Showing the single result', 'woocommerce' );
							} elseif ( $total <= $per_page || -1 == $per_page ) {
								printf( esc_html__( 'Showing all %d results', 'woocommerce' ), $total );
							} else {
								printf( _x( 'Showing %1$d–%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
							}
							?>
						</div>
						
						
						
						
						<div>
						<?php
							woocommerce_catalog_ordering();
							parse_str($_SERVER['QUERY_STRING'], $params);

							

							$product_count_key = !empty($revija_config['woocommerce']['product_count']) ? $revija_config['woocommerce']['product_count'] : $per_page;
							$product_sort_key = !empty($revija_config['woocommerce']['product_sort']) ? $revija_config['woocommerce']['product_sort'] : 'asc';
							$product_sort_key = strtolower($product_sort_key);
						?>
						</div>
						
						
						
						
					
			</div>
			
			

			<?php return ob_get_clean();
		}

	}
}

?>
