<!doctype html >
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php td_util::author_meta(); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


    <?php
    $tds_favicon_upload = td_util::get_option('tds_favicon_upload');
    if (!empty($tds_favicon_upload)) {
        echo '<link rel="icon" type="image/png" href="' . $tds_favicon_upload . '">';
    }

    wp_head();
    ?>
</head>

<body <?php body_class() ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">



<div id="outer-wrap">
    <div id="inner-wrap">
<?php

//echo td_util::get_option('tds_header_style');

$tds_header_style = td_util::get_option('tds_header_style');


if (TD_DEPLOY_READ_CONTENT_META === true) {
    global $wp_query;
    //$post_id = $wp_query->post->ID;

    if (!empty($wp_query->post)) {
        $td_db_header = get_post_meta($wp_query->post->ID, 'td_db_header', true);
        if (!empty($td_db_header)) {
            $tds_header_style = $td_db_header;
        }
    }
}




get_template_part('parts/header/menu_mobile');


if (td_util::get_customizer_option('top_menu') != 'hide') {
    get_template_part('parts/header/menu_top');
}

?>


<?php
switch ($tds_header_style) {
    case '2':
        get_template_part('parts/header/header_style_2');
        get_template_part('parts/header/menu_header');
        break;

    case '3':
        get_template_part('parts/header/header_style_3');
        get_template_part('parts/header/menu_header');
        break;

    default:
        get_template_part('parts/header/logo_ad');
        get_template_part('parts/header/menu_header');
        break;
}
?>




