<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

quickloans_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', quickloans_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'quickloans-gallery-script', quickloans_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$quickloans_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$quickloans_sticky_out = quickloans_get_theme_option('sticky_style')=='columns' 
							&& is_array($quickloans_stickies) && count($quickloans_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$quickloans_cat = quickloans_get_theme_option('parent_cat');
	$quickloans_post_type = quickloans_get_theme_option('post_type');
	$quickloans_taxonomy = quickloans_get_post_type_taxonomy($quickloans_post_type);
	$quickloans_show_filters = quickloans_get_theme_option('show_filters');
	$quickloans_tabs = array();
	if (!quickloans_is_off($quickloans_show_filters)) {
		$quickloans_args = array(
			'type'			=> $quickloans_post_type,
			'child_of'		=> $quickloans_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $quickloans_taxonomy,
			'pad_counts'	=> false
		);
		$quickloans_portfolio_list = get_terms($quickloans_args);
		if (is_array($quickloans_portfolio_list) && count($quickloans_portfolio_list) > 0) {
			$quickloans_tabs[$quickloans_cat] = esc_html__('All', 'quickloans');
			foreach ($quickloans_portfolio_list as $quickloans_term) {
				if (isset($quickloans_term->term_id)) $quickloans_tabs[$quickloans_term->term_id] = $quickloans_term->name;
			}
		}
	}
	if (count($quickloans_tabs) > 0) {
		$quickloans_portfolio_filters_ajax = true;
		$quickloans_portfolio_filters_active = $quickloans_cat;
		$quickloans_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters quickloans_tabs quickloans_tabs_ajax">
			<ul class="portfolio_titles quickloans_tabs_titles">
				<?php
				foreach ($quickloans_tabs as $quickloans_id=>$quickloans_title) {
					?><li><a href="<?php echo esc_url(quickloans_get_hash_link(sprintf('#%s_%s_content', $quickloans_portfolio_filters_id, $quickloans_id))); ?>" data-tab="<?php echo esc_attr($quickloans_id); ?>"><?php echo esc_html($quickloans_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$quickloans_ppp = quickloans_get_theme_option('posts_per_page');
			if (quickloans_is_inherit($quickloans_ppp)) $quickloans_ppp = '';
			foreach ($quickloans_tabs as $quickloans_id=>$quickloans_title) {
				$quickloans_portfolio_need_content = $quickloans_id==$quickloans_portfolio_filters_active || !$quickloans_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $quickloans_portfolio_filters_id, $quickloans_id)); ?>"
					class="portfolio_content quickloans_tabs_content"
					data-blog-template="<?php echo esc_attr(quickloans_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(quickloans_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($quickloans_ppp); ?>"
					data-post-type="<?php echo esc_attr($quickloans_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($quickloans_taxonomy); ?>"
					data-cat="<?php echo esc_attr($quickloans_id); ?>"
					data-parent-cat="<?php echo esc_attr($quickloans_cat); ?>"
					data-need-content="<?php echo (false===$quickloans_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($quickloans_portfolio_need_content) 
						quickloans_show_portfolio_posts(array(
							'cat' => $quickloans_id,
							'parent_cat' => $quickloans_cat,
							'taxonomy' => $quickloans_taxonomy,
							'post_type' => $quickloans_post_type,
							'page' => 1,
							'sticky' => $quickloans_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		quickloans_show_portfolio_posts(array(
			'cat' => $quickloans_cat,
			'parent_cat' => $quickloans_cat,
			'taxonomy' => $quickloans_taxonomy,
			'post_type' => $quickloans_post_type,
			'page' => 1,
			'sticky' => $quickloans_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>