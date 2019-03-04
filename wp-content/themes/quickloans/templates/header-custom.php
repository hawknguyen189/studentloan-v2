<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.06
 */

$quickloans_header_css = $quickloans_header_image = '';
$quickloans_header_video = quickloans_get_header_video();
if (true || empty($quickloans_header_video)) {
	$quickloans_header_image = get_header_image();
	if (quickloans_is_on(quickloans_get_theme_option('header_image_override')) && apply_filters('quickloans_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($quickloans_cat_img = quickloans_get_category_image()) != '')
				$quickloans_header_image = $quickloans_cat_img;
		} else if (is_singular() || quickloans_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$quickloans_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($quickloans_header_image)) $quickloans_header_image = $quickloans_header_image[0];
			} else
				$quickloans_header_image = '';
		}
	}
}

$quickloans_header_id = str_replace('header-custom-', '', quickloans_get_theme_option("header_style"));
$quickloans_header_meta = get_post_meta($quickloans_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($quickloans_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($quickloans_header_id)));
						echo !empty($quickloans_header_image) || !empty($quickloans_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($quickloans_header_video!='') 
							echo ' with_bg_video';
						if ($quickloans_header_image!='') 
							echo ' '.esc_attr(quickloans_add_inline_css_class('background-image: url('.esc_url($quickloans_header_image).');'));
						if (!empty($quickloans_header_meta['margin']) != '') 
							echo ' '.esc_attr(quickloans_add_inline_css_class('margin-bottom: '.esc_attr(quickloans_prepare_css_value($quickloans_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (quickloans_is_on(quickloans_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(quickloans_is_inherit(quickloans_get_theme_option('header_scheme')) 
														? quickloans_get_theme_option('color_scheme') 
														: quickloans_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($quickloans_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('quickloans_action_show_layout', $quickloans_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>