<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('quickloans_woocommerce_theme_setup1')) {
	add_action( 'after_setup_theme', 'quickloans_woocommerce_theme_setup1', 1 );
	function quickloans_woocommerce_theme_setup1() {

		add_theme_support( 'woocommerce' );

		// Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
		add_theme_support( 'wc-product-gallery-zoom' );

		// Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
		add_theme_support( 'wc-product-gallery-slider' ); 

		// Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
		add_theme_support( 'wc-product-gallery-lightbox' );

		add_filter( 'quickloans_filter_list_sidebars', 	'quickloans_woocommerce_list_sidebars' );
		add_filter( 'quickloans_filter_list_posts_types',	'quickloans_woocommerce_list_post_types');
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('quickloans_woocommerce_theme_setup3')) {
	add_action( 'after_setup_theme', 'quickloans_woocommerce_theme_setup3', 3 );
	function quickloans_woocommerce_theme_setup3() {
		if (quickloans_exists_woocommerce()) {
		
			// Section 'WooCommerce'
			quickloans_storage_merge_array('options', '', array_merge(
				array(
					'shop' => array(
						"title" => esc_html__('Shop', 'quickloans'),
						"desc" => wp_kses_data( __('Select parameters to display the shop pages', 'quickloans') ),
						"type" => "section"
						),
					'posts_per_page_shop' => array(
						"title" => esc_html__('Products per page', 'quickloans'),
						"desc" => wp_kses_data( __('How many products should be displayed on the shop page. If empty - use global value from the menu Settings - Reading', 'quickloans') ),
						"std" => '',
						"type" => "text"
						),
					'blog_columns_shop' => array(
						"title" => esc_html__('Shop loop columns', 'quickloans'),
						"desc" => wp_kses_data( __('How many columns should be used in the shop loop (from 2 to 4)?', 'quickloans') ),
						"std" => 2,
						"options" => quickloans_get_list_range(2,4),
						"type" => "select"
						),
					'shop_mode' => array(
						"title" => esc_html__('Shop mode', 'quickloans'),
						"desc" => wp_kses_data( __('Select style for the products list', 'quickloans') ),
						"std" => 'thumbs',
						"options" => array(
							'thumbs'=> esc_html__('Thumbnails', 'quickloans'),
							'list'	=> esc_html__('List', 'quickloans'),
						),
						"type" => "select"
						),
					'shop_hover' => array(
						"title" => esc_html__('Hover style', 'quickloans'),
						"desc" => wp_kses_data( __('Hover style on the products in the shop archive', 'quickloans') ),
						"std" => 'shop',
						"options" => apply_filters('quickloans_filter_shop_hover', array(
							'none' => esc_html__('None', 'quickloans'),
							'shop' => esc_html__('Icons', 'quickloans'),
							'shop_buttons' => esc_html__('Buttons', 'quickloans')
						)),
						"type" => "select"
						),
					'stretch_tabs_area' => array(
						"title" => esc_html__('Stretch tabs area', 'quickloans'),
						"desc" => wp_kses_data( __('Stretch area with tabs on the single product to the screen width if the sidebar is hidden', 'quickloans') ),
						"std" => 1,
						"type" => "checkbox"
						),
					'related_posts_shop' => array(
						"title" => esc_html__('Related products', 'quickloans'),
						"desc" => wp_kses_data( __('How many related products should be displayed in the single product page?', 'quickloans') ),
						"std" => 3,
						"options" => quickloans_get_list_range(0,9),
						"type" => "select"
						),
					'related_columns_shop' => array(
						"title" => esc_html__('Related columns', 'quickloans'),
						"desc" => wp_kses_data( __('How many columns should be used to output related products in the single product page?', 'quickloans') ),
						"std" => 3,
						"options" => quickloans_get_list_range(1,4),
						"type" => "select"
						)
				),
				quickloans_options_get_list_cpt_options('shop')
			));
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('quickloans_woocommerce_theme_setup9')) {
	add_action( 'after_setup_theme', 'quickloans_woocommerce_theme_setup9', 9 );
	function quickloans_woocommerce_theme_setup9() {
		
		if (quickloans_exists_woocommerce()) {
			add_action( 'wp_enqueue_scripts', 								'quickloans_woocommerce_frontend_scripts', 1100 );
			add_filter( 'quickloans_filter_merge_styles',						'quickloans_woocommerce_merge_styles' );
			add_filter( 'quickloans_filter_merge_scripts',						'quickloans_woocommerce_merge_scripts');
			add_filter( 'quickloans_filter_get_post_info',		 				'quickloans_woocommerce_get_post_info');
			add_filter( 'quickloans_filter_post_type_taxonomy',				'quickloans_woocommerce_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'quickloans_filter_detect_blog_mode',				'quickloans_woocommerce_detect_blog_mode' );
				add_filter( 'quickloans_filter_get_post_categories', 			'quickloans_woocommerce_get_post_categories');
				add_filter( 'quickloans_filter_allow_override_header_image',	'quickloans_woocommerce_allow_override_header_image' );
				add_action( 'quickloans_action_before_post_meta',				'quickloans_woocommerce_action_before_post_meta');
				add_action( 'pre_get_posts',								'quickloans_woocommerce_pre_get_posts' );
				add_filter( 'quickloans_filter_localize_script',				'quickloans_woocommerce_localize_script' );
			}
		}
		if (is_admin()) {
			add_filter( 'quickloans_filter_tgmpa_required_plugins',			'quickloans_woocommerce_tgmpa_required_plugins' );
		}

		// Add wrappers and classes to the standard WooCommerce output
		if (quickloans_exists_woocommerce()) {

			// Remove WOOC sidebar
			remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 10 );

			// Remove link around product item
			remove_action('woocommerce_before_shop_loop_item',			'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_product_link_close', 5);

			// Remove add_to_cart button
			//remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_add_to_cart', 10);
			
			// Remove link around product category
			remove_action('woocommerce_before_subcategory',				'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory',				'woocommerce_template_loop_category_link_close', 10);
			
			// Open main content wrapper - <article>
			remove_action( 'woocommerce_before_main_content',			'woocommerce_output_content_wrapper', 10);
			add_action(    'woocommerce_before_main_content',			'quickloans_woocommerce_wrapper_start', 10);
			// Close main content wrapper - </article>
			remove_action( 'woocommerce_after_main_content',			'woocommerce_output_content_wrapper_end', 10);		
			add_action(    'woocommerce_after_main_content',			'quickloans_woocommerce_wrapper_end', 10);

			// Close header section
			add_action(    'woocommerce_archive_description',			'quickloans_woocommerce_archive_description', 15 );

			// Add theme specific search form
			add_filter(    'get_product_search_form',					'quickloans_woocommerce_get_product_search_form' );

			// Add list mode buttons
			add_action(    'woocommerce_before_shop_loop', 				'quickloans_woocommerce_before_shop_loop', 10 );

			// Set columns number for the products loop
			add_filter(    'loop_shop_columns',							'quickloans_woocommerce_loop_shop_columns' );
			add_filter(    'post_class',								'quickloans_woocommerce_loop_shop_columns_class' );
			add_filter(    'product_cat_class',							'quickloans_woocommerce_loop_shop_columns_class', 10, 3 );
			// Open product/category item wrapper
			add_action(    'woocommerce_before_subcategory_title',		'quickloans_woocommerce_item_wrapper_start', 9 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'quickloans_woocommerce_item_wrapper_start', 9 );
			// Close featured image wrapper and open title wrapper
			add_action(    'woocommerce_before_subcategory_title',		'quickloans_woocommerce_title_wrapper_start', 20 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'quickloans_woocommerce_title_wrapper_start', 20 );

			// Wrap product title into link
			add_action(    'the_title',									'quickloans_woocommerce_the_title');
			// Wrap category title into link
			add_action(		'woocommerce_before_subcategory_title',		'quickloans_woocommerce_before_subcategory_title', 22, 1 );
			add_action(		'woocommerce_after_subcategory_title',		'quickloans_woocommerce_after_subcategory_title', 2, 1 );


			// Close title wrapper and add description in the list mode
			add_action(    'woocommerce_after_shop_loop_item_title',	'quickloans_woocommerce_title_wrapper_end', 7);
			add_action(    'woocommerce_after_subcategory_title',		'quickloans_woocommerce_title_wrapper_end2', 10 );
			// Close product/category item wrapper
			add_action(    'woocommerce_after_subcategory',				'quickloans_woocommerce_item_wrapper_end', 20 );
			add_action(    'woocommerce_after_shop_loop_item',			'quickloans_woocommerce_item_wrapper_end', 20 );

			// Add product ID into product meta section (after categories and tags)
			add_action(    'woocommerce_product_meta_end',				'quickloans_woocommerce_show_product_id', 10);
			
			// Set columns number for the product's thumbnails
			add_filter(    'woocommerce_product_thumbnails_columns',	'quickloans_woocommerce_product_thumbnails_columns' );


			// Detect current shop mode
			if (!is_admin()) {
				$shop_mode = quickloans_get_value_gpc('quickloans_shop_mode');
				if (empty($shop_mode) && quickloans_check_theme_option('shop_mode'))
					$shop_mode = quickloans_get_theme_option('shop_mode');
				if (empty($shop_mode))
					$shop_mode = 'thumbs';
				quickloans_storage_set('shop_mode', $shop_mode);
			}
		}
	}
}

// Theme init priorities:
// Action 'wp'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)
if (!function_exists('quickloans_woocommerce_theme_setup_wp')) {
	add_action( 'wp', 'quickloans_woocommerce_theme_setup_wp' );
	function quickloans_woocommerce_theme_setup_wp() {
		if (quickloans_exists_woocommerce()) {
			// Set columns number for the related products
			if ((int) quickloans_get_theme_option('related_posts') == 0) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			} else {
				add_filter(    'woocommerce_output_related_products_args',	'quickloans_woocommerce_output_related_products_args' );
				add_filter(    'woocommerce_related_products_columns',		'quickloans_woocommerce_related_products_columns' );
			}
		}
	}
}


// Check if WooCommerce installed and activated
if ( !function_exists( 'quickloans_exists_woocommerce' ) ) {
	function quickloans_exists_woocommerce() {
		return class_exists('Woocommerce');
		//return function_exists('is_woocommerce');
	}
}

// Return true, if current page is any woocommerce page
if ( !function_exists( 'quickloans_is_woocommerce_page' ) ) {
	function quickloans_is_woocommerce_page() {
		$rez = false;
		if (quickloans_exists_woocommerce())
			$rez = is_woocommerce() || is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'quickloans_woocommerce_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'quickloans_filter_detect_blog_mode', 'quickloans_woocommerce_detect_blog_mode' );
	function quickloans_woocommerce_detect_blog_mode($mode='') {
		if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy())
			$mode = 'shop';
		else if (is_product() || is_cart() || is_checkout() || is_account_page())
			$mode = 'shop';	//'shop_single';
		return $mode;
	}
}


// Return taxonomy for current post type
if ( !function_exists( 'quickloans_woocommerce_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'quickloans_filter_post_type_taxonomy',	'quickloans_woocommerce_post_type_taxonomy', 10, 2 );
	function quickloans_woocommerce_post_type_taxonomy($tax='', $post_type='') {
		if ($post_type == 'product')
			$tax = 'product_cat';
		return $tax;
	}
}

// Return true if page title section is allowed
if ( !function_exists( 'quickloans_woocommerce_allow_override_header_image' ) ) {
	//Handler of the add_filter( 'quickloans_filter_allow_override_header_image', 'quickloans_woocommerce_allow_override_header_image' );
	function quickloans_woocommerce_allow_override_header_image($allow=true) {
		return is_product() ? false : $allow;
	}
}

// Return shop page ID
if ( !function_exists( 'quickloans_woocommerce_get_shop_page_id' ) ) {
	function quickloans_woocommerce_get_shop_page_id() {
		return get_option('woocommerce_shop_page_id');
	}
}

// Return shop page link
if ( !function_exists( 'quickloans_woocommerce_get_shop_page_link' ) ) {
	function quickloans_woocommerce_get_shop_page_link() {
		$url = '';
		$id = quickloans_woocommerce_get_shop_page_id();
		if ($id) $url = get_permalink($id);
		return $url;
	}
}

// Show categories of the current product
if ( !function_exists( 'quickloans_woocommerce_get_post_categories' ) ) {
	//Handler of the add_filter( 'quickloans_filter_get_post_categories', 		'quickloans_woocommerce_get_post_categories');
	function quickloans_woocommerce_get_post_categories($cats='') {
		if (get_post_type()=='product') {
			$cats = quickloans_get_post_terms(', ', get_the_ID(), 'product_cat');
		}
		return $cats;
	}
}

// Add 'product' to the list of the supported post-types
if ( !function_exists( 'quickloans_woocommerce_list_post_types' ) ) {
	//Handler of the add_filter( 'quickloans_filter_list_posts_types', 'quickloans_woocommerce_list_post_types');
	function quickloans_woocommerce_list_post_types($list=array()) {
		$list['product'] = esc_html__('Products', 'quickloans');
		return $list;
	}
}

// Show price of the current product in the widgets and search results
if ( !function_exists( 'quickloans_woocommerce_get_post_info' ) ) {
	//Handler of the add_filter( 'quickloans_filter_get_post_info', 'quickloans_woocommerce_get_post_info');
	function quickloans_woocommerce_get_post_info($post_info='') {
		if (get_post_type()=='product') {
			global $product;
			if ( $price_html = $product->get_price_html() ) {
				$post_info = '<div class="post_price product_price price">' . trim($price_html) . '</div>' . $post_info;
			}
		}
		return $post_info;
	}
}

// Show price of the current product in the search results streampage
if ( !function_exists( 'quickloans_woocommerce_action_before_post_meta' ) ) {
	//Handler of the add_action( 'quickloans_action_before_post_meta', 'quickloans_woocommerce_action_before_post_meta');
	function quickloans_woocommerce_action_before_post_meta() {
		if (!is_single() && get_post_type()=='product') {
			global $product;
			if ( $price_html = $product->get_price_html() ) {
				?><div class="post_price product_price price"><?php quickloans_show_layout($price_html); ?></div><?php
			}
		}
	}
}
	
// Enqueue WooCommerce custom styles
if ( !function_exists( 'quickloans_woocommerce_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'quickloans_woocommerce_frontend_scripts', 1100 );
	function quickloans_woocommerce_frontend_scripts() {
		//if (quickloans_is_woocommerce_page())
			if (quickloans_is_on(quickloans_get_theme_option('debug_mode')) && quickloans_get_file_dir('plugins/woocommerce/woocommerce.css')!='')
				wp_enqueue_style( 'quickloans-woocommerce',  quickloans_get_file_url('plugins/woocommerce/woocommerce.css'), array(), null );
			if (quickloans_is_on(quickloans_get_theme_option('debug_mode')) && quickloans_get_file_dir('plugins/woocommerce/woocommerce.js')!='')
				wp_enqueue_script( 'quickloans-woocommerce', quickloans_get_file_url('plugins/woocommerce/woocommerce.js'), array('jquery'), null, true );
	}
}
	
// Merge custom styles
if ( !function_exists( 'quickloans_woocommerce_merge_styles' ) ) {
	//Handler of the add_filter('quickloans_filter_merge_styles', 'quickloans_woocommerce_merge_styles');
	function quickloans_woocommerce_merge_styles($list) {
		$list[] = 'plugins/woocommerce/woocommerce.css';
		return $list;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'quickloans_woocommerce_merge_scripts' ) ) {
	//Handler of the add_filter('quickloans_filter_merge_scripts', 'quickloans_woocommerce_merge_scripts');
	function quickloans_woocommerce_merge_scripts($list) {
		$list[] = 'plugins/woocommerce/woocommerce.js';
		return $list;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'quickloans_woocommerce_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('quickloans_filter_tgmpa_required_plugins',	'quickloans_woocommerce_tgmpa_required_plugins');
	function quickloans_woocommerce_tgmpa_required_plugins($list=array()) {
		if (in_array('woocommerce', quickloans_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('WooCommerce', 'quickloans'),
					'slug' 		=> 'woocommerce',
					'required' 	=> false
				);

		return $list;
	}
}



// Add WooCommerce specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( !function_exists( 'quickloans_woocommerce_list_sidebars' ) ) {
	//Handler of the add_filter( 'quickloans_filter_list_sidebars', 'quickloans_woocommerce_list_sidebars' );
	function quickloans_woocommerce_list_sidebars($list=array()) {
		$list['woocommerce_widgets'] = array(
											'name' => esc_html__('WooCommerce Widgets', 'quickloans'),
											'description' => esc_html__('Widgets to be shown on the WooCommerce pages', 'quickloans')
											);
		return $list;
	}
}




// Decorate WooCommerce output: Loop
//------------------------------------------------------------------------

// Add query vars to set products per page
if (!function_exists('quickloans_woocommerce_pre_get_posts')) {
	//Handler of the add_action( 'pre_get_posts', 'quickloans_woocommerce_pre_get_posts' );
	function quickloans_woocommerce_pre_get_posts($query) {
		if (!$query->is_main_query()) return;
		if ($query->get('post_type') == 'product') {
			$ppp = get_theme_mod('posts_per_page_shop', 0);
			if ($ppp > 0)
				$query->set('posts_per_page', $ppp);
		}
	}
}


// Before main content
if ( !function_exists( 'quickloans_woocommerce_wrapper_start' ) ) {
	//remove_action( 'woocommerce_before_main_content', 'quickloans_woocommerce_wrapper_start', 10);
	//Handler of the add_action('woocommerce_before_main_content', 'quickloans_woocommerce_wrapper_start', 10);
	function quickloans_woocommerce_wrapper_start() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			<article class="post_item_single post_type_product">
			<?php
		} else {
			?>
			<div class="list_products shop_mode_<?php echo !quickloans_storage_empty('shop_mode') ? quickloans_storage_get('shop_mode') : 'thumbs'; ?>">
				<div class="list_products_header">
			<?php
		}
	}
}

// After main content
if ( !function_exists( 'quickloans_woocommerce_wrapper_end' ) ) {
	//remove_action( 'woocommerce_after_main_content', 'quickloans_woocommerce_wrapper_end', 10);		
	//Handler of the add_action('woocommerce_after_main_content', 'quickloans_woocommerce_wrapper_end', 10);
	function quickloans_woocommerce_wrapper_end() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			</article><!-- /.post_item_single -->
			<?php
		} else {
			?>
			</div><!-- /.list_products -->
			<?php
		}
	}
}

