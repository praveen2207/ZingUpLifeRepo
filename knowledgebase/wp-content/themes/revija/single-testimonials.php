<?php get_header();

if (have_posts()) : while (have_posts()) : the_post(); 

$this_id = get_the_ID();
$link = get_permalink($this_id);
?>

<?php
  revija_setPostViews($this_id);
?>


<div class="portfolio-area">

	<div class="section">
	
		<div class="clearfix page_theme">

			<?php echo mad_portfolio_post_meta($this_id); ?>

		</div>

		<h2 class="section_title section_title_medium_var2"><?php the_title() ?></h2>
	

	</div><!--/ .section-->


	<div class="portfolio-body">

		<?php	
			if (has_post_thumbnail($this_id)) {
				$thumbnail_atts = array(
					'alt'	=> trim(strip_tags(get_the_excerpt())),
					'title'	=> trim(strip_tags(get_the_title($this_id))),
					'class'	=> ''
				);
				$image_size = "80*80";		
				$thumbnail = REVIJA_HELPER::get_the_post_thumbnail($this_id, $image_size, $thumbnail_atts);
				echo "<a href='{$link}' title='". sprintf(esc_attr__('%s', 'revija'), get_the_title($this_id)) ."' class='d_block wrapper m_bottom_15'>{$thumbnail}</a>";
			}
		?>
	
	
		<?php the_content(); ?>
		
		
		<div class="text_post_section add_this">
			<span><?php esc_html_e('Share this:', 'revija') ?></span>
			<div>
			  <!-- AddThis Button BEGIN -->
			  <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
			  </div>
			  <!-- AddThis Button END -->
			  <?php REVIJA_BASE_FUNCTIONS::enqueue_script('addthis'); ?>
			</div>
        </div>

		<?php get_template_part('loop/single', 'link-pages'); ?>
		
		
	</div>
	
	
</div><!--/ .section-line-->	
	
<?php endwhile; ?>

<?php endif;	 ?>
	
	

<?php
get_footer(); ?>