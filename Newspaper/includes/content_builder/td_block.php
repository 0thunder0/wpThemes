<?php
class td_block {
    var $block_id; // the block type
    var $block_uid; // the block unique id, it changes on every render


    /**
     * Used by blocks that don't need auto generated titles. If default is empty and no title is set it will remove the title from the block
     */
    function get_block_title_raw($atts, $default_title = '', $default_url = '') {
        extract(shortcode_atts(
            array(
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => '',
                'header_text_color' => '',
                'title_style' => ''
            ),$atts));


        if (empty($custom_title) and empty($default_title)) {
            //no title selected, and no default title - do nothing
            return;
        }



        //custom colors
            $td_header_color_css = '';
            $td_header_line_color_css = '';
            $td_header_text_color_css_class = '';


            if (!empty($header_text_color) and $header_text_color != '#') {
                $td_header_text_color_css_class = '; color:' . $header_text_color . ' !important';
            }

            if (!empty($header_color) and $header_color != '#') { //# is a fix for farbtastic
                $td_header_color_css = 'background-color:' . $header_color . '';
                $td_header_line_color_css = 'style="border-bottom: 2px solid ' . $header_color . '" ';
            }

            //append to the color_css the text color
            if (!empty($td_header_text_color_css_class)) {
                $td_header_color_css .= $td_header_text_color_css_class;
            }

            //wrap the header css
            if (!empty($td_header_color_css)) {
                $td_header_color_css = 'style="' . $td_header_color_css . '" ';
            }
        //end custom colors

        //print_r($td_header_text_color_css_class);

        $buffy = '';

        $title = $default_title;
        $url = $default_url;

        if ($hide_title != 'hide_title') {
            // read the custom url and title from the shortcode
            if (!empty($custom_title)) {
                $title = $custom_title;
            }

            if (!empty($custom_url)) {
                $url = $custom_url;
            }

            $css_buffer = '';
            if (!empty($title_style)) {
                $css_buffer = ' ' . $title_style;
            }

            $buffy .= '<h4 ' . $td_header_line_color_css . 'class="block-title' . $css_buffer . '">';
                if (!empty($url)) {
                    $buffy .= '<a ' . $td_header_color_css . 'href="' . $url . '">' . $title . '</a>';
                } else {
                    $buffy .= '<span ' . $td_header_color_css . '>' . $title . '</span>';
                }
            $buffy .= '</h4>';

        }

        return $buffy;
    }


