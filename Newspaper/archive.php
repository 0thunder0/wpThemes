<?php
/*  ----------------------------------------------------------------------------
    the archive(s) template
 */


get_header();




//set the template id, used to get the template specific settings
$template_id = 'archive';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position, $part_cur_auth_obj;
$loop_module_id = td_util::get_customizer_option($template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_customizer_option($template_id . '_sidebar_pos'); //sidebar right is default (empty)


//read the current author object - used by here in title and by /parts/author-header.php
$part_cur_auth_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));


switch ($loop_sidebar_position) {
    case 'sidebar_left':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span4 column_container">
            <?php get_sidebar(); ?>
        </div>
        <div class="span8 column_container">

            <?php
            echo td_page_generator::get_archive_breadcrumbs();
            get_template_part('parts/archive', 'header');
            get_template_part('loop', 'simple');

            echo td_page_generator::get_pagination();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;

    case 'no_sidebar':
        echo td_page_generator::wrap_start();
        ?>
        <div class="span12 column_container">

            <?php
            echo td_page_generator::get_archive_breadcrumbs();
            get_template_part('parts/archive', 'header');
            get_template_part('loop', 'simple');

            echo td_page_generator::get_pagination();
            ?>

        </div>
        <?php
        echo td_page_generator::wrap_end();
        break;



    default:
        echo td_page_generator::wrap_start();
        ?>
            <div class="span8 column_container">

                <?php
                echo td_page_generator::get_archive_breadcrumbs();
                get_template_part('parts/archive', 'header');
                get_template_part('loop', 'simple');

                echo td_page_generator::get_pagination();
                ?>

            </div>
            <div class="span4 column_container">
                <?php get_sidebar(); ?>
            </div>
        <?php
        echo td_page_generator::wrap_end();
        break;
}


get_footer();
?>