<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_post_id    = get_the_ID();
$quickloans_post_date  = quickloans_get_date();
$quickloans_post_title = get_the_title();
$quickloans_post_link  = get_permalink();
$quickloans_post_author_id   = get_the_author_meta('ID');
$quickloans_post_author_name = get_the_author_meta('display_name');
$quickloans_post_author_url  = get_author_posts_url($quickloans_post_author_id, '');

$quickloans_args = get_query_var('quickloans_args_widgets_posts');
$quickloans_show_date = isset($quickloans_args['show_date']) ? (int) $quickloans_args['show_date'] : 1;
$quickloans_show_image = isset($quickloans_args['show_image']) ? (int) $quickloans_args['show_image'] : 1;
$quickloans_show_author = isset($quickloans_args['show_author']) ? (int) $quickloans_args['show_author'] : 1;
$quickloans_show_counters = isset($quickloans_args['show_counters']) ? (int) $quickloans_args['show_counters'] : 1;
$quickloans_show_categories = isset($quickloans_args['show_categories']) ? (int) $quickloans_args['show_categories'] : 1;

$quickloans_output = quickloans_storage_get('quickloans_output_widgets_posts');

$quickloans_post_counters_output = '';
if ( $quickloans_show_counters ) {
	$quickloans_post_counters_output = '<span class="post_info_item post_info_counters">'
								. quickloans_get_post_counters('comments')
							. '</span>';
}


$quickloans_output .= '<article class="post_item with_thumb">';

if ($quickloans_show_image) {
	$quickloans_post_thumb = get_the_post_thumbnail($quickloans_post_id, quickloans_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($quickloans_post_thumb) $quickloans_output .= '<div class="post_thumb">' . ($quickloans_post_link ? '<a href="' . esc_url($quickloans_post_link) . '">' : '') . ($quickloans_post_thumb) . ($quickloans_post_link ? '</a>' : '') . '</div>';
}

$quickloans_output .= '<div class="post_content">'
			. ($quickloans_show_categories 
					? '<div class="post_categories">'
						. quickloans_get_post_categories()
						. $quickloans_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($quickloans_post_link ? '<a href="' . esc_url($quickloans_post_link) . '">' : '') . ($quickloans_post_title) . ($quickloans_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('quickloans_filter_get_post_info', 
								'<div class="post_info">'
									. ($quickloans_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($quickloans_post_link ? '<a href="' . esc_url($quickloans_post_link) . '" class="post_info_date">' : '') 
											. esc_html($quickloans_post_date) 
											. ($quickloans_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($quickloans_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'quickloans') . ' ' 
											. ($quickloans_post_link ? '<a href="' . esc_url($quickloans_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($quickloans_post_author_name) 
											. ($quickloans_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$quickloans_show_categories && $quickloans_post_counters_output
										? $quickloans_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
quickloans_storage_set('quickloans_output_widgets_posts', $quickloans_output);
?>