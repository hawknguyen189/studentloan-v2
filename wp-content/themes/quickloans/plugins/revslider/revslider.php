<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('quickloans_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'quickloans_revslider_theme_setup9', 9 );
	function quickloans_revslider_theme_setup9() {
		if (quickloans_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'quickloans_revslider_frontend_scripts', 1100 );
			add_filter( 'quickloans_filter_merge_styles',			'quickloans_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'quickloans_filter_tgmpa_required_plugins','quickloans_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'quickloans_exists_revslider' ) ) {
	function quickloans_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'quickloans_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('quickloans_filter_tgmpa_required_plugins',	'quickloans_revslider_tgmpa_required_plugins');
	function quickloans_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', quickloans_storage_get('required_plugins'))) {
			$path = quickloans_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'quickloans'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'quickloans_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'quickloans_revslider_frontend_scripts', 1100 );
	function quickloans_revslider_frontend_scripts() {
		if (quickloans_is_on(quickloans_get_theme_option('debug_mode')) && quickloans_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'quickloans-revslider',  quickloans_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'quickloans_revslider_merge_styles' ) ) {
	//Handler of the add_filter('quickloans_filter_merge_styles', 'quickloans_revslider_merge_styles');
	function quickloans_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>