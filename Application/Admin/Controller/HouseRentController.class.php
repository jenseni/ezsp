<?php
namespace Admin\Controller;

use \Think\Controller;

class HouseRentController extends AdminController{
	public function lists(){
		$this->authView(106);

		$community = I('get.community');
		$status = I('get.status');

		$condition = array();
		if(!empty($community)){
			$condition['hs.community'] = array('LIKE', "%{$community}%");
		}
		if(!empty($status)){
			$condition['hs.status'] = (int)$status;
		}

		$HouseRent = D('HouseRent');
		$totalCount = $HouseRent->alias('hr')->where($condition)->count();

		$Page = new \Org\Util\Page($totalCount);

		$dataList = $HouseRent->field('hr.id,hr.title,hr.community,hr.status,hr.create_time,area.name area_name,busi_area.name busi_area_name')
			->alias('hr')
			->join('__DISTRICT__ area on area.id=hr.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=hr.busi_area', 'LEFT')
			->where($condition)->limit($Page->firstRow, $Page->listRows)
			->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);
		$this->assign('page', $Page->show());

		$this->display();
	}


	public function add(){
		$this->authView(105);

		if(IS_POST){
			$HouseRent = D('HouseRent');
			$data = $HouseRent->saveOrUpdate();
			if(!$data){
				$this->errorInput($HouseRent->getError(), 'HouseRent/edit');
			}

			$this->successMessage('发布成功', 'HouseRent/add');
		}else{
			$this->display('edit');
		}
	}

	public function edit(){
		$this->authView(106);

		if(IS_POST){
			$HouseRent = D('HouseRent');
			$data = $HouseRent->saveOrUpdate();
			if(!$data){
				$this->errorInput($HouseRent->getError(), 'HouseRent/edit');
			}

			$this->successMessage('修改成功', get_return_url('HouseRent/lists'));
		}else{
			$HouseRent = D('HouseRent');
			$id = I('id');
			if(empty($id)){
				$this->error('参数不正确');
			}
			$data = $HouseRent->find($id);
			if(empty($data)){
				$this->error('数据不存在');
			}

			$Picture = M('Picture');
			$picList = $Picture->field('id,path')->where(array('pid'=>$data['id'], 'type'=>2))->select();
			if(empty($picList)){
				$data['house_pic'] = '[]';
			}else{
				$data['house_pic'] = json_encode($picList);
			}

			$this->assign('data', $data);

			$this->display('edit');
		}
	}

	public function changeStatus($id, $status){
		$this->authView(106);
		$HouseRent = D('HouseRent');

		$HouseRent->where(array('id'=>(int)$id))->setField('status', $status);

		$this->successMessage('操作成功', get_return_url(U('HosueSale/lists')));
	}

	public function delete(){
		$this->authView(106);

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('HouseRent/lists')));
		}

		if(is_array($id)){
			D('HouseRent')->where(array('id'=>array('id', $id)))->delete();
		}else{
			D('HouseRent')->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('HouseRent/lists')));
	}
}