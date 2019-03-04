<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_link = get_permalink();
$quickloans_post_format = get_post_format();
$quickloans_post_format = empty($quickloans_post_format) ? 'standard' : str_replace('post-format-', '', $quickloans_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($quickloans_post_format) ); ?>><?php
	quickloans_show_post_featured(array(
		'thumb_size' => quickloans_get_thumb_size( (int) quickloans_get_theme_option('related_posts') == 1 ? 'huge' : 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . quickloans_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($quickloans_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($quickloans_link) . '">' . quickloans_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>