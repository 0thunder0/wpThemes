<?php
global $loop_module_id, $loop_sidebar_position, $post;


td_global::load_single_post($post);


/*  ----------------------------------------------------------------------------
    the post template (single article template)
 */

get_header();


/* used by
    /includes/app/modules/module_modifier/td_module_blog.php
    /sidebar.php
*/



//set the template id, used to get the template specific settings
$template_id = 'home';  //home = blog index = blog - use the same settings from the blog index

//prepare the loop variables

//read the global settings
$loop_sidebar_position = td_util::get_customizer_option($template_id . '_sidebar_pos'); //sidebar right is default (empty)
$loop_module_id = 1; //use the default 1 module (full post)



//print_r($td_post_theme_settings);

//read the primary category sidebar position! - we have to make the page after the primary category or after the global setting
$primary_category_id = td_global::get_primary_category_id();
if (!empty($primary_category_id)) {
    $tax_meta_sidebar = get_tax_meta($primary_category_id, 'tdc_sidebar_pos');
    if (!empty($tax_meta_sidebar)) {
        //update the sidebar position from the category setting
        $loop_sidebar_position = $tax_meta_sidebar;
    }
}


//read the custom single post settings - this setting overids all of them
$td_post_theme_settings = get_post_meta($post->ID, 'td_post_theme_settings', true);
if (!empty($td_post_theme_settings['td_sidebar_position'])) {
    $loop_sidebar_position = $td_post_theme_settings['td_sidebar_position'];
}


//increment the views counter
td_page_views::update_page_views($post->ID);

switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
            <?php
            get_template_part('loop', 'simple');
            comments_template('', true);
            ?>
        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        //td_global::$load_featured_img_from_template = 'art-slide-big';
        td_global::$load_featured_img_from_template = 'full';
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
            <?php
            get_template_part('loop', 'simple');
            comments_template('', true);
            ?>
        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
                <?php
                get_template_part('loop', 'simple');
                comments_template('', true);
                ?>
            </div>
            <div class="span4 column_container" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                <?php get_sidebar(); ?>
            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;
}
get_footer();




?>