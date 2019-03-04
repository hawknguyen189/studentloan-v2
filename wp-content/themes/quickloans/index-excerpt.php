<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

quickloans_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$quickloans_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$quickloans_sticky_out = quickloans_get_theme_option('sticky_style')=='columns' 
							&& is_array($quickloans_stickies) && count($quickloans_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($quickloans_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($quickloans_sticky_out && !is_sticky()) {
			$quickloans_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $quickloans_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($quickloans_sticky_out) {
		$quickloans_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	quickloans_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>