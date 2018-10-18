<?php
/*
    tagDiv - 2013
    Our portofolio:  http://themeforest.net/user/tagDiv/portfolio
    Thanks for using our theme !
*/


/*  ----------------------------------------------------------------------------
    deploy mode - this file tells the theme what settings to load (demo, (dev) development, deploy)
 */
require_once('td_deploy_mode.php');


/*  ----------------------------------------------------------------------------
    wp_cake - this is our theme framework - all the content and settings are there
 */
require_once('includes/td_wp_cake.php');


/*
 * author meta support
 */
require_once('wp-admin/td_author.php' );


/*
 * if debug - the constants are used to load the live color customizer (demo) and to remove the tf bar on ios devices
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    require_once('includes/deploy/td_theme_style.php' );
}

if (TD_DEBUG_IOS_REDIRECT) {
    require_once('includes/deploy/td_ios_redirect.php' );
}



/*  ----------------------------------------------------------------------------
    CSS - front end
 */

function td_load_css() {

    //google fonts
    $td_protocol = is_ssl() ? 'https' : 'http';
    if ((defined('TD_DEPLOY_MODE') and (TD_DEPLOY_MODE == 'demo' or TD_DEPLOY_MODE == 'dev')) or defined('TD_SPEED_BOOSTER')) { //on demo and dev we load only the latin fonts
        //modify this collection if you want to optimize the fonts loaded
        //collection url -> : http://www.google.com/fonts#ReviewPlace:refine/Collection:PT+Sans:400,700,400italic|Ubuntu:400,400italic|Open+Sans:400italic,400|Oswald:400,700|Roboto+Condensed:400italic,700italic,400,700
        wp_enqueue_style('google-font-rest', $td_protocol . '://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic|Ubuntu:400,400italic|Open+Sans:400italic,400|Oswald:400,700|Roboto+Condensed:400italic,700italic,400,700'); //used on menus/small text
    } else {
        wp_enqueue_style('google-font-opensans', $td_protocol . '://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic'); //used on menus/small text
        wp_enqueue_style('google-font-ubuntu', $td_protocol . '://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&amp;subset=latin,cyrillic-ext,greek-ext,greek,latin-ext,cyrillic'); //used on content
        wp_enqueue_style('google-font-pt-sans', $td_protocol . '://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic&subset=latin,cyrillic-ext,latin-ext,cyrillic'); //used on content
        wp_enqueue_style('google-font-oswald', $td_protocol . '://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext'); //used on content
        wp_enqueue_style('google-roboto-cond', $td_protocol . '://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic'); //used on content
    }



    //bootstrap - custom built - it was generated via compilation of /external/bootstrap-master/less/bootstrap.less
    $responsive = td_util::get_customizer_option('responsive');
    switch ($responsive) {
        case '980_responsive':
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/external/td-bootstrap-980-responsive.css', '', TD_THEME_VERSION, 'all' );
            break;

        case '980':
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/external/td-bootstrap-980-not-resp.css', '', TD_THEME_VERSION, 'all' );
            break;

        case '1170':
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/external/td-bootstrap-1170-not-resp.css', '', TD_THEME_VERSION, 'all' );
            break;

        default:
            wp_enqueue_style('td-bootstrap', get_template_directory_uri() . '/external/td-bootstrap.css', '', TD_THEME_VERSION, 'all' );
            break;
    }





    //main theme style - set the TD_DEBUG_USE_LESS flag in /includes/app/td_config.php and the theme will load the less files and compile them for you
    if (TD_DEBUG_USE_LESS) {
        wp_enqueue_style('td-theme', get_template_directory_uri() . '/td_less_compiler.php',  array('td-bootstrap'), TD_THEME_VERSION, 'all' );
        //wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.less', array('td-bootstrap'), TD_THEME_VERSION, 'all' );
    } else {
        wp_enqueue_style('td-theme', get_stylesheet_uri(), array('td-bootstrap'), TD_THEME_VERSION, 'all' );
    }
}
add_action('wp_enqueue_scripts', 'td_load_css');



/*  ----------------------------------------------------------------------------
    CSS - wp-admin
 */

