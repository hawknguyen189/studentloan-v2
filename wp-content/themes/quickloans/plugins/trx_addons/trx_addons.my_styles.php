<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('quickloans_trx_addons_my_get_css')) {
	add_filter('quickloans_filter_get_css', 'quickloans_trx_addons_my_get_css', 10, 4);
	function quickloans_trx_addons_my_get_css($css, $colors, $fonts, $scheme='') {


        if (isset($css['fonts']) && $fonts) {
            $css['fonts'] .= <<<CSS
.sc_skills_pie.sc_skills_compact_off .sc_skills_total,
.sc_countdown_default .sc_countdown_digits,
.sc_countdown .sc_countdown_label,
.trx_addons_banner_large,
.trx_addons_banner_medium,
.sc_skills_pie.sc_skills_compact_off .sc_skills_item_title,
.wpb_text_column big,
.sc_testimonials_item_author_title,
.sc_testimonials_item_author_subtitle,
.sc_table table th {
	{$fonts['h1_font-family']}
}
.sc_price_item_price .sc_price_item_price_after,
.sc_price_item_price .sc_price_item_price_before,
.widget_area .post_item .post_info, .widget .post_item .post_info {
	{$fonts['p_font-family']}
}
footer .sc_layouts_row,
.sc_layouts_row.sc_layouts_row_type_normal {
	{$fonts['p_font-size']}
}

CSS;
        }

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS
.trx_addons_accent2 {
	color: {$colors['text_link2']};
}
.trx_addons_accent_bg {
    color: {$colors['bg_color']};
    background-color: {$colors['text_link2']};
}
.trx_addons_tooltip {
    color: {$colors['text']};
    border-color: {$colors['text']};
}
.trx_addons_tooltip:before {
    background-color: {$colors['text_link']};
}
.trx_addons_tooltip:after {
    border-top-color: {$colors['text_link']};
}
ol[class*="trx_addons_list"] > li:before {
    color: {$colors['text_dark']};
}
ul[class*="trx_addons_list"]>li:before {
    color: {$colors['text_link2']};
}
.sc_layouts_row_type_compact .sc_layouts_login .trx_addons_login_link .sc_layouts_item_icon {
    color: {$colors['bg_color']};
}
.sc_layouts_row_type_compact .sc_layouts_login .trx_addons_login_link {
    color: {$colors['bg_color']};
    background-color: {$colors['text_link']};
    background-image: linear-gradient(to top, {$colors['alter_link']} 0%, {$colors['alter_hover']} 100%);
}
.sc_layouts_row_type_compact .sc_layouts_column_align_right .sc_layouts_item:first-child + .sc_layouts_item:before {
    background-color: {$colors['bd_color']};
}
/* Menu */
.sc_layouts_menu_nav > li > a {
	color: {$colors['text_dark']}!important;
}
.sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['text_link2']} !important;
}
.sc_layouts_menu_nav > li.current-menu-item > a,
.sc_layouts_menu_nav > li.current-menu-parent > a,
.sc_layouts_menu_nav > li.current-menu-ancestor > a {
	color: {$colors['text']} !important;
}
.sc_layouts_menu_nav .menu-collapse > a:before {
	color: {$colors['alter_text']};
}
.sc_layouts_menu_nav .menu-collapse > a:after {
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:before {
	color: {$colors['alter_link']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:after {
	background-color: {$colors['alter_bg_hover']};
}

/* Submenu */
.sc_layouts_menu_popup .sc_layouts_menu_nav,
.sc_layouts_menu_nav > li ul {
    background-color: {$colors['text_link']};
    background-image: linear-gradient(to top, {$colors['alter_link']} 0%, {$colors['alter_hover']} 100%);
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li li > a {
	color: {$colors['bg_color']} !important;
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li.sfHover > a,
.sc_layouts_menu_nav > li li > a:hover,
.sc_layouts_menu_nav > li li.sfHover > a {
	color: {$colors['text_dark']} !important;
	background-color: {$colors['bg_color_0']};
}
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children > a:hover,
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children.sfHover > a {
	color: {$colors['text_dark']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav > li li[class*="icon-"]:before {
	color: {$colors['bg_color']};
}
.sc_layouts_menu_nav > li li[class*="icon-"]:hover:before,
.sc_layouts_menu_nav > li li[class*="icon-"].shHover:before {
	color: {$colors['text_dark']};
}
.sc_layouts_menu_nav > li li.current-menu-item > a,
.sc_layouts_menu_nav > li li.current-menu-parent > a,
.sc_layouts_menu_nav > li li.current-menu-ancestor > a {
	color: {$colors['text_dark']} !important;
}
.sc_layouts_menu_nav > li li.current-menu-item:before,
.sc_layouts_menu_nav > li li.current-menu-parent:before,
.sc_layouts_menu_nav > li li.current-menu-ancestor:before {
	color: {$colors['text_dark']} !important;
}

/* Mobile menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_hover']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner,
.menu_mobile_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_dark']};
}
.menu_mobile_button:hover {
	color: {$colors['text_link']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_dark']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['alter_link']};
}
.menu_mobile_inner a,
.menu_mobile_inner .menu_mobile_nav_area li:before {
	color: {$colors['alter_dark']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a,
.menu_mobile_inner .menu_mobile_nav_area li:hover:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-ancestor:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-item:before {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['input_dark']};
}

.menu_mobile_inner .social_item .social_icon {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_compact .sc_layouts_item_details,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details,
.sc_layouts_row_type_compact .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon {
	color: {$colors['text_link2']};
}
.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.sc_layouts_row_type_compact .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line2 {
	color: {$colors['text_link2']};
}
.breadcrumbs .breadcrumbs_item.current {
	color: {$colors['text_link2']};
}
.sc_layouts_title_breadcrumbs a:hover {
	color: {$colors['text_link2']}!important;
}
.widget_nav_menu ul.menu li a {
	color: {$colors['input_text']};
}
.widget_nav_menu ul.menu li a:hover {
	color: {$colors['text_link2']};
}
.mcfwp-agree-input a {
	color: {$colors['input_text']};
}


.footer_wrap .socials_wrap .social_item .social_icon,
.scheme_self.footer_wrap .socials_wrap .social_item .social_icon {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text_dark']};
}
.footer_wrap .socials_wrap .social_item:hover .social_icon,
.scheme_self.footer_wrap .socials_wrap .social_item:hover .social_icon {
	color: {$colors['text_link2']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text_link2']};
}
.sc_skills_pie.sc_skills_compact_off .sc_skills_total {
	color: {$colors['text_dark']};
}
.sc_countdown[class*="vc_custom"] .sc_countdown_digits span {
	color: {$colors['text_link2']};
}
.sc_countdown[class*="vc_custom"] .sc_countdown_label {
    color: {$colors['bg_color']};
}
.slider_swiper .swiper-pagination-bullet:after,
.slider_swiper_outer .swiper-pagination-bullet:after {
	background-color: {$colors['text_link2']};
}
.slider_swiper .slider_pagination_wrap .swiper-pagination-bullet,
.slider_swiper_outer .slider_pagination_wrap .swiper-pagination-bullet,
.swiper-pagination-custom .swiper-pagination-button {
	background-color: {$colors['bg_color_05']};
	border-color: {$colors['bg_color_0']};
}
/* Price */
.sc_price_item {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bg_color']};
}
.sc_price .sc_price_columns_wrap [class*="trx_addons_column-"]:nth-child(2n) .sc_price_item {
	background-color: {$colors['alter_light']};
}
.sc_price_item:hover {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bg_color']};
}
.sc_price_item .sc_price_item_icon {
	color: {$colors['text_link2']};
}
.sc_price_item:hover .sc_price_item_icon {
	color: {$colors['text_link2']};
}
.sc_price_item .sc_price_item_label {
	background-color: {$colors['extra_link']};
	color: {$colors['inverse_text']};
}
.sc_price_item:hover .sc_price_item_label {
	background-color: {$colors['extra_hover']};
	color: {$colors['inverse_text']};
}
.sc_price_item .sc_price_item_subtitle {
	color: {$colors['text_dark']};
}
.sc_price_item:hover .sc_price_item_title,
.sc_price_item .sc_price_item_title,
.sc_price_item:hover .sc_price_item_title a 
.sc_price_item .sc_price_item_title a {
	color: {$colors['text_dark']};
}
.sc_price_item .sc_price_item_title a:hover{
	color: {$colors['text_link2']};
}
.sc_price_item .sc_price_item_price {
	color: {$colors['text_dark']};
}
.sc_price_item .sc_price_item_description,
.sc_price_item .sc_price_item_details {
	color: {$colors['text']};
}
.sc_price_item_details ul > li:before {
	color: {$colors['text_link2']};
}
.sc_item_subtitle {
    color: {$colors['text']};
}
.sc_services_default .sc_services_item_featured_left .sc_services_item_number, .sc_services_default .sc_services_item_featured_right .sc_services_item_number {
	color: {$colors['text_link2']};
	border-color: {$colors['text_link2']};
}
.sc_services_default .sc_services_item_title a:hover {
    color: {$colors['text_link2']};
}
.sc_team .sc_team_item_thumb .sc_team_item_socials .social_item .social_icon {
	color: {$colors['text_link2']};
	border-color: {$colors['text_link2']};
}
.sc_team .sc_team_item_thumb .sc_team_item_socials .social_item:hover .social_icon {
	color: {$colors['text_link']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text_link']};
}
.sc_services.sc_services_short .sc_services_item.with_image {
	background-color: {$colors['bg_color']};
	color: {$colors['text']};
}
.sc_services.sc_services_short .slides > .swiper-slide:nth-child(2n) .sc_services_item.with_image {
	background-color: {$colors['alter_light']};
}
.sc_services.sc_services_short .slider_swiper .slider_pagination_wrap .swiper-pagination-bullet,
.sc_services.sc_services_short .slider_swiper_outer .slider_pagination_wrap .swiper-pagination-bullet,
.sc_services.sc_services_short .swiper-pagination-custom .swiper-pagination-button,
.sc_services.sc_services_default .slider_swiper .slider_pagination_wrap .swiper-pagination-bullet,
.sc_services.sc_services_default .slider_swiper_outer .slider_pagination_wrap .swiper-pagination-bullet,
.sc_services.sc_services_default .swiper-pagination-custom .swiper-pagination-button {
	background-color: {$colors['alter_dark']};
}
.wpb_text_column big {
	color: {$colors['text_dark']};
}
ul.trx_addons_list_success_circled > li {
	background-color: {$colors['text_link3']};
}
ul.trx_addons_list_success_circled > li:nth-child(2n) {
	background-color: {$colors['bg_color_0']};
}
.scheme_dark .sc_item_subtitle {
	color: {$colors['text_link2']};
}
.sc_team_default .sc_team_item_socials .social_item .social_icon,
.team_member_page .team_member_socials .social_item .social_icon {
	color: {$colors['text']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text']};
}
.sc_team_default .sc_team_item_socials .social_item:hover .social_icon,
.team_member_page .team_member_socials .social_item:hover .social_icon {
	color: {$colors['text_link']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text_link']};
}
.sc_team_default .sc_team_item {
    color: {$colors['text']};
}
.slider_swiper.slider_controls_top .slider_controls_wrap>a,
.slider_swiper.slider_controls_bottom .slider_controls_wrap>a,
.slider_outer_controls_top .slider_controls_wrap>a,
.slider_outer_controls_bottom .slider_controls_wrap>a {
	color: {$colors['text_link2']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text_link2']};
}
.slider_swiper.slider_controls_top .slider_controls_wrap>a:hover,
.slider_swiper.slider_controls_bottom .slider_controls_wrap>a:hover,
.slider_outer_controls_top .slider_controls_wrap>a:hover,
.slider_outer_controls_bottom .slider_controls_wrap>a:hover {
	color: {$colors['text']};
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text']};
}
.sc_blogger_item_content {
	color: {$colors['text']};
}
.sc_testimonials_slider .sc_testimonials_item, .sc_testimonials_columns_wrap .sc_testimonials_item {
	background-color: {$colors['bg_color']};
	color: {$colors['text']};
}
.sc_testimonials_item_content {
	color: {$colors['text']};
}
.sc_testimonials_slider .slides > .swiper-slide:nth-child(2n) .sc_testimonials_item {
	background-color: {$colors['alter_light']};
}
.sc_testimonials_item_author_title, .sc_testimonials_item_author_subtitle {
    color: {$colors['text_dark']};
}
.slider_swiper .slider_pagination_wrap .swiper-pagination-bullet,
.slider_swiper_outer .slider_pagination_wrap .swiper-pagination-bullet,
.swiper-pagination-custom .swiper-pagination-button {
	background-color: {$colors['alter_dark_03']};
}
.sc_services_hover .sc_services_item_subtitle,
.sc_services_hover .sc_services_item_subtitle a {
	color: {$colors['text_link2']};
}
.wpb_text_column h5 > span[class*="icon"] {
	color: {$colors['text_link2']};
}
.header_position_over .logo_slogan {
	color: {$colors['bg_color']};
}
.header_position_over .sc_layouts_row_fixed_on {
	background-color: {$colors['text_dark']}!important;
}
.sc_icons .sc_icons_item_title {
	color: {$colors['text_dark']};
}
.sc_icons .sc_icons_icon {
	color: {$colors['text_link2']};
}
.sc_button.sc_button_wide {
	background: {$colors['text_link3']}!important;
}
.sc_button.sc_button_wide:hover {
	background: {$colors['text_link']}!important;
}
.qis_container {
    background: linear-gradient(to top, {$colors['text_link']} 0%, {$colors['text_link3']} 100%)!important;
}
.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.sc_layouts_row_type_narrow .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line2 {
	color: {$colors['text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_icon {
	color: {$colors['text_link2']};
}
.sc_layouts_row_type_narrow .sc_layouts_item + .sc_layouts_item:before {
	background-color: {$colors['bd_color']};
}
.sc_layouts_row_type_normal .sc_layouts_item_icon,
.sc_layouts_row_type_normal .sc_layouts_item_details_line1,
.sc_layouts_row_type_normal .sc_layouts_item_details_line2 {
	color: {$colors['text_link2']};
}
.sc_blogger_plain .sc_blogger_item {
	background-color: {$colors['bg_color']};
}

.scheme_dark .qis-sliderleft,
.scheme_dark .qis-sliderright {
	color: {$colors['bg_color']}!important;
}
.scheme_dark .qis-interest,
.scheme_dark .qis-repayments {
	color: {$colors['bg_color']}!important;
}
.scheme_dark .qis-total {
	color: {$colors['bg_color']}!important;
}
.scheme_dark .qis,
.scheme_dark .qis__fill {
	background: {$colors['text_link2']}!important;
}
.scheme_dark .qis__fill {
	background: {$colors['text_link']}!important;
}
.scheme_dark .qis__handle {
	background: {$colors['bg_color']}!important;
}


CSS;
		}

		return $css;
	}
}
?>