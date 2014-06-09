<?php

namespace Admin\Controller;

class UserController extends AdminController{

	public function login(){
		if(!IS_POST){
			return $this->display();
		}

		$validate = array(
			array('username', 'require', '请输入用户名', 1),
			array('password', 'require', '请输入密码', 1)
		);
		$LoginUser = D('AdminUser');
		$data = $LoginUser->validate($validate)->create();
		if(!$data){
			$this->errorInput($LoginUser->getError(), 'User/login', array('username'));
		}
		
		$user = $LoginUser->where(array('username'=>$data['username']))->find();

		if(empty($user)){
			$this->errorInput('用户不存在');
		}

		if(md5($data['password']) != $user['password']){
			$this->errorInput('密码不正确');
		}

		session('uid', $user['id']);

		$returnUrl = cookie('return_url');
		if(empty($returnUrl)){
			$returnUrl = U('Index/index');
		}else{
			cookie('return_url', null);
		}

		redirect($returnUrl);
	}

	public function logout(){
		$user = get_login_user();
		if(!empty($user)){
			session('uid', null);
		}

		$this->redirect('User/login');
	}

	public function lists(){
		$this->authView(100);

		$username = I('get.username');

		$condition = array();
		if($username){
			$condition['username'] = $username;
		}

		$AdminUser = D('AdminUser');

		$userList = $AdminUser->field(true)->where($condition)->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $userList);

		$this->display();
	}

	public function add(){
		$this->authView(100);

		if(IS_POST){
			//C('TOKEN_ON', true);

			$AdminUser = D('AdminUser');
			$data = $AdminUser->create();

			if(!$data){
				$this->errorInput($AdminUser->getError(), 'User/edit');
			}

			if(!isset($data['password'])){
				$data['password'] = md5($data['username']);
			}

			$id = $AdminUser->data($data)->add();

			if(!$id){
				$this->errorMessage('添加失败', 'User/lists');
			}

			$this->successMessage('添加成功', 'User/lists');
		}

		$this->display('edit');
	}
}