function td_load_td_admin_css() {
    wp_enqueue_style('td-wp-admin-style', get_template_directory_uri() . '/wp-admin/css/wp-admin-style.css', false, TD_THEME_VERSION, 'all' );
    wp_enqueue_style('td-wp-admin-td-panel', get_template_directory_uri() . '/wp-admin/css/wp-admin-td-panel.css', false, TD_THEME_VERSION, 'all' );
}
add_action('admin_enqueue_scripts', 'td_load_td_admin_css');
add_action('customize_controls_print_styles', 'td_load_td_admin_css');  //load our css in wp theme customizer



/*  ----------------------------------------------------------------------------
    JS - main
 */

function td_load_js() {

    if (TD_DEPLOY_MODE == 'demo') { //on demo load compressed js
        //wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js',array( 'jquery' ), 1, true); //the main site script
        //wp_enqueue_script('site', get_template_directory_uri() . '/js/min/site.min.js',array( 'jquery' ), 1, true); //the main site script
        //wp_enqueue_script('site-external', get_template_directory_uri() . '/js/min/external.min.js', array( 'site' ), 1, true); //load at begining

        wp_enqueue_script('site-external', get_template_directory_uri() . '/js/min/external.min.js', array( 'jquery' ), 1, true); //load at begining
        wp_enqueue_script('site', get_template_directory_uri() . '/js/min/site.min.js',array( 'site-external' ), 1, true); //the main site script

        /*
         * //it's already appended
        if (TD_DEBUG_LIVE_THEME_STYLE) {
            wp_enqueue_script('td-js-style-customizer', get_template_directory_uri() . '/js/min/style_customizer.min.js',array( 'jquery'), 1, true);
        }
        (*/
    } else {
        wp_enqueue_script('site-external', get_template_directory_uri() . '/js/external.js',array( 'jquery' ), 1, true); //load at begining
        wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js',array( 'site-external' ), 1, true); //the main site script

        if (TD_DEBUG_LIVE_THEME_STYLE) {
            wp_enqueue_script('td-js-style-customizer', get_template_directory_uri() . '/js/style_customizer.js',array( 'jquery'), 1, true);
        }
    }


}
add_action('wp_enqueue_scripts', 'td_load_js');



/*  ----------------------------------------------------------------------------
    JS - admin
 */

function td_load_js_admin() {
    wp_enqueue_script('td-wp-admin-js', get_template_directory_uri() . '/wp-admin/js/wp-admin-js.js', array('jquery'), 1, false);
}
add_action('admin_enqueue_scripts', 'td_load_js_admin');



/*  ----------------------------------------------------------------------------
    JS - theme customizer
 */

function td_load_js_theme_customizer() {
    wp_enqueue_script('td-theme-custom', get_template_directory_uri() . '/wp-admin/js/theme-customizer.js', array('jquery'), 1, true);
}
add_action('customize_controls_init', 'td_load_js_theme_customizer');



// used by ie8 - there is no other way to add js for ie8 only
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->
    ';
}
add_action('wp_head', 'add_ie_html5_shim');



/*  ----------------------------------------------------------------------------
    Custom <title> wp_title - seo
 */
function td_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . __td('页面') . ' ' .  max( $paged, $page );

    return $title;
}
add_filter( 'wp_title', 'td_wp_title', 10, 2 );



/*  ----------------------------------------------------------------------------
    Pagebuilder
 */

global $td_row_count, $td_column_count;

$td_row_count = 0;
$td_column_count = 0;

$dir = dirname(__FILE__) . '/wpbakery';


$composer_settings = Array(
    'APP_ROOT'      => $dir . '/js_composer',
    'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
    'APP_DIR'       => basename( $dir ) . '/js_composer/',
    'CONFIG'        => $dir . '/js_composer/config/',
    'ASSETS_DIR'    => 'assets/',
    'COMPOSER'      => $dir . '/js_composer/composer/',
    'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
    'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',

    /* for which content types Visual Composer should be enabled by default */
    'default_post_types' => Array('page')
);


require_once locate_template('/wpbakery/js_composer/js_composer.php');

//map all of our blocks in page builder
td_global_blocks::wpb_map_all();

