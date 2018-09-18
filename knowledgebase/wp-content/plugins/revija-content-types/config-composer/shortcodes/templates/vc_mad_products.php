<?php

class WPBakeryShortCode_VC_mad_products extends WPBakeryShortCode {

	public $atts = array();
	public $products = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' 	 => '',
			'title_type' 		 => 'big',
			'categories' => array(),
			'columns' 	 => 4,
			'items' 	 => 6,
			'sort' 		 => '',
			'orderby' => '',
			'order' => '',
			'show' => '',
			'taxonomy' => 'product_cat',
			'random' => '',
			'sale' => '',
			'filter' 	 => 'no',
			'pagination' => 'no',
			'css_animation' => ''
		), $atts, 'vc_mad_products');

		global $woocommerce;
		if (!is_object($woocommerce) || !is_object($woocommerce->query)) return;

		$this->query();
		return $this->html();
	}

	public function query() {

		global $woocommerce;

		$params = $this->atts;

		$number = $params['items'];
		$orderby = sanitize_title ( $params['orderby'] );
		$order = sanitize_title( $params['order'] );
		$show = $params['show'];

		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		if (!$page || $params['pagination'] == 'no') $page = 1;

		// Meta query
		$meta_query = array();
		$tax_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
		$meta_query[] = $woocommerce->query->stock_status_meta_query();
		$meta_query = array_filter($meta_query);

		if (!empty($params['categories'])) {
			$categories = explode(',', $params['categories']);
			$tax_query = array(
				'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => $categories
					)
			);
		}

		$query = array(
			'post_type' 	 => 'product',
			'post_status' 	 => 'publish',
			'order'   		 => $order == 'asc' ? 'asc' : 'desc',
			'meta_query' 	 => $meta_query,
			'tax_query' 	 => $tax_query,
			'paged' 		 => $page,
			'posts_per_page' => $number
		);

		if ( $orderby != '' ) {
			switch ( $orderby ) {
				case 'price' :
					$query['meta_key'] = '_price';
					$query['orderby']  = 'meta_value_num';
					break;
				case 'rand' :
					$query['orderby']  = 'rand';
					break;
				case 'sales' :
					$query['meta_key'] = 'total_sales';
					$query['orderby']  = 'meta_value_num';
					break;
				default :
					$query['orderby']  = 'date';
					break;
			}
		} else {
			$query['orderby'] = get_option('woocommerce_default_catalog_orderby');
		}

		switch ( $show ) {
			case 'featured' :
				$query['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;
			case 'onsale' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query['post__in'] = $product_ids_on_sale;
				break;
			case 'bestselling':
				$query['ignore_sticky_posts'] = 1;
				$query['meta_key'] = 'total_sales';
				$query['orderby'] = 'meta_value_num';
				break;
			case 'toprated' :
				$query['ignore_sticky_posts'] = 1;
				$query['no_found_rows'] = 1;
				break;
		}

		if ($show == 'toprated')
			add_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );

		$this->products = new WP_Query( $query );

		if ($show == 'toprated')
			remove_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );
	}

	protected function entry_title($title) {
		return "<h2 class='product-title section_title section_title_big'>". esc_html($title) ."</h2>";
	}


	public function getTermsCat($id) {
		$classes = "";
		$item_categories = get_the_terms($id, 'product_cat');
		if (is_object($item_categories) || is_array($item_categories)) {
			foreach ($item_categories as $cat) {
				$classes .= $cat->slug . ' ';
			}
		}
		return $classes;
	}

	public function add_filter_classes($params) {
		if ($params['css_animation'] !== '') {
			add_filter('product_class', array(&$this, 'post_class_animations'));
		}
	}

	public function post_class_animations($classes) {
		$classes[] = $this->getCSSAnimation( $this->atts['css_animation'] );
		return $classes;
	}

	public function getCSSAnimation($css_animation) {
		$output = '';
		if ( $css_animation != '' ) {
			wp_enqueue_script('waypoints');
			$output = ' long animate-' . $css_animation;
		}
		return $output;
	}

	protected function html() {

		global $woocommerce_loop, $wp_query;

		
		$products = $this->products;
		$params = $this->atts;
		$sidebar_position = REVIJA_HELPER::template_layout_class('sidebar_position');

		$type = $title_type = $columns = $filter = $pagination = $shop_columns = $attr = $css_animation = '';

		extract($params);

		$woocommerce_loop['columns'] = $columns;
		
		$shop_columns = 'shop-columns-' . $columns;

		
		ob_start();

		if ( $products->have_posts() ) : ?>

			<?php
				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'products-container ' . $shop_columns . ' ' . $type . ' title-' . $title_type, $this->settings['base'], $params );
			?>

			<div <?php echo $attr ?> class="<?php echo esc_attr($css_class) ?>">

				<?php if (!empty($title)): ?>
					<div class="product-holder">
						<?php if (!empty($title)): ?>
						
							<?php if ($title_type == 'big' ) {?>
								<?php echo $this->entry_title($title); ?>
							<?php } else {?>
							<h3 class="section_title"><?php echo esc_attr($title); ?></h3>
							 <?php }?>
						<?php endif; ?>
					</div><!--/ .product-holder-->
				<?php endif; ?>

				
				<?php if ($filter == "yes") { ?>
				<div class="sorting_block clearfix">	
						<div class="woocommerce-result-count">
							<?php
							$paged    = max( 1, $wp_query->get( 'paged' ) );
							$per_page = $params['items'];
							$total    = $products->found_posts;
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
					
				</div>
				<?php } ?>
	
	
				<div class="shop_product_list">
				<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php $this->add_filter_classes($params); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				</div><!--/ .shop_product_list-->
				
				<?php woocommerce_reset_loop(); ?>

			</div><!--/ .products-container-->

		<?php else : ?>

			<?php if (!woocommerce_product_subcategories(array('before' => '<ul class="products">', 'after' => '</ul>' ))) : ?>
				<div class="woocommerce-error">
					<div class="messagebox_text">
						<p><?php esc_html_e( 'No products found which match your selection.', 'revija' ) ?></p>
					</div><!--/ .messagebox_text-->
				</div><!--/ .woocommerce-error-->
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( $pagination == 'yes'): ?>
		
			<?php echo mad_corenavi($products->max_num_pages); ?>
		<?php endif; ?>

		<?php return ob_get_clean();
	}

}