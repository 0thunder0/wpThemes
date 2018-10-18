<? 
// register_siderbar();注册一个小工具，只能在funcions.php这个文件中使用，注册之后才能使用小工具
register_sidebar(
  array(
     'name'          => '侧边栏1',
     'id' => 'rightsidebar-1',
     'before_widget' => '<div class="rightSidebar">',
     'after_widget'  => '</div>',
     'before_title'  => '<h3>',
     'after_title'   => '</h3>'
 )
);

register_sidebar(
  array(
     'name'          => '侧边栏2',
     'id' => 'rightsidebar-2',
     'before_widget' => '<div class="rightSidebar">',
     'after_widget'  => '</div>',
     'before_title'  => '<h3>',
     'after_title'   => '</h3>'
 )
);

// 后台添加特色图片功能
add_theme_support( 'post-thumbnails' );
//增加文章格式功能
add_theme_support( 'post-formats', array(
'aside',
'gallery',
));

// 自定义面包屑导航函数
function dH(){
    if(!is_home()){   ?>
        <a href="<? bloginfo('url'); ?>">首页>></a>
        <?
        if(is_category()){single_cat_title();}
        elseif(is_single()){
            $cat=get_the_category();
            $cat=$cat[0];
            echo '<a href="' . get_category_link( $cat ) . '">' . $cat->name . '</a> >> 文章内容';
        }elseif (is_page()) {the_title();}
        elseif(is_404()){ echo '404错误页面';}
        elseif(is_search()){echo $s;}
    }
}




