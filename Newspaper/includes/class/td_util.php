<?php
class td_util {
    static $td_customizer_settings; //we keep a instance of td_customizer_settings here


    //returns the $class if the variable is not empty or false
    static function if_show($variable, $class) {
        if ($variable !== false and !empty($variable)) {
            return ' ' . $class;
        } else {
            return '';
        }
    }

    //returns the class if the variable is empty or false
    static function if_not_show($variable, $class){
        if ($variable === false or empty($variable)) {
            return ' ' . $class;
        } else {
            return '';
        }
    }







    //reads a theme option from wp
    static function get_option($optionName) {
        $theme_options = get_option(TD_THEME_OPTIONS_NAME);
        if (!empty($theme_options[$optionName])) {
            return $theme_options[$optionName];
        } else {
            return;
        }
    }

    //updates a theme option
    static function update_option($optionName, $newValue) {
        $theme_options = get_option(TD_THEME_OPTIONS_NAME);
        //print_r($optionName);
        $theme_options[$optionName] = $newValue;
        update_option(TD_THEME_OPTIONS_NAME, $theme_options);
    }


    static function get_customizer_option($optionName, $default_value = '') {
        //returns empty when the default customizer setting is used
        //it doesn't requiers the tds_ prefix
        return self::$td_customizer_settings->get_setting($optionName, $default_value);
    }


    /**
     * Used only on slide big to cut the title to make it wrap
     *
     * @param $cut_parms
     * @param $title
     * @return string
     */
    static function cut_title($cut_parms, $title) {
        //trim and get the excerpt
        $title = trim($title);
        $title = td_excerpt($title,$cut_parms['excerpt']);

        //get an array of chars
        $title_chars = str_split($title);
        //$title_chars = preg_split('/(?=(.{16})*$)/u', $title);

        $buffy = '';
        $current_char_on_line = 0;
        $has_to_cut = false; //when true, the string will be cut

        foreach ($title_chars as $title_char) {
            //check if we reached the limit
            if ($cut_parms['char_per_line'] == $current_char_on_line) {
                $has_to_cut = true;
                $current_char_on_line = 0;
            } else {
                $current_char_on_line++;
            }

            if ($title_char == ' ' and $has_to_cut === true) {
                //we have to cut, it's a white space so we ignore it (not added to buffy)
                $buffy .= $cut_parms['line_wrap_end'] . $cut_parms['line_wrap_start'];
                $has_to_cut = false;
            } else {
                //normal loop
                $buffy .= $title_char;
            }

        }

        //wrap the string
        return $cut_parms['line_wrap_start'] . $buffy . $cut_parms['line_wrap_end'];
    }


    /*
     * gets the blog page url (only if the blog page is configured in theme customizer)
     */
    static function get_home_url() {
        if( get_option('show_on_front') == 'page') {
            $posts_page_id = get_option( 'page_for_posts');
            return get_permalink($posts_page_id);
        } else {
            return false;
        }
    }


    //gets the sidebar setting or default if no sidebar is selected for a specific setting id
    static function show_sidebar($template_id) {
        $tds_cur_sidebar = td_util::get_option('tds_' . $template_id . '_sidebar');
        if (!empty($tds_cur_sidebar)) {
            dynamic_sidebar($tds_cur_sidebar);
        } else {
            //show default
            if (!dynamic_sidebar(TD_THEME_NAME . ' default')) {
                ?>
                <!-- .no sidebar -->
            <?php
            }
        }
    }


    static function get_image_attachment_data($post_id, $size = 'thumbnail', $count = 1 ) {
        $objMeta = array();
        $meta = '';// (stdClass)
        $args = array(
            'numberposts' => $count,
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'nopaging' => false,
            'post_mime_type' => 'image',
            'order' => 'ASC', // change this to reverse the order
            'orderby' => 'menu_order ID', // select which type of sorting
            'post_status' => 'any'
        );

        $attachments = get_children($args);

        if ($attachments) {
            foreach ($attachments as $attachment) {
                $meta = new stdClass();
                $meta->ID = $attachment->ID;
                $meta->title = $attachment->post_title;
                $meta->caption = $attachment->post_excerpt;
                $meta->description = $attachment->post_content;
                $meta->alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

                // Image properties
                $props = wp_get_attachment_image_src( $attachment->ID, $size, false );

                $meta->properties['url'] = $props[0];
                $meta->properties['width'] = $props[1];
                $meta->properties['height'] = $props[2];

                $objMeta[] = $meta;
            }

            return ( count( $attachments ) == 1 ) ? $meta : $objMeta;
        }
    }


    //converts a sidebar name to an id that can be used by word press
    static function sidebar_name_to_id($sidebar_name) {
        $clean_name = str_replace(array(' '), '-', trim($sidebar_name));
        $clean_name = str_replace(array("'", '"'), '', trim($clean_name));
        return strtolower($clean_name);
    }



