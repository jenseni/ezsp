$(function(){
	var winHeight = $(window).height();
	var sidebarHeight = $('.sidebar').height();
	if(sidebarHeight < winHeight){
		$('.sidebar').css('height', winHeight - 50);
	}
});