<?php
namespace Home\Controller;

class CompanyController extends HomeController{
	public function index(){

		$pagePath = C('STATIC_PAGE_PATH') . '/company.html';

		\Think\Storage::connect();

		if(\Think\Storage::has($pagePath)){
			$content = \Think\Storage::read($pagePath);
		}

		$this->assign('content', isset($content) ? $content : '');

		$this->assign('currentNav', 2);

		$this->display();
	}
}