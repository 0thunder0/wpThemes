<?php


class td_sample extends td_block {


    function __construct() {
        $this->block_id = 'td_slide';
        add_shortcode('td_slide', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = uniqid(); //update unique id on each render

    }

    function inner($posts, $td_column_number = '', $autoplay = '') {
    }


    function get_map () {

    }

}



td_global_blocks::add_instance('Slide', new td_slide());




?>