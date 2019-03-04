<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_blog_style = explode('_', quickloans_get_theme_option('blog_style'));
$quickloans_columns = empty($quickloans_blog_style[1]) ? 2 : max(2, $quickloans_blog_style[1]);
$quickloans_post_format = get_post_format();
$quickloans_post_format = empty($quickloans_post_format) ? 'standard' : str_replace('post-format-', '', $quickloans_post_format);
$quickloans_animation = quickloans_get_theme_option('blog_animation');
$quickloans_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($quickloans_columns).' post_format_'.esc_attr($quickloans_post_format) ); ?>
	<?php echo (!quickloans_is_off($quickloans_animation) ? ' data-animation="'.esc_attr(quickloans_get_animation_classes($quickloans_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($quickloans_image[1]) && !empty($quickloans_image[2])) echo intval($quickloans_image[1]) .'x' . intval($quickloans_image[2]); ?>"
	data-src="<?php if (!empty($quickloans_image[0])) echo esc_url($quickloans_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$quickloans_image_hover = 'icon';	//quickloans_get_theme_option('image_hover');
	if (in_array($quickloans_image_hover, array('icons', 'zoom'))) $quickloans_image_hover = 'dots';
	$quickloans_components = quickloans_is_inherit(quickloans_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: quickloans_array_get_keys_by_value(quickloans_get_theme_option('meta_parts'));
	$quickloans_counters = quickloans_is_inherit(quickloans_get_theme_option_from_meta('counters')) 
								? 'comments'
								: quickloans_array_get_keys_by_value(quickloans_get_theme_option('counters'));
	quickloans_show_post_featured(array(
		'hover' => $quickloans_image_hover,
		'thumb_size' => quickloans_get_thumb_size( strpos(quickloans_get_theme_option('body_style'), 'full')!==false || $quickloans_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($quickloans_components)
										? quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
											'components' => $quickloans_components,
											'counters' => $quickloans_counters,
											'seo' => false,
											'echo' => false
											), $quickloans_blog_style[0], $quickloans_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'quickloans') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>