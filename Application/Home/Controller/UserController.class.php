<?php
namespace Home\Controller;

use \Think\Controller;

class UserController extends HomeController{
	
	public function infosubmit(){

		if(IS_POST){
			
			if($this->check_verify($_POST['verify'])){

				$Info = M('InfoSubmit');
				$data = $Info->create();

				if(!$data){
					$this->errorInput($Info->getError(), 'User/infosubmit');
				}

				$data['create_time'] = time();
				$data['status'] = 0;

				//echo json_encode($data); exit();

				$id = $Info->data($data)->add();

				if($id){
					$this->assign('message', '提交成功，经纪人查看后会及时联系您，谢谢您的关注。');
				}else{
					$this->assign('message','提交失败，请联系客服');
				}
			}else{
				$this->assign('message','验证码输入错误');
			}			
		}

		$this->display('infosubmit');

	}

	Public function verify(){
	    $Verify = new \Think\Verify();
		$Verify->entry();
	}

	Public function check_verify($code, $id = ''){
	    $verify = new \Think\Verify();
	    return $verify->check($code, $id);
	}

	public function login(){
		if(IS_POST){
			$username = I('username');
			$password = I('password');
			if(empty($username) || empty($password)){
				$this->error('请输入用户名密码');
			}
			$User = D('User');
			$user = $User->where(array('username'=>$username))->find();
			if(empty($user)){
				$this->error('用户不存在');
			}

			if(md5($password) != $user['password']){
				$this->error('密码不正确');
			}

			$uid = \Think\Crypt::encrypt($user['id'], C('CRYPT_KEY'));
			cookie('uid', $uid);
			$this->redirect('Index/index');
		}else{
			$this->display();
		}
	}

	public function register(){
		if(IS_POST){
			$User = D('User');
			$data = $User->create();
			if($data){
				$data['password'] = md5($data['password']);
				$id = $User->data($data)->add();
				$uid = \Think\Crypt::encrypt($id, C('CRYPT_KEY'));
				cookie('uid', $uid);
				$this->success('注册成功', U('Index/index'));
			}else{
				$this->error($User->getError());
			}
		}else{
			$this->display();
		}
	}

	public function logout(){
		cookie('uid', null);
		$this->redirect('Index/index');
	}
}