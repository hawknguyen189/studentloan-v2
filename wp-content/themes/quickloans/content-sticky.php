<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$quickloans_post_format = get_post_format();
$quickloans_post_format = empty($quickloans_post_format) ? 'standard' : str_replace('post-format-', '', $quickloans_post_format);
$quickloans_animation = quickloans_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($quickloans_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($quickloans_post_format) ); ?>
	<?php echo (!quickloans_is_off($quickloans_animation) ? ' data-animation="'.esc_attr(quickloans_get_animation_classes($quickloans_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	quickloans_show_post_featured(array(
		'thumb_size' => quickloans_get_thumb_size($quickloans_columns==1 ? 'big' : ($quickloans_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($quickloans_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(), 'sticky', $quickloans_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>