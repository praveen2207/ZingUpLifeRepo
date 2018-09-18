<?php

if (!class_exists('REVIJA_QUICK_VIEW')) {

	class REVIJA_QUICK_VIEW {

		protected $id;

		function __construct($id) {
			$this->id = $id;
			$this->hooks();
		}

		public function hooks() {
			remove_action('woocommerce_after_single_product_summary', 'mad_woocommerce_output_product_data_tabs', 26);
			remove_action('woocommerce_after_single_product_summary', 'mad_woocommerce_shop_link_products', 27);
			remove_action('woocommerce_after_single_product_summary', 'mad_woocommerce_output_related_products', 28);

			if (defined('YITH_WOOCOMPARE')) {
				new YITH_Woocompare_Frontend();
			}
		}

		public function html() {
			$query = array(
				'post_type' => 'product',
				'post__in' => array($this->id)
			);
			$the_query = new WP_Query( $query );
			?>

			<div id="modal-<?php echo esc_attr($this->id) ?>" class="modal-inner-content single-product">
				<button class="popup-close"></button>
				<div class="custom-scrollbar modal-product">
					<div class="row">

						<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

					</div><!--/ .row-->
				</div><!--/ .custom-scrollbar-->
			</div><!--/ .modal-inner-content-->

		<?php
		}
	}

}
