<?php

/**
 * internal use only! - this module is used for the full width single page. It basically outputs the post without the title + feature image etc.
 */

class td_module_full_w_content extends td_module_blog {
    var $show_excerpt = false; //this is changed by module 7 (module 7 inherits this module)


    function __construct($post) {
        //run the parent constructor
        parent::__construct($post);
    }

    function render() {
        $buffy = '';

        $buffy .= '<article id="post-' . $this->post->ID . '" class="' . join(' ', get_post_class()) . '" ' . $this->get_item_scope() . '>';

        $buffy .= '<header>';
        $buffy .= $this->get_bread_crumbs();

        $buffy .= $this->get_title();
        $buffy .= '<div class="meta-info">';
        $buffy .= $this->get_category();
        //$buffy .= $this->get_author();
        $buffy .= $this->get_date();
        $buffy .= $this->get_commentsAndViews();
        $buffy .= '</div>';
        $buffy .= '</header>';

        $buffy .= $this->get_image('featured-image');

        if ($this->show_excerpt === true) { //module 7 uses this
            $buffy .= '<p>' . $this->get_excerpt(td_util::get_customizer_option('mod7_content_excerpt')) . '</p>';
            $buffy .= '<div class="more-link-wrap wpb_button wpb_btn-danger clearfix">';
            $buffy .= '<a href="' . $this->href . '">' . __td('Continue', TD_THEME_NAME) . '</a>';
            $buffy .= '</div>';
        } else {
            $buffy .= $this->get_content();
        }


        $buffy .= '<footer class="clearfix">';
        $buffy .= $this->get_review();
        $buffy .= $this->get_the_tags();
		$buffy .= $this->get_source_and_via();
        $buffy .= $this->get_next_prev_posts();
        $buffy .= $this->get_author_box();
        $buffy .= '</footer>';

        $buffy .= '</article> <!-- /.post -->';

        $buffy .= $this->related_posts();

        return $buffy;
    }
}



?>