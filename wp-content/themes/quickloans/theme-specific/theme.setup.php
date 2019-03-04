<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.22
 */

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('quickloans_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'quickloans_customizer_theme_setup1', 1 );
	function quickloans_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		quickloans_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'max_excerpt_length'	=> 60,			// Max words number for the excerpt in the blog style 'Excerpt'.
													// For style 'Classic' - get half from this value

			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		quickloans_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Montserrat',
				'family' => 'sans-serif',
				'styles' => '400,400italic,500,500italic,600,600italic'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'   => 'Tinos',
				'family' => 'serif',
                'styles' => '400,400italic,700,700italic'		// Parameter 'style' used only for the Google fonts

				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		quickloans_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		quickloans_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'quickloans'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'quickloans'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.667',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.667em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'quickloans'),
				'font-family'		=> '"Tinos",serif',
				'font-size' 		=> '5.333em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.13',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.6px',
				'margin-top'		=> '0.9583em',
				'margin-bottom'		=> '0.55em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'quickloans'),
				'font-family'		=> '"Tinos",serif',
				'font-size' 		=> '4.667em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.07',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.5px',
				'margin-top'		=> '1.01em',
				'margin-bottom'		=> '0.57em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'quickloans'),
				'font-family'		=> '"Tinos",serif',
				'font-size' 		=> '3.333em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.1',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1px',
				'margin-top'		=> '1.27em',
				'margin-bottom'		=> '0.75em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'quickloans'),
				'font-family'		=> '"Tinos",serif',
				'font-size' 		=> '2.667em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.13',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.8px',
				'margin-top'		=> '1.6em',
				'margin-bottom'		=> '0.65em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'quickloans'),
				'font-family'		=> '"Tinos",serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.11',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.5px',
				'margin-top'		=> '2.17em',
				'margin-bottom'		=> '0.9em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'quickloans'),
				'font-family'		=> '"Tinos",serif',
				'font-size' 		=> '1.467em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.23',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.5px',
				'margin-top'		=> '2.35em',
				'margin-bottom'		=> '1.07em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'quickloans'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'quickloans'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '2em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'quickloans'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.7px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'quickloans'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'quickloans'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'quickloans'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'quickloans'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'quickloans'),
				'description'		=> esc_html__('Font settings of the main menu items', 'quickloans'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '17px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.6px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'quickloans'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'quickloans'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '17px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.6px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		quickloans_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'quickloans'),
							'description'	=> __('Colors of the main content area', 'quickloans')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'quickloans'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'quickloans')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'quickloans'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'quickloans')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'quickloans'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'quickloans')
							),
			'input'	=> array(
							'title'			=> __('Input', 'quickloans'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'quickloans')
							),
			)
		);
		quickloans_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'quickloans'),
							'description'	=> __('Background color of this block in the normal state', 'quickloans')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'quickloans'),
							'description'	=> __('Background color of this block in the hovered state', 'quickloans')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'quickloans'),
							'description'	=> __('Border color of this block in the normal state', 'quickloans')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'quickloans'),
							'description'	=> __('Border color of this block in the hovered state', 'quickloans')
							),
			'text'		=> array(
							'title'			=> __('Text', 'quickloans'),
							'description'	=> __('Color of the plain text inside this block', 'quickloans')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'quickloans'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'quickloans')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'quickloans'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'quickloans')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'quickloans'),
							'description'	=> __('Color of the links inside this block', 'quickloans')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'quickloans'),
							'description'	=> __('Color of the hovered state of links inside this block', 'quickloans')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'quickloans'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'quickloans')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'quickloans'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'quickloans')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'quickloans'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'quickloans')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'quickloans'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'quickloans')
							)
			)
		);
		quickloans_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'quickloans'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#e5e5e5',
		
					// Text and links colors
					'text'				=> '#a3a3a3', //+
					'text_light'		=> '#b7b7b7',
					'text_dark'			=> '#464c50', //+
                    'text_link' 		=> '#0cbeab', //+
                    'text_hover'		=> '#07b19f', //+
                    'text_link2'		=> '#fccb34', //+
                    'text_hover2'		=> '#f0c02b', //+
					'text_link3'		=> '#00a08e', //+
					'text_hover3'		=> '#eec432',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f3f5f7', //+
					'alter_bg_hover'	=> '#e6e8eb',
					'alter_bd_color'	=> '#e5e5e5',
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#f9f9f8', //+
					'alter_dark'		=> '#acacab', //+
					'alter_link'		=> '#0cbeab', //+
					'alter_hover'		=> '#12c6b2', //+
					'alter_link2'		=> '#3fdac9', //+
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#bfbfbf',
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f2f2f1', //+
					'input_bg_hover'	=> '#f2f2f1', //+
					'input_bd_color'	=> '#f2f2f1', //+
					'input_bd_hover'	=> '#fccb34', //+
					'input_text'		=> '#939392', //+
					'input_light'		=> '#939392', //+
					'input_dark'		=> '#1d1d1d',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'quickloans'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0e0d12',
					'bd_color'			=> '#1c1b1f',
		
					// Text and links colors
					'text'				=> '#b7b7b7',
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff',
                    'text_link' 		=> '#0cbeab', //+
                    'text_hover'		=> '#07b19f', //+
                    'text_link2'		=> '#fccb34', //+
                    'text_hover2'		=> '#f0c02b', //+
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1e1d22',
					'alter_bg_hover'	=> '#28272e',
					'alter_bd_color'	=> '#313131',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#ffaa5f',
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffaa5f',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#3e454a', //+
					'input_bg_hover'	=> '#3e454a', //+
					'input_bd_color'	=> '#3e454a', //+
					'input_bd_hover'	=> '#828383', //+
					'input_text'		=> '#939392', //+
					'input_light'		=> '#939392', //+
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		quickloans_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('quickloans_customizer_add_theme_colors')) {
	function quickloans_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['text_05']  = quickloans_hex2rgba( $colors['text'], 0.5 );
			$colors['bg_color_0']  = quickloans_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = quickloans_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_03']  = quickloans_hex2rgba( $colors['bg_color'], 0.3 );
			$colors['bg_color_05']  = quickloans_hex2rgba( $colors['bg_color'], 0.5 );
			$colors['bg_color_07']  = quickloans_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = quickloans_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = quickloans_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = quickloans_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = quickloans_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = quickloans_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = quickloans_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = quickloans_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['alter_dark_03']  = quickloans_hex2rgba( $colors['alter_dark'], 0.3 );
			$colors['text_dark_07']  = quickloans_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = quickloans_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = quickloans_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = quickloans_hsb2hex(quickloans_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = quickloans_hsb2hex(quickloans_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
			$colors['alter_link2_09'] = quickloans_hex2rgba( $colors['alter_link2'], 0.9 );
		} else {
			$colors['text_05'] = '{{ data.text_05 }}';
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_03'] = '{{ data.bg_color_03 }}';
			$colors['bg_color_05'] = '{{ data.bg_color_05 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['alter_dark_03'] = '{{ data.alter_dark_03 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
			$colors['alter_link2_09'] = '{{ data.alter_link2_09 }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('quickloans_customizer_add_theme_fonts')) {
	function quickloans_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !quickloans_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !quickloans_is_inherit($font['font-size'])
														? 'font-size:' . quickloans_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !quickloans_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !quickloans_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !quickloans_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !quickloans_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !quickloans_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !quickloans_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !quickloans_is_inherit($font['margin-top'])
														? 'margin-top:' . quickloans_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !quickloans_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . quickloans_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('quickloans_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'quickloans_customizer_theme_setup' );
	function quickloans_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('quickloans_filter_add_thumb_sizes', array(
			'quickloans-thumb-huge'		=> array(1170, 658, true),
			'quickloans-thumb-big' 		=> array( 760, 428, true),
			'quickloans-thumb-med' 		=> array( 370, 208, true),
			'quickloans-thumb-team' 		=> array( 370, 440, true),
			'quickloans-thumb-team-2' 		=> array( 370, 350, true),
			'quickloans-thumb-blogger'		=> array( 370, 290, true),
			'quickloans-thumb-plain'		=> array( 570, 292, true),
			'quickloans-thumb-tiny' 		=> array( 206, 206, true),
			'quickloans-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'quickloans-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = quickloans_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'quickloans_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('quickloans_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'quickloans_customizer_image_sizes' );
	function quickloans_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('quickloans_filter_add_thumb_sizes', array(
			'quickloans-thumb-huge'		=> esc_html__( 'Huge image', 'quickloans' ),
			'quickloans-thumb-big'			=> esc_html__( 'Large image', 'quickloans' ),
			'quickloans-thumb-med'			=> esc_html__( 'Medium image', 'quickloans' ),
			'quickloans-thumb-tiny'		=> esc_html__( 'Small square avatar', 'quickloans' ),
			'quickloans-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'quickloans' ),
			'quickloans-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'quickloans' ),
			)
		);
		$mult = quickloans_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'quickloans' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'quickloans_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'quickloans_customizer_trx_addons_add_thumb_sizes');
	function quickloans_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'quickloans_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'quickloans_customizer_trx_addons_get_thumb_size');
	function quickloans_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
                            'trx_addons-thumb-team',
							'trx_addons-thumb-team-@retina',
                            'trx_addons-thumb-team-2',
                            'trx_addons-thumb-team-2-@retina',
                            'trx_addons-thumb-blogger',
                            'trx_addons-thumb-blogger-@retina',
                            'trx_addons-thumb-plain',
                            'trx_addons-thumb-plain-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'quickloans-thumb-huge',
							'quickloans-thumb-huge-@retina',
							'quickloans-thumb-big',
							'quickloans-thumb-big-@retina',
							'quickloans-thumb-med',
							'quickloans-thumb-med-@retina',
                            'quickloans-thumb-team',
							'quickloans-thumb-team-@retina',
                            'quickloans-thumb-team-2',
                            'quickloans-thumb-team-2-@retina',
                            'quickloans-thumb-blogger',
                            'quickloans-thumb-blogger-@retina',
                            'quickloans-thumb-plain',
                            'quickloans-thumb-plain-@retina',
							'quickloans-thumb-tiny',
							'quickloans-thumb-tiny-@retina',
							'quickloans-thumb-masonry-big',
							'quickloans-thumb-masonry-big-@retina',
							'quickloans-thumb-masonry',
							'quickloans-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('quickloans_create_theme_options')) {

	function quickloans_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'quickloans');

		quickloans_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'quickloans'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'quickloans') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'quickloans') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'quickloans'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'quickloans'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'quickloans') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'quickloans'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => quickloans_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'quickloans'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'quickloans'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'quickloans'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'quickloans'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'quickloans') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'quickloans'),
					'left'	=> esc_html__('Left',	'quickloans'),
					'right'	=> esc_html__('Right',	'quickloans')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'quickloans'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'quickloans'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'quickloans') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'quickloans'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'quickloans') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'quickloans'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'quickloans') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'quickloans'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'quickloans') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'quickloans') ),
				"class" => "quickloans_column-1_2 quickloans_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'quickloans') ),
				"class" => "quickloans_column-1_2",
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'quickloans') ),
				"class" => "quickloans_column-1_2 quickloans_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'quickloans') ),
				"class" => "quickloans_column-1_2",
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'quickloans') ),
				"class" => "quickloans_column-1_2 quickloans_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'quickloans') ),
				"class" => "quickloans_column-1_2",
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'quickloans'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'quickloans') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'quickloans'),
				"desc" => wp_kses_data( __('Options of the content area.', 'quickloans') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'quickloans'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'quickloans')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'quickloans'),
				"desc" => wp_kses_data( __('Select width of the body content', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'quickloans')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'quickloans'),
					'wide'		=> esc_html__('Wide',		'quickloans'),
					'fullwide'	=> esc_html__('Fullwide',	'quickloans'),
					'fullscreen'=> esc_html__('Fullscreen',	'quickloans')
				),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'quickloans') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'quickloans')
				),
				"std" => '',
				"type" => "image"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'quickloans'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'quickloans')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'quickloans'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'quickloans')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'quickloans'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'quickloans') ),
				"std" => '4px',
				"type" => "text"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'quickloans') ),
				"std" => '',
				"type" => "image"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'quickloans'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'quickloans') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'privacy_text' => array(
				"title" => esc_html__("Text with Privacy Policy link", 'quickloans'),
				"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'quickloans') ),
				"std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'quickloans') ),
				"type"  => "text"
			),
			'author_info' => array(
				"title" => esc_html__('Author info', 'quickloans'),
				"desc" => wp_kses_data( __("Display block with information about post's author", 'quickloans') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'quickloans'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'quickloans') ),
				"std" => 0,
				"options" => quickloans_get_list_range(0,9),
				"type" => "hidden"
				),
			'related_columns' => array(
				"title" => esc_html__('Related columns', 'quickloans'),
				"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'quickloans') ),
				"std" => 2,
				"options" => quickloans_get_list_range(1,4),
				"type" => "hidden"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'quickloans'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'quickloans') ),
				"std" => 2,
				"options" => quickloans_get_list_styles(1,2),
				"type" => "hidden"
				),
			
		
		
			// Section 'Content'
			'sidebar' => array(
				"title" => esc_html__('Sidebars', 'quickloans'),
				"desc" => wp_kses_data( __('Options of the sidebar and other widgets areas', 'quickloans') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'quickloans'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'quickloans'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'quickloans') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'quickloans')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'quickloans'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number in the site footer', 'quickloans') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'quickloans'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'quickloans')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'quickloans'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'quickloans')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'quickloans')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'quickloans'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'quickloans')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => quickloans_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'quickloans'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'quickloans') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'quickloans')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'quickloans'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'quickloans') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'quickloans') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'quickloans'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'quickloans') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'quickloans'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'quickloans') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'quickloans'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'quickloans') ),
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'quickloans'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'quickloans'),
				"desc" => wp_kses_data( __("Select blog style and widgets to display on the default homepage. Attention! If you use custom page as the homepage - please set up parameters in the 'Theme Options' section of this page.", 'quickloans') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'quickloans'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'quickloans') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'quickloans'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'quickloans') ),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'quickloans'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'quickloans') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'quickloans'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'quickloans') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'quickloans') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'quickloans') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'quickloans') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'quickloans') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'quickloans') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'quickloans'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'quickloans') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'quickloans'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'quickloans') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'quickloans'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'quickloans'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'quickloans') ),
				"std" => 2,
				"options" => quickloans_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'quickloans'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'quickloans'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'quickloans'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'meta_parts' => array(
				"title" => esc_html__('Post meta', 'quickloans'),
				"desc" => wp_kses_data( __("Select elements to show in the post meta area on default blog archive and search results. You can drag items to change their order. Attention! If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Post meta' in the 'Theme Options' section of this page.", 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'categories=1|date=0|counters=0|author=1|share=0|edit=0',
				"options" => array(
					'categories' => esc_html__('Categories', 'quickloans'),
					'date'		 => esc_html__('Post date', 'quickloans'),
					'author'	 => esc_html__('Post author', 'quickloans'),
					'counters'	 => esc_html__('Post counters', 'quickloans'),
					'share'		 => esc_html__('Share links', 'quickloans'),
					'edit'		 => esc_html__('Edit link', 'quickloans')
				),
				"type" => "checklist"
			),
			'counters' => array(
				"title" => esc_html__('Counters', 'quickloans'),
				"desc" => wp_kses_data( __("Select counters to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Counters' in the 'Theme Options' section of this page. Attention! You can drag items to change their order. Likes and Views available only if ThemeREX Addons is active", 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'views=1|likes=1|comments=1',
				"options" => array(
					'views' => esc_html__('Views', 'quickloans'),
					'likes' => esc_html__('Likes', 'quickloans'),
					'comments' => esc_html__('Comments', 'quickloans')
				),
				"type" => "checklist"
			),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'quickloans'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"std" => "pages",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'quickloans'),
					'links'	=> esc_html__("Older/Newest", 'quickloans'),
					'more'	=> esc_html__("Load more", 'quickloans'),
					'infinite' => esc_html__("Infinite scroll", 'quickloans')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'quickloans'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'quickloans'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'quickloans') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'quickloans'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'quickloans') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'quickloans'),
					'fullpost'	=> esc_html__('Full post',	'quickloans')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'quickloans'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'quickloans') ),
				"std" => 5,
				"type" => "text"
				),
			'sticky_style' => array(
				"title" => esc_html__('Sticky posts style', 'quickloans'),
				"desc" => wp_kses_data( __('Select style of the sticky posts output', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(
					'inherit' => esc_html__('Decorated posts', 'quickloans'),
					'columns' => esc_html__('Mini-cards',	'quickloans')
				),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'quickloans'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'quickloans')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'quickloans'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'quickloans'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'quickloans'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'quickloans') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'quickloans'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'quickloans') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'quickloans'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'quickloans') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'quickloans'),
				"desc" => esc_html__("Modify colors and preview changes on your site", 'quickloans'),
				"priority" => 1000,
				"type" => "section"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Color schemes', 'quickloans'),
				"desc" => esc_html__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'quickloans'),
				"std" => '$quickloans_get_scheme_storage',
				"refresh" => false,
				"type" => "scheme_editor"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'quickloans'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'quickloans') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'quickloans')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'quickloans'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'quickloans') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'quickloans')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'quickloans'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'quickloans'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'quickloans') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'quickloans') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'quickloans'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'quickloans') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'quickloans') ),
				"class" => "quickloans_column-1_3 quickloans_new_row",
				"refresh" => false,
				"std" => '$quickloans_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=quickloans_get_theme_setting('max_load_fonts'); $i++) {
			/*
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'quickloans'), $i)),
				"desc" => '',
				"type" => "info",
				);
			*/
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'quickloans'),
				"desc" => '',
				"class" => "quickloans_column-1_3 quickloans_new_row",
				"refresh" => false,
				"std" => '$quickloans_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'quickloans'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'quickloans') )
							: '',
				"class" => "quickloans_column-1_3",
				"refresh" => false,
				"std" => '$quickloans_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'quickloans'),
					'serif' => esc_html__('serif', 'quickloans'),
					'sans-serif' => esc_html__('sans-serif', 'quickloans'),
					'monospace' => esc_html__('monospace', 'quickloans'),
					'cursive' => esc_html__('cursive', 'quickloans'),
					'fantasy' => esc_html__('fantasy', 'quickloans')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'quickloans'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'quickloans') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'quickloans') )
							: '',
				"class" => "quickloans_column-1_3",
				"refresh" => false,
				"std" => '$quickloans_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = quickloans_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'quickloans'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'quickloans'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'quickloans'),
						'100' => esc_html__('100 (Light)', 'quickloans'), 
						'200' => esc_html__('200 (Light)', 'quickloans'), 
						'300' => esc_html__('300 (Thin)',  'quickloans'),
						'400' => esc_html__('400 (Normal)', 'quickloans'),
						'500' => esc_html__('500 (Semibold)', 'quickloans'),
						'600' => esc_html__('600 (Semibold)', 'quickloans'),
						'700' => esc_html__('700 (Bold)', 'quickloans'),
						'800' => esc_html__('800 (Black)', 'quickloans'),
						'900' => esc_html__('900 (Black)', 'quickloans')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'quickloans'),
						'normal' => esc_html__('Normal', 'quickloans'), 
						'italic' => esc_html__('Italic', 'quickloans')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'quickloans'),
						'none' => esc_html__('None', 'quickloans'), 
						'underline' => esc_html__('Underline', 'quickloans'),
						'overline' => esc_html__('Overline', 'quickloans'),
						'line-through' => esc_html__('Line-through', 'quickloans')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'quickloans'),
						'none' => esc_html__('None', 'quickloans'), 
						'uppercase' => esc_html__('Uppercase', 'quickloans'),
						'lowercase' => esc_html__('Lowercase', 'quickloans'),
						'capitalize' => esc_html__('Capitalize', 'quickloans')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "quickloans_column-1_5",
					"refresh" => false,
					"std" => '$quickloans_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		quickloans_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			quickloans_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'quickloans'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'quickloans') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'quickloans')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('quickloans_options_get_list_cpt_options')) {
	function quickloans_options_get_list_cpt_options($cpt) {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Header style', 'quickloans'),
						"desc" => wp_kses_data( sprintf(__('Select style to display the site header on the %s pages', 'quickloans'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'quickloans'),
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'quickloans'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => "select"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'quickloans'),
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'quickloans'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'quickloans'),
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'quickloans'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'quickloans'),
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'quickloans'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'quickloans'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'quickloans') ),
						"std" => 0,
						"type" => "checkbox"
						),
					"expand_content_{$cpt}" => array(
						"title" => esc_html__('Expand content', 'quickloans'),
						"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'quickloans') ),
						"refresh" => false,
						"std" => 1,
						"type" => "checkbox"
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'quickloans'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'quickloans') ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'quickloans'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'quickloans') ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'quickloans'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'quickloans') ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'quickloans'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'quickloans') ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"footer_scheme_{$cpt}" => array(
						"title" => esc_html__('Footer Color Scheme', 'quickloans'),
						"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'quickloans') ),
						"std" => 'dark',
						"options" => array(),
						"type" => "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'quickloans'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'quickloans') ),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'quickloans'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'quickloans') ),
						"dependency" => array(
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => quickloans_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'quickloans'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'quickloans') ),
						"std" => 0,
						"type" => "checkbox"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('quickloans_options_get_list_choises')) {
	add_filter('quickloans_filter_options_get_list_choises', 'quickloans_options_get_list_choises', 10, 2);
	function quickloans_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = quickloans_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = quickloans_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = quickloans_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = quickloans_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = quickloans_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = quickloans_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = quickloans_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = quickloans_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = quickloans_array_merge(array(0 => esc_html__('- Select category -', 'quickloans')), quickloans_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = quickloans_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = quickloans_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = quickloans_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>