<?php
class td_page_views {

    static $post_view_counter_key = 'post_views_count';

    //the name of the field where 7 days counter are kept(in a serialized array) for the given post
    static $post_view_counter_7_day_array = 'post_views_count_7_day_arr';

    //the name of the field for the total of 7 days
    static $post_view_counter_7_day_total = 'post_views_count_7_day_total';

    //used only in single.php to update the views
    static function update_page_views($postID) {
        if (is_single()) {

            //used for general count
            $count = get_post_meta($postID, self::$post_view_counter_key, true);
            if ($count == ''){
                $count = 0;
                delete_post_meta($postID, self::$post_view_counter_key);
                add_post_meta($postID, self::$post_view_counter_key, '0');
            } else {
                $count++;
                update_post_meta($postID, self::$post_view_counter_key, $count);
            }

            //stop here if
            if (td_util::get_customizer_option('p_enable_7_days_count') != 'enabled') {
                return;
            }

            //used for 7 day count array
            //get the current day
            $get_current_day = date("N") - 1;
            $count_7_day_array = get_post_meta($postID, self::$post_view_counter_7_day_array, true);
            if (is_array($count_7_day_array)) {

                if (isset($count_7_day_array[$get_current_day])) {
                    $count_7_day_array[$get_current_day]++;
                    update_post_meta($postID, self::$post_view_counter_7_day_array, $count_7_day_array);
                }

            } else {
                $count_7_day_array = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0);
                $count_7_day_array[$get_current_day] = 1;
                update_post_meta($postID, self::$post_view_counter_7_day_array, $count_7_day_array);
            }

            update_post_meta($postID, self::$post_view_counter_7_day_total, array_sum($count_7_day_array));
        }
    }

    static function get_page_views($postID) {
        $count = get_post_meta($postID, self::$post_view_counter_key, true);

        if ($count == '') {
            delete_post_meta($postID, self::$post_view_counter_key);
            add_post_meta($postID, self::$post_view_counter_key, '0');
            return "0";
        }
        return $count;
    }



    static function hook_manage_posts_columns($defaults) {
        $defaults['td_post_views'] = 'Views';
        return $defaults;
    }

    static function hook_manage_posts_custom_column($column_name, $id) {
        if($column_name === 'td_post_views'){
            echo self::get_page_views(get_the_ID());
        }
    }

    static function hook_wp_admin() {
        add_filter('manage_posts_columns', array(__CLASS__, 'hook_manage_posts_columns'));
        add_action('manage_posts_custom_column', array(__CLASS__, 'hook_manage_posts_custom_column'), 5, 2);
    }
}

td_page_views::hook_wp_admin(); //do the hook shake

?>