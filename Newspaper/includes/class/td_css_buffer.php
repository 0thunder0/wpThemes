<?php

class td_css_buffer {
    static $css_buffer = '';

    static function add($css) {
        self::$css_buffer .= "\n" . $css;
    }

    static function render() {
        if (trim(self::$css_buffer) != '') {
            self::$css_buffer = "\n<!-- Style compiled by theme -->" . "\n\n<style>\n    " . apply_filters("td_css_buffer_render", self::$css_buffer) . "\n</style>\n\n";
            return self::$css_buffer;
        } else {
            return;
        }
    }
}


function td_css_buffer_render() {
    echo td_css_buffer::render();
}


add_action('wp_head', 'td_css_buffer_render', 15); //priority 10 is used by the css compiler