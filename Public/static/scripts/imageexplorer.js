/**
 * 简单的图片浏览器，
 * 可以调整图片顺序，删除，添加，限制图片张数，配置每张图片的显示高度
 * @author wanghe
 */
function ImageExplorer(options){
	this.defaults = {
		container: '#img_box',
		picsHolder: '#house_pic',
		itemHeight: 150,
		countLimit: 0
	};

	this.config = $.extend({}, this.defaults, options);

	this.itemTemplate = "<div style='float:left;position:relative'>\
		<img class='thumbnail' style='height:{itemHeight}px;margin:0;' src='{picPath}'/>\
		<div class='pic-delete' style='position:absolute;top:0;right:0;' data-id='{picId}'><a class='btn btn-xs btn-danger' href='javascript:;'>删除</a></div>\
		<div class='pic-sort' style='position:absolute;bottom:0;width:100%;'>\
			<a class='btn btn-xs btn-info pic-sort-prev' data-id='{picId}' style='float:left;' href='javascript:;'>向前</a>\
			<a class='btn btn-xs btn-info pic-sort-next' data-id='{picId}' style='float:right;' href='javascript:;'>向后</a>\
		</div>\
	</div>";

	this.init();
}

ImageExplorer.prototype.init = function(){
	this.itemHeight = this.config.itemHeight;
	if(this.itemHeight <= 0){
		this.itemHeight = 150;
	}

	this.render();
};

ImageExplorer.prototype.getContainer = function(){
	if(!this.container){
		this.container = $(this.config.container);
	}

	return this.container;
};

ImageExplorer.prototype.getPicsHolder = function(){
	if(!this.picsHolder){
		this.picsHolder = $(this.config.picsHolder);
	}

	return this.picsHolder;
};

ImageExplorer.prototype.getPics = function(){
	//[{id:'', path:''}]
	//console.log(this.getPicsHolder().val());
	var picsStr = this.getPicsHolder().val();
	if(!picsStr){
		picsStr = '[]';
	}
	return $.parseJSON(picsStr);
};

ImageExplorer.prototype.render = function(){
	this.getContainer().empty();
	var pics = this.getPics();
	if(!pics || pics.length <= 0){
		return;
	}
	for(var i = 0; i < pics.length; i++){
		this.renderItem(pics[i]);
	}
};

ImageExplorer.prototype.renderItem = function(pic){
	var itemTemplate = this.itemTemplate.replace(/\{itemHeight\}/g, this.itemHeight);
	itemTemplate = itemTemplate.replace(/\{picPath\}/g, pic.path);
	itemTemplate = itemTemplate.replace(/\{picId\}/g, pic.id);

	var picItem = $(itemTemplate);
	picItem.appendTo(this.getContainer());

	var imageExplorer = this;

	var deleteBtn = picItem.find('div.pic-delete');
	deleteBtn.hide();
	deleteBtn.click(function(){
		ImageExplorer.prototype.deletePic.call(imageExplorer, $(this).attr('data-id'));
	});

	var sortBtn = picItem.find('div.pic-sort');
	sortBtn.hide();

	sortBtn.find('a.pic-sort-prev').click(function(){
		ImageExplorer.prototype.sort.call(imageExplorer, $(this).attr('data-id'), 0);
	});
	sortBtn.find('a.pic-sort-next').click(function(){
		ImageExplorer.prototype.sort.call(imageExplorer, $(this).attr('data-id'), 1);
	});

	picItem.mouseover(function(){
		$(this).find('div.pic-delete,div.pic-sort').show();
	});

	picItem.mouseout(function(){
		$(this).find('div.pic-delete,div.pic-sort').hide();
	});
};

ImageExplorer.prototype.hasItem = function(picId){
	var pics = this.getPics();
	if(!pics || pics.length <= 0){
		return false;
	}

	for(var i = 0; i < pics.length; i++){
		if(pics[i].id == picId){
			return true;
		}
	}

	return false;
};

ImageExplorer.prototype.addItem = function(pic){
	if(!pic || !pic.id){
		return;
	}
	var pics = this.getPics();

	for(var i = 0; i < pics.length; i++){
		if(pics[i].id == pic.id){
			pics.splice(i, 1);
			break;
		}
	}

	if(this.config.countLimit != 0 && pics.length >= this.config.countLimit){
		alert('数量超过限制，最多' + this.config.countLimit + '张');
		return false;
	}

	pics.push(pic);

	this.getPicsHolder().val(this.picsToJSON(pics));

	//this.renderItem(pic);
	this.render();

	return true;
};

ImageExplorer.prototype.deletePic = function(id){
	var picList = this.getPics();
	if(!picList || picList.length <= 0){
		return;
	}
	for(var i = 0, size = picList.length; i < size; i++){
		var pic = picList[i];
		if(pic.id == id){
			picList.splice(i, 1);
			break;
		}
	}

	this.getPicsHolder().val(this.picsToJSON(picList));
	this.render();
};

ImageExplorer.prototype.sort = function(id, dir){
	var picList = this.getPics();
	if(!picList || picList.length <= 0){
		return;
	}
	for(var i = 0, size = picList.length; i < size; i++){
		var pic = picList[i];
		if(pic.id != id){
			continue;
		}
		if(dir == 0){
			if(i == 0){
				return;
			}
			var prev = picList[i - 1];
			picList[i - 1] = pic;
			picList[i] = prev;
		}else{
			if(i == size - 1){
				return;
			}
			var next = picList[i + 1];
			picList[i] = next;
			picList[i + 1] = pic;
		}
		break;
	}

	this.getPicsHolder().val(this.picsToJSON(picList));

	this.render();
};

ImageExplorer.prototype.picsToJSON = function(pics){
	var json = '[';
	if(pics && pics.length > 0){
		for(var i = 0; i < pics.length; i++){
			if(i > 0){
				json += ',';
			}
			json += '{';
			json += '"id":' + pics[i].id;
			json += ',';
			json += '"path":"' + pics[i].path + '"';
			json += '}';
		}
	}

	json += ']';

	return json;

};