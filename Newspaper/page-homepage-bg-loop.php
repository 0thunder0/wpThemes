<?php
/* Template Name: Homepage - bg + with article list */

get_header();


td_global::$current_template = 'page-homepage-loop';

global $paged, $loop_module_id, $loop_sidebar_position, $post;
$td_page = (get_query_var('page')) ? get_query_var('page') : 1; //rewrite the global var
$td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //rewrite the global var


//paged works on single pages, page - works on homepage
if ($td_paged > $td_page) {
    $paged = $td_paged;
} else {
    $paged = $td_page;
}


$list_custom_title_show = true; //show the article list title by default
$td_featured_posts = '';




/*
    read the settings for the loop
---------------------------------------------------------------------------------------- */
if (!empty($post->ID)) {
    td_global::load_single_post($post);

    $td_homepage_loop = get_post_meta($post->ID, 'td_homepage_loop', true);

    if (!empty($td_homepage_loop['td_layout'])) {
        $loop_module_id = $td_homepage_loop['td_layout'];
    }

    if (!empty($td_homepage_loop['td_sidebar_position'])) {
        $loop_sidebar_position = $td_homepage_loop['td_sidebar_position'];
    }

    if (!empty($td_homepage_loop['td_sidebar'])) {
        td_global::$load_sidebar_from_template = $td_homepage_loop['td_sidebar'];
    }

    if (!empty($td_homepage_loop['list_custom_title'])) {
        $td_list_custom_title = $td_homepage_loop['list_custom_title'];
    } else {
        $td_list_custom_title =__td('最新文章');
    }


    if (!empty($td_homepage_loop['list_custom_title_show'])) {
        $list_custom_title_show = false;
    }


    if (!empty($td_homepage_loop['featured_posts'])) {
        $td_featured_posts = $td_homepage_loop['featured_posts'];
    }
}


/*
    big slide
---------------------------------------------------------------------------------------- */
get_template_part('parts/slide', 'big-background');




echo td_page_generator::wrap_no_row_start();

/*
    the content if we have one
---------------------------------------------------------------------------------------- */
if(!empty($post->post_content)) { //show this only when we have content
    if (empty($paged) or $paged < 2) { //show this only on the first page

        ?>
        <div class="row-fluid">
            <div class="span12 column_container" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                <?php
                if (have_posts()) {
                    while ( have_posts() ) : the_post();
                        //read the page settings
                        the_content();
                    endwhile; //end loop
                }
                ?>
            </div>
        </div>
    <?php

    }
}




/*
    the main fake loop
---------------------------------------------------------------------------------------- */

echo '<div class="row-fluid">';


//do the loop
$queryPost = Array(
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => $paged
);

//hide featured categories
if ($td_featured_posts != 'show_featured_posts') {
    $queryPost['cat'] = '-' .get_cat_ID(TD_FEATURED_CAT);
}





switch ($loop_sidebar_position) {


    case 'sidebar_left':
        ?>
        <div class="span4 column_container">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container">
            <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) { ?>
                <h4 class="block-title"><span><?php echo $td_list_custom_title?></span></h4>
            <?php }

            query_posts($queryPost);
            get_template_part('loop', 'simple');
            echo td_page_generator::get_pagination();
            ?>
        </div>
        <?php
        break;


    case 'no_sidebar':
        ?>
        <div class="span12 column_container">
            <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) { ?>
                <h4 class="block-title"><span><?php echo $td_list_custom_title?></span></h4>
            <?php }

            query_posts($queryPost);
            get_template_part('loop', 'simple');
            echo td_page_generator::get_pagination();
            ?>
        </div>
        <?php
        break;


    //sidebar right
    default:
        ?>
            <div class="span8 column_container">
                <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) { ?>
                    <h4 class="block-title"><span><?php echo $td_list_custom_title?></span></h4>
                <?php }

                query_posts($queryPost);
                get_template_part('loop', 'simple');
                echo td_page_generator::get_pagination();
                ?>
            </div>
            <div class="span4 column_container">
                <?php get_sidebar(); ?>
            </div>
        <?php
        break;
}


echo '</div>'; //close the .row
echo td_page_generator::wrap_no_row_end();



get_footer();
?>