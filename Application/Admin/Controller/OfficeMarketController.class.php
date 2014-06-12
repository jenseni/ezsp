<?php
namespace Admin\Controller;

class OfficeMarketController extends AdminController{
	
	public function lists(){
		$this->authView(110);
		
		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Case = D('Officemarket');
		
		$totalCount = $Case->listCount($condition);
		$Page = new \Org\Util\Page($totalCount);

		$sortInfo = get_sort_info();

		$OfficeMarket = $Case->lists($sortInfo,$Page->firstRow,$Page->listRows,$condition);
		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $OfficeMarket);
		$this->display();
	}

	public function index(){
		
		/*$Case = D('Officemarket');
		$res = $Case->relation(true)->select();
		echo json_encode($res);
		exit();*/

		$this->authView(109);
		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Case = D('Officemarket');

		$totalCount = $Case->listCount($condition);
		
		$Page = new \Org\Util\Page($totalCount);

		$sortInfo = get_sort_info();

		$dataList = $Case->lists($sortInfo,$Page->firstRow,$Page->listRows,$condition);

		cookie('return_url', $_SERVER['REQUEST_URI']);


		$this->assign('dataList', $dataList);
		$this->display();
	}

	public function add($city = '517'){
		$this->authView(109);

		if(IS_POST){

			if(!isset($_POST['comp_register'])){
				$_POST['comp_register'] = 'N';
			}
			$Case = D('Officemarket');
			$data = $Case->create();

			if(!$data){
				$this->errorInput($Case->getError(), 'OfficeMarket/add');
			}

			$data['uid'] = session('uid');

			$id = $Case->data($data)->add();

			if(!$id){
				$this->errorMessage('添加失败', 'OfficeMarket/index');
			}

			$this->successMessage('添加成功', 'OfficeMarket/index');
		}
		
		$this->assign('city',$city);
		$this->display();
	}

	public function edit($city = '517'){
		$this->authView(110);
		
		$id = I('id','0');
		if(empty($id)){
			$this->error('参数不正确');
		}
		$Case = M('Officemarket')->find($id);
		if(empty($Case)){
			$this->error('数据不存在');
		}
		$this->assign('data', $Case);
		
		$this->assign('city',$city);
		$this->display();
	}
	//更新
	public function update(){
		if(!IS_POST){
			$this->error('错误的请求类型');
		}

		$res = D('Officemarket')->update();
		if(!$res){
			$this->errorMessage('更新失败','OfficeMarket/lists');
		}else{
			$this->successMessage('更新成功','OfficeMarket/lists');
		}
	}

	public function delete(){

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('OfficeMarket/lists')));
		}

		$Case = M('Officemarket');

		if(is_array($id)){
			$Case->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Case->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('OfficeMarket/lists')));
	}
}