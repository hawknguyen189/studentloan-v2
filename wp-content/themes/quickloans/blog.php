<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$quickloans_content = '';
$quickloans_blog_archive_mask = '%%CONTENT%%';
$quickloans_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $quickloans_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($quickloans_content = apply_filters('the_content', get_the_content())) != '') {
		if (($quickloans_pos = strpos($quickloans_content, $quickloans_blog_archive_mask)) !== false) {
			$quickloans_content = preg_replace('/(\<p\>\s*)?'.$quickloans_blog_archive_mask.'(\s*\<\/p\>)/i', $quickloans_blog_archive_subst, $quickloans_content);
		} else
			$quickloans_content .= $quickloans_blog_archive_subst;
		$quickloans_content = explode($quickloans_blog_archive_mask, $quickloans_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) quickloans_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$quickloans_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$quickloans_args = quickloans_query_add_posts_and_cats($quickloans_args, '', quickloans_get_theme_option('post_type'), quickloans_get_theme_option('parent_cat'));
$quickloans_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($quickloans_page_number > 1) {
	$quickloans_args['paged'] = $quickloans_page_number;
	$quickloans_args['ignore_sticky_posts'] = true;
}
$quickloans_ppp = quickloans_get_theme_option('posts_per_page');
if ((int) $quickloans_ppp != 0)
	$quickloans_args['posts_per_page'] = (int) $quickloans_ppp;
// Make a new query
query_posts( $quickloans_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($quickloans_content) && count($quickloans_content) == 2) {
	set_query_var('blog_archive_start', $quickloans_content[0]);
	set_query_var('blog_archive_end', $quickloans_content[1]);
}

get_template_part('index');
?>