<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

if (quickloans_sidebar_present()) {
	ob_start();
	$quickloans_sidebar_name = quickloans_get_theme_option('sidebar_widgets');
	quickloans_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($quickloans_sidebar_name) ) {
		dynamic_sidebar($quickloans_sidebar_name);
	}
	$quickloans_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($quickloans_out)) {
		$quickloans_sidebar_position = quickloans_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($quickloans_sidebar_position); ?> widget_area<?php if (!quickloans_is_inherit(quickloans_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(quickloans_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'quickloans_action_before_sidebar' );
				quickloans_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $quickloans_out));
				do_action( 'quickloans_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>