// Close header section
if ( !function_exists( 'quickloans_woocommerce_archive_description' ) ) {
	//Handler of the add_action( 'woocommerce_archive_description', 'quickloans_woocommerce_archive_description', 15 );
	function quickloans_woocommerce_archive_description() {
		?>
		</div><!-- /.list_products_header -->
		<?php
	}
}

// Add list mode buttons
if ( !function_exists( 'quickloans_woocommerce_before_shop_loop' ) ) {
	//Handler of the add_action( 'woocommerce_before_shop_loop', 'quickloans_woocommerce_before_shop_loop', 10 );
	function quickloans_woocommerce_before_shop_loop() {
		?>
		<div class="quickloans_shop_mode_buttons"><form action="<?php echo esc_url(quickloans_get_current_url()); ?>" method="post"><input type="hidden" name="quickloans_shop_mode" value="<?php echo esc_attr(quickloans_storage_get('shop_mode')); ?>" /><a href="#" class="woocommerce_thumbs icon-th" title="<?php esc_attr_e('Show products as thumbs', 'quickloans'); ?>"></a><a href="#" class="woocommerce_list icon-th-list" title="<?php esc_attr_e('Show products as list', 'quickloans'); ?>"></a></form></div><!-- /.quickloans_shop_mode_buttons -->
		<?php
	}
}

