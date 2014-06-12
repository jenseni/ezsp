<?php
namespace Admin\Controller;

class AgentMarketController extends AdminController{

	public function edit(){
		$this->authView(111);

		$pagePath = C('STATIC_PAGE_PATH') . '/agentmarket.html';

		if(IS_POST){

			\Think\Storage::connect();

			if(\Think\Storage::put($pagePath, $_POST['content'])){
				$this->successMessage('保存成功', 'AgentMarket/edit');
			}
			$this->errorMessage('保存失败', 'AgentMarket/edit');

		}else{
			\Think\Storage::connect();

			if(\Think\Storage::has($pagePath)){
				$content = \Think\Storage::read($pagePath);
			}

			$this->assign('content', isset($content) ? $content : '');

			$this->display();
		}
	}
}