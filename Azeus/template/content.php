				<div id="post_title"><h2><? the_title(); ?>[conent.php]</h2></div><hr>
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
				<div style="">
					<?php the_content(); ?>
			</div>
				