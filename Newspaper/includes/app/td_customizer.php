<?php

//make a new customizer settings object
$td_customizer_settings = new td_customizer_settings();


$currentSidebars = td_util::get_option('sidebars'); //read the sidebars

/*  ----------------------------------------------------------------------------
    Template options
 */
$sidebars_array[''] = 'Default sidebar';
if (!empty($currentSidebars)) {
    foreach ($currentSidebars as $sidebar) {
        $sidebars_array[$sidebar] = $sidebar;
    }
}


$td_module_list = array(
    '' => 'module 1',
    '2' => 'module 2',
    '3' => 'module 3',
    '4' => 'module 4',
    '5' => 'module 5',
    '6' => 'module 6',
    '7' => 'module 7',
    '8' => 'module 8',
    '9' => 'module 9',
    'search' => 'module search'
);

$td_sidebar_pos = array(
    '' => 'Sidebar right',
    'sidebar_left' => 'Sidebar left',
    'no_sidebar' => 'No sidebar',
);


$td_customizer_settings->add_section('Template options');



$td_customizer_settings->add_radio('Responsive', 'responsive', array(
    '' => 'Full responsive (1170px)',
    '980_responsive' => 'Full responsive (980px)',
    '980' => '980px fixed layout',
    '1170' => '1170px fixed layout'
));


// blog page - home.php template
$td_customizer_settings->add_td_separator('Blog index page', '1');
$td_customizer_settings->add_select('Blog - sidebar position', 'home_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Blog - sidebar', 'home_sidebar', $sidebars_array);
$td_customizer_settings->add_select('Blog - layout', 'home_page_layout', $td_module_list);


// page template
$td_customizer_settings->add_td_separator('Page template', '11');
$td_customizer_settings->add_select('Page - sidebar position', 'page_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Page - sidebar', 'page_sidebar', $sidebars_array);


//archives
$td_customizer_settings->add_td_separator('Archive page', '2');
$td_customizer_settings->add_select('Archives - sidebar position', 'archive_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Archives - sidebar', 'archive_sidebar', $sidebars_array);
$td_customizer_settings->add_select('Archives - layout', 'archive_page_layout', $td_module_list);



//attachment
$td_customizer_settings->add_td_separator('Attachment page', '22');
$td_customizer_settings->add_select('Attachment - sidebar position', 'attachment_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Attachment - sidebar', 'attachment_sidebar', $sidebars_array);


//author page
$td_customizer_settings->add_td_separator('Author page', '3');
$td_customizer_settings->add_select('Author - sidebar position', 'author_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Author - sidebar', 'author_sidebar', $sidebars_array);
$td_customizer_settings->add_select('Author - layout', 'author_page_layout', $td_module_list);


//category page
$td_customizer_settings->add_td_separator('Category page', '4');
$td_customizer_settings->add_select('Category - sidebar position', 'category_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Category - sidebar', 'category_sidebar', $sidebars_array);
$td_customizer_settings->add_select('Category - layout', 'category_page_layout', $td_module_list);

//tag page
$td_customizer_settings->add_td_separator('Tag page', '5');
$td_customizer_settings->add_select('Tag - sidebar position', 'tag_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Tag - sidebar', 'tag_sidebar', $sidebars_array);
$td_customizer_settings->add_select('Tag - layout', 'tag_page_layout', $td_module_list);


//search results page
$td_customizer_settings->add_td_separator('Search page', '6');
$td_customizer_settings->add_select('Search - sidebar position', 'search_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Search - sidebar', 'search_sidebar', $sidebars_array);
$td_customizer_settings->add_select('Search - layout', 'search_page_layout', $td_module_list);

//search results page
$td_customizer_settings->add_td_separator('Woocommerce', '61');
$td_customizer_settings->add_select('Woocommerce - sidebar position', 'woo_sidebar_pos', $td_sidebar_pos);
$td_customizer_settings->add_select('Woocommerce - sidebar', 'woo_sidebar', $sidebars_array);



//404 page?
$td_customizer_settings->add_td_separator('404 page', '7');
$td_customizer_settings->add_select('404 page - layout', '404_page_layout', $td_module_list);


//Upper or lower case title on slide posts; id 71 is used, this is way we use 711
$td_customizer_settings->add_td_separator('Upper or lower case title - slide posts', '711');
$td_customizer_settings->add_radio('Upper or lower case title on slide posts', 'small_text_slide', array(
    '' => 'Uppercase',
    'normal' => 'Normal text'
));

/*  ----------------------------------------------------------------------------
    Colors
 */
