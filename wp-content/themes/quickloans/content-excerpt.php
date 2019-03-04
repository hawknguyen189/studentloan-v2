<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_post_format = get_post_format();
$quickloans_post_format = empty($quickloans_post_format) ? 'standard' : str_replace('post-format-', '', $quickloans_post_format);
$quickloans_animation = quickloans_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($quickloans_post_format) ); ?>
	<?php echo (!quickloans_is_off($quickloans_animation) ? ' data-animation="'.esc_attr(quickloans_get_animation_classes($quickloans_animation)).'"' : ''); ?>
><div class="post_item_meta_container">
            <div class="post_item_meta_date"><?php echo get_the_date('j-M'); ?></div>
            <?php
            quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
                    'components' => 'counters',
                    'counters' => 'likes,comments',
                    'seo' => false
                ), 'excerpt', 1)
            );
            ?>

    </div><div class="post_item_content_container">
        <?php

        // Sticky label
        if ( is_sticky() && !is_paged() ) {
            ?><span class="post_label_sticky"><?php esc_html_e('Sticky','quickloans'); ?></span><?php
        }

        // Title and post meta
        if (get_the_title() != '') {
            ?>
            <div class="post_header entry-header">
                <?php
                do_action('quickloans_action_before_post_title');

                // Post title
                the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

                do_action('quickloans_action_before_post_meta');

                // Post meta
                $quickloans_components = quickloans_is_inherit(quickloans_get_theme_option_from_meta('meta_parts'))
                    ? 'categories,author'
                    : quickloans_array_get_keys_by_value(quickloans_get_theme_option('meta_parts'));
                $quickloans_counters = quickloans_is_inherit(quickloans_get_theme_option_from_meta('counters'))
                    ? ''
                    : quickloans_array_get_keys_by_value(quickloans_get_theme_option('counters'));

                if (!empty($quickloans_components))
                    quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
                            'components' => $quickloans_components,
                            'counters' => $quickloans_counters,
                            'seo' => false
                        ), 'excerpt', 1)
                    );

                // Sticky label
                if ( is_sticky() && !is_paged() ) {
                    ?><div class="post_meta_sticky"><?php
                    quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
                            'components' => 'date,author,counters',
                            'counters' => 'comments',
                            'seo' => false
                        ), 'excerpt', 1)
                    );
                    ?></div><?php
                }
                ?>
            </div><!-- .post_header --><?php
        }

        // Featured image
        quickloans_show_post_featured(array( 'thumb_size' => quickloans_get_thumb_size( strpos(quickloans_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

        // Post content
        ?><div class="post_content entry-content"><?php
            if (quickloans_get_theme_option('blog_content') == 'fullpost') {
                // Post content area
                ?><div class="post_content_inner"><?php
                the_content( '' );
                ?></div><?php
                // Inner pages
                wp_link_pages( array(
                    'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'quickloans' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'quickloans' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );

            } else {

                $quickloans_show_learn_more = !in_array($quickloans_post_format, array('link', 'aside', 'status', 'quote'));

                // Post content area
                ?><div class="post_content_inner"><?php
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
                ?></div><?php

                // Post taxonomies
                the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'quickloans').'</span> ', ' ', '</span>' );


                // More button
                if ( $quickloans_show_learn_more ) {
                    ?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Find out more', 'quickloans'); ?></a></p><?php
                }

            }
            ?>
        </div><!-- .entry-content -->
    </div>
</article>