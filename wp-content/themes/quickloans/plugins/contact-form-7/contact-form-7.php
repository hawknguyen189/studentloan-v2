<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('quickloans_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'quickloans_cf7_theme_setup9', 9 );
	function quickloans_cf7_theme_setup9() {
		
		if (quickloans_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'quickloans_cf7_frontend_scripts', 1100 );
			add_filter( 'quickloans_filter_merge_styles',						'quickloans_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'quickloans_filter_tgmpa_required_plugins',			'quickloans_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'quickloans_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('quickloans_filter_tgmpa_required_plugins',	'quickloans_cf7_tgmpa_required_plugins');
	function quickloans_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', quickloans_storage_get('required_plugins'))) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> esc_html__('Contact Form 7', 'quickloans'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
			// CF7 extension - datepicker 
			$params = array(
					'name' 		=> esc_html__('Contact Form 7 Datepicker', 'quickloans'),
					'slug' 		=> 'contact-form-7-datepicker',
					'required' 	=> false
			);
			$path = quickloans_get_file_dir('plugins/contact-form-7/contact-form-7-datepicker.zip');
			if ($path != '')
				$params['source'] = $path;
			$list[] = $params;
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'quickloans_exists_cf7' ) ) {
	function quickloans_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'quickloans_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'quickloans_cf7_frontend_scripts', 1100 );
	function quickloans_cf7_frontend_scripts() {
		if (quickloans_is_on(quickloans_get_theme_option('debug_mode')) && quickloans_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'quickloans-contact-form-7',  quickloans_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'quickloans_cf7_merge_styles' ) ) {
	//Handler of the add_filter('quickloans_filter_merge_styles', 'quickloans_cf7_merge_styles');
	function quickloans_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>