$td_customizer_settings->add_section('Colors');
$td_customizer_settings->add_color('Theme color', 'theme_color', '#4db2ec');
$td_customizer_settings->add_color('Header color', 'header_wrap_color', '#ffffff');
$td_customizer_settings->add_color('Menu color', 'menu_color', '#ffffff');
$td_customizer_settings->add_color('Top menu color', 'top_menu_color', '#4c4c4c');
$td_customizer_settings->add_color('Logo text color', 'logo_text_color', '#444444');
$td_customizer_settings->add_color('Link color', 'link_color', '#4db2ec');
$td_customizer_settings->add_color('Link hover color', 'link_hover_color', '#4db2ec');

/*  ----------------------------------------------------------------------------
    Headers
 */
$td_customizer_settings->add_section('Header');
$td_customizer_settings->add_radio('Header style', 'header_style', array(
    '' => 'Default (logo + ad)',
    '2' => 'Style 2 (text logo + ad)',
    '3' => 'Style 3 (full header centered)'
));

$td_customizer_settings->add_input('Align header up/down (ex: -10)', 'header_align_top', 0);

$td_customizer_settings->add_radio('Top menu (black one)', 'top_menu', array(
    '' => 'Show the menu',
    'hide' => 'Hide the menu'
));


$td_customizer_settings->add_radio('Show date on black header', 'data_top_menu', array(
    '' => 'Hide data',
    'show' => 'Show data'
));
$td_customizer_settings->add_input('Data and time format - default: l, F j, Y', 'data_time_format', 'l, F j, Y');


/*  ----------------------------------------------------------------------------
    Logo
*/
$td_customizer_settings->add_section('Logo');
$td_customizer_settings->add_image_upload('Upload your logo (300px x 100px) .png', 'logo_upload');
$td_customizer_settings->add_image_upload('Retina logo (600px x 200px) .png', 'logo_upload_r');
$td_customizer_settings->add_image_upload('Favicon (16px x 16px) .png', 'favicon_upload');

$td_customizer_settings->add_input('Logo alt attribute', 'logo_alt');
$td_customizer_settings->add_input('Logo title attribute', 'logo_title');


/*  ----------------------------------------------------------------------------
    Post settings
*/
$td_customizer_settings->add_section('Post settings');
$td_customizer_settings->add_radio('Featured image', 'show_featured_image', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Featured image lightbox?', 'featured_image_view_setting', array(
    '' => 'Link to article + lightbox',
    'lightbox' => 'Show lightbox',
    'link' => 'Link to picture',
    'no_link' => 'No link'
));

$td_customizer_settings->add_radio('Crop features image', 'crop_features_image', array(
    '' => 'Don\'t crop',
    'crop' => 'Crop',
));

$td_customizer_settings->add_radio('Show date', 'p_show_date', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Show post views', 'p_show_views', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Use 7 days post sorting', 'p_enable_7_days_count', array(
    '' => 'Disabled',
    'enabled' => 'Enabled'
));

$td_customizer_settings->add_radio('Show comment count', 'p_show_comments', array(
    '' => 'Show',
    'hide' => 'Hide'
));


$td_customizer_settings->add_radio('Tags', 'show_tags', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Author box', 'show_author_box', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Next and Previous posts', 'show_next_prev', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Similar articles', 'similar_articles', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Similar articles - type', 'similar_articles_type', array(
    '' => 'by category',
    'by_tag' => 'by tag',
    'by_auth' => 'by author'
));

$td_customizer_settings->add_radio('Similar articles - count', 'similar_articles_count', array(
    '' => '2 posts',
    '4' => '4 posts',
    '6' => '6 posts',
    '8' => '8 posts'
));


$td_customizer_settings->add_radio('Breadcrumbs - Show them on posts', 'breadcrumbs_show', array(
    '' => 'Show breadcrumbs',
    'hide' => 'Hide breadcrumbs'
));

$td_customizer_settings->add_radio('Breadcrumbs - show home link', 'breadcrumbs_show_home', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Breadcrumbs - show parent category link', 'breadcrumbs_show_parent', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_radio('Breadcrumbs - show article title', 'breadcrumbs_show_article', array(
    '' => 'Show',
    'hide' => 'Hide'
));

$td_customizer_settings->add_td_separator('Article sharing', '566');
$td_customizer_settings->add_radio('Social - show article sharing', 'social_show', array(
    '' => 'Show',
    'hide' => 'Hide'
));
$td_customizer_settings->add_input('Social twitter ID', 'social_twitter');


/*  ----------------------------------------------------------------------------
    Google fonts
*/

$td_customizer_settings->add_section('Google fonts');
td_google_fonts::generate_settings($td_customizer_settings);






/*  ----------------------------------------------------------------------------
   Navigation
*/
$td_customizer_settings->add_section('Navigation', 'nav');
$td_customizer_settings->add_radio('Snap menu', 'snap_menu', array(
    '' => 'Only on big screens (not on mobile)',
    'always' => 'Always',
    'never' => 'Never'
));


/*  ----------------------------------------------------------------------------
  Background
*/

$td_customizer_settings->add_section('Background', 'background_image');

