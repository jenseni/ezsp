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

			$data = $Case->saveOrUpdate();
			if(!$data){
				$this->errorInput($Case->getError(), 'OfficeMarket/add');
			}

			$this->successMessage('添加成功', 'OfficeMarket/add');
		}
		
		$this->assign('city',$city);
		$this->display();
	}

	public function edit($city = '517'){
		$this->authView(110);
		
		if(IS_POST){
			$Case = D('Officemarket');
			$data = $Case->saveOrUpdate();
			if(!$data){
				$this->errorInput($Case->getError(), 'OfficeMarket/lists');
			}

			$this->successMessage('修改成功', get_return_url('OfficeMarket/lists'));
		}else{
			$Case = D('Officemarket');
			$id = I('id');
			if(empty($id)){
				$this->error('参数不正确');
			}
			$data = $Case->find($id);
			if(empty($data)){
				$this->error('数据不存在');
			}

			$Picture = M('Picture');
			$picList = $Picture->field('id,path')->where(array('pid'=>$data['id'], 'type'=>3))->select();
			if(empty($picList)){
				$data['house_pic'] = '[]';
			}else{
				$data['house_pic'] = json_encode($picList);
			}

			$this->assign('data', $data);

			$this->display('edit');
		}
	}
	

	public function delete(){
		$this->authView(110);

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

	public function changestatus($id, $status){
		$this->authView(110);
		$OfficeMarket = M('Officemarket');

		$OfficeMarket->where(array('id'=>(int)$id))->setField('status', $status);

		$this->successMessage('操作成功', get_return_url(U('OfficeMarket/lists')));
	}
}