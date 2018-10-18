<? get_header(); ?>
<!-- 加载header.php文件 -->

<div class="container">
	<div><li style="display:block;float: left;border:1px solid grey;border-radius: 15px; ">当前分类：<? single_cat_title(); ?></li></div>
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
	<?
	if(have_posts()){
	// 用 if判断是否有文章
		while (have_posts()) {
			// 循环输出文章
			the_post();
			?>
			<li>
				<div id="post_title"><h2><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2><hr></div>
				<!-- 3.文章元数据的调用
				the_category();调用文章上一级目录
				the_author();调用文章的作者
				the_time();调用文章的时间
				edit_post_link();调用文章编辑链接
				the_excerpt();调用文章摘要
				the_post_thumbnail();调用文章特色图片 -->
				<div id="post_meta">
					<span>
						作者：<? the_author(); ?>
						发布时间：<? the_time('Y-m-d H:i:s'); ?>
						<? edit_post_link( __('Edit','墨君'),'|','' ); ?>
					</span>
					<hr>
				</div>
				<div style="border: 1px solid grey;border-radius: 20px;margin-bottom: 10px;padding: 15px;"><?php the_post_thumbnail(); ?></div>
				</li>  
			<?
		}
	}else{
		echo '没有日志可显示';
	}
	?> 
	
	<!-- 导航：
	posts_nav_link(); 获取导航链接 -->
	<div id="postsNav" >
  <? posts_nav_link(); ?>
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