$td_customizer_settings->add_radio('Stretch background', 'stretch_background', array(
    '' => 'No',
    'yes' => 'Yes'
));





/*  ----------------------------------------------------------------------------
  Excerpts
*/
$td_customizer_settings->add_section('Excerpts');

$td_customizer_settings->add_radio('Excerpts Type', 'excerpts_type', array(
    '' => 'On Words',
    'letters' => 'On Letters'
));

$td_customizer_settings->add_td_separator('Module 2', 'e2');
$td_customizer_settings->add_input('Title length', 'mod2_title_excerpt');
$td_customizer_settings->add_input('Content length', 'mod2_content_excerpt');

$td_customizer_settings->add_td_separator('Module 3', 'e3');
$td_customizer_settings->add_input('Title length', 'mod3_title_excerpt');

$td_customizer_settings->add_td_separator('Module 4', 'e4');
$td_customizer_settings->add_input('Title length', 'mod4_title_excerpt');

$td_customizer_settings->add_td_separator('Module 5', 'e5');
$td_customizer_settings->add_input('Title length', 'mod5_title_excerpt');
$td_customizer_settings->add_input('Content length', 'mod5_content_excerpt');

$td_customizer_settings->add_td_separator('Module 6', 'e6');
$td_customizer_settings->add_input('Title length', 'mod6_title_excerpt');

$td_customizer_settings->add_td_separator('Module 7', 'e7');
$td_customizer_settings->add_input('Content length', 'mod7_content_excerpt');

$td_customizer_settings->add_td_separator('Module 8', 'e8');
$td_customizer_settings->add_input('Title length', 'mod8_title_excerpt');
$td_customizer_settings->add_input('Content length', 'mod8_content_excerpt');

$td_customizer_settings->add_td_separator('Module 9', 'e9');
$td_customizer_settings->add_input('Title length', 'mod9_title_excerpt');
$td_customizer_settings->add_input('Content length', 'mod9_content_excerpt');

$td_customizer_settings->add_td_separator('Module search', 'e10');
$td_customizer_settings->add_input('Title length', 'mod_search_title_excerpt');
$td_customizer_settings->add_input('Content length', 'mod_search_content_excerpt');

$td_customizer_settings->add_td_separator('Wordpress default', 'e11');
$td_customizer_settings->add_input('Content length', 'wp_default_excerpt', 22);



/*  ----------------------------------------------------------------------------
   Ads
*/


$td_customizer_settings->add_section('Ads');

//read the adspots
$td_ad_spots = td_util::get_option('td_ad_spots');
$td_pb_ad_spots = array();
$td_pb_ad_spots[''] = 'Text ad spot';

if (!empty($td_ad_spots)) {
    foreach ($td_ad_spots as $td_ad_spot) {
        $td_pb_ad_spots['Ad spot -- ' . $td_ad_spot['name']] = 'Ad spot -- ' . $td_ad_spot['name'];
    }
}
//read the google adspots
$td_adsense_spots = td_util::get_option('td_adsense_spots');
if (!empty($td_adsense_spots)) {
    foreach ($td_adsense_spots as $td_ad_spot) {
        $td_pb_ad_spots['Adsense spot -- ' . $td_ad_spot['name']] = 'Adsense spot -- ' . $td_ad_spot['name'];
    }
}

$td_customizer_settings->add_td_separator('Header ad', 'a1');
//header ad
$td_customizer_settings->add_select('Top ad spot', 'top_ad_spot', $td_pb_ad_spots);
$td_customizer_settings->add_td_textarea('Top ad spot code:', 'top_ad_code', '');



//inline ads
$td_customizer_settings->add_td_separator('In content ad', 'a2');
$td_customizer_settings->add_radio('Inline ad', 'inline_ad', array(
    '' => 'Center',
    'left' => 'Left aligned'
));
$td_customizer_settings->add_input('Show Ad after paragraph:', 'inline_ad_paragraph', 3);
$td_pb_ad_spots[''] = 'No inline ad';
$td_customizer_settings->add_select('Inline ad spot', 'inline_ad_spot', $td_pb_ad_spots);


/*  ----------------------------------------------------------------------------
   Footer
*/
$td_customizer_settings->add_section('Footer');

//header ad
$td_customizer_settings->add_radio('Footer widget columns', 'footer_widget_cols', array(
    '' => '1/3 - 1/3 - 1/3',
    '23-13' => '2/3 - 1/3',
    '13-23' => '1/3 - 2/3',
    '33' => '3/3 (full)'
));

$td_customizer_settings->add_input('Footer copyright text', 'footer_copyright');
$td_customizer_settings->add_radio('Show copyright symbol', 'footer_copy_symbol', array(
    '' => 'yes',
    'no' => 'no'
));


















//add the global instance
td_util::$td_customizer_settings = $td_customizer_settings;

?>