//remove unused composer elements;
vc_remove_element("vc_separator");
vc_remove_element("vc_text_separator");
vc_remove_element("vc_message");
vc_remove_element("vc_toggle");
vc_remove_element("vc_gallery");
vc_remove_element("vc_tour"); //wtf
vc_remove_element("vc_accordion");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_facebook");


$wpVC_setup->init($composer_settings);



/*  ----------------------------------------------------------------------------
    visual composer rewrite classes
 */

function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if ($tag=='vc_row' || $tag=='vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
    }
    if ($tag=='vc_column' || $tag=='vc_column_inner') {
        $class_string = preg_replace('/vc_span(\d{1,2})/', 'span$1', $class_string);
    }
    return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);



/*  ----------------------------------------------------------------------------
    Category metadata
 */

require_once("wp-admin/external/Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
  /*
   * configure your meta box
   */
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => '演示元素框',          // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );



  /*
   * Initiate your meta box
   */

  $my_meta =  new Tax_Meta_Class($config);

  /*
   * Add fields to your meta box
   */
    $td_module_list = array(
        '0' => ' - 默认 - ',
        '1' => 'module 1',
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
    //layout
    $my_meta->addSelect('tdc_layout', $td_module_list, array('name'=> __('布局 ','tax-meta'), 'std'=> array('')));

    //sidebar position:
    $my_meta->addSelect('tdc_sidebar_pos',  array(
        '' => ' - 默认 - ',
        'sidebar_right' => '右侧边栏',
        'sidebar_left' => '左侧边栏',
        'no_sidebar' => '无边栏'
    ), array('name' => __('边栏位置 ','tax-meta'), 'std'=> array('')));

    //category sidebar
    $currentSidebars = td_util::get_option('sidebars'); //read the sidebars
    $categorySidebar = array();

    $categorySidebar[''] = ' - 默认边栏 - ';
    if (!empty($currentSidebars)) {
        foreach ($currentSidebars as $sidebar) {
            $categorySidebar[$sidebar] = $sidebar;
        }
    }

    if (count($categorySidebar) > 0) {
        $my_meta->addSelect('tdc_sidebar_name', $categorySidebar, array('name'=> __('分类 边栏','tax-meta'), 'std'=> array('')));
    }


    //slider
    $my_meta->addSelect('tdc_slider', array(
        ''=>' - 小型滑块 - ',
        'hide_slider'=> 'hide slider'
    ), array('name'=> __('在分类目录显示特色滑块 ','tax-meta'), 'std'=> array('')));

    //Category color
    $my_meta->addColor('tdc_color', array('name'=> __('分类颜色 ','tax-meta')));

    //background image
    $my_meta->addImage('tdc_image', array('name'=> __('分类背景 ','tax-meta')));
    $my_meta->addSelect('tdc_bg_repeat', array(
        ''=>' - 展开 - ',
        'tile'=>'标题'
    ),array('name'=> __('背景样式 ','tax-meta'), 'std'=> array('')));

    //Category background color
    $my_meta->addColor('tdc_bg_color', array('name'=> __('分类背景颜色 ','tax-meta')));




    $my_meta->addSelect('tdc_hide_on_post', array(''=> '文章中显示', 'hide'=>'文章中隐藏'),array('name'=> __('文章中隐藏 ','tax-meta'), 'std'=> array('')));

    $my_meta->Finish();
}








/*  ----------------------------------------------------------------------------
    page view counter
 */

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



/*  ----------------------------------------------------------------------------
    archive widget - add current class
 */
function theme_get_archives_link ( $link_html ) {
    global $wp;
    static $current_url;
    if ( empty( $current_url ) ) {
        $current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
    }
    if ( stristr( $current_url, 'page' ) !== false ) {
        $current_url = substr($current_url, 0, strrpos($current_url, 'page'));
    }
    if ( stristr( $link_html, $current_url ) !== false ) {
        $link_html = preg_replace( '/(<[^\s>]+)/', '\1 class="current"', $link_html, 1 );
    }
    return $link_html;
}
add_filter('get_archives_link', 'theme_get_archives_link');



/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */

add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
  $links = str_replace('</a> (', '<span class="td-widget-no">', $links);
  $links = str_replace(')', '</span></a>', $links);
  return $links;
}

