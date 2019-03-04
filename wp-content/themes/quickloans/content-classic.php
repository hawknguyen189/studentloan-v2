<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_blog_style = explode('_', quickloans_get_theme_option('blog_style'));
$quickloans_columns = empty($quickloans_blog_style[1]) ? 2 : max(2, $quickloans_blog_style[1]);
$quickloans_expanded = !quickloans_sidebar_present() && quickloans_is_on(quickloans_get_theme_option('expand_content'));
$quickloans_post_format = get_post_format();
$quickloans_post_format = empty($quickloans_post_format) ? 'standard' : str_replace('post-format-', '', $quickloans_post_format);
$quickloans_animation = quickloans_get_theme_option('blog_animation');
$quickloans_components = quickloans_is_inherit(quickloans_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date'
							: quickloans_array_get_keys_by_value(quickloans_get_theme_option('meta_parts'));
$quickloans_counters = quickloans_is_inherit(quickloans_get_theme_option_from_meta('counters')) 
							? 'comments'
							: quickloans_array_get_keys_by_value(quickloans_get_theme_option('counters'));

?><div class="<?php echo esc_html($quickloans_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($quickloans_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($quickloans_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($quickloans_columns)
					. ' post_layout_'.esc_attr($quickloans_blog_style[0]) 
					. ' post_layout_'.esc_attr($quickloans_blog_style[0]).'_'.esc_attr($quickloans_columns)
					); ?>
	<?php echo (!quickloans_is_off($quickloans_animation) ? ' data-animation="'.esc_attr(quickloans_get_animation_classes($quickloans_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	quickloans_show_post_featured( array( 'thumb_size' => quickloans_get_thumb_size($quickloans_blog_style[0] == 'classic'
													? (strpos(quickloans_get_theme_option('body_style'), 'full')!==false 
															? ( $quickloans_columns > 2 ? 'big' : 'huge' )
															: (	$quickloans_columns > 2
																? ($quickloans_expanded ? 'med' : 'small')
																: ($quickloans_expanded ? 'big' : 'med')
																)
														)
													: (strpos(quickloans_get_theme_option('body_style'), 'full')!==false 
															? ( $quickloans_columns > 2 ? 'masonry-big' : 'full' )
															: (	$quickloans_columns <= 2 && $quickloans_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($quickloans_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('quickloans_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('quickloans_action_before_post_meta'); 

			// Post meta
			if (!empty($quickloans_components))
				quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
					'components' => $quickloans_components,
					'counters' => $quickloans_counters,
					'seo' => false
					), $quickloans_blog_style[0], $quickloans_columns)
				);

			do_action('quickloans_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$quickloans_show_learn_more = false; //!in_array($quickloans_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($quickloans_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($quickloans_post_format == 'quote') {
				if (($quote = quickloans_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					quickloans_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($quickloans_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($quickloans_components))
				quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
					'components' => $quickloans_components,
					'counters' => $quickloans_counters
					), $quickloans_blog_style[0], $quickloans_columns)
				);
		}
		// More button
		if ( $quickloans_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'quickloans'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>