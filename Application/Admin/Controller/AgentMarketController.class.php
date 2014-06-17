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

	public function lists(){
		$this->authView(121);

		$title = I('title');
		$status = I('status');

		$condition = array();
		if(!empty($title)){
			$condition['h.title'] = array('LIKE', "%{$title}%");
		}
		if($status != ''){
			$condition['h.status'] = (int)$status;
		}

		$AgentMarket = D('AgentMarket');
		$totalCount = $AgentMarket->alias('h')->where($condition)->count();

		$Page = new \Org\Util\Page($totalCount);

		$dataList = $AgentMarket->field('h.id,h.title,h.status,h.create_time')
			->alias('h')
			->where($condition)
			->limit($Page->firstRow, $Page->listRows)
			->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);
		$this->assign('page', $Page->show());

		$this->display();
	}

	public function index(){
		$this->authView(122);

		$title = I('title');
		$status = I('status');

		$condition = array('uid'=>$this->loginUser['id']);
		if(!empty($title)){
			$condition['h.title'] = array('LIKE', "%{$title}%");
		}
		if($status != ''){
			$condition['h.status'] = (int)$status;
		}

		$AgentMarket = D('AgentMarket');
		$totalCount = $AgentMarket->alias('h')->where($condition)->count();

		$Page = new \Org\Util\Page($totalCount);

		$dataList = $AgentMarket->field('h.id,h.title,h.status,h.create_time')
			->alias('h')
			->where($condition)
			->limit($Page->firstRow, $Page->listRows)
			->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);
		$this->assign('page', $Page->show());

		$this->display();
	}
}