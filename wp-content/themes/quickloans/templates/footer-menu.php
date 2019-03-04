<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.10
 */

// Footer menu
$quickloans_menu_footer = quickloans_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($quickloans_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php quickloans_show_layout($quickloans_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>