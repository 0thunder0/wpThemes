<?php


class td_module_8 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        $buffy = '';
        $buffy .= '<div class="td_mod_wrap td_mod8 ' . $this->get_no_thumb_class() . '" ' . $this->get_item_scope() . '>';
        $buffy .= $this->get_image('art-big-1col');

        $buffy .= '<div class="item-details">';
        $buffy .= $this->get_title(td_util::get_option('tds_mod8_title_excerpt'));
        $buffy .= '<div class="meta-info">';
        //$buffy .= $this->get_author();
        $buffy .= $this->get_date();
        $buffy .= $this->get_commentsAndViews();
        $buffy .= '</div>';


        $buffy .= '<p>' .$this->get_excerpt(td_util::get_option('tds_mod8_content_excerpt')) . '</p>';
        $buffy .= '<div class="more-link-wrap wpb_button td_read_more clearfix">';
        $buffy .= '<a href="' . $this->href . '">' . __td('Continue', TD_THEME_NAME) . '</a>';
        $buffy .= '</div>';


        $buffy .= '</div>';

        $buffy .= $this->get_item_scope_meta();
        $buffy .= '</div>';

        return $buffy;
    }
}



?>