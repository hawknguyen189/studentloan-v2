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
$quickloans_columns = empty($quickloans_blog_style[1]) ? 1 : max(1, $quickloans_blog_style[1]);
$quickloans_expanded = !quickloans_sidebar_present() && quickloans_is_on(quickloans_get_theme_option('expand_content'));
$quickloans_post_format = get_post_format();
$quickloans_post_format = empty($quickloans_post_format) ? 'standard' : str_replace('post-format-', '', $quickloans_post_format);
$quickloans_animation = quickloans_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($quickloans_columns).' post_format_'.esc_attr($quickloans_post_format) ); ?>
	<?php echo (!quickloans_is_off($quickloans_animation) ? ' data-animation="'.esc_attr(quickloans_get_animation_classes($quickloans_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($quickloans_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	quickloans_show_post_featured( array(
											'class' => $quickloans_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => quickloans_get_thumb_size(
																	strpos(quickloans_get_theme_option('body_style'), 'full')!==false
																		? ( $quickloans_columns > 1 ? 'huge' : 'original' )
																		: (	$quickloans_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('quickloans_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('quickloans_action_before_post_meta'); 

			// Post meta
			$quickloans_components = quickloans_is_inherit(quickloans_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'
										: quickloans_array_get_keys_by_value(quickloans_get_theme_option('meta_parts'));
			$quickloans_counters = quickloans_is_inherit(quickloans_get_theme_option_from_meta('counters')) 
										? 'comments'
										: quickloans_array_get_keys_by_value(quickloans_get_theme_option('counters'));
			$quickloans_post_meta = empty($quickloans_components) 
										? '' 
										: quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
												'components' => $quickloans_components,
												'counters' => $quickloans_counters,
												'seo' => false,
												'echo' => false
												), $quickloans_blog_style[0], $quickloans_columns)
											);
			quickloans_show_layout($quickloans_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$quickloans_show_learn_more = !in_array($quickloans_post_format, array('link', 'aside', 'status', 'quote'));
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
				quickloans_show_layout($quickloans_post_meta);
			}
			// More button
			if ( $quickloans_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'quickloans'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>