//fix archives widget
add_filter('get_archives_link', 'archive_count_no_brackets');
function archive_count_no_brackets($links) {
    $links = str_replace('</a>&nbsp;(', '<span class="td-widget-no">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}


//remove gallery style css
add_filter( 'use_default_gallery_style', '__return_false' );



function remove_more_link_scroll( $link ) {

	$link = preg_replace( '|#more-[0-9]+|', '', $link );

        $link = '<div class="more-link-wrap wpb_button wpb_btn-danger">' . $link . '</div>';
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );



/*  ----------------------------------------------------------------------------
    excerpt lenght
 */

add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
    $excerpt_length = td_util::get_option('tds_wp_default_excerpt');
    if (!empty($excerpt_length) and is_numeric($excerpt_length)) {
        return $excerpt_length;
    } else {
        return 22; //default
    }
}



/*  ----------------------------------------------------------------------------
    more text
 */

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($text){
	return ' ';
}



/*  ----------------------------------------------------------------------------
    editor style
 */

add_editor_style();



/*  ----------------------------------------------------------------------------
    thumbnails
 */

//the image sizes that we use
add_theme_support( 'post-thumbnails' );

//featured image
$td_crop_features_image = td_util::get_customizer_option('crop_features_image');
if ($td_crop_features_image == '') {
 add_image_size('featured-image', 700, 0, true);
} else {
 add_image_size('featured-image', 700, 357, true);
}

//the small thumbnails
set_post_thumbnail_size(          100, 65, true );
add_image_size('art-thumb',       100, 65, true);

//small height, 1 col wide
add_image_size('art-wide',        326, 159, true);

//medium height 1 col wide
add_image_size('art-big-1col',    326, 235, true);

//the slides
add_image_size('art-slide-small', 326, 406, true);
add_image_size('art-slide-med',   700, 357, true);
add_image_size('art-slide-big',  1074, 483, true);

//big slider - big image
add_image_size('art-slidebig-main',  745, 483, true);

//the gallery
add_image_size('art-gal',         210, 210, true);



/*  ----------------------------------------------------------------------------
    Post formats
 */

add_theme_support('post-formats', array('gallery', 'video', 'link', 'quote'));



/*  ----------------------------------------------------------------------------
    localization
 */

function my_theme_setup(){
    load_theme_textdomain(TD_THEME_NAME, get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'my_theme_setup');



/*  ----------------------------------------------------------------------------
    shortcodes in widgets
 */

add_filter('widget_text', 'do_shortcode');



/*  ----------------------------------------------------------------------------
    content width
 */

if (!isset($content_width)) {
    $content_width = 700;
}



/*  ----------------------------------------------------------------------------
    rss supporrt
 */

add_theme_support('automatic-feed-links');



/*  ----------------------------------------------------------------------------
    Register the themes default menus
 */

add_filter('wp_nav_menu_objects', 'my_nav_menu_objects_shortcode_mangler', 11);


//do shortcodes in menu
function my_nav_menu_objects_shortcode_mangler($items) {
    $td_is_firstMenu = true;
    foreach ($items as $item) {
        if ($td_is_firstMenu) {
            $item->classes[] = 'menu-item-first';
            $td_is_firstMenu = false;
        }
        if (strpos($item->title,'[') === false) {

        } else {
            //on shortcodes [home] etc.. do not show down arrow
            //print_r($item);
            $item->classes[] = 'td-no-down-arrow';
        }

        $item->title = do_shortcode($item->title);
    }
    return $items;
}



function register_my_menus() {
  register_nav_menus(
      array(
        'top-menu' => __( '顶部菜单', TD_THEME_NAME),
        'header-menu' => __( '头部(主)菜单', TD_THEME_NAME),
        'footer-menu' => __( '底部菜单', TD_THEME_NAME)
      )
  );
}
add_action( 'init', 'register_my_menus' );



/*  ----------------------------------------------------------------------------
    Register the themes default sidebars + dinamic ones
 */

//register the default sidebar
register_sidebar(array(
    'name'=> TD_THEME_NAME . ' default',
    'id' => 'td-default', //the id is used by the importer
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="block-title"><span>',
    'after_title' => '</span></div>'
));

register_sidebar(array(
    'name'=>'Top right (social)',
    'id' => 'td-top-right',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
));

register_sidebar(array(
        'name'=>'页脚 1',
        'id' => 'td-footer-1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="block-title"><span>',
        'after_title' => '</span></div>'
    ));

register_sidebar(array(
        'name'=>'页脚 2',
        'id' => 'td-footer-2',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="block-title"><span>',
        'after_title' => '</span></div>'
    ));

register_sidebar(array(
        'name'=>'页脚 3',
        'id' => 'td-footer-3',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="block-title"><span>',
        'after_title' => '</span></div>'
    ));



//get our custom dynamic sidebars
$currentSidebars = td_util::get_option('sidebars');

//if we have user made sidebars, register them in wp
if (!empty($currentSidebars)) {
    foreach ($currentSidebars as $sidebar) {
        register_sidebar(array(
            'name'=>$sidebar,
            'id' => 'td-' . td_util::sidebar_name_to_id($sidebar),
            'before_widget' => '<aside class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class="block-title"><span>',
            'after_title' => '</span></div>',
        ));

    } //end foreach
}


/*  -----------------------------------------------------------------------------
    WP-ADMIN section
 */



/*
 * the wp-admin panels
 */

require_once('wp-admin/td_mvc/td_controller.php');

/*
 * the wp-admin TinyMCE editor buttons
 */
require_once('wp-admin/tinymce/tinymce.php');


/*
 * Custom content metaboxes (the select sidebar dropdown/post etc)
 */
require_once ('wp-admin/content-metaboxes/td_templates_settings.php');





//the bottom code for analytics and stuff
function td_bottom_code() {
    $td_analytics = td_util::get_option('td_analytics');
    echo stripslashes($td_analytics);
    echo '

    <!--
        Theme: ' . TD_THEME_NAME .' by tagDiv 2013
        Version: ' . TD_THEME_VERSION . ' (rara)
        Deploy mode: ' . TD_DEPLOY_MODE . '
    -->

    ';


    $authorMetaGoogle = get_the_author_meta('googleplus');
    if (!empty($authorMetaGoogle)) {
        echo '<a href="' . $authorMetaGoogle . '?rel=author"></a>';
    }
}
add_action('wp_footer', 'td_bottom_code');





//Append page slugs to the body class
function add_slug_to_body_class( $classes ) {
        global $post;
        if( is_home() ) {
                $key = array_search( 'blog', $classes );
                if($key > -1) {
                        unset( $classes[$key] );
                };
        } elseif( is_page() ) {
                $classes[] = sanitize_html_class( $post->post_name );
        } elseif(is_singular()) {
                $classes[] = sanitize_html_class( $post->post_name );
        };

        foreach ($classes as $key => $value) {
            $pos = strripos($value, 'span');
            if ($pos !== false) {
                unset($classes[$i]);
            }

            $pos = strripos($value, 'row');
            if ($pos !== false) {
                unset($classes[$i]);
            }

            $pos = strripos($value, 'container');
            if ($pos !== false) {
                unset($classes[$i]);
            }
        }
        return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');






//remove span row container classes from post_class()
function add_slug_to_post_class( $classes ) {
    $i = 0;
    foreach ($classes as $key => $value) {
        $pos = strripos($value, 'span');
        if ($pos !== false) {
            unset($classes[$i]);
        }

        $pos = strripos($value, 'row');
        if ($pos !== false) {
            unset($classes[$i]);
        }

        $pos = strripos($value, 'container');
        if ($pos !== false) {
            unset($classes[$i]);
        }
        $i++;
    }
    return $classes;
}
add_filter('post_class', 'add_slug_to_post_class');







/*  -----------------------------------------------------------------------------
    TGM_Plugin_Activation
 */
require_once dirname( __FILE__ ) . '/includes/external/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'td_required_plugins');

function td_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'     				=> 'tagDiv social counter', // The plugin name
            'slug'     				=> 'td-social-counter', // The plugin slug (typically the folder name)
            'source'   				=> get_template_directory_uri() . '/includes/plugins/td-social-counter.zip', // The plugin source
            'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
            'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'     				=> 'Revolution slider', // The plugin name
            'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
            'source'   				=> get_template_directory_uri() . '/includes/plugins/revslider.zip', // The plugin source
            'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
            'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name' 		=> 'Jetpack',
            'slug' 		=> 'jetpack',
            'required' 	=> false,
        ),
        array(
            'name' 		=> 'Animated Gif Resize',
            'slug' 		=> 'animated-gif-resize',
            'required' 	=> false,
        ),
        array(
            'name' 		=> 'Contact form 7',
            'slug' 		=> 'contact-form-7',
            'required' 	=> false,
        )

    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'tgmpa';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
        'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
        'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
        'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
        'menu'         		=> 'install-required-plugins', 	// Menu slug
        'has_notices'      	=> true,                       	// Show admin notices or not
        'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
        'message' 			=> '',							// Message to output right before the plugins table
        'strings'      		=> array(
            'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
            'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}



/*  -----------------------------------------------------------------------------
    Our custom admin bar
 */
add_action('admin_bar_menu', 'td_custom_menu', 1000);
function td_custom_menu() {
    global $wp_admin_bar;
    if(!is_super_admin() || !is_admin_bar_showing()) return;

    $wp_admin_bar->add_menu(array(
        'parent' => 'site-name',
        'title' => '主题 - 选项',
        'href' => admin_url('themes.php?page=td_controller'),
        'id' => 'td-menu1'
    ));


    $wp_admin_bar->add_menu(array(
        'parent' => 'site-name',
        'title' => '主题 - 边栏',
        'href' => admin_url('themes.php?page=td_controller.php&td_page=sidebars'),
        'id' => 'td-menu2'
    ));


    $wp_admin_bar->add_menu(array(
        'parent' => 'site-name',
        'title' => '主题 - 翻译',
        'href' => admin_url('themes.php?page=td_controller.php&td_page=translate'),
        'id' => 'td-menu3'
    ));


    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $wp_admin_bar->add_menu(array(
        'parent' => 'site-name',
        'title' => '<span class="td-admin-bar-red">主题 - 定制</span>',
        'href' => add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() ),
        //'href' => admin_url('customize.php'),
        'id' => 'customize'
    ));

    $wp_admin_bar->add_menu( array(
        'id'   => 'our_support_item',
        'meta' => array('title' => '主题支持', 'target' => '_blank'),
        'title' => '主题支持',
        'href' => 'http://forum.tagdiv.com' ));

}


/*  -----------------------------------------------------------------------------
    Woo commerce
 */

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) { // check if we have woo commerce installed
    // breadcrumb
    add_filter( 'woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs' );

    function td_woocommerce_breadcrumbs() {
        return array(
            'delimiter' => ' <span class="td-sp td-sp-breadcrumb-arrow td-bread-sep"></span> ',
            'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
            'wrap_after' => '</div>',
            'before' => '',
            'after' => '',
            'home' => _x( '首页', 'breadcrumb', 'woocommerce' ),
        );
    }

    // number of products to display on shop page
    add_filter('loop_shop_per_page', create_function('$cols', 'return 8;'));



    if (!function_exists('woocommerce_pagination')) {
        // pagination
        function woocommerce_pagination(){
            echo td_page_generator::get_pagination();
        }
    }


    if (!function_exists('woocommerce_output_related_products')) {
        // number of related product
        function woocommerce_output_related_products() {
            woocommerce_related_products(4,4); // Display 4 products in rows of 4
        }
    }
}



/**
 * Add prev and next links to a numbered link list - the pagination on single.
 */
function wp_link_pages_args_prevnext_add($args)
{
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number')
        return $args; # exit early

    $args['next_or_number'] = 'number'; # keep numbering for the main part
    if (!$more)
        return $args; # exit early

    if($page-1) # there is a previous page
    $args['before'] .= _wp_link_page($page-1)
        . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
    ;

    if ($page<$numpages) # there is a next page
    $args['after'] = _wp_link_page($page+1)
        . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
        . $args['after']
    ;

    return $args;
}
add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');


/*  -----------------------------------------------------------------------------
    Search filter
 */
function td_search_filter_published( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_status', array('publish') );
    }
    return $query;
}
add_filter('pre_get_posts','td_search_filter_published');