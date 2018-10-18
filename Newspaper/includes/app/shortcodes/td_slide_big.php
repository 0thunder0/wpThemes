<?php


class td_slide_big extends td_block {


    function __construct() {
        $this->block_id = 'td_slide_big';
        add_shortcode('td_slide_big', array($this, 'render'));
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
                'force_columns' => '', //used on categories
                'autoplay' => ''
            ),$atts));

        $buffy = ''; //output buffer
        $td_unique_id = uniqid();


        //go only on one category that was selected from drop down
        if (!empty($category_id) and empty($category_ids)) {
            $atts['category_ids'] = $category_id;
        }

        $td_data_source = new td_data_source(); //new data source
        $td_query = &$td_data_source->get_wp_query($atts); //by ref  do the query


        if ($td_query->have_posts() and $td_query->found_posts > 1 ) {
            //get the js for this block
            $buffy .= $this->get_block_js($atts, $td_query);


                $buffy .= '<div class="td_block_wrap td_block_slide td_block_slide_big">';

                    //get the block title
                    $buffy .= $this->get_block_title($atts, $td_data_source);

                    //get the sub category filter for this block
                    $buffy .= $this->get_block_sub_cats($atts, $td_unique_id);

                    $buffy .= '<div id=' . $td_unique_id . ' class="td_block_inner">';
                    //inner content of the block

                        $buffy .= $this->inner($td_query->posts, $force_columns, $autoplay);

                    $buffy .= '</div>';

                $buffy .= '</div> <!-- ./block1 -->';
        }



        /*
        $atts['limit'] = round($atts['limit'] / 2,0);
        $atts['force_columns'] = 2;
        $atts['class'] = 'td-big-slide-mobile';
        $buffy .= td_global_blocks::get_instance('td_slide')->render($atts);
        */

        return $buffy;
    }

    function inner($posts, $td_column_number = '', $autoplay = '') {
        global $post;

        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = $td_block_layout->get_column_number(); // get the column width of the block
        }

        $td_post_count = 0; // the number of posts rendered


        $td_unique_id_slide = uniqid();

        $buffy .= '<div id="' . $td_unique_id_slide . '" class="iosSlider iosSlider-col-' . $td_column_number . ' td_mod_wrap">';
        $buffy .= '<div class="slider ">';

        $mobile_post_count = 0;

        if (!empty($posts)) {
            for ($i = 0; $i <= count($posts) - 1; $i = $i + 4) {
                $post_1 = '';
                $post_2 = '';
                $post_3 = '';
                $post_4 = '';
                $post_mobile = '';


                if (!empty($posts[$mobile_post_count])) {
                    $post_mobile = $posts[$mobile_post_count];
                    $mobile_post_count++;
                }

                if (!empty($posts[$i])) {
                    $post_1 = $posts[$i];
                }

                if (!empty($posts[$i + 1])) {
                    $post_2 = $posts[$i + 1];
                }

                if (!empty($posts[$i + 2])) {
                    $post_3 = $posts[$i + 2];
                }

                if (!empty($posts[$i + 3])) {
                    $post_4 = $posts[$i + 3];
                }
                $td_module_slide_big = new td_module_slide_big($post_1, $post_2, $post_3, $post_4, $post_mobile);
                $buffy .= $td_module_slide_big->render($td_column_number, $td_post_count);
            }


        }



        $buffy .= $td_block_layout->close_all_tags();





        $buffy .= '</div>'; //close slider


        $buffy .= '<div class = "prevButton"></div>';
        $buffy .= '<div class = "nextButton"></div>';

        $buffy .= '</div>'; //clos ios

        if (!empty($autoplay)) {
            $autoplay_string =  '
            autoSlide: true,
            autoSlideTimer: ' . $autoplay * 1000 . ',
            ';
        } else {
            $autoplay_string = '';
        }

        td_js_buffer::add_to_footer('
jQuery(document).ready(function() {
    jQuery("#' . $td_unique_id_slide . '").iosSlider({
        snapToChildren: true,
        desktopClickDrag: true,
        keyboardControls: false,
        ' . $autoplay_string. '

        infiniteSlider: true,
        navPrevSelector: jQuery("#' . $td_unique_id_slide . ' .prevButton"),
        navNextSelector: jQuery("#' . $td_unique_id_slide . ' .nextButton"),
        onSlideComplete: slideContentComplete,
        onSlideStart: slideStartedMoving
    });
});
    ');

        return $buffy;
    }


    function get_map () {
        return array(
            "name" => __("Big Slide", TD_THEME_NAME),
            "base" => "td_slide_big",
            "class" => "td_slide_big",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-slide_big',
            "params" =>
            array(
                array(
                    "param_name" => "autoplay",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => 'Autoplay slider (at x seconds)',
                    "description" => "Leave empty do disable autoplay",
                    "holder" => "div",
                    "class" => ""
                ),
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
                     "param_name" => "hide_title",
                     "type" => "dropdown",
                     "value" => array('- Show title -' => '', 'Hide title' => 'hide_title'),
                     "heading" => __("Hide block title:", TD_THEME_NAME),
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



td_global_blocks::add_instance('Slide big', new td_slide_big());




?>