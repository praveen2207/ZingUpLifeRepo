<?php
/**
 * Custom tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly
	exit;
}

?>

<?php if (rwmb_meta('mad_content_product_tab') !== ''): ?>

	<?php
	$content = rwmb_meta('mad_content_product_tab');
	preg_match("!\[embed.+?\]|\[video.+?\]!", $content, $match_video);

	if (!empty($match_video)) {
		global $wp_embed;

		$video = $match_video[0];
		$before = "<div class='image-overlay'>";
			$before .= "<div class='entry-media photoframe'>";
			$before .= do_shortcode($wp_embed->run_shortcode($video));
			$before .= "</div>";
		$before .= "</div>";
		$before = apply_filters('the_content', $before);
		echo $before;
	} else {
		echo $content;
	}
	?>
<?php endif; ?>