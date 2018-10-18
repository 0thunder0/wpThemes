<?php
$td_translation_map = array(
    //header search
    'View all results' => __('View all results', TD_THEME_NAME),
    'No results' => __('No results', TD_THEME_NAME),

    'Home' => __('Home', TD_THEME_NAME),
    'Categories' => __('Categories', TD_THEME_NAME),

    //mobile menu
    'CLOSE' => __('CLOSE', TD_THEME_NAME),

    //title tag
    'Page' => __('Page', TD_THEME_NAME),


    //blocks
    'All' => __('All', TD_THEME_NAME),
    'by' => __('by', TD_THEME_NAME),
    'Load more' => __('Load more', TD_THEME_NAME),

    //breadcrumbs
    'View all posts in' => __('View all posts in', TD_THEME_NAME),

    //article / page
    'Previous article' => __('Previous article', TD_THEME_NAME),
    'Next article' => __('Next article', TD_THEME_NAME),
    'Author' => __('Author', TD_THEME_NAME),
    'More articles from author' => __('More articles from author', TD_THEME_NAME),
    'SIMILAR ARTICLES' => __('SIMILAR ARTICLES', TD_THEME_NAME),
    'source' => __('source', TD_THEME_NAME),
    'via' => __('via', TD_THEME_NAME),
    'Continue' => __('Continue', TD_THEME_NAME),

    //comments


    'Name:' => __('Name:', TD_THEME_NAME),
    'Email:' => __('Email:', TD_THEME_NAME),
    'Website:' => __('Website:', TD_THEME_NAME),
    'Comment:' => 'Comment:',
    'Leave a Reply' => __('Leave a Reply', TD_THEME_NAME),
    'Post Comment' => __('Post Comment', TD_THEME_NAME),
    'Cancel reply' => __('Cancel reply', TD_THEME_NAME),
    'Reply' => __('Reply', TD_THEME_NAME),
    'Log in to leave a comment' => __('Log in to leave a comment', TD_THEME_NAME),
    'NO COMMENTS' => __('NO COMMENTS', TD_THEME_NAME),
    '1 COMMENT' => __('1 COMMENT', TD_THEME_NAME),
    'COMMENTS' => __('COMMENTS', TD_THEME_NAME),


    //review
    'Review overview' => __('Review overview', TD_THEME_NAME),
    'Summary' => __('Summary', TD_THEME_NAME),

    //404

    '404 Error - page not found' => __('404 Error - page not found', TD_THEME_NAME),
    'OUR LATEST POSTS' => __('OUR LATEST POSTS', TD_THEME_NAME),
    "We're sorry, but the page you are looking for doesn't exist." => __("We're sorry, but the page you are looking for doesn't exist.", TD_THEME_NAME),
    'You can go to the' => __('You can go to the', TD_THEME_NAME),

    'homepage' => __('homepage', TD_THEME_NAME),

    //author page title atribute
    'Posts by ' => __('Posts by ', TD_THEME_NAME),
    'POSTS' => __('POSTS', TD_THEME_NAME),
    'COMMENTS' => __('COMMENTS', TD_THEME_NAME),

    //category page
    'Posts in ' => __('Posts in ', TD_THEME_NAME),

    //tags
    'Tags' => __('Tags', TD_THEME_NAME),
    'Posts tagged with' => __('Posts tagged with', TD_THEME_NAME),
    'Tag' => __('Tag', TD_THEME_NAME),

    //archives
    'Daily Archives: ' => __('Daily Archives: ', TD_THEME_NAME),
    'Monthly Archives: ' => __('Monthly Archives: ', TD_THEME_NAME),
    'Yearly Archives: ' => __('Yearly Archives: ', TD_THEME_NAME),
    'Archives' => __('Archives', TD_THEME_NAME),


    //homepage
    'LATEST ARTICLES' => __('LATEST ARTICLES', TD_THEME_NAME),

    //search page
    'search results' => __('search results', TD_THEME_NAME),
    'Search' => __('Search', TD_THEME_NAME),
    "If you're not happy with the results, please do another search" => __("If you're not happy with the results, please do another search", TD_THEME_NAME),

    //footer widget
    'Contact us' => __('Contact us', TD_THEME_NAME),
    'Contact' => __('Contact', TD_THEME_NAME),

    //pagination
    'Page %CURRENT_PAGE% of %TOTAL_PAGES%' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%', TD_THEME_NAME),
    'Next' => __('Next', TD_THEME_NAME),
    'Prev' => __('Prev', TD_THEME_NAME)



);

$td_translation_map_user = td_util::get_option('td_translation_map_user');


//the custom translation function
function __td($td_string, $td_domain = '') {
    global $td_translation_map_user, $td_translation_map;

    if (!empty($td_translation_map_user[$td_string])) {
        //return the user translation
        return stripslashes($td_translation_map_user[$td_string]);

    } elseif (!empty($td_translation_map[$td_string])) {
        //return the default translation
        return $td_translation_map[$td_string];

    } else {
        //no translation detected
        return $td_string;
    }
}



//echo custom translation function
function _etd($td_string, $td_domain = '') {
    echo __td($td_string, $td_domain);
}


?>