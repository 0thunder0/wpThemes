<div class="my_meta_control">


    <p class="td_help_section ">
        <span class="td_custom_label">Sidebar position:</span>
        <?php $mb->the_field('td_sidebar_position'); ?>
        <select name="<?php $mb->the_name(); ?>">
            <option value="">Default position</option>
            <option value="sidebar_right">Sidebar right</option>
            <option value="sidebar_left"<?php $mb->the_select_state('sidebar_left'); ?>>Sidebar left</option>
            <option value="no_sidebar"<?php $mb->the_select_state('no_sidebar'); ?>>Full width</option>
        </select>
        <span class="td_info_inline"> - Default = get the position from the theme customizer setting</span>
    </p>



    <p class="td_help_section ">
        <span class="td_custom_label">Custom sidebar:</span>
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
</div>


