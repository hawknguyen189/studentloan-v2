<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

// Page (category, tag, archive, author) title

if ( quickloans_need_page_title() ) {
	quickloans_sc_layouts_showed('title', true);
	quickloans_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal scheme_dark">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_left">
						<?php

						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$quickloans_blog_title = quickloans_get_blog_title();
							$quickloans_blog_title_text = $quickloans_blog_title_class = $quickloans_blog_title_link = $quickloans_blog_title_link_text = '';
							if (is_array($quickloans_blog_title)) {
								$quickloans_blog_title_text = $quickloans_blog_title['text'];
								$quickloans_blog_title_class = !empty($quickloans_blog_title['class']) ? ' '.$quickloans_blog_title['class'] : '';
								$quickloans_blog_title_link = !empty($quickloans_blog_title['link']) ? $quickloans_blog_title['link'] : '';
								$quickloans_blog_title_link_text = !empty($quickloans_blog_title['link_text']) ? $quickloans_blog_title['link_text'] : '';
							} else
								$quickloans_blog_title_text = $quickloans_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($quickloans_blog_title_class); ?>"><?php
								$quickloans_top_icon = quickloans_get_category_icon();
								if (!empty($quickloans_top_icon)) {
									$quickloans_attr = quickloans_getimagesize($quickloans_top_icon);
									?><img src="<?php echo esc_url($quickloans_top_icon); ?>" <?php if (!empty($quickloans_attr[3])) quickloans_show_layout($quickloans_attr[3]);?>><?php
								}
								echo wp_kses_data($quickloans_blog_title_text);
							?></h1>
							<?php
							if (!empty($quickloans_blog_title_link) && !empty($quickloans_blog_title_link_text)) {
								?><a href="<?php echo esc_url($quickloans_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($quickloans_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'quickloans_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>