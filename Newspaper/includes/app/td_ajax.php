<?php



function td_ajax_search() {
    $buffy = '';
	$buffy_msg = '';

    //the search string
    if (!empty($_POST['td_string'])) {
        $td_string = $_POST['td_string'];
    } else {
        $td_string = '';
    }

    //get the data
    $td_data_source = new td_data_source(); //new data source
    $td_query = &$td_data_source->get_wp_query_search($td_string); //by ref  do the query

    //build the results
    if (!empty($td_query->posts)) {
        foreach ($td_query->posts as $post) {
            $td_module_aj_search = new td_module_aj_search($post);
            $buffy .= $td_module_aj_search->render();
        }
    }

    if (count($td_query->posts) == 0) {
        //no results
        $buffy = '<div class="result-msg no-result">' . __td('没有结果') . '</div>';
    } else {
        //show the resutls
        $buffy_msg .= '<div class="result-msg"><a href="' . get_search_link($td_string) . '">' . __td('查看所有结果') . '</a></div>';
        //add wrap
        $buffy = '<div class="td-aj-search-results">' . $buffy . '</div>' . $buffy_msg;
    }





    //prepare array for ajax
    $buffyArray = array(
        'td_data' => $buffy,
        'td_total_results' => 2,
        'td_total_in_list' => count($td_query->posts),
        'td_search_query'=> $td_string
    );





    // Return the String
    die(json_encode($buffyArray));
}
add_action( 'wp_ajax_nopriv_td_ajax_search', 'td_ajax_search' );
add_action( 'wp_ajax_td_ajax_search', 'td_ajax_search' );



function td_ajax_block(){
    global $post;
    //get the data from ajax() call


    if (!empty($_POST['td_atts'])) {
        $td_atts = json_decode(stripslashes($_POST['td_atts']), true); //current block args
    } else {
        $td_atts = ''; //not ok
    }

    if (!empty($_POST['td_cur_cat'])) {
        $td_cur_cat = $_POST['td_cur_cat']; //the new id filter
    } else {
        $td_cur_cat = '';
    }

    if (!empty($_POST['td_column_number'])) {
        $td_column_number =  $_POST['td_column_number']; //the block is on x columns
    } else {
        $td_column_number = 0; //not ok
    }


    if (!empty($_POST['td_current_page'])) {
        $td_current_page = $_POST['td_current_page'];
    } else {
        $td_current_page = 1;
    }

    if (!empty($td_cur_cat)) {
        $td_atts['category_ids'] = $td_cur_cat;
        unset($td_atts['category_id']);
    }

    if (!empty($_POST['td_block_id'])) {
        $td_block_id = $_POST['td_block_id'];
    } else {
        $td_block_id = ''; //not ok
    }

    if (!empty($_POST['block_type'])) {
        $block_type = $_POST['block_type'];
    } else {
        $block_type = '';
    }

    $td_data_source = new td_data_source(); //new data source
    $td_query = &$td_data_source->get_wp_query($td_atts, $td_current_page); //by ref  do the query


    $buffy ='';


    $buffy .= td_global_blocks::get_instance($block_type)->inner($td_query->posts, $td_column_number, '', true);



    //pagination
    $td_hide_prev = false;
    $td_hide_next = false;
    if ($td_current_page == 1) {
        $td_hide_prev = true; //hide link on page 1
    }

    if ($td_current_page >= $td_query->max_num_pages ) {
        $td_hide_next = true; //hide link on last page
    }


    $buffyArray = array(
        'td_data' => $buffy,
        'td_block_id' => $td_block_id,
        'td_cur_cat' => $td_cur_cat,
        'td_hide_prev' => $td_hide_prev,
        'td_hide_next' => $td_hide_next
    );

    // Return the String
    die(json_encode($buffyArray));
}

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_td_ajax_block', 'td_ajax_block' );
add_action( 'wp_ajax_td_ajax_block', 'td_ajax_block' );
?>