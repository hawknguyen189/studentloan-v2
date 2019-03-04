<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($quickloans_columns).' post_format_'.esc_attr($quickloans_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!quickloans_is_off($quickloans_animation) ? ' data-animation="'.esc_attr(quickloans_get_animation_classes($quickloans_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$quickloans_image_hover = quickloans_get_theme_option('image_hover');
	// Featured image
	quickloans_show_post_featured(array(
		'thumb_size' => quickloans_get_thumb_size(strpos(quickloans_get_theme_option('body_style'), 'full')!==false || $quickloans_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $quickloans_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $quickloans_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>