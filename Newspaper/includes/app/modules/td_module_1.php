<?php

/**
 * This is the full blog post module
 */
if (!class_exists('td_module_1', false)) {
    class td_module_1 extends td_module_blog {
        var $show_excerpt = false; //this is changed by module 7 (module 7 inherits this module)


        function __construct($post) {
            //run the parrent constructor
            parent::__construct($post);
        }

        function render() {
            $buffy = '';


            $buffy .= $this->get_bread_crumbs();
            $buffy .= '<article id="post-' . $this->post->ID . '" class="' . join(' ', get_post_class()) . '" ' . $this->get_item_scope() . '>';



                $buffy .= '<header>';
                    $buffy .= $this->get_title();
                    $buffy .= '<div class="meta-info">';
                        $buffy .= $this->get_category();
                        //$buffy .= $this->get_author();
                        $buffy .= $this->get_date(false);
                        $buffy .= $this->get_commentsAndViews();
                    $buffy .= '</div>';
                $buffy .= '</header>';


                if (!empty($this->td_post_theme_settings['td_subtitle'])) {
                    $buffy .= '<p class="td-sub-title">' . $this->td_post_theme_settings['td_subtitle'] . '</p>';
                }

                // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
                if (!empty(td_global::$load_featured_img_from_template)) {
                    $buffy .= $this->get_image(td_global::$load_featured_img_from_template);
                } else {
                    $buffy .= $this->get_image('featured-image');
                }


                if ($this->show_excerpt === true) { //module 7 uses this
                    $buffy .= '<p>' . $this->get_excerpt(td_util::get_customizer_option('mod7_content_excerpt')) . '</p>';
                    $buffy .= '<div class="more-link-wrap wpb_button td_read_more clearfix">';
                    $buffy .= '<a href="' . $this->href . '">' . __td('Continue', TD_THEME_NAME) . '</a>';
                    $buffy .= '</div>';
                } else {
                    $buffy .= $this->get_content();
                }


                $buffy .= '<footer class="clearfix">';
                    $buffy .= $this->get_post_pagination();
                    $buffy .= $this->get_review();
                    $buffy .= $this->get_the_tags();
                    $buffy .= $this->get_source_and_via();
                    $buffy .= $this->get_social_sharing();
                    $buffy .= $this->get_next_prev_posts();
                    $buffy .= $this->get_author_box();
                $buffy .= '</footer>';

            $buffy .= '</article> <!-- /.post -->';

            $buffy .= $this->related_posts();

            return $buffy;
        }
    }

} //end class exists

?>