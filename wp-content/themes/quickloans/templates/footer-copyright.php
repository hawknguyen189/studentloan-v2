<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.10
 */

// Copyright area
$quickloans_footer_scheme =  quickloans_is_inherit(quickloans_get_theme_option('footer_scheme')) ? quickloans_get_theme_option('color_scheme') : quickloans_get_theme_option('footer_scheme');
$quickloans_copyright_scheme = quickloans_is_inherit(quickloans_get_theme_option('copyright_scheme')) ? $quickloans_footer_scheme : quickloans_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($quickloans_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$quickloans_copyright = quickloans_prepare_macros(quickloans_get_theme_option('copyright'));
				if (!empty($quickloans_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $quickloans_copyright, $quickloans_matches)) {
						$quickloans_copyright = str_replace($quickloans_matches[1], date(str_replace(array('{', '}'), '', $quickloans_matches[1])), $quickloans_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($quickloans_copyright));
				}
			?></div>
		</div>
	</div>
</div>