// ------------------------------------------------------------------------------
//调用bing美图作为登录页背景图
function custom_login_head(){
$str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
if(preg_match("/<url>(.+?)<\/url>/ies",$str,$matches)){
$imgurl='http://cn.bing.com'.$matches[1];
    echo'<style type="text/css">body{background: url('.$imgurl.');width:100%;height:100%;background-image:url('.$imgurl.');-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;-moz-border-image: url('.$imgurl.') 0;background-repeat:no-repeat\9;background-image:none\9;}</style>';
}}
add_action('login_head', 'custom_login_head');
// ------------------------------------------------------------------------------
// 注册菜单管理
function register_my_menus() {
  register_nav_menus(
      array(
        'top-menu' => __( '顶部菜单'),
        'header-menu' => __( '头部(主)菜单'),
        'footer-menu' => __( '底部菜单')
      )
  );
}
add_action( 'init', 'register_my_menus' );
// ------------------------------------------------------------------------------
//添加自定义图集
add_action('init','my_style_post');
function my_style_post(){
  $labels = array(
    'name'               => '图集',
      'singular_name'      => '图集',
      'add_new'            => '添加相册',
      'add_new_item'       => '添加相册资料',
      'edit_item'          => '编辑相册资料',
      'new_item'           => '新相册',
      'all_items'          => '所有相册',
      'view_item'          => '查看相册',
      'search_items'       => '搜索相册',
      'not_found'          => '没找到相册',
      'not_found_in_trash' => '回收站里没找到相册资料', 
      'menu_name'          => '图集'
  );
  $supports=array( 
    'title', 
    'editor', 
    'thumbnail'
  );
  $args = array(
    'public'=>true,
    'labels'=>$labels,
    'menu_position' => 5,
    'supports'      => $supports,
    'has_archive'   => true,
    'rewrite'       => array( 'slug'  => 'pic_club', 'with_front'  => false ),
  );
  register_post_type('pic_club', $args );
//添加图集分类
    $labels2 = array(
    'name'              => _x( '相册分类', 'taxonomy 名称' ),
    'singular_name'     => _x( '相册分类', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索相册分类' ),
    'all_items'         => __( '所有相册分类' ),
    'parent_item'       => __( '该相册分类的上级分类' ),
    'parent_item_colon' => __( '该相册分类的上级分类：' ),
    'edit_item'         => __( '编辑相册分类' ),
    'update_item'       => __( '更新相册分类' ),
    'add_new_item'      => __( '添加新的相册分类' ),
    'new_item_name'     => __( '新相册分类' ),
    'menu_name'         => __( '相册分类' ),
  );
  $args2 = array(
    'labels' => $labels2,
    'hierarchical' => true,
  );
  register_taxonomy( 'pic_club_category', 'pic_club', $args2 );
 
};
// $label数组告诉wordpress如何显示这个文章类型的相关信息
// $supports数组告诉wordpress这个文章类型可以支持什么（比如标题title,编辑栏editor,特色图片,revisions,自定义栏目custom-fields,摘要excerpt）

//丰富自定义文章可以输入的内容，添加自定义 Meta Box
add_action('add_meta_boxes','pic_club_meta');
function pic_club_meta(){
  //add_meta_box( $id, $title, $callback, $post_type, $context,$priority, $callback_args );
  add_meta_box(
    'pic_club_meta',
    '相册关键词',
    'pic_meta_func',
    'pic_club',
    'side',
    //侧边栏（side）。因为内容不多，所以侧边栏足够，若内容较多，可以将“side”改为“advanced”，这样就会在主内容区域渲染Meta Box
      'low'
  );
};

function pic_meta_func($post) { 
    // 创建临时隐藏表单，为了安全
    wp_nonce_field( 'pic_meta_func', 'pic_meta_func_nonce' );
    // 获取之前存储的值
    $value = get_post_meta( $post->ID, '_pic_club_meta', true );
?>
     <label for="pic_club_meta"></label>
    <input type="text" id="pic_club_meta" name="pic_club_meta" value="<?php echo esc_attr( $value ); ?>" placeholder="输入导演名称" >
 
    <?php
};
//保存Meta Box 表单内容
function pic_club_save_meta_box($post_id){
 
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if ( ! isset( $_POST['pic_meta_func_nonce'] ) ) {
        return;
    }
    // 判断隐藏表单的值与之前是否相同
    if ( ! wp_verify_nonce( $_POST['pic_meta_func_nonce'], 'pic_meta_func' ) ) {
        return;
    }
    // 判断该用户是否有权限
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 
    // 判断 Meta Box 是否为空
    if ( ! isset( $_POST['pic_club_meta'] ) ) {
        return;
    }
 
    $pic_club_meta = sanitize_text_field( $_POST['pic_club_meta'] );
    update_post_meta( $post_id, '_pic_club_meta', $pic_club_meta );
 
}

//列表显示自定义Meta Box字段
add_action("manage_posts_custom_column",  "movie_custom_columns");
add_filter("manage_edit-movie_columns", "movie_edit_columns");
function movie_custom_columns($column){
    global $post;
    switch ($column) {
        case "pic_club_meta":
            echo get_post_meta( $post->ID, '_pic_club_meta', true );
            break;
    }
}
function movie_edit_columns($columns){
 
    $columns['pic_club_meta'] = '导演';
 
    return $columns;
}
// ------------------------------------------------------------------------------
//去除分类标志代码
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
    global $wp_rewrite;
    $wp_rewrite -> flush_rules();
}
// register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
// function no_category_base_deactivate() {
//  remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
//  // We don't want to insert our custom rules again
//  no_category_base_refresh_rules();
// }
// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
    global $wp_rewrite, $wp_version;
    if (version_compare($wp_version, '3.4', '<')) {
        // For pre-3.4 support
        $wp_rewrite -> extra_permastructs['category'][0] = '%category%';
    } else {
        $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
    }
}
// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
    //var_dump($category_rewrite); // For Debugging
    $category_rewrite = array();
    $categories = get_categories(array('hide_empty' => false));
    foreach ($categories as $category) {
        $category_nicename = $category -> slug;
        if ($category -> parent == $category -> cat_ID)// recursive recursion
        $category -> parent = 0;
        elseif ($category -> parent != 0)
            $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
        $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
    }
    // Redirect support from Old Category Base
    global $wp_rewrite;
    $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
    $old_category_base = trim($old_category_base, '/');
    $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
    //var_dump($category_rewrite); // For Debugging
    return $category_rewrite;
}
// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
    $public_query_vars[] = 'category_redirect';
    return $public_query_vars;
}
// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
    //print_r($query_vars); // For Debugging
    if (isset($query_vars['category_redirect'])) {
        $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
        status_header(301);
        header("Location: $catlink");
        exit();
    }
    return $query_vars;
}
// ------------------------------------------------------------------------------


?>