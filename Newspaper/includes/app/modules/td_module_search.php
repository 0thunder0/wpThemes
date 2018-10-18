<?php
//used by the search page

class td_module_search extends td_module {
    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        $buffy = '';
        $buffy .= '<div class="td_mod_search td_mod_wrap' . $this->get_no_thumb_class() . '" ' . $this->get_item_scope() . '>';
        $buffy .= $this->get_image('thumbnail');

        $buffy .= '<div class="item-details">';
        $buffy .= $this->get_title(td_util::get_option('tds_mod_search_title_excerpt'));
            $buffy .= '<div class="meta-info">';
                $buffy .= $this->get_bread_crumbs();
                $buffy .= $this->get_author();
                $buffy .= $this->get_date();
                //$buffy .= $this->get_commentsAndViews();
            $buffy .= '</div>';

            $buffy .= $this->get_excerpt(td_util::get_option('tds_mod_search_content_excerpt'));
        $buffy .= '</div>';

        $buffy .= $this->get_item_scope_meta();
        $buffy .= '</div>';

        return $buffy;
    }

    function get_bread_crumbs() {

        $primary_category_id = '';

        //read the post setting
        $td_post_theme_settings = get_post_meta($this->post->ID, 'td_post_theme_settings', true);
        if (!empty($td_post_theme_settings['td_primary_cat'])) {
            $primary_category_id = $td_post_theme_settings['td_primary_cat'];

        } else {
            $categories = get_the_category($this->post->ID);
            foreach($categories as $category) {
                if ($category->name != TD_FEATURED_CAT) { //ignore the featured category name
                    $primary_category_id = $category->cat_ID;
                    break;
                }
            }
        }

        $category_1_name = '';
        $category_1_url = '';
        $category_2_name = '';
        $category_2_url = '';


        $primary_category_obj = get_category($primary_category_id);

        //print_r($primary_category_obj);
        if (!empty($primary_category_obj)) {
            if (!empty($primary_category_obj->name)) {
                $category_1_name = $primary_category_obj->name;
            } else {
                $category_1_name = '';
            }

            if (!empty($primary_category_obj->cat_ID)) {
                $category_1_url = get_category_link($primary_category_obj->cat_ID);
            }

            if (!empty($primary_category_obj->parent) and $primary_category_obj->parent != 0) {
                $parent_category_obj = get_category($primary_category_obj->parent);
                if (!empty($parent_category_obj)) {
                    $category_2_name = $parent_category_obj->name;
                    $category_2_url = get_category_link($parent_category_obj->cat_ID);
                }
            }
        }

        //print_r($primary_category_obj);

        $td_separator = ' <span class="td-sp td-sp-breadcrumb-arrow td-bread-sep"></span> ';

        $buffy = '';
        if (!empty($category_1_name)) {
            $buffy .= '<div itemscope="" itemtype="http://schema.org/WebPage" class="entry-crumbs">';

            //home
            if (td_util::get_option('tds_breadcrumbs_show_home') != 'hide') {
                $buffy .=  '<a class="entry-crumb" itemprop="breadcrumb" href="' . get_home_url() . '">Home</a>';
            }

            //parent category
            if (!empty($category_2_name) and td_util::get_option('tds_breadcrumbs_show_parent') != 'hide' ) {
                if (td_util::get_option('tds_breadcrumbs_show_home') != 'hide') {
                    $buffy .=  $td_separator;
                }

                $buffy .= '<a class="entry-crumb" itemprop="breadcrumb" href="' . $category_2_url . '" title="' . __td('View all posts in') . ' ' . htmlspecialchars($category_2_name) . '">' . $category_2_name . '</a>';

                $buffy .=  $td_separator;
            } else {
                if (td_util::get_option('tds_breadcrumbs_show_home') != 'hide') {
                    $buffy .=  $td_separator;
                }
            }


            $buffy .= '<a class="entry-crumb" itemprop="breadcrumb" href="' . $category_1_url . '" title="' . __td('View all posts in') . ' ' . htmlspecialchars($category_1_name) . '">' . $category_1_name . '</a>';

            //article title
            if (td_util::get_option('tds_breadcrumbs_show_article') != 'hide') {
                $buffy .=  $td_separator;
                $buffy .=  '<span>' . td_excerpt($this->title, 13) . '</span>';
            }
            $buffy .= '</div>';
        }

        return $buffy;
    }


    function get_image($thumbType, $image_link = '', $image_excerpt = '') {
        $attachment_id = get_post_thumbnail_id($this->post->ID);
        if (empty($attachment_id)) {
            //print_r($this->post);
            if (current_user_can('edit_posts')) {
                $td_edit_link = '<a class="td-admin-edit" href="' . get_edit_post_link($this->post->ID) . '">edit</a>';
            } else {
                $td_edit_link = '';
            }

            $buffy = '';


            $buffy .= '<div class="thumb-wrap">';
                $buffy .='<a href="' . $this->href . '" rel="bookmark">';

                if ($this->post->post_type == 'page') {
                    $buffy .= $td_edit_link . '<img src="'. get_template_directory_uri() .'/images/no-img-page.png" alt="" title="" />';
                } else {
                    $buffy .= $td_edit_link . '<img src="'. get_template_directory_uri() .'/images/no-img-post.png" alt="" title="" />';
                }

                $buffy .= '</a>';

            $buffy .= '</div>';
            return $buffy;

        } else {
            return parent::get_image($thumbType, $image_link);
        }
    }
}

?>