    /*  ----------------------------------------------------------------------------
        used by the css compiler in /includes/app/td_css_generator.php
     */
    static function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Format the hex color string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Get decimal values
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));

        // Adjust number of steps and keep it inside 0 to 255
        $r = max(0,min(255,$r + $steps));
        $g = max(0,min(255,$g + $steps));
        $b = max(0,min(255,$b + $steps));

        $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
        $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
        $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

        return '#'.$r_hex.$g_hex.$b_hex;
    }


    //converts a hex to rgba
    static function hex2rgba($hex, $opacity) {
        if ( $hex[0] == '#' ) {
            $hex = substr( $hex, 1 );
        }
        if ( strlen( $hex ) == 6 ) {
            list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[2] . $hex[3], $hex[4] . $hex[5] );
        } elseif ( strlen( $hex ) == 3 ) {
            list( $r, $g, $b ) = array( $hex[0] . $hex[0], $hex[1] . $hex[1], $hex[2] . $hex[2] );
        } else {
            return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return "rgba($r, $g, $b, $opacity)";
    }


    static function author_meta() {
        if (is_single()) {
            global $post;
            $td_post_author = get_the_author_meta('display_name', $post->post_author);
            if ($td_post_author) {
                echo '<meta name="author" content="'.$td_post_author.'">'."\n";
            }
        }
    }


    /**
     * create $td_authors array in format id_author => display_name_author
     * @return array id_author => display_name_author
     */
    static function create_array_authors() {
        $td_authors = array();
        $td_return_obj_authors = get_users();

        $td_authors[' - No author filter - '] = '';
        foreach($td_return_obj_authors as $obj_autor){
            $auth_id = $obj_autor->ID;
            $auth_name = $obj_autor->display_name;

            $td_authors[$auth_name] = $auth_id;
        }
        //print_r($td_authors);
        return $td_authors;
    }


}


/**
 * returns a string containing the numbers of words or chars for the content
 *
 * @param $post_content - the content thats need to be cut
 * @param $limit        - limit to cut
 * @param string $show_shortcodes - if shortcodes
 * @return string
 */
function td_excerpt($post_content, $limit, $show_shortcodes = '') {
    //REMOVE shortscodes and tags
    if ($show_shortcodes == '') {
        $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
    }

    $post_content = stripslashes(wp_filter_nohtml_kses($post_content));

    //excerpt for letters
    if (td_util::get_customizer_option('excerpts_type') == 'letters') {

        $ret_excerpt = mb_substr($post_content, 0, $limit);
        if (mb_strlen($post_content)>=$limit) {
            $ret_excerpt = $ret_excerpt.'...';
        }

    //excerpt for words
    } else {
        /*removed and moved to check this first thing when reaches thsi function
         * if ($show_shortcodes == '') {
            $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
        }

        $post_content = stripslashes(wp_filter_nohtml_kses($post_content));*/

        $excerpt = explode(' ', $post_content, $limit);




        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }


        $excerpt = esc_attr(strip_tags($excerpt));



        if (trim($excerpt) == '...') {
            return '';
        }

        $ret_excerpt = $excerpt;
    }
    return $ret_excerpt;
}




//used by page builder
function td_get_category2id_array($add_all_category = true) {


    $categories = get_categories(array(
        'hide_empty' => 0
    ));
    $categories_parents = array();
    $categories_childs = array();

    if ($add_all_category) { //add all categories if necessary
        $categories_buffer['- All categories -'] = '';
    }


    foreach ($categories as $category) {
        if ($category->category_parent == 0) {
            $categories_parents[$category->name] =  $category->term_id;
        } else {
            $categories_childs[$category->category_parent][$category->name] = $category->term_id;
        }
    }
    ksort ($categories_parents);
    foreach ($categories_parents as $category_name => $category_id) {
        $categories_buffer[$category_name] = $category_id;
        if (!empty($categories_childs[$category_id])) {
            ksort ($categories_childs[$category_id]);
            foreach ($categories_childs[$category_id] as $child_name => $child_id) {
                $categories_buffer[' - ' . $child_name] = $child_id;
            }
        }
    }

    $td_category_structure_buffer = $categories_buffer;


    return $categories_buffer;
}


function td_parse_class_name($name) {
    return str_replace(' ', '_', $name);
}




/*  ----------------------------------------------------------------------------
    mbstring support
 */

if (!function_exists('mb_strlen')) {
    function mb_strlen ($string) {
        return strlen($string);
    }
}

if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack,$needle,$offset=0) {
        return strpos($haystack,$needle,$offset);
    }
}
if (!function_exists('mb_strrpos')) {
    function mb_strrpos ($haystack,$needle,$offset=0) {
        return strrpos($haystack,$needle,$offset);
    }
}
if (!function_exists('mb_strtolower')) {
    function mb_strtolower($string) {
        return strtolower($string);
    }
}
if (!function_exists('mb_strtoupper')) {
    function mb_strtoupper($string){
        return strtoupper($string);
    }
}
if (!function_exists('mb_substr')) {
    function mb_substr($string,$start,$length) {
        return substr($string,$start,$length);
    }
}





