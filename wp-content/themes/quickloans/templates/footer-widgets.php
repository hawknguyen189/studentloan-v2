<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.10
 */

// Footer sidebar
$quickloans_footer_name = quickloans_get_theme_option('footer_widgets');
$quickloans_footer_present = !quickloans_is_off($quickloans_footer_name) && is_active_sidebar($quickloans_footer_name);
if ($quickloans_footer_present) { 
	quickloans_storage_set('current_sidebar', 'footer');
	$quickloans_footer_wide = quickloans_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($quickloans_footer_name) ) {
		dynamic_sidebar($quickloans_footer_name);
	}
	$quickloans_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($quickloans_out)) {
		$quickloans_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $quickloans_out);
		$quickloans_need_columns = true;	//or check: strpos($quickloans_out, 'columns_wrap')===false;
		if ($quickloans_need_columns) {
			$quickloans_columns = max(0, (int) quickloans_get_theme_option('footer_columns'));
			if ($quickloans_columns == 0) $quickloans_columns = min(4, max(1, substr_count($quickloans_out, '<aside ')));
			if ($quickloans_columns > 1)
				$quickloans_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($quickloans_columns).' widget ', $quickloans_out);
			else
				$quickloans_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($quickloans_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$quickloans_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($quickloans_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'quickloans_action_before_sidebar' );
				quickloans_show_layout($quickloans_out);
				do_action( 'quickloans_action_after_sidebar' );
				if ($quickloans_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$quickloans_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>