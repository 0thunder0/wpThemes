<?php

//set the template id, used to get the template specific settings
$template_id = '404';

td_global::$current_template = $template_id;

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position;
$loop_sidebar_position = 'no_sidebar';
$loop_module_id = td_util::get_customizer_option($template_id . '_page_layout', 1); //module 1 is default




get_header();

echo td_page_generator::wrap_start();

?>

    <div class="span12 column_container">
        <div class="td-404-title">
            <?php _etd('404 错误 - 页面没找到'); ?>
        </div>

        <div class="td-404-sub-title">
            <?php _etd("对不起，您查找的页面不存在。"); ?>
        </div>

        <div class="td-404-sub-sub-title">
            <?php _etd('您可以返回', ''); ?>
            <a href="<?php echo get_home_url(); ?>"><?php _etd('首页', ''); ?></a>

        </div>


        <h4 class="block-title"><span><?php echo __td('最新文章')?></span></h4>


        <?php


        $args = array(
            'post_type'=> 'post',
            'showposts' => 6
        );
        query_posts($args);


        $td_loop_block_module = td_util::get_option('tds_404_page_layout');
        //$td_loop_block_module

        get_template_part('loop-simple');
        //get_template_part('category', 'slider');
	

        ?>
    </div>
<?php

echo td_page_generator::wrap_end();
get_footer();
?>