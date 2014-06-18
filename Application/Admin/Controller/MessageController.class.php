<?php
namespace Admin\Controller;

class MessageController extends AdminController{
	

	public function index(){
		$this->authView(119);
		$contact = I('get.contact');
		$condition = array();
		if($contact){
			$condition['contact'] = array('LIKE', "%{$contact}%");
		}
		$Page = new \Think\Page($count,25);
		$Case = M('InfoSubmit');
		$countNum = $Case -> where('status = 0') ->count();
		$dataList = $Case ->where($condition)
		->order('status , create_time desc')
		->limit($Page->firstRow.','.$Page->listRows)
		->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$show = $Page->show();
		$this->assign('page',$show);
		$this->assign('messageNum',$countNum);
		$this->assign('dataList',$dataList);
		$this->display();
	}

	public function delete(){

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('Message/index')));
		}

		$Case = M('InfoSubmit');

		if(is_array($id)){
			$Case->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Case->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('Message/index')));
	}

	public function changeStatus($id, $status){
		
		$Case = D('InfoSubmit');

		$Case->where(array('id'=>(int)$id))->setField('status', $status);

		$this->successMessage('操作成功', get_return_url(U('Message/index')));
	}

	//详细页面
	public function detail($id){
		$Document = D('InfoSubmit');
		$info = $Document->find($id);
		$this->assign('data',$info);
		$Case = D('InfoSubmit');
		$Case->where(array('id'=>(int)$id))->setField('status', 1);
		$this->display();
	}

}