<div class="my_meta_control td-page-module-loop-wrap">
    <p class="td_help_section ">
        <span class="td_custom_label">Sidebar position:</span>
        <?php $mb->the_field('td_sidebar_position'); ?>
        <select name="<?php $mb->the_name(); ?>">
            <option value="">Sidebar right</option>
            <option value="sidebar_left"<?php $mb->the_select_state('sidebar_left'); ?>>Sidebar left</option>
            <option value="no_sidebar"<?php $mb->the_select_state('no_sidebar'); ?>>No sidebar</option>
        </select>
    </p>


    <p class="td_help_section ">
        <span class="td_custom_label">Sidebar:</span>
        <?php $mb->the_field('td_sidebar'); ?>
        <select name="<?php $mb->the_name(); ?>">
            <option value="">Default sidebar</option>
            <?php
            $currentSidebars = td_util::get_option('sidebars'); //read the sidebars
            foreach ($currentSidebars as $sidebar) {
                ?>
                <option value="<?php echo $sidebar?>"<?php $mb->the_select_state($sidebar); ?>><?php echo $sidebar?></option>
            <?php
            }
            ?>
        </select>
        - <a href="themes.php?page=td_controller.php&td_page=sidebars">manage sidebars</a>
    </p>



    <p class="td_help_section ">
        <span class="td_custom_label">Layout:</span>
        <?php $mb->the_field('td_layout'); ?>
        <select name="<?php $mb->the_name(); ?>">

            <?php
            $td_module_list = array(
                '' => 'please select a module',
                '1' => 'module 1',
                '2' => 'module 2',
                '3' => 'module 3',
                '4' => 'module 4',
                '5' => 'module 5',
                '6' => 'module 6',
                '7' => 'module 7',
                '8' => 'module 8',
                '9' => 'module 9',
                'search' => 'module search'
            );
            foreach ($td_module_list as $td_module_id => $td_module_name) {
                ?>
                <option value="<?php echo $td_module_id?>"<?php $mb->the_select_state($td_module_id); ?>><?php echo $td_module_name?></option>
            <?php
            }
            ?>
        </select>
    </p>



    <p class="td_help_section ">
        <span class="td_custom_label">Show list title:</span>
        <?php $mb->the_field('list_custom_title_show'); ?>
        <select name="<?php $mb->the_name(); ?>">
            <option value="">Show title</option>
            <option value="hide_title"<?php $mb->the_select_state('hide_title'); ?>>Hide title</option>
        </select>
    </p>


    <p class="td_help_section">
        <?php $mb->the_field('list_custom_title'); ?>
        <span class="td_custom_label">Article list title: </span><input style="width: 200px;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
        <span class="td_info_inline"> - Custom title for the article list section</span>
    </p>

    <p class="td_help_section ">
        <span class="td_custom_label">Featured posts:</span>
        <?php $mb->the_field('featured_posts'); ?>
        <select name="<?php $mb->the_name(); ?>">
            <option value="">Hide featured posts</option>
            <option value="show_featured_posts"<?php $mb->the_select_state('show_featured_posts'); ?>>Show featured posts</option>
        </select>
    </p>

    <div>
        <p><strong>Template structure:</strong></p>
        <img class="td-doc-image-wp td-doc-image-homepage-loop" style="max-width: 100%" src="<?php echo get_template_directory_uri() ?>/wp-admin/images/info-homepage-loop.jpg" />


    </div>
</div>