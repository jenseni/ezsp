/**
 * 其实是一些工具方法
 */
(function($){
	var App = window.App;
	
	/**
	 * 内容高度达不到浏览器高度时让content高度撑满
	 */
	App.fullContent = function(){
		var winHeight = $(window).height();
		var contentHeight = $('.content').height();
		if(contentHeight < winHeight){
			$('.content').css('height', winHeight - 50);
		}
	};

})(jQuery);