<?php

function td_theme_style_load_js() {
    wp_enqueue_script('style-customizer', get_template_directory_uri() . '/js/style_customizer.js',array( 'jquery' ), 1, true); //load at begining
}
//add_action('init', 'td_theme_style_load_js');





//the bottom code for analitics and stuff
function td_theme_style_footer() {
    ?>

    <div id="td-theme-settings" class="td-theme-settings-small">
        <?php

        td_theme_style_add_color('#4db2ec');
        td_theme_style_add_color('#ee5656');
        td_theme_style_add_color('#333333');
        td_theme_style_add_color('#ef4423');
        td_theme_style_add_color('#0a9600');
        td_theme_style_add_color('#ff85cb');
        td_theme_style_add_color('#78c0a8');
        td_theme_style_add_color('#ffd041');
        td_theme_style_add_color('#22aacf');
        td_theme_style_add_color('#ff60bb');  //r



        td_theme_style_add_color('#92b06a');
        td_theme_style_add_color('#bccf02');
        td_theme_style_add_color('#293e6a');
        td_theme_style_add_color('#c13212');


        ?>
        <div class="clearfix"></div>
        <div class="td-customizer-change-layout td-change-to-boxed" data-cur-layout="full"><span>boxed</span></div>


        <div class="td-bg-changer" data-bg="1"><span>bg 1</span></div>
        <div class="td-bg-changer" data-bg="2"><span>bg 2</span></div>
        <div class="td-bg-changer" data-bg="0"><span>bg 3</span></div>

        <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide">HIDE</a></div>
    </div>

    <?php
}

add_action('wp_footer', 'td_theme_style_footer');




function td_theme_style_add_color($color) {
    echo '<div class="td-set-color" data-td-color="' . $color . '" style="background-color:' . $color . '"></div>';
}

?>