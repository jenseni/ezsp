<?php
namespace Home\Controller;

class AgentMarketController extends HomeController{
	public function index(){
		$pagePath = C('STATIC_PAGE_PATH') . '/agentmarket.html';

		\Think\Storage::connect();

		if(\Think\Storage::has($pagePath)){
			$content = \Think\Storage::read($pagePath);
		}

		$this->assign('content', isset($content) ? $content : '');

		$this->display();
	}
}