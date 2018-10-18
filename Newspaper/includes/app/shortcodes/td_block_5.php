<?php


class td_block_5 extends td_block {


    function __construct() {
        $this->block_id = 5;
        add_shortcode('td_block5', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = uniqid(); //update unique id on each render
        global $post;

        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'tag_slug' => '',
                'header_color' => ''
            ),$atts));

        $buffy = ''; //output buffer
        $td_unique_id = uniqid();


        //go only on one category that was selected from drop down
        if (!empty($category_id) and empty($category_ids)) {
            $atts['category_ids'] = $category_id;
        }

        $td_data_source = new td_data_source(); //new data source
        $td_query = &$td_data_source->get_wp_query($atts); //by ref  do the query

        //get the js for this block
        $buffy .= $this->get_block_js($atts, $td_query);

        $buffy .= '<div class="td_block_wrap td_block5">';

        //get the block title
        $buffy .= $this->get_block_title($atts, $td_data_source);

        //get the sub category filter for this block
        $buffy .= $this->get_block_sub_cats($atts, $td_unique_id);

        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
        //inner content of the block
        $buffy .= $this->inner($td_query->posts);
        $buffy .= '</div>';

        //get the ajax pagination for this block
        $buffy .= $this->get_block_pagination($atts, $td_unique_id);
        $buffy .= '</div> <!-- ./block1 -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {
        global $post;

        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = $td_block_layout->get_column_number(); // get the column width of the block
        }
        $td_post_count = 0; // the number of posts rendered
        $td_current_column = 1; //the current column


        if (!empty($posts)) {
            foreach ($posts as $post) {

                $td_module_4 = new td_module_4($post);

                switch ($td_column_number) {

                    case '1': //one column layout
                        $buffy .= $td_module_4->render($post);
                        break;

                    case '2': //two column layout
                        $buffy .= $td_block_layout->open_row();

                        $buffy .= $td_block_layout->open6();
                        $buffy .= $td_module_4->render($post);
                        $buffy .= $td_block_layout->close6();

                        if ($td_current_column == 2) {
                            $buffy .= $td_block_layout->close_row();
                        }
                        break;

                    case '3': //three column layout
                        $buffy .= $td_block_layout->open_row();

                        $buffy .= $td_block_layout->open4();
                        $buffy .= $td_module_4->render($post);
                        $buffy .= $td_block_layout->close4();

                        if ($td_current_column == 3) {
                            $buffy .= $td_block_layout->close_row();
                        }
                        break;
                }

                //current column
                if ($td_current_column == $td_column_number) {
                    $td_current_column = 1;
                } else {
                    $td_current_column++;
                }


                $td_post_count++;
            }
        }
        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }


    function get_map () {
        return array(
            "name" => __("Block 5", TD_THEME_NAME),
            "base" => "td_block5",
            "class" => "td_block5",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-block5',
            "params" => array(
                array(
                    "param_name" => "category_id",
                    "type" => "dropdown",
                    "value" => td_get_category2id_array(),
                    "heading" => __("Category filter:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "category_ids",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Multiple categories filter:", TD_THEME_NAME),
                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 13,23,18)",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "tag_slug",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Filter by tag slug:", TD_THEME_NAME),
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "limit",
                    "type" => "textfield",
                    "value" => __("5", TD_THEME_NAME),
                    "heading" => __("Limit post number:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Latest -' => '', 'Popular (all time)' => 'popular', 'Popular (last 7 days; enable first from Theme Customizer -> Post Settings -> Use 7 days post sorting)' => 'popular7' , 'Featured' => 'featured', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts'),
                    "heading" => __("Sort order:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "autors_id",
                    "type" => "dropdown",
                    "value" => td_util::create_array_authors(),
                    "heading" => "Autors Filter:",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Header color", TD_THEME_NAME),
                    "param_name" => "header_color",
                    "value" => '', //Default Red color
                    "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Header text color", TD_THEME_NAME),
                    "param_name" => "header_text_color",
                    "value" => '', //Default Red color
                    "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
                ),
                array(
                    "param_name" => "custom_title",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "custom_url",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom url for this block (when the module title is clicked):", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "title_style",
                    "type" => "dropdown",
                    "value" => array('- default style -' => '', 'Style 1' => 'td_title_style_1'),
                    "heading" => __("Title style:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "hide_title",
                    "type" => "dropdown",
                    "value" => array('- Show title -' => '', 'Hide title' => 'hide_title'),
                    "heading" => __("Hide block title:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "show_child_cat",
                    "type" => "dropdown",
                    "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
                    "heading" => __("Show child categories menu:", TD_THEME_NAME),
                    "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "sub_cat_ajax",
                    "type" => "dropdown",
                    "value" => array('- Use ajax -' => '', 'Do not use ajax' => 'n'),
                    "heading" => __("Use ajax in child categories menu:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "ajax_pagination",
                    "type" => "dropdown",
                    "value" => array('- No pagination -' => '', 'Next Prev ajax' => 'next_prev', 'Load More button' => 'load_more', 'Infinite load' => 'infinite'),
                    "heading" => __("Pagination:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "installed_post_types",
                    "type" => "textfield",
                    "value" =>  '',//td_util::create_array_installed_post_types(),
                    "heading" => __("Post Type:", TD_THEME_NAME),
                    "description" => "Usage: post OR post,events,pages ; write 1 or more post types delimited by comas",
                    "holder" => "div",
                    "class" => ""
                )
            )
        );
    }

}



td_global_blocks::add_instance('Block 5', new td_block_5());




?>