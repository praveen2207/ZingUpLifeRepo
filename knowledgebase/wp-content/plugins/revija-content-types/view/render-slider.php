<?php if (!empty($portfolio_images)): ?>

	<?php
		$slideshow = $params[0]['slideshow'];
		$slideshowSpeed = !empty($params[0]['slideshowSpeed']) ? $params[0]['slideshowSpeed'] : 5000;
		$this_id = get_the_ID();
		
	?>

	<?php if (!empty($portfolio_images)): 
	
	?>

		<div class="tp-banner-container portfolio-extended-slider ">

			<div class="portfolio-single-slider rev_slider">
				<ul class="slides">
					<?php foreach ($portfolio_images as $image): 
					
					// if ( $image > 0 ) {
					// $post_thumbnail = array();
					// $thumbnail_atts = array(
						// 'class'	=> "tr_all_long_hover",
						// 'alt'	=> '',
						// 'title'	=> ''
					// );
					// $post_thumbnail['thumbnail'] = MAD_HELPER::get_the_thumbnail($image, '750*374', $thumbnail_atts);
					// $post_thumbnail['img_large'] = MAD_HELPER::get_post_attachment_image($image, '');
					// } else {
						// $post_thumbnail = array();
						// $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
						// $post_thumbnail['img_large'] = vc_asset_url( 'vc/no_image.png' );
					// }
					// $thumbnail = $post_thumbnail['thumbnail'];
					// $img_large = $post_thumbnail['img_large'];
					?>
						<li data-transition="fade" data-slotamount="10" >
						<img src="<?php echo esc_url($image['url']) ?>" alt="<?php echo esc_attr($image['title']) ?>">
						</li>
						
						
					<?php endforeach; ?>
				</ul><!--/ .slides-->
			</div><!--/ .portfolio-single-slider -->

			<script>

				(function ($) {

					$(function () {

						var $sl = $('.portfolio-single-slider');

						if ($sl.length) {
						$sl.revolution({
							delay:<?php echo ($slideshowSpeed); ?>,
							startwidth:1170,
							startheight:500,
							hideThumbs:0,
							fullWidth:"on",
							hideTimerBar:"on",
							soloArrowRightHOffset:30,
							soloArrowLeftHOffset:30,
							shadow:0
						  });

						  $sl.parent().find('.tp-bullets').remove();

						}

					});

				})(jQuery);

			</script>

			
			
			
			
			
			
	<div class="caption_type_1 var2">
        <div class="caption_inner">
          <div class="container">
            <div class="rev_caption">
              <div class="clearfix page_theme">
               <?php echo mad_portfolio_post_meta($this_id); ?>
              </div>
              <a href="<?php echo get_permalink($this_id);  ?>"><h2><?php the_title(); ?></h2></a>
            </div>
          </div>
        </div>
    </div>
			
			
			
			
			
			
			
			
			
		</div><!--/ .full-slider -->

	<?php endif; ?>

<?php endif; ?>


