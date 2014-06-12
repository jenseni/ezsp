<?php
namespace Admin\Controller;

class ShortRentController extends AdminController{

	public function lists(){
		$this->authView(108);

		$title = I('get.title');
		$status = I('get.status');

		$condition = array();
		if(!empty($title)){
			$condition['hs.title'] = array('LIKE', "%{$title}%");
		}
		if(!empty($status)){
			$condition['hs.status'] = (int)$status;
		}

		$Case = D('ShortRent');
		$totalCount = $Case->alias('hs')->where($condition)->count();

		$Page = new \Org\Util\Page($totalCount);

		$dataList = $Case->field('hs.id,hs.title,hs.title,hs.status,hs.create_time,area.name area_name,busi_area.name busi_area_name')
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
		$this->authView(107);

		if(IS_POST){
			$Case = D('ShortRent');
			$data = $Case->saveOrUpdate();
			if(!$data){
				$this->errorInput($Case->getError(), 'ShortRent/edit');
			}

			$this->successMessage('发布成功', 'ShortRent/add');
		}else{
			$this->display('edit');
		}
	}

	public function edit(){
		$this->authView(108);

		if(IS_POST){
			$Case = D('ShortRent');
			$data = $Case->saveOrUpdate();
			if(!$data){
				$this->errorInput($Case->getError(), 'ShortRent/edit');
			}

			$this->successMessage('修改成功', get_return_url('ShortRent/lists'));
		}else{
			$Case = D('ShortRent');
			$id = I('id');
			if(empty($id)){
				$this->error('参数不正确');
			}
			$data = $Case->find($id);
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

	public function changeStatus($id,$status){
		$this->authView(108);
		$id = I('id');

		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('ShortRent/lists')));
		}

		if(is_array($id)){
			D('ShortRent')->where(array('id'=>array('IN', $id)))->setField('status', $status);
			$message = '批量操作成功';	
		}else{
			D('ShortRent')->where(array('id'=>(int)$id))->setField('status', $status);
			$message = '操作成功';	
		}

		$this->successMessage($message, get_return_url(U('ShortRent/lists')));
	}

	public function delete(){
		$this->authView(108);

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('ShortRent/lists')));
		}

		if(is_array($id)){
			D('ShortRent')->where(array('id'=>array('IN', $id)))->delete();
		}else{
			D('ShortRent')->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('ShortRent/lists')));
	}

}