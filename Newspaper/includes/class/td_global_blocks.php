<?php

class td_global_blocks {
    private static $global_instances = array();

    static function add_instance($block_name, $block_instance) {
        self::$global_instances[$block_instance->block_id] = array (
            'id' => $block_instance->block_id,
            'name' => $block_name,
            'instance' => $block_instance
        );
    }

    static function get_instance($block_id) {
        return self::$global_instances[$block_id]['instance'];
    }


    /**
     * map all the blocks in the pagebuilder
     */
    static function wpb_map_all() {
        foreach (self::$global_instances as $block_array) {
            wpb_map($block_array['instance']->get_map());
        }
    }


    static function debug_get_all_instances() {
        return self::$global_instances;
    }
}

?>