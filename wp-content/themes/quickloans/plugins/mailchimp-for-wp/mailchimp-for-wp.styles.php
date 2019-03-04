<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('quickloans_mailchimp_get_css')) {
	add_filter('quickloans_filter_get_css', 'quickloans_mailchimp_get_css', 10, 4);
	function quickloans_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = quickloans_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['input_bg_color']};
	border-color: {$colors['input_bg_color']};
	color: {$colors['input_text']};
}
.mc4wp-form input[type="email"]:focus {
	background-color: {$colors['input_bg_color']};
	border-color: {$colors['input_bd_hover']};
	color: {$colors['input_text']};
}
.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.scheme_dark .mc4wp-form .mc4wp-form-fields input[type="submit"]:hover:not([disabled]) {
	color: {$colors['bg_color']}!important;
}
CSS;
		}

		return $css;
	}
}
?>