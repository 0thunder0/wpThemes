<div id="sideBar">
	<!-- 
	dynamic_sidebar('name');输出小工具,name是在functions.php文章中注册的侧边栏名字，name空时候默认调用第一个
	is_dynamic_sidebar();判断是否存在侧边栏小工具
	wp_list_cats();返回分类列表
	wp_list_pages();返回页面列表
	get_links();获取友情链接
	wp_register();获取登陆信息->管理站点链接
	wp_loginout();退出登陆
	 -->
	<? if(is_dynamic_sidebar()){		
		dynamic_sidebar('rightsidebar-1');
	}else{
		?>
		<div class="rightSidebar">

			<h3>自定义侧边栏</h3>
			<? wp_list_cats(); ?>

		</div>
		<?
	} ?>

</div>