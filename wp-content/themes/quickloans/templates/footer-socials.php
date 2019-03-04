<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.10
 */


// Socials
if ( quickloans_is_on(quickloans_get_theme_option('socials_in_footer')) && ($quickloans_output = quickloans_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php quickloans_show_layout($quickloans_output); ?>
		</div>
	</div>
	<?php
}
?>