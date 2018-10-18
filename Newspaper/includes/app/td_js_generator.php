<?php
function td_js_generator() {
    td_js_buffer::add_variable('td_ajax_url', admin_url('admin-ajax.php'));
    td_js_buffer::add_variable('td_get_template_directory_uri', get_template_directory_uri());
    td_js_buffer::add_variable('tds_snap_menu', td_util::get_option('tds_snap_menu'));
    td_js_buffer::add_variable('tds_header_style', td_util::get_option('tds_header_style'));
    td_js_buffer::add_variable('td_search_url', get_search_link());



    td_js_buffer::add("
var td_blocks = []; //here we store all the items for the current page

//td_block class - each ajax block uses a object of this class for requests
function td_block() {
    this.id = '';
    this.block_type = 1; //block type id (1-234 etc)
    this.atts = '';
    this.td_cur_cat = '';
    this.td_column_number = '';
    this.td_current_page = 1; //
    this.post_count = 0; //from wp
    this.found_posts = 0; //from wp
    this.max_num_pages = 0; //from wp
}

    ");
}

add_action('wp_head', 'td_js_generator', 10);
add_action('admin_head', 'td_js_generator', 10);
?>