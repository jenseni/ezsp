<?php
namespace Phone\Controller;

class CompanyController extends PhoneController{
	public function index(){

		$pagePath = C('STATIC_PAGE_PATH') . '/company.html';

		if(\Think\Storage::has($pagePath)){
			$content = \Think\Storage::read($pagePath);
			if($content){
				//去掉富文本多余的标记，如table一类的会影响手机浏览器显示样式
				$content = strip_tags($content, "<div><ul><li><ol><code><p><span><b><br><img>");
				//替换img宽度
				$content = preg_replace('/<img.+?src=\"(.+?)\".+?>/i',"<img src='\${1}' width='100%'/>",$content);
			}
		}

		$this->assign('content', isset($content) ? $content : '');

		$this->display();
	}
}