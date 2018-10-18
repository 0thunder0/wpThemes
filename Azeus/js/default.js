$(function(){
	$('img').addClass('img-fluid');
	$('#post_content img').addClass('imgStyle');


	// 评论样式修改
	$('#respond form p textarea').attr('cols','100%');
	$('#respond .comment-form-comment label').hide();
	$('#respond .form-submit').addClass('floatRight')
});