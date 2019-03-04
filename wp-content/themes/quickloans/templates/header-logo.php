<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

$quickloans_args = get_query_var('quickloans_logo_args');

// Site logo
$quickloans_logo_image  = quickloans_get_logo_image(isset($quickloans_args['type']) ? $quickloans_args['type'] : '');
$quickloans_logo_text   = quickloans_is_on(quickloans_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$quickloans_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($quickloans_logo_image) || !empty($quickloans_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($quickloans_logo_image)) {
			$quickloans_attr = quickloans_getimagesize($quickloans_logo_image);
			echo '<img src="'.esc_url($quickloans_logo_image).'" '.(!empty($quickloans_attr[3]) ? sprintf(' %s', $quickloans_attr[3]) : '').'>' ;
		} else {
			quickloans_show_layout(quickloans_prepare_macros($quickloans_logo_text), '<span class="logo_text">', '</span>');
			quickloans_show_layout(quickloans_prepare_macros($quickloans_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>