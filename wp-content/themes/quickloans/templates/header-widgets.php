<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

// Header sidebar
$quickloans_header_name = quickloans_get_theme_option('header_widgets');
$quickloans_header_present = !quickloans_is_off($quickloans_header_name) && is_active_sidebar($quickloans_header_name);
if ($quickloans_header_present) { 
	quickloans_storage_set('current_sidebar', 'header');
	$quickloans_header_wide = quickloans_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($quickloans_header_name) ) {
		dynamic_sidebar($quickloans_header_name);
	}
	$quickloans_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($quickloans_widgets_output)) {
		$quickloans_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $quickloans_widgets_output);
		$quickloans_need_columns = strpos($quickloans_widgets_output, 'columns_wrap')===false;
		if ($quickloans_need_columns) {
			$quickloans_columns = max(0, (int) quickloans_get_theme_option('header_columns'));
			if ($quickloans_columns == 0) $quickloans_columns = min(6, max(1, substr_count($quickloans_widgets_output, '<aside ')));
			if ($quickloans_columns > 1)
				$quickloans_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($quickloans_columns).' widget ', $quickloans_widgets_output);
			else
				$quickloans_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($quickloans_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$quickloans_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($quickloans_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'quickloans_action_before_sidebar' );
				quickloans_show_layout($quickloans_widgets_output);
				do_action( 'quickloans_action_after_sidebar' );
				if ($quickloans_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$quickloans_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>