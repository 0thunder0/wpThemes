<? get_header(); ?>
<!-- 加载header.php文件 -->


<div class="container">
	<div class="row">
	<!-- 
		2.首页文章调用
have_posts()：判断是否有文章
the_post();获取下一篇文章信息，并且将信息存入全局变量$post中
the_permalink(); 获取文章的连接地址
the_title(); 获取文章标题
the_content(); 获取文章所有内容
-->
<div class="col-sm-8" id="postMain">
	<!-- 调用默认文章 -->
	<?
	if(have_posts()){
	// 用 if判断是否有文章
		while (have_posts()) {
			// 循环输出文章
			the_post();
			// get_the_ID();获取文章id
			// get_the_category();根据文章id查找所属分类
			$cat = get_the_category( get_the_ID() );			
			$name = $cat[0]->slug;
			//加载 content-name.php 模版文件，如果文件不存在，则调用content.php
			// <!-- 调用自定义文章类型 -->
			get_template_part( 'template/content', $name );
			
		}
	}else{
		echo '没有日志可显示';
	}
	?> 
	<div id="postNav" >
		<!-- next_post_link();下一篇文章链接
previous_post_link();上一篇文章链接 -->

		
		<? previous_post_link('上一篇：%link'); ?><br />
		<? next_post_link('下一篇：%link'); ?>

	</div>
	<div>
<? comments_template(); ?>
	</div>

</div>

<div class="col-sm-4">
	<!-- get_sidebar();加载sidebar.php文件并显示 -->
	<? get_sidebar(); ?>
</div>
</div>
</div>
<!-- 加载footer.php文件 -->
<? get_footer(); ?>