    /**
     * Used by blocks that need auto generated titles
     * @param $atts
     * @param $td_data_source
     * @return string
     */
    function get_block_title($atts, $td_data_source) {
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
                'header_color' => '',
                'header_text_color' => '',
                'title_style' => ''
            ),$atts));


        //custom colors
            $td_header_color_css = '';
            $td_header_line_color_css = '';
            $td_header_text_color_css_class = '';


            if (!empty($header_text_color) and $header_text_color != '#') {
                $td_header_text_color_css_class = '; color:' . $header_text_color . ' !important';
            }

            if (!empty($header_color) and $header_color != '#') { //# is a fix for farbtastic
                $td_header_color_css = 'background-color:' . $header_color . '';
                $td_header_line_color_css = 'style="border-bottom: 2px solid ' . $header_color . '" ';
            }

            //append to the color_css the text color
            if (!empty($td_header_text_color_css_class)) {
                $td_header_color_css .= $td_header_text_color_css_class;
            }

            //wrap the header css
            if (!empty($td_header_color_css)) {
                $td_header_color_css = 'style="' . $td_header_color_css . '" ';
            }
        //end custom colors



        $buffy = '';

        //check to see if we show subcats
        //@todo the check is not like the one from get_block_sub_cats
        $css_buffer = '';
        if (!empty($show_child_cat) and !empty($category_id)) {
            $css_buffer = ' block-title-subcats';
        }

        if (!empty($title_style)) {
            $css_buffer .= ' ' . $title_style;
        }

        //show the block title
        if ($hide_title != 'hide_title') {
            $buffy .= '<h4 ' . $td_header_line_color_css . 'class="block-title' . $css_buffer . '">';
            if (empty($custom_title)) {
                //@todo remove empty title space
                if (empty($custom_url)) {
                    //all is autogenerated
                    $buffy .= '<a ' . $td_header_color_css . 'href="' . $td_data_source->block_link . '">' . $td_data_source->block_name . '</a>';
                } else {
                    //just custom url by user, the title is autogenerated
                    $buffy .= '<a ' . $td_header_color_css . 'href="' . $custom_url . '">' . $td_data_source->block_name . '</a>';
                }
            } else {
                if (empty($custom_url)) {
                    //url is autogenerated
                    if (empty($td_data_source->block_link)) {
                        //no url? - popular files for example dosn't have a url
                        $buffy .= '<span ' . $td_header_color_css . '>' . $custom_title . '</span>';
                    } else {
                        //url is present
                        $buffy .= '<a ' . $td_header_color_css . 'href="' . $td_data_source->block_link . '">' . $custom_title . '</a>';
                    }

                } else {
                    //url is custom + custom title
                    $buffy .= '<a ' . $td_header_color_css . 'href="' . $custom_url . '">' . $custom_title . '</a>';
                }
            }
            $buffy .= '</h4>';
        }

        return $buffy;
    }


    function get_block_sub_cats($atts) {
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
                'sub_cat_ajax' => '' //empty we use ajax
            ),$atts));

        $td_block_layout = new td_block_layout();
        //$td_column_number = $td_block_layout->get_column_number(); // get the column width of the block

        $buffy = '';

        if (!empty($show_child_cat) and !empty($category_id)) {
            $td_subcategories = get_categories(array('child_of' => $category_id));
            if (!empty($td_subcategories)) {
                if ($show_child_cat != 'all') {
                    $td_subcategories = array_slice($td_subcategories, 0, $show_child_cat);
                }

                $buffy .= '<ul class="block-child-cats">';
                if (empty($sub_cat_ajax)) {
                    $buffy .= '<li><a class="cur-sub-cat ajax-sub-cat sub-cat-' . $this->block_uid . '" id="sub-cat-'
                        . $this->block_uid . '-' . $category_id . '" data-cat_id="' . $category_id . '"
                        data-td_block_id="' . $this->block_uid . '" href="' . get_category_link($category_id) . '">' . __td('All') . '</a></li>';
                }
                foreach ($td_subcategories as $td_category) {
                    if (empty($sub_cat_ajax)) {
                        $buffy .= '<li><a class="ajax-sub-cat sub-cat-' . $this->block_uid . '" id="sub-cat-' . $this->block_uid . '-' . $td_category->cat_ID . '" data-cat_id="' . $td_category->cat_ID . '" data-td_block_id="' . $this->block_uid . '" href="' . get_category_link($td_category->cat_ID) . '">' . $td_category->name . '</a></li>';
                    } else {
                        $buffy .= '<li><a href="' . get_category_link($td_category->cat_ID) . '">' . $td_category->name . '</a></li>';
                    }

                }


                $buffy .= '</ul>';
            }
        }

        return $buffy;
    }


    function get_block_js ($atts, &$td_query) {
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
                'sub_cat_ajax' => '',
                'ajax_pagination' => ''
            ),$atts));


        if (!empty($atts['custom_title'])) {
            $atts['custom_title'] = htmlspecialchars($atts['custom_title'], ENT_QUOTES );
        }

        if (!empty($atts['custom_url'])) {
            $atts['custom_url'] = htmlspecialchars($atts['custom_url'], ENT_QUOTES );
        }

        $td_block_layout = new td_block_layout();
        $td_column_number = $td_block_layout->get_column_number(); // get the column width of the block
        $block_item = 'block_' . $this->block_uid;

        $buffy = '';

        $buffy .= '<script>';
        $buffy .= 'var ' . $block_item . ' = new td_block();' . "\n";
        $buffy .= $block_item . '.id = "' . $this->block_uid . '";' . "\n";
        $buffy .= $block_item . ".atts = '" . json_encode($atts) . "';" . "\n";
        $buffy .= $block_item . '.td_cur_cat = "' . $category_id . '";' . "\n";
        $buffy .= $block_item . '.td_column_number = "' . $td_column_number . '";' . "\n";

        $buffy .= $block_item . '.block_type = "' . $this->block_id . '";' . "\n";

        //wordpress wp query parms
        $buffy .= $block_item . '.post_count = "' . $td_query->post_count . '";' . "\n";
        $buffy .= $block_item . '.found_posts = "' . $td_query->found_posts . '";' . "\n";
        $buffy .= $block_item . '.max_num_pages = "' . $td_query->max_num_pages . '";' . "\n";
        $buffy .= 'td_blocks.push(' . $block_item . ');' . "\n";
        $buffy .= '</script>';

        return $buffy;
    }




    function get_block_pagination($atts, $td_unique_id = '') {
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
                'sub_cat_ajax' => '',
                'ajax_pagination' => ''
            ),$atts));

        $buffy = '';

        switch ($ajax_pagination) {
            case 'next_prev':
                if ($hide_title != 'hide_title') {
                    $buffy .= '<div class="td-next-prev-wrap">';
                        $buffy .= '<a href="#" class="td_ajax-prev-page ajax-page-disabled" id="prev-page-' . $this->block_uid . '" data-td_block_id="' . $this->block_uid . '"></a>';
                        $buffy .= '<a href="#"  class="td-ajax-next-page" id="next-page-' . $this->block_uid . '" data-td_block_id="' . $this->block_uid . '"></a>';
                    $buffy .= '</div>';
                }
                break;
            case 'load_more':
                $buffy .= '<div class="td-load-more-wrap">';
                    $buffy .= '<a href="#" class="td_ajax_load_more" id="next-page-' . $this->block_uid . '" data-td_block_id="' . $this->block_uid . '">' . __td('Load more') . '</a>';
                    $buffy .= '<div class="td-load-more-img-wrap">';
                        $buffy .= '<div class="td-load-more-img"></div>';
                    $buffy .= '</div>';
                $buffy .= '</div>';
                break;
            case 'infinite':

                    $buffy .= '<div class="td_ajax_infinite" id="next-page-' . $this->block_uid . '" data-td_block_id="' . $this->block_uid . '">';
                        $buffy .= ' ';
                    $buffy .= '</div>';
                break;
        }

        return $buffy;
    }




}


?>