/**
 * 其实是一些工具方法
 */
(function($){
	var App = window.App;
	
	/**
	 * 内容高度达不到浏览器高度时让content高度撑满
	 */
	App.fullContent = function(){
		var docHeight = $(document).height();
		var contentHeight = $('.content').height();
		if(contentHeight < docHeight && !App.fullContented){
			$('.content').css('min-height', docHeight - 90);
			App.fullContented = true;
		}
	};

	App.groupCheckbox = function(){
		$('input:checkbox[check-group]').click(function(){
			$this = $(this);
			var target = $(this).attr('check-group');

			if(!target){
				return;
			}

			var checked = $this.prop('checked');

			$(target).prop('checked', checked);
		});
	};

	App.tableSort = function(){
		$('th.sortable[href]').click(function(){
			window.location.href = $(this).attr('href');
		});
	};

	App.registAppButton = function(){
		$('.app-btn').click(function(e){
			e = e || window.event;
			e.preventDefault();

			$this = $(this);

			var result = true;

			var confirmMsg = $this.attr('confirm');

			if(confirmMsg){
				result = confirm(confirmMsg);
			}

			if(!result){
				return;
			}

			if($this.attr('target')){
				var $form = $($this.attr('target'));
				$form.attr('action', $this.attr('href'));
				$form.submit();
			}else{
				window.location.href = $this.attr('href');
			}
		});
	}
	/* 放到后台做校验
	App.checkSelect = function(form){
		var hasSelect = false;
		$(form).find('input:checkbox').each(function(){
			if($(this).prop('checked')){
				hasSelect = true;
			}
		});

		if(!hasSelect){
			alert('请选择要操作的记录');
		}

		return hasSelect;
	}
	*/

})(jQuery);

$(function(){
	App.fullContent();

	$(window).resize(function(){
		App.fullContent();
	});

	App.groupCheckbox();

	App.tableSort();

	App.registAppButton();
});