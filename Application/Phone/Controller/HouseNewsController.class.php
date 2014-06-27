<?php
namespace Phone\Controller;

class HouseNewsController extends PhoneController{
	//详细页面
	public function detail($document_id,$category_title = ''){
		$Document = M('Article');
		$news = $Document->find($document_id);
		if($news['content']){
			$news['content'] = htmlspecialchars_decode($news['content']);
			//去掉富文本多余的标记，如table一类的会影响手机浏览器显示样式
			$news['content'] = strip_tags($news['content'], "<div><ul><li><ol><code><p><span><b><br><img>");
			//替换img宽度
			$news['content'] = preg_replace('/<img.+?src=\"(.+?)\".+?>/i',"<img src='".__ROOT__."\${1}' width='100%'/>",$news['content']);
		}
		if(empty($category_title)){
			$category = M('Category')->find($news['category_id']);
			$category_title = $category['title'];
		}
		//echo json_encode($news);exit();
		$this->assign('news',$news);
		$this->assign('category_title',$category_title);
		$this->display();
	}
}