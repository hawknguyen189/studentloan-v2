<?php
/* Quick Interest Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('quickloans_quick_interest_slider_theme_setup9')) {
	add_action( 'after_setup_theme', 'quickloans_quick_interest_slider_theme_setup9', 9 );
	function quickloans_quick_interest_slider_theme_setup9() {
		if (is_admin()) {
			add_filter( 'quickloans_filter_tgmpa_required_plugins',		'quickloans_quick_interest_slider_tgmpa_required_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'quickloans_quick_interest_slider_tgmpa_required_plugins' ) ) {
	//add_filter('quickloans_filter_required_plugins',	'quickloans_quick_interest_slider_required_plugins');
	function quickloans_quick_interest_slider_tgmpa_required_plugins($list=array()) {
		if (in_array('quick-interest-slider', (array)quickloans_storage_get('required_plugins'))) {

			$path = quickloans_get_file_dir('plugins/quick-interest-slider/quick-interest-slider.zip');
			$list[] = array(
				'name' 		=> esc_html__('Quick Interest Slider', 'quickloans'),
				'slug' 		=> 'quick-interest-slider',
				'source'	=> !empty($path) ? $path : 'upload://quick-interest-slider.zip',
				'required' 	=> false
			);
		}
		return $list;
	}
}


// Check if Quick Interest Slider installed and activated
if ( !function_exists( 'quickloans_exists_quick_interest_slider' ) ) {
	function quickloans_exists_quick_interest_slider() {
		return function_exists('qis_subscribe');
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_quick_interest_slider_importer_set_options' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'trx_addons_quick_interest_slider_importer_set_options' );
	function trx_addons_quick_interest_slider_importer_set_options($options=array()) {
		if ( quickloans_exists_quick_interest_slider() && in_array('quick-interest-slider', $options['required_plugins']) ) {
			$options['additional_options'][]    = 'qis_%';                    // Add slugs to export options for this plugin
		}
		return $options;
	}
}


// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_quick_interest_slider_importer_required_plugins' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_required_plugins', 'trx_addons_quick_interest_slider_importer_required_plugins', 10, 2 );
	function trx_addons_quick_interest_slider_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'quick_interest_slider')!==false && !quickloans_exists_quick_interest_slider() )
			$not_installed .= '<br>' . esc_html__('Quick Interest Slider', 'quickloans');
		return $not_installed;
	}
}



?>