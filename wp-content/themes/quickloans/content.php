<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type()) 
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												. ' itemscope'
												); ?>
		itemscope itemtype="http://schema.org/<?php echo esc_attr(is_single() ? 'BlogPosting' : 'Article'); ?>">
    <div class="post_item_meta_container">
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
        do_action('quickloans_action_before_post_data');

        // Structured data snippets
        if (quickloans_is_on(quickloans_get_theme_option('seo_snippets'))) {
            ?>
            <div class="structured_data_snippets">
                <meta itemprop="headline" content="<?php echo esc_attr(get_the_title()); ?>">
                <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
                <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php echo esc_url(get_the_permalink()); ?>" content="<?php echo esc_attr(get_the_title()); ?>"/>
                <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <?php
                        $quickloans_logo_image = quickloans_get_retina_multiplier(2) > 1
                            ? quickloans_get_theme_option( 'logo_retina' )
                            : quickloans_get_theme_option( 'logo' );
                        if (!empty($quickloans_logo_image)) {
                            $quickloans_attr = quickloans_getimagesize($quickloans_logo_image);
                            ?>
                            <img itemprop="url" src="<?php echo esc_url($quickloans_logo_image); ?>">
                            <meta itemprop="width" content="<?php echo esc_attr($quickloans_attr[0]); ?>">
                            <meta itemprop="height" content="<?php echo esc_attr($quickloans_attr[1]); ?>">
                            <?php
                        }
                        ?>
                    </div>
                    <meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
                    <meta itemprop="telephone" content="">
                    <meta itemprop="address" content="">
                </div>
            </div>
            <?php
        }

        do_action('quickloans_action_before_post_featured');

        // Featured image
        if ( !quickloans_sc_layouts_showed('featured') && strpos(get_the_content(), '[trx_widget_banner]')===false)
            quickloans_show_post_featured();

        // Title and post meta
        if ( (!quickloans_sc_layouts_showed('title') || !quickloans_sc_layouts_showed('postmeta')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
            do_action('quickloans_action_before_post_title');
            ?>
            <div class="post_header entry-header">
                <?php
                // Post title
                if (!quickloans_sc_layouts_showed('title')) {
                    the_title( '<h3 class="post_title entry-title"'.(quickloans_is_on(quickloans_get_theme_option('seo_snippets')) ? ' itemprop="headline"' : '').'>', '</h3>' );
                }
                // Post meta
                if (!quickloans_sc_layouts_showed('postmeta')) {
                    quickloans_show_post_meta(apply_filters('quickloans_filter_post_meta_args', array(
                            'components' => 'categories,author',
                            'counters' => '',
                            'seo' => quickloans_is_on(quickloans_get_theme_option('seo_snippets'))
                        ), 'single', 1)
                    );
                }
                ?>
            </div><!-- .post_header -->
            <?php
        }

        do_action('quickloans_action_before_post_content');

        // Post content
        ?>
        <div class="post_content entry-content" itemprop="articleBody">
            <?php
            the_content( );

            do_action('quickloans_action_before_post_pagination');

            wp_link_pages( array(
                'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'quickloans' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'quickloans' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );

            // Taxonomies and share
            if ( is_single() && !is_attachment() ) {

                do_action('quickloans_action_before_post_meta');

                ?><div class="post_meta post_meta_single"><?php

                // Post taxonomies
                the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'quickloans').'</span> ', ' ', '</span>' );

                // Share
                quickloans_show_share_links(array(
                    'type' => 'block',
                    'caption' => '',
                    'before' => '<span class="post_meta_item post_share">',
                    'after' => '</span>'
                ));
                ?></div><?php

                do_action('quickloans_action_after_post_meta');
            }
            ?>
        </div><!-- .entry-content -->


        <?php
        do_action('quickloans_action_after_post_content');
        ?>
    </div>
    <?php
    // Author bio.
    if ( quickloans_get_theme_option('author_info')==1 && is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {	// && is_multi_author()
        do_action('quickloans_action_before_post_author');
        get_template_part( 'templates/author-bio' );
        do_action('quickloans_action_after_post_author');
    }

    do_action('quickloans_action_after_post_data');
    ?>

</article>
