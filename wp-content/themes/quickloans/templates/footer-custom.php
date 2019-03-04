<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.10
 */

$quickloans_footer_scheme =  quickloans_is_inherit(quickloans_get_theme_option('footer_scheme')) ? quickloans_get_theme_option('color_scheme') : quickloans_get_theme_option('footer_scheme');
$quickloans_footer_id = str_replace('footer-custom-', '', quickloans_get_theme_option("footer_style"));
$quickloans_footer_meta = get_post_meta($quickloans_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($quickloans_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($quickloans_footer_id))); 
						if (!empty($quickloans_footer_meta['margin']) != '') 
							echo ' '.esc_attr(quickloans_add_inline_css_class('margin-top: '.esc_attr(quickloans_prepare_css_value($quickloans_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($quickloans_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('quickloans_action_show_layout', $quickloans_footer_id);
	?>
</footer><!-- /.footer_wrap -->
