<?php

function td_js_buffer_render_filter($js) {
    return $js . "\n" . "

//themeforest iframe removal code - used only on demo
var td_is_safari = false;
var td_is_ios = false;
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf('safari')!=-1){
    if(ua.indexOf('chrome')  > -1){

    }else{
        td_is_safari = true;
    }
}
if(navigator.userAgent.match(/(iPhone|iPod|iPad)/i)) {
    td_is_ios = true;
}
if(td_is_ios || td_is_safari) {
    if (top.location != location) {
        top.location.replace('" . TD_THEME_DEMO_URL . "/');
    }
}
    ";
}
add_filter( 'td_js_buffer_render', 'td_js_buffer_render_filter');

