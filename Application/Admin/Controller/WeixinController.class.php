<?php
namespace Admin\Controller;

class WeixinController extends AdminController{
	public function accountlist(){
		$this->authView(124);

		$Account = M('WxAccount');
		$dataList = $Account->field('id,app_id,app_secret,valid_token,desc_txt,status')->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);

		$this->display();
	}

	public function accountedit($id){
		$this->authView(124);

		$Account = M('WxAccount');
		$data = $Account->find($id);

		$this->assign('data', $data);

		$this->display();
	}

	public function accountadd(){
		$this->authView(124);

		$this->display('accountedit');
	}

	public function accountsave(){
		$Account = D('WxAccount');
		$data = $Account->create();
		if(!$data){
			$this->errorInput($Account->getError(), 'Weixin/accountedit');
		}

		$acc = $Account->find($data['id']);
		if(empty($acc)){
			$Account->data($data)->add();
		}else{
			$Account->data($data)->save();
		}

		$this->successMessage('保存成功', 'Weixin/accountlist');
	}

	public function accountdelete(){
		$id = I('id');

		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url('Weixin/accountlist'));
		}

		$Account = M('WxAccount');
		if(is_array($id)){
			$Account->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Account->delete($id);
		}

		$this->successMessage('删除成功', get_return_url('Weixin/accountlist'));
	}

	public function menulist($account = ''){
		$this->authView(125);

		$Account = M('WxAccount');
		$accountList = $Account->field('id,desc_txt')->select();

		if(empty($accountList)){
			$this->error('请先添加微信号');
		}

		$Menu = M('WxMenu');

		if(empty($account)){
			$account = $accountList[0]['id'];
		}

		$dataList = $Menu->where(array('account_id'=>$account))->select();
		$dataList = list_to_tree($dataList);

		$this->assign('account', $account);
		$this->assign('accountList', $accountList);
		$this->assign('dataList', $dataList);

		$this->display();
	}

	public function menuadd($account){
		$this->authView(125);

		$Account = M('WxAccount');
		$account = $Account->find($account);
		if(empty($account)){
			$this->error('账户不存在');
		}

		$Menu = M('WxMenu');
		$topMenuList = $Menu->field('id,name')->where(array('pid'=>-1))->select();

		$this->assign('account', $account);
		$this->assign('topMenuList', $topMenuList);
		$this->display('menuedit');
	}
}