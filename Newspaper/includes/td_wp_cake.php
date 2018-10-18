<?php

/**
 * WP cake framework v1.0 by tagDiv
 */


// ~ app config ~ theme config
require_once('app/td_config.php');




// theme specific config values
require_once('class/td_global.php');
require_once('class/td_global_blocks.php');

// Util class
require_once('class/td_util.php');


// google fonts support
require_once("class/td_google_fonts.php");

// theme specific config values
require_once('app/td_translate.php');

// ajax
require_once("app/td_ajax.php");


// The social icons
require_once('class/td_social_icons.php');

// Review
require_once('class/td_review.php');




// vide thumbnail support
require_once('class/td_video_support.php');


// page views counter
require_once('class/td_page_views.php');

// css buffer class
require_once('class/td_css_buffer.php');

// js buffer class
require_once('class/td_js_buffer.php');

// page generator
require_once('content_builder/td_page_generator.php');

// block layout
require_once('content_builder/td_block_layout.php');

// template layout
require_once('content_builder/td_template_layout.php');

// data source
require_once('content_builder/td_data_source.php');

// module builder
require_once('content_builder/td_module.php');

// block builder
require_once('content_builder/td_block.php');

// widget builder
require_once('content_builder/td_widget_builder.php');



// customizer
require_once('customizer/td_customizer_wrap.php');

//
require_once('customizer/td_customizer_settings.php');


// ~ app config ~ customizer settings
require_once('app/td_customizer.php');



// css compiler
require_once('customizer/td_css_compiler.php');




// ~ app config ~ css generator
require_once('app/td_css_generator.php');


// ~ app config ~ css generator
require_once('app/td_js_generator.php');

/*
 * the code that runs on the first install of the theme
 */
require_once('app/td_first_install.php');

//the background support
require_once('class/td_background.php');


//the responsive support
require_once('class/td_responsive.php');


//modules modifier
require_once('app/modules/module_modifier/td_module_blog.php');



//modules
require_once('app/modules/td_module_1.php');
require_once('app/modules/td_module_2.php');
require_once('app/modules/td_module_3.php');
require_once('app/modules/td_module_4.php');
require_once('app/modules/td_module_5.php');
require_once('app/modules/td_module_6.php');
require_once('app/modules/td_module_7.php');
require_once('app/modules/td_module_8.php');
require_once('app/modules/td_module_9.php');
require_once('app/modules/td_module_slide.php');
require_once('app/modules/td_module_slide_big.php');
require_once('app/modules/td_module_aj_search.php');
require_once('app/modules/td_module_search.php');
require_once('app/modules/td_module_full_w_content.php');


//blocks
require_once('app/shortcodes/td_block_1.php');
require_once('app/shortcodes/td_block_2.php');
require_once('app/shortcodes/td_block_3.php');
require_once('app/shortcodes/td_block_4.php');
require_once('app/shortcodes/td_block_5.php');
require_once('app/shortcodes/gallery.php');
require_once('app/shortcodes/td_menu.php');
require_once('app/shortcodes/td_quote.php');
require_once('app/shortcodes/td_ad_box.php');
require_once('app/shortcodes/td_social.php');
require_once('app/shortcodes/td_popular_categories.php');
require_once('app/shortcodes/td_authors.php');
require_once('app/shortcodes/td_text_with_title.php');
require_once('app/shortcodes/td_slide.php');
require_once('app/shortcodes/td_slide_big.php');
require_once('app/shortcodes/td_revolution_slider.php');

//widgets
require_once('app/widgets/td_page_builder_widgets.php');
require_once('app/widgets/td_footer_logo_widget.php');



// the demo site
require_once('class/td_demo_site.php');



do_action('td_wp_cake_loaded'); //used by our plugins
?>