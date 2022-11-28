$(document).ready(function(){
	$('.acc h3').click(function(){
		$(this).next('.content_main').slideToggle();
		$(this).parent().toggleClass('active');
		$(this).parent().siblings().children('.content_main').slideUp();
		$(this).parent().siblings().removeClass('active');
	});
});