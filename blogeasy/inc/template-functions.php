<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blogeasy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogeasy_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'blogeasy_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blogeasy_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blogeasy_pingback_header' );

/**
* Breadcrumb Trail Customization
*/
function blogeasy_breadcrumb_trail() {
	$breadcrumb_defaults = array(
		'browse_tag'      => 'h6',
		'show_browse'     => false,
		'labels' => array(
			'home' => '<i class="fas fa-home"></i>'
		),
	);
	if ( function_exists( 'breadcrumb_trail' ) ) :
		breadcrumb_trail( $breadcrumb_defaults );
	endif;
}

/**
* Add classes to navigation buttons
*/
add_filter( 'next_posts_link_attributes', 'blogeasy_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'blogeasy_posts_link_attributes' );
add_filter( 'next_comments_link_attributes', 'blogeasy_comments_link_attributes' );
add_filter( 'previous_comments_link_attributes', 'blogeasy_comments_link_attributes' );

function blogeasy_posts_link_attributes() {
    return 'class="btn btn-outline-primary mb-4"';
}

function blogeasy_comments_link_attributes() {
    return 'class="btn btn-outline-primary mb-4"';
}

/**
* Greet new users & guide them to help page
*/
function blogeasy_admin_notice(){
	if ( is_admin() ) {
		blogeasy_greet_user();
	}
}
$intro_notice_dismissed = get_option( 'blogeasy-intro-dismissed' );
if( empty( $intro_notice_dismissed ) ) {
	add_action('admin_notices', 'blogeasy_admin_notice');
}

function blogeasy_greet_user() {
	$help_url = esc_url( admin_url( 'themes.php?page=blogeasy-theme-help' ) );
	echo '<div class="notice blogeasy-intro-notice notice-success is-dismissible">';
	echo wp_kses_post( __( '<p style="margin-bottom: 15px;">Welcome! Thank you for choosing BlogEasy. You can always reach out to us on the support forum if you need any help. Please do take a look at the pro version of the theme. We are offering some <b><u>special discounts for limited time on the pro version</u></b>. If you liked our work, please support us by providing us a review with 5 star ratings.', 'blogeasy' ) );
	echo "<p><a href='https://wordpress.org/support/theme/blogeasy' class='button' target='_blank'>";
	esc_html_e( 'Support Forum', 'blogeasy' );
	echo "</a><a href='https://wp-themespoint.com/blogeasy-pro' class='button button-primary' target='_blank' style='margin-left: 10px;'>";
	esc_html_e( 'Check BlogEasy Pro', 'blogeasy' );
	echo "</a><a href='https://wordpress.org/support/theme/blogeasy/reviews/#new-post' class='' target='_blank' style='margin-left: 10px;'>";
	esc_html_e( 'Rate us 5 stars', 'blogeasy' );
	echo "</a><a href='#' class='be-notice-dismiss' target='_blank' style='margin-left: 10px;float: right;'>";
	esc_html_e( 'Don\'t display this again!', 'blogeasy' );
	echo '</a></p></div>';
}


// Enqueue dismiss script
function blogeasy_admin_scripts() {
	wp_enqueue_script( 'blogeasy-admin', get_template_directory_uri() . '/assets/js/blogeasy-admin.js' );
}
$intro_notice_dismissed = get_option( 'blogeasy-intro-dismissed' );
if( empty( $intro_notice_dismissed ) ) {
	add_action( 'admin_enqueue_scripts' , 'blogeasy_admin_scripts' );
}


// Update option if notice dismissed
add_action( 'wp_ajax_blogeasy-intro-dismissed', 'blogeasy_dismiss_intro_notice' );
function blogeasy_dismiss_intro_notice() {
	update_option( 'blogeasy-intro-dismissed', 1 );
}
