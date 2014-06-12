<?php
namespace Admin\Controller;

class HouseSaleController extends AdminController{

	public function lists(){
		$this->authView(103);

		$community = I('get.community');
		$status = I('get.status');

		$condition = array();
		if(!empty($community)){
			$condition['hs.community'] = array('LIKE', "%{$community}%");
		}
		if(!empty($status)){
			$condition['hs.status'] = (int)$status;
		}

		$HouseSale = D('HouseSale');
		$totalCount = $HouseSale->alias('hs')->where($condition)->count();

		$Page = new \Org\Util\Page($totalCount);

		$dataList = $HouseSale->field('hs.id,hs.title,hs.community,hs.status,hs.create_time,area.name area_name,busi_area.name busi_area_name')
			->alias('hs')
			->join('__DISTRICT__ area on area.id=hs.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=hs.busi_area', 'LEFT')
			->where($condition)->limit($Page->firstRow, $Page->listRows)->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);
		$this->assign('page', $Page->show());

		$this->display();
	}


	public function add(){
		$this->authView(102);

		if(IS_POST){
			$HouseSale = D('HouseSale');
			$data = $HouseSale->saveOrUpdate();
			if(!$data){
				$this->errorInput($HouseSale->getError(), 'HouseSale/edit');
			}

			$this->successMessage('发布成功', 'HouseSale/add');
		}else{
			$this->display('edit');
		}
	}

	public function edit(){
		$this->authView(103);

		if(IS_POST){
			$HouseSale = D('HouseSale');
			$data = $HouseSale->saveOrUpdate();
			if(!$data){
				$this->errorInput($HouseSale->getError(), 'HouseSale/edit');
			}

			$this->successMessage('修改成功', get_return_url('HouseSale/lists'));
		}else{
			$HouseSale = D('HouseSale');
			$id = I('id');
			if(empty($id)){
				$this->error('参数不正确');
			}
			$data = $HouseSale->find($id);
			if(empty($data)){
				$this->error('数据不存在');
			}

			$Picture = M('Picture');
			$picList = $Picture->field('id,path')->where(array('pid'=>$data['id'], 'type'=>1))->select();
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
		$this->authView(103);
		$HouseSale = D('HouseSale');

		$HouseSale->where(array('id'=>(int)$id))->setField('status', $status);

		$this->successMessage('操作成功', get_return_url(U('HosueSale/lists')));
	}

	public function delete(){
		$this->authView(103);

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('HouseSale/lists')));
		}

		if(is_array($id)){
			D('HouseSale')->where(array('id'=>array('id', $id)))->delete();
		}else{
			D('HouseSale')->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('HouseSale/lists')));
	}

}