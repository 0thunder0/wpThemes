<?php

class td_module_4 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {

        $buffy = '';
        $buffy .= '<div class="td_mod4 td_mod_wrap' . $this->get_no_thumb_class() . '" ' . $this->get_item_scope() . '>';
        $buffy .= $this->get_image('art-thumb');

        $buffy .= '<div class="item-details">';
            $buffy .= $this->get_title(td_util::get_option('tds_mod4_title_excerpt'));

            $buffy .= '<div class="meta-info">';
                //$buffy .= $this->get_author();
                $buffy .= $this->get_date();
                //$buffy .= $this->get_commentsAndViews();
            $buffy .= '</div>';

        $buffy .= '</div>';

        $buffy .= $this->get_item_scope_meta();
        $buffy .= '</div>';
        return $buffy;
    }
}
?>