// Number of columns for the shop streampage
if ( !function_exists( 'quickloans_woocommerce_loop_shop_columns' ) ) {
	//Handler of the add_filter( 'loop_shop_columns', 'quickloans_woocommerce_loop_shop_columns' );
	function quickloans_woocommerce_loop_shop_columns($cols) {
		return max(2, min(4, quickloans_get_theme_option('blog_columns')));
	}
}

// Add column class into product item in shop streampage
if ( !function_exists( 'quickloans_woocommerce_loop_shop_columns_class' ) ) {
	//Handler of the add_filter( 'post_class', 'quickloans_woocommerce_loop_shop_columns_class' );
	//Handler of the add_filter( 'product_cat_class', 'quickloans_woocommerce_loop_shop_columns_class', 10, 3 );
	function quickloans_woocommerce_loop_shop_columns_class($classes, $class='', $cat='') {
		global $woocommerce_loop;
		if (is_product()) {
			if (!empty($woocommerce_loop['columns'])) {
				$classes[] = ' column-1_'.esc_attr($woocommerce_loop['columns']);
			}
		} else if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()) {
			$classes[] = ' column-1_'.esc_attr(max(2, min(4, quickloans_get_theme_option('blog_columns'))));
		}
		return $classes;
	}
}


// Open item wrapper for categories and products
if ( !function_exists( 'quickloans_woocommerce_item_wrapper_start' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'quickloans_woocommerce_item_wrapper_start', 9 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'quickloans_woocommerce_item_wrapper_start', 9 );
	function quickloans_woocommerce_item_wrapper_start($cat='') {
		quickloans_storage_set('in_product_item', true);
		$hover = quickloans_get_theme_option('shop_hover');
		?>
		<div class="post_item post_layout_<?php echo esc_attr(quickloans_storage_get('shop_mode')); ?>">
			<div class="post_featured hover_<?php echo esc_attr($hover); ?>">
				<?php do_action('quickloans_action_woocommerce_item_featured_start'); ?>
				<a href="<?php echo esc_url(is_object($cat) ? get_term_link($cat->slug, 'product_cat') : get_permalink()); ?>">
				<?php
	}
}

