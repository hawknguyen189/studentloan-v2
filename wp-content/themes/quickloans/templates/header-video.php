<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.14
 */
$quickloans_header_video = quickloans_get_header_video();
$quickloans_embed_video = '';
if (!empty($quickloans_header_video) && !quickloans_is_from_uploads($quickloans_header_video)) {
	if (quickloans_is_youtube_url($quickloans_header_video) && preg_match('/[=\/]([^=\/]*)$/', $quickloans_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$quickloans_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($quickloans_header_video) . '[/embed]' ));
			$quickloans_embed_video = quickloans_make_video_autoplay($quickloans_embed_video);
		} else {
			$quickloans_header_video = str_replace('/watch?v=', '/embed/', $quickloans_header_video);
			$quickloans_header_video = quickloans_add_to_url($quickloans_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$quickloans_embed_video = '<iframe src="' . esc_url($quickloans_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php quickloans_show_layout($quickloans_embed_video); ?></div><?php
	}
}
?>