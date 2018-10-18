<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- 	这里 echo get_bloginfo('blog_charset'); 和bloginfo('blog_charset');  效果一样 -->
	<!-- get_bloginfo( 'description','display');显示网站描述 -->
<title>
<? 
if(is_home()){
	$title=bloginfo('description','display');
 } else{
 	$title=wp_title();
 }
?>_<? bloginfo('name'); ?>
</title>
	<!-- <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="<? echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<? bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<? bloginfo('stylesheet_url'); ?>" >

</head>
<body>
	<div id="nav">			
		<? wp_nav_menu();	?>
	</div>

		<div class="container-fluid" id="banner">
			<!-- 
		1. get_option（'name'）:在wp_option这个数据库中创建并获得 name的值；update_option('name') 更新name这个值 
	-->
	<div class="jumbotron">
		<h1><a href="<? echo get_bloginfo('siteurl'); ?>">主题Azeus</a></h1> 
		<p>学的不仅是技术，更是梦想！！！</p>
		<?
		$totle_views=get_option('totle_views');
		update_option('totle_views',$totle_views+1);
		?>
		<p>访问量:<? echo $totle_views ?></p>
	</div>
</div>
<!-- 面包屑导航 -->
<div class="container">
<p>
	<? 	dH(); ?>
	
</p>
<hr>
</div>