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
			$condition['username'] = array('LIKE', "%{$username}%");
		}

		$AdminUser = D('AdminUser');

		$totalCount = $AdminUser->where($condition)->count(1);
		$Page = new \Org\Util\Page($totalCount);

		$AdminUser->field(true)->where($condition);
		$sortInfo = get_sort_info();
		if(!empty($sortInfo)){
			$AdminUser->order($sortInfo);
		}
		$userList = $AdminUser->limit($Page->firstRow, $Page->listRows)->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $userList);
		$this->assign('page', $Page->show());

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

	public function delete(){
		$this->authView(100);

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('User/lists')));
		}

		$AdminUser = M('AdminUser');

		if(is_array($id)){
			$AdminUser->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$AdminUser->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('User/lists')));
	}

	public function resetpassword($id){
		$AdminUser = M('AdminUser');

		$user = $AdminUser->find($id);

		$AdminUser->setField('password', md5($user['username']));

		$this->successMessage('重置成功', get_return_url(U('User/lists')));
	}

	public function assignauth(){

		$this->authView(100);

		$userId = I('id');

		if(empty($userId)){
			$this->error('参数错误');
		}

		$AdminUser = M('AdminUser');

		if(IS_POST){
			$auth = I('auth');
			if(empty($auth)){
				$auth = null;
			}else{
				$auth = implode(',', $auth);
			}
			
			$AdminUser->where(array('id'=>(int)$userId))->setField('auth', $auth);

			$this->successMessage('权限设置成功', get_return_url(U('User/lists')));
		}else{
			$user = $AdminUser->find($userId);
			
			$this->assign('menuList', C('SYS_MENU'));
			$this->assign('user', $user);

			return $this->display();
		}
	}
}