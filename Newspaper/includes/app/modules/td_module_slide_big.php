<?php

class td_module_slide_big extends td_module {

    var $post_1;
    var $post_2;
    var $post_3;
    var $post_4;
    var $post_mobile; //for mobile phones we render another post


    function __construct($post_1, $post_2, $post_3, $post_4, $post_mobile) {
        //load the posts, but do not run the parent constructor
        $this->post_1 = $post_1;
        $this->post_2 = $post_2;
        $this->post_3 = $post_3;
        $this->post_4 = $post_4;
        $this->post_mobile = $post_mobile;
        //run the parrent constructor
        //parent::__construct($post);
    }


    function get_title_main() {
        $cut_parms = array(
            'char_per_line' => 26,
            'excerpt' => 13, //words
            'line_wrap_start' => '<span class="td-sbig-title">',
            'line_wrap_end' => '</span><span class="td-sbig-sep"></span>'
        );

        $buffy = '';

        $buffy .= '<div class="td-sbig-title-wrap">';
            $buffy .='<a class="noSwipe" itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
                $buffy .= td_util::cut_title($cut_parms, $this->title);
            $buffy .='</a>';
        $buffy .= '</div>';

        return $buffy;

    }


    function get_title_sec_item() {
        $buffy = '';
        $buffy .= '<div class="td-sbig-title-wrap">';
            $buffy .='<a class="noSwipe" itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
            $buffy .= td_excerpt($this->title, 7, 'show_shortcodes');
            $buffy .='</a>';
        $buffy .= '</div>';

        return $buffy;
    }

    function render($td_column_number, $td_post_count) {
        $buffy = '';

        $buffy .= '<div class="item">';

            //mobile slides :)
            if (!empty($this->post_mobile)) {
                parent::__construct($this->post_mobile);
            }
            $buffy .= '<div class="td-mobile-post" ' . $this->get_item_scope() . '>';
                if (!empty($this->post_mobile)) {
                    $buffy .= $this->get_image('art-slidebig-main');
                    $buffy .= $this->get_title_sec_item();
                }
            $buffy .= '</div>';


            //small slides begin here
            $buffy .= '<div class="td-desktop-post">';
                $buffy .= '<div class="td-slide-sec-items-wrap">';

                    //slide small 1
                    if (!empty($this->post_2)) {
                        parent::__construct($this->post_2);
                    }
                    $buffy .= '<div class="td-slide-item-sec td-slide-item-sec-1" ' . $this->get_item_scope() . '>';
                        if (!empty($this->post_2)) {
                            $buffy .= $this->get_image('art-wide');
                            $buffy .= $this->get_title_sec_item();
                        }
                    $buffy .= '</div>';


                    //slide small 2
                    if (!empty($this->post_3)) {
                        parent::__construct($this->post_3);
                    }
                    $buffy .= '<div class="td-slide-item-sec td-slide-item-sec-2" ' . $this->get_item_scope() . '>';
                        if (!empty($this->post_3)) {
                            $buffy .= $this->get_image('art-wide');
                            $buffy .= $this->get_title_sec_item();
                        }
                    $buffy .= '</div>';


                    //slide small 3
                    if (!empty($this->post_4)) {
                        parent::__construct($this->post_4);
                    }
                    $buffy .= '<div class="td-slide-item-sec td-slide-item-sec-3" ' . $this->get_item_scope() . '>';
                        if (!empty($this->post_4)) {
                            $buffy .= $this->get_image('art-wide');
                            $buffy .= $this->get_title_sec_item();
                        }
                    $buffy .= '</div>';
                $buffy .= '</div>'; //end td-slide-sec-items-wrap
                //end small slides

                //slide big main item
                if (!empty($this->post_1)) {
                    parent::__construct($this->post_1);
                }
                $buffy .= '<div class="td-slide-item-main" ' . $this->get_item_scope() . '>';
                    if (!empty($this->post_1)) {
                        $buffy .= $this->get_image('art-slidebig-main');
                        $buffy .= $this->get_title_main();
                    }
                $buffy .= '</div>'; //end main item pic
            $buffy .= '</div>'; //end td-desktop-post


        $buffy .= '</div>'; //end item

        return $buffy;
    }
}

?>