// Open item wrapper for categories and products
if ( !function_exists( 'quickloans_woocommerce_open_item_wrapper' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'quickloans_woocommerce_title_wrapper_start', 20 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'quickloans_woocommerce_title_wrapper_start', 20 );
	function quickloans_woocommerce_title_wrapper_start($cat='') {
				?></a><?php
				if (($hover = quickloans_get_theme_option('shop_hover')) != 'none') {
					?><div class="mask"></div><?php
					quickloans_hovers_add_icons($hover, array('cat'=>$cat));
				}
				do_action('quickloans_action_woocommerce_item_featured_end');
				?>
			</div><!-- /.post_featured -->
			<div class="post_data">
				<div class="post_data_inner">
					<div class="post_header entry-header">
					<?php
	}
}


// Wrap product title into link
if ( !function_exists( 'quickloans_woocommerce_the_title' ) ) {
	//Handler of the add_filter( 'the_title', 'quickloans_woocommerce_the_title' );
	function quickloans_woocommerce_the_title($title) {
		if (quickloans_storage_get('in_product_item') && get_post_type()=='product') {
			$title = '<a href="'.get_permalink().'">'.esc_html($title).'</a>';
		}
		return $title;
	}
}

// Wrap category title to the link: open tag
if ( !function_exists( 'quickloans_woocommerce_before_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'quickloans_woocommerce_before_subcategory_title', 10, 1 );
function quickloans_woocommerce_before_subcategory_title($cat) {
if (quickloans_storage_get('in_product_item') && is_object($cat)) {
	?><a href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>"><?php
}
}
}

// Wrap category title to the link: close tag
if ( !function_exists( 'quickloans_woocommerce_after_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'quickloans_woocommerce_after_subcategory_title', 10, 1 );
function quickloans_woocommerce_after_subcategory_title($cat) {
if (quickloans_storage_get('in_product_item') && is_object($cat)) {
	?></a><?php
}
}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'quickloans_woocommerce_title_wrapper_end' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item_title', 'quickloans_woocommerce_title_wrapper_end', 7);
	function quickloans_woocommerce_title_wrapper_end() {
			?>
			</div><!-- /.post_header -->
		<?php
		if (quickloans_storage_get('shop_mode') == 'list' && (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()) && !is_product()) {
		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
			?>
			<div class="post_content entry-content"><?php quickloans_show_layout($excerpt); ?></div>
			<?php
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'quickloans_woocommerce_title_wrapper_end2' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'quickloans_woocommerce_title_wrapper_end2', 10 );
	function quickloans_woocommerce_title_wrapper_end2($category) {
			?>
			</div><!-- /.post_header -->
		<?php
		if (quickloans_storage_get('shop_mode') == 'list' && is_shop() && !is_product()) {
			?>
			<div class="post_content entry-content"><?php quickloans_show_layout($category->description); ?></div><!-- /.post_content -->
			<?php
		}
	}
}

// Close item wrapper for categories and products
if ( !function_exists( 'quickloans_woocommerce_close_item_wrapper' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory', 'quickloans_woocommerce_item_wrapper_end', 20 );
	//Handler of the add_action( 'woocommerce_after_shop_loop_item', 'quickloans_woocommerce_item_wrapper_end', 20 );
	function quickloans_woocommerce_item_wrapper_end($cat='') {
				?>
				</div><!-- /.post_data_inner -->
			</div><!-- /.post_data -->
		</div><!-- /.post_item -->
		<?php
		quickloans_storage_set('in_product_item', false);
	}
}


// Decorate WooCommerce output: Single product
//------------------------------------------------------------------------

// Add WooCommerce specific vars into localize array
if (!function_exists('quickloans_woocommerce_localize_script')) {
	//Handler of the add_filter( 'quickloans_filter_localize_script','quickloans_woocommerce_localize_script' );
	function quickloans_woocommerce_localize_script($arr) {
		$arr['stretch_tabs_area'] = !quickloans_sidebar_present() ? quickloans_get_theme_option('stretch_tabs_area') : 0;
		return $arr;
	}
}

// Add Product ID for the single product
if ( !function_exists( 'quickloans_woocommerce_show_product_id' ) ) {
	//Handler of the add_action( 'woocommerce_product_meta_end', 'quickloans_woocommerce_show_product_id', 10);
	function quickloans_woocommerce_show_product_id() {
		$authors = wp_get_post_terms(get_the_ID(), 'pa_product_author');
		if (is_array($authors) && count($authors)>0) {
			echo '<span class="product_author">'.esc_html__('Author: ', 'quickloans');
			$delim = '';
			foreach ($authors as $author) {
				echo  esc_html($delim) . '<span>' . esc_html($author->name) . '</span>';
				$delim = ', ';
			}
			echo '</span>';
		}
		echo '<span class="product_id">'.esc_html__('Product ID: ', 'quickloans') . '<span>' . get_the_ID() . '</span></span>';
	}
}

// Number columns for the product's thumbnails
if ( !function_exists( 'quickloans_woocommerce_product_thumbnails_columns' ) ) {
	//Handler of the add_filter( 'woocommerce_product_thumbnails_columns', 'quickloans_woocommerce_product_thumbnails_columns' );
	function quickloans_woocommerce_product_thumbnails_columns($cols) {
		return 4;
	}
}

// Set products number for the related products
if ( !function_exists( 'quickloans_woocommerce_output_related_products_args' ) ) {
	//Handler of the add_filter( 'woocommerce_output_related_products_args', 'quickloans_woocommerce_output_related_products_args' );
	function quickloans_woocommerce_output_related_products_args($args) {
		$args['posts_per_page'] = max(0, min(9, quickloans_get_theme_option('related_posts')));
		$args['columns'] = max(1, min(4, quickloans_get_theme_option('related_columns')));
		return $args;
	}
}

// Set columns number for the related products
if ( !function_exists( 'quickloans_woocommerce_related_products_columns' ) ) {
	//Handler of the add_filter('woocommerce_related_products_columns', 'quickloans_woocommerce_related_products_columns' );
	function quickloans_woocommerce_related_products_columns($columns) {
		$columns = max(1, min(4, quickloans_get_theme_option('related_columns')));
		return $columns;
	}
}



// Decorate WooCommerce output: Widgets
//------------------------------------------------------------------------

// Search form
if ( !function_exists( 'quickloans_woocommerce_get_product_search_form' ) ) {
	//Handler of the add_filter( 'get_product_search_form', 'quickloans_woocommerce_get_product_search_form' );
	function quickloans_woocommerce_get_product_search_form($form) {
		return '
		<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__('Search for products &hellip;', 'quickloans') . '" value="' . get_search_query() . '" name="s" /><button class="search_button" type="submit">' . esc_html__('Search', 'quickloans') . '</button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (quickloans_exists_woocommerce()) { require_once QUICKLOANS_THEME_DIR . 'plugins/woocommerce/woocommerce.styles.php'; }
?>