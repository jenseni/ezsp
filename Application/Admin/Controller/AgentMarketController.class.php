<?php
namespace Admin\Controller;

class AgentMarketController extends AdminController{

	/*public function edit(){
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
	}*/

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

		$this->display('index');
	}

	public function add(){
		$this->authView(122);

		if(IS_POST){
			$AgentMarket = D('AgentMarket');
			$data = $AgentMarket->saveOrUpdate();

			if(!$data){
				$this->errorInput($AgentMarket->getError(), 'AgentMarket/edit');
			}
			$this->successMessage('基本信息保存成功', 'AgentMarket/index');
		}else{
			$this->display('edit');
		}
	}

	public function edit($id = 1){
		$this->authView(121);

		$AgentMarket = D('AgentMarket');
		$data = $AgentMarket->field(true)->find($id);

		if(empty($data)){
			$this->errorMessage('数据不存在或已删除', get_return_url(U('AgentMarket/lists')));
		}

		$Picture = M('Picture');
		$picList = $Picture->field('id,path')->where(array('pid'=>$data['id'], 'type'=>5))->select();

		if(empty($picList)){
			$data['house_pic'] = '[]';
		}else{
			$data['house_pic'] = json_encode($picList);
		}

		$this->assign('data', $data);

		$this->display('edit');
	}
}