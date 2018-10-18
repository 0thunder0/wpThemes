<?php

function td_css_generator() {

    $raw_css = "
    <style>

    /* @theme_color */
    .block-title a, .block-title span, .td-tags a:hover, .td-scroll-up-visible, .td-scroll-up, .sf-menu ul
    .current-menu-item > a, .sf-menu ul a:hover, .sf-menu ul .sfHover > a, .td-rating-bar-wrap div, .iosSlider .slide-meta-cat, .sf-menu ul
    .current-menu-ancestor > a, .td-404-sub-sub-title a, .widget_tag_cloud .tagcloud a:hover, .td-mobile-close a,
    ul.td-category a, .td_social .td_social_type .td_social_button a, .dropcap {
        background-color: @theme_color;
    }
    .block-title, .sf-menu li a:hover, .sf-menu .sfHover a, .sf-menu .current-menu-ancestor a, .header-search-wrap
    .dropdown-menu, .sf-menu > .current-menu-item > a, .ui-tabs-nav, .woocommerce .product .woocommerce-tabs ul.tabs {
        border-color: @theme_color;
    }

    .widget_price_filter .ui-slider-handle {
        border-color: @theme_color !important;
    }

    .author-box-wrap .td-author-name a, blockquote p, .page-nav a:hover, .widget_pages .current_page_item a,
    .widget_calendar td a, .widget_categories .current-cat > a, .widget_pages .current_page_parent > a,
    .td_pull_quote p, .page-nav-post a:hover span {
        color: @theme_color;
    }

    .woocommerce .button, .woocommerce .form-submit #submit, .widget_price_filter .ui-slider-handle,
    .jetpack_subscription_widget input[type=\"submit\"], .pp_woocommerce .pp_close, .pp_woocommerce .pp_expand,
    .pp_woocommerce .pp_contract, .pp_woocommerce .pp_arrow_previous, .pp_woocommerce .pp_arrow_next, .pp_woocommerce
     .pp_next:before, .pp_woocommerce .pp_previous:before {
        background: @theme_color !important;
    }

    .woocommerce .woocommerce-message, .woocommerce .woocommerce-info {
        border-color: @theme_color !important;
    }
    .woocommerce .woocommerce-message:before, .woocommerce .woocommerce-info:before {
        background-color: @theme_color !important;
    }


    .buddypress #buddypress div.dir-search input[type=\"submit\"], .buddypress #buddypress .message-search
    input[type=\"submit\"], .buddypress #buddypress .item-list-tabs ul li.selected a,
    .buddypress #buddypress .generic-button a, .buddypress #buddypress .submit input[type=\"submit\"],
    .buddypress #buddypress .ac-reply-content input[type=\"submit\"], .buddypress #buddypress .standard-form
    input[type=\"submit\"], .buddypress #buddypress .standard-form .button-nav .current a, .buddypress #buddypress .standard-form .button, .buddypress #buddypress input[type=\"submit\"],
        .buddypress #buddypress a.accept, .buddypress #buddypress #activate-page .standard-form input[type=\"submit\"],
        .buddypress #buddypress .standard-form #group-create-body input[type=\"button\"],
        .post-password-required input[type=\"submit\"]  {
        background: @theme_color !important;
    }

    .buddypress #buddypress .groups .item-meta {
        color: @theme_color !important;
    }

    .page-nav .current, .page-nav-post span {
        background-color: @theme_color;
        border-color: @theme_color;
    }
    .wpb_btn-inverse, .ui-tabs-nav .ui-tabs-active a, .post .wpb_btn-danger, .form-submit input, .wpcf7-submit,
    .wpb_default, .woocommerce .product .woocommerce-tabs ul.tabs li.active, .woocommerce.widget_product_search
    input[type=\"submit\"], .more-link-wrap, .td_read_more {
        background-color: @theme_color !important;
    }
    .header-search-wrap .dropdown-menu:before {
        border-color: transparent transparent @theme_color;
    }
    .td-mobile-content .current-menu-item > a, .td-mobile-content a:hover {
        color: @theme_color !important;
    }
    .category .entry-content, .tag .entry-content, .td_quote_box {
        border-color: @theme_color;
    }


    /* @slider_text */
    .td-sbig-title-wrap .td-sbig-title, .td-slide-item-sec .td-sbig-title-wrap, .td-mobile-post .td-sbig-title-wrap a {
        background-color: @slider_text;
    }

    /* @jetpack caption hover */
    .tiled-gallery-caption {
        background: @slide_text !important;
    }



    /* @select_color */
    ::-moz-selection {
        background: @select_color;
        color: #fff;
    }

    ::selection {
        background: @select_color;
        color: #fff;
    }


    /* @menu_color */
    .td-full-layout .td-menu-background {
        background: @menu_color !important;
    }

    .td-boxed-layout .td-menu-background .td-menu-wrap {
        background: @menu_color !important;
    }


    /* @header_wrap_color */
    .td-full-layout .td-header-bg {
        background-color: @header_wrap_color !important;
    }

    .td-boxed-layout .td-logo-rec-wrap {
        background-color: @header_wrap_color !important;
    }


    /* @logo_text_color */
    .header-logo-wrap .td-logo-text, .header-logo-wrap .td-tagline-text {
        color: @logo_text_color !important;
    }


    /* @header_align_top */
    .td-logo-rec-wrap .span4,
    .td-logo-rec-wrap .span8 {
        top: @header_align_toppx !important;
        position: relative !important;
    }

    @media (max-width: 767px) {
        .td-logo-rec-wrap {
            top: 0px !important;
        }
    }


    /* @top_menu_color */
    .td-full-layout .td-header-menu-wrap {
        background-color: @top_menu_color !important;
    }

    .td-boxed-layout .td-header-menu-wrap .container {
        background-color: @top_menu_color !important;
    }

	
	/* @link_color */
	a, .widget_recent_comments .recentcomments .url {
		color: @link_color;
    }
    .cur-sub-cat {
      color:@link_color !important;
    }

	
	/* @link_hover_color */
	a:hover, .widget_recent_comments .recentcomments .url:hover {
		color: @link_hover_color;
    }


    /* ------------------------------------------------------ */
    /* @menu_font_family */
    .sf-menu a {
        font-family: @menu_font_family;
    }


    /* @menu_font_size */
    .sf-menu a {
        font-size: @menu_font_size !important;
    }

    /* @menu_line_height */
    .sf-menu a {
        line-height: @menu_line_height;
    }

    /* ------------------------------------------------------ */
    /* @top_menu_font_family */
    .td-header-menu-wrap {
        font-family: @top_menu_font_family;
    }


    /* @top_menu_font_size */
    .td-header-menu-wrap {
        font-size: @top_menu_font_size;
    }

    /* @top_menu_line_height */
    .td-header-menu-wrap {
        line-height: @top_menu_line_height;
    }

    /* ------------------------------------------------------ */
    /* @content_font_family */
    body {
        font-family: @content_font_family;
    }

    /* @content_font_size */
    body {
        font-size: @content_font_size !important;
    }

    /* @content_line_height */
    body {
        line-height: @content_line_height;
    }

    /* ------------------------------------------------------ */
    /* @normal_slide_font_family */
    .td_normal_slide .td-sbig-title-wrap .td-sbig-title {
        font-family: @normal_slide_font_family !important;
    }

    /* @normal_slide_font_size */
    .td_normal_slide .td-sbig-title-wrap a, .td_normal_slide .iosSlider-col-2 .item .td-sbig-title-wrap a, .td_normal_slide .iosSlider-col-1 .item .td-sbig-title-wrap a {
        font-size: @normal_slide_font_size !important;
    }

    /* @normal_slide_line_height */
    .td_normal_slide .td-sbig-title-wrap a, .td_normal_slide .iosSlider-col-2 .item .td-sbig-title-wrap a, .td_normal_slide .iosSlider-col-1 .item .td-sbig-title-wrap a  {
        line-height: @normal_slide_line_height;
    }

    /* ------------------------------------------------------ */
    /* @big_slide_main_font_family */
    .td_block_slide_big .td-slide-item-main .td-sbig-title-wrap .td-sbig-title {
        font-family: @big_slide_main_font_family !important;
    }

    /* @big_slide_main_font_size */
    .td_block_slide_big .td-slide-item-main .td-sbig-title-wrap .td-sbig-title {
        font-size: @big_slide_main_font_size !important;
    }

    /* @big_slide_main_line_height */
    .td_block_slide_big .td-slide-item-main .td-sbig-title-wrap .td-sbig-title {
        line-height: @big_slide_main_line_height;
    }

    /* ------------------------------------------------------ */
    /* @big_slide_sec_font_family */
    .td_block_slide_big .td-slide-item-sec .td-sbig-title-wrap a, .td-mobile-post .td-sbig-title-wrap a {
        font-family: @big_slide_sec_font_family !important;
    }

    /* @big_slide_sec_font_size */
    .td_block_slide_big .td-slide-item-sec .td-sbig-title-wrap a {
        font-size: @big_slide_sec_font_size !important;
    }

    /* @big_slide_sec_line_height */
    .td_block_slide_big .td-slide-item-sec .td-sbig-title-wrap a {
        line-height: @big_slide_sec_line_height;
    }

    /* ------------------------------------------------------ */
    /* @widget_title_font_family */
    .block-title a, .block-title span, .block-title label {
        font-family: @widget_title_font_family !important;
    }

    /* @widget_title_font_size */
    .block-title a, .block-title span, .block-title label {
        font-size: @widget_title_font_size !important;
    }

    /* @widget_title_line_height */
    .block-title a, .block-title span, .block-title label {
        line-height: @widget_title_line_height;
    }

    /* ------------------------------------------------------ */
    /* @widget_art_big_title_font_family */
    .td_mod2 .entry-title a, .td_mod5 .entry-title a, .td_mod6 .entry-title a, .td_mod_search .entry-title a  {
        font-family: @widget_art_big_title_font_family !important;
    }

    /* @widget_art_big_title_font_size */
    .td_mod2 .entry-title a, .td_mod5 .entry-title a, .td_mod6 .entry-title a, .td_mod_search .entry-title a {
        font-size: @widget_art_big_title_font_size !important;
    }

    /* @widget_art_big_title_line_height */
    .td_mod2 .entry-title a, .td_mod5 .entry-title a, .td_mod6 .entry-title a, .td_mod_search .entry-title a {
        line-height: @widget_art_big_title_line_height !important;
    }

    /* ------------------------------------------------------ */
    /* @widget_art_small_title_font_family */
    .td_mod3 .entry-title a, .td_mod4 .entry-title a {
        font-family: @widget_art_small_title_font_family !important;
    }

    /* @widget_art_small_title_font_size */
    .td_mod3 .entry-title a, .td_mod4 .entry-title a {
        font-size: @widget_art_small_title_font_size !important;
    }

    /* @widget_art_small_title_line_height */
    .td_mod3 .entry-title a, .td_mod4 .entry-title a {
        line-height: @widget_art_small_title_line_height !important;
    }

    /* ------------------------------------------------------ */
    /* @post_title_font_family */
    .post header h1 a, .td-page-title a, .td-page-title span {
        font-family: @post_title_font_family !important;
    }

    /* @post_title_font_size */
    .post header h1 a, .td-page-title a, .td-page-title span {
        font-size: @post_title_font_size !important;
    }

    /* @post_title_line_height */
    .post header h1 a, .td-page-title a, .td-page-title span {
        line-height: @post_title_line_height !important;
    }

    /* ------------------------------------------------------ */
    /* @tabs_title_font_family */
    .ui-tabs-nav a {
        font-family: @tabs_title_font_family;
    }

    /* @tabs_title_font_size */
    .ui-tabs-nav a {
        font-size: @tabs_title_font_size;
    }

    /* @tabs_title_line_height */
    .ui-tabs-nav a {
        line-height: @tabs_title_line_height;
    }

    /* @small_text_slide */
    .td-sbig-title-wrap a {
        text-transform: none;
    }

    </style>
    ";



    $td_css_compiler = new td_css_compiler($raw_css);



    //load the user settings
    $td_css_compiler->load_setting('theme_color');
    $td_css_compiler->load_setting('header_wrap_color');
    $td_css_compiler->load_setting('menu_color');
    $td_css_compiler->load_setting('top_menu_color');
    $td_css_compiler->load_setting('logo_text_color');
	$td_css_compiler->load_setting('link_color');
	$td_css_compiler->load_setting('link_hover_color');
    $td_css_compiler->load_setting('small_text_slide');
    $td_css_compiler->load_setting('header_align_top');

    //load the selection color
    $tds_theme_color = td_util::get_customizer_option('theme_color');
    if (!empty($tds_theme_color)) {
        //the select
        $td_css_compiler->load_setting_raw('select_color', td_util::adjustBrightness($tds_theme_color, 50));

        //the sliders text
        $td_css_compiler->load_setting_raw('slider_text', td_util::hex2rgba($tds_theme_color, 0.7));
    }






    //fonts
    $td_css_compiler->load_setting_raw('menu_font_family', td_google_fonts::css_get_font_family('menu_font_family'));
    $td_css_compiler->load_setting('menu_font_size', 'px');
    $td_css_compiler->load_setting('menu_line_height', 'px');

    $td_css_compiler->load_setting_raw('top_menu_font_family', td_google_fonts::css_get_font_family('top_menu_font_family'));
    $td_css_compiler->load_setting('top_menu_font_size', 'px');
    $td_css_compiler->load_setting('top_menu_line_height', 'px');

    $td_css_compiler->load_setting_raw('content_font_family', td_google_fonts::css_get_font_family('content_font_family'));
    $td_css_compiler->load_setting('content_font_size', 'px');
    $td_css_compiler->load_setting('content_line_height', 'px');

    $td_css_compiler->load_setting_raw('big_slide_main_font_family', td_google_fonts::css_get_font_family('big_slide_main_font_family'));
    $td_css_compiler->load_setting('big_slide_main_font_size', 'px');
    $td_css_compiler->load_setting('big_slide_main_line_height', 'px');

    $td_css_compiler->load_setting_raw('big_slide_sec_font_family', td_google_fonts::css_get_font_family('big_slide_sec_font_family'));
    $td_css_compiler->load_setting('big_slide_sec_font_size', 'px');
    $td_css_compiler->load_setting('big_slide_sec_line_height', 'px');

    $td_css_compiler->load_setting_raw('normal_slide_font_family', td_google_fonts::css_get_font_family('normal_slide_font_family'));
    $td_css_compiler->load_setting('normal_slide_font_size', 'px');
    $td_css_compiler->load_setting('normal_slide_line_height', 'px');

    $td_css_compiler->load_setting_raw('widget_title_font_family', td_google_fonts::css_get_font_family('widget_title_font_family'));
    $td_css_compiler->load_setting('widget_title_font_size', 'px');
    $td_css_compiler->load_setting('widget_title_line_height', 'px');

    $td_css_compiler->load_setting_raw('widget_art_big_title_font_family', td_google_fonts::css_get_font_family('widget_art_big_title_font_family'));
    $td_css_compiler->load_setting('widget_art_big_title_font_size', 'px');
    $td_css_compiler->load_setting('widget_art_big_title_line_height', 'px');

    $td_css_compiler->load_setting_raw('widget_art_small_title_font_family', td_google_fonts::css_get_font_family('widget_art_small_title_font_family'));
    $td_css_compiler->load_setting('widget_art_small_title_font_size', 'px');
    $td_css_compiler->load_setting('widget_art_small_title_line_height', 'px');

    $td_css_compiler->load_setting_raw('post_title_font_family', td_google_fonts::css_get_font_family('post_title_font_family'));
    $td_css_compiler->load_setting('post_title_font_size', 'px');
    $td_css_compiler->load_setting('post_title_line_height', 'px');

    $td_css_compiler->load_setting_raw('tabs_title_font_family', td_google_fonts::css_get_font_family('tabs_title_font_family'));
    $td_css_compiler->load_setting('tabs_title_font_size', 'px');
    $td_css_compiler->load_setting('tabs_title_line_height', 'px');





    //output the style
    td_css_buffer::add($td_css_compiler->compile_css());
}

add_action('wp_head', 'td_css_generator', 10);

?>